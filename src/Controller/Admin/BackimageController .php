<?php


namespace  App\Controller\Admin;

use App\Entity\Image;
use App\Form\ImageType;
use App\Repository\ImageRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


class BackimageController extends AbstractController
{

    #[Route('/image', name: 'app_image')]
    public function index(ImageRepository $repository): Response
    {
        $image = $repository->findAll();
        return $this->render('admin/image/ajouterimage.html.twig', [
            'image' => $image
        ]);
    }


   

    #[Route('/addimage', name: 'add_image')]
    #[Route('/updateimage/{id}/edit', name: 'edit.image')]
    public function form(Image $image= null, 
     Request $request, ManagerRegistry $entityManager,
     SluggerInterface $slugger ): Response
    {
       if(!$image){
        $image = new Image();
       }
      
       $form = $this->createForm(ImageType::class,$image);
       $form->handleRequest($request);
       if($form->isSubmitted()&& $form->isValid()){
        if(! $image->getId()){
            //$fiction->setCreatedAt( new \DateTimeImmutable());
        }
      $new =true;
       // $image->setSlug($ $image->getTitle());

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
            } $image->setLien($newFilename);
        }

        

        $acte = $entityManager->getManager();
        $acte->persist($image);
        $acte->flush();
        if($new) {
            $message = "a été ajouté avec succès";
            // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            }else{
                $message = "a été mis à jour avec succès";
            // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            }
            $this->addFlash(type: 'success', message:  $image->getId().  $message);
        // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
            //$mailer->sendEmail(content: $mailMessage);
            return $this->redirectToRoute('admin_actu');
            // return $this->redirectToRoute('app_actualites', ['slug' => $act->getSlug()]);
       
       }
       
       
        return $this->render('admin/image/ajouterimage.html.twig', [
            'form' => $form->createView(),
            'editMode' => $image->getId() !== null
           
        ]);
    }


    #[Route('/deltecinem/{id?0}/delet', name: 'app_cinemadelete')]
    public function UpdatCinema(Image  $image, 
    ManagerRegistry $entityManager,
  )
    {
        $em = $entityManager->getManager();
            $em->remove($image);
            $em->flush();
            $this->addFlash('message', 'Article supprimer avec succès');
            return $this->redirectToRoute('app_addactue'); 
       
        
    }


}