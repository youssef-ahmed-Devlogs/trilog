<?php

$pageTitle = 'Saved';
include 'init.php';

if (!isset($_SESSION['id'])) {
    redirect('login.php');
}

?>

<main class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <?php include $App . 'sidebar-left.php'; ?>
            </div>
            <div class="col">
                <div id="posts-area">
                    <?php

                    $query = "
                        SELECT posts.*, users.fname, users.lname FROM posts
                        JOIN users ON users.id = posts.user
                        JOIN saved ON saved.post = posts.id
                        WHERE saved.user = ?
                        ORDER BY saved.id DESC
                    ";

                    $posts = selectRows($query, [$_SESSION['id']]);


                    foreach ($posts as $post) {
                        include 'includes/posts/post.php';
                    }

                    if (count($posts) <= 0) { ?>

                        <div class="content-empty my-3 text-center">Has no posts in your saved page.</div>

                    <?php } ?>
                </div>
            </div>
            <div class="col-md-3">
                <?php include $App . 'sidebar-right.php'; ?>
            </div>
        </div>
    </div>
    <button class="d-none render-saved-posts"></button>

</main>


<?php include $App . 'footer.php' ?>

<div id="backend_msgs_like"></div>
<div id="backend_msgs"></div>