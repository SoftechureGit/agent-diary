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
    box-shadow: 2px 2px 22px #80808045;
  }

  #unitModal .card .card-body {
    padding: 1rem 2rem !important;
  }

  label.error {
    color: #a94442 !important;
    font-size: 14px !important;
}

  /* Unit Modal */

  #unit-details-modal table caption {
    font-family: Roboto;
    caption-side: top;
    font-weight: 600;
    letter-spacing: 1px;
    padding-top: 0;
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
          <h6 class="card-text text-muted ft-sm"><i class="fa fa-calendar"></i> <?= $record->lead_date ?> (Age of Lead)</h6>
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
          <h6 class="card-text text-muted  ft-sm" style="margin-top: 4px;margin-bottom: 0px;padding-bottom: 0px;"><i class="fa fa-mobile ft-14"></i> <span>+91<?= $record->lead_mobile_no ?></span></h6>
          <h6 class="card-text text-muted  ft-sm" style="margin-top: 4px;padding-top: 0px;"><i class="fa fa-phone ft-14"></i> <span>+91<?= $record->lead_mobile_no_2 ?></span></h6>
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
    <ul class="nav nav-tabs mb-3">
      <li class="nav-item"><a href="#navtabs-profile" class="nav-link <?php if ($this->input->post('def') == 1) {
                                                                        echo 'active';
                                                                      } ?>" data-toggle="tab" aria-expanded="false">Profile</a>
      </li>
      <li class="nav-item" onclick="getRequirementList(<?= $record->lead_id ?>);"><a href="#navtabs-requirement" class="nav-link" data-toggle="tab" aria-expanded="false">Requirement</a>
      </li>
      <li class="nav-item" onclick="getFollowupList(<?= $record->lead_id ?>);"><a href="#navtabs-followup" class="nav-link <?php if ($this->input->post('def') == 0) {
                                                                                                                              echo 'active';
                                                                                                                            } ?>" data-toggle="tab" aria-expanded="true">Followup</a>
      </li><!-- onclick="getLeadHistoryList(<?= $record->lead_id ?>);" -->
      <?php if ($this->Action_model->check_perm('followup_history', 'rr_view')) { ?>
        <li class="nav-item" onclick="getLeadHistoryList(<?= $record->lead_id ?>);"> <a href="#navtabs-history" class="nav-link" data-toggle="tab" aria-expanded="true">History</a>
        </li>
      <?php } ?>
      <li class="nav-item" onclick="getFeedbackList(<?= $record->lead_id ?>);"><a href="#navtabs-product" class="nav-link" data-toggle="tab" aria-expanded="true">Product</a>
      </li>
      <!-- Unit -->
      <li class="nav-item">
        <a href="#navtabs-units" class="nav-link" data-toggle="tab">Unit</a>
      </li>
      <!-- End Unit -->
    </ul>
    <div class="tab-content br-n pn" style="height: 40vh;overflow-y: auto;overflow-x: hidden;padding-right: 6px;">
      <div id="navtabs-profile" class="tab-pane <?php if ($this->input->post('def') == 1) {
                                                  echo 'active';
                                                } ?>">
        <div class="row">
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
                                                    echo 'active';
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
        <div class="row">
          <?php foreach(lead_units(12) as $lead_unit): ?>
          <!-- Unit Card -->
          <div class="col-md-12">
            <div class="card unit-card">
              <div class="card-body">
                <div class="row">
                  <!-- Project -->
                  <div class="col-md-2">
                    <label for="">Project :</label>
                  </div>
                  <div class="col-md-10 p-0">
                    <span class="label-value">
                    <?=  $lead_unit->project_name.', '.$lead_unit->property_name.', '.$lead_unit->city_name.', '.$lead_unit->state_name ?>
                    </span>
                  </div>
                  <!-- End Project -->

                  <!-- Project -->
                  <?php if($lead_unit->property_details->unit_number ?? 0): ?>
                  <div class="col-md-2">
                    <label for=""> Unit No :</label>
                  </div>
                  <div class="col-md-2 p-0">
                    <span class="label-value">
                    <?=  $lead_unit->property_details->unit_number; ?>
                    </span>
                  </div>
                  <?php endif; ?>

                  <?php if($lead_unit->property_details->plot_size ?? 0): ?>
                  <div class="col-md-1 pr-0">
                    <label for="">Size :</label>
                  </div>
                  <div class="col-md-2">
                    <span class="label-value">
                    <?=  $lead_unit->property_details->plot_size; ?>
                    </span>
                  </div>
                  <?php endif; ?>

                  <?php if($lead_unit->booking_date ?? 0): ?>
                  <div class="col-md-2 pr-0">
                    <label for="">Booking Date :</label>
                  </div>
                  <div class="col-md-2 p-0">
                    <span class="label-value">
                      <?=  $lead_unit->booking_date; ?>
                    </span>
                  </div>
                  <?php endif; ?>
                  <!-- End Project -->

                  <!-- Project -->
                  <?php if($lead_unit->property_details->referance_number ?? 0): ?>
                  <div class="col">
                    <label for="">Unit Ref No :</label>
                  </div>
                  <div class="col">
                    <span class="label-value">
                    <?=  $lead_unit->property_details->referance_number ?? ''; ?>
                    </span>
                  </div>
                  <?php endif; ?>
                  <div class="col align-self-end">
                    <div class="d-flex text-end" style="justify-content: right;">
                      <i class="fa fa-edit px-2  text-success add-edit-new-unit-btn"></i>
                      <i class="fa fa-eye px-2 text-primary view-unit-details"></i>
                    </div>
                  </div>
                  <!-- End Project -->


                </div>
              </div>
            </div>
          </div>
          <!-- End Unit Card -->
           <?php endforeach; ?>

          <div class="col-md-12">
            <!-- Add -->
            <div class="add-unit-wrapper">
              <div class="text-right m-2">
                <button class="btn btn-primary btn-sm add-edit-new-unit-btn">Add New</button>
              </div>
            </div>
            <!-- End Add -->
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
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add Unit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="ajax-msg"></div>
        <form id="lead-unit-form" method="post" enctype="multipart/form-data">
          <div class="row">
            <!-- User Id  -->
            <input type="hidden" name="lead_id" value="<?= $record->lead_id; ?>">
            <!-- End User Id -->

            <!-- Looking For -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Looking For <span class="text-danger">*</span></label>
                <select name="looking_for" id="" class="form-control" required>
                  <option value="" selected disabled>Choose..</option>
                  <option value="sale">Sale</option>
                  <option value="rent">Rent</option>
                  <option value="no_action">No Action</option>
                </select>
              </div>
            </div>
            <!-- End Looking For -->

            <!-- Date -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Booking Date <span class="text-danger">*</span></label>
                <input type="date" class="form-control" name="booking_date" required>
              </div>
            </div>
            <!-- End Date -->

            <!-- Project Type -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Project Type <span class="text-danger">*</span></label>
                <select name="project_type_id" id="" class="form-control get_property_types" required>
                  <option value="" selected disabled>Choose..</option>
                  <?php
                  foreach (project_types() as $project_type) :
                    echo "<option value='$project_type->id'>$project_type->name</option>";
                  endforeach;
                  ?>
                </select>
              </div>
            </div>
            <!-- End Project Type -->

            <!-- Property Type -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Property Type <span class="text-danger">*</span></label>
                <select name="property_type_id" id="" class="form-control set_property_types get_property_form" required>
                  <option value="" selected disabled>Choose..</option>
                </select>
              </div>
            </div>
            <!-- End Property Type -->

            <!-- State -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="">State <span class="text-danger">*</span></label>
                <select name="state_id" id="" class="form-control get_cities select2" required>
                  <option value="" selected disabled>Choose..</option>
                  <?php
                  foreach (states() as $state) :
                    echo "<option value='$state->id'>$state->name</option>";
                  endforeach;
                  ?>
                </select>
              </div>
            </div>
            <!-- End State -->

            <!-- City -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="">City <span class="text-danger">*</span></label>
                <select name="city_id" id="" class="form-control set_cities" required>
                  <option value="" selected disabled>Choose..</option>
                </select>
              </div>
            </div>
            <!-- End City -->

            <!-- Location -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Location <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="location" placeholder="Enter location" required>
              </div>
            </div>
            <!-- End Location -->

            <!-- List of Project -->
            <div class="col-md-6">
              <div class="form-group">
                <label for="">List of Project</label>
                <select name="project_id" id="" class="form-control">
                  <option value="" selected disabled>Choose..</option>
                  <option value="test">Test</option>
                </select>
              </div>
            </div>
            <!-- End List of Project -->

            <!-- Form View -->
            <div class="set_property_form w-100"></div>
            <!-- Form View -->

            <!-- List of Project -->
            <div class="col-md-12">
              <div class="text-center">
                <button type="submit" class="btn btn-primary btn-sm submit-btn">Submit</button>
              </div>
            </div>
            <!-- End List of Project -->
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Add Unit -->

<!-- Unit Detials -->
<div class="modal fade" id="unit-details-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Unit Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">


            <div class="table-responsive">
              <table class="table table-bordered">
                <caption>Basic Details</caption>
                <tr>
                  <th>Looking For</th>
                  <td>Sale</td>
                </tr>

                <tr>
                  <th>Date</th>
                  <td>26 March, 2024</td>
                </tr>

                <tr>
                  <th>State</th>
                  <td>Rajasthan</td>
                </tr>

                <tr>
                  <th>City</th>
                  <td>Jaipur</td>
                </tr>

                <tr>
                  <th>Location</th>
                  <td>Sodal</td>
                </tr>

                <tr>
                  <th>List of Project</th>
                  <td>Test</td>
                </tr>

              </table>
            </div>
          </div>

          <div class="col-md-6">
            <div class="table-responsive">
              <table class="table table-bordered">
                <caption>Property Details</caption>
                <tr>
                  <th>Project Type</th>
                  <td>Residential</td>
                </tr>

                <tr>
                  <th>Property Type</th>
                  <td>Plot</td>
                </tr>

                <tr>
                  <th>Block</th>
                  <td>2 BHK</td>
                </tr>

                <tr>
                  <th>Unit No</th>
                  <td>26</td>
                </tr>

                <tr>
                  <th>Size</th>
                  <td>100 Sqyd</td>
                </tr>

                <tr>
                  <th>Facing</th>
                  <td>Facing</td>
                </tr>

                <tr>
                  <th>Diamantion</th>
                  <td>Unit Diamantion</td>
                </tr>

                <tr>
                  <th>PLC if Any</th>
                  <td>...........</td>
                </tr>



              </table>
            </div>
          </div>
        </div>
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

    // $('.select2').select2();

    $('.add-edit-new-unit-btn').on('click', function() {
      $('#unitModal').modal('show')
    })

    $('.view-unit-details').on('click', function() {
      $('#unit-details-modal').modal('show')
    })

    /* Get Property Types */
    $('.get_property_types').on('change', function() {
      var project_type_id = $(this).val();

      get_and_set_property_types(project_type_id);

    })

    function get_and_set_property_types(project_type_id) {
      $.ajax({
        method: 'GET',
        url: "<?= base_url('helper/get_property_types'); ?>",
        data: {
          project_type_id: project_type_id
        },
        dataType: 'json',
        success: (res) => {
          if (res.status) {
            $('.set_property_types').html(res.options_view)
          }
        }
      })
    }
    /* End Get Property Types */

    /* End Get Property Form */
    $('.get_property_form').on('change', function() {
      var property_id = $(this).val();

      $.ajax({
        method: 'GET',
        url: "<?= base_url('helper/get_property_form'); ?>",
        data: {
          property_id: property_id
        },
        dataType: 'json',
        success: (res) => {
          if (res.status) {
            $('.set_property_form').html(res.form_view)
          }
        }
      })
    })
    /* End Get Property Form */

    /*  Get Cities */
    $('.get_cities').on('change', function() {
      var state_id = $(this).val();

      get_and_set_cities(state_id);

    })

    function get_and_set_cities(state_id) {
      $.ajax({
        method: 'GET',
        url: "<?= base_url('helper/get_cities'); ?>",
        data: {
          state_id: state_id
        },
        dataType: 'json',
        success: (res) => {
          if (res.status) {
            $('.set_cities').html(res.options_view)
          }
        }
      })
    }
    /*  End Get Cities */

    /*  Lead Unit Form */
    $('#lead-unit-form').validate({
      rules: {
        looking_for: {
          required: true
        }
      },
      messages: {},
      submitHandler: function(form) {
        var myform = document.getElementById("lead-unit-form");
        var fd = new FormData(myform);

        $.ajax({
          type: "POST",
          url: "<?= base_url('store_lead_unit') ?>",
          data: fd,
          dataType: 'json',
          cache: false,
          processData: false,
          contentType: false,
          beforeSend: function(data) {
            $(".error-msg").html('');
            $(".submit-btn").html("Please wait...").prop('disabled', true);
          },
          success: function(res) {
            if(res.status){
              $('.ajax-msg').html(`<div class="alert alert-success">${res.message}</div>`)
              setTimeout(function(){
                $('#unitModal').modal('hide')
                $('#lead-unit-form')[0].reset()
                $('.ajax-msg').html('')
                $('.set_property_form').html('')
              },1000)
            }else{
              $('.ajax-msg').html(`<div class="alert alert-danger">${res.message}</div>`)
            }
            $(".submit-btn").html("Submit").prop('disabled', false);
          },
          error: function() {
      
          }

        });

      }
    });
    /*  End Lead Unit Form */

    // ##########
  </script>