<?php

session_start();
include '../../connect.php';
include '../App/functions.php';

// Render posts without refresh
$query = "
                        SELECT posts.*, users.fname, users.lname FROM posts
                        JOIN users ON users.id = posts.user
                        JOIN saved ON saved.post = posts.id
                        WHERE saved.user = ?
                        ORDER BY saved.id DESC
                    ";

$posts = selectRows($query, [$_SESSION['id']]);

foreach ($posts as $post) {
    include '../posts/post.php';
}

if (count($posts) <= 0) { ?>

    <div class="content-empty my-3 text-center">Has no posts in your saved page.</div>

<?php } ?>