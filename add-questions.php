<?php
require_once 'db/connection.php';

if (empty($_COOKIE['student-id']))
    header('Location: ./login.php');

if (!array_key_exists('id', $_GET))
    header('Location: ' . $_SERVER['HTTP_REFERER']);

$test_id = $_GET['id'];
$test = getTestById($test_id);

$student = getStudentById($_COOKIE['student-id']);
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a7/React-icon.svg/2300px-React-icon.svg.png"/>
    <title>Добавление вопросов</title>
</head>
<body>

<section class="container">
    <div class="row d-flex justify-content-center">
        <div class="col col-md-9 col-lg-7 col-xl-6">
            <div class="card" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp"
                                 alt="Generic placeholder image" class="img-fluid"
                                 style="width: 180px; border-radius: 10px;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1"><?php print $student->getFullName() ?></h5>
                            <p class="mb-2 pb-1"><?php print $student->getGroupName() ?></p>
                        </div>

                        <form action="api/handler.php" method="post">
                            <input type="hidden" name="action" value="quit">
                            <button data-mdb-button-init data-mdb-ripple-init
                                    class="btn btn-outline-primary me-1 flex-grow-1">Выйти</button>
                        </form>
                    </div>

                    <div class="d-inline-flex mt-3 mb-2">
                        <h2 class="m-2">Тест "<?php print $test->getTitle() ?>"</h2>
                        <a class="btn btn-warning m-2" href=".">Домой</a>
                    </div>

                    <form id="answers-form" class="d-flex flex-column" method="post"
                          action="api/add-questions-and-answers-handler.php">
                        <h5>Вопрос <?php print count(getQuestionsByTestId($test_id)) + 1 ?></h5>

                        <?php if (isset($_SESSION['error'])) : ?>
                            <div class="alert alert-danger"><?php print $_SESSION['error'] ?></div>
                        <?php endif;
                        unset($_SESSION['error']); ?>

                        <input type="hidden" name="test_id" value="<?php print $test_id ?>">
                        <label> Текст вопроса
                            <input type="text" tabindex="0" id="q_text" class="form-control mb-2"
                                   name="q_text" placeholder="Текст вопроса"/>
                        </label>
                        <label> Адрес картинки
                            <input type="url" tabindex="1" id="image_url" class="form-control mb-2"
                                   name="image_url" placeholder="Адрес картинки"/>
                        </label>
                        <label> Ответы
                            <input type="text" tabindex="2" id="answer1" class="form-control mb-2"
                                   name="answer1" placeholder="Первый ответ (верный)"/>
                        </label>
                        <label>
                            <input type="text" tabindex="3" id="answer2" class="form-control mb-2"
                                   name="answer2" placeholder="Второй ответ"/>
                        </label>
                        <label>
                            <input type="text" tabindex="4" id="answer3" class="form-control mb-2"
                                   name="answer3" placeholder="Третий ответ"/>
                        </label>
                        <label>
                            <input type="text" tabindex="5" id="answer4" class="form-control mb-2"
                                   name="answer4" placeholder="Четвертый ответ"/>
                        </label>

                        <button id="continue-btn" tabindex="6" class="btn btn-warning mb-2">
                            Добавить
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
