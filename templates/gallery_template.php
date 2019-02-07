<div>
    <? if (!empty($arrPictures)): ?>
        <div class="gallery">
            <div class="gallery__list">
                <? foreach ($arrPictures as $v): ?>
                    <div class="gallery__item">
                        <div class="gallery__item-img">
                            <img src="upload/<?= $v['name']; ?>" alt="">
                        </div>
                        <p class="upload-date"><?= $v['date']; ?></p>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    <? else: ?>
        <h3 style="text-align: center">Please upload photo</h3>
    <? endif; ?>

</div>