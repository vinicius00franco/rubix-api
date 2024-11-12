<?php

namespace App\Entity;

use App\Repository\PatientQaResponseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PatientQaResponseRepository::class)]
class PatientQaResponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private $id;

    #[ORM\ManyToOne(targetEntity: "App\Entity\HealthData")]
    #[ORM\JoinColumn(nullable: false)]
    private $healthData;

    #[ORM\ManyToOne(targetEntity: "App\Entity\QaData")]
    #[ORM\JoinColumn(nullable: false)]
    private $qaData;

    #[ORM\Column(type: "integer", nullable: true)]
    private $response;

    // Getters e Setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHealthData(): ?HealthData
    {
        return $this->healthData;
    }

    public function setHealthData(?HealthData $healthData): self
    {
        $this->healthData = $healthData;

        return $this;
    }

    public function getQaData(): ?QaData
    {
        return $this->qaData;
    }

    public function setQaData(?QaData $qaData): self
    {
        $this->qaData = $qaData;

        return $this;
    }

    public function getResponse(): ?int
    {
        return $this->response;
    }

    public function setResponse(?int $response): self
    {
        $this->response = $response;

        return $this;
    }
}
