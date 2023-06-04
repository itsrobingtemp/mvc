<?php

namespace App\Entity;

use App\Repository\HealthDiseaseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HealthDiseaseRepository::class)]
class HealthDisease
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $type = null;

    #[ORM\Column]
    private ?string $country = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column]
    private ?float $data = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getData(): ?float
    {
        return $this->data;
    }

    public function setData(float $data): self
    {
        $this->data = $data;

        return $this;
    }
}
