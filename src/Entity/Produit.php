<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Zone;

#[ORM\Entity]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $marque = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $quantite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $commentaires = null;

    #[ORM\ManyToOne(targetEntity: Zone::class, inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Zone $zone = null;

    #[ORM\ManyToMany(targetEntity: ArticlesListes::class, mappedBy: 'Produit')]
    private Collection $articlesListes;

    public function __construct()
    {
        $this->articlesListes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(?string $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(?string $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getCommentaires(): ?string
    {
        return $this->commentaires;
    }

    public function setCommentaires(?string $commentaires): static
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    public function getZone(): ?Zone
    {
        return $this->zone;
    }

    public function setZone(?Zone $zone): static
    {
        $this->zone = $zone;

        return $this;
    }

    /**
     * @return Collection<int, ArticlesListes>
     */
    public function getArticlesListes(): Collection
    {
        return $this->articlesListes;
    }

    public function addArticlesListe(ArticlesListes $articlesListe): static
    {
        if (!$this->articlesListes->contains($articlesListe)) {
            $this->articlesListes->add($articlesListe);
            $articlesListe->addProduit($this);
        }

        return $this;
    }

    public function removeArticlesListe(ArticlesListes $articlesListe): static
    {
        if ($this->articlesListes->removeElement($articlesListe)) {
            $articlesListe->removeProduit($this);
        }

        return $this;
    }
}
