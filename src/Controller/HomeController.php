<?php

namespace App\Controller;

use App\Repository\ConcertRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepageAction(ConcertRepository $concertRepository): Response
    {
        return $this->render('home/homepage.html.twig', ['concerts' => $concertRepository->findLastThreeConcert()]);
    }

    /**
     * @Route("/manage", name="manage")
     * @IsGranted("ROLE_ADMIN")
     */
    public function manageAction(): Response
    {

        return $this->render('home/manage.html.twig', []);
    }
}
