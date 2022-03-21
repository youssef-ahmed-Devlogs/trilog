<?php

$noNavbar = '';
$pageTitle = 'Forgotten Password';
include 'init.php';

if (isset($_SESSION['id'])) {
    redirect("index.php");
}

?>

<main class="form-sign mb-4">
    <div class="container">
        <div class="card mx-auto">
            <form id="forgotten-password">
                <div class="input-container">
                    <input type="text" name="email" placeholder=" Email address">
                </div>

                <button class="login-btn primary-button">Reset Password</button>
            </form>

            <div class="forgotten-password">
                <a href="login.php">Return to Login?</a>
            </div>
        </div>
        <div id="backend_msgs"></div>
    </div>
</main>

<?php include $App . 'footer.php'; ?>

<script>
    $(document).on('submit', '#forgotten-password', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'includes/login/handle-forgotten-pass.php',
            data: new FormData(this),
            contentType: false,
            processData: false,
            beforeSend: function() {
                $(".login-btn").html(`
                
                    <div class="spinner-border text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>

                `);
            },
            success: function(data) {
                $("#backend_msgs").html(data);
            },
            complete: function() {
                $(".login-btn").html("Reset Password");
            }
        })
    })
</script>