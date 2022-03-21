<?php

session_start();

include '../../connect.php';
include '../App/functions.php';

$postid = filterStr($_POST['postid']);
$text   = filterStr($_POST['comment-text']);

$errors = checkValidate([
    "check" => "empty",
    "val" => $text,
    "msg" => "Comment can't be empty."
]);

foreach ($errors as $error) {
    toastr($error);
}

if (empty($errors)) {
    $result = insert("comments(comment, user, post, time)", "VALUES(?,?,?,?)", [$text, $_SESSION['id'], $postid, time()]);

    if ($result > 0) {
        toastr("Comment Added.", "success");
?>

        <script>
            location.reload();
        </script>

<?php
    }
}
