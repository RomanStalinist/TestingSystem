<?php

session_start();
require_once 'Test.php';
require_once 'Option.php';
require_once 'Student.php';
require_once 'Question.php';
require_once 'TestResult.php';

$values = parse_ini_file('.ini', true);
define('connection', new PDO(
    $values['database']['dsn'],
    $values['database']['username'],
    $values['database']['password']
));

/**
 * @return Student[]
 **/
function getStudents() : array
{
    $result = connection->query('SELECT * FROM students');
    $students = [];
    while ($row = $result->fetchObject()) {
        $students[] = new Student(
            $row->id,
            $row->full_name,
            $row->group_name
        );
    }
    return $students;
}

function getStudentById(int $id) : ?Student
{
    $stmt = connection->prepare('SELECT * FROM students WHERE id = ?');
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetchObject();
    if ($row)
        return new Student(
            $row->id,
            $row->full_name,
            $row->group_name
        );
    return null;
}

function getStudentByFullNameAndGroupName(string $full_name, string $group_name) : ?Student
{
    $stmt = connection->prepare('SELECT * FROM students WHERE full_name = ? AND group_name = ?');
    $stmt->bindValue(1, $full_name);
    $stmt->bindValue(2, $group_name);
    $stmt->execute();
    $row = $stmt->fetchObject();
    if ($row)
        return new Student(
            $row->id,
            $row->full_name,
            $row->group_name
        );
    return null;
}

function addStudent(Student $student) : void
{
    $stmt = connection->prepare('INSERT INTO students (full_name, group_name) VALUES (?, ?)');
    $stmt->bindValue(1, $student->getFullName());
    $stmt->bindValue(2, $student->getGroupName());
    $stmt->execute();
}

/**
 * @return Test[]
 **/
function getTests() : array
{
    $result = connection->query('SELECT * FROM tests');
    $tests = [];
    while ($row = $result->fetchObject())
        $tests[] = new Test(
            $row->id,
            $row->title,
            $row->seconds_limit
        );
    return $tests;
}

function getTestById(int $id) : ?Test
{
    $stmt = connection->prepare('SELECT * FROM tests WHERE id = ?');
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetchObject();

    if ($row)
        return new Test(
            $row->id,
            $row->title,
            $row->seconds_limit
        );
    return null;
}

function addTest(Test $test) : void
{
    $stmt = connection->prepare('INSERT INTO tests (title, seconds_limit) VALUES (?, ?)');
    $stmt->bindValue(1, $test->getTitle());
    $stmt->bindValue(2, $test->getSecondsLimit());
    $stmt->execute();
}

/**
 * @return Question[]
 **/
function getQuestions() : array
{
    $result = connection->query('SELECT * FROM questions');
    $questions = [];
    while ($row = $result->fetchObject())
        $questions[] = new Question(
            $row->id,
            $row->text,
            $row->image_url,
            $row->test_id
        );
    return $questions;
}

function getQuestionById(int $id) : ?Question
{
    $stmt = connection->prepare('SELECT * FROM questions WHERE id = ?');
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetchObject();

    if ($row)
        return new Question(
            $row->id,
            $row->text,
            $row->image_url,
            $row->test_id
        );
    return null;
}

function addQuestion(Question $question) : void
{
    $stmt = connection->prepare('INSERT INTO questions (text, image_url, test_id) VALUES (?, ?, ?)');
    $stmt->bindValue(1, $question->getText());
    $stmt->bindValue(2, $question->getImageUrl());
    $stmt->bindValue(3, $question->getTestId(), PDO::PARAM_INT);
    $stmt->execute();
}

/**
 * @return Question[]
 **/
function getQuestionsByTestId(int $test_id) : array
{
    $stmt = connection->prepare('SELECT * FROM questions WHERE test_id = ?');
    $stmt->bindValue(1, $test_id, PDO::PARAM_INT);
    $stmt->execute();
    $questions = [];
    while ($row = $stmt->fetchObject())
        $questions[] = new Question(
            $row->id,
            $row->text,
            $row->image_url,
            $row->test_id
        );
    return $questions;
}

/**
 * @return Option[]
 **/
function getOptionsRandomly() : array
{
    $result = connection->query('SELECT * FROM options ORDER BY RAND()');
    $options = [];
    while ($row = $result->fetchObject())
        $options[] = new Option(
            $row->id,
            $row->option_text,
            $row->question_id,
            $row->is_correct
        );
    return $options;
}

function getOptionById(int $id) : ?Option
{
    $stmt = connection->prepare('SELECT * FROM options WHERE id = ?');
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetchObject();

    if ($row)
        return new Option(
            $row->id,
            $row->option_text,
            $row->question_id,
            $row->is_correct
        );
    return null;
}

/**
 * @return Option[]
 **/
function getOptionsByQuestionIdRandomly(int $question_id) : array
{
    $stmt = connection->prepare('SELECT * FROM options WHERE question_id = ? ORDER BY RAND()');
    $stmt->bindValue(1, $question_id, PDO::PARAM_INT);
    $stmt->execute();
    $options = [];
    while ($row = $stmt->fetchObject())
        $options[] = new Option(
            $row->id,
            $row->option_text,
            $row->question_id,
            $row->is_correct
        );
    return $options;
}

function addOption(Option $option) : void
{
    $stmt = connection->prepare('INSERT INTO options (option_text, is_correct, question_id) VALUES (?, ?, ?)');
    $stmt->bindValue(1, $option->getText());
    $stmt->bindValue(2, $option->isCorrect(), PDO::PARAM_BOOL);
    $stmt->bindValue(3, $option->getQuestionId(), PDO::PARAM_INT);
    $stmt->execute();
}

/**
 * @return TestResult[]
 **/
function getTestResults() : array
{
    $result = connection->query('SELECT * FROM test_results');
    $test_results = [];
    while ($row = $result->fetchObject())
        $test_results[] = new TestResult(
            $row->id,
            $row->test_id,
            $row->student_id,
            $row->points_obtained,
            $row->test_date
        );
    return $test_results;
}

function getBestTestResultByTestAndStudentIds(int $test_id, int $student_id) : ?TestResult
{
    $stmt = connection->prepare('
    SELECT * FROM test_results
             WHERE test_id = ? AND student_id = ?
             ORDER BY points_obtained DESC
             LIMIT 1
    ');

    $stmt->bindValue(1, $test_id, PDO::PARAM_INT);
    $stmt->bindValue(2, $student_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetchObject();

    if ($row)
        return new TestResult(
            $row->id,
            $row->test_id,
            $row->student_id,
            $row->points_obtained,
            $row->test_date
        );
    return null;
}

function addTestResult(TestResult $test_result) : void
{
    $stmt = connection->prepare('INSERT INTO test_results (test_id, student_id, points_obtained, test_date) VALUES (?, ?, ?, ?)');
    $stmt->bindValue(1, $test_result->getTestId());
    $stmt->bindValue(2, $test_result->getStudentId(), PDO::PARAM_BOOL);
    $stmt->bindValue(3, $test_result->getPointsObtained(), PDO::PARAM_INT);
    $stmt->bindValue(4, $test_result->getTestDate());
    $stmt->execute();
}
