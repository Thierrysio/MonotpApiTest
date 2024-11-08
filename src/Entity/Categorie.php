<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Produit>
     */
    #[ORM\OneToMany(targetEntity: Produit::class, mappedBy: 'laCategorie')]
    private Collection $lesproduits;

    public function __construct()
    {
        $this->lesproduits = new ArrayCollection();
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

    /**
     * @return Collection<int, Produit>
     */
    public function getLesproduits(): Collection
    {
        return $this->lesproduits;
    }

    public function addLesproduit(Produit $lesproduit): static
    {
        if (!$this->lesproduits->contains($lesproduit)) {
            $this->lesproduits->add($lesproduit);
            $lesproduit->setLaCategorie($this);
        }

        return $this;
    }

    public function removeLesproduit(Produit $lesproduit): static
    {
        if ($this->lesproduits->removeElement($lesproduit)) {
            // set the owning side to null (unless already changed)
            if ($lesproduit->getLaCategorie() === $this) {
                $lesproduit->setLaCategorie(null);
            }
        }

        return $this;
    }
}
