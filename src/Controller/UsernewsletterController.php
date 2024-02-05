<?php

namespace App\Controller;

use App\Entity\UserNewsletter;
use App\Form\UserNewsletterType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;

#[Route('/usernewsletter', name: 'app_')]
class UsernewsletterController extends AbstractController
{
    #[Route('/', name: 'usernewsletter')]
    public function index(Request $request,
    ManagerRegistry $entityManager,
    MailerInterface $mailer): Response
    {
        
        $users = new  UserNewsletter();
        $form = $this->createForm(UserNewsletterType ::class, $users);
        if($form->isSubmitted()&& $form->isValid()){
           $users->setCreatedAt( new \DateTimeImmutable());
           $token = hash('sha256', uniqid());
           $users->setValidationToke($token);
           $em = $entityManager->getManager();
           $em->persist($users);
           $em->flush();
           $email = (new TemplatedEmail())
           ->from('neweletter@.fr')
           ->to($users->getEmail())
           ->subject('votre inscription à la newsletter')
           ->htmlTemplate('message/inscription.html.twig')
           ->context(compact('users', 'token'))
           ;

           $mailer->send($email);
           $this->addFlash('message', 'Inscription en attente de validation');
           return $this->redirectToRoute('app_home');
        }
       
        
        return $this->render('usernewsletter/index.html.twig', [
           'form' => $form->createView(),
        ]);
    }


    #[Route('/confirm/{id}/{token}', name: 'confirm')]
    public function confirm(UserNewsletter $users, $token,ManagerRegistry $entityManager, ): Response
    {
        if($users->getValidationToke() != $token){

            throw $this->createNotFoundException('page non trouvée');
        }

        $users->setIsValid(true);
        $em = $entityManager->getManager();
        $em->persist($users);
        $em->flush();

        $this->addFlash('message', 'compte activé');
        return $this->redirectToRoute('app_home');

    }
}
