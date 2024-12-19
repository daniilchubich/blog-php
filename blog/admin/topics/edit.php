<?php 
    include "../../path.php";
    include "../../app/controllers/topics.php";
?>

<?php include("../../app/include/header-admin.php"); ?>

<div class="container">
    <?php include "../../app/include/sidebar-admin.php"; ?>

    <div class="posts col-9">
        <div class="button row">
            <a href="<?php echo BASE_URL . "admin/topics/create.php";?>" class="col-2 btn btn-success">Створити</a>
            <span class="col-1"></span>
        </div>
        <div class="row title-table">
            <h2>Редагувати Категорію</h2>
        </div>
        <div class="row add-post">
            <div class="mb-12 col-12 col-md-12 err">
                <p>
                    <? include "../../app/controllers/errorinfo.php" ?>
                </p>
            </div>
            <form action="edit.php" method="post">
                <input name="id" value="<?=$id;?>" type="hidden">
                <div class="col">
                    <input name="name" value="<?=$name;?>" type="text" class="form-control" placeholder="Имя категории"
                        aria-label="Имя категории">
                </div>
                <div class="col">
                    <label for="content" class="form-label">Опис категорії</label>
                    <textarea name="description" class="form-control" id="content"
                        rows="3"><?=$description;?></textarea>
                </div>
                <div class="col">
                    <button name="topic-edit" class="btn btn-primary" type="submit">Оновити категорію</button>
                </div>
            </form>
        </div>

    </div>
</div>
</div>


<!-- footer -->
<?php include("../../app/include/footer.php"); ?>
<!-- // footer -->