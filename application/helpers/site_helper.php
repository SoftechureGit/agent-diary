<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

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

# Upload File
if (!function_exists('upload_file')) {
    function upload_file($name, $upload_folder, $old_file_name = null)
    {
        $upload_path                    = "./public/other/$upload_folder/";

        # Create Folder if Folder Not Exits
        if (!file_exists($upload_path)) {
            mkdir($upload_path, 0777, true);
        }
        # End Create Folder if Folder Not Exits

        $config                         = array();
        $config['upload_path']          = $upload_path;
        $config['allowed_types']        = 'png|jpg|jpeg';
        $config['max_size']             = 10 * 1024;
        $config['remove_spaces']        = TRUE;
        
        # File Upload
        if (!empty($_FILES[$name]['name'])) :
            # File Name and Config
            $file_name                  = time().'_'.$_FILES[$name]['name'];
            $config['file_name']        = $file_name;
            
            CI()->load->library('upload', $config);
            # End File Name and Config

            if (!CI()->upload->do_upload($name)) :
                $error   =   array('error' => CI()->upload->display_errors());
                return (object) ['status' => false, 'message' => $error['error']];
            else :
                CI()->upload->data($name);
            endif;
        else :
            $file_name                  =   $old_file_name;
        endif;
        # End File Upload

        return (object) ['status' => true, 'messgae' => 'Successfully file uploaded', 'file_name' => $file_name];
    }
}
# End Upload File

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
            ->select('lead_unit.*, product_type.product_type_name as project_type_name, unit_type.unit_type_name as property_type_name, state.state_name, city.city_name')
            ->join('tbl_product_types as product_type', 'product_type.product_type_id = lead_unit.project_type_id', 'left')
            ->join('tbl_unit_types as unit_type', 'unit_type.unit_type_id = lead_unit.property_type_id', 'left')
            ->join('tbl_states as state', 'state.state_id = lead_unit.state_id', 'left')
            ->join('tbl_city as city', 'city.city_id = lead_unit.city_id', 'left')
            ->where("lead_unit.lead_id = $lead_id")
            ->order_by("lead_unit.id", "desc")
            ->get('tbl_lead_units as lead_unit')
            ->result();

        foreach ($records ?? [] as  $record) :
            $record->property_details       =   $record->property_details ? json_decode($record->property_details) : null;
        endforeach;

        return $records ?? [];
    }
    # End Lead Units

    # Lead Unit Details
    function lead_unit_details($id)
    {
        if (!$id) :
            return null;
        endif;

        $record    =   db_instance()
            ->select('lead_unit.*, product_type.product_type_name as project_type_name, unit_type.unit_type_name as property_type_name, state.state_name, city.city_name')
            ->join('tbl_product_types as product_type', 'product_type.product_type_id = lead_unit.project_type_id', 'left')
            ->join('tbl_unit_types as unit_type', 'unit_type.unit_type_id = lead_unit.property_type_id', 'left')
            ->join('tbl_states as state', 'state.state_id = lead_unit.state_id', 'left')
            ->join('tbl_city as city', 'city.city_id = lead_unit.city_id', 'left')
            ->where("lead_unit.id = $id")
            ->order_by("lead_unit.id", "desc")
            ->get('tbl_lead_units as lead_unit')
            ->row();

        $record->property_details           =   $record->property_details ? json_decode($record->property_details) : null;
        $record->property_layout_url        =   $record->property_layout ? base_url("public/other/lead-unit-layouts/$record->property_layout") : null;

        return $record ?? null;
    }
    # End Lead Unit Details

    # Get Property Form
    function property_form($property_id, $property_details = null)
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
            return CI()->load->view("components/property-forms/$form", $property_details ?? [], true);
        else :
            return "<div class='text-center my-3'><h4>Form not available.</h4></div>";
        endif;
    }
    # End Get Property Form

}
