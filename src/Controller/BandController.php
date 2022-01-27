<?php

namespace App\Controller;

use App\Entity\Band;
use App\Form\BandType;
use App\Repository\BandRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/band")
 */
class BandController extends AbstractController
{

    /**
     * @Route("/list", name="band_list", methods={"GET"})
     *
     * @param BandRepository $bandRepository
     *
     * @return Response
     */
    public function list(BandRepository $bandRepository): Response
    {
        return $this->render('band/list.html.twig', [
            'bandsInfo' => $bandRepository->findAll(),
        ]);
    }

    /**
     * @Route("/", name="band_index", methods={"GET"})
     *
     * @param BandRepository $bandRepository
     *
     * @return Response
     */
    public function index(BandRepository $bandRepository): Response
    {
        return $this->render('band/index.html.twig', [
            'bands' => $bandRepository->findAll(),
        ]);
    }


    /**
     * @Route("/new", name="band_new", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $band = new Band();
        $form = $this->createForm(BandType::class, $band);
        $form->handleRequest($request);

        $form->getErrors();

        if ($form->isSubmitted() && $form->isValid()) {

            //dump($form->getData());

            $entityManager->persist($band);
            $entityManager->flush();

            return $this->redirectToRoute('band_list', [], Response::HTTP_SEE_OTHER);
        }


        return $this->renderForm('band_controller2/new.html.twig', [
            'band' => $band,
            'form' => $form,
        ]);
    }

    //#[Route('/{id}', name: 'band_controller2_show', methods: ['GET'])]

    /**
     * @Route("/{urlNameBand}", name="band_show")
     *
     * @param String $urlNameBand
     * @param BandRepository $bandRepository
     *
     * @return Response
     */
    public function show(String $urlNameBand, BandRepository $bandRepository): Response
    {
        return $this->render('band/show.html.twig', [
            'bandInfos' => $bandRepository->findOneBy(array('urlName' => $urlNameBand)),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="band_edit", methods={"GET", "POST"})
     *
     * @param Request $request
     * @param Band $band
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function edit(Request $request, Band $band, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BandType::class, $band);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('band_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('band/edit.html.twig', [
            'band' => $band,
            'form' => $form,
        ]);
    }

    //#[Route('/{id}', name: 'band_controller2_delete', methods: ['POST'])]
    public function delete(Request $request, Band $band, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$band->getId(), $request->request->get('_token'))) {
            $entityManager->remove($band);
            $entityManager->flush();
        }

        return $this->redirectToRoute('band_index', [], Response::HTTP_SEE_OTHER);
    }
}
