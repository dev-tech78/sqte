<?php

namespace App\Entity;

use App\Repository\CategorieProgrammeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieProgrammeRepository::class)]
class CategorieProgramme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $jour = null;

    #[ORM\OneToMany(mappedBy: 'categorieProgramme', targetEntity: EmissionRadio::class)]
    private Collection $EmissionRadio;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'categorieProgramme', targetEntity: Programme::class)]
    private Collection $personaliser;

    public function __construct()
    {
        $this->EmissionRadio = new ArrayCollection();
        $this->personaliser = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): static
    {
        $this->jour = $jour;

        return $this;
    }

    /**
     * @return Collection<int, EmissionRadio>
     */
    public function getEmissionRadio(): Collection
    {
        return $this->EmissionRadio;
    }

    public function addEmissionRadio(EmissionRadio $emissionRadio): static
    {
        if (!$this->EmissionRadio->contains($emissionRadio)) {
            $this->EmissionRadio->add($emissionRadio);
            $emissionRadio->setCategorieProgramme($this);
        }

        return $this;
    }

    public function removeEmissionRadio(EmissionRadio $emissionRadio): static
    {
        if ($this->EmissionRadio->removeElement($emissionRadio)) {
            // set the owning side to null (unless already changed)
            if ($emissionRadio->getCategorieProgramme() === $this) {
                $emissionRadio->setCategorieProgramme(null);
            }
        }

        return $this;
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
     * @return Collection<int, Programme>
     */
    public function getPersonaliser(): Collection
    {
        return $this->personaliser;
    }

    public function addPersonaliser(Programme $personaliser): static
    {
        if (!$this->personaliser->contains($personaliser)) {
            $this->personaliser->add($personaliser);
            $personaliser->setCategorieProgramme($this);
        }

        return $this;
    }

    public function removePersonaliser(Programme $personaliser): static
    {
        if ($this->personaliser->removeElement($personaliser)) {
            // set the owning side to null (unless already changed)
            if ($personaliser->getCategorieProgramme() === $this) {
                $personaliser->setCategorieProgramme(null);
            }
        }

        return $this;
    }
}
