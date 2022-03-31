<?php

$pageTitle = 'Home';
include 'init.php';

if (!isset($_SESSION['id'])) {
    redirect('login.php');
}

?>

<main class="home page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 sidebar-l">
                <?php include $App . 'sidebar-left.php'; ?>
            </div>
            <div class="col">
                <?php include 'includes/posts/add-post.php'; ?>

                <div id="posts-area">
                    <?php

                    $posts = selectRows("SELECT posts.*, users.fname, users.lname FROM posts JOIN users ON users.id = posts.user ORDER BY time DESC");


                    foreach ($posts as $post) {
                        include 'includes/posts/post.php';
                    }

                    ?>
                </div>
            </div>
            <div class="col-lg-3 sidebar-r">
                <?php include $App . 'sidebar-right.php'; ?>
            </div>
        </div>
    </div>
    <button class="d-none render-posts"></button>

</main>


<?php include $App . 'footer.php' ?>

<div id="backend_msgs_like"></div>
<div id="backend_msgs"></div>