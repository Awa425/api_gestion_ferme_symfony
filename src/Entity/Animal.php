<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\AnimalRepository;
use Doctrine\Common\Annotations\Annotation\Attributes;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Link;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
// #[ApiResource(
//     uriTemplate: '/capteurs/{id}/animal',
//     uriVariables: [
//         'id' => new Link(
//             fromClass: Capteur::class,
//             fromProperty: 'animal'
//         ),
//     ],
//     operations: [
//         new Get(),
//     ]
// )]
#[ApiResource(normalizationContext: ['groups' => ['readAnimal']])]
// #[GetCollection(normalizationContext: ['groups' => ['read_simple']])]
// #[Get(normalizationContext: ['groups' => ['read_detail']])]
// #[Post(denormalizationContext: ['groups' => ['write']])]
// #[Put(denormalizationContext: ['groups' => ['write_put']])]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    #[Groups(['readAnimal'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['readAnimal'])]

    private ?string $nom = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['readAnimal'])]
    private ?int $age = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['readAnimal'])]
    private ?bool $isEtat = true;

    #[ORM\Column(nullable: true)]
    #[Groups(['readAnimal'])]
    private ?\DateTimeImmutable $dateAt = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    #[ApiProperty(readableLink: false, writableLink: false)]
    #[Groups('readAnimal')]
    private ?Ferme $ferme = null;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    #[Groups(['read_simple', 'read_detail', 'write', 'write_put'])]
    #[ApiProperty(readableLink: false, writableLink: false)]
    private ?Fermier $fermier = null;

    #[ORM\ManyToOne(inversedBy: 'animal')]
    private ?Veterinaire $veterinaire = null;

    #[ORM\OneToMany(mappedBy: 'animal', targetEntity: Capteur::class)]
    private Collection $capteur;

    public function __construct()
    {
        $this->capteur = new ArrayCollection();
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
            $capteur->setAnimal($this);
        }

        return $this;
    }

    public function removeCapteur(capteur $capteur): self
    {
        if ($this->capteur->removeElement($capteur)) {
            // set the owning side to null (unless already changed)
            if ($capteur->getAnimal() === $this) {
                $capteur->setAnimal(null);
            }
        }

        return $this;
    }
}