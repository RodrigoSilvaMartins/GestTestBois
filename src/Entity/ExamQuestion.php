<?php

namespace App\Entity;

use App\Entity\Question;
use App\View\ExamQuestionView;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExamQuestionRepository")
 * @ORM\Table(name="t_examQuestions")
 */
class ExamQuestion
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="idExamQuestion")
     */
    private $id;

    /**
     * @var int
     * @ORM\Column(type="integer", name="exaOrder")
     */
    private $order;

    /**
     * @var Exam
     * @ORM\ManyToOne(targetEntity="App\Entity\Exam", inversedBy="examQuestions")
     * @ORM\JoinColumn(nullable=false, name="fkExam", referencedColumnName="idExam")
     */
    private $exam;

    /**
     * @var Question
     * @ORM\ManyToOne(targetEntity="App\Entity\Question")
     * @ORM\JoinColumn(nullable=false, name="fkQuestion", referencedColumnName="idQuestion")
     */
    private $question;

    public static function create(int $order, Exam $exam, Question $question): self
    {
        $self = new self();
        $self->order = $order;
        $self->exam = $exam;
        $self->question = $question;

        return $self;
    }

    /**
     * @return Exam
     */
    public function getExam(): Exam
    {
        return $this->exam;
    }

    /**
     * @param Exam $exam
     */
    public function setExam(Exam $exam): void
    {
        $this->exam = $exam;
    }
    public function getView(): ExamQuestionView
    {
        $examQuestionView = new ExamQuestionView();
        $examQuestionView->id = $this->id;
        $examQuestionView->question = $this->question->getId();
        $examQuestionView->exam = $this->exam->getId();

        return $examQuestionView;
    }
}
