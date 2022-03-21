<?php

session_start();
include '../../connect.php';
include '../App/functions.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    redirect("index.php");
}

// Form Data
$email = filterEmail($_POST['email']);
$password = $_POST['password'];

// Validate Data
$errors = checkValidate([
    "val" => $email,
    "msg" => "Email can't be empty.",
    "check" => "empty"
]);

$errors = checkValidate([
    "val" => $email,
    "msg" => "Please enter a valid email.",
    "check" => "email"
]);

$errors = checkValidate([
    "val" => $password,
    "msg" => "Password can't be empty.",
    "check" => "empty"
]);

$errors = checkValidate([
    "val" => $password,
    "msg" => "Password can't be less than 6 characters.",
    "check" => "min",
    "min" => 6
]);

$errors = checkValidate([
    "val" => $password,
    "msg" => "Password can't be more than 20 characters.",
    "check" => "max",
    "max" => 20
]);

// Display Errors
foreach (array_reverse($errors) as $e) {
    toastr($e);
}



if (empty($errors)) {

    if (selectColumn("email", "users", "WHERE email = ?", [$email]) <= 0) {
        toastr('This email is not register. If you don\'t have an account try create new account.');
    } elseif (selectColumn("email", "users", "WHERE email = ? AND password = ?", [$email, enc_pass($password)]) <= 0) {
        toastr('Password is wrong. If you don\'t remember your password try click on forgotten password to reset your password');
    } else {

        $id = selectColumn("id", "users", "WHERE email = ? AND password = ? ", [$email, enc_pass($password)]);

        if ($id > 0) {
            toastr('Login successfuly', 'success');
            $_SESSION['id'] = $id;
            redirect("index.php", null, 'script');
        }
    }
}
