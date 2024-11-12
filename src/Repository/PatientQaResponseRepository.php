<?php

namespace App\Repository;

use App\Entity\QaData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PatientQaResponseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PatientQaResponse::class);
    }

    // Métodos personalizados, se necessário
}
