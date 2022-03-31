<?php
// Select current user data from database
$user = selectRow("SELECT * FROM users WHERE id = ?", [$_SESSION['id']]);

?>


<div class="edit-profile info-card">
    <h2 class="lg-head">Edit Profile</h2>
    <form id="edit-profile-form" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-6">
                <input type="text" name="fname" placeholder="First Name" value="<?php echo $user['fname'] ?>">
            </div>
            <div class="col-lg-6">
                <input type="text" name="lname" placeholder="Last Name" value="<?php echo $user['lname'] ?>">
            </div>
            <div class="col-lg-6">
                <input type="text" placeholder="Email" value="<?php echo $user['email'] ?>" disabled title='You cannot edit email'>
            </div>
            <div class="col-lg-12">
                <textarea name="bio" placeholder="Bio"><?php echo str_replace("<br />", "", $user['bio'])  ?></textarea>
            </div>
            <div class="col-xl-12">
                <div class="input-container mt-2">
                    <label for="date_of_birth">Date of birth</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" value="<?php echo $user['date_of_birth'] ?>">
                </div>
            </div>
            <label for="" class="mt-2">Gender</label>
            <div class="col-xl-6">
                <div class="radio-input-custome mt-2">
                    <input type="radio" name="gender" id="gender-male" value="male" <?php echo $user['gender'] == "male" ? "checked" : "" ?>>
                    <label for="gender-male">Male</label>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="radio-input-custome mt-2">
                    <input type="radio" name="gender" id="gender-female" value="female" <?php echo $user['gender'] == "female" ? "checked" : "" ?>>
                    <label for="gender-female">Female</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn primary-button w-100 mt-3 py-3">Edit</button>
    </form>
    <div id="backend_msgs_edit"></div>
</div>