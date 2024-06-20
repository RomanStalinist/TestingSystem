<?php

class TestResult
{
    private int $id;
    private int $test_id;
    private int $student_id;
    private string $test_date;
    private int $points_obtained;

    public function __construct(int $id, int $test_id, int $student_id,
                                int $points_obtained, string $test_date = null) {
        $this->id = $id;
        $this->test_id = $test_id;
        $this->student_id = $student_id;
        $this->points_obtained = $points_obtained;
        $this->test_date = $test_date ?? date('Y-m-d H:i:s');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getPointsObtained(): int
    {
        return $this->points_obtained;
    }

    public function setPointsObtained(int $points_obtained): void
    {
        $this->points_obtained = $points_obtained;
    }

    public function getTestDate(): string
    {
        return $this->test_date;
    }

    public function setTestDate(string $test_date): void
    {
        $this->test_date = $test_date;
    }

    public function getTestId(): int
    {
        return $this->test_id;
    }

    public function setTestId(int $test_id): void
    {
        $this->test_id = $test_id;
    }

    public function getStudentId(): int
    {
        return $this->student_id;
    }

    public function setStudentId(int $student_id): void
    {
        $this->student_id = $student_id;
    }
}