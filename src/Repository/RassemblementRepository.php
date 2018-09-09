<?php

namespace App\Repository;

use App\Entity\Rassemblement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Rassemblement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rassemblement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rassemblement[]    findAll()
 * @method Rassemblement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RassemblementRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Rassemblement::class);
    }

//    /**
//     * @return Rassemblement[] Returns an array of Rassemblement objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Rassemblement
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
