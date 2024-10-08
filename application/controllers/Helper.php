<?php

defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');

class Helper extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    # Get Property Types
    public function get_property_types()
    {
        $project_type_id            = $this->input->get('project_type_id');
        $selected_id       = $this->input->get('selected_id');

        if (!$project_type_id) :
            return null;
        endif;

        $records = property_types($project_type_id);

        $options                =   "<option value='' disabled selected>Choose...</option>";

        foreach ($records ?? [] as $record) :
            $selected            =  $selected_id == $record->id ? 'selected' : '';
            $options            .=  "<option value='$record->id' $selected>$record->name</option>";
        endforeach;

        echo json_encode(['status' => true, 'message' => 'Successfully data fetched', 'data' => $records, 'options_view' => $options]);
    }
    # End Get Property Types

    # Get Cities
    public function get_cities()
    {
        $state_id    = $this->input->get('state_id');
        $selected_id       = $this->input->get('selected_id');

        if (!$state_id) :
            echo json_encode(['status' => false, 'message' => 'Please select state']);
        endif;

        $records                =   cities($state_id);

        $options                =   "<option value=''>Choose...</option>";

        foreach ($records ?? [] as $record) :
            $selected            =  $selected_id == $record->id ? 'selected' : '';
            $options            .=   "<option value='$record->id' $selected>$record->name</option>";
        endforeach;

        echo json_encode(['status' => true, 'message' => 'Successfully data fetched', 'data' => $records, 'options_view' => $options]);
    }
    # End Get Cities

    # Get Locations
    public function get_locations()
    {
        $city_id               = $this->input->get('city_id');
        $selected_id            = $this->input->get('selected_id');

        if (!$city_id) :
            echo json_encode(['status' => false, 'message' => 'City not selected']);
        endif;

        $records                =   locations($city_id);

        $options                =   "<option value=''>Choose...</option>";

        foreach ($records ?? [] as $record) :
            $selected            =  $selected_id == $record->id ? 'selected' : '';
            $options            .=   "<option value='$record->id' $selected>$record->name</option>";
        endforeach;

        echo json_encode(['status' => true, 'message' => 'Successfully data fetched', 'data' => $records, 'view' => $options]);
    }
    # End Get Locations

    # Get Property Form
    public function get_property_form()
    {
        $id                             = $this->input->get('id');
        $property_type_id               = $this->input->get('property_type_id');
        $property_id                    = $this->input->get('property_id');
        $selected_property_id           = $this->input->get('selected_property_id');
        $property_details               = $this->input->get('property_details');

        if (!$property_type_id) :
            return null;
        endif;


        if($property_id && $selected_property_id != $property_id ):
            $property_details               =   project_property_details($property_type_id, $property_id);
        elseif($id):
            $lead_unit_details               = lead_unit_details($id);
            $property_details                = $lead_unit_details->property_details ?? null;
        endif;
        

        $form_view                      =   property_form($property_type_id, $property_details);

        echo json_encode(['status' => true, 'message' => 'Successfully data fetched', 'form_view' => $form_view]);
    }
    # End Get Property Form

    # Get Lead Units
    public function get_lead_units()
    {
        $lead_id            = $this->input->get('lead_id');

        if (!$lead_id) :
            echo json_encode(['status' => false, 'message' => 'Please select lead']);
            exit;
        endif;

        $where          = "user_hash='" . $this->session->userdata('agent_hash') . "'";
        $user_detail    = $this->db->where($where)->get('tbl_users')->row();

    
    
        $view          =   $this->load->view('components/details-view/lead-units', ['lead_id' =>  $lead_id , 'user_detail' =>  $user_detail ], true);

        echo json_encode(['status' => true, 'message' => 'Successfully data fetched', 'view' => $view]);
    }
    # End Get Lead Units

    # Get Lead Units
    public function projects()
    {

        # Init
        $project_type_id                    =   $this->input->get('project_type_id');
        $property_type_id                   =   $this->input->get('property_type_id');
        $state_id                           =   $this->input->get('state_id');
        $city_id                            =   $this->input->get('city_id');
        $location_id                        =   $this->input->get('location_id');
        $selected_id                        =   $this->input->get('selected_id');
        $is_view                            =   $this->input->get('view');
        # End Init

        $records    =   $this->db
            ->select('project.product_id, project.project_name, product_type.product_type_name as project_type_name, unit_type.unit_type_name as property_type_name, state.state_name, city.city_name')
            ->join('tbl_product_types as product_type', 'product_type.product_type_id = project.project_type', 'left')
            ->join('tbl_unit_types as unit_type', 'unit_type.unit_type_id = project.property_type', 'left')
            ->join('tbl_states as state', 'state.state_id = project.state_id', 'left')
            ->join('tbl_city as city', 'city.city_id = project.city_id', 'left')
            ->order_by("project.product_id", "desc")
            ->where("project.product_status = 1");

        if ($project_type_id) :
            $records->where("project.project_type = $project_type_id");
        endif;

        if ($property_type_id) :
            $records->where("project.property_type = $property_type_id");
        endif;

        if ($state_id) :
            $records->where("project.state_id = $state_id");
        endif;

        if ($city_id) :
            $records->where("project.city_id = $city_id");
        endif;

        if ($location_id) :
            $records->where("project.location = $location_id");
        endif;


        $records        =   $records->get('tbl_products as project')
            ->result();

        if ($is_view) :
            $view                   =   "<option value='' selected>Choose...</option>";
            
            foreach ($records ?? [] as $record) :
                $selected            =  $selected_id == $record->product_id ? 'selected' : '';
                $view                .=   "<option value='$record->product_id' $selected>$record->project_name</option>";
            endforeach;
        endif;


        echo json_encode(['status' => true, 'message' => 'Successfully data fetched', 'data' => $records, 'view' => $view ?? null]);
    }
    # End Get Lead Units

     # Fetch Project Properties
     public function project_properties(){
        $project_id                     = $this->input->get('project_id');
        $selected_id            = $this->input->get('selected_id');

        if (!$project_id) :
            echo json_encode(['status' => false, 'message' => 'Please select project/product']);
            exit;
        endif;

        $records                =   project_properties($project_id);

        $options                =   "<option value=''>Choose...</option>";

        foreach ($records ?? [] as $record) :
            $selected            =  $selected_id == $record->id ? 'selected' : '';
            $options            .=   "<option value='$record->id' $selected>$record->code</option>";
        endforeach;

        echo json_encode(['status' => true, 'message' => 'Successfully data fetched', 'data' => $records, 'view' => $options]);
     }
     # End Fetch Project Properties
     
     # Fetch Project Properties
    public function project_property_details(){
        $property_type_id            = $this->input->get('property_type_id');
        $project_property_id            = $this->input->get('project_property_id');
      
        if (!$project_property_id) :
            return null;
        endif;

        $data                =   project_property_details($property_type_id, $project_property_id);

        echo json_encode(['status' => true, 'message' => 'Successfully data fetched', 'data' => $data]);
    }
     # End Fetch Project Properties

    # Remove Gallery Image
    public function remove_gallery_image(){
        if(!$this->input->post()){
            echo json_encode(['status' => false, 'message' => 'Request method not matched.']);
            exit;
        }
            $id                     =   $this->input->post('id');
            $type                   =   $this->input->post('type');

            if($id):
                
                # Fetch Record
                    $record = $this->db->where("id = $id")->get('tbl_gallery_images')->row();

                    if($record):

                        # Remove Image From Folder
                        switch($record->type):
                            case 'lead_unit';
                                $file_path = "./public/other/gallery-images/lead-units/".$record->name;
                                if(file_exists($file_path )):
                                    unlink($file_path );
                                endif;
                            break;
                        endswitch;
                        # End Remove Image From Folder
                    endif;
                # End Fetch Record

                # Delete Record
                $this->db->where("id = $id and type = '$type'")->delete('tbl_gallery_images');
                # End Delete Record
            endif;

            echo json_encode(['status' => true, 'message' => 'Successfully image removed.']);


    }
    # End Remove Gallery Image

    # Remove Add More Record
    public function remove_add_more_record_file(){
        if(!$this->input->post()){
            echo json_encode(['status' => false, 'message' => 'Request method not matched.']);
            exit;
        }
            $id                 =   $this->input->post('id');

            if($id):
                
                # Fetch Record
                    $record = $this->db->where("id = $id")->get('tbl_property_documents')->row();

                    if($record):

                        # Remove File From Folder
                        $file_path = "./public/other/property-documents/".$record->document;

                        if(file_exists($file_path )):
                            unlink($file_path );
                        endif;
                        # End Remove File From Folder
                    endif;
                # End Fetch Record

                # Delete Record
                $this->db->where("id = $id")->delete('tbl_property_documents');
                # End Delete Record
            endif;
           

            echo json_encode(['status' => true, 'message' => 'Successfully record removed.']);


    }
    # End Remove Add More Record

    # Delete Lead
    public function delete_lead(){
        if(!$this->input->post()){
            echo json_encode(['status' => false, 'message' => 'Request method not matched.']);
            exit;
        }

            # Permission
            if(user()->role_id != 1 || user()->role_id != 5):
                echo json_encode(['status' => false, 'message' => 'Permission denied']);
                exit;
            endif;
            # End Permission

            $id                 =   $this->input->post('id');

            if($id):
                
                # Fetch Record
                    $record = $this->db->where("id = $id")->get('tbl_leads')->row();

                    if($record):

                        # Remove File From Folder
                        $file_path = "./public/other/profile/".$record->profile;

                        if(file_exists($file_path )):
                            unlink($file_path );
                        endif;
                        # End Remove File From Folder
                    endif;
                # End Fetch Record

                # Delete Record
                $this->db->where("id = $id")->delete('tbl_leads');
                # End Delete Record
            endif;
           

            echo json_encode(['status' => true, 'message' => 'Successfully record deleted.']);


    }
    # End Delete Lead

}
