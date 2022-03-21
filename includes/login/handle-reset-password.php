<?php

session_start();
include '../../connect.php';
include '../App/functions.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    redirect("index.php");
}

// Form Data
$email = $_SESSION['email_reset'];
$password = $_POST['password'];
$repeatPassword = $_POST['repeat-password'];

// Validate Data
$errors = checkValidate([
    "val" => $password,
    "msg" => "Password can't be empty.",
    "check" => "empty"
]);

$errors = checkValidate([
    "val" => $repeatPassword,
    "msg" => "Repeat Password can't be empty.",
    "check" => "empty"
]);

$errors = checkValidate([
    "val" => $password,
    "msg" => "Password must be less than 6 characters.",
    "check" => "min",
    "min" => 6
]);

$errors = checkValidate([
    "val" => $password,
    "msg" => "Password can't be more than 20 characters.",
    "check" => "max",
    "max" => 20
]);

$errors = checkValidate([
    "val" => $repeatPassword,
    "msg" => "Repeat Password must be less than 6 characters.",
    "check" => "min",
    "min" => 6
]);

$errors = checkValidate([
    "val" => $repeatPassword,
    "msg" => "Repeat Password can't be more than 20 characters.",
    "check" => "max",
    "max" => 20
]);


$errors = checkValidate([
    "val" => $repeatPassword,
    "msg" => "Repeat Password can't be more than 20 characters.",
    "check" => "max",
    "max" => 20
]);


$errors = checkValidate([
    "val" => $password,
    "otherVal" => $repeatPassword,
    "msg" => "Password and repeat password is not match.",
    "check" => "comparison"
]);


// Display Errors
foreach (array_reverse($errors) as $e) {
    toastr($e);
}


if (empty($errors)) {

    $result = update("users", "password = ?", "WHERE email = ?", [enc_pass($password), $email]);
    $id = selectColumn("id", "users", "WHERE email = ?", [$email]);

    if ($result > 0) {
        toastr('Login successfuly', 'success');
        $_SESSION['email_reset'] = null;
        $_SESSION['id'] = $id;
        redirect("index.php", null, 'script');
    } else {
        toastr('This password is an old password please enter a new strong one');
    }
}
