<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 * @ORM\Table(name="t_image")
 */
class Image
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="idImage")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, name="imaName")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="blob", name="imaContent")
     */
    private $content;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, name="imaFormat")
     */
    private $format;

    public static function create(string $name, string $content, string $format): self
    {
        $self = new self();
        $self->name = $name;
        $self->content = $content;
        $self->format = $format;

        return $self;
    }
}
