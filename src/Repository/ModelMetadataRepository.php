<?php


namespace App\Repository;

use App\Entity\ModelMetadata;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ModelMetadataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModelMetadata::class);
    }

    public function saveModelMetadata(string $filePath, string $uniqueId, float $accuracy, float $f1Score): void
    {
        $entityManager = $this->getEntityManager(); 
        
        $modelMetadata = new ModelMetadata();
        $modelMetadata->setFilePath($filePath);
        $modelMetadata->setUniqueId($uniqueId);
        $modelMetadata->setAccuracy($accuracy);
        $modelMetadata->setF1Score($f1Score);

        // Use getEntityManager() instead of _em
        $entityManager->persist($modelMetadata);
        $entityManager->flush();
    }
}
