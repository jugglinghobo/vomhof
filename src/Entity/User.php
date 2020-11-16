<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2, options={"default": 7.7})
     */
    private $vatPercentage;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2, options={"default": 3})
     */
    private $bulkDiscountPercentage;

    /**
     * @ORM\Column(type="integer", options={"default": 300})
     */
    private $bulkDiscountThreshold;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $springDiscountActive;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2, options={"default": 5})
     */
    private $springDiscountPercentage;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=2, options={"default": 3})
     */
    private $cashDiscountPercentage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vatNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $iban;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getBulkDiscountPercentage(): ?string
    {
        return $this->bulkDiscountPercentage;
    }

    public function setBulkDiscountPercentage(string $bulkDiscountPercentage): self
    {
        $this->bulkDiscountPercentage = $bulkDiscountPercentage;

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

    public function getSpringDiscountActive(): ?bool
    {
        return $this->springDiscountActive;
    }

    public function setSpringDiscountActive(bool $springDiscountActive): self
    {
        $this->springDiscountActive = $springDiscountActive;

        return $this;
    }

    public function getSpringDiscountPercentage(): ?string
    {
        return $this->springDiscountPercentage;
    }

    public function setSpringDiscountPercentage(string $springDiscountPercentage): self
    {
        $this->springDiscountPercentage = $springDiscountPercentage;

        return $this;
    }

    public function getCashDiscountPercentage(): ?string
    {
        return $this->cashDiscountPercentage;
    }

    public function setCashDiscountPercentage(string $cashDiscountPercentage): self
    {
        $this->cashDiscountPercentage = $cashDiscountPercentage;

        return $this;
    }

    public function getVatNumber(): ?string
    {
        return $this->vatNumber;
    }

    public function setVatNumber(string $vatNumber): self
    {
        $this->vatNumber = $vatNumber;

        return $this;
    }

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function setIban(string $iban): self
    {
        $this->iban = $iban;

        return $this;
    }
}
