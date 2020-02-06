<?php

namespace App\Repository;

use App\Entity\Chapter;
use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

//@method Question|null find($id, $lockMode = null, $lockVersion = null)
/**
 * @method Question|null findOneBy(array $criteria, array $orderBy = null)
 * @method Question[]    findAll()
 * @method Question[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }

    public function find($id, $lockMode = null, $lockVersion = null)
    {
        $qb = $this
            ->createQueryBuilder('SELECT new ' . Question::class . '(q.id, q.answer, q.points, q.formula, q.image, q.subChapter->name, q.subChapter->chapter->name, q.subChapter->chapter->theme->name, q.subChapter->chapter->theme->subject->name, q.subChapter->level->name)', 'q')
            ->orderBy('q.subChapter->level->name');

        $result = $qb->getQuery()->execute();
        dd($result);
    }
    // /**
    //  * @return TQuestions[] Returns an array of TQuestions objects
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
    public function findOneBySomeField($value): ?TQuestions
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
