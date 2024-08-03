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

    # Get Invetory Excel Form

    function property_excel($property_id){

        // print_r(sizeUnit()); die;

       # Get property information
            $property_details = property($property_id);

            
            // print_r($property_details); die;
       # End  Get property information  

       # Get Unit code 
            $unit_codes       =  getPropertyAccomodations($property_details->project_type_id, $property_details->property_type_id, $property_id);     
       # End Unit  code

        $form               =   '';
        $excel_sheet        =   [];
      

        switch($property_details->property_type_id):
            case '2': #Villa
                $form          =   'villa';
                $excel_sheet[0]['title']                    =  'Villa';
                $excel_sheet[0]['headers']                  =  ['S.N.', 'Unit Code ( with Accomodations )', 'Referance Number', 'Plot Number', 'Plot Size', 'Size Unit' ,'No of Floor' ,'Block' , 'Applicable PLC' , 'Facing' ,'Dimantion F x B x S1 x S2' , 'Layout upload'];
                $excel_sheet[0]['data'][]                   =  ['', '', '', '', '', ''];

                # unit code
                   $excel_sheet[1]['title']      = 'Unit Code';  
                   $excel_sheet[1]['headers']    = ['S.N' ,'Unit Code', 'Code Id' ];  
                   
                   $count = 1;
                   foreach($unit_codes as $unit_code){
                      $excel_sheet[1]['data'][] = [$count,$unit_code->inventory_unit_code , $unit_code->id] ;
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
  
                      foreach(getPropertyApplicablePlcs($property_id ?? 0) as $ApplicablePlc){
                      $excel_sheet[4]['data'][] = [$count,$ApplicablePlc->price_component_name , $ApplicablePlc->price_component_id] ;
                      $count++;
                      } 
                      if(count(getPropertyApplicablePlcs($property_id ?? 0)) == 0){
                          $excel_sheet[4]['data'][] = ['','',''];
                      }
                  # end Applicable PLC

                break;
            case '3': #Plot

                $form                           =  'plot';
                $excel_sheet[0]['title']                    =  'Plot';
                $excel_sheet[0]['headers']                  =  ['S.N.', 'Unit Code', 'Referance Number', 'Plot Number', 'Plot Size', 'Size Unit' ,'Block' ,'Applicable PLC' , 'Facing' , 'Dimantion F x B x S1 x S2' ,'Layout Upload'];
                $excel_sheet[0]['data'][]                     =  ['', '', '', '', '', ''];

                # unit code
                   $excel_sheet[1]['title']      = 'Unit Code';  
                   $excel_sheet[1]['headers']    = ['S.N' ,'Unit Code', 'Code Id' ];  
                   
                   $count = 1;
                   foreach($unit_codes as $unit_code){
                      $excel_sheet[1]['data'][] = [$count,$unit_code->inventory_unit_code , $unit_code->id] ;
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
  
                      foreach(getPropertyApplicablePlcs($property_id ?? 0) as $ApplicablePlc){
                      $excel_sheet[4]['data'][] = [$count,$ApplicablePlc->price_component_name , $ApplicablePlc->price_component_id] ;
                      $count++;
                      } 
                      if(count(getPropertyApplicablePlcs($property_id ?? 0)) == 0){
                          $excel_sheet[4]['data'][] = ['','',''];
                      }
                  # end Applicable PLC
            
                break;
            case '4':
                $form          =   'shop';

                $excel_sheet[0]['title']                    =  'Shop';
                $excel_sheet[0]['headers']                  =  ['S.N.', 'Unit Code ( with Accomodations )', 'Referance Number', 'Unit no', 'Floor ', 'Tower' ,'Unit Type' ,'Area' , 'Size Unit' ,'Applicable PLC' , 'Facing' ,'Parking' , 'Layout upload'];
                $excel_sheet[0]['data'][]                   =  ['', '', '', '', '', ''];

                # unit code
                   $excel_sheet[1]['title']      = 'Unit Code';  
                   $excel_sheet[1]['headers']    = ['S.N' ,'Unit Code', 'Code Id' ];  
                   
                   $count = 1;
                   foreach($unit_codes as $unit_code){
                      $excel_sheet[1]['data'][] = [$count,$unit_code->inventory_unit_code , $unit_code->id] ;
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
  
                      foreach(getPropertyApplicablePlcs($property_id ?? 0) as $ApplicablePlc){
                      $excel_sheet[4]['data'][] = [$count,$ApplicablePlc->price_component_name , $ApplicablePlc->price_component_id] ;
                      $count++;
                      } 
                      if(count(getPropertyApplicablePlcs($property_id ?? 0)) == 0){
                          $excel_sheet[4]['data'][] = ['','',''];
                      }
                    # end Applicable PLC

                break;
            case '5': # Office
                $form          =   'office';
                $excel_sheet[0]['title']                    =  'Office';
                $excel_sheet[0]['headers']                  =  ['S.N.', 'Unit Code ( with Accomodations )', 'Referance Number', 'Unit no', 'Floor ', 'Tower' ,'Unit Type' ,'Area' , 'Size Unit' , 'Facing' ,'Parking' ,'Pentry' , 'Washroom' , 'Layout upload'];
                $excel_sheet[0]['data'][]                   =  ['', '', '', '', '', ''];

                # unit code
                   $excel_sheet[1]['title']      = 'Unit Code';  
                   $excel_sheet[1]['headers']    = ['S.N' ,'Unit Code', 'Code Id' ];  
                   
                   $count = 1;
                   foreach($unit_codes as $unit_code){
                      $excel_sheet[1]['data'][] = [$count,$unit_code->inventory_unit_code , $unit_code->id] ;
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
  
                      foreach(getPropertyApplicablePlcs($property_id ?? 0) as $ApplicablePlc){
                      $excel_sheet[4]['data'][] = [$count,$ApplicablePlc->price_component_name , $ApplicablePlc->price_component_id] ;
                      $count++;
                      } 
                      if(count(getPropertyApplicablePlcs($property_id ?? 0)) == 0){
                          $excel_sheet[4]['data'][] = ['','',''];
                      }
                  # end Applicable PLC

                break;
            case '7':
                $form          =   'builder-floor';

                $excel_sheet[0]['title']                    =  'Builder Floor';
                $excel_sheet[0]['headers']                  =  ['S.N.', 'Unit Code', 'Referance Number', 'Plot Number', 'Plot Size', 'Size Unit' ,'Floor', 'Block' ,'Applicable PLC' , 'Facing' , 'Dimantion F x B x S1 x S2' ,'Tarrace' , 'Basment' , 'Parking', 'Layout Upload'];
                $excel_sheet[0]['data'][]                   =  ['', '', '', '', '', ''];

                # unit code
                   $excel_sheet[1]['title']      = 'Unit Code';  
                   $excel_sheet[1]['headers']    = ['S.N' ,'Unit Code', 'Code Id' ];  
                   
                   $count = 1;
                   foreach($unit_codes as $unit_code){
                      $excel_sheet[1]['data'][] = [$count,$unit_code->inventory_unit_code , $unit_code->id] ;
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
  
                      foreach(getPropertyApplicablePlcs($property_id ?? 0) as $ApplicablePlc){
                      $excel_sheet[4]['data'][] = [$count,$ApplicablePlc->price_component_name , $ApplicablePlc->price_component_id] ;
                      $count++;
                      } 
                      if(count(getPropertyApplicablePlcs($property_id ?? 0)) == 0){
                          $excel_sheet[4]['data'][] = ['','',''];
                      }
                  # end Applicable PLC

                break;
            case '1':
                $form          =   'apartment';
                $excel_sheet[0]['title']                        =  'Apartment';
                $excel_sheet[0]['headers']                      =  ['S.N.', 'Unit Code ( with Accomodations )', 'Referance Number', 'Unit No', 'Floor', 'Tower' ,'Unit Type' ,'SA' , 'SA Size' , 'BA' ,'BA Size' , 'CA' ,'CA Size' ,'Applicable PLC' , 'Facing' , 'Parking' , 'Layout Upload Url'];
                $excel_sheet[0]['data'][]                       =  ['', '', '', '', '', '','','','','','','','','','',''];

                # unit code
                   $excel_sheet[1]['title']      = 'Unit Code';  
                   $excel_sheet[1]['headers']    = ['S.N' ,'Unit Code', 'Code Id' ];  
                   
                   $count = 1;
                   foreach($unit_codes as $unit_code){
                      $excel_sheet[1]['data'][] = [$count,$unit_code->inventory_unit_code , $unit_code->id] ;
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

                    foreach(getPropertyApplicablePlcs($property_id ?? 0) as $ApplicablePlc){
                    $excel_sheet[5]['data'][] = [$count,$ApplicablePlc->price_component_name , $ApplicablePlc->price_component_id] ;
                    $count++;
                    } 
                    if(count(getPropertyApplicablePlcs($property_id ?? 0)) == 0){
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

                break;
            case '9':
                $form          =   'apartment';
                $excel_sheet[0]['title']                        =  'Apartment';
                $excel_sheet[0]['headers']                      =  ['S.N.', 'Unit Code ( with Accomodations )', 'Referance Number', 'Unit No', 'Floor', 'Tower' ,'Unit Type' ,'SA' , 'SA Size' , 'BA' ,'BA Size' , 'CA' ,'CA Size' ,'Applicable PLC' , 'Facing' , 'Parking' , 'Layout Upload Url'];
                $excel_sheet[0]['data'][]                       =  ['', '', '', '', '', '','','','','','','','','','',''];

                # unit code
                   $excel_sheet[1]['title']      = 'Unit Code';  
                   $excel_sheet[1]['headers']    = ['S.N' ,'Unit Code', 'Code Id' ];  
                   
                   $count = 1;
                   foreach($unit_codes as $unit_code){
                      $excel_sheet[1]['data'][] = [$count,$unit_code->inventory_unit_code , $unit_code->id] ;
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

                    foreach(getPropertyApplicablePlcs($property_id ?? 0) as $ApplicablePlc){
                    $excel_sheet[5]['data'][] = [$count,$ApplicablePlc->price_component_name ?? '' , $ApplicablePlc->price_component_id ?? ''] ;
                    $count++;
                    } 

                    if(count(getPropertyApplicablePlcs($property_id ?? 0)) == 0){
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
                break;
        endswitch;
        

        // echo '<pre>';
        // print_r($excel_sheet); die;

        if ($form) :  
            return inventory_create_sample_file($excel_sheet);
        else :
            return "<div class='text-center my-3'><h4>Form not available.</h4></div>";
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
                        concat('$image_base_url', image) as image_url   
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
     function inventory_create_sample_file($excel_sheet){
        
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
                createSheet($objPHPExcel, $count , $excel_row['title'],  $excel_row['headers'], $excel_row['data']);  
                $count++;
            endforeach;  
        # end create mutiple sheet 

        $objPHPExcel->setActiveSheetIndex(0);
        
        // Save the spreadsheet
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="download-sample.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');

    }

   
    # end  create excel with multiple sheet  

}
