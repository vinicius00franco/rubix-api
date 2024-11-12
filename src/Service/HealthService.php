<?php

namespace App\Service;

use Rubix\ML\Pipeline;
use Rubix\ML\Persisters\Filesystem;
use Rubix\ML\Datasets\Unlabeled;

class HealthService
{
    private Pipeline $pipeline;

    public function __construct()
    {
        // Diretório onde os modelos treinados estão armazenados
        $modelDirectory = 'models';
        $modelFiles = glob("$modelDirectory/model_health_*.rbx");

        // Ordenar os modelos pelo tempo de modificação para pegar o mais recente
        usort($modelFiles, function ($a, $b) {
            return filemtime($b) - filemtime($a);
        });

        // Verificar se existe ao menos um modelo treinado
        if (empty($modelFiles)) {
            throw new \Exception('Nenhum modelo treinado encontrado.');
        }

        // Carregar o modelo mais recente
        $latestModelPath = $modelFiles[0];
        $persister = new Filesystem($latestModelPath);
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
        // Criar um dataset não rotulado para a predição
        $dataset = new Unlabeled([$userData]);

        // Fazer a predição
        $prediction = $this->pipeline->predict($dataset);

        return $prediction[0] ?? null;
    }
}
