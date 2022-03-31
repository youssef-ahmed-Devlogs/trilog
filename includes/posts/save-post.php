<?php

session_start();

include '../../connect.php';
include '../App/functions.php';

$postid = filterStr($_POST['postid']);


$check = selectColumn("id", "saved", "WHERE post = ? AND user = ?", [$postid, $_SESSION['id']]);

if ($check) {

    $result = deleteRows("saved", "WHERE post = ? AND user = ?", [$postid, $_SESSION['id']]);

    if ($result > 0) {
        toastr("Post removed from saved.", "success");
?>

        <script>
            $("#post_<?php echo $postid ?> .save-post").html("Save");
        </script>

    <?php
    }
} else {

    $result = insert("saved(user, post)", "VALUES(?,?)", [$_SESSION['id'], $postid]);

    if ($result > 0) {
        toastr("Post added to saved.", "success");

    ?>

        <script>
            $("#post_<?php echo $postid ?> .save-post").html("Unsave");
        </script>

<?php
    }
}

?>

<script>
    $(".render-saved-posts").click();
</script>