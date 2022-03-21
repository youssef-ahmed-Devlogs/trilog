<?php

session_start();
include '../../connect.php';
include '../App/functions.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    redirect("index.php");
}

// Form Data
$email = filterEmail($_POST['email']);

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

// Display Errors
foreach (array_reverse($errors) as $e) {
    toastr($e);
}


if (empty($errors)) {

    if (selectColumn("email", "users", "WHERE email = ?", [$email]) <= 0) {
        toastr('This email is not register. If you don\'t have an account try create new account.');
    } else {

        $verify_code = rand(10000, 100000);
        $message = "
            <html>
                <head></head>
                <body>
                    <h2>Trilog Verification Code Is : $verify_code</h2>
                </body>
            </html>
        ";

        $headers = 'From: <socialNetwork@info.com>' . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $result = update("users", "verify_code = ?", "WHERE email = ?", [$verify_code, $email]);

        if ($result > 0) {
            mail($email, "Trilog Verification Code", $message, $headers);
            $_SESSION['email_code_reset'] = $email;
            redirect("verification-reset.php", null, 'script');
        }
    }
}
