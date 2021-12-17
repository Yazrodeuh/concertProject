<?php

namespace App\Controller;

use App\Entity\Band;
use App\Repository\BandRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BandController extends AbstractController
{
    /**
     * @Route("/bands", name="bands")
     * @return Response
     */
    public function bandsAction(): Response
    {
        $bandsInfos = $this->getDoctrine()->getManager()->getRepository(Band::class)->findAll();

        return $this->render('band/bands.html.twig', [
            'bandsInfo' => $bandsInfos
        ]);
    }

    /**
     * @Route("/bands/{bandName}", name="band")
     * @param string $bandName
     * @return Response
     */
    public function bandAction(string $bandName): Response
    {
        $bandInfos = $this->getDoctrine()->getManager()->getRepository(Band::class)->findOneBy(array("name" => $bandName));

        return $this->render('band/band.html.twig', [
            'bandInfos' => $bandInfos
        ]);
    }
}
