<?php

namespace App\Entity;

use App\View\QuestionView;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
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
     * @var string
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
     * @var ?string
     * @ORM\Column(type="text", nullable=true, name="queFormula")
     */
    private $formula;

    /**
     * @var ?Image
     * @ORM\ManyToOne(targetEntity="App\Entity\Image")
     * @ORM\JoinColumn(name="fkImage", referencedColumnName="idImage")
     */
    private $image;

    /**
     * @var SubChapter
     * @ORM\OneToOne(targetEntity="App\Entity\SubChapter", mappedBy="question")
     * @ORM\JoinColumn(name="fkSubChapter", referencedColumnName="idSubChapter")
     */
    private $subChapter;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false, name="fkIdUser", referencedColumnName="idUser")
     */
    private $user;

    public static function create(
        string $question,
        string $answer,
        int $points,
        ?string $formula,
        ?Image $image,
        SubChapter $subChapter,
        User $user
    ): self
    {
        $self = new self();
        $self->question = $question;
        $self->answer = $answer;
        $self->points = $points;
        $self->formula = $formula;
        $self->image = $image;
        $self->subChapter = $subChapter;
        $self->user = $user;

        return $self;
    }

    public function getView(): QuestionView
    {
        $questionView = new QuestionView();
        $questionView->id = $this->id;
        $questionView->question = $this->question;
        $questionView->answer = $this->answer;
        $questionView->points = $this->points;
        $questionView->formula = $this->formula;
        $questionView->image = $this->image;
        $questionView->subChapter = $this->subChapter->getName();
        $questionView->chapter = $this->subChapter->getChapter()->getName();
        $questionView->theme = $this->subChapter->getChapter()->getTheme()->getName();
        $questionView->subject = $this->subChapter->getChapter()->getTheme()->getSubject()->getName();
        $questionView->level = $this->subChapter->getLevel()->getName();

        return $questionView;
    }

    /**
     * @return string
     */
    public function getQuestion(): ?string
    {
        return $this->question;
    }

    /**
     * @param string $question
     */
    public function setQuestion(string $question): void
    {
        $this->question = $question;
    }

    /**
     * @return string
     */
    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    /**
     * @param string $answer
     */
    public function setAnswer(string $answer): void
    {
        $this->answer = $answer;
    }

    /**
     * @return SubChapter
     */
    public function getSubChapter(): ?SubChapter
    {
        return $this->subChapter;
    }

    /**
     * @param SubChapter $subChapter
     */
    public function setSubChapter(SubChapter $subChapter): void
    {
        $this->subChapter = $subChapter;
    }

    /**
     * @return ?mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return ?mixed
     */
    public function getFormula()
    {
        return $this->formula;
    }

    /**
     * @param mixed $formula
     */
    public function setFormula($formula): void
    {
        $this->formula = $formula;
    }

    /**
     * @return int
     */
    public function getPoints(): ?int
    {
        return $this->points;
    }

    /**
     * @param int $points
     */
    public function setPoints(int $points): void
    {
        $this->points = $points;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}
