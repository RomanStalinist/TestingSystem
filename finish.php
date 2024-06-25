<?php
require_once 'db/connection.php';

if (!array_key_exists('id', $_GET)
    || !array_key_exists('correct-answers', $_COOKIE)
    || !array_key_exists('student-id', $_COOKIE))
    header('Location: .');

$student = getStudentById($_COOKIE['student-id']);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a7/React-icon.svg/2300px-React-icon.svg.png"/>
    <title>Результаты</title>
</head>
<body>

<h2>Результаты</h2>

<section class="container">
    <div class="row d-flex justify-content-center">
        <div class="col col-md-9 col-lg-7 col-xl-6">
            <div class="card" style="border-radius: 15px;">
                <div class="card-body p-4">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-profiles/avatar-1.webp" alt="Generic placeholder image" class="img-fluid" style="width: 180px; border-radius: 10px;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1"><?php print $student->getFullName() ?></h5>
                            <p class="mb-2 pb-1"><?php print $student->getGroupName() ?></p>
                        </div>

                        <form action="api/handler.php" method="post">
                            <input type="hidden" name="action" value="quit">
                            <button data-mdb-button-init="" data-mdb-ripple-init="" class="btn btn-outline-primary me-1 flex-grow-1">Выйти</button>
                        </form>
                    </div>

                    <div class="d-inline-flex mt-3 mb-2">
                        <h2 class="m-2">Результаты</h2>
                        <a href="." class="btn btn-warning w-50 m-2">Домой</a>
                    </div>

                    <div class="m-2 list-group">
                        <p>Тест "<?php print getTestById($_GET['id'])->getTitle() ?>"</p>
                        <p>Верные ответы:
                            <?php print $_COOKIE['correct-answers'] . ' / ' . count(getQuestionsByTestId($_GET['id'])) ?>
                        </p>
                        <?php addTestResult(new TestResult(-1, $_GET['id'], $_COOKIE['student-id'], $_COOKIE['correct-answers']));
                        setcookie('correct-answers', '', time() - 1, '/') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
