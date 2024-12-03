<?php

namespace App\DataFixtures;

use App\Entity\Zone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $zone1 = new Zone();
        $zone1->setNom("Conserves");
        $zone1->setPosition(1);
        $manager->persist($zone1);

        $zone2 = new Zone();
        $zone2->setNom("Fruits et Légumes");
        $zone2->setPosition(2);
        $manager->persist($zone2);

        $zone3 = new Zone();
        $zone3->setNom("Surgelés");
        $zone3->setPosition(3);
        $manager->persist($zone3);

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
