<?php

namespace App\Controller;

use App\Repository\AuthorRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    #[Route('/book/aff', name: 'app_bookaff')]
      public function findRomanceBooks(EntityManagerInterface $entityManager): Response
{
    $query = $entityManager->createQuery('
        SELECT b 
        FROM App\Entity\Book b
        WHERE b.category = :category
    ');

    $query->setParameter('category', 'Romance');

    $books = $query->getResult();
    $romanceBookCount = count($books); // Count the number of romance books

    return $this->render('book/affbook.html.twig', [
        'books' => $books,
        'romanceBookCount' => $romanceBookCount, // Pass the count to the template
    ]);
    }


    
}