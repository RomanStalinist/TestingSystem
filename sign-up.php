<?php
require_once 'db/connection.php';

if (isset($_COOKIE['student-id']))
    header('Location: ./');
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Регистрация</title>
</head>
<body>

<h2>Регистрация</h2>

<form action="api/handler.php" method="post">
    <input type="hidden" name="action" value="sign-up">
    <div class="img-container">
        <img src="./img/img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <?php if (isset($_SESSION['error'])) : ?>
        <div class="alert alert-danger"><?php print $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']); endif ?>

    <div class="container">
        <label for="fio"><b>Фио</b></label>
        <input type="text" placeholder="Введите Фио" name="full_name" id="fio" required>

        <label for="group"><b>Группа</b></label>
        <input type="text" placeholder="Введите Группу" name="group_name" id="group" required>

        <div class="btn-group">
            <button type="submit" class="btn btn-primary py-2">Создать пользователя</button>
            <button type="button" onclick="location.href = 'login.php'" class="btn btn-outline-dark py-2">Авторизация</button>
        </div>
    </div>

    <div class="container" style="background-color:#f1f1f1">
        <button type="reset" class="cancel-btn">Очистить</button>
    </div>
</form>

</body>
</html>
