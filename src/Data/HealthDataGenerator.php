<?php

// src/Data/HealthDataGenerator.php

namespace App\Data;

class HealthDataGenerator
{
    public static function getFeatures(): array
    {
        return [
            [25, 'Masculino', 70, 1, 0],
            [40, 'Feminino', 60, 0, 1],
            [30, 'Masculino', 80, 1, 1],
            [50, 'Feminino', 55, 0, 0],
            [35, 'Masculino', 90, 1, 0],
            // Adicione mais registros conforme necessário
        ];
    }

    public static function getLabels(): array
    {
        return [
            'Saudável',
            'Em Risco',
            'Necessita Atenção',
            'Saudável',
            'Em Risco',
            // Rótulos correspondentes
        ];
    }
}
