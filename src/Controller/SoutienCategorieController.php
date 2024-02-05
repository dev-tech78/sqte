<?php

namespace App\Controller;

use App\Entity\CatSoutien;
use App\Form\CatSoutienType;
use App\Repository\CatSoutienRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/soutien/categorie')]
class SoutienCategorieController extends AbstractController
{
    #[Route('/', name: 'app_soutien_categorie')]
    public function index(CatSoutienRepository $repos): Response
    {
        
        $soutien = $repos->findAll();
        return $this->render('soutien_categorie/affichage.html.twig', [
            'soutiens' => $soutien,
        ]);
    }

    #[Route('/cotise', name: 'app_categorie_cotise')]
    public function soutien(CatSoutienRepository $repos): Response
    {
        
        $don =  $repos->findby(['id' => '1']);
        $sabonner =  $repos->findby(['id' => '2']);
        $mecene =  $repos->findby(['id' => '3']);
        return $this->render('soutien_categorie/index.html.twig', [
            'soutien' => $don,
            'abonner' => $sabonner,
            'mecene' => $mecene
        ]);

    }


  




    #[Route('/addlier', name: 'app_addsoutien')]
    #[Route('/updasoutien/{id}/edit', name: 'app_edit.soutien')]
    public function Add(CatSoutien $cotise = null, Request $request,
     ManagerRegistry $entityManager,
   ): Response
    {
        
            if(!$cotise){
                $cotise = new CatSoutien();
                $new = true;
            }
            $form = $this->createForm(CatSoutienType::class,  $cotise);
            $form->handleRequest($request);
            if($form->isSubmitted()&& $form->isValid()){
                $cotise->setSlug($cotise->getNom());
            // $imageFile =  $form->get('image')->getData();
            //  if ($imageFile) {
            //      $imageoriginalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
            //      $imagFilename = $slugger->slug($imageoriginalFilename);
            //      $newFilename = $imagFilename.'-'.uniqid().'.'.$imageFile->guessExtension();
            //      try {
            //          $imageFile->move(
            //              $this->getParameter('galerie_directory'),
            //              $newFilename
            //          );
            //      } catch (FileException $e) {
            //      } $atelier->setImage($newFilename);
            //  }
            // if ($imageFile) {
            //     $derectory =  $this->getParameter('galerie_directory');    
            //     $atelier ->setImage($uploaderService->UploaderFile($imageFile, $derectory));
            // }
             $acte = $entityManager->getManager();
             $acte->persist($cotise);
             $acte->flush();
             return $this->redirectToRoute('app_soutien_categorie');
             return $this->redirectToRoute('app_soutien_categorie', ['slug' => $cotise->getSlug()]);
            if($new){
                $message = "Catégorie ajouté avec succés";    
            // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            }else{
                $message = "a été mis à jour avec succès";
            // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            }
            $this->addFlash(type: 'success', message: $cotise->getNom().  $message);
            // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            //$mailer->sendEmail(content: $mailMessage);
            return $this->redirectToRoute('app_soutien_categorie');
             return $this->redirectToRoute('app_soutien_categorie', ['slug' => $cotise->getSlug()]);
                }

    //   $form = $this->createForm(AtelierType::class, $atelier);
    //    $form->handleRequest($request);

        
        return $this->render('soutien_categorie/ajouter.html.twig', [
            'form' => $form->createView(),
            'editMode' => $cotise->getId() !== null
           
        ]);
    }


    #[Route('/deltesoutien/{id}/delet', name: 'app_soutien')]
    public function UpdatActu(CatSoutien $asoutien = null, 
    ManagerRegistry $entityManager,
  ): Response
    {
        
        if($asoutien){
            $em = $entityManager->getManager();
            $em->remove($asoutien);
            $em->flush();
            $this->addFlash(type: 'success', message:" 'Article supprimer avec succès ");
            return $this->redirectToRoute('app_soutien_categorie'); 

        }else{
            $this->addFlash(type: 'error',message:" 'Personne inexistante ");
        }
       
          
        return $this->redirectToRoute(route: 'app_soutien_categorie');
        
    }
}
