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
</style>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css">
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
                                <h4 class="card-title">Add New Product</h4>
                                <div class="basic-form">

                                    <div class="step-1">
                                    <form>
                                            <div class="form-row">

                                            	<div class="form-group col-md-6">
                                                    <label>Group:</label>
                                                    <select class="form-control">
                                                      <option value="">Select Group</option>
                                                      <option value="Raman">Raman</option>
                                                      <option value="Mukesh">Mukesh</option>
                                                      <option value="Rohit">Rohit</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Project Name:</label>
                                                    <input type="text" class="form-control" placeholder="">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Project Status:</label>
                                                    <select class="form-control">
                                                      <option value="">Select Status</option>
    								                  <option value="Upcomming">Upcomming Project</option>
    								                  <option value="Ongoing">Ongoing Project</option>
    								                  <option value="Past">Past Project</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Rera Application :</label>
                                                    <select class="form-control" id="rera_application" onchange="reraApplication()">
    								                  <option value="Not Applicable">Not Applicable</option>
    								                  <option value="Applied For">Applied For</option>
                                                      <option value="Registred">Registred</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <div class="input-rera-no" style="display: none;">
                                                        <label>Rera No:</label>
                                                        <input type="text" class="form-control" placeholder="">
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Type of Project:</label>
                                                    <select class="form-control">
                                                          <option value="">Select project type</option>
    									                  <option value="1">Residencial</option>
    									                  <option value="2">Commercial</option>
    									                  <option value="3">Both</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Date of commisment:</label>
                                                    <input type="date" class="form-control" placeholder="">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Total Land Area:</label>
                                                    <div class="row">
                                                    	<div class="col-md-7 col-sm-7 col-xs-7">
                                                    		<input type="text" class="form-control" placeholder="">
                                                    	</div>
                                                    	<div class="col-md-5 col-sm-5 col-xs-5 mg-10">
                                                    		<select class="form-control">
    		                                                      <option value="">Select Unit</option>
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
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Total Builtup Area:</label>
                                                    <div class="row">
                                                    	<div class="col-md-7 col-sm-7 col-xs-7">
                                                    		<input type="text" class="form-control" placeholder="">
                                                    	</div>
                                                    	<div class="col-md-5 col-sm-5 col-xs-5 mg-10">
                                                    		<select class="form-control">
    		                                                      <option value="">Select Unit</option>
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
                                                </div>

                                                <div class="form-group col-md-12">
                                                	<h5 style="padding: 0px;margin: 0px;">Land Detail:</h5>
                                            	</div>

                                                <div class="form-group col-md-4">
                                                    <label>State:</label>
                                                    <input type="text" class="form-control" placeholder="city">
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label>City:</label>
                                                    <input type="text" class="form-control" placeholder="city">
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label>Location:</label>
                                                    <input type="text" class="form-control" placeholder="location">
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label>Address:</label>
                                                    <textarea class="form-control" rows="2" placeholder="Address"></textarea>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Latitude:</label>
                                                    <input type="text" class="form-control" placeholder="Lat">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Longitude:</label>
                                                    <input type="text" class="form-control" placeholder="Long">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label>Type of Property:</label>
                                                    
                                            		<select class="form-control" id="property_type" onchange="propertType()" required="">
                                                          <option value="">Select property type</option>
    									                  <option value="Flat">Flat</option>
    									                  <option value="Villa">Villa</option>
    									                  <option value="Plot">Plot</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-12">
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
                                                              <tr>
                                                                <td><div class="flat_block_detail_<?= time() ?>"><i class="fa fa-plus-circle cp" aria-hidden="true" onclick="addRow('flat_block_detail_<?= time() ?>','flat_block_detail')"></i> <i class="fa fa-minus-circle text-danger cp" style="display: none;" aria-hidden="true" onclick="removeRow('flat_block_detail_<?= time() ?>')"></i></div></td>
                                                                <td><input class="form-control" type="text" name="block[0][block_name_1]" style="width:80px;"></td>
                                                                <td><input class="form-control" type="text" name="block[0][no_of_floor_1]" style="width:80px;"></td>
                                                                <td><input class="form-control" type="text" name="block[0][no_of_flat_1]" style="width:80px;"></td>
                                                                <td><input class="form-control" type="text" name="block[0][unit_per_floor_1]" style="width:80px;"></td>
                                                                <td><input class="form-control" type="text" name="block[0][no_of_ps_lift_1]" style="width:80px;"></td>
                                                                <td><input class="form-control" type="text" name="block[0][no_of_service_lift_1]" style="width:80px;"></td>
                                                                <td><input class="form-control" type="date" name="block[0][edp_1]"></td>
                                                              </tr>
                                                            </tbody>
                                                          </table>
                                                        </div>

                                                        <h5 style="margin-top: 15px;">Unit Details (Flat & Builder Floor)</h5>

                                                        <div class="table-responsive scrollbar">          
                                                          <table class="table table-bordered">
                                                            <thead>
                                                              <tr>
                                                                <th>&nbsp;  </th>
                                                                <th>Nos. Of Unit</th>
                                                                <th>C.A.</th>
                                                                <th>B.A.</th>
                                                                <th>S.A.</th>
                                                                <th>NO of Bedroom</th>
                                                                <th>No of Bathroom</th>
                                                                <th>Accomodation</th>
                                                                <th>Basic Cost</th>
                                                                <th>Club Membership Charges</th>
                                                                <th>Upload</th>

                                                              </tr>
                                                            </thead>
                                                            <tbody class="flat_unit_detail">
                                                              <tr>
                                                                <td><div class="flat_unit_detail_<?= time() ?>"><i class="fa fa-plus-circle cp" aria-hidden="true" onclick="addRow('flat_unit_detail_<?= time() ?>','flat_unit_detail')"></i> <i class="fa fa-minus-circle text-danger cp" style="display: none;" aria-hidden="true" onclick="removeRow('flat_unit_detail_<?= time() ?>')"></i></div></td>
                                                                <td><input class="form-control" type="text" name="unit[0][no_of_unit]" style="width:80px;"></td>
                                                                <td><input class="form-control" type="text" name="unit[0][ca]" style="width:80px;"></td>
                                                                <td><input class="form-control" type="text" name="unit[0][ba]" style="width:80px;"></td>
                                                                <td><input class="form-control" type="text" name="unit[0][sa]" style="width:80px;"></td>
                                                                <td><input class="form-control" type="text" name="unit[0][no_of_bedroom1]" style="width:80px;"></td>
                                                                <td><input class="form-control" type="text" name="unit[0][no_of_bathroom1]" style="width:80px;"></td>
                                                                <td><select class="form-control" id="accom" name="unit[0][accomotation_1]">
                                                                  <option> Select Accomodation </option>
                                                                              <option value="1 BHK">1 BHK</option>
                                                                              <option value="2 BHK">2 BHK</option>
                                                                              <option value="3 BHK">3 BHK</option>
                                                                              <option value="4 BHK">4 BHK</option>
                                                                              <option value="3 BHK + Servant ">3 BHK + Servant </option>
                                                                          </select></td>
                                                                <td><input class="form-control" type="text" name="unit[0][basic_cost]" style="width:80px;"></td>
                                                                <td><input class="form-control" type="text" name="unit[0][charges]" style="width:80px;"></td>
                                                                <td><input class="form-control" style="width: 230px;" type="file" name="flat_image_0"></td>
                                                              </tr>
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
                                                                  <tr>
                                                                    <td><div class="villa_detail_<?= time() ?>"><i class="fa fa-plus-circle cp" aria-hidden="true" onclick="addRow('villa_detail_<?= time() ?>','villa_detail')"></i> <i class="fa fa-minus-circle text-danger cp" style="display: none;" aria-hidden="true" onclick="removeRow('villa_detail_<?= time() ?>')"></i></div></td>
                                                                    <td>
                                                                    <div class="row" style="width: 330px;">
                                                                        <div class="col-md-6">
                                                                            <input class="form-control unit-select" type="text" name="unit[0][plot_size_1]" style="">
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
                                                                    <td><input class="form-control" type="text" name="unit[0][dimension_1]" style="width: 120px;"></td>
                                                                    <td>
                                                                    <select class="form-control unit-select" id="facing" name="unit[0][facing_1]" style="width: 120px;">
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
                                                                    <td><select class="form-control" id="accom" name="unit[0][accomotation_1]" style="width: 180px;">
                                                                      <option> Select Accomodation </option>
                                                                                  <option value="1 BHK">1 BHK</option>
                                                                                  <option value="2 BHK">2 BHK</option>
                                                                                  <option value="3 BHK">3 BHK</option>
                                                                                  <option value="4 BHK">4 BHK</option>
                                                                                  <option value="3 BHK + Servant ">3 BHK + Servant </option>
                                                                              </select></td>
                                                                    <td><input class="form-control" type="text" name="unit[0][no_of_floor_1]" style="width: 120px;"></td>
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
                                                                  </tr>
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
                                                                  <tr>
                                                                    <td><div class="plot_detail_<?= time() ?>"><i class="fa fa-plus-circle cp" aria-hidden="true" onclick="addRow('plot_detail_<?= time() ?>','plot_detail')"></i> <i class="fa fa-minus-circle text-danger cp" style="display: none;" aria-hidden="true" onclick="removeRow('plot_detail_<?= time() ?>')"></i></div></td>
                                                                   
                                                                    <td>
                                                                        <div class="row" style="width: 330px;">
                                                                            <div class="col-md-6">
                                                                                <input class="form-control unit-select" type="text" name="unit[0][plot_size_1]">
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
                                                                    <td><input class="form-control" type="text" name="unit[0][dimension_1]" style="width: 100px;"></td>
                                                                    <td>
                                                                    <select class="form-control unit-select" name="unit[0][facing_1]" id="facing" style="width: 150px;">
                                                                     
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
                                                                  </tr>
                                                                </tbody>
                                                              </table>

                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <div align="right">
                                            	<button type="button" class="btn btn-dark" onclick="step1Next()">Save & Next</button>
                                            </div>
                                        </form>

                                        </div>

                                        <div class="step-2" style="display: none;">

<form>
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
                  <select class="form-control" id="sel1" name="prop[b_cost_unit]">
                     <option value="">Select Unit</option>
                     <option value="Sq.Yd">Sq.Yd</option>
                     <option value="Sq.Ft">Sq.Ft</option>
                     <option value="Bigha">Bigha</option>
                     <option value="Sq.Mtr">Sq.Mtr</option>
                     <option value="Fix">Fix</option>
                     <option value="% of BSP">% of BSP</option>
                     <option value="Acres">Acres</option>
                  </select>
               </div>
               <div class="col-md-4 col-sm-4 col-xs-4">
                  <label><input class="checkgst" type="checkbox" value="" id="chkgst"> &nbsp;&nbsp;GST</label>
                  <div id="dvGst" style="">
                     <input class="form-control inputgst" type="text" id="txtGstNumber" style="display: none;" placeholder="Enter GST value" name="prop[price_gst]">
                  </div>

               </div>
               <div class="col-md-8 col-sm-8 col-xs-8" style="margin-top: 10px;">
                  <label for="area">Club Cost Unit:</label>
                  <select class="form-control" id="sel1" name="prop[club_cost_unit]">
                     <option value="">Select Unit</option>
                     <option value="Sq.Yd">Sq.Yd</option>
                     <option value="Sq.Ft">Sq.Ft</option>
                     <option value="Bigha">Bigha</option>
                     <option value="Sq.Mtr">Sq.Mtr</option>
                     <option value="Fix">Fix</option>
                     <option value="% of BSP">% of BSP</option>
                     <option value="Acres">Acres</option>
                  </select>
               </div>
               <div class="col-md-4 col-sm-4 col-xs-4" style="margin-top: 10px;">
                  <label><input class="checkgst" type="checkbox" value="" id="chkgst_club"> &nbsp;&nbsp;GST</label>
                  <div id="dvGst_club" style="">
                     <input class="form-control inputgst_club" type="text" id="txtGstNumber" style="display: none;" placeholder="Enter GST value" name="prop[club_gst]">
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
                  <div class="col-md-12 col-sm-12 col-xs-12 parking">
                     <label class="radio-inline">
                     <input type="radio" name="prop[open]" value="Open">
                     Open </label>
                     <label class="radio-inline">
                     <input type="radio" name="prop[cover]" value="Cover">
                     Cover </label>
                     <label class="radio-inline">
                     <input type="radio" name="prop[stilt]" value="Stilt">
                     Stilt </label>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12 col-sm-12 Open boxprice">
                     <div class="form-group">
                        <input type="text" class="form-control" name="prop[o_price]" id="area" placeholder="Price">
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4 padding-left-none">
               <label><input class="checkgst" type="checkbox" value="" id="chkgstprice"> &nbsp;&nbsp;GST</label>
               <div id="dvGstPrice" style="">
                  <input class="form-control inputgst_park" type="text" id="txtGstNumber" style="display: none;" placeholder="Enter GST value" name="prop[parking_gst]">
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
               <select class="multipleSelect form-control" multiple="" name="amenity[]" id="select_amenitie" style="width: 100%;">
                  <option value="">Select Amenities</option>
                  <option value="Lift">Lift</option>
                  <option value="Maintenance Staff">Maintenance Staff</option>
                  <option value="Reserved Parking">Reserved Parking</option>
                  <option value="Park">Park</option>
                  <option value="DTH &amp; Television Facility">DTH &amp; Television Facility</option>
                  <option value="Conference Room">Conference Room</option>
                  <option value="Visitor Parking">Visitor Parking</option>
                  <option value="Vaastu Compliant">Vaastu Compliant</option>
                  <option value="Internet/Wifi">Internet/Wifi</option>
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
                  <option value="SBI">SBI</option>
                  <option value="OBC">OBC</option>
                  <option value="HDFC">HDFC</option>
                  <option value="PNB">PNB</option>
                  <option value="BOB">BOB</option>
                  <option value="ICICI">ICICI</option>
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
    <button type="button" class="btn btn-dark" onclick="step2Next()">Save & Next</button>
</div>

</form>
                                        </div>

                                        <div class="step-3" style="display: none;">
<form>
   <div class="row">
      <div class="col-md-12">
         <h4>Project overview</h4>
      </div>
   </div>
   <input type="hidden" name="p_id_2" id="p_id_2" value="564">
   <div class="row">
      <div class="col-md-6 col-sm-6 col-xs-12">
         <div class="form-group">
            <label for="area">Approved By:</label>
            <select class="form-control" >
              <option value="">Select Approved By</option>
              <option value="RK">RK</option>
              <option value="SK">SK</option>
           </select>
         </div>
      </div>
      <div class="col-md-3 col-sm-3 col-xs-6">
         <div class="form-group">
            <div>
               <label for="usr">CC Certificate* :</label>
            </div>
            <label class="radio-inline">
            <input type="radio" value="1" name="prop[cc_certificate]">
            Yes </label>
            <label class="radio-inline">
            <input type="radio" value="2" name="prop[cc_certificate]">
            No </label>
         </div>
      </div>
      <div class="col-md-3 col-sm-3 col-xs-6">
         <div class="form-group">
            <div>
               <label for="usr">OC Certificate* :</label>
            </div>
            <label class="radio-inline">
            <input type="radio" value="1" name="prop[oc_certificate]">
            Yes </label>
            <label class="radio-inline">
            <input type="radio" value="2" name="prop[oc_certificate]">
            No </label>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-6">
         <div class="form-group">
            <label for="title">About Project:</label>
            <textarea class="form-control custom-textarea" name="prop[description]" rows="4" id="comment"></textarea>
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
         </div>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="row">
              <div class="col-md-12">
                 <h4>Project Logo</h4>
                 <div class="form-group">
                    <label for="title">Upload image:</label>
                    <input type="file" name="project_logo" class="form-control">
                    <!--<div class="image-small-div">
                       <img src="" alt="image">
                    </div>-->
                 </div>
              </div>
              <div class="col-md-12">
                 <h4>Banner Images</h4>
                 <div class="form-group">
                    <label for="title">Upload image:</label>
                    <input type="file" name="banner_image" class="form-control">
                    <!--<div class="image-small-div">
                       <img src="" alt="image">
                    </div>-->
                 </div>
              </div>
          </div>
      </div>
   </div>

                                                <div align="right">
                                                    <button type="button" class="btn btn-dark" onclick="step3Prev()">Previous</button>
                                                    &nbsp;
                                                    <button type="button" class="btn btn-dark" onclick="step3Submit()">Save</button>
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
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>


 <script>
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
    window.location.href='<?= base_url(AGENT_URL.'products/') ?>';
}
$('#select_amenitie').select2();
$('#select_finance').select2();
//$('#payment_plans').select2();

// show rera no if selected Registred
function reraApplication() {
    var rera_application = $("#rera_application").val();
    if (rera_application=='Registred') {
        $(".input-rera-no").show();
    }
    else {
        $(".input-rera-no").hide();
    }
}

function propertType() {
    var property_type = $("#property_type").val();
    if (property_type=='Flat') {
        $(".property-type-flat").show();
        $(".property-type-villa").hide();
        $(".property-type-plot").hide();
    }
    else if (property_type=='Villa') {
        $(".property-type-flat").hide();
        $(".property-type-villa").show();
        $(".property-type-plot").hide();
    }
    else if (property_type=='Plot') {
        $(".property-type-flat").hide();
        $(".property-type-villa").hide();
        $(".property-type-plot").show();
    }
    else {
        $(".property-type-flat").hide();
        $(".property-type-villa").hide();
        $(".property-type-plot").hide();
    }
}


function addRow(id,type) {
    $("."+id+" .fa-plus-circle").hide();
    $("."+id+" .fa-minus-circle").show();

    var timestamp = Date.now();


    var t = type+"_"+timestamp;

    var plus_minus = "<div class='"+t+"'><i class='fa fa-plus-circle cp' aria-hidden='true' onclick='addRow(&quot;"+t+"&quot;,&quot;"+type+"&quot;)'></i> <i class='fa fa-minus-circle text-danger cp' style='display: none;' aria-hidden='true' onclick='removeRow(&quot;"+t+"&quot;)'></i></div>";

    if (type == 'flat_block_detail') {

        var ht = "<tr> <td>"+plus_minus+"</td> <td><input class='form-control' type='text' name='block[0][block_name_1]' style='width:80px;'></td> <td><input class='form-control' type='text' name='block[0][no_of_floor_1]' style='width:80px;'></td> <td><input class='form-control' type='text' name='block[0][no_of_flat_1]' style='width:80px;'></td> <td><input class='form-control' type='text' name='block[0][unit_per_floor_1]' style='width:80px;'></td> <td><input class='form-control' type='text' name='block[0][no_of_ps_lift_1]' style='width:80px;'></td> <td><input class='form-control' type='text' name='block[0][no_of_service_lift_1]' style='width:80px;'></td> <td><input class='form-control' type='date' name='block[0][edp_1]'></td> </tr>";

        $("."+type).append(ht);
    }
    else if (type == 'flat_unit_detail') {

        var ht = "<tr> <td>"+plus_minus+"</td> <td><input class='form-control' type='text' name='unit[0][no_of_unit]' style='width:80px;'></td> <td><input class='form-control' type='text' name='unit[0][ca]' style='width:80px;'></td> <td><input class='form-control' type='text' name='unit[0][ba]' style='width:80px;'></td> <td><input class='form-control' type='text' name='unit[0][sa]' style='width:80px;'></td> <td><input class='form-control' type='text' name='unit[0][no_of_bedroom1]' style='width:80px;'></td> <td><input class='form-control' type='text' name='unit[0][no_of_bathroom1]' style='width:80px;'></td> <td><select class='form-control' id='accom' name='unit[0][accomotation_1]'> <option> Select Accomodation </option> <option value='1 BHK'>1 BHK</option> <option value='2 BHK'>2 BHK</option> <option value='3 BHK'>3 BHK</option> <option value='4 BHK'>4 BHK</option> <option value='3 BHK + Servant '>3 BHK + Servant </option> </select></td> <td><input class='form-control' type='text' name='unit[0][basic_cost]' style='width:80px;'></td> <td><input class='form-control' type='text' name='unit[0][charges]' style='width:80px;'></td> <td><input class='form-control' type='file' name='flat_image_0'></td> </tr>";

        $("."+type).append(ht);
    }
    else if (type == 'villa_detail') {

        var ht = "<tr> <td>"+plus_minus+"</td> <td> <div class='row' style='width: 330px;'> <div class='col-md-6'> <input class='form-control unit-select' type='text' name='unit[0][plot_size_1]' style=''> </div> <div class='col-md-6'><select class='form-control unit-select' id='unit' name='unit[0][plot_unit]' style=''> <option value='Select Unit'>Select Unit</option> <option value='Sq.Yd'>Sq.Yd</option> <option value='Sq.Ft'>Sq.Ft</option> <option value='Bigha'>Bigha</option> <option value='Sq.Mtr'>Sq.Mtr</option> <option value='Fix'>Fix</option> <option value='% of BSP'>% of BSP</option> <option value='Acres'>Acres</option> </select> </div> </div> </td> <td><input class='form-control' type='text' name='unit[0][dimension_1]' style='width: 120px;'></td> <td> <select class='form-control unit-select' id='facing' name='unit[0][facing_1]' style='width: 120px;'> <option value='north'>north</option> <option value='North'>North</option> <option value='East'>East</option> <option value='West'>West</option> <option value='South'>South</option> <option value='North-East'>North-East</option> <option value='North-West'>North-West</option> <option value='South-East'>South-East</option> <option value='South-West'>South-West</option> </select> </td> <td><input class='form-control' type='text' name='unit[0][no_of_unit]' style='width: 80px;'></td> <td><select class='form-control' id='accom' name='unit[0][accomotation_1]' style='width: 180px;'> <option> Select Accomodation </option> <option value='1 BHK'>1 BHK</option> <option value='2 BHK'>2 BHK</option> <option value='3 BHK'>3 BHK</option> <option value='4 BHK'>4 BHK</option> <option value='3 BHK + Servant '>3 BHK + Servant </option> </select></td> <td><input class='form-control' type='text' name='unit[0][no_of_floor_1]' style='width: 120px;'></td> <td> <div class='row' style='width: 330px;'> <div class='col-md-6'> <input class='form-control unit-select' type='text' name='unit[0][construction_area1]' > </div> <div class='col-md-6'> <select class='form-control unit-select' id='unit' name='unit[0][con_unit]'> <option value='Select Unit'>Select Unit</option> <option value='Sq.Yd'>Sq.Yd</option> <option value='Sq.Ft'>Sq.Ft</option> <option value='Bigha'>Bigha</option> <option value='Sq.Mtr'>Sq.Mtr</option> <option value='Fix'>Fix</option> <option value='% of BSP'>% of BSP</option> <option value='Acres'>Acres</option> </select> </div> </div> </td> <td><input class='form-control' type='text' name='unit[0][no_of_bedroom1]' style='width: 100px;'></td> <td><input class='form-control' type='text' name='unit[0][no_of_bathroom1]' style='width: 100px;'></td> <td><input class='form-control' type='text' name='unit[0][basic_cost]' style='width: 100px;'></td> <td><input class='form-control' type='text' name='unit[0][charges]' style='width: 100px;'></td> <td><input class='form-control' style='width: 230px;' type='file' name='villa_image_0'></td> </tr>";

        $("."+type).append(ht);
    }

    else if (type == 'plot_detail') {

        var ht = "<tr> <td>"+plus_minus+"</td> <td> <div class='row' style='width: 330px;'> <div class='col-md-6'> <input class='form-control unit-select' type='text' name='unit[0][plot_size_1]'> </div> <div class='col-md-6'> <select class='form-control unit-select' id='unit' name='unit[0][plot_unit]'> <option value='Select Unit'>Select Unit</option> <option value='Sq.Yd'>Sq.Yd</option> <option value='Sq.Ft'>Sq.Ft</option> <option value='Bigha'>Bigha</option> <option value='Sq.Mtr'>Sq.Mtr</option> <option value='Fix'>Fix</option> <option value='% of BSP'>% of BSP</option> <option value='Acres'>Acres</option> </select> </div> </div> </td> <td><input class='form-control' type='text' name='unit[0][dimension_1]' style='width: 100px;'></td> <td> <select class='form-control unit-select' name='unit[0][facing_1]' id='facing' style='width: 150px;'> <option value='north'>north</option> <option value='North'>North</option> <option value='East'>East</option> <option value='West'>West</option> <option value='South'>South</option> <option value='North-East'>North-East</option> <option value='North-West'>North-West</option> <option value='South-East'>South-East</option> <option value='South-West'>South-West</option> </select> </td> <td><input class='form-control' type='text' name='unit[0][no_of_unit]' style='width: 100px;'></td> <td><input class='form-control' type='text' name='unit[0][basic_cost]' style='width: 100px;'></td> <td><input class='form-control' type='text' name='unit[0][charges]' style='width: 100px;'></td> <td><input class='form-control' style='width: 230px;' type='file' name='plot_image_0' style='width: 100px;'></td> </tr>";

        $("."+type).append(ht);
    }
}

function removeRow(id) {
    $("."+id+"").parent().parent().remove();
}

$('#chkgst').change(function () {
  if($("#chkgst").is(':checked')){
    $(".inputgst").show(); 
  } 
  else {
     $(".inputgst").hide(); 
  }
});

$('#chkgst_club').change(function () {
  if($("#chkgst_club").is(':checked')){
    $(".inputgst_club").show(); 
  } 
  else {
     $(".inputgst_club").hide(); 
  }
});

$('#chkgstprice').change(function () {
  if($("#chkgstprice").is(':checked')){
    $(".inputgst_park").show(); 
  } 
  else {
     $(".inputgst_park").hide(); 
  }
});

input_fields_additional();

function input_fields_additional() {
    $.ajax({
      url: "<?= base_url(AGENT_URL.'input_fields_additional') ?>",
      success: function(html){
        $(".input_fields_additional").append(html);
      },
      error: function(){
        alert("Some Error Occurred!!");
      }
    });
}

function removeInputRowAdditional(id) {
    $("."+id+"").remove();
}

function addInputRowAdditional(id) {
    $("."+id+" .fa-plus-circle").hide();
    $("."+id+" .fa-minus-circle").show();
    input_fields_additional();
}

input_fields_plc();

function input_fields_plc() {
    $.ajax({
      url: "<?= base_url(AGENT_URL.'input_fields_plc') ?>",
      success: function(html){
        $(".input_fields_plc").append(html);
      },
      error: function(){
        alert("Some Error Occurred!!");
      }
    });
}

function removeInputRowPLC(id) {
    $("."+id+"").remove();
}

function addInputRowPLC(id) {
    $("."+id+" .fa-plus-circle").hide();
    $("."+id+" .fa-minus-circle").show();
    input_fields_plc();
}

input_fields_specification();

function input_fields_specification() {
    $.ajax({
      url: "<?= base_url(AGENT_URL.'input_fields_specification') ?>",
      success: function(html){
        $(".input_fields_specification").append(html);
      },
      error: function(){
        alert("Some Error Occurred!!");
      }
    });
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
    $.ajax({
      url: "<?= base_url(AGENT_URL.'input_fields_property_image') ?>",
      success: function(html){
        $(".input_fields_property_image").append(html);
      },
      error: function(){
        alert("Some Error Occurred!!");
      }
    });
}

function removeInputRowProperty_image(id) {
    $("."+id+"").remove();
}

function addInputRowProperty_image(id) {
    $("."+id+" .fa-plus-circle").hide();
    $("."+id+" .fa-minus-circle").show();
    input_fields_property_image();
}

</script>