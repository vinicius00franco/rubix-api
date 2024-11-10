<?php

namespace App\Command;

use Rubix\ML\Pipeline;
use Rubix\ML\Persisters\Filesystem;
use Rubix\ML\Transformers\OneHotEncoder;
use Rubix\ML\Classifiers\RandomForest;
use Rubix\ML\Datasets\Labeled;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Data\HealthDataGenerator;
use App\Entity\ModelMetadata;
use App\Repository\ModelMetadataRepository;
use Rubix\ML\Datasets\Unlabeled;
use Rubix\ML\CrossValidation\Metrics\Accuracy;
use Rubix\ML\CrossValidation\Metrics\FBeta;

#[AsCommand(
    name: 'app:train-health-model',
    description: 'Treina e salva o modelo de avaliação de saúde.'
)]
class TrainHealthModelCommand extends Command
{
    
    public function __construct(
        private HealthDataGenerator $healthDataGenerator,
        private ModelMetadataRepository $modelMetadataRepository
        )
    {
        parent::__construct();
        $this->healthDataGenerator = $healthDataGenerator;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        [$features, $labels] = $this->healthDataGenerator->getFeaturesAndLabels();

        // Verificação de dados vazios
        if (empty($features) || empty($labels)) {
            $output->writeln('<error>Erro: Nenhum dado encontrado para treinar o modelo.</error>');
            return Command::FAILURE;
        }

        // Codificação de variáveis categóricas
        $encoder = new OneHotEncoder([1]); // Índice da coluna 'sexo'

        // Modelo
        $estimator = new RandomForest(null, 100);

        // Pipeline completo
        $pipeline = new Pipeline([
            $encoder,
        ], $estimator);

        // Criação do Dataset
        $dataset = new Labeled($features, $labels);

        // Treinamento
        $pipeline->train($dataset);

        // Calculate metrics (Accuracy and F1 score)
        $predictions = $pipeline->predict(new Unlabeled($features));


        $accuracyMetric = new Accuracy();
        $f1Metric = new FBeta(1.0);

        $accuracy = $accuracyMetric->score($predictions, $labels);
        $f1Score = $f1Metric->score($predictions, $labels);

        // Serialize the Pipeline object to a string
        $serializedPipeline = serialize($pipeline);

        // Ensure the 'models' directory exists
        $directory = 'models';
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        /// Generate a unique 5-digit identifier for the model file
        $uniqueId = substr(uniqid(), -5);
        $filename = "model_health_{$uniqueId}.rbx";
        $filePath = "{$directory}/{$filename}";

        // Save the serialized model to the file
        file_put_contents($filePath, $serializedPipeline);

        // Save metadata to the database using the repository
        $this->modelMetadataRepository->saveModelMetadata($filePath, $uniqueId, $accuracy, $f1Score);

        $output->writeln('Modelo de Avaliação de Saúde treinado e salvo com sucesso.');

        return Command::SUCCESS;
    }
}
