<?php

namespace App\Entity;

use App\Repository\CategorieImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieImageRepository::class)]
class CategorieImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToMany(targetEntity: Image::class, inversedBy: 'categorieImages')]
    private Collection $catImage;

    public function __construct()
    {
        $this->catImage = new ArrayCollection();
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

    /**
     * @return Collection<int, Image>
     */
    public function getCatImage(): Collection
    {
        return $this->catImage;
    }

    public function addCatImage(Image $catImage): static
    {
        if (!$this->catImage->contains($catImage)) {
            $this->catImage->add($catImage);
        }

        return $this;
    }

    public function removeCatImage(Image $catImage): static
    {
        $this->catImage->removeElement($catImage);

        return $this;
    }
}
