<?php

namespace App\Entity;

use App\Repository\ArticlesListesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticlesListesRepository::class)]
class ArticlesListes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Produit::class, inversedBy: 'articlesListes')]
    private Collection $Produit;

    #[ORM\Column]
    private ?float $quantite = null;

    #[ORM\Column]
    private ?bool $IsInList = null;

    #[ORM\ManyToOne(inversedBy: 'articlesListes')]
    private ?Liste $id_liste = null;



    public function __construct()
    {
        $this->Produit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduit(): Collection
    {
        return $this->Produit;
    }

    public function addProduit(Produit $produit): static
    {
        if (!$this->Produit->contains($produit)) {
            $this->Produit->add($produit);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): static
    {
        $this->Produit->removeElement($produit);

        return $this;
    }

    public function getQuantite(): ?float
    {
        return $this->quantite;
    }

    public function setQuantite(float $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function isIsInList(): ?bool
    {
        return $this->IsInList;
    }

    public function setIsInList(bool $IsInList): static
    {
        $this->IsInList = $IsInList;

        return $this;
    }

    public function getIdListe(): ?Liste
    {
        return $this->id_liste;
    }

    public function setIdListe(?Liste $id_liste): static
    {
        $this->id_liste = $id_liste;

        return $this;
    }
}
