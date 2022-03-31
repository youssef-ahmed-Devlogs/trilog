<?php

// Send friend request and cancel it
session_start();
include '../../connect.php';
include '../App/functions.php';

$uid = $_POST['id'];

// Create req_id
$req_id = $uid < $_SESSION['id'] ? $uid . $_SESSION['id'] : $_SESSION['id'] . $uid;
$friend = selectRow("SELECT * FROM friends WHERE req_id = ?", [$req_id]);

if (empty($friend)) {
    $result = insert("friends(req_id, send_user, req_user)", "VALUES(?,?,?)", [$req_id, $_SESSION['id'], $uid]);

    if ($result) { ?>

        <script>
            $("<?php echo $_POST['btn'] ?>").html(`
                Request send
                <i class="fas fa-arrow-right"></i>
            `);
        </script>

    <?php

    }
} else {

    $result = deleteRows("friends", "WHERE req_id = ?", [$req_id]);

    if ($result) { ?>

        <script>
            $("<?php echo $_POST['btn'] ?>").html(`
                Add Friend
                <i class="fas fa-plus"></i>
            `);
        </script>

<?php

    }
}
