<?php

// src/Data/QaDataGenerator.php

namespace App\Data;

class QaDataGenerator
{
    public static function getSamples(): array
    {
        return [
            ['Como está o tempo hoje?'],
            ['Quais são os sintomas da gripe?'],
            ['Como posso melhorar minha alimentação?'],
            ['O que é hipertensão?'],
            ['Como praticar exercícios em casa?'],
            // Adicione mais perguntas conforme necessário
        ];
    }

    public static function getLabels(): array
    {
        return [
            'A resposta sobre o tempo.',
            'A resposta sobre sintomas da gripe.',
            'A resposta sobre melhoria da alimentação.',
            'A resposta sobre hipertensão.',
            'A resposta sobre exercícios em casa.',
            // Respostas correspondentes
        ];
    }
}
