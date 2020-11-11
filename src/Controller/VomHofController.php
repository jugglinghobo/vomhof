<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

class VomHofController extends AbstractController {

  private $navItems = [
    [ "path" => "betrieb", "label" => "Unser Betrieb"],
    [ "path" => "kontakt", "label" => "Kontakt"],
    [ "path" => "kulturen", "label" => "Kulturen"],
    [ "path" => "lohnarbeiten", "label" => "Lohnarbeiten"],
    [ "path" => "schule", "label" => "Schule auf dem Bauernhof"],
    [ "path" => "verpackungsmaterial", "label" => "Verpackungsmaterial"],
  ];

  private $productCategories = [
    "schalen_koerbe" => [
      "id" => "schalen_koerbe",
      "name" => "Schalen & Körbe",
      "path" => "1_schalen_und_koerbe",
      "products" => [
        [ 'name' => 'Fruchtschalen', 'img' => 'fruchtschalen.jpg'],
        [ 'name' => 'Spankörbe mit Henkel', 'img' => 'korb_henkel.jpg'],
        [ 'name' => 'Spankörbe ohne Henkel', 'img' => 'korb.jpg'],
        [ 'name' => 'Geschenkkörbe', 'img' => 'geschenkkorb.jpg'],
        [ 'name' => 'Eierverpackungen', 'img' => 'eierverpackungen.png'],
      ]
    ],
    "taschen_beutel" => [
      "id" => "taschen_beutel",
      "name" => 'Taschen & Beutel',
      "path" => '2_taschen_beutel',
      "products" => [
        [ 'name' => 'Früchtebeutel', 'img' => 'fruechtebeutel_einzeln.jpg'],
        [ 'name' => 'Knotenbeutel', 'img' => 'knotenbeutel.jpg'],
        [ 'name' => 'Früchte-Tragtaschen', 'img' => 'fruechte_tragtaschen.jpg'],
        [ 'name' => 'Papiertragtaschen', 'img' => 'papiertragtaschen.jpg'],
        [ 'name' => 'Brotpapiersäcke', 'img' => 'brotpapiersack.jpg'],
        [ 'name' => 'Vakuumbeutel', 'img' => 'vakuumbeutel.jpg'],
        [ 'name' => 'Frischhaltebeutel', 'img' => 'frischhaltebeutel.jpg'],
        [ 'name' => 'Geschenktaschen', 'img' => 'geschenktasche.jpg'],
      ]
    ],
    "glaswaren" => [
      "id" => "glaswaren",
      "name" => 'Glaswaren',
      "path" => '3_glaswaren',
      "products" => [
        [ 'name' => 'Konfitüregläser', 'img' => 'konfituereglaeser.png'],
        [ 'name' => 'Sirupflaschen', 'img' => 'sirupflaschen.png'],
        [ 'name' => 'Likörflaschen', 'img' => 'likoerflaschen.png'],
        [ 'name' => 'Spirituoseflaschen', 'img' => 'spirituosenflaschen.png'],
        [ 'name' => 'Konfitueredeckel Schwarz', 'img' => 'schraubdeckel_schwarz.png'],
        [ 'name' => 'Konfitueredeckel Schwarz', 'img' => 'schraubdeckel_weiss.png'],
        [ 'name' => 'Sirupdeckel', 'img' => 'deckel_sirupflaschen.png'],
        [ 'name' => 'Korkzapfen', 'img' => 'korkzapfen.png'],
        [ 'name' => 'Verschluss Spirituosenflaschen', 'img' => 'verschluss_spirituosen.png'],
      ]
    ],
    "beschriftungen" => [
      "id" => "beschriftungen",
      "name" => 'Beschriftungen',
      "path" => '4_beschriftungen',
      "products" => [
        [ 'name' => 'Schilder', 'img' => 'beschriftungen_schilder.jpg'],
        [ 'name' => 'Beschriftungsmaterial', 'img' => 'beschriftungsmaterial.jpg'],
      ]
    ],
    "diverses" => [
      "id" => "diverses",
      "name" => 'Diverses',
      "path" => '5_diverses',
      "products" => [
        [ 'name' => 'Etiketten "Vom Hof"', 'img' => 'etiketten_vom_hof.jpg'],
        [ 'name' => 'Etiketten "Hausgemacht"', 'img' => 'siegeletiketten_hausgemacht.jpg'],
        [ 'name' => 'Klebeband', 'img' => 'klebeband.jpg'],
        [ 'name' => 'Quittierblöcke', 'img' => 'quittierblock.jpg'],
        [ 'name' => 'Wickelpapiere', 'img' => 'wickelpapier.jpg'],
        [ 'name' => 'Petflasche', 'img' => 'petflasche.png'],
        [ 'name' => 'Deckel Petflasche', 'img' => 'deckel_petflasche.png'],
        [ 'name' => 'Ersatzbeutel Most', 'img' => 'mostbeutel.png'],
      ]
    ]
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
   * @Route("/verpackungsmaterial", name="verpackungsmaterial")
   */
  public function verpackungsmaterial() {
    return $this->render('vomhof/verpackungsmaterial.html.twig', [
      "navItems" => $this->navItems,
      "productCategories" => $this->productCategories,
    ]);
  }

  /**
   * @Route("/formular", name="formular")
   */
  public function formular() {
    $response = new BinaryFileResponse('formular.pdf');
    $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_INLINE,'verpackungsmaterial.pdf');
    return $response;
  }
}
