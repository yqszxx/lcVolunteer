<?php

namespace App\Repository\Appointment;

use App\Entity\Appointment\BookingRecord;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BookingRecord|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookingRecord|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookingRecord[]    findAll()
 * @method BookingRecord[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingRecordRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BookingRecord::class);
    }

    // /**
    //  * @return BookingRecord[] Returns an array of BookingRecord objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BookingRecord
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
