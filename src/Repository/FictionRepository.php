<?php

namespace App\Repository;

use App\Entity\Fiction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Fiction>
 *
 * @method Fiction|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fiction|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fiction[]    findAll()
 * @method Fiction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FictionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fiction::class);
    }

//    /**
//     * @return Fiction[] Returns an array of Fiction objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Fiction
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
