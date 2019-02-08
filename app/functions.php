<?php
/**
 * Выводит галерею картинок из /upload/
 * @param bool $checkBox - Выбор загружаемого шаблона для галереи (обычный вывод, вывод с чекбокс)
 */
function showPhoto($checkBox = false)
{
    $pathPictures = $_SERVER['DOCUMENT_ROOT'] . '/upload/';
    $arrFiles = scandir($pathPictures);
    foreach ($arrFiles as $v) {
        if (is_file($pathPictures . $v)) {
            $arrPictures[$v]['name'] = $v;
            $arrPictures[$v]['date'] = date("F d Y H:i:s.", filectime($pathPictures . $v));
        }
    }

    empty($checkBox) ? require PATH_TEMPLATE . 'gallery_template.php' : require PATH_TEMPLATE . 'gallery_check-box_template.php';
}

/**
 * Проверяет загружаемые картинки
 * @return mixed
 */
function uploadFiles(): array
{
    $count = count($_FILES['userFile']['name']);
    for ($i = 0; $i < $count; $i++) {

        if (!empty($_FILES['userFile']['error'][$i])) {
            $answer['error'][$i] = 'Error!! File not uploaded';
            continue;
        }
        $tmpPath = $_FILES['userFile']['tmp_name'][$i];
        $uploadFile = PATH_UPLOAD . basename($_FILES['userFile']['name'][$i]);

        $fileType = ['image/jpeg', 'image/png'];
        $imageMime = @image_type_to_mime_type(exif_imagetype($tmpPath));
/*
        if (!in_array($_FILES['userFile']['type'][$i], $fileType)) {
            $answer['error'] = '<strong>Only pictures!!</strong> <br>';
            continue;
        }
*/
        if (!in_array($imageMime, $fileType)) {
            $answer['error'][$i] = "{$_FILES['userFile']['name'][$i]}: <strong>This isn't a picture!</strong> <br>";
            continue;
        }
        if ($_FILES['userFile']['size'][$i] > MAX_FILE_SIZE) {
            $answer['error'][$i] = "{$_FILES['userFile']['name'][$i]}:  <strong>The file is very big :( </strong><br>";
            continue;
        }
        if (!move_uploaded_file($tmpPath, $uploadFile)) {
            $answer['error'][$i] = 'Ups';
            continue;
        }
        $answer['success'][$i] = "{$_FILES['userFile']['name'][$i]}: Successfully uploaded!<br>";
    }
    return $answer;

}