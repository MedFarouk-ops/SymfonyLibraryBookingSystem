<?php

namespace App\Controller;

use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Repository\LivreRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(LivreRepository $livreRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'livres' => $livreRepository->findLastest(),
        ]);
    }
    /**
     * @Route("/collection", name="collection")
     */
    public function colletion(LivreRepository $livreRepository,CategorieRepository $categorieRepository): Response
    {
        return $this->render('home/collection.html.twig', [
            'controller_name' => 'HomeController',
            'livres' => $livreRepository->findOrdred(),
            'categories' => $categorieRepository->findOrdred(),
        ]);
    }

     /**
     * @Route("/book/{id}", name="single_book", methods={"GET"})
     */
    public function show(Livre $livre): Response
    {
        return $this->render('home/show_livre.html.twig', [
            'livre' => $livre,
        ]);
    }


    /**
     * @Route("/search", name="search_livre")
     */
    public function searchLivre(Request $request)
    {

        $titre = $request->query->get('titre');

        $em  = $this->getDoctrine()->getManager();
        $req = $em->createQuery('
            SELECT l FROM App\Entity\Livre l
            WHERE l.titre LIKE :titre
            ORDER BY l.titre ASC'
        )
        ->setParameter('titre','%'.$titre.'%')
        ->setMaxResults(10);
        $resultat = $req->getResult();
        return $this->render('home/search_result.html.twig', [
            'resultat' => $resultat,
        ]);
    }
    
}
