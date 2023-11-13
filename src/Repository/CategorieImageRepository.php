<?php

namespace App\Repository;

use App\Entity\CategorieImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategorieImage>
 *
 * @method CategorieImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieImage[]    findAll()
 * @method CategorieImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieImage::class);
    }

//    /**
//     * @return CategorieImage[] Returns an array of CategorieImage objects
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

//    public function findOneBySomeField($value): ?CategorieImage
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
