<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\ManyToOne(inversedBy: 'lesproduits')]
    private ?Categorie $laCategorie = null;

    /**
     * @var Collection<int, Fournisseur>
     */
    #[ORM\ManyToMany(targetEntity: Fournisseur::class, inversedBy: 'lesProduits')]
    private Collection $lesFournisseurs;

    public function __construct()
    {
        $this->lesFournisseurs = new ArrayCollection();
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

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getLaCategorie(): ?Categorie
    {
        return $this->laCategorie;
    }

    public function setLaCategorie(?Categorie $laCategorie): static
    {
        $this->laCategorie = $laCategorie;

        return $this;
    }

    /**
     * @return Collection<int, Fournisseur>
     */
    public function getLesFournisseurs(): Collection
    {
        return $this->lesFournisseurs;
    }

    public function addLesFournisseur(Fournisseur $lesFournisseur): static
    {
        if (!$this->lesFournisseurs->contains($lesFournisseur)) {
            $this->lesFournisseurs->add($lesFournisseur);
        }

        return $this;
    }

    public function removeLesFournisseur(Fournisseur $lesFournisseur): static
    {
        $this->lesFournisseurs->removeElement($lesFournisseur);

        return $this;
    }
}
