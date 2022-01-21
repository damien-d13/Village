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
           $message = new Message();
           $message->setObject($faker->word())
                    ->setDescription($faker->word())
                    ->setCreatedAt($faker->dateTime())
                        
           ; 
           $manager->persist($message);
        }

        $manager->flush();
    }
}
