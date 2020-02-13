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

    public static function create(
        string $question,
        string $answer,
        int $points,
        ?string $formula,
        ?Image $image,
        SubChapter $subChapter
    ): self
    {
        $self = new self();
        $self->question = $question;
        $self->answer = $answer;
        $self->points = $points;
        $self->formula = $formula;
        $self->image = $image;
        $self->subChapter = $subChapter;

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
}
