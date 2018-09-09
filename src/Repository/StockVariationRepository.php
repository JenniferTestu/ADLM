<?php

namespace App\Repository;

use App\Entity\StockVariation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method StockVariation|null find($id, $lockMode = null, $lockVersion = null)
 * @method StockVariation|null findOneBy(array $criteria, array $orderBy = null)
 * @method StockVariation[]    findAll()
 * @method StockVariation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockVariationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, StockVariation::class);
    }

//    /**
//     * @return StockVariation[] Returns an array of StockVariation objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StockVariation
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
