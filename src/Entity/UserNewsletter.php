<?php

namespace App\Entity;

use App\Repository\UserNewsletterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserNewsletterRepository::class)]
class UserNewsletter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?bool $is_rgpd = false;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $validation_token = null;

    #[ORM\Column]
    private ?bool $isValid = false;

    #[ORM\OneToMany(mappedBy: 'relatuser', targetEntity: Newsletter::class, orphanRemoval: true)]
    private Collection $names;

    public function __construct()
    {
        $this->names = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

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

    public function isIsRgpd(): ?bool
    {
        return $this->is_rgpd;
    }

    public function setIsRgpd(bool $is_rgpd): static
    {
        $this->is_rgpd = $is_rgpd;

        return $this;
    }

    public function getValidationToke(): ?string
    {
        return $this->validation_token;
    }

    public function setValidationToke(?string $validation_token): static
    {
        $this->validation_token = $validation_token;

        return $this;
    }

    public function isIsValid(): ?bool
    {
        return $this->isValid;
    }

    public function setIsValid(bool $isValid): static
    {
        $this->isValid = $isValid;

        return $this;
    }

    /**
     * @return Collection<int, Name>
     */
    public function getNames(): Collection
    {
        return $this->names;
    }

    public function addName(Newsletter $name): static
    {
        if (!$this->names->contains($name)) {
            $this->names->add($name);
            $name->setRelatuser($this);
        }

        return $this;
    }

    public function removeName(Newsletter $newsletter): static
    {
        if ($this->$newsletter->removeElement($newsletter)) {
            // set the owning side to null (unless already changed)
            if ($newsletter->getRelatuser() === $this) {
                $newsletter->setRelatuser(null);
            }
        }

        return $this;
    }
}
