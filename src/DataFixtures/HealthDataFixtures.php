<?php

namespace App\DataFixtures;

use App\Entity\HealthData;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class HealthDataFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Cria uma instância do Faker
        $faker = Factory::create();

        for ($i = 0; $i < 100; $i++) {
            $healthData = new HealthData();

            // Gera dados fictícios para cada campo
            $healthData->setIdade($faker->numberBetween(18, 80)); // Idade entre 18 e 80 anos
            $healthData->setSexo($faker->randomElement(['Masculino', 'Feminino'])); // Sexo
            $healthData->setPeso($faker->randomFloat(1, 50, 100)); // Peso entre 50.0 e 100.0 com uma casa decimal
            $healthData->setHabito1($faker->boolean); // Verdadeiro ou falso para Habito1
            $healthData->setHabito2($faker->boolean); // Verdadeiro ou falso para Habito2
            $healthData->setLabel($faker->randomElement(['Saudável', 'Em Risco', 'Necessita Atenção'])); // Rótulo

            $manager->persist($healthData);
        }

        $manager->flush();
    }
}
