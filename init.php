<?php

ob_start();
session_start();
include 'connect.php';

$App   = 'includes/App/';

include $App . 'functions.php';
include $App . 'head.php';

if (!isset($noNavbar)) {
    include $App . 'navbar.php';
}
