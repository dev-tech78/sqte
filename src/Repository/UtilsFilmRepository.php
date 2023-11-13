<?php

namespace App\Repository;

use App\Entity\UtilsFilm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UtilsFilm>
 *
 * @method UtilsFilm|null find($id, $lockMode = null, $lockVersion = null)
 * @method UtilsFilm|null findOneBy(array $criteria, array $orderBy = null)
 * @method UtilsFilm[]    findAll()
 * @method UtilsFilm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilsFilmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UtilsFilm::class);
    }

//    /**
//     * @return UtilsFilm[] Returns an array of UtilsFilm objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UtilsFilm
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
