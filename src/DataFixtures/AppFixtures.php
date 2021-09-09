<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        for($i=0; $i<3; $i++){
            $product = new Product();
            $product->setName($faker->word());
            $product->setDescription($faker->sentence(5));
            $product->setReference($faker->word());
            $product->setPrice("15,5");

            $manager->persist($product);
        }

        $manager->flush();
    }
}
