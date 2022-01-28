<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public const USER_REFERENCE = 'user';

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 1; ++$i) {
            $user = new User();
            $password = $this->encoder->hashPassword($user, '123456');
            $user->setEmail('user@test.com')
                ->setUsername('dams')
                ->setPassword($password)
                ->setAgreeTerms(true)
            ;

            $manager->persist($user);
            $this->addReference(self::USER_REFERENCE, $user);
        }
        $manager->flush();
    }
}
