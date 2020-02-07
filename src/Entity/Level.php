<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LevelRepository")
 * @ORM\Table(name="t_levels")
 */
class Level
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="idLevel")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, name="levName")
     */
    private $name;

    public static function create(string $name): self
    {
        $self = new self();
        $self->name = $name;

        return $self;
    }
}
