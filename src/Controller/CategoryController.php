<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\ArtistRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{id}", name="category", requirements={"id"="\d+"})
     */
    public function index(Category $categorie, ArtistRepository $artistRepository): Response
    {
        $categoryId = $categorie->getId();

        // $categories = $categorieRepository->findAll(); 
        $artistes = $artistRepository->findArtistesForCategory($categoryId);
        //dd($artistes);

        return $this->render('category/index.html.twig', [
            'artistes' => $artistes,
        ]);
    }

}
