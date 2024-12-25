<?php

include '../../path.php';
include '../../app/controllers/commentaries.php';
?>


<?php include('../../app/include/header-admin.php'); ?>

<div class="container">
    <?php include '../../app/include/sidebar-admin.php'; ?>

    <div class="posts col-9">
        <div class="row title-table">
            <h2>Редагувати Коментар</h2>
        </div>
        <div class="row add-post">
            <div class="mb-12 col-12 col-md-12 err">
                <!-- Вывод массива с ошибками -->
                <?php include '../../app/helps/errorInfo.php'; ?>
            </div>
            <form action="edit.php" method="post">
                <?php if (isset($id)): ?>
                <input name="id" value="<?= $id; ?>" type="hidden">
                <?php else: ?>
                <input name="id" value="" type="hidden">
                <?php endif; ?>
                <div class="col">
                    <label for="editor" class="form-label">Коментар</label>
                    <?php if (isset($text1)): ?>
                    <textarea name="description" class="form-control" id="content" rows="3"><?= $text1; ?></textarea>
                    <?php else: ?>
                    <textarea name="description" class="form-control" id="content" rows="3"></textarea>
                    <?php endif; ?>
                    </textarea>
                </div>


                <div class="form-check">
                    <?php if (isset($pub)) {
                        $checked = 'checked';
                    } else {
                        $checked = '';
                    } ?>
                    <input name="publish" class="form-check-input" type="checkbox" id="flexCheckChecked"
                        <?= $checked; ?>>
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
<?php include('../../app/include/footer.php'); ?>
<!-- // footer -->