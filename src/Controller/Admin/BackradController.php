<?php


namespace  App\Controller\Admin;


use App\Entity\EmissionRadio;
use App\Form\EmissionRadioType;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\EmissionRadioRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/ backradio')]
class BackradController extends AbstractController
{

    #[Route('/', name: 'app_afficheradio')]
    public function index(EmissionRadioRepository $repos): Response
    {
        $emission = $repos->findAll();
        return $this->render('admin/radio/emission.html.twig', [
            'emission' => $emission
        ]);
    }


    #[Route('/addemission', name: 'app_addradio')]
    #[Route('updateradio/{id<\d+>}', name: 'app_detail.radio')]
    public function Addradio(EmissionRadio $emissionRadio  = null,
    Request $request, ManagerRegistry $entityManager,
    SluggerInterface $slugger ): Response
    {
       
      
        if(! $emissionRadio){
            $emissionRadio = new EmissionRadio();
        }
        $new = true;
        $form = $this->createForm(EmissionRadioType::class,$emissionRadio);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
         if(!$emissionRadio->getId()){
            $emissionRadio->setCreatedAt( new \DateTimeImmutable());
         }
       
         $emissionRadio->setSlug($emissionRadio->getTitle());
 
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
             }$emissionRadio->setImage($newFilename);
         }
 
         
 
         $acte = $entityManager->getManager();
         $acte->persist($emissionRadio);
         $acte->flush();
         if($new) {
            $message = "a été ajouté avec succès";
            // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            }else{
                $message = "a été mis à jour avec succès";
            // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            }
            $this->addFlash(type: 'success', message:  $emissionRadio->getTitle().  $message);
        // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            //$mailer->sendEmail(content: $mailMessage);
            return $this->redirectToRoute('admin_actu');
            // return $this->redirectToRoute('app_actualites', ['slug' => $act->getSlug()]);
       }
        
        return $this->render('admin/radio/ajouter.html.twig', [
            'form' => $form->createView(),
            'editMode' => $emissionRadio->getId() !== null
        ]);
    }

    #[Route('/delteemission/{id}/delet', name: 'app_emissionradio')]
    public function UpdatActu(EmissionRadio $emissionRadio = null, 
    ManagerRegistry $entityManager,
  ): Response
    {
        
        if($emissionRadio){
            $em = $entityManager->getManager();
            $em->remove($emissionRadio);
            $em->flush();
            $this->addFlash(type: 'success', message:" 'Article supprimer avec succès ");
            return $this->redirectToRoute('app_afficheradio'); 

        }else{
            $this->addFlash(type: 'error',message:" 'Personne inenexistante ");
        }
       
          
        return $this->redirectToRoute(route: 'app_afficheradio');
        
    }


}