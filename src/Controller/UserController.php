<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;



#[Route('personne'),
IsGranted('ROLE_ADMIN')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user'),
    IsGranted("ROLE_ADMIN")]

       
    public function index(): Response
    {
       $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
