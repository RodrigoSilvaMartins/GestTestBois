<?php

namespace App\Entity;

use App\View\ExamView;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExamRepository")
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
     * @ORM\Column(type="datetime", length=255, nullable=true, name="exaCreationDate")
     */
    private $creationDate;

    /**
     * @var int
     * @ORM\Column(type="integer", length=255)
     *
     * Usually in minutes
     */
    private $duration;

    /**
     * @var Subject
     * @ORM\ManyToOne(targetEntity="App\Entity\Subject")
     * @ORM\JoinColumn(nullable=false, name="fkSubject", referencedColumnName="idSubject")
     */
    private $subject;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ExamQuestion", mappedBy="exam")
     */
    private $examQuestions;

    public function __construct()
    {
        $this->examQuestions = new ArrayCollection();
    }

    /**
     * @return Collection|ExamQuestion[]
     */
    public function getExamQuestions(): Collection
    {
        return $this->examQuestions;
    }

    public function addExamQuestion(ExamQuestion $examQuestion): self
    {
        if (!$this->examQuestions->contains($examQuestion)) {
            $this->examQuestions[] = $examQuestion;
            $examQuestion->setExam($this);
        }

        return $this;
    }

    public function removeExamQuestion(ExamQuestion $examQuestion): self
    {
        if ($this->examQuestions->contains($examQuestion)) {
            $this->examQuestions->removeElement($examQuestion);
            // set the owning side to null (unless already changed)
            if ($examQuestion->getExam() === $this) {
                $examQuestion->setExam(null);
            }
        }

        return $this;
    }

    public static function create(string $name, DateTime $creationDate, int $duration, Subject $subject): self
    {
        $self = new self();
        $self->name = $name;
        $self->creationDate = $creationDate;
        $self->duration = $duration;
        $self->subject = $subject;

        return $self;
    }
    public function getView(): ExamView
    {
        $examView = new ExamView();
        $examView->id = $this->id;
        $examView->name = $this->name;
        $examView->date = $this->creationDate;
        $examView->duration = $this->duration;
        $examView->subject = $this->subject->getName();

        return $examView;
    }
    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
