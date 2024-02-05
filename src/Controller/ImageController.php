<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\ImageType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ImageController extends AbstractController
{
     #[Route('/image', name: 'app_image')]
    // #[Route('/updateimage/{id}/edit', name: 'edit.image')]
    // public function index(): Response
    // {
    //     return $this->render('image/index.html.twig', [
    //         'controller_name' => 'ImageController',
    //     ]);
    // }

    #[Route('/addimage', name: 'add_image')]
    #[Route('/updateimage/{id}/edit', name: 'edit.image')]
    public function form(Image $image= null, 
     Request $request, ManagerRegistry $entityManager,
     SluggerInterface $slugger ): Response
    {
       if(!$image){
        $image = new Image();
       }
      
       $form = $this->createForm(ImageType::class,$image);
       $form->handleRequest($request);
       if($form->isSubmitted()&& $form->isValid()){
        if(! $image->getId()){
            //$fiction->setCreatedAt( new \DateTimeImmutable());
        }
      
       // $image->setSlug($ $image->getTitle());

        $imageFile =  $form->get('lien')->getData();
        if ($imageFile) {
            $imageoriginalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
            $imagFilename = $slugger->slug($imageoriginalFilename);
            $newFilename = $imagFilename.'-'.uniqid().'.'.$imageFile->guessExtension();
            try {
                $imageFile->move(
                    $this->getParameter('galerie_directory'),
                    $newFilename
                );
            } catch (FileException $e) {
            } $image->setLien($newFilename);
        }

        

        $acte = $entityManager->getManager();
        $acte->persist($image);
        $acte->flush();
        $this->addFlash('message', 'Article ajouté avec succès');
        return $this->redirectToRoute('add_image');
       // return $this->redirectToRoute('app_actualites', ['slug' => $act->getSlug()]);
       }
       
       
        return $this->render('image/index.html.twig', [
            'form' => $form->createView(),
            'editMode' => $image->getId() !== null
           
        ]);
    }
    
}
