<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

use App\Form\ProductType;
use App\Entity\Product;

/**
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class ProductController extends AbstractController {

  /**
   * @Route("/admin/products", name="products", methods="GET")
   */
  public function index(EntityManagerInterface $entityManager, PaginatorInterface $paginator, Request $request) {
    $repository = $entityManager->getRepository(Product::class);

    $q = $request->query->get('q');
    $queryBuilder = $repository->getWithSearchQueryBuilder($q);

    $pagination = $paginator->paginate(
      $queryBuilder, /* query NOT result */
      $request->query->getInt('page', 1), /*page number*/
      10 /*limit per page*/
    );

    return $this->render("admin/products/index.html.twig", [
      "pagination" => $pagination,
      "lastQuery" => $q
    ]);
  }

  /**
   * @Route("/admin/products/search", name="product_search", methods="GET")
   */
  public function search(EntityManagerInterface $entityManager, Request $request) {
    $repository = $entityManager->getRepository(Product::class);
    $q = $request->query->get('q');
    $queryBuilder = $repository->getWithSearchQueryBuilder($q);
    $products = $queryBuilder->getQuery()->getResult();

    $encoders = [new JsonEncoder()];
    $normalizers = [new ObjectNormalizer()];
    $serializer = new Serializer($normalizers, $encoders);
    $jsonCustomers = $serializer->serialize($products, 'json');

    $response = new JsonResponse();
    $response->setData($jsonCustomers);
    return $response;
  }

  /**
   * @Route("/admin/products/new", name="create_product", methods={"GET", "POST"})
   */
  public function new(Request $request) {
    $product = new Product();

    $form = $this->createForm(ProductType::class, $product);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      return $this->handleFormSuccess($form);
    }

    return $this->render("admin/products/new.html.twig", [
      "form" => $form->createView()
    ]);
  }

  /**
   * @Route("/admin/products/{id}", name="edit_product", requirements={"id":"\d+"}, methods={"GET", "POST"})
   */
  public function edit(Product $product, Request $request) {
    $form = $this->createForm(ProductType::class, $product);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      return $this->handleFormSuccess($form);
    }

    return $this->render("admin/products/edit.html.twig", [
      "form" => $form->createView()
    ]);
  }

  /**
   * @Route("/admin/products/{id}", name="delete_product", requirements={"id":"\d+"}, methods="DELETE")
   */
  public function delete(Product $product) {
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($product);
    $entityManager->flush();

    return $this->redirectToRoute("products");
  }

  private function handleFormSuccess($form) {
    $product = $form->getData();

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($product);
    $entityManager->flush();

    return $this->redirectToRoute('products');
  }
}

