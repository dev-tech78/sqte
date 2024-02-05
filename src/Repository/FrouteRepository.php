<?php

namespace App\Repository;

use App\Entity\Froute;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Froute>
 *
 * @method Froute|null find($id, $lockMode = null, $lockVersion = null)
 * @method Froute|null findOneBy(array $criteria, array $orderBy = null)
 * @method Froute[]    findAll()
 * @method Froute[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FrouteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Froute::class);
    }

//    /**
//     * @return Froute[] Returns an array of Froute objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Froute
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
