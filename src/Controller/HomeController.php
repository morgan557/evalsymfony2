<?php

namespace App\Controller;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Repository\GenreRepository;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $repoMovie;

    public function __construct(MovieRepository $repoMovie){
        $this->repoMovie = $repoMovie;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(GenreRepository $repoGenre): Response
    {
     $movies = $this->repoMovie->findAll();
     $genres = $repoGenre->findAll();

        return $this->render("home/index.html.twig",[
            'movies' => $movies,
            'genres' => $genres
        ]);
    }
           /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        return $this->render("home/about.html.twig");
    }

     /**
     * @Route("/view/{id}", name="view")
     */
    public function view(Movie $movie): Response
    {
        if(!$movie)
            return $this->redirectToRoute('home');
        return $this->render("home/view.html.twig",[
            'movie'=>$movie
        ]);
    }

    /**
     * @Route("/showByCategory/{id}", name="showByCategory")
     */
    public function showByGenre(Genre $genre): Response
    {
        if(!$genre)
            return $this->redirectToRoute('home');
        return $this->render("home/index.html.twig",[
            'movies'=>$genre->getMovies(),
        ]);
    }
}