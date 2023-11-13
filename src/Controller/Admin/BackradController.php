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
    #[Route('updateradio/{id<\d+>}', name: 'app_detail')]
    public function Addradio(EmissionRadio $emissionRadio  = null,
    Request $request, ManagerRegistry $entityManager,
    SluggerInterface $slugger ): Response
    {
       
      
        if(! $emissionRadio){
            $emissionRadio = new EmissionRadio();
        }

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
         $this->addFlash('message', 'Article ajouté avec succès');
         return $this->redirectToRoute('app_actualites');
        // return $this->redirectToRoute('app_actualites', ['slug' => $act->getSlug()]);
        }
        
        
        
        
        return $this->render('admin/radio/ajouter.html.twig', [
            'form' => $form->createView(),
            'editMode' => $emissionRadio->getId() !== null
        ]);
    }

    

}