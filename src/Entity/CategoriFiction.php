<?php

namespace App\Entity;

use App\Repository\CategoriFictionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriFictionRepository::class)]
class CategoriFiction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'categoriFiction', targetEntity: Fiction::class)]
    private Collection $catfictions;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    public function __construct()
    {
        $this->catfictions = new ArrayCollection();
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
     * @return Collection<int, Fiction>
     */
    public function getCatfictions(): Collection
    {
        return $this->catfictions;
    }

    public function addCatfiction(Fiction $catfiction): static
    {
        if (!$this->catfictions->contains($catfiction)) {
            $this->catfictions->add($catfiction);
            $catfiction->setCategoriFiction($this);
        }

        return $this;
    }

    public function removeCatfiction(Fiction $catfiction): static
    {
        if ($this->catfictions->removeElement($catfiction)) {
            // set the owning side to null (unless already changed)
            if ($catfiction->getCategoriFiction() === $this) {
                $catfiction->setCategoriFiction(null);
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
