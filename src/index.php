<?php
include('path.php');
include 'app/controllers/topics.php';

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 2;
$offset = $limit * ($page - 1);
if (is_int(countRow('posts'))) {
    $countRow = round(countRow('posts'));
}
if (isset($countRow) && is_float($countRow)) {
    $total_pages = $countRow / $limit;
}

$posts = selectAllFromPostsWithUsersOnIndex('posts', 'users', $limit, $offset);
$topTopic = selectTopTopicFromPostsOnIndex('posts');
?>

<?php include('app/include/header.php') ?>
<!-- Блок карусели START-->
<div class="container carousel-hidden">
    <div class="row">
        <h2 class="slider-title">Top Posts</h2>
    </div>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($topTopic as $key => $post): ?>
                <div class="carousel-item <?= $key === 0 ? 'active' : '' ?>">
                    <img src="<?= BASE_URL . 'assets/images/posts/' . htmlspecialchars($post['img']) ?>"
                        alt="<?= htmlspecialchars($post['title']) ?>" class="d-block w-100">
                    <div class="carousel-caption carousel-caption-hack d-none d-md-block">
                        <h5>
                            <a href="<?= BASE_URL . 'single.php?post=' . urlencode($post['id']) ?>">
                                <?= htmlspecialchars(substr($post['title'], 0, 120)) . '...' ?>
                            </a>
                        </h5>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>





<!-- FINISH block carusel-->

<div class="container">
    <div class="content row">
        <!-- Main Content -->
        <div class="main-content col-md-9 col-12">
            <h2>Останні Новини</h2>
            <?php foreach ($posts as $post): ?>
                <div class="post row">
                    <div class="img col-12 col-md-4">
                        <img src="<?= BASE_URL . 'assets/images/posts/' . $post['img'] ?>" alt="<?= $post['title'] ?>"
                            class="img-thumbnail h-100">
                    </div>
                    <div class="post_text col-12 col-md-8">
                        <h3>
                            <a
                                href="<?= BASE_URL . 'single.php?post=' . $post['id']; ?>"><?= substr($post['title'], 0, 80) . '...'  ?></a>
                        </h3>
                        <i class="far fa-user"> <?= $post['username']; ?></i>
                        <i class="far fa-calendar"> <?= $post['created']; ?></i>
                        <p class="preview-text">

                            <?= mb_substr($post['content'], 0, 55, 'UTF-8') . '...'  ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php include('app/include/pagination.php'); ?>
        </div>
        <!-- sidebar Content -->
        <div class="sidebar col-md-3 col-12">

            <div class="section search">
                <h3>Пошук</h3>
                <form action="search.php" method="post">
                    <input type="text" name="search-term" class="text-input" placeholder="Введите искомое слово...">
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

<!-- START FOOTER -->
<?php include('app/include/footer.php') ?>
<!-- FINISH FOOTER -->