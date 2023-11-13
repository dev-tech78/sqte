<?php

namespace App\Entity;

use App\Repository\FictionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FictionRepository::class)]
class Fiction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(length: 120)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'catfictions')]
    private ?CategoriFiction $categoriFiction = null;

    #[ORM\OneToMany(mappedBy: 'fiction', targetEntity: UtilsFilm::class)]
    private Collection $relatfiction;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\OneToMany(mappedBy: 'fiction', targetEntity: Image::class)]
    private Collection $imageline;

    public function __construct()
    {
        $this->relatfiction = new ArrayCollection();
        $this->imageline = new ArrayCollection();
    }

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

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

    public function getCategoriFiction(): ?CategoriFiction
    {
        return $this->categoriFiction;
    }

    public function setCategoriFiction(?CategoriFiction $categoriFiction): static
    {
        $this->categoriFiction = $categoriFiction;

        return $this;
    }

    /**
     * @return Collection<int, UtilsFilm>
     */
    public function getRelatfiction(): Collection
    {
        return $this->relatfiction;
    }

    public function addRelatfiction(UtilsFilm $relatfiction): static
    {
        if (!$this->relatfiction->contains($relatfiction)) {
            $this->relatfiction->add($relatfiction);
            $relatfiction->setFiction($this);
        }

        return $this;
    }

    public function removeRelatfiction(UtilsFilm $relatfiction): static
    {
        if ($this->relatfiction->removeElement($relatfiction)) {
            // set the owning side to null (unless already changed)
            if ($relatfiction->getFiction() === $this) {
                $relatfiction->setFiction(null);
            }
        }

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
     * @return Collection<int, Image>
     */
    public function getImageline(): Collection
    {
        return $this->imageline;
    }

    public function addImageline(Image $imageline): static
    {
        if (!$this->imageline->contains($imageline)) {
            $this->imageline->add($imageline);
            $imageline->setFiction($this);
        }

        return $this;
    }

    public function removeImageline(Image $imageline): static
    {
        if ($this->imageline->removeElement($imageline)) {
            // set the owning side to null (unless already changed)
            if ($imageline->getFiction() === $this) {
                $imageline->setFiction(null);
            }
        }

        return $this;
    }
}
