<?php

namespace App\DataFixtures;

use App\Entity\HealthData;
use App\Entity\PatientQaResponse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Carregar HealthData e PatientQaResponse
        for ($i = 301; $i <= 400; $i++) {
            $healthData = new HealthData();
            $healthData->setIdade(25); // Defina um valor para idade
            $healthData->setSexo('Masculino');
            $healthData->setPeso(70.5);
            $healthData->setHabito1(true);
            $healthData->setHabito2(false);
            $manager->persist($healthData);

            // Criar uma resposta para cada pergunta existente
            for ($qid = 0; $qid < 50; $qid++) { // Ajuste o número para a quantidade total de QaData carregados em QaDataFixtures
                $response = new PatientQaResponse();
                $response->setHealthData($healthData);
                $response->setQaData($this->getReference('qa_' . $qid));
                $response->setResponse(random_int(1, 5)); // Exemplo de resposta aleatória entre 1 e 5
                $manager->persist($response);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            QaDataFixtures::class,
        ];
    }
}
