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
     */
    public function index(CategoryRepository $categoryrepository, ArtistRepository $artistrepository): Response
    {
        $categories = $categoryrepository->findAll();
        $artistes = $artistrepository->findAll();
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
     * @Route("/artiste/view/{id}", name="artiste_view", requirements={"id"="\d+"})
     */
    public function view(Artist $artiste, ArtistRepository $artisteRepository): Response
    {
        $artisteId = $artiste->getId();
        $artiste = $artisteRepository->find($artisteId);

        return $this->render('artistes/view.html.twig', [
            'artiste' => $artiste,
        ]);
    }




}
