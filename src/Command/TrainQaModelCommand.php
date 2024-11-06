<?php

// src/Command/TrainQaModelCommand.php

namespace App\Command;

use Rubix\ML\Classifiers\MultinomialNB;
use Rubix\ML\FeatureExtraction\TokenCountVectorizer;
use Rubix\ML\FeatureExtraction\TfIdfTransformer;
use Rubix\ML\Pipeline;
use Rubix\ML\Persisters\Filesystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Data\QaDataGenerator;

class TrainQaModelCommand extends Command
{
    protected static $defaultName = 'app:train-qa-model';
    protected static $defaultDescription = 'Treina e salva o modelo de Q&A.';

    protected function configure()
    {
        // Descrição e ajuda
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Obter dados
        $samples = QaDataGenerator::getSamples();
        $labels = QaDataGenerator::getLabels();

        // Pipeline de pré-processamento
        $vectorizer = new TokenCountVectorizer(new \Rubix\ML\Tokenizers\WhitespaceTokenizer());
        $transformer = new TfIdfTransformer();

        // Modelo
        $estimator = new MultinomialNB();

        // Pipeline completo
        $pipeline = new Pipeline([
            $vectorizer,
            $transformer,
            $estimator
        ]);

        // Treinamento
        $pipeline->train($samples, $labels);

        // Persistência do modelo
        $persister = new Filesystem('models/model_qa.rbx');
        $persister->save($pipeline);

        $output->writeln('Modelo de Q&A treinado e salvo com sucesso.');

        return Command::SUCCESS;
    }
}
