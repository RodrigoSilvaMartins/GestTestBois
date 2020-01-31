<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="QuestionRepository")
 * @ORM\Table(name="t_questions")
 */
class Question
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="idQuestion")
     */
    private $id;

    /**
     * @var Chapter
     * @ORM\Column(type="integer", nullable=true, name="fkSubChapter")
     */
    private $chapter;

    /**
     * @var Question
     * @ORM\Column(type="string", length=255, name="queQuestion")
     */
    private $question;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, name="queAnswer")
     */
    private $answer;

    /**
     * @var int
     * @ORM\Column(type="integer", name="quePoints")
     */
    private $points;

    /**
     * @var Image
     * @ORM\Column(type="integer", nullable=true, name="fkImage")
     */
    private $image;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true, name="queFormula")
     */
    private $formula;
}