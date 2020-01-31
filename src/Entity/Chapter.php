<?php

namespace App\Entity;

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
     * @ORM\JoinColumn(nullable=false, name="fkTheme")
     */
    private $theme;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SubChapter", mappedBy="chapter")
     * @ORM\JoinColumn(name="fkSubChapter")
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


}
