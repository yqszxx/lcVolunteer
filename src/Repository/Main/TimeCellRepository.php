<?php

namespace App\Repository\Main;

use App\Entity\Main\TimeCell;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TimeCell|null find($id, $lockMode = null, $lockVersion = null)
 * @method TimeCell|null findOneBy(array $criteria, array $orderBy = null)
 * @method TimeCell[]    findAll()
 * @method TimeCell[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TimeCellRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TimeCell::class);
    }

    // /**
    //  * @return TimeCell[] Returns an array of TimeCell objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TimeCell
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
