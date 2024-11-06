<?php


// src/Command/TrainHealthModelCommand.php

namespace App\Command;

use Rubix\ML\Classifiers\RandomForest;
use Rubix\ML\Transformers\OneHotEncoder;
use Rubix\ML\Datasets\Labeled;
use Rubix\ML\Persisters\Filesystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Data\HealthDataGenerator;

class TrainHealthModelCommand extends Command
{
    protected static $defaultName = 'app:train-health-model';
    protected static $defaultDescription = 'Treina e salva o modelo de avaliação de saúde.';

    protected function configure()
    {
        // Descrição e ajuda
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Obter dados
        $features = HealthDataGenerator::getFeatures();
        $labels = HealthDataGenerator::getLabels();

        // Pré-processamento: Codificação de variáveis categóricas
        $encoder = new OneHotEncoder(['sexo']);
        $encoder->fit($features);
        $encoder->transform($features);

        // Criação do dataset
        $dataset = new Labeled($features, $labels);

        // Modelo
        $estimator = new RandomForest(100);

        // Treinamento
        $estimator->train($dataset);

        // Persistência do modelo
        $persister = new Filesystem('models/model_health.rbx');
        $persister->save($estimator);

        $output->writeln('Modelo de Avaliação de Saúde treinado e salvo com sucesso.');

        return Command::SUCCESS;
    }
}
