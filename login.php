<?php

$noNavbar = '';
$pageTitle = 'Login';
include 'init.php';

if (isset($_SESSION['id'])) {
    redirect("index.php");
}

?>

<main class="form-sign mb-4">
    <div class="container">
        <div class="card mx-auto">
            <form id="login">
                <div class="input-container">
                    <input type="text" name="email" placeholder=" Email address">
                </div>
                <div class="input-container">
                    <input type="password" name="password" placeholder="Password">
                </div>

                <button class="login-btn primary-button">Login</button>
            </form>

            <div class="forgotten-password">
                <a href="forgotten-password.php">Forgotten Password?</a>
            </div>

            <div class="divider"></div>

            <div class="" style="text-align: center;">
                <a class="crt-new-ac success-button" href="register.php">Create New Account</a>
            </div>
        </div>
        <div id="backend_msgs"></div>
    </div>
</main>

<?php include $App . 'footer.php'; ?>

<script>
    $(document).on('submit', '#login', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'includes/login/handle-login.php',
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
                $(".login-btn").html("Login");
            }
        })
    })
</script>