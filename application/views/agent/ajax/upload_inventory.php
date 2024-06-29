<?php 

$floors = array();
$floor_ids = array();
$towers = array();
$tower_ids = array();
$unit_codes = array();
$unit_code_ids = array();

foreach ($floor_list as $floor) {
	$floors[] = $floor->floor_name;//$floor->floor_id."#".$floor->floor_name; 
	$floor_ids[] = $floor->floor_id; 
}
foreach ($block_list as $item) {
	$towers[] = $item['block_name'];//$item['block_id']."#".$item['block_name']; 
	$tower_ids[] = $item['block_id']; 
}
foreach ($unit_code_list as $unit_code) {
	$unit_codes[] = $unit_code['unit_code'];//$unit_code['unit_code_id']."#".$unit_code['unit_code']; 
	$unit_code_ids[] = $unit_code['unit_code_id']; 
}


$plc_ids = array();
$plc_column_ids = array();
$add_ids = array();
$add_column_ids = array();

if (isset($_POST["product_id"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        $l = 0;
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            //echo $sqlInsert = "INSERT into users (userId,userName,password,firstName,lastName)
            //       values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "')";
        	if($l) {
	        	$i_unit_code = "";
				if(in_array($column[1], $unit_codes)) {
					$i_unit_code = $unit_code_ids[array_search($column[1],$unit_codes)];
				}

				$i_tower = "";
				if(in_array($column[4], $towers)) {
					$i_tower = $tower_ids[array_search($column[4],$towers)];
				}

				$i_floor = "";
				if(in_array($column[5], $floors)) {
					$i_floor = $floor_ids[array_search($column[5],$floors)];
				}

				//echo count($column);exit;
	            $data_array = array(
		            'unit_code'=>$i_unit_code,
		            'unit_no'=>$column[3],
		            'basic_cost'=>($column[6]=='Yes')?1:0,
		            'club_cost'=>0,
		            'parking'=>($column[7]=='Yes')?1:0,
		            'floor_id'=>$i_floor,
		            'product_id' => $product_id,
		            'builder_id' => '',
		            'extra_entry' => '',
		            'reference'=>$column[2],
		            'block_id'=>$i_tower
		        );

	            $inventory_id = $column[0];
		        if ($inventory_id) {
		            $data_array['updated_at'] = time();

		            $this->Action_model->update_data($data_array,'tbl_inventory',"inventory_id='".$inventory_id."'");
		        }
		        else {
		            $data_array['created_at'] = time();
		            $data_array['updated_at'] = time();

		            $inventory_id = $this->Action_model->insert_data($data_array,'tbl_inventory');
		        }

		        foreach ($plc_column_ids as $key => $value) {

		        	$data_array = array(
                    'inventory_id'=>$inventory_id,
                    'product_plc_detail_id'=>$plc_ids[$key],
                    'is_active'=>($column[$value]=='Yes')?1:0
                    );

					$where_ent = "inventory_id='".$inventory_id."' AND product_plc_detail_id='".$plc_ids[$key]."'";
					$dd_ent = $this->Action_model->select_single('tbl_inventory_plc',$where_ent);
					if ($dd_ent) {
						$this->Action_model->update_data($data_array,'tbl_inventory_plc',$where_ent);
					}
					else {
						$this->Action_model->insert_data($data_array,'tbl_inventory_plc');
					}
		        }

		        foreach ($add_column_ids as $key => $value) {

		        	$data_array = array(
                    'inventory_id'=>$inventory_id,
                    'product_additional_detail_id'=>$add_ids[$key],
                    'is_active'=>($column[$value]=='Yes')?1:0
                    );

					$where_ent = "inventory_id='".$inventory_id."' AND product_additional_detail_id='".$add_ids[$key]."'";
                   $dd_ent = $this->Action_model->select_single('tbl_inventory_additional',$where_ent);

                   if ($dd_ent) {
                        $this->Action_model->update_data($data_array,'tbl_inventory_additional',$where_ent);
                   }
                   else {
                        $this->Action_model->insert_data($data_array,'tbl_inventory_additional');
                   }
		        }

		        //print_r($data_array); echo "<br>";
	    	}
	    	else {
	    		foreach ($column as $key => $value) {
	    			if ($key>7) {

	    				$this->db->select("*");
		                $this->db->from('tbl_product_plc_details');
		                $this->db->join('tbl_price_components', 'tbl_price_components.price_component_id = tbl_product_plc_details.price_comp_id');
		                $this->db->where("price_component_name='".$value."' AND product_id='".$product_id."'");
		                $query = $this->db->get();
		                $record_f = $query->row();

		                if ($record_f) {
		                	$plc_ids[] = $record_f->product_plc_detail_id;
	    					$plc_column_ids[] = $key;
		                }

		                $this->db->select("*");
		                $this->db->from('tbl_product_additional_details');
		                $this->db->join('tbl_price_components', 'tbl_price_components.price_component_id = tbl_product_additional_details.price_comp_id');
		                $this->db->where("price_component_name='".$value."' AND product_id='".$product_id."'");
		                $query = $this->db->get();
		                $record_f = $query->row();

		                if ($record_f) {
		                	$add_ids[] = $record_f->product_additional_detail_id;
	    					$add_column_ids[] = $key;
		                }
	    			}
	    		}
	    	}
	        $l++;
        }
    }

    $this->session->set_flashdata('success_msg', 'Upload Successfully!!');
    redirect(AGENT_URL.'manage-inventory');
}

?>