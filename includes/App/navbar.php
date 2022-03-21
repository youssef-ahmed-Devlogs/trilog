<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 d-flex align-items-center">
                <div class="header-left">
                    <div class="nav-brand">
                        <a href="index.php" class="brand">
                            <img src="assets/images/logo.png" alt="">
                        </a>
                    </div>
                    <div class="nav-search">
                        <form id="nav-search">
                            <input type="text" name="search" placeholder="search" autocomplete="off">
                        </form>
                    </div>
                    <div class="nav-icons">
                        <a href="index.php" class="nav-icon active">
                            <i class="fas fa-home"></i>
                        </a>
                        <a href="#" class="nav-icon">
                            <i class="fas fa-users"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 d-flex justify-content-end align-items-center">
                <div class="header-right">
                    <div class="nav-profile">
                        <?php

                        $uFname = selectColumn("fname", "users", "WHERE id = ?", [$_SESSION['id']]);
                        $uAvatar = selectColumn("name", "avatar", "WHERE user = ? ORDER BY id DESC", [$_SESSION['id']]);

                        ?>

                        <a href="profile.php" class="nav-icon">
                            <img src="<?php echo showAvatar($uAvatar); ?>" alt="">
                            <span>
                                <?php echo $uFname ?>
                            </span>
                        </a>
                    </div>
                    <div class="nav-icons">
                        <div class="nav-messages">
                            <a href="#" class="nav-icon">
                                <img src="assets/images/icons/messenger.svg" alt="">
                            </a>
                        </div>
                        <div class="nav-notifications">
                            <a href="#" class="nav-icon">
                                <img src="assets/images/icons/bell.svg" alt="">
                            </a>
                        </div>
                        <div class="nav-settings">
                            <a href="#" class="nav-icon">
                                <img src="assets/images/icons/down-arrow.svg" alt="">
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</header>