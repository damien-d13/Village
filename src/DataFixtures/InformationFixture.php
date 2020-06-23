<?php

namespace App\DataFixtures;

use App\Entity\Information;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class InformationFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 50; $i++) { 
           $adresse = new Information();
           $adresse->setTitle($faker->words(3, true))
                    ->setSubtitle($faker->sentence($nbWords = 6, $variableNbWords = true))
                    ->setDescription($faker->sentences($nb = 3, $asText = true))
                          
           ; 
           $manager->persist($adresse);
        }

        $manager->flush();
    }
}
