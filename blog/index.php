<?php 
  include("path.php");
  include "app/controllers/topics.php";


  $page = isset($_GET['page']) ? $_GET['page']: 1;
  $limit = 2;
  $offset = $limit * ($page-1);
  $total_pages = round(countRow('posts')/$limit, 0);

  $posts = selectAllFromPostsWithUsersOnIndex('posts','users', $limit, $offset);
  $topTopic = selectTopTopicFromPostsOnIndex('posts');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My blog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include("app/include/header.php")?>
    <!-- Блок карусели START-->
    <div class="container carousel-hidden">
        <div class="row">
            <h2 class="slider-title">Top Posts</h2>
        </div>
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <!-- Опциональные индикаторы -->
            <!-- <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div> -->
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
                <?php include("app/include/pagination.php"); ?>
            </div>
            <!-- sidebar Content -->
            <div class="sidebar col-md-3 col-12">

                <div class="section search">
                    <h3>Пошук</h3>
                    <form action="search.php" method="post">
                        <input type="text" name="search-term" class="text-input" placeholder="Введите искомое слово...">
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

    <!-- START FOOTER -->
    <?php include("app/include/footer.php") ?>
    <!-- FINISH FOOTER -->