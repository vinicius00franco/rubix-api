<?php

namespace App\Command;

use Rubix\ML\Pipeline;
use Rubix\ML\Transformers\OneHotEncoder;
use Rubix\ML\Transformers\ZScaleStandardizer;
use Rubix\ML\Transformers\MissingDataImputer;
use Rubix\ML\Classifiers\RandomForest;
use Rubix\ML\Datasets\Labeled;
use Rubix\ML\CrossValidation\KFold;
use Rubix\ML\CrossValidation\Metrics\Accuracy;
use Rubix\ML\CrossValidation\Metrics\FBeta;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Data\HealthDataGenerator;
use App\Repository\ModelMetadataRepository;
use Rubix\ML\Classifiers\ClassificationTree;

#[AsCommand(
    name: 'app:train-health-model',
    description: 'Treina e salva o modelo de avaliação de saúde aprimorado.'
)]
class TrainHealthModelCommand extends Command
{
    public function __construct(
        private HealthDataGenerator $healthDataGenerator,
        private ModelMetadataRepository $modelMetadataRepository
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Obter as features e labels
        [$features, $labels] = $this->healthDataGenerator->getFeaturesAndLabels();

        // Verificação de dados vazios
        if (empty($features) || empty($labels)) {
            $output->writeln('<error>Erro: Nenhum dado encontrado para treinar o modelo.</error>');
            return Command::FAILURE;
        }

        // Verificação e conversão dos tipos de dados
        foreach ($features as &$row) {
            // Converter 'idade' e 'peso' para float
            $row['idade'] = (float) $row['idade'];
            $row['peso'] = (float) $row['peso'];

            // Converter 'habito1' e 'habito2' para inteiros
            $row['habito1'] = (int) $row['habito1'];
            $row['habito2'] = (int) $row['habito2'];
        }

        // Criação do Dataset
        $dataset = new Labeled($features, $labels);

        // Pipeline de Pré-processamento e Modelo
        $pipeline = new Pipeline([
            // Tratamento de Valores Ausentes
            //new MissingDataImputer(), // Preenche valores ausentes com a média (default)

            // Codificação de Variáveis Categóricas
            new OneHotEncoder(['sexo']), // Codifica a coluna 'sexo'

            // Escalonamento das Features Numéricas
            new ZScaleStandardizer(),
        ], new RandomForest(new ClassificationTree(10), 100, 0.2, true)); // Número de árvores, profundidade máxima, etc.

        // Validação Cruzada para Avaliação do Modelo
        $kfold = new KFold(5);
        $accuracyMetric = new Accuracy();
        $f1Metric = new FBeta(1.0);

        // Avaliação de Performance
        $accuracyScore = $kfold->test($pipeline, $dataset, $accuracyMetric);
        $f1Score = $kfold->test($pipeline, $dataset, $f1Metric);

        // Log de Métricas
        $output->writeln(sprintf('Acurácia Média: %.2f%%', $accuracyScore * 100));
        $output->writeln(sprintf('F1 Score Médio: %.2f', $f1Score));


        // Treinamento Final do Modelo com Todos os Dados
        $pipeline->train($dataset);

        // Serialização do Modelo
        $serializedPipeline = serialize($pipeline);

        // Garantir que o diretório 'models' exista
        $directory = 'models';
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        // Gerar um identificador único para o modelo
        $uniqueId = substr(uniqid(), -5);
        $filename = "model_health_{$uniqueId}.rbx";
        $filePath = "{$directory}/{$filename}";

        // Salvar o modelo no sistema de arquivos
        file_put_contents($filePath, $serializedPipeline);

        // Salvar Metadados no Banco de Dados
        $this->modelMetadataRepository->saveModelMetadata($filePath, $uniqueId, $accuracyScore, $f1Score);

        $output->writeln('Modelo de Avaliação de Saúde treinado e salvo com sucesso.');

        return Command::SUCCESS;
    }
}
