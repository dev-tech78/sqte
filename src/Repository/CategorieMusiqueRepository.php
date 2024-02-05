<?php

namespace App\Repository;

use App\Entity\CategorieMusique;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategorieMusique>
 *
 * @method CategorieMusique|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieMusique|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieMusique[]    findAll()
 * @method CategorieMusique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieMusiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieMusique::class);
    }

//    /**
//     * @return CategorieMusique[] Returns an array of CategorieMusique objects
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

//    public function findOneBySomeField($value): ?CategorieMusique
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
