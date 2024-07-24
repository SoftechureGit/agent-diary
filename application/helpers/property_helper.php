<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


    # Facings
    if (!function_exists('facings')) {  
    function facings(){
       
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
    if(function_exists('lead')){
        function lead($id){
            echo $id;
            die;

            if(!$id) return null;

            return db_instance()->where("lead_id = $id")->get('tbl_leads')->row();
        }
    }
    # End Lead Details

    # Lead Details

    if(function_exists('facings')){
        function sizeUnits(){
            $records    =   db_instance()
            ->select('*')
            ->where("unit_status='1'")
            ->get('tbl_units')
            ->result();

        return $records ?? [];
        }
    }

    # End Lead Details

    # Get Inventory Details
    function get_product_details($product_id){
        return db_instance()
        ->select('product.product_id as id, product.project_name as name')
        ->where("product.product_id='$product_id'")
        // ->join('tbl_product_unit_details as product', "product.")
        ->get('tbl_products as product')
        ->result();
    }
    # End Get Inventory Details

    # Get Inventory Details
    function getInventory($id){
        return db_instance()
        ->select('*')
        ->where("inventory_id = $id")
        ->get('tbl_inventory')
        ->row();
    }
    # End Get Inventory Details

    # Get Inventory Details
    function getPlcs($ids = [], $group_id = 0){
        $where   = ' 1 = 1';
        
        if ($ids) {
            $ids_list = implode(',', array_map('intval', $ids)); // Ensure $ids is properly formatted
            $where .= " AND price_component_id IN ($ids_list)";
        }
        
        if($group_id):
            $group_id = intval($group_id);
            $where   .= " and price_group_id = $group_id";
        endif;

        return db_instance()
        ->select('price_component_id as id, price_component_name as name')
        ->where($where)
        ->get('tbl_price_components')
        ->result();
    }
    # End Get Inventory Details
