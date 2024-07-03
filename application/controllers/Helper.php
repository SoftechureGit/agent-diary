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
        $property_id            = $this->input->get('property_id');
        $property_details       = $this->input->get('property_details');

        if (!$property_id) :
            return null;
        endif;

        $form_view                =   property_form($property_id, $property_details);

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

        $view                =   $this->load->view('components/details-view/lead-units', ['lead_id' =>  $lead_id], true);

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

}
