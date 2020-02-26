<?php

namespace App\Entity;

use App\View\LevelView;
use App\View\QuestionView;
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

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    public function getView(): LevelView
    {
        $levelView = new LevelView();
        $levelView->id = $this->id;
        $levelView->name = $this->name;

        return $levelView;
    }
}
