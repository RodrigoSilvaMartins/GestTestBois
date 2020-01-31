<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="SubChapterRepository")
 * @ORM\Table(name="t_subChapters")
 */
class SubChapter
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
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
     * @ORM\Column(type="integer", nullable=true, name="fkChapter")
     */
    private $chapter;

    /**
     * @var Level
     * @ORM\Column(type="integer", nullable=true, name="fkLevel")
     */
    private $level;
}
