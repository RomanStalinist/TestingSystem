<?php
require_once '../db/connection.php';

const seconds = 1440;

if (empty($_POST['action']))
    header('Location: ' . $_SERVER['HTTP_REFERER']);
else
    switch ($_POST['action']) {
        case 'login':
            $student = getStudentByFullNameAndGroupName($_POST['full_name'], $_POST['group_name']);
            if (is_null($student)) {
                $_SESSION['error'] = 'Студент не найден';
                header('Location: ../login.php');
            } else {
                setcookie('student-id', $student->getId(), time() + seconds, '/');
                header('Location: ../.');
            }
            break;

        case 'sign-up':
            try {
                addStudent(new Student(-1, $_POST['full_name'], $_POST['group_name']));
                header('Location: ../.');
            } catch (Exception $ignored) {
                $_SESSION['error'] = "Эти данные уже заняты";
                header('Location: ../sign-up.php');
            }
            break;

        case 'quit':
            setcookie('student-id', '', time() - 1, '/');
            header('Location: ../login.php');
            break;
    }
