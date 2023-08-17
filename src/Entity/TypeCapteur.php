<?php

namespace App\Entity;

use App\Repository\TypeCapteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeCapteurRepository::class)]
class TypeCapteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'typeCapteur', targetEntity: capteur::class)]
    private Collection $capteur;

    public function __construct()
    {
        $this->capteur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, capteur>
     */
    public function getCapteur(): Collection
    {
        return $this->capteur;
    }

    public function addCapteur(capteur $capteur): self
    {
        if (!$this->capteur->contains($capteur)) {
            $this->capteur->add($capteur);
            $capteur->setTypeCapteur($this);
        }

        return $this;
    }

    public function removeCapteur(capteur $capteur): self
    {
        if ($this->capteur->removeElement($capteur)) {
            // set the owning side to null (unless already changed)
            if ($capteur->getTypeCapteur() === $this) {
                $capteur->setTypeCapteur(null);
            }
        }

        return $this;
    }
}
