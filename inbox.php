<?php

$pageTitle = 'Inbox';
include_once 'init.php';

if (!isset($_SESSION['id'])) {
    redirect('login.php');
}

// Get chat id and req user id
$uid = isset($_GET['uid']) && is_numeric($_GET['uid']) ? intval($_GET['uid']) : 0;

// Create chat_id
$chatid = $uid < $_SESSION['id'] ? $uid . $_SESSION['id'] : $_SESSION['id'] . $uid;

$isFriend = selectColumn("req_id", "friends", "WHERE req_id = ? AND accepted = 1", [$chatid]);

if (!$isFriend || $uid == $_SESSION['id']) {
    redirect('index.php');
}

$chat = selectRows("SELECT * FROM messages WHERE chat_id = ? AND (send_user = ? OR req_user = ?) ", [$chatid, $_SESSION['id'], $_SESSION['id']]);

?>

<main class="inbox-page page-content ">
    <div class="container-fluid">
        <div class="row">

            <div class="col">
                <div id="posts-area">
                    <div class="chat-inbox">
                        <div class="top-section">

                            <!-- Get friend name and image -->
                            <?php $user = selectRow("SELECT fname, lname FROM users WHERE id = ?", [$uid]); ?>

                            <a href="uprofile.php?uid=<?php echo $uid ?>" class="user">
                                <img src="<?php echo showAvatar($uid) ?>" alt="">
                                <h2 class="sm-head">
                                    <?php echo cutstrMax(ucwords($user['fname'] . ' ' . $user['lname']), 14, "..."); ?>
                                </h2>
                            </a>
                        </div>
                        <div class="chat-area">
                            <?php

                            foreach ($chat as $msg) {

                                if ($msg['send_user'] == $_SESSION['id']) {

                            ?>

                                    <div class="send mb-3">
                                        <a href="uprofile.php?uid=<?php echo $msg['send_user'] ?>">
                                            <img src="<?php echo showAvatar($msg['send_user']) ?>" alt="">
                                        </a>
                                        <div class="mess-bar">
                                            <p class="message">
                                                <?php echo $msg['text'] ?>
                                            </p>
                                            <span class="time">
                                                <?php echo timeAgo($msg['time']) ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php
                                } else { ?>

                                    <div class="req mb-3">
                                        <a href="uprofile.php?uid=<?php echo $msg['send_user'] ?>">
                                            <img src="<?php echo showAvatar($msg['send_user']) ?>" alt="">
                                        </a>
                                        <div class="mess-bar">
                                            <p class="message">
                                                <?php echo $msg['text'] ?>
                                            </p>
                                            <span class="time">
                                                <?php echo timeAgo($msg['time']) ?>
                                            </span>
                                        </div>
                                    </div>

                            <?php
                                }
                            }

                            ?>
                        </div>
                        <div class="chat-control">
                            <form id="send-message" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="uid" value="<?php echo $uid ?>">
                                <textarea name="message-text" placeholder="Message"></textarea>
                                <button class="btn primary-button btn-sm">
                                    Send
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="d-none render-chat"></button>
</main>


<?php include $App . 'footer.php' ?>

<div id="backend_msgs"></div>

<script>
    const lastMsg = document.querySelectorAll(".chat-area .message").length * 300;
    document.querySelector(".inbox-page .chat-inbox .chat-area").scrollTo(0, lastMsg);


    $(document).on('submit', '#send-message', function(e) {
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: 'includes/inbox/insert.php',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data)
                $("#backend_msgs").html(data);
            }
        })
    })
</script>