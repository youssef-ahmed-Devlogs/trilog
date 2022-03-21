<?php
session_start();

include '../../connect.php';
include '../App/functions.php';

$uFname = selectColumn("fname", "users", "WHERE id = ?", [$_SESSION['id']]);

?>

<div class="add-post-form">
    <h2 class="lg-head">Create post</h2>
    <form id="add-post" method="POST">
        <textarea name="text" placeholder="What's in your mind, <?php echo ucwords($uFname) ?>?"></textarea>
        <div class="file-input-custome mt-2">
            <label for="images" title="Add Photo">
                <img src="assets/images/icons/photo.svg" alt="">
            </label>
            <input type="file" id="images" name="images[]" multiple>
        </div>
        <button type="submit" class="btn primary-button">Post</button>
    </form>
    <div id="backend_msgs"></div>
</div>