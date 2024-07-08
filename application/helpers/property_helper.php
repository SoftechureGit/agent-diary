<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

# Get Instance
if (!function_exists('CI')) {
    function CI()
    {
        $CI          = &get_instance();

        return $CI;
    }
}
# End Get Instance

# Get DB Instance
if (!function_exists('db_instance')) {
    function db_instance()
    {
        $CI          = &get_instance();
        $CI->load->database();

        return $CI->db;
    }
}
# End Get DB Instance

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
}