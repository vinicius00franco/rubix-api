<?php

namespace App\Data;

use App\Repository\HealthDataRepository;
use App\Repository\QaDataRepository;

class HealthDataGenerator
{
    private $healthDataRepository;
    private $qaDataRepository;

    public function __construct(
        HealthDataRepository $healthDataRepository,
        QaDataRepository $qaDataRepository
    ) {
        $this->healthDataRepository = $healthDataRepository;
        $this->qaDataRepository = $qaDataRepository;
    }

    public function getFeaturesAndLabels(): array
    {
        // Obter todos os registros de saúde
        $healthRecords = $this->healthDataRepository->findAll();

        // Obter todas as perguntas
        $qaItems = $this->qaDataRepository->findAll();

        // Preparar as perguntas como colunas de features
        $questionIds = [];
        foreach ($qaItems as $qa) {
            $questionIds[] = $qa->getId();
        }

        $features = [];
        $labels = [];

        foreach ($healthRecords as $record) {
            $feature = [
                'idade' => $record->getIdade(),
                'sexo' => $record->getSexo(),
                'peso' => $record->getPeso(),
                'habito1' => $record->getHabito1(),
                'habito2' => $record->getHabito2(),
                // Adicione outras features estruturadas conforme necessário
            ];

            // Obter as respostas do paciente às perguntas
            foreach ($record->getQaResponses() as $qaResponse) {
                $qid = $qaResponse->getQaData()->getId(); // ID da pergunta
                $feature["qa_{$qid}"] = $qaResponse->getResponse();
            }

            $features[] = $feature;
            $labels[] = $record->getLabel();
        }

        return [$features, $labels];
    }
}
