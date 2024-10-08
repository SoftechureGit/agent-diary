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

# SMS
if (!function_exists('sms')) {
    function sms()
    {
       return false;
    }
}
# End SMS


if (!function_exists('user')) {
    function user($user_id = 0)
    {
        if(!$user_id):
            $user_id            =    CI()->session->userdata('user_id');
            $access_token       =    CI()->input->request_headers()['Access-Token'] ?? '';
        endif;

        // if (!$user_id && !$access_token) return null;

        $where              =   '1 = 1 ';
        
        if($user_id):
            $where              .=   " and user.user_id = '$user_id'";
        endif;

        if($access_token ?? 0):
            $where              .=   " and user.user_hash = '$access_token'";
        endif;

        $user =  db_instance()
            ->select(
                "
                            user.*, 
                            CONCAT(
                                    IFNULL(user.user_title, ''), ' ', 
                                    IFNULL(user.first_name, ''), ' ', 
                                    IFNULL(user.last_name, '')
                                ) AS full_name,
                            role.role_name"
            )
            ->join('tbl_roles as role', 'role.role_id = user.role_id', 'left')
            ->where($where)
            ->get('tbl_users as user')->row();
            

         # Permission Roles
        $user->level_user_ids_arr               =   get_level_user_ids();
        $user->level_user_ids                   =   implode(',', $user->level_user_ids_arr);
        $user->account_id                       =   getAccountId();
        # End Permission Roles

        return $user;
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

        print_r($_FILES[$name]['name']);
        die;

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

        $user_hash = $CI->input->request_headers()['Access-Token'] ?? null;

        if($user_hash):
            $where = "user_hash='" . $user_hash . "'";
        else:
            $where = "user_hash='" . $CI->session->userdata('agent_hash') . "'";
        endif;

        
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
    function lead_units($lead_id, $user_detail = null)
    
    {
        if (!$lead_id) :
            return null;
        endif;
   
        
        $account_id = $user_detail->user_id;

        if($user_detail->role_id < 3 ){

            $where =  "( lead_unit.lead_id = $lead_id or lead_unit.buyer_id = $lead_id )" ;

        }
        else{
    
            $where =  "added_by=$account_id AND  ( lead_unit.lead_id = $lead_id or lead_unit.buyer_id = $lead_id )" ;
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

        if($record) :
            $record->property_details           =   ($record->property_details ?? 0) ? json_decode($record->property_details) : null;
            $record->component_details          =   ($record->component_details ?? 0) ? json_decode($record->component_details) : null;
            $record->property_layout_url        =   $record->property_layout ? base_url("public/other/lead-unit-layouts/$record->property_layout") : null;          
        else:
            return  null; 
        endif;    


        return $record ?? null;
    }
    # End Lead Unit Details

    # Get Property Form
    function property_form($property_type_id, $property_details = null)
    {
        $data          =   [];
        $form          =   '';
        $property_type_name          =   '';
        
        # Commercial
        if(!$property_type_id):
            $form          =   'commercial';
        endif;
        # End Commercial

        switch ($property_type_id):
            case '2':
                $form          =   'villa';
                break;
            case '3':
                $form          =   'plot';
                break;
            case '4':
                $form          =   'commercial';
                $property_type_name          =   'Shop';
                break;
            case '5':
                $form          =   'commercial';
                $property_type_name          =   'Office';
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

            $data               =   (object) [
                                        'property_type_name'    => $property_type_name,
                                        'property_details'      => (array) $property_details ?? [],
                                    ];

            return CI()->load->view("components/property-forms/$form", [ 'data' => $data ], true);
        else :
            return "<div class='text-center my-3 form-not-found'><h4>Form not available.</h4></div>";
        endif;
    }

    # End Get Property Form

    # Get Invetory Excel Form

    function property_excel($property_id){

       # Get property information
            $property_details = property($property_id);
       # End  Get property information  

       # Get Unit code 
            $unit_codes       =  getPropertyAccomodations($property_details->project_type_id, $property_details->property_type_id, $property_id);     
       # End Unit  code

       

       # Get Parking
            $parkings         =         parkings($property_details->id ?? 0);        
       # End Get Parking 

        $form               =   '';
        $excel_sheet        =   [];
      

        switch($property_details->property_type_id):
            case '2': #Villa
                $form          =   'villa';
                $excel_sheet[0]['title']                    =  'Villa';
                $excel_sheet[0]['headers']                  =  ['S.N.', 'Unit Code ', 'Referance Number', 'Plot Number', 'Plot Size', 'Size Unit' ,'No of Floor' ,'Block' , 'Applicable PLC' , 'Facing' ,'Dimantion F x B x S1 x S2' , 'Layout upload'];
                $excel_sheet[0]['data'][]                   =  ['', '', '', '', '', ''];

                # unit code
                   $excel_sheet[1]['title']      = 'Unit Code';  
                   $excel_sheet[1]['headers']    = ['S.N' ,'Unit Code', 'Code Id' , 'Property Type Name'];  
                   
                   $count = 1;
                   foreach($unit_codes as $unit_code){
                      $excel_sheet[1]['data'][] = [$count,$unit_code->inventory_unit_code , $unit_code->id , $unit_code->property_type_name ?? ''] ;
                      $count++;
                   } 
                # end unit code

                # size unit 
                    $excel_sheet[2]['title']        = 'Size Unit';  
                    $excel_sheet[2]['headers']       =  ['S.N.', 'Unit', 'Unit Id' ];
                    $count = 1;

                    foreach(sizeUnits() as $size_unit){
                    $excel_sheet[2]['data'][] = [$count,$size_unit->unit_name , $size_unit->unit_id] ;
                    $count++;
                    } 
                # end size  unit 

                # facing
                   $excel_sheet[3]['title']         = 'Facing';
                   $excel_sheet[3]['headers']       =  ['S.N', 'Title', 'Facing Id'];

                   $count = 1; 

                   foreach(facings() as $facing){

                    $excel_sheet[3]['data'][] = [$count,$facing->title , $facing->facing_id] ;
                    $count++;

                 } 
                # end facing   

                      # Applicable PLC
                  
                      $excel_sheet[4]['title']         = 'Applicable PLC';  
                      $excel_sheet[4]['headers']       =  ['S.N.', 'Title', 'PLC ID' ];
                      $count = 1;
  
                      foreach(getPropertyPlcs($property_id ?? 0) as $ApplicablePlc){
                      $excel_sheet[4]['data'][] = [$count,$ApplicablePlc->price_component_name , $ApplicablePlc->price_component_id] ;
                      $count++;
                      } 
                      if(count(getPropertyPlcs($property_id ?? 0)) == 0){
                          $excel_sheet[4]['data'][] = ['','',''];
                      }
                  # end Applicable PLC

                break;
            case '3': #Plot

                $form                           =  'plot';
                $excel_sheet[0]['title']                    =  'Plot';
                $excel_sheet[0]['headers']                  =  ['S.N.', 'Unit Code', 'Referance Number', 'Plot Number', 'Plot Size', 'Size Unit' ,'Block' ,'Applicable PLC' , 'Facing' , 'Dimantion F x B x S1 x S2' ,'Layout Upload'];
                $excel_sheet[0]['data'][]                   =  ['', '', '', '', '', ''];

                # unit code
                   $excel_sheet[1]['title']      = 'Unit Code';  
                   $excel_sheet[1]['headers']    = ['S.N' ,'Unit Code', 'Code Id' , 'Property Type Name' ];  
                   
                   $count = 1;
                   foreach($unit_codes as $unit_code){
                      $excel_sheet[1]['data'][] = [$count,$unit_code->inventory_unit_code , $unit_code->id , $unit_code->property_type_name ?? ''] ;
                      $count++;
                   } 
                # end unit code

                # size unit 
                    $excel_sheet[2]['title']        = 'Size Unit';  
                    $excel_sheet[2]['headers']       =  ['S.N.', 'Unit', 'Unit Id' ];
                    $count = 1;

                    foreach(sizeUnits() as $size_unit){
                    $excel_sheet[2]['data'][] = [$count,$size_unit->unit_name , $size_unit->unit_id] ;
                    $count++;
                    } 
                # end size  unit 

                # facing
                   $excel_sheet[3]['title']         = 'Facing';
                   $excel_sheet[3]['headers']       =  ['S.N', 'Title', 'Facing Id'];

                   $count = 1; 

                   foreach(facings() as $facing){

                    $excel_sheet[3]['data'][] = [$count,$facing->title , $facing->facing_id] ;
                    $count++;

                 } 
                # end facing   

                      # Applicable PLC
                  
                      $excel_sheet[4]['title']         = 'Applicable PLC';  
                      $excel_sheet[4]['headers']       =  ['S.N.', 'Title', 'PLC ID' ];
                      $count = 1;
  
                      foreach(getPropertyPlcs($property_id ?? 0) as $ApplicablePlc){
                      $excel_sheet[4]['data'][] = [$count,$ApplicablePlc->price_component_name , $ApplicablePlc->price_component_id] ;
                      $count++;
                      } 
                      if(count(getPropertyPlcs($property_id ?? 0)) == 0){
                          $excel_sheet[4]['data'][] = ['','',''];
                      }
                  # end Applicable PLC
            
                break;
            case '4': # Shop
                $form          =   'shop';

                $excel_sheet[0]['title']                    =  'Shop';
                $excel_sheet[0]['headers']                  =  ['S.N.', 'Unit Code ', 'Referance Number', 'Unit no', 'Floor ', 'Tower' ,'Unit Type' ,'Area' , 'Size Unit' ,'Applicable PLC' , 'Facing' ,'Parking' , 'Layout upload'];
                $excel_sheet[0]['data'][]                   =  ['', '', '', '', '', ''];

                # unit code
                   $excel_sheet[1]['title']      = 'Unit Code';  
                   $excel_sheet[1]['headers']    = ['S.N' ,'Unit Code', 'Code Id' , 'Property Type Name'  ];  
                   
                   $count = 1;
                   foreach($unit_codes as $unit_code){
                      $excel_sheet[1]['data'][] = [$count,$unit_code->inventory_unit_code , $unit_code->id , $unit_code->property_type_name ?? ''] ;
                      $count++;
                   } 
                # end unit code

                # size unit 
                    $excel_sheet[2]['title']         = 'Size Unit';  
                    $excel_sheet[2]['headers']       =  ['S.N.', 'Unit', 'Unit Id' ];
                    $count = 1;

                    foreach(sizeUnits() as $size_unit){
                    $excel_sheet[2]['data'][] = [$count,$size_unit->unit_name , $size_unit->unit_id] ;
                    $count++;
                    } 
                # end size  unit 

                # facing
                   $excel_sheet[3]['title']         = 'Facing';
                   $excel_sheet[3]['headers']       =  ['S.N', 'Title', 'Facing Id'];

                   $count = 1; 

                   foreach(facings() as $facing){

                    $excel_sheet[3]['data'][] = [$count,$facing->title , $facing->facing_id] ;
                    $count++;

                 } 
                # end facing  
                        
                   # parkings
                
                   $excel_sheet[4]['title']         = 'Parkings';
                   $excel_sheet[4]['headers']       =  ['S.N', 'Label', 'Value'];
  
                   $count = 1; 
          
                   foreach($parkings as $parking ){
  
                       $excel_sheet[4]['data'][] = [$count,$parking->label , $parking->value] ;
                       $count++;
  
                   } 
                   if($parkings){
                       $excel_sheet[4]['data'][] = ['','',''];
                   }
  
               
               # end parkings 

                      # Applicable PLC
                  
                      $excel_sheet[5]['title']         = 'Applicable PLC';  
                      $excel_sheet[5]['headers']       =  ['S.N.', 'Title', 'PLC ID' ];
                      $count = 1;
  
                      foreach(getPropertyPlcs($property_id ?? 0) as $ApplicablePlc){
                      $excel_sheet[5]['data'][] = [$count,$ApplicablePlc->price_component_name , $ApplicablePlc->price_component_id] ;
                      $count++;
                      } 
                      if(count(getPropertyPlcs($property_id ?? 0)) == 0){
                          $excel_sheet[5]['data'][] = ['','',''];
                      }
                    # end Applicable PLC

                         # size Floor 
                         $excel_sheet[6]['title']         = 'Floor';  
                         $excel_sheet[6]['headers']       =  ['S.N.', 'Name', 'Floor Id' ];
                         $count = 1;

                         foreach(getFloors() as $get_floor){
                         $excel_sheet[6]['data'][] = [$count,$get_floor->name , $get_floor->id] ;
                         $count++;
                         } 
                         # end size  Tower 

                         # size Floor 
                         $excel_sheet[7]['title']         = 'Tower';  
                         $excel_sheet[7]['headers']       =  ['S.N.', 'Name', 'Floor Id' ];
                         $count = 1;

                         foreach(getBlocksOrTowers() as $block_or_tower){
                         $excel_sheet[7]['data'][] = [$count,$block_or_tower->name , $block_or_tower->id] ;
                         $count++;
                         } 

            
                        # end size  Floor 

                break;
            case '5': # Office
                $form          =   'office';
                $excel_sheet[0]['title']                    =  'Office';
                $excel_sheet[0]['headers']                  =  ['S.N.', 'Unit Code ', 'Referance Number', 'Unit no', 'Floor ', 'Tower' ,'Unit Type' ,'Area' , 'Size Unit' , 'Facing' ,'Parking' ,'Pentry' , 'Washroom' , 'Layout upload'];
                $excel_sheet[0]['data'][]                   =  ['', '', '', '', '', ''];

                # unit code
                   $excel_sheet[1]['title']      = 'Unit Code';  
                   $excel_sheet[1]['headers']    = ['S.N' ,'Unit Code', 'Code Id' , 'Property Type Name'];  
                   
                   $count = 1;
                   foreach($unit_codes as $unit_code){
                      $excel_sheet[1]['data'][] = [$count,$unit_code->inventory_unit_code , $unit_code->id , $unit_code->property_type_name ?? ''] ;
                      $count++;
                   } 
                # end unit code

                # size unit 
                    $excel_sheet[2]['title']         = 'Size Unit';  
                    $excel_sheet[2]['headers']       =  ['S.N.', 'Unit', 'Unit Id' ];
                    $count = 1;

                    foreach(sizeUnits() as $size_unit){
                    $excel_sheet[2]['data'][] = [$count,$size_unit->unit_name , $size_unit->unit_id] ;
                    $count++;
                    } 
                # end size  unit 

                # facing
                   $excel_sheet[3]['title']         = 'Facing';
                   $excel_sheet[3]['headers']       =  ['S.N', 'Title', 'Facing Id'];

                   $count = 1; 

                   foreach(facings() as $facing){

                    $excel_sheet[3]['data'][] = [$count,$facing->title , $facing->facing_id] ;
                    $count++;

                 } 
                # end facing   

                      # Applicable PLC
                  
                      $excel_sheet[4]['title']         = 'Applicable PLC';  
                      $excel_sheet[4]['headers']       =  ['S.N.', 'Title', 'PLC ID' ];
                      $count = 1;
  
                      foreach(getPropertyPlcs($property_id ?? 0) as $ApplicablePlc){
                      $excel_sheet[4]['data'][] = [$count,$ApplicablePlc->price_component_name , $ApplicablePlc->price_component_id] ;
                      $count++;
                      } 
                      if(count(getPropertyPlcs($property_id ?? 0)) == 0){
                          $excel_sheet[4]['data'][] = ['','',''];
                      }
                  # end Applicable PLC

                       # parkings
                
                       $excel_sheet[5]['title']         = 'Parkings';
                       $excel_sheet[5]['headers']       =  ['S.N', 'Label', 'Value'];
      
                       $count = 1; 
              
                       foreach($parkings as $parking ){
      
                           $excel_sheet[5]['data'][] = [$count,$parking->label , $parking->value] ;
                           $count++;
      
                       } 
                       if($parkings){
                           $excel_sheet[5]['data'][] = ['','',''];
                       }
      
                   
                   # end parkings 

                break;

            case '7':
                $form          =   'builder-floor';

                $excel_sheet[0]['title']                    =  'Builder Floor';
                $excel_sheet[0]['headers']                  =  ['S.N.', 'Unit Code', 'Referance Number', 'Plot Number', 'Plot Size', 'Size Unit' ,'Floor', 'Block' ,'Applicable PLC' , 'Facing' , 'Dimantion F x B x S1 x S2' ,'Tarrace' , 'Basment' , 'Parking', 'Layout Upload'];
                $excel_sheet[0]['data'][]                   =  ['', '', '', '', '', ''];

                # unit code
                   $excel_sheet[1]['title']      = 'Unit Code';  
                   $excel_sheet[1]['headers']    = ['S.N' ,'Unit Code', 'Code Id' , 'Property Type Name' ];  
                   
                   $count = 1;
                   foreach($unit_codes as $unit_code){
                      $excel_sheet[1]['data'][] = [$count,$unit_code->inventory_unit_code , $unit_code->id ] ;
                      $count++;
                   } 
                # end unit code

                # size unit 
                    $excel_sheet[2]['title']        = 'Size Unit';  
                    $excel_sheet[2]['headers']       =  ['S.N.', 'Unit', 'Unit Id' ];
                    $count = 1;

                    foreach(sizeUnits() as $size_unit){
                    $excel_sheet[2]['data'][] = [$count,$size_unit->unit_name , $size_unit->unit_id] ;
                    $count++;
                    } 
                # end size  unit 

                # facing
                   $excel_sheet[3]['title']         = 'Facing';
                   $excel_sheet[3]['headers']       =  ['S.N', 'Title', 'Facing Id'];

                   $count = 1; 

                   foreach(facings() as $facing){

                    $excel_sheet[3]['data'][] = [$count,$facing->title , $facing->facing_id] ;
                    $count++;

                 } 
                # end facing   

                      # Applicable PLC
                  
                      $excel_sheet[4]['title']         = 'Applicable PLC';  
                      $excel_sheet[4]['headers']       =  ['S.N.', 'Title', 'PLC ID' ];
                      $count = 1;
  
                      foreach(getPropertyPlcs($property_id ?? 0) as $ApplicablePlc){
                      $excel_sheet[4]['data'][] = [$count,$ApplicablePlc->price_component_name , $ApplicablePlc->price_component_id] ;
                      $count++;
                      } 
                      if(count(getPropertyPlcs($property_id ?? 0)) == 0){
                          $excel_sheet[4]['data'][] = ['','',''];
                      }
                  # end Applicable PLC

                       # parkings
                
                       $excel_sheet[5]['title']         = 'Parkings';
                       $excel_sheet[5]['headers']       =  ['S.N', 'Label', 'Value'];
      
                       $count = 1; 
              
                       foreach($parkings as $parking ){
      
                           $excel_sheet[5]['data'][] = [$count,$parking->label , $parking->value] ;
                           $count++;
      
                       } 
                       if($parkings){
                           $excel_sheet[5]['data'][] = ['','',''];
                       }
      
                   
                   # end parkings 

                        # size Floor 
                            $excel_sheet[6]['title']         = 'Floor';  
                            $excel_sheet[6]['headers']       =  ['S.N.', 'Name', 'Floor Id' ];
                            $count = 1;

                            foreach(getFloors() as $get_floor){
                            $excel_sheet[6]['data'][] = [$count,$get_floor->name , $get_floor->id] ;
                            $count++;
                            } 
                    # end size  Floor 

                break;
            case '1':
               
                $form          =   'apartment';
                $excel_sheet[0]['title']                        =  'Apartment';
                $excel_sheet[0]['headers']                      =  ['S.N.', 'Unit Code ', 'Referance Number', 'Unit No', 'Floor', 'Tower' ,'Unit Type' ,'SA' , 'SA Size' , 'BA' ,'BA Size' , 'CA' ,'CA Size' ,'Applicable PLC' , 'Facing' , 'Parking' , 'Layout Upload Url'];
                $excel_sheet[0]['data'][]                       =  ['', '', '', '', '', '','','','','','','','','','',''];

                # unit code
                   $excel_sheet[1]['title']      = 'Unit Code';  
                   $excel_sheet[1]['headers']    = ['S.N' ,'Unit Code', 'Code Id' , 'Property Type Name'];  
                   
                   $count = 1;
                   foreach($unit_codes as $unit_code){
                      $excel_sheet[1]['data'][] = [$count,$unit_code->inventory_unit_code , $unit_code->id , $unit_code->property_type_name ?? ''] ;
                      $count++;
                   } 
                # end unit code

                # size Floor 
                    $excel_sheet[2]['title']         = 'Floor';  
                    $excel_sheet[2]['headers']       =  ['S.N.', 'Name', 'Floor Id' ];
                    $count = 1;

                    foreach(getFloors() as $get_floor){
                    $excel_sheet[2]['data'][] = [$count,$get_floor->name , $get_floor->id] ;
                    $count++;
                    } 
                # end size  Floor 

                # Tower
                   $excel_sheet[3]['title']         = 'Tower';
                   $excel_sheet[3]['headers']       =  ['S.N', 'Title', 'Tower Id'];

                   $count = 1; 

                   foreach(getBlocksOrTowers() as $tower){

                    $excel_sheet[3]['data'][] = [$count,$tower->name , $tower->id] ;
                    $count++;

                 } 
                # end Tower   

               # size unit 
                    $excel_sheet[4]['title']        = 'Size Unit (SA , BA and CA)';  
                    $excel_sheet[4]['headers']       =  ['S.N.', 'Unit', 'Unit Id' ];
                    $count = 1;

                    foreach(sizeUnits() as $size_unit){
                    $excel_sheet[4]['data'][] = [$count,$size_unit->unit_name , $size_unit->unit_id] ;
                    $count++;
                    } 
                # end size  unit 

               # Applicable PLC
                  
                    $excel_sheet[5]['title']         = 'Applicable PLC';  
                    $excel_sheet[5]['headers']       =  ['S.N.', 'Title', 'PLC ID' ];
                    $count = 1;

                    foreach(getPropertyPlcs($property_id ?? 0) as $ApplicablePlc){
                    $excel_sheet[5]['data'][] = [$count,$ApplicablePlc->price_component_name , $ApplicablePlc->price_component_id] ;
                    $count++;
                    } 
                    if(count(getPropertyPlcs($property_id ?? 0)) == 0){
                        $excel_sheet[5]['data'][] = ['','',''];
                    }
                # end Applicable PLC

              

                  # facing
                  $excel_sheet[6]['title']         = 'Facing';
                  $excel_sheet[6]['headers']       =  ['S.N', 'Title', 'Facing Id'];

                  $count = 1; 

                  foreach(facings() as $facing){

                   $excel_sheet[6]['data'][] = [$count,$facing->title , $facing->facing_id] ;
                   $count++;

                } 
               # end facing 

                  # parkings
                
                  $excel_sheet[7]['title']         = 'Parkings';
                  $excel_sheet[7]['headers']       =  ['S.N', 'Label', 'Value'];
 
                  $count = 1; 
         
                  foreach($parkings as $parking ){
 
                      $excel_sheet[7]['data'][] = [$count,$parking->label , $parking->value] ;
                      $count++;
 
                  } 
                  if($parkings){
                      $excel_sheet[7]['data'][] = ['','',''];
                  }
 
              
              # end parkings 

                break;
            case '9':
                $form          =   'apartment';
                $excel_sheet[0]['title']                        =  'Apartment';
                $excel_sheet[0]['headers']                      =  ['S.N.', 'Unit Code ', 'Referance Number', 'Unit No', 'Floor', 'Tower' ,'Unit Type' ,'SA' , 'SA Size' , 'BA' ,'BA Size' , 'CA' ,'CA Size' ,'Applicable PLC' , 'Facing' , 'Parking' , 'Layout Upload Url'];
                $excel_sheet[0]['data'][]                       =  ['', '', '', '', '', '','','','','','','','','','',''];

                # unit code
                   $excel_sheet[1]['title']      = 'Unit Code';  
                   $excel_sheet[1]['headers']    = ['S.N' ,'Unit Code', 'Code Id' , 'Property Type Name'];  
                   
                   $count = 1;
                   foreach($unit_codes as $unit_code){
                      $excel_sheet[1]['data'][] = [$count,$unit_code->inventory_unit_code , $unit_code->id , $unit_code->property_type_name ?? ''] ;
                      $count++;
                   } 
                # end unit code

                # size Floor 
                    $excel_sheet[2]['title']         = 'Floor';  
                    $excel_sheet[2]['headers']       =  ['S.N.', 'Name', 'Floor Id' ];
                    $count = 1;

                    foreach(getFloors() as $get_floor){
                    $excel_sheet[2]['data'][] = [$count,$get_floor->name , $get_floor->id] ;
                    $count++;
                    } 
                # end size  Floor 

                # Tower
                   $excel_sheet[3]['title']         = 'Tower';
                   $excel_sheet[3]['headers']       =  ['S.N', 'Title', 'Tower Id'];

                   $count = 1; 

                   foreach(getBlocksOrTowers() as $tower){

                    $excel_sheet[3]['data'][] = [$count,$tower->name , $tower->id] ;
                    $count++;

                 } 
                # end Tower   

               # size unit 
                    $excel_sheet[4]['title']        = 'Size Unit (SA , BA and CA)';  
                    $excel_sheet[4]['headers']       =  ['S.N.', 'Unit', 'Unit Id' ];
                    $count = 1;

                    foreach(sizeUnits() as $size_unit){
                    $excel_sheet[4]['data'][] = [$count,$size_unit->unit_name , $size_unit->unit_id] ;
                    $count++;
                    } 
                # end size  unit 

               # Applicable PLC
                  
                    $excel_sheet[5]['title']         = 'Applicable PLC';  
                    $excel_sheet[5]['headers']       =  ['S.N.', 'Title', 'PLC ID' ];
                    $count = 1;

                    foreach(getPropertyPlcs($property_id ?? 0) as $ApplicablePlc){
                    $excel_sheet[5]['data'][] = [$count,$ApplicablePlc->price_component_name ?? '' , $ApplicablePlc->price_component_id ?? ''] ;
                    $count++;
                    } 

                    if(count(getPropertyPlcs($property_id ?? 0)) == 0){
                        $excel_sheet[5]['data'][] = ['','',''];
                    }

                # end Applicable PLC

                  # facing
                  $excel_sheet[6]['title']         = 'Facing';
                  $excel_sheet[6]['headers']       =  ['S.N', 'Title', 'Facing Id'];

                  $count = 1; 

                  foreach(facings() as $facing){

                   $excel_sheet[6]['data'][] = [$count,$facing->title , $facing->facing_id] ;
                   $count++;

                } 
               # end facing 

                    # parkings
                
                    $excel_sheet[7]['title']         = 'Parkings';
                    $excel_sheet[7]['headers']       =  ['S.N', 'Label', 'Value'];
   
                    $count = 1; 
           
                    foreach($parkings as $parking ){
   
                        $excel_sheet[7]['data'][] = [$count,$parking->label , $parking->value] ;
                        $count++;
   
                    } 
                    if($parkings){
                        $excel_sheet[7]['data'][] = ['','',''];
                    }
   
                
                # end parkings 
                break;
                
                default:
                $form          =   'shop';

                $excel_sheet[0]['title']                    =  'Shop';
                $excel_sheet[0]['headers']                  =  ['S.N.', 'Unit Code ', 'Referance Number', 'Unit no', 'Floor ', 'Tower' ,'Unit Type' ,'Area' , 'Size Unit' ,'Applicable PLC' , 'Facing' ,'Parking' , 'Layout upload'];
                $excel_sheet[0]['data'][]                   =  ['', '', '', '', '', ''];

                # unit code
                   $excel_sheet[1]['title']      = 'Unit Code';  
                   $excel_sheet[1]['headers']    = ['S.N' ,'Unit Code', 'Code Id' , 'Property Type Name'  ];  
                   
                   $count = 1;
                   foreach($unit_codes as $unit_code){
                      $excel_sheet[1]['data'][] = [$count,$unit_code->inventory_unit_code , $unit_code->id , $unit_code->property_type_name ?? ''] ;
                      $count++;
                   } 
                # end unit code

                # size unit 
                    $excel_sheet[2]['title']         = 'Size Unit';  
                    $excel_sheet[2]['headers']       =  ['S.N.', 'Unit', 'Unit Id' ];
                    $count = 1;

                    foreach(sizeUnits() as $size_unit){
                    $excel_sheet[2]['data'][] = [$count,$size_unit->unit_name , $size_unit->unit_id] ;
                    $count++;
                    } 
                # end size  unit 

                # facing
                   $excel_sheet[3]['title']         = 'Facing';
                   $excel_sheet[3]['headers']       =  ['S.N', 'Title', 'Facing Id'];

                   $count = 1; 

                   foreach(facings() as $facing){

                    $excel_sheet[3]['data'][] = [$count,$facing->title , $facing->facing_id] ;
                    $count++;

                 } 
                # end facing  
                        
                   # parkings
                
                   $excel_sheet[4]['title']         = 'Parkings';
                   $excel_sheet[4]['headers']       =  ['S.N', 'Label', 'Value'];
  
                   $count = 1; 
          
                   foreach($parkings as $parking ){
  
                       $excel_sheet[4]['data'][] = [$count,$parking->label , $parking->value] ;
                       $count++;
  
                   } 
                   if($parkings){
                       $excel_sheet[4]['data'][] = ['','',''];
                   }
  
               
               # end parkings 

                      # Applicable PLC
                  
                      $excel_sheet[5]['title']         = 'Applicable PLC';  
                      $excel_sheet[5]['headers']       =  ['S.N.', 'Title', 'PLC ID' ];
                      $count = 1;
  
                      foreach(getPropertyPlcs($property_id ?? 0) as $ApplicablePlc){
                      $excel_sheet[5]['data'][] = [$count,$ApplicablePlc->price_component_name , $ApplicablePlc->price_component_id] ;
                      $count++;
                      } 
                      if(count(getPropertyPlcs($property_id ?? 0)) == 0){
                          $excel_sheet[5]['data'][] = ['','',''];
                      }
                    # end Applicable PLC

                         # size Floor 
                         $excel_sheet[6]['title']         = 'Floor';  
                         $excel_sheet[6]['headers']       =  ['S.N.', 'Name', 'Floor Id' ];
                         $count = 1;

                         foreach(getFloors() as $get_floor){
                         $excel_sheet[6]['data'][] = [$count,$get_floor->name , $get_floor->id] ;
                         $count++;
                         } 
                         # end size  Tower 

                         # size Floor 
                         $excel_sheet[7]['title']         = 'Tower';  
                         $excel_sheet[7]['headers']       =  ['S.N.', 'Name', 'Floor Id' ];
                         $count = 1;

                         foreach(getBlocksOrTowers() as $block_or_tower){
                         $excel_sheet[7]['data'][] = [$count,$block_or_tower->name , $block_or_tower->id] ;
                         $count++;
                         } 

            
                        # end size  Floor 

         
                break;
            endswitch;
        

        if ($form) :  
            return inventory_create_sample_file($excel_sheet , $property_details->name);
        else :
            return false;
        endif;
    }

    # End Invetory Excel Form 

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

    # get_property_unit_details
    function get_property_unit_details($id)
    {
        if (!$id) :
            return null;
        endif;

        $image_base_url             =   base_url('uploads/images/property/unit/');

        $record    =   db_instance()
            ->select("
                        product_unit_detail_id as id, 
                        product_id as property_id, 
                        code as unit_code, 
                        no_of_unit as unit_no,
                        ba, sa, ca,
                        dimension,
                        plot_size,
                        unit as size_unit,
                        plot_unit,
                        facing,
                        no_of_floor as number_of_floor,
                        IF(image != '', concat('$image_base_url', image), '') as image_url   
                    ")
            ->where("product_unit_detail_id = $id") 
            ->order_by("code", "asc")
            ->get('tbl_product_unit_details')
            ->row();

        # Parkings
        CI()->db->select('product_id as id, parking_open, parking_stilt, parking_basment');
        CI()->db->from('tbl_products');
        CI()->db->where("product_id = $record->property_id");
        $parkings        = CI()->db->get()->row();
        $record->parkings        = $parkings;
        # End Parkings

        # PLC
        CI()->db->select('pc.price_component_id as id, pc.price_component_name as name');
        CI()->db->from('tbl_product_plc_details');
        CI()->db->join('tbl_price_components as pc', 'pc.price_component_id = tbl_product_plc_details.price_comp_id');
        CI()->db->where("product_id = $record->property_id");
        $plc_records    = CI()->db->get()->result();
        $record->plc        = $plc_records;
        # End PLC

        # Additional PLC
        CI()->db->select('pc.price_component_id as id, pc.price_component_name as name');
        CI()->db->from('tbl_product_additional_details');
        CI()->db->join('tbl_price_components as pc', 'pc.price_component_id = tbl_product_additional_details.price_comp_id');
        CI()->db->where("product_id = $record->property_id");
        $additional_plc_records = CI()->db->get()->result();
        $record->additional_plc        = $additional_plc_records;
        # End Additional PLC

        # Accomodations
        CI()->db->select('ac.accomodation_id as id, ac.accomodation_name as name');
        CI()->db->from('tbl_product_unit_details');
        CI()->db->join('tbl_accomodations as ac', 'ac.accomodation_id = tbl_product_unit_details.accomodation', 'left');
        CI()->db->where("product_id = $record->property_id");
        $accomodations = CI()->db->get()->result();
        $record->accomodations        = $accomodations;
        # End Accomodations

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
    

    
    #  create excel with multiple sheet
     function inventory_create_sample_file($excel_sheet , $sheet_name){
        
        require_once(APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php');
        require_once(APPPATH . 'third_party/PHPExcel/Classes/PHPExcel/IOFactory.php');
        
        /* Create new PHPExcel object*/
        $objPHPExcel = new PHPExcel();
        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
        
        // Function to create a new sheet with specified headers and data
        function createSheet($objPHPExcel, $index, $title, $headers, $data) {
            // Create a new sheet
            $objPHPExcel->createSheet($index);
            $objPHPExcel->setActiveSheetIndex($index);
        
            // Set column dimensions and headers
            $columnIndex = 'A';
            foreach ($headers as $header) {
                $objPHPExcel->getActiveSheet()->getColumnDimension($columnIndex)->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->setCellValue($columnIndex . '1', $header);
                $columnIndex++;
            }
        
            // Insert data
            $row = 2; // Starting row for data
            foreach ($data as $rowData) {
                $columnIndex = 'A';
                foreach ($rowData as $cellData) {
                    $objPHPExcel->getActiveSheet()->setCellValue($columnIndex . $row, $cellData);
                    $columnIndex++;
                }
                $row++;
            }
        
            // Set sheet title
            $objPHPExcel->getActiveSheet()->setTitle($title);
        }

        # create mutiple sheet
            $count = 0;
            foreach($excel_sheet  as $excel_row):
                createSheet($objPHPExcel, $count , $excel_row['title'],  $excel_row['headers'], $excel_row['data'] ?? []);  
                $count++;
            endforeach;  
        # end create mutiple sheet 

        $objPHPExcel->setActiveSheetIndex(0);
        
        // Save the spreadsheet
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=".'.$sheet_name.'.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');

    }

   
    # end  create excel with multiple sheet  

    # Account Helper
    if(!function_exists('getAgent')){
    function getAgent()
    {
        CI()->load->model('Action_model');

        $user_hash = CI()->input->request_headers()['Access-Token'] ?? null;

        if($user_hash):
            $where = "user_hash='" . $user_hash . "'";
        else:
            $where = "user_hash='" . CI()->session->userdata('agent_hash') . "'";
        endif;

        $user_detail = CI()->Action_model->select_single('tbl_users', $where);
        return $user_detail;
    }
}
    
    if(!function_exists('get_level_user_ids')){
        function get_level_user_ids()
        {
            CI()->load->model('Action_model');
            $agent = getAgent();
            $user_role_id = $agent->role_id;

            $user_ids = array();
            if ($user_role_id == 5) {
                $user_ids[] = $agent->user_id;

                $w1 = "role_id='4' AND report_to='" . $agent->user_id . "'";
                $d1 = CI()->Action_model->detail_result('tbl_users', $w1);
                if ($d1) {
                    foreach ($d1 as $item1) {

                        $user_ids[] = $item1->user_id;

                        $w2 = "role_id='3' AND report_to='" . $item1->user_id . "'";
                        $d2 = CI()->Action_model->detail_result('tbl_users', $w2);
                        if ($d2) {
                            foreach ($d2 as $item2) {

                                $user_ids[] = $item2->user_id;
                            }
                        }
                    }
                }
            } else if ($user_role_id == 4) {
                $user_ids[] = $agent->user_id;

                $w1 = "role_id='3' AND report_to='" . $agent->user_id . "'";
                $d1 =CI()->Action_model->detail_result('tbl_users', $w1);
                if ($d1) {
                    foreach ($d1 as $item1) {

                        $user_ids[] = $item1->user_id;
                    }
                }
            } else if ($user_role_id == 3) {
                $user_ids[] = $agent->user_id;
            }

            return $user_ids;
        }
    }

    # End Account Helper

    # Request

    if(!function_exists('request')){

    function request(){
            if(CI()->input->post()):
                return (object) CI()->input->post();
            endif;

            if(CI()->input->get()):
                return (object) CI()->input->get();
            endif;
        }
    }
    # Request

    # History
    // if(!function_exists('store_lead_history')):
    //     function store_lead_history($params){
    //         $lead_history_array =   [
    //                                     'title'         => $params->title ?? '',
    //                                     'description'   => $params->description ?? '',
    //                                     'lead_id'       => $params->lead_id,
    //                                     'created_at'    => time(),
    //                                     "account_id"    => $params->account_id,
    //                                     "user_id"       => $params->user_id
    //                                 ];
    //         $this->Action_model->insert_data($lead_history_array, 'tbl_lead_history');
    //     }
    // endif;
    # End History

    # Counting Summary
    if(!function_exists('counting_summary')){
        function count_summary($user, $selected_member_ids = null){
            $count_summary                  =   [];
            $where                          =   " 1 = 1 ";
    
            if ($selected_member_ids):
                $where                      .=   " and user_id in ($selected_member_ids) ";
            else:
                $where  .=  $user->level_user_ids ? 
                        " and user_id in ($user->level_user_ids) " : 
                        " and ( user_id = '$user->user_id' or account_id = '$user->user_id') " ;
            endif;

        /****************************************************
        *   Leads Counting 
        ****************************************************/
        # Counting Query
        $total_leads_count_query                    =   "lead.lead_stage_id != '6' AND lead.lead_stage_id != '7'";
        $total_active_leads_count_query             =   "( lead.lead_status = '1' ) and lead.lead_stage_id != '6' AND lead.lead_stage_id != '7'";
        $total_inactive_leads_count_query             =   "(  lead.lead_status is NULL or lead.lead_status = '0' or lead.lead_status = '2' ) and lead.lead_stage_id != '6' AND lead.lead_stage_id != '7'";
        $today_lead_count_query                     =   "(( lead.lead_status = '1' ) AND ( lead.lead_stage_id = '1' ) AND ( lead.added_to_followup = 0 ) AND ( DATE(FROM_UNIXTIME(created_at))  = CURDATE()) ) ";
        
        $initial_leads_count_query                  =   " ( lead.lead_stage_id = '1' or lead.lead_stage_id = '0' )";
        $followup_leads_count_query                 =   "lead.lead_stage_id = '2'";
        $enquiry_leads_count_query                  =   "lead.lead_stage_id = '3'";
        $site_visit_leads_count_query               =   "lead.lead_stage_id = '4'";
        $metting_leads_count_query                  =   "lead.lead_stage_id = '5'";
        $success_leads_count_query                  =   "lead.lead_stage_id = '6'";
        $dump_leads_count_query                     =   "lead.lead_stage_id = '7'";
        $unknown_stage_count_query                  =   "lead.lead_stage_id is NULL";
        # End Counting Query

        $lead_select_query                  =   "
                                                    COUNT(DISTINCT lead.lead_id) as all_leads_count,
                                                    SUM(CASE WHEN ( $total_leads_count_query) THEN 1 ELSE 0 END) as total_leads_count,
                                                    SUM(CASE WHEN ( $total_active_leads_count_query) THEN 1 ELSE 0 END) as total_active_leads_count,
                                                    SUM(CASE WHEN ( $total_inactive_leads_count_query) THEN 1 ELSE 0 END) as total_inactive_leads_count,
                                                    SUM(CASE WHEN ( $today_lead_count_query) THEN 1 ELSE 0 END) as today_initial_lead_count,
                                                    SUM(CASE WHEN ( $initial_leads_count_query) THEN 1 ELSE 0 END) as total_initial_count,
                                                    SUM(CASE WHEN ( $followup_leads_count_query) THEN 1 ELSE 0 END) as total_followup_count,
                                                    SUM(CASE WHEN ( $enquiry_leads_count_query) THEN 1 ELSE 0 END) as total_enquiry_count,
                                                    SUM(CASE WHEN ( $site_visit_leads_count_query) THEN 1 ELSE 0 END) as total_site_visit_count,
                                                    SUM(CASE WHEN ( $metting_leads_count_query) THEN 1 ELSE 0 END) as total_metting_count,
                                                    SUM(CASE WHEN ( $success_leads_count_query) THEN 1 ELSE 0 END) as total_success_count,
                                                    SUM(CASE WHEN ( $dump_leads_count_query) THEN 1 ELSE 0 END) as total_dump_count,
                                                    SUM(CASE WHEN ( $unknown_stage_count_query ) THEN 1 ELSE 0 END) as total_unknown_stage_count
                                                    ";

        
                                                    db_instance()->select($lead_select_query);
                                                    db_instance()->where($where);
                                                    db_instance()->from('tbl_leads as lead');
        $leads_count_sumamry                          =   db_instance()->get()->row();

        /****************************************************
        *   End Leads Counting 
        ****************************************************/

        $today_initial_followup_lead_count_query        =   "( followup_status = '1' ) AND ( lead_stage_id = '1' ) AND ( STR_TO_DATE(next_followup_date, '%d-%m-%Y') = CURDATE() ) ";

        $today_followup_count_query                     =   "followup_status = '1' AND STR_TO_DATE(next_followup_date, '%d-%m-%Y') = CURDATE() ";
        $missed_followup_count_query                    =   "(( lead_stage_id != '6' and lead_stage_id != '7' ) AND  followup.lead_status_id = '1' AND followup.followup_status = '1' AND STR_TO_DATE(followup.next_followup_date, '%d-%m-%Y') < CURDATE() )";
              
        $followup_select_query                          =   "
                                                                SUM(CASE WHEN ( $today_initial_followup_lead_count_query ) THEN 1 ELSE 0 END) as today_initial_followup_lead_count,
                                                                SUM(CASE WHEN ( $today_followup_count_query ) THEN 1 ELSE 0 END) as today_followup_lead_count,
                                                                SUM(CASE WHEN ( $missed_followup_count_query ) THEN 1 ELSE 0 END) as missed_followup_count
                                                            ";

        
        db_instance()->select($followup_select_query);
        db_instance()->where($where);
        db_instance()->from('tbl_followup as followup');
        $followup_count_summary                          =   db_instance()->get()->row();

        /****************************************************
        *   Followup Counting 
        ****************************************************/

        /****************************************************
        *   End Followup Counting 
        ****************************************************/

        #
        $today_lead                                               =   ( $leads_count_sumamry->today_initial_lead_count ?? 0 ) + ( $followup_count_summary->today_initial_followup_lead_count ?? 0);

        $count_summary['today_lead']                              =   $today_lead;
        $count_summary['today_followup']                          =   ( $followup_count_summary->today_followup_lead_count ?? 0 );
        $count_summary['missed_followup']                         =   ( $followup_count_summary->missed_followup_count ?? 0 );

        
        $count_summary['total_leads']                             =   $leads_count_sumamry->total_leads_count ?? 0;
        $count_summary['total_active_leads']                      =   $leads_count_sumamry->total_active_leads_count ?? 0;
        $count_summary['total_inactive_leads']                    =   $leads_count_sumamry->total_inactive_leads_count ?? 0;

        # Stage Count
            $count_summary['total_initial']                       =   $leads_count_sumamry->total_initial_count ?? 0;
            $count_summary['total_followup']                      =   $leads_count_sumamry->total_followup_count ?? 0;
            $count_summary['total_enquiry']                       =   $leads_count_sumamry->total_enquiry_count ?? 0;
            $count_summary['total_site_visit']                    =   $leads_count_sumamry->total_site_visit_count ?? 0;
            $count_summary['total_metting']                       =   $leads_count_sumamry->total_metting_count ?? 0;
            $count_summary['total_dump']                          =   $leads_count_sumamry->total_dump_count ?? 0;
            $count_summary['total_success']                       =   $leads_count_sumamry->total_success_count ?? 0;
            $count_summary['unknown_stage']                       =   $leads_count_sumamry->total_unknown_stage_count ?? 0;
        # End Stage Count

       # End 
            
           return (object) $count_summary;
        }
    }
    # End Counting Summary

    if(!function_exists('transfer_or_assign_lead')){
        function transfer_or_assign_lead($param = null){
            if(!$param) return false;

            $lead_id                =   $param->lead_id;

        }
    }


}
