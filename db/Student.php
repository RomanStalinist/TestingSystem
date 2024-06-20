<?php

class Student
{
    private int $id;
    private string $full_name;
    private string $group_name;

    public function __construct(int $id, string $full_name, string $group_name)
    {
        $this->id = $id;
        $this->full_name = $full_name;
        $this->group_name = $group_name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getFullName(): string
    {
        return $this->full_name;
    }

    public function setFullName(string $full_name): void
    {
        $this->full_name = $full_name;
    }

    public function getGroupName(): string
    {
        return $this->group_name;
    }

    public function setGroupName(string $group_name): void
    {
        $this->group_name = $group_name;
    }
}