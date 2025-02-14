<?php

namespace App\Entity;

use App\Entity\Trait\SlugTrait; //ajouté
use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{

    use SlugTrait; //ajouté
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 250)]
    private ?string $url_photo = null;

    #[ORM\Column(length: 255)] // Add this line for the slug
    private ?string $slug = null; // Add this line for the slug

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'categories')]
    // #[ORM\JoinColumn(onDelete: 'CASCAD')]  //j'ai ajouté à case 
    private ?self $parent = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'parent')]
    private Collection $categories;

    /**
     * @var Collection<int, Produits>
     */
    #[ORM\OneToMany(targetEntity: Produits::class, mappedBy: 'categories')]
    private Collection $produits;

    /**
     * @var Collection<int, Produits>
     */
    #[ORM\OneToMany(targetEntity: Produits::class, mappedBy: 'categories')]
    private Collection $produitsCollection;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->produits = new ArrayCollection();
        $this->produitsCollection = new ArrayCollection();
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

    public function getUrlPhoto(): ?string
    {
        return $this->url_photo;
    }

    public function setUrlPhoto(string $url_photo): static
    {
        $this->url_photo = $url_photo;

        return $this;
    }

    public function getSlug(): ?string // Getter for slug

    {

        return $this->slug;

    }


    public function setSlug(string $slug): static // Setter for slug

    {

        $this->slug = $slug;


        return $this;

    }


 public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(self $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->setParent($this);
        }

        return $this;
    }

    public function removeCategory(self $category): static
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getParent() === $this) {
                $category->setParent(null);
            }
        }

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
            $produit->setCategories($this);
        }

        return $this;
    }

    public function removeProduit(Produits $produit): static
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getCategories() === $this) {
                $produit->setCategories(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Produits>
     */
    public function getProduitsCollection(): Collection
    {
        return $this->produitsCollection;
    }

    public function addProduitsCollection(Produits $produitsCollection): static
    {
        if (!$this->produitsCollection->contains($produitsCollection)) {
            $this->produitsCollection->add($produitsCollection);
            $produitsCollection->setCategories($this);
        }

        return $this;
    }

    public function removeProduitsCollection(Produits $produitsCollection): static
    {
        if ($this->produitsCollection->removeElement($produitsCollection)) {
            // set the owning side to null (unless already changed)
            if ($produitsCollection->getCategories() === $this) {
                $produitsCollection->setCategories(null);
            }
        }

        return $this;
    }
}
