<?php

namespace App\Command;

use Rubix\ML\Pipeline;
use Rubix\ML\Persisters\Filesystem;
use Rubix\ML\Classifiers\MultinomialNB;
use Rubix\ML\Tokenizers\WhitespaceTokenizer;
use Rubix\ML\FeatureExtraction\TokenCountVectorizer;
use Rubix\ML\FeatureExtraction\TfIdfTransformer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Data\QaDataGenerator;

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

        // Pipeline de pré-processamento
        $pipeline = new Pipeline([
            new TokenCountVectorizer(new WhitespaceTokenizer()),
            new TfIdfTransformer(),
        ], new MultinomialNB());

        // Treinamento
        $pipeline->train($samples, $labels);

        // Persistência do modelo
        $persister = new Filesystem('models/model_qa.rbx');
        $persister->save($pipeline);

        $output->writeln('Modelo de Q&A treinado e salvo com sucesso.');

        return Command::SUCCESS;
    }
}
