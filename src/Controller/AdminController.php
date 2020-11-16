<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class AdminController extends AbstractController {

  /**
   * @Route("/admin", name="admin_root")
   */
  public function root() {
    return $this->redirectToRoute('products');
  }
}
