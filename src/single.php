<?php include('path.php');

include 'app/controllers/topics.php';
$post = selectPostFromPostsWithUsersOnSingle('posts', 'users', $_GET['post']);
?>
<!-- START HEADER-->
<?php include('app/include/header.php') ?>
<!-- END HEADER-->

<!-- Блок MAIN START-->
<div class="container">
    <div class="content row">
        <div class="main-content col-md-9 col-12">
            <h2><?php if (is_array($post) && isset($post['title']) && is_string($post['title'])) {
                echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8');
            } ?></h2>

            <div class="single_post row">
                <div class="img col-12">
                    <?php if (is_array($post) && isset($post['img']) && is_string($post['title']) && is_string($post['img'])): ?>
                        <img src="<?= BASE_URL . 'assets/images/posts/' . htmlspecialchars($post['img'], ENT_QUOTES, 'UTF-8') ?>"
                            alt="<?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>" class="img-thumbnail">
                    <?php endif; ?>
                </div>
                <div class="info">
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
                </div>
                <div class="single_post_text col-12">
                    <?php if (is_array($post) && isset($post['content']) && is_string($post['content'])) {
                        echo htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8');
                    } ?>
                </div>
                <!-- ИНКЛЮДИМ HTML БЛОК С КОММЕНТАРИЯМИ  --->
                <?php include('app/include/comments.php'); ?>
            </div>

        </div>
        <div class="sidebar col-md-3 col-12">
            <div class="section search">
                <h3>Пошук</h3>
                <form action="/" method="post">
                    <input type="text" name="search-term" class="text-input" placeholder="Search...">
                </form>
            </div>
            <?php if (isset($topics) && is_array($topics)): ?>
                <div class="section topics">
                    <h3>Категорії</h3>
                    <ul>

                        <?php foreach ($topics as $key => $topic): ?>
                            <li>
                                <?php if (is_array($topic) && is_int($topic['id']) && is_string($topic['name'])): ?>
                                    <a href="<?= BASE_URL . 'category.php?id=' . $topic['id'] ?>"><?= $topic['name']; ?>
                                    </a>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- FINISH block MAIN-->
<!-- START FOOTER -->
<?php include('app/include/footer.php') ?>
<!-- FINISH FOOTER -->