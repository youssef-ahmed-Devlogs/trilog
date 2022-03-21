<?php

session_start();

include '../../connect.php';
include '../App/functions.php';

$text    = filterStr($_POST['text']);
$images  = $_FILES['images'];
$imagesCount = count(array_filter($images['name']));


if ($imagesCount <= 0) {
    $errors = checkValidate([
        "check" => "empty",
        "val" => $text,
        "msg" => "Post text can't be empty."
    ]);
}

// Set images config and validation
for ($i = 0; $i < $imagesCount; $i++) {
    $name = $images['name'][$i];
    $size = $images['size'][$i];
    $tmpName = $images['tmp_name'][$i];
    $type = $images['type'][$i];
    $type = explode('/', $type);
    $type = end($type);
    $randName = rand(0, 99999999999) * 9999 . '.' . $type;

    // Validation
    $validExtensions = ['png', 'jpg', 'jpeg'];
    $validSize = (5 * 1024) * 1024;

    if (!empty($name)) {
        $errors = checkValidate([
            "check" => "file",
            "type" => $type,
            "validExtensions" => $validExtensions,
            "msg" => "$name file type must be in (png, jpg, jpeg)."
        ]);

        $errors = checkValidate([
            "check" => "fileSize",
            "fileSize" => $size,
            "max" => $validSize,
            "msg" => "$name Image must be less than 5MB."
        ]);
    }

    if (empty($errors)) {
        $db_images_name[] = $randName;
        move_uploaded_file($tmpName, '../../assets/images/posts/' . $randName);
    }
}

if (!empty($errors)) {
    foreach ($errors as $e) {
        toastr($e);
    }
}


if (!empty($db_images_name) || !empty($text)) {
    $db_images_name = isset($db_images_name) ? implode(",", $db_images_name) : "";
    $time = time();

    $result = insert("posts(text, images, user, time)", "VALUES(?,?,?,?)", [$text, $db_images_name, $_SESSION['id'], $time]);

    if ($result > 0) {
        toastr("Posted successfully", "success");
        redirect("index.php", null, 'script');
    }
}
