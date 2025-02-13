<?php

namespace App\Entity;

use App\Repository\CommercialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommercialRepository::class)]
class Commercial
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom_com = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom_com = null;

    #[ORM\Column(length: 10)]
    private ?string $telephone_com = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    /**
     * @var Collection<int, Users>
     */
   #[ORM\OneToMany(targetEntity: Users::class, mappedBy: 'Commercial')]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCom(): ?string
    {
        return $this->nom_com;
    }

    public function setNomCom(string $nom_com): static
    {
        $this->nom_com = $nom_com;

        return $this;
    }

    public function getPrenomCom(): ?string
    {
        return $this->prenom_com;
    }

    public function setPrenomCom(string $prenom_com): static
    {
        $this->prenom_com = $prenom_com;

        return $this;
    }

    public function getTelephoneCom(): ?string
    {
        return $this->telephone_com;
    }

    public function setTelephoneCom(string $telephone_com): static
    {
        $this->telephone_com = $telephone_com;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Users $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setCommercial($this);
        }

        return $this;
    }

    public function removeUser(Users $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getCommercial() === $this) {
                $user->setCommercial(null);
            }
        }

        return $this;
    }
}
