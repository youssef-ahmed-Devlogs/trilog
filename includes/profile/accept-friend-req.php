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
    // $result = deleteRows("friends", "WHERE req_id = ?", [$req_id]);
    $result = update("friends", "accepted = 1", "WHERE req_id = ?", [$req_id]);

    $fr_reqs = selectRows("SELECT friends.send_user, friends.req_user, users.fname, users.lname FROM `friends` 
    JOIN users ON users.id = friends.send_user
    WHERE req_user = ? AND accepted = 0", [$_SESSION['id']]);

    // Get friends of this user
    $friends = selectRows("SELECT * FROM friends WHERE (req_user = ? OR send_user = ?) AND accepted = 1", [$uid, $uid]);
    $friendsCount = count($friends);

    // Create chat_id
    $chatid = $uid < $_SESSION['id'] ? $uid . $_SESSION['id'] : $_SESSION['id'] . $uid;

?>
    <button id="rm-friend-req" class="btn btn-danger w-100 mb-2" data-id="<?php echo $uid ?>">
        Remove Friend
        <i class="fas fa-trash"></i>
    </button>
    <a href="inbox.php?uid=<?php echo $uid ?>" class="btn msg w-100 mb-2">
        Message
        <i class="fas fa-envelope"></i>
    </a>


    <script>
        $(".nav-friends-req .nav-icon .count").html("<?php echo countNumK(count($fr_reqs)) ?>");
        $(".profile-av-info #friends-count .value").html("<?php echo countNumK($friendsCount) ?>");
    </script>

<?php
}
