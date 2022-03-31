<?php

// Remove post

session_start();
include '../../connect.php';
include '../App/functions.php';

$postid = $_POST['postid'];

$check = selectColumn("id", "posts", "WHERE id = ? AND user = ?", [$postid, $_SESSION['id']]);

if ($check) {
    $result = deleteRows("posts", "WHERE id = ? AND user = ?", [$postid, $_SESSION['id']]);

    // Render posts count in current user profile page after remove a post
    // Select posts for this user only
    $posts = selectRows(
        "SELECT posts.*, users.fname, users.lname FROM posts
                                JOIN users ON users.id = posts.user
                                WHERE users.id = ?
                                ORDER BY time DESC
                                ",
        [$_SESSION['id']]
    );

    // Posts Count
    $postsCount = count($posts);

    if ($result > 0) {
?>
        <script>
            $(".render-posts").click();
            $(".profile-av-info #posts-count .value").html("<?php echo countNumK($postsCount) ?>")
        </script>
<?php
    }
}
