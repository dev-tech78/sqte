<?php


namespace  App\Controller\Admin;

use App\Entity\Fiction;
use App\Form\FictionType;
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
     SluggerInterface $slugger ): Response
    {
       if(!$fiction){
        $fiction = new Fiction();
       }
      
       $form = $this->createForm(FictionType::class, $fiction);
       $form->handleRequest($request);
       if($form->isSubmitted()&& $form->isValid()){
        if(! $fiction->getId()){
            $fiction->setCreatedAt( new \DateTimeImmutable());
        }
      
        $fiction->setSlug($fiction->getTitle());

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
            } $fiction->setImage($newFilename);
        }

        

        $acte = $entityManager->getManager();
        $acte->persist($fiction);
        $acte->flush();
        $this->addFlash('message', 'Article ajouté avec succès');
        return $this->redirectToRoute('app_actualites');
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
        $em = $entityManager->getManager();
            $em->remove($fiction);
            $em->flush();
            $this->addFlash('message', 'Article supprimer avec succès');
            return $this->redirectToRoute('app_addactue'); 
       
        
    }


}