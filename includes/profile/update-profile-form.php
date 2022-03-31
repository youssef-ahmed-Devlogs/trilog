<?php

session_start();
include '../../connect.php';
include '../App/functions.php';

if (!isset($_SESSION['id'])) {
    redirect('login.php');
}

include 'edit-profile-form.php';
