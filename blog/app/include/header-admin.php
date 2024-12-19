<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My blog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>

<body>
    <header class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <h1>
                        <a href="<?php echo BASE_URL ?>">My blog</a>
                    </h1>
                </div>
                <nav class="col-8">
                    <ul>
                        <li class="nav-user">
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <?php echo $_SESSION['login']; ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_URL . "logout.php"; ?>">Вихід</a>
                        </li>
                        <li class="mobile">
                            <a href="#">
                                <i class="fa-solid fa-bars"></i>
                            </a>
                            <ul>
                                <li>
                                    <a href="<?php echo BASE_URL . "admin/posts/index.php";?>">Записи</a>
                                </li>
                                <li>
                                    <a href="<?php echo BASE_URL . "admin/topics/index.php";?>">Категорії</a>
                                </li>
                                <li>
                                    <a href="<?php echo BASE_URL . "admin/users/index.php";?>">Користувачі</a>
                                </li>
                                <li>
                                    <a href="<?php echo BASE_URL . "admin/comments/index.php";?>">Відгуки</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>