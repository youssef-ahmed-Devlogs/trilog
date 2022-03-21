<?php

$noNavbar = '';
$pageTitle = 'Register';
include 'init.php';

if (isset($_SESSION['id'])) {
    redirect("index.php");
}

?>

<main class="form-sign mb-4">
    <div class="container">
        <div class="card mx-auto">
            <form id="register" method="POST">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="input-container">
                            <input type="text" name="fname" placeholder="First Name">
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="input-container">
                            <input type="text" name="lname" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="input-container">
                            <input type="text" name="email" placeholder="Email address">
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="input-container">
                            <input type="password" name="password" placeholder="New Password">
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="input-container mt-2">
                            <label for="date_of_birth">Date of birth</label>
                            <input type="date" name="date_of_birth" id="date_of_birth">
                        </div>
                    </div>
                    <label for="" class="mt-2">Gender</label>
                    <div class="col-xl-6">
                        <div class="radio-input-custome mt-2">
                            <input type="radio" name="gender" id="gender-male" value="male">
                            <label for="gender-male">Male</label>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="radio-input-custome mt-2">
                            <input type="radio" name="gender" id="gender-female" value="female">
                            <label for="gender-female">Female</label>
                        </div>
                    </div>
                    <input type="radio" name="gender" class="d-none" value="" checked>
                </div>

                <button class="login-btn primary-button">Register</button>
            </form>

            <div class="forgotten-password">
                <a href="login.php">Already have a account?</a>
            </div>
        </div>
        <div id="backend_msgs"></div>
    </div>
</main>

<?php include $App . 'footer.php'; ?>

<script>
    $(document).on('submit', '#register', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'includes/register/insert.php',
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
                $(".login-btn").html("Register");
            }
        })
    })
</script>