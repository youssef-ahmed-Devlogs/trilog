<!-- ad uniqe id for every post -->
<div class="post" id="<?php echo 'post_' . $post['id'] ?>">
    <div class="top-section">
        <!-- if comment added by me set href=profile.php if added by other person set href=uprofile.php?uid= user id -->
        <a href="<?php echo $post['user'] === $_SESSION['id'] ? 'profile.php' : 'uprofile.php?uid=' . $post['user'] ?>" class="left">

            <img src="<?php echo showAvatar($post['user']); ?>" alt="">
            <div class="info">
                <span class="post-username">
                    <?php echo ucwords($post['fname'] . ' ' . $post['lname']) ?>
                </span>
                <span class="post-date">
                    <?php echo timeAgo($post['time']) ?>
                </span>
            </div>
        </a>
        <div class="right">
            <div class="post-options">
                <div class="dropdown">
                    <a class="post-options-btn" href="#" role="button" id="post-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-h "></i>
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="post-dropdown">

                        <!-- Check if this post saved -->
                        <?php

                        $result = selectColumn("id", "saved", "WHERE post = ? AND user = ?", [$post['id'], $_SESSION['id']]);

                        ?>
                        <li>
                            <span class="dropdown-item save-post" data-postid="<?php echo $post['id'] ?>">
                                <?php echo $result > 0 ? "Unsave" : "save" ?>
                            </span>
                        </li>

                        <?php if ($post['user'] === $_SESSION['id']) { ?>

                            <li>
                                <span class="edit-post dropdown-item" data-fancybox data-type="ajax" href="includes/posts/edit-post-form.php?postid=<?php echo $post['id'] ?>">Edit</span>
                            </li>
                            <li>
                                <span class="remove-post dropdown-item text-danger" data-id="<?php echo $post['id'] ?>">Remove</span>
                            </li>

                        <?php } else { ?>

                            <!-- <li><a class="dropdown-item" href="#">Another action</a></li> -->

                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php if (!empty($post['text'])) { ?>
        <p class="post-text">
            <?php echo $post['text'] ?>
        </p>
    <?php } ?>
    <?php if (!empty($post['images'])) { ?>

        <?php

        // explode images string convert to array to loop in it as array
        $images = explode(",", $post['images']);
        $imagesCount = count($images);

        ?>

        <div class="images">

            <!-- Display images by count from 1 to 4 if > 4 images add +number -->
            <?php foreach ($images as $key => $image) { ?>
                <?php if ($imagesCount <= 2) { ?>

                    <a style="width: 100%;" data-fancybox="<?php echo $post['id'] ?>" data-src="includes/uploads/posts/<?php echo $image ?>" data-caption="<?php echo $post['text'] ?>" class="post-img">
                        <img src="includes/uploads/posts/<?php echo $image ?>" style="<?php echo $imagesCount == 1 ? 'height: 500px' : '' ?>">
                    </a>

                <?php } elseif ($imagesCount == 3) { ?>

                    <a style="<?php echo $key == 0 ? 'width: 100%' : '' ?>" data-fancybox="<?php echo $post['id'] ?>" data-src="includes/uploads/posts/<?php echo $image ?>" data-caption="<?php echo $post['text'] ?>" class="post-img">
                        <img src="includes/uploads/posts/<?php echo $image ?>">
                    </a>

                <?php } elseif ($imagesCount == 4) { ?>

                    <a data-fancybox="<?php echo $post['id'] ?>" data-src="includes/uploads/posts/<?php echo $image ?>" data-caption="<?php echo $post['text'] ?>" class="post-img">
                        <img src="includes/uploads/posts/<?php echo $image ?>">
                    </a>

                <?php } elseif ($imagesCount > 4) { ?>

                    <a data-fancybox="<?php echo $post['id'] ?>" data-src="includes/uploads/posts/<?php echo $image ?>" data-caption="<?php echo $post['text'] ?>" class="post-img">
                        <img src="includes/uploads/posts/<?php echo $image ?>" class="<?php echo $key > 3 ? 'd-none' : '' ?>">
                        <?php echo $key == 3 ? "<span class='more-images'>+" . $imagesCount - 3 . "</span>" : '' ?>
                    </a>

                <?php } ?>
            <?php } ?>

        </div>
    <?php } ?>
    <div class="reach">

        <?php

        // Get post likes count 
        $likes = selectRows("SELECT * FROM likes WHERE post = ?", [$post['id']]);
        $likesCount = count($likes);

        // Get post comments count by comments and replies count 
        $comments = selectRows("SELECT id FROM comments WHERE post = ?", [$post['id']]);
        $replies  = selectRows("SELECT comments_reply.id FROM comments_reply JOIN comments ON comments.id = comments_reply.comment WHERE comments.post = ?", [$post['id']]);
        $commentsCount = count($comments) + count($replies);

        ?>

        <div class="likes" data-fancybox data-type='ajax' href="includes/posts/post-likes.php?postid=<?php echo $post['id'] ?>">
            <i class="fas fa-thumbs-up"></i> <?php echo $likesCount ?>
        </div>
        <div class="comments" data-fancybox="view-comments" data-type="ajax" href="includes/posts/comments.php?postid=<?php echo $post['id'] ?>">
            <i class="fas fa-comment-alt"></i> <?php echo $commentsCount ?>
        </div>
    </div>
    <div class="actions">

        <!-- Check is i liked this post or not | [ like = 1 ] - [ not like = 0 ] -->
        <?php $isLiked = count(selectRows("SELECT * FROM likes WHERE user = ? and post = ?", [$_SESSION['id'], $post['id']])); ?>

        <button data-id="<?php echo $post['id'] ?>" class="like like-button <?php echo $isLiked == 1 ? 'active' : '' ?>">
            <i class="fas fa-thumbs-up"></i>
            Like
        </button>
        <a data-fancybox="view-comments" data-type="ajax" href="includes/posts/comments.php?postid=<?php echo $post['id'] ?>" class="comment">
            <i class="fas fa-comment-alt"></i>
            Comment
        </a>

    </div>
</div>