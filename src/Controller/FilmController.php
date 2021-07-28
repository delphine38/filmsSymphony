<?php

namespace App\Controller;

use App\Entity\Film;
use App\Form\FilmType;
use App\Repository\FilmRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

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
        return $this->render('film/film.html.twig', [
            'film' => $film
        ]);
    }



    /**
     * @Route("/film/create", name="film_create", priority=2)
     */
    public function create(Request $requete, EntityManagerInterface $manager, UserInterface $user): Response
    {

        $film = new Film();
        $formulaire = $this->createForm(FilmType::class, $film);

        $formulaire->handleRequest($requete);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $film->setName($user);
            $film->setAnneesortie(new \DateTime());


            $manager->persist($film);
            $manager->flush();

            return $this->redirectToRoute('film');

        }

        return $this->render('film/create.html.twig', [
            'formulaire' => $formulaire->createView(),
        ]);
    }

    /**
     * @Route ("film/delete{id}", name="delete")
     */
    public function delete(Film $film, EntityManagerInterface $manager, UserInterface $user): Response
    {
        if ($user == $film->getUser()){
            $manager->remove(($film));
            $manager->flush();
        }
        return $this->redirect('/film');
    }




}
