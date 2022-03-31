<?php

session_start();

include '../../connect.php';
include '../App/functions.php';

$text    = filterStr($_POST['text']);
$images  = $_FILES['images'];
$imagesCount = count(array_filter($images['name']));


if ($imagesCount <= 0) {
    $errors = checkValidate([
        "check" => "empty",
        "val" => $text,
        "msg" => "Post text can't be empty."
    ]);
}

// Set images config and validation
for ($i = 0; $i < $imagesCount; $i++) {
    $name = $images['name'][$i];
    $size = $images['size'][$i];
    $tmpName = $images['tmp_name'][$i];
    $type = $images['type'][$i];
    $type = explode('/', $type);
    $type = end($type);
    $randName = rand(0, 99999999999) * 9999 . '.' . $type;

    // Validation
    $validExtensions = ['png', 'jpg', 'jpeg'];
    $validSize = (5 * 1024) * 1024;

    if (!empty($name)) {
        $errors = checkValidate([
            "check" => "file",
            "type" => $type,
            "validExtensions" => $validExtensions,
            "msg" => "$name file type must be in (png, jpg, jpeg)."
        ]);

        $errors = checkValidate([
            "check" => "fileSize",
            "fileSize" => $size,
            "max" => $validSize,
            "msg" => "$name Image must be less than 5MB."
        ]);
    }

    if (empty($errors)) {
        $db_images_name[] = $randName;
        move_uploaded_file($tmpName, '../../includes/uploads/posts/' . $randName);
    }
}

if (!empty($errors)) {
    foreach ($errors as $e) {
        toastr($e);
    }
}


if (!empty($db_images_name) || !empty($text)) {
    $db_images_name = isset($db_images_name) ? implode(",", $db_images_name) : "";
    $time = time();

    $result = insert("posts(text, images, user, time)", "VALUES(?,?,?,?)", [$text, $db_images_name, $_SESSION['id'], $time]);

    if ($result > 0) {
        toastr("Posted successfully", "success");


        // Render posts count in current user profile page after add a new post
        // Select posts for this user only
        $posts = selectRows(
            "SELECT posts.*, users.fname, users.lname FROM posts
                                JOIN users ON users.id = posts.user
                                WHERE users.id = ?
                                ORDER BY time DESC
                                ",
            [$_SESSION['id']]
        );

        // Posts Count
        $postsCount = count($posts);
?>
        <script>
            $(".render-posts").click();

            $(".profile-av-info #posts-count .value").html("<?php echo countNumK($postsCount) ?>")
        </script>

<?php
    }
}
