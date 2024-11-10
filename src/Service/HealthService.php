<?php

namespace App\Service;

use Rubix\ML\Pipeline;
use Rubix\ML\Persisters\Filesystem;

class HealthService
{
    private Pipeline $pipeline;

    public function __construct(string $modelPath)
    {
        $persister = new Filesystem($modelPath);
        $this->pipeline = $persister->load();
    }

    /**
     * Avalia a saúde do usuário com base nos dados fornecidos.
     *
     * @param array $userData [idade, sexo, peso, habito1, habito2]
     * @return string|null
     */
    public function evaluate(array $userData): ?string
    {
        $prediction = $this->pipeline->predict([$userData]);

        return $prediction[0] ?? null;
    }
}
