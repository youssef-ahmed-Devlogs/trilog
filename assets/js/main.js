// Handel render posts without refresh page

$(document).on("click", ".render-posts", function (e) {
  e.preventDefault();

  $.ajax({
    type: "POST",
    url: "includes/posts/render-posts.php",
    data: {
      uid: $(this).data("uid")
    },
    success: function (data) {
      $("#posts-area").html(data);
    },
  });
});


// Handel add post

$(document).on("submit", "#add-post", function (e) {
  e.preventDefault();

  $.ajax({
    type: "POST",
    url: "includes/posts/insert-post.php",
    data: new FormData(this),
    contentType: false,
    processData: false,
    beforeSend: function () {
      $("#add-post button[type='submit']").html(`
                    <div class="spinner-border text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                `);
    },
    success: function (data) {
      $("#backend_msgs").html(data);
    },
    complete: function () {
      $("#add-post button[type='submit']").html("Post");
      $(".carousel__button").click();
    },
  });
});

// Handel edit post

$(document).on("submit", "#edit-post", function (e) {
  e.preventDefault();

  $.ajax({
    type: "POST",
    url: "includes/posts/update-post.php",
    data: new FormData(this),
    contentType: false,
    processData: false,
    beforeSend: function () {
      $("#edit-post button[type='submit']").html(`
                    <div class="spinner-border text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                `);
    },
    success: function (data) {
      $("#backend_msgs").html(data);
    },
    complete: function () {
      $("#edit-post button[type='submit']").html("Edit");
      $(".carousel__button").click();
    },
  });
});

// Handel remove post

$(document).on("click", ".remove-post", function () {
  if (confirm("Are you sure?")) {
    const postid = $(this).data("id");

    $.ajax({
      type: "POST",
      url: "includes/posts/remove-post.php",
      data: {
        postid,
      },
      success: function (data) {
        $("#backend_msgs").html(data);
      },
    });
  }
});

// Handel render comments without refresh page

$(document).on("click", ".render-comments", function () {
  const postid = $(".render-comments").data("id");
  $.ajax({
    type: "POST",
    url: "includes/posts/render-comments.php",
    data: {
      postid,
    },
    success: function (data) {
      $(".comments-area").html(data);
    },
  });
});

// Handel add comment to post

$(document).on("submit", "#add-comment-form", function (e) {
  e.preventDefault();

  $.ajax({
    type: "POST",
    url: "includes/posts/add-comment.php",
    data: new FormData(this),
    contentType: false,
    processData: false,
    beforeSend: function () {
      $("#add-comment-form button[type='submit']").html(`
                    Comment
                    <div class="spinner-border spinner-border-sm text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div> 
                `);
    },
    success: function (data) {
      $("#backend_msgs_comments").html(data);
      e.target["comment-text"].value = "";
    },
    complete: function () {
      $("#add-comment-form button[type='submit']").html("Comment");
      // $(".carousel__button").click();
    },
  });
});

// Handel post like and dis like

$(document).on("click", ".like-button", function () {
  $.ajax({
    type: "POST",
    url: "includes/posts/like.php",
    data: {
      postid: $(this).data("id"),
    },
    success: function (data) {
      $("#backend_msgs_like").html(data);
    },
  });
});

// Handel comment like and dis like

$(document).on("click", ".like-comment", function () {
  $.ajax({
    type: "POST",
    url: "includes/posts/like-comment.php",
    data: {
      commentid: $(this).data("id"),
    },
    success: function (data) {
      $("#backend_msgs_like").html(data);
    },
  });
});

// Handel comment reply

$(document).on("click", ".reply-comment", function () {
  const postid = $(this).data("postid");
  const commentid = $(this).data("commentid");

  $(`#comment_${commentid} .comment_reply_container`).html(`

            <form class="comment_reply_form" id="comment-reply_${commentid}">
                <input type="hidden" name="commentid" value="${commentid}" />
                <input type="hidden" name="postid" value="${postid}" />
                <textarea name="reply" class="reply" placeholder="Reply to comment."></textarea>
                <button type="submit" class="btn success-button btn-sm">Reply</button>
            </form>

        `);

  // Handel add reply to comment
  $(document).on("submit", `#comment-reply_${commentid}`, function (e) {
    e.preventDefault();

    const formSelector = `#comment-reply_${commentid}`;

    $.ajax({
      type: "POST",
      url: "includes/posts/add-reply-comment.php",
      data: new FormData(this),
      contentType: false,
      processData: false,
      beforeSend: function () {
        $(`${formSelector} button[type='submit']`).html(`
                    Reply
                    <div class="spinner-border spinner-border-sm text-light" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div> 
                `);
      },
      success: function (data) {
        console.log(data);
        $("#backend_msgs_comments").html(data);
      },
      complete: function () {
        $(`${formSelector} button[type='submit']`).html("Reply");
        // $(".carousel__button").click();
      },
    });
  });
});

// Handel remove comment

$(document).on("click", ".remove-comment", function () {
  if (confirm("Are you sure?")) {
    const commentid = $(this).data("id");
    const commenttype = $(this).data("commenttype");

    $.ajax({
      type: "POST",
      url: "includes/posts/remove-comment.php",
      data: {
        commentid,
        commenttype,
      },
      success: function (data) {
        $("#backend_msgs_comments").html(data);
      },
    });
  }
});

// Handel Save post

$(document).on("click", ".save-post", function () {
  const postid = $(this).data("postid");

  $.ajax({
    type: "POST",
    url: "includes/posts/save-post.php",
    data: {
      postid,
    },
    success: function (data) {
      $("#backend_msgs").html(data);
    },
  });
});

// Handel render posts without refresh page

$(document).on("click", ".render-saved-posts", function (e) {
  e.preventDefault();

  $.ajax({
    type: "POST",
    url: "includes/posts/render-saved-posts.php",
    success: function (data) {
      $("#posts-area").html(data);
    },
  });
});

// Handel Preview Image cover and its gallery src 

function previewImage(e, selector) {
  const imageInput = e.target;
  const imageFile = imageInput.files[0];
  const imageSrc = URL.createObjectURL(imageFile);
  const extension = imageFile.type.split("/")[imageFile.type.split("/").length - 1];

  // Set valid image info
  const validSize = (5 * 1024) * 1024;
  const validExtensions = ['png', 'jpg', 'jpeg'];

  if (!validExtensions.includes(extension)) {
      toastr.error(`${imageFile.name} must be in (png, jpg, jpeg)`);
      imageInput.value = "";
  } else if (imageFile.size > validSize) {
      toastr.error(`${imageFile.name} so big image size must be less than 5MB`);
      imageInput.value = "";
  } else {
      // Display cover preview
      $(`${selector} .preview`).attr("data-src", imageSrc);
      $(`${selector} .preview img`).attr("src", imageSrc);
      $(`${selector} #confirm-upload`).html("<button class='btn success-button btn-sm'><i class='fas fa-upload'></i> Upload</button>")
  }
}


// Preview cover image before upload
$(document).on('change', '#up-profile-cover', function(e) {
  previewImage(e, ".profile-cover");
})

// Preview avatar image before upload
$(document).on('change', '#up-profile-img', function(e) {
  previewImage(e, ".profile-avatar");
})

$(document).on('submit', '#profile-cover-form', function(e) {
  e.preventDefault();

  $.ajax({
      type: 'post',
      url: 'includes/profile/upload-cover-avatar.php',
      data: new FormData(this),
      contentType: false,
      processData: false,
      success: function(data) {
          $("#backend_msgs").html(data);
          $("#profile-cover-form #confirm-upload").html("");
      }
  })
})

// Upload cover and avatar image
$(document).on('submit', '#profile-avatar-form', function(e) {
  e.preventDefault();

  $.ajax({
      type: 'post',
      url: 'includes/profile/upload-cover-avatar.php',
      data: new FormData(this),
      contentType: false,
      processData: false,
      success: function(data) {
          $("#backend_msgs").html(data);
          $("#profile-avatar-form #confirm-upload").html("");
      }
  })
})


// Render edit section in profile page
$(document).on("click", "#edit-profile-btn", function() {
  $.ajax({
      type: 'post',
      url: 'includes/profile/update-profile-form.php',
      success: function(data) {
          $("#posts-area").html(data);
      }
  })
})


// Update profile info
$(document).on('submit', '#edit-profile-form', function(e) {
  e.preventDefault();

  $.ajax({
      type: 'POST',
      url: 'includes/profile/update-profile.php',
      data: new FormData(this),
      contentType: false,
      processData: false,
      beforeSend: function() {
          $("#edit-profile-form button[type=submit]").html(`

              <div class="spinner-border text-light" role="status">
                  <span class="visually-hidden">Loading...</span>
              </div>

          `);
      },
      success: function(data) {
          $("#backend_msgs_edit").html(data);
      },
      complete: function() {
          $("#edit-profile-form button[type=submit]").html("Edit");
      }
  })
})

// Send friend request and cancel it from profile page
$(document).on("click", ".profile-av-info #add-friend", function() {
  $.ajax({
      type: 'post',
      url: 'includes/profile/send-friend-req.php',
      data: {
          id: $(this).data("id"),
          btn: ".profile-av-info #add-friend"
      },
      success: function(data) {
          $("#backend_msgs").html(data);
      }
  })
})

// Accept friend request from profile page
$(document).on("click", "#accept-friend-req", function() {

  if(confirm("Are you sure?")) {
    $.ajax({
      type: 'post',
      url: 'includes/profile/accept-friend-req.php',
      data: {
          id: $(this).data("id")
      },
      success: function(data) {
          $(".profile-connect").html(data);

          // Update friends list 
          $.ajax({
              type: 'post',
              url: 'includes/friends/friends-req-list.php',
              success: function(data) {
                  $(".friends-req-list").html(data);
              }
          })

      }
  })
  }
})

// remove friend request from profile page
$(document).on("click", "#rm-friend-req", function() {

  if(confirm("Are you sure?")) {
    $.ajax({
      type: 'post',
      url: 'includes/profile/rm-friend-req.php',
      data: {
          id: $(this).data("id")
      },
      success: function(data) {
          $(".profile-connect").html(data);

          // Update friends list 
          $.ajax({
              type: 'post',
              url: 'includes/friends/friends-req-list.php',
              success: function(data) {
                  $(".friends-req-list").html(data);
              }
          })

      }
  })
  }
  
})


// Accept friend request from friend request list page
$(document).on("click", ".accept-req-list", function() {

  if(confirm("Are you sure?")) {
    $.ajax({
      type: 'post',
      url: 'includes/friends/accept-req-list.php',
      data: {
          id: $(this).data("id")
      },
      success: function(data) {
          $("#backend_msgs").html(data);

          // Update friends list 
          $.ajax({
              type: 'post',
              url: 'includes/friends/friends-req-list.php',
              success: function(data) {
                  $(".friends-req-list").html(data);
              }
          })

      }
  })
  }
})

// remove friend request from friend request list page
$(document).on("click", ".rm-req-list", function() {

  if(confirm("Are you sure?")) {
    $.ajax({
      type: 'post',
      url: 'includes/friends/rm-req-list.php',
      data: {
          id: $(this).data("id")
      },
      success: function(data) {
          // Update friends list
          $("#backend_msgs").html(data);

          $.ajax({
              type: 'post',
              url: 'includes/friends/friends-req-list.php',
              success: function(data) {
                  $(".friends-req-list").html(data);
              }
          })
      }
  })
  }

})
