<?php


namespace  App\Controller\Admin;

use App\Entity\Actualites;
use App\Service\PdfService;
use App\Form\ActualitesType;
use App\Service\MailerService;
use App\Service\UploaderService;
use App\Repository\ActualitesRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/admin/actudd'),
IsGranted('ROLE_ADMIN')]
class ActualitesController  extends AbstractController
{

    
   
    #[Route('/', name: 'app_actu')]
    #[Route('/updateactue/{id}/edit', name: 'edit.actu')]
    public function form(Actualites $act  = null, 
     Request $request, ManagerRegistry $entityManager,
     UploaderService $uploaderService, MailerService $mailer
    ): Response
    {
       
       //$new = false;
       
        if(!$act){
        $act = new Actualites();
       
       }
       $new = true;
      
       $form = $this->createForm(ActualitesType::class, $act);
       $form->handleRequest($request);
       if($form->isSubmitted()&& $form->isValid()){
        if(! $act->getId()){
            $act->setCreatedAt( new \DateTimeImmutable());
        }
        $act->setSlug($act->getTitle());
        $imageFile =  $form->get('image')->getData();
        if ($imageFile) {
            $derectory =  $this->getParameter('galerie_directory');    
            $act->setImage($uploaderService->UploaderFile($imageFile, $derectory));
        }

        $acte = $entityManager->getManager();
        $acte->persist($act);
        $acte->flush();

        if($new) {
            $message = "a été ajouté avec succès";
           // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
        }else{
            $message = "a été mis à jour avec succès";
           // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
        }
        $this->addFlash(type: 'success', message: $act->getTitle().  $message);
       // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
        //$mailer->sendEmail(content: $mailMessage);
        return $this->redirectToRoute('admin_actu');
        // return $this->redirectToRoute('app_actualites', ['slug' => $act->getSlug()]);
       }
       
       
        return $this->render('admin/actualite/ajouteractu.html.twig', [
            'form' => $form->createView(),
            'editMode' =>  $act->getId() !== null
           
        ]);
    }

    #[Route('/pdf/{id}', name: 'app_pdf')]
    public function Pdf(Actualites $act = null, PdfService $pdfService)
    {
        $html = $this->render('admin/actualite/pdf.html.twig',[
            'pdf' => $act
        ]);
        $pdfService->showPdf($html);
    }


#[Route('/delteactue/{id}/delet', name: 'app_deletarticle')]
    public function UpdatActu(Actualites $act = null, 
    ManagerRegistry $entityManager,
  ): Response
    {
        
        if($act){
            $em = $entityManager->getManager();
            $em->remove($act);
            $em->flush();
            $this->addFlash(type: 'success', message:" 'Article supprimer avec succès ");
            return $this->redirectToRoute('admin_actu'); 

        }else{
            $this->addFlash(type: 'error',message:" 'Personne inexistante ");
        }
       
          
        return $this->redirectToRoute(route: 'admin_actu');
        
    }


    #[Route('/admin/actu', name: 'admin_actu')]
    public function annonce_coment(ActualitesRepository $repos): Response
    {
       
        $actualitet = $repos->findAll();
        return $this->render('admin/actualite/affiche.html.twig',[
            'actualite' => $actualitet
        ]);  
    }

   

}