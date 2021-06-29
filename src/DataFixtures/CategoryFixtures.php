<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Artist;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $faker = Factory::create('fr_FR');
        $categoryNames = ['Mélodique', 'Industrielle', 'Groovy', 'Deep', 'Détroit'];
        $concertIndex = 1;

        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->setName($categoryNames[$i]);
            $manager->persist($category);

            for ($j = 0; $j < rand(3, 8); $j++) {
                $concert = rand(1, 5) <= 2 ? $concertIndex : 0;
                $artiste = new Artist();
                $artiste->setName($faker->firstName())
                    ->setDescription($faker->text())
                    ->setCategory($category)
                    ->setConcert($concert);;
                $manager->persist($artiste);
            }
        }

        $manager->flush();
    }
}
