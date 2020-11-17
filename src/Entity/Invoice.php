<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=InvoiceRepository::class)
 */
class Invoice {

  use TimestampableEntity;

  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   * @Assert\NotBlank
   */
  private $firstName;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   * @Assert\NotBlank
   */
  private $lastName;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   */
  private $company;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   * @Assert\NotBlank
   */
  private $address1;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   */
  private $address2;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   * @Assert\NotBlank
   */
  private $zipCode;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   * @Assert\NotBlank
   */
  private $city;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   */
  private $phone;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   */
  private $email;

  /**
   * @ORM\Column(type="boolean")
   */
  private $paidCash;

  /**
   * @ORM\Column(type="decimal", precision=8, scale=2, options={"default": 0})
   */
  private $cashDiscount;

  /**
   * @ORM\Column(type="decimal", precision=8, scale=2, options={"default": 0})
   */
  private $bulkDiscount;

  /**
   * @ORM\Column(type="integer", options={"default": 300})
   */
  private $bulkDiscountThreshold;

  /**
   * @ORM\Column(type="decimal", precision=8, scale=2, options={"default": 0})
   */
  private $springDiscount;

  /**
   * @ORM\Column(type="decimal", precision=8, scale=2)
   */
  private $vatPercentage;

  /**
   * @ORM\Column(type="decimal", precision=8, scale=2)
   */
  private $vatAmount;

  /**
   * @ORM\Column(type="decimal", precision=8, scale=2, options={"default": 0})
   */
  private $shippingCost;

  /**
   * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="invoices")
   * @ORM\JoinColumn(nullable=false)
   */
  private $customer;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getName(): ?string
  {
    if ($this->getCompany() != '') {
      return $this->getCompany();
    } else {
      return $this->getLastName() . ' ' .$this->getFirstName();
    }
  }

  public function getFirstName(): ?string
  {
    return $this->firstName;
  }

  public function setFirstName(?string $firstName): self
  {
    $this->firstName = $firstName;

    return $this;
  }

  public function getLastName(): ?string
  {
    return $this->lastName;
  }

  public function setLastName(?string $lastName): self
  {
    $this->lastName = $lastName;

    return $this;
  }

  public function getCompany(): ?string
  {
    return $this->company;
  }

  public function setCompany(?string $company): self
  {
    $this->company = $company;

    return $this;
  }

  public function getAddress1(): ?string
  {
    return $this->address1;
  }

  public function setAddress1(?string $address1): self
  {
    $this->address1 = $address1;

    return $this;
  }

  public function getAddress2(): ?string
  {
    return $this->address2;
  }

  public function setAddress2(?string $address2): self
  {
    $this->address2 = $address2;

    return $this;
  }

  public function getZipCode(): ?string
  {
    return $this->zipCode;
  }

  public function setZipCode(?string $zipCode): self
  {
    $this->zipCode = $zipCode;

    return $this;
  }

  public function getCity(): ?string
  {
    return $this->city;
  }

  public function setCity(?string $city): self
  {
    $this->city = $city;

    return $this;
  }

  public function getPhone(): ?string
  {
    return $this->phone;
  }

  public function setPhone(?string $phone): self
  {
    $this->phone = $phone;

    return $this;
  }

  public function getEmail(): ?string
  {
    return $this->email;
  }

  public function setEmail(?string $email): self
  {
    $this->email = $email;

    return $this;
  }

  public function getPaidCash(): ?bool
  {
    return $this->paidCash;
  }

  public function setPaidCash(bool $paidCash): self
  {
    $this->paidCash = $paidCash;

    return $this;
  }

  public function getCashDiscount(): ?string
  {
    return $this->cashDiscount;
  }

  public function setCashDiscount(string $cashDiscount): self
  {
    $this->cashDiscount = $cashDiscount;

    return $this;
  }

  public function getBulkDiscount(): ?string
  {
    return $this->bulkDiscount;
  }

  public function setBulkDiscount(string $bulkDiscount): self
  {
    $this->bulkDiscount = $bulkDiscount;

    return $this;
  }

  public function getBulkDiscountThreshold(): ?int
  {
    return $this->bulkDiscountThreshold;
  }

  public function setBulkDiscountThreshold(int $bulkDiscountThreshold): self
  {
    $this->bulkDiscountThreshold = $bulkDiscountThreshold;

    return $this;
  }

  public function getSpringDiscount(): ?string
  {
    return $this->springDiscount;
  }

  public function setSpringDiscount(string $springDiscount): self
  {
    $this->springDiscount = $springDiscount;

    return $this;
  }

  public function getVatPercentage(): ?string
  {
    return $this->vatPercentage;
  }

  public function setVatPercentage(string $vatPercentage): self
  {
    $this->vatPercentage = $vatPercentage;

    return $this;
  }

  public function getVatAmount(): ?string
  {
    return $this->vatAmount;
  }

  public function setVatAmount(string $vatAmount): self
  {
    $this->vatAmount = $vatAmount;

    return $this;
  }

  public function getShippingCost(): ?string
  {
    return $this->shippingCost;
  }

  public function setShippingCost(string $shippingCost): self
  {
    $this->shippingCost = $shippingCost;

    return $this;
  }

  public function getCustomer(): ?Customer
  {
      return $this->customer;
  }

  public function setCustomer(?Customer $customer): self
  {
      $this->customer = $customer;

      return $this;
  }
}
