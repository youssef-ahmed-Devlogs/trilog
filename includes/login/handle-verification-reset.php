<?php

session_start();
include '../../connect.php';
include '../App/functions.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    redirect("index.php");
}

// Form Data
$email = $_SESSION['email_code_reset'];
$code = filterStr($_POST['code']);


// Validate Data
$errors = checkValidate([
    "val" => $code,
    "msg" => "Enter verification code.",
    "check" => "empty"
]);

// Display Errors
foreach (array_reverse($errors) as $e) {
    toastr($e);
}

if (empty($errors)) {

    $id = selectColumn("id", "users", "WHERE email = ? AND verify_code = ? ", [$email, $code]);

    if ($id > 0) {

        $_SESSION['email_reset'] = $email;
        $_SESSION['email_code_reset'] = null;
        redirect("reset-password.php", null, 'script');
    } else {
        toastr('Verification code is wrong.');
    }
}
