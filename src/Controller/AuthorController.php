<?php

namespace App\Controller;

use App\Entity\Author; // Ensure this path is correct
use App\Form\AuthorType; // Ensure this path is correct
use App\Repository\AuthorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry; // This should be recognized
use Symfony\Component\HttpFoundation\Request; // This should be recognized
use Symfony\Component\HttpFoundation\Response; // This should be recognized
use Symfony\Component\Routing\Annotation\Route; // This should be recognized
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // This should be recognized



class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route(path:'author/showauthors', name: 'app_show')]
    public function showAuthors(AuthorRepository $authorRepository): Response
    { 
        $authors = $authorRepository->findAll();
        return $this -> render('author/display.html.twig', ['authors' => $authors]);
    }

    #[Route('/author/create', name: 'author_create')]
public function createAuthor(ManagerRegistry $managerRegistry, Request $httpRequest): Response
{    
    // Get the entity manager
    $entityManager = $managerRegistry->getManager();
    
    // Create a new Author instance
    $newAuthor = new Author();
    
    // Create the form for the Author
    $authorForm = $this->createForm(AuthorType::class, $newAuthor);
    
    // Handle the request
    $authorForm->handleRequest($httpRequest);
    
    // Check if the form is submitted and valid
    if ($authorForm->isSubmitted() && $authorForm->isValid()) {
        // Persist the new Author entity
        $entityManager->persist($newAuthor);
        $entityManager->flush(); // Save to the database
        
        // Redirect to the app_show route after adding the author
        return $this->redirectToRoute('app_show'); // Change this to match your route name
    }
    
    // Render the form in the template
    return $this->render('author/addAuthor.html.twig', [
        'form' => $authorForm->createView(), // Pass the form view to the template
    ]);
}

#[Route (path:'/author/delete/{id}', name:'app_delete')]
public function deleteAuthor(EntityManagerInterface $em,$id,AuthorRepository $rep): Response
{

    $author=$rep->find($id);
    $em->remove($author);
    $em->flush();
        
    return $this->redirectToRoute('app_show');

    
}

#[Route(path:'/author/byemail', name: 'app_show_by_email')]
public function showAuthorsByEmail(AuthorRepository $authorRepository): Response
{
    $authors = $authorRepository->listAuthorByEmail();
    return $this->render('/author/displayByEmail.html.twig', ['authors' => $authors]);
}
}

   
