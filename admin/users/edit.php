<?php 
include "../../path.php";
include "../../app/controllers/users.php";
?>
<?php include("../../app/include/header-admin.php"); ?>

<div class="container">
    <?php include "../../app/include/sidebar-admin.php"; ?>

    <div class="posts col-9">
        <div class="button row">
            <a href="<?php echo BASE_URL . "admin/users/create.php";?>" class="col-2 btn btn-success">Створити</a>
            <span class="col-1"></span>
        </div>
        <div class="row title-table">
            <h2>Змінити Користувача</h2>
        </div>
        <div class="row add-post">
            <div class="mb-12 col-12 col-md-12 err">
                <?php include "../../app/helps/errorInfo.php"; ?>
            </div>
            <form action="edit.php" method="post">
                <input name="id" value="<?=$id;?>" type="hidden">
                <div class="col">
                    <label for="formGroupExampleInput" class="form-label">Логін</label>
                    <input name="login" value="<?=$username;?>" type="text" class="form-control"
                        id="formGroupExampleInput" placeholder="введите ваш логин...">
                </div>
                <div class="col">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input name="mail" value="<?=$email;?>" type="email" class="form-control" readonly
                        id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="введите ваш email...">
                </div>
                <div class="col">
                    <label for="exampleInputPassword1" class="form-label">Сброс паролю</label>
                    <input name="pass-first" type="password" class="form-control" id="exampleInputPassword1"
                        placeholder="введите ваш пароль...">
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
                    <button name="update-user" class="btn btn-primary" type="submit">Обновити</button>
                </div>
            </form>
        </div>

    </div>
</div>
</div>


<!-- footer -->
<?php include("../../app/include/footer.php"); ?>
<!-- // footer -->