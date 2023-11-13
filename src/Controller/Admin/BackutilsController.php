<?php


namespace  App\Controller\Admin;

use App\Entity\Fiction;
use App\Entity\UtilsFilm;
use App\Form\UtilsFilmType;
use App\Repository\FictionRepository;
use App\Repository\UtilsFilmRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/ backutil')]
class BackutilsController extends AbstractController
{

    #[Route('/', name: 'app_afficherutil')]
    public function index( UtilsFilmRepository $repos): Response
    {
        $imagefilm = $repos->findAll();
        return $this->render('admin/utils/image.html.twig', [
            'imagefilm' => $imagefilm
        ]);
    }


    #[Route('/utilimage/{slug}', name: 'app_util')]
    #[Route('updatutil/{id<\d+>}', name: 'util_detail')]
    public function Addimage(UtilsFilm $utilsFilm  = null,
    Request $request, ManagerRegistry $entityManager,
    SluggerInterface $slugger, Fiction $fiction, FictionRepository $fictionRepository, $slug ): Response
    {
       
      
        if(!  $utilsFilm){
            $utilsFilm = new UtilsFilm();
        }

        
        $form = $this->createForm(UtilsFilmType::class, $utilsFilm);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
         if(! $utilsFilm->getId()){
          
         }
       
        // $utilsFilm->setSlug( $utilsFilm->getTitle());
 
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
             } $utilsFilm->setImage($newFilename);

           
         }
 
         $utilsFilm->setFiction($fiction);
         
         $acte = $entityManager->getManager();
         $acte->persist($utilsFilm);
         $acte->flush();
         $this->addFlash('message', 'Article ajouté avec succès');
         return $this->redirectToRoute('app_actualites');
        // return $this->redirectToRoute('app_actualites', ['slug' => $act->getSlug()]);
        }
        
        
        
        $article = $fictionRepository->findOneBy(['slug' => $slug]);
        return $this->render('admin/utilsfilm/ajouter.html.twig', [
            'form' => $form->createView(),
            'editMode' =>  $utilsFilm->getId() !== null
        ]);
    }

    

}