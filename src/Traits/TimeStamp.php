<?php

namespace App\Traits;


use Doctrine\ORM\Mapping as ORM;




trait TimeStamp 
{

 
#[ORM\Column]
private ?\DateTimeImmutable $createdAt = null;

public function getCreatedAt(): ?\DateTimeImmutable
{
    return $this->createdAt;
}

public function setCreatedAt(\DateTimeImmutable $createdAt): static
{
    $this->createdAt = $createdAt;

    return $this;
}







  

#[ORM\PrePersist]
 public function onPrePersiste()
 {
    $this->createdAt = new \DateTimeImmutable();
   
 }

 


}