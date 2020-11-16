<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Customer;

class CustomerFixtures extends Fixture {


  public function load(ObjectManager $manager) {
    $customer = new Customer();
    $customer->setFirstName("Simon");
    $customer->setLastName("Kiener");
    $customer->setAddress1("Haslerstrasse 6");
    $customer->setZipCode("3008");
    $customer->setCity("Bern");
    $customer->setPhone("079 475 01 15");
    $customer->setEmail("kiener.simon@gmail.com");
    $customer->setPaysCash(false);
    $customer->setPickUp(true);

    $manager->persist($customer);

    $manager->flush();
  }
}
