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
