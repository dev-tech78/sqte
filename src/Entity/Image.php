<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 120)]
    private ?string $lien = null;

  

    #[ORM\ManyToOne(inversedBy: 'imageline')]
    private ?Fiction $fiction = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $faceboock = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $instagram = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $snap = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $youtube = null;

   


   

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

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(string $lien): static
    {
        $this->lien = $lien;

        return $this;
    }

    

    public function getFiction(): ?Fiction
    {
        return $this->fiction;
    }

    public function setFiction(?Fiction $fiction): static
    {
        $this->fiction = $fiction;

        return $this;
    }

    public function getFaceboock(): ?string
    {
        return $this->faceboock;
    }

    public function setFaceboock(?string $faceboock): static
    {
        $this->faceboock = $faceboock;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): static
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getSnap(): ?string
    {
        return $this->snap;
    }

    public function setSnap(?string $snap): static
    {
        $this->snap = $snap;

        return $this;
    }

    public function getYoutube(): ?string
    {
        return $this->youtube;
    }

    public function setYoutube(?string $youtube): static
    {
        $this->youtube = $youtube;

        return $this;
    }
}
