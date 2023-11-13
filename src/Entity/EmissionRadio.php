<?php

namespace App\Entity;

use App\Repository\EmissionRadioRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmissionRadioRepository::class)]
class EmissionRadio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $title = null;

    #[ORM\Column(length: 150)]
    private ?string $presentateur = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $discription = null;

    #[ORM\Column(length: 120)]
    private ?string $image = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 200)]
    private ?string $duree = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255)]
    private ?string $lien = null;

    #[ORM\ManyToOne(inversedBy: 'catradio')]
    private ?CategorieRadio $categorieRadio = null;

    #[ORM\ManyToOne(inversedBy: 'EmissionRadio')]
    private ?CategorieProgramme $categorieProgramme = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getPresentateur(): ?string
    {
        return $this->presentateur;
    }

    public function setPresentateur(string $presentateur): static
    {
        $this->presentateur = $presentateur;

        return $this;
    }

    public function getDiscription(): ?string
    {
        return $this->discription;
    }

    public function setDiscription(string $discription): static
    {
        $this->discription = $discription;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): static
    {
        $this->duree = $duree;

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

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(string $lien): static
    {
        $this->lien = $lien;

        return $this;
    }

    public function getCategorieRadio(): ?CategorieRadio
    {
        return $this->categorieRadio;
    }

    public function setCategorieRadio(?CategorieRadio $categorieRadio): static
    {
        $this->categorieRadio = $categorieRadio;

        return $this;
    }

    public function getCategorieProgramme(): ?CategorieProgramme
    {
        return $this->categorieProgramme;
    }

    public function setCategorieProgramme(?CategorieProgramme $categorieProgramme): static
    {
        $this->categorieProgramme = $categorieProgramme;

        return $this;
    }
}
