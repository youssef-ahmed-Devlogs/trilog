<?php

session_start();
include '../../connect.php';
include '../App/functions.php';

// Get post id from get request
// Check if post id is valid
$postid = isset($_GET['postid']) && is_numeric($_GET['postid']) ? intval($_GET['postid']) : 0;


if ($postid > 0) { ?>

    <!-- GET MY AVATAR -->
    <?php

    $accAvatar = selectColumn("name", "avatar", "WHERE user = ? ORDER BY id DESC", [$_SESSION['id']]);

    ?>

    <!-- Add comment form -->
    <div class="add-comment">
        <a href="profile.php" class="account-img">
            <img src="<?php echo showAvatar($accAvatar); ?>" alt="">
        </a>
        <form id="add-comment-form" method="POST">
            <input type="hidden" name="postid" value="<?php echo $postid ?>">
            <textarea name="comment-text" placeholder="Add comment"></textarea>
            <button type="submit" class="btn success-button">Comment</button>
        </form>
    </div>

    <ul class="comments-list">

        <!-- GET COMMENTS INFO -->
        <?php

        $query = "SELECT comments.id AS comment_id , comments.comment, comments.time, comments.user , users.fname, users.lname FROM comments
                    JOIN users ON users.id = comments.user WHERE comments.post = ? ORDER BY comments.id DESC";
        $bind = [$postid];

        $comments = selectRows($query, $bind);

        foreach ($comments as $comment) {

            // Get comments avatars
            $avatar = selectColumn("name", "avatar", "WHERE user = ? ORDER BY id DESC", [$comment['user']]);

        ?>

            <!-- Loop in every comment -->
            <li class="comment" id="comment_<?php echo $comment['comment_id'] ?>">

                <!-- if comment added by me set href=profile.php if added by other person set href=uprofile.php?uid= user id -->
                <a href="<?php echo $comment['user'] === $_SESSION['id'] ? 'profile.php' : 'uprofile.php?uid=' . $comment['user'] ?>" class="comment-user">
                    <img src="<?php echo showAvatar($avatar); ?>" alt="">
                    <span>
                        <?php echo ucwords($comment['fname'] . ' ' . $comment['lname']) ?>
                    </span>
                </a>
                <p class="comment-text m-0">
                    <?php echo $comment['comment'] ?>

                    <?php

                    // Get comment likes count
                    $commentLikes = selectRows("SELECT * FROM comments_likes WHERE comment = ?", [$comment['comment_id']]);
                    $commentLikesCount = count($commentLikes);

                    ?>

                    <span class="comment-likes-count">
                        <?php echo $commentLikesCount ?>
                    </span>
                </p>
                <div class="comment-info">

                    <?php $isComLiked = selectRow("SELECT * FROM comments_likes WHERE comment = ? AND user = ?", [$comment['comment_id'], $_SESSION['id']]); ?>

                    <span class="like-comment <?php echo $isComLiked > 0 ? "active" : "" ?>" data-id="<?php echo $comment['comment_id'] ?>">Like</span>
                    <span class="comment-time">
                        <?php echo timeAgo($comment['time']) ?>
                    </span>
                </div>
            </li>


        <?php } ?>

    </ul>

    <?php if (count($comments) <= 0) { ?>
        <div class="content-empty">Has no comment in this post.</div>
    <?php } ?>


    <div id="backend_msgs_comments"></div>



<?php

} else {
    redirect("index.php");
    redirect("index.php", null, "script");
}
