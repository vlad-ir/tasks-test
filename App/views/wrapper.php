<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $title ?></title>
    <link href="../public/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <header class="navbar navbar-expand py-2 bg-warning border-bottom">
        <div class="container">
            <div class="col d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div><a class="text-decoration-none" href="./">Главная страница</a></div>
                <div>
                    <?php if (isset($USER_ARR)) : ?>
                        <span><?= $USER_ARR['username'] ?></span>
                        <form class="d-inline-block" action="./logout" method="POST">
                            <button class="border-0 btn btn-primary">Выход</button>
                        </form>
                    <?php else : ?>
                        <a class="text-decoration-none btn btn-primary" href="./login">Войти</a>
                    <?php endif; ?>
                    <a class="text-decoration-none btn btn-success" href="./add">Добавить задачу</a>
                </div>
            </div>
        </div>
    </header>