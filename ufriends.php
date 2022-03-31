<?php

$pageTitle = 'Friends';
include 'init.php';

if (!isset($_SESSION['id'])) {
    redirect('login.php');
}

$uid = isset($_GET['uid']) && is_numeric($_GET['uid']) ? intval($_GET['uid']) : 0;

// Select current user data from database
$user = selectRow("SELECT * FROM users WHERE id = ?", [$uid]);

// Check if user not exist or this user is me
if (empty($user)) {
    redirect('index.php');
} elseif ($user['id'] == $_SESSION['id']) {
    redirect('friends.php');
}

// Select posts for this user only
$posts = selectRows("SELECT posts.*, users.fname, users.lname FROM posts
                                            JOIN users ON users.id = posts.user
                                            WHERE users.id = ?
                                            ORDER BY time DESC
                                        ", [$uid]);
// Posts Count
$postsCount = count($posts);

// === Show if this person is my frined ==
// Create req_id
$req_id = $_GET['uid'] < $_SESSION['id'] ? $_GET['uid'] . $_SESSION['id'] : $_SESSION['id'] . $_GET['uid'];
$friend = selectRow("SELECT * FROM friends WHERE req_id = ?", [$req_id]);

// Get friends of this user
$friends = selectRows("SELECT users.id AS userid, users.fname, users.lname, users.bio FROM friends
JOIN users ON users.id = friends.req_user OR users.id = friends.send_user
WHERE (req_user = ? OR send_user = ?) AND accepted = 1 AND users.id <> ?", [$_GET['uid'], $_GET['uid'], $_GET['uid']]);
$friendsCount = count($friends);


?>

<main class="profile-page page-content">
    <div class="profile-top-section">
        <div class="profile-cover">
            <a data-fancybox="profile-cover-gallery" data-src="<?php echo showCover($user['id']) ?>">
                <img src="<?php echo showCover($user['id']) ?>" alt="">
            </a>
        </div>
        <div class="profile-av-info">
            <div class="profile-avatar">
                <?php if ($user['trust_user'] == 1) { ?>
                    <span class="check-mark" title="Trust User">
                        <i class="fas fa-check"></i>
                    </span>
                <?php } ?>

                <a data-fancybox="profile-avatar-gallery" data-src="<?php echo showAvatar($user['id']) ?>">
                    <img src="<?php echo showAvatar($user['id']) ?>" alt="">
                </a>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="username">
                        <?php echo ucwords($user['fname'] . ' ' . $user['lname']) ?>
                    </h2>
                    <span class="bio">
                        <?php echo $user['bio'] ?>
                    </span>
                </div>
                <div class="col-lg-6">
                    <div class="profile-connect">


                        <?php if (empty($friend)) { ?>
                            <button id="add-friend" class="btn add primary-button w-100 mb-2" data-id="<?php echo $_GET['uid'] ?>">
                                Add Friend
                                <i class="fas fa-plus"></i>
                            </button>
                        <?php } elseif ($friend['accepted'] == 1) { ?>
                            <button id="rm-friend-req" class="btn btn-danger w-100 mb-2" data-id="<?php echo $_GET['uid'] ?>">
                                Remove Friend
                                <i class="fas fa-trash"></i>
                            </button>
                            <?php
                            // Create chat_id
                            $chatid = $_GET['uid'] < $_SESSION['id'] ? $_GET['uid'] . $_SESSION['id'] : $_SESSION['id'] . $_GET['uid'];

                            ?>
                            <a href="inbox.php?uid=<?php echo $_GET['uid'] ?>" class="btn msg w-100 mb-2">
                                Message
                                <i class="fas fa-envelope"></i>
                            </a>
                        <?php } else { ?>

                            <?php if ($friend['send_user'] == $_SESSION['id']) { ?>
                                <button id="add-friend" class="btn add primary-button w-100 mb-2" data-id="<?php echo $_GET['uid'] ?>">
                                    Request send
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            <?php } else { ?>
                                <button id="accept-friend-req" class="btn add success-button w-100 mb-2" data-id="<?php echo $_GET['uid'] ?>">
                                    Accept Friend
                                    <i class="fas fa-check"></i>
                                </button>
                                <button id="rm-friend-req" class="btn btn-danger w-100 mb-2" data-id="<?php echo $_GET['uid'] ?>">
                                    Remove Friend
                                    <i class="fas fa-trash"></i>
                                </button>
                            <?php } ?>



                        <?php } ?>
                    </div>
                    <div class="stats-list">
                        <div class="stat" id="posts-count">
                            <span class="value">
                                <?php echo countNumK($postsCount) ?>
                            </span>
                            <span class="key">Posts</span>
                        </div>
                        <a href="ufriends.php?uid=<?php echo $_GET['uid'] ?>" class="stat" id="friends-count">
                            <span class="value">
                                <?php echo countNumK($friendsCount) ?>
                            </span>
                            <span class="key">Friends</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <?php include 'includes/profile/profile-page-side.php' ?>
            </div>
            <div class="col">
                <div id="posts-area">
                    <div class="row my-friends-list">
                        <?php foreach ($friends as $fr) { ?>
                            <div class="col-xl-4 col-lg-6 mb-4">
                                <?php include 'includes/friends/person-card.php' ?>
                            </div>
                        <?php } ?>
                    </div>

                    <?php if (count($friends) <= 0) { ?>
                        <div class="content-empty"><?php echo ucwords($user['fname'] . ' ' . $user['lname']) ?> has no friends.</div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <button class="d-none render-posts"></button>

</main>


<?php include $App . 'footer.php' ?>

<div id="backend_msgs_like"></div>
<div id="backend_msgs"></div>