<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\FermeVeterinaireRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FermeVeterinaireRepository::class)]
#[ApiResource()]
class FermeVeterinaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'fermeVeterinaires')]
    private ?Ferme $ferme = null;

    #[ORM\ManyToOne(inversedBy: 'fermeVeterinaires')]
    private ?Veterinaire $veterinaire = null;

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