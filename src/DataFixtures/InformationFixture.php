<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Sujet;
use App\Entity\Information;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class InformationFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $sujets=[];

        for ($i=0; $i < 10; $i++) { 
            $sujet = new Sujet();
            $sujet->setLabel($faker->words(3, true))
                           
            ; 
            $manager->persist($sujet);
            $sujets[] = $sujet;
         }

        for ($i=0; $i < 50; $i++) { 
           $information = new Information();
           $information->setTitle($faker->words(3, true))
                    ->setSubtitle($faker->sentence($nbWords = 6, $variableNbWords = true))
                    ->setDescription($faker->sentences($nb = 3, $asText = true))
                    ->setSujet($faker->randomElement($sujets))  
           ; 
           $manager->persist($information);
          

        }
        

        $manager->flush();
    }
}
