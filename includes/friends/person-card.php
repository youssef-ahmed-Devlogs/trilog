<a href="uprofile.php?uid=<?php echo $fr['userid'] ?>" class="person-card">
    <div class="cover">
        <img src="<?php echo showCover($fr['userid']) ?>" alt="">
    </div>
    <div class="avatar-info">
        <img src="<?php echo showAvatar($fr['userid']) ?>" alt="">
        <h2 class="sm-head mb-0">
            <?php echo ucwords($fr['fname'] . ' ' . $fr['lname']) ?>
        </h2>
        <span class="bio">
            <?php echo $fr['bio'] ?>
        </span>
    </div>
</a>