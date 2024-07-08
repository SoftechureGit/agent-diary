<?php
  $is_followup      = false;
  
  if($record->added_to_followup == '1' ):
    $is_followup      = true;
  endif;
?>
<style>
  .card.unit-card {
    box-shadow: 2px 2px 8px #80808038 !important;
    margin: 0.5rem;
  }

  .card.unit-card .card-body {
    padding: 1rem;
  }

  .card.unit-card label {
    font-family: Roboto;
    font-size: 12px;
    font-weight: 500;
  }

  .card.unit-card .label-value {
    font-family: Roboto;
    font-size: 12px;
    font-weight: 400;
  }

  /* Unit Modal */
  #unitModal form .form-control {
    border-radius: 5px;
  }

  #unitModal .card {
    box-shadow: unset;
  }

  #unitModal .card .card-body {
    padding: 0 !important;
  }

  label.error {
    color: #a94442 !important;
    font-size: 14px !important;
  }

  .modal-xl {
    max-width: 1140px;
  }

  #unitModal .clone-template .form-control {
    border-radius: 5px;
    height: 1.8rem;
  }

  /* Unit Modal */

  .add-edit-new-unit-btn,
  .view-unit-details {
    cursor: pointer;
  }

  .lead-unit-details-container table caption {
    font-family: Roboto;
    caption-side: top;
    font-weight: 600;
    letter-spacing: 1px;
    padding-top: 0;
  }

  #lead-unit-form details {
    background: #b2cbff57;
  }

  #lead-unit-form summary {
    font-size: 15px;
    background: #b2cbff57;
    padding: 1rem;
    color: #000;
  }

  section.photo-gallery .gallery-image {
    object-fit: contain;
    border-radius: 7px;
    border: 1px solid #80808061;
  }

  .lead-unit-details-container table caption {
    color: #000000d6 !important;
  }

  .lead-unit-details-container table tr,
  .lead-unit-details-container table th,
  .lead-unit-details-container table td {
    border: 1px solid #00000038 !important;
    color: #000000d6 !important;
  }

  .add-more-btn:focus,
  .add-more-btn:active {
    outline: none !important;
  }

  .remove-clone-template-row {
    position: absolute;
    top: 12px;
    right: 10px;
    background: red;
    color: #fff;
    padding: 8px;
    border-radius: 50%;
    font-size: 12px;
    cursor: pointer;
    z-index: 9;
  }

  .property-documents.clone-template .form-group {
    margin-bottom: 0;
  }

</style>



<div style="padding: 0px 15px 0px 15px;">
  <div class="row" style="border-bottom: 1px solid #0000000f;padding-bottom: 13px;margin-bottom: 10px;">
    <div class="col-md-2" align="center">
      <img class="mr-3" src="<?= base_url('public/front/user.png') ?>" style="margin-top: 18px;border-radius:50%;" width="50" height="50" alt="">
    </div>
    <div class="col-md-10">

      <div class="row">
        <div class="col-md-6">
          <h6 class="card-text text-muted ft-sm"><i class="fa fa-calendar"></i> <?= $record->lead_date ?></h6>
        </div>
        <div class="col-md-6" align="right">
          <!--<h6 class="card-text text-muted"><?= ucwords($record->user_title . ' ' . $record->first_name . ' ' . $record->last_name) ?></h6>-->
        </div>
      </div>

      <div class="row" style="margin-top: 5px;">
        <div class="col-md-6">
          <h6 class="card-text text-muted ft-14"><i class="fa fa-user"></i> <?= ucwords($record->lead_title . ' ' . $record->lead_first_name . ' ' . $record->lead_last_name) ?></h6>
        </div>

        <div class="col-md-6" align="right">
          <h6 class="card-text text-muted ft-sm">Matching Property</h6>
        </div>
      </div>

      <div class="row" style="margin-top: 2px;">
        <div class="col-md-6">
          <!-- Primary Mobile Number -->
          <?php if($record->lead_mobile_no): ?>
          <h6 class="card-text text-muted  ft-sm" style="margin-top: 4px;margin-bottom: 0px;padding-bottom: 0px;">
            <i class="fa fa-mobile ft-14"></i> <span><?= ( $record->primary_mobile_number_country_data ?? 0 ) ? '+'.json_decode($record->primary_mobile_number_country_data)->dialCode : '+91' ?>  <?= $record->lead_mobile_no ?></span>
          </h6>
          <?php endif; ?>
          <!-- End Primary Mobile Number -->

          <!-- Secondary Mobile Number -->
          <?php if($record->lead_mobile_no_2): ?>
          <h6 class="card-text text-muted  ft-sm" style="margin-top: 4px;padding-top: 0px;">
            <i class="fa fa-phone ft-14"></i> <span><?= ( $record->secondary_mobile_number_country_data ?? 0 ) ? '+'.json_decode($record->secondary_mobile_number_country_data)->dialCode : '+91' ?> <?= $record->lead_mobile_no_2 ?></span>
          </h6>
          <?php endif; ?>
          <!-- End Secondary Mobile Number -->

        </div>
        <div class="col-md-6" align="right">
          <div class="card-text text-muted pt-1 ft-sm"><span><?php if ($record->lead_type_id == 1) {
                                                                echo "<span style='padding:2px 10px;background:#4d7cff;color:white;border-radius:10px;'>" . $record->lead_type_name . "</span>";
                                                              } else if ($record->lead_type_id == 2) {
                                                                echo "<span style='padding:2px 10px;background:#e76166;color:white;border-radius:10px;'>" . $record->lead_type_name . "</span>";
                                                              } else if ($record->lead_type_id == 3) {
                                                                echo "<span style='padding:2px 10px;background:#6fd96f;color:white;border-radius:10px;'>" . $record->lead_type_name . "</span>";
                                                              } else {
                                                                echo $record->lead_type_name;
                                                              } ?></span></div>
          <div class="card-text text-muted pt-1 ft-sm"><span><?= $record->lead_stage_name ?></span></div>
          <div class="card-text text-muted ft-sm"><span><?= $record->lead_source_name ?></span></div>
          <?php if (!$record->added_to_followup) : ?>
            <button type="button" class="btn btn-dark btn-sm btn-add-followup w-120 mt-1 ft-sm" style="color: white;" onclick="add_to_followup_new(<?= $record->lead_id ?>)"><i class="fa fa-pencil"></i> Add to Followup</button>
          <?php endif; ?>
        </div>
      </div>

      <div>
        <div class="text-muted ft-sm next_followup_<?= $record->lead_id ?>"><?= $next_followup ?></div>
      </div>

      <div style="margin-top: 10px;">
        <a href="tel:<?= $record->lead_mobile_no ?>"><button class="btn btn-dark btn-sm btn-rounded" style="margin-right: 8px;"><i class="fa fa-phone"></i></button></a>

        <a href="javascript:void(0)" onclick="get_sms_form('1','<?= $record->lead_id ?>','<?= $record->lead_mobile_no ?>')"><button class="btn btn-info btn-sm btn-rounded" style="margin-right: 8px;"><i class="fa fa-comment"></i></button></a><?php //  } 
                                                                                                                                                                                                                                                  ?>

        <a href="javascript:void(0)" onclick="get_sms_form('3','<?= $record->lead_id ?>','<?= $record->lead_mobile_no ?>')"><button class="btn btn-success btn-sm btn-rounded" style="margin-right: 8px;"><i class="fa fa-whatsapp" style="color: #fff;"></i></button></a><?php //  } 
                                                                                                                                                                                                                                                                          ?>

        <a href="javascript:void(0)" onclick="get_sms_form('2','<?= $record->lead_id ?>','<?= $record->lead_email ?>')"><button class="btn btn-warning btn-sm btn-rounded" style="margin-right: 8px;"><i class="fa fa-envelope" style="color: #fff;"></i></button></a>

        <button class="btn btn-dark btn-sm btn-rounded" style="margin-right: 8px;" onclick="transfer_lead(<?= $record->lead_id ?>)"><i class="fa fa-exchange" style="color: #fff;"></i></button>
      </div>

    </div>
  </div>

  <div style="margin-top: 10px;">
      <!-- Tabs List -->
      <ul class="nav nav-tabs mb-3">
        <!-- Profile -->
        <li class="nav-item">
          <a href="#navtabs-profile" class="nav-link active" data-toggle="tab" aria-expanded="false">Profile</a>
        </li>
        <!-- End Profile -->
        
        <!-- Requirement -->
        <li class="nav-item <?= $is_followup ? '' : 'd-none'; ?>" onclick="getRequirementList(<?= $record->lead_id ?>);">
          <a href="#navtabs-requirement" class="nav-link" data-toggle="tab" aria-expanded="false">Requirement</a>
        </li>
        <!-- Requirement -->

        <!-- Follow Up -->
        <li class="nav-item <?= $is_followup ? '' : 'd-none'; ?>" onclick="getFollowupList(<?= $record->lead_id ?>);">
          <a href="#navtabs-followup" class="nav-link" data-toggle="tab" aria-expanded="true">Followup</a>
        </li>
        <!-- Follow Up -->

        <!-- Lead History -->
        <?php if ($this->Action_model->check_perm('followup_history', 'rr_view')) { ?>
          <li class="nav-item <?= $is_followup ? '' : 'd-none'; ?>" onclick="getLeadHistoryList(<?= $record->lead_id ?>);">
            <a href="#navtabs-history" class="nav-link" data-toggle="tab" aria-expanded="true">History</a>
          </li>
        <?php } ?>
        <!-- Lead History -->

        <!-- Feedback List / Product -->
        <li class="nav-item <?= $is_followup ? '' : 'd-none'; ?>" onclick="getFeedbackList(<?= $record->lead_id ?>);">
          <a href="#navtabs-product" class="nav-link" data-toggle="tab" aria-expanded="true">Product</a>
        </li>
        <!-- Feedback List / Product -->

        <!-- Unit -->
        <li class="nav-item <?= $is_followup ? '' : 'd-none'; ?>">
          <a href="#navtabs-units" class="nav-link" data-toggle="tab" onclick="lead_units(<?= $record->lead_id ?>)">Unit</a>
        </li>
        <!-- End Unit -->
      </ul>
      <!-- End Tabs List -->

    <div class="tab-content br-n pn" style="height: 50vh;overflow-y: auto;overflow-x: hidden;padding-right: 6px;">
      <div id="navtabs-profile" class="tab-pane active">

        <div class="row">

          <div class="col-md-12 d-none">
            <!-- Table -->
             <table class="table table-bordered">
                <!-- Name -->
                <tr>
                  <th>Name</th>
                  <td><?= ucwords($record->lead_title . ' ' . $record->lead_first_name . ' ' . $record->lead_last_name) ?></td>
                </tr>
                <!-- End Name -->

                <!-- Mobile -->
                <tr>
                  <th>Mobile</th>
                  <td>+91 <?= $record->lead_mobile_no ?></td>
                </tr>
                <!-- End Mobile -->
             </table>
            <!-- End Table -->
          </div>

          <div class="col-md-12">
            <label>Name:</label> <strong><?= ucwords($record->lead_title . ' ' . $record->lead_first_name . ' ' . $record->lead_last_name) ?></strong>
          </div>
          <div class="col-md-6">
            <label>Contact No:</label> <strong>+91<?= $record->lead_mobile_no ?></strong>
          </div>
          <div class="col-md-6">
            <label>Other No:</label> <strong>+91<?= $record->lead_mobile_no_2 ?></strong>
          </div>
          <div class="col-md-12">
            <label>Email Id:</label> <strong><?= $record->lead_email ?></strong>
          </div>
          <div class="col-md-12">
            <label>Address:</label> <strong><?= $record->lead_address ?></strong>
          </div>
          <div class="col-md-6">
            <label>City:</label> <strong><?= $record->city_name ?></strong>
          </div>
          <div class="col-md-6">
            <label>State:</label> <strong><?= $record->state_name ?></strong>
          </div>
          <div class="col-md-6">
            <label>Sex:</label> <strong><?= $record->lead_gender ?></strong>
          </div>
          <div class="col-md-6">
            <label>Marital Status:</label> <strong><?= $record->lead_marital_status ?></strong>
          </div>
          <div class="col-md-6">
            <label>Occupation:</label> <strong><?= $record->occupation_name ?></strong>
          </div>
          <div class="col-md-6">
            <label>Designation:</label> <strong><?= $record->designation_name ?></strong>
          </div>
          <div class="col-md-12">
            <label>Name of Company:</label> <strong><?= $record->lead_company ?></strong>
          </div>
          <div class="col-md-12">
            <label>Annual Income:</label> <strong><?= $record->lead_annual_income ?></strong>
          </div>
          <div class="col-md-12">
            <h4>KYC</h4>
          </div>
          <div class="col-md-6">
            <label>PAN No:</label> <strong><?= $record->lead_pan_no ?></strong>
          </div>
          <div class="col-md-6">
            <label>Adhar No:</label> <strong><?= $record->lead_adhar_no ?></strong>
          </div>
          <div class="col-md-6">
            <label>Voter Id:</label> <strong><?= $record->lead_voter_id ?></strong>
          </div>
          <div class="col-md-6">
            <label>Passport No:</label> <strong><?= $record->lead_passport_no ?></strong>
          </div>
          <div class="col-md-6">
            <label>Added By:</label> <strong><?= ($record->added_by) ? $this->Action_model->get_name($record->added_by) : '' ?></strong>
          </div>
          <div class="col-md-12" align="right">
            <!--<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#profileEditModal" style="color: white;"><i class="fa fa-edit"></i> Edit</button>-->
            <!-- <a href="<?= base_url(AGENT_URL . 'lead-detail/' . $record->lead_id) ?>">-->
            <button type="button" class="btn btn-dark btn-sm" style="color: white;" onclick="get_lead_form(<?= $record->lead_id ?>)"><i class="fa fa-edit"></i> Edit</button>
            <!--</a>-->
          </div>
        </div>

        <div class="modal fade" id="profileEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="row">
                    <div class="col-md-12">
                      <label>Name:</label>
                      <input type="text" class="form-control" value="Rakesh">
                    </div>
                    <div class="col-md-6" style="margin-top: 10px;">
                      <label>Contact No:</label>
                      <input type="text" class="form-control" value="+91878454545454">
                    </div>
                    <div class="col-md-6" style="margin-top: 10px;">
                      <label>Other No:</label>
                      <input type="text" class="form-control" value="+91878454545454">
                    </div>
                    <div class="col-md-12" style="margin-top: 10px;">
                      <label>Email Id:</label>
                      <input type="email" class="form-control" value="abc@gmail.com">
                    </div>
                    <div class="col-md-12" style="margin-top: 10px;">
                      <label>Address:</label>
                      <textarea class="form-control" rows="2">Pratap Nagar Jaipur, Rajasthan, India</textarea>
                    </div>
                    <div class="col-md-6" style="margin-top: 10px;">
                      <label>City:</label>
                      <select class="form-control">
                        <option value="">Select City</option>
                        <option value="Jaipur">Jaipur</option>
                        <option value="Sikar">Sikar</option>
                      </select>
                    </div>
                    <div class="col-md-6" style="margin-top: 10px;">
                      <label>State:</label>
                      <select class="form-control">
                        <option value="">Select State</option>
                        <option value="Rajasthan">Rajasthan</option>
                        <option value="Gujrat">Gujrat</option>
                      </select>
                    </div>
                    <div class="col-md-6" style="margin-top: 10px;">
                      <label>Sex:</label>
                      <select class="form-control">
                        <option value="">Select Sex</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                    <div class="col-md-6" style="margin-top: 10px;">
                      <label>Marital Status:</label>
                      <select class="form-control">
                        <option value="">Select Marital Status</option>
                        <option value="Married">Married</option>
                        <option value="Unmarried">Unmarried</option>
                      </select>
                    </div>
                    <div class="col-md-6" style="margin-top: 10px;">
                      <label>Occopuction:</label>
                      <select class="form-control">
                        <option value="">Select Occopuction</option>
                        <option value="Service">Service</option>
                        <option value="Business">Business</option>
                      </select>
                    </div>
                    <div class="col-md-6" style="margin-top: 10px;">
                      <label>Designation:</label>
                      <select class="form-control">
                        <option value="">Select Designation</option>
                      </select>
                    </div>
                    <div class="col-md-12" style="margin-top: 10px;">
                      <label>Name of Company:</label>
                      <input type="text" class="form-control" value="">
                    </div>
                    <div class="col-md-6" style="margin-top: 10px;">
                      <label>Annual Income:</label>
                      <input type="text" class="form-control" value="">
                    </div>
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-12" style="margin-top: 10px;">
                      <h4>KYC</h4>
                    </div>
                    <div class="col-md-6" style="margin-top: 10px;">
                      <label>PAN No:</label>
                      <input type="text" class="form-control" value="">
                    </div>
                    <div class="col-md-6" style="margin-top: 10px;">
                      <label>Adhar No:</label>
                      <input type="text" class="form-control" value="">
                    </div>
                    <div class="col-md-6" style="margin-top: 10px;">
                      <label>Voter Id:</label>
                      <input type="text" class="form-control" value="">
                    </div>
                    <div class="col-md-6" style="margin-top: 10px;">
                      <label>Passport No:</label>
                      <input type="text" class="form-control" value="">
                    </div>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Update</button>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div id="navtabs-requirement" class="tab-pane">


        <div class="row" align="right" style="margin-bottom: 10px;">
          <div class="col-md-12">
            <button type="button" class="btn btn-dark btn-sm" onclick="reqFormModal(0,1,<?= $record->lead_id ?>)" style="color: white;">Add Requirement</button>
          </div>
        </div>

        <div class="requirement_list"></div>

      </div>

      <div id="navtabs-followup" class="tab-pane <?php if ($this->input->post('def') == 0) {
                                                    echo 'actived';
                                                  } ?>">
        <div class="followup_list"></div>
      </div>

      <div id="navtabs-history" class="tab-pane">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="lead_history">
            </div>
          </div>
        </div>
      </div>

      <div id="navtabs-product" class="tab-pane">


        <div class="row" style="margin-bottom: 10px;">
          <div class="col-md-12" align="right">
            <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#productFeedbackModal" onclick="feedbackFormModal(0,1,<?= $record->lead_id ?>)" style="color: white;">Feedback</button>
          </div>
        </div>

        <div class="feedback_list" style="padding-left: 5px;"></div>

      </div>

      <!-- Units -->
      <div id="navtabs-units" class="tab-pane">
        <section class="lead-units-section"></section>
        <div class="row">
          <div class="col-md-12">
            <!-- Add -->
            <div class="add-unit-wrapper">
              <div class="text-right m-2">
                <button class="btn btn-primary btn-sm add-edit-new-unit-btn" data-lead_id="<?= $record->lead_id ?>">Add New</button>
              </div>
            </div>
            <!-- End Add -->
          </div>
        </div>
      </div>
    </div>
    <!-- End Units -->

  </div>

</div>
</div>

<!-- start transfer lead modal -->
<div class="modal fade" id="transferModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Transfer Lead</h5>
        <button type="button" class="close" onclick="closeTransferModal()" aria-label="Close"><span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="transfer-error-msg"></div>
        <form id="transfer-form-modal" method="post">
          <input type="hidden" name="transfer_lead_id" id="transfer_lead_id" value="">
          <div class="row">

            <div class="col-md-12" style="margin-top: 10px;">
              <label>Transfer To:</label>
              <select class="form-control" id="transfer_to" name="transfer_to" required>
                <option value="">Select User</option>
                <?php foreach ($user_list as $item) {
                  if ($record->user_id != $item->user_id) {  ?>
                    <option value="<?= $item->user_id ?>"><?= (($item->parent_id == 0) ? (($item->is_individual) ? ucwords($item->user_title . ' ' . $item->first_name . ' ' . $item->last_name) : $item->firm_name) : ucwords($item->user_title . ' ' . $item->first_name . ' ' . $item->last_name)) ?></option>
                <?php }
                } ?>
              </select>
            </div>

            <div class="col-md-12 pt-4 pb-2" align="right">
              <button type="button" class="btn btn-danger btn-lg mr-3" onclick="closeTransferModal()">Close</button>
              <button type="submit" class="btn btn-dark btn-lg transfer-form-btn w-120">Transfer</button>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end transfer lead modal -->

<!-- Add / Edit Unit -->

<div class="modal fade" id="unitModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add / Edit Unit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#lead-unit-form')[0].reset(0);">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="ajax-msg"></div>
        <div class="lead-unit-form-view">

        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Add Unit -->

<!-- Unit Detials -->
<div class="modal fade" id="lead-unit-details-modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Unit Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="lead-unit-details-container"></div>
      </div>
    </div>
  </div>
  <!-- End Unit Detials -->

  <script>
    function transfer_lead(id) {

      $("#transferModal").modal({
        backdrop: 'static',
        keyboard: false
      });
      $("#transfer_to").val('');
      $(".transfer-error-msg").html('');
      $(".error-msg-right").html('');
      $("#transfer_lead_id").val(id);
    }

    function closeTransferModal() {
      $("#transferModal").modal('hide');
    }
    $("#transfer-form-modal").validate({
      rules: {},
      messages: {},
      submitHandler: function(form) {
        var myform = document.getElementById("transfer-form-modal");
        var fd = new FormData(myform);

        $.ajax({
          type: "POST",
          url: "<?= base_url(AGENT_URL . 'api/transfer_lead') ?>",
          data: fd,
          cache: false,
          processData: false,
          contentType: false,
          beforeSend: function(data) {
            $(".transfer-error-msg").html('');
            $(".transfer-form-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
          },
          success: function(response) {
            setTimeout(function() {
              var obj;
              try {
                obj = JSON.parse(response);
                $(".transfer-form-btn").html("Transfer");
                if (obj.status == 'success') {

                  $("#transferModal").modal('hide');
                  $(".error-msg-right").html(alertMessage('success', obj.message));
                  $(".btn-add-followup").css("visibility", "hidden");
                  $(".transfer_btn").css("visibility", "hidden");
                  setTimeout(function() {
                    window.location.href = "";
                  }, 1000);

                } else {
                  $(".transfer-error-msg").html(alertMessage('error', obj.message));
                }
              } catch (err) {
                $(".transfer-form-btn").html("Transfer");
                $(".transfer-error-msg").html(alertMessage('error', 'Some error occurred, please try again.'));
              }
            }, 500);
          },
          error: function() {
            $(".transfer-form-btn").html("Transfer");
            $(".transfer-error-msg").html(alertMessage('error', 'Some error occurred, please try again.'));

          }

        });

      }
    });
  </script>

  <script>
    <?php if ($this->input->post('def') == 0) { ?>
      getFollowupList(<?= $record->lead_id ?>);
    <?php } ?>

    // ##########
  </script>