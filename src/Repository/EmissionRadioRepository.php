<?php

namespace App\Repository;

use App\Entity\EmissionRadio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmissionRadio>
 *
 * @method EmissionRadio|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmissionRadio|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmissionRadio[]    findAll()
 * @method EmissionRadio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmissionRadioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmissionRadio::class);
    }

//    /**
//     * @return EmissionRadio[] Returns an array of EmissionRadio objects
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

//    public function findOneBySomeField($value): ?EmissionRadio
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
