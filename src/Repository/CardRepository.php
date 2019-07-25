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

    /**
     * @param $criteria
     * @return mixed
     */
    public function searchCard($criteria)
    {
        $qb = $this->createQueryBuilder('u');

        $qb
            ->where('u.codeCard = :codeCard')
            ->setParameter('codeCard', $criteria['codeCard']);
        /*->where('u.checksum = :checksum')
        ->setParameter('checksum', $criteria['checksum']);*/

        return $qb
            ->getQuery()
            ->getResult();

    }

    public function findFreeCard() {
        $qb = $this->createQueryBuilder('card')
            ->andWhere('card.status = :customerCode')
            ->setParameter(':customerCode', 'libre');
        return (boolean)$qb->getQuery()->getResult();
    }


    public function findOneBySomeField($value): ?Card
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
