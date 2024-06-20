<?php
require_once '../db/connection.php';

$test_id = (int)$_POST['test-id'];
$answer = getOptionById((int)$_POST['answer']);

if ($answer->isCorrect())
    setcookie('correct-answers', (string)((int)$_COOKIE['correct-answers'] + 1), time() + 1440, '/');

$q_id = $answer->getQuestionId();

if ($q_id > count(getQuestionsByTestId($test_id)) - 1)
    header("Location: ../finish.php?id=$test_id");
else
    header("Location: ../testing.php?id=$test_id&q_id=$q_id");
