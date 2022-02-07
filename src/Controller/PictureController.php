<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Form\PictureType;
use App\Repository\PictureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/picture")
 */
class PictureController extends AbstractController
{
    /**
     * @Route("/", name="picture_index", methods={"GET"})
     */
    public function index(PictureRepository $pictureRepository): Response
    {
        return $this->render('picture/index.html.twig', [
            'pictures' => $pictureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="picture_new", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     *
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $picture = new Picture();
        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($picture);
            $entityManager->flush();

            return $this->redirectToRoute('picture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('picture/new.html.twig', [
            'picture' => $picture,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="picture_show", methods={"GET"})
     *
     * @param Picture $picture
     *
     * @return Response
     */
    public function show(Picture $picture): Response
    {
        return $this->render('picture/show.html.twig', [
            'picture' => $picture,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="picture_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     *
     * @param Request $request
     * @param Picture $picture
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     */
    public function edit(Request $request, Picture $picture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('picture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('picture/edit.html.twig', [
            'picture' => $picture,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="picture_delete", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     *
     * @param Request $request
     * @param Picture $picture
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     */
    public function delete(Request $request, Picture $picture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $picture->getId(), $request->request->get('_token'))) {
            $entityManager->remove($picture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('picture_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     *
     * @param string $name
     * @param $file
     *
     * @return void
     */
    public static function upload(string $name, $file)
    {
        $emplacement = "/img/upload";
        $file->move($emplacement, $name);

    }
}
