<?php include('include/header.php');?>
<link rel="stylesheet" href="<?php echo base_url('public/admin/') ?>plugins/sweetalert/css/sweetalert.css">
<style>
@media only screen and (max-width : 576px) {
.mg-10 {
	margin-top: 10px;
}
}

.radio-toolbar {
  margin: 10px;
}

.radio-toolbar input[type="radio"] {
  opacity: 0;
  position: fixed;
  width: 0;
}

.radio-toolbar label {
    display: inline-block;
    background-color: #ddd;
    padding: 7px 14px;
    width: 100%;
    font-family: sans-serif, Arial;
    font-size: 12px;
    border: 1px solid #444;
    border-radius: 4px;
    text-align: center;
    cursor: pointer;
}

.radio-toolbar label:hover {
  background-color: #dfd;
}

.radio-toolbar input[type="radio"]:focus + label {
    border: 1px dashed #444;
}

.radio-toolbar input[type="radio"]:checked + label {
    background-color: #bfb;
    border-color: #4c4;
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
                        <div class="card" id="printableArea">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <h4 class="card-title">Booking: <span style="font-weight: bold;">#<?= $booking_detail->booking_id ?></span></h4>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6" align="right">

                                      <?php if(!$booking_detail->share_account_id) { ?>
                                      <button class="btn btn-success btn-sm" style="color:#fff;" onclick="editBooking()">Edit</button>
                                      <?php } ?>
                                    </div>
                                </div>
                                <div class="basic-form">
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
                                        <div class="form-row">

                                             <div class="col-md-12">
                                                <h5>Customer Detail</h5>
                                                <label>Name: </label> <span style="color: #333;"><?= $booking_detail->customer_name ?></span>
                                            </div>

                                            <div class="col-md-12">
                                                <label>S/D/W of: </label> <span style="color: #333;"><?= $booking_detail->sdw_title.' '.$booking_detail->sdw ?></span>
                                            </div>

                                            <div class="col-md-12">
                                                <label>Address: </label> <span style="color: #333;"><?= $booking_detail->address ?></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>City: </label> <span style="color: #333;"><?= $booking_detail->city_name ?></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>City: </label> <span style="color: #333;"><?= $booking_detail->state_name ?></span>
                                            </div>

                                            <div class="col-md-12">
                                                <label>Mobile: </label> <span style="color: #333;"><?= $lead_detail->lead_mobile_no ?></span>
                                            </div>

                                            <div class="col-md-12">
                                                <label>Email Id: </label> <span style="color: #333;"><?= $lead_detail->lead_email ?></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Aadhar No: </label> <span style="color: #333;"><?= $lead_detail->lead_adhar_no ?></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>PAN No: </label> <span style="color: #333;"><?= $lead_detail->lead_pan_no ?></span>
                                            </div>

                                             <div class="col-md-12" style="margin-top: 20px;">
                                                <h5>Project Details</h5>
                                                <label>Project Name: </label> <span style="color: #333;"><?= $booking_detail->project_name ?></span>
                                            </div>

                                             <div class="col-md-12">
                                                <label>Location: </label> <span style="color: #333;"><?= $booking_detail->location_name ?></span>
                                            </div>

                                             <div class="col-md-4">
                                                <label>Unit No: </label> <span style="color: #333;"><?= $booking_detail->unit_no ?></span>
                                            </div>

                                             <div class="col-md-4">
                                                <label>Floor: </label> <span style="color: #333;"><?= $booking_detail->floor_name ?></span>
                                            </div>

                                             <div class="col-md-4">
                                                <label>Block: </label> <span style="color: #333;"><?= $booking_detail->block_name ?></span>
                                            </div>

                                            <div class="col-md-4">
                                                <label>Size: </label> <span style="color: #333;"><?= $booking_detail->size ?></span>
                                            </div>
                                             <!--<div class="col-md-4">
                                                <label>Plot Area: </label> <span style="color: #333;"></span>
                                            </div>

                                             <div class="col-md-4">
                                                <label>Salable Area: </label> <span style="color: #333;"></span>
                                            </div>-->


                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <h5>Seller Detail</h5>
                                                <label>Name: </label> <span style="color: #333;"><?= $builder_detail->firm_name ?></span>
                                            </div>

                                            <div class="col-md-12">
                                                <label>Address: </label> <span style="color: #333;">
                                                  <?= $builder_detail->address_1 ?>
                                                  <?= ($builder_detail->address_2)?'<br>'.$builder_detail->address_2:'' ?>
                                                  <?= ($builder_detail->address_3)?'<br>'.$builder_detail->address_3:'' ?>
                                              
                                                  </span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>City: </label> <span style="color: #333;"><?= $builder_detail->city_name ?></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>City: </label> <span style="color: #333;"><?= $builder_detail->state_name ?></span>
                                            </div>

                                            <div class="col-md-12">
                                                <label>Mobile: </label> <span style="color: #333;"><?= $builder_detail->builder_mobile ?></span>
                                            </div>

                                            <div class="col-md-12">
                                                <label>Email Id: </label> <span style="color: #333;"><?= $builder_detail->builder_email ?></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Aadhar No: </label> <span style="color: #333;"><?= $builder_detail->adhar_no ?></span>
                                            </div>

                                            <div class="col-md-6">
                                                <label>PAN No: </label> <span style="color: #333;"><?= $builder_detail->pan_no ?></span>
                                            </div>

                    <?php 
                    $asking_price = 0;
                    $where="pud.product_unit_detail_id='".$booking_detail->product_unit_detail_id."'";
                    $this->db->select("pud.product_unit_detail_id,tbl_product_types.product_type_name,tbl_unit_types.unit_type_name,tbl_city.city_name,tbl_states.state_name,tbl_locations.location_name,tbl_accomodations.accomodation_name,pud.project_type,pud.property_type,pud.sa,pud.plot_size,pud.plot_unit,punit.unit_name as plot_unit_name,sa_unit.unit_name as sa_unit_name,pud.basic_cost,p.b_cost_unit,p.parking_open,p.parking_stilt,p.parking_basment,p.parking_gst,p.o_price,p.s_price,p.b_price,p.b_cost_gst");
                    $this->db->from('tbl_product_unit_details as pud');
                    $this->db->join('tbl_products as p', 'p.product_id = pud.product_id','left');
                    $this->db->join('tbl_product_types','tbl_product_types.product_type_id=p.project_type','left');
                    $this->db->join('tbl_unit_types','tbl_unit_types.unit_type_id=p.property_type','left');
                    $this->db->join('tbl_states', 'tbl_states.state_id = p.state_id','left');
                    $this->db->join('tbl_city', 'tbl_city.city_id = p.city_id','left');
                    $this->db->join('tbl_locations', 'tbl_locations.location_id = p.location','left');
                    $this->db->join('tbl_accomodations', 'tbl_accomodations.accomodation_id = pud.accomodation','left');
                    $this->db->join('tbl_units as punit', 'punit.unit_id = pud.plot_unit','left');
                    $this->db->join('tbl_units as sa_unit', 'sa_unit.unit_id = pud.unit','left');
                    $this->db->where($where);
                    $query = $this->db->get();
                    $item = $query->row();

                    if ($item) {

                        $budget = "";

                        $this->db->select('*,tbl_inventory.inventory_id as inventory_id');
                        $this->db->from('tbl_inventory');
                        $this->db->join('tbl_basic_cost', 'tbl_basic_cost.inventory_id = tbl_inventory.inventory_id','left');
                        $this->db->where("unit_code='".$item->product_unit_detail_id."' AND tbl_inventory.inventory_id='".$booking_detail->inventory_id."'");
                        $query = $this->db->get();
                        $itemInv = $query->row();


                        if ($itemInv) {

                          ///////////////////////////////
                          if ($itemInv->basic_cost==1) {
                            
                            $current_rate = 0;
                            if ($itemInv->basic_cost_id) {

                                $b_cost_unit = $itemInv->current_rate_unit;
                                if ($itemInv->current_rate) {
                                    //$current_rate += $itemInv->current_rate;

                                    // residencial
                                    if($item->project_type==2){
                                        
                                        // for flat
                                        if(($item->property_type==1 || $item->property_type==7)){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                            if ($b_cost_unit=='2') {// for Sq.Ft
                                                $current_rate = $item->sa*$itemInv->current_rate;
                                            }
                                            else if ($b_cost_unit=='5') {// for Fix
                                                $current_rate = $itemInv->current_rate;
                                            }
                                        }
                                        // for plot
                                        else if(($item->property_type==2 || $item->property_type==3)){
                                            //$size = $item->plot_size;
                                            //if ($item->plot_unit_name) {
                                            //    $size .= ' '.$item->plot_unit_name;
                                            //}
                                            if ($b_cost_unit=='1') {// for Sq.Yd
                                                $current_rate = $item->plot_size*$itemInv->current_rate;
                                            }
                                            else if ($b_cost_unit=='2') {// for Sq.Ft
                                                $current_rate += $item->construction_area*$itemInv->current_rate;
                                            } 
                                            else if ($b_cost_unit=='5') {// for Fix
                                                $current_rate = $itemInv->current_rate;
                                            }
                                        }
                                    }
                                    // commercial
                                    else if($item->project_type==3){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                        if ($b_cost_unit=='2') {// for Sq.Ft
                                            $current_rate = $item->sa*$itemInv->current_rate;
                                        }
                                        else if ($b_cost_unit=='5') {// for Fix
                                            $current_rate = $itemInv->current_rate;
                                        }
                                    }
                                }
                            }
                            else {

                                $b_cost_unit = $item->b_cost_unit;

                                if ($item->basic_cost) {

                                    // residencial
                                    if($item->project_type==2){
                                        // for flat
                                        if(($item->property_type==1 || $item->property_type==7)){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                            if ($b_cost_unit=='2') {// for Sq.Ft
                                                $current_rate = $item->sa*$item->basic_cost;
                                            }
                                            else if ($b_cost_unit=='5') {// for Fix
                                                $current_rate = $item->basic_cost;
                                            }
                                        }
                                        // for plot
                                        else if(($item->property_type==2 || $item->property_type==3)){
                                            //$size = $item->plot_size;
                                            //if ($item->plot_unit_name) {
                                            //    $size .= ' '.$item->plot_unit_name;
                                            //}
                                            if ($b_cost_unit=='1') {// for Sq.Yd
                                                $current_rate = $item->plot_size*$item->basic_cost;
                                            }
                                            else if ($b_cost_unit=='2') {// for Sq.Ft
                                                $current_rate = $item->construction_area*$item->basic_cost;
                                            } 
                                            else if ($b_cost_unit=='5') {// for Fix
                                                $current_rate = $item->basic_cost;
                                            }
                                        }
                                    }
                                    // commercial
                                    else if($item->project_type==3){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                        if ($b_cost_unit=='2') {// for Sq.Ft
                                            $current_rate = $item->sa*$item->basic_cost;
                                        }
                                        else if ($b_cost_unit=='5') {// for Fix
                                            $current_rate = $item->basic_cost;
                                        }
                                    }
                                }
                            }

                            if ($current_rate) {
                                $asking_price = $current_rate;
                            }
                          }
                          //////////////////////////////////



                          // Parking Open 
                          $parking_open_show = 0;
                          $parking_open_price = 0;
                          $parking_open_gst = 0;
                          if ($itemInv->parking==1 && $item->parking_open) {
                            $parking_open_show = 1;
                            $current_rate = 0;
                            if ($itemInv->o_current_rate) {

                                $b_cost_unit = $itemInv->o_current_rate_unit;
                                $parking_open_gst = $itemInv->o_current_rate_gst;
                                if ($itemInv->o_current_rate) {
                                    //$current_rate += $itemInv->current_rate;

                                    // residencial
                                    if($item->project_type==2){
                                        
                                        // for flat
                                        if(($item->property_type==1 || $item->property_type==7)){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                            if ($b_cost_unit=='2') {// for Sq.Ft
                                                $current_rate = $item->sa*$itemInv->o_current_rate;
                                            }
                                            else if ($b_cost_unit=='5') {// for Fix
                                                $current_rate = $itemInv->o_current_rate;
                                            }
                                        }
                                        // for plot
                                        else if(($item->property_type==2 || $item->property_type==3)){
                                            //$size = $item->plot_size;
                                            //if ($item->plot_unit_name) {
                                            //    $size .= ' '.$item->plot_unit_name;
                                            //}
                                            if ($b_cost_unit=='1') {// for Sq.Yd
                                                $current_rate = $item->plot_size*$itemInv->o_current_rate;
                                            }
                                            else if ($b_cost_unit=='2') {// for Sq.Ft
                                                $current_rate += $item->construction_area*$itemInv->o_current_rate;
                                            } 
                                            else if ($b_cost_unit=='5') {// for Fix
                                                $current_rate = $itemInv->o_current_rate;
                                            }
                                        }
                                    }
                                    // commercial
                                    else if($item->project_type==3){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                        if ($b_cost_unit=='2') {// for Sq.Ft
                                            $current_rate = $item->sa*$itemInv->o_current_rate;
                                        }
                                        else if ($b_cost_unit=='5') {// for Fix
                                            $current_rate = $itemInv->o_current_rate;
                                        }
                                    }
                                }
                            }
                            else {

                                $b_cost_unit = 5;//$item->b_cost_unit;
                                $parking_open_gst = $item->parking_gst;

                                if ($item->o_price) {

                                    // residencial
                                    if($item->project_type==2){
                                        // for flat
                                        if(($item->property_type==1 || $item->property_type==7)){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                            if ($b_cost_unit=='2') {// for Sq.Ft
                                                $current_rate = $item->sa*$item->o_price;
                                            }
                                            else if ($b_cost_unit=='5') {// for Fix
                                                $current_rate = $item->o_price;
                                            }
                                        }
                                        // for plot
                                        else if(($item->property_type==2 || $item->property_type==3)){
                                            //$size = $item->plot_size;
                                            //if ($item->plot_unit_name) {
                                            //    $size .= ' '.$item->plot_unit_name;
                                            //}
                                            if ($b_cost_unit=='1') {// for Sq.Yd
                                                $current_rate = $item->plot_size*$item->o_price;
                                            }
                                            else if ($b_cost_unit=='2') {// for Sq.Ft
                                                $current_rate = $item->construction_area*$item->o_price;
                                            } 
                                            else if ($b_cost_unit=='5') {// for Fix
                                                $current_rate = $item->o_price;
                                            }
                                        }
                                    }
                                    // commercial
                                    else if($item->project_type==3){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                        if ($b_cost_unit=='2') {// for Sq.Ft
                                            $current_rate = $item->sa*$item->o_price;
                                        }
                                        else if ($b_cost_unit=='5') {// for Fix
                                            $current_rate = $item->o_price;
                                        }
                                    }
                                }
                            }

                            if ($current_rate) {
                                $parking_open_price = $current_rate;
                            }
                          }
                          // Parking Open End 

                          // Parking Stilt 
                          $parking_stilt_show = 0;
                          $parking_stilt_price = 0;
                          $parking_stilt_gst = 0;
                          if ($itemInv->parking==1 && $item->parking_stilt) {
                            $parking_stilt_show = 1;
                            $current_rate = 0;
                            if ($itemInv->s_current_rate) {

                                $b_cost_unit = $itemInv->s_current_rate_unit;
                                $parking_stilt_gst = $itemInv->s_current_rate_gst;
                                if ($itemInv->s_current_rate) {
                                    //$current_rate += $itemInv->current_rate;

                                    // residencial
                                    if($item->project_type==2){
                                        
                                        // for flat
                                        if(($item->property_type==1 || $item->property_type==7)){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                            if ($b_cost_unit=='2') {// for Sq.Ft
                                                $current_rate = $item->sa*$itemInv->s_current_rate;
                                            }
                                            else if ($b_cost_unit=='5') {// for Fix
                                                $current_rate = $itemInv->s_current_rate;
                                            }
                                        }
                                        // for plot
                                        else if(($item->property_type==2 || $item->property_type==3)){
                                            //$size = $item->plot_size;
                                            //if ($item->plot_unit_name) {
                                            //    $size .= ' '.$item->plot_unit_name;
                                            //}
                                            if ($b_cost_unit=='1') {// for Sq.Yd
                                                $current_rate = $item->plot_size*$itemInv->s_current_rate;
                                            }
                                            else if ($b_cost_unit=='2') {// for Sq.Ft
                                                $current_rate += $item->construction_area*$itemInv->s_current_rate;
                                            } 
                                            else if ($b_cost_unit=='5') {// for Fix
                                                $current_rate = $itemInv->s_current_rate;
                                            }
                                        }
                                    }
                                    // commercial
                                    else if($item->project_type==3){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                        if ($b_cost_unit=='2') {// for Sq.Ft
                                            $current_rate = $item->sa*$itemInv->s_current_rate;
                                        }
                                        else if ($b_cost_unit=='5') {// for Fix
                                            $current_rate = $itemInv->s_current_rate;
                                        }
                                    }
                                }
                            }
                            else {

                                $b_cost_unit = 5;//$item->b_cost_unit;
                                $parking_stilt_gst = $item->parking_gst;

                                if ($item->s_price) {

                                    // residencial
                                    if($item->project_type==2){
                                        // for flat
                                        if(($item->property_type==1 || $item->property_type==7)){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                            if ($b_cost_unit=='2') {// for Sq.Ft
                                                $current_rate = $item->sa*$item->s_price;
                                            }
                                            else if ($b_cost_unit=='5') {// for Fix
                                                $current_rate = $item->s_price;
                                            }
                                        }
                                        // for plot
                                        else if(($item->property_type==2 || $item->property_type==3)){
                                            //$size = $item->plot_size;
                                            //if ($item->plot_unit_name) {
                                            //    $size .= ' '.$item->plot_unit_name;
                                            //}
                                            if ($b_cost_unit=='1') {// for Sq.Yd
                                                $current_rate = $item->plot_size*$item->s_price;
                                            }
                                            else if ($b_cost_unit=='2') {// for Sq.Ft
                                                $current_rate = $item->construction_area*$item->s_price;
                                            } 
                                            else if ($b_cost_unit=='5') {// for Fix
                                                $current_rate = $item->s_price;
                                            }
                                        }
                                    }
                                    // commercial
                                    else if($item->project_type==3){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                        if ($b_cost_unit=='2') {// for Sq.Ft
                                            $current_rate = $item->sa*$item->s_price;
                                        }
                                        else if ($b_cost_unit=='5') {// for Fix
                                            $current_rate = $item->s_price;
                                        }
                                    }
                                }
                            }

                            if ($current_rate) {
                                $parking_stilt_price = $current_rate;
                            }
                          }
                          // Parking Stilt End 

                          // Parking Basment 
                          $parking_basment_show = 0;
                          $parking_basment_price = 0;
                          $parking_basment_gst = 0;
                          if ($itemInv->parking==1 && $item->parking_basment) {
                            $parking_basment_show = 1;
                            $current_rate = 0;
                            if ($itemInv->b_current_rate) {

                                $b_cost_unit = $itemInv->b_current_rate_unit;
                                $parking_basment_gst = $itemInv->b_current_rate_gst;
                                if ($itemInv->b_current_rate) {
                                    //$current_rate += $itemInv->current_rate;

                                    // residencial
                                    if($item->project_type==2){
                                        
                                        // for flat
                                        if(($item->property_type==1 || $item->property_type==7)){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                            if ($b_cost_unit=='2') {// for Sq.Ft
                                                $current_rate = $item->sa*$itemInv->b_current_rate;
                                            }
                                            else if ($b_cost_unit=='5') {// for Fix
                                                $current_rate = $itemInv->b_current_rate;
                                            }
                                        }
                                        // for plot
                                        else if(($item->property_type==2 || $item->property_type==3)){
                                            //$size = $item->plot_size;
                                            //if ($item->plot_unit_name) {
                                            //    $size .= ' '.$item->plot_unit_name;
                                            //}
                                            if ($b_cost_unit=='1') {// for Sq.Yd
                                                $current_rate = $item->plot_size*$itemInv->b_current_rate;
                                            }
                                            else if ($b_cost_unit=='2') {// for Sq.Ft
                                                $current_rate += $item->construction_area*$itemInv->b_current_rate;
                                            } 
                                            else if ($b_cost_unit=='5') {// for Fix
                                                $current_rate = $itemInv->b_current_rate;
                                            }
                                        }
                                    }
                                    // commercial
                                    else if($item->project_type==3){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                        if ($b_cost_unit=='2') {// for Sq.Ft
                                            $current_rate = $item->sa*$itemInv->b_current_rate;
                                        }
                                        else if ($b_cost_unit=='5') {// for Fix
                                            $current_rate = $itemInv->b_current_rate;
                                        }
                                    }
                                }
                            }
                            else {

                                $b_cost_unit = 5;//$item->b_cost_unit;
                                $parking_basment_gst = $item->parking_gst;

                                if ($item->b_price) {

                                    // residencial
                                    if($item->project_type==2){
                                        // for flat
                                        if(($item->property_type==1 || $item->property_type==7)){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                            if ($b_cost_unit=='2') {// for Sq.Ft
                                                $current_rate = $item->sa*$item->b_price;
                                            }
                                            else if ($b_cost_unit=='5') {// for Fix
                                                $current_rate = $item->b_price;
                                            }
                                        }
                                        // for plot
                                        else if(($item->property_type==2 || $item->property_type==3)){
                                            //$size = $item->plot_size;
                                            //if ($item->plot_unit_name) {
                                            //    $size .= ' '.$item->plot_unit_name;
                                            //}
                                            if ($b_cost_unit=='1') {// for Sq.Yd
                                                $current_rate = $item->plot_size*$item->b_price;
                                            }
                                            else if ($b_cost_unit=='2') {// for Sq.Ft
                                                $current_rate = $item->construction_area*$item->b_price;
                                            } 
                                            else if ($b_cost_unit=='5') {// for Fix
                                                $current_rate = $item->b_price;
                                            }
                                        }
                                    }
                                    // commercial
                                    else if($item->project_type==3){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                        if ($b_cost_unit=='2') {// for Sq.Ft
                                            $current_rate = $item->sa*$item->b_price;
                                        }
                                        else if ($b_cost_unit=='5') {// for Fix
                                            $current_rate = $item->b_price;
                                        }
                                    }
                                }
                            }

                            if ($current_rate) {
                                $parking_basment_price = $current_rate;
                            }
                          }
                          // Parking Basment End 



                        }
                    }
                  ?>
                                            

                                            <div class="col-md-12" style="margin-top: 20px;">
                                              <div class="row">
                                                  <div class="col-md-3 col-xs-3">
                                                      <h5>Cost Detail</h5>
                                                  </div>

                                                  <div class="col-md-3 col-xs-3" align="right">
                                                      <label style="color: #333;">Cost</label>
                                                  </div>

                                                  <div class="col-md-3 col-xs-3" align="right">
                                                      <label style="color: #333;">GST Amount</label>
                                                  </div>

                                                  <div class="col-md-3 col-xs-3" align="right">
                                                      <label style="color: #333;">Total</label>
                                                  </div>
                                                
                                                </div>
                                            </div>

                                            <?php 
                                              $total_cost = 0;
                                              $total_gst_amount = 0;
                                              $total_amount = 0;

                                              $cost = 0;
                                              $gst = 0;
                                              $gst_amount = 0;
                                              $total = 0;
                                              if ($asking_price) {
                                                $total_cost += $cost = $asking_price;

                                                if ($item->b_cost_gst) {
                                                  $gst = $item->b_cost_gst;
                                                  $total_gst_amount += $gst_amount = ($cost*$gst/100);
                                                }
                                                $total_amount += $total = $cost+$gst_amount;
                                              }
                                            ?>
                                            <div class="col-md-12">
                                              <div class="row">
                                                  <div class="col-md-3 col-xs-3">
                                                      <label>Asking Price: </label>
                                                  </div>

                                                  <div class="col-md-3 col-xs-3" align="right">
                                                      <label style="color: #333;"><?= ($cost)?'Rs.'.$cost:'' ?></label>
                                                  </div>

                                                  <div class="col-md-3 col-xs-3" align="right">
                                                      <label style="color: #333;"><?= ($gst)?'Rs.'.$gst_amount:'' ?></label>
                                                  </div>

                                                  <div class="col-md-3 col-xs-3" align="right">
                                                      <label style="color: #333;"><?= ($total)?'Rs.'.$total:'' ?></label>
                                                  </div>
                                                
                                                </div>
                                            </div>


                                            <?php if($parking_open_show){ 

                                              $cost = 0;
                                              $gst = 0;
                                              $gst_amount = 0;
                                              $total = 0;
                                              if ($parking_open_price) {
                                                $total_cost += $cost = $parking_open_price;

                                                if ($parking_open_gst) {
                                                  $gst = $parking_open_gst;
                                                  $total_gst_amount += $gst_amount = ($cost*$gst/100);
                                                }
                                                $total_amount += $total = $cost+$gst_amount;
                                              }
                                            ?>
                                            <div class="col-md-12">
                                              <div class="row">
                                                  <div class="col-md-3 col-xs-3">
                                                      <label>Parking Open: </label>
                                                  </div>

                                                  <div class="col-md-3 col-xs-3" align="right">
                                                      <label style="color: #333;"><?= ($cost)?'Rs.'.$cost:'' ?></label>
                                                  </div>

                                                  <div class="col-md-3 col-xs-3" align="right">
                                                      <label style="color: #333;"><?= ($gst)?'Rs.'.$gst_amount:'' ?></label>
                                                  </div>

                                                  <div class="col-md-3 col-xs-3" align="right">
                                                      <label style="color: #333;"><?= ($total)?'Rs.'.$total:'' ?></label>
                                                  </div>
                                                
                                                </div>
                                            </div>
                                            <?php } ?>

                                            <?php if($parking_stilt_show){ 

                                              $cost = 0;
                                              $gst = 0;
                                              $gst_amount = 0;
                                              $total = 0;
                                              if ($parking_stilt_price) {
                                                $total_cost += $cost = $parking_stilt_price;

                                                if ($parking_stilt_gst) {
                                                  $gst = $parking_stilt_gst;
                                                  $total_gst_amount += $gst_amount = ($cost*$gst/100);
                                                }
                                                $total_amount += $total = $cost+$gst_amount;
                                              }
                                            ?>
                                            <div class="col-md-12">
                                              <div class="row">
                                                  <div class="col-md-3 col-xs-3">
                                                      <label>Parking Stilt: </label>
                                                  </div>

                                                  <div class="col-md-3 col-xs-3" align="right">
                                                      <label style="color: #333;"><?= ($cost)?'Rs.'.$cost:'' ?></label>
                                                  </div>

                                                  <div class="col-md-3 col-xs-3" align="right">
                                                      <label style="color: #333;"><?= ($gst)?'Rs.'.$gst_amount:'' ?></label>
                                                  </div>

                                                  <div class="col-md-3 col-xs-3" align="right">
                                                      <label style="color: #333;"><?= ($total)?'Rs.'.$total:'' ?></label>
                                                  </div>
                                                
                                                </div>
                                            </div>
                                            <?php } ?>

                                            <?php if($parking_basment_show){ 

                                              $cost = 0;
                                              $gst = 0;
                                              $gst_amount = 0;
                                              $total = 0;
                                              if ($parking_basment_price) {
                                                $total_cost += $cost = $parking_basment_price;

                                                if ($parking_basment_gst) {
                                                  $gst = $parking_basment_gst;
                                                  $total_gst_amount += $gst_amount = ($cost*$gst/100);
                                                }
                                                $total_amount += $total = $cost+$gst_amount;
                                              }
                                            ?>
                                            <div class="col-md-12">
                                              <div class="row">
                                                  <div class="col-md-3 col-xs-3">
                                                      <label>Parking Basment: </label>
                                                  </div>

                                                  <div class="col-md-3 col-xs-3" align="right">
                                                      <label style="color: #333;"><?= ($cost)?'Rs.'.$cost:'' ?></label>
                                                  </div>

                                                  <div class="col-md-3 col-xs-3" align="right">
                                                      <label style="color: #333;"><?= ($gst)?'Rs.'.$gst_amount:'' ?></label>
                                                  </div>

                                                  <div class="col-md-3 col-xs-3" align="right">
                                                      <label style="color: #333;"><?= ($total)?'Rs.'.$total:'' ?></label>
                                                  </div>
                                                
                                                </div>
                                            </div>
                                            <?php } ?>

                                            <?php if($item){ 
                                              $where = "inventory_id='".$booking_detail->inventory_id."' and is_active='1'";
                                              $this->db->select("*");
                                              $this->db->from('tbl_inventory_additional');
                                              $this->db->join('tbl_product_additional_details', 'tbl_product_additional_details.product_additional_detail_id = tbl_inventory_additional.product_additional_detail_id','left');
                                              $this->db->join('tbl_price_components', 'tbl_price_components.price_component_id = tbl_product_additional_details.price_comp_id','left');
                                              $this->db->where($where);
                                              $query = $this->db->get();
                                              $add_items = $query->result();
                                              
                                              foreach ($add_items as $itemInv) {
                                                $m_price = 0;
                                                $m_gst = 0;

                                                $current_rate = 0;
                                                if ($itemInv->current_rate) {

                                                    $b_cost_unit = $itemInv->current_rate_unit;
                                                    $m_gst = $itemInv->current_rate_gst;
                                                    if ($itemInv->current_rate) {
                                                        //$current_rate += $itemInv->current_rate;

                                                        // residencial
                                                        if($item->project_type==2){
                                                            
                                                            // for flat
                                                            if(($item->property_type==1 || $item->property_type==7)){
                                                                //$size = $item->sa;
                                                                //if ($item->sa_unit_name) {
                                                                //    $size .= ' '.$item->sa_unit_name;
                                                                //}

                                                                if ($b_cost_unit=='2') {// for Sq.Ft
                                                                    $current_rate = $item->sa*$itemInv->current_rate;
                                                                }
                                                                else if ($b_cost_unit=='5') {// for Fix
                                                                    $current_rate = $itemInv->current_rate;
                                                                }
                                                            }
                                                            // for plot
                                                            else if(($item->property_type==2 || $item->property_type==3)){
                                                                //$size = $item->plot_size;
                                                                //if ($item->plot_unit_name) {
                                                                //    $size .= ' '.$item->plot_unit_name;
                                                                //}
                                                                if ($b_cost_unit=='1') {// for Sq.Yd
                                                                    $current_rate = $item->plot_size*$itemInv->current_rate;
                                                                }
                                                                else if ($b_cost_unit=='2') {// for Sq.Ft
                                                                    $current_rate += $item->construction_area*$itemInv->current_rate;
                                                                } 
                                                                else if ($b_cost_unit=='5') {// for Fix
                                                                    $current_rate = $itemInv->current_rate;
                                                                }
                                                            }
                                                        }
                                                        // commercial
                                                        else if($item->project_type==3){
                                                                //$size = $item->sa;
                                                                //if ($item->sa_unit_name) {
                                                                //    $size .= ' '.$item->sa_unit_name;
                                                                //}

                                                            if ($b_cost_unit=='2') {// for Sq.Ft
                                                                $current_rate = $item->sa*$itemInv->current_rate;
                                                            }
                                                            else if ($b_cost_unit=='5') {// for Fix
                                                                $current_rate = $itemInv->current_rate;
                                                            }
                                                        }
                                                    }
                                                }
                                                else {

                                                    $b_cost_unit = $itemInv->unit;
                                                    $m_gst = $itemInv->gst;

                                                    if ($itemInv->price) {

                                                        // residencial
                                                        if($item->project_type==2){
                                                            // for flat
                                                            if(($item->property_type==1 || $item->property_type==7)){
                                                                //$size = $item->sa;
                                                                //if ($item->sa_unit_name) {
                                                                //    $size .= ' '.$item->sa_unit_name;
                                                                //}

                                                                if ($b_cost_unit=='2') {// for Sq.Ft
                                                                    $current_rate = $item->sa*$itemInv->price;
                                                                }
                                                                else if ($b_cost_unit=='5') {// for Fix
                                                                    $current_rate = $itemInv->price;
                                                                }
                                                            }
                                                            // for plot
                                                            else if(($item->property_type==2 || $item->property_type==3)){
                                                                //$size = $item->plot_size;
                                                                //if ($item->plot_unit_name) {
                                                                //    $size .= ' '.$item->plot_unit_name;
                                                                //}
                                                                if ($b_cost_unit=='1') {// for Sq.Yd
                                                                    $current_rate = $item->plot_size*$itemInv->price;
                                                                }
                                                                else if ($b_cost_unit=='2') {// for Sq.Ft
                                                                    $current_rate = $item->construction_area*$itemInv->price;
                                                                } 
                                                                else if ($b_cost_unit=='5') {// for Fix
                                                                    $current_rate = $itemInv->price;
                                                                }
                                                            }
                                                        }
                                                        // commercial
                                                        else if($item->project_type==3){
                                                                //$size = $item->sa;
                                                                //if ($item->sa_unit_name) {
                                                                //    $size .= ' '.$item->sa_unit_name;
                                                                //}

                                                            if ($b_cost_unit=='2') {// for Sq.Ft
                                                                $current_rate = $item->sa*$itemInv->price;
                                                            }
                                                            else if ($b_cost_unit=='5') {// for Fix
                                                                $current_rate = $itemInv->price;
                                                            }
                                                        }
                                                    }
                                                }

                                                if ($current_rate) {
                                                    $m_price = $current_rate;
                                                }


                                                $cost = 0;
                                                $gst = 0;
                                                $gst_amount = 0;
                                                $total = 0;


                                                if ($m_price) {
                                                  $total_cost += $cost = $m_price;

                                                  if ($m_gst) {
                                                    $gst = $m_gst;
                                                    $total_gst_amount += $gst_amount = ($cost*$gst/100);
                                                  }
                                                  $total_amount += $total = $cost+$gst_amount;
                                                }
                                                ?>
                                                <div class="col-md-12">
                                                  <div class="row">
                                                      <div class="col-md-3 col-xs-3">
                                                          <label><?= $itemInv->price_component_name ?></label>
                                                      </div>

                                                      <div class="col-md-3 col-xs-3" align="right">
                                                          <label style="color: #333;"><?= ($cost)?'Rs.'.$cost:'' ?></label>
                                                      </div>

                                                      <div class="col-md-3 col-xs-3" align="right">
                                                          <label style="color: #333;"><?= ($gst)?'Rs.'.$gst_amount:'' ?></label>
                                                      </div>

                                                      <div class="col-md-3 col-xs-3" align="right">
                                                          <label style="color: #333;"><?= ($total)?'Rs.'.$total:'' ?></label>
                                                      </div>
                                                    
                                                    </div>
                                                </div>
                                              <?php
                                              }


                                              $where = "inventory_id='".$booking_detail->inventory_id."' and is_active='1'";
                                              $this->db->select("*");
                                              $this->db->from('tbl_inventory_plc');
                                              $this->db->join('tbl_product_plc_details', 'tbl_product_plc_details.product_plc_detail_id = tbl_inventory_plc.product_plc_detail_id','left');
                                              $this->db->join('tbl_price_components', 'tbl_price_components.price_component_id = tbl_product_plc_details.price_comp_id','left');
                                              $this->db->where($where);
                                              $query = $this->db->get();
                                              $add_items = $query->result();
                                              
                                              foreach ($add_items as $itemInv) {
                                                $m_price = 0;
                                                $m_gst = 0;

                                                $current_rate = 0;
                                                if ($itemInv->current_rate) {

                                                    $b_cost_unit = $itemInv->current_rate_unit;
                                                    $m_gst = $itemInv->current_rate_gst;
                                                    if ($itemInv->current_rate) {
                                                        //$current_rate += $itemInv->current_rate;

                                                        // residencial
                                                        if($item->project_type==2){
                                                            
                                                            // for flat
                                                            if(($item->property_type==1 || $item->property_type==7)){
                                                                //$size = $item->sa;
                                                                //if ($item->sa_unit_name) {
                                                                //    $size .= ' '.$item->sa_unit_name;
                                                                //}

                                                                if ($b_cost_unit=='2') {// for Sq.Ft
                                                                    $current_rate = $item->sa*$itemInv->current_rate;
                                                                }
                                                                else if ($b_cost_unit=='5') {// for Fix
                                                                    $current_rate = $itemInv->current_rate;
                                                                }
                                                                else if ($b_cost_unit=='6') {// for % of BSP
                                                                    $current_rate = ($itemInv->current_rate*$asking_price/100);
                                                                }
                                                            }
                                                            // for plot
                                                            else if(($item->property_type==2 || $item->property_type==3)){
                                                                //$size = $item->plot_size;
                                                                //if ($item->plot_unit_name) {
                                                                //    $size .= ' '.$item->plot_unit_name;
                                                                //}
                                                                if ($b_cost_unit=='1') {// for Sq.Yd
                                                                    $current_rate = $item->plot_size*$itemInv->current_rate;
                                                                }
                                                                else if ($b_cost_unit=='2') {// for Sq.Ft
                                                                    $current_rate += $item->construction_area*$itemInv->current_rate;
                                                                } 
                                                                else if ($b_cost_unit=='5') {// for Fix
                                                                    $current_rate = $itemInv->current_rate;
                                                                }
                                                                else if ($b_cost_unit=='6') {// for % of BSP
                                                                    $current_rate = ($itemInv->current_rate*$asking_price/100);
                                                                }
                                                            }
                                                        }
                                                        // commercial
                                                        else if($item->project_type==3){
                                                                //$size = $item->sa;
                                                                //if ($item->sa_unit_name) {
                                                                //    $size .= ' '.$item->sa_unit_name;
                                                                //}

                                                            if ($b_cost_unit=='2') {// for Sq.Ft
                                                                $current_rate = $item->sa*$itemInv->current_rate;
                                                            }
                                                            else if ($b_cost_unit=='5') {// for Fix
                                                                $current_rate = $itemInv->current_rate;
                                                            }
                                                            else if ($b_cost_unit=='6') {// for % of BSP
                                                                $current_rate = ($itemInv->current_rate*$asking_price/100);
                                                            }
                                                        }
                                                    }
                                                }
                                                else {

                                                    $b_cost_unit = $itemInv->unit;
                                                    $m_gst = $itemInv->gst;

                                                    if ($itemInv->price) {

                                                        // residencial
                                                        if($item->project_type==2){
                                                            // for flat
                                                            if(($item->property_type==1 || $item->property_type==7)){
                                                                //$size = $item->sa;
                                                                //if ($item->sa_unit_name) {
                                                                //    $size .= ' '.$item->sa_unit_name;
                                                                //}

                                                                if ($b_cost_unit=='2') {// for Sq.Ft
                                                                    $current_rate = $item->sa*$itemInv->price;
                                                                }
                                                                else if ($b_cost_unit=='5') {// for Fix
                                                                    $current_rate = $itemInv->price;
                                                                }
                                                                else if ($b_cost_unit=='6') {// for % of BSP
                                                                    $current_rate = ($itemInv->price*$asking_price/100);
                                                                }
                                                            }
                                                            // for plot
                                                            else if(($item->property_type==2 || $item->property_type==3)){
                                                                //$size = $item->plot_size;
                                                                //if ($item->plot_unit_name) {
                                                                //    $size .= ' '.$item->plot_unit_name;
                                                                //}
                                                                if ($b_cost_unit=='1') {// for Sq.Yd
                                                                    $current_rate = $item->plot_size*$itemInv->price;
                                                                }
                                                                else if ($b_cost_unit=='2') {// for Sq.Ft
                                                                    $current_rate = $item->construction_area*$itemInv->price;
                                                                } 
                                                                else if ($b_cost_unit=='5') {// for Fix
                                                                    $current_rate = $itemInv->price;
                                                                }
                                                                else if ($b_cost_unit=='6') {// for % of BSP
                                                                    $current_rate = ($itemInv->price*$asking_price/100);
                                                                }
                                                            }
                                                        }
                                                        // commercial
                                                        else if($item->project_type==3){
                                                                //$size = $item->sa;
                                                                //if ($item->sa_unit_name) {
                                                                //    $size .= ' '.$item->sa_unit_name;
                                                                //}

                                                            if ($b_cost_unit=='2') {// for Sq.Ft
                                                                $current_rate = $item->sa*$itemInv->price;
                                                            }
                                                            else if ($b_cost_unit=='5') {// for Fix
                                                                $current_rate = $itemInv->price;
                                                            }
                                                            else if ($b_cost_unit=='6') {// for % of BSP
                                                                $current_rate = ($itemInv->price*$asking_price/100);
                                                            }
                                                        }
                                                    }
                                                }

                                                if ($current_rate) {
                                                    $m_price = $current_rate;
                                                }


                                                $cost = 0;
                                                $gst = 0;
                                                $gst_amount = 0;
                                                $total = 0;


                                                if ($m_price) {
                                                  $total_cost += $cost = $m_price;

                                                  if ($m_gst) {
                                                    $gst = $m_gst;
                                                    $total_gst_amount += $gst_amount = ($cost*$gst/100);
                                                  }
                                                  $total_amount += $total = $cost+$gst_amount;
                                                }
                                                ?>
                                                <div class="col-md-12">
                                                  <div class="row">
                                                      <div class="col-md-3 col-xs-3">
                                                          <label><?= $itemInv->price_component_name ?></label>
                                                      </div>

                                                      <div class="col-md-3 col-xs-3" align="right">
                                                          <label style="color: #333;"><?= ($cost)?'Rs.'.$cost:'' ?></label>
                                                      </div>

                                                      <div class="col-md-3 col-xs-3" align="right">
                                                          <label style="color: #333;"><?= ($gst)?'Rs.'.$gst_amount:'' ?></label>
                                                      </div>

                                                      <div class="col-md-3 col-xs-3" align="right">
                                                          <label style="color: #333;"><?= ($total)?'Rs.'.$total:'' ?></label>
                                                      </div>
                                                    
                                                    </div>
                                                </div>
                                              <?php
                                              }
                                            }
                                            ?>

                                            <div class="col-md-12">
                                              <hr style="margin-bottom: 12px;">
                                              <div class="row">
                                                  <div class="col-md-3 col-xs-3" align="right">
                                                      <label>Total </label>
                                                  </div>

                                                  <div class="col-md-3 col-xs-3" align="right">
                                                      <label style="color: #333;"><?= ($total_cost)?'Rs.'.$total_cost:'' ?></label>
                                                  </div>

                                                  <div class="col-md-3 col-xs-3" align="right">
                                                      <label style="color: #333;"><?= ($total_gst_amount)?'Rs.'.$total_gst_amount:'' ?></label>
                                                  </div>

                                                  <div class="col-md-3 col-xs-3" align="right">
                                                      <label style="color: #333;"><?= ($total_amount)?'Rs.'.$total_amount:'' ?></label>
                                                  </div>
                                                
                                                </div>
                                            </div>

                                            <div class="col-md-12" style="margin-top: 10px;">
                                                <label>Deal Amount: </label> <span style="color: #333;"><?= ($booking_detail->deal_amount)?'Rs.'.$booking_detail->deal_amount:'' ?></span>
                                            </div>

                                            <div class="col-md-12">
                                                <label>Remark: </label> <span style="color: #333;"><?= $booking_detail->remark ?></span>
                                            </div>

                                            <div class="col-md-12" style="margin-top: 20px;">
                                                <h5>Payment Detail</h5>
                                                <label>Booking Amount: </label> <span style="color: #333;"><?= ($booking_detail->booking_amount)?'Rs.'.$booking_detail->booking_amount:'' ?></span>
                                            </div>

                                            <div class="col-md-12">
                                                <label>Date: </label> <span style="color: #333;"><?= $booking_detail->booking_date ?></span>
                                            </div>

                                            <div class="col-md-12" style="margin-top: 20px;">
                                                  <?php if(!$booking_detail->share_account_id) { ?>
                                                  <?php if($booking_detail->booking_status==2) { ?>
                                                    <h5 style="color:red;font-weight: bold;margin-bottom: 10px;">Booking Rejected</h5>
                                                    <p style="margin-bottom: 20px;">Comment: <span style="color: #333;"><?= $booking_detail->comment ?></span></p>
                                                  <?php } else if($booking_detail->booking_status==3) { ?>
                                                    <h5 style="color:red;font-weight: bold;margin-bottom: 10px;">Booking Canclled</h5>
                                                    <p style="margin-bottom: 20px;">Comment: <span style="color: #333;"><?= $booking_detail->comment ?></span></p>
                                                  <?php } else if($booking_detail->booking_status==1) { ?>
                                                    <h5 style="color:green;font-weight: bold;margin-bottom: 20px;">Booking Accepted</h5>
                                                    <button class="btn btn-danger btn-md" style="margin-right: 15px;color:#fff;" onclick="updateBookingStatusConfirm(<?= $booking_detail->booking_id ?>,3,'Cancel')">Cancel</button>
                                                    <?php } else { ?>
                                                    <button class="btn btn-success btn-md" style="margin-right: 15px;color:#fff;" onclick="updateBookingStatusConfirm(<?= $booking_detail->booking_id ?>,1,'Accept')">Accept</button>
                                                    <button class="btn btn-warning btn-md" style="margin-right: 15px;color:#fff;" onclick="updateBookingStatusConfirm(<?= $booking_detail->booking_id ?>,2,'Reject')">Reject</button>
                                                    <?php } ?>
                                                    <?php } ?>
                                                <button class="btn btn-dark btn-md" style="margin-right: 15px;color:#fff;" onclick="printBooking('printableArea')">Print</button>
                                            </div>

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


<!-- modal form -->
<div class="modal fade" id="formModal" tabindex="-1" budget="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" budget="document">
        <div class="modal-content">

            <form id="form-modal" method="post">
                <input type="hidden" class="form-control" id="booking_id" name="booking_id" value="<?= $booking_detail->booking_id ?>">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Edit Booking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="error-msg"></div>
                    <div class="row form-group">
                          <div class="col-md-12"><label for="budget_name" class="col-form-label">Name:</label></div>
                      <div class="col-md-4">
                      <select id="inputState" class="form-control" name="lead_title">
                          <option selected="selected" value="">Select Title</option>
                          <option value="Mr." <?php if($lead_detail && $lead_detail->lead_title=='Mr.') { echo 'selected'; } ?>>Mr.</option>
                          <option value="Ms." <?php if($lead_detail && $lead_detail->lead_title=='Ms.') { echo 'selected'; } ?>>Ms.</option>
                          <option value="Mrs." <?php if($lead_detail && $lead_detail->lead_title=='Mrs.') { echo 'selected'; } ?>>Mrs.</option>
                          <option value="M/s." <?php if($lead_detail && $lead_detail->lead_title=='M/s.') { echo 'selected'; } ?>>M/s.</option>
                          <option value="Dr." <?php if($lead_detail && $lead_detail->lead_title=='Dr.') { echo 'selected'; } ?>>Dr.</option>
                          <option value="Prof." <?php if($lead_detail && $lead_detail->lead_title=='Prof.') { echo 'selected'; } ?>>Prof.</option>
                         
                      </select>
                      </div>
                      <div class="col-md-4">
                          <input type="text" class="form-control" id="lead_first_name" name="lead_first_name" value="<?= $lead_detail->lead_first_name ?>" placeholder="First Name">
                      </div>
                      <div class="col-md-4">
                          <input type="text" class="form-control" id="lead_first_name" name="lead_last_name" value="<?= $lead_detail->lead_last_name ?>" placeholder="Last Name">
                      </div>
                      </div>

                    <div class="row form-group">
                          <div class="col-md-12"><label for="budget_name" class="col-form-label">Name of S/D/W:</label></div>
                      <div class="col-md-4">
                      <select id="inputState" class="form-control" name="sdw_title">
                          <option selected="selected" value="">Select Title</option>
                          <option value="Mr." <?php if($booking_detail && $booking_detail->sdw_title=='Mr.') { echo 'selected'; } ?>>Mr.</option>
                          <option value="Ms." <?php if($booking_detail && $booking_detail->sdw_title=='Ms.') { echo 'selected'; } ?>>Ms.</option>
                          <option value="Mrs." <?php if($booking_detail && $booking_detail->sdw_title=='Mrs.') { echo 'selected'; } ?>>Mrs.</option>
                          <option value="M/s." <?php if($lead_detail && $lead_detail->lead_title=='M/s.') { echo 'selected'; } ?>>M/s.</option>
                          <option value="Dr." <?php if($booking_detail && $booking_detail->sdw_title=='Dr.') { echo 'selected'; } ?>>Dr.</option>
                          <option value="Prof." <?php if($booking_detail && $booking_detail->sdw_title=='Prof.') { echo 'selected'; } ?>>Prof.</option>
                         
                      </select>
                      </div>
                      <div class="col-md-4">
                          <input type="text" class="form-control" id="sdw" name="sdw" value="<?= $booking_detail->sdw ?>" placeholder="Name of S/D/W:">
                      </div>
                      </div>

                    <div class="form-group">
                        <label for="budget_name" class="col-form-label">Address:</label>
                        <textarea type="text" rows="2" class="form-control" id="address" name="address"><?= $booking_detail->address ?></textarea>
                    </div>

                    <div class="row form-group">
                      <div class="col-md-4">
                        <label for="budget_name" class="col-form-label">State:</label>
                        <select class="form-control" id="state_id" name="lead_state_id" onchange="getCity(this.value)">
                             <option value="">Select State</option>
                              <?php foreach ($state_list as $state) { ?>
                            <option value="<?= $state->state_id ?>" <?php if($lead_detail && $lead_detail->lead_state_id==$state->state_id) { echo 'selected'; } ?>><?= $state->state_name ?></option>
                              <?php } ?>
                         </select>
                      </div>
                      <div class="col-md-4">
                        <label for="budget_name" class="col-form-label">City:</label>
                          <select class="form-control" id="city_id" name="lead_city_id">
                             <option value="">Select City</option>
                              <?php foreach ($city_list as $city) { ?>
                            <option value="<?= $city->city_id ?>" <?php if($lead_detail && $lead_detail->lead_city_id==$city->city_id) { echo 'selected'; } ?>><?= $city->city_name ?></option>
                              <?php } ?>
                         </select>
                      </div>
                      </div>


                    <div class="form-group">
                        <label for="budget_name" class="col-form-label">Mobile No:</label>
                        <input type="text" class="form-control" id="lead_mobile_no" name="lead_mobile_no" value="<?= $lead_detail->lead_mobile_no ?>">
                    </div>

                    <div class="form-group">
                        <label for="budget_name" class="col-form-label">Email Id:</label>
                        <input type="text" class="form-control" id="lead_email" name="lead_email" value="<?= $lead_detail->lead_email ?>">
                    </div>

                    <div class="form-group">
                        <label for="budget_name" class="col-form-label">Adhar No:</label>
                        <input type="text" class="form-control" id="lead_adhar_no" name="lead_adhar_no" value="<?= $lead_detail->lead_adhar_no ?>">
                    </div>

                    <div class="form-group">
                        <label for="budget_name" class="col-form-label">PAN No:</label>
                        <input type="text" class="form-control" id="lead_pan_no" name="lead_pan_no" value="<?= $lead_detail->lead_pan_no ?>">
                    </div>

                    <div class="form-group">
                        <label for="budget_name" class="col-form-label">Remark:</label>
                        <textarea type="text" rows="2" class="form-control" id="remark" name="remark"><?= $booking_detail->remark ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success form-btn wd-100">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal end -->

<!-- modal form -->
<div class="modal fade" id="formModalAction" tabindex="-1" budget="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" budget="document">
        <div class="modal-content">

            <form id="action-form-modal" method="post">
                <input type="hidden" class="form-control" name="id" value="<?= $booking_detail->booking_id ?>">
                <input type="hidden" class="form-control" id="bk_status" name="status" value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="action-error-msg"></div>

                    <div class="form-group">
                        <label for="budget_name" class="col-form-label">Comment:</label>
                        <textarea type="text" rows="3" class="form-control" id="bk_comment" name="comment" required=""></textarea>
                    </div>
                          
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success action-form-btn wd-100">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal end -->

 <?php include('include/footer.php');?>
<script src="<?php echo base_url('public/admin/') ?>plugins/sweetalert/js/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
 <script>
$('input[type=radio][name=radioType]').change(function() {

    if (this.value == 'KYC') {
       $(".box-kyc").show();
       $(".box-plan").hide();
       $(".box-invoice").hide();
       $(".box-summary").hide();
    }
    else if (this.value == 'Plan') {
       $(".box-kyc").hide();
       $(".box-plan").show();
       $(".box-invoice").hide();
       $(".box-summary").hide();
    }
    else if (this.value == 'InvoiceReceipt') {
       $(".box-kyc").hide();
       $(".box-plan").hide();
       $(".box-invoice").show();
       $(".box-summary").hide();
    }
    else if (this.value == 'Summary') {
       $(".box-kyc").hide();
       $(".box-plan").hide();
       $(".box-invoice").hide();
       $(".box-summary").show();
    }
});
function alertMessage(type,message) {
  if (type=='error') {
    type = 'danger';
  }

  return "<div class='alert alert-"+type+" alert-dismissible'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "+message+" </div>";
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

function editBooking(){
  $("#formModal").modal('show');
}

$("#form-modal").validate({
    rules: {
    },
    messages: {
    },
    submitHandler: function(form) {
      var myform = document.getElementById("form-modal");
      var fd = new FormData(myform );
      var btn_label = "Update";

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'api/update_booking') ?>",
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

                if (obj.status=='updated') {
                  $("#formModal").modal('hide');
                  $(".error-msg").html(alertMessage('success',obj.message));
                  window.location.href='';
                }
                else {
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

$("#action-form-modal").validate({
    rules: {
    },
    messages: {
    },
    submitHandler: function(form) {
      var myform = document.getElementById("action-form-modal");
      var fd = new FormData(myform );
      var btn_label = "Submit";

      $.ajax({
        type: "POST",
        url: "<?= base_url(AGENT_URL.'api/update_booking_status') ?>",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
        beforeSend: function (data) {
          $(".action-error-msg").html('');
          $(".action-form-btn").html("<i class='fa fa-circle-o-notch fa-spin'></i>");
        },
        success: function (response) {
          setTimeout(function(){
            var obj;
              try {
                obj = JSON.parse(response);
                $(".action-form-btn").html(btn_label);

                if (obj.status=='success') {
                  $("#formModalAction").modal('hide');
                  //$(".action-error-msg").html(alertMessage('success',obj.message));
                  window.location.href='';
                }
                else {
                  $(".action-error-msg").html(alertMessage('error',obj.message));
                }
              }
              catch(err) {
                $(".action-form-btn").html(btn_label);
                $(".action-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
              }
          },500);
        },
        error: function () {
            $(".action-form-btn").html(btn_label);
          $(".action-error-msg").html(alertMessage('error','Some error occurred, please try again.'));
           
        }

    });

    }
});

function updateBookingStatusConfirm(id,t,n) {
    if (t==1) {
        swal({
          title: "Are you sure to "+n+"?",
          showCancelButton: true,
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: true,     
        }, function(isConfirm) {
          if (isConfirm) {
            
            $(".sa-button-container button").prop('disabled', true);
            $(".sa-button-container button").css('color', '#ffffff');
            $(".confirm").text("Wating...");

            update_booking_status(id,t)
          } 
        });
    }
    else {
        $("#formModalAction").modal('show');
        $("#formModalAction .modal-title").html('Booking '+n);
        $("#bk_status").val(t);
        $("#bk_comment").val('');
    }
  }

  function update_booking_status(id,t) {

    $.ajax({
    type: "POST",
    url: "<?php echo base_url(AGENT_URL.'api/update_booking_status'); ?>",
    data: {id:id,status:t,comment:''},
    success: function (data) {
      setTimeout(function() {
        swal.close();
        window.location.href='';
      },500);
    },
    error: function () {
      alert('Some Error Occured.');
    }

  });
  }

  function printBooking(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
 </script>