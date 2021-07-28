<?php

namespace App\Controller;

use App\Entity\Film;
use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    /**
     * @Route("/film", name="film")
     */
    public function index(FilmRepository $repo): Response
    {
        $films = $repo->findAll();

        return $this->render('film/index.html.twig', [
            "films" => $films,
        ]);
    }

    /**
     * @Route ("/film/{id}", name="film_show")
     */
    public function show(Film $film): Response
    {
        return  $this->render('film/film.html.twig', [
            'film' => $film
    ]);
    }


    /**
     * @Route("/film/create", name="film_create", priority=2)
     * @Route("/film/{id}/edition", name="film_edit", priority=2)
     */
    public function create(Film $film = null): Response
    {
        $modeEdition = true;

        if($film) {
            $film = new Film();
            $modeEdition = false;
        }



    }
}
