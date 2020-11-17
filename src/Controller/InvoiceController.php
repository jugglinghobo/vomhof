<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Knp\Component\Pager\PaginatorInterface;

use App\Form\InvoiceType;
use App\Entity\Invoice;
use App\Entity\User;

/**
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class InvoiceController extends AbstractController {

  /**
   * @Route("/admin/invoices", name="invoices", methods="GET")
   */
  public function index(EntityManagerInterface $entityManager, PaginatorInterface $paginator, Request $request) {
    $repository = $entityManager->getRepository(Invoice::class);


    $queryBuilder = $repository->findAllQueryBuilder();

    $pagination = $paginator->paginate(
      $queryBuilder, /* query NOT result */
      $request->query->getInt('page', 1), /*page number*/
      10 /*limit per page*/
    );

    return $this->render("admin/invoices/index.html.twig", [
      "pagination" => $pagination,
    ]);
  }

  /**
   * @Route("/admin/invoices/new", name="create_invoice", methods={"GET", "POST"})
   */
  public function new(Request $request) {
    $invoice = new Invoice();
    $invoice = $this->setDefaultValues($invoice, $this->getUser());

    $form = $this->createForm(InvoiceType::class, $invoice, ['user' => $this->getUser()]);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      return $this->handleFormSuccess($form);
    }

    return $this->render("admin/invoices/new.html.twig", [
      "user" => $this->getUser(),
      "form" => $form->createView()
    ]);
  }

  /**
   * @Route("/admin/invoices/{id}", name="edit_invoice", requirements={"id":"\d+"}, methods={"GET", "POST"})
   */
  public function edit(Invoice $invoice, Request $request) {
    $form = $this->createForm(InvoiceType::class, $invoice, ['user' => $this->getUser()]);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      return $this->handleFormSuccess($form);
    }

    return $this->render("admin/invoices/edit.html.twig", [
      "user" => $this->getUser(),
      "form" => $form->createView()
    ]);
  }

  /**
   * @Route("/admin/invoices/{id}", name="delete_invoice", requirements={"id":"\d+"}, methods="DELETE")
   */
  public function delete(Invoice $invoice) {
    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($invoice);
    $entityManager->flush();

    return $this->redirectToRoute("invoices");
  }

  private function handleFormSuccess($form) {
    $invoice = $form->getData();

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($invoice);
    $entityManager->flush();

    return $this->redirectToRoute('invoices');
  }

  private function setDefaultValues(Invoice $invoice, User $user): Invoice {
    $invoice->setCashDiscount(0);
    $invoice->setBulkDiscount(0);
    $invoice->setBulkDiscountThreshold($user->getBulkDiscountThreshold());
    $invoice->setSpringDiscount(0);
    $invoice->setVatPercentage($user->getVatPercentage());
    $invoice->setVatAmount(0);
    $invoice->setShippingCost(0);

    return $invoice;
  }
}


