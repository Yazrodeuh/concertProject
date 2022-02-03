<?php

namespace App\Controller;

use App\Entity\Band;
use App\Form\BandType;
use App\Repository\BandRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
     * TODO add description
     *
     * @Route("/", name="band_index", methods={"GET"})
     *
     * @param BandRepository $bandRepository
     *
     * @return Response
     */
    public function indexAction(BandRepository $bandRepository): Response
    {
        return $this->render('band/index.html.twig', [
            'bands' => $bandRepository->findAll(),
        ]);
    }

    /**
     * TODO add description
     *
     * @Route("/list", name="band_list", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     *
     * @param BandRepository $bandRepository
     *
     * @return Response
     */
    public function listAction(BandRepository $bandRepository): Response
    {
        return $this->render('band/list.html.twig', [
            'bands' => $bandRepository->findAll(),
        ]);
    }

    /**
     * TODO add description + front
     *
     * @Route("/new", name="band_new", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     */
    public function newAction(Request $request, EntityManagerInterface $entityManager): Response
    {
        $band = new Band();
        $form = $this->createForm(BandType::class, $band);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //TODO attention aux images

            $entityManager->persist($band);
            $entityManager->flush();

            $session = $request->getSession();
            $session->getFlashBag()->add('message', 'The band has been created !');
            $session->set('statut', 'success');

            return $this->redirectToRoute('band_list');
        }

        return $this->renderForm('band/new.html.twig', [
            'band' => $band,
            'form' => $form,
        ]);
    }


    /**
     * TODO add description
     *
     * @Route("/{urlName}", name="band_show", methods={"GET"})
     *
     * @param String $urlName
     * @param BandRepository $bandRepository
     *
     * @return Response
     */
    public function showAction(string $urlName, BandRepository $bandRepository): Response
    {
        return $this->render('band/show.html.twig', [
            'bandInfos' => $bandRepository->findOneBy(array('urlName' => $urlName)),
        ]);
    }

    /**
     * TODO add description
     *
     * @Route("/{id}/edit", name="band_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     *
     * @param Request $request
     * @param Band $band
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     */
    public function editAction(Request $request, Band $band, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BandType::class, $band);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('band_list');
        }

        return $this->renderForm('band/edit.html.twig', [
            'band' => $band,
            'form' => $form,
        ]);
    }


    /**
     * TODO add description
     *
     * @Route("/{id}", name="band_delete", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     *
     * @param Request $request
     * @param Band $band
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     */
    public function deleteAction(Request $request, Band $band, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $band->getId(), $request->request->get('_token'))) {
            $entityManager->remove($band);
            $entityManager->flush();
        }

        return $this->redirectToRoute('band_list');
    }
}
