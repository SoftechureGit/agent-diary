<?php include('include/header.php');?>
<style>
@media only screen and (max-width : 576px) {
.mg-10 {
	margin-top: 10px;
}
}

.radio-toolbar {
  margin: 10px;
}

.radio-toolbar input[type="radio"] {
  opacity: 0;
  position: fixed;
  width: 0;
}

.radio-toolbar label {
    display: inline-block;
    background-color: #ddd;
    padding: 7px 14px;
    width: 100%;
    font-family: sans-serif, Arial;
    font-size: 12px;
    border: 1px solid #444;
    border-radius: 4px;
    text-align: center;
    cursor: pointer;
}

.radio-toolbar label:hover {
  background-color: #dfd;
}

.radio-toolbar input[type="radio"]:focus + label {
    border: 1px dashed #444;
}

.radio-toolbar input[type="radio"]:checked + label {
    background-color: #bfb;
    border-color: #4c4;
}
</style>
<?php include('include/sidebar.php');?>








        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <!--<div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Home</a></li>
                    </ol>
                </div>
            </div>-->
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">


        						<div class="error-msg-2">
        							<?php if($this->session->flashdata('error_msg')) { ?>
                        <div class="alert alert-danger pd8">
                          <?php echo $this->session->flashdata('error_msg'); ?>
                        </div>
                      <?php } ?>
                      <?php if($this->session->flashdata('success_msg')) { ?>
                        <div class="alert alert-success pd8">
                          <?php echo $this->session->flashdata('success_msg'); ?>
                        </div>
                      <?php } ?>
        						</div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h4 class="card-title">Ticket: <span class="text-success"><?= $ticket_detail->ticket_track_id ?></span></h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                        <a href="<?= base_url(ADMIN_URL.'tickets') ?>"><button type="button" class="btn btn-dark btn-sm" >Back</button></a>
                                    </div>
                                </div>
                                <div class="basic-form">

                                        <div class="form-row">

                                            <div class="col-md-6">
                                                <label>Ticket Title: </label> <span style="color: #333;"><?= $ticket_detail->ticket_title ?></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Open Time: </label> <span style="color: #333;"><?= $ticket_detail->created_at ?></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Ticket User: </label> <span style="color: #333;"><?= $ticket_detail->first_name.' '.$ticket_detail->last_name ?></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Ticket Email: </label> <span style="color: #333;"><?= $ticket_detail->email ?></span>
                                            </div>

                                            <div class="col-md-6 pt-2">
                                                <label>Status: </label> <span style="color: #333;"><?php if($ticket_detail->ticket_status==1) { echo "<span class='text-success'>Open</span>"; } else if($ticket_detail->ticket_status==2) { echo "<span class='text-danger'>Close</span>"; } ?></span> <button type='button' class='btn btn-success btn-sm' style="color: #fff;padding: 1px 5px !important;margin-left: 20px;" onclick='editStatus()'><i class='fa fa-edit'></i> Edit</button>

                                                <div id="ticket-status" style="margin-top: 15px;display: none;">
                                                	<form id="form-modal" method="post">
                                                		<input type="hidden" name="id" value="<?= $ticket_detail->ticket_id ?>">
	                                                	<div class="error-msg"></div>
									                    <div class="row">
									                    	<div class="col-md-4">
										                        <select class="form-control" id="ticket_status" name="ticket_status" required="">
										                            <option value="">Select Status</option>
										                            <option value="1" <?php if($ticket_detail->ticket_status==1) { echo 'selected'; } ?>>Open</option>
										                            <option value="2" <?php if($ticket_detail->ticket_status==2) { echo 'selected'; } ?>>Closed</option>
										                        </select>
										                    </div>

									                    	<div class="col-md-8">
											                    <button type="submit" class="btn btn-success form-btn wd-100 btn-sm" style="width:80px;height: calc(2.0625rem + 2px);color: #fff;">Update</button>
											                    <button type="button" class="btn btn-danger btn-sm" style="width:60px;height: calc(2.0625rem + 2px);" onclick="editStatusHide()">Close</button>
									                    	</div>
									                    </div>
									                </form>
                                                </div>
                                            </div>

                                        </div>


                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if($ticket_messages) { ?>
                      <div class="col-lg-12">
                        <h4>Replies:</h4>
                      </div>
                    <?php } ?>
                    
                    <div class="col-lg-12 reply-list">
                	<?php foreach ($ticket_messages as $ticket_message_row) { ?>
                		<div class="row">
	                		<div class="col-lg-12">
		                        <div class="card">
		                            <div class="card-body pt-4 pb-3">
		                                <div class="bootstrap-media">
		                                    <div class="media">
		                                    	<?php 
		                                    		$user_image = base_url('uploads/images/user/photo/user.png');
								                    if ($ticket_message_row->sender_id==$user_detail->user_id) {
								                        if ($ticket_message_row->s_image) {
								                            $user_image = base_url('uploads/images/user/photo/'.$ticket_message_row->s_image);
								                        }
								                    }
								                    else {
								                        if ($ticket_message_row->s_image) {
								                            $user_image = base_url('uploads/images/user/photo/'.$ticket_message_row->s_image);
								                        }
								                    }
							                    ?>
							                    <?php if ($ticket_message_row->sender_id!=$user_detail->user_id) { ?>
		                                        <img class="mr-3" src="<?= $user_image ?>" alt="User Image" style="width: 50px;height: 50px;border-radius: 50%;">
							                    <?php } ?>
		                                        <div class="media-body">
		                                            <h5 class="mt-0 mb-1"><?php if ($ticket_message_row->sender_id==$user_detail->user_id) { echo $ticket_message_row->s_first_name.' '.$ticket_message_row->s_last_name; } else { echo $ticket_message_row->r_first_name.' '.$ticket_message_row->r_last_name; } ?></h5><?= $ticket_message_row->ticket_message; ?>
		                                        <p class="f-s-13 text-muted pt-1"><i class="fa fa-clock-o"></i> <?= $ticket_message_row->created_at; ?></p>
		                                        </div>
		                                        <?php if ($ticket_message_row->sender_id==$user_detail->user_id) { ?>
		                                        <img class="ml-3" src="<?= $user_image ?>" alt="User Image" style="width: 50px;height: 50px;border-radius: 50%;">
							                    <?php } ?>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
	                    </div>
                	<?php } ?>
                	</div>

                	<?php if($ticket_detail->ticket_status==1) { ?>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body pt-4 pb-3">
                            	<form id="form-modal-3" method="post">
                            		<input type="hidden" name="id" value="<?= $ticket_detail->ticket_id ?>">
                                	<div class="error-msg-3"></div>
                                	<h4 class="pb-1">Reply To Ticket</h4>
				                    <div class="form-row">
				                    	<div class="form-group col-md-12">
					                        <textarea class="form-control" id="ticket_message" name="ticket_message" required="" rows="4"></textarea>
					                    </div>

				                    	<div class="form-group col-md-12">
						                    <button type="submit" class="btn btn-dark form-btn-3 wd-100" style="width:100px;">Reply</button>
				                    	</div>
				                    </div>
				                </form>
                            </div>
                        </div>
                    </div>
                	<?php } else if($ticket_detail->ticket_status==2) { ?>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body pt-4 pb-3 text-center text-danger">
                            	Ticket closed
                            </div>
                        </div>
                    </div>
                	<?php } ?>


                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
 <?php include('include/footer.php');?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
 <script>
 function editStatus() {
 	$("#ticket-status").show();
 }
 function editStatusHide() {
 	$("#ticket-status").hide();
 }

 function alertMessage(type,message) {
  if (type=='error') {
    type = 'danger';
  }

  return "<div class='alert alert-"+type+" alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "+message+" </div>";
}

 $("#form-modal").validate({
    rules: {
    },
    messages: {
    },
    submitHandler: function(form) {
      var myform = document.getElementById("form-modal");
      var fd = new FormData(myform );

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'api/update_ticket_status') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".error-msg").html('');
          $(".error-msg-2").html('');
          $(".form-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
        },
        success: function (response) {
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".form-btn").html("Update");

                if (obj.status=='success') {
                  //$(".error-msg-2").html(alertMessage('success',obj.message));
                  editStatusHide();
                  window.location.href='';
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

 $("#form-modal-3").validate({
    rules: {
    },
    messages: {
    },
    submitHandler: function(form) {
      var myform = document.getElementById("form-modal-3");
      var fd = new FormData(myform );

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'api/ticket_reply') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".error-msg-3").html('');
          $(".form-btn-3").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
        },
        success: function (response) {
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".form-btn-3").html("Reply");

                if (obj.status=='success') {
                  $(".error-msg-3").html(alertMessage('success',obj.message));
                 $("#ticket_message").val('');

                 var msg=obj.ticket_messages;
                 var ht = "<div class='row'> <div class='col-lg-12'> <div class='card'> <div class='card-body pt-4 pb-3'> <div class='bootstrap-media'> <div class='media'> <div class='media-body'> <h5 class='mt-0 mb-1'>"+msg.name+"</h5>"+msg.ticket_message+"<p class='f-s-13 text-muted pt-1'><i class='fa fa-clock-o'></i> "+msg.created_at+"</p> </div> <img class='ml-3' src='"+msg.user_image+"' alt='User Image' style='width: 50px;height: 50px;border-radius: 50%;'> </div> </div> </div> </div> </div> </div>";
                 $(".reply-list").append(ht);
                }
                else {
                  $(".error-msg-3").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".form-btn-3").html("Reply");
                $(".error-msg-3").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
            $(".form-btn-3").html("Reply");
          $(".error-msg-3").html(alertMessage('error','Some error occurred, please try again.'));
           
        }

    });

    }
});
 </script>