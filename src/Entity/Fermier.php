<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\FermierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FermierRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Put()
    ]
)]
class Fermier extends User
{
    #[ORM\OneToMany(mappedBy: 'fermier', targetEntity: FermeFermier::class)]
    private Collection $fermeFermiers;

    #[ORM\OneToMany(mappedBy: 'fermier', targetEntity: Employe::class)]
    private Collection $employes;

    #[ORM\OneToMany(mappedBy: 'fermier', targetEntity: Veterinaire::class)]
    private Collection $veterinaires;

    #[ORM\OneToMany(mappedBy: 'fermier', targetEntity: Animal::class)]
    private Collection $animals;

    public function __construct()
    {
        $this->fermeFermiers = new ArrayCollection();
        $this->employes = new ArrayCollection();
        $this->veterinaires = new ArrayCollection();
        $this->animals = new ArrayCollection();
    }

    /**
     * @return Collection<int, FermeFermier>
     */
    public function getFermeFermiers(): Collection
    {
        return $this->fermeFermiers;
    }

    public function addFermeFermier(FermeFermier $fermeFermier): self
    {
        if (!$this->fermeFermiers->contains($fermeFermier)) {
            $this->fermeFermiers->add($fermeFermier);
            $fermeFermier->setFermier($this);
        }

        return $this;
    }

    public function removeFermeFermier(FermeFermier $fermeFermier): self
    {
        if ($this->fermeFermiers->removeElement($fermeFermier)) {
            // set the owning side to null (unless already changed)
            if ($fermeFermier->getFermier() === $this) {
                $fermeFermier->setFermier(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Employe>
     */
    public function getEmployes(): Collection
    {
        return $this->employes;
    }

    public function addEmploye(Employe $employe): self
    {
        if (!$this->employes->contains($employe)) {
            $this->employes->add($employe);
            $employe->setFermier($this);
        }

        return $this;
    }

    public function removeEmploye(Employe $employe): self
    {
        if ($this->employes->removeElement($employe)) {
            // set the owning side to null (unless already changed)
            if ($employe->getFermier() === $this) {
                $employe->setFermier(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Veterinaire>
     */
    public function getVeterinaires(): Collection
    {
        return $this->veterinaires;
    }

    public function addVeterinaire(Veterinaire $veterinaire): self
    {
        if (!$this->veterinaires->contains($veterinaire)) {
            $this->veterinaires->add($veterinaire);
            $veterinaire->setFermier($this);
        }

        return $this;
    }

    public function removeVeterinaire(Veterinaire $veterinaire): self
    {
        if ($this->veterinaires->removeElement($veterinaire)) {
            // set the owning side to null (unless already changed)
            if ($veterinaire->getFermier() === $this) {
                $veterinaire->setFermier(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Animal>
     */
    public function getAnimals(): Collection
    {
        return $this->animals;
    }

    public function addAnimal(Animal $animal): self
    {
        if (!$this->animals->contains($animal)) {
            $this->animals->add($animal);
            $animal->setFermier($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): self
    {
        if ($this->animals->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getFermier() === $this) {
                $animal->setFermier(null);
            }
        }

        return $this;
    }
}