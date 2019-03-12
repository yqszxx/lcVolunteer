<?php

namespace App\Repository\Main;

use App\Entity\Main\Recruitment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Recruitment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recruitment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recruitment[]    findAll()
 * @method Recruitment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecruitmentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Recruitment::class);
    }

    // /**
    //  * @return Recruitment[] Returns an array of Recruitment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Recruitment
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
