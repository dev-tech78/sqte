<?php

namespace App\Service;

use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class UploaderService
{
   
   public function __construct(  private SluggerInterface $slugger)
   { }
   
    // On va lui passer un objet de type UploadeFile
   //Et elle doit doit nous retourner le nom de ce file
    public function UploaderFile(UploadedFile  $fil, string $directoryFolder )  {
      
     
            $imageoriginalFilename = pathinfo($fil->getClientOriginalName(), PATHINFO_FILENAME);
            $imagFilename = $this->slugger->slug($imageoriginalFilename);
            $newFilename = $imagFilename.'-'.uniqid().'.'.$fil->guessExtension();
            try {
                $fil->move(
                    $directoryFolder,
                    $newFilename
                );
            } catch (FileException $e) {
            }
            
            return $newFilename;
        }
    }
