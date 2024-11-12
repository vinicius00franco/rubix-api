<?php

namespace App\Data;


use App\Repository\QaDataRepository;

class QaDataGenerator
{
    private QaDataRepository $qaDataRepository;

    public function __construct(QaDataRepository $qaDataRepository)
    {
        $this->qaDataRepository = $qaDataRepository;
    }

    /**
     * Retorna as amostras e labels para treinamento do modelo.
     *
     * @return array [samples, labels]
     */
    public function getSamplesAndLabels(): array
    {
        $qaDataList = $this->qaDataRepository->findAll();

        $samples = [];
        $labels = [];

        foreach ($qaDataList as $data) {
            $samples[] = $data->getQuestion();
            $labels[] = $data->getAnswer();
        }

        return [$samples, $labels];
    }
}
