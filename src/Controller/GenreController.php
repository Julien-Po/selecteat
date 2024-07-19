<?php

namespace App\Controller;

use App\Entity\Genre;
use App\Form\GenreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GenreController extends AbstractController
{
    #[Route('admin/newgenre', name: 'app_genre')]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {
       $genre = new Genre();
       $form = $this->createForm(GenreType::class, $genre);

       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {
        $genre = $form->getData();
        $manager->persist($genre);
        $manager->flush();

        // $this->redirectToRoute();
       }
       return $this->render('genre/new.html.twig', [
        'form' => $form->createView()
       ]);
    }
}
