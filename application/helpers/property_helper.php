<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


# Facings
if (!function_exists('facings')) {
    function facings()
    {
        $records    =   db_instance()
            ->select('*')
            ->where("facing_status = 1")
            ->order_by("title", "asc")
            ->get('tbl_facings')
            ->result();

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
                    property.project_type as project_type_id,
                    property.parking_open,
                    property.parking_stilt,
                    property.parking_basment as parking_basement
                    '
                )
        ->where("property.product_id='$id'")
        // ->join('tbl_product_unit_details as product', "product.")
        ->get('tbl_products as property')
        ->row();
}
# End Get Inventory Details

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
function getPropertyAccomodations($project_type_id, $property_type_id, $property_id, $id = null)
{
    $unit_code_list   = null;

    $where = "product_id='" . $property_id . "' AND project_type='" . $project_type_id . "' AND property_type='" . $property_type_id . "'";

    if ($id) :
        $where  .= " and inventory.product_unit_detail_id = '$id'";
    endif;

    db_instance()->select("inventory.product_unit_detail_id as id, inventory.code as inventory_unit_code, accomodation.accomodation_name, concat(accomodation.accomodation_name,' ', inventory.code) as unit_code_with_accomodation_name");
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
# End Get Property Accomodations

# Get Floors
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
# End Get Floors

# Get Blocks or Towers
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
        # End Get Blocks or Towers
