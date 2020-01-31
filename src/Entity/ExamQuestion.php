<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ExamQuestionRepository")
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
     * @var Exam
     * @ORM\Column(type="integer", nullable=true, name="fkExam")
     */
    private $exam;

    /**
     * @var Question
     * @ORM\Column(type="integer", nullable=true, name="fkQuestion")
     */
    private $question;

    /**
     * @var int
     * @ORM\Column(type="integer", name="exaOrder")
     */
    private $order;
}
