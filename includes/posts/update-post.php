<?php

session_start();

include '../../connect.php';
include '../App/functions.php';

$text    = filterStr($_POST['text']);
$postid  = filterStr($_POST['postid']);

$errors = checkValidate([
    "check" => "empty",
    "val" => $text,
    "msg" => "Post text can't be empty."
]);

foreach ($errors as $e) {
    toastr($e);
}

if (empty($errors)) {
    $time = time();
    $result = update("posts", "text = ?", "WHERE id = ? AND user = ?", [$text, $postid, $_SESSION['id']]);

    if ($result > 0) {
        toastr("Edit successfully", "success");
?>

        <script>
            $(".render-posts").click();
        </script>

<?php

    }
}
