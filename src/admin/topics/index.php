<?php
include '../../path.php';
include '../../app/controllers/topics.php';
?>
<?php include('../../app/include/header-admin.php'); ?>

<div class="container">
    <?php include '../../app/include/sidebar-admin.php'; ?>
    <div class="posts col-12 col-md-9">
        <div class="button row">
            <a href="<?php echo BASE_URL . 'admin/users/create.php'; ?>"
                class="col-4 btn btn-success"><span>Створити</span><i class="fa-solid fa-plus"></i></a>
            <ipan class="col-1"></span>

        </div>
        <div class="row title-table">
            <h2>Категорії</h2>
            <div class="mb-12 col-12 col-md-12 err">
                <p></p>
            </div>
            <div class="col-1">ID</div>
            <div class="col-5">Назва</div>
            <div class="col-4">Управління</div>
        </div>
        <?php if (isset($topics) && is_array($topics)): ?>
            <?php foreach ($topics as $key => $topic): ?>
                <div class="row post">
                    <div class="id col-1"><?= $key + 1; ?></div>
                    <div class="title col-5"><?= $topic['name']; ?></div>
                    <div class="red col-2"><a href="edit.php?id=<?= $topic['id']; ?>">edit</a></div>
                    <div class="del col-2"><a href="index.php?del_id=<?= $topic['id']; ?>">delete</a></div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
</div>
<!-- START FOOTER -->
<?php include('../../app/include/footer.php') ?>
<!-- FINISH FOOTER -->