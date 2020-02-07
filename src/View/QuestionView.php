<?php

namespace App\View;

use App\Entity\Question;
use App\Entity\SubChapter;

class QuestionView
{
    /**
     * @var int
     */
    public $id;

    /**q
     * @var string
     */
    public $question;

    /**
     * @var string
     */
    public $answer;

    /**
     * @var int
     */
    public $points;

    /**
     * @var string
     */
    public $formula;

    /**
     * @var string
     */
    public $image;

    /**
     * @var string
     */
    public $subChapter;

    /**
     * @var string
     */
    public $chapter;

    /**
     * @var string
     */
    public $theme;

    /**
     * @var string
     */
    public $subject;

    /**
     * @var string
     */
    public $level;
}