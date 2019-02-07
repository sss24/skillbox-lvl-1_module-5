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
function uploadFiles()
{
    $count = count($_FILES['userFile']['name']);
    for ($i = 0; $i < $count; $i++) {
        if (!empty($_FILES['userFile']['error'][$i])) {
            $answer['error'] = 'Error!! File not uploaded';
        } else {
            $tmpPath = $_FILES['userFile']['tmp_name'][$i];
            $uploadFile = PATH_UPLOAD . basename($_FILES['userFile']['name'][$i]);

            $fileType = ['image/jpeg', 'image/png'];
            $imageMime = @image_type_to_mime_type(exif_imagetype($tmpPath));

            if (in_array($imageMime, $fileType)) {
                if ($_FILES['userFile']['size'][$i] < MAX_FILE_SIZE) {
                    if (move_uploaded_file($tmpPath, $uploadFile)) {
                        $answer['success'] = "Successfully uploaded files <br>";
                    }
                } else {
                    $answer['error'] = 'The file is very big';
                }
            } else {
                $answer['error'] = '<strong>Only pictures!!</strong> <br>';
            }
        }
    }
    return $answer;
}