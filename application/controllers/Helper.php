<?php

    defined('BASEPATH') OR exit('No direct script access allowed');
    date_default_timezone_set('Asia/Kolkata');

class Helper extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    # Get Property Types
    public function get_property_types(){
        $project_type_id            = $this->input->get('project_type_id');
        $selected_property_id       = $this->input->get('selected_property_id');

        if(!$project_type_id):
            return null;
        endif;

        $records = property_types($project_type_id);

        $options                =   "<option value=''>Choose...</option>";
        
        foreach($records ?? [] as $record):
            $selected            =  $selected_property_id == $record->id ? 'selected' : '';
            $options            .=  "<option value='$record->id' $selected>$record->name</option>";
        endforeach;

        echo json_encode(['status' => true, 'message' => 'Successfully data fetched', 'data' => $records, 'options_view' => $options]);
    }
    # End Get Property Types

    # Get Cities
    public function get_cities(){
        $state_id    = $this->input->get('state_id');
        $selected_city_id       = $this->input->get('selected_city_id');

        if(!$state_id):
            return null;
        endif;

        $records                =   cities($state_id);

        $options                =   "<option value=''>Choose...</option>";
        
        foreach($records ?? [] as $record):
            $selected            =  $selected_city_id == $record->id ? 'selected' : '';
            $options            .=   "<option value='$record->id' $selected>$record->name</option>";
        endforeach;

        echo json_encode(['status' => true, 'message' => 'Successfully data fetched', 'data' => $records, 'options_view' => $options]);
    }
    # End Get Cities

    # Get Property Form
    public function get_property_form(){
        $property_id            = $this->input->get('property_id');
        $property_details       = $this->input->get('property_details');
       
        if(!$property_id):
            return null;
        endif;

        $form_view                =   property_form($property_id, $property_details);

        echo json_encode(['status' => true, 'message' => 'Successfully data fetched', 'form_view' => $form_view]);
    
    }
    # End Get Property Form

    # Get Lead Units
    public function get_lead_units(){
        $lead_id            = $this->input->get('lead_id');
       
        if(!$lead_id):
            return null;
        endif;

        $view                =   $this->load->view('components/details-view/lead-units', [ 'lead_id' =>  $lead_id ], true);

        echo json_encode(['status' => true, 'message' => 'Successfully data fetched', 'view' => $view]);
    
    }
    # End Get Lead Units

}
