<?php

namespace App\Repository;

use App\Entity\Emission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Emission>
 *
 * @method Emission|null find($id, $lockMode = null, $lockVersion = null)
 * @method Emission|null findOneBy(array $criteria, array $orderBy = null)
 * @method Emission[]    findAll()
 * @method Emission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Emission::class);
    }

//    /**
//     * @return Emission[] Returns an array of Emission objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Emission
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
