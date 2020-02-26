<?php

namespace App\Entity;

use App\View\ChapterView;
use App\View\QuestionView;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChapterRepository")
 * @ORM\Table(name="t_chapters")
 */
class Chapter
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="idChapter")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, name="chaName")
     */
    private $name;

    /**
     * @var int
     * @ORM\Column(type="integer", name="chaNumber")
     */
    private $number;

    /**
     * @var Theme
     * @ORM\ManyToOne(targetEntity="App\Entity\Theme", inversedBy="chapter")
     * @ORM\JoinColumn(nullable=false, name="fkTheme", referencedColumnName="idTheme")
     */
    private $theme;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SubChapter", mappedBy="chapter")
     */
    private $subChapters;

    public function __construct()
    {
        $this->subChapters = new ArrayCollection();
    }

    public function addSubChapter(SubChapter $subChapter): self
    {
        if (!$this->subChapters->contains($subChapter)) {
            $this->subChapters[] = $subChapter;
            $subChapter->setChapter($this);
        }

        return $this;
    }

    public function removeSubChapter(SubChapter $subChapter): self
    {
        if ($this->subChapters->contains($subChapter)) {
            $this->subChapters->removeElement($subChapter);
            // set the owning side to null (unless already changed)
            if ($subChapter->getChapter() === $this) {
                $subChapter->setChapter(null);
            }
        }

        return $this;
    }

    public static function create(string $name, int $number, Theme $theme): self
    {
        $self = new self();
        $self->name = $name;
        $self->number = $number;
        $self->theme = $theme;

        return $self;
    }

    /**
     * @return Theme
     */
    public function getTheme(): Theme
    {
        return $this->theme;
    }

    /**
     * @param Theme $theme
     */
    public function setTheme(Theme $theme): void
    {
        $this->theme = $theme;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function getView(): ChapterView
    {
        $chapterView = new ChapterView();
        $chapterView->id = $this->id;
        $chapterView->name = $this->name;
        $chapterView->number = $this->number;
        $chapterView->theme = $this->theme->getName();

        return $chapterView;
    }
}
