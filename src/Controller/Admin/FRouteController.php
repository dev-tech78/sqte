<?php

namespace App\Controller\Admin;

use App\Entity\Froute;
use App\Form\FrouteType;
use App\Service\UploaderService;
use App\Repository\FrouteRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/route', name: 'app_')]
class FRouteController extends AbstractController
{
    #[Route('/', name: 'route')]
    public function index(FrouteRepository $repos): Response
    {
        
        $froute = $repos->findAll();
        return $this->render('admin/f_route/index.html.twig', [
            'froute' =>  $froute,
        ]);
    }

    #[Route('/feuillederoute/{id<\d+>}{slug}', name: 'byone')]
    public function feuillRoute(Froute $froute): Response
    {
        
        return $this->render('admin/f_route/index.html.twig', [
            'froute' =>  $froute,
        ]);
    }





    #[Route('/add', name: 'add')]
    #[Route('/updateroute/{id}/edit', name: 'update.route')]
    public function add(Froute $froute = null, 
    Request $request, ManagerRegistry $entityManager,
    UploaderService $uploaderService) : Response

    {
        
        if(!$froute){
            $act = new Froute();
           
           }
           $new = true;
          
           $form = $this->createForm(FrouteType::class, $act);
           $form->handleRequest($request);
           if($form->isSubmitted()&& $form->isValid()){
            if(! $act->getId()){
                $act->setCreatedAt( new \DateTimeImmutable());
            }
           // $act->setSlug($act->getTitle());
            $imageFile =  $form->get('image')->getData();
            if ($imageFile) {
                $derectory =  $this->getParameter('galerie_directory');    
                $act->setImage($uploaderService->UploaderFile($imageFile, $derectory));
            }
    
            $acte = $entityManager->getManager();
            $acte->persist($froute);
            $acte->flush();
    
            if($new) {
                $message = "a été ajouté avec succès";
               // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            }else{
                $message = "a été mis à jour avec succès";
               // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            }
            $this->addFlash(type: 'success', message: $froute->getTitle().  $message);
           // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            //$mailer->sendEmail(content: $mailMessage);
            return $this->redirectToRoute('route');
            // return $this->redirectToRoute('app_actualites', ['slug' => $act->getSlug()]);
           }
        
    
        return $this->render('admin/f_route/ajouter.html.twig',[
            'form' => $form->createView(),
            'editMode' =>  $act->getId() !== null

        ]);
    }


    #[Route('/delteactue/{id}/delet', name: 'app_deletarticle')]
    public function UpdatActu(Froute $froute = null, 
    ManagerRegistry $entityManager,
  ): Response
    {
        
        if($froute){
            $em = $entityManager->getManager();
            $em->remove($froute);
            $em->flush();
            $this->addFlash(type: 'success', message:" 'Article supprimer avec succès ");
            return $this->redirectToRoute('route'); 

        }else{
            $this->addFlash(type: 'error',message:" 'Personne inexistante ");
        }
       
          
        return $this->redirectToRoute(route: 'route');
        
    }

    
}
