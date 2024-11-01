<?php

namespace App\Controller;

use App\Repository\SingerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SingerController extends AbstractController
{
    #[Route('/singer', name: 'app_singer')]
    public function index(): Response
    {
        return $this->render('singer/index.html.twig', [
            'controller_name' => 'SingerController',
        ]);
    }

    #[Route('/singer/displaysingers', name: 'app_singerdisplay')]

    public function showSingers(SingerRepository $singerRepository): Response
    {
        $singers = $singerRepository -> findAll();
        return $this->render('/singer/displaySinger.html.twig', ['singers' => $singers]);
    }
}
