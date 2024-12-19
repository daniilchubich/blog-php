<?php
include SITE_ROOT . "/app/database/db.php";

$errMsg = [];

function userAuth($user){
    $_SESSION['id_user'] = $user['id'];
    $_SESSION['login'] = $user['username'];
    $_SESSION['admin'] = $user['admin'];
    if($_SESSION['admin']){
        header('location: ' . BASE_URL . "admin/posts/index.php");
    }else{
        header('location: ' . BASE_URL);
    }
}

$users = selectAll('users');

// FORM REG
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])){

    $admin = 0;
    $login = trim($_POST['login']);
    $email = trim($_POST['mail']);
    $passF = trim($_POST['pass-first']);
    $passS = trim($_POST['pass-second']);

    if($login === '' || $email === '' || $passF === ''){
        array_push($errMsg, "Заповніть усі поля");
    }elseif (mb_strlen($login, 'UTF8') < 2){
        array_push($errMsg, "Логін повинен мати більш 2-ох символів");
    }elseif ($passF !== $passS) {
        array_push($errMsg, "Паролі не співпадають");
    }else{
        $existence = selectOne('users', ['email' => $email]);
        if($existence['email'] === $email){
            array_push($errMsg,"Користувач з цією електроною поштою вже існує");
        }else{
            $pass = password_hash($passF, PASSWORD_DEFAULT);
            $post = [
                'admin' => $admin,
                'username' => $login,
                'email' => $email,
                'password' => $pass
            ];
            $id = insert('users', $post);
            $user = selectOne('users', ['id' => $id] );
            userAuth($user);
        }
    }
}else{
    $login = '';
    $email = '';
}

// FORM AUTH
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])){
    

    
    $email = trim($_POST['mail']);
    $pass = trim($_POST['password']);
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
        $_SESSION['time_left_end'] = 0;
    }
    $_SESSION['login_attempts'] = isset($_SESSION['login_attempts']) ? $_SESSION['login_attempts']+1 : 1;
    if($_SESSION['login_attempts'] == MAX_ATTEMPTS_AUTH){
        if(time() < $_SESSION['time_left_end']){
            $time_left = $_SESSION['time_left_end'] - time();
            array_push($errMsg,"Перевищіно кількість спроб. Спробуйте через " . ceil($time_left / 60) . " минут.");
        }
    }
    elseif($_SESSION['login_attempts'] > MAX_ATTEMPTS_AUTH){
        if(time() <= $_SESSION['time_left_end']){
            $time_left = $_SESSION['time_left_end'] - time(); //55900 
            array_push($errMsg,"Перевищіно кількість спроб. Спробуйте через " . ceil($time_left / 60) . " минут.");
        }
        else{
            $_SESSION['login_attempts'] = 0;
            $_SESSION['time_left_end'] = 0;
        }
    }
    elseif($email === '' || $pass === '') {
             array_push($errMsg,"Не усі поля зааповнені!");
    }else{
        $existence = selectOne('users', ['email' => $email]);
        if($existence && password_verify($pass, $existence['password'])){
            userAuth($existence);
            unset($_SESSION['login_attempts']);
        }else{
            $errMsg = "Пошта або пароль не дійсні!";
            if(!isset($time_left_end)){
                $_SESSION['time_left_end'] = time() + BLOCK_TIME;
            }
        }
    }
    }else{
        $email = '';
    }

    // ADD USERS FROM ADMIN
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-user'])){


    $admin = 0;
    $login = trim($_POST['login']);
    $email = trim($_POST['mail']);
    $passF = trim($_POST['pass-first']);
    $passS = trim($_POST['pass-second']);

    if($login === '' || $email === '' || $passF === ''){
        array_push($errMsg, "Заповніть усі поля");
    }elseif (mb_strlen($login, 'UTF8') < 2){
        array_push($errMsg, "Логін повинен мати більш 2-ох символів");
    }elseif ($passF !== $passS) {
        array_push($errMsg, "Паролі не співпадають");
    }else{
        $existence = selectOne('users', ['email' => $email]);
        if($existence['email'] === $email){
            array_push($errMsg, "Користувач з цією електроною поштою вже існує");
        }else{
            $pass = password_hash($passF, PASSWORD_DEFAULT);
            if (isset($_POST['admin'])) $admin = 1;
            $user = [
                'admin' => $admin,
                'username' => $login,
                'email' => $email,
                'password' => $pass
            ];
            $id = insert('users', $user);
            $user = selectOne('users', ['id' => $id] );
            userAuth($user);
        }
    }
}else{
    $login = '';
    $email = '';
}
    
// Код удаления пользователя в админке
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    delete('users', $id);
    header('location: ' . BASE_URL . 'admin/users/index.php');
}

// РЕДАКТИРОВАНИЕ ПОЛЬЗОВАТЕЛЯ ЧЕРЕЗ АДМИНКУ
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])){
    $user = selectOne('users', ['id' => $_GET['edit_id']]);

    $id =  $user['id'];
    $admin =  $user['admin'];
    $username = $user['username'];
    $email = $user['email'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-user'])){

    $id = $_POST['id'];
    $mail = trim($_POST['mail']);
    $login = trim($_POST['login']);
    $passF = trim($_POST['pass-first']);
    $passS = trim($_POST['pass-second']);
    $admin = isset($_POST['admin']) ? 1 : 0;

    if($login === ''){
        array_push($errMsg, "Заповніть усі поля");
    }elseif (mb_strlen($login, 'UTF8') < 2){
        array_push($errMsg, "Логін повинен мати більш 2-ох символів");
    }elseif ($passF !== $passS) {
        array_push($errMsg, "Паролі не співпадають");
    }else{
        $pass = password_hash($passF, PASSWORD_DEFAULT);
        if (isset($_POST['admin'])) $admin = 1;
        $user = [
            'admin' => $admin,
            'username' => $login,
            'email' => $mail,
            'password' => $pass
        ];

        $user = update('users', $id, $user);
        header('location: ' . BASE_URL . 'admin/users/index.php');
    }
}else{
    $id =  isset($user['id']);
    $admin =  isset($user['admin']);
    $username = isset($user['username']);
    $email = isset($user['email']);
}