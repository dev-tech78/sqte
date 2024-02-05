<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UseradminType;
use App\Repository\ProfilRepository;
use App\Repository\UserRepository;
use App\Security\UserAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;



#[Route('personne'),
IsGranted('ROLE_ADMIN')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user'),
    IsGranted("ROLE_ADMIN")]

       
    public function index(): Response
    {
       $this->denyAccessUnlessGranted('ROLE_ADMIN');
        //app_forgot_password_request
       return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/staff', name: 'app_personnel'),
    IsGranted("ROLE_ADMIN")]
    public function staff(UserRepository $repos): Response
    {
       //$this->denyAccessUnlessGranted('ROLE_ADMIN');
        //app_forgot_password_request
        $user = $repos->findBy([], ['id' => 'DESC']);
       return $this->render('admin/user/staff.html.twig', [
            'user' => $user
           
        ]);
    }

    #[Route('/admin/profil/{slug}membre', name: 'profil_membre')]
    public function profil(ProfilRepository $repos, $slug) : Response
    {
        $membre = $repos->findBy([], ['id' => 'DESC']);
        $profil = $repos->findOneBy(['slug' => $slug]);
        return $this->render('admin/user/profil.html.twig', [
             'profil' => $profil,
             'membre' => $membre
            
         ]);
    }

    #[Route('/admin/membre/assoc', name: 'membre_assoc')]
    public function membre(ProfilRepository $repos) : Response
    {
        $membre = $repos->findBy([], ['id' => 'DESC']);
      
        return $this->render('admin/user/membre.html.twig', [
             'membre' => $membre
            
         ]);
    }



    // Add User 
    #[Route('/admin/adduser/addcompte', name: 'admin_userCompte')]
    #[Route('/admin/modife/{id}addcompte', name: 'modif_userCompte')]
    public function useradd(Request $request, User $user= null,
     UserPasswordHasherInterface $userPasswordHasher, 
    UserAuthenticatorInterface $userAuthenticator,
     UserAuthenticator $authenticator, 
    EntityManagerInterface $entityManager): Response
    {
       
      
       if(!$user){
        $user = new User();
       }
       
      
        $form = $this->createForm(UseradminType::class, $user);
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
