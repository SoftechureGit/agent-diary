<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('getAccountId')) {

    function getAccountId()
    {
        $account_id = 0;

        $CI    =    get_instance();
        $CI->load->database();

        $where = "user_hash='" . $CI->session->userdata('agent_hash') . "'";
        $CI->db->where($where);
        $query = $CI->db->get('tbl_users');
        $user_detail = $query->row();
        if ($user_detail) {
            $account_id = $user_detail->user_id;
            if ($user_detail->role_id != 2) {
                $account_id = $user_detail->parent_id;
            }
        }

        return $account_id;
    }

    function getAccountIdHash($user_hash)
    {
        $account_id = 0;

        $CI    =    get_instance();
        $CI->load->database();

        $where = "user_hash='" . $user_hash . "'";
        $CI->db->where($where);
        $query = $CI->db->get('tbl_users');
        $user_detail = $query->row();

        if ($user_detail) {
            $account_id = $user_detail->user_id;
            if ($user_detail->role_id != 2) {
                $account_id = $user_detail->parent_id;
            }
        }

        return $account_id;
    }

    # Get Instance
    function CI()
    {
        $CI          = &get_instance();

        return $CI;
    }
    # End Get Instance

    # Get DB Instance
    function db_instance()
    {
        $CI          = &get_instance();
        $CI->load->database();

        return $CI->db;
    }
    # End Get DB Instance

    # Project Types
    function project_types()
    {
        $records    =   db_instance()
            ->select('product_type_id as id, product_type_name as name')
            ->where('product_type_status = 1')
            ->order_by("product_type_name", "asc")
            ->get('tbl_product_types')
            ->result();

        return $records ?? [];
    }
    # End Project Types

    # Get Projects
    function property_types($project_type_id)
    {
        $records    =   db_instance()
            ->select('unit_type_id as id, unit_type_name as name')
            ->where("product_type_id = $project_type_id")
            ->where('unit_type_status = 1')
            ->order_by("unit_type_name", "asc")
            ->get('tbl_unit_types')
            ->result();

        return $records ?? [];
    }
    # End Get Projects

    # Get States
    function states()
    {
        $records    =   db_instance()
            ->select('state_id as id, state_name as name')
            ->order_by("state_name", "asc")
            ->get('tbl_states')
            ->result();

        return $records ?? [];
    }
    # End Get States

    # Get Cities
    function cities($state_id)
    {
        if (!$state_id) :
            return null;
        endif;

        $records    =   db_instance()
            ->select('city_id as id, city_name as name')
            ->where("state_id = $state_id")
            ->order_by("city_name", "asc")
            ->get('tbl_city')
            ->result();

        return $records ?? [];
    }
    # End Get Cities

    # Lead Units
    function lead_units($lead_id)
    {
        if (!$lead_id) :
            return null;
        endif;

        $records    =   db_instance()
                        ->select('lead_unit.*, product_type.product_type_name as project_name, unit_type.unit_type_name as property_name, state.state_name, city.city_name')
                        ->join('tbl_product_types as product_type', 'product_type.product_type_id = lead_unit.project_type_id', 'left')
                        ->join('tbl_unit_types as unit_type', 'unit_type.unit_type_id = lead_unit.property_type_id', 'left')
                        ->join('tbl_states as state', 'state.state_id = lead_unit.state_id', 'left')
                        ->join('tbl_city as city', 'city.city_id = lead_unit.city_id', 'left')
                        ->where("lead_unit.lead_id = $lead_id")
                        ->order_by("lead_unit.id", "desc")
                        ->get('tbl_lead_units as lead_unit')
                        ->result();
        
        foreach( $records ?? [] as  $record):
            $record->property_details       =   $record->property_details ? json_decode($record->property_details) : null;
        endforeach;

        return $records ?? [];
    }
    # End Lead Units

    # Get Property Form
    function property_form($property_id)
    {
        $form          =   '';

        switch ($property_id):
            case '2':
                $form          =   'villa';
                break;
            case '3':
                $form          =   'plot';
                break;
            case '4':
                $form          =   'shop';
                break;
            case '5':
                $form          =   'office';
                break;
            case '7':
                $form          =   'builder-floor';
                break;
            case '1':
                $form          =   'apartment';
                break;
            case '9':
                $form          =   'apartment';
                break;
        endswitch;

        if ($form) :
            return CI()->load->view("components/property-forms/$form", [], true);
        else :
            return "<div class='text-center my-3'><h4>Form not available.</h4></div>";
        endif;
    }
    # End Get Property Form
}
