<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }


    public function searchUser($criteria)
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


    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
