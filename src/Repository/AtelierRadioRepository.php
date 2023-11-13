<?php

namespace App\Repository;

use App\Entity\AtelierRadio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AtelierRadio>
 *
 * @method AtelierRadio|null find($id, $lockMode = null, $lockVersion = null)
 * @method AtelierRadio|null findOneBy(array $criteria, array $orderBy = null)
 * @method AtelierRadio[]    findAll()
 * @method AtelierRadio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AtelierRadioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AtelierRadio::class);
    }

//    /**
//     * @return AtelierRadio[] Returns an array of AtelierRadio objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AtelierRadio
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
