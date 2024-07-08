<div style="padding: 0px 15px 0px 15px;">
  <div class="row" style="border-bottom: 1px solid #0000000f;padding-bottom: 13px;margin-bottom: 10px;">
  <div class="col-md-2" align="center">
    <img class="mr-3" src="<?= base_url('public/front/user.png') ?>" style="margin-top: 18px;border-radius:50%;" width="50" height="50" alt="">
  </div>
  <div class="col-md-10">

    <!--<div class="row">
      <div class="col-md-12">
        <h6 class="card-text text-muted"><i class="fa fa-calendar"></i> <?= $record->lead_date ?></h6>
      </div>
    </div>-->

    <div class="row" style="margin-top: 5px;">
      <div class="col-md-6">
        <h6 class="card-text text-muted ft-14" style="font-size: 16px;"><i class="fa fa-user"></i> <?= ucwords($record->lead_title.' '.$record->lead_first_name.' '.$record->lead_last_name) ?></h6>
      </div>

      <div class="col-md-6" align="right">
        <h6 class="card-text text-muted ft-sm"><i class="fa fa-calendar"></i> <?= $record->lead_date." & ".$record->lead_time ?></h6>
      </div>
    </div>

    <div class="row" style="margin-top: 2px;">
      <div class="col-md-6">
        <h6 class="card-text text-muted" style="margin-top: 4px;margin-bottom: 0px;padding-bottom: 0px;"><i class="fa fa-mobile"></i> <span >+91<?= $record->lead_mobile_no ?></span></h6>
        <h6 class="card-text text-muted ft-sm" style="margin-top: 4px;padding-top: 0px;"><i class="fa fa-phone"></i> <span>+91<?= $record->lead_mobile_no_2 ?></span></h6>
      </div>
      <div class="col-md-6 pt-2" align="right">
        <div class="card-text text-muted ft-sm"><span><?php if($record->lead_type_id==1) { echo "<span style='padding:2px 10px;background:#4d7cff;color:white;border-radius:10px;'>".$record->lead_type_name."</span>"; } else if($record->lead_type_id==2) { echo "<span style='padding:2px 10px;background:#e76166;color:white;border-radius:10px;'>".$record->lead_type_name."</span>"; } else if($record->lead_type_id==3) { echo "<span style='padding:2px 10px;background:#6fd96f;color:white;border-radius:10px;'>".$record->lead_type_name."</span>"; }  else { echo $record->lead_type_name; } ?></span></div>
        <div class="card-text text-muted pt-1 ft-sm"><span><?= $record->lead_stage_name ?></span></div>
        <div class="card-text text-muted ft-sm"><span><?= $record->lead_source_name ?></span></div>

        <button type="button" class="btn btn-dark btn-sm btn-add-followup w-120 mt-1 ft-sm" style="color: white;" onclick="add_to_followup(<?= $record->lead_id ?>)"><i class="fa fa-pencil"></i> Add to Followup</button>
      </div>
    </div>

    <div style="margin-top: 10px;">
      <a href="tel:<?= $record->lead_mobile_no ?>"><button class="btn btn-dark btn-sm btn-rounded" style="margin-right: 8px;"><i class="fa fa-phone"></i></button></a>

      <a href="javascript:void(0)" onclick="get_sms_form('1','<?= $record->lead_id ?>','<?= $record->lead_mobile_no ?>')"><button class="btn btn-info btn-sm btn-rounded" style="margin-right: 8px;"><i class="fa fa-comment"></i></button></a><?php //  } ?>
      
      <a href="javascript:void(0)" onclick="get_sms_form('3','<?= $record->lead_id ?>','<?= $record->lead_mobile_no ?>')"><button class="btn btn-success btn-sm btn-rounded" style="margin-right: 8px;"><i class="fa fa-whatsapp" style="color: #fff;"></i></button></a><?php //  } ?>

      <a href="javascript:void(0)" onclick="get_sms_form('2','<?= $record->lead_id ?>','<?= $record->lead_email ?>')"><button class="btn btn-warning btn-sm btn-rounded" style="margin-right: 8px;"><i class="fa fa-envelope" style="color: #fff;"></i></button></a>

      <button class="btn btn-dark btn-sm btn-rounded" style="margin-right: 8px;" onclick="transfer_lead(<?= $record->lead_id ?>)"><i class="fa fa-exchange" style="color: #fff;"></i></button>
    </div>

  </div>
</div>

<div style="margin-top: 10px;">
<ul class="nav nav-tabs mb-3">
    <li class="nav-item"><a href="#navtabs-profile" class="nav-link active" data-toggle="tab" aria-expanded="false">Profile</a>
    </li>
    <!--<li class="nav-item"><a href="#navtabs-requirement" class="nav-link" data-toggle="tab" aria-expanded="false">Requirement</a>
    </li>
    <li class="nav-item"><a href="#navtabs-unit" class="nav-link" data-toggle="tab" aria-expanded="true">Unit</a>
    </li>
    <li class="nav-item"><a href="#navtabs-history" class="nav-link" data-toggle="tab" aria-expanded="true">History</a>
    </li>
    <li class="nav-item"><a href="#navtabs-product" class="nav-link" data-toggle="tab" aria-expanded="true">Product</a>
    </li>-->
</ul>
<div class="tab-content br-n pn" style="height: 40vh;overflow-y: auto;overflow-x: hidden;padding-right: 6px;">
    <div id="navtabs-profile" class="tab-pane active">
        <div class="row">
            <div class="col-md-12">
              <label>Name:</label> <strong><?= ucwords($record->lead_title.' '.$record->lead_first_name.' '.$record->lead_last_name) ?></strong>
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
              <label>Added By:</label> <strong><?= ($record->added_by)?$this->Action_model->get_name($record->added_by):'' ?></strong>
            </div>
                <div class="col-md-12" align="right">
                    <!--<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#profileEditModal" style="color: white;"><i class="fa fa-edit"></i> Edit</button>-->
                    <!-- <a href="<?= base_url(AGENT_URL.'lead-detail/'.$record->lead_id) ?>">-->
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
                    <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#requirementModal" style="color: white;">Add Requirement</button>
                </div>
        </div>

        <?php for ($i=1; $i <=5 ; $i++) { ?>
        <div style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);padding-bottom: 13px;margin-bottom: 14px;">
          <div class="row">
              <div class="col-md-4">
                <label>Requirement Id:</label> <strong>1001</strong>
              </div>
              <div class="col-md-4">
                <label>DOR:</label> <strong>25-10-2019</strong>
              </div>
              <div class="col-md-4" align="right">
                <label>Status:</label> <strong><span class="label label-pill label-success" style="padding: 3px 10px;">Open</span></strong>
              </div>
              <div class="col-md-6">
                <label>Looking For:</label> <strong></strong>
              </div>
              <div class="col-md-12">
                <label>At:</label> <strong>Pratap Nagar. Jaipur, Rajasthan</strong>
              </div>
              <div class="col-md-12">
                <label>Budget:</label> <strong>100000-200000</strong>, <label>Size:</label> <strong>80-80</strong> Biga
              </div>
              <div class="col-md-8">
                <label>Remarks:</label> <strong></strong>
              </div>
                  <div class="col-md-4" align="right">
                      <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#requirementModal" style="color: white;"><i class="fa fa-edit"></i> Edit</button>
                  </div>
          </div>
        </div>
        <?php } ?>

        <div class="modal fade" id="requirementModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add/Edit Requirement</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                              <div class="row">
                                  <div class="col-md-6">
                        <label>Looking For :</label>
                                        <select class="form-control">
                                              <option value="">Select Looking For</option>
                                              <option value="For Sale">For Sale</option>
                                              <option value="For Buy">For Buy</option>
                                              <option value="For Rent">For Rent</option>
                                        </select>
                      </div>
                      <div class="col-md-6" style="margin-top: 10px;">
                        <label>Type of Property:</label>
                                        <select class="form-control">
                                              <option value="">Select Type of Property</option>
                                        </select>
                      </div>
                      <div class="col-md-6" style="margin-top: 10px;">
                        <label>Unit Type:</label>
                                        <select class="form-control">
                                              <option value="">Select Unit Type</option>
                                        </select>
                      </div>
                      <div class="col-md-6" style="margin-top: 10px;">
                        <label>Accomodation :</label>
                        <input type="text" class="form-control" value="">
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
                        <label>City:</label>
                                        <select class="form-control">
                                              <option value="">Select City</option>
                                              <option value="Jaipur">Jaipur</option>
                                              <option value="Sikar">Sikar</option>
                                        </select>
                      </div>

                      <div class="col-md-6" style="margin-top: 10px;">
                        <label>Location:</label>
                                        <select class="form-control" multiple="" id="selectLocation" style="width: 100%;">
                                              <option value="">Select Location</option>
                                              <option value="Mansarovar">Mansarovar</option>
                                              <option value="Pratap Nagar">Pratap Nagar</option>
                                        </select>
                      </div>

                      <div class="col-md-12" style="margin-top: 10px;">
                        <label>Budget:</label>
                        <div class="row">
                          <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Min" value="">
                          </div>
                          <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Max" value="">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12" style="margin-top: 10px;">
                        <label>Size:</label>
                        <div class="row">
                          <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Min" value="">
                          </div>
                          <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Max" value="">
                          </div>
                          <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Unit" value="">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12" style="margin-top: 10px;">
                        <label>Remarks:</label>
                        <textarea class="form-control" rows="2"></textarea>
                      </div>

                  </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Add/Save</button>
                        </div>
                    </div>
                </div>
            </div>

    </div>

    <div id="navtabs-unit" class="tab-pane">

    </div>

    <div id="navtabs-history" class="tab-pane">
        <div class="row align-items-center">
            <div class="col-md-12">
                <p class="text-center">From Add a customer to all Histroy like call, sms , email , whatsapp , followup , Site visit , Customer Transfer and other activeity date time and user wise</p>
            </div>
        </div>
    </div>

    <div id="navtabs-product" class="tab-pane">


        <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-12" align="right">
                    <button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#productFeedbackModal" style="color: white;">Feedback</button>
                </div>
        </div>
        
        <?php for ($i=1; $i <=5 ; $i++) { ?>
        <div style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);padding-bottom: 13px;margin-bottom: 14px;">
          <div class="row">
              <div class="col-md-1" align="center">
                <input type="radio" name="rd_product" value="1">
              </div>
              <div class="col-md-11">
                <div class="row">
                  <div class="col-md-12">
                    <label>Size (unit), Accomodation, Type of Property, Unit Type, Task @ Project name, Location, City, State</label>
                  </div>
                  <div class="col-md-6">
                    <label>Furniture, Budget-100000</label>
                  </div>
                  <div class="col-md-6">
                    <label>Requirment id</label>
                  </div>
                  <div class="col-md-6">
                    <label>Visit Status</label>
                  </div>
                  <div class="col-md-6">
                    <label>Date & Time, By Team</label>
                  </div>
                  <div class="col-md-12">
                    <label>Comment:</label> 
                  </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>

        <div class="modal fade" id="productFeedbackModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Feedback</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                              <div class="row">
                                  <div class="col-md-12">
                        <label>Customer like this porperty:</label>
                        <label><input type="radio" name="like_property" value="Yes"> Yes</label>
                        <label><input type="radio" name="like_property" value="No"> No</label>
                      </div>
                      <div class="col-md-12" style="margin-top: 10px;">
                        <label>Date & Time of visit:</label>
                        <div class="row">
                          <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Date" value="">
                          </div>
                          <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Time" value="">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12" style="margin-top: 10px;">
                        <label>Comment:</label>
                        <textarea class="form-control" rows="2"></textarea>
                      </div>

                      <div class="col-md-12" style="margin-top: 10px;">
                        <label>Customer Offer:</label>
                        <input type="text" class="form-control" value="">
                      </div>

                  </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>

    </div>

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
                                  <?php foreach ($user_list as $item) { if($record->user_id!=$item->user_id) {  ?>
                            <option value="<?= $item->user_id ?>"><?= (($item->parent_id==0)?(($item->is_individual)?ucwords($item->user_title.' '.$item->first_name.' '.$item->last_name):$item->firm_name):ucwords($item->user_title.' '.$item->first_name.' '.$item->last_name)) ?></option>
                        <?php } } ?>
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

function closeTransferModal(){
  $("#transferModal").modal('hide');
}
$("#transfer-form-modal").validate({
    rules: {
    },
    messages: {
    },
    submitHandler: function(form) {
      var myform = document.getElementById("transfer-form-modal");
      var fd = new FormData(myform );

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'api/transfer_lead') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".transfer-error-msg").html('');
          $(".transfer-form-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
        },
        success: function (response) {
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".transfer-form-btn").html("Transfer");
                if (obj.status=='success') {

                  $("#transferModal").modal('hide');
                  $(".error-msg-right").html(alertMessage('success',obj.message));
                   $(".btn-add-followup").css("visibility","hidden");
                   $(".transfer_btn").css("visibility","hidden");

                }
                else {
                  $(".transfer-error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".transfer-form-btn").html("Transfer");
                $(".transfer-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
            $(".transfer-form-btn").html("Transfer");
          $(".transfer-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
           
        }

    });

    }
});
</script>