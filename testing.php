<?php
require_once 'db/connection.php';

if (empty($_COOKIE['student-id']))
    header('Location: ./login.php');

if (!array_key_exists('id', $_GET))
    header('Location: .');

$test_id = (int)$_GET['id'];
$test = getTestById($test_id);
$q_id = getQuestionsByTestId($test_id)[$_GET['q_id']]->getId();
$question = getQuestionById($q_id);

if (empty($test) || empty($question))
    header('Location: .');

if ($q_id == 1)
    setcookie('correct-answers', '0', time() + 1440, '/')
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a7/React-icon.svg/2300px-React-icon.svg.png"/>
    <title>Тестирование</title>
</head>
<body>

<h2>Тестирование</h2>

<form class="container" action="api/test-handler.php" method="post">
    <input type="hidden" name="test-id" value="<?php print $_GET['id'] ?>">
    <h3 class="p-2"><?php print $question->getText() ?></h3>
    <img width="200" class="p-2" src="<?php print $question->getImageUrl() ?>" alt="image">
    <div class="list-group" class="p-2">
        <?php
        $options = getOptionsByQuestionIdRandomly($question->getId());
        foreach ($options as $o) : ?>
        <div class="form-check mb-3">
            <input class="form-check-input" type="radio" name="answer"
                   id="answer<?php print $o->getId() ?>"
                   value="<?php print $o->getId() ?>">
            <label class="form-check-label" for="answer<?php print $o->getId() ?>">
                <?php print $o->getText() ?>
            </label>
        </div>
        <?php endforeach ?>
    </div>
    <button class="btn btn-warning w-100 mb-2">Далее</button>
    <a href="." class="btn btn-warning w-100">Домой</a>
</form>

<script>
    let secs = 0;
    setInterval(() => {
        secs++;
        if (secs === <?php print $test->getSecondsLimit() ?>)
            location.href = 'finish.php?id=<?php print $_GET['id'] ?>';
    }, 1000);
</script>
</body>
</html>
