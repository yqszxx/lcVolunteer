<?php

namespace App\Repository\Appointment;

use App\Entity\Appointment\ConferenceRoom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ConferenceRoom|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConferenceRoom|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConferenceRoom[]    findAll()
 * @method ConferenceRoom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConferenceRoomRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ConferenceRoom::class);
    }

    // /**
    //  * @return ConferenceRoom[] Returns an array of ConferenceRoom objects
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
    public function findOneBySomeField($value): ?ConferenceRoom
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
