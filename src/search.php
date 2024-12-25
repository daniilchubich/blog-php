<?php
include 'path.php';
include SITE_ROOT . '/app/database/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search-term'])) {
    $posts = seacrhInTitileAndContent($_POST['search-term'], 'posts', 'users');
}
?>
<?php include('app/include/header.php'); ?>


<!-- блок main-->
<div class="container">
    <div class="content row">
        <!-- Main Content -->
        <div class="main-content col-12">
            <h2>Результати пошуку</h2>
            <?php if (isset($posts) && is_array($posts)): ?>
            <?php foreach ($posts as $post): ?>
            <div class="post row">
                <div class="img col-12 col-md-4">
                    <?php if (is_array($post) && isset($post['img']) && is_string($post['title']) && is_string($post['img'])): ?>
                    <img src="<?= BASE_URL . 'assets/images/posts/' . htmlspecialchars($post['img'], ENT_QUOTES, 'UTF-8') ?>"
                        alt="<?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>" class="img-thumbnail">
                    <?php endif; ?>

                </div>
                <div class="post_text col-12 col-md-8">
                    <h3>
                        <?php if (is_array($post) && is_int($post['id']) && is_string($post['title'])): ?>
                        <a href="<?= BASE_URL . 'single.php?post=' . $post['id'] ?>"><?= $post['title']; ?>
                        </a>
                        <?php endif; ?>
                    </h3>
                    <i class="far fa-user">
                        <?php if (is_array($post) && isset($post['username']) && is_string($post['username'])) {
                            echo htmlspecialchars($post['username'], ENT_QUOTES, 'UTF-8');
                        } ?>
                    </i>
                    <i class="far fa-calendar">
                        <?php if (is_array($post) && isset($post['created']) && is_string($post['created'])) {
                            echo htmlspecialchars($post['created'], ENT_QUOTES, 'UTF-8');
                        } ?>
                    </i>
                    <p class="preview-text">
                        <?php if (is_array($post) && isset($post['content']) && is_string($post['content'])) {
                            echo mb_substr(htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8'), 0, 55, 'UTF-8') . '...';
                        } ?>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>
</div>

<!-- блок main END-->
<!-- footer -->
<?php include('app/include/footer.php'); ?>
<!-- // footer -->