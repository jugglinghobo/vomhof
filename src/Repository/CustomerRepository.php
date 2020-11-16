<?php

namespace App\Repository;

use App\Entity\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Customer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customer[]    findAll()
 * @method Customer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerRepository extends ServiceEntityRepository {

  public function __construct(ManagerRegistry $registry) {
    parent::__construct($registry, Customer::class);
  }

  public function findAll() {
    return $this->findBy([], ['lastName' => 'ASC', 'firstName' => 'ASC']);
  }

  public function getWithFirstLetterQueryBuilder(?string $letter): QueryBuilder {
    $qb = $this->createQueryBuilder('customer');
    if ($letter) {
      $qb->andWhere('LOWER(customer.company) LIKE :term OR LOWER(customer.lastName) LIKE :term')
         ->setParameter('term', $letter . '%')
       ;
    }
    return $qb
      ->orderBy('customer.lastName', 'ASC')
    ;
  }

  public function getWithSearchQueryBuilder(?string $term): QueryBuilder {
    $qb = $this->createQueryBuilder('customer');
    if ($term) {
      $qb->andWhere('LOWER(customer.company) LIKE :term OR LOWER(customer.lastName) LIKE :term OR LOWER(customer.firstName) LIKE :term OR LOWER(customer.address1) LIKE :term OR LOWER(customer.zipCode) LIKE :term OR LOWER(customer.city) LIKE :term')
         ->setParameter('term', '%' . $term . '%')
       ;
    }
    return $qb
      ->orderBy('customer.lastName', 'ASC')
    ;
  }

  // /**
  //  * @return Customer[] Returns an array of Customer objects
  //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
     */

    /*
    public function findOneBySomeField($value): ?Customer
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
     */
}
