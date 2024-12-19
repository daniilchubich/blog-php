<?php
    include "path.php";
    include SITE_ROOT . "/app/database/db.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search-term'])){
        $posts = seacrhInTitileAndContent($_POST['search-term'], 'posts', 'users');
    }
?>
<?php include("app/include/header.php"); ?>


<!-- блок main-->
<div class="container">
    <div class="content row">
        <!-- Main Content -->
        <div class="main-content col-12">
            <h2>Результати пошуку</h2>
            <?php foreach ($posts as $post): ?>
            <div class="post row">
                <div class="img col-12 col-md-4">
                    <img src="<?=BASE_URL . 'assets/images/posts/' . $post['img'] ?>" alt="<?=$post['title']?>"
                        class="img-thumbnail">
                </div>
                <div class="post_text col-12 col-md-8">
                    <h3>
                        <a
                            href="<?=BASE_URL . 'single.php?post=' . $post['id'];?>"><?=substr($post['title'], 0, 80) . '...'  ?></a>
                    </h3>a <i class="far fa-user"> <?=$post['username'];?></i>
                    <i class="far fa-calendar"> <?=$post['created'];?></i>
                    <p class="preview-text">

                        <?=mb_substr($post['content'], 0, 55, 'UTF-8'). '...'  ?>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>

        </div>

    </div>
</div>

<!-- блок main END-->
<!-- footer -->
<?php include("app/include/footer.php"); ?>
<!-- // footer -->