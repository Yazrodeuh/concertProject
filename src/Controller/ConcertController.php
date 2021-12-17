<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConcertController extends AbstractController
{
    /**
     *
     *
     * @return Response
     *
     * @Route("/", name="homepage")
     */
    public function indexAction(): Response
    {
        return $this->render('concert/index.html.twig', [
            'controller_name' => 'ConcertController',
        ]);
    }

    /**
     * Affiche une liste de concert
     *
     * @param string $name
     * @return Response
     *
     * @Route("/concert/{name}", name="list")
     */
    public function listAction(string $name): Response
    {
        return $this->render('concert/list.html.twig', [
            'controller_name' => 'ConcertController',
            'name' => $name,
        ]);
    }
}
