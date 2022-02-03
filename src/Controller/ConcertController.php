<?php

namespace App\Controller;

use App\Entity\Concert;
use App\Form\ConcertType;
use App\Repository\BandRepository;
use App\Repository\ConcertRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/concert")
 */
class ConcertController extends AbstractController
{

    /**
     * Affiche une liste de concert
     *
     * @param ConcertRepository $concertRepository
     * @return Response
     *
     * @Route("/", name="concert_index")
     */
    public function list(ConcertRepository $concertRepository): Response
    {
        return $this->render('concert/list.html.twig', [
            'concerts' => $concertRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{urlName}", name="concert_show")
     *
     * @param String $urlName
     * @param ConcertRepository $concertRepository
     * @return Response
     */
    public function show(string $urlName, ConcertRepository $concertRepository): Response
    {
        return $this->render('concert/show.html.twig', [
            'concert' => $concertRepository->findOneBy(array('urlName' => $urlName)),
        ]);
    }

    /**
     * Affiche une liste de concert
     *
     * @Route("/archives", name="concert_archives")
     *
     * @param ConcertRepository $concertRepository
     *
     * @return Response
     */
    public function archives(ConcertRepository $concertRepository): Response
    {
        return $this->render('concert/archives.html.twig', [
            'oldConcert' => $concertRepository->findOldConcert(),
        ]);
    }

    /**
     * Affiche une liste de concert
     *
     * @Route("/new", name="concert_new", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     *
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {

        $concert = new Concert();

        $form = $this->createForm(ConcertType::class, $concert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($concert);
            $entityManager->flush();

            return $this->redirectToRoute('concer_success');
        }

        return $this->render('concert/new.html.twig', [
            'formConcert' => $form->createView(),
        ]);
    }

}
