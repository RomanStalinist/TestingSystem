<?php
require_once '../db/connection.php';

if (!array_key_exists('title', $_POST) || !array_key_exists('seconds_limit', $_POST))
    header('Location: '. $_SERVER['HTTP_REFERER']);

$title = $_POST['title'];
$seconds_limit = $_POST['seconds_limit'];

if (empty($title) || empty($seconds_limit)) {
    $_SESSION['error'] = 'Не все поля заполнены';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} elseif ($seconds_limit < 30) {
    $_SESSION['error'] = 'Минимальное время: 30 секунд';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    addTest(new Test(-1, $title, $seconds_limit));
    define("tests", getTests());
    header('Location: ../add-questions.php?id=' . tests[count(tests) - 1]->getId());
}
