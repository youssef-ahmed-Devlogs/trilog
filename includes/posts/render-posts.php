<?php

session_start();
include '../../connect.php';
include '../App/functions.php';

// Render posts without refresh
$uid = isset($_POST['uid']) && is_numeric($_POST['uid']) ? intval($_POST['uid']) : 0;

if ($uid > 0) {

    $posts = selectRows("SELECT posts.*, users.fname, users.lname FROM posts JOIN users ON users.id = posts.user WHERE users.id = ? ORDER BY time DESC", [$uid]);
} else {
    $posts = selectRows("SELECT posts.*, users.fname, users.lname FROM posts JOIN users ON users.id = posts.user ORDER BY time DESC");
}

foreach ($posts as $post) {
    include '../posts/post.php';
}
