<?php

namespace App\Service;

use Rubix\ML\Pipeline;
use Rubix\ML\Persisters\Filesystem;

class QaService
{
    private Pipeline $pipeline;

    public function __construct(string $modelPath)
    {
        $persister = new Filesystem($modelPath);
        $this->pipeline = $persister->load();
    }

    /**
     * Obtém a resposta para uma pergunta fornecida.
     *
     * @param string $question
     * @return string|null
     */
    public function getAnswer(string $question): ?string
    {
        $prediction = $this->pipeline->predict([$question]);

        return $prediction[0] ?? null;
    }
}
