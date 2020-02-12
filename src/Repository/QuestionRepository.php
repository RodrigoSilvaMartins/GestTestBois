<?php

namespace App\Repository;

use App\Entity\Chapter;
use App\Entity\Question;
use App\Entity\User;
use App\View\QuestionView;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

//

/**
 * @method Question|null find($id, $lockMode = null, $lockVersion = null)
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

    public function list(array $id = null, array $subChapter = null): array
    {
        $qb = $this->_em->createQueryBuilder()
            ->select('q')
            ->from(Question::class, 'q');

        if (!empty($id)) {
            $qb->andWhere('q.id in (:id)')->setParameter('id', $id);
        }

        if (!empty($subChapter)) {
            $qb->andWhere('q.subChapter in (:subChapter)')->setParameter('subChapter', $subChapter);
        }

        $result = $qb->getQuery()->execute();
        $questionViews = [];

        /** @var Question $question */
        foreach ($result as $question) {
            $questionViews[] = $question->getView();
        }
        return $questionViews;
    }
}
