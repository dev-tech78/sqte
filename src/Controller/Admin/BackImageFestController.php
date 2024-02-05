<?php


namespace  App\Controller\Admin;

use App\Entity\ImageFestival;
use App\Form\ImageFestivalType;
use App\Service\PictureService;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ImageFestivalRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/ festivalImage')]
class BackImageFestController  extends AbstractController
{

    #[Route('/', name: 'app_festival')]
    public function index(ImageFestivalRepository $repository): Response
    {
        
      
      
        $fest = $repository->findAll();
        
        return $this->render('admin/festival/index.html.twig', [
            //'festival' => $fest
        ]);
    }


    #[Route('/add', name: 'festival_image.add')]
    #[Route('/update/{id}/edit', name: 'upload.fest')]
    public function formadd(ImageFestival $imagefest  = null, 
     Request $request, ManagerRegistry $entityManager,
     SluggerInterface $slugger,
     PictureService $uploader  ): Response
    {
       if(!$imagefest){
        $imagefest = new ImageFestival();
       }
      
       $form = $this->createForm(ImageFestivalType::class, $imagefest);
       $form->handleRequest($request);
if($form->isSubmitted() && $form->isValid()) {

    $imageFile =  $form->get('image')->getData();
    foreach($imageFile as $image) {

        $derectory = '_prodect';
        $fichier = $uploader->add($image, $derectory);

    }


    $imagefest->setImage($fichier);
    $acte = $entityManager->getManager();
    $acte->persist($imagefest);
    $acte->flush();
    try {
        $acte->flush();
    } catch (\Exception $e) {
        $this->addFlash('message', 'Article ajouté avec succès');
        return $this->redirectToRoute('app_actualites');
    }


    //$this->addFlash('message', 'Article ajouté avec succès');
    //return $this->redirectToRoute('app_actualites');
       // return $this->redirectToRoute('app_actualites', ['slug' => $act->getSlug()]);

}
        return $this->render('admin/festivalimage/ajouter.html.twig', [
            'form' => $form->createView(),
            'editMode' =>  $imagefest->getId() !== null
           
        ]);
    }


    #[Route('/supprimerimage/{id?0}/delet', name: 'app_fest')]
    public function Delete(ImageFestival  $fest, 
    ManagerRegistry $entityManager,
  )
    {
        $em = $entityManager->getManager();
            $em->remove($fest);
            $em->flush();
            $this->addFlash('message', 'Article supprimer avec succès');
            return $this->redirectToRoute('app_addactue'); 
    }


   


}