<?php

namespace App\Entity;

use App\Repository\HealthDataRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: HealthDataRepository::class)]
#[ORM\Table(name: 'health_data')]
class HealthData
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank]
    #[Assert\Range(min: 0, max: 120)]
    private int $idade;

    #[ORM\Column(type: 'string', length: 20)]
    #[Assert\NotBlank]
    #[Assert\Choice(choices: ["Masculino", "Feminino"])]
    private string $sexo;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private float $peso;

    #[ORM\Column(type: 'boolean')]
    private bool $habito1;

    #[ORM\Column(type: 'boolean')]
    private bool $habito2;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank]
    private string $label;

    #[ORM\OneToMany(mappedBy: 'healthData', targetEntity: PatientQaResponse::class)]
    private Collection $qaResponses;

    public function __construct()
    {
        $this->qaResponses = new ArrayCollection();
    }

    public function getQaResponses(): Collection
    {
        return $this->qaResponses;
    }

    public function addQaResponse(PatientQaResponse $qaResponse): self
    {
        if (!$this->qaResponses->contains($qaResponse)) {
            $this->qaResponses[] = $qaResponse;
            $qaResponse->setHealthData($this);
        }

        return $this;
    }

    public function removeQaResponse(PatientQaResponse $qaResponse): self
    {
        if ($this->qaResponses->removeElement($qaResponse)) {
            // Set the owning side to null (unless already changed)
            if ($qaResponse->getHealthData() === $this) {
                $qaResponse->setHealthData(null);
            }
        }

        return $this;
    }


    // Getters e Setters...

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdade(): int
    {
        return $this->idade;
    }

    public function setIdade(int $idade): self
    {
        $this->idade = $idade;

        return $this;
    }

    public function getSexo(): string
    {
        return $this->sexo;
    }

    public function setSexo(string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getPeso(): float
    {
        return $this->peso;
    }

    public function setPeso(float $peso): self
    {
        $this->peso = $peso;

        return $this;
    }

    public function getHabito1(): bool
    {
        return $this->habito1;
    }

    public function setHabito1(bool $habito1): self
    {
        $this->habito1 = $habito1;

        return $this;
    }

    public function getHabito2(): bool
    {
        return $this->habito2;
    }

    public function setHabito2(bool $habito2): self
    {
        $this->habito2 = $habito2;

        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    // Continue com os demais getters e setters...
}
