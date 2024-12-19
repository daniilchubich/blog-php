<?php
        include "../../path.php";
        include "../../app/controllers/users.php";
?>
<?php include("../../app/include/header-admin.php"); ?>

<div class="container">
    <?php include "../../app/include/sidebar-admin.php"; ?>

    <div class="posts col-9">
        <div class="button row">
            <span class="col-1"></span>

        </div>
        <div class="row title-table">
            <h2>Створити Користувача</h2>
        </div>
        <div class="row add-post">
            <div class="mb-12 col-12 col-md-12 err">
                <!-- Вывод массива с ошибками -->
                <p><?php include "../../app/helps/errorInfo.php"; ?></p>
            </div>
            <form action="create.php" method="post">
                <div class="col">
                    <label for="formGroupExampleInput" class="form-label">Ваш логін</label>
                    <input name="login" value="<?=$login?>" type="text" class="form-control" id="formGroupExampleInput"
                        placeholder="введіть ваш логин...">
                </div>
                <div class="col">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input name="mail" value="<?=$email?>" type="email" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="введіть ваш email...">
                </div>
                <div class="col">
                    <label for="exampleInputPassword1" class="form-label">Пароль</label>
                    <input name="pass-first" type="password" class="form-control" id="exampleInputPassword1"
                        placeholder="введіть ваш пароль...">
                </div>
                <div class="col">
                    <label for="exampleInputPassword2" class="form-label">Повторите пароль</label>
                    <input name="pass-second" type="password" class="form-control" id="exampleInputPassword2"
                        placeholder="повторите ваш пароль...">
                </div>
                <input name="admin" class="form-check-input" value="1" type="checkbox" id="flexCheckChecked">
                <label class="form-check-label" for="flexCheckChecked">
                    Admin?
                </label>
                <div class="col">
                    <button name="create-user" class="btn btn-primary" type="submit">Створити</button>
                </div>
            </form>
        </div>

    </div>
</div>
</div>
<!-- START FOOTER -->
<?php include("../../app/include/footer.php") ?>
<!-- FINISH FOOTER -->