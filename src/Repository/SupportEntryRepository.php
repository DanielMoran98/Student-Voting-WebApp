<?php

namespace App\Repository;

use App\Entity\SupportEntry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SupportEntry|null find($id, $lockMode = null, $lockVersion = null)
 * @method SupportEntry|null findOneBy(array $criteria, array $orderBy = null)
 * @method SupportEntry[]    findAll()
 * @method SupportEntry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SupportEntryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SupportEntry::class);
    }

    // /**
    //  * @return SupportEntry[] Returns an array of SupportEntry objects
    //  */
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
    public function findOneBySomeField($value): ?SupportEntry
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
