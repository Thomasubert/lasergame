<?php

namespace App\Repository;

use App\Entity\Card;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Card|null find($id, $lockMode = null, $lockVersion = null)
 * @method Card|null findOneBy(array $criteria, array $orderBy = null)
 * @method Card[]    findAll()
 * @method Card[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CardRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Card::class);
    }


    public function searchCard($criteria)
    {
        $qb = $this->createQueryBuilder('u');

        //$qb->orderBy('u.lastname', 'DESC');

        //if (!empty($criteria['user'])) {
        $qb
            ->where('u.lastname = :lastname')
            ->setParameter('lastname', $criteria['lastname']);

        //}


        //$query = $qb->getQuery();

        //dump($query->getSQL());

        //$qb->orderBy('u.lastname', 'DESC');

        return $qb
            ->getQuery()
            ->getResult();

    }
    // /**
    //  * @return Card[] Returns an array of Card objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Card
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
