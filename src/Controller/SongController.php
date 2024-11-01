<?php

namespace App\Controller;
use App\Form\SongType;
use Doctrine\ORM\EntityManagerInterface;
 
use App\Repository\SongRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Song;

class SongController extends AbstractController
{
    #[Route('/song', name: 'app_song')]
    public function index(): Response
    {
        return $this->render('song/index.html.twig', [
            'controller_name' => 'SongController',
        ]);
    }

    #[Route('/song/displaysongs', name: 'app_songdisplay')]
    public function showSongs(SongRepository $songRepository): Response
    {
        $songs = $songRepository->findAll();
        return $this->render('song/displaySong.html.twig', ['songs' => $songs]);
    }



    #[Route('/song/displaysongs/{id}', name: 'app_songupdate')]    
    public function update(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        
        $song = $entityManager->getRepository(Song::class)->find($id);

        
        if (!$song) {
            throw $this->createNotFoundException('No song found for id ' . $id);
            
        }

        $form = $this->createForm(SongType::class, $song);
        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->flush();

            
            return $this->redirectToRoute('app_songdisplay'); // Replace with your route
        }

       
        return $this->render('song/updateSong.html.twig', [
            'form' => $form->createView(),
            'song' => $song,
        ]);
    }
}
       

