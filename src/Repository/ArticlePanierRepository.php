<?php

namespace App\Repository;

use App\Entity\ArticlePanier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ArticlePanier|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticlePanier|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticlePanier[]    findAll()
 * @method ArticlePanier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticlePanierRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ArticlePanier::class);
    }

//    /**
//     * @return ArticlePanier[] Returns an array of ArticlePanier objects
//     */
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
    public function findOneBySomeField($value): ?ArticlePanier
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
