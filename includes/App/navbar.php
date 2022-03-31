<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 d-flex align-items-center">
                <div class="header-left">
                    <div class="nav-brand">
                        <a href="index.php" class="brand">
                            <img src="assets/images/logo.png" alt="">
                        </a>
                    </div>
                    <div class="nav-search">
                        <form id="nav-search">
                            <input type="text" name="search" placeholder="search" autocomplete="off">
                        </form>
                    </div>
                    <div class="nav-icons">
                        <a href="index.php" class="nav-icon <?php echo $pageTitle == "Home" ? "active" : '' ?>">
                            <i class="fas fa-home"></i>
                        </a>
                        <a href="#" class="nav-icon">
                            <i class="fas fa-users"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 d-flex justify-content-end align-items-center">
                <div class="header-right">
                    <div class="nav-profile">
                        <?php

                        $uFname = selectColumn("fname", "users", "WHERE id = ?", [$_SESSION['id']]);

                        ?>

                        <a href="profile.php" class="nav-icon">
                            <img src="<?php echo showAvatar($_SESSION['id']); ?>" alt="">
                            <span>
                                <?php echo $uFname ?>
                            </span>
                        </a>
                    </div>
                    <div class="nav-icons">

                        <!-- Get friends requests -->
                        <?php

                        $fr_reqs = selectRows("SELECT friends.send_user, friends.req_user, users.fname, users.lname FROM `friends` 
                        JOIN users ON users.id = friends.send_user
                        WHERE req_user = ? AND accepted = 0 ORDER BY friends.id DESC", [$_SESSION['id']]);

                        ?>

                        <div class="nav-friends-req">

                            <a class="nav-icon" href="#" role="button" id="friends-req-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-friends"></i>
                                <span class="count">
                                    <?php echo count($fr_reqs) ?>
                                </span>
                            </a>

                            <ul class="dropdown-menu friends-list friends-req-list" aria-labelledby="friends-req-dropdown">
                                <h2 class="sm-head ps-3 pt-3">
                                    <span class="text-danger fw-bold"><?php echo count($fr_reqs) ?></span> Friends Request
                                </h2>
                                <?php foreach ($fr_reqs as $fr_req) { ?>

                                    <li class="dropdown-item">
                                        <a href="uprofile.php?uid=<?php echo $fr_req['send_user'] ?>" class="friend">
                                            <img src="<?php echo showAvatar($fr_req['send_user']) ?>" class="friend-img">
                                            <span class="friend-name">
                                                <?php echo ucwords($fr_req['fname'] . ' ' . $fr_req['lname']) ?>
                                            </span>
                                        </a>
                                        <div class="req-actions">
                                            <button class="accept-req-list btn success-button" data-id="<?php echo $fr_req['send_user'] ?>">
                                                <i class="fas fa-check"></i>
                                                Accept
                                            </button>
                                            <button class="rm-req-list btn btn-danger" data-id="<?php echo $fr_req['send_user'] ?>">
                                                <i class="fas fa-trash"></i>
                                                Remove
                                            </button>
                                        </div>
                                    </li>
                                <?php } ?>

                                <?php if (count($fr_reqs) <= 0) { ?>
                                    <div class="content-empty p-3">You has no friends request.</div>
                                <?php } ?>
                            </ul>


                        </div>

                        <!-- Get messages -->
                        <?php

                        $chatsid = selectRows("SELECT chat_id FROM messages
                                                    JOIN friends ON friends.req_id = messages.chat_id
                                                WHERE friends.accepted = 1 AND (messages.req_user = ? OR messages.send_user = ?)
                                                GROUP BY chat_id ORDER BY messages.id DESC
                                                ", [$_SESSION['id'], $_SESSION['id']]);


                        ?>

                        <div class="nav-messages">

                            <?php ?>
                            <a class="nav-icon" href="#" role="button" id="msgs-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="assets/images/icons/messenger.svg" alt="">
                                <span class="count">
                                    <?php echo countNumK(count($chatsid)) ?>
                                </span>
                            </a>

                            <ul class="dropdown-menu friends-list msgs-list" aria-labelledby="msgs-dropdown">
                                <h2 class="sm-head ps-3 pt-3">
                                    <span class="text-danger fw-bold">
                                        <?php echo countNumK(count($chatsid)) ?>
                                    </span> Messages
                                </h2>

                                <?php

                                foreach ($chatsid as $chatid) {

                                    $lastMsg = selectRow("SELECT * FROM messages WHERE chat_id = ? ORDER BY id DESC LIMIT 1", [$chatid['chat_id']]);
                                    $user = $lastMsg['send_user'] == $_SESSION['id'] ? 'req_user' : 'send_user';

                                ?>


                                    <li class="dropdown-item" style="white-space: normal;">
                                        <a href="inbox.php?uid=<?php echo $lastMsg[$user] ?>" class="msg">

                                            <div class="friend">
                                                <img src="<?php echo showAvatar($lastMsg[$user]) ?>" class="friend-img">
                                                <span class="friend-name">

                                                    <?php
                                                    $msgUsername = selectRow("SELECT fname, lname FROM users WHERE id = ?", [$lastMsg[$user]]);
                                                    echo cutstrMax(ucwords($msgUsername['fname'] . ' ' . $msgUsername['lname']), 14, "...");
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="msg-info">
                                                <p class="text">
                                                    <?php echo cutstrMax($lastMsg['text'], 60, "..."); ?>
                                                </p>
                                            </div>
                                            <span class="time">
                                                <?php echo timeAgo($lastMsg['time']) ?>
                                            </span>
                                        </a>
                                    </li>


                                <?php } ?>

                                <?php if (count($chatsid) <= 0) { ?>
                                    <div class="content-empty p-3">You has no messages.</div>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="nav-notifications">
                            <a href="#" class="nav-icon">
                                <img src="assets/images/icons/bell.svg" alt="">
                            </a>
                        </div>
                        <div class="nav-settings">

                            <?php

                            $user = selectRow("SELECT fname, lname FROM users WHERE id = ?", [$_SESSION['id']]);

                            ?>

                            <a class="nav-icon" href="#" role="button" id="nav-settings-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="assets/images/icons/down-arrow.svg" alt="">
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="nav-settings-dropdown">

                                <li>
                                    <a href="profile.php" class="dropdown-item fun <?php echo $pageTitle == "Profile" ? "active" : "" ?>">
                                        <img src="<?php echo showAvatar($_SESSION['id']); ?>" class="fun-img">
                                        <span class="fun-name">
                                            <?php echo ucwords($user['fname'] . ' ' . $user['lname']) ?>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="edit-profile.php" class="dropdown-item fun">
                                        <i class="fas fa-user fun-img"></i>
                                        <span class="fun-name">Edit Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="friends.php" class="dropdown-item fun">
                                        <i class="fas fa-user-friends fun-img"></i>
                                        <span class="fun-name">Friends</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item fun">
                                        <i class="fas fa-users fun-img"></i>
                                        <span class="fun-name">Groups</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="saved.php" class="dropdown-item fun <?php echo $pageTitle == "Saved" ? "active" : "" ?>">
                                        <i class="fas fa-bookmark fun-img"></i>
                                        <span class="fun-name">Saved</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="logout.php" class="dropdown-item fun text-danger">
                                        <i class="fas fa-door-closed fun-img"></i>
                                        <span class="fun-name">Logout</span>
                                    </a>
                                </li>

                            </ul>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</header>