<?php

namespace App\Repository;

use App\Entity\CatSoutien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CatSoutien>
 *
 * @method CatSoutien|null find($id, $lockMode = null, $lockVersion = null)
 * @method CatSoutien|null findOneBy(array $criteria, array $orderBy = null)
 * @method CatSoutien[]    findAll()
 * @method CatSoutien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatSoutienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CatSoutien::class);
    }

//    /**
//     * @return CatSoutien[] Returns an array of CatSoutien objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CatSoutien
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
