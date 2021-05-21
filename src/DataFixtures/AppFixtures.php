<?php

namespace App\DataFixtures;
use App\Entity\Actor;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Studio;
use App\Entity\User;
use Faker;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use \joshtronic\LoremIpsum;
use Symfony\Component\Security\Core\Encoder\SodiumPasswordEncoder;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $faker = Faker\Factory::create();
        $lipsum = new \joshtronic\LoremIpsum();


        $actors = [];

        for($i=0; $i <15; $i++){
            $actor = new Actor();
            $actor->setFirstName($faker->firstName());
            $actor->setLastName($faker->lastName());
            $actor->setImage($faker->imageUrl());
            $manager->persist($actor);
            $actors[] = $actor;
        }
        $genres = [];

        for($i=0; $i <15; $i++){
            $genre = new Genre();
            $genre->setName($lipsum->words(1));
            $manager->persist($genre);
            $genres[] = $genre;
        }

        $studios = [];

        for($i=0; $i <10; $i++){
            $studio = new Studio();
            $studio->setName($faker->lastName());
            $manager->persist($studio);
            $studios[] = $studio;
        }

        $users = [];

        for($i=0; $i <20; $i++){
            $user = new User();
            $user->setUsername($faker->username);
            $user->setPassword($faker->password());
            $manager->persist($user);
            $users[] = $user;
        }

        $user->setUsername('admin');
        $user->setPassword('admin');
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);
        $users[] = $user;
        $movies = [];

        for($i=0; $i <50; $i++){
            $movie = new Movie();
            $movie->setName($lipsum->words(10));
            $movie->setOrginalName($lipsum->words(10));
            $movie->setReleaseDate($faker->numberBetween($min = 1900, $max = 2020));
            $movie->setSynopsis($lipsum->paragraphs(2));
            $movie->setSeen($faker->boolean(50));
            $movie->setWatchList($faker->boolean(50));
            $movie->setImage('https://www.themoviedb.org/t/p/original/h06jDZB4Y9YQJiSGTcUwbhuiUrB.jpg');
            $movie->addActor($actors[$faker->numberBetween(0,14)]);
            $movie->addGenre($genres[$faker->numberBetween(0,14)]);
            $movie->addStudio($studios[$faker->numberBetween(0,9)]);
            $manager->persist($movie);
            $movies[] = $movie;
        }
        $manager->flush();
    }
}
