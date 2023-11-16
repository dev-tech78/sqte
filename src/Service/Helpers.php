<?php

namespace App\Service;

use Symfony\Bundle\SecurityBundle\Security;

class Helpers {


    public function __construct( private Security $security)
    {
        
    }
    
    public function getUser()

    {
        if($this->security->isGranted('ROLE_ADMIN')){
            return $this->security->getUser();
        }
      
    }

}