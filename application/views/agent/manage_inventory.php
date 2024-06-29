<?php include('include/header.php');?>
<style>
@media only screen and (max-width : 576px) {
.mg-10 {
	margin-top: 10px;
}
}
.loader_progress{
    display: none;
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url("<?= base_url('public/front/ajax-loader.gif') ?>") 
              50% 50% no-repeat #fff3f38f;
}
.project_inventory {
    width: 100%;
    min-height: 350px;
}
.cp {
    cursor: pointer;
}
</style>
<?php include('include/sidebar.php');?>

        <div class="content-body">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h4 class="card-title">Manage Inventory</h4>
                                    </div>
                                </div>
                                <div class="basic-form">

                                    <div class="inventory-error-msg">
                                      
                                      <div>
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
                                    </div>

                                    <form method="post" id="inventory-form" enctype="multipart/form-data" autocomplete="off">
                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <label>Builder:</label>
                                                <select class="form-control" id="builder_id" name="builder_id" onchange="getProjects()">
                                                  <option value="">Select Builder</option>
                                                  <?php foreach ($builder_list as $builder) { ?>
                                                    <option value="<?= $builder->builder_id ?>" ><?= $builder->firm_name ?></option>
                                                  <?php } ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Select Project:</label>
                                                <select class="form-control" id="product_id" name="product_id" onchange="get_project_inventory()" disabled>
                                                      <option value="">Select Project</option>
                                                </select>
                                            </div>

                                            <div class="project_inventory"></div>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

<div class="loader_progress"></div>

 <?php include('include/footer.php');?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>

<script>
//$(".loader_progress").hide();
function getProjects() {
  var builder_id = $("#builder_id").val();
  $("#product_id").html("<option value=''>Select Project</option>");
  $(".project_inventory").html("");
  $("#product_id").prop("disabled",true);
  $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'api/get_project_by_builder') ?>",
        data: {builder_id:builder_id},
        beforeSend: function (data) {
          $(".loader_progress").show();
        },
        success: function (response) {
          console.log(response);
          $(".loader_progress").hide();
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status=='success') {
              var product_list = obj.product_list;
              var row = "<option value=''>Select Project</option>";
              for (var i = 0; i<product_list.length; i++) {
                row += "<option value='"+product_list[i].product_id+"'>"+product_list[i].project_name+"</option>";
              }
              $("#product_id").html(row);

              $("#product_id").prop("disabled",false);
            }
            else {
              $("#product_id").html("<option value=''>Select Project</option>");
            }
          }
          catch(err) {
            alert('Some error occurred, please try again.');
          }
        },
        error: function () {
            $(".loader_progress").hide();
            alert('Some error occurred, please try again.');
        }

    });
}
function get_project_inventory() {
  var product_id = $("#product_id").val();
  if(product_id=="") {
    $(".project_inventory").html("");
  }
  else {
      $.ajax({
            type: "POST",
            url: "<?= base_url(AGENT_URL.'api/get_project_inventory') ?>",
            data: {product_id:product_id},
            beforeSend: function (data) {
                $(".project_inventory").html("<div style='padding:50px;' align='center'><img src='<?= base_url('public/front/ajax-loader.gif') ?>' style='height:60px;'></div>");
            },
            success: function (response) {
                setTimeout(function(){
                    $(".project_inventory").html(response);
                },100);
            },
            error: function () {
                $(".project_inventory").html("<div class=' alert alert-danger'>Some error occurred, please try again.</div>");
               
            }
        });
  }
}

function alertMessage(type,message) {
  if (type=='error') {
    type = 'danger';
  }

  return "<div class='alert alert-"+type+" alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "+message+" </div>";
}

$("#inventory-form").validate({
    rules: {
        product_id: {
            required:true
        }
    },
    messages: {
        product_id: 'Please select project'
    },
    submitHandler: function(form) {
      var myform = document.getElementById("inventory-form");
      var fd = new FormData(myform );

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'/api/project_inventory_update') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".inventory-error-msg").html('');
          $(".inventory-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>").prop('disabled',true);
          $(".loader_progress").show();
        },
        success: function (response) {

          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".inventory-btn").html("Update").prop('disabled',false);
                $(".loader_progress").hide();

                if (obj.status=='success') {
                    get_project_inventory();
                    $(".inventory-error-msg").html(alertMessage('success',obj.message));
                }
                else {
                  $(".inventory-error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".inventory-btn").html("Update").prop('disabled',false);
                $(".inventory-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
                $(".loader_progress").hide();
              }
          },100);
        },
        error: function () {
            $(".inventory-btn").html("Save & Next").prop('disabled',false);
          $(".inventory-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
            $(".loader_progress").hide();
           
        }

    });

    }
});

 </script>