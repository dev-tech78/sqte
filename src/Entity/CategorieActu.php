<?php

namespace App\Entity;

use App\Repository\CategorieActuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieActuRepository::class)]
class CategorieActu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'categorieActu', targetEntity: Actualites::class)]
    private Collection $catactu;

    

    public function __construct()
    {
        $this->catactu = new ArrayCollection();
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
     * @return Collection<int, Actualites>
     */
    public function getCatactu(): Collection
    {
        return $this->catactu;
    }

    public function addCatactu(Actualites $catactu): self
    {
        if (!$this->catactu->contains($catactu)) {
            $this->catactu->add($catactu);
            $catactu->setCategorieActu($this);
        }

        return $this;
    }

    public function removeCatactu(Actualites $catactu): self
    {
        if ($this->catactu->removeElement($catactu)) {
            // set the owning side to null (unless already changed)
            if ($catactu->getCategorieActu() === $this) {
                $catactu->setCategorieActu(null);
            }
        }

        return $this;
    }

   

   
}
