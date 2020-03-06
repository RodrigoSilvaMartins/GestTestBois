<?php

namespace App\Entity;

use App\View\SubChaptersView;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubChapterRepository")
 * @ORM\Table(name="t_subChapters")
 */
class SubChapter
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="idSubChapter")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, name="subName")
     */
    private $name;

    /**
     * @var int
     * @ORM\Column(type="integer", name="subChapNumber", name="subNumber")
     */
    private $number;

    /**
     * @var Chapter
     * @ORM\ManyToOne(targetEntity="App\Entity\Chapter", inversedBy="subChapters")
     * @ORM\JoinColumn(nullable=false, name="fkChapter", referencedColumnName="idChapter")
     */
    private $chapter;

    /**
     * @var Level
     * @ORM\ManyToOne(targetEntity="App\Entity\Level")
     * @ORM\JoinColumn(name="fkLevel", referencedColumnName="idLevel")
     */
    private $level;

    public static function create(string $name, int $number, Chapter $chapter, Level $level): self
    {
        $self = new self();
        $self->name = $name;
        $self->number = $number;
        $self->chapter = $chapter;
        $self->level = $level;

        return $self;
    }

    /**
     * @return Chapter
     */
    public function getChapter(): Chapter
    {
        return $this->chapter;
    }

    /**
     * @param Chapter $chapter
     */
    public function setChapter(Chapter $chapter): void
    {
        $this->chapter = $chapter;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Level
     */
    public function getLevel(): Level
    {
        return $this->level;
    }

    public function getView(): SubChaptersView
    {
        $subChapterView = new SubChaptersView();
        $subChapterView->id = $this->id;
        $subChapterView->name = $this->name;
        $subChapterView->number = $this->number;
        $subChapterView->chapter = $this->chapter->getName();
        $subChapterView->theme = $this->chapter->getTheme()->getName();

        return $subChapterView;
    }

    public function __toString() {
        return ''.$this->id;
    }
}
