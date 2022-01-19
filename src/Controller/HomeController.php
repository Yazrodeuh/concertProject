<?php

namespace App\Controller;

use App\Entity\Concert;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepageAction(): Response
    {

        $repConcert = $this->getDoctrine()->getRepository(Concert::class)->findLastThreeConcert();

        return $this->render('home/homepage.html.twig', ['concerts' => $repConcert]);
    }
}
