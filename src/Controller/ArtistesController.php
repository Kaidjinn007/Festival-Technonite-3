<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Repository\ArtistRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArtistesController extends AbstractController
{
    /**
     * @Route("/artistes", name="artistes")
     * @Route("/artistes/category/{id}", name="liste_categoryById", requirements={"id"="\d+"})
     */
    //public function index(CategoryRepository $categoryrepository, ArtistRepository $artistrepository): Response
    public function index(CategoryRepository $categoryRepository, ArtistRepository $artistrepository, $id = null): Response
    {
        $categories = $categoryRepository->findAll();
        //$artistes = $artistrepository->findAll();
        $artistes = $id ? $artistrepository->findBy(['category' => $id]) :  $artistrepository->findAll();
        // Ici nous allons utiliser la souplesse d'un tableau définir et agencer les couleurs de chaque catégoried
        // ci-dessous le tableau nom de ayant $categoryColorName
        $categoryColorName = [
            'Mélodique' => 'primary',
            'Industrielle' => 'secondary',
            'Groovy' => 'success',
            'Deep' => 'info',
            'Détroit' => 'warning',
        ];
        foreach ($categories as $category) {
            $category->color = $categoryColorName[$category->getName()];
        }

        return $this->render('artistes/artistes.html.twig', [
            'categories' => $categories,
            'artistes' => $artistes,
        ]);




    }

    /**
     * @Route("/artistes/view/{id}", name="artiste_view", requirements={"id"="\d+"})
     */
    public function view(Artist $artiste, ArtistRepository $artistRepository): Response
    {
        $artisteId = $artiste->getId();
        $artiste = $artistRepository->find($artisteId);

        return $this->render('artistes/view.html.twig', [
            'artiste' => $artiste,
        ]);
    }
}


