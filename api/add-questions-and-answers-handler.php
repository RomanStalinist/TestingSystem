<?php
require_once '../db/connection.php';

function ake(string $key, array $arr) : bool
{
    return array_key_exists($key, $arr);
}

function e(mixed $value) : bool
{
    return empty($value);
}

if (!ake('test_id', $_POST) || !ake('q_text', $_POST) || !ake('image_url', $_POST)
    || !ake('answer1', $_POST) || !ake('answer2', $_POST) || !ake('answer3', $_POST)
    || !ake('answer4', $_POST)
    || e($_POST['test_id']) || e($_POST['q_text']) || e($_POST['image_url'])
    || e($_POST['answer1']) || e($_POST['answer2']) || e($_POST['answer3'])
    || e($_POST['answer4'])) {
    $_SESSION['error'] = 'Не все поля верно заполнены';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    $text = $_POST['q_text'];
    $test_id = (int)$_POST['test_id'];
    $image = $_POST['image_url'];
    $answer1 = $_POST['answer1'];
    $answer2 = $_POST['answer2'];
    $answer3 = $_POST['answer3'];
    $answer4 = $_POST['answer4'];

    addQuestion(new Question(-1, $text, $image, $test_id));

    $questions = getQuestions();
    $last_id = $questions[count($questions) - 1]->getId();
    addOption(new Option(-1, $answer1, $last_id, is_correct: true));

    foreach ([$answer2, $answer3, $answer4] as $a)
        addOption(new Option(-1, $a, $last_id));

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
