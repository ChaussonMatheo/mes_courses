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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $notes = null;

    #[ORM\OneToMany(mappedBy: 'id_liste', targetEntity: ArticlesListes::class)]
    private Collection $articlesListes;

    public function __construct()
    {
        $this->articlesListes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;

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
            $articlesListe->setIdListe($this);
        }

        return $this;
    }

    public function removeArticlesListe(ArticlesListes $articlesListe): static
    {
        if ($this->articlesListes->removeElement($articlesListe)) {
            // set the owning side to null (unless already changed)
            if ($articlesListe->getIdListe() === $this) {
                $articlesListe->setIdListe(null);
            }
        }

        return $this;
    }
}
