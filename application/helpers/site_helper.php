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


if (!function_exists('user')) {
    function user()
    {
        $user_id    =    CI()->session->userdata('user_id');
        
        if (!$user_id) return null;

        return  db_instance()
            ->select(
                "
                            user.user_id, 
                            user.role_id, 
                            user.username, 
                            CONCAT(
                                    IFNULL(user.user_title, ''), ' ', 
                                    IFNULL(user.first_name, ''), ' ', 
                                    IFNULL(user.last_name, '')
                                ) AS full_name,
                            user.email, 
                            user.mobile,
                            role.role_name,
                            parent_id"
            )
            ->join('tbl_roles as role', 'role.role_id = user.role_id', 'left')
            ->where("user.user_id = $user_id")
            ->get('tbl_users as user')->row();
    }
}


# Upload File
if (!function_exists('upload_file')) {
    function upload_file($name, $upload_folder, $old_file_name = null, $is_new_upload_path = true)
    {
        if($is_new_upload_path):
            $upload_path                    = "./public/other/$upload_folder/";
        else:
            
            $upload_path                    =  $upload_folder;
        endif;

        # Create Folder if Folder Not Exits
        if (!file_exists($upload_path)) {
            mkdir($upload_path, 0777, true);
        }
        # End Create Folder if Folder Not Exits

        $config                         = array();
        $config['upload_path']          = $upload_path;
        // $config['allowed_types']        = 'png|jpg|jpeg|pdf';
        $config['allowed_types']        = '*';
        $config['max_size']             = 10 * 1024;
        $config['remove_spaces']        = TRUE;

        # File Upload
        if (!empty($_FILES[$name]['name'])) :
            # File Name and Config
            $file_name                  = str_replace(' ', '-', time() . '_' . $_FILES[$name]['name']);
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

# Upload Files
if (!function_exists('upload_files')) {
    function upload_files($name, $upload_folder, $old_file_name = null)
    {
        $upload_path                    = "./public/other/gallery-images/$upload_folder/";

        # Create Folder if Folder Not Exits
        if (!file_exists($upload_path)) {
            mkdir($upload_path, 0777, true);
        }
        # End Create Folder if Folder Not Exits

        $images                     =   array();
        $config                     =   array();
        $config['upload_path']      =   $upload_path;
        $config['allowed_types']    =   'jpeg|jpg|png';
        $config['max_size']         =   10 * 1024;
        $config['remove_spaces']    =   TRUE;
        $config['encrypt_name']     =   TRUE;

        CI()->load->library('upload', $config);

        for ($x = 0; $x < count($_FILES[$name]['name']); $x++) {
            $_FILES['file']['name']         = $_FILES[$name]['name'][$x];
            $_FILES['file']['type']         = $_FILES[$name]['type'][$x];
            $_FILES['file']['tmp_name']     = $_FILES[$name]['tmp_name'][$x];
            $_FILES['file']['error']        = $_FILES[$name]['error'][$x];
            $_FILES['file']['size']         = $_FILES[$name]['size'][$x];
            $config['file_name']            = $_FILES[$name]['name'][$x];

            CI()->upload->initialize($config);


            if (!empty($_FILES[$name]['name'][$x])) {
                if (!CI()->upload->do_upload('file')) {
                    $error = array('error' => CI()->upload->display_errors());
                    $array = array('status' => false, 'message' => $error['error'] . ' * ( Photo Gallery ) ');
                    return (object) $array;
                } else {
                    $images[] = CI()->upload->data('file_name');
                }
            }
        }

        return (object) array('status' => true, 'message' => 'Images uploaded successfully', 'images' => $images);
    }
}
# End Upload Files

# String Before : str_before()
if (!function_exists('str_before')) {
    function str_before($search, $subject)
    {
        if ($search === '') {
            return $subject;
        }

        $pos = strpos($subject, $search);

        if ($pos === false) {
            return $subject;
        }

        return substr($subject,  0, $pos - strlen($search));
    }
}
# End String Before

# String After : str_after()
if (!function_exists('str_after')) {
    function str_after($search, $subject)
    {
        if ($search === '') {
            return $subject;
        }

        $pos = strpos($subject, $search);

        if ($pos === false) {
            return $subject;
        }

        return substr($subject, $pos + strlen($search));
    }
}
# End String After

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

    # Get Locations
    function locations($city_id)
    {
        if (!$city_id) :
            return null;
        endif;

        $records    =   db_instance()
            ->select('location_id as id, location_name as name')
            ->where("city_id = $city_id")
            ->order_by("location_name", "asc")
            ->get('tbl_locations')
            ->result();

        return $records ?? [];
    }
    # End Get Locations

    # Lead Units
    function lead_units($lead_id,$user_detail =[])
    
    {
        if (!$lead_id) :
            return null;
        endif;
   
        
        $account_id = $user_detail->user_id;

        if($user_detail->role_id < 3 ){

            $where =  "lead_unit.lead_id = $lead_id" ;

        }
        else{
    
            $where =  "added_by=$account_id AND  lead_unit.lead_id = $lead_id" ;
        }
      

        $records    =   db_instance()
            ->select('lead_unit.*, product_type.product_type_name as project_type_name, unit_type.unit_type_name as property_type_name, state.state_name, city.city_name, location.location_name')
            ->join('tbl_product_types as product_type', 'product_type.product_type_id = lead_unit.project_type_id', 'left')
            ->join('tbl_unit_types as unit_type', 'unit_type.unit_type_id = lead_unit.property_type_id', 'left')
            ->join('tbl_states as state', 'state.state_id = lead_unit.state_id', 'left')
            ->join('tbl_city as city', 'city.city_id = lead_unit.city_id', 'left')
            ->join('tbl_locations as location', 'location.location_id = lead_unit.location_id', 'left')
            ->where($where)
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
            ->select('lead_unit.*, lead_unit.project_name as lead_unit_project_name, product.project_name, property.code as property_name ,product_type.product_type_name as project_type_name, unit_type.unit_type_name as property_type_name, state.state_name, city.city_name, location.location_name')
            ->join('tbl_products as product', 'product.product_id = lead_unit.project_id', 'left')
            ->join('tbl_product_unit_details as property', 'property.product_unit_detail_id = lead_unit.property_id', 'left')
            ->join('tbl_product_types as product_type', 'product_type.product_type_id = lead_unit.project_type_id', 'left')
            ->join('tbl_unit_types as unit_type', 'unit_type.unit_type_id = lead_unit.property_type_id', 'left')
            ->join('tbl_states as state', 'state.state_id = lead_unit.state_id', 'left')
            ->join('tbl_city as city', 'city.city_id = lead_unit.city_id', 'left')
            ->join('tbl_locations as location', 'location.location_id = lead_unit.location_id', 'left')
            ->where("lead_unit.id = $id")
            ->order_by("lead_unit.id", "desc")
            ->get('tbl_lead_units as lead_unit')
            ->row();


        $record->property_details           =   ($record->property_details ?? 0) ? json_decode($record->property_details) : null;
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

    # Project Properties
    function project_properties($project_id)
    {
        if (!$project_id) :
            return null;
        endif;

        $records    =   db_instance()
            ->select('product_unit_detail_id as id, code')
            ->where("product_id = $project_id")
            ->order_by("code", "asc")
            ->get('tbl_product_unit_details')
            ->result();

        return $records ?? [];
    }
    # End Project Properties

    # Project Property Details
    function project_property_details($property_type_id, $project_property_id)
    {
        if (!$project_property_id || !$property_type_id) :
            return null;
        endif;

        $record    =   db_instance()
            ->select('*')
            ->where("property_type = $property_type_id and product_unit_detail_id = $project_property_id")
            ->order_by("code", "asc")
            ->get('tbl_product_unit_details')
            ->row();

        return $record ?? null;
    }
    # End Project Property Details

    ##### Gallery Images #####
    function insert_or_update_gallery_images($gallery_images, $type, $parent_id)
    {
        $data                           =   [];

        foreach ($gallery_images ?? [] as $gallery_image) :
            $data[]                           =   [
                'name'              => $gallery_image,
                'type'              => $type,
                'parent_id'         => $parent_id,
                'updated_at'         => date('Y-m-d h:i:m:s'),
                'created_at'         => date('Y-m-d h:i:m:s'),
            ];
        endforeach;

        if (count($data)) :
            db_instance()->insert_batch('tbl_gallery_images', $data);
        endif;

        return true;
    }
    ##### End Gallery Images #####
    

}
