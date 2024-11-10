<?php

namespace App\Data;

use App\Entity\HealthData;
use App\Repository\HealthDataRepository;

class HealthDataGenerator
{


    public function __construct(
        private HealthDataRepository $healthDataRepository
        )
    {
        $this->healthDataRepository = $healthDataRepository;
    }

    /**
     * Retorna as features e labels para treinamento do modelo.
     *
     * @return array [features, labels]
     */
    public function getFeaturesAndLabels(): array
    {
        $healthDataList = $this->healthDataRepository->findAllHealthData();

        //dd($healthDataList);

        $features = [];
        $labels = [];

        foreach ($healthDataList as $data) {
            $features[] = [
                $data->getIdade(),
                $data->getSexo(),
                $data->getPeso(),
                $data->getHabito1() ? 1 : 0,
                $data->getHabito2() ? 1 : 0,
            ];
            $labels[] = $data->getLabel();
        }

        return [$features, $labels];
    }
}
