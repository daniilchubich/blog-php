<?php
include SITE_ROOT . '/app/controllers/commentaries.php';
if (isset($id_post)) {
    $comments = selectAllFromCommentsWithUsers('comments', 'users', ['status' => 1, 'id_posts' => $id_post]);
}
?>

<div class="cpl-md-12 col-12 comments">
    <?php if (isset($_SESSION['login'])): ?>
        <h3>Залишити відгук</h3>
        <div class="mb-12 col-12 col-md-12 err">
            <!-- Вывод массива с ошибками -->
            <?php include SITE_ROOT . '/app/helps/errorInfo.php'; ?>
        </div>

        <?php if (isset($id_post)): ?>
            <form action="<?= BASE_URL . "single.php?post=$id_post" ?>" method="post">
            <?php endif; ?>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Залишити відгук</label>
                <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
            </div>
            <div class="col-12">
                <button type="submit" name="goComment" class="btn btn-primary">Надіслати</button>
            </div>
            </form>
        <?php else: ?>
            <h3>Щоб залишити відкуг<a href="<?php echo BASE_URL ?>log.php ">Авторизуватись</a></h3>
        <?php endif; ?>
        <?php if (isset($comments) && count($comments) > 0): ?>
            <div class="row all-comments">
                <h3 class="col-12">Відкуги до Запису</h3>
                <?php foreach ($comments as $comment): ?>
                    <div class="one-comment col-12">
                        <span><i class="far fa-envelope"></i><?= $comment['username']  ?></span>
                        <span><i class="far fa-calendar-check"></i><?= $comment['created']  ?></span>
                        <div class="col-12 text">
                            <?= $comment['comment']  ?>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endif; ?>
</div>