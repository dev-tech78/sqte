<?php


namespace  App\Controller\Admin;

use App\Entity\Atelier;


use App\Form\AtelierType;
use App\Service\MailerService;
use App\Service\UploaderService;
use App\Repository\AtelierRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/affichebackend')]
class BackatelierController extends AbstractController
{

    #[Route('/', name: 'app_afficheatelier')]
    public function index(AtelierRepository $repository): Response
    {
        
      
        $atelier = $repository->findAll();
        return $this->render('admin/atelier/affiche.html.twig', [
            'atelier' => $atelier
        ]);
    }

    #[Route('/addlier', name: 'app_addatelier')]
    #[Route('/updateatelir/{id}/edit', name: 'app_edit')]
    public function Add(Atelier $atelier = null, Request $request,
     ManagerRegistry $entityManager,
    SluggerInterface $slugger,
    UploaderService $uploaderService,
     MailerService $mailer): Response
    {
        
     
            if(!$atelier){
                $atelier = new Atelier();
                $new = true;
            }
       
            $form = $this->createForm(AtelierType::class,  $atelier);
            $form->handleRequest($request);
            if($form->isSubmitted()&& $form->isValid()){
             if(!  $atelier->getId()){
                $atelier->setCreatedAt( new \DateTimeImmutable());
             }
           
             $atelier->setSlug($atelier->getTitel());
     
             $imageFile =  $form->get('image')->getData();
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
            if ($imageFile) {
                $derectory =  $this->getParameter('galerie_directory');    
                $atelier ->setImage($uploaderService->UploaderFile($imageFile, $derectory));
            }
     
             
     
             $acte = $entityManager->getManager();
             $acte->persist($atelier);
             $acte->flush();

          
             return $this->redirectToRoute('app_afficheatelier');
            // return $this->redirectToRoute('app_actualites', ['slug' => $act->getSlug()]);
            if($new){
                $message = "Atelier ajouter avec succés";
                
            // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            }else{
                $message = "a été mis à jour avec succès";
            // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            }
            $this->addFlash(type: 'success', message: $atelier->getTitel().  $message);
            // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            //$mailer->sendEmail(content: $mailMessage);
            return $this->redirectToRoute('app_afficheatelier');
            // return $this->redirectToRoute('app_actualites', ['slug' => $act->getSlug()]);
                }

    //   $form = $this->createForm(AtelierType::class, $atelier);
    //    $form->handleRequest($request);

        
        return $this->render('admin/atelier/ajouter.html.twig', [
            'form' => $form->createView(),
            'editMode' => $atelier->getId() !== null
           
        ]);
    }


    

}