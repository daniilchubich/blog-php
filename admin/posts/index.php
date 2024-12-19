<?php
        include "../../path.php";
        include "../../app/controllers/posts.php";
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
            <h2>Записи</h2>
            <div class="mb-12 col-12 col-md-12 err">

            </div>
            <div class="col-1">ID</div>
            <div class="col-3">Назва</div>
            <div class="col-3">Автор</div>
            <div class="col-5">Управління</div>
        </div>
        <?php foreach ($postsAdm as $key => $post): ?>
        <div class="row post">
            <div class="id col-1"><?=$key + 1; ?></div>
            <div class="title col-3"><?=mb_substr($post['title'], 0, 50, 'UTF-8'). '...'  ?></div>
            <div class="author col-2"><?=$post['username']; ?></div>
            <div class="red col-2"><a href="edit.php?id=<?=$post['id'];?>">edit</a></div>
            <div class="del col-2"><a href="edit.php?delete_id=<?=$post['id'];?>">delete</a></div>
            <?php if ($post['status']): ?>
            <div class="status col-2"><a href="edit.php?publish=0&pub_id=<?=$post['id'];?>">unpublish</a></div>
            <?php else: ?>
            <div class="status col-2"><a href="edit.php?publish=1&pub_id=<?=$post['id'];?>">publish</a></div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>

    </div>
</div>
</div>
<!-- START FOOTER -->
<?php include("../../app/include/footer.php") ?>
<!-- FINISH FOOTER -->