<?php

namespace App\Repository;

use App\Entity\MentioLegales;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MentioLegales>
 *
 * @method MentioLegales|null find($id, $lockMode = null, $lockVersion = null)
 * @method MentioLegales|null findOneBy(array $criteria, array $orderBy = null)
 * @method MentioLegales[]    findAll()
 * @method MentioLegales[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MentioLegalesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MentioLegales::class);
    }

//    /**
//     * @return MentioLegales[] Returns an array of MentioLegales objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MentioLegales
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
