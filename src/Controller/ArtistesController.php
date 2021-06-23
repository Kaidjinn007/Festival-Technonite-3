<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistesController extends AbstractController
{
    /**
     * @Route("/artistes", name="artistes")
     */
    public function artistes(): Response
    {
        return $this->render('artistes/artistes.html.twig', [
            'controller_name' => 'ArtistesController',
        ]);
    }
}
