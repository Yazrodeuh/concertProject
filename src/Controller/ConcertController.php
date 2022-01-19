<?php

namespace App\Controller;

use App\Entity\Concert;
use App\Form\CreateConcertType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConcertController extends AbstractController
{

    /**
     * Affiche une liste de concert
     *
     * @return Response
     *
     * @Route("/concert", name="concert_list")
     */
    public function listAction(): Response
    {
        $repConcert = $this->getDoctrine()->getRepository(Concert::class)->findAll();

        return $this->render('concert/list.html.twig', [
            'concerts' => $repConcert,
        ]);
    }

    /**
     * Affiche une liste de concert
     *
     * @return Response
     *
     * @Route("/archives", name="concert_archives")
     */
    public function archivesAction(): Response
    {
        $repConcert = $this->getDoctrine()->getRepository(Concert::class)->findOldConcert();

        return $this->render('concert/archives.html.twig', [
            'oldConcert' => $repConcert,
        ]);
    }

    /**
     * Affiche une liste de concert
     *
     * @param Request $request
     * @return Response
     *
     * @Route("/concert/create", name="concert_create")
     */
    public function createConcertAction(Request $request): Response
    {

        $show = new Concert();

        $form = $this->createForm(CreateConcertType::class, $show);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $show = -$form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($show);
            $entityManager->flush();

            //return $this->redirectToRoute('concer_success');
        }

        return $this->render('concert/new.html.twig', [
            'formConcert' => $form->createView(),
        ]);
    }




}
