<?php

class Option
{
    private int $id;
    private string $text;
    private bool $correct;
    private int $question_id;

    public function __construct(int $id, string $text, int $question_id, bool $is_correct = false)
    {
        $this->id = $id;
        $this->text = $text;
        $this->correct = $is_correct;
        $this->question_id = $question_id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function isCorrect(): bool
    {
        return $this->correct;
    }

    public function setCorrect(bool $correct): void
    {
        $this->correct = $correct;
    }

    public function getQuestionId(): int
    {
        return $this->question_id;
    }

    public function setQuestionId(int $question_id): void
    {
        $this->question_id = $question_id;
    }
}