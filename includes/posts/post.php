<!-- ad uniqe id for every post -->
<div class="post mt-4" id="<?php echo 'post_' . $post['id'] ?>">
    <div class="top-section">
        <!-- if comment added by me set href=profile.php if added by other person set href=uprofile.php?uid= user id -->
        <a href="<?php echo $post['user'] === $_SESSION['id'] ? 'profile.php' : 'uprofile.php?uid=' . $post['user'] ?>" class="left">

            <!-- Display avatar for user upload -->
            <?php $avatar = selectColumn("name", "avatar", "WHERE user = ? ORDER BY id DESC", [$post['user']]); ?>

            <img src="<?php echo showAvatar($avatar); ?>" alt="">
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
                <i class="fas fa-ellipsis-h post-options-btn"></i>
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

                    <a style="width: 100%;" data-fancybox="<?php echo $post['id'] ?>" data-src="assets/images/posts/<?php echo $image ?>" data-caption="<?php echo $post['text'] ?>" class="post-img">
                        <img src="assets/images/posts/<?php echo $image ?>">
                    </a>

                <?php } elseif ($imagesCount == 3) { ?>

                    <a style="<?php echo $key == 0 ? 'width: 100%' : '' ?>" data-fancybox="<?php echo $post['id'] ?>" data-src="assets/images/posts/<?php echo $image ?>" data-caption="<?php echo $post['text'] ?>" class="post-img">
                        <img src="assets/images/posts/<?php echo $image ?>">
                    </a>

                <?php } elseif ($imagesCount == 4) { ?>

                    <a data-fancybox="<?php echo $post['id'] ?>" data-src="assets/images/posts/<?php echo $image ?>" data-caption="<?php echo $post['text'] ?>" class="post-img">
                        <img src="assets/images/posts/<?php echo $image ?>">
                    </a>

                <?php } elseif ($imagesCount > 4) { ?>

                    <a data-fancybox="<?php echo $post['id'] ?>" data-src="assets/images/posts/<?php echo $image ?>" data-caption="<?php echo $post['text'] ?>" class="post-img">
                        <img src="assets/images/posts/<?php echo $image ?>" class="<?php echo $key > 3 ? 'd-none' : '' ?>">
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

        // Get post comments count 
        $comments = selectRows("SELECT * FROM comments WHERE post = ?", [$post['id']]);
        $commentsCount = count($comments);

        ?>

        <div class="likes" <?php echo $likesCount > 0 ? "data-fancybox data-type='ajax' href='includes/posts/post-likes.php?postid={$post['id']}'" : '' ?>>
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