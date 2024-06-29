<?php include('include/header.php');?>
<style>
@media only screen and (max-width : 576px) {
.mg-10 {
    margin-top: 10px;
}
}
body {
    overflow-y: hidden;
}
</style>

<?php include('include/sidebar.php');?>

        <!-- content body start -->
        <div class="content-body">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pb-3"><input type="text" class="form-control input-rounded" id="search-user" placeholder="Search..."></div>
                                        <h4 class="card-title">Users</h4>

                                        <div class="chat-user-list"></div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<style>
.status-offline {
    background-color: #aca9b2;
}
.status-online {
    background-color: #2db94d;
}
.status {
    width: 12px;
    height: 12px;
    display: flex;
    border-radius: 50%;
    position: absolute;
    bottom: 3px;
    right: 0;
}
.media-img {
    position: relative;width: 50px;height: 50px;margin-right: 13px;
}
.chat-messages span {
    font-size: 12px;
    color: #aca9b2db;
}
.input-chat {
    background-color: #e0e0e0 !important;
    outline: none !important;
    box-shadow: none !important;
    border-color: #e0e0e0 !important;
    border-top-left-radius: 10px !important;
    border-bottom-left-radius: 10px !important;
}
.input-group-append {
    background-color: #e0e0e0 !important;
    border-top-right-radius: 10px !important;
    border-bottom-right-radius: 10px !important;
}
.btn-chat {
    color: #000;
}
.btn-chat:hover {
    color: #000;
}
.chat-messages {
    height: calc(100vh - 258px);
    overflow-x: hidden;
    overflow-y: auto;
    padding-bottom: 5px;
    margin-bottom: 5px;
}
.chat-user-list {
    height: calc(100vh - 214px);
    overflow-x: hidden;
    overflow-y: auto;
}
.chat-user-list .media {
    cursor: pointer;
}
.chat-right {
    display: none;
}
</style>
                    <div class="col-md-8 chat-right">
                        <div class="card">
                            <div class="card-body">
                                <div class="basic-form">

                                    <div class="media border-bottom-1 pb-2">
                                        <div class="media-img">
                                            <img id="chat-user-image" src="<?= base_url('uploads/images/user/photo/user.png') ?>" class="mr-3 rounded-circle" style='width:50px;height:50px;'>
                                            <span class="status chat-user-status"></span>
                                        </div>
                                        <div class="media-body pt-2">
                                            <h5 class="mb-0 chat-user-name">Name</h5>
                                            <p class="chat-user-role-name">Role</p>
                                            <input type="hidden" id="chat_user_id" value="">
                                        </div>
                                    </div>

                                    <div class="error-msg"></div>

                                    <div class="chat-messages pt-3" id="chat-body">
                                    </div>

                                    <form method="post" onsubmit="return send_message()">
                                      <div class="input-group">
                                        <input type="text" class="form-control form-control-lg input-chat" id="chat_message" placeholder="Type message..." autofocus="" required="">
                                        <div class="input-group-append">
                                          <button class="btn chat-btn" type="submit"><i class="fa fa-send-o btn-chat"></i></button>
                                        </div>
                                      </div>
                                    </form>

                                    <form id="form-main" method="post">
                                        
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- content body end -->

 <?php include('include/footer.php');?>
 <!-- include jquery validation -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>

<script>
function alertMessage(type,message) {
  if (type=='error') {
    type = 'danger';
  }

  return "<div class='alert alert-"+type+" alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "+message+" </div>";
}
 
jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, ""); 

 $("#form-main").validate({
    rules: {
        first_name: {
            required: true,
            lettersonly: true
        },
        last_name: {
            required: true,
            lettersonly: true
        }
    },
    messages: {
        first_name: {
            required: "Please Enter First Name",
            lettersonly:"Please Enter Letters and Spaces Only"
        },
        last_name: {
            required: "Please Enter Last Name",
            lettersonly:"Please Enter Letters and Spaces Only"
        }
    },
    submitHandler: function(form) {

      var myform = document.getElementById("form-main");
      var fd = new FormData(myform );

      $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/send_message') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".error-msg").html('');
          $(".form-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
        },
        success: function (response) {
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".form-btn").html("Update");

                if (obj.status=='success') {
                  $(".error-msg").html(alertMessage('success',obj.message));
                }
                else {
                  $(".error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".form-btn").html("Update");
                $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
          $(".form-btn").html("Update");
          $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
           
        }

    });

    }
});

var refresh = false;

getChats();

function getChats() {
  $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/get_chats') ?>",
        data: {t:1},
        beforeSend: function (data) {
        },
        success: function (response) {
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status=='success') {

var chat_users = obj.chat_users;
var row = "";
for (var i = 0; i<chat_users.length; i++) {
var chat_user = chat_users[i];
var status = "offline";
if (chat_user.status=='1') {
    status = "online";
}

var user_image = chat_user.user_image;
row += "<div class='media border-bottom-1 pb-0 mb-3' onclick='startChat("+chat_user.user_id+",&quot;"+chat_user.user_name+"&quot;,&quot;"+chat_user.role_name+"&quot;,&quot;"+status+"&quot;,&quot;"+chat_user.user_image+"&quot;)'>"+
"    <div class='media-img'>"+
"        <img src='"+user_image+"' class='mr-3 rounded-circle' style='width:50px;height:50px;'>"+
"        <span class='status status-"+status+"'></span>"+
"    </div>"+
"    <div class='media-body pt-2'>"+
"        <h5 class='mb-0'>"+chat_user.user_name+"</h5>"+
"        <p>"+chat_user.role_name+"</p>"+
"    </div>"+
"</div>";
}

if (chat_users.length==0) {
    $(".chat-user-list").html("<p class='text-center'>--- No Users ---</p>");
}
else {
$(".chat-user-list").html(row);
}

var chat_messages = obj.chat_messages;
var row = "";
for (var i = 0; i<chat_messages.length; i++) {
var chat_message = chat_messages[i];
var img = "<img src='"+chat_message.user_image+"' class='mr-3 rounded-circle' style='height:50px;width:50px;'>";
var sender = "";
var receiver = "";
if (chat_message.is_sender=='yes') {
    receiver = img;
}
else {
    sender = img;
}
row += "<div class='media border-bottom-1 pb-3 mb-3'>"+sender+
"    <div class='media-body'>"+
"        <p class='mb-0 pt-2'>"+chat_message.message+"</p>"+
"        <span>"+chat_message.sent_on+"</span>"+
"    </div>"+receiver+
"</div>";
}

if (chat_messages.length==0) {
    $(".chat-messages").html("<p class='text-center'>--- No Messages ---</p>");
}
else {
$(".chat-messages").html(row);
}


if (obj.current_chat_user_id!=0) {

for (var i = 0; i<chat_users.length; i++) {
    var chat_user = chat_users[i];
    if (obj.current_chat_user_id==chat_user.user_id) {
        var status = "offline";
        if (chat_user.status=='1') {
            status = "online";
        }

        startChat(chat_user.user_id,chat_user.user_name,chat_user.role_name,status,chat_user.user_image);
    }
}
}

var messageBody = document.querySelector('#chat-body');
messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;

            }
            else {
              $(".chat-user-list").html("<p class='text-center'>Some error occurred, please try again.</p>");
              $(".chat-messages").html("<p class='text-center'>Some error occurred, please try again.</p>");
            }
          }
          catch(err) {
            alert('Some error occurred, please try again.');
          }
        },
        error: function () {
            alert('Some error occurred, please try again.');
           
        }

    });
}

function startChat(receiver_id,user_name,role_name,status,image) {
    $(".chat-right").show();
    $(".chat-user-name").text(user_name);
    $(".chat-user-role-name").text(role_name);

    if ($(".chat-user-status").hasClass("status-online")) {
        $(".chat-user-status").removeClass("status-online");
    }

    if ($(".chat-user-status").hasClass("status-offline")) {
        $(".chat-user-status").removeClass("status-offline");
    }

    if (status=='online') {
        $(".chat-user-status").addClass("status-online");
    }
    else if (status=='offline') {
        $(".chat-user-status").addClass("status-offline");
    }
    $("#chat_user_id").val(receiver_id);
    $("#chat-user-image").attr("src", image);
    refresh = true;
    getChatMessages();
}

setInterval(function(){ if(refresh==true){ getChatMessages(1); } }, 10000);

function getChatMessages(rf='') {
  
  var chat_user_id = $("#chat_user_id").val();
  $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/get_chat_messages') ?>",
        data: {chat_user_id:chat_user_id},
        beforeSend: function (data) {
            if (rf=='') {
                $(".chat-messages").html("<div class='text-center' style='padding-top:20px;'><img style='height:50px;width:50px;' src='<?= base_url('public/front/ajax-loader.gif') ?>'></div>");
            }
        },
        success: function (response) {
          setTimeout(function(){
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status=='success') {

var chat_messages = obj.chat_messages;
var row = "";
for (var i = 0; i<chat_messages.length; i++) {
var chat_message = chat_messages[i];
var img = "<img src='"+chat_message.user_image+"' class='mr-3 rounded-circle' style='height:50px;width:50px;'>";
var sender = "";
var receiver = "";
if (chat_message.is_sender=='yes') {
    receiver = img;
}
else {
    sender = img;
}
row += "<div class='media border-bottom-1 pb-3 mb-3'>"+sender+
"    <div class='media-body'>"+
"        <p class='mb-0 pt-2'>"+chat_message.message+"</p>"+
"        <span>"+chat_message.sent_on+"</span>"+
"    </div>"+receiver+
"</div>";
}

if (chat_messages.length==0) {
    $(".chat-messages").html("<p class='text-center'>--- No Messages ---</p>");
}
else {
$(".chat-messages").html(row);
}

var messageBody = document.querySelector('#chat-body');
messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;

if ($(".chat-user-status").hasClass("status-online")) {
    $(".chat-user-status").removeClass("status-online");
}

if ($(".chat-user-status").hasClass("status-offline")) {
    $(".chat-user-status").removeClass("status-offline");
}

if (obj.chat_status=='online') {
    $(".chat-user-status").addClass("status-online");
}
else if (obj.chat_status=='offline') {
    $(".chat-user-status").addClass("status-offline");
}

var chat_users = obj.chat_users;
var row = "";
for (var i = 0; i<chat_users.length; i++) {
var chat_user = chat_users[i];
var status = "offline";
if (chat_user.status=='1') {
    status = "online";
}

var user_image = chat_user.user_image;
row += "<div class='media border-bottom-1 pb-0 mb-3' onclick='startChat("+chat_user.user_id+",&quot;"+chat_user.user_name+"&quot;,&quot;"+chat_user.role_name+"&quot;,&quot;"+status+"&quot;,&quot;"+chat_user.user_image+"&quot;)'>"+
"    <div class='media-img'>"+
"        <img src='"+user_image+"' class='mr-3 rounded-circle' style='width:50px;height:50px;'>"+
"        <span class='status status-"+status+"'></span>"+
"    </div>"+
"    <div class='media-body pt-2'>"+
"        <h5 class='mb-0'>"+chat_user.user_name+"</h5>"+
"        <p>"+chat_user.role_name+"</p>"+
"    </div>"+
"</div>";
}

if (chat_users.length==0) {
    $(".chat-user-list").html("<p class='text-center'>--- No Users ---</p>");
}
else {
$(".chat-user-list").html(row);
}

            }
            else {
              $(".chat-user-list").html("<p class='text-center'>Some error occurred, please try again.</p>");
              $(".chat-messages").html("<p class='text-center'>Some error occurred, please try again.</p>");
            }
          }
          catch(err) {
            alert('Some error occurred, please try again.');
          }
          },100);
        },
        error: function () {
            alert('Some error occurred, please try again.');
           
        }

    });
}

function send_message() {
    var message = $("#chat_message").val();
    var receiver_id = $("#chat_user_id").val();
  $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/send_message') ?>",
        data: {message:message,receiver_id:receiver_id},
        beforeSend: function (data) {
            $(".chat-btn").html("<i class='fa fa-spinner fa-spin btn-chat'></i>").attr("disabled", true);
            $("#chat_message").attr("disabled", true);
        },
        success: function (response) {
          setTimeout(function(){
          $(".chat-btn").html("<i class='fa fa-send-o btn-chat'></i>").attr("disabled", false);
          $("#chat_message").attr("disabled", false);
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status=='success') {
              $("#chat_message").val('').focus();

var chat_messages = obj.chat_messages;
var row = "";
for (var i = 0; i<chat_messages.length; i++) {
var chat_message = chat_messages[i];
var img = "<img src='"+chat_message.user_image+"' class='mr-3 rounded-circle' style='height:50px;width:50px;'>";
var sender = "";
var receiver = "";
if (chat_message.is_sender=='yes') {
    receiver = img;
}
else {
    sender = img;
}
row += "<div class='media border-bottom-1 pb-3 mb-3'>"+sender+
"    <div class='media-body'>"+
"        <p class='mb-0 pt-2'>"+chat_message.message+"</p>"+
"        <span>"+chat_message.sent_on+"</span>"+
"    </div>"+receiver+
"</div>";
}
row += "<div class='mg'></div>";
if (chat_messages.length==0) {
    $(".chat-messages").html("<p class='text-center'>--- No Messages ---</p>");
}
else {
$(".chat-messages").html(row);
}


/*$('html, body').animate({
    scrollTop: $(".mg").offset().top
}, 1000);*/

var messageBody = document.querySelector('#chat-body');
messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;

if ($(".chat-user-status").hasClass("status-online")) {
    $(".chat-user-status").removeClass("status-online");
}

if ($(".chat-user-status").hasClass("status-offline")) {
    $(".chat-user-status").removeClass("status-offline");
}

if (obj.chat_status=='online') {
    $(".chat-user-status").addClass("status-online");
}
else if (obj.chat_status=='offline') {
    $(".chat-user-status").addClass("status-offline");
}

var chat_users = obj.chat_users;
var row = "";
for (var i = 0; i<chat_users.length; i++) {
var chat_user = chat_users[i];
var status = "offline";
if (chat_user.status=='1') {
    status = "online";
}

var user_image = chat_user.user_image;
row += "<div class='media border-bottom-1 pb-0 mb-3' onclick='startChat("+chat_user.user_id+",&quot;"+chat_user.user_name+"&quot;,&quot;"+chat_user.role_name+"&quot;,&quot;"+status+"&quot;,&quot;"+chat_user.user_image+"&quot;)'>"+
"    <div class='media-img'>"+
"        <img src='"+user_image+"' class='mr-3 rounded-circle' style='width:50px;height:50px;'>"+
"        <span class='status status-"+status+"'></span>"+
"    </div>"+
"    <div class='media-body pt-2'>"+
"        <h5 class='mb-0'>"+chat_user.user_name+"</h5>"+
"        <p>"+chat_user.role_name+"</p>"+
"    </div>"+
"</div>";
}

if (chat_users.length==0) {
    $(".chat-user-list").html("<p class='text-center'>--- No Users ---</p>");
}
else {
$(".chat-user-list").html(row);
}

            }
            else {
              alert(obj.message);
            }
          }
          catch(err) {
            $("#chat_message").attr("disabled", false);
            $(".chat-btn").html("<i class='fa fa-send-o btn-chat'></i>").attr("disabled", false);
            alert('Some error occurred, please try again.');
          }
          },100);
        },
        error: function () {
            $("#chat_message").attr("disabled", false);
            $(".chat-btn").html("<i class='fa fa-send-o btn-chat'></i>").attr("disabled", false);
            alert('Some error occurred, please try again.');
           
        }

    });
  return false;
}

$("#search-user").on("keyup", function() {
    var value = $(this).val().toLowerCase();

    $(".chat-user-list .media").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
</script>