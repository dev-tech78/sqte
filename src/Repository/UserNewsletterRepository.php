<?php

namespace App\Repository;

use App\Entity\UserNewsletter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserNewsletter>
 *
 * @method UserNewsletter|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserNewsletter|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserNewsletter[]    findAll()
 * @method UserNewsletter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserNewsletterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserNewsletter::class);
    }

//    /**
//     * @return UserNewsletter[] Returns an array of UserNewsletter objects
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

//    public function findOneBySomeField($value): ?UserNewsletter
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
