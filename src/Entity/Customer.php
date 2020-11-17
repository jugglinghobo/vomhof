<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 */
class Customer {

  use TimestampableEntity;

  public function __toString() {
    return $this->getName();
  }

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
   * @Assert\Email
   */
  private $email;

  /**
   * @ORM\Column(type="boolean")
   */
  private $paysCash;

  /**
   * @ORM\Column(type="boolean")
   */
  private $pickUp;

  /**
   * @ORM\OneToMany(targetEntity=Invoice::class, mappedBy="customer")
   */
  private $invoices;

  public function __construct()
  {
      $this->invoices = new ArrayCollection();
  }

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

  public function getPaysCash(): ?bool
  {
    return $this->paysCash;
  }

  public function setPaysCash(bool $paysCash): self
  {
    $this->paysCash = $paysCash;

    return $this;
  }

  public function getPickUp(): ?bool
  {
    return $this->pickUp;
  }

  public function setPickUp(bool $pickUp): self
  {
    $this->pickUp = $pickUp;

    return $this;
  }

  /**
   * @return Collection|Invoice[]
   */
  public function getInvoices(): Collection
  {
      return $this->invoices;
  }

  public function addInvoice(Invoice $invoice): self
  {
      if (!$this->invoices->contains($invoice)) {
          $this->invoices[] = $invoice;
          $invoice->setCustomer($this);
      }

      return $this;
  }

  public function removeInvoice(Invoice $invoice): self
  {
      if ($this->invoices->removeElement($invoice)) {
          // set the owning side to null (unless already changed)
          if ($invoice->getCustomer() === $this) {
              $invoice->setCustomer(null);
          }
      }

      return $this;
  }

}
