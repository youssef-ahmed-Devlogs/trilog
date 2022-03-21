<?php

$pageTitle = 'Home';
include 'init.php';

if (!isset($_SESSION['id'])) {
    redirect('login.php');
}

?>

<main class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <?php include $App . 'sidebar-left.php'; ?>
            </div>
            <div class="col">
                <?php include 'includes/posts/add-post.php'; ?>
                <div id="posts-area">
                    <?php

                    $posts = selectRows("SELECT posts.*, users.fname, users.lname FROM posts JOIN users ON users.id = posts.user ORDER BY time DESC");

                    foreach ($posts as $post) {
                        include 'includes/posts/post.php';
                    }


                    ?>
                </div>
            </div>
            <div class="col-md-3">
                <?php include $App . 'sidebar-right.php'; ?>
            </div>
        </div>
    </div>
</main>


<?php include $App . 'footer.php' ?>

<!-- Handel add post -->
<script>
    $(document).on('submit', '#add-post', function(e) {
        e.preventDefault();

        var $fileUpload = $(".file-input-custome input[type='file']");
        if (parseInt($fileUpload.get(0).files.length) > 8) {
            $fileUpload.val('');
            toastr.error("You can upload a maximum of 8 photos.");
        }

        $.ajax({
            type: 'POST',
            url: 'includes/posts/insert-post.php',
            data: new FormData(this),
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("#add-post button[type='submit']").html(`
                    <div class="spinner-border text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                `)
            },
            success: function(data) {
                $("#backend_msgs").html(data);
            },
            complete: function() {
                $("#add-post button[type='submit']").html("Post")
                $(".carousel__button").click();
            }
        })
    });
</script>

<!-- Handel add comment to post -->
<script>
    $(document).on('submit', '#add-comment-form', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'includes/posts/add-comment.php',
            data: new FormData(this),
            contentType: false,
            processData: false,
            beforeSend: function() {
                $("#add-comment-form button[type='submit']").html(`
                    Comment
                    <div class="spinner-border spinner-border-sm text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div> 
                `)
            },
            success: function(data) {
                $("#backend_msgs_comments").html(data);
            },
            complete: function() {
                $("#add-comment-form button[type='submit']").html("Comment")
                // $(".carousel__button").click();
            }
        })
    });
</script>

<!-- Handel post like and dis like -->
<script>
    $(document).on('click', '.like-button', function() {
        $.ajax({
            type: 'POST',
            url: 'includes/posts/like.php',
            data: {
                postid: $(this).data('id')
            },
            success: function(data) {
                $("#backend_msgs_like").html(data);
            }
        })
    })
</script>

<!-- Handel post like and dis like -->
<script>
    $(document).on('click', '.like-comment', function() {
        $.ajax({
            type: 'POST',
            url: 'includes/posts/like-comment.php',
            data: {
                commentid: $(this).data('id')
            },
            success: function(data) {
                $("#backend_msgs_like").html(data);
            }
        })
    })
</script>

<div id="backend_msgs_like"></div>