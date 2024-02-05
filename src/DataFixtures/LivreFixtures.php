<?php

namespace App\DataFixtures;

use App\Entity\Livre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class LivreFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Créer quelques livres
        $livre1 = new Livre();
        $livre1->setAuteur($faker->lastName);
        $manager->persist($livre1);

        $livre2 = new Livre();
        $livre2->setAuteur($faker->lastName);
        $manager->persist($livre2);

        $manager->flush();

        for ($j = 0; $j <= 5; $j++):
            $livre = new Livre();

            $livre->setTitre($faker->sentence())
                ->setEditeur($faker->sentence())
                ->setAuteur($faker->randomElement([$livre1, $livre2]));

            $manager->persist($livre);
        endfor;

        $manager->flush();
    }
}
