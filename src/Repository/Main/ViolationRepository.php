<?php

namespace App\Repository\Main;

use App\Entity\Main\Violation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Violation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Violation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Violation[]    findAll()
 * @method Violation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ViolationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Violation::class);
    }

    // /**
    //  * @return Violation[] Returns an array of Violation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Violation
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
