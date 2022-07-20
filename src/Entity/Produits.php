<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitsRepository::class)]
class Produits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    #[ORM\Column(type: 'string', length: 255)]
    private $titre;

    #[ORM\Column(type: 'float')]
    private $prix;

    #[ORM\Column(type: 'boolean')]
    private $MeilleurCommande;

    #[ORM\Column(type: 'boolean')]
    private $VenteLivrer;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'produits')]
    private $category;

    #[ORM\Column(type: 'string', length: 255)]
    private $image2;

    #[ORM\Column(type: 'string', length: 255)]
    private $image3;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function isMeilleurCommande(): ?bool
    {
        return $this->MeilleurCommande;
    }

    public function setMeilleurCommande(bool $MeilleurCommande): self
    {
        $this->MeilleurCommande = $MeilleurCommande;

        return $this;
    }

    public function isVenteLivrer(): ?bool
    {
        return $this->VenteLivrer;
    }

    public function setVenteLivrer(bool $VenteLivrer): self
    {
        $this->VenteLivrer = $VenteLivrer;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getImage2(): ?string
    {
        return $this->image2;
    }

    public function setImage2(string $image2): self
    {
        $this->image2 = $image2;

        return $this;
    }

    public function getImage3(): ?string
    {
        return $this->image3;
    }

    public function setImage3(string $image3): self
    {
        $this->image3 = $image3;

        return $this;
    }

    public function __toString()
    {
        return $this->getTitre();
    }
}
