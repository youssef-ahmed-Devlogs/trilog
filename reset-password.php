<?php


$noNavbar = '';
$pageTitle = 'Reset Password';
include 'init.php';

if (!isset($_SESSION['email_reset'])) {
    redirect("index.php");
}

?>

<main class="form-sign mb-4">
    <div class="container">
        <div class="card mx-auto">
            <h3 class="mb-3 fw-bold">Create a new password</h3>
            <form id="reset">
                <div class="input-container">
                    <input type="password" name="password" placeholder="Password">
                </div>
                <div class="input-container">
                    <input type="password" name="repeat-password" placeholder="Repeat Password">
                </div>

                <button class="login-btn primary-button">Reset Password</button>
            </form>
        </div>
        <div id="backend_msgs"></div>
    </div>
</main>

<?php include $App . 'footer.php'; ?>

<script>
    $(document).on('submit', '#reset', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'includes/login/handle-reset-password.php',
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