<?php

namespace App\Command;

use Rubix\ML\Pipeline;
use Rubix\ML\Persisters\Filesystem;
use Rubix\ML\Transformers\WordCountVectorizer;
use Rubix\ML\Tokenizers\Whitespace;
use Rubix\ML\Transformers\TfIdfTransformer;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Data\QaDataGenerator;
use Rubix\ML\Classifiers\MultinomialNaiveBayes;
use Rubix\ML\Classifiers\NaiveBayes;
use Rubix\ML\Datasets\Labeled;
use Rubix\ML\PersistentModel;
use Rubix\ML\Transformers\IntervalDiscretizer;

#[AsCommand(
    name: 'app:train-qa-model',
    description: 'Treina e salva o modelo de Q&A.'
)]
class TrainQaModelCommand extends Command
{
    private QaDataGenerator $qaDataGenerator;

    public function __construct(QaDataGenerator $qaDataGenerator)
    {
        parent::__construct();
        $this->qaDataGenerator = $qaDataGenerator;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        [$samples, $labels] = $this->qaDataGenerator->getSamplesAndLabels();

        if (empty($samples) || empty($labels)) {
            $output->writeln('Erro: Amostras ou rótulos estão vazios.');
            return Command::FAILURE;
        }

        // Cria o dataset rotulado
        $dataset = new Labeled($samples, $labels);

        // Pipeline de pré-processamento
        $pipeline = new Pipeline([
            new WordCountVectorizer(10000, 1, 0.8, new Whitespace()),
            new TfIdfTransformer(),
            new IntervalDiscretizer(5),
        ], new NaiveBayes());

        // Treinamento
        $pipeline->train($dataset);



        // Garantir que o diretório 'models' exista
        $directory = 'models/qa';
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        // Gerar um identificador único para o modelo
        $uniqueId = substr(uniqid(), -5);
        $filename = "model_qa_{$uniqueId}.rbx";
        $filePath = "{$directory}/{$filename}";

        // Persistência do modelo
        $persister = new Filesystem($filePath);
        $model = new PersistentModel($pipeline, $persister);
        $model->save();


        $output->writeln('Modelo de Q&A treinado e salvo com sucesso.');

        return Command::SUCCESS;
    }
}
