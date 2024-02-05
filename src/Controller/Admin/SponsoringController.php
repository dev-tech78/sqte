<?php

namespace App\Controller\Admin;

use App\Entity\Sponsoring;
use App\Form\SponsoringType;
use App\Repository\SponsoringRepository;
use App\Service\MailerService;
use App\Service\UploaderService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/sponsoring')]
class SponsoringController extends AbstractController
{
    #[Route('/', name: 'app_sponsoring')]
    public function index(SponsoringRepository $repos): Response
    {
        
        $ponsor = $repos->findBy([], ['id' => 'DESC']);
        return $this->render('admin/sponsoring/index.html.twig', [
            'sponsor' =>  $ponsor
        ]);
    }

    #[Route('/ajoutersponsor', name: 'app_spon')]
    #[Route('/updatesponsor/{id}/edit', name: 'edit.sponsor')]
    public function form(Sponsoring $sponsoring  = null, 
     Request $request, ManagerRegistry $entityManager,
     UploaderService $uploaderService, MailerService $mailer
    ): Response
    {
       
       //$new = false;
       
        if(!$sponsoring){
            $sponsoring = new Sponsoring();
       
       }
       $new = true;
      
       $form = $this->createForm(SponsoringType::class, $sponsoring);
       $form->handleRequest($request);
       if($form->isSubmitted()&& $form->isValid()){
        if(! $sponsoring->getId()){
            $sponsoring->setCreatedAt( new \DateTimeImmutable());
        }
        $sponsoring->setSlug($sponsoring->getName());
        $imageFile =  $form->get('image')->getData();
        if ($imageFile) {
            $derectory =  $this->getParameter('galerie_directory');    
            $sponsoring->setImage($uploaderService->UploaderFile($imageFile, $derectory));
        }

        $acte = $entityManager->getManager();
        $acte->persist($sponsoring);
        $acte->flush();

        if($new) {
            $message = "a été ajouté avec succès";
           // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
        }else{
            $message = "a été mis à jour avec succès";
           // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
        }
        $this->addFlash(type: 'success', message: $sponsoring->getName().  $message);
       // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
        //$mailer->sendEmail(content: $mailMessage);
        return $this->redirectToRoute('app_sponsoring');
        // return $this->redirectToRoute('app_actualites', ['slug' => $act->getSlug()]);
       }
       
       
        return $this->render('admin/sponsoring/ajoutersponsor.html.twig', [
            'form' => $form->createView(),
            'editMode' =>  $sponsoring->getId() !== null
           
        ]);
    }

    #[Route('/delteactue/{id}/delet', name: 'app_deletsponsor')]
    public function UpdatActu(Sponsoring $sponsor = null, 
    ManagerRegistry $entityManager,
  ): Response
    {
        
        if($sponsor){
            $em = $entityManager->getManager();
            $em->remove($sponsor);
            $em->flush();
            $this->addFlash(type: 'success', message:" 'Article supprimer avec succès ");
            return $this->redirectToRoute('app_sponsoring'); 

        }else{
            $this->addFlash(type: 'error',message:" 'Personne inexistante ");
        }
       
          
        return $this->redirectToRoute(route: 'app_sponsoring');
        
    }

}
