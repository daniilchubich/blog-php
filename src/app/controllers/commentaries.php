<?php

include_once SITE_ROOT . '/app/database/db.php';
$commentsForAdm = selectAllFromCommentsWithUsersOnAdmin('comments', 'users', 'posts', ['status' => 1]);
//tt($commentsForAdm);
$id_post = isset($_GET['post']) ? $_GET['post'] : '';
$email = '';
$comment = '';
$errMsg = [];
$status = 0;
$comments = [];


// ADD Comment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['goComment'])) {



    $comment = trim($_POST['comment']);

    //tt($comment);
    if ($comment === '') {
        array_push($errMsg, 'Не все поля заполнены!');
    } elseif (mb_strlen($comment, 'UTF8') < 50) {
        array_push($errMsg, 'Комментарий должен быть длинее 50 символов');
    } else {


        $comment = [
            'status' => 1,
            'id_posts' => $id_post,
            'id_users' => $_SESSION['id_user'],
            'comment' => $comment
        ];

        $comment = insert('comments', $comment);
        header('Location: ' . BASE_URL);
    }
} else {
    $email = '';
    $comment = '';
}
// DELETE COMMENT
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    delete('comments', $id);
    header('location: ' . BASE_URL . 'admin/comments/index.php');
}

//STATUS Public or NOT Public
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) {
    $id = $_GET['pub_id'];
    $publish = $_GET['publish'];

    $postId = update('comments', $id, ['status' => $publish]);

    header('location: ' . BASE_URL . 'admin/comments/index.php');
    exit();
}


// UPDATE POST
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $oneComment = selectOne('comments', ['id' => $_GET['id']]);
    $id =  $oneComment['id'];
    $text1 = $oneComment['comment'];
    $pub = $oneComment['status'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_comment'])) {
    $id =  $_POST['id'];
    $text = trim($_POST['content']);
    $publish = isset($_POST['publish']) ? 1 : 0;

    if ($text === '') {
        array_push($errMsg, 'Комментарий не имеет содержимого текста');
    } elseif (mb_strlen($text, 'UTF8') < 50) {
        array_push($errMsg, 'Количество символов внутри комментария меньше 50');
    } else {
        $com = [
            'comment' => $text,
            'status' => $publish
        ];

        $comment = update('comments', $id, $com);
        header('location: ' . BASE_URL . 'admin/comments/index.php');
    }
} else {
    if (isset($_POST['content'])) {
        $text = trim($_POST['content']);
    }
    $publish = isset($_POST['publish']) ? 1 : 0;
}
