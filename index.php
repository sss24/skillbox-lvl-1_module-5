<? include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>

    <h1 class="title">Photo gallery</h1>
    <div class="content">
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <input type="file" name="userFile[]" multiple>
            <br>
            <br>
            <input type="submit" name="sendForm">
        </form>
        <br>
        <div>

            <? if (!empty($answer['error'])): ?>
                <? foreach ($answer['error'] as $k => $v): ?>
                    <?= isset($v) ? $v : ''; ?>
                <? endforeach; ?>
            <? endif; ?>
            <br>
            <? if (!empty($answer['success'])): ?>
                <? foreach ($answer['success'] as $k => $v): ?>
                    <?= isset($v) ? $v : ''; ?>
                <? endforeach; ?>
            <? endif; ?>

        </div>
    </div>
<? showPhoto(); ?>

<? include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>