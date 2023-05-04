<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\VeterinaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VeterinaireRepository::class)]
#[ApiResource()]
class Veterinaire extends User
{
    #[ORM\ManyToOne(inversedBy: 'veterinaires')]
    private ?Fermier $fermier = null;

    #[ORM\OneToMany(mappedBy: 'veterinaire', targetEntity: Animal::class)]
    private Collection $animal;

    #[ORM\OneToMany(mappedBy: 'veterinaire', targetEntity: FermeVeterinaire::class)]
    private Collection $fermeVeterinaires;

    public function __construct()
    {
        $this->animal = new ArrayCollection();
        $this->fermeVeterinaires = new ArrayCollection();
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

    /**
     * @return Collection<int, Animal>
     */
    public function getAnimal(): Collection
    {
        return $this->animal;
    }

    public function addAnimal(Animal $animal): self
    {
        if (!$this->animal->contains($animal)) {
            $this->animal->add($animal);
            $animal->setVeterinaire($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): self
    {
        if ($this->animal->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getVeterinaire() === $this) {
                $animal->setVeterinaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FermeVeterinaire>
     */
    public function getFermeVeterinaires(): Collection
    {
        return $this->fermeVeterinaires;
    }

    public function addFermeVeterinaire(FermeVeterinaire $fermeVeterinaire): self
    {
        if (!$this->fermeVeterinaires->contains($fermeVeterinaire)) {
            $this->fermeVeterinaires->add($fermeVeterinaire);
            $fermeVeterinaire->setVeterinaire($this);
        }

        return $this;
    }

    public function removeFermeVeterinaire(FermeVeterinaire $fermeVeterinaire): self
    {
        if ($this->fermeVeterinaires->removeElement($fermeVeterinaire)) {
            // set the owning side to null (unless already changed)
            if ($fermeVeterinaire->getVeterinaire() === $this) {
                $fermeVeterinaire->setVeterinaire(null);
            }
        }

        return $this;
    }
}