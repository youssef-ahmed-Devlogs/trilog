<?php

// Remove comment or reply comment

session_start();
include '../../connect.php';
include '../App/functions.php';

$table = $_POST['commenttype'] === 'comment' ? "comments" : "comments_reply";
$commentid = $_POST['commentid'];

$check = selectColumn("id", $table, "WHERE id = ?", [$commentid]);

if ($check) {
    $result = deleteRows($table, "WHERE id = ?", [$commentid]);

    if ($result > 0) { ?>
        <script>
            $(".render-comments").click();
        </script>
<?php
    }
}
