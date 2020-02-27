<?php

namespace App\Entity;

use App\View\SubjectView;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubjectRepository")
 * @ORM\Table(name="t_subjects")
 */
class Subject
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="idSubject")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, name="subName")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Theme", mappedBy="subject")
     */
    private $themes;

    public function __construct()
    {
        $this->themes = new ArrayCollection();
    }

    /**
     * @return Collection|Theme[]
     */
    public function getThemes(): Collection
    {
        return $this->themes;
    }

    public function addTheme(Theme $theme): self
    {
        if (!$this->themes->contains($theme)) {
            $this->themes[] = $theme;
            $theme->setSubject($this);
        }

        return $this;
    }

    public function removeTheme(Theme $theme): self
    {
        if ($this->themes->contains($theme)) {
            $this->themes->removeElement($theme);
            // set the owning side to null (unless already changed)
            if ($theme->getSubject() === $this) {
                $theme->setSubject(null);
            }
        }

        return $this;
    }

    public static function create(string $name): self
    {
        $self = new self();
        $self->name = $name;

        return $self;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    public function getView(): SubjectView
    {
        $subjectView = new SubjectView();
        $subjectView->id = $this->id;
        $subjectView->name = $this->name;

        return $subjectView;
    }
}
