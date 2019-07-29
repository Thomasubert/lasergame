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

        return $qb
            ->getQuery()
            ->getResult();

    }

    public function existsFreeCard() {
        $qb = $this->createQueryBuilder('card')
            ->andWhere('card.status = :customerCode')
            ->setParameter(':customerCode', 'libre');
        return (boolean)$qb->getQuery()->getResult();
    }


    public function findFreeCard()
    {
        $qb = $this->createQueryBuilder('card')
            ->andWhere('card.status = :customerCode')
            ->setParameter(':customerCode', 'libre');
        $qb->setMaxResults( 1 );
        return $qb->getQuery()->getScalarResult();
    }
}
