<?php

namespace App\Repository;

use App\Entity\CategorieActu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategorieActu>
 *
 * @method CategorieActu|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieActu|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieActu[]    findAll()
 * @method CategorieActu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieActuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieActu::class);
    }

//    /**
//     * @return CategorieActu[] Returns an array of CategorieActu objects
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

//    public function findOneBySomeField($value): ?CategorieActu
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
