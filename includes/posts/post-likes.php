<?php

session_start();

include '../../connect.php';
include '../App/functions.php';

$postid = isset($_GET['postid']) && is_numeric($_GET['postid']) ? intval($_GET['postid']) : 0;

$query = "SELECT users.id, users.fname, users.lname FROM likes
            JOIN users ON users.id = likes.user
            WHERE post = ?";

$likes = selectRows($query, [$postid]);

?>

<h2 class="head-log mb-3">Post Likes</h2>
<ul class="friends-list">
    <?php foreach ($likes as $like) {


    ?>
        <a href="<?php echo $like['id'] === $_SESSION['id'] ? 'profile.php' : 'uprofile.php?uid=' . $like['id'] ?>" class="friend">
            <img src="<?php echo showAvatar($like['id']) ?>" class="friend-img">
            <span class="friend-name">
                <?php echo ucwords($like['fname'] . ' ' . $like['lname']) ?>
            </span>
        </a>
    <?php } ?>

    <?php if (count($likes) <= 0) { ?>
        <div class="content-empty">Has no likes in this post.</div>
    <?php } ?>
</ul>