<?php

session_start();
include '../../connect.php';
include '../App/functions.php';

$fname          = filterStr($_POST['fname']);
$lname          = filterStr($_POST['lname']);
$bio            = filterStr($_POST['bio']);
$date_of_birth  = filterStr($_POST['date_of_birth']);
$gender         = filterStr($_POST['gender']);

$errors = checkValidate([
    "check" => "empty",
    "val" =>  $fname,
    "msg" => "First Name can't be empty."
]);

$errors = checkValidate([
    "check" => "empty",
    "val" => $lname,
    "msg" => "Last Name can't be empty."
]);

$errors = checkValidate([
    "check" => "empty",
    "val" => $date_of_birth,
    "msg" => "Date of birth can't be empty."
]);

$errors = checkValidate([
    "check" => "in_data",
    "val" => $gender,
    "in_data" => ["male", "female"],
    "msg" => "Gender must be Male or Female.",
]);

foreach ($errors as $error) {
    toastr($error);
}

if (empty($errors)) {
    $result = update("users", "fname = ?, lname = ?, bio = ?, date_of_birth = ?, gender = ?", "WHERE id = ?", [$fname, $lname, $bio, $date_of_birth, $gender, $_SESSION['id']]);
    if ($result) {
        toastr("Edit profile successfuly.", "success");
    }
}
