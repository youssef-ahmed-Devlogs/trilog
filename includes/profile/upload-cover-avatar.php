<?php

session_start();
include '../../connect.php';
include '../App/functions.php';

$image = $_FILES['image'];
$name      = $image['name'];
$tmpName   = $image['tmp_name'];
$type      = $image['type'];
$size      = $image['size'];

// Get type and generate a random name 
$type = explode('/', $type);
$type = end($type);
$randName = rand(0, 99999999999) * 9999 . '.' . $type;

$validSize = (5 * 1024) * 1024;
$validExtensions = ['png', 'jpg', 'jpeg'];

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

foreach ($errors as $e) {
    toastr($e);
}

if (empty($errors)) {

    if (isset($_POST['up_avatar'])) {
        $result = insert("avatar(name, user)", "VALUES(?, ?)", [$randName, $_SESSION['id']]);
        move_uploaded_file($tmpName, '../../includes/uploads/avatar/' . $randName);
    } else {
        $result = insert("profile_cover(name, user)", "VALUES(?, ?)", [$randName, $_SESSION['id']]);
        move_uploaded_file($tmpName, '../../includes/uploads/cover/' . $randName);
    }

    if ($result) {
        toastr("Cover change successfuly", "success");
    }
}
