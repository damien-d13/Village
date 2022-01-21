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
        $faker = Factory::create();
        $sujets=[];

        for ($i=0; $i < 10; $i++) { 
            $sujet = new Sujet();
            $sujet->setLabel($faker->word())
                           
            ; 
            $manager->persist($sujet);
            $sujets[] = $sujet;
         }

        for ($i=0; $i < 50; $i++) { 
           $information = new Information();
           $information->setTitle($faker->word())
                    ->setSubtitle($faker->word())
                    ->setDescription($faker->word())
                    ->setSujet($faker->randomElement($sujets))  
           ; 
           $manager->persist($information);
          

        }
        

        $manager->flush();
    }
}
