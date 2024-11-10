<?php

namespace App\Repository;

use App\Entity\HealthData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class HealthDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HealthData::class);
    }

    // Métodos personalizados, se necessário

    public function findAllHealthData(): array
    {
        return $this->createQueryBuilder('h')
            ->getQuery()
            ->getResult();
    }
}
