<?php

namespace App\Repository;

use App\Entity\Chapter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Chapter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chapter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chapter[]    findAll()
 * @method Chapter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChapterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chapter::class);
    }

    // /**
    //  * @return TChapters[] Returns an array of TChapters objects
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
    public function findOneBySomeField($value): ?TChapters
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function list(array $id = null, array $theme = null): array
    {
        $cb = $this->_em->createQueryBuilder()
            ->select('c')
            ->from(Chapter::class, 'c');

        if (!empty($id)) {
            $cb->andWhere('c.id in (:id)')->setParameter('id', $id);
        }

        if (!empty($theme)) {
            $cb->andWhere('c.theme in (:theme)')->setParameter('theme', $theme);
        }

        $result = $cb->getQuery()->execute();
        $chapterViews = [];

        /** @var Chapter $chapter */
        foreach ($result as $chapter) {
            $chapterViews[] = $chapter->getView();
        }
        return $chapterViews;
    }

}
