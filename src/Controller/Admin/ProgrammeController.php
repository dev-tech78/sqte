<?php

namespace App\Controller\Admin;

use App\Entity\Programme;
use App\Form\ProgrammeType;
use App\Repository\ProgrammeRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/admin/programme'),
IsGranted('ROLE_ADMIN')]
class ProgrammeController extends AbstractController
{
    #[Route('/', name: 'app_programme')]
    public function index(ProgrammeRepository $repos): Response
    {
        $programme = $repos->findAll();
        return $this->render('admin/programme/index.html.twig', [
            'programme' =>  $programme
        ]);
    }

    #[Route('/addpro', name: 'app_programm.add')]
    #[Route('updatprogramme/{id<\d+>}', name: 'detail.programme')]
    public function Addprogramme(Programme $programme  = null,
    Request $request, ManagerRegistry $entityManager,
    SluggerInterface $slugger ): Response
    {
       
      
        if(! $programme){
            $programme = new Programme();
        }

        $form = $this->createForm(ProgrammeType::class,$programme);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
         if(!$programme->getId()){
            $programme->setCreatedAt( new \DateTimeImmutable());
         }
       
         $programme->setSlug($programme->getTitle());
 
        //  $imageFile =  $form->get('image')->getData();
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
        //      }$programme->setImage($newFilename);
        //  }
 
         
 
         $acte = $entityManager->getManager();
         $acte->persist($programme);
         $acte->flush();
         $this->addFlash(type: 'success', message:" 'Article ajouter avec succès ");
         return $this->redirectToRoute('app_afficheradio'); 
        // return $this->redirectToRoute('app_actualites', ['slug' => $act->getSlug()]);
        }
        
        return $this->render('admin/programme/ajouter.html.twig', [
            'form' => $form->createView(),
            'editMode' => $programme->getId() !== null
        ]);
    }

    #[Route('/delteprogramme/{id}/delet', name: 'delete.programme')]
    public function UpdatActu(Programme $programme = null, 
    ManagerRegistry $entityManager,
  ): Response
    {
        
        if($programme){
            $em = $entityManager->getManager();
            $em->remove($programme);
            $em->flush();
            $this->addFlash(type: 'success', message:" 'Article supprimer avec succès ");
            return $this->redirectToRoute('app_afficheradio'); 

        }else{
            $this->addFlash(type: 'error',message:" 'Personne inenexistante ");
        }
       
          
        return $this->redirectToRoute(route: 'app_afficheradio');
        
    }
}
