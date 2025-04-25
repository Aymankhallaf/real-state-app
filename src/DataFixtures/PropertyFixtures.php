<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Property;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $property = new Property();
            $property->setTitle($faker->sentence(3));
            $property->setDescription($faker->paragraph(5));
            $property->setPrice($faker->numberBetween(100000, 1000000));
            $property->setArea($faker->numberBetween(30, 300));
            $property->setRoom($faker->numberBetween(1, 10));
            $property->setBed($faker->numberBetween(1, 10));
            $property->setBathroom($faker->numberBetween(1, 5));
            $property->setAddress($faker->address);
            $property->setCity($faker->city);
            $property->setPostalCode($faker->postcode);
            $property->setCreatedAt(new \DateTimeImmutable());
            
            // Add more fields as necessary

            $manager->persist($property);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
