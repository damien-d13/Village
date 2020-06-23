<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Message;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class MessageFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i=0; $i < 50; $i++) { 
           $adresse = new Message();
           $adresse->setObject($faker->words(3, true))
                    ->setDescription($faker->sentences($nb = 3, $asText = true))
                    ->setCreatedAt($faker->dateTimeAD($max = 'now', $timezone = null))
                        
           ; 
           $manager->persist($adresse);
        }

        $manager->flush();
    }
}
