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
            <?= isset($answer['error']) ? $answer['error'] : ''; ?>
            <?= isset($answer['success']) ? $answer['success'] : ''; ?>
        </div>
    </div>
<? showPhoto(); ?>

<? include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>