<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


# Facings
if (!function_exists('facings')) {
    function facings($id = '')
    {
        $where              =   "facing_status = 1";

        if ($id) :
            $where          .=   " and facing_id = '$id'";
        endif;

        $records    =   db_instance()
            ->select('*')
            ->where($where)
            ->order_by("title", "asc")
            ->get('tbl_facings');

        if ($id) :
            $records    =   $records->row();
        else :
            $records    = $records->result();
        endif;

        return $records ?? [];
    }
}
# End Facings

# Lead Details
if (function_exists('lead')) {
    function lead($id)
    {
        echo $id;
        die;

        if (!$id) return null;

        return db_instance()->where("lead_id = $id")->get('tbl_leads')->row();
    }
}
# End Lead Details

# Lead Details

if (function_exists('facings')) {
    function sizeUnits($id = 0)
    {
        $where    = "unit_status='1'";
        if ($id) :
            $where    .= " and unit_id = '$id '";
        endif;

        $records    =   db_instance()->select('*');
        $records->where($where);
        $records    =  $records->get('tbl_units');
        if ($id) :
            $records    = $records->row();
        else :
            $records    = $records->result();
        endif;

        return $records ?? null;
    }
}

# End Lead Details

# Get Inventory Details
function property($id)
{
    return db_instance()
        ->select(
            'property.product_id as id,
                    property.project_name as name, 
                    property.property_type as property_type_id, 
                    property.project_type as project_type_id,
                    project_type.product_type_name as project_type_name,
                    property_type.unit_type_name as property_type_name,

                    unit_size.unit_name as unit_size_name, 
                    accomodation.accomodation_name, 
                    '
        )
        ->where("property.product_id='$id'")
        ->join('tbl_product_types as project_type', "project_type.product_type_id = property.project_type", 'left')
        ->join('tbl_unit_types as property_type', "property_type.unit_type_id = property.property_type", 'left')
        ->join('tbl_product_unit_details as proptery_details', "proptery_details.product_id = property.product_id", 'left')

        ->join('tbl_units as unit_size', "unit_size.unit_id = proptery_details.unit", 'left')
        ->join('tbl_accomodations as accomodation', "accomodation.accomodation_id = proptery_details.accomodation", 'left')
        ->get('tbl_products as property')
        ->row();
}
# End Get Inventory Details

# Get Property Parkings Details
function parkings($id)
{
    $parkings                   =   [];
    $parkings                   =   [];
    $record                     =   db_instance()
        ->select(
            'property.product_id as id, 
                                                property.project_name as name, 
                                                property.parking_open,
                                                property.parking_stilt,
                                                property.parking_basment as parking_basement
                                                '
        )
        ->where("property.product_id='$id'")
        ->get('tbl_products as property')
        ->row();

    if ($record) :

        # Open Parking
        if (($record->parking_open ?? 0)) :
            $parkings[]           = (object) [
                'label' => 'Open',
                'value' => 'open'
            ];
        endif;
        # End Open Parking

        # Stilt Parking
        if (($record->parking_stilt ?? 0)) :
            $parkings[]           = (object) [
                'label' => 'Stilt',
                'value' => 'stilt'
            ];
        endif;
        # End Stilt Parking

        # Basement Parking
        if (($record->parking_basement ?? 0)) :
            $parkings[]           = (object) [
                'label' => 'Basement',
                'value' => 'basement'
            ];
        endif;
    # End Basement Parking

    endif;

    return (object) $parkings;
}
# End Get Property Parkings Details

# Get Inventory Details
function getInventory($id)
{
    return db_instance()
        ->select('*')
        ->where("inventory_id = $id")
        ->get('tbl_inventory')
        ->row();
}
# End Get Inventory Details

# Get Inventory Details
function getPropertyPlcs($property_id, $selected_applicable_plcs = null)
{
    $where   = ' 1 = 1';

    if (!$property_id) {
        return null;
    }

    $where                  =   "product_id='" . $property_id . "'";

    if ($selected_applicable_plcs && is_array($selected_applicable_plcs)) :
        $selected_applicable_plcs       =   implode(',', $selected_applicable_plcs);
        if ($selected_applicable_plcs) :
            $where                  .=   " and price_component_id in ( $selected_applicable_plcs )";
        endif;
    endif;

    db_instance()->select('*');
    db_instance()->from('tbl_product_plc_details as plc');
    db_instance()->join('tbl_price_components', 'tbl_price_components.price_component_id = plc.price_comp_id');
    db_instance()->where($where);
    return db_instance()->get()->result();
}
# End Get Inventory Details

# Get Property Accomodations
if (!function_exists('getPropertyAccomodations')) {
    function getPropertyAccomodations($project_type_id, $property_type_id, $property_id, $id = null)
    {
        $unit_code_list   = null;

        $where = "product_id='" . $property_id . "' AND project_type='" . $project_type_id . "' AND property_type='" . $property_type_id . "'";

        if ($id) :
            $where  .= " and inventory.product_unit_detail_id = '$id'";
        endif;

        db_instance()->select("inventory.product_unit_detail_id as id, inventory.code as inventory_unit_code, accomodation.accomodation_id, accomodation.accomodation_name, concat(accomodation.accomodation_name,' ', inventory.code) as unit_code_with_accomodation_name");
        db_instance()->from('tbl_product_unit_details as inventory');
        db_instance()->join('tbl_accomodations as accomodation', 'accomodation.accomodation_id = inventory.accomodation', 'left');
        db_instance()->where($where);
        $query = db_instance()->get();

        if ($id) :
            $result = $query->row();
        else :
            $result = $query->result();
        endif;

        return $result ?? null;
    }
}
# End Get Property Accomodations

# Get Floors
if (!function_exists('getFloors')) {
    function getFloors($id = null)
    {
        $where  = "floor_status = '1'";

        if ($id) :
            $where  .= " and floor_id = $id";
        endif;

        $result  = db_instance()
            ->select('floor_id as id, floor_name as name')
            ->where($where)
            ->get('tbl_floors');

        if ($id) :
            $result  = $result->row();
        else :
            $result  = $result->result();
        endif;

        return $result;
    }
}
# End Get Floors

# Get Blocks or Towers
if (!function_exists('getBlocksOrTowers')) {
    function getBlocksOrTowers($id = null)
    {
        $where  = "1 = 1";

        if ($id) :
            $where  .= " and block_id = $id";
        endif;

        $result  = db_instance()
            ->select('block_id as id, block_name as name')
            ->where($where)
            ->get('tbl_product_block_details');

        if ($id) :
            $result  = $result->row();
        else :
            $result  = $result->result();
        endif;

        return $result;
    }
}
# End Get Blocks or Towers

# Inventory Status
if (!function_exists('inventory_status')) {
    function inventory_status($id = '')
    {
        $where  = "1 = '1'";

        if ($id) :
            $where  .= " and tbl_inventory_status = $id";
        endif;

        $result  = db_instance()
            ->select('inventory_status_id as id, inventory_status_name as name')
            ->where($where)
            ->get('tbl_inventory_status');

        if ($id) :
            $result  = $result->row();
        else :
            $result  = $result->result();
        endif;

        return $result;
    }
}
# End Inventory Status

# Accomodations
if (!function_exists('accomodations')) {
    function accomodations($id = ''){
        $where  = "accomodation_status = '1'";

        if ($id) :
            $where  .= " and accomodation_id = $id";
        endif;

        $result  = db_instance()
            ->select('accomodation_id as id, accomodation_name as name')
            ->where($where)
            ->get('tbl_accomodations');

        if ($id) :
            $result  = $result->row();
        else :
            $result  = $result->result();
        endif;

        return $result;
    }
}
# End Accomodations

/*******************************************
 *  Inventory Filters
*******************************************/
    # Sa Size List
    if(!function_exists('inventory_sa_sizes')):
        function inventory_sa_sizes($data = null){
            # Data 
            $property_id    = $data->property_id ?? 0;
            $unit_code      = $data->unit_code ?? 0;
            # End Data 

            # Conditions
            $where          =   '1 = 1';

            if($property_id):
                $where          .=   " and inventory.product_id = $property_id";
            endif;
            
            if($unit_code):
                $where          .=   " and inventory.unit_code = $unit_code";
            endif;
            # End Conditions

            db_instance()->distinct("JSON_UNQUOTE(JSON_EXTRACT(property_details, '$.sa')) as sa_size");
            db_instance()->select("
                                    JSON_UNQUOTE(JSON_EXTRACT(property_details, '$.sa')) as sa_size, 
                                    size_unit.unit_name,
                                    size_unit.unit_id");
            db_instance()->where($where);
            db_instance()->join('tbl_units as size_unit', "size_unit.unit_id = JSON_UNQUOTE(JSON_EXTRACT(property_details, '$.sa_size_unit'))", "left");
            db_instance()->from('tbl_inventory as inventory');
        
            $records = db_instance()->get()->result();
     
            return $records;
        }
    endif;
    # Sa Size List

    # Floors List
    if(!function_exists('inventory_floors')):
        function inventory_floors($data = null){

            # Data 
            $property_id    = $data->property_id ?? 0;
            $unit_code      = $data->unit_code ?? 0;
            # End Data 

            # Conditions
            $where          =   '1 = 1';

            if($property_id):
                $where          .=   " and inventory.product_id = $property_id";
            endif;
            
            if($unit_code):
                $where          .=   " and inventory.unit_code = $unit_code";
            endif;
            # End Conditions

            db_instance()->distinct("JSON_EXTRACT(property_details, '$.floor_id')");
            db_instance()->select("JSON_UNQUOTE(JSON_EXTRACT(property_details, '$.floor_id')) as id, floor.floor_name as name");
            db_instance()->where($where);
            db_instance()->join('tbl_floors as floor', "floor.floor_id = JSON_UNQUOTE(JSON_EXTRACT(property_details, '$.floor_id'))", "left");
            db_instance()->from('tbl_inventory as inventory');
            $records = db_instance()->get()->result();
     
            return $records;
        }
    endif;
    # Size Floors

    # Accomodations List
    if(!function_exists('inventory_accomodations')):
        function inventory_accomodations($data = null){

            # Data 
            $property_id    = $data->property_id ?? 0;
            $unit_code      = $data->unit_code ?? 0;
            # End Data 

            # Conditions
            $where          =   '1 = 1';

            if($property_id):
                $where          .=   " and inventory.product_id = $property_id";
            endif;
            
            if($unit_code):
                $where          .=   " and inventory.unit_code = $unit_code";
            endif;
            # End Conditions

            db_instance()->distinct("JSON_EXTRACT(property_details, '$.accomodation_id')");
            db_instance()->select("JSON_UNQUOTE(JSON_EXTRACT(property_details, '$.accomodation_id')) as id, accomodation.accomodation_name as name");
            db_instance()->where($where);
            db_instance()->join('tbl_accomodations as accomodation', "accomodation.accomodation_id = JSON_UNQUOTE(JSON_EXTRACT(property_details, '$.accomodation_id'))", "left");
            db_instance()->from('tbl_inventory as inventory');
            $records = db_instance()->get()->result();
     
            return $records;
        }
    endif;
    # End Accomodations Floors

    # Tower List
    if(!function_exists('inventory_tower')):
        function inventory_tower($data = null){

            # Data 
            $property_id    = $data->property_id ?? 0;
            $unit_code      = $data->unit_code ?? 0;
            # End Data 

            # Conditions
            $where          =   '1 = 1';

            if($property_id):
                $where          .=   " and inventory.product_id = $property_id";
            endif;
            
            if($unit_code):
                $where          .=   " and inventory.unit_code = $unit_code";
            endif;
            # End Conditions

            db_instance()->distinct("JSON_EXTRACT(property_details, '$.block_or_tower_id')");
            db_instance()->select("JSON_UNQUOTE(JSON_EXTRACT(property_details, '$.block_or_tower_id')) as id, tower_or_block.block_name as name");
            db_instance()->where($where);
            db_instance()->join('tbl_product_block_details as tower_or_block', "tower_or_block.block_id = JSON_UNQUOTE(JSON_EXTRACT(property_details, '$.block_or_tower_id'))", "left");
            db_instance()->from('tbl_inventory as inventory');
            $records = db_instance()->get()->result();
     
            return $records;
        }
    endif;
    # End Tower Floors

    # Status List
    if(!function_exists('inventory_filter_status')):
        function inventory_filter_status($data = null){

            # Data 
            $property_id    = $data->property_id ?? 0;
            $unit_code      = $data->unit_code ?? 0;
            # End Data 

            # Conditions
            $where          =   '1 = 1';

            if($property_id):
                $where          .=   " and inventory.product_id = $property_id";
            endif;
            
            if($unit_code):
                $where          .=   " and inventory.unit_code = $unit_code";
            endif;
            # End Conditions

            db_instance()->distinct("inventory.inventory_status");
            db_instance()->select("inventory.inventory_status as id, inventory_status.inventory_status_name as name");
            db_instance()->where($where);
            db_instance()->join('tbl_inventory_status as inventory_status', "inventory_status.inventory_status_id = inventory.inventory_status", "left");
            db_instance()->from('tbl_inventory as inventory');
            $records = db_instance()->get()->result();
     
            return $records;
        }
    endif;
    # End Status Floors

    # Facing List
    if(!function_exists('inventory_facings')):
        function inventory_facings($data = null){

            # Data 
            $property_id    = $data->property_id ?? 0;
            $unit_code      = $data->unit_code ?? 0;
            # End Data 

            # Conditions
            $where          =   ' 1 = 1';

            if($property_id):
                $where          .=   " and inventory.product_id = $property_id";
            endif;
            
            if($unit_code):
                $where          .=   " and inventory.unit_code = $unit_code";
            endif;
            # End Conditions

            db_instance()->distinct("JSON_EXTRACT(property_details, '$.facing_id')");
            db_instance()->select("JSON_UNQUOTE(JSON_EXTRACT(property_details, '$.facing_id')) as id, facing.title as name");
            db_instance()->where($where);
            db_instance()->join('tbl_facings as facing', "facing.facing_id = JSON_UNQUOTE(JSON_EXTRACT(property_details, '$.facing_id'))", "left");
            db_instance()->from('tbl_inventory as inventory');
            $records = db_instance()->get()->result();
     
            return $records;
        }
    endif;
    # End Facing List

    # Plot Size List
    if(!function_exists('inventory_plot_size')):
        function inventory_plot_size($data = null){

           # Data 
           $property_id    = $data->property_id ?? 0;
           $unit_code      = $data->unit_code ?? 0;
           # End Data 

           # Conditions
           $where          =   '1 = 1';

           if($property_id):
               $where          .=   " and inventory.product_id = $property_id";
           endif;
           
           if($unit_code):
               $where          .=   " and inventory.unit_code = $unit_code";
           endif;
           # End Conditions

           db_instance()->distinct("JSON_UNQUOTE(JSON_EXTRACT(property_details, '$.plot_size')) as plot_size");
           db_instance()->select("
                                   JSON_UNQUOTE(JSON_EXTRACT(property_details, '$.plot_size')) as plot_size, 
                                   size_unit.unit_name,
                                   size_unit.unit_id");
           db_instance()->where($where);
           db_instance()->join('tbl_units as size_unit', "size_unit.unit_id = JSON_UNQUOTE(JSON_EXTRACT(property_details, '$.size_unit'))", "left");
           db_instance()->from('tbl_inventory as inventory');
       
           $records = db_instance()->get()->result();
    
           return $records;
        }
    endif;
    # End Plot Size List

    # Unit Size List
    if(!function_exists('inventory_unit_size')):
        function inventory_unit_size($data = null){

           # Data 
           $property_id    = $data->property_id ?? 0;
           $unit_code      = $data->unit_code ?? 0;
           # End Data 

           # Conditions
           $where          =   '1 = 1';

           if($property_id):
               $where          .=   " and inventory.product_id = $property_id";
           endif;
           
           if($unit_code):
               $where          .=   " and inventory.unit_code = $unit_code";
           endif;
           # End Conditions

           db_instance()->distinct("JSON_UNQUOTE(JSON_EXTRACT(property_details, '$.unit_size')) as unit_size");
           db_instance()->select("
                                   JSON_UNQUOTE(JSON_EXTRACT(property_details, '$.unit_size')) as unit_size, 
                                   size_unit.unit_name,
                                   size_unit.unit_id");
           db_instance()->where($where);
           db_instance()->join('tbl_units as size_unit', "size_unit.unit_id = JSON_UNQUOTE(JSON_EXTRACT(property_details, '$.unit_size_unit'))", "left");
           db_instance()->from('tbl_inventory as inventory');
       
           $records = db_instance()->get()->result();
    
           return $records;
        }
    endif;
    # End Unit Size List

/*******************************************
 *  Inventory Filters
*******************************************/

/*******************************************
 *  Site Visit Filters
*******************************************/
    
    # Site Visit Filter Followup Users
    if(!function_exists('site_visit_filter_followup_users')){
        function site_visit_filter_followup_users($data = null){

            # Data 
            $property_id    = $data->property_id ?? 0;
            # End Data 
 
            # Conditions
            $where          =   '1 = 1';
 
            if($property_id):
                $where          .=   " and site_visit.project_id = $property_id";
            endif;
            
            # End Conditions
 
            db_instance()->distinct("site_visit.assign_to");
            db_instance()->select("
                                    user.user_id as id,
                                     CONCAT(
                                            COALESCE(user.user_title, ''),
                                            ' ',
                                            COALESCE(user.first_name, ''),
                                            ' ',
                                            COALESCE(user.last_name, '')
                                        ) as full_name
                                ");
            db_instance()->where($where);
            db_instance()->join('tbl_users as user', "user.user_id = site_visit.assign_to", "left");
            db_instance()->from('tbl_site_visit as site_visit');
        
            $records = db_instance()->get()->result();
     
            return $records;
        }
        }
        # End Site Visit Filter Followup Users

    # Site Visit Filter Lead Status
    if(!function_exists('site_visit_filter_lead_status')){
        function site_visit_filter_lead_status($data = null){

            # Data 
            $property_id    = $data->property_id ?? 0;
            # End Data 
 
            # Conditions
            $where          =   '1 = 1';
 
            if($property_id):
                $where          .=   " and site_visit.project_id = $property_id";
            endif;
            
            # End Conditions
 
            db_instance()->distinct("site_visit.assign_to");
            db_instance()->select("
                                    lead_status.lead_type_id as id,
                                    lead_status.lead_type_name as name
                                ");
            db_instance()->where($where);
            db_instance()->join('tbl_leads as lead', "lead.lead_id = site_visit.lead_id", "left");
            db_instance()->join('tbl_lead_types as lead_status', "lead_status.lead_type_id = lead.lead_status", "left");
            db_instance()->from('tbl_site_visit as site_visit');
        
            $records = db_instance()->get()->result();
     
            return $records;
        }
        # End Site Visit Filter Lead Status
    }

    # Site Visit Filter Lead Stage
    if(!function_exists('site_visit_filter_lead_stage')){
        function site_visit_filter_lead_stage($data = null){

            # Data 
            $property_id    = $data->property_id ?? 0;
            # End Data 
 
            # Conditions
            $where          =   '1 = 1';
 
            if($property_id):
                $where          .=   " and site_visit.project_id = $property_id";
            endif;
            
            # End Conditions
 
            db_instance()->distinct("site_visit.assign_to");
            db_instance()->select("
                                    lead_stage.lead_stage_id as id,
                                    lead_stage.lead_stage_name as name
                                ");
            db_instance()->where($where);
            db_instance()->join('tbl_leads as lead', "lead.lead_id = site_visit.lead_id", "left");
            db_instance()->join('tbl_lead_stages as lead_stage', "lead_stage.lead_stage_id = lead.lead_stage_id", "left");
            db_instance()->from('tbl_site_visit as site_visit');
        
            $records = db_instance()->get()->result();
     
            return $records;
        }
        # End Site Visit Filter Lead Stage
    }
/*******************************************
 *  End Site Visit Filters
*******************************************/