<?php

session_start();

include '../../connect.php';
include '../App/functions.php';

// Get post id
$postid  =  isset($_POST['postid']) && is_numeric($_POST['postid']) ? intval($_POST['postid']) : 0;
$isLiked = count(selectRows("SELECT * FROM likes WHERE user = ? and post = ?", [$_SESSION['id'], $postid]));


if ($isLiked  == 1) {
    // Dis Like
    $result = deleteRows("likes", "WHERE user = ? AND post = ?", [$_SESSION['id'], $postid]);

    if ($result > 0) {

        $likes = selectRows("SELECT * FROM likes WHERE post = ?", [$postid]);
        $likesCount = count($likes);
?>

        <script>
            $("#post_<?php echo $postid ?> .likes").html(`<i class="fas fa-thumbs-up"></i> <?php echo $likesCount ?>`);
            $("#post_<?php echo $postid ?> .like-button").removeClass("active")
        </script>

    <?php

    }
} elseif ($isLiked  == 0) {
    // Like
    $result = insert("likes(user, post)", "VALUES(?, ?)", [$_SESSION['id'], $postid]);

    if ($result > 0) {

        $likes = selectRows("SELECT * FROM likes WHERE post = ?", [$postid]);
        $likesCount = count($likes);
    ?>

        <script>
            $("#post_<?php echo $postid ?> .likes").html(`<i class="fas fa-thumbs-up"></i> <?php echo $likesCount ?>`);
            $("#post_<?php echo $postid ?> .like-button").addClass("active")
        </script>

<?php
    }
}
