<?php

$noNavbar = '';
$pageTitle = 'Verification Code';
include 'init.php';

if (!isset($_SESSION['email_code'])) {
    redirect("index.php");
}

?>

<main class="form-sign mb-4">
    <div class="container">
        <div class="card mx-auto">
            <div>Verification code send to: <span class='fw-bold'><?php echo $_SESSION['email_code'] ?></span></div>
            <div>Please check your email and enter code or open the link in email.</div>
            <form id="activate" method="POST">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="input-container">
                            <input type="text" name="code" placeholder="Verification code">
                        </div>
                    </div>
                </div>

                <button class="login-btn primary-button">Activate</button>
            </form>
        </div>
        <div id="backend_msgs"></div>
    </div>
</main>

<?php include $App . 'footer.php'; ?>

<script>
    $(document).on('submit', '#activate', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'includes/register/activate.php',
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
                $(".login-btn").html("Activate");
            }
        })
    })
</script>