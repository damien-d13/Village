<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Adresse;
use App\Entity\Evenement;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AdresseFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create();
        $adresses = [];
        for ($i=0; $i < 50; $i++) { 
           $adresse = new Adresse();
           $adresse->setLabel($faker->word())
                    ->setNumber($faker->randomDigit())
                    ->setStreet($faker->streetName())
                    ->setCity($faker->city())
                    ->setCountry($faker->country())
                    ->setCodePostal($faker->postcode())
           ;
          /* $this->setReference(self::FIRST_ADDRESS, $adresse);*/
           $manager->persist($adresse);
           $adresses[] = $adresse;
        }

        for ($i=0; $i < 50; $i++) { 
            $evenement = new Evenement();
            $evenement->setLabel($faker->word())
                     ->setDescription($faker->sentence())
                     ->setDate($faker->dateTime())
                     ->setCreatedAt($faker->dateTime())
                     ->setUpdatedAt($faker->dateTime())
                     ->setLocalisation($faker->url())
                     ->setAdresse($faker->randomElement($adresses)) 
            ; 
            $manager->persist($evenement);
         }


        $manager->flush();
    }
}
