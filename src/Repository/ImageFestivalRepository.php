<?php

namespace App\Repository;

use App\Entity\ImageFestival;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ImageFestival>
 *
 * @method ImageFestival|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageFestival|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageFestival[]    findAll()
 * @method ImageFestival[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageFestivalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageFestival::class);
    }

//    /**
//     * @return ImageFestival[] Returns an array of ImageFestival objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ImageFestival
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
