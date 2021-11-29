<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Repository\LivreRepository;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
            'livres' => $livreRepository->findAll(),
            'categories' => $categorieRepository->findAll(),
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
}
