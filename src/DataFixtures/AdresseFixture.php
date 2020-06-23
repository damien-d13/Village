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

        $faker = Factory::create('fr_FR');
        $adresses = [];
        for ($i=0; $i < 50; $i++) { 
           $adresse = new Adresse();
           $adresse->setLabel($faker->words(3, true))
                    ->setNumber($faker->buildingNumber)
                    ->setStreet($faker->streetName)
                    ->setCity($faker->city)
                    ->setCountry($faker->country)
                    ->setCodePostal($faker->postcode)      
           ; 
          /* $this->setReference(self::FIRST_ADDRESS, $adresse);*/
           $manager->persist($adresse);
           $adresses[] = $adresse;
        }

        for ($i=0; $i < 50; $i++) { 
            $evenement = new Evenement();
            $evenement->setLabel($faker->words(3, true))
                     ->setDescription($faker->buildingNumber)
                     ->setDate($faker->dateTimeAD($max = 'now', $timezone = null))
                     ->setCreatedAt($faker->dateTimeAD($max = 'now', $timezone = null))
                     ->setUpdatedAt($faker->dateTimeAD($max = 'now', $timezone = null))
                     ->setLocalisation($faker->url)
                     ->setAdresse($faker->randomElement($adresses)) 
            ; 
            $manager->persist($evenement);
         }


        $manager->flush();
    }
}
