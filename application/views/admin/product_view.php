<?php include('include/header.php');?>
<style>
@media only screen and (max-width : 576px) {
.mg-10 {
  margin-top: 10px;
}
}
.cp {
    cursor: pointer;
}
.scrollbar {
    overflow-x: scroll !important;
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
.project-image-item-remove {
  color: #fff;
  font: 18px;
  position: absolute;
  right: -10px;
  text-decoration: none;
  text-shadow: 0 1px 0 #fff;
  top: -10px;
  background: red;
  border-radius: 50%;
  height: 20px;
  width: 20px;
  text-align: center;    
  line-height: 19px;
  cursor: pointer;
}

.project-image-item-remove:after {
  content: 'x';
}

.project-image-item {
  border-radius: 0px;
  float: left;
  height: 70px;
  margin: 10px 10px 10px 20px;
  position: relative;
  width: 70px;
}
.project-image-item img {
  border: 1px solid #000;
}
</style>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css">
    <link href="<?php echo base_url('public/admin/') ?>plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
<div class="loader_progress"></div>
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
                                <h4 class="card-title">Product #<?= $id ?></h4>
                                <div class="basic-form">

                                    <div class="error-msg" style="margin-top: 10px;">
                                    </div>
                                    <div class="response-data"></div>
                                    <div class="step-1">
                                    <form method="post" id="step-1-form" enctype="multipart/form-data" autocomplete="off">
                                            <input type="hidden" class="pid" name="id" value="<?php if($id) { echo $id; } ?>">
                                            <div class="form-row">

                                              <div class="form-group col-md-4">
                                                    <label>Group:</label>
                                                    <select class="form-control" id="builder_group_id" name="builder_group_id" onchange="getBuilders(this.value)">
                                                      <option value="">Select Group</option>
                                                      <?php foreach ($builder_group_list as $builder_group) { ?>
                                                        <option value="<?= $builder_group->builder_group_id ?>" <?php if($id && $product_detail->builder_group_id==$builder_group->builder_group_id) { echo 'selected'; } ?> ><?= $builder_group->builder_group_name ?></option>
                                                      <?php } ?>
                                                    </select>
                                              </div>

                                                <div class="form-group col-md-4">
                                                    <label>Builder:</label>
                                                    <select class="form-control" id="builder_id" name="builder_id">
                                                      <option value="">Select Builder</option>
                                                      <?php foreach ($builder_list as $builder) { ?>
                                                        <option value="<?= $builder->builder_id ?>" <?php if($id && $product_detail->builder_id==$builder->builder_id) { echo 'selected'; } ?> ><?= $builder->firm_name ?></option>
                                                      <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label>Agent:</label>
                                                    <select class="form-control" id="agent_id" name="agent_id">
                                                      <option value="">Select Agent</option>
                                                      <?php foreach ($agent_list as $agent) { ?>
                                                        <option value="<?= $agent->user_id ?>" <?php if($id && $product_detail->agent_id==$agent->user_id) { echo 'selected'; } ?> ><?= ($agent->is_individual)?(ucwords($agent->first_name.' '.$agent->last_name)):$agent->firm_name ?></option>
                                                      <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Project Name:</label>
                                                    <input type="text" class="form-control" id="project_name" name="project_name" placeholder="" value="<?php if($id) { echo $product_detail->project_name; } ?>">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Project Status:</label>
                                                    <select class="form-control" id="project_status" name="project_status">
                                                      <option value="">Select Status</option>
                                                      <?php foreach ($project_status_list as $project_status) { ?>
                                                        <option value="<?= $project_status->project_status_id ?>" <?php if($id && $product_detail->project_status==$project_status->project_status_id) { echo 'selected'; } ?> ><?= $project_status->project_status_name ?></option>
                                                      <?php } ?>

                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Rera Application :</label>
                                                    <select class="form-control" id="rera_application" name="rera_application" onchange="reraApplication()">
                                      <option value="not_applicable" <?php if($id && $product_detail->rera_application=='not_applicable') { echo 'selected'; } ?> >Not Applicable</option>
                                      <option value="applied" <?php if($id && $product_detail->rera_application=='applied') { echo 'selected'; } ?> >Applied For</option>
                                                      <option value="registred" <?php if($id && $product_detail->rera_application=='registred') { echo 'selected'; } ?> >Registred</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <div class="input-rera-no" style="display: none;">
                                                        <label>Rera No:</label>
                                                        <input type="text" class="form-control" placeholder="" id="rera_no" name="rera_no" value="<?php if($id) { echo $product_detail->rera_no; } ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Type of Project:</label>
                                                    <select class="form-control" id="project_type" name="project_type" onchange="getUnitTypes()">
                                                          <option value="">Select Project Type</option>
                                                          <?php foreach ($project_type_list as $project_type) { ?>
                                                            <option value="<?= $project_type->product_type_id ?>" <?php if($id && $product_detail->project_type==$project_type->product_type_id) { echo 'selected'; } ?> ><?= $project_type->product_type_name ?></option>
                                                          <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Date of commisment:</label>
                                                    <input type="text" class="form-control mydatepicker" data-date-format='dd-mm-yyyy' placeholder="" id="commisment_date" name="commisment_date" value="<?php if($id) { echo $product_detail->commisment_date; } ?>">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Total Land Area:</label>
                                                    <div class="row">
                                                      <div class="col-md-7 col-sm-7 col-xs-7">
                                                        <input type="text" class="form-control" placeholder="" id="land_area" name="land_area" value="<?php if($id) { echo $product_detail->land_area; } ?>">
                                                      </div>
                                                      <div class="col-md-5 col-sm-5 col-xs-5 mg-10">
                                                        <select class="form-control" id="land_area_unit" name="land_area_unit">
                                                              <option value="">Select Unit</option>
                                                                  <?php foreach ($unit_list as $unit) { ?>
                                                                    <option value="<?= $unit->unit_id ?>" <?php if($id && $product_detail->land_area_unit==$unit->unit_id) { echo 'selected'; } ?> ><?= $unit->unit_name ?></option>
                                                                  <?php } ?>
                                                        </select>
                                                      </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Total Builtup Area:</label>
                                                    <div class="row">
                                                      <div class="col-md-7 col-sm-7 col-xs-7">
                                                        <input type="text" class="form-control" placeholder="" id="buildup_area" name="buildup_area" value="<?php if($id) { echo $product_detail->buildup_area; } ?>">
                                                      </div>
                                                      <div class="col-md-5 col-sm-5 col-xs-5 mg-10">
                                                        <select class="form-control" id="buildup_area_unit" name="buildup_area_unit">
                                                                  <option value="">Select Unit</option>
                                                                  <?php foreach ($unit_list as $unit) { ?>
                                                                    <option value="<?= $unit->unit_id ?>" <?php if($id && $product_detail->buildup_area_unit==$unit->unit_id) { echo 'selected'; } ?> ><?= $unit->unit_name ?></option>
                                                                  <?php } ?>
                                                        </select>
                                                      </div>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-12">
                                                  <h5 style="padding: 0px;margin: 0px;">Land Detail:</h5>
                                              </div>

                                                <div class="form-group col-md-4">
                                                    <label>State:</label>
                                                    <select class="form-control" id="state_id" name="state_id" onchange="getCity(this.value)">
                                                         <option value="">Select State</option>
                                                          <?php foreach ($state_list as $state) { ?>
                                                        <option value="<?= $state->state_id ?>" <?php if($id && $product_detail->state_id==$state->state_id) { echo 'selected'; } ?>><?= $state->state_name ?></option>
                                                          <?php } ?>
                                                     </select>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label>City:</label>
                                                    <select class="form-control" id="city_id" name="city_id" onchange="getLocation(this.value)">
                                                         <option value="">Select City</option>
                                                          <?php foreach ($city_list as $city) { ?>
                                                        <option value="<?= $city->city_id ?>" <?php if($id && $product_detail->city_id==$city->city_id) { echo 'selected'; } ?>><?= $city->city_name ?></option>
                                                          <?php } ?>
                                                     </select>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label>Location:</label>

                                                    <select class="form-control"id="location" name="location">
                                                         <option value="">Select Location</option>
                                                          <?php foreach ($location_list as $location) { ?>
                                                        <option value="<?= $location->location_id ?>" <?php if($id && $product_detail->location==$location->location_id) { echo 'selected'; } ?>><?= $location->location_name ?></option>
                                                          <?php } ?>
                                                     </select>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label>Address:</label>
                                                    <textarea class="form-control" rows="2" placeholder="" id="address1" name="address1" ><?php if($id) { echo $product_detail->address1; } ?></textarea>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Latitude:</label>
                                                    <input type="text" class="form-control" placeholder="" id="lattitude" name="lattitude" value="<?php if($id) { echo $product_detail->lattitude; } ?>">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Longitude:</label>
                                                    <input type="text" class="form-control" placeholder="" id="longitude" name="longitude" value="<?php if($id) { echo $product_detail->longitude; } ?>">
                                                </div>

                                                <div class="form-group col-md-6 PropertyHide">
                                                    <label>Type of Property:</label>
                                                    
                                                <select class="form-control" id="property_type" name="property_type" onchange="propertType('2')">
                                                          <option value="">Select Property Type</option>
                                                          <?php foreach ($unit_type_list as $unit_type) { ?>
                                                            <option value="<?= $unit_type->unit_type_id ?>" <?php if($id && $product_detail->property_type==$unit_type->unit_type_id) { echo 'selected'; } ?> ><?= $unit_type->unit_type_name ?></option>
                                                          <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-12">

                                                <div class="comm_detail_main" style="display: none;">
                                                  <div class="table-responsive scrollbar">          
                                                    <table class="table table-bordered">
                                                      <thead>
                                                        <tr>
                                                          <th></th>
                                                          <th>Block </th>
                                                          <th>No of Floor</th>
                                                          <th>Unit Per Floor</th>
                                                          <th>No Of Passanger Lift</th>
                                                          <th>No. Of Service Lift</th>
                                                          <th>E D P</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody class="comm_block_detail">
                                                      </tbody>
                                                    </table>
                                                  </div>

                                                  <div class="table-responsive scrollbar">          
                                                    <table class="table table-bordered">
                                                      <thead>
                                                        <tr>
                                                          <th></th>
                                                          <th>Unit Code </th>
                                                          <th>No of Unit</th>
                                                          <th>C.A.</th>
                                                          <th>B.A.</th>
                                                          <th>S.A.</th>
                                                          <th>Unit</th>
                                                          <th>Dimension(Ft)</th>
                                                          <th>Sub Category</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody class="comm_detail">
                                                      </tbody>
                                                    </table>
                                                  </div>
                                                </div>

                                                    <div class="property-type-flat" style="display: none;">

                                                        <h5>Block Details (Flat & Builder Floor)</h5>

                                                        <div class="table-responsive scrollbar">          
                                                          <table class="table table-bordered">
                                                            <thead>
                                                              <tr>
                                                                <th></th>
                                                                <th>Block/Tower </th>
                                                                <th>No of Floor</th>
                                                                <th>No of Flat</th>
                                                                <th>Unit Per Floor</th>
                                                                <th>No Of Passanger Lift</th>
                                                                <th>No. Of Service Lift</th>
                                                                <th>E D P</th>
                                                              </tr>
                                                            </thead>
                                                            <tbody class="flat_block_detail">
                                                            </tbody>
                                                          </table>
                                                        </div>

                                                        <h5 style="margin-top: 15px;">Unit Details (Flat & Builder Floor)</h5>

                                                        <div class="table-responsive scrollbar">          
                                                          <table class="table table-bordered">
                                                            <thead>
                                                              <tr>
                                                                <th>&nbsp;  </th>
                                                                <th>Unit Code </th>
                                                                <th>Nos. Of Unit</th>
                                                                <th>C.A.</th>
                                                                <th>B.A.</th>
                                                                <th>S.A.</th>
                                                                <th>Unit</th>
                                                                <th>NO of Bedroom</th>
                                                                <th>No of Bathroom</th>
                                                                <th>Accomodation</th>
                                                                <th>Basic Cost</th>
                                                                <th>Club Membership Charges</th>
                                                                <th>Upload</th>

                                                              </tr>
                                                            </thead>
                                                            <tbody class="flat_unit_detail">
                                                              <!--<tr>
                                                                <td><div class="flat_unit_detail_<?= time() ?>"><i class="fa fa-plus-circle cp" aria-hidden="true" onclick="addRow('flat_unit_detail_<?= time() ?>','flat_unit_detail')"></i> <i class="fa fa-minus-circle text-danger cp" style="display: none;" aria-hidden="true" onclick="removeRow('flat_unit_detail_<?= time() ?>')"></i></div></td>
                                                                <td><input class="form-control" type="text" name="unit[0][no_of_unit]" style="width:80px;"></td>
                                                                <td><input class="form-control" type="text" name="unit[0][ca]" style="width:80px;"></td>
                                                                <td><input class="form-control" type="text" name="unit[0][ba]" style="width:80px;"></td>
                                                                <td><input class="form-control" type="text" name="unit[0][sa]" style="width:80px;"></td>
                                                                <td><input class="form-control" type="text" name="unit[0][no_of_bedroom1]" style="width:80px;"></td>
                                                                <td><input class="form-control" type="text" name="unit[0][no_of_bathroom1]" style="width:80px;"></td>
                                                                <td><select class="form-control" id="accom" name="unit[0][accomodation]">
                                                                  <option> Select Accomodation </option>
                                                                              <option value="1 BHK">1 BHK</option>
                                                                              <option value="2 BHK">2 BHK</option>
                                                                              <option value="3 BHK">3 BHK</option>
                                                                              <option value="4 BHK">4 BHK</option>
                                                                              <option value="3 BHK + Servant ">3 BHK + Servant </option>
                                                                          </select></td>
                                                                <td><input class="form-control" type="text" name="unit[0][basic_cost]" style="width:80px;"></td>
                                                                <td><input class="form-control" type="text" name="unit[0][charges]" style="width:80px;"></td>
                                                                <td><input class="form-control" style="width: 230px;" type="file" name="image_0"></td>
                                                              </tr>-->
                                                            </tbody>
                                                          </table>
                                                        </div>
                                                    </div>

                                                    <div class="property-type-villa" style="display: none;">
                                                        <h5>Property Details</h5>

                                                        <div class="table-responsive scrollbar">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                  <tr>
                                                                    <th>&nbsp;  </th>
                                                                    <th>Unit Code </th>
                                                                    <th>Plot Size (Sq.Yd.)</th>
                                                                    <th>Dimension (Ft)</th>
                                                                    <th>Facing</th>
                                                                    <th>NO of Unit</th>
                                                                    <th>Accomodation</th>
                                                                    <th>No of Floor</th>
                                                                    <th>Constuction Area</th>
                                                                    <th>NO of Bedroom</th>
                                                                    <th>No of Bathroom</th>
                                                                    <th>Basic Cost</th>
                                                                    <th>Club Membership Charges</th>
                                                                    <th>Upload</th>
                                                                  </tr>
                                                                </thead>
                                                                <tbody class="villa_detail">
                                                                  <!--<tr>
                                                                    <td><div class="villa_detail_<?= time() ?>"><i class="fa fa-plus-circle cp" aria-hidden="true" onclick="addRow('villa_detail_<?= time() ?>','villa_detail')"></i> <i class="fa fa-minus-circle text-danger cp" style="display: none;" aria-hidden="true" onclick="removeRow('villa_detail_<?= time() ?>')"></i></div></td>
                                                                    <td>
                                                                    <div class="row" style="width: 330px;">
                                                                        <div class="col-md-6">
                                                                            <input class="form-control unit-select" type="text" name="unit[0][plot_size]" style="">
                                                                        </div>
                                                                        <div class="col-md-6"><select class="form-control unit-select" id="unit" name="unit[0][plot_unit]" style="">
                                                                             <option value="Select Unit">Select Unit</option>
                                                                                                <option value="Sq.Yd">Sq.Yd</option>
                                                                                                <option value="Sq.Ft">Sq.Ft</option>
                                                                                                <option value="Bigha">Bigha</option>
                                                                                                <option value="Sq.Mtr">Sq.Mtr</option>
                                                                                                <option value="Fix">Fix</option>
                                                                                                <option value="% of BSP">% of BSP</option>
                                                                                                <option value="Acres">Acres</option>
                                                                                              </select>
                                                                        </div>
                                                                    </div>
                                                                    </td>
                                                                    <td><input class="form-control" type="text" name="unit[0][dimension]" style="width: 120px;"></td>
                                                                    <td>
                                                                    <select class="form-control unit-select" id="facing" name="unit[0][facing]" style="width: 120px;">
                                                                                   <option value="north">north</option>
                                                                                  <option value="North">North</option>
                                                                                  <option value="East">East</option>
                                                                                  <option value="West">West</option>
                                                                                  <option value="South">South</option>
                                                                                  <option value="North-East">North-East</option>
                                                                                  <option value="North-West">North-West</option>
                                                                                  <option value="South-East">South-East</option>
                                                                                  <option value="South-West">South-West</option>
                                                                              </select>
                                                                    </td>
                                                                    <td><input class="form-control" type="text" name="unit[0][no_of_unit]" style="width: 80px;"></td>
                                                                    <td><select class="form-control" id="accom" name="unit[0][accomodation]" style="width: 180px;">
                                                                      <option> Select Accomodation </option>
                                                                                  <option value="1 BHK">1 BHK</option>
                                                                                  <option value="2 BHK">2 BHK</option>
                                                                                  <option value="3 BHK">3 BHK</option>
                                                                                  <option value="4 BHK">4 BHK</option>
                                                                                  <option value="3 BHK + Servant ">3 BHK + Servant </option>
                                                                              </select></td>
                                                                    <td><input class="form-control" type="text" name="unit[0][no_of_floor]" style="width: 120px;"></td>
                                                                    <td>
                                                                        <div class="row" style="width: 330px;">
                                                                            <div class="col-md-6">
                                                                                <input class="form-control unit-select" type="text" name="unit[0][construction_area1]" >
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <select class="form-control unit-select" id="unit" name="unit[0][con_unit]">
                                                                                     <option value="Select Unit">Select Unit</option>
                                                                                                        <option value="Sq.Yd">Sq.Yd</option>
                                                                                                        <option value="Sq.Ft">Sq.Ft</option>
                                                                                                        <option value="Bigha">Bigha</option>
                                                                                                        <option value="Sq.Mtr">Sq.Mtr</option>
                                                                                                        <option value="Fix">Fix</option>
                                                                                                        <option value="% of BSP">% of BSP</option>
                                                                                                        <option value="Acres">Acres</option>
                                                                                              </select>
                                                                                          </div>
                                                                                      </div>
                                                                    </td>
                                                                    <td><input class="form-control" type="text" name="unit[0][no_of_bedroom1]" style="width: 100px;"></td>
                                                                    <td><input class="form-control" type="text" name="unit[0][no_of_bathroom1]" style="width: 100px;"></td>
                                                                    <td><input class="form-control" type="text" name="unit[0][basic_cost]" style="width: 100px;"></td>
                                                                    <td><input class="form-control" type="text" name="unit[0][charges]" style="width: 100px;"></td>
                                                                    <td><input class="form-control" style="width: 230px;" type="file" name="villa_image_0"></td>
                                                                  </tr>-->
                                                                </tbody>
                                                              </table>
                                                        </div>
                                                    </div>

                                                    <div class="property-type-plot" style="display: none;">
                                                        <h5>Property Details</h5>

                                                        <div class="table-responsive scrollbar">

                                                            <table class="table table-bordered">
                                                                <thead>
                                                                  <tr>
                                                                    <th>&nbsp;  </th>
                                                                    <th>Unit Code </th>
                                                                    <th>Plot Size (Sq.Yd.)</th>
                                                                    <th>Dimension (Ft)</th>
                                                                    <th>Facing</th>
                                                                    <th>NO of Unit</th>
                                                                    <th>Basic Cost</th>
                                                                    <th>Club Cost</th>
                                                                    <th>Upload</th>
                                                                  </tr>
                                                                </thead>
                                                                <tbody class="plot_detail">
                                                                  <!--<tr>
                                                                    <td><div class="plot_detail_<?= time() ?>"><i class="fa fa-plus-circle cp" aria-hidden="true" onclick="addRow('plot_detail_<?= time() ?>','plot_detail')"></i> <i class="fa fa-minus-circle text-danger cp" style="display: none;" aria-hidden="true" onclick="removeRow('plot_detail_<?= time() ?>')"></i></div></td>
                                                                   
                                                                    <td>
                                                                        <div class="row" style="width: 330px;">
                                                                            <div class="col-md-6">
                                                                                <input class="form-control unit-select" type="text" name="unit[0][plot_size]">
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <select class="form-control unit-select" id="unit" name="unit[0][plot_unit]">
                                                                                         <option value="Select Unit">Select Unit</option>
                                                                                                            <option value="Sq.Yd">Sq.Yd</option>
                                                                                                            <option value="Sq.Ft">Sq.Ft</option>
                                                                                                            <option value="Bigha">Bigha</option>
                                                                                                            <option value="Sq.Mtr">Sq.Mtr</option>
                                                                                                            <option value="Fix">Fix</option>
                                                                                                            <option value="% of BSP">% of BSP</option>
                                                                                                            <option value="Acres">Acres</option>
                                                                                                          </select>
                                                                              </div>
                                                                          </div>
                                                                  </td>
                                                                    <td><input class="form-control" type="text" name="unit[0][dimension]" style="width: 100px;"></td>
                                                                    <td>
                                                                    <select class="form-control unit-select" name="unit[0][facing]" id="facing" style="width: 150px;">
                                                                     
                                                                    <option value="north">north</option>
                                                                   
                                                                    <option value="North">North</option>
                                                                   
                                                                    <option value="East">East</option>
                                                                   
                                                                    <option value="West">West</option>
                                                                   
                                                                    <option value="South">South</option>
                                                                   
                                                                    <option value="North-East">North-East</option>
                                                                   
                                                                    <option value="North-West">North-West</option>
                                                                   
                                                                    <option value="South-East">South-East</option>
                                                                   
                                                                    <option value="South-West">South-West</option>
                                                                          </select>
                                                                    </td>
                                                                    <td><input class="form-control" type="text" name="unit[0][no_of_unit]" style="width: 100px;"></td>
                                                                    <td><input class="form-control" type="text" name="unit[0][basic_cost]" style="width: 100px;"></td>
                                                                     <td><input class="form-control" type="text" name="unit[0][charges]" style="width: 100px;"></td>
                                                                    <td><input class="form-control" style="width: 230px;" type="file" name="plot_image_0" style="width: 100px;"></td>
                                                                  </tr>-->
                                                                </tbody>
                                                              </table>

                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <div align="right">
                                              <button type="submit" class="btn btn-dark">Next</button>
                                            </div>
                                        </form>

                                        </div>

                                        <div class="step-2" style="display: none;">

<form id="step-2-form" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" class="pid" name="id" value="<?php if($id) { echo $id; } ?>">
<fieldset id="f2" style="display: block;">
   <div class="row">
      <div class="col-md-6 col-sm-6">
         <div class="form-group">
            <div class="row">
               <div class="col-md-12">
                  <h4>Basic Comp</h4>
               </div>
               <div class="col-md-8 col-sm-8 col-xs-8">
                  <label for="area">Basic Cost:</label>
                  <select class="form-control" id="b_cost_unit" name="b_cost_unit">
                     <option value="">Select Unit</option>
                     <?php foreach ($unit_list as $unit) { ?>
                        <option value="<?= $unit->unit_id ?>"><?= $unit->unit_name ?></option>
                     <?php } ?>
                  </select>
               </div>
               <div class="col-md-4 col-sm-4 col-xs-4">
                  <label><input class="checkgst" type="checkbox" id="b_cost_gst_check" name="b_cost_gst_check" value="1"> &nbsp;&nbsp;GST</label>
                  <div id="dvGst" style="">
                     <input class="form-control input_b_cost_gst_check" type="text" id="b_cost_gst" style="display: none;" placeholder="Enter GST value" name="b_cost_gst">
                  </div>

               </div>
               <div class="col-md-8 col-sm-8 col-xs-8" style="margin-top: 10px;">
                  <label for="area">Club Cost Unit:</label>
                  <select class="form-control" id="club_cost_unit" name="club_cost_unit">
                     <option value="">Select Unit</option>
                     <?php foreach ($unit_list as $unit) { ?>
                        <option value="<?= $unit->unit_id ?>"><?= $unit->unit_name ?></option>
                     <?php } ?>
                  </select>
               </div>
               <div class="col-md-4 col-sm-4 col-xs-4" style="margin-top: 10px;">
                  <label><input class="checkgst" type="checkbox" id="club_gst_check" name="club_gst_check" value="1"> &nbsp;&nbsp;GST</label>
                  <div id="dvGst_club" style="">
                     <input class="form-control input_club_gst_check" type="text" id="club_gst" style="display: none;" placeholder="Enter GST value" name="club_gst">
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-6 col-sm-6">
         <div class="row">
            <div class="col-md-12">
               <h4>Parking:</h4>
            </div>
            <div class="col-md-8 col-sm-8 col-xs-8">
               <div class="row">
                  <div class="col-md-12 col-sm-12">
                     <div class="form-group">
                         <label class="radio-inline">
                         <input type="checkbox" name="parking_open" id="parking_open" value="1">&nbsp;&nbsp;Open</label>
                        <input type="text" class="form-control" name="o_price" id="o_price" placeholder="Price">
                     </div>
                     <div class="form-group">
                         <label class="radio-inline">
                         <input type="checkbox" name="parking_stilt" id="parking_stilt" value="1">&nbsp;&nbsp;Stilt</label>
                        <input type="text" class="form-control" name="s_price" id="s_price" placeholder="Price">
                     </div>
                     <div class="form-group">
                         <label class="radio-inline">
                         <input type="checkbox" name="parking_basment" id="parking_basment" value="1">&nbsp;&nbsp;Basment</label>
                        <input type="text" class="form-control" name="b_price" id="b_price" placeholder="Price">
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4 padding-left-none">
               <label><input class="checkgst" type="checkbox" id="parking_gst_check" name="parking_gst_check" value="1"> &nbsp;&nbsp;GST</label>
               <div id="dvGstPrice" style="">
                  <input class="form-control input_parking_gst_check" type="text" id="parking_gst" style="display: none;" placeholder="Enter GST value" name="parking_gst">
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-12">
         <h4>Additional</h4>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="form-group">
            <div class="input_fields_additional">
               
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-12">
         <h4>PLC</h4>
      </div>
      <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="form-group">
            
            <div class="input_fields_plc">
               
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-6">
         <div class="form-group">
            <div><label for="area">Amenities:</label></div>
            <div class="fstElement fstMultipleMode fstNoneSelected">
               <!--<div class="fstControls"><input class="fstQueryInput fstQueryInputExpanded" style="" placeholder="Choose option"></div>-->
               <select class="multipleSelect form-control" multiple="" name="amenitie[]" id="select_amenitie" style="width: 100%;">
                  <option value="">Select Amenities</option>
                  <?php foreach ($amenitie_list as $amenitie) { ?>
                        <option value="<?= $amenitie->amenitie_id ?>"><?= $amenitie->amenitie_name ?></option>
                     <?php } ?>
               </select>
            </div>
         </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
            <label for="area">Finance Option:</label>
            <div class="fstElement fstMultipleMode fstNoneSelected">
               <!--<div class="fstControls"><input class="fstQueryInput fstQueryInputExpanded" style="" placeholder="Choose option"></div>-->
               <select class="multipleSelect form-control" multiple="" name="finance[]" id="select_finance" style="width: 100%;">
                  <option value="">Select finance type</option>

                     <?php foreach ($finance_list as $finance) { ?>
                        <option value="<?= $finance->finance_id ?>"><?= $finance->finance_name ?></option>
                     <?php } ?>
               </select>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-12">
         <h4>Specification</h4>
         <div class="form-group">
            <div class="input_fields_specification">
               
            </div>
         </div>
      </div>
   </div>
</fieldset>

<div align="right">
    <button type="button" class="btn btn-dark" onclick="step2Prev()">Previous</button>
    &nbsp;
    <button type="submit" class="btn btn-dark form-btn-2">Next</button>
</div>

</form>
                                        </div>

                                        <div class="step-3" style="display: none;">
<form id="step-3-form" enctype="multipart/form-data" autocomplete="off">
<input type="hidden" class="pid" name="id" value="<?php if($id) { echo $id; } ?>">
   <div class="row">
      <div class="col-md-12">
         <h4>Project overview</h4>
      </div>
   </div>
   <div class="row">
      <div class="col-md-6 col-sm-6 col-xs-12">
         <div class="form-group">
            <label for="area">Approved By:</label>
            <select class="form-control" id="authority_approval" name="authority_approval">
              <option value="0">Select Authority</option>
             <?php foreach ($authority_list as $authority) { ?>
                <option value="<?= $authority->authority_id ?>"><?= $authority->authority_name ?></option>
             <?php } ?>
           </select>
         </div>
      </div>
      <div class="col-md-3 col-sm-3 col-xs-6">
         <div class="form-group">
            <div>
               <label for="usr">CC Certificate* :</label>
            </div>
            <label class="radio-inline">
            <input type="radio" value="1" name="cc_certificate">
            Yes </label>
            <label class="radio-inline">
            <input type="radio" value="0" name="cc_certificate">
            No </label>
         </div>
      </div>
      <div class="col-md-3 col-sm-3 col-xs-6">
         <div class="form-group">
            <div>
               <label for="usr">OC Certificate* :</label>
            </div>
            <label class="radio-inline">
            <input type="radio" value="1" name="oc_certificate">
            Yes </label>
            <label class="radio-inline">
            <input type="radio" value="0" name="oc_certificate">
            No </label>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-6">
         <div class="form-group">
            <label for="title">About Project:</label>
            <textarea class="form-control custom-textarea" id="description" name="description" rows="4"></textarea>
         </div>
      </div>
      <div class="col-md-6">
         <!--<div class="form-group">
            <div><label for="area">Payment Plans:</label></div>
            <div class="fstElement fstMultipleMode fstNoneSelected">
               <select class="multipleSelect form-control" multiple="" name="plans[]" id="payment_plans">
                  <option value="Construction Link Payment Plan">Construction Link Payment Plan</option>
               </select>
            </div>
         </div>-->
      </div>
   </div>
   <div class="row">
      <div class="col-md-6">
         <h4>Properties Images</h4>
         <div class="form-group">
            <div class="input_fields_property_image">
               
            </div>

            <div class="error-msg-img"></div>

            <div id="project_upload_images">
               
            </div>
         </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="row">
              <div class="col-md-12">
                 <h4>Project Logo</h4>
                 <div class="form-group">
                    <!--<label for="title">Upload image:</label>-->
                    <input type="file" name="project_logo" id="project_logo" class="form-control input_logo" style="display: none;" accept="image/jpg,image/jpeg,image/png">
                    <div> <button type='button' class='btn btn-primary btn_logo btn-block' style='height: calc(2.0625rem + 2px);padding: 0px 10px;' onclick="browseFile('logo')"><i class='fa fa-upload'></i> &nbsp;Upload</button> </div><div class='span_logo' style='margin-top: 3px;'></div>
                    <div id="project_logo_view">
                    </div>
                 </div>
              </div>
              <div class="col-md-12">
                 <h4>Banner Image</h4>
                 <div class="form-group">
                    <!--<label for="title">Upload image:</label>-->
                    <input type="file" name="banner_image" id="banner_image" class="form-control input_banner" style="display: none;" accept="image/jpg,image/jpeg,image/png">
                    <div> <button type='button' class='btn btn-primary btn_banner btn-block' style='height: calc(2.0625rem + 2px);padding: 0px 10px;' onclick="browseFile('banner')"><i class='fa fa-upload'></i> &nbsp;Upload</button> </div><div class='span_banner' style='margin-top: 3px;'></div>
                    <div id="banner_image_view">
                    </div>
                 </div>
              </div>
          </div>
      </div>
   </div>

                                                <div align="right">
                                                    <button type="button" class="btn btn-dark" onclick="step3Prev()">Previous</button>
                                                </div>
                                            </form>
                                        </div>

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
 <script src="<?php echo base_url('public/admin/') ?>js/tinymce/jquery.tinymce.min.js"></script>
  <script src="<?php echo base_url('public/admin/') ?>js/tinymce/tinymce.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
<script src="<?php echo base_url('public/admin/') ?>plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>


 <script>
var accomodation_list =  <?= json_encode($accomodation_list) ?>;
var unit_list =  <?= json_encode($unit_list) ?>;
var facing_list =  <?= json_encode($facing_list) ?>;
var amenitie_list =  <?= json_encode($amenitie_list) ?>;
var finance_list =  <?= json_encode($finance_list) ?>;
var price_component_list =  <?= json_encode($price_component_list) ?>;
var specification_list =  <?= json_encode($specification_list) ?>;
var comm_product_unit_type_list = <?= json_encode($comm_product_unit_type_list) ?>;
$('.mydatepicker').datepicker();
function alertMessage(type,message) {
  if (type=='error') {
    type = 'danger';
  }

  return "<div class='alert alert-"+type+" alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "+message+" </div>";
}

<?php if($id && ($product_unit_details || $product_comm_blocks)) { ?>

if ($("#project_type").val()=='3') {
  $(".comm_detail_main").show();

  <?php if($product_unit_details) { ?>

  var blocks = <?= json_encode($product_unit_details) ?>;
  commDetail(blocks,0);
  <?php } else { ?>
  addRowComm('','comm_detail');
  <?php } ?>

  <?php if($product_comm_blocks) { ?>
  var product_comm_blocks = <?= json_encode($product_comm_blocks) ?>;
  commDetailBlock(product_comm_blocks,0);
  <?php } else { ?>
  addRowCommBlock('','comm_block_detail');
  <?php } ?>

}
else {
  $(".comm_detail_main").hide();
}
<?php } else { ?>
if ($("#project_type").val()=='3') {
$(".comm_detail_main").show();
addRowComm('','comm_detail');
addRowCommBlock('','comm_block_detail');
}
else {
  $(".comm_detail_main").hide();
}
<?php } ?>

<?php if($id && $blocks) { ?>
var blocks = <?= json_encode($blocks) ?>;
flatBlockDetail(blocks,0)
<?php } else { ?>
addRow('','flat_block_detail');
<?php } ?>

<?php if($id && $product_flat_unit_details) { ?>
var product_flat_unit_details = <?= json_encode($product_flat_unit_details) ?>;
flatUnitDetail(product_flat_unit_details,0);
<?php } else { ?>
addRow('','flat_unit_detail');
<?php } ?>

<?php if($id && $product_villa_unit_details) { ?>
var product_villa_unit_details = <?= json_encode($product_villa_unit_details) ?>;
villaUnitDetail(product_villa_unit_details,0);
<?php } else { ?>
addRow('','villa_detail');
<?php } ?>

<?php if($id && $product_plot_unit_details) { ?>
var product_plot_unit_details = <?= json_encode($product_plot_unit_details) ?>;
plotUnitDetail(product_plot_unit_details,0);
<?php } else { ?>
addRow('','plot_detail');
<?php } ?>

function flatBlockDetail(blocks,n) {
    var ht = "";
    type = 'flat_block_detail';

    for (var i = 0; i < blocks.length; i++) {

        var timestamp = blocks[i]['block_id'];
        var t = type+"_"+timestamp;

        var minus = "";
        var plus = "none";
        if (blocks.length-1==i) {
            minus = "none";
            plus = "";
        }

        var plus_minus = "<div class='"+t+"'><i class='fa fa-plus-circle cp' style='display:"+plus+";' aria-hidden='true' onclick='addRow(&quot;"+t+"&quot;,&quot;"+type+"&quot;)'></i> <i class='fa fa-minus-circle text-danger cp' style='display:"+minus+"' aria-hidden='true' onclick='removeRow(&quot;"+t+"&quot;)'></i></div>";
        
        ht += "<tr> <td>"+plus_minus+"</td> <td><input class='form-control' type='hidden' name='block["+timestamp+"][block_id]' value='"+blocks[i]['block_id']+"'><input class='form-control' type='text' name='block["+timestamp+"][block_name]' value='"+blocks[i]['block_name']+"' style='width:80px;'></td> <td><input class='form-control' type='text' name='block["+timestamp+"][no_of_floor]' value='"+blocks[i]['no_of_floor']+"' style='width:80px;'></td> <td><input class='form-control' type='text' name='block["+timestamp+"][no_of_flat]' value='"+blocks[i]['no_of_flat']+"' style='width:80px;'></td> <td><input class='form-control' type='text' name='block["+timestamp+"][unit_per_floor]' style='width:80px;'></td> <td><input class='form-control' type='text' name='block["+timestamp+"][no_of_ps_lift]' value='"+blocks[i]['no_of_ps_lift']+"' style='width:80px;'></td> <td><input class='form-control' type='text' name='block["+timestamp+"][no_of_service_lift]' value='"+blocks[i]['no_of_service_lift']+"' style='width:80px;'></td> <td><input class='form-control mydatepicker' type='text' placeholder='dd-mm-yyyy' name='block["+timestamp+"][edp]' value='"+blocks[i]['edp']+"'></td> </tr>";
    }

    $("."+type).html(ht);
}

function flatUnitDetail(blocks,n) {
    var ht = "";
    type = 'flat_unit_detail';

    for (var i = 0; i < blocks.length; i++) {

        var timestamp = blocks[i]['product_unit_detail_id'];
        var t = type+"_"+timestamp;

        var minus = "";
        var plus = "none";
        if (blocks.length-1==i) {
            minus = "none";
            plus = "";
        }

        var accomodation_html = "<option value=''>Select Accomodation</option>";
        for (var j = 0; j < accomodation_list.length; j++) {
            var selected = "";
            if (blocks[i]['accomodation']==accomodation_list[j].accomodation_id) { selected = "selected"; }
            accomodation_html += "<option value='"+accomodation_list[j].accomodation_id+"' "+selected+">"+accomodation_list[j].accomodation_name+"</option>";
        }

        var unit_html = "<option value=''>Select Unjt</option>";
        for (var j = 0; j < unit_list.length; j++) {
            unit_html += "<option value='"+unit_list[j].unit_id+"'>"+unit_list[j].unit_name+"</option>";
        }

        var facing_html = "<option value=''>Select Facjng</option>";
        for (var j = 0; j < facing_list.length; j++) {
            facing_html += "<option value='"+facing_list[j].facing_id+"'>"+facing_list[j].tjtle+"</option>";
        }

        var plus_minus = "<div class='"+t+"'><i class='fa fa-plus-circle cp' style='display:"+plus+";' aria-hidden='true' onclick='addRow(&quot;"+t+"&quot;,&quot;"+type+"&quot;)'></i> <i class='fa fa-minus-circle text-danger cp' style='display:"+minus+"' aria-hidden='true' onclick='removeRow(&quot;"+t+"&quot;)'></i></div>";

        var file = "";
        if (blocks[i].image!='') {
            file = "<a href='<?= base_url('uploads/images/property/unit/') ?>"+blocks[i].image+"' target='_blank'><span style='color: #7571f9;text-decoration: underline;display:inline-block;margin-top:5px;'>View File</span></a>";
        }

        var sa_unit_html = "<select class='form-control unit-select' name='flat_unit["+timestamp+"][unit]' style='width:120px;'>";
            sa_unit_html += "<option value=''>Select Unit</option>";
        for (var j = 0; j < unit_list.length; j++) {
            var selected = "";
            if (blocks[i]['unit']==unit_list[j].unit_id) { selected = "selected"; }
            sa_unit_html += "<option value='"+unit_list[j].unit_id+"' "+selected+">"+unit_list[j].unit_name+"</option>";
        }
        sa_unit_html += "</select>";

        ht += "<tr> <td>"+plus_minus+"</td> <td><input class='form-control' type='text' name='flat_unit["+timestamp+"][code]' value='"+blocks[i]['code']+"' style='width:80px;'></td><td><input class='form-control' type='hidden' name='flat_unit["+timestamp+"][product_unit_detail_id]' value='"+blocks[i]['product_unit_detail_id']+"'><input class='form-control' type='text' name='flat_unit["+timestamp+"][no_of_unit]' value='"+blocks[i]['no_of_unit']+"' style='width:80px;'></td> <td><input class='form-control' type='text' name='flat_unit["+timestamp+"][ca]' value='"+blocks[i]['ca']+"' style='width:80px;'></td> <td><input class='form-control' type='text' name='flat_unit["+timestamp+"][ba]' value='"+blocks[i]['ba']+"' style='width:80px;'></td> <td><input class='form-control' type='text' name='flat_unit["+timestamp+"][sa]' value='"+blocks[i]['sa']+"' style='width:80px;'></td> <td>"+sa_unit_html+"</td>  <td><input class='form-control' type='text' name='flat_unit["+timestamp+"][no_of_bedroom]' value='"+blocks[i]['no_of_bedroom']+"' style='width:80px;'></td> <td><input class='form-control' type='text' name='flat_unit["+timestamp+"][no_of_bathroom]' value='"+blocks[i]['no_of_bathroom']+"' style='width:80px;'></td> <td><select class='form-control' id='accom' name='flat_unit["+timestamp+"][accomodation]'>"+accomodation_html+"</select></td> <td><input class='form-control' type='text' name='flat_unit["+timestamp+"][basic_cost]' value='"+blocks[i]['basic_cost']+"' style='width:80px;'></td> <td><input class='form-control' type='text' name='flat_unit["+timestamp+"][charges]' value='"+blocks[i]['charges']+"' style='width:80px;'></td> <td><input class='form-control input_flat_"+timestamp+"' style='width: 230px;display:none;' type='file' name='flat_image_"+timestamp+"' accept='image/jpg,image/jpeg,image/png'> <div> <button type='button' class='btn btn-primary btn_tan_image' style='height: calc(2.0625rem + 2px);padding: 0px 10px;' onclick='browseFile(&quot;flat_"+timestamp+"&quot;)'>Upload <span class='btn-icon-right'><i class='fa fa-upload'></i></span> </button> </div><div class='span_flat_"+timestamp+"' style='margin-top: 3px;'></div>"+file+"</td> </tr>";
    }

    $("."+type).html(ht);
}

function villaUnitDetail(blocks,n) {
    var ht = "";
    type = 'villa_detail';
    for (var i = 0; i < blocks.length; i++) {

        var timestamp = blocks[i]['product_unit_detail_id'];
        var t = type+"_"+timestamp;

        var minus = "";
        var plus = "none";
        if (blocks.length-1==i) {
            minus = "none";
            plus = "";
        }

        var accomodation_html = "<option value=''>Select Accomodation</option>";
        for (var j = 0; j < accomodation_list.length; j++) {
            var selected = "";
            if (blocks[i]['accomodation']==accomodation_list[j].accomodation_id) { selected = "selected"; }
            accomodation_html += "<option value='"+accomodation_list[j].accomodation_id+"' "+selected+">"+accomodation_list[j].accomodation_name+"</option>";
        }

        var plot_unit_html = "<option value=''>Select Unit</option>";
        for (var j = 0; j < unit_list.length; j++) {
            var selected = "";
            if (blocks[i]['plot_unit']==unit_list[j].unit_id) { selected = "selected"; }
            plot_unit_html += "<option value='"+unit_list[j].unit_id+"' "+selected+">"+unit_list[j].unit_name+"</option>";
        }

        var con_unit_html = "<option value=''>Select Unit</option>";
        for (var j = 0; j < unit_list.length; j++) {
            var selected = "";
            if (blocks[i]['con_unit']==unit_list[j].unit_id) { selected = "selected"; }
            con_unit_html += "<option value='"+unit_list[j].unit_id+"' "+selected+">"+unit_list[j].unit_name+"</option>";
        }

        var facing_html = "<option value=''>Select Facing</option>";
        for (var j = 0; j < facing_list.length; j++) {
            var selected = "";
            if (blocks[i]['facing']==facing_list[j].facing_id) { selected = "selected"; }
            facing_html += "<option value='"+facing_list[j].facing_id+"' "+selected+">"+facing_list[j].title+"</option>";
        }

        var plus_minus = "<div class='"+t+"'><i class='fa fa-plus-circle cp' style='display:"+plus+";' aria-hidden='true' onclick='addRow(&quot;"+t+"&quot;,&quot;"+type+"&quot;)'></i> <i class='fa fa-minus-circle text-danger cp' style='display:"+minus+"' aria-hidden='true' onclick='removeRow(&quot;"+t+"&quot;)'></i></div>";

        var file = "";
        if (blocks[i].image!='') {
            file = "<a href='<?= base_url('uploads/images/property/unit/') ?>"+blocks[i].image+"' target='_blank'><span style='color: #7571f9;text-decoration: underline;display:inline-block;margin-top:5px;'>View File</span></a>";
        }

        ht += "<tr> <td>"+plus_minus+"</td> <td><input class='form-control' type='text' name='villa_unit["+timestamp+"][code]' value='"+blocks[i]['code']+"' style='width:80px;'></td><td><input class='form-control' type='hidden' name='villa_unit["+timestamp+"][product_unit_detail_id]' value='"+blocks[i]['product_unit_detail_id']+"'> <div class='row' style='width: 330px;'> <div class='col-md-6'> <input class='form-control unit-select' type='text' name='villa_unit["+timestamp+"][plot_size]' value='"+blocks[i]['plot_size']+"' style=''> </div> <div class='col-md-6'><select class='form-control unit-select' id='unit' name='villa_unit["+timestamp+"][plot_unit]' style=''>"+plot_unit_html+"</select> </div> </div> </td> <td><input class='form-control' type='text' name='villa_unit["+timestamp+"][dimension]' value='"+blocks[i]['dimension']+"' style='width: 120px;'></td> <td> <select class='form-control unit-select' id='facing' name='villa_unit["+timestamp+"][facing]' style='width: 120px;'>"+facing_html+"</select> </td> <td><input class='form-control' type='text' name='villa_unit["+timestamp+"][no_of_unit]' value='"+blocks[i]['no_of_unit']+"' style='width: 80px;'></td> <td><select class='form-control' id='accom' name='villa_unit["+timestamp+"][accomodation]' style='width: 180px;'>"+accomodation_html+"</select></td> <td><input class='form-control' type='text' name='villa_unit["+timestamp+"][no_of_floor]' value='"+blocks[i]['no_of_floor']+"' style='width: 120px;'></td> <td> <div class='row' style='width: 330px;'> <div class='col-md-6'> <input class='form-control unit-select' type='text' name='villa_unit["+timestamp+"][construction_area]' value='"+blocks[i]['construction_area']+"' > </div> <div class='col-md-6'> <select class='form-control unit-select' id='unit' name='villa_unit["+timestamp+"][con_unit]'>"+con_unit_html+"</select> </div> </div> </td> <td><input class='form-control' type='text' name='villa_unit["+timestamp+"][no_of_bedroom]' value='"+blocks[i]['no_of_bedroom']+"' style='width: 100px;'></td> <td><input class='form-control' type='text' name='villa_unit["+timestamp+"][no_of_bathroom]' value='"+blocks[i]['no_of_bathroom']+"' style='width: 100px;'></td> <td><input class='form-control' type='text' name='villa_unit["+timestamp+"][basic_cost]' value='"+blocks[i]['basic_cost']+"' style='width: 100px;'></td> <td><input class='form-control' type='text' name='villa_unit["+timestamp+"][charges]' value='"+blocks[i]['charges']+"' style='width: 100px;'></td> <td><input class='form-control input_villa_"+timestamp+"' style='width: 230px;display:none;' type='file' name='villa_image_"+timestamp+"' accept='image/jpg,image/jpeg,image/png'> <div> <button type='button' class='btn btn-primary btn_tan_image' style='height: calc(2.0625rem + 2px);padding: 0px 10px;' onclick='browseFile(&quot;villa_"+timestamp+"&quot;)'>Upload <span class='btn-icon-right'><i class='fa fa-upload'></i></span> </button> </div><div class='span_villa_"+timestamp+"' style='margin-top: 3px;'></div>"+file+"</td> </tr>";

    }

    $("."+type).html(ht);
}

function plotUnitDetail(blocks,n) {
    var ht = "";
    type = 'plot_detail';

    for (var i = 0; i < blocks.length; i++) {

        var timestamp = blocks[i]['product_unit_detail_id'];
        var t = type+"_"+timestamp;

        var minus = "";
        var plus = "none";
        if (blocks.length-1==i) {
            minus = "none";
            plus = "";
        }

        /*var accomodation_html = "<option value=''>Select Accomodation</option>";
        for (var j = 0; j < accomodation_list.length; j++) {
            var selected = "";
            if (blocks[i]['accomodation']==accomodation_list[j].accomodation_id) { selected = "selected"; }
            accomodation_html += "<option value='"+accomodation_list[j].accomodation_id+"' "+selected+">"+accomodation_list[j].accomodation_name+"</option>";
        }

        var plot_unit_html = "<option value=''>Select Unit</option>";
        for (var j = 0; j < unit_list.length; j++) {
            var selected = "";
            if (blocks[i]['plot_unit']==unit_list[j].unit_id) { selected = "selected"; }
            plot_unit_html += "<option value='"+unit_list[j].unit_id+"' "+selected+">"+unit_list[j].unit_name+"</option>";
        }

        var con_unit_html = "<option value=''>Select Unit</option>";
        for (var j = 0; j < unit_list.length; j++) {
            var selected = "";
            if (blocks[i]['con_unit']==unit_list[j].unit_id) { selected = "selected"; }
            con_unit_html += "<option value='"+unit_list[j].unit_id+"' "+selected+">"+unit_list[j].unit_name+"</option>";
        }*/

        var plot_unit_html = "<option value=''>Select Unit</option>";
        for (var j = 0; j < unit_list.length; j++) {
            var selected = "";
            if (blocks[i]['plot_unit']==unit_list[j].unit_id) { selected = "selected"; }
            plot_unit_html += "<option value='"+unit_list[j].unit_id+"' "+selected+">"+unit_list[j].unit_name+"</option>";
        }

        var facing_html = "<option value=''>Select Facing</option>";
        for (var j = 0; j < facing_list.length; j++) {
            var selected = "";
            if (blocks[i]['facing']==facing_list[j].facing_id) { selected = "selected"; }
            facing_html += "<option value='"+facing_list[j].facing_id+"' "+selected+">"+facing_list[j].title+"</option>";
        }

        var plus_minus = "<div class='"+t+"'><i class='fa fa-plus-circle cp' style='display:"+plus+";' aria-hidden='true' onclick='addRow(&quot;"+t+"&quot;,&quot;"+type+"&quot;)'></i> <i class='fa fa-minus-circle text-danger cp' style='display:"+minus+"' aria-hidden='true' onclick='removeRow(&quot;"+t+"&quot;)'></i></div>";

        var file = "";
        if (blocks[i].image!='') {
            file = "<a href='<?= base_url('uploads/images/property/unit/') ?>"+blocks[i].image+"' target='_blank'><span style='color: #7571f9;text-decoration: underline;display:inline-block;margin-top:5px;'>View File</span></a>";
        }

        ht += "<tr> <td>"+plus_minus+"</td> <td><input class='form-control' type='text' name='villa_unit["+timestamp+"][code]' value='"+blocks[i]['code']+"' style='width:80px;'></td><td><input class='form-control' type='hidden' name='plot_unit["+timestamp+"][product_unit_detail_id]' value='"+blocks[i]['product_unit_detail_id']+"'> <div class='row' style='width: 330px;'> <div class='col-md-6'> <input class='form-control unit-select' type='text' name='plot_unit["+timestamp+"][plot_size]' value='"+blocks[i]['plot_size']+"'> </div> <div class='col-md-6'> <select class='form-control unit-select' id='unit' name='plot_unit["+timestamp+"][plot_unit]'>"+plot_unit_html+"</select> </div> </div> </td>  <td><input class='form-control' type='text' name='plot_unit["+timestamp+"][dimension]' value='"+blocks[i]['dimension']+"' style='width: 100px;'></td> <td> <select class='form-control unit-select' name='plot_unit["+timestamp+"][facing]' id='facing' style='width: 150px;'>"+facing_html+"</select> </td> <td><input class='form-control' type='text' name='plot_unit["+timestamp+"][no_of_unit]' value='"+blocks[i]['no_of_unit']+"' style='width: 100px;'></td> <td><input class='form-control' type='text' name='plot_unit["+timestamp+"][basic_cost]' value='"+blocks[i]['basic_cost']+"' style='width: 100px;'></td> <td><input class='form-control' type='text' name='plot_unit["+timestamp+"][charges]' value='"+blocks[i]['charges']+"' style='width: 100px;'></td> <td><input class='form-control input_plot_"+timestamp+"' style='width: 230px;display:none;' type='file' name='plot_image_"+timestamp+"' accept='image/jpg,image/jpeg,image/png'> <div> <button type='button' class='btn btn-primary btn_tan_image' style='height: calc(2.0625rem + 2px);padding: 0px 10px;' onclick='browseFile(&quot;plot_"+timestamp+"&quot;)'>Upload <span class='btn-icon-right'><i class='fa fa-upload'></i></span> </button> </div><div class='span_plot_"+timestamp+"' style='margin-top: 3px;'></div>"+file+"</td> </tr>";

    }

    $("."+type).html(ht);
}

 $("#step-1-form").validate({
    rules: {
        project_name: {
            required:true
        },
        project_status: {
            required:true
        }
    },
    messages: {
        project_name: 'Please enter project name',
        project_status: 'Please select project status'
    },
    submitHandler: function(form) {
      var myform = document.getElementById("step-1-form");
      var fd = new FormData(myform );
    fd.append('view_only', 1);

      $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'/api/product_save') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".error-msg").html('');
          $(".form-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>").prop('disabled',true);
          $(".loader_progress").show();
        },
        success: function (response) {
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".form-btn").html("Next").prop('disabled',false);
                $(".loader_progress").hide();

                if (obj.status=='success') {
                    if ($(".pid").val()=='') {
                        $(".pid").val(obj.pid);
                    }

                    flatBlockDetail(obj.blocks,1);
                    flatUnitDetail(obj.product_flat_unit_details,1);
                    villaUnitDetail(obj.product_villa_unit_details,1);
                    plotUnitDetail(obj.product_plot_unit_details,1);

                    if ($("#project_type").val()=='3') {
                    var unit_details = obj.comm_units;
                    if (unit_details.length==0) {
                      addRowComm('','comm_detail');
                    }
                    else {
                      commDetail(unit_details,0);
                    }

                    var comm_block_details = obj.comm_blocks;
                    if (comm_block_details.length==0) {
                      addRowCommBlock('','comm_block_detail');
                    }
                    else {
                      commDetailBlock(comm_block_details,0);
                    }
                  }

                    $('html, body').animate({
                        scrollTop: $(".header-content").offset().top
                    }, 1000);

                    //$(".error-msg").html(alertMessage('success',obj.message));

                    var record = obj.record;

                    $("#b_cost_unit").val(record.b_cost_unit);
                    $("#b_cost_gst").val(record.b_cost_gst);
                    if (record.b_cost_gst!='0.00') {
                        $("#b_cost_gst_check").prop("checked", true);
                        $(".input_b_cost_gst_check").show();
                    }
                    else {
                        $("#b_cost_gst_check").prop("checked", false);
                       $(".input_b_cost_gst_check").hide(); 
                    }

                    $("#club_cost_unit").val(record.club_cost_unit);
                    $("#club_gst").val(record.club_gst);
                    if (record.club_gst!='0.00') {
                        $("#club_gst_check").prop("checked", true);
                        $(".input_club_gst_check").show();
                    }
                    else {
                        $("#club_gst_check").prop("checked", false);
                       $(".input_club_gst_check").hide(); 
                    }

                    $("#parking_gst").val(record.parking_gst);
                    if (record.parking_gst!='0.00') {
                        $("#parking_gst_check").prop("checked", true);
                        $(".input_parking_gst_check").show();
                    }
                    else {
                        $("#parking_gst_check").prop("checked", false);
                       $(".input_parking_gst_check").hide(); 
                    }

                    $("#o_price").val(record.o_price);
                    if (record.parking_open=='1') {
                        $("#parking_open").prop("checked", true);
                        $("#o_price").show();
                    }
                    else {
                        $("#parking_open").prop("checked", false);
                       $("#o_price").hide(); 
                    }

                    $("#s_price").val(record.s_price);
                    if (record.parking_stilt=='1') {
                        $("#parking_stilt").prop("checked", true);
                        $("#s_price").show();
                    }
                    else {
                        $("#parking_stilt").prop("checked", false);
                       $("#s_price").hide(); 
                    }

                    $("#b_price").val(record.b_price);
                    if (record.parking_basment=='1') {
                        $("#parking_basment").prop("checked", true);
                        $("#b_price").show();
                    }
                    else {
                        $("#parking_basment").prop("checked", false);
                       $("#b_price").hide(); 
                    }

                    var amenitie=record.amenitie;
                     var amenitie_array = [];
                    if (amenitie!=null && amenitie!='') { amenitie_array = amenitie.split(','); }

                    var amenitie_html = "<option value='' disabled>Select Amenities</option>";
                    for (var j = 0; j < amenitie_list.length; j++) {
                        var selected = "";
                        if(amenitie_array.indexOf(amenitie_list[j].amenitie_id) !== -1){
                            selected = "selected";
                        }
                        amenitie_html += "<option value='"+amenitie_list[j].amenitie_id+"' "+selected+">"+amenitie_list[j].amenitie_name+"</option>";
                    }
                    $("#select_amenitie").html(amenitie_html).trigger("change");

                    var finance=record.finance;

                    var finance_array = [];
                    if (finance!=null && finance!='') { finance_array = finance.split(','); }

                    var finance_html = "<option value='' disabled>Select Amenities</option>";
                    for (var j = 0; j < finance_list.length; j++) {
                        var selected = "";
                        if(finance_array.indexOf(finance_list[j].finance_id) !== -1){
                            selected = "selected";
                        }
                        finance_html += "<option value='"+finance_list[j].finance_id+"' "+selected+">"+finance_list[j].finance_name+"</option>";
                    }
                    $("#select_finance").html(finance_html).trigger("change");

                    var additional_details = obj.additional_details;
                    if (additional_details.length!=0) {
                        input_fields_additional_update(additional_details);
                    }
                    else {
                        input_fields_additional();
                    }

                    var plc_details = obj.plc_details;
                    if (plc_details.length!=0) {
                        input_fields_plc_update(plc_details);
                    }
                    else {
                        input_fields_plc();
                    }

                    var product_specifications = obj.product_specifications;
                    if (product_specifications.length!=0) {
                        input_fields_specification_update(product_specifications);
                    }
                    else {
                        input_fields_specification();
                    }

                    step1Next();
                }
                else {
                  $(".error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".form-btn").html("Next").prop('disabled',false);
                $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
                $(".loader_progress").hide();
              }
          },500);
        },
        error: function () {
            $(".form-btn").html("Next").prop('disabled',false);
          $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
            $(".loader_progress").hide();
           
        }

    });

    }
});
//step1Next();
 function step1Next() {
    $(".step-1").hide();
    $(".step-2").show();
    $(".step-3").hide();
}

function step2Prev() {
    $(".step-1").show();
    $(".step-2").hide();
    $(".step-3").hide();
}

function step2Next() {
    $(".step-1").hide();
    $(".step-2").hide();
    $(".step-3").show();
}

function step3Prev() {
    $(".step-1").hide();
    $(".step-2").show();
    $(".step-3").hide();
}

function step3Submit() {
    window.location.href='<?= base_url(ADMIN_URL.'products/') ?>';
}
$('#select_amenitie').select2();
$('#select_finance').select2();
//$('#payment_plans').select2();

reraApplication();
function reraApplication() {
    var rera_application = $("#rera_application").val();
    if (rera_application=='registred') {
        $(".input-rera-no").show();
    }
    else {
        $(".input-rera-no").hide();
    }
}

propertType('1');
function propertType(tt) {

    var property_type = $("#property_type").val();
    var project_type = $("#project_type").val();
    if (project_type=='2') {
      if (property_type=='1' || property_type=='7') {
          $(".property-type-flat").show();
          $(".property-type-villa").hide();
          $(".property-type-plot").hide();
      }
      else if (property_type=='2') {
          $(".property-type-flat").hide();
          $(".property-type-villa").show();
          $(".property-type-plot").hide();
      }
      else if (property_type=='3') {
          $(".property-type-flat").hide();
          $(".property-type-villa").hide();
          $(".property-type-plot").show();
      }
      else {
          $(".property-type-flat").hide();
          $(".property-type-villa").hide();
          $(".property-type-plot").hide();
      }
      if (tt==2) {
        getUnitDetails();
      }
    }
    else {
        $(".property-type-flat").hide();
        $(".property-type-villa").hide();
        $(".property-type-plot").hide();
    }

    if (tt==2) {
//alert(112);
      if (project_type=='3') {
//alert(113);

        if ($("#project_type").val()=='3') {

//alert(114);
          $(".comm_detail_main").show();
          $(".comm_detail").html("");
          $(".comm_block_detail").html("");

          getUnitDetails();
        }
        else {
          $(".comm_detail_main").hide();
          $(".comm_block_detail").html("");
          $(".comm_detail").html("");
        }
      }
    }
}

function addRow(id,type) {
    if (id!='') {
        $("."+id+" .fa-plus-circle").hide();
        $("."+id+" .fa-minus-circle").show();
    }

    var accomodation_html = "<option value=''>Select Accomodation</option>";
    for (var i = 0; i < accomodation_list.length; i++) {
        accomodation_html += "<option value='"+accomodation_list[i].accomodation_id+"'>"+accomodation_list[i].accomodation_name+"</option>";
    }

    var unit_html = "<option value=''>Select Unit</option>";
    for (var i = 0; i < unit_list.length; i++) {
        unit_html += "<option value='"+unit_list[i].unit_id+"'>"+unit_list[i].unit_name+"</option>";
    }

    var facing_html = "<option value=''>Select Facing</option>";
    for (var i = 0; i < facing_list.length; i++) {
        facing_html += "<option value='"+facing_list[i].facing_id+"'>"+facing_list[i].title+"</option>";
    }

    var timestamp = Date.now();


    var t = type+"_"+timestamp;

    var plus_minus = "<div class='"+t+"'><i class='fa fa-plus-circle cp' aria-hidden='true' onclick='addRow(&quot;"+t+"&quot;,&quot;"+type+"&quot;)'></i> <i class='fa fa-minus-circle text-danger cp' style='display: none;' aria-hidden='true' onclick='removeRow(&quot;"+t+"&quot;)'></i></div>";

    if (type == 'flat_block_detail') {

        var ht = "<tr> <td>"+plus_minus+"</td> <td><input class='form-control' type='hidden' name='block["+timestamp+"][block_id]' value=''><input class='form-control' type='text' name='block["+timestamp+"][block_name]' style='width:80px;'></td> <td><input class='form-control' type='text' name='block["+timestamp+"][no_of_floor]' style='width:80px;'></td> <td><input class='form-control' type='text' name='block["+timestamp+"][no_of_flat]' style='width:80px;'></td> <td><input class='form-control' type='text' name='block["+timestamp+"][unit_per_floor]' style='width:80px;'></td> <td><input class='form-control' type='text' name='block["+timestamp+"][no_of_ps_lift]' style='width:80px;'></td> <td><input class='form-control' type='text' name='block["+timestamp+"][no_of_service_lift]' style='width:80px;'></td> <td><input class='form-control mydatepicker' type='text' placeholder='dd-mm-yyyy' name='block["+timestamp+"][edp]'></td> </tr>";

        $("."+type).append(ht);

    }
    else if (type == 'flat_unit_detail') {

        var sa_unit_html = "<select class='form-control unit-select' name='flat_unit["+timestamp+"][unit]' style='width:120px;'>";
        sa_unit_html += "<option value=''>Select Unit</option>";
        for (var j = 0; j < unit_list.length; j++) {
            var selected = "";
            //if (blocks[i]['unit']==unit_list[j].unit_id) { selected = "selected"; }
            sa_unit_html += "<option value='"+unit_list[j].unit_id+"' "+selected+">"+unit_list[j].unit_name+"</option>";
        }
        sa_unit_html += "</select>";

        var ht = "<tr> <td>"+plus_minus+"</td> <td><input class='form-control' type='text' name='flat_unit["+timestamp+"][code]' style='width:80px;'></td><td><input class='form-control' type='hidden' name='flat_unit["+timestamp+"][product_unit_detail_id]' value=''><input class='form-control' type='text' name='flat_unit["+timestamp+"][no_of_unit]' style='width:80px;'></td> <td><input class='form-control' type='text' name='flat_unit["+timestamp+"][ca]' style='width:80px;'></td> <td><input class='form-control' type='text' name='flat_unit["+timestamp+"][ba]' style='width:80px;'></td> <td><input class='form-control' type='text' name='flat_unit["+timestamp+"][sa]' style='width:80px;'></td> <td>"+sa_unit_html+"</td> <td><input class='form-control' type='text' name='flat_unit["+timestamp+"][no_of_bedroom]' style='width:80px;'></td> <td><input class='form-control' type='text' name='flat_unit["+timestamp+"][no_of_bathroom]' style='width:80px;'></td> <td><select class='form-control' id='accom' name='flat_unit["+timestamp+"][accomodation]'>"+accomodation_html+"</select></td> <td><input class='form-control' type='text' name='flat_unit["+timestamp+"][basic_cost]' style='width:80px;'></td> <td><input class='form-control' type='text' name='flat_unit["+timestamp+"][charges]' style='width:80px;'></td> <td><input class='form-control input_flat_"+timestamp+"' style='width: 230px;display:none;' type='file' name='flat_image_"+timestamp+"' accept='image/jpg,image/jpeg,image/png'> <div> <button type='button' class='btn btn-primary btn_tan_image' style='height: calc(2.0625rem + 2px);padding: 0px 10px;' onclick='browseFile(&quot;flat_"+timestamp+"&quot;)'>Upload <span class='btn-icon-right'><i class='fa fa-upload'></i></span> </button> </div><div class='span_flat_"+timestamp+"' style='margin-top: 3px;'></div></td> </tr>";

        $("."+type).append(ht);
    }
    else if (type == 'villa_detail') {

        var ht = "<tr> <td>"+plus_minus+"</td> <td><input class='form-control' type='text' name='villa_unit["+timestamp+"][code]' style='width:80px;'></td><td><input class='form-control' type='hidden' name='villa_unit["+timestamp+"][product_unit_detail_id]' value=''> <div class='row' style='width: 330px;'> <div class='col-md-6'> <input class='form-control unit-select' type='text' name='villa_unit["+timestamp+"][plot_size]' style=''> </div> <div class='col-md-6'><select class='form-control unit-select' id='unit' name='villa_unit["+timestamp+"][plot_unit]' style=''>"+unit_html+"</select> </div> </div> </td> <td><input class='form-control' type='text' name='villa_unit["+timestamp+"][dimension]' style='width: 120px;'></td> <td> <select class='form-control unit-select' id='facing' name='villa_unit["+timestamp+"][facing]' style='width: 120px;'>"+facing_html+"</select> </td> <td><input class='form-control' type='text' name='villa_unit["+timestamp+"][no_of_unit]' style='width: 80px;'></td> <td><select class='form-control' id='accom' name='villa_unit["+timestamp+"][accomodation]' style='width: 180px;'>"+accomodation_html+"</select></td> <td><input class='form-control' type='text' name='villa_unit["+timestamp+"][no_of_floor]' style='width: 120px;'></td> <td> <div class='row' style='width: 330px;'> <div class='col-md-6'> <input class='form-control unit-select' type='text' name='villa_unit["+timestamp+"][construction_area]' > </div> <div class='col-md-6'> <select class='form-control unit-select' id='unit' name='villa_unit["+timestamp+"][con_unit]'>"+unit_html+"</select> </div> </div> </td> <td><input class='form-control' type='text' name='villa_unit["+timestamp+"][no_of_bedroom]' style='width: 100px;'></td> <td><input class='form-control' type='text' name='villa_unit["+timestamp+"][no_of_bathroom]' style='width: 100px;'></td> <td><input class='form-control' type='text' name='villa_unit["+timestamp+"][basic_cost]' style='width: 100px;'></td> <td><input class='form-control' type='text' name='villa_unit["+timestamp+"][charges]' style='width: 100px;'></td> <td><input class='form-control input_villa_"+timestamp+"' style='width: 230px;display:none;' type='file' name='villa_image_"+timestamp+"' accept='image/jpg,image/jpeg,image/png'> <div> <button type='button' class='btn btn-primary btn_tan_image' style='height: calc(2.0625rem + 2px);padding: 0px 10px;' onclick='browseFile(&quot;villa_"+timestamp+"&quot;)'>Upload <span class='btn-icon-right'><i class='fa fa-upload'></i></span> </button> </div><div class='span_villa_"+timestamp+"' style='margin-top: 3px;'></div></td> </tr>";

        $("."+type).append(ht);
    }

    else if (type == 'plot_detail') {

        var ht = "<tr> <td>"+plus_minus+"</td> <td><input class='form-control' type='text' name='plot_unit["+timestamp+"][code]' style='width:80px;'></td><td><input class='form-control' type='hidden' name='plot_unit["+timestamp+"][product_unit_detail_id]' value=''> <div class='row' style='width: 330px;'> <div class='col-md-6'> <input class='form-control unit-select' type='text' name='plot_unit["+timestamp+"][plot_size]'> </div> <div class='col-md-6'> <select class='form-control unit-select' id='unit' name='plot_unit["+timestamp+"][plot_unit]'>"+unit_html+"</select> </div> </div> </td> <td><input class='form-control' type='text' name='plot_unit["+timestamp+"][dimension]' style='width: 100px;'></td> <td> <select class='form-control unit-select' name='plot_unit["+timestamp+"][facing]' id='facing' style='width: 150px;'>"+facing_html+"</select> </td> <td><input class='form-control' type='text' name='plot_unit["+timestamp+"][no_of_unit]' style='width: 100px;'></td> <td><input class='form-control' type='text' name='plot_unit["+timestamp+"][basic_cost]' style='width: 100px;'></td> <td><input class='form-control' type='text' name='plot_unit["+timestamp+"][charges]' style='width: 100px;'></td> <td><input class='form-control input_plot_"+timestamp+"' style='width: 230px;display:none;' type='file' name='plot_image_"+timestamp+"' accept='image/jpg,image/jpeg,image/png'> <div> <button type='button' class='btn btn-primary btn_tan_image' style='height: calc(2.0625rem + 2px);padding: 0px 10px;' onclick='browseFile(&quot;plot_"+timestamp+"&quot;)'>Upload <span class='btn-icon-right'><i class='fa fa-upload'></i></span> </button> </div><div class='span_plot_"+timestamp+"' style='margin-top: 3px;'></div></td> </tr>";

        $("."+type).append(ht);
    }

    $('.mydatepicker').datepicker();
}

function removeRow(id) {
    $("."+id+"").parent().parent().remove();
}

$('#b_cost_gst_check').change(function () {
  if($("#b_cost_gst_check").is(':checked')){
    $(".input_b_cost_gst_check").show(); 
  } 
  else {
     $(".input_b_cost_gst_check").hide(); 
  }
});

$('#club_gst_check').change(function () {
  if($("#club_gst_check").is(':checked')){
    $(".input_club_gst_check").show(); 
  } 
  else {
     $(".input_club_gst_check").hide(); 
  }
});

$('#parking_gst_check').change(function () {
  if($("#parking_gst_check").is(':checked')){
    $(".input_parking_gst_check").show(); 
  } 
  else {
     $(".input_parking_gst_check").hide(); 
  }
});

$("#o_price").hide(); 
$('#parking_open').change(function () {
  if($("#parking_open").is(':checked')){
    $("#o_price").show(); 
  } 
  else {
    $("#o_price").hide(); 
  }
});

$("#s_price").hide(); 
$('#parking_stilt').change(function () {
  if($("#parking_stilt").is(':checked')){
    $("#s_price").show(); 
  } 
  else {
    $("#s_price").hide(); 
  }
});

$("#b_price").hide(); 
$('#parking_basment').change(function () {
  if($("#parking_basment").is(':checked')){
    $("#b_price").show(); 
  } 
  else {
    $("#b_price").hide(); 
  }
});

function input_fields_additional() {

    var timestamp = Date.now();

    var unit_html = "<option value=''>Select Unit</option>";
    for (var j = 0; j < unit_list.length; j++) {
        unit_html += "<option value='"+unit_list[j].unit_id+"'>"+unit_list[j].unit_name+"</option>";
    }

    var price_component_html = "<option value=''>Select Component</option>";
    for (var j = 0; j < price_component_list.length; j++) {
        if(price_component_list[j].price_group_id=='3') {
            price_component_html += "<option value='"+price_component_list[j].price_component_id+"'>"+price_component_list[j].price_component_name+"</option>";
        }
    }
    
    var html = "<div class='row margin-add additional_"+timestamp+"' style='margin-bottom: 15px;'> <input type='hidden' name='add_detail["+timestamp+"][product_additional_detail_id]' value=''> <div class='col-md-4 col-sm-4 col-xs-12'> <label for='area'>Select Component:</label> <select class='form-control' id='a_box' name='add_detail["+timestamp+"][price_comp_id]'>"+price_component_html+"</select> </div> <div class='col-md-4 col-sm-4 col-xs-8'> <div class='row'> <div class='col-md-6 col-sm-6 col-xs-6'> <label for='area'>Price:</label> <input type='text' name='add_detail["+timestamp+"][price]' class='form-control' id='area' value=''> </div> <div class='col-md-6 col-sm-6 col-xs-6 padding-left-none'> <label onclick='additionalCheckboxGST("+timestamp+")'><input class='checkgst' type='checkbox' id='chkgst_additional_"+timestamp+"' name='add_detail["+timestamp+"][gst_check]' value='1' > &nbsp;&nbsp;GST</label> <div class='dvGst2' style=''> <input class='form-control inputgst_additional_"+timestamp+"' style='display: none;' type='text' name='add_detail["+timestamp+"][gst]' id='txtGstNumber' placeholder='Enter GST value'> </div> </div> </div> </div> <div class='col-md-3 col-sm-3 col-xs-4 padding-left-none'> <label for='area'>Unit:</label> <select class='form-control' id='a_box2' name='add_detail["+timestamp+"][unit]'>"+unit_html+"</select> </div> <div class='col-md-1 col-sm-1 col-xs-12'> <label class='blank' for='blank'> &nbsp; </label> <div class='add_field_button3'><i class='fa fa-plus-circle cp' style='font-size: 18px;' aria-hidden='true' onclick='addInputRowAdditional(&quot;additional_"+timestamp+"&quot;)'></i> <i class='fa fa-minus-circle text-danger cp' style='display: none;font-size: 18px;' aria-hidden='true' onclick='removeInputRowAdditional(&quot;additional_"+timestamp+"&quot;)'></i></div> </div> </div>";

    $(".input_fields_additional").append(html);    

}

function input_fields_additional_update(blocks) {
    var html = "";
    for (var i = 0; i < blocks.length; i++) {
        var timestamp = blocks[i].product_additional_detail_id;

        var minus = "";
        var plus = "none";
        if (blocks.length-1==i) {
            minus = "none";
            plus = "";
        }

        var unit_html = "<option value=''>Select Unit</option>";
        for (var j = 0; j < unit_list.length; j++) {
            var selected = "";
            if (blocks[i]['unit']==unit_list[j].unit_id) { selected = "selected"; }
            unit_html += "<option value='"+unit_list[j].unit_id+"' "+selected+">"+unit_list[j].unit_name+"</option>";
        }

        var price_component_html = "<option value=''>Select Component</option>";
        for (var j = 0; j < price_component_list.length; j++) {
            if(price_component_list[j].price_group_id=='3') {
                var selected = "";
                if (blocks[i]['price_comp_id']==price_component_list[j].price_component_id) { selected = "selected"; }
                price_component_html += "<option value='"+price_component_list[j].price_component_id+"' "+selected+">"+price_component_list[j].price_component_name+"</option>";
            }
        }

        var chk = "";
        var input_show = "none";
        if (blocks[i].gst!='0.00') {
            chk = "checked";
            input_show = "";
        }
        
        html += "<div class='row margin-add additional_"+timestamp+"' style='margin-bottom: 15px;'> <input type='hidden' name='add_detail["+timestamp+"][product_additional_detail_id]' value='"+blocks[i].product_additional_detail_id+"'> <div class='col-md-4 col-sm-4 col-xs-12'> <label for='area'>Select Component:</label> <select class='form-control' id='a_box' name='add_detail["+timestamp+"][price_comp_id]'>"+price_component_html+"</select> </div> <div class='col-md-4 col-sm-4 col-xs-8'> <div class='row'> <div class='col-md-6 col-sm-6 col-xs-6'> <label for='area'>Price:</label> <input type='text' name='add_detail["+timestamp+"][price]' class='form-control' id='area' value='"+blocks[i].price+"'> </div> <div class='col-md-6 col-sm-6 col-xs-6 padding-left-none'> <label onclick='additionalCheckboxGST("+timestamp+")'><input class='checkgst' type='checkbox' id='chkgst_additional_"+timestamp+"' name='add_detail["+timestamp+"][gst_check]' value='1' "+chk+"> &nbsp;&nbsp;GST</label> <div class='dvGst2' style=''> <input class='form-control inputgst_additional_"+timestamp+"' style='display: "+input_show+";' type='text' name='add_detail["+timestamp+"][gst]' id='txtGstNumber' placeholder='Enter GST value' value='"+blocks[i].gst+"'> </div> </div> </div> </div> <div class='col-md-3 col-sm-3 col-xs-4 padding-left-none'> <label for='area'>Unit:</label> <select class='form-control' id='a_box2' name='add_detail["+timestamp+"][unit]'>"+unit_html+"</select> </div> <div class='col-md-1 col-sm-1 col-xs-12'> <label class='blank' for='blank'> &nbsp; </label> <div class='add_field_button3'><i class='fa fa-plus-circle cp' style='font-size: 18px;display:"+plus+";' aria-hidden='true' onclick='addInputRowAdditional(&quot;additional_"+timestamp+"&quot;)'></i> <i class='fa fa-minus-circle text-danger cp' style='display:"+minus+";font-size: 18px;' aria-hidden='true' onclick='removeInputRowAdditional(&quot;additional_"+timestamp+"&quot;)'></i></div> </div> </div>";

    }
    $(".input_fields_additional").html(html);

}


function additionalCheckboxGST(id){
    if($("#chkgst_additional_"+id).is(':checked')){
    $(".inputgst_additional_"+id).show(); 
    } 
    else {
     $(".inputgst_additional_"+id).hide(); 
    }
}


function removeInputRowAdditional(id) {
    $("."+id+"").remove();
}

function addInputRowAdditional(id) {
    $("."+id+" .fa-plus-circle").hide();
    $("."+id+" .fa-minus-circle").show();
    input_fields_additional();
}

function input_fields_plc() {

    var timestamp = Date.now();

    var unit_html = "<option value=''>Select Unit</option>";
    for (var j = 0; j < unit_list.length; j++) {
        unit_html += "<option value='"+unit_list[j].unit_id+"'>"+unit_list[j].unit_name+"</option>";
    }

    var price_component_html = "<option value=''>Select Component</option>";
    for (var j = 0; j < price_component_list.length; j++) {
        if(price_component_list[j].price_group_id=='4') {
            price_component_html += "<option value='"+price_component_list[j].price_component_id+"'>"+price_component_list[j].price_component_name+"</option>";
        }
    }
    
    var html = "<div class='row margin-plc plc_"+timestamp+"' style='margin-bottom: 15px;'> <input type='hidden' name='plc_detail["+timestamp+"][product_plc_detail_id]' value=''> <div class='col-md-4 col-sm-4 col-xs-12'> <label for='area'>Select Component:</label> <select class='form-control' id='a_box' name='plc_detail["+timestamp+"][price_comp_id]'>"+price_component_html+"</select> </div> <div class='col-md-4 col-sm-4 col-xs-8'> <div class='row'> <div class='col-md-6 col-sm-6 col-xs-6'> <label for='area'>Price:</label> <input type='text' name='plc_detail["+timestamp+"][price]' class='form-control' id='area' value=''> </div> <div class='col-md-6 col-sm-6 col-xs-6 pplcing-left-none'> <label onclick='plcCheckboxGST("+timestamp+")'><input class='checkgst' type='checkbox' id='chkgst_plc_"+timestamp+"' name='plc_detail["+timestamp+"][gst_check]' value='1' > &nbsp;&nbsp;GST</label> <div class='dvGst2' style=''> <input class='form-control inputgst_plc_"+timestamp+"' style='display: none;' type='text' name='plc_detail["+timestamp+"][gst]' id='txtGstNumber' placeholder='Enter GST value'> </div> </div> </div> </div> <div class='col-md-3 col-sm-3 col-xs-4 pplcing-left-none'> <label for='area'>Unit:</label> <select class='form-control' id='a_box2' name='plc_detail["+timestamp+"][unit]'>"+unit_html+"</select> </div> <div class='col-md-1 col-sm-1 col-xs-12'> <label class='blank' for='blank'> &nbsp; </label> <div class='plc_field_button3'><i class='fa fa-plus-circle cp' style='font-size: 18px;' aria-hidden='true' onclick='addInputRowPLC(&quot;plc_"+timestamp+"&quot;)'></i> <i class='fa fa-minus-circle text-danger cp' style='display: none;font-size: 18px;' aria-hidden='true' onclick='removeInputRowPLC(&quot;plc_"+timestamp+"&quot;)'></i></div> </div> </div>";

    $(".input_fields_plc").append(html);    

}

function input_fields_plc_update(blocks) {
    var html = "";
    for (var i = 0; i < blocks.length; i++) {
        var timestamp = blocks[i].product_plc_detail_id;

        var minus = "";
        var plus = "none";
        if (blocks.length-1==i) {
            minus = "none";
            plus = "";
        }

        var unit_html = "<option value=''>Select Unit</option>";
        for (var j = 0; j < unit_list.length; j++) {
            var selected = "";
            if (blocks[i]['unit']==unit_list[j].unit_id) { selected = "selected"; }
            unit_html += "<option value='"+unit_list[j].unit_id+"' "+selected+">"+unit_list[j].unit_name+"</option>";
        }

        var price_component_html = "<option value=''>Select Component</option>";
        for (var j = 0; j < price_component_list.length; j++) {
            if(price_component_list[j].price_group_id=='4') {
                var selected = "";
                if (blocks[i]['price_comp_id']==price_component_list[j].price_component_id) { selected = "selected"; }
                price_component_html += "<option value='"+price_component_list[j].price_component_id+"' "+selected+">"+price_component_list[j].price_component_name+"</option>";
            }
        }

        var chk = "";
        var input_show = "none";
        if (blocks[i].gst!='0.00') {
            chk = "checked";
            input_show = "";
        }
        
        html += "<div class='row margin-plc plc_"+timestamp+"' style='margin-bottom: 15px;'> <input type='hidden' name='plc_detail["+timestamp+"][product_plc_detail_id]' value='"+blocks[i].product_plc_detail_id+"'> <div class='col-md-4 col-sm-4 col-xs-12'> <label for='area'>Select Component:</label> <select class='form-control' id='a_box' name='plc_detail["+timestamp+"][price_comp_id]'>"+price_component_html+"</select> </div> <div class='col-md-4 col-sm-4 col-xs-8'> <div class='row'> <div class='col-md-6 col-sm-6 col-xs-6'> <label for='area'>Price:</label> <input type='text' name='plc_detail["+timestamp+"][price]' class='form-control' id='area' value='"+blocks[i].price+"'> </div> <div class='col-md-6 col-sm-6 col-xs-6 pplcing-left-none'> <label onclick='plcCheckboxGST("+timestamp+")'><input class='checkgst' type='checkbox' id='chkgst_plc_"+timestamp+"' name='plc_detail["+timestamp+"][gst_check]' value='1' "+chk+"> &nbsp;&nbsp;GST</label> <div class='dvGst2' style=''> <input class='form-control inputgst_plc_"+timestamp+"' style='display: "+input_show+";' type='text' name='plc_detail["+timestamp+"][gst]' id='txtGstNumber' placeholder='Enter GST value' value='"+blocks[i].gst+"'> </div> </div> </div> </div> <div class='col-md-3 col-sm-3 col-xs-4 pplcing-left-none'> <label for='area'>Unit:</label> <select class='form-control' id='a_box2' name='plc_detail["+timestamp+"][unit]'>"+unit_html+"</select> </div> <div class='col-md-1 col-sm-1 col-xs-12'> <label class='blank' for='blank'> &nbsp; </label> <div class='plc_field_button3'><i class='fa fa-plus-circle cp' style='font-size: 18px;display:"+plus+";' aria-hidden='true' onclick='addInputRowPLC(&quot;plc_"+timestamp+"&quot;)'></i> <i class='fa fa-minus-circle text-danger cp' style='display:"+minus+";font-size: 18px;' aria-hidden='true' onclick='removeInputRowPLC(&quot;plc_"+timestamp+"&quot;)'></i></div> </div> </div>";

    }
    $(".input_fields_plc").html(html);

}


function plcCheckboxGST(id){
    if($("#chkgst_plc_"+id).is(':checked')){
    $(".inputgst_plc_"+id).show(); 
    } 
    else {
     $(".inputgst_plc_"+id).hide(); 
    }
}

function removeInputRowPLC(id) {
    $("."+id+"").remove();
}

function addInputRowPLC(id) {
    $("."+id+" .fa-plus-circle").hide();
    $("."+id+" .fa-minus-circle").show();
    input_fields_plc();
}

/*input_fields_specification();

function input_fields_specification() {
    $.ajax({
      url: "<?= base_url(ADMIN_URL.'input_fields_specification') ?>",
      success: function(html){
        $(".input_fields_specification").append(html);
      },
      error: function(){
        alert("Some Error Occurred!!");
      }
    });
}*/

function input_fields_specification() {

    var timestamp = Date.now();

    var specification_html = "<option value=''>Select Unit</option>";
    for (var j = 0; j < specification_list.length; j++) {
        specification_html += "<option value='"+specification_list[j].specification_id+"'>"+specification_list[j].specification_name+"</option>";
    }
    
    var html = "<div class='row margin-specification specification_"+timestamp+"' style='margin-bottom: 15px;'> <input type='hidden' name='spec["+timestamp+"][product_specification_id]' value=''> <div class='col-md-4'> <label for='area'>Select Specification:</label> <select class='form-control' id='a_box' name='spec["+timestamp+"][specification_id]'>"+specification_html+"</select> </div> <div class='col-md-7'> <label for='area'>Description:</label> <textarea custom-textarea_ name='spec["+timestamp+"][description]' class='form-control custom-textarea_"+timestamp+"' id='custom-textarea_"+timestamp+"' ></textarea> </div> <div class='col-md-1'> <label class='blank' for='blank'> &nbsp; </label> <div class='specification_field_button3'><i class='fa fa-plus-circle cp' style='font-size: 18px;' aria-hidden='true' onclick='addInputRowSpecification(&quot;specification_"+timestamp+"&quot;)'></i> <i class='fa fa-minus-circle text-danger cp' style='display: none;font-size: 18px;' aria-hidden='true' onclick='removeInputRowSpecification(&quot;specification_"+timestamp+"&quot;)'></i></div> </div>";

    $(".input_fields_specification").append(html);  

    addTinyMCE("#custom-textarea_"+timestamp);

}

function addTinyMCE(id){
  tinymce.init({
    selector: id,
    themes: 'modern',
    height: 200
  });
}

function input_fields_specification_update(blocks) {
    var html = "";
    for (var i = 0; i < blocks.length; i++) {
        var timestamp = blocks[i].product_specification_id;

        var minus = "";
        var plus = "none";
        if (blocks.length-1==i) {
            minus = "none";
            plus = "";
        }

        var specification_html = "<option value=''>Select Unit</option>";
        for (var j = 0; j < specification_list.length; j++) {
            var selected = "";
            if (blocks[i]['product_specification_id']==specification_list[j].specification_id) { selected = "selected"; }
            specification_html += "<option value='"+specification_list[j].specification_id+"' "+selected+">"+specification_list[j].specification_name+"</option>";
        }
        
        html += "<div class='row margin-specification specification_"+timestamp+"' style='margin-bottom: 15px;'> <input type='hidden' name='spec["+timestamp+"][product_specification_id]' value='"+blocks[i].product_specification_id+"'> <div class='col-md-4'> <label for='area'>Select Specification:</label> <select class='form-control' id='a_box' name='spec["+timestamp+"][specification_id]'>"+specification_html+"</select> </div> <div class='col-md-7'> <label for='area'>Description:</label> <textarea name='spec["+timestamp+"][description]' class='form-control custom-textarea_"+timestamp+"' id='custom-textarea_"+timestamp+"' >"+blocks[i].description+"</textarea> </div> <div class='col-md-1'> <label class='blank' for='blank'> &nbsp; </label> <i class='fa fa-plus-circle cp' style='font-size: 18px;display:"+plus+";' aria-hidden='true' onclick='addInputRowSpecification(&quot;specification_"+timestamp+"&quot;)'></i> <i class='fa fa-minus-circle text-danger cp' style='display:"+minus+";font-size: 18px;' aria-hidden='true' onclick='removeInputRowSpecification(&quot;specification_"+timestamp+"&quot;)'></i></div> </div>";

    }
    $(".input_fields_specification").html(html);

    for (var i = 0; i < blocks.length; i++) {
      var timestamp = blocks[i].product_specification_id;
      addTinyMCE("#custom-textarea_"+timestamp);
    }

}

function removeInputRowSpecification(id) {
    $("."+id+"").remove();
}

function addInputRowSpecification(id) {
    $("."+id+" .fa-plus-circle").hide();
    $("."+id+" .fa-minus-circle").show();
    input_fields_specification();
}

input_fields_property_image();

function input_fields_property_image() {
    var timestamp = Date.now();
    var html = "<div class='row margin-add property_image_"+timestamp+"' style='margin-bottom: 15px;'> <div class='col-md-10 col-sm-10 col-xs-10'> <!--<label for='title'>Upload image:</label>--> <input type='hidden' name='project_image_id["+timestamp+"]' class='form-control' value='"+timestamp+"'> <input type='file' name='project_image_"+timestamp+"' class='form-control input_"+timestamp+"' style='display: none;' accept='image/jpg,image/jpeg,image/png'> <div> <button type='button' class='btn btn-primary btn-block btn_"+timestamp+"' style='height: calc(2.0625rem + 2px);padding: 0px 10px;' onclick='browseFile(&quot;"+timestamp+"&quot;)'><i class='fa fa-upload'></i> &nbsp;Upload</button> </div><div class='span_"+timestamp+"' style='margin-top: 3px;'></div> </div> <div class='col-md-2 col-sm-2 col-xs-2'><div class='add_field_button3'><i class='fa fa-plus-circle cp' style='font-size: 30px;' aria-hidden='true' onclick='addInputRowProperty_image(&quot;property_image_"+timestamp+"&quot;)'></i> <i class='fa fa-minus-circle text-danger cp' style='display: none;font-size: 30px;' aria-hidden='true' onclick='removeInputRowProperty_image(&quot;property_image_"+timestamp+"&quot;)'></i></div> </div> </div>";
    $(".input_fields_property_image").append(html);
}

function removeInputRowProperty_image(id) {
    $("."+id+"").remove();
}

function addInputRowProperty_image(id) {
    $("."+id+" .fa-plus-circle").hide();
    $("."+id+" .fa-minus-circle").show();
    input_fields_property_image();
}
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
            $("#location").html("<option value=''>Select Location</option>");
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

$('input[type=radio][name=parking_type]').change(function() {
    parkingType();
});

$("#step-2-form").validate({
    rules: {
    },
    messages: {
    },
    submitHandler: function(form) {
      tinymce.triggerSave();

      var myform = document.getElementById("step-2-form");
      var fd = new FormData(myform );
      fd.append('view_only', 1);

      $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'/api/product_save2') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".error-msg").html('');
          $(".form-btn-2").html("<i class='fa fa-circle-o-notch fa-spin'></i>").prop('disabled',true);
          $(".loader_progress").show();
        },
        success: function (response) {
          //$(".response-data").html(response);
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".form-btn-2").html("Next").prop('disabled',false);
                $(".loader_progress").hide();

                if (obj.status=='success') {

                    //$(".error-msg").html(alertMessage('success',obj.message));
                    $('html, body').animate({
                        scrollTop: $(".header-content").offset().top
                    }, 1000);

                    var additional_details = obj.additional_details;
                    if (additional_details.length!=0) {
                        input_fields_additional_update(additional_details);
                    }
                    else {
                        input_fields_additional();
                    }

                    var plc_details = obj.plc_details;
                    if (plc_details.length!=0) {
                        input_fields_plc_update(plc_details);
                    }
                    else {
                        input_fields_plc();
                    }

                    var product_specifications = obj.product_specifications;
                    if (product_specifications.length!=0) {
                        input_fields_specification_update(product_specifications);
                    }
                    else {
                        input_fields_specification();
                    }

                    var record = obj.record;
                    $("#authority_approval").val(record.authority_approval);
                    $("#description").val(record.description);

                    var cc_certificate = record.cc_certificate;
                    if (cc_certificate=='1') {
                        $('input:radio[name="cc_certificate"][value="1"]').attr('checked',true);
                    }
                    else if (cc_certificate=='0') {
                        $('input:radio[name="cc_certificate"][value="0"]').attr('checked',true);
                    }

                    var oc_certificate = record.oc_certificate;
                    if (oc_certificate=='1') {
                        $('input:radio[name="oc_certificate"][value="1"]').attr('checked',true);
                    }
                    else if (oc_certificate=='0') {
                        $('input:radio[name="oc_certificate"][value="0"]').attr('checked',true);
                    }

                    if (record.project_logo!=null && record.project_logo!='') {
                        $("#project_logo_view").html("<img style='margin-top:8px;height:50px;width:50px;' src='<?= base_url('uploads/images/project/logo/') ?>"+record.project_logo+"' >");
                    }
                    else {
                        $("#project_logo_view").html('');
                    }

                    if (record.banner_image!=null && record.banner_image!='') {
                        $("#banner_image_view").html("<img style='margin-top:8px;height:50px;width:50px;' src='<?= base_url('uploads/images/project/banner/') ?>"+record.banner_image+"' >");
                    }
                    else {
                        $("#banner_image_view").html('');
                    }

                    var product_images = obj.product_images;
                    var project_upload_images = "";
                  for (var i = 0; i<product_images.length; i++) {
                    project_upload_images += "<div class='project-image-item project-image-item-"+product_images[i].product_image_id+"'> <span class='project-image-item-remove' onclick='removeProductImage("+product_images[i].product_image_id+")'></span> <img src='<?= base_url('uploads/images/project/image/') ?>"+product_images[i].product_image+"' style='width: 70px;height: 70px;'> </div>";
                  }
                    $("#project_upload_images").html(project_upload_images);

                    step2Next();
                }
                else {
                  $(".error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".form-btn-2").html("Next").prop('disabled',false);
                $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
                $(".loader_progress").hide();
              }
          },500);
        },
        error: function () {
            $(".form-btn-2").html("Next").prop('disabled',false);
          $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
            $(".loader_progress").hide();
           
        }

    });

    }
});

$("#step-3-form").validate({
    rules: {
    },
    messages: {
    },
    submitHandler: function(form) {
      var myform = document.getElementById("step-3-form");
      var fd = new FormData(myform );
      fd.append('view_only', 1);

      $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'/api/product_save3') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".error-msg").html('');
          $(".form-btn-3").html("<i class='fa fa-circle-o-notch fa-spin'></i>").prop('disabled',true);
          $(".loader_progress").show();
        },
        success: function (response) {
          //$(".response-data").html(response);
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".form-btn-3").html("Update").prop('disabled',false);
                $(".loader_progress").hide();

                if (obj.status=='success') {

                    //$(".error-msg").html(alertMessage('success',obj.message));
                    //$('html, body').animate({
                    //    scrollTop: $(".header-content").offset().top
                    //}, 1000);

                    window.location.href="<?= base_url(ADMIN_URL.'products') ?>";

                }
                else {
                  $(".error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".form-btn-3").html("Update").prop('disabled',false);
                $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
                $(".loader_progress").hide();
              }
          },500);
        },
        error: function () {
            $(".form-btn-3").html("Update").prop('disabled',false);
          $(".error-msg").html(alertMessage('error','Some error occurred, please try again.'));
            $(".loader_progress").hide();
           
        }

    });

    }
});

function removeProductImage(id) {
    $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'/api/delete_product_image') ?>",
        data: {id:id},
        beforeSend: function (data) {
          $(".error-msg-img").html('');
          $(".loader_progress").show();
        },
        success: function (response) {
          $(".response-data").html(response);
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".loader_progress").hide();

                if (obj.status=='success') {

                    $(".project-image-item-"+id).remove();
                    $(".error-msg-img").html(alertMessage('success',obj.message));

                }
                else {
                  $(".error-msg-img").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".error-msg-img").html(alertMessage('error','Some error occurred, please try again.'));
                $(".loader_progress").hide();
              }
          },500);
        },
        error: function () {
          $(".error-msg-img").html(alertMessage('error','Some error occurred, please try again.'));
            $(".loader_progress").hide();
           
        }

    });
}

function getBuilders(builder_group_id) {
  $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/get_builders') ?>",
        data: {builder_group_id:builder_group_id},
        beforeSend: function (data) {
        },
        success: function (response) {
          console.log(response);
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status=='success') {
              var builder_list = obj.builder_list;
              var row = "<option value=''>Select Builder</option>";
              for (var i = 0; i<builder_list.length; i++) {
                row += "<option value='"+builder_list[i].builder_id+"'>"+builder_list[i].firm_name+"</option>";
              }
              $("#builder_id").html(row);
            }
            else {
              $("#builder_id").html("<option value=''>Select Builder</option>");
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

if ($("#project_type").val()==3) {
    $(".PropertyHide").hide();
  }
  else {

    $(".PropertyHide").show();
  }

function getUnitTypes() {
  
  if ($("#project_type").val()==3) {
    $(".PropertyHide").hide();
  }
  else {

    $(".PropertyHide").show();
  }
  
  $(".comm_detail").html("");
    $(".comm_block_detail").html("");
    if ($("#project_type").val()=='3') {
      $(".comm_detail_main").show();
    }
    else {
      $(".comm_detail_main").hide();
    }

  if ($("#project_type").val()=='3') {
    //propertType('1');
    //getUnitDetails();
    propertType('2');
  }
  else {
    $("#property_type").html("<option value=''>Select Property Type</option>");

    /*$(".comm_detail").html("");
    $(".comm_block_detail").html("");
    if ($("#project_type").val()=='3' && $("#property_type").val()!='') {
      $(".comm_detail_main").show();
    }
    else {
      $(".comm_detail_main").hide();
    }*/
    var product_type_id = $("#project_type").val();
    $.ajax({
          type: "POST",
          url: "<?= base_url(ADMIN_URL.'api/get_unit_types') ?>",
          data: {product_type_id:product_type_id},
          beforeSend: function (data) {
          },
          success: function (response) {
            //console.log(response);
            var obj;
            try {
              obj = JSON.parse(response);
              if (obj.status=='success') {
                var unit_type_list = obj.unit_type_list;
                var row = "<option value=''>Select Property Type</option>";
                for (var i = 0; i<unit_type_list.length; i++) {
                  row += "<option value='"+unit_type_list[i].unit_type_id+"'>"+unit_type_list[i].unit_type_name+"</option>";
                }
                $("#property_type").html(row);
              }
              else {
                $("#property_type").html("<option value=''>Select Property Type</option>");
              }
              propertType('1');
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
}

function getUnitDetails() {

  var property_type = $("#property_type").val();
  var project_type = $("#project_type").val();
  var product_id = "<?= $id ?>";
  $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/get_unit_details') ?>",
        data: {property_type:property_type,project_type:project_type,product_id:product_id},
        beforeSend: function (data) {
        },
        success: function (response) {
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status=='success') {

              if ($("#project_type").val()=='3') {
                var unit_details = obj.unit_details;
                if (unit_details.length==0) {
                  addRowComm('','comm_detail');
                }
                else {
                  commDetail(unit_details,0);
                }

                var comm_block_details = obj.comm_block_details;
                if (comm_block_details.length==0) {
                  addRowCommBlock('','comm_block_detail');
                }
                else {
                  commDetailBlock(comm_block_details,0);
                }
              }

              if ($("#project_type").val()=='2') {
                $(".flat_block_detail").html("");
                $(".flat_unit_detail").html("");
                $(".villa_detail").html("");
                $(".plot_detail").html("");

                var pblocks = obj.blocks;
                if (pblocks.length==0) {
                  addRow('','flat_block_detail');
                }
                else {
                  flatBlockDetail(pblocks,1);
                }

                var pfut = obj.product_flat_unit_details;
                if (pfut.length==0) {
                  addRow('','flat_unit_detail');
                }
                else {
                  flatUnitDetail(pfut,1);
                }

                var pvut = obj.product_villa_unit_details;
                if (pvut.length==0) {
                  addRow('','villa_detail');
                }
                else {
                  villaUnitDetail(pvut,1);
                }

                var pput = obj.product_plot_unit_details;
                if (pput.length==0) {
                  addRow('','plot_detail');
                }
                else {
                  plotUnitDetail(pput,1);
                }
              }
              
            }
            else {
              alert('Some error occurred, please try again.');
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



function commDetailBlock(blocks,n) {
    var ht = "";
    type = 'comm_block_detail';

    for (var i = 0; i < blocks.length; i++) {

        var timestamp = blocks[i]['block_id'];
        var t = type+"_"+timestamp;

        var minus = "";
        var plus = "none";
        if (blocks.length-1==i) {
            minus = "none";
            plus = "";
        }

        var plus_minus = "<div class='"+t+"'><i class='fa fa-plus-circle cp' style='display:"+plus+";' aria-hidden='true' onclick='addRowCommBlock(&quot;"+t+"&quot;,&quot;"+type+"&quot;)'></i> <i class='fa fa-minus-circle text-danger cp' style='display:"+minus+"' aria-hidden='true' onclick='removeRow(&quot;"+t+"&quot;)'></i></div>";
        
        ht += "<tr> <td>"+plus_minus+"</td> <td><input class='form-control' type='hidden' name='comm_block["+timestamp+"][block_id]' value='"+blocks[i]['block_id']+"'><input class='form-control' type='text' name='comm_block["+timestamp+"][block_name]' value='"+blocks[i]['block_name']+"' style='width:80px;'></td> <td><input class='form-control' type='text' name='comm_block["+timestamp+"][no_of_floor]' value='"+blocks[i]['no_of_floor']+"' style='width:80px;'></td>  <td><input class='form-control' type='text' name='comm_block["+timestamp+"][unit_per_floor]' value='"+blocks[i]['unit_per_floor']+"' style='width:80px;'></td> <td><input class='form-control' type='text' name='comm_block["+timestamp+"][no_of_ps_lift]' value='"+blocks[i]['no_of_ps_lift']+"' style='width:80px;'></td> <td><input class='form-control' type='text' name='comm_block["+timestamp+"][no_of_service_lift]' value='"+blocks[i]['no_of_service_lift']+"' style='width:80px;'></td> <td><input class='form-control mydatepicker' type='text' placeholder='dd-mm-yyyy' name='comm_block["+timestamp+"][edp]' value='"+blocks[i]['edp']+"'></td> </tr>";
    }

    $("."+type).html(ht);
}

function addRowCommBlock(id,type) {
    if (id!='') {
        $("."+id+" .fa-plus-circle").hide();
        $("."+id+" .fa-minus-circle").show();
    }

    var timestamp = Date.now();


    var t = type+"_"+timestamp;

    var plus_minus = "<div class='"+t+"'><i class='fa fa-plus-circle cp' aria-hidden='true' onclick='addRowCommBlock(&quot;"+t+"&quot;,&quot;"+type+"&quot;)'></i> <i class='fa fa-minus-circle text-danger cp' style='display: none;' aria-hidden='true' onclick='removeRow(&quot;"+t+"&quot;)'></i></div>";

    if (type == 'comm_block_detail') {

        var ht = "<tr> <td>"+plus_minus+"</td> <td><input class='form-control' type='hidden' name='comm_block["+timestamp+"][block_id]' value=''><input class='form-control' type='text' name='comm_block["+timestamp+"][block_name]' style='width:80px;'></td> <td><input class='form-control' type='text' name='comm_block["+timestamp+"][no_of_floor]' style='width:80px;'></td> <td><input class='form-control' type='text' name='comm_block["+timestamp+"][unit_per_floor]' style='width:80px;'></td> <td><input class='form-control' type='text' name='comm_block["+timestamp+"][no_of_ps_lift]' style='width:80px;'></td> <td><input class='form-control' type='text' name='comm_block["+timestamp+"][no_of_service_lift]' style='width:80px;'></td> <td><input class='form-control mydatepicker' type='text' placeholder='dd-mm-yyyy' name='comm_block["+timestamp+"][edp]'></td> </tr>";

        $("."+type).append(ht);

    }

    $('.mydatepicker').datepicker();
}

function commDetail(blocks,n) {
    var ht = "";
    type = 'comm_detail';

    for (var i = 0; i < blocks.length; i++) {

        var timestamp = blocks[i]['product_unit_detail_id'];
        var t = type+"_"+timestamp;

        var minus = "";
        var plus = "none";
        if (blocks.length-1==i) {
            minus = "none";
            plus = "";
        }

        var unit_html = "<option value=''>--Select--</option>";
        for (var j = 0; j < comm_product_unit_type_list.length; j++) {
            var selected = "";
            if (blocks[i]['sub_category']==comm_product_unit_type_list[j].unit_type_id) { selected = "selected"; }
            unit_html += "<option value='"+comm_product_unit_type_list[j].unit_type_id+"' "+selected+">"+comm_product_unit_type_list[j].unit_type_name+"</option>";
        }

        var plus_minus = "<div class='"+t+"'><i class='fa fa-plus-circle cp' style='display:"+plus+";' aria-hidden='true' onclick='addRowComm(&quot;"+t+"&quot;,&quot;"+type+"&quot;)'></i> <i class='fa fa-minus-circle text-danger cp' style='display:"+minus+"' aria-hidden='true' onclick='removeRow(&quot;"+t+"&quot;)'></i></div>";

        var sa_unit_html = "<select class='form-control unit-select' name='comm_unit["+timestamp+"][unit]' style='width:120px;'>";
            sa_unit_html += "<option value=''>Select Unit</option>";
        for (var j = 0; j < unit_list.length; j++) {
            var selected = "";
            if (blocks[i]['unit']==unit_list[j].unit_id) { selected = "selected"; }
            sa_unit_html += "<option value='"+unit_list[j].unit_id+"' "+selected+">"+unit_list[j].unit_name+"</option>";
        }
        sa_unit_html += "</select>";
        
        ht += "<tr> <td>"+plus_minus+"</td> <td><input class='form-control' type='hidden' name='comm_unit["+timestamp+"][product_unit_detail_id]' value='"+blocks[i]['product_unit_detail_id']+"'><input class='form-control' type='text' name='comm_unit["+timestamp+"][code]' value='"+blocks[i]['code']+"' style='width:80px;'></td> <td><input class='form-control' type='text' name='comm_unit["+timestamp+"][no_of_unit]' value='"+blocks[i]['no_of_unit']+"' style='width:80px;'></td> <td><input class='form-control' type='text' name='comm_unit["+timestamp+"][ca]' value='"+blocks[i]['ca']+"' style='width:80px;'></td> <td><input class='form-control' type='text' name='comm_unit["+timestamp+"][ba]' value='"+blocks[i]['ba']+"' style='width:80px;'></td> <td><input class='form-control' type='text' name='comm_unit["+timestamp+"][sa]' value='"+blocks[i]['sa']+"' style='width:80px;'></td> <td>"+sa_unit_html+"</td> <td><input class='form-control' type='text' name='comm_unit["+timestamp+"][dimension]' value='"+blocks[i]['dimension']+"' style='width:80px;'></td> <td><select class='form-control' name='comm_unit["+timestamp+"][sub_category]'>"+unit_html+"</select></td> </tr>";
    }

    $("."+type).html(ht);
}

function addRowComm(id,type) {
    if (id!='') {
        $("."+id+" .fa-plus-circle").hide();
        $("."+id+" .fa-minus-circle").show();
    }

    var timestamp = Date.now();


    var t = type+"_"+timestamp;

    var unit_html = "<option value=''>--Select--</option>";
    for (var j = 0; j < comm_product_unit_type_list.length; j++) {
        var selected = "";
        //if (blocks[i]['sub_category']==comm_product_unit_type_list[j].unit_type_id) { selected = "selected"; }
        unit_html += "<option value='"+comm_product_unit_type_list[j].unit_type_id+"' "+selected+">"+comm_product_unit_type_list[j].unit_type_name+"</option>";
    }


    var plus_minus = "<div class='"+t+"'><i class='fa fa-plus-circle cp' aria-hidden='true' onclick='addRowComm(&quot;"+t+"&quot;,&quot;"+type+"&quot;)'></i> <i class='fa fa-minus-circle text-danger cp' style='display: none;' aria-hidden='true' onclick='removeRow(&quot;"+t+"&quot;)'></i></div>";

    if (type == 'comm_detail') {

        var sa_unit_html = "<select class='form-control unit-select' name='comm_unit["+timestamp+"][unit]' style='width:120px;'>";
            sa_unit_html += "<option value=''>Select Unit</option>";
        for (var j = 0; j < unit_list.length; j++) {
            var selected = "";
            //if (blocks[i]['unit']==unit_list[j].unit_id) { selected = "selected"; }
            sa_unit_html += "<option value='"+unit_list[j].unit_id+"' "+selected+">"+unit_list[j].unit_name+"</option>";
        }
        sa_unit_html += "</select>";

        var ht = "<tr> <td>"+plus_minus+"</td> <td><input class='form-control' type='hidden' name='comm_unit["+timestamp+"][product_unit_detail_id]' value=''><input class='form-control' type='text' name='comm_unit["+timestamp+"][code]' style='width:80px;'></td> <td><input class='form-control' type='text' name='comm_unit["+timestamp+"][no_of_unit]' style='width:80px;'></td> <td><input class='form-control' type='text' name='comm_unit["+timestamp+"][ca]' style='width:80px;'></td> <td><input class='form-control' type='text' name='comm_unit["+timestamp+"][ba]' style='width:80px;'></td> <td><input class='form-control' type='text' name='comm_unit["+timestamp+"][sa]' style='width:80px;'></td> <td>"+sa_unit_html+"</td> <td><input class='form-control' type='text' name='comm_unit["+timestamp+"][dimension]' style='width:80px;'></td> <td><select class='form-control' name='comm_unit["+timestamp+"][sub_category]'>"+unit_html+"</select></td> </tr>";

        $("."+type).append(ht);

    }

    $('.mydatepicker').datepicker();
}

function getLocation(city_id) {
  $.ajax({
        type: "POST",
        url: "<?= base_url(ADMIN_URL.'api/get_locations') ?>",
        data: {city_id:city_id},
        beforeSend: function (data) {
        },
        success: function (response) {
          console.log(response);
          var obj;
          try {
            obj = JSON.parse(response);
            if (obj.status=='success') {
              var location_list = obj.location_list;
              var row = "<option value=''>Select Location</option>";
              for (var i = 0; i<location_list.length; i++) {
                row += "<option value='"+location_list[i].location_id+"'>"+location_list[i].location_name+"</option>";
              }
              $("#location").html(row);
            }
            else {
              $("#location").html("<option value=''>Select Location</option>");
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