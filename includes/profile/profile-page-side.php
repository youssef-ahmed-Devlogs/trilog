<div class="profile-page-side">
    <div class="profile-page-info info-card">
        <h4 class="sm-head">Main info</h4>

        <ul class="list">
            <li class="list-item">
                <span class="key">Email: </span>
                <span class="values">
                    <?php echo $user['email'] ?>
                </span>
            </li>
            <li class="list-item">
                <span class="key">Gender: </span>
                <span class="values">
                    <?php echo $user['gender'] ?>
                </span>
            </li>
            <li class="list-item">
                <span class="key">Date of birth: </span>
                <span class="values">
                    <?php echo $user['date_of_birth'] ?>
                </span>
            </li>
            <li class="list-item">
                <span class="key">Join date: </span>
                <span class="values">
                    <?php echo $user['join_date'] ?>
                </span>
            </li>
        </ul>
    </div>
    <div class="profile-page-friends info-card">
        <h4 class="sm-head">Friends</h4>
        <ul class="friends-list">
            <div class="row">
                <?php foreach ($friends as $key => $fr) {

                    if ($key < 9) {

                ?>
                        <div class="col-xl-6">
                            <a href="uprofile.php?uid=<?php echo $fr['userid'] ?>" class="friend">
                                <img src="<?php echo showAvatar($fr['userid']) ?>" class="friend-img">
                                <span class="friend-name">
                                    <?php echo ucwords($fr['fname'] . ' ' . $fr['lname']) ?>
                                </span>
                            </a>
                        </div>
                <?php
                    }
                }

                ?>

                <?php if (count($friends) <= 0) { ?>
                    <div class="content-empty">You has no friends.</div>
                <?php } elseif (count($friends) > 10) { ?>
                    <div class="col-12">
                        <a href="ufriends.php?uid=<?php echo isset($_GET['uid']) ? $_GET['uid'] : $_SESSION['id'] ?>" class="show-more text-center">More</a>
                    </div>
                <?php } ?>
            </div>
        </ul>
    </div>
    <div class="profile-page-groups info-card">
        <h4 class="sm-head">Groups</h4>
        <ul class="list">
            <li class="list-item">
                <span class="key">Email: </span>
                <span class="values">youssef@gmail.com</span>
            </li>
            <li class="list-item">
                <span class="key">Gender: </span>
                <span class="values">Male</span>
            </li>
            <li class="list-item">
                <span class="key">Date of birth: </span>
                <span class="values">2000-11-4</span>
            </li>
            <li class="list-item">
                <span class="key">Join date: </span>
                <span class="values">2007-6-8</span>
            </li>
        </ul>
    </div>
</div>