<?php

namespace App\Repository;

use App\Entity\SubFamilies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SubFamilies|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubFamilies|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubFamilies[]    findAll()
 * @method SubFamilies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubFamiliesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubFamilies::class);
    }

    // /**
    //  * @return SubFamilies[] Returns an array of SubFamilies objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SubFamilies
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
