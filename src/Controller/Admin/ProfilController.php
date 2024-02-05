<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Profil;
use App\Form\ProfilType;
use App\Form\ProfildminType;
use App\Service\MailerService;
use App\Service\UploaderService;
use App\Security\UserAuthenticator;
use App\Repository\ProfilRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;


#[Route('/profil')]
class ProfilController extends AbstractController
{
    #[Route('/', name: 'app_profil')]
    public function index(): Response
    {
        return $this->render('admin/profil/index.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }


    #[Route('/profil/ajouter', name: 'app_ajouter')]
    #[Route('/updateprofil/@pass/59@2aa698~é9852{id}/@pass/59@2aa698~é9852edit', name: 'edit.profil')]
    public function form(Profil $profil  = null, 
     Request $request, ManagerRegistry $entityManager,
     UploaderService $uploaderService, MailerService $mailer
    ): Response
    {
       
       //$new = false;
       
        if(!$profil){
            $user =  $this->getUser();
            $profil = new Profil();
       
       }
       $new = true;
      
       $form = $this->createForm(ProfilType::class,$profil);
       $form->handleRequest($request);
       if($form->isSubmitted()&& $form->isValid()){
        if(! $profil->getId()){
            $profil->setCreatedAt( new \DateTimeImmutable());
        }
        $profil->setSlug($profil->getName());
        $imageFile =  $form->get('avatar')->getData();
        if ($imageFile) {
            $derectory =  $this->getParameter('galerie_directory');    
            $profil->setAvatar($uploaderService->UploaderFile($imageFile, $derectory));
        }
        $profil->setPerson($user);
        $acte = $entityManager->getManager();
        $acte->persist($profil);
        $acte->flush();

        if($new) {
            $message = "a été ajouté avec succès";
           // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
        }else{
            $message = "a été mis à jour avec succès";
           // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
        }
        $this->addFlash(type: 'success', message: $profil->getName().  $message);
       // $mailMessage = $act->getTitle() . '' .$act->getImage(). '' .$message;
        //$mailer->sendEmail(content: $mailMessage);
        return $this->redirectToRoute('app_profil');
        // return $this->redirectToRoute('app_actualites', ['slug' => $act->getSlug()]);
       }
       
       
        return $this->render('admin/profil/ajouterprofil.html.twig', [
            'form' => $form->createView(),
            'editMode' =>  $profil->getId() !== null
           
        ]);
    }

  

    #[Route('/delteprofil/{id}/delet', name: 'app_deletaprofil')]
    public function UpdatActu(Profil $profil = null, 
    ManagerRegistry $entityManager,
  ): Response
    {
        
        if($profil){
            $em = $entityManager->getManager();
            $em->remove($profil);
            $em->flush();
            $this->addFlash(type: 'success', message:" 'Article supprimer avec succès ");
            return $this->redirectToRoute('admin_actu'); 

        }else{
            $this->addFlash(type: 'error',message:" 'Personne inexistante ");
        }
       
          
        return $this->redirectToRoute(route: 'admin_actu');
        
    }


    //#[Route('/adduser/addcompte', name: 'admin_userCompte')]
    #[Route('/modife/comp%#@//25/{slug}@pass/59@2aa698~é9852{id<\d+>}19684@#', name: 'modif_profilCompte')]
    public function useradd(Request $request, User $user= null,
     UserPasswordHasherInterface $userPasswordHasher, 
    UserAuthenticatorInterface $userAuthenticator,
     UserAuthenticator $authenticator, 
    EntityManagerInterface $entityManager): Response
    {
       
      
       if(!$user){
        $user = new User();
       }
       
      
        $form = $this->createForm(ProfildminType::class, $user);
        $form->handleRequest($request);

if ($form->isSubmitted() && $form->isValid()) {
    $user->setCreatedAt(new \DateTimeImmutable());
    // encode the plain password
    $user->setPassword(
        $userPasswordHasher->hashPassword(
            $user,
            $form->get('plainPassword')->getData()
        )
    );

    $entityManager->persist($user);
    $entityManager->flush();
}
        return $this->render('admin/user/adduser_compte.html.twig',[
            'userForm' => $form->createView(),
            'editMode' =>   $user->getId() !== null
        ]);   
    }



}
