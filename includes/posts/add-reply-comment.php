<?php

session_start();

include '../../connect.php';
include '../App/functions.php';

$commentid = $_POST['commentid'];
$reply     = $_POST['reply'];

$errors = checkValidate([
    "check" => "empty",
    "val" => $reply,
    "msg" => "Reply can't be empty."
]);

foreach ($errors as $error) {
    toastr($error);
}

if (empty($errors)) {
    $result = insert("comments_reply(reply, user, comment, time)", "VALUES(?,?,?,?)", [$reply, $_SESSION['id'], $commentid, time()]);

    if ($result > 0) {
        toastr("Reply Added.", "success");
?>

        <script>
            location.reload();
        </script>

<?php
    }
}
