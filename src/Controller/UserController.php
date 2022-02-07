<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/account")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/users", name="user_list", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     *
     * @param UserRepository $userRepository
     * @return Response
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/", name="user_index", methods={"GET"})
     * @IsGranted("ROLE_USER")
     *
     * @param UserRepository $userRepository
     *
     * @return Response
     */
    public function show(UserRepository $userRepository): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $userRepository->findOneBy(array('email' => $this->getUser()->getUserIdentifier())),
        ]);
    }

    /**
     * @Route("/edit", name="user_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER")
     *
     * @param Request $request
     * @param UserRepository $userRepository
     * @param EntityManagerInterface $entityManager
     * @param UserPasswordHasherInterface $userPasswordHasher
     *
     * @return Response
     */
    public function edit(Request $request, UserRepository $userRepository, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $user = $userRepository->findOneBy(array('email' => $this->getUser()->getUserIdentifier()));

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword($user, $form->get('password')->getData())
            );
            $entityManager->flush();

            return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/id", name="user_delete", methods={"POST"})
     * @IsGranted("ROLE_USER")
     *
     * @param Request $request
     * @param User $user
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     */
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    }
}
