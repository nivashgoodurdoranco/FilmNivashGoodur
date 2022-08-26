<?php

namespace App\Controller;

use DateTime;
use App\Entity\Film;
use App\Form\FilmFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FilmController extends AbstractController
{
    #[Route('/ajouter-un-film', name: 'create_film')]
    public function createFilm(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {

        $film = new Film();

        $form = $this->createForm(FilmFormType::class, $film);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManagerInterface->persist($film);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('default_home');

        }


        return $this->render('film/create_film.html.twig', [
            'form_film' =>$form->createView()
        ]);
    }
}
