<?php

namespace App\Repository;

use App\Entity\Subject;
use App\Entity\Theme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Theme|null find($id, $lockMode = null, $lockVersion = null)
 * @method Theme|null findOneBy(array $criteria, array $orderBy = null)
 * @method Theme[]    findAll()
 * @method Theme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThemeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Theme::class);
    }

    // /**
    //  * @return TThemes[] Returns an array of TThemes objects
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
    public function findOneBySomeField($value): ?TThemes
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function list(array $id = null, array $subject = null): array
    {
        $tb = $this->_em->createQueryBuilder()
            ->select('t')
            ->from(Theme::class, 't');

        if (!empty($id)) {
            $tb->andWhere('t.id in (:id)')->setParameter('id', $id);
        }

        if (!empty($subject)) {
            $tb->andWhere('t.subject in (:subject)')->setParameter('subject', $subject);
        }

        $result = $tb->getQuery()->execute();
        $themeViews = [];

        /** @var Theme $theme */
        foreach ($result as $theme) {
            $themeViews[] = $theme->getView();
        }
        return $themeViews;
    }
}
