<?php

namespace App\Entity;

use App\Repository\AboutRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AboutRepository::class)]
class About
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $imagetop;

    #[ORM\Column(type: 'text')]
    private $texthistoire;

    #[ORM\Column(type: 'string', length: 255)]
    private $imagehistoire;

    #[ORM\Column(type: 'text')]
    private $textservice;

    #[ORM\Column(type: 'string', length: 255)]
    private $imageservice;

    #[ORM\Column(type: 'text')]
    private $sitation;

    #[ORM\Column(type: 'string', length: 255)]
    private $auteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImagetop(): ?string
    {
        return $this->imagetop;
    }

    public function setImagetop(string $imagetop): self
    {
        $this->imagetop = $imagetop;

        return $this;
    }

    public function getTexthistoire(): ?string
    {
        return $this->texthistoire;
    }

    public function setTexthistoire(string $texthistoire): self
    {
        $this->texthistoire = $texthistoire;

        return $this;
    }

    public function getImagehistoire(): ?string
    {
        return $this->imagehistoire;
    }

    public function setImagehistoire(string $imagehistoire): self
    {
        $this->imagehistoire = $imagehistoire;

        return $this;
    }

    public function getTextservice(): ?string
    {
        return $this->textservice;
    }

    public function setTextservice(string $textservice): self
    {
        $this->textservice = $textservice;

        return $this;
    }

    public function getImageservice(): ?string
    {
        return $this->imageservice;
    }

    public function setImageservice(string $imageservice): self
    {
        $this->imageservice = $imageservice;

        return $this;
    }

    public function getSitation(): ?string
    {
        return $this->sitation;
    }

    public function setSitation(string $sitation): self
    {
        $this->sitation = $sitation;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }
}
