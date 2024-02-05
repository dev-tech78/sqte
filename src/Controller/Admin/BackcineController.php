<?php


namespace  App\Controller\Admin;

use App\Entity\Fiction;
use App\Form\FictionType;
use App\Service\UploaderService;
use App\Repository\FictionRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/ affichebackendcine')]
class BackcineController extends AbstractController
{

    #[Route('/', name: 'app_affichecine')]
    public function index(FictionRepository $repository): Response
    {
        $fiction = $repository->findAll();
        return $this->render('admin/cinema/index.html.twig', [
            'fiction' => $fiction
        ]);
    }


   

    #[Route('/cinemaadd', name: 'cinema.add')]
    #[Route('/updatecinema/{id}/edit', name: 'edit.cinema')]
    public function form(Fiction $fiction  = null, 
     Request $request, ManagerRegistry $entityManager,
     SluggerInterface $slugger,
     UploaderService $uploaderService ): Response
    {
       if(!$fiction){
        $fiction = new Fiction();
        
       }
       $new = true;
       $form = $this->createForm(FictionType::class, $fiction);
       $form->handleRequest($request);
       if($form->isSubmitted()&& $form->isValid()){
        if(! $fiction->getId()){
            $fiction->setCreatedAt( new \DateTimeImmutable());
        }
      
        $fiction->setSlug($fiction->getTitle());

        $imageFile =  $form->get('image')->getData();
        if ($imageFile) {
            $derectory =  $this->getParameter('galerie_directory');    
            $fiction->setImage($uploaderService->UploaderFile($imageFile, $derectory));
        }
        $acte = $entityManager->getManager();
        $acte->persist($fiction);
        $acte->flush();
        $this->addFlash('message', 'Article ajouté avec succès');
        if($new) {
            $message = "a été ajouté avec succès";
           // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
        }else{
            $message = "a été mis à jour avec succès";
           // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
        }
        $this->addFlash(type: 'success', message:  $fiction->getTitle().  $message);
       // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
        //$mailer->sendEmail(content: $mailMessage);
        return $this->redirectToRoute('app_affichecine');
        // return $this->redirectToRoute('app_actualites', ['slug' => $act->getSlug()]);
       
       }
       
       
        return $this->render('admin/cinema/ajouterfiction.html.twig', [
            'form' => $form->createView(),
            'editMode' => $fiction->getId() !== null
           
        ]);
    }


    #[Route('/deltecinem/{id?0}/delet', name: 'app_cinemadelete')]
    public function UpdatCinema(Fiction $fiction, 
    ManagerRegistry $entityManager,
  )
    {
        $new = true;
        $em = $entityManager->getManager();
            $em->remove($fiction);
            $em->flush();
          
            $this->addFlash('message', 'Article ajouté avec succès');
            if($new) {
                $message = "a été ajouté avec succès";
               // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            }else{
                $message = "a été mis à jour avec succès";
               // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            }
            $this->addFlash(type: 'success', message:  $fiction->getTitle().  $message);
           // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            //$mailer->sendEmail(content: $mailMessage);
            return $this->redirectToRoute('app_affichecine');
       
        
    }


}