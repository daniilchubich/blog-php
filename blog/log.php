<?php 
    include("path.php");
    include("app/controllers/users.php");
?>

<!-- START HEADER-->
<?php include("app/include/header.php")?>
<!-- END HEADER-->
<!-- START FORM-->
<div class="container reg_form">
    <form class="row justify-content-center" method="post" action="log.php">
        <h2 class="col-12">Авторизація</h2>
        <div class="mb-3 col-12 col-md-4 err">
            <p><?php include "app/helps/errorInfo.php"; ?></p>
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="formGroupExampleInput" class="form-label">Ваша пошта (при реєстрації)</label>
            <input name="mail" value="<?=$email?>" type="email" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="введіть ваш email...">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1"
                placeholder="введіть ваш пароль...">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <button type="submit" name="button-log" class="btn btn-secondary">Війти</button>
            <a href="reg.php">Зареєструватись</a>
        </div>
    </form>
</div>




</div>
<!-- END FORM-->
<!-- START FOOTER-->
<? include("app/include/footer.php");?>

<!-- FINISH FOOTER-->