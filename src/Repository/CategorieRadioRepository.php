<?php

namespace App\Repository;

use App\Entity\CategorieRadio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategorieRadio>
 *
 * @method CategorieRadio|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieRadio|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieRadio[]    findAll()
 * @method CategorieRadio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieRadioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieRadio::class);
    }

//    /**
//     * @return CategorieRadio[] Returns an array of CategorieRadio objects
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

//    public function findOneBySomeField($value): ?CategorieRadio
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
