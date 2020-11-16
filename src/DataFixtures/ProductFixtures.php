<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Product;

class ProductFixtures extends Fixture {


  public function load(ObjectManager $manager) {
    $product = new Product();
    $product->setIdentifier("1");
    $product->setName("Block: Lieferschein, Rechnung, Quittung");
    $product->setPrice(4.70);

    $manager->persist($product);

    $manager->flush();
  }
}
