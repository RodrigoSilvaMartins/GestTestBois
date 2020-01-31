<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ThemeRepository")
 * @ORM\Table(name="t_themes")
 */
class Theme
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="idThemes")
     */
    private $id;

    /** @var string
     * @ORM\Column(type="string", length=255, name="theName")
     */
    private $name;

    /**
     * @var Subject
     * @ORM\Column(type="integer", nullable=true, name="fkSubject")
     */
    private $subject;
}
