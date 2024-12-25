<?php

include '../../path.php';
include '../../app/controllers/posts.php';
?>

<?php include('../../app/include/header-admin.php'); ?>

<div class="container">
    <?php include '../../app/include/sidebar-admin.php'; ?>

    <div class="posts col-9">
        <div class="row title-table">
            <h2>Редактирование записи</h2>
        </div>
        <div class="row add-post">
            <div class="mb-12 col-12 col-md-12 err">
                <?php include SITE_ROOT .  '/app/helps/errorInfo.php'; ?>
            </div>
            <form action="edit.php" method="post" enctype="multipart/form-data">
                <?php if (isset($id)): ?>
                    <input name="id" value="<?= $id; ?>" type="hidden">
                <?php else: ?>
                    <input name="id" value="" type="hidden">
                <?php endif; ?>
                <div class="col mb-4">
                    <?php if (isset($post['title'])): ?>
                        <input value="<?= $post['title']; ?>" name="title" type="text" class="form-control"
                            placeholder="Title" aria-label="Название статьи">
                    <?php else: ?>
                        <input value="" name="title" type="text" class="form-control" placeholder="Title"
                            aria-label="Название статьи">
                    <?php endif; ?>
                </div>
                <div class="col">
                    <label for="editor" class="form-label">Содержимое записи</label>
                    <?php if (isset($post['content'])): ?>
                        <textarea name="description" class="form-control" id="content"
                            rows="3"><?= $post['content']; ?></textarea>
                    <?php else: ?>
                        <textarea name="content" id="editor" class="form-control" rows="6"></textarea>
                    <?php endif; ?>
                </div>
                <div class="input-group col mb-4 mt-4">
                    <input name="img" type="file" class="form-control" id="inputGroupFile02">
                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                </div>
                <select name="topic" class="form-select mb-2" aria-label="Default select example">
                    <?php if (isset($topics)): ?>
                        <?php foreach ($topics as $key => $topic): ?>
                            <option value="<?= $topic['id']; ?>"><?= $topic['name']; ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <div class="form-check">
                    <?php if (isset($publish) && $publish === 0): ?>
                        <input name="publish" class="form-check-input" type="checkbox" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Publish
                        </label>
                    <?php else: ?>
                        <input name="publish" class="form-check-input" type="checkbox" id="flexCheckChecked" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Publish
                        </label>
                    <?php endif; ?>
                </div>
                <div class="col col-6">
                    <button name="edit_post" class="btn btn-primary" type="submit">Сохранить запись</button>
                </div>
            </form>
        </div>

    </div>
</div>
</div>


<!-- footer -->
<?php include('../../app/include/footer.php'); ?>
<!-- // footer -->