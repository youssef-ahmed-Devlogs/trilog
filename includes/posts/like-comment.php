<?php

session_start();

include '../../connect.php';
include '../App/functions.php';

$commentid  =  isset($_POST['commentid']) && is_numeric($_POST['commentid']) ? intval($_POST['commentid']) : 0;
$isLiked = count(selectRows("SELECT * FROM comments_likes WHERE user = ? and comment = ?", [$_SESSION['id'], $commentid]));

if ($isLiked  == 1) {
    // Dis Like
    $result = deleteRows("comments_likes", "WHERE user = ? AND comment = ?", [$_SESSION['id'], $commentid]);

    if ($result > 0) {

        $likes = selectRows("SELECT * FROM comments_likes WHERE comment = ?", [$commentid]);
        $likesCount = count($likes);
?>

        <script>
            $("#comment_<?php echo $commentid ?> .comment-likes-count").html(`<?php echo $likesCount ?>`);
            $("#comment_<?php echo $commentid ?> .like-comment").removeClass("active")
        </script>

    <?php

    }
} elseif ($isLiked  == 0) {
    // Like
    $result = insert("comments_likes(user, comment)", "VALUES(?, ?)", [$_SESSION['id'], $commentid]);

    if ($result > 0) {

        $likes = selectRows("SELECT * FROM comments_likes WHERE comment = ?", [$commentid]);
        $likesCount = count($likes);
    ?>

        <script>
            $("#comment_<?php echo $commentid ?> .comment-likes-count").html(`<?php echo $likesCount ?>`);
            $("#comment_<?php echo $commentid ?> .like-comment").addClass("active")
        </script>

<?php
    }
}
