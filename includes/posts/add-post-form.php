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
        <div class="images-preview" id="images-preview">

        </div>
        <div class="file-input-custome mt-2">
            <label for="images" title="Add Photo">
                <img src="assets/images/icons/photo.svg" alt="">
            </label>
            <!-- Input file -->
            <input type="file" id="images" name="images[]" multiple onchange="images_select()">
        </div>
        <button type="submit" class="btn primary-button">Post</button>
    </form>
    <div id="backend_msgs"></div>
</div>


<script>
    var upImages = [];

    function images_select() {
        var images = document.getElementById("images").files;

        var $fileUpload = $(".file-input-custome input[type='file']");
        if (parseInt($fileUpload.get(0).files.length) > 8) {
            $fileUpload.val('');
            toastr.error("You can upload a maximum of 8 photos.");
        } else {

            const validSize = (5 * 1024) * 1024;
            const validExtensions = ['png', 'jpg', 'jpeg'];

            for (i = 0; i < images.length; i++) {

                const extension = images[i]['type'].split("/")[images[i]['type'].split("/").length - 1]

                if (!validExtensions.includes(extension)) {
                    toastr.error(`${images[i]['name']} must be in (png, jpg, jpeg)`);
                } else if (images[i]['size'] > validSize) {
                    toastr.error(`${images[i]['name']} so big image size must be less than 5MB`);
                } else {
                    upImages.push({
                        "name": images[i]['name'],
                        "url": URL.createObjectURL(images[i]),
                        "file": images[i]
                    })


                }
            }

            images_show()
        }
    }

    function images_show() {

        document.querySelector(".images-preview").innerHTML = "";

        upImages.forEach(image => {
            document.querySelector(".images-preview").innerHTML += `
                    <div class="image-preview">
                        <img src="${image['url']}" alt="" >
                    </div>
            `
        })

        upImages = [];
    }
</script>