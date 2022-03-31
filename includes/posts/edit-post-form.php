<?php
session_start();

include '../../connect.php';
include '../App/functions.php';

$postid = $_GET['postid'];

$uFname = selectColumn("fname", "users", "WHERE id = ?", [$_SESSION['id']]);
$postText = selectColumn("text", "posts", "WHERE id = ? AND user = ?", [$postid, $_SESSION['id']]);

?>

<div class="add-post-form">
    <h2 class="lg-head">Edit post</h2>
    <form id="edit-post" method="POST">
        <input type="hidden" name="postid" value="<?php echo $postid ?>">
        <textarea name="text" placeholder="What's in your mind, <?php echo ucwords($uFname) ?>?"><?php echo $postText ?></textarea>
        <button type="submit" class="btn primary-button">Edit</button>
    </form>
    <div id="backend_msgs"></div>
</div>