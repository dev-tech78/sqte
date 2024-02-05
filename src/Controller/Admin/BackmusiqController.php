<?php


namespace  App\Controller\Admin;

use App\Entity\Musique;
use App\Form\MusiqueType;
use App\Repository\MusiqueRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/ affichebackendaaaa')]
class BackmusiqController extends AbstractController
{

    #[Route('/', name: 'app_affichemusique')]
    public function index(MusiqueRepository $repos): Response
    {
        
      
      
       // $ateliermao = $repos->findAll();
          $musique =$repos->findAll();
        
        return $this->render('admin/musique/index.html.twig', [
           // 'ateliermao' =>  $ateliermao
           'musique'=>$musique
        ]);
    }


    #[Route('/{id<\d+>}', name: 'app_detail')]
    public function emisson(Musique $musique  = null): Response
    {
       
       if(!$musique){
        $this->addFlash(type: 'error', message: "la personne d'id nexiste pas");
        return $this->redirectToRoute('ppp_detail');
       }
        return $this->render('admin/radio/atelier.html.twig', [
            'emissionRadio' => $musique,
        ]);
    }

    #[Route('/addmusique', name: 'app_add.musique')]
    #[Route('updatemusique/{id<\d+>}', name: 'app_detail.musique')]
    public function Addmusique(Musique $musique  = null,
    Request $request, ManagerRegistry $entityManager,
    SluggerInterface $slugger ): Response
    {
       
      
        if(!$musique){
            $musique = new Musique();
        }
        $new = true;
        $form = $this->createForm(MusiqueType::class,$musique);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
         if(!$musique->getId()){
            $musique->setCreatedAt( new \DateTimeImmutable());
         }
       
         $musique->setSlug($musique->getTitel());
 
         $imageFile =  $form->get('image')->getData();
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
             }$musique->setImage($newFilename);
         }

         $acte = $entityManager->getManager();
         $acte->persist($musique);
         $acte->flush();
         if($new) {
            $message = "a été ajouté avec succès";
            // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            }else{
                $message = "a été mis à jour avec succès";
            // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            }
            $this->addFlash(type: 'success', message:  $musique->getTitel().  $message);
        // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            //$mailer->sendEmail(content: $mailMessage);
            return $this->redirectToRoute('admin_actu');
            // return $this->redirectToRoute('app_actualites', ['slug' => $act->getSlug()]);
       }
        
        
        return $this->render('admin/musique/ajoutermusique.html.twig', [
            'form' => $form->createView(),
            'editMode' => $musique->getId() !== null
        ]);
    }

    
    #[Route('/delteactue/{id}/delet', name: 'app_deletmusique')]
    public function UpdatActu(Musique $musique = null, 
    ManagerRegistry $entityManager,
  ): Response
    {
        
        if($musique){
            $em = $entityManager->getManager();
            $em->remove($musique);
            $em->flush();
            $this->addFlash(type: 'success', message:" 'Article supprimer avec succès ");
            return $this->redirectToRoute('admin_actu'); 

        }else{
            $this->addFlash(type: 'error',message:" 'Personne in existante ");
        }
       
          
        return $this->redirectToRoute(route: 'admin_actu');
        
    }

}