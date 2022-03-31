<aside class="right">
    <div class="friends mb-4">
        <h3 class="sm-head">Groups</h3>
        <ul class="friends-list">
            <a href="#" class="friend">
                <i class="fas fa-users fa-2x"></i>
                <span class="friend-name">Group 1</span>
            </a>
            <a href="#" class="friend">
                <i class="fas fa-users fa-2x"></i>
                <span class="friend-name">Group 2</span>
            </a>
            <a href="#" class="friend">
                <i class="fas fa-users fa-2x"></i>
                <span class="friend-name">Group 3</span>
            </a>
            <a href="#" class="friend">
                <i class="fas fa-users fa-2x"></i>
                <span class="friend-name">Group 4</span>
            </a>
            <a href="#" class="friend">
                <i class="fas fa-users fa-2x"></i>
                <span class="friend-name">Group 5</span>
            </a>


        </ul>
    </div>

    <?php
    // Get friends of this user
    $friends = selectRows("SELECT users.id AS userid, users.fname, users.lname FROM friends
        JOIN users ON users.id = friends.req_user OR users.id = friends.send_user
        WHERE (req_user = ? OR send_user = ?) AND accepted = 1 AND users.id <> ? LIMIT 25", [$_SESSION['id'], $_SESSION['id'], $_SESSION['id']]);
    ?>

    <div class="friends">
        <h3 class="sm-head">Friends</h3>
        <ul class="friends-list">

            <?php

            foreach ($friends as $key => $fr) {

                // Create chat_id
                $chatid = $fr['userid'] < $_SESSION['id'] ? $fr['userid'] . $_SESSION['id'] : $_SESSION['id'] . $fr['userid'];

            ?>

                <a href="inbox.php?uid=<?php echo $fr['userid'] ?>" class="friend">
                    <img src="<?php echo showAvatar($fr['userid']) ?>" class="friend-img">
                    <span class="friend-name">
                        <?php echo ucwords($fr['fname'] . ' ' . $fr['lname']) ?>
                    </span>
                </a>

            <?php } ?>

            <?php if (count($friends) <= 0) { ?>
                <div class="content-empty">You has no friends.</div>
            <?php } elseif (count($friends) == 25) { ?>
                <a href="friends.php" class="show-more text-right">More</a>
            <?php } ?>




        </ul>
    </div>
</aside>