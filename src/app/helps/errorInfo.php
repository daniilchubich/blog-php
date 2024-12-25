<?php if (isset($errMsg) && count($errMsg) > 0): ?>
    <ul class="error25">
        <?php foreach ($errMsg as $error): ?>
            <li><?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>