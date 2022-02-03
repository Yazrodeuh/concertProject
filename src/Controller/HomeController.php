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
     * TODO add description
     *
     * @Route("/", name="homepage", methods={"GET"})
     *
     * @param ConcertRepository $concertRepository
     *
     * @return Response
     */
    public function homepageAction(ConcertRepository $concertRepository): Response
    {
        return $this->render('home/homepage.html.twig', [
            'concerts' => $concertRepository->findLastThreeConcert()
        ]);
    }

    /**
     * TODO add description
     *
     * @Route("/manage", name="manage", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     *
     * @return Response
     */
    public function manageAction(): Response
    {
        return $this->render('home/manage.html.twig', []);
    }
}
