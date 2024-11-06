<?php

// src/Service/HealthService.php

namespace App\Service;

use Rubix\ML\Persisters\Filesystem;
use Rubix\ML\Classifiers\RandomForest;
use Rubix\ML\Transformers\OneHotEncoder;

class HealthService
{
    private RandomForest $estimator;
    private OneHotEncoder $encoder;

    public function __construct(string $modelPath)
    {
        // Carregar o modelo
        $persister = new Filesystem($modelPath);
        $this->estimator = $persister->load();

        // Configurar o codificador (mesmo usado no treinamento)
        $this->encoder = new OneHotEncoder(['sexo']);
    }

    public function evaluate(array $userData): ?string
    {
        // userData deve estar no formato: [idade, sexo, peso, hábito1, hábito2]
        $this->encoder->transform($userData);

        $prediction = $this->estimator->predict([$userData]);

        return $prediction[0] ?? null;
    }
}
