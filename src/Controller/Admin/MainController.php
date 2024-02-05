<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UtilsFilmType;
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

#[Route('admin')] //, IsGranted('ROLE_ADMIN')
//#[Route('admin')]
class MainController extends AbstractController
{
    #[Route('/', name: 'admin_index')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }


    // #[Route('/staff', name: 'admin_staff')]
    // public function Staff(UserRepository $repos): Response
    // {
       
       
    //    $this->denyAccessUnlessGranted('ROLE_ADMIN');
    //     $user = $repos->findAll();
    //    $mmembre = $repos->findBy(['roles' => 'membre'],['id' => 'DESC']);
    //     return $this->render('admin/staff.html.twig', [
    //         'staff' =>  $user,
    //         'membre' =>$mmembre
    //     ]);
    // }

    // Add User 
    #[Route('/admin/adduser/addcompte', name: 'admin_userCompte')]
    #[Route('/updatadmin/{id}/edit', name: 'edit.admin')]
    public function useradd(Request $request, UserPasswordHasherInterface $userPasswordHasher, 
    UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, 
    EntityManagerInterface $entityManager,  User $user = null): Response
    {
       
      
       if($user){
        $user = new User();
       }
      
      
       // $form = $this->createForm(UseradminType::class, $user);
       $form = $this->createForm(UtilsFilmType::class, $user);
        $form->handleRequest($request);

if ($form->isSubmitted() && $form->isValid()) {
    //$user->setCreatedAt(new \DateTimeImmutable());
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
        return $this->render('admin/adduser_compte.html.twig',[
            'userForm' => $form->createView(),
        ]);   
    }

    
}
