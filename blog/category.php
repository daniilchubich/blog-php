<?php
    include "path.php";
    include "app/controllers/topics.php";
    $posts = selectAllFromPostsWithUsersOnCategory('posts','users', $_GET['id']);
    //$posts = selectAll('posts', ['id_topic' => $_GET['id']]);
    $topTopic = selectTopTopicFromPostsOnIndex('posts');
    $category = selectOne('topics', ['id' => $_GET['id']]);
//tt($category);
?>

<?php include("app/include/header.php"); ?>



<!-- блок main-->
<div class="container">
    <div class="content row">
        <!-- Main Content -->
        <div class="main-content col-md-9 col-12">
            <?php if(!empty($posts)): ?>
            <h2>Статті розділу <strong><?=$category['name']; ?></strong></h2>
            <?php else: ?>
            <h2>Статти в цьому розділі <strong><?=$category['name']; ?></strong> відсутні!</h2>
            <?php endif ?>
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
                    </h3>
                    <i class="far fa-user"> <?=$post['username'];?></i>
                    <i class="far fa-calendar"> <?=$post['created'];?></i>
                    <p class="preview-text">

                        <?=mb_substr($post['content'], 0, 55, 'UTF-8'). '...'  ?>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
        <!-- sidebar Content -->
        <div class="sidebar col-md-3 col-12">

            <div class="section search">
                <h3>Пошук</h3>
                <form action="search.php" method="post">
                    <input type="text" name="search-term" class="text-input" placeholder="Введіть ключове слово">
                </form>
            </div>


            <div class="section topics">
                <h3>Категорії</h3>
                <ul>
                    <?php foreach ($topics as $key => $topic): ?>
                    <li>
                        <a href="<?=BASE_URL . 'category.php?id=' . $topic['id']; ?>"><?=$topic['name']; ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>
    </div>
</div>

<!-- блок main END-->
<!-- footer -->
<?php include("app/include/footer.php"); ?>
<!-- // footer -->