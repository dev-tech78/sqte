<?php


namespace  App\Controller\Admin;

use App\Entity\Documentaire;
use App\Form\DocumentaireType;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\DocumentaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/ affichebacdoc')]
class BackDocController  extends AbstractController
{




    #[Route('/adddocumentaire', name: 'app_doc')]
    #[Route('/modifeactue/{id}/edit', name: 'modif.doc')]
    public function form(Documentaire $doc  = null, 
     Request $request, ManagerRegistry $entityManager,
     SluggerInterface $slugger, ): Response
    {
       if(!$doc){
        $doc = new Documentaire();
       
       }
       $new = true;
       $form = $this->createForm(DocumentaireType::class, $doc);
       $form->handleRequest($request);
       if($form->isSubmitted()&& $form->isValid()){
        if(! $doc->getId()){
            $doc->setCreatedAt( new \DateTimeImmutable());
        }
      
        $doc->setSlug($doc->getTitle());

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
            }  $doc->setImage($newFilename);
        }

        

        $acte = $entityManager->getManager();
        $acte->persist($doc);
        $acte->flush();
        if($new) {
            $message = " a été ajouté avec succès";
           // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
        }else{
            $message = " a été mis à jour avec succès";
           // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
        }
        $this->addFlash(type: 'success', message: $doc->getTitle().  ' '.$message);
       // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
        //$mailer->sendEmail(content: $mailMessage);
        return $this->redirectToRoute('app_affidocback');
        // return $this->redirectToRoute('app_actualites', ['slug' => $act->getSlug()]);
       }
       
       
        return $this->render('admin/documentaire/ajouterdoc.html.twig', [
            'form' => $form->createView(),
            'editMode' =>  $doc->getId() !== null
           
        ]);
    }


    #[Route('/supprimerdocumentaire/{id?0}/delet', name: 'app_docdelete')]
    public function UpdatActu(Documentaire $doc, 
    ManagerRegistry $entityManager,
  )
    {
        $em = $entityManager->getManager();
            $em->remove($doc);
            $em->flush();
            $this->addFlash('message', 'Article supprimer avec succès');
            return $this->redirectToRoute('app_addactue'); 
    }


    #[Route('/', name: 'app_affidocback')]
    public function index(DocumentaireRepository $repository): Response
    {
        
      
      
        $doc = $repository->findAll();
        
        return $this->render('admin/documentaire/index.html.twig', [
            'documentaire' => $doc
        ]);
    }


}