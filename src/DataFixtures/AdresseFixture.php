<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Adresse;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AdresseFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('fr_FR');
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
        }
        $manager->flush();
    }
}
