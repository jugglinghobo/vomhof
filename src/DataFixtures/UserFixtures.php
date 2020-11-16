<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use App\Entity\User;

class UserFixtures extends Fixture {


  private $passwordEncoder;

  public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
    $this->passwordEncoder = $passwordEncoder;
  }

  public function load(ObjectManager $manager) {
    $user = new User();
    $user->setUsername("VomHof");
    $user->setPassword($this->passwordEncoder->encodePassword(
      $user,
      'chleehof1'
    ));

    $user->setVatPercentage(7.7);
    $user->setBulkDiscountPercentage(3);
    $user->setBulkDiscountThreshold(300);
    $user->setSpringDiscountActive(true);
    $user->setSpringDiscountPercentage(5);
    $user->setCashDiscountPercentage(3);
    $user->setVatNumber('CHE-110.836.851');
    $user->setIban('CH58 0631 3640 3035 2090 2');

    $manager->persist($user);

    $manager->flush();
  }
}
