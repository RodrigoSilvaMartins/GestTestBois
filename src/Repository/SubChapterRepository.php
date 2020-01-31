<?php

namespace App\Repository;

use App\Entity\SubChapter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SubChapter|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubChapter|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubChapter[]    findAll()
 * @method SubChapter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubChapterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubChapter::class);
    }

    // /**
    //  * @return TSubChapters[] Returns an array of TSubChapters objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TSubChapters
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
