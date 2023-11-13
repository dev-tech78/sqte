<?php

namespace App\Entity;

use App\Repository\CategorieAtelierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieAtelierRepository::class)]
class CategorieAtelier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'categorieAtelier', targetEntity: Atelier::class)]
    private Collection $catatelier;

    public function __construct()
    {
        $this->catatelier = new ArrayCollection();
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
     * @return Collection<int, Atelier>
     */
    public function getCatatelier(): Collection
    {
        return $this->catatelier;
    }

    public function addCatatelier(Atelier $catatelier): static
    {
        if (!$this->catatelier->contains($catatelier)) {
            $this->catatelier->add($catatelier);
            $catatelier->setCategorieAtelier($this);
        }

        return $this;
    }

    public function removeCatatelier(Atelier $catatelier): static
    {
        if ($this->catatelier->removeElement($catatelier)) {
            // set the owning side to null (unless already changed)
            if ($catatelier->getCategorieAtelier() === $this) {
                $catatelier->setCategorieAtelier(null);
            }
        }

        return $this;
    }
}
