<?php

namespace App\Entity;

use App\Repository\ListeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListeRepository::class)]
class Liste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?\DateTime $createdAt = null;

    #[ORM\OneToMany(mappedBy: 'liste', targetEntity: Ligne::class, cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $lignes;

    public function __construct()
    {
        $this->lignes = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }
    public function setNom(string $nom): self
    {
    $this->nom = $nom;

    return $this;
    }
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt ?? new \DateTime(); // Retourne une nouvelle date si null
    }
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = new \DateTime();
        return $this;
    }


    /**
     * @return Collection<int, Ligne>
     */
    public function getLignes(): Collection
    {
        return $this->lignes;
    }

    public function addLigne(Ligne $ligne): static
    {
        if (!$this->lignes->contains($ligne)) {
            $this->lignes->add($ligne);
            $ligne->setListe($this);
        }

        return $this;
    }

    public function removeLigne(Ligne $ligne): static
    {
        if ($this->lignes->removeElement($ligne)) {
            // set the owning side to null (unless already changed)
            if ($ligne->getListe() === $this) {
                $ligne->setListe(null);
            }
        }

        return $this;
    }
}
