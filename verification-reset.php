<?php

$noNavbar = '';
$pageTitle = 'Verification Reset';
include 'init.php';

if (!isset($_SESSION['email_code_reset'])) {
    redirect("index.php");
}

?>

<main class="form-sign mb-4">
    <div class="container">
        <div class="card mx-auto">
            <div>Verification code send to: <span class='fw-bold'><?php echo $_SESSION['email_code_reset'] ?></span></div>
            <div>Please check your email and enter code or open the link in email.</div>
            <form id="reset" method="POST">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="input-container">
                            <input type="text" name="code" placeholder="Verification code">
                        </div>
                    </div>
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
            url: 'includes/login/handle-verification-reset.php',
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