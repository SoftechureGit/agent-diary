<?php include('include/header.php');?>
<style>
@media only screen and (max-width : 576px) {
.mg-10 {
	margin-top: 10px;
}
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
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h4 class="card-title">Add New Builder</h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                                        <a href="<?= base_url(ADMIN_URL.'builders') ?>"><button type="button" class="btn btn-dark btn-sm" ><i class="fa fa-arrow-left"></i> Back</button></a><?php //  } ?>
                                    </div>
                                </div>
                                <div class="basic-form">

                                    <div class="error-msg" style="margin-top: 10px;">
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
                                    <form method="post" id="main-form" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php if($id) { echo $id; }  ?>">
                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <label>Group:</label>
                                                <select class="form-control" name="builder_group_id" required="">
                                                  <option value="">Select Group</option>
                                                  <?php foreach ($builder_group_list as $builder_group) { ?>
                                                    <option value="<?= $builder_group->builder_group_id ?>" <?php if($id && $builder_detail->builder_group_id==$builder_group->builder_group_id) { echo 'selected'; } ?>><?= $builder_group->builder_group_name ?></option>
                                                     <?php } ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Company Name:</label>
                                                <input type="text" class="form-control" placeholder="" name="firm_name" value="<?php if($id) { echo $builder_detail->firm_name; }  ?>" required="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Email Id:</label>
                                                <input type="text" class="form-control" placeholder="" name="builder_email" value="<?php if($id) { echo $builder_detail->builder_email; }  ?>" required="">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Contact No:</label>
                                                <input type="text" class="form-control" placeholder="" name="builder_mobile" value="<?php if($id) { echo $builder_detail->builder_mobile; }  ?>" required="" maxlenth="10">
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Type of Firm:</label>

                                                <select class="form-control" name="firm_type_id" required="">
                                                  <option value="">Select Type of Firm</option>
                                                  <?php foreach ($firm_type_list as $firm_type) { ?>
                                                    <option value="<?= $firm_type->firm_type_id ?>" <?php if($id && $builder_detail->firm_type_id==$firm_type->firm_type_id) { echo 'selected'; } ?>><?= $firm_type->firm_type_name ?></option>
                                                     <?php } ?>
                                                 </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>Address-1:</label>
                                                <input type="text" class="form-control" placeholder="" name="address_1" value="<?php if($id) { echo $builder_detail->address_1; }  ?>">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>Address-2:</label>
                                                <input type="text" class="form-control" placeholder="" name="address_2" value="<?php if($id) { echo $builder_detail->address_2; }  ?>">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>Address-3:</label>
                                                <input type="text" class="form-control" placeholder="" name="address_3" value="<?php if($id) { echo $builder_detail->address_3; }  ?>">
                                            </div>

                                            <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Country</label>
                                                  <select id="inputState" class="form-control" id="country_id" name="country_id">
                                                      <?php foreach ($country_list as $country) { ?>
                                                    <option value="<?= $country->country_id ?>" <?php if($id && $builder_detail->builder_country_id==$country->country_id) { echo 'selected'; } ?>><?= $country->country_name ?></option>
                                                      <?php } ?>
                                                 </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>State</label>
                                                <select id="inputState" class="form-control" id="state_id" name="state_id" onchange="getCity(this.value)">
                                                     <option value="">Select State</option>
                                                      <?php foreach ($state_list as $state) { ?>
                                                    <option value="<?= $state->state_id ?>" <?php if($id && $builder_detail->builder_state_id==$state->state_id) { echo 'selected'; } ?>><?= $state->state_name ?></option>
                                                      <?php } ?>
                                                 </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>City</label>
                                                <select class="form-control" id="city_id" name="city_id">
                                                     <option value="">Select City</option>
                                                      <?php foreach ($city_list as $city) { ?>
                                                    <option value="<?= $city->city_id ?>" <?php if($id && $builder_detail->builder_city_id==$city->city_id) { echo 'selected'; } ?>><?= $city->city_name ?></option>
                                                      <?php } ?>
                                                 </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label>Title:</label>
                                                <select id="inputState" class="form-control" name="director_title">
                                                    <option selected="selected" value="">Select Title</option>
                                                    <option value="Mr." <?php if($id && $builder_detail->director_title=='Mr.') { echo 'selected'; } ?>>Mr.</option>
                                                    <option value="Ms." <?php if($id && $builder_detail->director_title=='Ms.') { echo 'selected'; } ?>>Ms.</option>
                                                    <option value="Mrs." <?php if($id && $builder_detail->director_title=='Mrs.') { echo 'selected'; } ?>>Mrs.</option>
                                                    <option value="Dr." <?php if($id && $builder_detail->director_title=='Dr.') { echo 'selected'; } ?>>Dr.</option>
                                                    <option value="Prof." <?php if($id && $builder_detail->director_title=='Prof.') { echo 'selected'; } ?>>Prof.</option>
                                                   
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Name of Director:</label>
                                                <input type="text" class="form-control" placeholder="" name="director_name" value="<?php if($id) { echo $builder_detail->director_name; }  ?>">
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label>Director Contact No:</label>
                                                <input type="text" class="form-control" placeholder="" name="director_contact_no" value="<?php if($id) { echo $builder_detail->director_contact_no; }  ?>" maxlenth="10">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>Director Email Id:</label>
                                                <input type="text" class="form-control" placeholder="" name="director_email" value="<?php if($id) { echo $builder_detail->director_email; }  ?>">
                                            </div>

                                            <div class="col-md-4">
                                                <label>Title:</label>
                                                <select id="inputState" class="form-control" name="representative_title">
                                                    <option selected="selected" value="">Select Title</option>

                                                    <option value="Mr." <?php if($id && $builder_detail->representative_title=='Mr.') { echo 'selected'; } ?>>Mr.</option>
                                                    <option value="Ms." <?php if($id && $builder_detail->representative_title=='Ms.') { echo 'selected'; } ?>>Ms.</option>
                                                    <option value="Mrs." <?php if($id && $builder_detail->representative_title=='Mrs.') { echo 'selected'; } ?>>Mrs.</option>
                                                    <option value="Dr." <?php if($id && $builder_detail->representative_title=='Dr.') { echo 'selected'; } ?>>Dr.</option>
                                                    <option value="Prof." <?php if($id && $builder_detail->representative_title=='Prof.') { echo 'selected'; } ?>>Prof.</option>
                                                   
                                                </select>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label>Name of Representative:</label>
                                                <input type="text" class="form-control" placeholder="" name="representative_name" value="<?php if($id) { echo $builder_detail->representative_name; }  ?>">
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label>Representative Contact No:</label>
                                                <input type="text" class="form-control" placeholder="" name="representative_contact_no" value="<?php if($id) { echo $builder_detail->representative_contact_no; }  ?>" maxlenth="10">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>Representative Email Id:</label>
                                                <input type="text" class="form-control" placeholder="" name="representative_email" value="<?php if($id) { echo $builder_detail->representative_email; }  ?>">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>About Builder:</label>
                                                <textarea class="form-control" placeholder="" rows="2" name="about_builder"><?php if($id) { echo $builder_detail->about_builder; }  ?></textarea>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Upload Logo:</label>
                                                <input type="file" class="form-control" name="builder_logo" accept="image/*">
                                                <?php if($id && $builder_detail->builder_logo) { ?>
                                                    <a href="<?= base_url('uploads/images/builder/logo/'.$builder_detail->builder_logo) ?>" target="_blank">
                                                    <img src="<?= base_url('uploads/images/builder/logo/'.$builder_detail->builder_logo) ?>" style="height: 50px;width: 50px;margin-top: 8px;"></a>
                                                <?php } ?>
                                            </div>

                                            <div class="col-md-12">
                                            	<h5>KYC:</h5>
                                            </div>

                                            
                                            <div class="form-group col-md-3 ">
                                                <label>CIN NO.</label>
                                                <input type="text" class="form-control" name="cin_no" value="<?php if($id) { echo $builder_detail->cin_no; }  ?>">
                                            </div>
                                            <div class="form-group col-md-3 ">
                                                <label>Upload CIN Copy</label>
                                                <input type="file" class="form-control" name="cin_image" accept="image/*">
                                                <?php if($id && $builder_detail->cin_image) { ?>
                                                    <a href="<?= base_url('uploads/images/builder/document/'.$builder_detail->cin_image) ?>" target="_blank">
                                                    <img src="<?= base_url('uploads/images/builder/document/'.$builder_detail->cin_image) ?>" style="height: 50px;width: 50px;margin-top: 8px;"></a>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group col-md-3 ">
                                                <label>TAN NO.</label>
                                                <input type="text" class="form-control" name="tan_no" value="<?php if($id) { echo $builder_detail->tan_no; }  ?>">
                                            </div>
                                            <div class="form-group col-md-3 ">
                                                <label>Upload TAN Copy</label>
                                                <input type="file" class="form-control" name="tan_image" accept="image/*">
                                                <?php if($id && $builder_detail->tan_image) { ?>
                                                    <a href="<?= base_url('uploads/images/builder/document/'.$builder_detail->tan_image) ?>" target="_blank">
                                                    <img src="<?= base_url('uploads/images/builder/document/'.$builder_detail->tan_image) ?>" style="height: 50px;width: 50px;margin-top: 8px;"></a>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group col-md-3 ">
                                                <label>PAN NO.</label>
                                                <input type="text" class="form-control" name="pan_no" value="<?php if($id) { echo $builder_detail->pan_no; }  ?>">
                                            </div>
                                            <div class="form-group col-md-3 ">
                                                <label>Upload Pan Copy</label>
                                                <input type="file" class="form-control" name="pan_image" accept="image/*">
                                                <?php if($id && $builder_detail->pan_image) { ?>
                                                    <a href="<?= base_url('uploads/images/builder/document/'.$builder_detail->pan_image) ?>" target="_blank">
                                                    <img src="<?= base_url('uploads/images/builder/document/'.$builder_detail->pan_image) ?>" style="height: 50px;width: 50px;margin-top: 8px;"></a>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group col-md-3 ">
                                                <label>GST No</label>
                                                <input type="numeber" class="form-control" name="gst_no" value="<?php if($id) { echo $builder_detail->gst_no; }  ?>">
                                            </div>
                                             <div class="form-group col-md-3 ">
                                                <label>Upload GST Copy</label>
                                                <input type="file" class="form-control" name="gst_image" accept="image/*">
                                                <?php if($id && $builder_detail->gst_image) { ?>
                                                    <a href="<?= base_url('uploads/images/builder/document/'.$builder_detail->gst_image) ?>" target="_blank">
                                                    <img src="<?= base_url('uploads/images/builder/document/'.$builder_detail->gst_image) ?>" style="height: 50px;width: 50px;margin-top: 8px;"></a>
                                                <?php } ?>
                                            </div>

                                        </div>

                                    	<button type="submit" class="btn btn-dark btn-lg form-btn" style="width: 100px;"><?php if($id) { echo 'Update'; } else { echo 'Add New'; } ?></button>
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
 <?php include('include/footer.php');?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script>

function alertMessage(type,message) {
  if (type=='error') {
    type = 'danger';
  }

  return "<div class='alert alert-"+type+" alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "+message+" </div>";
}

 $("#main-form").validate({
    rules: {
        builder_email: {
            required: true,
            email:true
        }
    },
    messages: {
    },
    submitHandler: function(form) {
      var myform = document.getElementById("main-form");
      var fd = new FormData(myform );

      $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'/api/builder_process') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".error-msg").html('');
          $(".form-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>").prop('disabled',true);
        },
        success: function (response) {
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".form-btn").html("<?php if($id) { echo 'Update'; } else { echo 'Add New'; } ?>").prop('disabled',false);

                if (obj.status=='success') {
                  window.location.href='';
                }
                else {
                  $(".error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".form-btn").html("<?php if($id) { echo 'Update'; } else { echo 'Add New'; } ?>").prop('disabled',false);
                $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
            $(".form-btn").html("Save").prop('disabled',false);
          $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
           
        }

    });

    }
});

 function getCity(state_id) {
  $.ajax({
        type: "POST",
        url: "<?= base_url('get_city') ?>",
        data: {state_id:state_id},
        beforeSend: function (data) {
        },
        success: function (response) {
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status=='success') {
              var city_list = obj.city_list;
              var row = "<option value=''>Select City</option>";
              for (var i = 0; i<city_list.length; i++) {
                row += "<option value='"+city_list[i].city_id+"'>"+city_list[i].city_name+"</option>";
              }
              $("#city_id").html(row);
            }
            else {
              $("#city_id").html("<option value=''>Select City</option>");
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
</script>