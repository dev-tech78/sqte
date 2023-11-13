<?php

namespace App\Repository;

use App\Entity\CategorieDoc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategorieDoc>
 *
 * @method CategorieDoc|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieDoc|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieDoc[]    findAll()
 * @method CategorieDoc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieDocRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieDoc::class);
    }

//    /**
//     * @return CategorieDoc[] Returns an array of CategorieDoc objects
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

//    public function findOneBySomeField($value): ?CategorieDoc
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
