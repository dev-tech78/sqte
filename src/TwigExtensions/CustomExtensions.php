<?php

namespace App\TwigExtensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class CustomExtensions extends AbstractExtension
{
       public function getFilters()
       {
         return [

            new TwigFilter( 'dateInstant', [$this, 'date'])
         ];
       }

       public function date(string $date)
       {
        
       }
}