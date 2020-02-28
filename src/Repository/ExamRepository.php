<?php

namespace App\Repository;

use App\Entity\Exam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Exam|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exam|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exam[]    findAll()
 * @method Exam[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exam::class);
    }

    // /**
    //  * @return TExams[] Returns an array of TExams objects
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
    public function findOneBySomeField($value): ?TExams
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function list(array $id = null, array $subjects = null): array
    {
        $eb = $this->_em->createQueryBuilder()
            ->select('e')
            ->from(Exam::class, 'e');

        if (!empty($id)) {
            $eb->andWhere('e.id in (:id)')->setParameter('id', $id);
        }

        if (!empty($subjects)) {
            $eb->andWhere('e.subject in (:subject)')->setParameter('subject', $subjects);
        }

        $result = $eb->getQuery()->execute();
        $examViews = [];

        /** @var Exam $exam */
        foreach ($result as $exam) {
            $examViews[] = $exam->getView();
        }
        return $examViews;
    }
}
