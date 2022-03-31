<?php

// Send friend request and cancel it
session_start();
include '../../connect.php';
include '../App/functions.php';

$uid = $_POST['id'];

// Create req_id
$req_id = $uid < $_SESSION['id'] ? $uid . $_SESSION['id'] : $_SESSION['id'] . $uid;
$friend = selectRow("SELECT * FROM friends WHERE req_id = ?", [$req_id]);


if (!empty($friend)) {
    $result = deleteRows("friends", "WHERE req_id = ?", [$req_id]);

    $fr_reqs = selectRows("SELECT friends.send_user, friends.req_user, users.fname, users.lname FROM `friends` 
    JOIN users ON users.id = friends.send_user
    WHERE req_user = ? AND accepted = 0", [$_SESSION['id']]);

    // Get friends of this user
    $friends = selectRows("SELECT * FROM friends WHERE (req_user = ? OR send_user = ?) AND accepted = 1", [$uid, $uid]);
    $friendsCount = count($friends);

?>
    <button id="add-friend" class="btn add primary-button w-100 mb-2" data-id="<?php echo $uid ?>">
        Add Friend
        <i class="fas fa-plus"></i>
    </button>

    <script>
        $(".nav-friends-req .nav-icon .count").html("<?php echo countNumK(count($fr_reqs)) ?>")
        $(".profile-av-info #friends-count .value").html("<?php echo countNumK($friendsCount) ?>");
    </script>

<?php
}
