<?php

namespace App\Repository;

use App\Entity\VoteEntry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method VoteEntry|null find($id, $lockMode = null, $lockVersion = null)
 * @method VoteEntry|null findOneBy(array $criteria, array $orderBy = null)
 * @method VoteEntry[]    findAll()
 * @method VoteEntry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoteEntryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, VoteEntry::class);
    }

    // /**
    //  * @return VoteEntry[] Returns an array of VoteEntry objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VoteEntry
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
