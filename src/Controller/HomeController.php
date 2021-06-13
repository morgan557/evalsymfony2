<?php

namespace App\Controller;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Actor;
use App\Entity\Studio;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\ActorRepository;
use App\Repository\GenreRepository;
use App\Repository\MovieRepository;
use App\Repository\StudioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class HomeController extends AbstractController
{
    private $repoMovie;

    public function __construct(MovieRepository $repoMovie,GenreRepository $repoGenre, ActorRepository $repoActor, StudioRepository $repoStudio){
        $this->repoMovie = $repoMovie;
        $this->repoGenre = $repoGenre;
        $this->repoactor = $repoActor;
        $this->repoStudio = $repoStudio;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(GenreRepository $repoGenre, ActorRepository $repoActor, StudioRepository $repoStudio, UserRepository $repoUser): Response
    {
     $movies = $this->repoMovie->findAll();
     $genres = $repoGenre->findAll();
     $actors = $repoActor->findAll();
     $studios = $repoStudio->findAll();
     $users = $repoUser->findAll();
     
       
        return $this->render("home/index.html.twig",[
            'movies' => $movies,
            'genres' => $genres,
            'actors' => $actors,
            'studios' => $studios,
            'users'=>$users
        ]);
    }
    
    // fonction qui ne marche pour editer les films 
     /**
     * @Route("/edit/{id}", name="edit_movie")
     * 
     */
    public function updateMovie (Request $request,$id){
        $movie=$this->getDoctrine()->getRepository(Movie::class);
        $movie = $movie->find($id);

        if(!$movie){
            throw $this->createNotFoundException(
                'There are no movies with the following id: ' . $id
            ); 
        }
        $form = $this->createFormBuilder($movie)
        ->add('name', TextType::class)
        ->add('synopsis', TextareaType::class)
        ->add('seen', CheckboxType::class)
        ->add('save', SubmitType::class, array('label' => 'Editer'))
        ->getForm();
    $form->handleRequest($request);
    if ($form->isSubmitted()) {
        $em = $this->getDoctrine()->getManager();
        $movie = $form->getData();
        $em->flush();
        return $this->redirect($this->generateUrl('home'));
    }
    return $this->render(
        'home/edit.html.twig',
        array('form' => $form->createView())
    );
}
    
           /**
     * @Route("/about" , name="about")
     */
    public function about(): Response
    {
        return $this->render("home/about.html.twig");
    } 

        /**
     * @Route("/genre", name="genre")
     */
    public function genre(): Response
    {
        $genres = $this->repoGenre->findAll();
        return $this->render('home/genre.html.twig',[
            'genres'=>$genres
        ]);
    }
    /**
     * @Route("/showByGenre/{id}", name="showByGenre")
     */
    public function showByGenre(Genre $genre): Response
    {
        if(!$genre)
            return $this->redirectToRoute('home');
        return $this->render("home/index.html.twig",[
            'movies'=>$genre->getMovies(),
        ]);
    }
     

       /**
     * @Route("/actor", name="actor")
     */
    public function actor(): Response
    {
        $actor = $this->repoactor->findAll();
        return $this->render('home/actor.html.twig',[
            'actors'=>$actor
        ]);
    }

      /**
     * @Route("/showByActor/{id}/", name="showByActor")
     */
    public function showByActor(Actor $actor): Response
    {
        if(!$actor)
            return $this->redirectToRoute('home');
        return $this->render("home/index.html.twig",[
            'movies'=>$actor->getMovies(),
        ]);
    }


        /**
     * @Route("/studio", name="studio")
     */
    public function studio(): Response
    {
        $studio = $this->repoStudio->findAll();
        return $this->render('home/studio.html.twig',[
            'studios'=>$studio
        ]);
    }
       /**
     * @Route("/showByStudio/{id}", name="showByStudio")
     */
    public function showByStudio(Studio $studio): Response
    {
        if(!$studio)
            return $this->redirectToRoute('home');
        return $this->render("home/index.html.twig",[
            'movies'=>$studio->getMovies(),
        ]);
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
     * @Route("/DisplayMovieNotSeen/", name="movienotseen")
     */
    public function DisplayMovieNotSeen(MovieRepository $repoMovie): Response
    { $movies = $this->repoMovie->findBy(array('seen'=>'false'));
        if(!$movies)
            return $this->redirectToRoute('home');
             
        return $this->render("home/movienotseen.html.twig",[
            'movies'=>$movies
        ]);
    }
}