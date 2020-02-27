<?php

namespace App\Repository;

use App\Entity\Level;
use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Level|null find($id, $lockMode = null, $lockVersion = null)
 * @method Level|null findOneBy(array $criteria, array $orderBy = null)
 * @method Level[]    findAll()
 * @method Level[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LevelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Level::class);
    }

    public function list(array $id = null): array
    {
        $qb = $this->_em->createQueryBuilder()
            ->select('l')
            ->from(Level::class, 'l');

        if (!empty($id)) {
            $qb->andWhere('l.id in (:id)')->setParameter('id', $id);
        }

        $result = $qb->getQuery()->execute();
        $levelViews = [];

        /** @var Level $level */
        foreach ($result as $level) {
            $levelViews[] = $level->getView();
        }
        return $levelViews;
    }
    // /**
    //  * @return TLevels[] Returns an array of TLevels objects
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
    public function findOneBySomeField($value): ?TLevels
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
