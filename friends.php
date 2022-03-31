<?php

$pageTitle = 'Friends';
include 'init.php';

if (!isset($_SESSION['id'])) {
    redirect('login.php');
}

// Select current user data from database
$user = selectRow("SELECT * FROM users WHERE id = ?", [$_SESSION['id']]);

// Select posts for this user only
$posts = selectRows("SELECT posts.*, users.fname, users.lname FROM posts
                                            JOIN users ON users.id = posts.user
                                            WHERE users.id = ?
                                            ORDER BY time DESC
                                        ", [$_SESSION['id']]);
// Posts Count
$postsCount = count($posts);


// Get friends of this user
$friends = selectRows("SELECT users.id AS userid, users.fname, users.lname, users.bio FROM friends
JOIN users ON users.id = friends.req_user OR users.id = friends.send_user
WHERE (req_user = ? OR send_user = ?) AND accepted = 1 AND users.id <> ?", [$_SESSION['id'], $_SESSION['id'], $_SESSION['id']]);
$friendsCount = count($friends);

?>

<main class="profile-page page-content">
    <div class="profile-top-section">
        <div class="profile-cover">
            <label for="up-profile-cover" class="change-cover" title="Upload cover">
                <i class="fas fa-image"></i>
            </label>
            <form id="profile-cover-form" method="post" enctype="multipart/form-data">
                <input type="file" name="image" id="up-profile-cover" class="d-none">
                <div id="confirm-upload">

                </div>
            </form>
            <a class="preview" data-fancybox="profile-cover-gallery" data-src="<?php echo showCover($user['id']) ?>">
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
                <label for="up-profile-img" class="change-image" title="Upload profile image">
                    <i class="fas fa-image"></i>
                </label>
                <form id="profile-avatar-form" enctype="multipart/form-data">
                    <input type="hidden" name="up_avatar">
                    <input type="file" name="image" id="up-profile-img" class="d-none">
                    <div id="confirm-upload"></div>
                </form>
                <a class="preview" data-fancybox="profile-avatar-gallery" data-src="<?php echo showAvatar($user['id']) ?>">
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
                    <button id="edit-profile-btn" class="btn success-button w-100 mb-2">
                        Edit
                    </button>
                    <div class="stats-list">
                        <div class="stat" id="posts-count">
                            <span class="value">
                                <?php echo countNumK($postsCount) ?>
                            </span>
                            <span class="key">Posts</span>
                        </div>
                        <a href="ufriends.php?uid=<?php echo $_SESSION['id'] ?>" class="stat" id="friends-count">
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
                        <div class="content-empty">You has no friends.</div>
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