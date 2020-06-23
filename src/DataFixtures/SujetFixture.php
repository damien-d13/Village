<?php

namespace App\DataFixtures;

use App\Entity\Sujet;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SujetFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 10; $i++) { 
           $adresse = new Sujet();
           $adresse->setLabel($faker->words(3, true))
                          
           ; 
           $manager->persist($adresse);
        }

        $manager->flush();
    }
}
