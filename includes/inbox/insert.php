<?php

session_start();
include '../../connect.php';
include '../App/functions.php';

$text = filterStr($_POST['message-text']);

// Get chat id and req user id
$uid = isset($_POST['uid']) && is_numeric($_POST['uid']) ? intval($_POST['uid']) : 0;

// Create chat_id
$chatid = $uid < $_SESSION['id'] ? $uid . $_SESSION['id'] : $_SESSION['id'] . $uid;

$isFriend = selectColumn("req_id", "friends", "WHERE req_id = ? AND accepted = 1", [$chatid]);

if ($isFriend) {
    $result = insert("messages(chat_id, text, send_user, req_user, time)", "VALUES(?,?,?,?,?)", [$chatid, $text, $_SESSION['id'], $uid, time()]);


    if ($result) {
?>

        <script>
            location.reload();
        </script>
<?php

    }
}
