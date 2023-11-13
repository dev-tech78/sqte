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

    #[ORM\ManyToMany(targetEntity: CategorieImage::class, mappedBy: 'catImage')]
    private Collection $categorieImages;

    #[ORM\ManyToOne(inversedBy: 'imageline')]
    private ?Fiction $fiction = null;

    public function __construct()
    {
        $this->categorieImages = new ArrayCollection();
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

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(string $lien): static
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * @return Collection<int, CategorieImage>
     */
    public function getCategorieImages(): Collection
    {
        return $this->categorieImages;
    }

    public function addCategorieImage(CategorieImage $categorieImage): static
    {
        if (!$this->categorieImages->contains($categorieImage)) {
            $this->categorieImages->add($categorieImage);
            $categorieImage->addCatImage($this);
        }

        return $this;
    }

    public function removeCategorieImage(CategorieImage $categorieImage): static
    {
        if ($this->categorieImages->removeElement($categorieImage)) {
            $categorieImage->removeCatImage($this);
        }

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
}
