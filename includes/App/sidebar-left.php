<?php

$user = selectRow("SELECT fname, lname FROM users WHERE id = ?", [$_SESSION['id']]);

?>

<aside class="left">

    <ul class="fun-list">
        <a href="profile.php" class="fun <?php echo $pageTitle == "Profile" ? "active" : "" ?>">
            <img src="<?php echo showAvatar($_SESSION['id']); ?>" class="fun-img">
            <span class="fun-name">
                <?php echo ucwords($user['fname'] . ' ' . $user['lname']) ?>
            </span>
        </a>
        <a href="friends.php" class="fun">
            <i class="fas fa-user-friends fun-img"></i>
            <span class="fun-name">Friends</span>
        </a>
        <a href="#" class="fun">
            <i class="fas fa-users fun-img"></i>
            <span class="fun-name">Groups</span>
        </a>
        <a href="saved.php" class="fun <?php echo $pageTitle == "Saved" ? "active" : "" ?>">
            <i class="fas fa-bookmark fun-img"></i>
            <span class="fun-name">Saved</span>
        </a>
    </ul>

</aside>