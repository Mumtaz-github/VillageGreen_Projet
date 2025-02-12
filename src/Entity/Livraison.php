<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivraisonRepository::class)]
class Livraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_livraison = null;

    #[ORM\Column(length: 100)]
    private ?string $adresse_livraison = null;

    #[ORM\ManyToOne(inversedBy: 'livraisons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commande $commande = null;

    #[ORM\ManyToOne(inversedBy: 'livraisons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?LivraisonDetails $livraisondetails = null;

    /**
     * @var Collection<int, LivraisonDetails>
     */
    #[ORM\OneToMany(targetEntity: LivraisonDetails::class, mappedBy: 'livraison')]
    private Collection $livraisonDetails;

    public function __construct()
    {
        $this->livraisonDetails = new ArrayCollection();
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

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->date_livraison;
    }

    public function setDateLivraison(\DateTimeInterface $date_livraison): static
    {
        $this->date_livraison = $date_livraison;

        return $this;
    }

    public function getAdresseLivraison(): ?string
    {
        return $this->adresse_livraison;
    }

    public function setAdresseLivraison(string $adresse_livraison): static
    {
        $this->adresse_livraison = $adresse_livraison;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): static
    {
        $this->commande = $commande;

        return $this;
    }

    public function getLivraisondetails(): ?LivraisonDetails
    {
        return $this->livraisondetails;
    }

    public function setLivraisondetails(?LivraisonDetails $livraisondetails): static
    {
        $this->livraisondetails = $livraisondetails;

        return $this;
    }

    public function addLivraisonDetail(LivraisonDetails $livraisonDetail): static
    {
        if (!$this->livraisonDetails->contains($livraisonDetail)) {
            $this->livraisonDetails->add($livraisonDetail);
            $livraisonDetail->setLivraison($this);
        }

        return $this;
    }

    public function removeLivraisonDetail(LivraisonDetails $livraisonDetail): static
    {
        if ($this->livraisonDetails->removeElement($livraisonDetail)) {
            // set the owning side to null (unless already changed)
            if ($livraisonDetail->getLivraison() === $this) {
                $livraisonDetail->setLivraison(null);
            }
        }

        return $this;
    }
}
