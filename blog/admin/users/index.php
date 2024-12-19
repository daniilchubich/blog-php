<?php
include "../../path.php";
include "../../app/controllers/users.php";
?>

<?php include("../../app/include/header-admin.php"); ?>

<div class="container">

    <?php include "../../app/include/sidebar-admin.php"; ?>

    <div class="posts col-9 container">
        <div class="button row">
            <a href="<?php echo BASE_URL . "admin/users/create.php";?>"
                class="col-4 btn btn-success"><span>Створити</span><i class="fa-solid fa-plus"></i></a>
            <ipan class="col-1"></span>

        </div>
        <div class="row title-table">
            <h2>Користувачі</h2>
            <div class="col-1">ID</div>
            <div class="col-2">Логін</div>
            <div class="col-3">Email</div>
            <div class="col-2">Роль</div>
            <div class="col-4">Управління</div>
        </div>
        <?php foreach ($users as $key => $user): ?>
        <div class="row post">
            <div class="col-1"><?=$user['id'];?></div>
            <div class="col-2"><?=$user['username'];?></div>

            <div class="col-3 email"><?=$user['email'];?>
                <div class="email-full"><?=$user['email'];?></div>
            </div>
            <?php if($user['admin'] == 1): ?>
            <div class=" col-2">Admin</div>
            <?php else: ?>
            <div class="col-2">User</div>
            <?php endif; ?>
            <div class="red col-2"><a href="edit.php?edit_id=<?=$user['id'];?>">edit</a></div>
            <div class="del col-2"><a href="index.php?delete_id=<?=$user['id'];?>">delete</a></div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
</div>


<!-- footer -->
<?php include("../../app/include/footer.php"); ?>
<!-- // footer -->