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
    <title>Главная</title>
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
                                 alt="Generic placeholder image" class="img-fluid" style="width: 180px; border-radius: 10px;">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1"><?php print $student->getFullName() ?></h5>
                            <p class="mb-2 pb-1"><?php print $student->getGroupName() ?></p>
                        </div>

                        <form action="api/handler.php" method="post">
                            <input type="hidden" name="action" value="quit">
                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary me-1 flex-grow-1">Выйти</button>
                        </form>
                    </div>

                    <div class="d-inline-flex mt-3 mb-2">
                        <h2 class="m-2" style="">Тесты</h2>
                        <a href="add-test.php" class="btn btn-warning w-50 m-2">Создать</a>
                    </div>
                    <div class="m-2 list-group">
                        <?php
                        $tests = getTests();
                        if (count($tests) > 0) :
                            foreach(getTests() as $test): ?>
                                <a class="list-group-item" href="testing.php?id=<?php print $test->getId() ?>&q_id=0">
                                    <?php print $test->getTitle() .
                                        ' (' .
                                        count(getQuestionsByTestId($test->getId())) .
                                        ' вопросов, ' .
                                        $test->getSecondsLimit() .
                                        ' секунд)';
                                    $best_result = getBestTestResultByTestAndStudentIds($test->getId(), $_COOKIE['student-id']) ?>

                                    <p class="small">
                                        Лучший результат:
                                        <?php
                                        if (isset($best_result))
                                            print $best_result->getPointsObtained() .
                                                '/' .
                                                count(getQuestionsByTestId($test->getId())) .
                                                '. Когда: ' .
                                                $best_result->getTestDate();
                                        else
                                            print 'Отсутствует'
                                        ?>
                                    </p>
                                </a>
                                <a class="btn btn-warning mb-2" style="border-radius: 0 0 8px 8px"
                                   href="add-questions.php?id=<?php print $test->getId() ?>">
                                    Добавить вопросы
                                </a>
                            <?php endforeach;
                        else : ?>
                        <div>Пусто...</div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>