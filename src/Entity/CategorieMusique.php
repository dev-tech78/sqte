<?php

namespace App\Entity;

use App\Repository\CategorieMusiqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieMusiqueRepository::class)]
class CategorieMusique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

  

    #[ORM\OneToMany(mappedBy: 'categorieMusique', targetEntity: Musique::class)]
    private Collection $catmusique;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    public function __construct()
    {
        $this->catmusique = new ArrayCollection();
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
     * @return Collection<int, Musique>
     */
    public function getCatmusique(): Collection
    {
        return $this->catmusique;
    }

    public function addCatmusique(Musique $catmusique): static
    {
        if (!$this->catmusique->contains($catmusique)) {
            $this->catmusique->add($catmusique);
            $catmusique->setCategorieMusique($this);
        }

        return $this;
    }

    public function removeCatmusique(Musique $catmusique): static
    {
        if ($this->catmusique->removeElement($catmusique)) {
            // set the owning side to null (unless already changed)
            if ($catmusique->getCategorieMusique() === $this) {
                $catmusique->setCategorieMusique(null);
            }
        }

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
}
