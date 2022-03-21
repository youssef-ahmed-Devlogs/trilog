<?php

$pageTitle = 'Home';
include 'init.php';

if (!isset($_SESSION['id'])) {
    redirect('login.php');
}

?>

<h1>Profile</h1>


<?php include $App . 'footer.php' ?>