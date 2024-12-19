<?php
    
include SITE_ROOT . "/app/database/db.php";

if (!$_SESSION){
    header('location: ' . BASE_URL . 'log.php');
}

$errMsg = [];
$id = '';
$title = '';
$content = '';
$img = '';
$topic = '';

$topics = selectAll('topics');
$posts = selectAll('posts');
$postsAdm = selectAllFromPostsWithUsers('posts', 'users');

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])){

    if (!empty($_FILES['img']['name'])){
        $imgName = time() . "_" . $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $folder = ROOT_PATH . "/assets/images/posts/";
        $destination = $folder . $imgName;

        if (strpos($fileType, 'image') === false) {
            array_push($errMsg, "Файл не є зображенням!");
        }else{
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }
            $result = move_uploaded_file($fileTmpName, $destination);
            //tt($result);
            if ($result){
                $_POST['img'] = $imgName;
                //tt($_POST['img']);
            }else{
                array_push($errMsg, "Помилка завантаження зображння");
            }
        }
    }else{
        array_push($errMsg, "Помилка отримання зображення");
    }

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $topic = trim($_POST['topic']);
    $publish = isset($_POST['publish']) ? 1 : 0;


    if($title === '' || $content === '' || $topic === ''){
        array_push($errMsg, "Не усі поля заповнені!");
    }elseif (mb_strlen($title, 'UTF8') < 7){
        array_push($errMsg, "Назва статті повинна містити більше 7-оми символів");
    }else{
        $post = [
            'id_user' => $_SESSION['id_user'],
            'title' => $title,
            'content' => $content,
            'img' => $_POST['img'],
            'status' => $publish,
            'id_topic' => $topic
        ];

        $post = insert('posts', $post);
        $post = selectOne('posts', ['id' => $id] );
        header('location: ' . BASE_URL . 'admin/posts/index.php');
    }
}else{
    $id = '';
    $title = '';
    $content = '';
    $publish = '';
    $topic = '';
}

// АПДЕЙТ СТАТЬИ
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
    $post = selectOne('posts', ['id' => $_GET['id']]);

    $id =  $post['id'];
    $title =  $post['title'];
    $content = $post['content'];
    $topic = $post['id_topic'];
    $publish = $post['status'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_post'])){
    $id =  $_POST['id'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $topic = trim($_POST['topic']);
    $publish = isset($_POST['publish']) ? 1 : 0;

    if (!empty($_FILES['img']['name'])){
        $imgName = time() . "_" . $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $destination = ROOT_PATH . "\assets\images\posts\\" . $imgName;


        if (strpos($fileType, 'image') === false) {
            array_push($errMsg, "Файл не є зображення!");
        }else{
            $result = move_uploaded_file($fileTmpName, $destination);

            if ($result){
                $_POST['img'] = $imgName;
            }else{
                array_push($errMsg, "Помилка завантаження");
            }
        }
    }else{
        array_push($errMsg, "Помилка отримання зображення");
    }


    if($title === '' || $content === '' || $topic === ''){
        array_push($errMsg, "Не усі поля заповнені!");
    }elseif (mb_strlen($title, 'UTF8') < 7){
        array_push($errMsg, "Назва статті повинна містити більше 7-оми символів");
    }else{
        $post = [
            'id_user' => $_SESSION['id_user'],
            'title' => $title,
            'content' => $content,
            'img' => $_POST['img'],
            'status' => $publish,
            'id_topic' => $topic
        ];

        $post = update('posts', $id, $post);
        header('location: ' . BASE_URL . 'admin/posts/index.php');
    }
}else{
    $title = isset($_POST['title']);
    $content = isset($_POST['content']);
    $publish = isset($_POST['publish']) ? 1 : 0;
    $topic = isset($_POST['id_topic']);
}

// Статус опубликовать или снять с публикации
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])){
    $id = $_GET['pub_id'];
    $publish = $_GET['publish'];

    $postId = update('posts', $id, ['status' => $publish]);

    header('location: ' . BASE_URL . 'admin/posts/index.php');
    exit();
}

// Удаление статьи
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    delete('posts', $id);
    header('location: ' . BASE_URL . 'admin/posts/index.php');
}