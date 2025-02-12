<?php

namespace App\Entity;

use App\Repository\LivraisonDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivraisonDetailsRepository::class)]
class LivraisonDetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Produits::class, inversedBy: 'livraisonDetails')] //added manually
    #[ORM\JoinColumn(nullable: false)]
    private ?Produits $produit = null;
    

// In LivraisonDetails entity  added 
public function setProduit(?Produits $produit): self    
{
    $this->produit = $produit;
    return $this;
}

public function getProduit(): ?Produits
{
    return $this->produit;
}



    public function getId(): ?int
    {
        return $this->id;
    }
}
