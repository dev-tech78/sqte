<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\NewsletterType;
use App\Entity\UserNewsletter;
use App\Repository\NewsletterRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/newsletter', name: 'app_')]
class NewsletterController extends AbstractController
{
    #[Route('/', name: 'list')]
    public function index(NewsletterRepository $repos): Response
    {
        return $this->render('newsletter/list.html.twig', [
            'newsletter' => $repos->findAll()
        ]);
    }


    #[Route('/send/{id}', name: 'send')]
    public function send(Newsletter $newsletter, MailerInterface $mailer): Response
    {
        
        $users = $newsletter->getRelatuser();
        foreach($users as $user){
            $email = (new TemplatedEmail())
            ->from('newsletter@hotmil.fr')
            ->to($users->getEmail())
            ->subject($newsletter->getTitle())
            ->htmlTemplate('')
            ->context(compact('newsletter', 'users'))

            ;
            $mailer->send(($email));
        }
        
        return $this->render('newsletter/list.html.twig', [
           
        ]);
    }

    #[Route('/unsubscribe/{id}/{newsletter}/{token}', name: 'unsubscribe')]
    public function desincrit(Newsletter $newsletter,
     UserNewsletter $users, $token,
     ManagerRegistry $entityManager)
    {
        if($users->getValidationToke() != $token) {
            throw $this->createNotFoundException('Page non trouvée');
        }
         $em = $entityManager->getManager();
            $em->remove($users);
            $em->flush();
            $this->addFlash(type: 'success', message:" 'Newsletter supprimé avec succès ");
            return $this->redirectToRoute('home'); 

    }

    #[Route('/prepare', name: 'prepare')]
    public function prepare(Request $request,
    ManagerRegistry $entityManager): Response
    {
        
        $newsletter = new Newsletter();
        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){

            $em = $entityManager->getManager();
            $em->persist($newsletter);
            $em->flush();
            return $this->redirectToRoute('app_list');
        }
        
        return $this->render('newsletter/prepare.html.twig', [
            'form' => $form->createView(),
            'editMode' =>  $newsletter->getId() !== null
        ]);
    }

    
}
