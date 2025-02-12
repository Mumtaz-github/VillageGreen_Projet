<?php

namespace App\Entity;


use App\Entity\Trait\SlugTrait;
use App\Entity\Trait\CreatedAtTrait;
use App\Repository\ProduitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitsRepository::class)]
class Produits
{
    use CreatedAtTrait;  //ajouté cette linge aller va cherche en CreatedAtTrait.php
    use SlugTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 250)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $prix = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\Column(length: 100)]
    private ?string $slug = null;

    #[ORM\Column(length: 250)]
    private ?string $reference_fournisseur = null;

    #[ORM\Column(length: 250)]
    private ?string $url_photo = null;

    // #[ORM\Column(type: Types::DATETIME_MUTABLE)]  i will delete later if there is no issue
    // private ?\DateTimeInterface $created_at = null;

    #[ORM\ManyToOne(inversedBy: 'produitsCollection')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categories $categories = null;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fournisseur $fournisseur = null;

    /**
     * @var Collection<int, CommandeDetails>
     */
    #[ORM\OneToMany(targetEntity: CommandeDetails::class, mappedBy: 'produit')]
    private Collection $commandeDetails;

    /**
     * @var Collection<int, LivraisonDetails>
     */
    #[ORM\OneToMany(targetEntity: LivraisonDetails::class, mappedBy: 'produit')]
    private Collection $livraisonDetails;

    public function __construct()
    {
        $this->commandeDetails = new ArrayCollection();
        $this->livraisonDetails = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable(); //ajouté ici mais il feut crée class i dont i will other video of symonfy 6
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getReferenceFournisseur(): ?string
    {
        return $this->reference_fournisseur;
    }

    public function setReferenceFournisseur(string $reference_fournisseur): static
    {
        $this->reference_fournisseur = $reference_fournisseur;

        return $this;
    }

    public function getUrlPhoto(): ?string
    {
        return $this->url_photo;
    }

    public function setUrlPhoto(string $url_photo): static
    {
        $this->url_photo = $url_photo;

        return $this;
    }

    // public function getCreatedAt(): ?\DateTimeInterface
    // {
    //     return $this->created_at;
    // }

    // public function setCreatedAt(\DateTimeInterface $created_at): static
    // {
    //     $this->created_at = $created_at;

    //     return $this;
    // }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): static
    {
        $this->categories = $categories;

        return $this;
    }

    public function getFournisseur(): ?Fournisseur
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseur $fournisseur): static
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    /**
     * @return Collection<int, CommandeDetails>
     */
    public function getCommandeDetails(): Collection
    {
        return $this->commandeDetails;
    }

    public function addCommandeDetail(CommandeDetails $commandeDetail): static
    {
        if (!$this->commandeDetails->contains($commandeDetail)) {
            $this->commandeDetails->add($commandeDetail);
            $commandeDetail->setProduit($this);
        }

        return $this;
    }

    public function removeCommandeDetail(CommandeDetails $commandeDetail): static
    {
        if ($this->commandeDetails->removeElement($commandeDetail)) {
            // set the owning side to null (unless already changed)
            if ($commandeDetail->getProduit() === $this) {
                $commandeDetail->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LivraisonDetails>
     */
    public function getLivraisonDetails(): Collection
    {
        return $this->livraisonDetails;
    }

    public function addLivraisonDetail(LivraisonDetails $livraisonDetail): static
    {
        if (!$this->livraisonDetails->contains($livraisonDetail)) {
            $this->livraisonDetails->add($livraisonDetail);
            $livraisonDetail->setProduit($this);
        }

        return $this;
    }

    public function removeLivraisonDetail(LivraisonDetails $livraisonDetail): static
    {
        if ($this->livraisonDetails->removeElement($livraisonDetail)) {
            // set the owning side to null (unless already changed)
            if ($livraisonDetail->getProduit() === $this) {
                $livraisonDetail->setProduit(null);
            }
        }

        return $this;
    }
}
