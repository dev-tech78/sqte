<?php

namespace App\Entity;

use App\Repository\CatSoutienRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CatSoutienRepository::class)]
class CatSoutien
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(length: 255)]
    private ?string $soustitre = null;

    #[ORM\Column(length: 255)]
    private ?string $action = null;



    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\OneToMany(mappedBy: 'relstn', targetEntity: Soutien::class)]
    private Collection $soutiens;

    public function __construct()
    {
        $this->soutiens = new ArrayCollection();
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getSoustitre(): ?string
    {
        return $this->soustitre;
    }

    public function setSoustitre(string $soustitre): static
    {
        $this->soustitre = $soustitre;

        return $this;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function setAction(string $action): static
    {
        $this->action = $action;

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

    /**
     * @return Collection<int, Soutien>
     */
    public function getSoutiens(): Collection
    {
        return $this->soutiens;
    }

    public function addSoutien(Soutien $soutien): static
    {
        if (!$this->soutiens->contains($soutien)) {
            $this->soutiens->add($soutien);
            $soutien->setRelstn($this);
        }

        return $this;
    }

    public function removeSoutien(Soutien $soutien): static
    {
        if ($this->soutiens->removeElement($soutien)) {
            // set the owning side to null (unless already changed)
            if ($soutien->getRelstn() === $this) {
                $soutien->setRelstn(null);
            }
        }

        return $this;
    }
}
