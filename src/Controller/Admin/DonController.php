<?php

namespace App\Controller\Admin;

use App\Entity\Soutien;
use App\Form\SoutienType;
use App\Repository\CatSoutienRepository;
use App\Repository\SoutienRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/don', name: 'app_')]
class DonController extends AbstractController
{
    #[Route('/', name: 'don')]
    public function index(SoutienRepository $repos): Response
    {
        $soutien = $repos->findAll();
        return $this->render('admin/don/index.html.twig', [
            'soutien' => $soutien,
        ]);
    }


    #[Route('/client/{slug}', name: 'client')]
    public function indexclient(  $slug,
    SoutienRepository $repos): Response
    {
      
        $soutien =  $repos->findby(['relstn' => '1'],['title' => 'DESC']);
        return $this->render('don/show.html.twig', [
            'soutien' => $soutien,
         
        ]);
    }

    

 
    

    #[Route('/ajouter/don', name: 'ajouter_don')]
    #[Route('/updatedon/{id}/edit', name: 'edit.don')]
    public function form(Soutien $don  = null, 
     Request $request, ManagerRegistry $entityManager
   
    ): Response
    {
       
       //$new = false;
       
        if(!$don){
         $don = new Soutien();
       }
       $new = true;
      
       $form = $this->createForm(SoutienType::class, $don);
       $form->handleRequest($request);
       if($form->isSubmitted()&& $form->isValid()){
      
        $don->setSlug($don->getTitle());
        
        $acte = $entityManager->getManager();
        $acte->persist($don);
        $acte->flush();

        if($new) {
            $message = "a été ajouté avec succès";
           // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
        }else{
            $message = "a été mis à jour avec succès";
           // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
        }
        $this->addFlash(type: 'success', message: $don->getTitle().  $message);
       // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
        //$mailer->sendEmail(content: $mailMessage);
        return $this->redirectToRoute('app_don');
        // return $this->redirectToRoute('app_actualites', ['slug' => $act->getSlug()]);
       }
       
       
        return $this->render('admin/don/ajouter.html.twig', [
            'form' => $form->createView(),
            'editMode' =>  $don->getId() !== null
           
        ]);
    }




#[Route('/deltedon/{id}/delet', name: 'deletDon')]
    public function UpdatActu(Soutien $outien = null, 
    ManagerRegistry $entityManager,
  ): Response
    {
        
        if($outien){
            $em = $entityManager->getManager();
            $em->remove($outien);
            $em->flush();
            $this->addFlash(type: 'success', message:" 'Article supprimer avec succès ");
            return $this->redirectToRoute('app_don'); 

        }else{
            $this->addFlash(type: 'error',message:" 'Produit inexistant ");
        }
       
          
        return $this->redirectToRoute(route: 'app_don');
        
    }


}
