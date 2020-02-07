<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ThemeRepository")
 * @ORM\Table(name="t_themes")
 */
class Theme
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="idTheme")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, name="theName")
     */
    private $name;

    /**
     * @var Subject
     * @ORM\ManyToOne(targetEntity="App\Entity\Subject", inversedBy="themes")
     * @ORM\JoinColumn(nullable=false, name="fkSubject", referencedColumnName="idSubject")
     */
    private $subject;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Chapter", mappedBy="theme")
     */
    private $chapters;

    public function __construct()
    {
        $this->chapters = new ArrayCollection();
    }

    /**
     * @return Collection|Chapter[]
     */
    public function getChapters(): Collection
    {
        return $this->chapters;
    }

    public function addChapter(Chapter $chapter): self
    {
        if (!$this->chapters->contains($chapter)) {
            $this->chapters[] = $chapter;
            $chapter->setTheme($this);
        }

        return $this;
    }

    public function removeChapter(Chapter $chapter): self
    {
        if ($this->chapters->contains($chapter)) {
            $this->chapters->removeElement($chapter);
            // set the owning side to null (unless already changed)
            if ($chapter->getTheme() === $this) {
                $chapter->setTheme(null);
            }
        }

        return $this;
    }

    public static function create(string $name, Subject $subject): self
    {
        $self = new self();
        $self->name = $name;
        $self->subject = $subject;

        return $self;
    }

    /**
     * @return Subject
     */
    public function getSubject(): Subject
    {
        return $this->subject;
    }

    /**
     * @param Subject $subject
     */
    public function setSubject(Subject $subject): void
    {
        $this->subject = $subject;
    }
}
