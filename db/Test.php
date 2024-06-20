<?php

class Test
{
    private int $id;
    private string $title;
    private int $seconds_limit;

    public function __construct(int $id, string $title, int $seconds_limit) {
        $this->id = $id;
        $this->title = $title;
        $this->seconds_limit = $seconds_limit;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getSecondsLimit(): int
    {
        return $this->seconds_limit;
    }

    /**
     * @throws Exception
     */
    public function setSecondsLimit(int $seconds_limit): void
    {
        if ($seconds_limit > 0)
            $this->seconds_limit = $seconds_limit;
        else
            throw new Exception(
                'Количество секунд должно быть больше 0');
    }
}