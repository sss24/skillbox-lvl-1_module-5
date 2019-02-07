<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/constants.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/functions.php';

/**
 * Если директории нет, создаем
 */
if (!is_dir(PATH_UPLOAD)) {
    mkdir(PATH_UPLOAD);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sendForm'])) {

    $answer = [];
    $count = count($_FILES['userFile']['name']);

    if ($count > 5) {
        $answer['error'] = 'Max 5 files <br>';
    } else {
        $answer = uploadFiles();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sendCheck'])) {
    $check = !empty($_POST['checkDel']) ? $_POST['checkDel'] : false;
    if ($check) {
        foreach ($check as $k => $v) {
            $file = PATH_UPLOAD . $v;
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }
}