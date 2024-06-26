<?php
require_once 'db/connection.php';

if (empty($_COOKIE['student-id']))
    header('Location: ./login.php');

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
    <title>Добавление теста</title>
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
                        <h2 class="m-2">Добавление теста</h2>
                        <a href="." class="btn btn-warning m-2">Домой</a>
                    </div>

                    <?php if (isset($_SESSION['error'])) : ?>
                        <div class="alert alert-danger"><?php print $_SESSION['error'] ?></div>
                    <?php endif;
                    unset($_SESSION['error']) ?>

                    <form id="info-form" class="d-flex flex-column mb-2" action="api/add-test-handler.php" method="post">
                        <label> Название
                            <input type="text" id="title" class="form-control mb-2"
                                   name="title" placeholder="Название теста"/>
                        </label>
                        <label> Лимит времени
                            <input type="number" id="seconds_limit" class="form-control mb-2" value="0" step="30"
                                   min="0" max="3600" name="seconds_limit" placeholder="Кол-во времени в секундах"/>
                        </label>

                        <button id="continue-btn" class="btn btn-warning mb-2 w-100">
                            Добавить
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>
