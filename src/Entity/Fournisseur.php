<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FournisseurRepository::class)]
class Fournisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom_fournisseur = null;

    #[ORM\Column(length: 50)]
    private ?string $telephone_fournisseur = null;

    #[ORM\Column(length: 100)]
    private ?string $adresse_fournisseur = null;

    #[ORM\Column(length: 100)]
    private ?string $ville_fournisseur = null;

    #[ORM\Column(length: 5)]
    private ?string $cp_fournisseur = null;

    /**
     * @var Collection<int, Produits>
     */
    #[ORM\OneToMany(targetEntity: Produits::class, mappedBy: 'fournisseur')]
    private Collection $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
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

    public function getPrenomFournisseur(): ?string
    {
        return $this->prenom_fournisseur;
    }

    public function setPrenomFournisseur(string $prenom_fournisseur): static
    {
        $this->prenom_fournisseur = $prenom_fournisseur;

        return $this;
    }

    public function getTelephoneFournisseur(): ?string
    {
        return $this->telephone_fournisseur;
    }

    public function setTelephoneFournisseur(string $telephone_fournisseur): static
    {
        $this->telephone_fournisseur = $telephone_fournisseur;

        return $this;
    }

    public function getAdresseFournisseur(): ?string
    {
        return $this->adresse_fournisseur;
    }

    public function setAdresseFournisseur(string $adresse_fournisseur): static
    {
        $this->adresse_fournisseur = $adresse_fournisseur;

        return $this;
    }

    public function getVilleFournisseur(): ?string
    {
        return $this->ville_fournisseur;
    }

    public function setVilleFournisseur(string $ville_fournisseur): static
    {
        $this->ville_fournisseur = $ville_fournisseur;

        return $this;
    }

    public function getCpFournisseur(): ?string
    {
        return $this->cp_fournisseur;
    }

    public function setCpFournisseur(string $cp_fournisseur): static
    {
        $this->cp_fournisseur = $cp_fournisseur;

        return $this;
    }

    /**
     * @return Collection<int, Produits>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produits $produit): static
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->setFournisseur($this);
        }

        return $this;
    }

    public function removeProduit(Produits $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getFournisseur() === $this) {
                $produit->setFournisseur(null);
            }
        }

        return $this;
    }
}
