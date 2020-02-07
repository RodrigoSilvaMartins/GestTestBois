<?php

namespace App\View;

class ExamQuestionView
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

    public function __construct(
        int $id,
        string $question,
        string $answer,
        int $points,
        string $formula,
        string $image,
        string $subChapter,
        string $chapter,
        string $theme,
        string $subject,
        string $level
    )
    {
        $this->id = $id;
        $this->question = $question;
        $this->answer = $answer;
        $this->points = $points;
        $this->formula = $formula;
        $this->image = $image;
        $this->subChapter = $subChapter;
        $this->chapter = $chapter;
        $this->theme = $theme;
        $this->subject = $subject;
        $this->level = $level;
    }
}