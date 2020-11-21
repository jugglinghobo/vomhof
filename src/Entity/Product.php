<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product {

  use TimestampableEntity;

  public function __toString() {
    return $this->getIdentifier() . ' ' . $this->getName();
  }

  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
  private $id;


  /**
   * @ORM\Column(type="string", length=255, unique=true)
   * @Assert\NotBlank
   */
  private $identifier;

  /**
   * @ORM\Column(type="string", length=255)
   * @Assert\NotBlank
   */
  private $name;

  /**
   * @ORM\Column(type="float")
   * @Assert\NotBlank
   */
  private $price;

  /**
   * @ORM\OneToMany(targetEntity=InvoiceItem::class, mappedBy="product")
   */
  private $invoiceItems;

  public function __construct()
  {
      $this->invoiceItems = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getName(): ?string
  {
    return $this->name;
  }

  public function setName(string $name): self
  {
    $this->name = $name;

    return $this;
  }

  public function getPrice(): ?float
  {
    return $this->price;
  }

  public function setPrice(float $price): self
  {
    $this->price = $price;

    return $this;
  }

  public function getIdentifier(): ?string
  {
    return $this->identifier;
  }

  public function setIdentifier(string $identifier): self
  {
    $this->identifier = $identifier;

    return $this;
  }

  /**
   * @return Collection|InvoiceItem[]
   */
  public function getInvoiceItems(): Collection
  {
      return $this->invoiceItems;
  }

  public function addInvoiceItem(InvoiceItem $invoiceItem): self
  {
      if (!$this->invoiceItems->contains($invoiceItem)) {
          $this->invoiceItems[] = $invoiceItem;
          $invoiceItem->setProduct($this);
      }

      return $this;
  }

  public function removeInvoiceItem(InvoiceItem $invoiceItem): self
  {
      if ($this->invoiceItems->removeElement($invoiceItem)) {
          // set the owning side to null (unless already changed)
          if ($invoiceItem->getProduct() === $this) {
              $invoiceItem->setProduct(null);
          }
      }

      return $this;
  }
}
