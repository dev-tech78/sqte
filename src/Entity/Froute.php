<?php

namespace App\Entity;

use App\Repository\FrouteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FrouteRepository::class)]
class Froute
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $animateur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $producteur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $technicien = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $tempsDirect = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $tempsEnregistrement = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $source = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $theme = null;

    #[ORM\Column(length: 120, nullable: true)]
    private ?string $format = null;

    #[ORM\Column(length: 120, nullable: true)]
    private ?string $qui = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $duréeTotal = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $notes = null;

    #[ORM\Column(length: 120, nullable: true)]
    private ?string $image = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $invitePrincipal = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getAnimateur(): ?string
    {
        return $this->animateur;
    }

    public function setAnimateur(?string $animateur): static
    {
        $this->animateur = $animateur;

        return $this;
    }

    public function getProducteur(): ?string
    {
        return $this->producteur;
    }

    public function setProducteur(?string $producteur): static
    {
        $this->producteur = $producteur;

        return $this;
    }

    public function getTechnicien(): ?string
    {
        return $this->technicien;
    }

    public function setTechnicien(?string $technicien): static
    {
        $this->technicien = $technicien;

        return $this;
    }

    public function getTempsDirect(): ?\DateTimeInterface
    {
        return $this->tempsDirect;
    }

    public function setTempsDirect(?\DateTimeInterface $tempsDirect): static
    {
        $this->tempsDirect = $tempsDirect;

        return $this;
    }

    public function getTempsEnregistrement(): ?\DateTimeInterface
    {
        return $this->tempsEnregistrement;
    }

    public function setTempsEnregistrement(?\DateTimeInterface $tempsEnregistrement): static
    {
        $this->tempsEnregistrement = $tempsEnregistrement;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(?string $source): static
    {
        $this->source = $source;

        return $this;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(?string $theme): static
    {
        $this->theme = $theme;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(?string $format): static
    {
        $this->format = $format;

        return $this;
    }

    public function getQui(): ?string
    {
        return $this->qui;
    }

    public function setQui(?string $qui): static
    {
        $this->qui = $qui;

        return $this;
    }

    public function getDuréeTotal(): ?\DateTimeInterface
    {
        return $this->duréeTotal;
    }

    public function setDuréeTotal(?\DateTimeInterface $duréeTotal): static
    {
        $this->duréeTotal = $duréeTotal;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): static
    {
        $this->notes = $notes;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getInvitePrincipal(): ?string
    {
        return $this->invitePrincipal;
    }

    public function setInvitePrincipal(?string $invitePrincipal): static
    {
        $this->invitePrincipal = $invitePrincipal;

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
}
