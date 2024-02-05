<?php

namespace App\Entity;

use App\Repository\CategorieRadioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRadioRepository::class)]
class CategorieRadio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'categorieRadio', targetEntity: EmissionRadio::class)]
    private Collection $catradio;

    #[ORM\Column(length: 160)]
    private ?string $image = null;

    public function __construct()
    {
        $this->catradio = new ArrayCollection();
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
     * @return Collection<int, EmissionRadio>
     */
    public function getCatradio(): Collection
    {
        return $this->catradio;
    }

    public function addCatradio(EmissionRadio $catradio): static
    {
        if (!$this->catradio->contains($catradio)) {
            $this->catradio->add($catradio);
            $catradio->setCategorieRadio($this);
        }

        return $this;
    }

    public function removeCatradio(EmissionRadio $catradio): static
    {
        if ($this->catradio->removeElement($catradio)) {
            // set the owning side to null (unless already changed)
            if ($catradio->getCategorieRadio() === $this) {
                $catradio->setCategorieRadio(null);
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
