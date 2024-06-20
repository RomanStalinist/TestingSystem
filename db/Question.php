<?php

class Question
{
    private int $id;
    private string $text;
    private string $image_url;
    private int $test_id;

    public function __construct(int $id, string $text, string $image_url, int $test_id)
    {
        $this->id = $id;
        $this->text = $text;
        $this->image_url = $image_url;
        $this->test_id = $test_id;
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

    public function getImageUrl(): string
    {
        return $this->image_url;
    }

    public function setImageUrl(string $image_url): void
    {
        $this->image_url = $image_url;
    }

    public function getTestId(): int
    {
        return $this->test_id;
    }

    public function setTestId(int $test_id): void
    {
        $this->test_id = $test_id;
    }
}