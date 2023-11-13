<?php

namespace App\Traits;


use Doctrine\ORM\Mapping as ORM;


trait TimeStamp 
{
public function getCreatedAt(): ?\DateTimeImmutable
{
    return $this->createdAt;
}

public function setCreatedAt(\DateTimeImmutable $createdAt): static
{
    $this->createdAt = $createdAt;

    return $this;
}





public function getUpdateAt(): ?\DateTimeInterface
{
   return $this->updateAt;
}

public function setUpdateAt(?\DateTimeInterface $updateAt): static
{
   $this->updateAt = $updateAt;

   return $this;
}

  

#[ORM\PrePersist]
 public function onPrePersiste()
 {
    $this->createdAt = new \DateTime();
    $this->updateAt = new \DateTime();
 }

 #[ORM\PreUpdate]
public function onPreUpdate()
{
$this->updateAt = new \DateTime();
}


}