<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\FermeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FermeRepository::class)]
#[ApiResource()]
class Ferme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isEtat = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $dataAt = null;

    #[ORM\OneToMany(mappedBy: 'ferme', targetEntity: FermeFermier::class)]
    private Collection $fermeFermiers;

    #[ORM\OneToMany(mappedBy: 'ferme', targetEntity: Employe::class)]
    private Collection $employe;

    #[ORM\OneToMany(mappedBy: 'ferme', targetEntity: Employe::class)]
    private Collection $employes;

    #[ORM\OneToMany(mappedBy: 'ferme', targetEntity: Animal::class)]
    private Collection $animals;

    #[ORM\OneToMany(mappedBy: 'ferme', targetEntity: FermeVeterinaire::class)]
    private Collection $fermeVeterinaires;

    public function __construct()
    {
        $this->fermeFermiers = new ArrayCollection();
        $this->employe = new ArrayCollection();
        $this->employes = new ArrayCollection();
        $this->animals = new ArrayCollection();
        $this->fermeVeterinaires = new ArrayCollection();
    }

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

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

    public function getDataAt(): ?\DateTimeImmutable
    {
        return $this->dataAt;
    }

    public function setDataAt(?\DateTimeImmutable $dataAt): self
    {
        $this->dataAt = $dataAt;

        return $this;
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
            $fermeFermier->setFerme($this);
        }

        return $this;
    }

    public function removeFermeFermier(FermeFermier $fermeFermier): self
    {
        if ($this->fermeFermiers->removeElement($fermeFermier)) {
            // set the owning side to null (unless already changed)
            if ($fermeFermier->getFerme() === $this) {
                $fermeFermier->setFerme(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Employe>
     */
    public function getEmploye(): Collection
    {
        return $this->employe;
    }

    public function addEmploye(Employe $employe): self
    {
        if (!$this->employe->contains($employe)) {
            $this->employe->add($employe);
            $employe->setFerme($this);
        }

        return $this;
    }

    public function removeEmploye(Employe $employe): self
    {
        if ($this->employe->removeElement($employe)) {
            // set the owning side to null (unless already changed)
            if ($employe->getFerme() === $this) {
                $employe->setFerme(null);
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
            $animal->setFerme($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): self
    {
        if ($this->animals->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getFerme() === $this) {
                $animal->setFerme(null);
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
            $fermeVeterinaire->setFerme($this);
        }

        return $this;
    }

    public function removeFermeVeterinaire(FermeVeterinaire $fermeVeterinaire): self
    {
        if ($this->fermeVeterinaires->removeElement($fermeVeterinaire)) {
            // set the owning side to null (unless already changed)
            if ($fermeVeterinaire->getFerme() === $this) {
                $fermeVeterinaire->setFerme(null);
            }
        }

        return $this;
    }
}