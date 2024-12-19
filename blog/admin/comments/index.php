<?php
        include "../../path.php";
        include "../../app/controllers/commentaries.php";
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Custom Styling -->
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <title>My blog</title>
</head>

<body>

    <?php include("../../app/include/header-admin.php"); ?>

    <div class="container">
        <?php include "../../app/include/sidebar-admin.php"; ?>

        <div class="posts col-9 container">
            <div class="row title-table">
                <h2>Коментарі</h2>
                <div class="mb-12 col-12 col-md-12 err">
                    <p><?=isset($_SESSION['error']);?></p>
                </div>
                <div class="col-1">ID</div>
                <div class="col-2">Запис</div>
                <div class="col-3">Текст</div>
                <div class="col-3">Автор</div>
                <div class="col-3">Управління</div>
            </div>
            <?php foreach ($commentsForAdm as $key => $comment): ?>

            <div class="row post display-standart-comment">
                <div class="id col-1"><?=$comment['id']; ?></div>
                <div class="title col-2"><a
                        href="<?=BASE_URL . 'single.php?post=' . $comment['id_users']; ?>"><?=$comment['title']; ?></a>
                </div>
                <div class="comment col-3"><?=mb_substr($comment['comment'], 0, 20, 'UTF-8'). '...'  ?></div>
                <div class="author col-2"><?=$comment['username']; ?></div>

                <div class="red col-1"><a href="edit.php?id=<?=$comment['id'];?>">edit</a></div>
                <div class="del col-1"><a href="edit.php?delete_id=<?=$comment['id'];?>">delete</a></div>
                <?php if ($comment['status']): ?>
                <div class="status col-1"><a href="edit.php?publish=0&pub_id=<?=$comment['id'];?>">unpublish</a>
                </div>
                <?php else: ?>
                <div class="status col-1"><a href="edit.php?publish=1&pub_id=<?=$comment['id'];?>">publish</a></div>
                <?php endif; ?>


            </div>
            <div class="row post display-mobile-comment">
                <div class="id col-1"><?=$comment['id']; ?></div>
                <div class="title col-2"><a
                        href="<?=BASE_URL . 'single.php?post=' . $comment['id_users']; ?>"><?=$comment['title']; ?></a>
                </div>
                <div class="comment col-3"><?=mb_substr($comment['comment'], 0, 20, 'UTF-8'). '...'  ?></div>
                <div class="author col-2"><?=$comment['username']; ?></div>

                <div class="red col-2"><a href="edit.php?id=<?=$comment['id'];?>">edit</a></div>
                <div class="del col-2"><a href="edit.php?delete_id=<?=$comment['id'];?>">delete</a></div>



            </div>
            <?php endforeach; ?>
        </div>
    </div>
    </div>


    <!-- footer -->
    <?php include("../../app/include/footer.php"); ?>
    <!-- // footer -->