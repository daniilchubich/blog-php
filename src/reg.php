<?php
include('path.php');
include('app/controllers/users.php');
?>



<!-- START HEADER-->
<?php include('app/include/header.php') ?>
<!-- END HEADER-->

<!-- START FORM-->
<div class="container reg_form">


    <form action="reg.php" method="post" class="row justify-content-center">
        <h2>Форма регистрации</h2>
        <div class="mb-3 col-12 col-md-4 err">
            <p><?php include 'app/helps/errorInfo.php'; ?></p>
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="formGroupExampleInput" class="form-label">Ваш логин</label>
            <?php if (isset($login) && is_string($login)): ?>
                <input name="login" value="<?= $login ?>" type="text" class="form-control" id="formGroupExampleInput"
                    placeholder="введите ваш логин...">
            <?php endif; ?>
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <?php if (isset($email) && is_string($email)): ?>
                <input name="mail" value="<?= $email ?>" type="text" class="form-control" id="formGroupExampleInput"
                    placeholder="введите ваш логин...">
            <?php else: ?>
                <input name="mail" value="" type="text" class="form-control" id="formGroupExampleInput"
                    placeholder="введите ваш логин...">
            <?php endif; ?>
            <div id="emailHelp" class="form-text">Ваш email адрес не будет использован для спама!</div>
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input name="pass-first" type="password" class="form-control" id="exampleInputPassword1"
                placeholder="введите ваш пароль...">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="exampleInputPassword2" class="form-label">Повторите пароль</label>
            <input name="pass-second" type="password" class="form-control" id="exampleInputPassword2"
                placeholder="повторите ваш пароль...">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <button type="submit" class="btn btn-secondary" name="button-reg">Регистрация</button>
            <a href="log.php">Войти</a>
        </div>
    </form>




</div>
<!-- END FORM-->

<!-- START FOOTER -->
<?php include('app/include/footer.php') ?>
<!-- FINISH FOOTER -->