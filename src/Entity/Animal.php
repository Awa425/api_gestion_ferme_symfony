<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AnimalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
#[ApiResource()]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(nullable: true)]
    private ?int $age = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isEtat = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $dateAt = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    private ?Ferme $ferme = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    private ?Fermier $fermier = null;

    #[ORM\ManyToOne(inversedBy: 'animal')]
    private ?Veterinaire $veterinaire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function isIsEtat(): ?bool
    {
        return $this->isEtat;
    }

    public function setIsEtat(?bool $isEtat): self
    {
        $this->isEtat = $isEtat;

        return $this;
    }

    public function getDateAt(): ?\DateTimeImmutable
    {
        return $this->dateAt;
    }

    public function setDateAt(?\DateTimeImmutable $dateAt): self
    {
        $this->dateAt = $dateAt;

        return $this;
    }

    public function getFerme(): ?Ferme
    {
        return $this->ferme;
    }

    public function setFerme(?Ferme $ferme): self
    {
        $this->ferme = $ferme;

        return $this;
    }

    public function getFermier(): ?Fermier
    {
        return $this->fermier;
    }

    public function setFermier(?Fermier $fermier): self
    {
        $this->fermier = $fermier;

        return $this;
    }

    public function getVeterinaire(): ?Veterinaire
    {
        return $this->veterinaire;
    }

    public function setVeterinaire(?Veterinaire $veterinaire): self
    {
        $this->veterinaire = $veterinaire;

        return $this;
    }
}