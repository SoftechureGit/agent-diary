	<div class="error-msg pt-1">
                                    
    <!--<?php if($this->session->flashdata('error_msg')) { ?>
        <div class="alert alert-danger pd8">
          <?php echo $this->session->flashdata('error_msg'); ?>
        </div>
      <?php } ?>
      <?php if($this->session->flashdata('success_msg')) { ?>
        <div class="alert alert-success pd8">
          <?php echo $this->session->flashdata('success_msg'); ?>
        </div>
    <?php } ?>-->

    </div>

    <form method="post" id="form-modal" autocomplete="off">
        <input type="hidden" class="form-control" id="fid" name="id" value="<?php if($id) { echo $id; } ?>">
        <div class="form-row">

            <div class="form-group col-md-6">
                <label>Date:</label>
                <input type="text" class="form-control" placeholder="" id="lead_date" name="lead_date" value="<?php if($id) { echo $lead_detail->lead_date; } else { echo date("d-m-Y"); } ?>" readonly="">
            </div>

            <div class="form-group col-md-6">
                <label>Time:</label>
                <input type="text" class="form-control" placeholder="" id="lead_time" name="lead_time" value="<?php if($id) { echo $lead_detail->lead_time; } else { echo date("h:i:s a"); } ?>" readonly="">
            </div>

            <div class="form-group col-md-4">
                <label>Title:</label>

                <select id="inputState" class="form-control" name="lead_title">
                    <option selected="selected" value="">Select Title</option>
                    <option value="Mr." <?php if($id && $lead_detail->lead_title=='Mr.') { echo 'selected'; } ?>>Mr.</option>
                    <option value="Ms." <?php if($id && $lead_detail->lead_title=='Ms.') { echo 'selected'; } ?>>Ms.</option>
                    <option value="Mrs." <?php if($id && $lead_detail->lead_title=='Mrs.') { echo 'selected'; } ?>>Mrs.</option>
                    <option value="Dr." <?php if($id && $lead_detail->lead_title=='Dr.') { echo 'selected'; } ?>>Dr.</option>
                    <option value="Prof." <?php if($id && $lead_detail->lead_title=='Prof.') { echo 'selected'; } ?>>Prof.</option>
                   
                </select>
            </div>

            <div class="form-group col-md-4">
                <label>First Name:</label>
                <input type="text" class="form-control" placeholder="" id="lead_first_name" name="lead_first_name" value="<?php if($id) { echo $lead_detail->lead_first_name; } ?>" required="">
            </div>

            <div class="form-group col-md-4">
                <label>Last Name:</label>
                <input type="text" class="form-control" placeholder="" id="lead_last_name" name="lead_last_name" value="<?php if($id) { echo $lead_detail->lead_last_name; } ?>">
            </div>

            <div class="form-group col-md-4">
                <label>Mobile:</label>
                <br>
                <input type="text" class="form-control primary_mobile_number" placeholder="" id="lead_mobile_no" name="lead_mobile_no" value="<?php if($id) { echo $lead_detail->lead_mobile_no; } ?>" required="">
                 <!-- Primary Mobile Number Country Code -->
                 <input type="hidden" value='<?= $lead_detail->primary_mobile_number_country_data ?? '{ "name" : "India", "iso2" : "in", "dialCode" : "91" }' ?>' name="primary_mobile_number_country_data" data-iso2="<?= json_decode($lead_detail->primary_mobile_number_country_data)->iso2 ?? 'in' ?>">
                      <!-- End Primary Mobile Number Country Code -->
            </div>

            <div class="form-group col-md-4">
                <label>Other No:</label>
                <br>
                <input type="text" class="form-control secondary_mobile_number" placeholder="" id="lead_mobile_no_2" name="lead_mobile_no_2" value="<?php if($id) { echo $lead_detail->lead_mobile_no_2; } ?>">
                <!-- Secondary Mobile Number Country Code -->

                <input type="hidden" value='<?= $lead_detail->secondary_mobile_number_country_data ?? '{ "name" : "India", "iso2" : "in", "dialCode" : "91" }' ?>' name="secondary_mobile_number_country_data" data-iso2="<?= json_decode($lead_detail->secondary_mobile_number_country_data)->iso2 ?? 'in' ?>">
                      <!-- End Secondary Mobile Number Country Code -->
            </div>

            <div class="form-group col-md-4">
                <label>Email:</label>
                <input type="text" class="form-control" placeholder="Enter email" id="lead_email" name="lead_email" value="<?= $lead_detail->lead_email ?? '' ?>">
            </div>

             <!-- Profile -->
             <div class="col-md-4">
                     <div class="form-group">
                       <label>Profile</label>
                       <input type="file" class="form-control p-1" name="profile" accept="image/*">
                       <input type="hidden" name="old_profile" value="<?= $lead_detail->profile ?? '' ?>">
                       <?php if($lead_detail->profile ?? 0): ?>
                        <a href="<?= $lead_detail->profile_url ?? '' ?>" target="_blank" class="text-primary">View</a>
                        <?php endif; ?>
                      </div>
                    </div>
                  <!-- End Profile -->

            <div class="form-group col-md-4">
                <label>Address:</label>
                <input type="text" class="form-control" placeholder="Enter address" id="lead_address" name="lead_address" value="<?php if($id) { echo $lead_detail->lead_address; } ?>">
            </div>

            <div class="form-group col-md-4">
                <label>State:</label>
                <select class="form-control" id="state_id" name="lead_state_id" onchange="getCityLead(this.value)">
                     <option value="">Select State</option>
                      <?php foreach ($state_list as $state) { ?>
                    <option value="<?= $state->state_id ?>" <?php if($id && $lead_detail->lead_state_id==$state->state_id) { echo 'selected'; } ?>><?= $state->state_name ?></option>
                      <?php } ?>
                 </select>
            </div>

            <div class="form-group col-md-4">
                <label>City:</label>
                <select class="form-control get_locations" id="new_city_id" name="lead_city_id">
                     <option value="">Select City</option>
                      <?php foreach ($city_list as $city) { ?>
                    <option value="<?= $city->city_id ?>" <?php if($id && $lead_detail->lead_city_id==$city->city_id) { echo 'selected'; } ?>><?= $city->city_name ?></option>
                      <?php } ?>
                 </select>
            </div>

            <!-- Location -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="">Location</label>
        <select name="location_id" id="" class="form-control set_locations" data-selected_id="<?= $lead_detail->location_id ?? 0 ?>">
          <option value="" selected disabled>Choose..</option>
        </select>
      </div>
    </div>
    <!-- End Location -->

            <div class="form-group col-md-4">
                <label>Occupation:</label>
                <select class="form-control" id="occupation_id" name="lead_occupation_id">
                     <option value="">Select Occupation</option>
                      <?php foreach ($occupation_list as $occupation) { ?>
                    <option value="<?= $occupation->occupation_id ?>" <?php if($id && $lead_detail->lead_occupation_id==$occupation->occupation_id) { echo 'selected'; } ?>><?= $occupation->occupation_name ?></option>
                      <?php } ?>
                 </select>
            </div>

            <div class="form-group col-md-4">
                <label>Department:</label>
                <select class="form-control" id="department_id" name="lead_department_id">
                     <option value="">Select Department</option>
                      <?php foreach ($department_list as $department) { ?>
                    <option value="<?= $department->department_id ?>" <?php if($id && $lead_detail->lead_department_id==$department->department_id) { echo 'selected'; } ?>><?= $department->department_name ?></option>
                      <?php } ?>
                 </select>
            </div>

            <div class="form-group col-md-4">
                <label>DOB:</label>
                <input type="text" class="form-control mydatepicker" data-date-format='dd-mm-yyyy' placeholder="Enter date of birth" id="lead_dob" name="lead_dob" value="<?php if($id) { echo $lead_detail->lead_dob; } ?>">
            </div>

            <div class="form-group col-md-4">
                <label>DOA:</label>
                <input type="text" class="form-control mydatepicker" data-date-format='dd-mm-yyyy' placeholder="Enter DOA" id="lead_doa" name="lead_doa" value="<?php if($id) { echo $lead_detail->lead_doa; } ?>">
            </div>

            <div class="form-group col-md-4">
                <label>Source:</label>
                
                <select class="form-control" id="lead_source_id" name="lead_source_id">
                     <option value="">Select Lead Source</option>
                      <?php foreach ($lead_source_list as $lead_source) { ?>
                    <option value="<?= $lead_source->lead_source_id ?>" <?php if($id && $lead_detail->lead_source_id==$lead_source->lead_source_id) { echo 'selected'; } ?>><?= $lead_source->lead_source_name ?></option>
                      <?php } ?>
                 </select>
            </div>

            <div class="form-group col-md-4">
                <label>Stage:</label>

                <select class="form-control" name="lead_stage_id">
                     <option value="" disabled="">Select Lead Stage</option>
                      <?php foreach ($lead_stage_list as $lead_stage) { ?>
                    <option value="<?= $lead_stage->lead_stage_id ?>" <?php if($id && $lead_detail->lead_stage_id==$lead_stage->lead_stage_id) { echo 'selected'; } ?>><?= $lead_stage->lead_stage_name ?></option>
                      <?php } ?>
                 </select>
            </div>


            <div class="form-group col-md-4">
                <label>Status:</label>
                <select class="form-control" name="lead_status" required="">
                    <option value="" disabled="">Select Status</option>
                    <?php foreach ($lead_type_list as $item) { ?>
                        <option value="1" <?php if($id && $lead_detail->lead_status==$item->lead_type_id) { echo 'selected'; } ?>><?= $item->lead_type_name ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group col-md-4">
            	<label>Gender:</label>
                <select class="form-control" id="lead_gender" name="lead_gender">
                      <option value="">Select Gender</option>
                      <option value="Male" <?php if($id && $lead_detail->lead_gender=='Male') { echo 'selected'; } ?> >Male</option>
                      <option value="Female" <?php if($id && $lead_detail->lead_gender=='Female') { echo 'selected'; } ?> >Female</option>
                </select>
            </div>
            <div class="form-group col-md-4">
            	<label>Marital Status:</label>
                <select class="form-control" id="lead_marital_status" name="lead_marital_status">
                      <option value="">Select Marital Status</option>
                      <option value="Married" <?php if($id && $lead_detail->lead_marital_status=='Married') { echo 'selected'; } ?> >Married</option>
                      <option value="Unmarried" <?php if($id && $lead_detail->lead_marital_status=='Unmarried') { echo 'selected'; } ?> >Unmarried</option>
                </select>
            </div>

            <div class="form-group col-md-4">
            	<label>Designation:</label>
                <select class="form-control" id="lead_designation" name="lead_designation">
                	<option value="">Select Designation</option>
                	<?php foreach ($designation_list as $designation) { ?>
                    <option value="<?= $designation->designation_id ?>" <?php if($id && $lead_detail->lead_designation==$designation->designation_id) { echo 'selected'; } ?>><?= $designation->designation_name ?></option>
                      <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-4">
              <label>Annual Income:</label>
              <input type="text" class="form-control" id="lead_annual_income" name="lead_annual_income" value="<?php if($id) { echo $lead_detail->lead_annual_income; } ?>" placeholder="Enter annual income">
            </div>
            <div class="form-group col-md-12">
            	<label>Name of Company:</label>
            	<input type="text" class="form-control" id="lead_company" name="lead_company" value="<?php if($id) { echo $lead_detail->lead_company; } ?>" placeholder="Enter company name">
            </div>

            <div class="form-group col-md-12">
            	<h4>KYC</h4>
            </div>
            <div class="form-group col-md-6">
            	<label>PAN No:</label>
            	<input type="text" class="form-control" id="lead_pan_no" name="lead_pan_no" value="<?php if($id) { echo $lead_detail->lead_pan_no; } ?>" placeholder="Enter Pancard Number">
            </div>
            <div class="form-group col-md-6">
            	<label>Aadhar No:</label>
            	<input type="text" class="form-control" id="lead_adhar_no" name="lead_adhar_no" value="<?php if($id) { echo $lead_detail->lead_adhar_no; } ?>"  placeholder="Enter Aadhar Number">
            </div>
            <div class="form-group col-md-6">
            	<label>Voter Id:</label>
            	<input type="text" class="form-control" id="lead_voter_id" name="lead_voter_id" value="<?php if($id) { echo $lead_detail->lead_voter_id; } ?>"  placeholder="Enter Voter Number">
            </div>
            <div class="form-group col-md-6">
            	<label>Passport No:</label>
            	<input type="text" class="form-control" id="lead_passport_no" name="lead_passport_no" value="<?php if($id) { echo $lead_detail->lead_passport_no; } ?>"  placeholder="Enter Passport Number">
            </div>

        </div>

        <div align="center" class="pt-2 pb-2">

            <button type="button" class="btn btn-danger btn-lg mr-3" data-dismiss="modal">Close</button>
        	<button type="submit" class="btn btn-dark btn-lg form-btn" style="width: 120px;"><?php if($id) { echo 'Update'; } else {  echo 'Add New'; } ?></button>
        </div>
    </form>

<script>
$('.mydatepicker').bootstrapMaterialDatePicker({
    weekStart: 0,
    time: false,
    format: 'DD-MM-YYYY', 
    minDate : new Date()
});

$("#form-modal").validate({
    rules: {

        // lead_email: {
        //     required: true,
        //     email:true
        // },
        // lead_mobile_no: {
        //     minlength:11,
        //     maxlength:11
        // },
        // lead_mobile_no_2: {
        //     minlength:11,
        //     maxlength:11
        // }
          
    },
    messages: {
        lead_mobile_no: {
            minlength:"Enter Valid 10 Digit No",
            maxlength:"Enter Valid 10 Digit No"
        },
        lead_mobile_no_2: {
            minlength:"Enter Valid 10 Digit No",
            maxlength:"Enter Valid 10 Digit No"
        },
    },
    submitHandler: function(form) {
      var myform = document.getElementById("form-modal");
      var fd = new FormData(myform );
      var fid = "<?php if($id) { echo $id; } ?>";
      var btn_label = "Add New";
      if (fid!="") {
        btn_label = "Update";
      }

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'api/lead_process') ?>",
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
                $(".form-btn").html(btn_label);

                if (obj.status=='added') {
                    //window.location.href='';
                  //$(".error-msg").html(alertMessage('success',obj.message));
                }
                else if (obj.status=='updated') {
                    // window.location.href=''; 
                    
                    get_followup_list();

                    var record = obj.data;

                $('.data-add-'+fid).html(`  <div class='col-md-2' style='' align='center'>
                      <img class='mr-3' src='${record.full_profile_url}' style='border-radius:50%;' width='45' height='45' alt=''>
                    </div>
                    
                    <div class='col-md-10'>
                      <div class='row'>
                        <div class='col-md-6'>
                          <div class='card-text ${is_followup}'>
                          <i class='fa fa-user pr-2 d-none'></i> 
                          ${record.lead_title} ${record.lead_first_name} ${record.lead_last_name} </div>
                        </div>

                          <div class='col-md-6'>
                          <div class='card-text text-right text-muted'>
                              ${record.lead_stage_name ?? 'N/A'}
                            </div>
                          </div>

                          <div class='col-md-7'>
                            <div class='card-text text-muted'>
                              ${record.lead_date}
                              ${lead_time} 
                            </div>
                          </div>

                          <div class='col-md-5'>
                          <div class='card-text text-right text-muted'>
                              ${record.lead_source_name ?? 'N/A'}
                          </div>
                        </div>
                      </div>
                    </div>`)



                    showToast('success', obj.message)
                  $(".error-msg").html(alertMessage('success',obj.message));
                  hideLeadEditModal(<?= $id ?>);

                  
                }
                else {
                  showToast('success', obj.message)
                  $(".error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".form-btn").html(btn_label);
                $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
            $(".form-btn").html(btn_label);
            $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));  
        }

    });

    }
});

function getCityLead(state_id) {
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
              $("#new_city_id").html(row);
            }
            else {
              $("#new_city_id").html("<option value=''>Select City</option>");
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