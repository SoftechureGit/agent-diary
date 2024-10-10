<?php 
                    $asking_price = 0;
                    $where="pud.product_unit_detail_id='".$inventory_data->unit_code."'";
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

                    $size = "";
                    $is_plot = false;
                    $is_sa = false;
                    if ($item) {

                    	
		                if($item->project_type==2){
		                            
		                    if(($item->property_type==1 || $item->property_type==7) && $item->sa){
		                        $size = $item->sa;
		                        if ($item->sa_unit_name) {
		                            $size .= ' '.$item->sa_unit_name;
		                        }
		                        $is_sa = true;
		                    }
		                    if(($item->property_type==2 || $item->property_type==3) && $item->plot_size){
		                        $size = $item->plot_size;
		                        if ($item->plot_unit_name) {
		                            $size .= ' '.$item->plot_unit_name;
		                        }
		                        $is_plot = true;
		                    }
		                }

		                if($item->project_type==3 && $item->sa){
		                        $size = $item->sa;
		                        if ($item->sa_unit_name) {
		                            $size .= ' '.$item->sa_unit_name;
		                        }
		                        $is_sa = true;
		                }

                        $budget = "";

                        $this->db->select('*,tbl_inventory.inventory_id as inventory_id');
                        $this->db->from('tbl_inventory');
                        $this->db->join('tbl_basic_cost', 'tbl_basic_cost.inventory_id = tbl_inventory.inventory_id','left');
                        $this->db->where("unit_code='".$item->product_unit_detail_id."' AND tbl_inventory.inventory_id='".$inventory_data->inventory_id."'");
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
<div class="row">
	<div class="col-md-12"><span style="color: #333;">Date:</span> <span></span></div>
	<div class="col-md-12"><span style="color: #333;">Project:</span> <span><?= $inventory_data->project_name ?></span></div>
	<div class="col-md-12"><span style="color: #333;">Builder:</span> <span><?= $inventory_data->b_firm_name ?></span></div>
	<div class="col-md-12" style="margin-bottom: 15px;"><span style="color: #333;">Location:</span> <span><?= $inventory_data->location_name ?></span></div>
	<div class="col-md-4"><span style="color: #333;">Unit Ref: <span></span><?= $inventory_data->reference ?></div>
	<div class="col-md-4"><span style="color: #333;">Unit No:</span> <span><?= $inventory_data->unit_no ?></span></div>
	<div class="col-md-4"><span style="color: #333;">Accomodation:</span> <span><?= $inventory_data->accomodation_name ?></span></div>
	<div class="col-md-4"><span style="color: #333;">Tower:</span> <span><?= $inventory_data->block_name ?></span></div>
	<div class="col-md-8"><span style="color: #333;">Floor:</span> <span><?= $inventory_data->floor_name ?></span></div>
	<div class="col-md-4"><span style="color: #333;">Plot Size:</span> <span><?= ($is_plot)?$size:'' ?></span></div>
	<div class="col-md-4"><span style="color: #333;">Saleable Area:</span> <span><?= ($is_sa)?$size:'' ?></span></div>

	<div class="col-md-12" style="margin-top: 13px;"><h4>Cost Details</h4></div>

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
	      <div class="col-md-4 col-xs-4">
	          <label>Basic Cost: </label>
	      </div>

	      <div class="col-md-4 col-xs-4" align="center">
	          <label style="color: #333;">:</label>
	      </div>

	      <div class="col-md-4 col-xs-4" align="right">
	          <label style="color: #333;"><?= ($cost)?'Rs.'.$cost:'' ?></label>
	      </div>
	    
	    </div>
	</div>


	<?php if($item){ 
	  $where = "inventory_id='".$inventory_data->inventory_id."' and is_active='1'";
	  $this->db->select("*");
	  $this->db->from('tbl_inventory_additional');
	  $this->db->join('tbl_product_additional_details', 'tbl_product_additional_details.product_additional_detail_id = tbl_inventory_additional.product_additional_detail_id','left');
	  $this->db->join('tbl_price_components', 'tbl_price_components.price_component_id = tbl_product_additional_details.price_comp_id','left');
	  $this->db->where($where);
	  $query = $this->db->get();
	  $add_items = $query->result();
	  if ($add_items) {
	  	?>
	  	<div class="col-md-12">
	  		<div style="color: #333;font-weight: bold;margin-top: 2px;margin-bottom: 2px;">Additional:</div>
	  	</div>
	  	<?php
	  }
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
	                        $current_rate += ($item->construction_area ?? 1) *$itemInv->current_rate;
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
	          <div class="col-md-4 col-xs-4" style="padding-left: 40px;">
	              <label><?= $itemInv->price_component_name ?></label>
	          </div>

		      <div class="col-md-4 col-xs-4" align="center">
		          <label style="color: #333;">:</label>
		      </div>

		      <div class="col-md-4 col-xs-4" align="right">
		          <label style="color: #333;"><?= ($cost)?'Rs.'.$cost:'' ?></label>
		      </div>
	        
	        </div>
	    </div>
	  <?php
	  }


	  $where = "inventory_id='".$inventory_data->inventory_id."' and is_active='1'";
	  $this->db->select("*");
	  $this->db->from('tbl_inventory_plc');
	  $this->db->join('tbl_product_plc_details', 'tbl_product_plc_details.product_plc_detail_id = tbl_inventory_plc.product_plc_detail_id','left');
	  $this->db->join('tbl_price_components', 'tbl_price_components.price_component_id = tbl_product_plc_details.price_comp_id','left');
	  $this->db->where($where);
	  $query = $this->db->get();
	  $add_items = $query->result();
	  if ($add_items) {
	  	?>
	  	<div class="col-md-12">
	  		<div style="color: #333;font-weight: bold;margin-top: 2px;margin-bottom: 2px;">PLC:</div>
	  	</div>
	  	<?php
	  }
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
	          <div class="col-md-4 col-xs-4" style="padding-left: 40px;">
	              <label><?= $itemInv->price_component_name ?></label>
	          </div>

		      <div class="col-md-4 col-xs-4" align="center">
		          <label style="color: #333;">:</label>
		      </div>

		      <div class="col-md-4 col-xs-4" align="right">
		          <label style="color: #333;"><?= ($cost)?'Rs.'.$cost:'' ?></label>
		      </div>
	        
	        </div>
	    </div>
	  <?php
	  }
	}
	?>

	<?php 
	if ($parking_open_show || $parking_stilt_show || $parking_basment_show) {
	  	?>
	  	<div class="col-md-12">
	  		<div style="color: #333;font-weight: bold;margin-top: 2px;margin-bottom: 2px;">Parking:</div>
	  	</div>
	  	<?php
  	}
	if($parking_open_show){ 

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
	      <div class="col-md-4 col-xs-4" style="padding-left: 40px;">
	          <label>Open: </label>
	      </div>

	      <div class="col-md-4 col-xs-4" align="center">
	          <label style="color: #333;">:</label>
	      </div>

	      <div class="col-md-4 col-xs-4" align="right">
	          <label style="color: #333;"><?= ($cost)?'Rs.'.$cost:'' ?></label>
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
	      <div class="col-md-4 col-xs-4" style="padding-left: 40px;">
	          <label>Stilt: </label>
	      </div>

	      <div class="col-md-4 col-xs-4" align="center">
	          <label style="color: #333;">:</label>
	      </div>

	      <div class="col-md-4 col-xs-4" align="right">
	          <label style="color: #333;"><?= ($cost)?'Rs.'.$cost:'' ?></label>
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
	      <div class="col-md-4 col-xs-4" style="padding-left: 40px;">
	          <label>Basment: </label>
	      </div>

	      <div class="col-md-4 col-xs-4" align="center">
	          <label style="color: #333;">:</label>
	      </div>

	      <div class="col-md-4 col-xs-4" align="right">
	          <label style="color: #333;"><?= ($cost)?'Rs.'.$cost:'' ?></label>
	      </div>
	    
	    </div>
	</div>
	<?php } ?>


    <div class="col-md-12">
	  <hr style="margin-bottom: 12px;">
      <div class="row">
          <div class="col-md-4 col-xs-4">
              <label style="font-weight: 600;">Total Cost</label>
          </div>

	      <div class="col-md-4 col-xs-4" align="center">
	          <label style="color: #333;">:</label>
	      </div>

	      <div class="col-md-4 col-xs-4" align="right">
	          <label style="color: #333;font-weight: 600;"><?= ($total_cost)?'Rs.'.$total_cost:'' ?></label>
	      </div>
        
        </div>
    </div>

    <div class="col-md-12">
      <div class="row">
          <div class="col-md-4 col-xs-4">
              <label style="font-weight: 600;">Total GST</label>
          </div>

	      <div class="col-md-4 col-xs-4" align="center">
	          <label style="color: #333;">:</label>
	      </div>

	      <div class="col-md-4 col-xs-4" align="right">
	          <label style="color: #333;font-weight: 600;"><?= ($total_gst_amount)?'Rs.'.$total_gst_amount:'' ?></label>
	      </div>
        
        </div>
    </div>

    <div class="col-md-12">
      <div class="row">
          <div class="col-md-4 col-xs-4">
              <label style="font-weight: 600;">Net Cost</label>
          </div>

	      <div class="col-md-4 col-xs-4" align="center">
	          <label style="color: #333;">:</label>
	      </div>

	      <div class="col-md-4 col-xs-4" align="right">
	          <label style="color: green;font-weight: 600;font-size: 18px;"><?= ($total_amount)?'Rs.'.$total_amount:'' ?></label>
	      </div>
        
        </div>
    </div>

	<div class="col-md-12" style="margin-top: 15px;">
	<p>For any further Details Please Call Us Agent: <b><?= ($inventory_data->a_is_individual)?ucwords($inventory_data->a_user_title.' '.$inventory_data->a_first_name.' '.$inventory_data->a_last_name):$inventory_data->a_firm_name ?> <?= ($inventory_data->a_mobile)?'(+91'.$inventory_data->mobile.')':'' ?></b></p>
	</div>
	<div class="col-md-12">
	<div>Note: </div>
	<style>
		.notelist {
			margin-left: 35px;
		}
		.notelist li {
			display: list-item;
			list-style-type: circle;
			color: #787878;
		}
	</style>
	<ul class="notelist">
		<li>All Payment should be make in the name of <?= $inventory_data->b_firm_name ?> Payable at Par</li>
		<li>Final price will be calculate at the time of Booking</li>
		<li>Terms and conditional applicable</li>
		<li>GST as applicable</li>
	</ul>
	</div>
</div>