<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JeuxDonneesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        // 1- Product list
        for( $i=0 ; $i < 6; $i++) {

        }
        // 2- Vente Requests

        $manager->flush();
    }
}
