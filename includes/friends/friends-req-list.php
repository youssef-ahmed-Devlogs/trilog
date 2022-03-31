<?php

session_start();
include '../../connect.php';
include '../App/functions.php';

$fr_reqs = selectRows("SELECT friends.send_user, friends.req_user, users.fname, users.lname FROM `friends` 
JOIN users ON users.id = friends.send_user
WHERE req_user = ? AND accepted = 0", [$_SESSION['id']]);


?>

<h2 class="sm-head ps-3 pt-3">
    <span class="text-danger fw-bold"><?php echo count($fr_reqs) ?></span> Friends Request
</h2>
<!-- Get friends requests -->
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
            <button class="btn rm-req-list btn-danger" data-id="<?php echo $fr_req['send_user'] ?>">
                <i class="fas fa-trash"></i>
                Remove
            </button>
        </div>
    </li>
<?php } ?>


<?php if (count($fr_reqs) <= 0) { ?>
    <div class="content-empty p-3">You has no friends request.</div>
<?php } ?>