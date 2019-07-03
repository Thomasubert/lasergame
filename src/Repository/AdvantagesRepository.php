<?php

namespace App\Repository;

use App\Entity\Advantages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Advantages|null find($id, $lockMode = null, $lockVersion = null)
 * @method Advantages|null findOneBy(array $criteria, array $orderBy = null)
 * @method Advantages[]    findAll()
 * @method Advantages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvantagesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Advantages::class);
    }

    // /**
    //  * @return Advantages[] Returns an array of Advantages objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Advantages
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
