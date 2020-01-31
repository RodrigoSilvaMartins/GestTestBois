<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ChapterRepository")
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
     * @ORM\Column(type="integer", nullable=true, name="fkTheme")
     */
    private $theme;

}
