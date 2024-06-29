<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Associate Registration</title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('public/admin/') ?>assets/images/favicon.png">
    <link href="<?php echo base_url('public/admin/') ?>plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url('public/admin/') ?>css/style.css" rel="stylesheet">
    <style>
        label.error {
            color: #a94442;
            font-weight: normal;
            margin-top: 4px;
          }
    </style>
    
</head>

<body class="h-100">
    

<div class="login-form-bg">
    <div class="container h-100">
        <div class="row justify-content-center h-100 mt-5">
            <div class="col-xl-10">
                <div class="form-input-content">

                    <div class="text-center" style="padding-bottom: 10px;">
                        <img src="<?php echo base_url('public/front/images/');?>logo.png" style="height: 100px;margin-bottom: 5px;">
                    </div>
                    <div class="card login-form mb-0">
                        <div class="card-body pt-2 ">
                            
                            <div class="basic-form">
                                    <h4 class="card-title text-center mt-3">Associate Registration</h4>
                                    <div class="mb-4 mt-3">
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
                                    <form method="post" id="accociate-form" enctype="multipart/form-data">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label class="radio-inline mb-0 mr-3">
                                                    <input type="radio" name="is_individual" <?php if(!is_numeric($user_detail->is_individual)) { echo 'checked'; } else if($user_detail->is_individual=='1') { echo 'checked'; } ?> value="1" required=""> Individual</label>
                                                <label class="radio-inline mr-3 mb-0">
                                                    <input type="radio" name="is_individual" <?php if($user_detail->is_individual=='0') { echo 'checked'; } ?> value="0" required=""> Non Individual</label>

                                                    <div>
                                                        <label id="is_individual-error" class="error" for="is_individual" style="display: none;"></label>
                                                    </div>
                                             
                                            </div>

                                            <div class="form-group col-md-12 individual">
                                                <label>Agent Name</label>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <select id="inputState" class="form-control individual_val" name="user_title">
                                                            <option selected="selected" value="">Select Title</option>
                                                            <option value="Mr." <?php if($user_detail->user_title=='Mr.') { echo 'selected'; } ?>>Mr.</option>
                                                            <option value="Ms." <?php if($user_detail->user_title=='Ms.') { echo 'selected'; } ?>>Ms.</option>
                                                            <option value="Mrs." <?php if($user_detail->user_title=='Mrs.') { echo 'selected'; } ?>>Mrs.</option>
                                                            <option value="Dr." <?php if($user_detail->user_title=='Dr.') { echo 'selected'; } ?>>Dr.</option>
                                                            <option value="Prof." <?php if($user_detail->user_title=='Prof.') { echo 'selected'; } ?>>Prof.</option>

                                                           
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control individual_val" placeholder="First Name" name="first_name" value="<?=  $user_detail->first_name ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control individual_val" placeholder="Last Name" name="last_name" value="<?=  $user_detail->last_name ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-12 individual">
                                                <label>S/D/W Of </label>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <select class="form-control individual_val" name="sdw_title">
                                                            <option value="">Select Title</option>
                                                            <option value="Mr." <?php if($user_detail->sdw_title=='Mr.') { echo 'selected'; } ?>>Mr.</option>
                                                            <option value="Ms." <?php if($user_detail->sdw_title=='Ms.') { echo 'selected'; } ?>>Ms.</option>
                                                            <option value="Mrs." <?php if($user_detail->sdw_title=='Mrs.') { echo 'selected'; } ?>>Mrs.</option>
                                                            <option value="Dr." <?php if($user_detail->sdw_title=='Dr.') { echo 'selected'; } ?>>Dr.</option>
                                                            <option value="Prof." <?php if($user_detail->sdw_title=='Prof.') { echo 'selected'; } ?>>Prof.</option>
                                                           
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control individual_val" placeholder="First Name" name="sdw_first_name" value="<?=  $user_detail->sdw_first_name ?>">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control individual_val" placeholder="Last Name" name="sdw_last_name" value="<?=  $user_detail->sdw_last_name ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-2 non-individual">
                                                <label>Name of Firm</label>
                                                <select class="form-control non_individual_val" name="firm_type_id">
                                                    <option value="">Type of Firm</option>
                                                    <?php foreach ($firm_type_list as $firm_type) { ?>
                                                        <option value="<?= $firm_type->firm_type_id ?>" <?php if($user_detail->firm_type_id==$firm_type->firm_type_id) { echo 'selected'; } ?>><?= $firm_type->firm_type_name ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-10 non-individual">
                                                <label>Firm Name</label>
                                                <input type="text" class="form-control non_individual_val" placeholder="Please Enter Your Firm Name" name="firm_name" value="<?=  $user_detail->firm_name ?>">
                                            </div>
                                           
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" placeholder="" name="address_1" value="<?=  $user_detail->address_1 ?>" required="">
                                        </div>
                                        <div class="form-group">
                                            <label>Address 2</label>
                                            <input type="text" class="form-control" placeholder="" name="address_2" value="<?=  $user_detail->address_2 ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Address 3</label>
                                            <input type="text" class="form-control" placeholder="" name="address_3" value="<?=  $user_detail->address_3 ?>">
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-5">
                                                <label>Country</label>
                                                  <select class="form-control" id="country_id" name="country_id" onchange="getState(this.value)" required="">
                                                     <option value="">Select Country</option>
                                                      <?php foreach ($country_list as $country) { ?>
                                                    <option value="<?= $country->country_id ?>" <?php if($user_detail->country_id==$country->country_id) { echo 'selected'; } ?>><?= $country->country_name ?></option>
                                                      <?php } ?>
                                                 </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>State</label>
                                                <select class="form-control state_id" id="state_id" name="state_id" onchange="getCity(this.value)" required="">
                                                     <option value="">Select State</option>
                                                      <?php foreach ($state_list as $state) { ?>
                                                    <option value="<?= $state->state_id ?>" <?php if($user_detail->state_id==$state->state_id) { echo 'selected'; } ?>><?= $state->state_name ?></option>
                                                      <?php } ?>
                                                 </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>City</label>
                                                <select class="form-control"id="city_id" name="city_id" required="">
                                                     <option value="">Select City</option>
                                                      <?php foreach ($city_list as $city) { ?>
                                                    <option value="<?= $city->city_id ?>" <?php if($user_detail->city_id==$city->city_id) { echo 'selected'; } ?>><?= $city->city_name ?></option>
                                                      <?php } ?>
                                                 </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                            <label>Mobile No.</label>
                                            <input type="numeber" class="form-control" placeholder="" name="mobile" value="<?=  $user_detail->mobile ?>" required="" maxlength="10">
                                        </div>
                                          <div class="form-group col-md-4">
                                            <label>Contact No.</label>
                                            <input type="numeber" class="form-control" placeholder="" name="contact_no" value="<?=  $user_detail->contact_no ?>" maxlength="10">
                                        </div>
                                          <div class="form-group col-md-4">
                                            <label>WhatsApp No.</label>
                                            <input type="numeber" class="form-control" placeholder="" name="whatsapp_no" value="<?=  $user_detail->whatsapp_no ?>" maxlength="10">
                                        </div>
                                        <div class="form-group col-md-7">
                                            <label>Email Id</label>
                                            <input type="email" class="form-control" placeholder="" name="email" value="<?=  $user_detail->email ?>" required="">
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label>Rera Registred</label>
                                              <select id="rera_registered" class="form-control"  onchange="ddn();" name="rera_registered">
                                                    <option value="1" <?php if($user_detail->rera_registered==1) { echo 'selected'; } ?>>YES</option>
                                                    <option value="0" <?php if($user_detail->rera_registered==0) { echo 'selected'; } ?>>NO</option>
                                                   
                                                </select>
                                        </div>

<!-------------------------------- on change------------------------------->
                                    <div style="display: none;" id="frm" class="col-md-12 ">

                                         <div class="row">
                                         <div class="form-group col-md-6">
                                                <label>Rera No</label>
                                                <input type="text" class="form-control" placeholder="Please Enter Your Rera No" name="rera_no" value="<?=  $user_detail->rera_no ?>">
                                            </div>
                                             <div class="form-group col-md-6">
                                                <label>DOR</label>
                                                <input type="text" class="form-control mydatepicker" data-date-format='dd-mm-yyyy' placeholder="" name="rera_dor" value="<?=  $user_detail->rera_dor ?>">
                                            </div>
                                             <div class="form-group col-md-6">
                                                <label>Valid Till</label>
                                                <input type="text" class="form-control mydatepicker" data-date-format='dd-mm-yyyy' placeholder="" name="rera_valid_till" value="<?=  $user_detail->rera_valid_till ?>">
                                            </div>


                                            <div class="form-group col-md-6">
                                                <label>Upload Rara Copy</label>
                                                <div>
                                                    <button type="button" class="btn btn-primary btn_rera_image" style="height: calc(2.0625rem + 2px);padding: 0px 10px;" onclick="browseFile('rera_image')">Upload <span class="btn-icon-right"><i class="fa fa-upload"></i></span>
                                                    </button>
                                                </div>
                                                <div class="span_rera_image" style="margin-top: 3px;"></div>
                                                <input type="file" class="form-control input_rera_image" style="display:none;" name="rera_image" accept="image/jpg,image/jpeg,image/png,application/pdf">
                                                <?php if($user_detail && $user_detail->rera_image) { ?>
                                                    <a href="<?= base_url('uploads/images/user/document/'.$user_detail->rera_image) ?>" target="_blank"><!--
                                                     <img src="<?= base_url('uploads/images/user/document/'.$user_detail->rera_image) ?>" style="height: 60px;width: 60px;border: 1px solid #c1cad2;padding: 5px;margin-top: 8px;">--><span style="color: #7571f9;text-decoration: underline;display:inline-block;margin-top:5px;">View File</span></a>
                                                <?php } ?>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 ">
                                        <div class="row">
                                        <div class="form-group col-md-12 non-individual">
                                            <label>Owner Name</label>
                                              <div class="row">
                                                  <div class="col-md-4">
                                                      <select id="inputState" class="form-control" name="owner_title">
                                                            <option selected="selected" value="">Select Title</option>
                                                            <option value="Mr." <?php if($user_detail->owner_title=='Mr.') { echo 'selected'; } ?>>Mr.</option>
                                                            <option value="Ms." <?php if($user_detail->owner_title=='Ms.') { echo 'selected'; } ?>>Ms.</option>
                                                            <option value="Mrs." <?php if($user_detail->owner_title=='Mrs.') { echo 'selected'; } ?>>Mrs.</option>
                                                            <option value="Dr." <?php if($user_detail->owner_title=='Dr.') { echo 'selected'; } ?>>Dr.</option>
                                                            <option value="Prof." <?php if($user_detail->owner_title=='Prof.') { echo 'selected'; } ?>>Prof.</option>
                                                        </select>
                                                  </div>
                                                  <div class="col-md-4">
                                                        <input type="text" class="form-control" placeholder="First Name" name="owner_first_name" value="<?=  $user_detail->owner_first_name ?>">
                                                  </div>
                                                  <div class="col-md-4">
                                                        <input type="text" class="form-control" placeholder="Last Name" name="owner_last_name" value="<?=  $user_detail->owner_last_name ?>">
                                                  </div>
                                              </div>
                                        </div>

                                            <div class="form-group col-md-4 individual">
                                                <label>Upload Photo</label>
                                                <div>
                                                    <button type="button" class="btn btn-primary btn_image" style="height: calc(2.0625rem + 2px);padding: 0px 10px;" onclick="browseFile('image')">Upload <span class="btn-icon-right"><i class="fa fa-upload"></i></span>
                                                    </button>
                                                </div>
                                                <div class="span_image" style="margin-top: 3px;"></div>

                                                <input type="file" class="form-control input_image" style="display:none;" name="image" accept="image/jpg,image/jpeg,image/png">
                                                <?php if($user_detail && $user_detail->image) { ?>
                                                    <a href="<?= base_url('uploads/images/user/photo/'.$user_detail->image) ?>" target="_blank">
                                                    <!-- <img src="<?= base_url('uploads/images/user/photo/'.$user_detail->image) ?>" style="height: 60px;width: 60px;border: 1px solid #c1cad2;padding: 5px;margin-top: 8px;">--><span style="color: #7571f9;text-decoration: underline;display:inline-block;margin-top:5px;">View File</span></a>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-md-4 non-individual">
                                                <label>Upload Logo</label>
                                                <div>
                                                    <button type="button" class="btn btn-primary btn_logo" style="height: calc(2.0625rem + 2px);padding: 0px 10px;" onclick="browseFile('logo')">Upload <sadhar class="btn-icon-right"><i class="fa fa-upload"></i></sadhar>
                                                    </button>
                                                </div>
                                                <div class="sadhar_logo" style="margin-top: 3px;"></div>
                                                <input type="file" class="form-control input_logo" style="display:none;" name="logo" accept="image/jpg,image/jpeg,image/png">
                                                <?php if($user_detail && $user_detail->logo) { ?>
                                                    <a href="<?= base_url('uploads/images/user/logo/'.$user_detail->logo) ?>" target="_blank">
                                                     <!--<img src="<?= base_url('uploads/images/user/logo/'.$user_detail->logo) ?>" style="height: 60px;width: 60px;border: 1px solid #c1cad2;padding: 5px;margin-top: 8px;">--><span style="color: #7571f9;text-decoration: underline;display:inline-block;margin-top:5px;">View File</span></a>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-md-12 non-individual">
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label>Mobile No.</label>
                                                        <input type="numeber" class="form-control" placeholder="" name="owner_mobile" value="<?=  $user_detail->owner_mobile ?>" maxlength="10">
                                                    </div>
                                                      <div class="form-group col-md-4">
                                                        <label>Contact No.</label>
                                                        <input type="numeber" class="form-control" placeholder="" name="owner_contact_no" value="<?=  $user_detail->owner_contact_no ?>" maxlength="10">
                                                    </div>
                                                      <div class="form-group col-md-4">
                                                        <label>WhatsApp No.</label>
                                                        <input type="numeber" class="form-control" placeholder="" name="owner_whatsapp_no" value="<?=  $user_detail->owner_whatsapp_no ?>" maxlength="10">
                                                    </div>
                                                </div>
                                            </div>

                                              
                                            <div class="form-group col-md-12 ">
                                                <h4 style="margin: 0px;">KYC</h4>
                                            </div>
                                            <div class="form-group col-md-3 non-individual">
                                                <label>CIN NO.</label>
                                                <input type="text" class="form-control" name="cin_no" value="<?=  $user_detail->cin_no ?>">
                                            </div>
                                            <div class="form-group col-md-3 non-individual">
                                                <label>Upload CIN Copy</label>
                                                <div>
                                                    <button type="button" class="btn btn-primary btn_cin_image" style="height: calc(2.0625rem + 2px);padding: 0px 10px;" onclick="browseFile('cin_image')">Upload <span class="btn-icon-right"><i class="fa fa-upload"></i></span>
                                                    </button>
                                                </div>
                                                <div class="span_cin_image" style="margin-top: 3px;"></div>
                                                <input type="file" class="form-control input_cin_image" style="display:none;" name="cin_image" accept="image/jpg,image/jpeg,image/png,application/pdf">
                                                <?php if($user_detail && $user_detail->cin_image) { ?>
                                                    <a href="<?= base_url('uploads/images/user/document/'.$user_detail->cin_image) ?>" target="_blank">
                                                     <!--<img src="<?= base_url('uploads/images/user/document/'.$user_detail->cin_image) ?>" style="height: 60px;width: 60px;border: 1px solid #c1cad2;padding: 5px;margin-top: 8px;">--><span style="color: #7571f9;text-decoration: underline;display:inline-block;margin-top:5px;">View File</span></a>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group col-md-3 non-individual">
                                                <label>TAN NO.</label>
                                                <input type="text" class="form-control" name="tan_no" value="<?=  $user_detail->tan_no ?>">
                                            </div>
                                            <div class="form-group col-md-3 non-individual">
                                                <label>Upload TAN Copy</label>
                                                <div>
                                                    <button type="button" class="btn btn-primary btn_tan_image" style="height: calc(2.0625rem + 2px);padding: 0px 10px;" onclick="browseFile('tan_image')">Upload <span class="btn-icon-right"><i class="fa fa-upload"></i></span>
                                                    </button>
                                                </div>
                                                <div class="span_tan_image" style="margin-top: 3px;"></div>
                                                <input type="file" class="form-control input_tan_image" style="display:none;" name="tan_image" accept="image/jpg,image/jpeg,image/png,application/pdf">
                                                <?php if($user_detail && $user_detail->tan_image) { ?>
                                                    <a href="<?= base_url('uploads/images/user/document/'.$user_detail->tan_image) ?>" target="_blank">
                                                     <!--<img src="<?= base_url('uploads/images/user/document/'.$user_detail->tan_image) ?>" style="height: 60px;width: 60px;border: 1px solid #c1cad2;padding: 5px;margin-top: 8px;">--><span style="color: #7571f9;text-decoration: underline;display:inline-block;margin-top:5px;">View File</span></a>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group col-md-3 ">
                                                <label>PAN NO.</label>
                                                <input type="text" class="form-control" name="pan_no" value="<?=  $user_detail->pan_no ?>">
                                            </div>
                                            <div class="form-group col-md-3 ">
                                                <label>Upload Pan Copy</label>
                                                <div>
                                                    <button type="button" class="btn btn-primary btn_pan_image" style="height: calc(2.0625rem + 2px);padding: 0px 10px;" onclick="browseFile('pan_image')">Upload <span class="btn-icon-right"><i class="fa fa-upload"></i></span>
                                                    </button>
                                                </div>
                                                <div class="span_pan_image" style="margin-top: 3px;"></div>
                                                <input type="file" class="form-control input_pan_image" style="display:none;" name="pan_image" accept="image/jpg,image/jpeg,image/png,application/pdf">
                                                <?php if($user_detail && $user_detail->pan_image) { ?>
                                                    <a href="<?= base_url('uploads/images/user/document/'.$user_detail->pan_image) ?>" target="_blank">
                                                     <!--<img src="<?= base_url('uploads/images/user/document/'.$user_detail->pan_image) ?>" style="height: 60px;width: 60px;border: 1px solid #c1cad2;padding: 5px;margin-top: 8px;">--><span style="color: #7571f9;text-decoration: underline;display:inline-block;margin-top:5px;">View File</span></a>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group col-md-3 ">
                                                <label>GST No</label>
                                                <input type="numeber" class="form-control" name="gst_no" value="<?=  $user_detail->gst_no ?>">
                                            </div>
                                             <div class="form-group col-md-3 ">
                                                <label>Upload GST Copy</label>
                                                <div>
                                                    <button type="button" class="btn btn-primary btn_gst_image" style="height: calc(2.0625rem + 2px);padding: 0px 10px;" onclick="browseFile('gst_image')">Upload <sgst class="btn-icon-right"><i class="fa fa-upload"></i></sgst>
                                                    </button>
                                                </div>
                                                <div class="sgst_gst_image" style="margin-top: 3px;"></div>
                                                <input type="file" class="form-control input_gst_image" style="display:none;" name="gst_image" accept="image/jpg,image/jpeg,image/png,application/pdf">
                                                <?php if($user_detail && $user_detail->gst_image) { ?>
                                                    <a href="<?= base_url('uploads/images/user/document/'.$user_detail->gst_image) ?>" target="_blank">
                                                     <!--<img src="<?= base_url('uploads/images/user/document/'.$user_detail->gst_image) ?>" style="height: 60px;width: 60px;border: 1px solid #c1cad2;padding: 5px;margin-top: 8px;">--><span style="color: #7571f9;text-decoration: underline;display:inline-block;margin-top:5px;">View File</span></a>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group col-md-3 ">
                                                <label>Adhar No</label>
                                                <input type="numeber" class="form-control" name="adhar_no" value="<?=  $user_detail->adhar_no ?>">
                                            </div>
                                             <div class="form-group col-md-3 ">
                                                <label>Upload Adhar Copy</label>
                                                <div>
                                                    <button type="button" class="btn btn-primary btn_adhar_image" style="height: calc(2.0625rem + 2px);padding: 0px 10px;" onclick="browseFile('adhar_image')">Upload <sadhar class="btn-icon-right"><i class="fa fa-upload"></i></sadhar>
                                                    </button>
                                                </div>
                                                <div class="sadhar_adhar_image" style="margin-top: 3px;"></div>
                                                <input type="file" class="form-control input_adhar_image" style="display:none;" name="adhar_image" accept="image/jpg,image/jpeg,image/png,application/pdf">
                                                <?php if($user_detail && $user_detail->adhar_image) { ?>
                                                    <a href="<?= base_url('uploads/images/user/document/'.$user_detail->adhar_image) ?>" target="_blank">
                                                     <!--<img src="<?= base_url('uploads/images/user/document/'.$user_detail->adhar_image) ?>" style="height: 60px;width: 60px;border: 1px solid #c1cad2;padding: 5px;margin-top: 8px;">--><span style="color: #7571f9;text-decoration: underline;display:inline-block;margin-top:5px;">View File</span></a>
                                                <?php } ?>
                                            </div>
                                     </div>
                                 </div>
<!-------------------------------- on change------------------------------->

                                        </div>
                                       
                                        <button type="submit" class="btn btn-dark form-btn" style="width: 100px;">SAVE</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('public/admin/') ?>plugins/common/common.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>js/custom.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>

<script>
ddn();
function ddn(){
    if($("#rera_registered").val()=='1'){
    document.getElementById('frm').style.display="block";
}else{
     document.getElementById('frm').style.display="none";
   
}
}

</script>

<script>
    individualStatus();
    function individualStatus() {
        if ($('input[name=is_individual]:checked').val() == '1') {
            $(".individual").show();
            $(".non-individual").hide();
            $(".individual_val").prop('required',true);
            $(".non_individual_val").prop('required',false);
        }
        else if ($('input[name=is_individual]:checked').val() == '0') {
            
            $(".individual").hide();
            $(".non-individual").show();
            $(".individual_val").prop('required',false);
            $(".non_individual_val").prop('required',true);
        }
    }
$('input[type=radio][name=is_individual]').change(function() {
    individualStatus();
});
$('.mydatepicker').datepicker();
function alertMessage(type,message) {
  if (type=='error') {
    type = 'danger';
  }

  return "<div class='alert alert-"+type+" alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "+message+" </div>";
}

 $("#accociate-form").validate({
    rules: {
        mobile:{
            number: true,
            minlength:10
        },
        whatsapp_no:{
            number: true,
            minlength:10
        },
        contact_no:{
            number: true,
            minlength:10
        },
        owner_mobile:{
            number: true,
            minlength:10
        },
        owner_whatsapp_no:{
            number: true,
            minlength:10
        },
        owner_contact_no:{
            number: true,
            minlength:10
        },
    },
    messages: {
        mobile:{
            minlength: 'Enter Valid 10 Digit No',
        },
        whatsapp_no:{
            minlength: 'Enter Valid 10 Digit No',
        },
        contact_no:{
            minlength: 'Enter Valid 10 Digit No',
        },
        owner_mobile:{
            minlength: 'Enter Valid 10 Digit No',
        },
        owner_whatsapp_no:{
            minlength: 'Enter Valid 10 Digit No',
        },
        owner_contact_no:{
            minlength: 'Enter Valid 10 Digit No',
        }
    },
    submitHandler: function(form) {
      var myform = document.getElementById("accociate-form");
      var fd = new FormData(myform );

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'/associate_save') ?>",
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
                $(".form-btn").html("Save").prop('disabled',false);

                if (obj.status=='success') {
                  //$(".error-msg").html(alertMessage('success',obj.message));

                  window.location.href='<?= base_url(AGENT_URL.'login?as=1') ?>';
                }
                else {
                  $(".error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".form-btn").html("Save").prop('disabled',false);
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

function getState(country_id) {

  $.ajax({
        type: "POST",
        url: "<?= base_url('get_state') ?>",
        data: {country_id:country_id,l:1},
        beforeSend: function (data) {
        },
        success: function (response) {
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status=='success') {
              var state_list = obj.state_list;
              
              var row = "<option value=''>Select State</option>";
              for (var i = 0; i<state_list.length; i++) {
                row += "<option value='"+state_list[i].state_id+"'>"+state_list[i].state_name+"</option>";
              }
              $("#city_id").html("<option value=''>Select City</option>");
              $(".state_id").html(row);
            }
            else {
              $(".state_id").html("<option value=''>Select State</option>");
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

function browseFile(id) {
   $(".input_"+id).click();
   $(".span_"+id).text('');

    $(".input_"+id).change(function(e){
        var fileName = e.target.files[0].name;
        $(".span_"+id).text('Choose file: '+fileName);
    });
}

</script>

</body>
</html>