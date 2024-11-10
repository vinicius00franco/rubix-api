<?php
namespace App\Entity;

use App\Repository\ModelMetadataRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModelMetadataRepository::class)]
#[ORM\Table(name: 'model_metadata')]
class ModelMetadata
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(type: Types::STRING)]
    private string $filePath;

    #[ORM\Column(type: Types::STRING, length: 5)]
    private string $uniqueId;

    #[ORM\Column(type: Types::FLOAT)]
    private float $accuracy;

    #[ORM\Column(type: Types::FLOAT)]
    private float $f1Score;

    // Getters and Setters
    public function getId(): int
    {
        return $this->id;
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }

    public function setFilePath(string $filePath): self
    {
        $this->filePath = $filePath;
        return $this;
    }

    public function getUniqueId(): string
    {
        return $this->uniqueId;
    }

    public function setUniqueId(string $uniqueId): self
    {
        $this->uniqueId = $uniqueId;
        return $this;
    }

    public function getAccuracy(): float
    {
        return $this->accuracy;
    }

    public function setAccuracy(float $accuracy): self
    {
        $this->accuracy = $accuracy;
        return $this;
    }

    public function getF1Score(): float
    {
        return $this->f1Score;
    }

    public function setF1Score(float $f1Score): self
    {
        $this->f1Score = $f1Score;
        return $this;
    }
}
