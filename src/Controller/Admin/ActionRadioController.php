<?php


namespace  App\Controller\Admin;


use App\Entity\EmissionRadio;
use App\Form\EmissionRadioType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/actionradio')]
class ActionRadioController extends AbstractController
{

    #[Route('/', name: 'app_backradio')]
    #[Route('/updatemession/{$id}', name: 'app_updatemession')]
    public function index( Request $request, 
    ManagerRegistry $entityManager,
     SluggerInterface $slugger, EmissionRadio $emission = null): Response
    {
        

      if(!$emission){
        $emission = new EmissionRadio();
      }
           
          
        //$emission = new Emission();
       $form = $this->createForm(EmissionRadioType::class, $emission);
       $form->handleRequest($request);
       if($form->isSubmitted()&& $form->isValid()){
        $emission->setCreatedAt( new \DateTimeImmutable());
        $emission->setSlug($emission->getTitle());

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
            }    $emission->setImage($newFilename);
        }

        

        $acte = $entityManager->getManager();
        $acte->persist($emission);
        $acte->flush();
        $this->addFlash('message', 'Article ajouté avec succès');
       }
        
        
        return $this->render('admin/radio/emission.html.twig', [
            'form' => $form->createView(),
            'editMode' =>  $emission->getid() !== null
        ]);
    }


    #[Route('/atelierbackend', name: 'app_backateleir')]
    public function atelier(): Response
    {
        return $this->render('admin/radio/atelier.html.twig', [
            'controller_name' => 'AboutController',
        ]);
    }
    

    #[Route('/delteactue/{id?}', name: 'app_deletarticle')]
    public function UpdatActu(EmissionRadio $emission, 
    Request $request, ManagerRegistry $entityManager,
    SluggerInterface $slugger): Response
    {
       
       
       
        $em = $entityManager->getManager();
            $em->remove($emission);
            $em->flush();
            $this->addFlash('message', 'Article supprimer avec succès');
            return $this->redirectToRoute('app_addactue'); 
       
       
        return $this->render('admin/actue/modifier.html.twig', []);
    }


}