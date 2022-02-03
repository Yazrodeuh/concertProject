<?php

namespace App\Controller;

use App\Entity\Band;
use App\Entity\Concert;
use App\Form\BandType;
use App\Form\ConcertType;
use App\Repository\ConcertRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
     * @Route("/", name="concert_index")
     *
     * @param ConcertRepository $concertRepository
     *
     * @return Response
     */
    public function indexAction(ConcertRepository $concertRepository): Response
    {
        return $this->render('concert/index.html.twig', [
            'concerts' => $concertRepository->findAll(),
        ]);
    }

    /**
     * Affiche une liste de concert
     *
     * @Route("/list", name="concert_list")
     * @IsGranted("ROLE_ADMIN")
     *
     * @param ConcertRepository $concertRepository
     *
     * @return Response
     */
    public function listAction(ConcertRepository $concertRepository): Response
    {
        return $this->render('concert/list.html.twig', [
            'concerts' => $concertRepository->findAll(),
        ]);
    }

    /**
     * TODO add description + front
     *
     * @Route("/new", name="concert_new", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     */
    public function newAction(Request $request, EntityManagerInterface $entityManager): Response
    {
        $concert = new Concert();
        $form = $this->createForm(ConcertType::class, $concert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //TODO attention aux images

            $entityManager->persist($concert);
            $entityManager->flush();

            $session = $request->getSession();
            $session->getFlashBag()->add('message', 'The concert has been created !');
            $session->set('statut', 'success');

            return $this->redirectToRoute('band_list');
        }

        return $this->renderForm('concert/new.html.twig', [
            'band' => $concert,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{urlName}", name="concert_show", methods={"GET"})
     *
     * @param String $urlName
     * @param ConcertRepository $concertRepository
     *
     * @return Response
     */
    public function showAction(string $urlName, ConcertRepository $concertRepository): Response
    {
        return $this->render('concert/show.html.twig', [
            'concert' => $concertRepository->findOneBy(array('urlName' => $urlName)),
        ]);
    }

    /**
     * TODO add description
     *
     * @Route("/{id}/edit", name="concert_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     *
     * @param Request $request
     * @param Concert $concert
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     */
    public function editAction(Request $request, Concert $concert, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConcertType::class, $concert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('concert_list');
        }

        return $this->renderForm('concert/edit.html.twig', [
            'band' => $concert,
            'form' => $form,
        ]);
    }

    /**
     * TODO add description
     *
     * @Route("/{id}", name="concert_delete", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     *
     * @param Request $request
     * @param Concert $concert
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     */
    public function deleteAction(Request $request, Concert $concert, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $concert->getId(), $request->request->get('_token'))) {
            $entityManager->remove($concert);
            $entityManager->flush();
        }

        return $this->redirectToRoute('concert_list');
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



}
