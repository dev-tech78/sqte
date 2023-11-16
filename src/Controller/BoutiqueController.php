<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Polyfill\Intl\Idn\Info;

class BoutiqueController extends AbstractController
{
    #[Route('/boutique', name: 'app_boutique',methods:['GET'])]
    public function index(Request $request): Response
    {
       
       //Affichage de notre produuit
        $session = $request->getSession();
         //sinon je l'initialise puis j'affiche
         if(!$session->has(name: 'produits')){
            $produit = [
                'achat' => 'acheter clé usb',
                'cours' => 'Finaliser mon cours',
                'correction' => 'corriger mes examens'

            ];
               $session->set('produits', $produit);
               $this->addFlash(type: 'Info', message: "La liste des produits viens d'etre initalisés");
                
           
         }
       
        return $this->render('boutique/index.html.twig');
       
    }

    #[Route('/boutique/add/{name}/{content}', name: 'boutique')]
    public function addProduit(Request $request, $name, $content):RedirectResponse
    {
        $session = $request->getSession();
        //Vérifier si j ai mon tableau de produit
        if($session->has(name: 'produits')){

            //si oui
                //Vérifier si on a déja un produit avec le mmem nom
                $produits = $session->get(name:'produits');  
                if(isset($produits[$name])){
                     //si oui afficher erreur
                    $this->addFlash(type: 'error', message: "le produits $name exste déja");
                }else{

                     //si non l'ajouter et on affiche un message de succées
                     $produits[$name] = $content;
                     $session->set('produits',$produits);
                     $this->addFlash(type: 'success', message: "le produits $name  a été ajouter avec succès ");
                }
               

        }else{

            // si non 
            //afficher une erreur et on va rediriger vers le controller index
            $this->addFlash(type: 'error', message: "La liste des produits n'est pas encor initalisés");
        }
            
        return $this->redirectToRoute( route: 'app_boutique');

    }


    #[Route('/boutique/update/{name}/{content}', name: 'update.boutique')]
    public function UpdateProduit(Request $request, $name, $content):RedirectResponse
    {
        $session = $request->getSession();
        //Vérifier si j ai mon tableau de produit
        if($session->has(name: 'produits')){

            //si oui
                //Vérifier si on a déja un produit avec le mmem nom
                $produits = $session->get(name:'produits');  
                if(!isset($produits[$name])){
                     //si oui afficher erreur
                    $this->addFlash(type: 'error', message: "le produits $name n'existe pas");
                }else{

                     //si non l'ajouter et on affiche un message de succées
                     $produits[$name] = $content;
                     $session->set('produits',$produits);
                     $this->addFlash(type: 'success', message: "le produits $name  a été modifié avec succès ");
                }
               

        }else{

            // si non 
            //afficher une erreur et on va rediriger vers le controller index
            $this->addFlash(type: 'error', message: "La liste des produits n'est pas encor initalisés");
        }
            
        return $this->redirectToRoute( route: 'app_boutique');
        
    }


    #[Route('/boutique/delte/{name}', name: 'delete')]
    public function deletProduit(Request $request, $name):RedirectResponse
    {
    $session = $request->getSession();
    //Vérifier si j ai mon tableau de produit
    if($session->has(name: 'produits')) {

        //si oui
        //Vérifier si on a déja un produit avec le mmem nom
        $produits = $session->get(name:'produits');
        if(isset($produits[$name])) {
            //si oui afficher erreur
            $this->addFlash(type: 'error', message: "le produits $name exste déja");
        } else {

            //si non l'ajouter et on affiche un message de succées
            unset($produits[$name]);
            $session->set('produits', $produits);
            $this->addFlash(type: 'success', message: "le produits $name  a été  supprimé avec succès ");
        }


    } else {

        // si non
        //afficher une erreur et on va rediriger vers le controller index
        $this->addFlash(type: 'error', message: "La liste des produits n'est pas encor initalisés");
    }

    return $this->redirectToRoute(route: 'app_boutique');

}

        #[Route('/boutique/reset', name: 'reset')]
        public function resetProduit(Request $request): RedirectResponse

    {
            $session = $request->getSession();
            $session->remove(name: 'produits');
            return $this->redirectToRoute(route: 'app_boutique');
    }


    //pour chercher un nombre aliatoire
    #[Route('/nobre/{nb?6<\d+>}', name: 'tab')]
    public function nbalt($nb): Response
    {
        //en remplit un tableau
        $notes = [];
        for($i = 0; $i<$nb ; $i++){
            $notes[] = rand(0,20);
        }

        return $this->render('tab/index', [ 'notes' => $notes]);
    }
}
