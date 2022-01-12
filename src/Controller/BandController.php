<?php

namespace App\Controller;

use App\Entity\Band;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BandController extends AbstractController
{
    /**
     * @Route("/bands", name="bands_list")
     * @return Response
     */
    public function bandsAction(): Response
    {
        $bandsInfos = $this->getDoctrine()->getRepository(Band::class)->findAll();

        return $this->render('band/list.html.twig', [
            'bandsInfo' => $bandsInfos
        ]);
    }

    /**
     * @Route("/bands/{bandName}", name="band_show")
     * @param string $bandName
     * @return Response
     */
    public function bandAction(string $bandName): Response
    {
        $bandInfos = $this->getDoctrine()->getManager()->getRepository(Band::class)->findOneBy(array("urlName" => $bandName));

        return $this->render('band/show.html.twig', [
            'bandInfos' => $bandInfos
        ]);
    }
}
