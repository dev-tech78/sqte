<?php

namespace App\Repository;

use App\Entity\CategorieAtelier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategorieAtelier>
 *
 * @method CategorieAtelier|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieAtelier|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieAtelier[]    findAll()
 * @method CategorieAtelier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieAtelierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieAtelier::class);
    }

//    /**
//     * @return CategorieAtelier[] Returns an array of CategorieAtelier objects
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

//    public function findOneBySomeField($value): ?CategorieAtelier
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
