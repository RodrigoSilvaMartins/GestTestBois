<?php

namespace App\Repository;

use App\Entity\ExamQuestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ExamQuestion|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExamQuestion|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExamQuestion[]    findAll()
 * @method ExamQuestion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExamQuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExamQuestion::class);
    }

    // /**
    //  * @return TExamQuestion[] Returns an array of TExamQuestion objects
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
    public function findOneBySomeField($value): ?TExamQuestion
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function list(array $id = null, array $questions = null,array $exams = null): array
    {
        $eb = $this->_em->createQueryBuilder()
            ->select('e')
            ->from(ExamQuestion::class, 'e');

        if (!empty($id)) {
            $eb->andWhere('e.id in (:id)')->setParameter('id', $id);
        }

        if (!empty($questions)) {
            $eb->andWhere('e.question in (:question)')->setParameter('question', $questions);
        }

        if (!empty($exams)) {
            $eb->andWhere('e.exam in (:exam)')->setParameter('exam', $exams);
        }

        $result = $eb->getQuery()->execute();
        $examQuestionsViews = [];

        /** @var ExamQuestion $examQuestion */
        foreach ($result as $examQuestion) {
            $examQuestionsViews[] = $examQuestion->getView();
        }
        return $examQuestionsViews;
    }
}
