<?php

namespace App\Entity;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Exam", inversedBy="examQuestions")
     * @ORM\JoinColumn(nullable=false, name="fkExam")
     */
    private $exam;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Question")
     * @ORM\JoinColumn(nullable=false, name="fkQuestion")
     */
    private $question;
}
