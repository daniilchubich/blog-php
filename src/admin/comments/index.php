<?php
include '../../path.php';
include '../../app/controllers/commentaries.php';
?>


<?php include('../../app/include/header-admin.php'); ?>

<div class="container">
    <?php include '../../app/include/sidebar-admin.php'; ?>

    <div class="posts col-12 col-md-9">
        <div class="row title-table">
            <h2>Коментарі</h2>
            <div class="mb-12 col-12 col-md-12 err">
                <p><?= isset($_SESSION['error']); ?></p>
            </div>
            <div class="col-1">ID</div>
            <div class="col-2">Запис</div>
            <div class="col-3">Текст</div>
            <div class="col-3">Автор</div>
            <div class="col-3">Управління</div>
        </div>
        <?php if (isset($commentsForAdm) && is_array($commentsForAdm)): ?>
            <?php foreach ($commentsForAdm as $key => $comment): ?>

                <div class="row post display-standart-comment">
                    <div class="id col-1"><?= $comment['id']; ?></div>
                    <div class="title col-2"><a
                            href="<?= BASE_URL . 'single.php?post=' . $comment['id_users']; ?>"><?= $comment['title']; ?></a>
                    </div>
                    <div class="comment col-3"><?= mb_substr($comment['comment'], 0, 20, 'UTF-8') . '...'  ?></div>
                    <div class="author col-2"><?= $comment['username']; ?></div>

                    <div class="red col-1"><a href="edit.php?id=<?= $comment['id']; ?>">edit</a></div>
                    <div class="del col-1"><a href="edit.php?delete_id=<?= $comment['id']; ?>">delete</a></div>
                    <?php if ($comment['status']): ?>
                        <div class="status col-1"><a href="edit.php?publish=0&pub_id=<?= $comment['id']; ?>">unpublish</a>
                        </div>
                    <?php else: ?>
                        <div class="status col-1"><a href="edit.php?publish=1&pub_id=<?= $comment['id']; ?>">publish</a></div>
                    <?php endif; ?>


                </div>
                <div class="row post display-mobile-comment">
                    <div class="id col-1"><?= $comment['id']; ?></div>
                    <div class="title col-2"><a
                            href="<?= BASE_URL . 'single.php?post=' . $comment['id_users']; ?>"><?= $comment['title']; ?></a>
                    </div>
                    <div class="comment col-3"><?= mb_substr($comment['comment'], 0, 20, 'UTF-8') . '...'  ?></div>
                    <div class="author col-2"><?= $comment['username']; ?></div>

                    <div class="red col-2"><a href="edit.php?id=<?= $comment['id']; ?>">edit</a></div>
                    <div class="del col-2"><a href="edit.php?delete_id=<?= $comment['id']; ?>">delete</a></div>



                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
</div>


<!-- footer -->
<?php include('../../app/include/footer.php'); ?>
<!-- // footer -->