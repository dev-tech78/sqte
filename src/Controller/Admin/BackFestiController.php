<?php


namespace  App\Controller\Admin;

use App\Entity\Festival;
use App\Form\FestivalType;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\DocumentaireRepository;
use App\Repository\FestivalRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/ festivalafficher')]
class BackFestiController  extends AbstractController
{




    #[Route('/addfestival', name: 'festival_add')]
    #[Route('/modiffestival/{id}/edit', name: 'upload.fest')]
    public function form(Festival $fest  = null, 
     Request $request, ManagerRegistry $entityManager,
     SluggerInterface $slugger ): Response
    {
       if(!$fest){
        $fest = new Festival();
       }
      
       $form = $this->createForm(FestivalType::class, $fest);
       $form->handleRequest($request);
       if($form->isSubmitted()&& $form->isValid()){
        if(!$fest->getId()){
            $fest->setCreatedAt( new \DateTimeImmutable());
        }
      
        $fest->setSlug($fest->getTitel());
        $acte = $entityManager->getManager();
        $acte->persist( $fest);
        $acte->flush();
        $this->addFlash('message', 'Article ajouté avec succès');
        return $this->redirectToRoute('app_actualites');
       // return $this->redirectToRoute('app_actualites', ['slug' => $act->getSlug()]);
       }
       
       
        return $this->render('admin/festival/ajouterfest.html.twig', [
            'form' => $form->createView(),
            'editMode' =>   $fest->getId() !== null
           
        ]);
    }


    #[Route('/supprimerdocumentaire/{id?0}/delet', name: 'app_docdelete')]
    public function DeletFesival(Festival  $fest, 
    ManagerRegistry $entityManager,
  )
    {
        $em = $entityManager->getManager();
            $em->remove($fest);
            $em->flush();
            $this->addFlash('message', 'Article supprimer avec succès');
            return $this->redirectToRoute('app_addactue'); 
    }


    #[Route('/', name: 'app_festival.affiche')]
    public function index(FestivalRepository $repository): Response
    {
        
      
      
        $fest = $repository->findAll();
        
        return $this->render('admin/festival/index.html.twig', [
            'festival' => $fest
        ]);
    }


}