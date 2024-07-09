<?php include('include/header.php'); ?>
<style>
  @media only screen and (max-width : 576px) {
    .mg-10 {
      margin-top: 10px;
    }
  }
</style>
<link href="<?php echo base_url('public/admin/') ?>plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">

<?php include('include/sidebar.php'); ?>

<div class="content-body">

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-6">
                <h4 class="card-title"><?php if ($id) {
                                          echo 'Update Lead';
                                        } else {
                                          echo 'Add New Lead';
                                        } ?></h4>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-6" align="right">
                <a href="<?= base_url(AGENT_URL . 'leads') ?>"><button type="button" class="btn btn-dark btn-sm">Back</button></a>
              </div>
            </div>
            <div class="basic-form">

              <div class="error-msg pt-1">

                <?php if ($this->session->flashdata('error_msg')) { ?>
                  <div class="alert alert-danger pd8">
                    <?php echo $this->session->flashdata('error_msg'); ?>
                  </div>
                <?php } ?>
                <?php if ($this->session->flashdata('success_msg')) { ?>
                  <div class="alert alert-success pd8">
                    <?php echo $this->session->flashdata('success_msg'); ?>
                  </div>
                <?php } ?>

              </div>
              <form method="post" id="form-modal" autocomplete="off">
                <input type="hidden" class="form-control" id="fid" name="id" value="<?php if ($id) {
                                                                                      echo $id;
                                                                                    } ?>">
                <div class="form-row">

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Date:</label>
                      <input type="text" class="form-control" placeholder="" id="lead_date" name="lead_date" value="<?php if ($id) {
                                                                                                                      echo $lead_detail->lead_date;
                                                                                                                    } else {
                                                                                                                      echo date("d-m-Y");
                                                                                                                    } ?>" readonly="">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Time:</label>
                      <input type="text" class="form-control" placeholder="" id="lead_time" name="lead_time" value="<?php if ($id) {
                                                                                                                      echo $lead_detail->lead_time;
                                                                                                                    } else {
                                                                                                                      echo date("h:i:s a");
                                                                                                                    } ?>" readonly="">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Source <span class="text-danger">*</span></label>

                      <select class="form-control" id="lead_source_id" name="lead_source_id" required>
                        <option value="">Select Lead Source</option>
                        <?php foreach ($lead_source_list as $lead_source) { ?>
                          <option value="<?= $lead_source->lead_source_id ?>" <?php if ($id && $lead_detail->lead_source_id == $lead_source->lead_source_id) {
                                                                                echo 'selected';
                                                                              } ?>><?= $lead_source->lead_source_name ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Stage <span class="text-danger">*</span></label>

                      <select class="form-control" id="lead_stage_id" name="lead_stage_id" required>
                        <option value="" disabled selected>Select Lead Stage</option>
                        <?php foreach ($lead_stage_list as $lead_stage) { ?>
                          <option value="<?= $lead_stage->lead_stage_id ?>" <?php if ($id && $lead_detail->lead_stage_id == $lead_stage->lead_stage_id) {
                                                                              echo 'selected';
                                                                            } ?>><?= $lead_stage->lead_stage_name ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Department</label>
                      <select class="form-control" id="department_id" name="lead_department_id">
                        <option value="">Select Department</option>
                        <?php foreach ($department_list as $department) { ?>
                          <option value="<?= $department->department_id ?>" <?php if ($id && $lead_detail->lead_department_id == $department->department_id) {
                                                                              echo 'selected';
                                                                            } ?>><?= $department->department_name ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Title <span class="text-danger">*</span></label>

                      <select id="inputState" class="form-control" name="lead_title" required>
                        <option selected="selected" value="">Select Title</option>
                        <option value="Mr." <?php if ($id && $lead_detail->lead_title == 'Mr.') {
                                              echo 'selected';
                                            } ?>>Mr.</option>
                        <option value="Ms." <?php if ($id && $lead_detail->lead_title == 'Ms.') {
                                              echo 'selected';
                                            } ?>>Ms.</option>
                        <option value="Mrs." <?php if ($id && $lead_detail->lead_title == 'Mrs.') {
                                                echo 'selected';
                                              } ?>>Mrs.</option>
                        <option value="Dr." <?php if ($id && $lead_detail->lead_title == 'Dr.') {
                                              echo 'selected';
                                            } ?>>Dr.</option>
                        <option value="Prof." <?php if ($id && $lead_detail->lead_title == 'Prof.') {
                                                echo 'selected';
                                              } ?>>Prof.</option>

                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>First Name <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" placeholder="Enter first name" id="lead_first_name" name="lead_first_name" value="<?php if ($id) {
                                                                                                                                                  echo $lead_detail->lead_first_name;
                                                                                                                                                } ?>" required="">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Last Name</label>
                      <input type="text" class="form-control" placeholder="Enter last name" id="lead_last_name" name="lead_last_name" value="<?php if ($id) {
                                                                                                                                                echo $lead_detail->lead_last_name;
                                                                                                                                              } ?>">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Mobile <span class="text-danger">*</span></label>
                      <br>
                      <input type="text" class="form-control w-100 primary_mobile_number" placeholder="Enter mobile" id="primary_mobile_number" name="lead_mobile_no" value="<?php if ($id) {
                                                                                                                                                                                echo $lead_detail->lead_mobile_no;
                                                                                                                                                                              } ?>" required="" <?php if ($id) {
                                                                                                                                                                            echo 'disabled';
                                                                                                                                                                          } ?>>
                      <!-- Primary Mobile Number Country Code -->
                      <input type="hidden" value='{ "name" : "India", "iso2" : "in", "dialCode" : "91" }' name="primary_mobile_number_country_data" data-iso2="in">
                      <!-- End Primary Mobile Number Country Code -->
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                    <label>Other Mobile Number</label>
                    <input type="text" class="form-control secondary_mobile_number" placeholder="Enter other mobile number" id="secondary_mobile_number" name="lead_mobile_no_2" value="<?php if ($id) {
                                                                                                                                                                                          echo $lead_detail->lead_mobile_no_2;
                                                                                                                                                                                        } ?>">
                    <!-- Secondary Mobile Number Country Code -->
                    <input type="hidden" value='{ "name" : "India", "iso2" : "in", "dialCode" : "91" }' name="secondary_mobile_number_country_data" data-iso2="in">
                    <!-- End Secondary Mobile Number Country Code -->
                  </div>

                  <div class="form-group col-md-4">
                    <label>Email</label>
                    <input type="text" class="form-control" placeholder="Enter email" id="lead_email" name="lead_email" value="<?= $lead_detail->lead_email ?? '' ?>">
                  </div>

                  <div class="form-group col-md-4">
                    <label>Address </label>
                    <input type="text" class="form-control" placeholder="Enter address" id="lead_address" name="lead_address" value="<?php if ($id) {
                                                                                                                                        echo $lead_detail->lead_address;
                                                                                                                                      } ?>">
                  </div>

                  <div class="form-group col-md-4">
                    <label>State</label>
                    <select class="form-control select2" id="state_id" name="lead_state_id" onchange="getCity(this.value)">
                      <option value="">Select State</option>
                      <?php foreach ($state_list as $state) { ?>
                        <option value="<?= $state->state_id ?>" <?php if ($id && $lead_detail->lead_state_id == $state->state_id) {
                                                                  echo 'selected';
                                                                } ?>><?= $state->state_name ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-md-4">
                    <label>City</label>
                    <select class="form-control get_locations select2" id="city_id" name="lead_city_id">
                      <option value="">Select City</option>
                      <?php foreach ($city_list as $city) { ?>
                        <option value="<?= $city->city_id ?>" <?php if ($id && $lead_detail->lead_city_id == $city->city_id) {
                                                                echo 'selected';
                                                              } ?>><?= $city->city_name ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <!-- Location -->
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="">Location</label>
                      <select name="location_id" id="" class="form-control set_locations select2" data-selected_id="<?= $record->location_id ?? 0 ?>">
                        <option value="" selected disabled>Choose..</option>
                      </select>
                    </div>
                  </div>
                  <!-- End Location -->

                  <div class="form-group col-md-4">
                    <label>Occupation</label>
                    <select class="form-control" id="occupation_id" name="lead_occupation_id">
                      <option value="">Select Occupation</option>
                      <?php foreach ($occupation_list as $occupation) { ?>
                        <option value="<?= $occupation->occupation_id ?>" <?php if ($id && $lead_detail->lead_occupation_id == $occupation->occupation_id) {
                                                                            echo 'selected';
                                                                          } ?>><?= $occupation->occupation_name ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group col-md-4">
                    <label>Date of Birth</label>
                    <input type="text" class="form-control mydatepicker" data-date-format='dd-mm-yyyy' placeholder="Select..." id="lead_dob" name="lead_dob" value="<?php if ($id) {
                                                                                                                                                                      echo $lead_detail->lead_dob;
                                                                                                                                                                    } ?>">
                  </div>

                  <div class="form-group col-md-4">
                    <label>DOA</label>
                    <input type="text" class="form-control mydatepicker" data-date-format='dd-mm-yyyy' placeholder="" id="lead_doa" name="lead_doa" value="<?php if ($id) {
                                                                                                                                                              echo $lead_detail->lead_doa;
                                                                                                                                                            } ?>">
                  </div>

                  <div class="form-group col-md-4">
                    <label>Status:</label>
                    <select class="form-control" id="lead_status" name="lead_status" required="">
                      <option value="" disabled="">Select Status</option>
                      <?php foreach ($lead_type_list as $item) { ?>
                        <option value="<?= $item->lead_type_id ?>" <?php if ($id && $lead_detail->lead_status == $item->lead_type_id) {
                                                                      echo 'selected';
                                                                    } ?>><?= $item->lead_type_name ?></option>
                      <?php } ?>
                    </select>
                  </div>

                </div>

                <button type="submit" class="btn btn-dark btn-lg form-btn" style="width: 120px;"><?php if ($id) {
                                                                                                    echo 'Update';
                                                                                                  } else {
                                                                                                    echo 'Add New';
                                                                                                  } ?></button>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include('include/footer.php'); ?>
<script src="<?php echo base_url('public/admin/') ?>plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script>
  $('.mydatepicker').datepicker();

  function alertMessage(type, message) {
    if (type == 'error') {
      type = 'danger';
    }

    return "<div class='alert alert-" + type + " alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> " + message + " </div>";
  }

  $("#form-modal").validate({
    rules: {

      // lead_email: {
      //     required: true,
      //     email:true
      // },
      lead_mobile_no: {
        // number: true,
        // minlength: 11,
        // maxlength: 11
      },
      lead_mobile_no_2: {
        // number: true
        // minlength: 11,
        // maxlength: 11
      }

    },
    messages: {
      lead_mobile_no: {
        minlength: "Enter Valid 10 Digit No",
        maxlength: "Enter Valid 10 Digit No"
      },
      lead_mobile_no_2: {
        minlength: "Enter Valid 10 Digit No",
        maxlength: "Enter Valid 10 Digit No"
      },
    },
    submitHandler: function(form) {
      var myform = document.getElementById("form-modal");
      var fd = new FormData(myform);
      var fid = "<?php if ($id) {
                    echo $id;
                  } ?>";
      var btn_label = "Add New";
      if (fid != "") {
        btn_label = "Update";
      }

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL . 'api/lead_process') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function(data) {
          $(".error-msg").html('');
          $(".form-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
        },
        success: function(response) {
          setTimeout(function() {
            var obj;
            try {
              obj = JSON.parse(response);
              $(".form-btn").html(btn_label);

              if (obj.status == 'added') {
                window.location.href = '';
                //$(".error-msg").html(alertMessage('success',obj.message));
              } else if (obj.status == 'updated') {
                window.location.href = '';
                //$(".error-msg").html(alertMessage('success',obj.message));
              } else {
                $('html, body').animate({
                  scrollTop: $(".header-content").offset().top
                }, 500);
                $(".error-msg").html(alertMessage('error', obj.message));
              }
            } catch (err) {
              $('html, body').animate({
                scrollTop: $(".header-content").offset().top
              }, 500);
              $(".form-btn").html(btn_label);
              $(".error-msg").html(alertMessage('error', 'Some error occurred, please try again.'));
            }
          }, 500);
        },
        error: function() {
          $(".form-btn").html(btn_label);
          $(".error-msg").html(alertMessage('error', 'Some error occurred, please try again.'));

        }

      });

    }
  });

  function getCity(state_id) {
    $.ajax({
      type: "POST",
      url: "<?= base_url('get_city') ?>",
      data: {
        state_id: state_id
      },
      beforeSend: function(data) {},
      success: function(response) {
        var obj;
        try {
          obj = JSON.parse(response);
          if (obj.status == 'success') {
            var city_list = obj.city_list;
            var row = "<option value=''>Select City</option>";
            for (var i = 0; i < city_list.length; i++) {
              row += "<option value='" + city_list[i].city_id + "'>" + city_list[i].city_name + "</option>";
            }
            $("#city_id").html(row);
          } else {
            $("#city_id").html("<option value=''>Select City</option>");
          }
        } catch (err) {
          alert('Some error occurred, please try again.');
        }
      },
      error: function() {
        alert('Some error occurred, please try again.');

      }

    });
  }

  primary_mobile_number_with_dial_code();
  secondary_mobile_number_with_dial_code();
</script>