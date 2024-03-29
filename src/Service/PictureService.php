<?php

namespace App\Service;

use Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureService
{
    private $params;
    
    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function add(UploadedFile $picture, ?string $folder = '', ?int $width = 250, ?int $heigth = 250)
    {
        //On donne un nouveau nom à l'image
        $fichier = md5(uniqid(rand(), true)) .  '.webp';
        //On récupère les infos d'image

        // $picture_infos = getimagesize($picture);
        // if($picture_infos === false){
        //     throw new Exception('Format d\'image incorrect');
        // }
        // // On vérifie le format de l'image

        // switch($picture_infos['mime']){
        //     case 'image/png';
        //    // $picture_source = imagecreatefrompng($picture);
        //     break;
        //     case 'image/jpeg';
        //     //$picture_source = imagecreatefromjpeg($picture);
        //     break;
        //     case 'image/webp';
        //     $picture_source = imagecreatefromwebp($picture);
        //     break;
        //     default:
        //     throw new Exception('Format d\'image incorrect');
        // }

        //On recadre l'image
        //On récupère le demontions de l'image
       // $imageWight = $picture_infos[0];
       // $imageHeight = $picture_infos[1];

         //On vérifie l'oriontation de l'image
        //  switch($imageWight <=> $imageHeight){
        //     case  0: // portrait
        //         $squareSize = $imageWight;
        //         $src_x = 0;
        //         $src_y = 0;
        //         break;
        //         case 1: // paysage
        //             $squareSize = $imageHeight;
        //             $src_y =($imageWight - $squareSize) /2;
        //             $src_x = 0;
        //             break;    


        // }

         //On  créer une nouvelle image 'vierge'
         //$resized_picture = imagecreatetruecolor($width, $heigth);
        // imagecopyresampled($resized_picture, $picture_source, 0,0,  
        // $src_x, $src_y, $width, $heigth, $squareSize, $squareSize);
         $path = $this->params->get('galerie_directory'). $folder;
         //On crée le dossier de destination s'il n'existe pas
         if(!file_exists($path . '/mini/')){
            mkdir($path . '/mini/', 0755, true);//php8769.tmp
         }
         // On setock l'mage recadrer 
        // imagewebp($resized_picture, $path . '/mini' . $width . 'x' . $heigth. '-' .  $fichier);
         $picture->move($path . '/'  , $fichier);
         return $fichier;
    }

    public function delete(string $fichier,  ?string $folder = '', ?int $width = 250, ?int $heigth = 250)
    {
        if($fichier !== 'defaultpng'){
            $success = false;
            $path = $this->params->get('galerie_directory'). $folder; 
            $mini = $path . '/mini/' . $width. 'x'. $heigth .'-' . $fichier;   
            if(file_exists($mini)){
                unlink($mini);
                $success = true;
            } 

            $orignal = $path . '/'. $fichier;
            if(file_exists( $orignal)){
                unlink($mini);
                $success = true;
            }
            return $success; 

          }
          return false;
    }
}