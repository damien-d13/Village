<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Adresse;
use App\Entity\Evenement;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EvenementFixture extends Fixture
{
    public function load(ObjectManager $manager/*, Adresse $adresse*/)
    { 
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 50; $i++) { 
           $evenement = new Evenement();
           $evenement->setLabel($faker->words(3, true))
                    ->setDescription($faker->buildingNumber)
                    ->setDate($faker->dateTimeAD($max = 'now', $timezone = null))
                    ->setCreatedAt($faker->dateTimeAD($max = 'now', $timezone = null))
                    ->setUpdatedAt($faker->dateTimeAD($max = 'now', $timezone = null))
                    ->setLocalisation($faker->url)
                    /*->setAdresse($this->getReference(AdresseFixture::FIRST_ADDRESS))    */ 
           ; 
           $manager->persist($evenement);
        }

        $manager->flush();
    }
}
