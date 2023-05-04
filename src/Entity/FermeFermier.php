<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\FermeFermierRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FermeFermierRepository::class)]
#[ApiResource()]
class FermeFermier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'fermeFermiers')]
    private ?Ferme $ferme = null;

    #[ORM\ManyToOne(inversedBy: 'fermeFermiers')]
    private ?Fermier $fermier = null;

    public function getId(): ?int
    {
        return $this->id;
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
}