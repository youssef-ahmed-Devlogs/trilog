<?php

ob_start();
session_start();
include_once 'connect.php';

$App   = 'includes/App/';

include_once $App . 'functions.php';
include_once $App . 'head.php';

if (!isset($noNavbar)) {
    include_once $App . 'navbar.php';
}
