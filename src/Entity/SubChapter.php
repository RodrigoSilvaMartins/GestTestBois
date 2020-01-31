<?php

namespace App\Entity;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Chapter", inversedBy="subChapters")
     * @ORM\JoinColumn(nullable=false, name="fkChapter")
     */
    private $chapter;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Level")
     * @ORM\JoinColumn(name="fkLevel")
     */
    private $level;
}
