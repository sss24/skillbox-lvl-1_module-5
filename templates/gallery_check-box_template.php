<div>

    <? if (!empty($arrPictures)): ?>
        <form class="form-checkbox" action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="gallery">
                <div class="gallery__list gallery__list--vertical">
                    <? foreach ($arrPictures as $v): ?>
                        <div class="gallery__item">
                            <img src="upload/<?= $v['name']; ?>" alt="">
                            <input type="checkbox" name="checkDel[]" value="<?= $v['name']; ?>">
                        </div>

                    <? endforeach; ?>
                </div>
            </div>
            <input class="form-checkbox__submit" type="submit" name="sendCheck" value="Delete">
        </form>
    <? else: ?>
        <h3 style="text-align: center">Please upload photo</h3>
    <? endif; ?>

</div>