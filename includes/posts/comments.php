<?php

session_start();
include '../../connect.php';
include '../App/functions.php';

// Get post id from get request
// Check if post id is valid
$postid = isset($_GET['postid']) && is_numeric($_GET['postid']) ? intval($_GET['postid']) : 0;
?>

<button class="d-none render-comments" data-id="<?php echo $postid ?>"></button>
<h2 class="head-log mb-3">Post Comments</h2>
<?php

if ($postid > 0) { ?>

    <!-- Add comment form -->
    <div class="add-comment">
        <a href="profile.php" class="account-img">
            <img src="<?php echo showAvatar($_SESSION['id']); ?>" alt="">
        </a>
        <form id="add-comment-form" method="POST">
            <input type="hidden" name="postid" value="<?php echo $postid ?>">
            <textarea name="comment-text" placeholder="Add comment"></textarea>
            <button type="submit" class="btn success-button">Comment</button>
        </form>
    </div>

    <!-- Comments Area -->
    <div class="comments-area">
        <ul class="comments-list p-0">

            <!-- GET COMMENTS INFO -->
            <?php

            $query = "SELECT comments.id AS comment_id , comments.comment, comments.time, comments.user , users.fname, users.lname FROM comments
                    JOIN users ON users.id = comments.user WHERE comments.post = ? ORDER BY comments.id DESC";
            $bind = [$postid];

            $comments = selectRows($query, $bind);

            foreach ($comments as $comment) {


            ?>

                <!-- Loop in every comment -->
                <li class="comment" id="comment_<?php echo $comment['comment_id'] ?>">

                    <!-- if comment added by me set href=profile.php if added by other person set href=uprofile.php?uid= user id -->
                    <a href="<?php echo $comment['user'] === $_SESSION['id'] ? 'profile.php' : 'uprofile.php?uid=' . $comment['user'] ?>" class="comment-user">
                        <img src="<?php echo showAvatar($comment['user']); ?>" alt="">
                        <span>
                            <?php echo ucwords($comment['fname'] . ' ' . $comment['lname']) ?>
                        </span>
                    </a>
                    <p class="comment-text m-0">
                        <?php echo $comment['comment'] ?>


                        <!-- Remove comment button -->
                        <?php if ($comment['user'] === $_SESSION['id']) { ?>
                            <span class="remove-comment text-danger" data-id="<?php echo $comment['comment_id'] ?>" data-commenttype="comment">
                                <i class="fas fa-trash-alt"></i>
                            </span>
                        <?php } ?>

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
                        <span class="reply-comment" data-commentid="<?php echo $comment['comment_id'] ?>" data-postid="<?php echo $postid ?>">reply</span>

                        <span class="comment-time">
                            <?php echo timeAgo($comment['time']) ?>
                        </span>
                    </div>


                    <!-- Append reply form on click on the reply button -->
                    <div class="comment_reply_container"></div>

                    <!-- GET COMMENTS REPLY INFO -->
                    <?php

                    $query = "SELECT comments_reply.id AS reply_id , comments_reply.reply, comments_reply.time, comments_reply.user , users.fname, users.lname FROM comments_reply
                    JOIN users ON users.id = comments_reply.user WHERE comments_reply.comment = ? ORDER BY comments_reply.id DESC";
                    $bind = [$comment['comment_id']];

                    $replies = selectRows($query, $bind);


                    if (count($replies) > 0) { ?>

                        <ul class="comments-list reply-list pl-3 mt-2 mb-4">

                            <?php

                            foreach ($replies as $reply) {

                            ?>

                                <li class="comment">
                                    <a href="#" class="comment-user">
                                        <img src="<?php echo showAvatar($reply['user']); ?>" alt="">
                                        <span>
                                            <?php echo ucwords($reply['fname'] . ' ' . $reply['lname']) ?>
                                        </span>
                                    </a>
                                    <p class="comment-text m-0">
                                        <?php echo $reply['reply'] ?>

                                        <?php if ($reply['user'] === $_SESSION['id']) { ?>
                                            <small class="remove-comment text-danger" data-id="<?php echo $reply['reply_id'] ?>" data-commenttype="reply">
                                                <i class="fas fa-trash-alt"></i>
                                            </small>
                                        <?php } ?>
                                    </p>
                                    <div class="comment-info">
                                        <span class="comment-time">
                                            <?php echo timeAgo($reply['time']) ?>
                                        </span>
                                    </div>
                                </li>

                            <?php } ?>

                        </ul>

                    <?php } ?>
                </li>


            <?php } ?>

        </ul>

        <?php if (count($comments) <= 0) { ?>
            <div class="content-empty">Has no comment in this post.</div>
        <?php } ?>
    </div>


    <div id="backend_msgs_comments"></div>




<?php

} else {
    redirect("index.php");
    redirect("index.php", null, "script");
}

?>