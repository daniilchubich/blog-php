<?php

include "../../path.php";
include "../../app/controllers/commentaries.php";
?>


<?php include("../../app/include/header-admin.php"); ?>

<div class="container">
    <?php include "../../app/include/sidebar-admin.php"; ?>

    <div class="posts col-9">
        <div class="row title-table">
            <h2>Редагувати Коментар</h2>
        </div>
        <div class="row add-post">
            <div class="mb-12 col-12 col-md-12 err">
                <!-- Вывод массива с ошибками -->
                <?php include "../../app/helps/errorInfo.php"; ?>
            </div>
            <form action="edit.php" method="post">
                <input type="hidden" name="id" value="<?=$id; ?>">
                <div class="col mb-4">
                    <input value="<?=$email?>" name="title" type="text" disabled class="form-control"
                        placeholder="Title" aria-label="Название статьи">
                </div>
                <div class="col">
                    <label for="editor" class="form-label">Коментар</label>
                    <textarea name="content" id="editor" class="form-control" rows="6">
                        <?=$text1?>
                    </textarea>
                </div>


                <div class="form-check">
                    <?php if($pub) $checked = "checked"; else $checked = "";?>
                    <input name="publish" class="form-check-input" type="checkbox" id="flexCheckChecked" <?=$checked;?>>
                    <label class="form-check-label" for="flexCheckChecked">
                        Publish
                    </label>
                </div>
                <div class="col col-6">
                    <button name="edit_comment" class="btn btn-primary" type="submit">Зберегти</button>
                </div>
            </form>
        </div>

    </div>
</div>
</div>


<!-- footer -->
<?php include("../../app/include/footer.php"); ?>
<!-- // footer -->