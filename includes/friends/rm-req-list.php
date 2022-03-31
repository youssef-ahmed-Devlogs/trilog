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
?>

    <script>
        $(".nav-friends-req .nav-icon .count").html("<?php echo countNumK(count($fr_reqs)) ?>")
    </script>

<?php
}
