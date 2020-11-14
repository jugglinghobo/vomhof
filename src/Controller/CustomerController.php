<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Knp\Component\Pager\PaginatorInterface;

use App\Form\CustomerType;
use App\Entity\Customer;

/**
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class CustomerController extends AbstractController {

  /**
   * @Route("/admin/customers", name="customers", methods="GET")
   */
  public function index(EntityManagerInterface $entityManager, PaginatorInterface $paginator, Request $request) {
    $repository = $entityManager->getRepository(Customer::class);

    $q = $request->query->get('q');
    $queryBuilder = $repository->getWithSearchQueryBuilder($q);

    $pagination = $paginator->paginate(
      $queryBuilder, /* query NOT result */
      $request->query->getInt('page', 1), /*page number*/
      10 /*limit per page*/
    );

    return $this->render("admin/customers/index.html.twig", [
      "pagination" => $pagination,
      "lastQuery" => $q
    ]);
  }

  /**
   * @Route("/admin/customers/new", name="create_customer", methods={"GET", "POST"})
   */
  public function new(Request $request) {
    $customer = new Customer();

    $form = $this->createForm(CustomerType::class, $customer);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      return $this->handleFormSuccess($form);
    }

    return $this->render("admin/customers/new.html.twig", [
      "form" => $form->createView()
    ]);
  }

  /**
   * @Route("/admin/customers/{id}", name="edit_customer", requirements={"id":"\d+"}, methods={"GET", "POST"})
   */
  public function edit(Customer $customer, Request $request) {
    $form = $this->createForm(CustomerType::class, $customer);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      return $this->handleFormSuccess($form);
    }

    return $this->render("admin/customers/edit.html.twig", [
      "form" => $form->createView()
    ]);
  }

  /**
   * @Route("/admin/customers/{id}", name="delete_customer", requirements={"id":"\d+"}, methods="DELETE")
   */
  public function delete(Customer $customer) {
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($customer);
    $entityManager->flush();

    return $this->redirectToRoute("customers");
  }

  private function handleFormSuccess($form) {
    $customer = $form->getData();

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($customer);
    $entityManager->flush();

    return $this->redirectToRoute('customers');
  }
}


