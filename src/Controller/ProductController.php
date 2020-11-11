<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Product;

class ProductController extends AbstractController {
  private $logger;

  public function __construct(LoggerInterface $logger)
  {
    $this->logger = $logger;
  }

  /**
   * @Route("/verpackungsmaterial", name="verpackungsmaterial")
   */
  public function index(EntityManagerInterface $entityManager) {
    $repository = $entityManager->getRepository(Product::class);
    $product = $repository->findOneBy(['identifier' => "1"]);
  }

  /**
   * @Route("/products/new")
   */
  public function new() {
    $product = new Product();
      return new Response('Time for some Doctrine magic!');
  }
}

