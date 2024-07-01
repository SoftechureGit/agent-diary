<?php

    defined('BASEPATH') OR exit('No direct script access allowed');
    date_default_timezone_set('Asia/Kolkata');

class Helper extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    # Get Property Types
    public function get_property_types(){
        $project_type_id    = $this->input->get('project_type_id');

        if(!$project_type_id):
            return null;
        endif;

        $records = property_types($project_type_id);

        $options                =   "<option value=''>Choose...</option>";
        
        foreach($records ?? [] as $record):
            $options            .=   "<option value='$record->id'>$record->name</option>";
        endforeach;

        echo json_encode(['status' => true, 'message' => 'Successfully data fetched', 'data' => $records, 'options_view' => $options]);
    }
    # End Get Property Types

    # Get Cities
    public function get_cities(){
        $state_id    = $this->input->get('state_id');

        if(!$state_id):
            return null;
        endif;

        $records                =   cities($state_id);

        $options                =   "<option value=''>Choose...</option>";
        
        foreach($records ?? [] as $record):
            $options            .=   "<option value='$record->id'>$record->name</option>";
        endforeach;

        echo json_encode(['status' => true, 'message' => 'Successfully data fetched', 'data' => $records, 'options_view' => $options]);
    }
    # End Get Cities

    # Get Property Form
    public function get_property_form(){
        $property_id    = $this->input->get('property_id');

        if(!$property_id):
            return null;
        endif;

        $form_view                =   property_form($property_id);

        echo json_encode(['status' => true, 'message' => 'Successfully data fetched', 'form_view' => $form_view]);
    
    }
    # End Get Property Form

}
