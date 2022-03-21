<?php

session_start();
include '../../connect.php';
include '../App/functions.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    redirect("index.php");
}

// Form Data
$fname = filterStr($_POST['fname']);
$lname = filterStr($_POST['lname']);
$email = filterEmail($_POST['email']);
$password = $_POST['password'];
$date_of_birth = filterStr($_POST['date_of_birth']);
$gender = filterStr($_POST['gender']);

// Validate Data
$errors = checkValidate([
    "val" => $fname,
    "msg" => "First Name can't be empty.",
    "check" => "empty"
]);

$errors = checkValidate([
    "val" => $lname,
    "msg" => "Last Name can't be empty.",
    "check" => "empty"
]);

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

$errors = checkValidate([
    "val" => $date_of_birth,
    "msg" => "Date of birth can't be empty.",
    "check" => "empty"
]);

$errors = checkValidate([
    "val" => $gender,
    "msg" => "Gender can't be empty.",
    "check" => "empty"
]);

$errors = checkValidate([
    "val" => $gender,
    "msg" => "Gender must be Male or Female.",
    "check" => "in_data"
]);


// Display Errors
foreach (array_reverse($errors) as $e) {
    toastr($e);
}

if (empty($errors)) {

    if (selectColumn("email", "users", "WHERE email = ?", [$email]) > 0) {
        toastr('This email is already exist.');
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

        $table = "users(fname, lname, email, password, date_of_birth, gender, verify_code)";
        $values = "VALUES(?,?,?,?,?,?,?)";
        $bind = [$fname, $lname, $email, enc_pass($password), $date_of_birth, $gender, $verify_code];
        $result = insert($table, $values, $bind);

        if ($result > 0) {
            mail($email, "Trilog Verification Code", $message, $headers);
            $_SESSION['email_code'] = $email;
            redirect("verification-code.php", null, 'script');
        }
    }
}
