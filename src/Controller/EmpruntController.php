<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Entity\Livre;
use App\Entity\Emprunt;
use Symfony\Component\Security\Core\Security;
use App\Repository\LivreRepository;
use App\Repository\EmpruntRepository;
use Symfony\Component\HttpFoundation\Request;


class EmpruntController extends AbstractController
{
    // fonction predefenie :
    public function make_emprunt_data(SessionInterface $session ,LivreRepository $livresRepository,Emprunt $emprunt){
        $panier = $session->get("panier", []);
        // On "fabrique" les données
        $dataPanier = [];
        $total = 0;
        foreach($panier as $id => $quantite){
            $livre = $livresRepository->find($id);
            $dataPanier[] = [
                "livre" => $livre,
                "quantite" => $quantite
            ];
            $this->fill_emprunt($emprunt , $livre);
            $total += $livre->getPrix() * $quantite;
        }
        return $emprunt;
    }
    // remplir l'emprunte :
    public function fill_emprunt(Emprunt $emprunt , Livre $livre){
        $emprunt->addLivre($livre);
    }
    // fin de fonctions //

    // constructeur et initialisation des variable de securité : 
    /**
    * @var Security
    */
    private $security;
    
    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    // fin constructeur //

    /**
     * @Route("/admin/emprunt", name="emprunt_index", methods={"GET"})
     */
    public function index(EmpruntRepository $empruntRepository): Response
    {
        return $this->render('emprunt/index.html.twig', [
            'emprunts' => $empruntRepository->findAll(),
        ]);
    }

    /**
     * @Route("/user/emprunter", name="emprunter")
     */
    public function emprunter(SessionInterface $session ,LivreRepository $livresRepository)
    {
        //get current user :
        $user = $this->security->getUser();

        $emprunt = new Emprunt();
        $entityManager = $this->getDoctrine()->getManager();
        // construire l'emprunte : 
        $newEmprunt = $this->make_emprunt_data($session,$livresRepository,$emprunt);  
        $newEmprunt->setDataEmprunt(new \DateTime());
        $newEmprunt->addUser($user);
        $newEmprunt->setIsConfirmed(false);
        // enregistrer l'emprunte : 
        $entityManager->persist($newEmprunt);
        $entityManager->flush();
        return $this->redirectToRoute('home');
    }
    /**
     * @Route("/{id}", name="emprunt_delete", methods={"POST"})
     */
    public function delete(Request $request, Emprunt $emprunt): Response
    {
        if ($this->isCsrfTokenValid('delete'.$emprunt->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($emprunt);
            $entityManager->flush();
        }

        return $this->redirectToRoute('emprunt_index', [], Response::HTTP_SEE_OTHER);
    }
   

}
