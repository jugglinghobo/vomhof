<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VomHofController extends AbstractController {

  private $navItems = [
    [ "path" => "betrieb", "label" => "Unser Betrieb"],
    [ "path" => "kontakt", "label" => "Kontakt"],
    [ "path" => "kulturen", "label" => "Kulturen"],
    [ "path" => "lohnarbeiten", "label" => "Lohnarbeiten"],
    [ "path" => "schule", "label" => "Schule auf dem Bauernhof"],
  ];

  /**
   * @Route("/", name="home")
   */
  public function home() {
    return $this->render('vomhof/home.html.twig', [
      "navItems" => $this->navItems
    ]);
  }

  /**
   * @Route("/betrieb", name="betrieb")
   */
  public function betrieb() {
    return $this->render('vomhof/betrieb.html.twig', [
      "navItems" => $this->navItems,
      "slideshowImgPaths" => [
        "/images/minified/chleehof.jpg",
        "/images/minified/chleehof_wide.jpg",
        "/images/minified/wasser.jpg",
        "/images/minified/pferde.jpg",
        "/images/minified/kaelber.jpg",
        "/images/minified/kaninchen_stroh.jpg",
        "/images/minified/kaninchen.jpg",
      ]
    ]);
  }

  /**
   * @Route("/kontakt", name="kontakt")
   */
  public function kontakt() {
    return $this->render('vomhof/kontakt.html.twig', [
      "navItems" => $this->navItems
    ]);
  }

  /**
   * @Route("/kulturen", name="kulturen")
   */
  public function kulturen() {
    return $this->render('vomhof/lohnarbeiten.html.twig', [
      "navItems" => $this->navItems,
      "slideshowImgPaths" => [
        "/images/minified/kartoffelpflanzen.jpg",
        "/images/minified/kartoffeln_band.jpg",
        "/images/minified/kartoffeln.jpg",
        "/images/minified/getreide.jpg",
        "/images/minified/maehdrescher.jpg",
        "/images/minified/rueben.jpg",
        "/images/minified/raps.jpg",
        "/images/minified/kunstwiesen.jpg",
        "/images/minified/rundballen.jpg",
      ]
    ]);
  }

  /**
   * @Route("/lohnarbeiten", name="lohnarbeiten")
   */
  public function lohnarbeiten() {
    return $this->render('vomhof/lohnarbeiten.html.twig', [
      "navItems" => $this->navItems,
      "slideshowImgPaths" => [
        "/images/minified/kalkmischer_front.jpg",
        "/images/minified/kalkmischer.jpg",
        "/images/minified/kalkstreuer.jpg",
        "/images/minified/kartoffeln_graben.jpg",
      ]
    ]);
  }

  /**
   * @Route("/schule", name="schule")
   */
  public function schule() {
    return $this->render('vomhof/schule.html.twig', [
      "navItems" => $this->navItems,
      "slideshowImgPaths" => [
        "/images/minified/schule1.jpg",
        "/images/minified/schule2.jpg",
        "/images/minified/schule3.jpg",
      ]
    ]);
  }

  /**
   * @Route("/formular", name="formular")
   */
  public function formular() {
    return new Response('What a bewitching controller we have conjured!');
  }
}
