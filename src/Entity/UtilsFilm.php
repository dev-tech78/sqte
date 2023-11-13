<?php

namespace App\Entity;

use App\Repository\UtilsFilmRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilsFilmRepository::class)]
class UtilsFilm
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 120)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    private ?string $slug = null;

    #[ORM\ManyToOne(inversedBy: 'relatfiction')]
    private ?Fiction $fiction = null;

    public function __toString(){
        return $this->image; // Remplacer champ par une propriété "string" de l'entité
    }
    
    
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getFiction(): ?Fiction
    {
        return $this->fiction;
    }

    public function setFiction(?Fiction $fiction): self
    {
        $this->fiction = $fiction;

        return $this;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
