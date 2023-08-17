<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\EmployeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EmployeRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Put()
    ],
)]
// #[Post(denormalizationContext: ['groups' => ['write_employe']])]
class Employe extends User
{
    #[ORM\ManyToOne(inversedBy: 'employes')]
    #[Groups(['write_employe'])]
    private ?Ferme $ferme = null;

    #[ORM\ManyToOne(inversedBy: 'employes')]
   
    private ?Fermier $fermier = null;

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