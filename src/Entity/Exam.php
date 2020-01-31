<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ExamRepository")
 * @ORM\Table(name="t_exams")
 */
class Exam
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="idExam")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, name="exaName")
     */
    private $name;

    /**
     * @var DateTime
     * @ORM\Column(type="string", length=255, nullable=true, name="exaCreationDate")
     */
    private $creationDate;

    /**
     * @var int
     * @ORM\Column(type="string", length=255)
     *
     * Usually in minutes
     */
    private $duration;

    /**
     * @var Subject
     * @ORM\Column(type="integer", nullable=true, name="fkSubject")
     */
    private $subject;
}
