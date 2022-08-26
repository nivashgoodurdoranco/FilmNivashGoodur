<?php

namespace App\Controller;

use App\Entity\Film;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'default_home')]
    public function index(EntityManagerInterface $entityManagerInterface): Response
    {
        $films = $entityManagerInterface->getRepository(Film::class)->findAll();

        return $this->render('default/home.html.twig', [
            'films' => $films
        ]);
    }
}
