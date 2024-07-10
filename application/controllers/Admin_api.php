<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_api extends CI_Controller {
 public function __construct() {
        parent::__construct();
        $this->load->model('Action_model');
    }

	public function index()
	{
        
	  $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
      echo json_encode($array);
	}

    /* role start */
    public function role_list(){
        if ($this->input->post()) {
            $postData = $this->input->post();
            $select = 'role_id,role_name,role_status';
            $where = '';

            $searchValue = $postData['search']['value'];
            $searchQuery = "";
             if($searchValue != ''){
                $searchQuery = " (role_name like '%".$searchValue."%' )";//" AND (role_id='1' OR role_id='2' OR is_admin_member='1')";
             }
             else {
                //$searchQuery = "(role_id='1' OR role_id='2' OR is_admin_member='1')";
             }
            $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_roles',$where,$select);

            echo json_encode($data);
        }
        else {
            $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
            echo json_encode($array);
        }
    }

    public function get_role()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_roles',"role_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function role_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_roles',"role_id='".$id."'");

            $record_array = array(
                'role_name'=>$this->input->post('role_name'),
                'role_status'=>$this->input->post('role_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_roles',"role_name='".$this->input->post('role_name')."' AND user_id='1' AND role_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Role Name is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_roles',"role_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Role Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();
                $record_array['is_admin_member'] = 1;
                $record_array['user_id'] = 1;

                if ($this->Action_model->select_single('tbl_roles',"role_name='".$this->input->post('role_name')."' AND user_id='1'")) {
                    $array = array('status'=>'error','message'=>'This Role Name is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_roles');
                    $array = array('status'=>'added','message'=>'Role Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_role()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_roles',"role_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_roles',"role_id='".$id."'");
                $array = array('status'=>'added','message'=>'Role Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* role end */

    /* lead_type start */
    public function lead_type_list(){
     
        $postData = $this->input->post();
        $select = 'lead_type_id,lead_type_name,lead_type_status';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (lead_type_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_lead_types',$where,$select);

        echo json_encode($data);
    }

    public function get_lead_type()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_lead_types',"lead_type_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function lead_type_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_lead_types',"lead_type_id='".$id."'");

            $record_array = array(
                'lead_type_name'=>$this->input->post('lead_type_name'),
                'lead_type_status'=>$this->input->post('lead_type_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_lead_types',"lead_type_name='".$this->input->post('lead_type_name')."' AND lead_type_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Lead Status is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_lead_types',"lead_type_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Lead Status Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_lead_types',"lead_type_name='".$this->input->post('lead_type_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Lead Status is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_lead_types');
                    $array = array('status'=>'added','message'=>'Lead Status Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_lead_type()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_lead_types',"lead_type_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_lead_types',"lead_type_id='".$id."'");
                $array = array('status'=>'added','message'=>'Lead Type Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* lead_type end */

    /* lead_source start */
    public function lead_source_list(){
     
        $postData = $this->input->post();
        $select = 'lead_source_id,lead_source_name,lead_source_status';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (lead_source_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_lead_sources',$where,$select);

        echo json_encode($data);
    }

    public function get_lead_source()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_lead_sources',"lead_source_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function lead_source_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_lead_sources',"lead_source_id='".$id."'");

            $record_array = array(
                'lead_source_name'=>$this->input->post('lead_source_name'),
                'lead_source_status'=>$this->input->post('lead_source_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_lead_sources',"lead_source_name='".$this->input->post('lead_source_name')."' AND lead_source_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Lead Source is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_lead_sources',"lead_source_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Lead Source Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_lead_sources',"lead_source_name='".$this->input->post('lead_source_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Lead Source is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_lead_sources');
                    $array = array('status'=>'added','message'=>'Lead Source Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_lead_source()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_lead_sources',"lead_source_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_lead_sources',"lead_source_id='".$id."'");
                $array = array('status'=>'added','message'=>'Lead Source Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* lead_source end */

    /* furnishing start */
    public function furnishing_list(){
     
        $postData = $this->input->post();
        $select = 'furnishing_id,furnishing_name,furnishing_status,input_type';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (furnishing_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_furnishings',$where,$select);

        echo json_encode($data);
    }

    public function get_furnishing()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_furnishings',"furnishing_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function furnishing_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_furnishings',"furnishing_id='".$id."'");

            $record_array = array(
                'furnishing_name'=>$this->input->post('furnishing_name'),
                'input_type'=>$this->input->post('input_type'),
                'furnishing_status'=>$this->input->post('furnishing_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_furnishings',"furnishing_name='".$this->input->post('furnishing_name')."' AND furnishing_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Furnishing is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_furnishings',"furnishing_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Furnishing Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_furnishings',"furnishing_name='".$this->input->post('furnishing_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Furnishing is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_furnishings');
                    $array = array('status'=>'added','message'=>'Furnishing Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_furnishing()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_furnishings',"furnishing_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_furnishings',"furnishing_id='".$id."'");
                $array = array('status'=>'added','message'=>'Furnishing Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* furnishing end */

        /* lead_stage start */
    public function lead_stage_list(){
     
        $postData = $this->input->post();
        $select = 'lead_stage_id,lead_stage_name,lead_stage_status';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (lead_stage_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_lead_stages',$where,$select);

        echo json_encode($data);
    }

    public function get_lead_stage()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_lead_stages',"lead_stage_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function lead_stage_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_lead_stages',"lead_stage_id='".$id."'");

            $record_array = array(
                'lead_stage_name'=>$this->input->post('lead_stage_name'),
                'lead_stage_status'=>$this->input->post('lead_stage_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_lead_stages',"lead_stage_name='".$this->input->post('lead_stage_name')."' AND lead_stage_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Lead Stage is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_lead_stages',"lead_stage_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Lead Stage Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_lead_stages',"lead_stage_name='".$this->input->post('lead_stage_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Lead Stage is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_lead_stages');
                    $array = array('status'=>'added','message'=>'Lead Stage Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_lead_stage()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_lead_stages',"lead_stage_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_lead_stages',"lead_stage_id='".$id."'");
                $array = array('status'=>'added','message'=>'Lead Stage Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* lead_stage end */

    /* lead_action start */
    public function lead_action_list(){
     
        $postData = $this->input->post();
        $select = 'lead_action_id,lead_action_name,lead_action_status';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (lead_action_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_lead_actions',$where,$select);

        echo json_encode($data);
    }

    public function get_lead_action()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_lead_actions',"lead_action_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function lead_action_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_lead_actions',"lead_action_id='".$id."'");

            $record_array = array(
                'lead_action_name'=>$this->input->post('lead_action_name'),
                'lead_action_status'=>$this->input->post('lead_action_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_lead_actions',"lead_action_name='".$this->input->post('lead_action_name')."' AND lead_action_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Lead Action is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_lead_actions',"lead_action_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Lead Action Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_lead_actions',"lead_action_name='".$this->input->post('lead_action_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Lead Action is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_lead_actions');
                    $array = array('status'=>'added','message'=>'Lead Action Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_lead_action()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_lead_actions',"lead_action_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_lead_actions',"lead_action_id='".$id."'");
                $array = array('status'=>'added','message'=>'Lead Action Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* lead_action end */

    /* ideal_business start */
    public function ideal_business_list(){
     
        $postData = $this->input->post();
        $select = 'ideal_business_id,ideal_business_name,ideal_business_status';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (ideal_business_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_ideal_business',$where,$select);

        echo json_encode($data);
    }

    public function get_ideal_business()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_ideal_business',"ideal_business_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function ideal_business_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_ideal_business',"ideal_business_id='".$id."'");

            $record_array = array(
                'ideal_business_name'=>$this->input->post('ideal_business_name'),
                'ideal_business_status'=>$this->input->post('ideal_business_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_ideal_business',"ideal_business_name='".$this->input->post('ideal_business_name')."' AND ideal_business_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Business is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_ideal_business',"ideal_business_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Business Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_ideal_business',"ideal_business_name='".$this->input->post('ideal_business_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Business is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_ideal_business');
                    $array = array('status'=>'added','message'=>'Business Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_ideal_business()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_ideal_business',"ideal_business_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_ideal_business',"ideal_business_id='".$id."'");
                $array = array('status'=>'added','message'=>'Business Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* ideal_business end */

    /* construction_age start */
    public function construction_age_list(){
     
        $postData = $this->input->post();
        $select = 'construction_age_id,construction_age_name,construction_age_status';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (construction_age_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_construction_ages',$where,$select);

        echo json_encode($data);
    }

    public function get_construction_age()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_construction_ages',"construction_age_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function construction_age_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_construction_ages',"construction_age_id='".$id."'");

            $record_array = array(
                'construction_age_name'=>$this->input->post('construction_age_name'),
                'construction_age_status'=>$this->input->post('construction_age_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_construction_ages',"construction_age_name='".$this->input->post('construction_age_name')."' AND construction_age_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Construction Age is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_construction_ages',"construction_age_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Construction Age Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_construction_ages',"construction_age_name='".$this->input->post('construction_age_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Construction Age is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_construction_ages');
                    $array = array('status'=>'added','message'=>'Construction Age Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_construction_age()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_construction_ages',"construction_age_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_construction_ages',"construction_age_id='".$id."'");
                $array = array('status'=>'added','message'=>'Construction Age Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* construction_age end */

        /* module start */
    public function module_list(){
     
        $postData = $this->input->post();
        $select = 'module_id,module_name,module_code,module_page_name,module_status';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (module_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_modules',$where,$select);

        echo json_encode($data);
    }

    public function get_module()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_modules',"module_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function module_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_modules',"module_id='".$id."'");

            $record_array = array(
                'module_name'=>$this->input->post('module_name'),
                'module_code'=>$this->input->post('module_code'),
                'module_page_name'=>$this->input->post('module_page_name'),
                'perm_create'=>$this->input->post('perm_create'),
                'perm_edit'=>$this->input->post('perm_edit'),
                'perm_delete'=>$this->input->post('perm_delete'),
                'perm_view'=>$this->input->post('perm_view'),
                'module_status'=>$this->input->post('module_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_modules',"module_name='".$this->input->post('module_name')."' AND module_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Module is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_modules',"module_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Module Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_modules',"module_name='".$this->input->post('module_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Module is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_modules');
                    $array = array('status'=>'added','message'=>'Module Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_module()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_modules',"module_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_modules',"module_id='".$id."'");
                $array = array('status'=>'added','message'=>'Module Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* module end */

        /* unit start */
    public function unit_list(){
     
        $postData = $this->input->post();
        $select = 'unit_id,unit_name,unit_status';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (unit_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_units',$where,$select);

        echo json_encode($data);
    }

    public function get_unit()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_units',"unit_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function unit_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_units',"unit_id='".$id."'");

            $record_array = array(
                'unit_name'=>$this->input->post('unit_name'),
                'unit_status'=>$this->input->post('unit_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_units',"unit_name='".$this->input->post('unit_name')."' AND unit_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Unit is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_units',"unit_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Unit Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_units',"unit_name='".$this->input->post('unit_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Unit is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_units');
                    $array = array('status'=>'added','message'=>'Unit Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_unit()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_units',"unit_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_units',"unit_id='".$id."'");
                $array = array('status'=>'added','message'=>'Unit Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* unit end */

        /* department start */
    public function department_list(){
     
        $postData = $this->input->post();
        $select = 'department_id,department_name,department_status';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (department_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_departments',$where,$select);

        echo json_encode($data);
    }

    public function get_department()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_departments',"department_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function department_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_departments',"department_id='".$id."'");

            $record_array = array(
                'department_name'=>$this->input->post('department_name'),
                'department_status'=>$this->input->post('department_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_departments',"department_name='".$this->input->post('department_name')."' AND department_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Department is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_departments',"department_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Department Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_departments',"department_name='".$this->input->post('department_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Department is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_departments');
                    $array = array('status'=>'added','message'=>'Department Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_department()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_departments',"department_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_departments',"department_id='".$id."'");
                $array = array('status'=>'added','message'=>'Department Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* department end */

        /* occupation start */
    public function occupation_list(){
     
        $postData = $this->input->post();
        $select = 'occupation_id,occupation_name,occupation_status';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (occupation_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_occupations',$where,$select);

        echo json_encode($data);
    }

    public function get_occupation()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_occupations',"occupation_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function occupation_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_occupations',"occupation_id='".$id."'");

            $record_array = array(
                'occupation_name'=>$this->input->post('occupation_name'),
                'occupation_status'=>$this->input->post('occupation_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_occupations',"occupation_name='".$this->input->post('occupation_name')."' AND occupation_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Occupation is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_occupations',"occupation_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Occupation Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_occupations',"occupation_name='".$this->input->post('occupation_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Occupation is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_occupations');
                    $array = array('status'=>'added','message'=>'Occupation Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_occupation()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_occupations',"occupation_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_occupations',"occupation_id='".$id."'");
                $array = array('status'=>'added','message'=>'Occupation Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* occupation end */

        /* product_type start */
    public function product_type_list(){
     
        $postData = $this->input->post();
        $select = 'product_type_id,product_type_name,product_type_status';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (product_type_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_product_types',$where,$select);

        echo json_encode($data);
    }

    public function get_product_type()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_product_types',"product_type_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function product_type_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_product_types',"product_type_id='".$id."'");

            $record_array = array(
                'product_type_name'=>$this->input->post('product_type_name'),
                'product_type_status'=>$this->input->post('product_type_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_product_types',"product_type_name='".$this->input->post('product_type_name')."' AND product_type_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Product Type is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_product_types',"product_type_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Product Type Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_product_types',"product_type_name='".$this->input->post('product_type_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Product Type is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_product_types');
                    $array = array('status'=>'added','message'=>'Product Type Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_product_type()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_product_types',"product_type_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_product_types',"product_type_id='".$id."'");
                $array = array('status'=>'added','message'=>'Product Type Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* product_type end */

    /* specification start */
    public function specification_list(){
     
        $postData = $this->input->post();
        $select = 'specification_id,specification_name,specification_status';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (specification_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_specifications',$where,$select);

        echo json_encode($data);
    }

    public function get_specification()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_specifications',"specification_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function specification_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_specifications',"specification_id='".$id."'");

            $record_array = array(
                'specification_name'=>$this->input->post('specification_name'),
                'specification_status'=>$this->input->post('specification_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_specifications',"specification_name='".$this->input->post('specification_name')."' AND specification_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Specification is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_specifications',"specification_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Specification Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_specifications',"specification_name='".$this->input->post('specification_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Specification is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_specifications');
                    $array = array('status'=>'added','message'=>'Specification Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_specification()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_specifications',"specification_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_specifications',"specification_id='".$id."'");
                $array = array('status'=>'added','message'=>'Specification Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* specification end */

    /* amenitie start */
    public function amenitie_list(){
     
        $postData = $this->input->post();
        $select = 'amenitie_id,amenitie_name,amenitie_status,amenitie_image';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (amenitie_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_amenities',$where,$select);

        echo json_encode($data);
    }

    public function get_amenitie()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_amenities',"amenitie_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function amenitie_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $amenitie_image = "";
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_amenities',"amenitie_id='".$id."'");

            if ($record) {

                if ($this->Action_model->select_single('tbl_amenities',"amenitie_name='".$this->input->post('amenitie_name')."' AND amenitie_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Amenitie is already exist.');
                    echo json_encode($array);
                    exit;
                }
            }
            else {

                if ($this->Action_model->select_single('tbl_amenities',"amenitie_name='".$this->input->post('amenitie_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Amenitie is already exist.');
                    echo json_encode($array);
                    exit;
                }
            }

            $where = array(
                'client_id'=>$id
            );

            if ($record) {
                $amenitie_image = $record->amenitie_image;
            }

            $config['upload_path'] = './uploads/images/amenitie/';
            $config['allowed_types']= 'jpg|png';
            $config['max_size']             = 5*1024;
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if (!empty($_FILES['amenitie_image']['name'])) {
                if (!$this->upload->do_upload('amenitie_image'))
                { 
                    $error = array('error' => $this->upload->display_errors());
                    $array = array('status'=>'error','message'=> $error['error']);
                    echo json_encode($array);
                    exit;
                }
                else
                { 
                    if($record && $record->amenitie_image && file_exists('./uploads/images/amenitie/'.$record->amenitie_image)){ unlink('./uploads/images/amenitie/'.$record->amenitie_image); }
                    $amenitie_image=$this->upload->data('file_name');
                }
            }

            $record_array = array(
                'amenitie_name'=>$this->input->post('amenitie_name'),
                'amenitie_status'=>$this->input->post('amenitie_status'),
                'amenitie_image'=>$amenitie_image
            );

            if ($record) {
                $record_array['updated_at'] = time();
                $this->Action_model->update_data($record_array,'tbl_amenities',"amenitie_id='".$id."'");
                $array = array('status'=>'added','message'=>'Amenitie Updated Successfully!!');
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();
                $this->Action_model->insert_data($record_array,'tbl_amenities');
                $array = array('status'=>'added','message'=>'Amenitie Added Successfully!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_amenitie()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_amenities',"amenitie_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_amenities',"amenitie_id='".$id."'");
                $array = array('status'=>'added','message'=>'Amenitie Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* amenitie end */

    /* finance start */
    public function finance_list(){
     
        $postData = $this->input->post();
        $select = 'finance_id,finance_name,finance_status,finance_image';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (finance_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_finances',$where,$select);

        echo json_encode($data);
    }

    public function get_finance()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_finances',"finance_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function finance_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $finance_image = "";
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_finances',"finance_id='".$id."'");

            if ($record) {

                if ($this->Action_model->select_single('tbl_finances',"finance_name='".$this->input->post('finance_name')."' AND finance_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Finance is already exist.');
                    echo json_encode($array);
                    exit;
                }
            }
            else {

                if ($this->Action_model->select_single('tbl_finances',"finance_name='".$this->input->post('finance_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Finance is already exist.');
                    echo json_encode($array);
                    exit;
                }
            }

            $where = array(
                'client_id'=>$id
            );

            if ($record) {
                $finance_image = $record->finance_image;
            }

            $config['upload_path'] = './uploads/images/finance/';
            $config['allowed_types']= 'jpg|png';
            $config['max_size']             = 5*1024;
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if (!empty($_FILES['finance_image']['name'])) {
                if (!$this->upload->do_upload('finance_image'))
                { 
                    $error = array('error' => $this->upload->display_errors());
                    $array = array('status'=>'error','message'=> $error['error']);
                    echo json_encode($array);
                    exit;
                }
                else
                { 
                    if($record && $record->finance_image && file_exists('./uploads/images/finance/'.$record->finance_image)){ unlink('./uploads/images/finance/'.$record->finance_image); }
                    $finance_image=$this->upload->data('file_name');
                }
            }

            $record_array = array(
                'finance_name'=>$this->input->post('finance_name'),
                'finance_status'=>$this->input->post('finance_status'),
                'finance_image'=>$finance_image
            );

            if ($record) {
                $record_array['updated_at'] = time();
                $this->Action_model->update_data($record_array,'tbl_finances',"finance_id='".$id."'");
                $array = array('status'=>'added','message'=>'Fiinance Updated Successfully!!');
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();
                $this->Action_model->insert_data($record_array,'tbl_finances');
                $array = array('status'=>'added','message'=>'Fiinance Added Successfully!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_finance()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_finances',"finance_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_finances',"finance_id='".$id."'");
                $array = array('status'=>'added','message'=>'Fiinance Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* finance end */


    /* location start */
    public function location_list(){
        
        $postData = $this->input->post();
        $search_state_id = $this->input->post('search_state_id');
        $search_city_id = $this->input->post('search_city_id');
        $select = 'location_id,location_name,location_status,state_name,city_name';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "location_id!=''";
         if($searchValue != ''){
            $searchQuery = " (location_name like '%".$searchValue."%' OR state_name like '%".$searchValue."%' OR city_name like '%".$searchValue."%') ";
         }

        if($search_state_id != ''){
           $searchQuery .= " and tbl_locations.state_id='".$search_state_id."' ";
        }

        if($search_city_id != ''){
           $searchQuery .= " and tbl_locations.city_id='".$search_city_id."' ";
        }


        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_locations',$where,$select,array('tbl_states','tbl_states.state_id=tbl_locations.state_id','tbl_city','tbl_city.city_id=tbl_locations.city_id' ));

        echo json_encode($data);
    }

    public function get_location()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_locations',"location_id='".$id."'");
            if ($record) {

                $where = "state_id='".$record->state_id."'";
                $city_data = $this->Action_model->detail_result('tbl_city',$where);
                $city_list = array();
                if ($city_data) {
                    $city_list = $city_data;
                }

                $array = array('status'=>'success','message'=>'','record'=>$record,'city_list'=>$city_list);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function location_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_locations',"location_id='".$id."'");

            $record_array = array(
                'location_name'=>$this->input->post('location_name'),
                'state_id'=>$this->input->post('state_id'),
                'city_id'=>$this->input->post('city_id'),
                'location_status'=>$this->input->post('location_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_locations',"location_name='".$this->input->post('location_name')."' AND location_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Location is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_locations',"location_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Location Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_locations',"location_name='".$this->input->post('location_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Location is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_locations');
                    $array = array('status'=>'added','message'=>'Location Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_location()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_locations',"location_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_locations',"location_id='".$id."'");
                $array = array('status'=>'added','message'=>'Location Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function get_city()
    {
        $array = array();
        $city_list = array();

        if ($this->input->post()) {
            $state_id=$this->input->post('state_id');
            $where = "state_id='".$state_id."'";
            $city_data = $this->Action_model->detail_result('tbl_city',$where);
            if ($city_data) {
                $city_list = $city_data;
            }
            $array = array('status'=>'success','message'=>'Data Found','city_list'=>$city_list);
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* location end */

    /* team start */
    public function team_list(){
     
        $postData = $this->input->post();
        $select = 'tbl_users.user_id,date_register,mobile,user_title,first_name,last_name,user_status,role_name,username';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (first_name like '%".$searchValue."%' ) AND (tbl_roles.is_admin_member='1' OR tbl_roles.role_id='1')";
         }
         else {
            $searchQuery ="(tbl_roles.is_admin_member='1' OR tbl_roles.role_id='1')";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_users',$where,$select,array('tbl_roles',"tbl_roles.role_id=tbl_users.role_id" ));

        echo json_encode($data);
    }

    public function get_team()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_users',"user_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function team_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_users',"user_id='".$id."'");

            $record_array = array(
                'user_title'=>$this->input->post('user_title'),
                'first_name'=>$this->input->post('user_first_name'),
                'last_name'=>$this->input->post('user_last_name'),
                'email'=>$this->input->post('user_email'),
                'username'=>$this->input->post('user_user_id'),
                'mobile'=>$this->input->post('user_mobile'),
                'whatsapp_no'=>$this->input->post('user_whatsapp_no'),
                'role_id'=>$this->input->post('user_role_id'),
                'work_time_from'=>$this->input->post('work_time_from'),
                'work_time_to'=>$this->input->post('work_time_to'),
                'date_register'=>$this->input->post('date_register'),
                'user_status'=>$this->input->post('user_status'),
                'user_hash'=>md5(time()).time().rand(1000,9999)
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->input->post('user_password')) {
                    $record_array['password'] = md5($this->input->post('user_password'));
                }

                $this->Action_model->update_data($record_array,'tbl_users',"user_id='".$id."'");
                $array = array('status'=>'added','message'=>'Team Updated Successfully!!');
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();
                $record_array['password'] = md5($this->input->post('user_password'));
                $record_array['parent_id'] = 1;
                $record_array['email_verify'] = 1;

                if ($this->Action_model->select_single('tbl_users',"username='".$this->input->post('user_user_id')."'")) {
                    $array = array('status'=>'error','message'=>'This Username is already exist.');
                }
                else if ($this->Action_model->select_single('tbl_users',"email='".$this->input->post('user_email')."'")) {
                    $array = array('status'=>'error','message'=>'This email address is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_users');
                    $array = array('status'=>'added','message'=>'Team Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_team()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_users',"user_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_users',"user_id='".$id."'");
                $array = array('status'=>'added','message'=>'Team Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* team end */

    /* unit_type start */
    public function unit_type_list(){
     
        $postData = $this->input->post();
        $select = 'unit_type_id,unit_type_name,unit_type_status,product_type_name';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (unit_type_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_unit_types',$where,$select,array('tbl_product_types','tbl_product_types.product_type_id=tbl_unit_types.product_type_id' ));

        echo json_encode($data);
    }

    public function get_unit_type()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_unit_types',"unit_type_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function unit_type_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_unit_types',"unit_type_id='".$id."'");

            $requirement_accomodation = 0;
            if ($this->input->post('requirement_accomodation')) {
               $requirement_accomodation = 1;
            }
            $record_array = array(
                'unit_type_name'=>$this->input->post('unit_type_name'),
                'product_type_id'=>$this->input->post('product_type_id'),
                'unit_type_status'=>$this->input->post('unit_type_status'),
                'requirement_accomodation'=>$requirement_accomodation
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_unit_types',"unit_type_name='".$this->input->post('unit_type_name')."' AND unit_type_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Unit Type is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_unit_types',"unit_type_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Unit Type Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_unit_types',"unit_type_name='".$this->input->post('unit_type_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Unit Type is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_unit_types');
                    $array = array('status'=>'added','message'=>'Unit Type Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_unit_type()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_unit_types',"unit_type_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_unit_types',"unit_type_id='".$id."'");
                $array = array('status'=>'added','message'=>'Unit Type Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* unit_type end */

     /* price_component start */
    public function price_component_list(){
     
        $postData = $this->input->post();
        $select = 'price_component_id,price_component_name,price_component_status,price_group_name';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (price_component_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_price_components',$where,$select,array('tbl_price_groups','tbl_price_groups.price_group_id=tbl_price_components.price_group_id' ));

        echo json_encode($data);
    }

    public function get_price_component()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_price_components',"price_component_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function price_component_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_price_components',"price_component_id='".$id."'");

            $record_array = array(
                'price_component_name'=>$this->input->post('price_component_name'),
                'price_group_id'=>$this->input->post('price_group_id'),
                'price_component_status'=>$this->input->post('price_component_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_price_components',"price_component_name='".$this->input->post('price_component_name')."' AND price_component_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Price Component is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_price_components',"price_component_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Price Component Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_price_components',"price_component_name='".$this->input->post('price_component_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Price Component is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_price_components');
                    $array = array('status'=>'added','message'=>'Price Component Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_price_component()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_price_components',"price_component_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_price_components',"price_component_id='".$id."'");
                $array = array('status'=>'added','message'=>'Price Component Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* price_component end */

        /* firm_type start */
    public function firm_type_list(){
     
        $postData = $this->input->post();
        $select = 'firm_type_id,firm_type_name,firm_type_status';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (firm_type_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_firm_types',$where,$select);

        echo json_encode($data);
    }

    public function get_firm_type()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_firm_types',"firm_type_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function firm_type_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_firm_types',"firm_type_id='".$id."'");

            $record_array = array(
                'firm_type_name'=>$this->input->post('firm_type_name'),
                'firm_type_status'=>$this->input->post('firm_type_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_firm_types',"firm_type_name='".$this->input->post('firm_type_name')."' AND firm_type_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Firm Type is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_firm_types',"firm_type_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Firm Type Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_firm_types',"firm_type_name='".$this->input->post('firm_type_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Firm Type is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_firm_types');
                    $array = array('status'=>'added','message'=>'Firm Type Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_firm_type()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_firm_types',"firm_type_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_firm_types',"firm_type_id='".$id."'");
                $array = array('status'=>'added','message'=>'Firm Type Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* firm_type end */

        /* property_type start */
    public function property_type_list(){
     
        $postData = $this->input->post();
        $select = 'property_type_id,property_type_name,property_type_status';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (property_type_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_property_types',$where,$select);

        echo json_encode($data);
    }

    public function get_property_type()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_property_types',"property_type_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function property_type_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_property_types',"property_type_id='".$id."'");

            $record_array = array(
                'property_type_name'=>$this->input->post('property_type_name'),
                'property_type_status'=>$this->input->post('property_type_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();
                $this->Action_model->update_data($record_array,'tbl_property_types',"property_type_id='".$id."'");
                $array = array('status'=>'added','message'=>'Property Type Updated Successfully!!');
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();
                $this->Action_model->insert_data($record_array,'tbl_property_types');
                $array = array('status'=>'added','message'=>'Property Type Added Successfully!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_property_type()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_property_types',"property_type_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_property_types',"property_type_id='".$id."'");
                $array = array('status'=>'added','message'=>'Property Type Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* property_type end */

    /* builder_group start */
    public function builder_group_list(){
     
        $postData = $this->input->post();
        $select = 'builder_group_id,builder_group_name,builder_group_status';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (builder_group_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_builder_groups',$where,$select);

        echo json_encode($data);
    }

    public function get_builder_group()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_builder_groups',"builder_group_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function builder_group_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_builder_groups',"builder_group_id='".$id."'");

            $record_array = array(
                'builder_group_name'=>$this->input->post('builder_group_name'),
                'builder_group_status'=>$this->input->post('builder_group_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_builder_groups',"builder_group_name='".$this->input->post('builder_group_name')."' AND builder_group_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Builder Group is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_builder_groups',"builder_group_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Builder Group Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_builder_groups',"builder_group_name='".$this->input->post('builder_group_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Builder Group is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_builder_groups');
                    $array = array('status'=>'added','message'=>'Builder Group Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_builder_group()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_builder_groups',"builder_group_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_builder_groups',"builder_group_id='".$id."'");
                $array = array('status'=>'added','message'=>'Builder Group Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* builder_group end */

        /* accomodation start */
    public function accomodation_list(){
     
        $postData = $this->input->post();
        $select = 'accomodation_id,accomodation_name,accomodation_status';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (accomodation_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_accomodations',$where,$select);

        echo json_encode($data);
    }

    public function get_accomodation()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_accomodations',"accomodation_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function accomodation_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_accomodations',"accomodation_id='".$id."'");

            $record_array = array(
                'accomodation_name'=>$this->input->post('accomodation_name'),
                'accomodation_status'=>$this->input->post('accomodation_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_accomodations',"accomodation_name='".$this->input->post('accomodation_name')."' AND accomodation_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Accomodation is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_accomodations',"accomodation_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Accomodation Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_accomodations',"accomodation_name='".$this->input->post('accomodation_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Accomodation is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_accomodations');
                    $array = array('status'=>'added','message'=>'Accomodation Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_accomodation()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_accomodations',"accomodation_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_accomodations',"accomodation_id='".$id."'");
                $array = array('status'=>'added','message'=>'Accomodation Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* accomodation end */

        /* floor start */
    public function floor_list(){
     
        $postData = $this->input->post();
        $select = 'floor_id,floor_name,floor_status';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (floor_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_floors',$where,$select);

        echo json_encode($data);
    }

    public function get_floor()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_floors',"floor_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function floor_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_floors',"floor_id='".$id."'");

            $record_array = array(
                'floor_name'=>$this->input->post('floor_name'),
                'floor_status'=>$this->input->post('floor_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_floors',"floor_name='".$this->input->post('floor_name')."' AND floor_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Floor is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_floors',"floor_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Floor Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_floors',"floor_name='".$this->input->post('floor_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Floor is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_floors');
                    $array = array('status'=>'added','message'=>'Floor Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_floor()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_floors',"floor_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_floors',"floor_id='".$id."'");
                $array = array('status'=>'added','message'=>'Floor Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* floor end */

        /* facing start */
    public function facing_list(){
     
        $postData = $this->input->post();
        $select = 'facing_id,title,facing_status';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (title like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_facings',$where,$select);

        echo json_encode($data);
    }

    public function get_facing()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_facings',"facing_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function facing_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_facings',"facing_id='".$id."'");

            $record_array = array(
                'title'=>$this->input->post('title'),
                'facing_status'=>$this->input->post('facing_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_facings',"title='".$this->input->post('title')."' AND facing_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Facing is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_facings',"facing_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Facing Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_facings',"title='".$this->input->post('title')."'")) {
                    $array = array('status'=>'error','message'=>'This Facing is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_facings');
                    $array = array('status'=>'added','message'=>'Facing Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_facing()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_facings',"facing_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_facings',"facing_id='".$id."'");
                $array = array('status'=>'added','message'=>'Facing Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* facing end */

    /* authority start */
    public function authority_list(){
        
        $postData = $this->input->post();
        $search_state_id = $this->input->post('search_state_id');
        $search_city_id = $this->input->post('search_city_id');
        $select = 'authority_id,authority_name,authority_status,state_name,city_name';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "authority_id!=''";
         if($searchValue != ''){
            $searchQuery = " (authority_name like '%".$searchValue."%' OR state_name like '%".$searchValue."%' OR city_name like '%".$searchValue."%') ";
         }

        if($search_state_id != ''){
           $searchQuery .= " and tbl_authorities.state_id='".$search_state_id."' ";
        }

        if($search_city_id != ''){
           $searchQuery .= " and tbl_authorities.city_id='".$search_city_id."' ";
        }


        $data = $this->Action_model->ajaxDatatableLeft($postData,$searchQuery,'tbl_authorities',$where,$select,array('tbl_states','tbl_states.state_id=tbl_authorities.state_id','tbl_city','tbl_city.city_id=tbl_authorities.city_id' ));

        echo json_encode($data);
    }

    public function get_authority()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_authorities',"authority_id='".$id."'");
            if ($record) {

                $where = "state_id='".$record->state_id."'";
                $city_data = $this->Action_model->detail_result('tbl_city',$where);
                $city_list = array();
                if ($city_data) {
                    $city_list = $city_data;
                }

                $array = array('status'=>'success','message'=>'','record'=>$record,'city_list'=>$city_list);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function authority_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_authorities',"authority_id='".$id."'");

            $record_array = array(
                'authority_name'=>$this->input->post('authority_name'),
                'state_id'=>$this->input->post('state_id'),
                'city_id'=>$this->input->post('city_id'),
                'authority_status'=>$this->input->post('authority_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_authorities',"authority_name='".$this->input->post('authority_name')."' AND authority_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Authority is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_authorities',"authority_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Authority Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_authorities',"authority_name='".$this->input->post('authority_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Authority is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_authorities');
                    $array = array('status'=>'added','message'=>'Authority Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_authority()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_authorities',"authority_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_authorities',"authority_id='".$id."'");
                $array = array('status'=>'added','message'=>'Authority Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* authority end */

    /* budget start */
    public function budget_list(){
     
        $postData = $this->input->post();
        $select = 'budget_id,budget_name,budget_status';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (budget_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_budgets',$where,$select);

        echo json_encode($data);
    }

    public function get_budget()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_budgets',"budget_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function budget_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_budgets',"budget_id='".$id."'");

            $record_array = array(
                'budget_name'=>$this->input->post('budget_name'),
                'budget_status'=>$this->input->post('budget_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_budgets',"budget_name='".$this->input->post('budget_name')."' AND budget_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Budget is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_budgets',"budget_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Budget Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_budgets',"budget_name='".$this->input->post('budget_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Budget is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_budgets');
                    $array = array('status'=>'added','message'=>'Budget Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_budget()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_budgets',"budget_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_budgets',"budget_id='".$id."'");
                $array = array('status'=>'added','message'=>'Budget Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* budget end */

    /* designation start */
    public function designation_list(){
     
        $postData = $this->input->post();
        $select = 'designation_id,designation_name,designation_status';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (designation_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_designations',$where,$select);

        echo json_encode($data);
    }

    public function get_designation()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_designations',"designation_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function designation_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_designations',"designation_id='".$id."'");

            $record_array = array(
                'designation_name'=>$this->input->post('designation_name'),
                'designation_status'=>$this->input->post('designation_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_designations',"designation_name='".$this->input->post('designation_name')."' AND designation_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Designation is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_designations',"designation_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Designation Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_designations',"designation_name='".$this->input->post('designation_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Designation is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_designations');
                    $array = array('status'=>'added','message'=>'Designation Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_designation()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_designations',"designation_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_designations',"designation_id='".$id."'");
                $array = array('status'=>'added','message'=>'Designation Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* designation end */

    /* agent start */
    public function agent_list(){
     
        $postData = $this->input->post();

        $search_by = $this->input->post('search_by');
        $today = date("Y-m-d");
        $select = "user_id,date_register,mobile,first_name,last_name,email,user_status,rera_no,firm_name,city_name,unique_code,mobile_verify,email_verify,IF(STR_TO_DATE(next_due_date,'%d-%m-%Y')>='".$today."', 1, 0) as plan_active";
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (first_name like '%".$searchValue."%' OR last_name like '%".$searchValue."%' OR firm_name like '%".$searchValue."%' OR mobile like '%".$searchValue."%' OR email like '%".$searchValue."%') ";
         }

         if ($search_by) {
            if ($searchQuery) {
                $searchQuery .= " AND ";
            }
             $searchQuery .=" (first_name like '%".$search_by."%' OR last_name like '%".$search_by."%' OR firm_name like '%".$search_by."%' OR mobile like '%".$search_by."%' OR email like '%".$search_by."%')";
         }


         if ($searchQuery) {
                $searchQuery .= " AND role_id='2'";
         }
         else {
            $searchQuery .= "role_id='2'";
         }

         $state_id = $this->input->post('state_id');
         $city_id = $this->input->post('city_id');

         if ($state_id) {
                $searchQuery .= " AND tbl_users.state_id='".$state_id."'";
         }
         if ($city_id) {
                $searchQuery .= " AND tbl_users.city_id='".$city_id."'";
         }


         $plan_active = $this->input->post('plan_active');

         if ($plan_active=='1') {
                $searchQuery .= " AND STR_TO_DATE(next_due_date,'%d-%m-%Y')>='".$today."'";
         }
         else if ($plan_active=='0') {
                $searchQuery .= " AND STR_TO_DATE(next_due_date,'%d-%m-%Y')<'".$today."'";
         }

        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_users',$where,$select,array('tbl_city','tbl_city.city_id=tbl_users.city_id' ));

        $aaData = $data['aaData'];

        foreach ($aaData as $item) {
            $item->agent_name = $this->Action_model->get_name($item->user_id);
        }
        $data['aaData'] = $aaData;

        echo json_encode($data);
    }
    /* agent end */

    /* builder start */
    public function builder_list(){
     
        $postData = $this->input->post();
        $select = 'builder_id,firm_name,builder_status,date_register,builder_email,builder_mobile';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "builder_id!=''";
         if($searchValue != ''){
            $searchQuery = " (firm_name like '%".$searchValue."%' OR builder_email like '%".$searchValue."%' OR builder_mobile like '%".$searchValue."%' OR date_register like '%".$searchValue."%') ";
         }

         $search_by = $this->input->post('search_by');
         if ($search_by) {
            if ($searchQuery) {
                $searchQuery .= " AND ";
            }
             $searchQuery .=" (firm_name like '%".$search_by."%' OR builder_email like '%".$search_by."%' OR builder_mobile like '%".$search_by."%' OR date_register like '%".$search_by."%')";
         }

         $state_id = $this->input->post('state_id');
         $city_id = $this->input->post('city_id');
         $builder_status = $this->input->post('builder_status');

         if ($state_id) {
                $searchQuery .= " AND tbl_builders.builder_state_id='".$state_id."'";
         }
         if ($city_id) {
                $searchQuery .= " AND tbl_builders.builder_city_id='".$city_id."'";
         }
         if ($builder_status=='1') {
            $searchQuery .= " AND tbl_builders.builder_status='1'";
         }
         else if ($builder_status=='0') {
            $searchQuery .= " AND tbl_builders.builder_status='0'";
         }

        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_builders',$where,$select);

        echo json_encode($data);
    }

    public function builder_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_builders',"builder_id='".$id."'");

            $builder_logo = "";
            $cin_image = "";
            $tan_image = "";
            $pan_image = "";
            $gst_image = "";
            if ($record) {
                $builder_logo = $record->builder_logo;
                $cin_image = $record->cin_image;
                $tan_image = $record->tan_image;
                $pan_image = $record->pan_image;
                $gst_image = $record->gst_image;
            }

            $config['upload_path'] = './uploads/images/builder/logo/';
            $config['allowed_types']= 'jpg|png';
            $config['max_size']             = 5*1024;
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if (!empty($_FILES['builder_logo']['name'])) {
                if (!$this->upload->do_upload('builder_logo'))
                { 
                    $error = array('error' => $this->upload->display_errors());
                    $array = array('status'=>'error','message'=> $error['error']);
                    echo json_encode($array);
                    exit;
                }
                else
                { 
                    if($record && $record->builder_logo && file_exists('./uploads/images/builder/logo/'.$record->builder_logo)){ unlink('./uploads/images/builder/logo/'.$record->builder_logo); }
                    $builder_logo=$this->upload->data('file_name');
                }
            }

            $config['upload_path'] = './uploads/images/builder/document/';
            $config['allowed_types']= 'jpg|png';
            $config['max_size']             = 5*1024;
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if (!empty($_FILES['cin_image']['name'])) {
                if (!$this->upload->do_upload('cin_image'))
                { 
                    $error = array('error' => $this->upload->display_errors());
                    $array = array('status'=>'error','message'=> $error['error']);
                    echo json_encode($array);
                    exit;
                }
                else
                { 
                    if($record && $record->cin_image && file_exists('./uploads/images/builder/logo/'.$record->cin_image)){ unlink('./uploads/images/builder/logo/'.$record->cin_image); }
                    $cin_image=$this->upload->data('file_name');
                }
            }


            if (!empty($_FILES['tan_image']['name'])) {
                if (!$this->upload->do_upload('tan_image'))
                { 
                    $error = array('error' => $this->upload->display_errors());
                    $array = array('status'=>'error','message'=> $error['error']);
                    echo json_encode($array);
                    exit;
                }
                else
                { 
                    if($record && $record->tan_image && file_exists('./uploads/images/builder/logo/'.$record->tan_image)){ unlink('./uploads/images/builder/logo/'.$record->tan_image); }
                    $tan_image=$this->upload->data('file_name');
                }
            }


            if (!empty($_FILES['pan_image']['name'])) {
                if (!$this->upload->do_upload('pan_image'))
                { 
                    $error = array('error' => $this->upload->display_errors());
                    $array = array('status'=>'error','message'=> $error['error']);
                    echo json_encode($array);
                    exit;
                }
                else
                { 
                    if($record && $record->pan_image && file_exists('./uploads/images/builder/logo/'.$record->pan_image)){ unlink('./uploads/images/builder/logo/'.$record->pan_image); }
                    $pan_image=$this->upload->data('file_name');
                }
            }


            if (!empty($_FILES['gst_image']['name'])) {
                if (!$this->upload->do_upload('gst_image'))
                { 
                    $error = array('error' => $this->upload->display_errors());
                    $array = array('status'=>'error','message'=> $error['error']);
                    echo json_encode($array);
                    exit;
                }
                else
                { 
                    if($record && $record->gst_image && file_exists('./uploads/images/builder/logo/'.$record->gst_image)){ unlink('./uploads/images/builder/logo/'.$record->gst_image); }
                    $gst_image=$this->upload->data('file_name');
                }
            }

            $record_array = array(
                'builder_group_id'=>$this->input->post('builder_group_id'),
                'firm_name'=>$this->input->post('firm_name'),
                'builder_email'=>$this->input->post('builder_email'),
                'builder_mobile'=>$this->input->post('builder_mobile'),
                'firm_type_id'=>$this->input->post('firm_type_id'),
                'address_1'=>$this->input->post('address_1'),
                'address_2'=>$this->input->post('address_2'),
                'address_3'=>$this->input->post('address_3'),
                'builder_country_id'=>$this->input->post('country_id'),
                'builder_state_id'=>$this->input->post('state_id'),
                'builder_city_id'=>$this->input->post('city_id'),
                'director_name'=>$this->input->post('director_name'),
                'director_contact_no'=>$this->input->post('director_contact_no'),
                'director_email'=>$this->input->post('director_email'),
                'representative_name'=>$this->input->post('representative_name'),
                'representative_contact_no'=>$this->input->post('representative_contact_no'),
                'representative_email'=>$this->input->post('representative_email'),
                'about_builder'=>$this->input->post('about_builder'),
                'cin_no'=>$this->input->post('cin_no'),
                'cin_image'=>$cin_image,
                'tan_no'=>$this->input->post('tan_no'),
                'tan_image'=>$tan_image,
                'pan_no'=>$this->input->post('pan_no'),
                'pan_image'=>$pan_image,
                'gst_no'=>$this->input->post('gst_no'),
                'gst_image'=>$gst_image,
                'builder_logo'=>$builder_logo,
                'builder_status'=>$this->input->post('builder_status'),
                'date_register'=>date("d-m-Y"),
                'director_title'=>$this->input->post('director_title'),
                'representative_title'=>$this->input->post('representative_title')
            );

            if ($record) {
                $record_array['updated_at'] = time();
                $this->Action_model->update_data($record_array,'tbl_builders',"builder_id='".$id."'");
                $this->session->set_flashdata('success_msg', 'Builder Updated Successfully!!');
                $array = array('status'=>'success','message'=>'Builder Updated Successfully!!');
            }
            else {
                $record_array['builder_status'] = '1';
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();
                $this->Action_model->insert_data($record_array,'tbl_builders');
                $this->session->set_flashdata('success_msg', 'Builder Added Successfully!!');
                $array = array('status'=>'success','message'=>'Builder Added Successfully!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function builder_update_status()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $status=$this->input->post('status');

            $record = $this->Action_model->select_single('tbl_builders',"builder_id='".$id."'");

            if ($record) {
                $this->Action_model->update_data(array('builder_status'=>$status),'tbl_builders',"builder_id='".$id."'");
                $array = array('status'=>'added','message'=>'Builder Updated Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* builder end */

    public function product_save()
    {

        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_products',"product_id='".$id."'");
            $property_type=$this->input->post('property_type');

            $block=$this->input->post('block');
            $flat_unit=$this->input->post('flat_unit');
            $villa_unit=$this->input->post('villa_unit');
            $plot_unit=$this->input->post('plot_unit');
            $comm_block = $this->input->post('comm_block');
            $comm_unit = $this->input->post('comm_unit');

            $slug = url_title($this->input->post('project_name'), 'dash', true);

            //print_r($plot_unit);exit;

            $record_array = array(
                'builder_id'=>$this->input->post('builder_id'),
                'agent_id'=>$this->input->post('agent_id'),
                'builder_group_id'=>$this->input->post('builder_group_id'),
                'project_name'=>$this->input->post('project_name'),
                'rera_application'=>$this->input->post('rera_application'),
                'rera_no'=>$this->input->post('rera_no'),
                'project_status'=>$this->input->post('project_status'),
                'project_type'=>$this->input->post('project_type'),
                'commisment_date'=>$this->input->post('commisment_date'),
                'land_area'=>$this->input->post('land_area'),
                'land_area_unit'=>$this->input->post('land_area_unit'),
                'buildup_area'=>$this->input->post('buildup_area'),
                'buildup_area_unit'=>$this->input->post('buildup_area_unit'),
                'state_id'=>$this->input->post('state_id'),
                'city_id'=>$this->input->post('city_id'),
                'location'=>$this->input->post('location'),
                'address1'=>$this->input->post('address1'),
                'lattitude'=>$this->input->post('lattitude'),
                'longitude'=>$this->input->post('longitude'),
                'property_type'=>$this->input->post('property_type')
            );

            if ($record) {

                if ($this->input->post('view_only')!=1) {

                $record_array['updated_at'] = time();
                $this->Action_model->update_data($record_array,'tbl_products',"product_id='".$id."'");

                if($this->input->post('project_type')==3) { 
                    if ($comm_block) {
                        $block_id_array = array();

                        foreach ($comm_block as $key => $value) {
                            $block_array = array(
                                'block_name'=>$value['block_name'],
                                'no_of_floor'=>$value['no_of_floor'],
                                'unit_per_floor'=>$value['unit_per_floor'],
                                'no_of_ps_lift'=>$value['no_of_ps_lift'],
                                'no_of_service_lift'=>$value['no_of_service_lift'],
                                'edp'=>$value['edp']
                            );

                            if ($value['block_id']!='') {
                                $block_id = $value['block_id'];
                                $block_id_array[] = $block_id;

                                $block_array['updated_at'] = time();

                                $this->Action_model->update_data($block_array,'tbl_product_block_details',"product_id='".$id."' AND project_type='".$this->input->post('project_type')."' 
                                    AND block_id='".$block_id."'");
                            }
                            else {
                                if ($value['block_name']) {
                                    $block_array['product_id'] = $id;
                                    $block_array['project_type'] = $this->input->post('project_type');
                                    $block_array['property_type'] = $this->input->post('property_type');
                                    $block_array['created_at'] = time();
                                    $block_array['updated_at'] = time();
                                    $block_id=$this->Action_model->insert_data($block_array,'tbl_product_block_details');
                                    $block_id_array[] = $block_id;
                                }
                            }
                        }

                        if ($block_id_array) {
                           $this->Action_model->delete_query('tbl_product_block_details',"product_id='".$id."' AND project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND (block_id NOT IN (".implode(',', $block_id_array)."))");
                        }
                    }
                    else {
                        $this->Action_model->delete_query('tbl_product_block_details',"product_id='".$id."' AND project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."'");
                    }

                    if ($comm_unit) {
                            $product_unit_detail_id_array = array();

                            foreach ($comm_unit as $key => $value) {

                                $unit_data = $this->Action_model->select_single('tbl_product_unit_details',"product_unit_detail_id='".$value['product_unit_detail_id']."'");

                                $comm_unit_array = array(
                                    'code'=>$value['code'],
                                    'no_of_unit'=>$value['no_of_unit'],
                                    'ca'=>$value['ca'],
                                    'ba'=>$value['ba'],
                                    'sa'=>$value['sa'],
                                    'unit'=>$value['unit'],
                                    'dimension'=>$value['dimension'],
                                    'sub_category'=>$value['sub_category']
                                );

                                if ($value['product_unit_detail_id']!='') {
                                    $product_unit_detail_id = $value['product_unit_detail_id'];
                                    $product_unit_detail_id_array[] = $product_unit_detail_id;

                                    $comm_unit_array['updated_at'] = time();

                                    $this->Action_model->update_data($comm_unit_array,'tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND product_id='".$id."' 
                                        AND product_unit_detail_id='".$product_unit_detail_id."'");
                                }
                                else {
                                    if ($value['code']) {
                                        $comm_unit_array['product_id'] = $id;
                                        $comm_unit_array['project_type'] = $this->input->post('project_type');
                                        $comm_unit_array['property_type'] = $this->input->post('property_type');
                                        $comm_unit_array['created_at'] = time();
                                        $comm_unit_array['updated_at'] = time();
                                        $product_unit_detail_id=$this->Action_model->insert_data($comm_unit_array,'tbl_product_unit_details');
                                        $product_unit_detail_id_array[] = $product_unit_detail_id;
                                    }
                                }
                            }

                            if ($product_unit_detail_id_array) {
                               $this->Action_model->delete_query('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."' AND (product_unit_detail_id NOT IN (".implode(',', $product_unit_detail_id_array)."))");
                            }
                        }
                        else {
                            $this->Action_model->delete_query('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."'");
                        }
                }


                if($this->input->post('project_type')==2) {

                    if($this->input->post('property_type')==1 || $this->input->post('property_type')==7) {
                        if ($block) {
                            $block_id_array = array();

                            foreach ($block as $key => $value) {
                                $block_array = array(
                                    'block_name'=>$value['block_name'],
                                    'no_of_floor'=>$value['no_of_floor'],
                                    'no_of_flat'=>$value['no_of_flat'],
                                    'unit_per_floor'=>$value['unit_per_floor'],
                                    'no_of_ps_lift'=>$value['no_of_ps_lift'],
                                    'no_of_service_lift'=>$value['no_of_service_lift'],
                                    'edp'=>$value['edp']
                                );

                                if ($value['block_id']!='') {
                                    $block_id = $value['block_id'];
                                    $block_id_array[] = $block_id;

                                    $block_array['updated_at'] = time();

                                    $this->Action_model->update_data($block_array,'tbl_product_block_details',"block_id='".$block_id."'");
                                }
                                else {
                                    if ($value['block_name']) {
                                        $block_array['product_id'] = $id;
                                        $block_array['project_type'] = $this->input->post('project_type');
                                        $block_array['property_type'] = $this->input->post('property_type');
                                        $block_array['created_at'] = time();
                                        $block_array['updated_at'] = time();
                                        $block_id=$this->Action_model->insert_data($block_array,'tbl_product_block_details');
                                        $block_id_array[] = $block_id;
                                    }
                                }
                            }

                            if ($block_id_array) {
                               $this->Action_model->delete_query('tbl_product_block_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."' AND (block_id NOT IN (".implode(',', $block_id_array)."))");
                            }
                        }
                        else {
                            $this->Action_model->delete_query('tbl_product_block_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."'");
                        }



                        if ($flat_unit) {
                            $product_unit_detail_id_array = array();

                            foreach ($flat_unit as $key => $value) {

                                $image = "";
                                $unit_data = $this->Action_model->select_single('tbl_product_unit_details',"product_unit_detail_id='".$value['product_unit_detail_id']."'");
                                if ($unit_data) {
                                    $image = $unit_data->image;
                                }

                                $config['upload_path'] = './uploads/images/property/unit/';
                                $config['allowed_types']= 'jpg|png|jpeg';
                                $config['max_size']             = 5*1024;
                                $config['remove_spaces'] = TRUE;
                                $config['encrypt_name'] = TRUE;

                                $this->load->library('upload', $config);

                                $this->upload->initialize($config);

                                if (!empty($_FILES['flat_image_'.$key]['name'])) {
                                    if (!$this->upload->do_upload('flat_image_'.$key))
                                    { 
                                    }
                                    else
                                    { 
                                        if($unit_data && $unit_data->image && file_exists('./uploads/images/property/unit/'.$unit_data->image)){ unlink('./uploads/images/property/unit/'.$unit_data->image); }

                                        $image=$this->upload->data('file_name');
                                    }
                                }

                                $flat_unit_array = array(
                                    'code'=>$value['code'],
                                    'no_of_unit'=>$value['no_of_unit'],
                                    'ca'=>$value['ca'],
                                    'ba'=>$value['ba'],
                                    'sa'=>$value['sa'],
                                    'unit'=>$value['unit'],
                                    'no_of_bedroom'=>$value['no_of_bedroom'],
                                    'no_of_bathroom'=>$value['no_of_bathroom'],
                                    'accomodation'=>$value['accomodation'],
                                    'basic_cost'=>$value['basic_cost'],
                                    'charges'=>$value['charges'],
                                    'image'=>$image
                                );

                                if ($value['product_unit_detail_id']!='') {
                                    $product_unit_detail_id = $value['product_unit_detail_id'];
                                    $product_unit_detail_id_array[] = $product_unit_detail_id;

                                    $flat_unit_array['updated_at'] = time();

                                    $this->Action_model->update_data($flat_unit_array,'tbl_product_unit_details',"product_unit_detail_id='".$product_unit_detail_id."'");
                                }
                                else {
                                    if ($value['code']) {
                                        $flat_unit_array['product_id'] = $id;
                                        $flat_unit_array['project_type'] = $this->input->post('project_type');
                                        $flat_unit_array['property_type'] = $this->input->post('property_type');
                                        $flat_unit_array['created_at'] = time();
                                        $flat_unit_array['updated_at'] = time();
                                        $product_unit_detail_id=$this->Action_model->insert_data($flat_unit_array,'tbl_product_unit_details');
                                        $product_unit_detail_id_array[] = $product_unit_detail_id;
                                    }
                                }
                            }

                            if ($product_unit_detail_id_array) {

                                $unit_detail_imgs = $this->Action_model->detail_result('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."' AND (product_unit_detail_id NOT IN (".implode(',', $product_unit_detail_id_array)."))");
                                foreach ($unit_detail_imgs as $unit_detail_img) {
                                    if($unit_detail_img->image) { 
                                        unlink('./uploads/images/property/unit/'.$unit_detail_img->image);
                                    }
                                }
                               $this->Action_model->delete_query('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."' AND (product_unit_detail_id NOT IN (".implode(',', $product_unit_detail_id_array)."))");
                            }
                        }
                        else {
                            $unit_detail_imgs = $this->Action_model->detail_result('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."'");
                            foreach ($unit_detail_imgs as $unit_detail_img) {
                                if($unit_detail_img->image) { 
                                    unlink('./uploads/images/property/unit/'.$unit_detail_img->image);
                                }
                            }
                            $this->Action_model->delete_query('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."'");
                        }
                    }


                    if($this->input->post('property_type')==2) {
                        if ($villa_unit) {
                            $product_unit_detail_id_array = array();

                            foreach ($villa_unit as $key => $value) {

                                $image = "";
                                $unit_data = $this->Action_model->select_single('tbl_product_unit_details',"product_unit_detail_id='".$value['product_unit_detail_id']."'");
                                if ($unit_data) {
                                    $image = $unit_data->image;
                                }

                                $config['upload_path'] = './uploads/images/property/unit/';
                                $config['allowed_types']= 'jpg|png|jpeg';
                                $config['max_size']             = 5*1024;
                                $config['remove_spaces'] = TRUE;
                                $config['encrypt_name'] = TRUE;

                                $this->load->library('upload', $config);

                                $this->upload->initialize($config);

                                if (!empty($_FILES['villa_image_'.$key]['name'])) {
                                    if (!$this->upload->do_upload('villa_image_'.$key))
                                    { 
                                    }
                                    else
                                    { 
                                        if($unit_data && $unit_data->image && file_exists('./uploads/images/property/unit/'.$unit_data->image)){ unlink('./uploads/images/property/unit/'.$unit_data->image); }

                                        $image=$this->upload->data('file_name');
                                    }
                                }

                                $villa_unit_array = array(
                                    'code'=>$value['code'],
                                    'plot_size'=>$value['plot_size'],
                                    'plot_unit'=>$value['plot_unit'],
                                    'dimension'=>$value['dimension'],
                                    'facing'=>$value['facing'],
                                    'no_of_unit'=>$value['no_of_unit'],
                                    'accomodation'=>$value['accomodation'],
                                    'no_of_floor'=>$value['no_of_floor'],
                                    'construction_area'=>$value['construction_area'],
                                    'con_unit'=>$value['con_unit'],
                                    'no_of_bedroom'=>$value['no_of_bedroom'],
                                    'no_of_bathroom'=>$value['no_of_bathroom'],
                                    'no_of_unit'=>$value['no_of_unit'],
                                    'basic_cost'=>$value['basic_cost'],
                                    'charges'=>$value['charges'],
                                    'image'=>$image
                                );

                                if ($value['product_unit_detail_id']!='') {
                                    $product_unit_detail_id = $value['product_unit_detail_id'];
                                    $product_unit_detail_id_array[] = $product_unit_detail_id;

                                    $villa_unit_array['updated_at'] = time();

                                    $this->Action_model->update_data($villa_unit_array,'tbl_product_unit_details',"product_unit_detail_id='".$product_unit_detail_id."'");
                                }
                                else {
                                    if ($value['code']) {
                                        $villa_unit_array['product_id'] = $id;
                                        $villa_unit_array['project_type'] = $this->input->post('project_type');
                                        $villa_unit_array['property_type'] = $this->input->post('property_type');
                                        $villa_unit_array['created_at'] = time();
                                        $villa_unit_array['updated_at'] = time();
                                        $product_unit_detail_id=$this->Action_model->insert_data($villa_unit_array,'tbl_product_unit_details');
                                        $product_unit_detail_id_array[] = $product_unit_detail_id;
                                    }
                                }
                            }

                            if ($product_unit_detail_id_array) {

                                $unit_detail_imgs = $this->Action_model->detail_result('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."' AND (product_unit_detail_id NOT IN (".implode(',', $product_unit_detail_id_array)."))");
                                foreach ($unit_detail_imgs as $unit_detail_img) {
                                    if($unit_detail_img->image) { 
                                        unlink('./uploads/images/property/unit/'.$unit_detail_img->image);
                                    }
                                }
                               $this->Action_model->delete_query('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."' AND (product_unit_detail_id NOT IN (".implode(',', $product_unit_detail_id_array)."))");
                            }
                        }
                        else {
                            $unit_detail_imgs = $this->Action_model->detail_result('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."'");
                            foreach ($unit_detail_imgs as $unit_detail_img) {
                                if($unit_detail_img->image) { 
                                    unlink('./uploads/images/property/unit/'.$unit_detail_img->image);
                                }
                            }
                            $this->Action_model->delete_query('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."'");
                        }
                    }



                    if($this->input->post('property_type')==3) {
                        if ($plot_unit) {
                            $product_unit_detail_id_array = array();

                            foreach ($plot_unit as $key => $value) {

                                $image = "";
                                $unit_data = $this->Action_model->select_single('tbl_product_unit_details',"product_unit_detail_id='".$value['product_unit_detail_id']."'");
                                if ($unit_data) {
                                    $image = $unit_data->image;
                                }

                                $config['upload_path'] = './uploads/images/property/unit/';
                                $config['allowed_types']= 'jpg|png|jpeg';
                                $config['max_size']             = 5*1024;
                                $config['remove_spaces'] = TRUE;
                                $config['encrypt_name'] = TRUE;

                                $this->load->library('upload', $config);

                                $this->upload->initialize($config);

                                if (!empty($_FILES['plot_image_'.$key]['name'])) {
                                    if (!$this->upload->do_upload('plot_image_'.$key))
                                    { 
                                    }
                                    else
                                    { 
                                        if($unit_data && $unit_data->image && file_exists('./uploads/images/property/unit/'.$unit_data->image)){ unlink('./uploads/images/property/unit/'.$unit_data->image); }

                                        $image=$this->upload->data('file_name');
                                    }
                                }

                                $plot_unit_array = array(
                                    'code'=>$value['code'],
                                    'plot_size'=>$value['plot_size'],
                                    'plot_unit'=>$value['plot_unit'],
                                    'dimension'=>$value['dimension'],
                                    'facing'=>$value['facing'],
                                    'no_of_unit'=>$value['no_of_unit'],
                                    'basic_cost'=>$value['basic_cost'],
                                    'charges'=>$value['charges'],
                                    'image'=>$image
                                );

                                if ($value['product_unit_detail_id']!='') {
                                    $product_unit_detail_id = $value['product_unit_detail_id'];
                                    $product_unit_detail_id_array[] = $product_unit_detail_id;

                                    $plot_unit_array['updated_at'] = time();

                                    $this->Action_model->update_data($plot_unit_array,'tbl_product_unit_details',"product_unit_detail_id='".$product_unit_detail_id."'");
                                }
                                else {
                                    if ($value['code']) {
                                        $plot_unit_array['product_id'] = $id;
                                        $plot_unit_array['project_type'] = $this->input->post('project_type');
                                        $plot_unit_array['property_type'] = $this->input->post('property_type');
                                        $plot_unit_array['created_at'] = time();
                                        $plot_unit_array['updated_at'] = time();
                                        $product_unit_detail_id=$this->Action_model->insert_data($plot_unit_array,'tbl_product_unit_details');
                                        $product_unit_detail_id_array[] = $product_unit_detail_id;
                                    }
                                }
                            }

                            if ($product_unit_detail_id_array) {

                                $unit_detail_imgs = $this->Action_model->detail_result('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."' AND (product_unit_detail_id NOT IN (".implode(',', $product_unit_detail_id_array)."))");
                                foreach ($unit_detail_imgs as $unit_detail_img) {
                                    if($unit_detail_img->image) { 
                                        unlink('./uploads/images/property/unit/'.$unit_detail_img->image);
                                    }
                                }
                               $this->Action_model->delete_query('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."' AND (product_unit_detail_id NOT IN (".implode(',', $product_unit_detail_id_array)."))");
                            }
                        }
                        else {
                            $unit_detail_imgs = $this->Action_model->detail_result('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."'");
                            foreach ($unit_detail_imgs as $unit_detail_img) {
                                if($unit_detail_img->image) { 
                                    unlink('./uploads/images/property/unit/'.$unit_detail_img->image);
                                }
                            }
                            $this->Action_model->delete_query('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."'");
                        }
                    }
                }
                }

                $comm_blocks = array();
                $comm_block_data = $this->Action_model->detail_result('tbl_product_block_details',"product_id='".$id."' AND project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' ORDER BY block_id ASC");
                if ($comm_block_data) {
                    $comm_blocks = $comm_block_data;
                }

                $comm_units = array();
                $comm_unit_data = $this->Action_model->detail_result('tbl_product_unit_details',"product_id='".$id."' AND project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' ORDER BY product_unit_detail_id ASC");
                if ($comm_unit_data) {
                    $comm_units = $comm_unit_data;
                }

                $blocks = array();
                $block_data = $this->Action_model->detail_result('tbl_product_block_details',"product_id='".$id."' AND project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' ORDER BY block_id ASC");
                if ($block_data) {
                    $blocks = $block_data;
                }

               
                $product_flat_unit_details = array();
                $product_flat_unit_detail_data = $this->Action_model->detail_result('tbl_product_unit_details',"product_id='".$id."' AND project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' ORDER BY product_unit_detail_id ASC");
                if ($product_flat_unit_detail_data) {
                    $product_flat_unit_details = $product_flat_unit_detail_data;
                }

                $product_villa_unit_details = array();
                $product_villa_unit_detail_data = $this->Action_model->detail_result('tbl_product_unit_details',"product_id='".$id."' AND project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' ORDER BY product_unit_detail_id ASC");
                if ($product_villa_unit_detail_data) {
                    $product_villa_unit_details = $product_villa_unit_detail_data;
                }

                $product_plot_unit_details = array();
                $product_plot_unit_detail_data = $this->Action_model->detail_result('tbl_product_unit_details',"product_id='".$id."' AND project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' ORDER BY product_unit_detail_id ASC");
                if ($product_plot_unit_detail_data) {
                    $product_plot_unit_details = $product_plot_unit_detail_data;
                }

                $additional_details = array();
                $additional_detail_data = $this->Action_model->detail_result('tbl_product_additional_details',"product_id='".$id."' ORDER BY product_additional_detail_id ASC");
                if ($additional_detail_data) {
                    $additional_details = $additional_detail_data;
                }

                $plc_details = array();
                $plc_detail_data = $this->Action_model->detail_result('tbl_product_plc_details',"product_id='".$id."' ORDER BY product_plc_detail_id ASC");
                if ($plc_detail_data) {
                    $plc_details = $plc_detail_data;
                }

                $product_specifications = array();
                $product_specification_data = $this->Action_model->detail_result('tbl_product_specifications',"product_id='".$id."' ORDER BY product_specification_id ASC");
                if ($product_specification_data) {
                    $product_specifications = $product_specification_data;
                }

                $record = $this->Action_model->select_single('tbl_products',"product_id='".$id."'");

                $array = array('status'=>'success','message'=>'Project Updated Successfully!!','pid'=>$id,'blocks'=>$blocks,'product_flat_unit_details'=>$product_flat_unit_details,'product_villa_unit_details'=>$product_villa_unit_details,'product_plot_unit_details'=>$product_plot_unit_details,'record'=>$record,'additional_details'=>$additional_details,'plc_details'=>$plc_details,'product_specifications'=>$product_specifications,'comm_blocks'=>$comm_blocks,'comm_units'=>$comm_units);
            }
            else {


                $recordSlug = $this->Action_model->select_single('tbl_products',"slug='".$slug."'");
                if ($recordSlug) {
                    $slug .= $recordSlug->slug."-".time();
                }

                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();
                $record_array['slug'] = $slug;
                $record_array['product_status'] = 1;
                $record_array['date_register'] = date("d-m-Y");
                $id=$this->Action_model->insert_data($record_array,'tbl_products');

                if($this->input->post('project_type')==3) { 
                    if ($comm_block) {
                        $block_id_array = array();

                        foreach ($comm_block as $key => $value) {
                            $block_array = array(
                                'block_name'=>$value['block_name'],
                                'no_of_floor'=>$value['no_of_floor'],
                                'unit_per_floor'=>$value['unit_per_floor'],
                                'no_of_ps_lift'=>$value['no_of_ps_lift'],
                                'no_of_service_lift'=>$value['no_of_service_lift'],
                                'edp'=>$value['edp']
                            );

                            if ($value['block_id']!='') {
                                $block_id = $value['block_id'];
                                $block_id_array[] = $block_id;

                                $block_array['updated_at'] = time();

                                $this->Action_model->update_data($block_array,'tbl_product_block_details',"block_id='".$block_id."'");
                            }
                            else {
                                if ($value['block_name']) {
                                    $block_array['product_id'] = $id;
                                    $block_array['project_type'] = $this->input->post('project_type');
                                    $block_array['property_type'] = $this->input->post('property_type');
                                    $block_array['created_at'] = time();
                                    $block_array['updated_at'] = time();
                                    $block_id=$this->Action_model->insert_data($block_array,'tbl_product_block_details');
                                    $block_id_array[] = $block_id;
                                }
                            }
                        }

                        if ($block_id_array) {
                           $this->Action_model->delete_query('tbl_product_block_details',"product_id='".$id."' AND project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND (block_id NOT IN (".implode(',', $block_id_array)."))");
                        }
                    }
                    else {
                        $this->Action_model->delete_query('tbl_product_block_details',"product_id='".$id."' AND project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."'");
                    }

                    if ($comm_unit) {
                            $product_unit_detail_id_array = array();

                            foreach ($comm_unit as $key => $value) {

                                $unit_data = $this->Action_model->select_single('tbl_product_unit_details',"product_unit_detail_id='".$value['product_unit_detail_id']."'");

                                $comm_unit_array = array(
                                    'code'=>$value['code'],
                                    'no_of_unit'=>$value['no_of_unit'],
                                    'ca'=>$value['ca'],
                                    'ba'=>$value['ba'],
                                    'sa'=>$value['sa'],
                                    'unit'=>$value['unit'],
                                    'dimension'=>$value['dimension'],
                                    'sub_category'=>$value['sub_category']
                                );

                                if ($value['product_unit_detail_id']!='') {
                                    $product_unit_detail_id = $value['product_unit_detail_id'];
                                    $product_unit_detail_id_array[] = $product_unit_detail_id;

                                    $comm_unit_array['updated_at'] = time();

                                    $this->Action_model->update_data($comm_unit_array,'tbl_product_unit_details',"product_unit_detail_id='".$product_unit_detail_id."'");
                                }
                                else {
                                    if ($value['code']) {
                                        $comm_unit_array['product_id'] = $id;
                                        $comm_unit_array['project_type'] = $this->input->post('project_type');
                                        $comm_unit_array['property_type'] = $this->input->post('property_type');
                                        $comm_unit_array['created_at'] = time();
                                        $comm_unit_array['updated_at'] = time();
                                        $product_unit_detail_id=$this->Action_model->insert_data($comm_unit_array,'tbl_product_unit_details');
                                        $product_unit_detail_id_array[] = $product_unit_detail_id;
                                    }
                                }
                            }

                            if ($product_unit_detail_id_array) {
                               $this->Action_model->delete_query('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."' AND (product_unit_detail_id NOT IN (".implode(',', $product_unit_detail_id_array)."))");
                            }
                        }
                        else {
                            $this->Action_model->delete_query('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."'");
                        }
                }


                if($this->input->post('project_type')==2) {

                    if($this->input->post('property_type')==1 || $this->input->post('property_type')==7) {
                        if ($block) {
                            $block_id_array = array();

                            foreach ($block as $key => $value) {
                                $block_array = array(
                                    'block_name'=>$value['block_name'],
                                    'no_of_floor'=>$value['no_of_floor'],
                                    'no_of_flat'=>$value['no_of_flat'],
                                    'unit_per_floor'=>$value['unit_per_floor'],
                                    'no_of_ps_lift'=>$value['no_of_ps_lift'],
                                    'no_of_service_lift'=>$value['no_of_service_lift'],
                                    'edp'=>$value['edp']
                                );

                                if ($value['block_id']!='') {
                                    $block_id = $value['block_id'];
                                    $block_id_array[] = $block_id;

                                    $block_array['updated_at'] = time();

                                    $this->Action_model->update_data($block_array,'tbl_product_block_details',"block_id='".$block_id."'");
                                }
                                else {
                                    if ($value['block_name']) {
                                        $block_array['product_id'] = $id;
                                        $block_array['project_type'] = $this->input->post('project_type');
                                        $block_array['property_type'] = $this->input->post('property_type');
                                        $block_array['created_at'] = time();
                                        $block_array['updated_at'] = time();
                                        $block_id=$this->Action_model->insert_data($block_array,'tbl_product_block_details');
                                        $block_id_array[] = $block_id;
                                    }
                                }
                            }

                            if ($block_id_array) {
                               $this->Action_model->delete_query('tbl_product_block_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."' AND (block_id NOT IN (".implode(',', $block_id_array)."))");
                            }
                        }
                        else {
                            $this->Action_model->delete_query('tbl_product_block_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."'");
                        }



                        if ($flat_unit) {
                            $product_unit_detail_id_array = array();

                            foreach ($flat_unit as $key => $value) {

                                $image = "";
                                $unit_data = $this->Action_model->select_single('tbl_product_unit_details',"product_unit_detail_id='".$value['product_unit_detail_id']."'");
                                if ($unit_data) {
                                    $image = $unit_data->image;
                                }

                                $config['upload_path'] = './uploads/images/property/unit/';
                                $config['allowed_types']= 'jpg|png|jpeg';
                                $config['max_size']             = 5*1024;
                                $config['remove_spaces'] = TRUE;
                                $config['encrypt_name'] = TRUE;

                                $this->load->library('upload', $config);

                                $this->upload->initialize($config);

                                if (!empty($_FILES['flat_image_'.$key]['name'])) {
                                    if (!$this->upload->do_upload('flat_image_'.$key))
                                    { 
                                    }
                                    else
                                    { 
                                        if($unit_data && $unit_data->image && file_exists('./uploads/images/property/unit/'.$unit_data->image)){ unlink('./uploads/images/property/unit/'.$unit_data->image); }

                                        $image=$this->upload->data('file_name');
                                    }
                                }

                                $flat_unit_array = array(
                                    'code'=>$value['code'],
                                    'no_of_unit'=>$value['no_of_unit'],
                                    'ca'=>$value['ca'],
                                    'ba'=>$value['ba'],
                                    'sa'=>$value['sa'],
                                    'unit'=>$value['unit'],
                                    'no_of_bedroom'=>$value['no_of_bedroom'],
                                    'no_of_bathroom'=>$value['no_of_bathroom'],
                                    'accomodation'=>$value['accomodation'],
                                    'basic_cost'=>$value['basic_cost'],
                                    'charges'=>$value['charges'],
                                    'image'=>$image
                                );

                                if ($value['product_unit_detail_id']!='') {
                                    $product_unit_detail_id = $value['product_unit_detail_id'];
                                    $product_unit_detail_id_array[] = $product_unit_detail_id;

                                    $flat_unit_array['updated_at'] = time();

                                    $this->Action_model->update_data($flat_unit_array,'tbl_product_unit_details',"product_unit_detail_id='".$product_unit_detail_id."'");
                                }
                                else {
                                    if ($value['code']) {
                                        $flat_unit_array['product_id'] = $id;
                                        $flat_unit_array['project_type'] = $this->input->post('project_type');
                                        $flat_unit_array['property_type'] = $this->input->post('property_type');
                                        $flat_unit_array['created_at'] = time();
                                        $flat_unit_array['updated_at'] = time();
                                        $product_unit_detail_id=$this->Action_model->insert_data($flat_unit_array,'tbl_product_unit_details');
                                        $product_unit_detail_id_array[] = $product_unit_detail_id;
                                    }
                                }
                            }

                            if ($product_unit_detail_id_array) {

                                $unit_detail_imgs = $this->Action_model->detail_result('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."' AND (product_unit_detail_id NOT IN (".implode(',', $product_unit_detail_id_array)."))");
                                foreach ($unit_detail_imgs as $unit_detail_img) {
                                    if($unit_detail_img->image) { 
                                        unlink('./uploads/images/property/unit/'.$unit_detail_img->image);
                                    }
                                }
                               $this->Action_model->delete_query('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."' AND (product_unit_detail_id NOT IN (".implode(',', $product_unit_detail_id_array)."))");
                            }
                        }
                        else {
                            $unit_detail_imgs = $this->Action_model->detail_result('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."'");
                            foreach ($unit_detail_imgs as $unit_detail_img) {
                                if($unit_detail_img->image) { 
                                    unlink('./uploads/images/property/unit/'.$unit_detail_img->image);
                                }
                            }
                            $this->Action_model->delete_query('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."'");
                        }
                    }


                    if($this->input->post('property_type')==2) {
                        if ($villa_unit) {
                            $product_unit_detail_id_array = array();

                            foreach ($villa_unit as $key => $value) {

                                $image = "";
                                $unit_data = $this->Action_model->select_single('tbl_product_unit_details',"product_unit_detail_id='".$value['product_unit_detail_id']."'");
                                if ($unit_data) {
                                    $image = $unit_data->image;
                                }

                                $config['upload_path'] = './uploads/images/property/unit/';
                                $config['allowed_types']= 'jpg|png|jpeg';
                                $config['max_size']             = 5*1024;
                                $config['remove_spaces'] = TRUE;
                                $config['encrypt_name'] = TRUE;

                                $this->load->library('upload', $config);

                                $this->upload->initialize($config);

                                if (!empty($_FILES['villa_image_'.$key]['name'])) {
                                    if (!$this->upload->do_upload('villa_image_'.$key))
                                    { 
                                    }
                                    else
                                    { 
                                        if($unit_data && $unit_data->image && file_exists('./uploads/images/property/unit/'.$unit_data->image)){ unlink('./uploads/images/property/unit/'.$unit_data->image); }

                                        $image=$this->upload->data('file_name');
                                    }
                                }

                                $villa_unit_array = array(
                                    'code'=>$value['code'],
                                    'plot_size'=>$value['plot_size'],
                                    'plot_unit'=>$value['plot_unit'],
                                    'dimension'=>$value['dimension'],
                                    'facing'=>$value['facing'],
                                    'no_of_unit'=>$value['no_of_unit'],
                                    'accomodation'=>$value['accomodation'],
                                    'no_of_floor'=>$value['no_of_floor'],
                                    'construction_area'=>$value['construction_area'],
                                    'con_unit'=>$value['con_unit'],
                                    'no_of_bedroom'=>$value['no_of_bedroom'],
                                    'no_of_bathroom'=>$value['no_of_bathroom'],
                                    'no_of_unit'=>$value['no_of_unit'],
                                    'basic_cost'=>$value['basic_cost'],
                                    'charges'=>$value['charges'],
                                    'image'=>$image
                                );

                                if ($value['product_unit_detail_id']!='') {
                                    $product_unit_detail_id = $value['product_unit_detail_id'];
                                    $product_unit_detail_id_array[] = $product_unit_detail_id;

                                    $villa_unit_array['updated_at'] = time();

                                    $this->Action_model->update_data($villa_unit_array,'tbl_product_unit_details',"product_unit_detail_id='".$product_unit_detail_id."'");
                                }
                                else {
                                    if ($value['code']) {
                                        $villa_unit_array['product_id'] = $id;
                                        $villa_unit_array['project_type'] = $this->input->post('project_type');
                                        $villa_unit_array['property_type'] = $this->input->post('property_type');
                                        $villa_unit_array['created_at'] = time();
                                        $villa_unit_array['updated_at'] = time();
                                        $product_unit_detail_id=$this->Action_model->insert_data($villa_unit_array,'tbl_product_unit_details');
                                        $product_unit_detail_id_array[] = $product_unit_detail_id;
                                    }
                                }
                            }

                            if ($product_unit_detail_id_array) {

                                $unit_detail_imgs = $this->Action_model->detail_result('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."' AND (product_unit_detail_id NOT IN (".implode(',', $product_unit_detail_id_array)."))");
                                foreach ($unit_detail_imgs as $unit_detail_img) {
                                    if($unit_detail_img->image) { 
                                        unlink('./uploads/images/property/unit/'.$unit_detail_img->image);
                                    }
                                }
                               $this->Action_model->delete_query('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."' AND (product_unit_detail_id NOT IN (".implode(',', $product_unit_detail_id_array)."))");
                            }
                        }
                        else {
                            $unit_detail_imgs = $this->Action_model->detail_result('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."'");
                            foreach ($unit_detail_imgs as $unit_detail_img) {
                                if($unit_detail_img->image) { 
                                    unlink('./uploads/images/property/unit/'.$unit_detail_img->image);
                                }
                            }
                            $this->Action_model->delete_query('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."'");
                        }
                    }



                    if($this->input->post('property_type')==3) {
                        if ($plot_unit) {
                            $product_unit_detail_id_array = array();

                            foreach ($plot_unit as $key => $value) {

                                $image = "";
                                $unit_data = $this->Action_model->select_single('tbl_product_unit_details',"product_unit_detail_id='".$value['product_unit_detail_id']."'");
                                if ($unit_data) {
                                    $image = $unit_data->image;
                                }

                                $config['upload_path'] = './uploads/images/property/unit/';
                                $config['allowed_types']= 'jpg|png|jpeg';
                                $config['max_size']             = 5*1024;
                                $config['remove_spaces'] = TRUE;
                                $config['encrypt_name'] = TRUE;

                                $this->load->library('upload', $config);

                                $this->upload->initialize($config);

                                if (!empty($_FILES['plot_image_'.$key]['name'])) {
                                    if (!$this->upload->do_upload('plot_image_'.$key))
                                    { 
                                    }
                                    else
                                    { 
                                        if($unit_data && $unit_data->image && file_exists('./uploads/images/property/unit/'.$unit_data->image)){ unlink('./uploads/images/property/unit/'.$unit_data->image); }

                                        $image=$this->upload->data('file_name');
                                    }
                                }

                                $plot_unit_array = array(
                                    'code'=>$value['code'],
                                    'plot_size'=>$value['plot_size'],
                                    'plot_unit'=>$value['plot_unit'],
                                    'dimension'=>$value['dimension'],
                                    'facing'=>$value['facing'],
                                    'no_of_unit'=>$value['no_of_unit'],
                                    'basic_cost'=>$value['basic_cost'],
                                    'charges'=>$value['charges'],
                                    'image'=>$image
                                );

                                if ($value['product_unit_detail_id']!='') {
                                    $product_unit_detail_id = $value['product_unit_detail_id'];
                                    $product_unit_detail_id_array[] = $product_unit_detail_id;

                                    $plot_unit_array['updated_at'] = time();

                                    $this->Action_model->update_data($plot_unit_array,'tbl_product_unit_details',"product_unit_detail_id='".$product_unit_detail_id."'");
                                }
                                else {
                                    if($value['code']){
                                        $plot_unit_array['product_id'] = $id;
                                        $plot_unit_array['project_type'] = $this->input->post('project_type');
                                        $plot_unit_array['property_type'] = $this->input->post('property_type');
                                        $plot_unit_array['created_at'] = time();
                                        $plot_unit_array['updated_at'] = time();
                                        $product_unit_detail_id=$this->Action_model->insert_data($plot_unit_array,'tbl_product_unit_details');
                                        $product_unit_detail_id_array[] = $product_unit_detail_id;
                                    }
                                }
                            }

                            if ($product_unit_detail_id_array) {

                                $unit_detail_imgs = $this->Action_model->detail_result('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."' AND (product_unit_detail_id NOT IN (".implode(',', $product_unit_detail_id_array)."))");
                                foreach ($unit_detail_imgs as $unit_detail_img) {
                                    if($unit_detail_img->image) { 
                                        unlink('./uploads/images/property/unit/'.$unit_detail_img->image);
                                    }
                                }
                               $this->Action_model->delete_query('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."' AND (product_unit_detail_id NOT IN (".implode(',', $product_unit_detail_id_array)."))");
                            }
                        }
                        else {
                            $unit_detail_imgs = $this->Action_model->detail_result('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."'");
                            foreach ($unit_detail_imgs as $unit_detail_img) {
                                if($unit_detail_img->image) { 
                                    unlink('./uploads/images/property/unit/'.$unit_detail_img->image);
                                }
                            }
                            $this->Action_model->delete_query('tbl_product_unit_details',"project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' AND product_id='".$id."'");
                        }
                    }
                }

                $comm_blocks = array();
                $comm_block_data = $this->Action_model->detail_result('tbl_product_block_details',"product_id='".$id."' AND project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' ORDER BY block_id ASC");
                if ($comm_block_data) {
                    $comm_blocks = $comm_block_data;
                }

                $comm_units = array();
                $comm_unit_data = $this->Action_model->detail_result('tbl_product_unit_details',"product_id='".$id."' AND project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' ORDER BY product_unit_detail_id ASC");
                if ($comm_unit_data) {
                    $comm_units = $comm_unit_data;
                }

                $blocks = array();
                $block_data = $this->Action_model->detail_result('tbl_product_block_details',"product_id='".$id."' AND project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' ORDER BY block_id ASC");
                if ($block_data) {
                    $blocks = $block_data;
                }

               
                $product_flat_unit_details = array();
                $product_flat_unit_detail_data = $this->Action_model->detail_result('tbl_product_unit_details',"product_id='".$id."' AND project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' ORDER BY product_unit_detail_id ASC");
                if ($product_flat_unit_detail_data) {
                    $product_flat_unit_details = $product_flat_unit_detail_data;
                }

                $product_villa_unit_details = array();
                $product_villa_unit_detail_data = $this->Action_model->detail_result('tbl_product_unit_details',"product_id='".$id."' AND project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' ORDER BY product_unit_detail_id ASC");
                if ($product_villa_unit_detail_data) {
                    $product_villa_unit_details = $product_villa_unit_detail_data;
                }

                $product_plot_unit_details = array();
                $product_plot_unit_detail_data = $this->Action_model->detail_result('tbl_product_unit_details',"product_id='".$id."' AND project_type='".$this->input->post('project_type')."' AND property_type='".$this->input->post('property_type')."' ORDER BY product_unit_detail_id ASC");
                if ($product_plot_unit_detail_data) {
                    $product_plot_unit_details = $product_plot_unit_detail_data;
                }

                $additional_details = array();
                $additional_detail_data = $this->Action_model->detail_result('tbl_product_additional_details',"product_id='".$id."' ORDER BY product_additional_detail_id ASC");
                if ($additional_detail_data) {
                    $additional_details = $additional_detail_data;
                }

                $plc_details = array();
                $plc_detail_data = $this->Action_model->detail_result('tbl_product_plc_details',"product_id='".$id."' ORDER BY product_plc_detail_id ASC");
                if ($plc_detail_data) {
                    $plc_details = $plc_detail_data;
                }

                $product_specifications = array();
                $product_specification_data = $this->Action_model->detail_result('tbl_product_specifications',"product_id='".$id."' ORDER BY product_specification_id ASC");
                if ($product_specification_data) {
                    $product_specifications = $product_specification_data;
                }

                $record = $this->Action_model->select_single('tbl_products',"product_id='".$id."'");

                $array = array('status'=>'success','message'=>'Project Added Successfully!!','pid'=>$id,'blocks'=>$blocks,'product_flat_unit_details'=>$product_flat_unit_details,'product_villa_unit_details'=>$product_villa_unit_details,'product_plot_unit_details'=>$product_plot_unit_details,'record'=>$record,'additional_details'=>$additional_details,'plc_details'=>$plc_details,'product_specifications'=>$product_specifications,'comm_blocks'=>$comm_blocks,'comm_units'=>$comm_units);
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function product_save2()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $parking_type = $this->input->post('parking_type');
            $record = $this->Action_model->select_single('tbl_products',"product_id='".$id."'");

            $b_cost_gst = 0.00;
            if ($this->input->post('b_cost_gst_check')) {
                $b_cost_gst = $this->input->post('b_cost_gst');
            }

            $club_gst = 0.00;
            if ($this->input->post('club_gst_check')) {
                $club_gst = $this->input->post('club_gst');
            }

            $parking_gst = 0.00;
            if ($this->input->post('parking_gst_check')) {
                $parking_gst = $this->input->post('parking_gst');
            }

            $amenitie = "";
            $amenitie_array = $this->input->post('amenitie');
            if ($amenitie_array) {
                $amenitie = implode(",", $amenitie_array);
            }

            $finance = "";
            $finance_array = $this->input->post('finance');
            if ($finance_array) {
                $finance = implode(",", $finance_array);
            }

            $record_array = array(
                'b_cost_gst'=>$b_cost_gst,
                'b_cost_unit'=>$this->input->post('b_cost_unit'),
                'club_cost_unit'=>$this->input->post('club_cost_unit'),
                'club_gst'=>$club_gst,
                'o_price'=>$this->input->post('o_price'),
                's_price'=>$this->input->post('s_price'),
                'b_price'=>$this->input->post('b_price'),
                'parking_open'=>$this->input->post('parking_open'),
                'parking_stilt'=>$this->input->post('parking_stilt'),
                'parking_basment'=>$this->input->post('parking_basment'),
                'parking_gst'=>$parking_gst,
                'amenitie'=>$amenitie,
                'finance'=>$finance
            );

            if ($record) {
                if ($this->input->post('view_only')!=1) {
                $record_array['updated_at'] = time();
                $this->Action_model->update_data($record_array,'tbl_products',"product_id='".$id."'");


                $add_detail=$this->input->post('add_detail');
                if ($add_detail) {
                    $product_additional_detail_id_array = array();

                    foreach ($add_detail as $key => $value) {

                        $id=$this->input->post('id');
                        $unit_data = $this->Action_model->select_single('tbl_product_additional_details',"product_id='".$id."' AND product_additional_detail_id='".$value['product_additional_detail_id']."'");

                        $gst = 0.00;
                        if (isset($value['gst_check'])) {
                            $gst = $this->input->post('gst');
                        }

                        $add_detail_array = array(
                            'price_comp_id'=>$value['price_comp_id'],
                            'gst'=>$value['gst'],
                            'price'=>$value['price'],
                            'unit'=>$value['unit']
                        );

                        if ($value['product_additional_detail_id']!='') {
                            $product_additional_detail_id = $value['product_additional_detail_id'];
                            $product_additional_detail_id_array[] = $product_additional_detail_id;

                            $add_detail_array['updated_at'] = time();

                            $this->Action_model->update_data($add_detail_array,'tbl_product_additional_details',"product_id='".$id."' 
                                AND product_additional_detail_id='".$product_additional_detail_id."'");
                        }
                        else {
                            $add_detail_array['product_id'] = $id;
                            $add_detail_array['created_at'] = time();
                            $add_detail_array['updated_at'] = time();
                            $product_additional_detail_id=$this->Action_model->insert_data($add_detail_array,'tbl_product_additional_details');
                            $product_additional_detail_id_array[] = $product_additional_detail_id;
                        }
                    }

                    if ($product_additional_detail_id_array) {

                       $this->Action_model->delete_query('tbl_product_additional_details',"product_id='".$id."' AND (product_additional_detail_id NOT IN (".implode(',', $product_additional_detail_id_array)."))");
                    }
                }
                else {
                    $this->Action_model->delete_query('tbl_product_additional_details',"product_id='".$id."'");
                }

                $plc_detail=$this->input->post('plc_detail');
                if ($plc_detail) {
                    $product_plc_detail_id_array = array();

                    foreach ($plc_detail as $key => $value) {

                        $id=$this->input->post('id');
                        $unit_data = $this->Action_model->select_single('tbl_product_plc_details',"product_id='".$id."' AND product_plc_detail_id='".$value['product_plc_detail_id']."'");

                        $gst = 0.00;
                        if (isset($value['gst_check'])) {
                            $gst = $this->input->post('gst');
                        }

                        $plc_detail_array = array(
                            'price_comp_id'=>$value['price_comp_id'],
                            'gst'=>$value['gst'],
                            'price'=>$value['price'],
                            'unit'=>$value['unit']
                        );

                        if ($value['product_plc_detail_id']!='') {
                            $product_plc_detail_id = $value['product_plc_detail_id'];
                            $product_plc_detail_id_array[] = $product_plc_detail_id;

                            $plc_detail_array['updated_at'] = time();

                            $this->Action_model->update_data($plc_detail_array,'tbl_product_plc_details',"product_id='".$id."' 
                                AND product_plc_detail_id='".$product_plc_detail_id."'");
                        }
                        else {
                            $plc_detail_array['product_id'] = $id;
                            $plc_detail_array['created_at'] = time();
                            $plc_detail_array['updated_at'] = time();
                            $product_plc_detail_id=$this->Action_model->insert_data($plc_detail_array,'tbl_product_plc_details');
                            $product_plc_detail_id_array[] = $product_plc_detail_id;
                        }
                    }

                    if ($product_plc_detail_id_array) {

                       $this->Action_model->delete_query('tbl_product_plc_details',"product_id='".$id."' AND (product_plc_detail_id NOT IN (".implode(',', $product_plc_detail_id_array)."))");
                    }
                }
                else {
                    $this->Action_model->delete_query('tbl_product_plc_details',"product_id='".$id."'");
                }

                $spec=$this->input->post('spec');
                if ($spec) {
                    $product_specification_id_array = array();

                    foreach ($spec as $key => $value) {

                        $id=$this->input->post('id');
                        $unit_data = $this->Action_model->select_single('tbl_product_specifications',"product_id='".$id."' AND product_specification_id='".$value['product_specification_id']."'");

                        $spec_array = array(
                            'specification_id'=>$value['specification_id'],
                            'description'=>$value['description']
                        );

                        if ($value['product_specification_id']!='') {
                            $product_specification_id = $value['product_specification_id'];
                            $product_specification_id_array[] = $product_specification_id;

                            $spec_array['updated_at'] = time();

                            $this->Action_model->update_data($spec_array,'tbl_product_specifications',"product_id='".$id."' 
                                AND product_specification_id='".$product_specification_id."'");
                        }
                        else {
                            $spec_array['product_id'] = $id;
                            $spec_array['created_at'] = time();
                            $spec_array['updated_at'] = time();
                            $product_specification_id=$this->Action_model->insert_data($spec_array,'tbl_product_specifications');
                            $product_specification_id_array[] = $product_specification_id;
                        }
                    }

                    if ($product_specification_id_array) {

                       $this->Action_model->delete_query('tbl_product_specifications',"product_id='".$id."' AND (product_specification_id NOT IN (".implode(',', $product_specification_id_array)."))");
                    }
                }
                else {
                    $this->Action_model->delete_query('tbl_product_specifications',"product_id='".$id."'");
                }
                }



                $product_add_detail_details = array();
                $product_add_detail_detail_data = $this->Action_model->detail_result('tbl_product_additional_details',"product_id='".$id."' ORDER BY product_additional_detail_id ASC");
                if ($product_add_detail_detail_data) {
                    $product_add_detail_details = $product_add_detail_detail_data;
                }



                $product_plc_detail_details = array();
                $product_plc_detail_detail_data = $this->Action_model->detail_result('tbl_product_plc_details',"product_id='".$id."' ORDER BY product_plc_detail_id ASC");
                if ($product_plc_detail_detail_data) {
                    $product_plc_detail_details = $product_plc_detail_detail_data;
                }

                $product_specification_details = array();
                $product_specification_detail_data = $this->Action_model->detail_result('tbl_product_specifications',"product_id='".$id."' ORDER BY product_specification_id ASC");
                if ($product_specification_detail_data) {
                    $product_specification_details = $product_specification_detail_data;
                }

                $record = $this->Action_model->select_single('tbl_products',"product_id='".$id."'");

                $product_images = array();
                $product_image_detail_data = $this->Action_model->detail_result('tbl_product_images',"product_id='".$id."' ORDER BY product_image_id ASC");
                if ($product_image_detail_data) {
                    $product_images = $product_image_detail_data;
                }

                $array = array('status'=>'success','message'=>'Success','additional_details'=>$product_add_detail_details,'plc_details'=>$product_plc_detail_details,'product_specifications'=>$product_specification_details,'record'=>$record,'product_images'=>$product_images);
            }
            else { 
               $array = array('status'=>'error','message'=>'Not Found');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function product_save3()
    {
        $array = array();

        if ($this->input->post()) {
            $banner_image = "";
            $project_logo = "";
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_products',"product_id='".$id."'");

            if ($record) {
                $banner_image = $record->banner_image;
                $project_logo = $record->project_logo;
            }

            $config['upload_path'] = './uploads/images/project/banner/';
            $config['allowed_types']= 'jpg|png|jpeg';
            $config['max_size']             = 5*1024;
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if (!empty($_FILES['banner_image']['name'])) {
                if (!$this->upload->do_upload('banner_image'))
                { 
                }
                else
                { 
                    if($record && $record->banner_image && file_exists('./uploads/images/project/banner/'.$record->banner_image)){ unlink('./uploads/images/project/banner/'.$record->banner_image); }

                    $banner_image=$this->upload->data('file_name');
                }
            }

            $config['upload_path'] = './uploads/images/project/logo/';
            $config['allowed_types']= 'jpg|png|jpeg';
            $config['max_size']             = 5*1024;
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if (!empty($_FILES['project_logo']['name'])) {
                if (!$this->upload->do_upload('project_logo'))
                { 
                }
                else
                { 
                    if($record && $record->project_logo && file_exists('./uploads/images/project/logo/'.$record->project_logo)){ unlink('./uploads/images/project/logo/'.$record->project_logo); }

                    $project_logo=$this->upload->data('file_name');
                }
            }

            $config['upload_path'] = './uploads/images/project/image/';
            $config['allowed_types']= 'jpg|png|jpeg';
            $config['max_size']             = 5*1024;
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            $project_images=array();
            $project_image_id=$this->input->post('project_image_id');
            if ($project_image_id) {
                foreach ($project_image_id as $key => $value) {
                   if (!empty($_FILES['project_image_'.$key]['name'])) {
                        if (!$this->upload->do_upload('project_image_'.$key))
                        { 
                        }
                        else
                        {
                            $image=$this->upload->data('file_name');
                            $project_images[]=array('product_id'=>$id,'product_image'=>$image,'product_image_status'=>'1','created_at'=>time(),'updated_at'=>time());
                        }
                    }
                }
            }

            $record_array = array(
                'authority_approval'=>$this->input->post('authority_approval'),
                'cc_certificate'=>$this->input->post('cc_certificate'),
                'oc_certificate'=>$this->input->post('oc_certificate'),
                'description'=>$this->input->post('description'),
                'banner_image'=>$banner_image,
                'project_logo'=>$project_logo
            );

            if ($record) {
                $record_array['updated_at'] = time();
                $this->Action_model->update_data($record_array,'tbl_products',"product_id='".$id."'");

                if ($project_images) {
                    $this->db->insert_batch('tbl_product_images', $project_images); 
                }

                $message = "Project has been updated successfully!";
                $this->session->set_flashdata('success_msg', $message);
                $array = array('status'=>'success','message'=> $message);
            }
            else { 
               $array = array('status'=>'error','message'=>'Not Found');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

     public function delete_product_image()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_product_images',"product_image_id='".$id."'");

            if ($record) {
                if($record && $record->product_image && file_exists('./uploads/images/project/image/'.$record->product_image)){ unlink('./uploads/images/project/image/'.$record->product_image); }
                $this->Action_model->delete_query('tbl_product_images',"product_image_id='".$id."'");

                $message = "Image Deleted Successfully!";
                $array = array('status'=>'success','message'=> $message);
            }
            else { 
               $array = array('status'=>'error','message'=>'Image Not Found');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function product_list(){
     
        $postData = $this->input->post();
        $select = 'product_id,project_name,product_status,tbl_products.date_register as date_register,product_type_name,unit_type_name,project_status_name,location,city_name,state_name,location_name,firm_name,agent_id';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "project_name!=''";
         if($searchValue != ''){
            $searchQuery = " AND (project_name like '%".$searchValue."%' ) ";
         }

         $search_by = $this->input->post('search_by');
         $builder_group_id = $this->input->post('builder_group_id');
         $builder_id = $this->input->post('builder_id');
         $agent_id = $this->input->post('agent_id');
         $project_type = $this->input->post('project_type');
         $property_type = $this->input->post('property_type');
         $project_status = $this->input->post('project_status');
         $state_id = $this->input->post('state_id');
         $city_id = $this->input->post('city_id');
         $location = $this->input->post('location');

         if ($search_by) {
                $searchQuery .= " AND tbl_products.project_name LIKE '%".$search_by."%'";
         }
         if ($builder_group_id) {
                $searchQuery .= " AND tbl_products.builder_group_id='".$builder_group_id."'";
         }
         if ($builder_id) {
                $searchQuery .= " AND tbl_products.builder_id='".$builder_id."'";
         }
         if ($agent_id) {
                $searchQuery .= " AND tbl_products.agent_id='".$agent_id."'";
         }
         if ($project_type) {
                $searchQuery .= " AND tbl_products.project_type='".$project_type."'";
         }
         if ($property_type) {
                $searchQuery .= " AND tbl_products.property_type='".$property_type."'";
         }
         if ($project_status) {
            $searchQuery .= " AND tbl_products.project_status='".$project_status."'";
         }
         if ($state_id) {
                $searchQuery .= " AND tbl_products.state_id='".$state_id."'";
         }
         if ($city_id) {
                $searchQuery .= " AND tbl_products.city_id='".$city_id."'";
         }
         if ($location) {
                $searchQuery .= " AND tbl_products.location='".$location."'";
         }
        $data = $this->Action_model->ajaxDatatableLeft($postData,$searchQuery,'tbl_products',$where,$select,array('tbl_product_types','tbl_product_types.product_type_id=tbl_products.project_type','tbl_unit_types','tbl_unit_types.unit_type_id=tbl_products.property_type' ,'tbl_project_status','tbl_project_status.project_status_id=tbl_products.project_status','tbl_city','tbl_city.city_id=tbl_products.city_id','tbl_states','tbl_states.state_id=tbl_products.state_id','tbl_locations','tbl_locations.location_id=tbl_products.location','tbl_builders','tbl_builders.builder_id=tbl_products.builder_id'));

        echo json_encode($data);
    }

    public function get_builders()
    {
        $array = array();
        $builder_list = array();

        if ($this->input->post()) {
            $builder_group_id=$this->input->post('builder_group_id');
            $where = "builder_group_id='".$builder_group_id."' AND builder_status='1'";
            $builder_data = $this->Action_model->detail_result('tbl_builders',$where,'builder_id,firm_name');
            if ($builder_data) {
                $builder_list = $builder_data;
            }
            $array = array('status'=>'success','message'=>'Data Found','builder_list'=>$builder_list);
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function get_unit_types()
    {
        $array = array();
        $unit_type_list = array();

        if ($this->input->post()) {
            $product_type_id=$this->input->post('product_type_id');
            $where = "product_type_id='".$product_type_id."' AND unit_type_status='1'";
            $unit_type_data = $this->Action_model->detail_result('tbl_unit_types',$where,'unit_type_id,unit_type_name');
            if ($unit_type_data) {
                $unit_type_list = $unit_type_data;
            }
            $array = array('status'=>'success','message'=>'Data Found','unit_type_list'=>$unit_type_list);
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function get_unit_details()
    {
        $array = array();
        $unit_details = array();
        $comm_block_details = array();

        if ($this->input->post()) {
            $project_type=$this->input->post('project_type');
            $property_type=$this->input->post('property_type');
            $product_id=$this->input->post('product_id');
            $where = "project_type='".$project_type."' AND property_type='".$property_type."' AND product_id='".$product_id."'";
            $unit_detail_data = $this->Action_model->detail_result('tbl_product_unit_details',$where,'*');
            if ($unit_detail_data) {
                $unit_details = $unit_detail_data;
            }

            $comm_block_data = $this->Action_model->detail_result('tbl_product_block_details',$where,'*');
            if ($comm_block_data) {
                $comm_block_details = $comm_block_data;
            }

            $blocks = array();
            $block_data = $this->Action_model->detail_result('tbl_product_block_details',"project_type='".$project_type."' AND property_type='".$property_type."' AND product_id='".$product_id."' ORDER BY block_id ASC");
            if ($block_data) {
                $blocks = $block_data;
            }

           
            $product_flat_unit_details = array();
            $product_flat_unit_detail_data = $this->Action_model->detail_result('tbl_product_unit_details',"project_type='".$project_type."' AND property_type='".$property_type."' AND product_id='".$product_id."' ORDER BY product_unit_detail_id ASC");
            if ($product_flat_unit_detail_data) {
                $product_flat_unit_details = $product_flat_unit_detail_data;
            }

            $product_villa_unit_details = array();
            $product_villa_unit_detail_data = $this->Action_model->detail_result('tbl_product_unit_details',"project_type='".$project_type."' AND property_type='".$property_type."' AND product_id='".$product_id."' ORDER BY product_unit_detail_id ASC");
            if ($product_villa_unit_detail_data) {
                $product_villa_unit_details = $product_villa_unit_detail_data;
            }

            $product_plot_unit_details = array();
            $product_plot_unit_detail_data = $this->Action_model->detail_result('tbl_product_unit_details',"project_type='".$project_type."' AND property_type='".$property_type."' AND product_id='".$product_id."' ORDER BY product_unit_detail_id ASC");
            if ($product_plot_unit_detail_data) {
                $product_plot_unit_details = $product_plot_unit_detail_data;
            }

            $array = array('status'=>'success','message'=>'Data Found','unit_details'=>$unit_details,'comm_block_details'=>$comm_block_details,'blocks'=>$blocks,'product_flat_unit_details'=>$product_flat_unit_details,'product_villa_unit_details'=>$product_villa_unit_details,'product_plot_unit_details'=>$product_plot_unit_details);
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function get_locations()
    {
        $array = array();
        $location_list = array();

        if ($this->input->post()) {
            $city_id=$this->input->post('city_id');
            $where = "city_id='".$city_id."' AND location_status='1'";
            $location_data = $this->Action_model->detail_result('tbl_locations',$where,'location_id,location_name');
            if ($location_data) {
                $location_list = $location_data;
            }
            $array = array('status'=>'success','message'=>'Data Found','location_list'=>$location_list);
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }


    public function update_password()
    {
        $array = array();

        if ($this->input->post()) {
            
            $current_password=md5($this->input->post('current_password'));

            $where = "user_hash='".$this->session->userdata('admin_user_hash')."' AND password='".$current_password."'";
            $user_detail = $this->Action_model->select_single('tbl_users',$where);

            $record_array = array(
                'password'=>md5($this->input->post('password'))
            );

            if ($user_detail) {
                $this->Action_model->update_data($record_array,'tbl_users',$where);
                $array = array('status'=>'success','message'=>'Password Updated Successfully!!');
            }
            else {
                $array = array('status'=>'error','message'=>'Invalid Current Password!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function update_profile()
    {
        $array = array();

        if ($this->input->post()) {

            $where = "user_hash='".$this->session->userdata('admin_user_hash')."'";
            $user_detail = $this->Action_model->select_single('tbl_users',$where);

            $record_array = array(
                'first_name'=>$this->input->post('first_name'),
                'last_name'=>$this->input->post('last_name')
            );

            if ($user_detail) {
                $this->Action_model->update_data($record_array,'tbl_users',$where);
                $array = array('status'=>'success','message'=>'Profile Updated Successfully!!');
            }
            else {
                $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function update_general_setting()
    {
        $array = array();

        if ($this->input->post()) {

            

            $record_array = array(
                'invoice_company_name'=>$this->input->post('invoice_company_name'),
                'invoice_address'=>$this->input->post('invoice_address')
            );

            $where = "setting_id='1'";
            $this->Action_model->update_data($record_array,'tbl_setting',$where);
            $array = array('status'=>'success','message'=>'Updated Successfully!!');
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    function time_elapsed_string($ptime)
    {
        $etime = time() - $ptime;

        if ($etime < 1)
        {
            return '1 seconds';
        }

        $a = array( 365 * 24 * 60 * 60  =>  'year',
                     30 * 24 * 60 * 60  =>  'month',
                          24 * 60 * 60  =>  'day',
                               60 * 60  =>  'hour',
                                    60  =>  'minute',
                                     1  =>  'second'
                    );
        $a_plural = array( 'year'   => 'years',
                           'month'  => 'months',
                           'day'    => 'days',
                           'hour'   => 'hours',
                           'minute' => 'minutes',
                           'second' => 'seconds'
                    );

        foreach ($a as $secs => $str)
        {
            $d = $etime / $secs;
            if ($d >= 1)
            {
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
            }
        }
    }

    public function get_chats()
    {
        $array = array();
        $chat_users = array();
        $chat_messages = array();

        if ($this->input->post()) {

            $where = "user_hash='".$this->session->userdata('admin_user_hash')."'";
            $user_detail = $this->Action_model->select_single('tbl_users',$where);

            if ($user_detail) {
                $user_id = $user_detail->user_id;

                $this->Action_model->update_data(array('last_visit'=>time()),'tbl_users',"user_id='".$user_detail->user_id."'");

                $where = "user_status='1' AND (tbl_roles.role_id='2' OR tbl_roles.is_admin_member='1')";
                $this->db->select('tbl_users.user_id as uid,first_name,last_name,role_name,last_visit,image');
                $this->db->from('tbl_users');
                $this->db->join('tbl_roles', 'tbl_roles.role_id = tbl_users.role_id');
                $this->db->where($where);
                $query = $this->db->get();
                $chat_user_data = $query->result();

                $timestamp = time();

                $where = "(sender_id='".$user_id."' OR receiver_id='".$user_id."') ORDER BY sent_on DESC LIMIT 1";
                $this->db->select('s.first_name as s_first_name,s.last_name as s_last_name,r.first_name as r_first_name,r.last_name as r_last_name,s.image as s_image,r.image as r_image,message,sender_id,receiver_id,message,sent_on');
                $this->db->from('tbl_chats');
                $this->db->join('tbl_users as s', 's.user_id = tbl_chats.sender_id');
                $this->db->join('tbl_users as r', 'r.user_id = tbl_chats.receiver_id');
                $this->db->where($where);
                $query = $this->db->get();
                $chat_data = $query->row();

                $current_chat_user_id = 0;
                if ($chat_data && $chat_data->sender_id!=$user_id) {
                   $current_chat_user_id = $chat_data->sender_id;
                }
                else if ($chat_data && $chat_data->receiver_id!=$user_id) {
                   $current_chat_user_id = $chat_data->receiver_id;
                }

                if ($chat_user_data) {
                    $i=0;
                    foreach ($chat_user_data as $chat_user) {
                        $status = 1;

                        if ($timestamp-($chat_user->last_visit)>900) {
                           $status = 0;
                        }

                        $user_image = base_url('uploads/images/user/photo/user.png');
                        if ($chat_user->image) {
                            $user_image = base_url('uploads/images/user/photo/'.$chat_user->image);
                        }

                        $chat_users[] = array('user_id'=>$chat_user->uid,'user_name'=>$chat_user->first_name.' '.$chat_user->last_name,'role_name'=>$chat_user->role_name,'status'=>$status,'user_image'=>$user_image);

                         $i++;
                    }
                }
                $array = array('status'=>'success','message'=>'Data Found','chat_users'=>$chat_users,'chat_messages'=>$chat_messages,'current_chat_user_id'=>$current_chat_user_id);
            }
            else {
                $array = array('status'=>'expired','message'=>'Your session has been expired, login to continue.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function get_chat_messages()
    {
        $array = array();
        $chat_messages = array();

        if ($this->input->post()) {

            $where = "user_hash='".$this->session->userdata('admin_user_hash')."'";
            $user_detail = $this->Action_model->select_single('tbl_users',$where);

            if ($user_detail) {
                $user_id = $user_detail->user_id;

                $this->Action_model->update_data(array('last_visit'=>time()),'tbl_users',"user_id='".$user_detail->user_id."'");

                $chat_user_id = $this->input->post('chat_user_id');

                $record_chat_user = $this->Action_model->select_single('tbl_users',"user_id='".$chat_user_id."'");
                $chat_status = 'online';
                $timestamp = time();
                if ($timestamp-($record_chat_user->last_visit)>900) {
                   $chat_status = 'offline';
                }

                $where = "((receiver_id='".$chat_user_id."' AND sender_id='".$user_id."') OR (sender_id='".$chat_user_id."' AND receiver_id='".$user_id."')) ORDER BY sent_on ASC";
                $this->db->select('s.first_name as s_first_name,s.last_name as s_last_name,r.first_name as r_first_name,r.last_name as r_last_name,s.image as s_image,r.image as r_image,message,message,sender_id,receiver_id,message,sent_on');
                $this->db->from('tbl_chats');
                $this->db->join('tbl_users as s', 's.user_id = tbl_chats.sender_id');
                $this->db->join('tbl_users as r', 'r.user_id = tbl_chats.receiver_id');
                $this->db->where($where);
                $query = $this->db->get();
                $chat_data = $query->result();

                foreach ($chat_data as $chat) {
                    $is_sender = 'no';
                    if ($chat->sender_id==$user_id) {
                        $is_sender = 'yes';
                    }

                    $user_image = base_url('uploads/images/user/photo/user.png');
                    
                    if ($chat->sender_id==$user_id) {
                        if ($chat->s_image) {
                            $user_image = base_url('uploads/images/user/photo/'.$chat->s_image);
                        }
                    }
                    else {
                        if ($chat->s_image) {
                            $user_image = base_url('uploads/images/user/photo/'.$chat->s_image);
                        }
                    }
                    $chat_messages[] = array('sender_id'=>$chat->sender_id,'sender_name'=>$chat->s_first_name.' '.$chat->s_last_name,'receiver_id'=>$chat->receiver_id,'receiver_name'=>$chat->r_first_name.' '.$chat->r_last_name,'message'=>$chat->message,'sent_on'=>$this->time_elapsed_string($chat->sent_on),'is_sender'=>$is_sender,'user_image'=>$user_image);
                }

                $where = "user_status='1' AND (tbl_roles.role_id='2' OR tbl_roles.is_admin_member='1')";
                $this->db->select('tbl_users.user_id as uid,first_name,last_name,role_name,last_visit,image');
                $this->db->from('tbl_users');
                $this->db->join('tbl_roles', 'tbl_roles.role_id = tbl_users.role_id');
                $this->db->where($where);
                $query = $this->db->get();
                $chat_user_data = $query->result();

                $timestamp = time();

                if ($chat_user_data) {
                    $i=0;
                    foreach ($chat_user_data as $chat_user) {
                        $status = 1;

                        if ($timestamp-($chat_user->last_visit)>900) {
                           $status = 0;
                        }

                        $user_image = base_url('uploads/images/user/photo/user.png');
                        if ($chat_user->image) {
                            $user_image = base_url('uploads/images/user/photo/'.$chat_user->image);
                        }

                        $chat_users[] = array('user_id'=>$chat_user->uid,'user_name'=>$chat_user->first_name.' '.$chat_user->last_name,'role_name'=>$chat_user->role_name,'status'=>$status,'user_image'=>$user_image);

                         $i++;
                    }
                }

                $array = array('status'=>'success','message'=>'Data Found','chat_messages'=>$chat_messages,'chat_users'=>$chat_users,'chat_status'=>$chat_status);
            }
            else {
                $array = array('status'=>'expired','message'=>'Your session has been expired, login to continue.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function send_message()
    {
        $array = array();

        if ($this->input->post()) {

            $where = "user_hash='".$this->session->userdata('admin_user_hash')."'";
            $user_detail = $this->Action_model->select_single('tbl_users',$where);
            $chat_user_id = $this->input->post('receiver_id');

            if ($user_detail) {
                $user_id = $user_detail->user_id;

                $this->Action_model->update_data(array('last_visit'=>time()),'tbl_users',"user_id='".$user_detail->user_id."'");

                $record_chat_user = $this->Action_model->select_single('tbl_users',"user_id='".$chat_user_id."'");
                $chat_status = 'online';
                $timestamp = time();
                if ($timestamp-($record_chat_user->last_visit)>900) {
                   $chat_status = 'offline';
                }

                $record_array = array(
                    'message'=>$this->input->post('message'),
                    'sender_id'=>$user_detail->user_id,
                    'receiver_id'=>$this->input->post('receiver_id'),
                    'message'=>$this->input->post('message'),
                    'sent_on'=>time()
                );

                $this->Action_model->insert_data($record_array,'tbl_chats');

                $where = "((receiver_id='".$chat_user_id."' AND sender_id='".$user_id."') OR (sender_id='".$chat_user_id."' AND receiver_id='".$user_id."')) ORDER BY sent_on ASC";
                $this->db->select('s.first_name as s_first_name,s.last_name as s_last_name,r.first_name as r_first_name,r.last_name as r_last_name,s.image as s_image,r.image as r_image,message,message,sender_id,receiver_id,message,sent_on');
                $this->db->from('tbl_chats');
                $this->db->join('tbl_users as s', 's.user_id = tbl_chats.sender_id');
                $this->db->join('tbl_users as r', 'r.user_id = tbl_chats.receiver_id');
                $this->db->where($where);
                $query = $this->db->get();
                $chat_data = $query->result();

                foreach ($chat_data as $chat) {
                    $is_sender = 'no';
                    if ($chat->sender_id==$user_id) {
                        $is_sender = 'yes';
                    }

                    $user_image = base_url('uploads/images/user/photo/user.png');
                    if ($chat->sender_id==$user_id) {
                        if ($chat->s_image) {
                            $user_image = base_url('uploads/images/user/photo/'.$chat->s_image);
                        }
                    }
                    else {
                        if ($chat->s_image) {
                            $user_image = base_url('uploads/images/user/photo/'.$chat->s_image);
                        }
                    }

                    $chat_messages[] = array('sender_id'=>$chat->sender_id,'sender_name'=>$chat->s_first_name.' '.$chat->s_last_name,'receiver_id'=>$chat->receiver_id,'receiver_name'=>$chat->r_first_name.' '.$chat->r_last_name,'message'=>$chat->message,'sent_on'=>$this->time_elapsed_string($chat->sent_on),'is_sender'=>$is_sender,'user_image'=>$user_image);
                }

                $where = "user_status='1' AND (tbl_roles.role_id='2' OR tbl_roles.is_admin_member='1')";
                $this->db->select('tbl_users.user_id as uid,first_name,last_name,role_name,last_visit,image');
                $this->db->from('tbl_users');
                $this->db->join('tbl_roles', 'tbl_roles.role_id = tbl_users.role_id');
                $this->db->where($where);
                $query = $this->db->get();
                $chat_user_data = $query->result();

                $timestamp = time();

                if ($chat_user_data) {
                    $i=0;
                    foreach ($chat_user_data as $chat_user) {
                        $status = 1;

                        if ($timestamp-($chat_user->last_visit)>900) {
                           $status = 0;
                        }

                        $user_image = base_url('uploads/images/user/photo/user.png');
                        if ($chat_user->image) {
                            $user_image = base_url('uploads/images/user/photo/'.$chat_user->image);
                        }

                        $chat_users[] = array('user_id'=>$chat_user->uid,'user_name'=>$chat_user->first_name.' '.$chat_user->last_name,'role_name'=>$chat_user->role_name,'status'=>$status,'user_image'=>$user_image);

                         $i++;
                    }
                }

                $array = array('status'=>'success','message'=>'Message Send Successfully!!','chat_messages'=>$chat_messages,'chat_users'=>$chat_users,'chat_status'=>$chat_status);
            }
            else {
                $array = array('status'=>'expired','message'=>'Your session has been expired, login to continue.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    /* ticket start */
    public function ticket_list(){
     
        $where = "user_hash='".$this->session->userdata('admin_user_hash')."'";
        $user_detail = $this->Action_model->select_single('tbl_users',$where);

        if ($user_detail) {
            $user_id = $user_detail->user_id;
            $postData = $this->input->post();
            $select = 'ticket_id,ticket_title,ticket_status,created_at,ticket_track_id';
            $where = '';

            $searchValue = $postData['search']['value'];
            $searchQuery = "";
             if($searchValue != ''){
                $searchQuery = " (ticket_title like '%".$searchValue."%' )";
             }
            $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_tickets',$where,$select);

            echo json_encode($data);
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }
    }

    public function get_ticket()
    {
        $array = array();

        if ($this->input->post()) {

            $where = "user_hash='".$this->session->userdata('agent_hash')."'";
            $user_detail = $this->Action_model->select_single('tbl_users',$where);

            if ($user_detail) {
                $user_id = $user_detail->user_id;
                $id=$this->input->post('id');
                $record = $this->Action_model->select_single('tbl_tickets',"ticket_id='".$id."' AND user_id='".$user_id."'");
                if ($record) {
                    $array = array('status'=>'success','message'=>'','record'=>$record);
                }
                else {
                    $array = array('status'=>'error','message'=>'Record Not Found.');
                }
            }
            else { 
               $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function ticket_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $where = "user_hash='".$this->session->userdata('agent_hash')."'";
            $user_detail = $this->Action_model->select_single('tbl_users',$where);

            if ($user_detail) {
                $user_id = $user_detail->user_id;

                $id=$this->input->post('id');
                $record = $this->Action_model->select_single('tbl_tickets',"ticket_id='".$id."' AND user_id='".$user_id."'");

                $record_array = array(
                    'ticket_title'=>$this->input->post('ticket_title'),
                    'ticket_message'=>$this->input->post('ticket_message'),
                    'ticket_status'=>$this->input->post('ticket_status')
                );

                if ($record) {
                    $record_array['updated_at'] = date("d-m-Y h:i:s a");

                    $this->Action_model->update_data($record_array,'tbl_tickets',"ticket_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Ticket Updated Successfully!!');

                }
                else {
                    $record_array['created_at'] = date("d-m-Y h:i:s a");
                    $record_array['updated_at'] = date("d-m-Y h:i:s a");
                    $record_array['user_id'] = $user_id;

                    $record = $this->Action_model->select_single('tbl_tickets',"ticket_id!='' ORDER BY ticket_id DESC LIMIT 1");
                    $tlast=1;
                    if ($record) {
                        $tlast = $record->ticket_id+1;
                    }
                    $ticket_track_id= "TK-".str_pad($tlast, 4, '0', STR_PAD_LEFT);
                    $record_array['ticket_track_id'] = $ticket_track_id;

                    $ticket_id=$this->Action_model->insert_data($record_array,'tbl_tickets');

                    $message_array = array(
                        'ticket_id'=>$ticket_id,
                        'sender_id'=>$user_id,
                        'receiver_id'=>1,
                        'ticket_message'=>$this->input->post('ticket_message'),
                        'created_at'=>date("d-m-Y h:i:s a")
                    );
                    $this->Action_model->insert_data($message_array,'tbl_ticket_messages');
                    $array = array('status'=>'added','message'=>'Ticket Added Successfully!!');

                }
            }
            else { 
               $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_ticket()
    {
        $array = array();

        if ($this->input->post()) {
            
            $where = "user_hash='".$this->session->userdata('admin_user_hash')."'";
            $user_detail = $this->Action_model->select_single('tbl_users',$where);

            if ($user_detail) {
                $user_id = $user_detail->user_id;
                $id=$this->input->post('id');
                $record = $this->Action_model->select_single('tbl_tickets',"ticket_id='".$id."'");

                if ($record) {
                    $this->Action_model->delete_query('tbl_tickets',"ticket_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Ticket Deleted Successfully!!');
                }
                else {
                    $array = array('status'=>'added','message'=>'Record Not Found!!');
                }
            }
            else { 
               $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function update_ticket_status()
    {
        $array = array();

        if ($this->input->post()) {
            
            $where = "user_hash='".$this->session->userdata('admin_user_hash')."'";
            $user_detail = $this->Action_model->select_single('tbl_users',$where);

            if ($user_detail) {
                $user_id = $user_detail->user_id;
                $id=$this->input->post('id');
                $ticket_status=$this->input->post('ticket_status');
                $record = $this->Action_model->select_single('tbl_tickets',"ticket_id='".$id."'");

                if ($record) {
                    $ticket_status_label = "";
                    if ($ticket_status==1) {
                        $ticket_status_label = "Open";
                    }
                    else if ($ticket_status==2) {
                        $ticket_status_label = "Closed";
                    }
                    $this->Action_model->update_data(array('ticket_status'=>$ticket_status),'tbl_tickets',"ticket_id='".$id."'");

                    $this->session->set_flashdata('success_msg', 'Ticket '.$ticket_status_label.' Successfully!!');
                    $array = array('status'=>'success','message'=>'Ticket '.$ticket_status_label.' Successfully!!');
                }
                else {
                    $array = array('status'=>'error','message'=>'Record Not Found!!');
                }
            }
            else { 
               $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function ticket_reply()
    {
        $array = array();

        if ($this->input->post()) {
            
            $where = "user_hash='".$this->session->userdata('admin_user_hash')."'";
            $user_detail = $this->Action_model->select_single('tbl_users',$where);

            if ($user_detail) {
                $user_id = $user_detail->user_id;
                $id=$this->input->post('id');
                $record = $this->Action_model->select_single('tbl_tickets',"ticket_id='".$id."'");

                if ($record) {

                    if ($record->ticket_status==2) {

                        $array = array('status'=>'error','message'=>'Ticket Closed.');
                    }
                    else { 
                        $message_array = array(
                            'ticket_id'=>$id,
                            'sender_id'=>1,
                            'receiver_id'=>$record->user_id,
                            'ticket_message'=>$this->input->post('ticket_message'),
                            'created_at'=>date("d-m-Y h:i:s a")
                        );

                        $tm_id=$this->Action_model->insert_data($message_array,'tbl_ticket_messages');

                        $ticket_messages = array();

                        $where = "ticket_message_id='".$tm_id."' AND ticket_id='".$id."' AND ((receiver_id='".$record->user_id."' AND sender_id='1') OR (sender_id='".$record->user_id."' AND receiver_id='1')) ORDER BY ticket_message_id ASC";
                        $this->db->select('s.first_name as s_first_name,s.last_name as s_last_name,r.first_name as r_first_name,r.last_name as r_last_name,s.image as s_image,r.image as r_image,sender_id,receiver_id,ticket_message,tbl_ticket_messages.created_at as created_at');
                        $this->db->from('tbl_ticket_messages');
                        $this->db->join('tbl_users as s', 's.user_id = tbl_ticket_messages.sender_id');
                        $this->db->join('tbl_users as r', 'r.user_id = tbl_ticket_messages.receiver_id');
                        $this->db->where($where);
                        $query = $this->db->get();
                        $ticket_message_data = $query->row();

                        if ($ticket_message_data) {
                            $user_image = base_url('uploads/images/user/photo/user.png');
                            if ($ticket_message_data->sender_id==1) {
                                if ($ticket_message_data->s_image) {
                                    $user_image = base_url('uploads/images/user/photo/'.$ticket_message_data->s_image);
                                }
                            }
                            else {
                                if ($ticket_message_data->s_image) {
                                    $user_image = base_url('uploads/images/user/photo/'.$ticket_message_data->s_image);
                                }
                            }
                            $ticket_messages = array('user_image'=>$user_image,'ticket_message'=>$ticket_message_data->ticket_message,'name'=>$ticket_message_data->s_first_name.' '.$ticket_message_data->s_last_name,'created_at'=>$ticket_message_data->created_at);
                        }

                        $array = array('status'=>'success','message'=>'Ticket Reply Added Successfully!!','ticket_messages'=>$ticket_messages);
                    }
                }
                else {
                    $array = array('status'=>'error','message'=>'Record Not Found!!');
                }
            }
            else { 
               $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* ticket end */


    /* customer start */
    public function get_customer_list()
    {
        $array = array();

        if ($this->input->post()) {

                $filter_by = $this->input->post('filter_by');
                $page=$this->input->post('page');

                $search_text = $this->input->post('search_text');
                $search_date_from = $this->input->post('search_date_from');
                $search_date_to = $this->input->post('search_date_to');
                $search_state_id = $this->input->post('search_state_id');
                $search_city_id = $this->input->post('search_city_id');
                $search_source_id = $this->input->post('search_source_id');
                $search_stage_id = $this->input->post('search_stage_id');
                $search_status = $this->input->post('search_status');
                $search_location_id = $this->input->post('search_location_id');
                $search_budget_min = $this->input->post('search_budget_min');
                $search_budget_max = $this->input->post('search_budget_max');
                $search_size_min = $this->input->post('search_size_min');
                $search_size_max = $this->input->post('search_size_max');
                $search_size_unit = $this->input->post('search_size_unit');
                $search_agent_id = $this->input->post('search_agent_id');

                $limit = 10;
                $total_pages = 0;
                $start = 0;
                $next_page = 0;
                $start = ($page-1)*$limit;

                if ($search_agent_id) {
                    $where = "tbl_leads.account_id='".$search_agent_id."'";
                }
                else {
                    $where = "tbl_leads.account_id!=''";
                }

                $where_ext = "";
                if ($search_text) {
                    $where_ext .=" AND (lead_mobile_no LIKE '%".$search_text."%' OR lead_email LIKE '%".$search_text."%' OR CONCAT(lead_title, ' ', lead_first_name, ' ', lead_last_name) LIKE '%".$search_text."%')";
                }

                if ($search_date_from && !$search_date_to) {
                    $where_ext .=" AND lead_date>='".$search_date_from."'";
                }
                if ($search_date_from && $search_date_to) {
                    $where_ext .=" AND (lead_date BETWEEN '".$search_date_from."' AND '".$search_date_to."')";
                }
                if ($search_state_id) {
                    $where_ext .=" AND lead_state_id='".$search_state_id."'";
                }
                if ($search_city_id) {
                    $where_ext .=" AND lead_city_id='".$search_city_id."'";
                }
                if ($search_source_id) {
                    $where_ext .=" AND lead_source_id='".$search_source_id."'";
                }
                if ($search_stage_id) {
                    $where_ext .=" AND lead_stage_id='".$search_stage_id."'";
                }
                if ($search_status) {
                    $where_ext .=" AND lead_status='".$search_status."'";
                }

                if ($search_location_id) {
                    $where_ext .=" AND FIND_IN_SET(".$search_location_id.",location)";
                }

                if ($search_budget_min && !$search_budget_max) {
                    $where_ext .=" AND budget_min>='".$search_budget_min."'";
                }
                if ($search_budget_min && $search_budget_max) {
                    $where_ext .=" AND (budget_min>='".$search_budget_min."' AND budget_max<='".$search_budget_max."')";
                }

                if ($search_size_min && !$search_size_max) {
                    $where_ext .=" AND size_min<='".$search_size_min."'";
                }
                if ($search_size_min && $search_size_max) {
                    $where_ext .=" AND (size_min<='".$search_size_min."' AND size_max>='".$search_size_max."')";
                }

                if ($search_size_unit) {
                    $where_ext .=" AND size_unit='".$search_size_unit."'";
                }

                $where .= $where_ext;
                $where.=" GROUP BY lead_mobile_no";

                $this->db->select("budget_min,budget_max,size_min,size_max,size_unit,count(tbl_leads.lead_id) as total_records");
                $this->db->from('tbl_leads');
                $this->db->join('tbl_requirements', 'tbl_requirements.lead_id = tbl_leads.lead_id','left');
                $this->db->where($where);
                $query = $this->db->get();
                $record_all = $query->result();

                $total_records = 0;
                if ($record_all) {
                    //$total_records = $record_all->total_records;
                    $total_records = count($record_all);
                    $total_pages = ceil($total_records/$limit);
                }


                if ($search_agent_id) {
                    $where = "tbl_leads.account_id='".$search_agent_id."'";
                }
                else {
                    $where = "tbl_leads.account_id!=''";
                }
                $where .= $where_ext;
                $where.=" GROUP BY  lead_mobile_no";

                if ($filter_by==1) {
                    $where.=" ORDER BY lead_name";
                }
                else if ($filter_by==2) {
                    $where.=" ORDER BY STR_TO_DATE(lead_date,'%d-%m-%Y') DESC, tbl_leads.lead_id DESC";
                }
                else if ($filter_by==3) {
                    $where.=" ORDER BY lead_status DESC";
                }
                else if ($filter_by==4) {
                    $where.=" ORDER BY lead_status ASC";
                }
                else {
                    //$where.=" ORDER BY STR_TO_DATE(lead_date,'%d-%m-%Y') DESC";
                    $where.=" ORDER BY tbl_leads.created_at DESC";
                }

                $where.=" limit ".$start.",".$limit;
                $this->db->select("*,tbl_leads.lead_id as lead_id,CONCAT(lead_first_name, ' ', lead_last_name) AS 'lead_name'");
                $this->db->from('tbl_leads');
                $this->db->join('tbl_requirements', 'tbl_requirements.lead_id = tbl_leads.lead_id','left');
                $this->db->where($where);
                $query = $this->db->get();
                $records = $query->result();

                if ($total_pages!=$page) {
                    $next_page = $page+1;
                }
                $array = array('status'=>'success','message'=>'Lead Found','records'=>$records,'total_records'=>$total_records,'total_pages'=>$total_pages,'next_page'=>$next_page,'records'=>$records);
            
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function get_customer()
    {

        if ($this->input->post()) {
            $id=$this->input->post('id');

            $where = "lead_id='".$id."'";

            $this->db->select("*");
            $this->db->from('tbl_leads');
            $this->db->join('tbl_states', 'tbl_states.state_id = tbl_leads.lead_state_id','left');
            $this->db->join('tbl_city', 'tbl_city.city_id = tbl_leads.lead_city_id','left');
            $this->db->join('tbl_occupations', 'tbl_occupations.occupation_id = tbl_leads.lead_occupation_id','left');
            $this->db->join('tbl_lead_types', 'tbl_lead_types.lead_type_id = tbl_leads.lead_status','left');
            $this->db->join('tbl_lead_stages', 'tbl_lead_stages.lead_stage_id = tbl_leads.lead_stage_id','left');
            $this->db->join('tbl_lead_sources', 'tbl_lead_sources.lead_source_id = tbl_leads.lead_source_id','left');
            $this->db->join('tbl_designations', 'tbl_designations.designation_id = tbl_leads.lead_designation','left');
            $this->db->where($where);
            $query = $this->db->get();
            $record = $query->row();

            if ($record) {
                $data['record'] = $record;
                $this->load->view(ADMIN_URL.'get_customer',$data);
            }
            else {
                echo 'error';
            }
        }
        else { 
           echo 'error';
        }
        
    }

    public function get_customer_requirement_list()
    {
        $array = array();
        $requirement_list = array();

        if ($this->input->post()) {
            $lead_id=$this->input->post('lead_id');

            $where = "lead_id='".$lead_id."'";
            $lead_detail = $this->Action_model->select_single('tbl_leads',$where);

            $lead_ids = array();
            $lead_data = $this->Action_model->detail_result('tbl_leads',"lead_mobile_no='".$lead_detail->lead_mobile_no."'","lead_id");
            foreach ($lead_data as $item) {
                $lead_ids[] = $item->lead_id;
            }

            $where = "(lead_id IN (".implode(',', $lead_ids)."))";
            $where .= " OR (customer_mobile='".$lead_detail->lead_mobile_no."')";
            $where .= " ORDER BY requirement_id DESC";

            $this->db->select("requirement_id,lead_id,tbl_requirements.user_id,look_for,product_type_name,unit_type_name,accomodation_name,location,size_min,size_max,size_unit,remark,dor,lead_option_name as look_for,requirement_status,state_name,city_name,b_min.budget_name as budget_minimum,b_max.budget_name as budget_maximum,agent.user_title,agent.is_individual,agent.first_name,agent.last_name,agent.firm_name,tbl_units.unit_name");
            $this->db->from('tbl_requirements');
            $this->db->join('tbl_lead_options', 'tbl_lead_options.lead_option_id = tbl_requirements.look_for','left');
            $this->db->join('tbl_states', 'tbl_states.state_id = tbl_requirements.state_id','left');
            $this->db->join('tbl_city', 'tbl_city.city_id = tbl_requirements.city_id','left');
            $this->db->join('tbl_accomodations', 'tbl_accomodations.accomodation_id = tbl_requirements.accomodation_id','left');
            $this->db->join('tbl_product_types', 'tbl_product_types.product_type_id = tbl_requirements.product_type_id','left');
            $this->db->join('tbl_unit_types', 'tbl_unit_types.unit_type_id = tbl_requirements.unit_type_id','left');
            $this->db->join('tbl_budgets as b_min', 'b_min.budget_id = tbl_requirements.budget_min','left');
            $this->db->join('tbl_budgets as b_max', 'b_max.budget_id = tbl_requirements.budget_max','left');
            $this->db->join('tbl_users as agent', 'agent.user_id = tbl_requirements.account_id','left');
            $this->db->join('tbl_units', 'tbl_units.unit_id = tbl_requirements.size_unit','left');
            $this->db->where($where);
            $query = $this->db->get();
            $requirement_data = $query->result();

            if ($requirement_data) {
                //$requirement_list = $requirement_data;
                foreach ($requirement_data as $item) {
                    $location = "";
                    if ($item->location) {
                        $location_data = $this->Action_model->detail_result('tbl_locations',"location_id IN (".$item->location.")",'location_name');
                        $location_list = array();
                        if ($location_data) {
                            foreach ($location_data as $item_location) {
                                $location_list[] = $item_location->location_name;
                            }

                            $location .=implode(", ", $location_list);
                        }
                    }

                    if ($location) {
                        $location .= " ";
                    }

                    if ($item->state_name) {
                        $location .= $item->state_name;
                    }

                    if ($item->city_name) {
                        if ($item->state_name) {
                            $location .= ", ";
                        }
                        $location .= $item->city_name;
                    }

                    $look_for = $item->look_for;
                    if ($item->accomodation_name) {
                        $look_for .= " ".$item->accomodation_name;
                    }
                    
                    if ($item->product_type_name) {
                        $look_for .= " ".$item->product_type_name;
                    }
                    
                    if ($item->unit_type_name) {
                        $look_for .= " ".$item->unit_type_name;
                    }

                    $requirement_list[] = array(
                        "requirement_id"=>$item->requirement_id,
                        "lead_id"=>$item->lead_id,
                        "look_for"=>$item->look_for,
                        "budget_min"=>($item->budget_minimum)?$item->budget_minimum:'',
                        "budget_max"=>($item->budget_maximum)?$item->budget_maximum:'',
                        "size_min"=>$item->size_min,
                        "size_max"=>$item->size_max,
                        "size_unit"=>($item->unit_name)?$item->unit_name:'',
                        "remark"=>$item->remark,
                        "dor"=>$item->dor,
                        "look_for"=>$look_for,
                        "location"=>$location,
                        "requirement_status"=>$item->requirement_status,
                        "agent_name"=>($item->is_individual)?ucwords($item->user_title.' '.$item->first_name.' '.$item->last_name):$item->firm_name
                    );
                }
            }
            $array = array('status'=>'success','message'=>'Data Found','requirement_list'=>$requirement_list);
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_customer_reference_list()
    {
        $array = array();
        $reference_list = array();

        if ($this->input->post()) {

            $lead_id=$this->input->post('lead_id');
            
            //$where = "user_id='".$account_id."'";
            //$user_detail = $this->Action_model->select_single('tbl_users',$where);

            //$reference_list[] = array("reference_id" => '',"reference_name" => ucwords($user_detail->user_title.' '.$user_detail->first_name.' '.$user_detail->last_name),"dor" => '',"purpose" => '',"status" => '');

            $where = "lead_id='".$lead_id."'";
            $lead_detail = $this->Action_model->select_single('tbl_leads',$where);


            $where = "lead_mobile_no='".$lead_detail->lead_mobile_no."'";
            $where .= " ORDER BY STR_TO_DATE(lead_date,'%d-%m-%Y') DESC";

            $this->db->select('*');
            $this->db->from('tbl_leads');
            $this->db->join('tbl_users', 'tbl_users.user_id = tbl_leads.account_id','left');
            $this->db->join('tbl_states', 'tbl_states.state_id = tbl_leads.lead_state_id','left');
            $this->db->join('tbl_city', 'tbl_city.city_id = tbl_leads.lead_city_id','left');
            $this->db->join('tbl_lead_stages', 'tbl_lead_stages.lead_stage_id = tbl_leads.lead_stage_id','left');
            $this->db->join('tbl_lead_sources', 'tbl_lead_sources.lead_source_id = tbl_leads.lead_source_id','left');
            /*$this->db->join('tbl_locations', 'tbl_locations.location_id = tbl_property.location_id','left');
            
            $this->db->join('tbl_listing_types',"tbl_listing_types.listing_type_id=tbl_property.listing_type",'left');
            $this->db->join('tbl_product_types',"tbl_product_types.product_type_id=tbl_property.product_type_id",'left');
            $this->db->join('tbl_unit_types',"tbl_unit_types.unit_type_id=tbl_property.unit_type_id",'left');*/
            $this->db->where($where);
            $query = $this->db->get();
            $requirement_data = $query->result();

            if ($requirement_data) {
                foreach ($requirement_data as $item) {

                    $last_followup = "";
                    $next_followup = "";
                    $last_followup_comment = "";
                    $next_followup_remark = "";

                    $where_followup = "lead_id='".$item->lead_id."' ORDER BY followup_id DESC LIMIT 1, 1";

                    $this->db->select('tbl_followup.next_followup_date,tbl_followup.next_followup_time,comment,task_desc,tbl_lead_actions.lead_action_name');
                    $this->db->from('tbl_followup');
                    $this->db->join('tbl_lead_actions', 'tbl_lead_actions.lead_action_id = tbl_followup.next_action','left');
                    $this->db->where($where_followup);
                    $query = $this->db->get();
                    $followup_data = $query->row();
                    if ($followup_data) {
                        $next_action = $followup_data->lead_action_name." ";
                        if ($followup_data->next_followup_date) {
                            $next_action .= $followup_data->next_followup_date;
                        }
                        if ($followup_data->next_followup_time) {
                            if ($followup_data->next_followup_date) {
                                $next_action .= " & ";
                            }
                            $next_action .= $followup_data->next_followup_time;
                        }
                        $last_followup = $next_action;
                        $last_followup_comment = $followup_data->comment;
                    }

                    $where_followup = "lead_id='".$item->lead_id."' ORDER BY followup_id DESC LIMIT 1";

                    $this->db->select('tbl_followup.next_followup_date,tbl_followup.next_followup_time,comment,task_desc,tbl_lead_actions.lead_action_name');
                    $this->db->from('tbl_followup');
                    $this->db->join('tbl_lead_actions', 'tbl_lead_actions.lead_action_id = tbl_followup.next_action','left');
                    $this->db->where($where_followup);
                    $query = $this->db->get();
                    $followup_data = $query->row();
                    if ($followup_data) {
                        $next_action = $followup_data->lead_action_name." ";
                        if ($followup_data->next_followup_date) {
                            $next_action .= $followup_data->next_followup_date;
                        }
                        if ($followup_data->next_followup_time) {
                            if ($followup_data->next_followup_date) {
                                $next_action .= " & ";
                            }
                            $next_action .= $followup_data->next_followup_time;
                        }
                        $next_followup = $next_action;
                        $next_followup_remark = $followup_data->task_desc;
                    }

                    $reference_list[] = array(
                         "lead_id"=>$item->lead_id,
                        "agent_name"=>($item->is_individual)?ucwords($item->user_title.' '.$item->first_name.' '.$item->last_name):$item->firm_name,
                         "status"=>$item->lead_status,
                        "city_name"=>(!$item->city_name)?'':$item->city_name,
                        "state_name"=>(!$item->state_name)?'':$item->state_name,
                         "lead_date"=>$item->lead_date,
                        "lead_stage_name"=>(!$item->lead_stage_name)?'':$item->lead_stage_name,
                        "lead_source_name"=>(!$item->lead_source_name)?'':$item->lead_source_name,
                         "last_followup"=>$last_followup,
                         "next_followup"=>$next_followup,
                         "last_followup_comment"=>$last_followup_comment,
                         "next_followup_remark"=>$next_followup_remark,
                        /*"location_name"=>(!$item->location_name)?'':$item->location_name,
                        "post_date"=>$item->post_date,
                        "city_name"=>(!$item->city_name)?'':$item->city_name,
                        "state_name"=>(!$item->state_name)?'':$item->state_name,
                        "listing_type"=>(!$item->title)?'':$item->title,
                        "product_type_name"=>(!$item->product_type_name)?'':$item->product_type_name,
                        "unit_type_name"=>(!$item->unit_type_name)?'':$item->unit_type_name,
                        "status"=>1*/
                    );
                }
            }

            $array = array('status'=>'success','message'=>'Data Found','reference_list'=>$reference_list);
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_customer_unit_list()
    {
        $array = array();
        $unit_list = array();

        if ($this->input->post()) {

            $lead_id=$this->input->post('lead_id');

            $where = "lead_id='".$lead_id."'";
            $lead_detail = $this->Action_model->select_single('tbl_leads',$where);

            $this->db->select('*');
            $this->db->from('tbl_bookings');
            $this->db->join('tbl_products', 'tbl_products.product_id = tbl_bookings.project_id','left');
            //$this->db->join('tbl_locations', 'tbl_locations.location_id = tbl_bookings.address','left');
            $this->db->join('tbl_states', 'tbl_states.state_id = tbl_bookings.state_id','left');
            $this->db->join('tbl_city', 'tbl_city.city_id = tbl_bookings.city_id','left');
            $this->db->join('tbl_product_unit_details', 'tbl_product_unit_details.product_unit_detail_id = tbl_bookings.product_unit_detail_id');
            $this->db->join('tbl_product_types',"tbl_product_types.product_type_id=tbl_product_unit_details.project_type",'left');
            $this->db->join('tbl_unit_types',"(tbl_product_unit_details.project_type!='3' AND tbl_unit_types.unit_type_id=tbl_product_unit_details.property_type) OR (tbl_product_unit_details.project_type='3' AND tbl_unit_types.unit_type_id=tbl_product_unit_details.sub_category)",'left');
            $this->db->join('tbl_accomodations', 'tbl_accomodations.accomodation_id = tbl_bookings.accommodation','left');
            $this->db->join('tbl_floors', 'tbl_floors.floor_id = tbl_bookings.floor','left');
            $this->db->join('tbl_product_block_details', 'tbl_product_block_details.block_id = tbl_bookings.tower','left');
            /*$this->db->join('tbl_users', 'tbl_users.user_id = tbl_property.account_id','left');
            $this->db->join('tbl_locations', 'tbl_locations.location_id = tbl_property.location_id','left');
            $this->db->join('tbl_states', 'tbl_states.state_id = tbl_property.state_id','left');
            $this->db->join('tbl_city', 'tbl_city.city_id = tbl_property.city_id','left');
            $this->db->join('tbl_listing_types',"tbl_listing_types.listing_type_id=tbl_property.listing_type",'left');
            $this->db->join('tbl_product_types',"tbl_product_types.product_type_id=tbl_property.product_type_id",'left');
            $this->db->join('tbl_unit_types',"tbl_unit_types.unit_type_id=tbl_property.unit_type_id",'left');*/
            $this->db->where($where);
            $query = $this->db->get();
            $requirement_data = $query->result();

            if ($requirement_data) {
                foreach ($requirement_data as $item) {
                    $payment_mode = "";
                    if ($item->payment_mode=="cheque") {
                        $payment_mode = "By Cheque";
                    }
                    if ($item->payment_mode=="cash") {
                        $payment_mode = "By Cash";
                    }
                    if ($item->payment_mode=="online_transfer") {
                        $payment_mode = "Online Transfer";
                    }

                    $unit_list[] = array(
                        "lead_id"=>$item->lead_id,
                        "customer_name"=>$item->customer_name,
                        "sdw_title"=>$item->sdw_title,
                        "sdw"=>$item->sdw,
                        "dob"=>$item->dob,
                        "project_name"=>$item->project_name,
                        "address"=>(!$item->address)?'':$item->address,
                        "city_name"=>(!$item->city_name)?'':$item->city_name,
                        "state_name"=>(!$item->state_name)?'':$item->state_name,
                        "product_type_name"=>(!$item->product_type_name)?'':$item->product_type_name,
                        "unit_type_name"=>(!$item->unit_type_name)?'':$item->unit_type_name,
                        "deal_amount"=>$item->deal_amount,
                        "booking_amount"=>$item->booking_amount,
                        "payment_mode"=>$payment_mode,
                        "cheque_no"=>$item->cheque_no,
                        "drawn_on"=>$item->drawn_on,
                        "booking_date"=>$item->booking_date,
                        "remark"=>$item->remark,
                        "unit_ref_no"=>$item->unit_ref_no,
                        "size"=>$item->size,
                        "unit_no"=>$item->unit_no,
                        "accomodation_name"=>(!$item->accomodation_name)?'':$item->accomodation_name,
                        "floor_name"=>(!$item->floor_name)?'':$item->floor_name,
                        "tower_name"=>(!$item->block_name)?'':$item->block_name,
                        /*"agent_name"=>($item->is_individual)?ucwords($item->user_title.' '.$item->first_name.' '.$item->last_name):$item->firm_name,
                        "location_name"=>(!$item->location_name)?'':$item->location_name,
                        "post_date"=>$item->post_date,
                        "city_name"=>(!$item->city_name)?'':$item->city_name,
                        "state_name"=>(!$item->state_name)?'':$item->state_name,
                        "listing_type"=>(!$item->title)?'':$item->title,
                        "product_type_name"=>(!$item->product_type_name)?'':$item->product_type_name,
                        "unit_type_name"=>(!$item->unit_type_name)?'':$item->unit_type_name,
                        "status"=>1*/
                    );
                }
            }
            $array = array('status'=>'success','message'=>'Data Found','unit_list'=>$unit_list);
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    /* customer end */

    public function get_lead_list()
    {
        $array = array();

        if ($this->input->post()) {

            if ($this->input->post()) {
                $filter_by = $this->input->post('filter_by');
                $page=$this->input->post('page');

                $search_text = $this->input->post('search_text');
                $search_date_from = $this->input->post('search_date_from');
                $search_date_to = $this->input->post('search_date_to');
                $search_state_id = $this->input->post('search_state_id');
                $search_city_id = $this->input->post('search_city_id');
                $search_source_id = $this->input->post('search_source_id');
                $search_stage_id = $this->input->post('search_stage_id');
                $search_status = $this->input->post('search_status');
                $search_location_id = $this->input->post('search_location_id');
                $search_budget_min = $this->input->post('search_budget_min');
                $search_budget_max = $this->input->post('search_budget_max');
                $search_size_min = $this->input->post('search_size_min');
                $search_size_max = $this->input->post('search_size_max');
                $search_size_unit = $this->input->post('search_size_unit');
                $search_agent_id = $this->input->post('search_agent_id');

                $limit = 10;
                $total_pages = 0;
                $start = 0;
                $next_page = 0;
                $start = ($page-1)*$limit;

                /*$where_ids = "";
                $user_ids = $this->get_level_user_ids();
                if (count($user_ids)) {
                    $where_ids .= " AND (tbl_leads.user_id='".implode("' OR tbl_leads.user_id='", $user_ids)."')";
                }*/

                if ($search_agent_id) {
                    $where = "tbl_leads.account_id='".$search_agent_id."'";
                }
                else {
                    $where = "tbl_leads.account_id!=''";
                }

                $where .= " AND added_to_followup='0' AND is_customer='0'";
                //$where .= $where_ids;
                $where_ext = "";
                if ($search_text) {
                    $where_ext .=" AND (lead_mobile_no LIKE '%".$search_text."%' OR lead_email LIKE '%".$search_text."%' OR CONCAT(lead_title, ' ', lead_first_name, ' ', lead_last_name) LIKE '%".$search_text."%')";
                }

                if ($search_date_from && !$search_date_to) {
                    $where_ext .=" AND lead_date>='".$search_date_from."'";
                }
                if ($search_date_from && $search_date_to) {
                    $where_ext .=" AND (lead_date BETWEEN '".$search_date_from."' AND '".$search_date_to."')";
                }
                if ($search_state_id) {
                    $where_ext .=" AND lead_state_id='".$search_state_id."'";
                }
                if ($search_city_id) {
                    $where_ext .=" AND lead_city_id='".$search_city_id."'";
                }
                if ($search_source_id) {
                    $where_ext .=" AND lead_source_id='".$search_source_id."'";
                }
                if ($search_stage_id) {
                    $where_ext .=" AND lead_stage_id='".$search_stage_id."'";
                }
                if ($search_status) {
                    $where_ext .=" AND lead_status='".$search_status."'";
                }

                if ($search_location_id) {
                    $where_ext .=" AND FIND_IN_SET(".$search_location_id.",location)";
                }

                if ($search_budget_min && !$search_budget_max) {
                    $where_ext .=" AND budget_min>='".$search_budget_min."'";
                }
                if ($search_budget_min && $search_budget_max) {
                    $where_ext .=" AND (budget_min>='".$search_budget_min."' AND budget_max<='".$search_budget_max."')";
                }

                if ($search_size_min && !$search_size_max) {
                    $where_ext .=" AND size_min<='".$search_size_min."'";
                }
                if ($search_size_min && $search_size_max) {
                    $where_ext .=" AND (size_min<='".$search_size_min."' AND size_max>='".$search_size_max."')";
                }

                if ($search_size_unit) {
                    $where_ext .=" AND size_unit='".$search_size_unit."'";
                }

                $where .= $where_ext;

                $this->db->select("count(tbl_leads.lead_id) as total_records,CONCAT(lead_first_name, ' ', lead_last_name) AS 'lead_name'");
                $this->db->from('tbl_leads');
                $this->db->join('tbl_requirements', 'tbl_requirements.lead_id = tbl_leads.lead_id','left');
                $this->db->where($where);
                $query = $this->db->get();
                $record_all = $query->row();

                $total_records = 0;
                if ($record_all) {
                    $total_records = $record_all->total_records;
                    $total_pages = ceil($total_records/$limit);
                }


                $where="added_to_followup='0' AND is_customer='0'";
                //$where .= $where_ids;
                $where .= $where_ext;

                if ($filter_by==1) {
                    $where.=" ORDER BY lead_name";
                }
                else if ($filter_by==2) {
                    $where.=" ORDER BY STR_TO_DATE(lead_date,'%d-%m-%Y') DESC, tbl_leads.lead_id DESC";
                }
                else if ($filter_by==3) {
                    $where.=" ORDER BY lead_status DESC";
                }
                else if ($filter_by==4) {
                    $where.=" ORDER BY lead_status ASC";
                }
                else {
                    $where.=" ORDER BY STR_TO_DATE(lead_date,'%d-%m-%Y') DESC, tbl_leads.lead_id DESC";
                }

                $where.=" limit ".$start.",".$limit;
                $this->db->select("*,tbl_leads.lead_id as lead_id,CONCAT(lead_first_name, ' ', lead_last_name) AS 'lead_name'");
                $this->db->from('tbl_leads');
                $this->db->join('tbl_requirements', 'tbl_requirements.lead_id = tbl_leads.lead_id','left');
                $this->db->where($where);
                $query = $this->db->get();
                $records = $query->result();

                if ($total_pages!=$page) {
                    $next_page = $page+1;
                }
                $array = array('status'=>'success','message'=>'Lead Found','records'=>$records,'total_records'=>$total_records,'total_pages'=>$total_pages,'next_page'=>$next_page,'records'=>$records);
            }
            else {
                $array = array('status'=>'error','message'=>'No Leads');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function get_lead()
    {

        //$account_id = getAccountId();

        if ($this->input->post()) {
            $id=$this->input->post('id');

            $where = "lead_id='".$id."'";

            $this->db->select("*");
            $this->db->from('tbl_leads');
            $this->db->join('tbl_states', 'tbl_states.state_id = tbl_leads.lead_state_id','left');
            $this->db->join('tbl_city', 'tbl_city.city_id = tbl_leads.lead_city_id','left');
            $this->db->join('tbl_occupations', 'tbl_occupations.occupation_id = tbl_leads.lead_occupation_id','left');
            $this->db->join('tbl_lead_types', 'tbl_lead_types.lead_type_id = tbl_leads.lead_status','left');
            $this->db->join('tbl_lead_stages', 'tbl_lead_stages.lead_stage_id = tbl_leads.lead_stage_id','left');
            $this->db->join('tbl_lead_sources', 'tbl_lead_sources.lead_source_id = tbl_leads.lead_source_id','left');
            $this->db->join('tbl_designations', 'tbl_designations.designation_id = tbl_leads.lead_designation','left');
            $this->db->where($where);
            $query = $this->db->get();
            $record = $query->row();

            if ($record) {
                $data['record'] = $record;

                //$account_id = getAccountId();
        
                $where = "user_status='1'";
                /*$where_ids = "";
                $user_ids = $this->get_level_user_ids();

                if (count($user_ids)) {

                    $where_ids .= " AND (tbl_users.user_id='".implode("' OR tbl_users.user_id='", $user_ids)."')";
                }
                $where .= $where_ids;*/

                $user_list = $this->Action_model->detail_result('tbl_users',$where,'user_id,user_title,first_name,last_name,parent_id,is_individual,firm_name');
                $data['user_list'] = $user_list;

                $this->load->view(ADMIN_URL.'get_lead',$data);
            }
            else {
                echo 'error';
            }
        }
        else { 
           echo 'error';
        }
        
    }

    public function load_followup_list()
    {
        $array = array();
        $followup_list = array();

        //$account_id = getAccountId();

        if ($this->input->post()) {

            $lead_id=$this->input->post('lead_id');

            $where = "lead_id='".$lead_id."'";
            /*$where_ids = "";
            $user_ids = $this->get_level_user_ids();
            if (count($user_ids)) {
                $where_ids .= " AND (tbl_followup.user_id='".implode("' OR tbl_followup.user_id='", $user_ids)."')";
            }
            $where .= $where_ids;*/
            $where .= " ORDER BY followup_id DESC";

            $this->db->select('followup_id,followup_status,comment,task_desc,lead_id,tbl_followup.created_at as created_at,cu.is_individual as cu_is_individual,cu.firm_name as cu_firm_name,cu.parent_id as cu_parent_id,cu.user_title as cu_user_title,cu.first_name as cu_first_name,cu.last_name as cu_last_name,au.is_individual as au_is_individual,au.firm_name as au_firm_name,au.parent_id as au_parent_id,au.user_title as au_user_title,au.first_name as au_first_name,au.last_name as au_last_name,next_followup_date,next_followup_time,lead_action_name');
            $this->db->from('tbl_followup');
            $this->db->join('tbl_users as cu', 'cu.user_id = tbl_followup.user_id','left');
            $this->db->join('tbl_users as au', 'au.user_id = tbl_followup.user_id','left');
            $this->db->join('tbl_lead_actions', 'tbl_lead_actions.lead_action_id = tbl_followup.next_action','left');
            $this->db->where($where);
            $query = $this->db->get();
            $followup_data = $query->result();

            if ($followup_data) {

                foreach ($followup_data as $item) {
                    
                    $next_action = "";
                    if ($item->next_followup_date) {
                        $next_action .= $item->next_followup_date;
                    }

                    if ($item->next_followup_time) {
                        if ($item->next_followup_date) {
                            $next_action .= " & ";
                        }

                        $next_action .= $item->next_followup_time;
                    }


                    $followup_list[] = array(
                        "followup_id"=>$item->followup_id,
                        "lead_id"=>$item->lead_id,
                        "followup_status"=>$item->followup_status,
                        "comment"=>$item->comment,
                        "task_desc"=>$item->task_desc,
                        "created"=>date("d-m-Y & h:i A",$item->created_at),
                        "cu_name"=>(($item->cu_parent_id==0)?(($item->cu_is_individual)?ucwords($item->cu_user_title.' '.$item->cu_first_name.' '.$item->cu_last_name):$item->cu_firm_name):ucwords($item->cu_user_title.' '.$item->cu_first_name.' '.$item->cu_last_name)),
                        "au_name"=>(($item->au_parent_id==0)?(($item->au_is_individual)?ucwords($item->au_user_title.' '.$item->au_first_name.' '.$item->au_last_name):$item->au_firm_name):ucwords($item->au_user_title.' '.$item->au_first_name.' '.$item->au_last_name)),
                        "next_action"=>$next_action,
                        "lead_action_name"=>$item->lead_action_name
                    );
                }
            }
            $array = array('status'=>'success','message'=>'Data Found','followup_list'=>$followup_list);
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function get_followup_list()
    {
        $array = array();

        if ($this->input->post()) {

            //$account_id = getAccountId();
            //$agent = $this->getAgent();
            //$user_id = $agent->user_id;

            if ($this->input->post()) {
                $filter_by = $this->input->post('filter_by');
                $page=$this->input->post('page');

                $search_text = $this->input->post('search_text');
                $search_date_from = $this->input->post('search_date_from');
                $search_date_to = $this->input->post('search_date_to');
                $search_state_id = $this->input->post('search_state_id');
                $search_city_id = $this->input->post('search_city_id');
                $search_source_id = $this->input->post('search_source_id');
                $search_stage_id = $this->input->post('search_stage_id');
                $search_status = $this->input->post('search_status');
                $search_location_id = $this->input->post('search_location_id');
                $search_budget_min = $this->input->post('search_budget_min');
                $search_budget_max = $this->input->post('search_budget_max');
                $search_size_min = $this->input->post('search_size_min');
                $search_size_max = $this->input->post('search_size_max');
                $search_size_unit = $this->input->post('search_size_unit');
                $search_agent_id = $this->input->post('search_agent_id');
                $search_agent_id = $this->input->post('search_agent_id');

                $limit = 10;
                $total_pages = 0;
                $start = 0;
                $next_page = 0;
                $start = ($page-1)*$limit;

                if ($search_agent_id) {
                    $where = "tbl_leads.account_id='".$search_agent_id."'";
                }
                else {
                    $where = "tbl_leads.account_id!=''";
                }

                $where = "added_to_followup='1' AND tbl_leads.lead_status='1' AND is_customer='0'";
                /*$where_ids = "";
                $user_ids = $this->get_level_user_ids();
                if (count($user_ids)) {
                   $where_ids .= " AND ((tbl_followup.user_id='".implode("' OR tbl_followup.user_id='", $user_ids)."')  OR (tbl_followup.assign_user_id='".implode("' OR tbl_followup.assign_user_id='", $user_ids)."'))";
                }
                $where .= $where_ids;*/
                $where_ext = "";
                if ($search_text) {
                    $where_ext .=" AND (lead_mobile_no LIKE '%".$search_text."%' OR lead_email LIKE '%".$search_text."%' OR CONCAT(lead_title, ' ', lead_first_name, ' ', lead_last_name) LIKE '%".$search_text."%')";
                }

                if ($search_date_from && !$search_date_to) {
                    $where_ext .=" AND next_followup_date>='".$search_date_from."'";
                }
                if ($search_date_from && $search_date_to) {
                    $where_ext .=" AND (next_followup_date BETWEEN '".$search_date_from."' AND '".$search_date_to."')";
                }
                if ($search_state_id) {
                    $where_ext .=" AND lead_state_id='".$search_state_id."'";
                }
                if ($search_city_id) {
                    $where_ext .=" AND lead_city_id='".$search_city_id."'";
                }
                if ($search_source_id) {
                    $where_ext .=" AND tbl_leads.lead_source_id='".$search_source_id."'";
                }
                if ($search_stage_id) {
                    $where_ext .=" AND tbl_leads.lead_stage_id='".$search_stage_id."'";
                }
                if ($search_status) {
                    $where_ext .=" AND tbl_leads.lead_status='".$search_status."'";
                }

                if ($search_location_id) {
                    $where_ext .=" AND FIND_IN_SET(".$search_location_id.",location)";
                }

                if ($search_budget_min && !$search_budget_max) {
                    $where_ext .=" AND budget_min>='".$search_budget_min."'";
                }
                if ($search_budget_min && $search_budget_max) {
                    $where_ext .=" AND (budget_min>='".$search_budget_min."' AND budget_max<='".$search_budget_max."')";
                }

                if ($search_size_min && !$search_size_max) {
                    $where_ext .=" AND size_min<='".$search_size_min."'";
                }
                if ($search_size_min && $search_size_max) {
                    $where_ext .=" AND (size_min<='".$search_size_min."' AND size_max>='".$search_size_max."')";
                }

                if ($search_size_unit) {
                    $where_ext .=" AND size_unit='".$search_size_unit."'";
                }

                $where .= $where_ext;

                $where .= " GROUP BY tbl_followup.lead_id";

                $this->db->select("count(tbl_followup.lead_id) as total_records");
                $this->db->from('tbl_followup');
                $this->db->join('tbl_leads', 'tbl_leads.lead_id = tbl_followup.lead_id');
                $this->db->join('tbl_requirements', 'tbl_requirements.lead_id = tbl_leads.lead_id','left');
                $this->db->where($where);
                $query = $this->db->get();
                $record_all = $query->result();

                $total_records = 0;
                if ($record_all) {
                    $total_records = count($record_all);// $record_all->total_records;
                    $total_pages = ceil($total_records/$limit);
                }


                $where="tbl_leads.added_to_followup='1' AND tbl_leads.lead_status='1' AND is_customer='0'";
                /*$where_ids = "";
                $user_ids = $this->get_level_user_ids();
                if (count($user_ids)) {
                   $where_ids .= " AND ((tbl_followup.user_id='".implode("' OR tbl_followup.user_id='", $user_ids)."')  OR (tbl_followup.assign_user_id='".implode("' OR tbl_followup.assign_user_id='", $user_ids)."'))";
                }
                $where .= $where_ids;*/

                $where .= $where_ext;

                $where .= " GROUP BY tbl_leads.lead_id";

                if ($filter_by==1) {
                    $where.=" ORDER BY next_followup_date DESC";
                }
                else {
                    $where.=" ORDER BY tbl_leads.lead_id DESC";
                }

                $where.=" limit ".$start.",".$limit;

                $query=$this->db->query("SELECT tbl_requirements.*,tbl_leads.*,tbl_lead_sources.*,tbl_lead_stages.*,`tbl_leads`.`lead_id` as `lead_id`, CONCAT(lead_first_name, ' ', lead_last_name) AS 'lead_name', `followup_date`, CONCAT(IFNULL(ft.next_followup_date,''), ' ', IFNULL(ft.next_followup_time,'')) AS 'next_followup_date', IFNULL(ft.next_followup_time,'') as next_followup_time FROM `tbl_followup`  LEFT JOIN tbl_leads ON `tbl_leads`.`lead_id` = `tbl_followup`.`lead_id` LEFT JOIN `tbl_requirements` ON `tbl_requirements`.`lead_id` = `tbl_leads`.`lead_id` LEFT JOIN `tbl_lead_stages` ON `tbl_lead_stages`.`lead_stage_id` = `tbl_leads`.`lead_stage_id` LEFT JOIN `tbl_lead_sources` ON `tbl_lead_sources`.`lead_source_id` = `tbl_leads`.`lead_source_id` LEFT JOIN `tbl_followup` as ft ON `ft`.`lead_id` = `tbl_leads`.`lead_id` AND ft.followup_id= (select fs.followup_id from tbl_followup as fs where fs.lead_id=tbl_leads.lead_id order by fs.followup_id desc limit 1) WHERE ".((0)?"tbl_followup.followup_id in (select max(followup_id) from tbl_followup where ((tbl_followup.user_id='".implode("' OR tbl_followup.user_id='", $user_ids)."')  OR (tbl_followup.assign_user_id='".implode("' OR tbl_followup.assign_user_id='", $user_ids)."')) group by lead_id) AND ":"tbl_followup.followup_id in (select max(followup_id) from tbl_followup where lead_id=tbl_leads.lead_id group by lead_id) AND ")."".$where);
                $record_data = $query->result();

                //print_r($record_data);

                $records = array();
                if ($record_data) {
                    foreach ($record_data as $item) {

                        $next_followup = "";

                        $where = "lead_id='".$item->lead_id."' AND next_followup_date!='' ORDER BY followup_id DESC LIMIT 1";
                        $this->db->select('au.first_name as au_first_name,au.last_name as au_last_name,next_followup_date,next_followup_time');
                        $this->db->from('tbl_followup');
                        $this->db->join('tbl_users as au', 'au.user_id = tbl_followup.assign_user_id','left');
                        $this->db->where($where);
                        $query = $this->db->get();
                        $followup_detail = $query->row();
                        if ($followup_detail) {
                            $next_followup = "<i class='fa fa-clock-o'></i> ".$followup_detail->next_followup_date." & ".$followup_detail->next_followup_time." &nbsp; <i class='fa fa-bookmark'></i> ".$followup_detail->au_first_name.' '.$followup_detail->au_last_name;
                        }

                        $next_followup_date = "";
                        if ($item->next_followup_date) {
                            $next_followup_date = "$item->next_followup_date";

                            $next_followup_date = preg_replace("/ /", "<br>", $next_followup_date,1);
                        }
                       $records[] = array(
                            'lead_id'=>$item->lead_id,
                            'lead_title'=>$item->lead_title,
                            'lead_first_name'=>$item->lead_first_name,
                            'lead_last_name'=>$item->lead_last_name,
                            'lead_date'=>$item->lead_date,
                            'next_followup_date'=>$next_followup_date,
                            'lead_mobile_no'=>$item->lead_mobile_no,
                            'lead_stage_name'=>$item->lead_stage_name,
                            'lead_source_name'=>$item->lead_source_name,
                            'lead_email'=>$item->lead_email,
                            'next_followup'=>$next_followup
                        );
                    }
                }

                if ($total_pages!=$page) {
                    $next_page = $page+1;
                }
                $array = array('status'=>'success','message'=>'Lead Found','records'=>$records,'total_records'=>$total_records,'total_pages'=>$total_pages,'next_page'=>$next_page,'records'=>$records);
            }
            else {
                $array = array('status'=>'error','message'=>'No Leads');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function get_followup()
    {

        //$account_id = getAccountId();

        if ($this->input->post()) {
            $id=$this->input->post('id');

            $where = "lead_id='".$id."'";

            $this->db->select("*");
            $this->db->from('tbl_leads');
            $this->db->join('tbl_states', 'tbl_states.state_id = tbl_leads.lead_state_id','left');
            $this->db->join('tbl_city', 'tbl_city.city_id = tbl_leads.lead_city_id','left');
            $this->db->join('tbl_occupations', 'tbl_occupations.occupation_id = tbl_leads.lead_occupation_id','left');
            $this->db->join('tbl_lead_stages', 'tbl_lead_stages.lead_stage_id = tbl_leads.lead_stage_id','left');
            $this->db->join('tbl_lead_sources', 'tbl_lead_sources.lead_source_id = tbl_leads.lead_source_id','left');
            $this->db->join('tbl_lead_types', 'tbl_lead_types.lead_type_id = tbl_leads.lead_status');
            $this->db->join('tbl_users', 'tbl_users.user_id = tbl_leads.user_id','left');
            $this->db->join('tbl_designations', 'tbl_designations.designation_id = tbl_leads.lead_designation','left');
            $this->db->where($where);
            $query = $this->db->get();
            $record = $query->row();

            if ($record) {
                $next_followup = "";
                $next_followup_date = "";

                $where = "lead_id='".$record->lead_id."' ORDER BY followup_id DESC LIMIT 1";
                $this->db->select('au.first_name as au_first_name,au.last_name as au_last_name,next_followup_date,next_followup_time');
                $this->db->from('tbl_followup');
                $this->db->join('tbl_users as au', 'au.user_id = tbl_followup.assign_user_id','left');
                $this->db->where($where);
                $query = $this->db->get();
                $followup_detail = $query->row();
                if ($followup_detail && $followup_detail->next_followup_date) {
                    $next_followup = "<i class='fa fa-clock-o'></i> ".$followup_detail->next_followup_date." & ".$followup_detail->next_followup_time." &nbsp; <i class='fa fa-bookmark'></i> ".$followup_detail->au_first_name.' '.$followup_detail->au_last_name;
                    $next_followup_date = $followup_detail->next_followup_date."<br>".$followup_detail->next_followup_time;
                }

                $data['record'] = $record;
                $data['next_followup'] = $next_followup;
                $data['next_followup_date'] = $next_followup_date;



                $account_id = getAccountId();
        
                $where = "user_status='1'";
                /*$where_ids = "";
                $user_ids = $this->get_level_user_ids();

                if (count($user_ids)) {

                    $where_ids .= " AND (tbl_users.user_id='".implode("' OR tbl_users.user_id='", $user_ids)."')";
                }
                $where .= $where_ids;*/

                $user_list = $this->Action_model->detail_result('tbl_users',$where,'user_id,user_title,first_name,last_name,parent_id,is_individual,firm_name');
                $data['user_list'] = $user_list;

                $this->load->view(ADMIN_URL.'get_followup',$data);
            }
            else {
                echo 'error';
            }
        }
        else { 
           echo 'error';
        }
        
    }

    public function get_requirement_list()
    {
        $array = array();
        $requirement_list = array();

        //$account_id = getAccountId();

        if ($this->input->post()) {

            $lead_id=$this->input->post('lead_id');
            $where = "lead_id='".$lead_id."'";
            $where_ids = "";
            //$user_ids = $this->get_level_user_ids();
            //if (count($user_ids)) {
            //    $where_ids .= " AND (tbl_requirements.user_id='".implode("' OR tbl_requirements.user_id='", $user_ids)."')";
            //}
            //$where .= $where_ids;
            $where .= " ORDER BY requirement_id DESC";

            $this->db->select('requirement_id,lead_id,look_for,product_type_name,unit_type_name,accomodation_name,location,size_min,size_max,size_unit,remark,dor,lead_option_name as look_for,requirement_status,state_name,city_name,b_min.budget_name as budget_minimum,b_max.budget_name as budget_maximum,su.unit_name as size_unit_name,au.is_individual as au_is_individual,au.firm_name as au_firm_name,au.parent_id as au_parent_id,au.user_title as au_user_title,au.first_name as au_first_name,au.last_name as au_last_name');
            $this->db->from('tbl_requirements');
            $this->db->join('tbl_lead_options', 'tbl_lead_options.lead_option_id = tbl_requirements.look_for','left');
            $this->db->join('tbl_states', 'tbl_states.state_id = tbl_requirements.state_id','left');
            $this->db->join('tbl_city', 'tbl_city.city_id = tbl_requirements.city_id','left');
            $this->db->join('tbl_accomodations', 'tbl_accomodations.accomodation_id = tbl_requirements.accomodation_id','left');
            $this->db->join('tbl_product_types', 'tbl_product_types.product_type_id = tbl_requirements.product_type_id','left');
            $this->db->join('tbl_unit_types', 'tbl_unit_types.unit_type_id = tbl_requirements.unit_type_id','left');
            $this->db->join('tbl_units as su', 'su.unit_id = tbl_requirements.size_unit','left');
            $this->db->join('tbl_budgets as b_min', 'b_min.budget_id = tbl_requirements.budget_min','left');
            $this->db->join('tbl_budgets as b_max', 'b_max.budget_id = tbl_requirements.budget_max','left');
            $this->db->join('tbl_users as au', 'au.user_id = tbl_requirements.user_id','left');
            $this->db->where($where);
            $query = $this->db->get();
            $requirement_data = $query->result();

            if ($requirement_data) {
                //$requirement_list = $requirement_data;
                foreach ($requirement_data as $item) {
                    $location = "";
                    if ($item->location) {
                        $location_data = $this->Action_model->detail_result('tbl_locations',"location_id IN (".$item->location.")",'location_name');
                        $location_list = array();
                        if ($location_data) {
                            foreach ($location_data as $item_location) {
                                $location_list[] = $item_location->location_name;
                            }

                            $location .=implode(", ", $location_list);
                        }
                    }

                    if ($location) {
                        $location .= "<br>";
                    }

                    if ($item->state_name) {
                        $location .= $item->state_name;
                    }

                    if ($item->city_name) {
                        if ($item->state_name) {
                            $location .= ", ";
                        }
                        $location .= $item->city_name;
                    }

                    $look_for = $item->look_for;
                    if ($item->accomodation_name) {
                        $look_for .= " ".$item->accomodation_name;
                    }
                    
                    if ($item->product_type_name) {
                        $look_for .= " ".$item->product_type_name;
                    }
                    
                    if ($item->unit_type_name) {
                        $look_for .= " ".$item->unit_type_name;
                    }

                    $requirement_list[] = array(
                        "requirement_id"=>$item->requirement_id,
                        "lead_id"=>$item->lead_id,
                        "look_for"=>$item->look_for,
                        "budget_min"=>($item->budget_minimum)?$item->budget_minimum:'',
                        "budget_max"=>($item->budget_maximum)?$item->budget_maximum:'',
                        "size_min"=>$item->size_min,
                        "size_max"=>$item->size_max,
                        "size_unit"=>$item->size_unit_name,
                        "remark"=>$item->remark,
                        "dor"=>$item->dor,
                        "look_for"=>$look_for,
                        "location"=>$location,
                        "requirement_status"=>$item->requirement_status,
                         "added_by"=>(($item->au_parent_id==0)?(($item->au_is_individual)?ucwords($item->au_user_title.' '.$item->au_first_name.' '.$item->au_last_name):$item->au_firm_name):ucwords($item->au_user_title.' '.$item->au_first_name.' '.$item->au_last_name))
                    );
                }
            }
            $array = array('status'=>'success','message'=>'Data Found','requirement_list'=>$requirement_list);
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function get_lead_history_list()
    {
        $array = array();
        $lead_history_list = array();

         //$account_id = getAccountId();

        if ($this->input->post()) {

            $lead_id=$this->input->post('lead_id');
            $where = "lead_id='".$lead_id."' ORDER BY lead_history_id DESC";

            $this->db->select('lead_history_id,title,description,created_at');
            $this->db->from('tbl_lead_history');
            $this->db->where($where);
            $query = $this->db->get();
            $lead_history_data = $query->result();

            if ($lead_history_data) {
                foreach ($lead_history_data as $item) {

                    $lead_history_list[] = array(
                        "lead_history_id"=>$item->lead_history_id,
                        "title"=>$item->title,
                        "description"=>$item->description,
                        "created_at"=>date("d-m-Y",$item->created_at).'<br>'.date("h:i a",$item->created_at)
                    );
                }
            }
            $array = array('status'=>'success','message'=>'Data Found','lead_history_list'=>$lead_history_list);
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }



    // Returns maximum in array 
    function getMax($array)  
    { 
       $n = count($array);  
       $max = $array[0]; 
       for ($i = 1; $i < $n; $i++)  
           if ($max < $array[$i]) 
               $max = $array[$i]; 
        return $max;        
    } 
      
    // Returns maximum in array 
    function getMin($array)  
    { 
       $n = count($array);  
       $min = $array[0]; 
       for ($i = 1; $i < $n; $i++)  
           if ($min > $array[$i]) 
               $min = $array[$i]; 
        return $min;        
    } 

    public function get_feedback_list()
    {
        $array = array();
        $feedback_list = array();

        //$account_id = getAccountId();

        if ($this->input->post()) {

            $lead_id=$this->input->post('lead_id');

            $sql = "
SELECT req.requirement_id,pty.property_id,COALESCE('simple_property') as  type,bgt_min.budget_amount as req_budget_min,bgt_max.budget_amount as req_budget_max,state_name,city_name,location_name,product_type_name,unit_type_name,COALESCE('') as  project_name FROM tbl_requirements as req 
JOIN tbl_property as pty ON pty.product_type_id = req.product_type_id AND pty.unit_type_id = req.unit_type_id AND pty.state_id = req.state_id AND pty.city_id = req.city_id AND FIND_IN_SET(pty.location_id,req.location)
LEFT JOIN tbl_budgets as bgt_min ON bgt_min.budget_id = req.budget_min 
LEFT JOIN tbl_budgets as bgt_max ON bgt_max.budget_id = req.budget_max 
LEFT JOIN tbl_states ON tbl_states.state_id = pty.state_id 
LEFT JOIN tbl_city ON tbl_city.city_id = pty.city_id 
LEFT JOIN tbl_locations ON tbl_locations.location_id = pty.location_id  
LEFT JOIN tbl_product_types ON tbl_product_types.product_type_id = req.product_type_id 
LEFT JOIN tbl_unit_types ON tbl_unit_types.unit_type_id = req.unit_type_id  
WHERE lead_id='".$lead_id."'
UNION ALL
SELECT req.requirement_id,pty.product_unit_detail_id,COALESCE('project_property') as  type,bgt_min.budget_amount as req_budget_min,bgt_max.budget_amount as req_budget_max,state_name,city_name,location_name,product_type_name,unit_type_name,COALESCE(pdt.project_name) as  project_name FROM tbl_requirements as req
JOIN tbl_product_unit_details as pty ON pty.project_type = req.product_type_id AND ((pty.project_type != '3' AND pty.property_type = req.unit_type_id) OR (pty.project_type = '3' AND pty.sub_category = req.unit_type_id))  
JOIN tbl_products as pdt ON pdt.product_id = pty.product_id  AND pdt.state_id = req.state_id AND pdt.city_id = req.city_id AND FIND_IN_SET(pdt.location,req.location) 
LEFT JOIN tbl_budgets as bgt_min ON bgt_min.budget_id = req.budget_min 
LEFT JOIN tbl_budgets as bgt_max ON bgt_max.budget_id = req.budget_max 
LEFT JOIN tbl_states ON tbl_states.state_id = pdt.state_id 
LEFT JOIN tbl_city ON tbl_city.city_id = pdt.city_id 
LEFT JOIN tbl_locations ON tbl_locations.location_id = pdt.location 
LEFT JOIN tbl_product_types ON tbl_product_types.product_type_id = req.product_type_id 
LEFT JOIN tbl_unit_types ON tbl_unit_types.unit_type_id = req.unit_type_id  
WHERE lead_id='".$lead_id."'
";

$query = $this->db->query($sql);
        $property_list = $query->result();


        $items = array();
        $property_items = array();

        //echo print_r($property_list);
        foreach ($property_list as $itemRow) {
            $budget = 0;
            $b_min = 0;
            $b_max = 0;

            $req_b_min = $itemRow->req_budget_min;
            $req_b_max = $itemRow->req_budget_max;
            if ($itemRow->type=="simple_property") {

                $budget = 0;
                $b_min = 0;
                $b_max = 0;

                $i1 = array(
                    'requirement_id'=>$itemRow->requirement_id,
                    'property_id'=>$itemRow->property_id,
                    'state_name'=>$itemRow->state_name,
                    'city_name'=>$itemRow->city_name,
                    'location_name'=>$itemRow->location_name,
                    'product_type_name'=>$itemRow->product_type_name,
                    'unit_type_name'=>$itemRow->unit_type_name,
                    'project_name'=>$itemRow->project_name,
                    'type'=>$itemRow->type,
                    'budget'=>$budget,
                    'budget_min'=>$b_min,
                    'budget_max'=>$b_max,
                    'req_budget_min'=>$req_b_min,
                    'req_budget_max'=>$req_b_max,
                    'size'=>"",
                    'accomodation_name'=>''
                );

                $items[] = $i1;

                $rq = $this->Action_model->select_single('tbl_requirements',"requirement_id='".$itemRow->requirement_id."'");
                //$pt = $this->Action_model->select_single('tbl_property',"property_id='".$itemRow->property_id."'");

                $this->db->select("*");
                $this->db->from('tbl_property');
                $this->db->join('tbl_units', 'tbl_units.unit_id = tbl_property.covered_area_unit','left');
                $this->db->where("property_id='".$itemRow->property_id."'");
                $query = $this->db->get();
                $pt = $query->row();

                if ($rq && $pt && $rq->size_unit==$pt->covered_area_unit && ($pt->covered_area>=$rq->size_min && $pt->covered_area<=$rq->size_max)) {
                    // sale
                    if ($rq->look_for==1 && $pt->listing_type==2) {

                        if ($pt->sale_price>=$req_b_min && $pt->sale_price<=$req_b_max) {

                            $budget = "Budget: Rs.".$pt->sale_price;
                            $b_min = $pt->sale_price;
                            $b_max = $pt->sale_price;

                            $i1 = array(
                                'requirement_id'=>$itemRow->requirement_id,
                                'property_id'=>$itemRow->property_id,
                                'state_name'=>$itemRow->state_name,
                                'city_name'=>$itemRow->city_name,
                                'location_name'=>$itemRow->location_name,
                                'product_type_name'=>$itemRow->product_type_name,
                                'unit_type_name'=>$itemRow->unit_type_name,
                                'project_name'=>$itemRow->project_name,
                                'type'=>$itemRow->type,
                                'budget'=>$budget,
                                'budget_min'=>$b_min,
                                'budget_max'=>$b_max,
                                'req_budget_min'=>$req_b_min,
                                'req_budget_max'=>$req_b_max,
                                'size'=> $pt->covered_area." ".$pt->unit_name,
                                'accomodation_name'=>''
                            );

                            $property_items[] = $i1;
                        }
                    }
                    // rent
                    if ($rq->look_for==2 && $pt->listing_type==1) {
                        if ($pt->rent_price>=$req_b_min && $pt->rent_price<=$req_b_max) {

                            $budget = "Budget: Rs.".$pt->rent_price;
                            $b_min = $pt->rent_price;
                            $b_max = $pt->rent_price;

                            $i1 = array(
                                'requirement_id'=>$itemRow->requirement_id,
                                'property_id'=>$itemRow->property_id,
                                'state_name'=>$itemRow->state_name,
                                'city_name'=>$itemRow->city_name,
                                'location_name'=>$itemRow->location_name,
                                'product_type_name'=>$itemRow->product_type_name,
                                'unit_type_name'=>$itemRow->unit_type_name,
                                'project_name'=>$itemRow->project_name,
                                'type'=>$itemRow->type,
                                'budget'=>$budget,
                                'budget_min'=>$b_min,
                                'budget_max'=>$b_max,
                                'req_budget_min'=>$req_b_min,
                                'req_budget_max'=>$req_b_max,
                                'size'=>$pt->covered_area." ".$pt->unit_name,
                                'accomodation_name'=>''
                            );

                            $property_items[] = $i1;
                        }
                    }
                }
            }
            else if ($itemRow->type=="project_property") {

                $where="pud.product_unit_detail_id='".$itemRow->property_id."'";
                $this->db->select("pud.product_unit_detail_id,tbl_accomodations.accomodation_name,pud.project_type,pud.property_type,pud.sa,pud.plot_size,pud.plot_unit,punit.unit_name as plot_unit_name,sa_unit.unit_name as sa_unit_name,pud.basic_cost,p.b_cost_unit,pud.unit");
                $this->db->from('tbl_product_unit_details as pud');
                $this->db->join('tbl_products as p', 'p.product_id = pud.product_id','left');
                $this->db->join('tbl_accomodations', 'tbl_accomodations.accomodation_id = pud.accomodation','left');
                $this->db->join('tbl_units as punit', 'punit.unit_id = pud.plot_unit','left');
                $this->db->join('tbl_units as sa_unit', 'sa_unit.unit_id = pud.unit','left');
                $this->db->where($where);
                $query = $this->db->get();
                $item = $query->row();

                $size_value = 0;
                $size_unit = "";
                $size = "";

                if ($item->project_type=='2') {

                    if ($item->sa) {
                        $size_value = $item->sa;
                        $size_unit = $item->unit;

                        $size = $item->sa;
                        if ($item->sa_unit_name) {
                            $size .= ' '.$item->sa_unit_name;
                        }
                    }

                    if ($item->plot_size) {
                        $size_value = $item->plot_size;
                        $size_unit = $item->plot_unit;

                        $size = $item->plot_size;
                        if ($item->plot_unit_name) {
                            $size .= ' '.$item->plot_unit_name;
                        }
                    }

                }
                if ($item->project_type=='3') {

                    $size_value = $item->sa;
                    $size_unit = $item->unit;

                    $size = $item->sa;
                    if ($item->sa_unit_name) {
                        $size .= ' '.$item->sa_unit_name;
                    }
                }

                $rq = $this->Action_model->select_single('tbl_requirements',"requirement_id='".$itemRow->requirement_id."'");

                if ($rq && $rq->size_unit==$size_unit && ($size_value>=$rq->size_min && $size_value<=$rq->size_max)) {

                        
                            $this->db->select('*');
                            $this->db->from('tbl_inventory');
                            $this->db->join('tbl_basic_cost', 'tbl_basic_cost.inventory_id = tbl_inventory.inventory_id','left');
                            $this->db->where("unit_code='".$item->product_unit_detail_id."'");
                            $query = $this->db->get();
                            $item_inv_data = $query->result();
                            $o=0;

                            $amount_array = array();
                            if ($item_inv_data) {
                                foreach ($item_inv_data as $itemInv) {
                                    $current_rate = 0;
                                    if ($itemInv->basic_cost_id) {

                                        $b_cost_unit = $itemInv->current_rate_unit;
                                        if ($itemInv->current_rate) {
                                            //$current_rate += $itemInv->current_rate;

                                            // residencial
                                            if($item->project_type==2){
                                                
                                                // for flat
                                                if(($item->property_type==1 || $item->property_type==7)){
                                                    //$size = $item->sa;
                                                    //if ($item->sa_unit_name) {
                                                    //    $size .= ' '.$item->sa_unit_name;
                                                    //}

                                                    if ($b_cost_unit=='2') {// for Sq.Ft
                                                        $current_rate = $item->sa*$itemInv->current_rate;
                                                    }
                                                    else if ($b_cost_unit=='5') {// for Fix
                                                        $current_rate = $itemInv->current_rate;
                                                    }
                                                }
                                                // for plot
                                                else if(($item->property_type==2 || $item->property_type==3)){
                                                    //$size = $item->plot_size;
                                                    //if ($item->plot_unit_name) {
                                                    //    $size .= ' '.$item->plot_unit_name;
                                                    //}
                                                    if ($b_cost_unit=='1') {// for Sq.Yd
                                                        $current_rate = $item->plot_size*$itemInv->current_rate;
                                                    }
                                                    else if ($b_cost_unit=='2') {// for Sq.Ft
                                                        $current_rate += $item->construction_area*$itemInv->current_rate;
                                                    } 
                                                    else if ($b_cost_unit=='5') {// for Fix
                                                        $current_rate = $itemInv->current_rate;
                                                    }
                                                }
                                            }
                                            // commercial
                                            else if($item->project_type==3){
                                                    //$size = $item->sa;
                                                    //if ($item->sa_unit_name) {
                                                    //    $size .= ' '.$item->sa_unit_name;
                                                    //}

                                                if ($b_cost_unit=='2') {// for Sq.Ft
                                                    $current_rate = $item->sa*$itemInv->current_rate;
                                                }
                                                else if ($b_cost_unit=='5') {// for Fix
                                                    $current_rate = $itemInv->current_rate;
                                                }
                                            }
                                        }
                                    }
                                    else {

                                        $b_cost_unit = $item->b_cost_unit;

                                        if ($item->basic_cost) {

                                            // residencial
                                            if($item->project_type==2){
                                                // for flat
                                                if(($item->property_type==1 || $item->property_type==7)){
                                                    //$size = $item->sa;
                                                    //if ($item->sa_unit_name) {
                                                    //    $size .= ' '.$item->sa_unit_name;
                                                    //}

                                                    if ($b_cost_unit=='2') {// for Sq.Ft
                                                        $current_rate = $item->sa*$item->basic_cost;
                                                    }
                                                    else if ($b_cost_unit=='5') {// for Fix
                                                        $current_rate = $item->basic_cost;
                                                    }
                                                }
                                                // for plot
                                                else if(($item->property_type==2 || $item->property_type==3)){
                                                    //$size = $item->plot_size;
                                                    //if ($item->plot_unit_name) {
                                                    //    $size .= ' '.$item->plot_unit_name;
                                                    //}
                                                    if ($b_cost_unit=='1') {// for Sq.Yd
                                                        $current_rate = $item->plot_size*$item->basic_cost;
                                                    }
                                                    else if ($b_cost_unit=='2') {// for Sq.Ft
                                                        $current_rate = $item->construction_area*$item->basic_cost;
                                                    } 
                                                    else if ($b_cost_unit=='5') {// for Fix
                                                        $current_rate = $item->basic_cost;
                                                    }
                                                }
                                            }


                                            // commercial
                                            else if($item->project_type==3){

                                                    //$size = $item->sa;
                                                    //if ($item->sa_unit_name) {
                                                    //    $size .= ' '.$item->sa_unit_name;
                                                    //}

                                                if ($b_cost_unit=='2') {// for Sq.Ft
                                                    $current_rate = $item->sa*$item->basic_cost;
                                                }
                                                else if ($b_cost_unit=='5') {// for Fix
                                                    $current_rate = $item->basic_cost;
                                                }
                                            }
                                            //echo $item->project_type."#";
                                        }
                                    }

                                    if ($current_rate) {
                                        $amount_array[] = $current_rate;
                                    }
                                }
                            }
                            else {
                                $b_cost_unit = $item->b_cost_unit;

                                if ($item->basic_cost) {

                                    // residencial
                                    if($item->project_type==2){
                                        // for flat
                                        if(($item->property_type==1 || $item->property_type==7)){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                            if ($b_cost_unit=='2') {// for Sq.Ft
                                                $current_rate = $item->sa*$item->basic_cost;
                                            }
                                            else if ($b_cost_unit=='5') {// for Fix
                                                $current_rate = $item->basic_cost;
                                            }
                                        }
                                        // for plot
                                        else if(($item->property_type==2 || $item->property_type==3)){
                                            //$size = $item->plot_size;
                                            //if ($item->plot_unit_name) {
                                            //    $size .= ' '.$item->plot_unit_name;
                                            //}
                                            if ($b_cost_unit=='1') {// for Sq.Yd
                                                $current_rate = $item->plot_size*$item->basic_cost;
                                            }
                                            else if ($b_cost_unit=='2') {// for Sq.Ft
                                                $current_rate = $item->construction_area*$item->basic_cost;
                                            } 
                                            else if ($b_cost_unit=='5') {// for Fix
                                                $current_rate = $item->basic_cost;
                                            }
                                        }
                                    }


                                    // commercial
                                    else if($item->project_type==3){

                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                        if ($b_cost_unit=='2') {// for Sq.Ft
                                            $current_rate = $item->sa*$item->basic_cost;
                                        }
                                        else if ($b_cost_unit=='5') {// for Fix
                                            $current_rate = $item->basic_cost;
                                        }
                                    }
                                    //echo $item->project_type."#";
                                }

                                if ($current_rate) {
                                    $amount_array[] = $current_rate;
                                }
                            }
                            

                            if (count($amount_array)) {
                                $b_min = $this->getMin($amount_array);
                                $b_max = $this->getMax($amount_array);

                                if ($b_min==$b_max) {
                                    $budget = " Budget: Rs.".$b_min;
                                }
                                else {
                                    $budget = " Budget: Rs.".$b_min." to Rs.".$b_max."";
                                }
                            }


                        

                        $i1 = array(
                            'requirement_id'=>$itemRow->requirement_id,
                            'property_id'=>$itemRow->property_id,
                            'state_name'=>$itemRow->state_name,
                            'city_name'=>$itemRow->city_name,
                            'location_name'=>$itemRow->location_name,
                            'product_type_name'=>$itemRow->product_type_name,
                            'unit_type_name'=>$itemRow->unit_type_name,
                            'project_name'=>$itemRow->project_name,
                            'type'=>$itemRow->type,
                            'budget'=>$budget,
                            'budget_min'=>$b_min,
                            'budget_max'=>$b_max,
                            'req_budget_min'=>$req_b_min,
                            'req_budget_max'=>$req_b_max,
                            'size'=>$size,
                            'accomodation_name'=>$item->accomodation_name
                        );

                        $items[] = $i1;

                        if ($b_min>=$req_b_min && $b_max<=$req_b_max) {
                            $property_items[] = $i1;
                        }
                    }

                    }
        }

            foreach ($property_items as $itemPrp) {
                $where = "requirement_id='".$itemPrp['requirement_id']."'";

                $this->db->select('requirement_id,tbl_requirements.created_at,lead_id,user_id,look_for,product_type_name,unit_type_name,accomodation_name,location,size_min,size_max,size_unit,remark,dor,lead_option_name as look_for,requirement_status,state_name,city_name,b_min.budget_name as budget_minimum,b_max.budget_name as budget_maximum,su.unit_name as size_unit_name');
                $this->db->from('tbl_requirements');
                $this->db->join('tbl_lead_options', 'tbl_lead_options.lead_option_id = tbl_requirements.look_for','left');
                $this->db->join('tbl_states', 'tbl_states.state_id = tbl_requirements.state_id','left');
                $this->db->join('tbl_city', 'tbl_city.city_id = tbl_requirements.city_id','left');
                $this->db->join('tbl_accomodations', 'tbl_accomodations.accomodation_id = tbl_requirements.accomodation_id','left');
                $this->db->join('tbl_product_types', 'tbl_product_types.product_type_id = tbl_requirements.product_type_id','left');
                $this->db->join('tbl_unit_types', 'tbl_unit_types.unit_type_id = tbl_requirements.unit_type_id','left');
                $this->db->join('tbl_budgets as b_min', 'b_min.budget_id = tbl_requirements.budget_min','left');
                $this->db->join('tbl_budgets as b_max', 'b_max.budget_id = tbl_requirements.budget_max','left');
                $this->db->join('tbl_units as su', 'su.unit_id = tbl_requirements.size_unit','left');
                $this->db->where($where);
                $query = $this->db->get();
                $feedback_data = $query->row();

                if ($feedback_data) {
                    $date_user = "";//$itemPrp->visit_date." & ".$itemPrp->visit_time." By ".ucwords($itemPrp->first_name." ".$itemPrp->last_name);

                    $this->db->select('*');
                    $this->db->from('tbl_feedbacks');
                    $this->db->join('tbl_users', 'tbl_users.user_id = tbl_feedbacks.account_id','left');
                    $this->db->where("requirement_id='".$itemPrp['requirement_id']."' AND property_id='".$itemPrp['requirement_id']."' AND type='".$itemPrp['type']."' AND lead_id='".$lead_id."'");
                    $query = $this->db->get();
                    $feedback_dd = $query->row();

                    $feedback_id = "";
                    $comment = "";
                    $visit_status = "";
                    if ($feedback_dd) {
                        $feedback_id = $feedback_dd->feedback_id;
                        $comment = $feedback_dd->comment;
                        $visit_status = ($feedback_dd->like_property)?'Yes':'No';
                        $date_user = $feedback_dd->visit_date." & ".$feedback_dd->visit_time." By ".ucwords($feedback_dd->first_name." ".$feedback_dd->last_name);
                    }

                    $feedback_list[] = array(
                        'feedback_id'=>$feedback_id,
                        'requirement_id'=>$itemPrp['requirement_id'],
                        'property_id'=>$itemPrp['property_id'],
                        'type'=>$itemPrp['type'],
                        'state_name'=>$itemPrp['state_name'],
                        'city_name'=>$itemPrp['city_name'],
                        'location_name'=>$itemPrp['location_name'],
                        'product_type_name'=>$itemPrp['product_type_name'],
                        'unit_type_name'=>$itemPrp['unit_type_name'],
                        'budget'=>$itemPrp['budget'],
                        "comment"=>$comment,
                        "visit_status"=>$visit_status,
                        "created_at"=>$feedback_data->created_at,
                        "accomodation_name"=>($itemPrp['accomodation_name'])?$itemPrp['accomodation_name']:'',
                        "size_min"=>$feedback_data->size_min,
                        "size_max"=>$feedback_data->size_max,
                        "size_unit"=>$feedback_data->size_unit_name,
                        'project_name'=>$itemPrp['project_name'],
                        "date_user"=>$date_user,
                        'size'=>$itemPrp['size']
                    );
                }
            }
        
            /*$where = "lead_id='".$lead_id."' AND tbl_feedbacks.account_id='".$account_id."' ORDER BY feedback_id DESC";

            $this->db->select('*');
            $this->db->from('tbl_feedbacks');
            $this->db->where($where);
            $this->db->join('tbl_users', 'tbl_users.user_id = tbl_feedbacks.user_id','left');
            $query = $this->db->get();
            $feedback_data = $query->result();

            if ($feedback_data) {
                foreach ($feedback_data as $item) {
                    $date_user = $item->visit_date." & ".$item->visit_time." By ".ucwords($item->first_name." ".$item->last_name);
                    $feedback_list[] = array(
                        "feedback_id"=>$item->feedback_id,
                        "comment"=>$item->comment,
                        "created_at"=>$item->created_at,
                        "date_user"=>$date_user
                    );
                }
            }*/
            $array = array('status'=>'success','message'=>'Data Found','feedback_list'=>$feedback_list);
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }



    public function get_agent_plan()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_users',"user_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function agent_plan_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_users',"user_id='".$id."'");

            $record_array = array(
                'no_of_user'=>$this->input->post('no_of_user'),
                'per_user_amount'=>$this->input->post('per_user_amount'),
                'monthly_cost'=>$this->input->post('monthly_cost'),
                'next_due_date'=>$this->input->post('next_due_date')
            );

            if ($record) {

                $this->Action_model->update_data($record_array,'tbl_users',"user_id='".$id."'");
                $this->session->set_flashdata('success_msg', 'Updated Successfully.');
                    $array = array('status'=>'success','message'=>'Updated Successfully!!');
            }
            else {
                $array = array('status'=>'error','message'=>'Agent Found');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }


    public function get_create_invoice()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            
            $where = "user_id='".$id."'";

            $this->db->select('tbl_users.*,tbl_states.state_name,tbl_city.city_name');
            $this->db->from('tbl_users');
            $this->db->join('tbl_states', 'tbl_states.state_id = tbl_users.state_id','left');
            $this->db->join('tbl_city', 'tbl_city.city_id = tbl_users.city_id','left');
            $this->db->where($where);
            $query = $this->db->get();
            $record = $query->row();

            if ($record) {

                $agent_name = ($record->is_individual)?ucwords($record->user_title.' '.$record->first_name.' '.$record->last_name):$record->firm_name;
                $record->agent_name = $agent_name;

                $record->monthly_cost = ($record->monthly_cost)?$record->monthly_cost:"";
                $record->invoice_date = date("d-m-Y");

                $where = "payment_id!='' ORDER BY payment_id DESC LIMIT 1";
                $inv_detail = $this->Action_model->select_single('tbl_payment',$where,'payment_id');

                $record->invoice_id = ($inv_detail && $inv_detail->payment_id)?($inv_detail->payment_id + 1):"";
                $record->current_plan_date = $record->next_due_date;
                $record->next_due_date = $this->getDates($record->next_due_date,1);

                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function invoice_save()
    {
        $this->load->library('pdf');

        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_users',"user_id='".$id."'");

            if ($record) {
                $mobile = $record->mobile;
                $email = $record->email;
                $address = $record->address_1;
                $address .= ($record->address_2)?"\n".$record->address_2:"";
                $address .= ($record->address_3)?"\n".$record->address_3:"";

                $per_user_amount = $this->input->post('inv_per_user_amount');
                $monthly_cost = $this->input->post('inv_monthly_cost');
                $no_of_user = $this->input->post('inv_no_of_user');

                $amt = $per_user_amount * $no_of_user;

                $net_amount = $amt + $monthly_cost;

                $order_id = md5(time()).rand(9999,99999).md5(rand(9999,99999));

                $payment_data = array(
                    'user_id' => $record->user_id,
                    'plan_id' => 2,
                    'no_of_user' => $no_of_user,
                    'total_amount' => $net_amount,
                    'amount_per_user' => $per_user_amount,
                    'monthly_cost' => $monthly_cost,
                    'payment_status' => 0,
                    'order_id' => $order_id,
                    'payment_getway' => '',
                    'paid_type' => '',
                    'create_at' => time(),
                    'entry_type'=>'2',
                    'invoice_type'=>'1',
                    'name' => $this->input->post('agent_name'),
                    'state' => $this->input->post('state_name'),
                    'city' => $this->input->post('city_name'),
                    'mobile' => $mobile,
                    'email' => $email,
                    'address' => $address,
                    'current_plan_date' => $this->input->post('inv_current_plan_date'),
                    'next_due_date' => $this->input->post('inv_next_due_date')
                );
                $payment_data['invoice_date'] = $this->input->post('invoice_date');
                $id=$this->Action_model->insert_data($payment_data,'tbl_payment');

                $invID = str_pad($id, 4, '0', STR_PAD_LEFT);
                $inv_update_array['invoice_id'] = $invID;
                $this->Action_model->update_data($inv_update_array,'tbl_payment',"payment_id='".$id."'");

                $pay_link = base_url('invoice-pay/'.$order_id);
                $expire_date = $record->next_due_date;
                $name = $this->Action_model->get_name($record->user_id);
                $mobile = $record->mobile;
                $date1 = new DateTime(date("d-m-Y")." 00:00:00");
                $date2 = new DateTime($expire_date." 00:00:00");
                $interval = $date1->diff($date2);
                $expire_days = $interval->days;

                $data['name'] = $name;
                $data['expire_date'] = $expire_date;
                $data['pay_link'] = $pay_link;

                $email_from = MAINEMAIL;
                $email_to = $record->email;
                $subject = SITE_TITLE." – your account will Expires";
                if ($record->next_due_date==date("d-m-Y")) {
                   $subject .= " Today";
                }
                else if (strtotime($record->next_due_date)<=time()) {
                    $subject .= " on ".$record->next_due_date;
                }
                else {
                    $subject .= " in Next ".$expire_days." Days";
                }
                $email_subject = $subject;
                $email_msg = $this->load->view('email/invoice_create',$data,true);

                /*$this->email->from($email_from, SITE_TITLE);
                $this->email->to($email_to);
                $this->email->subject($email_subject);
                $this->email->message($email_msg);
                $this->email->set_mailtype("html");
                $this->email->send();*/

                $data['email_from'] = $email_from;
                $data['email_to'] = $email_to;
                $data['email_subject'] = $email_subject;
                $data['email_msg'] = $email_msg;

                $this->db->select('*');
                $this->db->from('tbl_payment');
                $this->db->join('tbl_paid_type', "tbl_paid_type.paid_type_id = paid_type", 'left');
                $this->db->where("((entry_type='1' AND payment_status='1') OR (entry_type='2')) AND payment_id='".$id."'");
                $query = $this->db->get(); 
                $invoice_detail = $query->row();
                $data['invoice_detail'] = $invoice_detail;

                $where = "setting_id='1'";
                $setting = $this->Action_model->select_single('tbl_setting',$where);
                $data['setting'] = $setting;

                $data['pdf_send_mail'] = 1;

                $this->load->view('template/pdf/invoice',$data);

                $this->Action_model->sendMobileSMS($mobile,"Dear ".$name."
Greeting For the Day!
Thanks you for using Agent Diary for your Sales Management solution. We hope agent diary has been helping you in managing your leads and growing yours Sales in your Usage.
We regularly rollout, every month, new and interesting features that can further easy your sales management experience.
Your account will Expires in Next ".$expire_days." Days.
We would like to inform you that you account will expire on ".$expire_date.". Please Find the attachment of Performa invoice and use the below link to upgrade you account.
".$pay_link."
Our billing support team is available to support you, for any assistance. Please feel free to contact us at billing@agentdiary.com 
We wish you more lead more customers and more sales.
Thanks & Regards
https://www.agentdiary.com");

                $this->session->set_flashdata('success_msg', 'Invoice Created Successfully.');
                $array = array('status'=>'success','message'=>'Updated Successfully!!');
            }
            else {
                $array = array('status'=>'error','message'=>'Agent Not Found');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }


    public function get_cancel_invoice()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            
            $where = "payment_id='".$id."'";

            $this->db->select('tbl_payment.*');
            $this->db->from('tbl_payment');
            $this->db->where($where);
            $query = $this->db->get();
            $record = $query->row();

            if ($record) {

                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

     public function invoice_cancel()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $where = "payment_id='".$id."' AND payment_status='0'";

            $this->db->select('tbl_payment.*');
            $this->db->from('tbl_payment');
            $this->db->where($where);
            $query = $this->db->get();
            $record = $query->row();

            if ($record) {

                $payment_data = array(
                    'cancel_time' => time(),
                    'cancel_reason' => $this->input->post('cancel_reason'),
                    'payment_status' => 3
                );

                $this->Action_model->update_data($payment_data,'tbl_payment',$where);

                $this->session->set_flashdata('success_msg', 'Invoice Cancelled Successfully.');
                    $array = array('status'=>'success','message'=>'Invoice Cancelled Successfully.');
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function get_create_receipt()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            
            $where = "payment_id='".$id."'";

            $this->db->select('tbl_payment.*,state_name,city_name');
            $this->db->from('tbl_payment');
            $this->db->join('tbl_states', 'tbl_states.state_id = tbl_payment.state','left');
            $this->db->join('tbl_city', 'tbl_city.city_id = tbl_payment.city','left');
            $this->db->where($where);
            $query = $this->db->get();
            $record = $query->row();

            if ($record) {
                $record->receipt_date = date("d-m-Y");
                $record->monthly_cost = ($record->monthly_cost)?str_replace(".00", "", $record->monthly_cost):"";
                $record->amount_per_user = ($record->amount_per_user)?str_replace(".00", "", $record->amount_per_user):"";
                $record->total_amount = ($record->monthly_cost)?str_replace(".00", "", $record->total_amount):"";
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function receipt_save()
    {
        $this->load->library('pdf');
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $where = "payment_id='".$id."' AND payment_status='0'";

            $this->db->select('tbl_payment.*');
            $this->db->from('tbl_payment');
            $this->db->where($where);
            $query = $this->db->get();
            $pay_detail = $query->row();

            if ($pay_detail) {

                $where = "user_id='".$pay_detail->user_id."'";
                $user_detail = $this->Action_model->select_single('tbl_users',$where);

                $receipt_date = date("d-m-Y");

                $pay_array = array(
                    'paid_type' => ($this->input->post('receipt_paid_type'))?$this->input->post('receipt_paid_type'):'',
                    'txn_id' => ($this->input->post('receipt_txn_id'))?$this->input->post('receipt_txn_id'):'',
                    'cheque_no' => ($this->input->post('receipt_cheque_no'))?$this->input->post('receipt_cheque_no'):'',
                    'cheque_date' => ($this->input->post('receipt_cheque_date'))?$this->input->post('receipt_cheque_date'):'',
                    'bank_name' => ($this->input->post('receipt_bank_name'))?$this->input->post('receipt_bank_name'):'',
                    'receipt_remark' => ($this->input->post('receipt_remark'))?$this->input->post('receipt_remark'):'',
                    'payment_status' => 1,
                    'receipt_date' => $receipt_date
                );

                $update_array['per_user_amount'] = $pay_detail->amount_per_user;
                $update_array['monthly_cost'] = $pay_detail->monthly_cost;
                $update_array['no_of_user'] = $pay_detail->no_of_user;

                if ($user_detail->plan_id==1) {
                    $update_array['plan_id'] = 2;
                }

                $this->Action_model->update_data($pay_array,'tbl_payment',"payment_id='".$id."' AND payment_status='0'");

                $update_array['current_plan_date'] = $pay_detail->current_plan_date;
                $update_array['next_due_date'] = $pay_detail->next_due_date;

                $next_month = $pay_detail->next_due_date;

                //$this->Action_model->update_data($update_array,'tbl_users',array('user_id'=>$user_detail->user_id));

                $expire_date = $next_month;
                $name = $this->Action_model->get_name($user_detail->user_id);
                $mobile = $user_detail->mobile;
                $invoice_no = $pay_detail->invoice_id;
                $receipt_date = date("d-m-Y");
                $invoice_amount = "Rs.".str_replace(".00", "", $pay_detail->total_amount);
                $date1 = new DateTime(date("d-m-Y")." 00:00:00");
                $date2 = new DateTime($expire_date." 00:00:00");
                $interval = $date1->diff($date2);
                $expire_days = $interval->days;

                $data['name'] = $name;
                $data['expire_date'] = $expire_date;
                $data['invoice_no'] = $invoice_no;
                $data['receipt_date'] = $receipt_date;
                $data['invoice_amount'] = $invoice_amount;

                $email_from = MAINEMAIL;
                $email_to = $user_detail->email;
                $email_subject = "Invoice for Agent Diary Subscription (Invoice No: ".$invoice_no.")";
                $email_msg = $this->load->view('email/receipt',$data,true);

                /*$this->email->from($email_from, SITE_TITLE);
                $this->email->to($email_to);
                $this->email->subject($email_subject);
                $this->email->message($email_msg);
                $this->email->set_mailtype("html");
                $this->email->send();*/

                $data['email_from'] = $email_from;
                $data['email_to'] = $email_to;
                $data['email_subject'] = $email_subject;
                $data['email_msg'] = $email_msg;

                $this->db->select('*');
                $this->db->from('tbl_payment');
                $this->db->join('tbl_paid_type', "tbl_paid_type.paid_type_id = paid_type", 'left');
                $this->db->where("((entry_type='1' AND payment_status='1') OR (entry_type='2')) AND payment_id='".$id."'");
                $query = $this->db->get(); 
                $invoice_detail = $query->row();
                $data['invoice_detail'] = $invoice_detail;

                $where = "setting_id='1'";
                $setting = $this->Action_model->select_single('tbl_setting',$where);
                $data['setting'] = $setting;

                $data['pdf_send_mail'] = 1;

                $this->load->view('template/pdf/receipt',$data);

                $this->Action_model->sendMobileSMS($mobile,"Dear Agent, Thanks for Received ".$invoice_amount." Against Invoice No# ".$invoice_no."  , For Agent Diary Subscription");

                $this->session->set_flashdata('success_msg', 'Receipt Created Successfully.');
                    $array = array('status'=>'success','message'=>'Receipt Created Successfully.');
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    function getDates($startDate, $monthsToAdvance)
    {
        $dt = new DateTime($startDate);
        $day = $dt->format('d');
        $dt->setDate($dt->format('Y'),$dt->format('n'),1);
        $dt->add(new DateInterval('P'.$monthsToAdvance.'M'));
        $daysInMonth = $dt->format('t');
        if($day > $daysInMonth) $day = $daysInMonth;
        $dt->setDate($dt->format('Y'),$dt->format('n'),$day);
        return $dt->format('d-m-Y');
    }

    public function add_sms_agent()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $no_of_sms=$this->input->post('no_of_sms');
            $amount=$this->input->post('amount');
            $where = "user_id='".$id."'";

            $this->db->select('*');
            $this->db->from('tbl_users');
            $this->db->where($where);
            $query = $this->db->get();
            $record = $query->row();

            if ($record) {
                $sms_before = $record->no_of_sms;
                $net_no_of_sms = $sms_before + $no_of_sms;
                $sms_after = $net_no_of_sms;

                $user_data = array(
                    'no_of_sms' => $net_no_of_sms
                );

                $this->Action_model->update_data($user_data,'tbl_users',$where);

                $sms_credit_array = array(
                    'account_id' => $record->user_id,
                    'amount' => $amount,
                    'no_of_sms' => $no_of_sms,
                    'sms_before' => $sms_before,
                    'sms_after' => $sms_after,
                    'user_type' => 2,
                    'create_at' => date("d-m-Y H:i:s A")
                );

                $this->Action_model->insert_data($sms_credit_array,'tbl_sms_credit');

                $this->session->set_flashdata('success_msg', 'SMS Added Successfully.');
                    $array = array('status'=>'success','message'=>'SMS Added Successfully.');
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function sms_credit_list(){
        $id = $this->input->get('id');
        $postData = $this->input->post();
        $select = '*';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = "account_id='". $id."'";
         }
         else {
            $searchQuery = "account_id='". $id."'";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_sms_credit',$where,$select);

        echo json_encode($data);
    }

    public function sms_history_list(){
        $id = $this->input->get('id');
        $postData = $this->input->post();
        $select = '*';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = "account_id='". $id."'";
         }
         else {
            $searchQuery = "account_id='". $id."'";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_sms_history',$where,$select);

        echo json_encode($data);
    }

    public function send_invoice()
    {

        $this->load->library('pdf');
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $where = "payment_id='".$id."'";

            $this->db->select('*,tbl_users.next_due_date as next_due_date');
            $this->db->from('tbl_payment');
            $this->db->join('tbl_users', 'tbl_users.user_id = tbl_payment.user_id','left');
            $this->db->where($where);
            $query = $this->db->get();
            $record = $query->row();

            if ($record) {

                $pay_link = base_url('invoice-pay/'.$record->order_id);
                $expire_date = $record->next_due_date;
                $name = $this->Action_model->get_name($record->user_id);
                $mobile = $record->mobile;
                $date1 = new DateTime(date("d-m-Y")." 00:00:00");
                $date2 = new DateTime($expire_date." 00:00:00");
                $interval = $date1->diff($date2);
                $expire_days = $interval->days;

                $data['name'] = $name;
                $data['expire_date'] = $expire_date;
                $data['pay_link'] = $pay_link;

                //$dataFile = $_POST['data'];

                //$dataFile = str_replace('data:application/pdf;base64,', '', $dataFile);
                //$dataFile = str_replace(' ', '+', $dataFile);

                //$dataFile = base64_decode($dataFile);
                //$str_file = 'uploads/tmppdf/'.$id.".pdf";
                //file_put_contents( $str_file, $dataFile);

                $email_from = MAINEMAIL;
                $email_to = $record->email;
                $subject = SITE_TITLE." – your account will Expires";
                if ($record->next_due_date==date("d-m-Y")) {
                   $subject .= " Today";
                }
                else if (strtotime($record->next_due_date)<=time()) {
                    $subject .= " on ".$record->next_due_date;
                }
                else {
                    $subject .= " in Next ".$expire_days." Days";
                }
                $email_subject = $subject;
                $email_msg = $this->load->view('email/invoice_create',$data,true);

                /*$this->email->from($email_from, SITE_TITLE);
                $this->email->to($email_to);
                $this->email->subject($email_subject);
                $this->email->message($email_msg);
                $this->email->set_mailtype("html");
                $this->email->attach(base_url($str_file));
                $this->email->send();*/
                $data['email_from'] = $email_from;
                $data['email_to'] = $email_to;
                $data['email_subject'] = $email_subject;
                $data['email_msg'] = $email_msg;

                $this->db->select('*');
                $this->db->from('tbl_payment');
                $this->db->join('tbl_paid_type', "tbl_paid_type.paid_type_id = paid_type", 'left');
                $this->db->where("((entry_type='1' AND payment_status='1') OR (entry_type='2')) AND payment_id='".$id."'");
                $query = $this->db->get(); 
                $invoice_detail = $query->row();
                $data['invoice_detail'] = $invoice_detail;

                $where = "setting_id='1'";
                $setting = $this->Action_model->select_single('tbl_setting',$where);
                $data['setting'] = $setting;

                $data['pdf_send_mail'] = 1;

                $this->load->view('template/pdf/invoice',$data);

                $array = array('status'=>'success','message'=>'Invoice Sent Successfully');
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function send_receipt()
    {
        $this->load->library('pdf');
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $where = "payment_id='".$id."'";

            $this->db->select('*,tbl_users.next_due_date as next_due_date');
            $this->db->from('tbl_payment');
            $this->db->join('tbl_users', 'tbl_users.user_id = tbl_payment.user_id','left');
            $this->db->where($where);
            $query = $this->db->get();
            $record = $query->row();

            if ($record) {

                $expire_date = $record->next_due_date;
                $name = $this->Action_model->get_name($record->user_id);
                $mobile = $record->mobile;
                $invoice_no = $record->invoice_id;
                $receipt_date = date("d-m-Y");
                $invoice_amount = "Rs.".str_replace(".00", "", $record->total_amount);
                $date1 = new DateTime(date("d-m-Y")." 00:00:00");
                $date2 = new DateTime($expire_date." 00:00:00");
                $interval = $date1->diff($date2);
                $expire_days = $interval->days;

                $data['name'] = $name;
                $data['expire_date'] = $expire_date;
                $data['invoice_no'] = $invoice_no;
                $data['receipt_date'] = $receipt_date;
                $data['invoice_amount'] = $invoice_amount;

                

                //$dataFile = $_POST['data'];

                //$dataFile = str_replace('data:application/pdf;base64,', '', $dataFile);
                //$dataFile = str_replace(' ', '+', $dataFile);

                //$dataFile = base64_decode($dataFile);
                //$str_file = 'uploads/tmppdf/'.$id.".pdf";
                //file_put_contents( $str_file, $dataFile);

                $email_from = MAINEMAIL;
                $email_to = $record->email;
                $email_subject = "Invoice for Agent Diary Subscription (Invoice No: ".$invoice_no.")";
                $email_msg = $this->load->view('email/receipt',$data,true);

                /*$this->email->from($email_from, SITE_TITLE);
                $this->email->to($email_to);
                $this->email->subject($email_subject);
                $this->email->message($email_msg);
                $this->email->set_mailtype("html");
                $this->email->attach(base_url($str_file));
                $this->email->send();*/

                $data['email_from'] = $email_from;
                $data['email_to'] = $email_to;
                $data['email_subject'] = $email_subject;
                $data['email_msg'] = $email_msg;

                $this->db->select('*');
                $this->db->from('tbl_payment');
                $this->db->join('tbl_paid_type', "tbl_paid_type.paid_type_id = paid_type", 'left');
                $this->db->where("((entry_type='1' AND payment_status='1') OR (entry_type='2')) AND payment_id='".$id."'");
                $query = $this->db->get(); 
                $invoice_detail = $query->row();
                $data['invoice_detail'] = $invoice_detail;

                $where = "setting_id='1'";
                $setting = $this->Action_model->select_single('tbl_setting',$where);
                $data['setting'] = $setting;

                $data['pdf_send_mail'] = 1;

                $this->load->view('template/pdf/receipt',$data);

                $array = array('status'=>'success','message'=>'Receipt Sent Successfully');
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    /* template start */
    public function template_list(){
     
        $postData = $this->input->post();
        $select = 'template_id,template_name,template_status,template_type,template_message,disable_delete';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
         if($searchValue != ''){
            $searchQuery = " (template_name like '%".$searchValue."%' ) ";
         }
        $data = $this->Action_model->ajaxDatatable($postData,$searchQuery,'tbl_templates',$where,$select);

        echo json_encode($data);
    }

    public function get_template()
    {
        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_templates',"template_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record);
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function template_process()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_templates',"template_id='".$id."'");

            $record_array = array(
                'template_name'=>$this->input->post('template_name'),
                'template_status'=>$this->input->post('template_status'),
                'template_message'=>$this->input->post('template_message'),
                'template_type'=>$this->input->post('template_type'),
                'template_subject'=>$this->input->post('template_subject')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_templates',"template_name='".$this->input->post('template_name')."' AND template_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This Template is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_templates',"template_id='".$id."'");
                    $array = array('status'=>'added','message'=>'Template Updated Successfully!!');
                }
            }
            else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_templates',"template_name='".$this->input->post('template_name')."'")) {
                    $array = array('status'=>'error','message'=>'This Template is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_templates');
                    $array = array('status'=>'added','message'=>'Template Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function delete_template()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_templates',"template_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_templates',"template_id='".$id."'");
                $array = array('status'=>'added','message'=>'Template Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }
    /* template end */


    public function get_sms_form()
    {
        $array = array();

        if ($this->input->post()) {
            $type = $this->input->post('type');
            $where = "template_status='1' AND user_id='0' AND user_id='0' AND template_type='".$type."'";
            $template_data = $this->Action_model->detail_result('tbl_templates',$where);
            $template_list = array();
            if ($template_data) {
                $template_list = $template_data;
            }

            $array = array('status'=>'success','message'=>'Success','template_list'=>$template_list);
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function send_sms_whatsapp_email()
    {
        $array = array();
        $type = $this->input->post('type');
        $user_id = $this->input->post('user_id');
        $send_to = $this->input->post('send_to');
        $message = $this->input->post('message');
        $subject = $this->input->post('subject');
        $send_type = $this->input->post('send_type');

        if($send_type=="lead") {

            $where = "lead_id='".$user_id."'";
            $user_detail = $this->Action_model->select_single('tbl_leads',$where,"*,CONCAT(lead_first_name, ' ', lead_last_name) AS lead_name");

            if ($user_detail) {
                $message = str_replace("[customer_name]", $user_detail->lead_name, $message);
                $message = str_replace("[customer_email]", $user_detail->lead_email, $message);
                $message = str_replace("[customer_mobile]", $user_detail->lead_mobile_no, $message);
            }
        }
        else if($send_type=="agent") {

            $where = "user_id='".$user_id."'";
            $user_detail = $this->Action_model->select_single('tbl_users',$where);

            if ($user_detail) {
                $message = str_replace("[name]", $this->Action_model->get_name($user_detail->user_id), $message);
                $message = str_replace("[email]", $user_detail->email, $message);
                $message = str_replace("[mobile]", $user_detail->mobile, $message);
                $message = str_replace("[expire_date]", $user_detail->next_due_date, $message);
            }
        }
        else {

            $where = "user_id='".$user_id."'";
            $user_detail = $this->Action_model->select_single('tbl_users',$where);

            if ($user_detail) {
                $message = str_replace("[name]", $this->Action_model->get_name($user_detail->user_id), $message);
                $message = str_replace("[email]", $user_detail->email, $message);
                $message = str_replace("[mobile]", $user_detail->mobile, $message);
                $message = str_replace("[expire_date]", $user_detail->next_due_date, $message);
            }
        }

        //echo $message;exit;

        if ($this->input->post()) {
            $msg = "";
            if ($type=="1") {
                $msg = "SMS Sent Successfully";
                $sms_response = $this->Action_model->sendMobileSMS($send_to,$message,true);
                if ($sms_response) {
                    $sms_response_array = json_decode($sms_response);
                    if ($sms_response_array && isset($sms_response_array->status) && $sms_response_array->status=="success") {

                        $array = array('status'=>'success','message'=>$msg);
                    }
                    else {
                        $array = array('status'=>'error','message'=>"SMS API Error, Please Try Again");
                    }
                }
                else {
                    $array = array('status'=>'error','message'=>"SMS API Error, Please Try Again");
                }
            }
            else if ($type=="2") {
                $msg = "Email Sent Successfully";
                $result_status = $this->Action_model->send_mail($send_to,$subject,$message);
                if ($result_status) {
                    $array = array('status'=>'success','message'=>$msg);
                }
                else {
                    $array = array('status'=>'error','message'=>"Error in sending email, Please Try Again");
                }
            }
            else if ($type=="3") {
                $msg = "Whatsapp Message Sent Successfully";
                $result_status = $this->Action_model->sendWhatsappMessage($send_to,$message);
                if ($result_status) {
                    $array = array('status'=>'success','message'=>$msg);
                }
                else {
                    $array = array('status'=>'error','message'=>"Whatsapp API Error, Please Try Again");
                }
            }

            
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }


    /* product start */
    public function get_product_list()
    {
        $array = array();

        if ($this->input->post()) {

            //$account_id = getAccountId();

            //if ($account_id) {
                $filter_by = $this->input->post('filter_by');
                $page=$this->input->post('page');

                $limit = 10;
                $total_pages = 0;
                $start = 0;
                $next_page = 0;
                $start = ($page-1)*$limit;

                $where = "tbl_product_unit_details.product_unit_detail_id!=''";
                $this->db->select("count(tbl_product_unit_details.product_unit_detail_id) as total_records");
                $this->db->from('tbl_product_unit_details');
                $this->db->join('tbl_products as p', 'p.product_id = tbl_product_unit_details.product_id','left');
                $this->db->join('tbl_project_share', "tbl_project_share.project_id = p.product_id",'left');
                $this->db->where($where);
                $query = $this->db->get();
                $record_all = $query->row();

                $total_records = 0;
                if ($record_all) {
                    $total_records = $record_all->total_records;
                    $total_pages = ceil($total_records/$limit);
                }


                $where = "pud.product_unit_detail_id!=''";
                if ($filter_by==1) {
                    //$where.=" ORDER BY lead_name";
                }
                else if ($filter_by==2) {
                    //$where.=" ORDER BY lead_date";
                }
                else if ($filter_by==3) {
                    //$where.=" ORDER BY lead_status DESC";
                }
                else if ($filter_by==4) {
                    //$where.=" ORDER BY lead_status ASC";
                }
                else {
                    //$where.=" ORDER BY STR_TO_DATE(lead_date,'%d-%m-%Y') DESC";
                    $where.=" ORDER BY pud.created_at DESC";
                }

                $where.=" limit ".$start.",".$limit;
                $this->db->select("pud.product_unit_detail_id,tbl_product_types.product_type_name,tbl_unit_types.unit_type_name,tbl_city.city_name,tbl_states.state_name,tbl_locations.location_name,tbl_accomodations.accomodation_name,pud.project_type,pud.property_type,pud.sa,pud.plot_size,pud.plot_unit,punit.unit_name as plot_unit_name,sa_unit.unit_name as sa_unit_name,pud.basic_cost,p.b_cost_unit");
                $this->db->from('tbl_product_unit_details as pud');
                $this->db->join('tbl_products as p', 'p.product_id = pud.product_id','left');
                $this->db->join('tbl_product_types','tbl_product_types.product_type_id=p.project_type','left');
                $this->db->join('tbl_unit_types','tbl_unit_types.unit_type_id=p.property_type','left');
                $this->db->join('tbl_states', 'tbl_states.state_id = p.state_id','left');
                $this->db->join('tbl_city', 'tbl_city.city_id = p.city_id','left');
                $this->db->join('tbl_locations', 'tbl_locations.location_id = p.location','left');
                $this->db->join('tbl_accomodations', 'tbl_accomodations.accomodation_id = pud.accomodation','left');
                $this->db->join('tbl_units as punit', 'punit.unit_id = pud.plot_unit','left');
                $this->db->join('tbl_units as sa_unit', 'sa_unit.unit_id = pud.unit','left');
                $this->db->join('tbl_project_share', "tbl_project_share.project_id = p.product_id",'left');
                $this->db->where($where);
                $query = $this->db->get();
                $record_data = $query->result();

                $records = array();
                if ($record_data) {
                    foreach ($record_data as $item) {

                        $next_followup = "";
                        $next_followup_date = "";


                        $size = "";
                        $budget = "";

                        if($item->project_type==2){
                            
                            if(($item->property_type==1 || $item->property_type==7) && $item->sa){
                                $size = $item->sa;
                                if ($item->sa_unit_name) {
                                    $size .= ' '.$item->sa_unit_name;
                                }
                            }
                            if(($item->property_type==2 || $item->property_type==3) && $item->plot_size){
                                $size = $item->plot_size;
                                if ($item->plot_unit_name) {
                                    $size .= ' '.$item->plot_unit_name;
                                }
                            }
                        }

                        if($item->project_type==3 && $item->sa){
                                $size = $item->sa;
                                if ($item->sa_unit_name) {
                                    $size .= ' '.$item->sa_unit_name;
                                }
                        }

                        $this->db->select('*');
                        $this->db->from('tbl_inventory');
                        $this->db->join('tbl_basic_cost', 'tbl_basic_cost.inventory_id = tbl_inventory.inventory_id','left');
                        $this->db->where("unit_code='".$item->product_unit_detail_id."'");
                        $query = $this->db->get();
                        $item_inv_data = $query->result();
                        $o=0;

                        $amount_array = array();
                        foreach ($item_inv_data as $itemInv) {
                            $current_rate = 0;
                            if ($itemInv->basic_cost_id) {

                                $b_cost_unit = $itemInv->current_rate_unit;
                                if ($itemInv->current_rate) {
                                    //$current_rate += $itemInv->current_rate;

                                    // residencial
                                    if($item->project_type==2){
                                        
                                        // for flat
                                        if(($item->property_type==1 || $item->property_type==7)){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                            if ($b_cost_unit=='2') {// for Sq.Ft
                                                $current_rate = $item->sa*$itemInv->current_rate;
                                            }
                                            else if ($b_cost_unit=='5') {// for Fix
                                                $current_rate = $itemInv->current_rate;
                                            }
                                        }
                                        // for plot
                                        else if(($item->property_type==2 || $item->property_type==3)){
                                            //$size = $item->plot_size;
                                            //if ($item->plot_unit_name) {
                                            //    $size .= ' '.$item->plot_unit_name;
                                            //}
                                            if ($b_cost_unit=='1') {// for Sq.Yd
                                                $current_rate = $item->plot_size*$itemInv->current_rate;
                                            }
                                            else if ($b_cost_unit=='2') {// for Sq.Ft
                                                $current_rate += $item->construction_area*$itemInv->current_rate;
                                            } 
                                            else if ($b_cost_unit=='5') {// for Fix
                                                $current_rate = $itemInv->current_rate;
                                            }
                                        }
                                    }
                                    // commercial
                                    else if($item->project_type==3){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                        if ($b_cost_unit=='2') {// for Sq.Ft
                                            $current_rate = $item->sa*$itemInv->current_rate;
                                        }
                                        else if ($b_cost_unit=='5') {// for Fix
                                            $current_rate = $itemInv->current_rate;
                                        }
                                    }
                                }
                            }
                            else {

                                $b_cost_unit = $item->b_cost_unit;

                                if ($item->basic_cost) {

                                    // residencial
                                    if($item->project_type==2){
                                        // for flat
                                        if(($item->property_type==1 || $item->property_type==7)){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                            if ($b_cost_unit=='2') {// for Sq.Ft
                                                $current_rate = $item->sa*$item->basic_cost;
                                            }
                                            else if ($b_cost_unit=='5') {// for Fix
                                                $current_rate = $item->basic_cost;
                                            }
                                        }
                                        // for plot
                                        else if(($item->property_type==2 || $item->property_type==3)){
                                            //$size = $item->plot_size;
                                            //if ($item->plot_unit_name) {
                                            //    $size .= ' '.$item->plot_unit_name;
                                            //}
                                            if ($b_cost_unit=='1') {// for Sq.Yd
                                                $current_rate = $item->plot_size*$item->basic_cost;
                                            }
                                            else if ($b_cost_unit=='2') {// for Sq.Ft
                                                $current_rate = $item->construction_area*$item->basic_cost;
                                            } 
                                            else if ($b_cost_unit=='5') {// for Fix
                                                $current_rate = $item->basic_cost;
                                            }
                                        }
                                    }
                                    // commercial
                                    else if($item->project_type==3){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                        if ($b_cost_unit=='2') {// for Sq.Ft
                                            $current_rate = $item->sa*$item->basic_cost;
                                        }
                                        else if ($b_cost_unit=='5') {// for Fix
                                            $current_rate = $item->basic_cost;
                                        }
                                    }
                                }
                            }

                            if ($current_rate) {
                                $amount_array[] = $current_rate;
                            }
                        }

                        $budget = count($amount_array);
                        if (count($amount_array)) {
                            $b_min = $this->getMin($amount_array);
                            $b_max = $this->getMax($amount_array);

                            if ($b_min==$b_max) {
                                $budget = " Budget: ₹".$b_min;
                            }
                            else {
                                $budget = " Budget: ₹".$b_min." to ₹".$b_max."";
                            }
                        }

                        /*$this->db->select('*');
                        $this->db->from('tbl_inventory');
                        $this->db->join('tbl_basic_cost', 'tbl_basic_cost.inventory_id = tbl_inventory.inventory_id','left');
                        $this->db->where("unit_code='".$item->product_unit_detail_id."'");
                        $query = $this->db->get();
                        $item_inv_data = $query->result();
                        $o=0;
                        $current_rate = 0;
                        foreach ($item_inv_data as $itemInv) {
                            if ($itemInv->basic_cost_id) {
                                if ($itemInv->current_rate) {
                                    //$current_rate += $itemInv->current_rate;

                                    if($item->project_type==2){
                            
                                        if(($item->property_type==1 || $item->property_type==7)){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                            if ($b_cost_unit=='2') {
                                                $current_rate += $item->sa*$itemInv->current_rate;
                                            }
                                            else if ($b_cost_unit=='5') {
                                                $current_rate += $item->basic_cost;
                                            }
                                        }
                                        else if(($item->property_type==2 || $item->property_type==3)){
                                            //$size = $item->plot_size;
                                            //if ($item->plot_unit_name) {
                                            //    $size .= ' '.$item->plot_unit_name;
                                            //}
                                            if ($b_cost_unit=='1') {
                                                $current_rate += $item->plot_size*$itemInv->current_rate;
                                            }
                                            else if ($b_cost_unit=='2') {
                                                $current_rate += $item->construction_area*$itemInv->current_rate;
                                            } 
                                            else if ($b_cost_unit=='5') {
                                                $current_rate += $itemInv->current_rate;
                                            }
                                        }
                                    }
                                    else if($item->project_type==3){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                        if ($b_cost_unit=='2') {
                                            $current_rate += $item->sa*$itemInv->current_rate;
                                        }
                                        else if ($b_cost_unit=='5') {
                                            $current_rate += $itemInv->current_rate;
                                        }
                                    }
                                }
                            }
                            else {
                                if ($item->basic_cost) {

                                    if($item->project_type==2){
                            
                                        if(($item->property_type==1 || $item->property_type==7)){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                            if ($b_cost_unit=='2') {
                                                $current_rate += $item->sa*$item->basic_cost;
                                            }
                                            else if ($b_cost_unit=='5') {
                                                $current_rate += $item->basic_cost;
                                            }
                                        }
                                        else if(($item->property_type==2 || $item->property_type==3)){
                                            //$size = $item->plot_size;
                                            //if ($item->plot_unit_name) {
                                            //    $size .= ' '.$item->plot_unit_name;
                                            //}
                                            if ($b_cost_unit=='1') {
                                                $current_rate += $item->plot_size*$item->basic_cost;
                                            }
                                            else if ($b_cost_unit=='2') {
                                                $current_rate += $item->construction_area*$item->basic_cost;
                                            } 
                                            else if ($b_cost_unit=='5') {
                                                $current_rate += $item->basic_cost;
                                            }
                                        }
                                    }
                                    else if($item->project_type==3){
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                        if ($b_cost_unit=='2') {
                                            $current_rate += $item->sa*$item->basic_cost;
                                        }
                                        else if ($b_cost_unit=='5') {
                                            $current_rate += $item->basic_cost;
                                        }
                                    }
                                }
                            }
                        }*/


                        /*$current_rate = 0;

                        if ($item->basic_cost) {

                            if($item->project_type==2){
                    
                                if(($item->property_type==1 || $item->property_type==7)){
                                    //$size = $item->sa;
                                    //if ($item->sa_unit_name) {
                                    //    $size .= ' '.$item->sa_unit_name;
                                    //}

                                    if ($b_cost_unit=='2' && $item->sa) {
                                        $current_rate = $item->sa*$item->basic_cost;
                                    }
                                    else if ($b_cost_unit=='5') {
                                        $current_rate = $item->basic_cost;
                                    }
                                }
                                else if(($item->property_type==2 || $item->property_type==3)){
                                    //$size = $item->plot_size;
                                    //if ($item->plot_unit_name) {
                                    //    $size .= ' '.$item->plot_unit_name;
                                    //}
                                    if ($b_cost_unit=='1' && $item->plot_size) {
                                        $current_rate = $item->plot_size*$item->basic_cost;
                                    }
                                    else if ($b_cost_unit=='2' && $item->construction_area) {
                                        $current_rate = $item->construction_area*$item->basic_cost;
                                    } 
                                    else if ($b_cost_unit=='5') {
                                        $current_rate = $item->basic_cost;
                                    }
                                }
                            }
                            else if($item->project_type==3){
                                    //$size = $item->sa;
                                    //if ($item->sa_unit_name) {
                                    //    $size .= ' '.$item->sa_unit_name;
                                    //}

                                if ($b_cost_unit=='2' && $item->sa) {
                                    $current_rate = $item->sa*$item->basic_cost;
                                }
                                else if ($b_cost_unit=='5') {
                                    $current_rate = $item->basic_cost;
                                }
                            }
                        }
                        $budget = $current_rate;*/

                        $bottom_label = $size.(($size)?', ':' ').$budget;

                        $records[] = array(
                            'product_unit_detail_id'=>$item->product_unit_detail_id,
                            "accomodation_name"=>(!$item->accomodation_name)?'':$item->accomodation_name,
                            'product_type_name'=>($item->product_type_name)?$item->product_type_name:'',
                            'unit_type_name'=>($item->unit_type_name)?$item->unit_type_name:'',
                            "city_name"=>(!$item->city_name)?'':$item->city_name,
                            "state_name"=>(!$item->state_name)?'':$item->state_name,
                            "location_name"=>(!$item->location_name)?'':$item->location_name,
                            'bottom_label'=>$bottom_label,
                            /*'lead_title'=>$item->lead_title,
                            'lead_first_name'=>$item->lead_first_name,
                            'lead_last_name'=>$item->lead_last_name,
                            'lead_date'=>$item->lead_date,
                            'next_followup_date'=>$next_followup_date,
                            'lead_mobile_no'=>$item->lead_mobile_no,
                            'lead_stage_name'=>(!$item->lead_stage_name)?'':$item->lead_stage_name,
                            'lead_source_name'=>(!$item->lead_source_name)?'':$item->lead_source_name,
                            'lead_email'=>$item->lead_email,
                            'next_followup'=>$next_followup*/
                        );
                    }
                }

                if ($total_pages!=$page) {
                    $next_page = $page+1;
                }
                $array = array('status'=>'success','message'=>'Lead Found','records'=>$records,'total_records'=>$total_records,'total_pages'=>$total_pages,'next_page'=>$next_page,'records'=>$records);
            
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    } 

    public function get_product_unit_single()
    {

        if ($this->input->post()) {
            $id=$this->input->post('id');

            $where="pud.product_unit_detail_id='".$id."'";

            $this->db->select("pud.product_unit_detail_id,pud.no_of_bathroom,pud.no_of_unit,pud.ca,pud.ba,pud.sa,p.description,tbl_product_types.product_type_name,tbl_unit_types.unit_type_name,tbl_city.city_name,tbl_states.state_name,tbl_locations.location_name,tbl_accomodations.accomodation_name,p.product_id,p.project_name,p.no_of_tower,p.cc_certificate,p.oc_certificate,p.parking_open,p.o_price,p.parking_stilt,p.s_price,p.parking_basment,p.b_price,p.parking_gst,tbl_builders.firm_name as b_firm_name,p.project_type,p.property_type,pud.sa,pud.plot_size,pud.plot_unit,punit.unit_name as plot_unit_name,sa_unit.unit_name as sa_unit_name,pud.basic_cost,p.b_cost_unit");
            $this->db->from('tbl_product_unit_details as pud');
            $this->db->join('tbl_products as p', 'p.product_id = pud.product_id','left');
            $this->db->join('tbl_product_types','tbl_product_types.product_type_id=p.project_type','left');
            $this->db->join('tbl_unit_types','tbl_unit_types.unit_type_id=p.property_type','left');
            $this->db->join('tbl_states', 'tbl_states.state_id = p.state_id','left');
            $this->db->join('tbl_city', 'tbl_city.city_id = p.city_id','left');
            $this->db->join('tbl_locations', 'tbl_locations.location_id = p.location','left');
            $this->db->join('tbl_accomodations', 'tbl_accomodations.accomodation_id = pud.accomodation','left');
            $this->db->join('tbl_builders', 'tbl_builders.builder_id = p.builder_id','left');
            $this->db->join('tbl_units as punit', 'punit.unit_id = pud.plot_unit','left');
            $this->db->join('tbl_units as sa_unit', 'sa_unit.unit_id = pud.unit','left');
                $this->db->join('tbl_project_share', "tbl_project_share.project_id = p.product_id",'left');
            $this->db->where($where);
            $query = $this->db->get();
            $record = $query->row();

            if ($record) {
                $item=$record;
                $size = "";
                $budget = "";

                if($item->project_type==2){
                    
                    if(($item->property_type==1 || $item->property_type==7) && $item->sa){
                        $size = $item->sa;
                        if ($item->sa_unit_name) {
                            $size .= ' '.$item->sa_unit_name;
                        }
                    }
                    if(($item->property_type==2 || $item->property_type==3) && $item->plot_size){
                        $size = $item->plot_size;
                        if ($item->plot_unit_name) {
                            $size .= ' '.$item->plot_unit_name;
                        }
                    }
                }

                if($item->project_type==3 && $item->sa){
                        $size = $item->sa;
                        if ($item->sa_unit_name) {
                            $size .= ' '.$item->sa_unit_name;
                        }
                }

                $this->db->select('*');
                $this->db->from('tbl_inventory');
                $this->db->join('tbl_basic_cost', 'tbl_basic_cost.inventory_id = tbl_inventory.inventory_id','left');
                $this->db->where("unit_code='".$item->product_unit_detail_id."'");
                $query = $this->db->get();
                $item_inv_data = $query->result();
                $o=0;

                $amount_array = array();
                foreach ($item_inv_data as $itemInv) {
                    $current_rate = 0;
                    if ($itemInv->basic_cost_id) {

                        $b_cost_unit = $itemInv->current_rate_unit;
                        if ($itemInv->current_rate) {
                            //$current_rate += $itemInv->current_rate;

                            // residencial
                            if($item->project_type==2){
                                
                                // for flat
                                if(($item->property_type==1 || $item->property_type==7)){
                                    //$size = $item->sa;
                                    //if ($item->sa_unit_name) {
                                    //    $size .= ' '.$item->sa_unit_name;
                                    //}

                                    if ($b_cost_unit=='2') {// for Sq.Ft
                                        $current_rate = $item->sa*$itemInv->current_rate;
                                    }
                                    else if ($b_cost_unit=='5') {// for Fix
                                        $current_rate = $itemInv->current_rate;
                                    }
                                }
                                // for plot
                                else if(($item->property_type==2 || $item->property_type==3)){
                                    //$size = $item->plot_size;
                                    //if ($item->plot_unit_name) {
                                    //    $size .= ' '.$item->plot_unit_name;
                                    //}
                                    if ($b_cost_unit=='1') {// for Sq.Yd
                                        $current_rate = $item->plot_size*$itemInv->current_rate;
                                    }
                                    else if ($b_cost_unit=='2') {// for Sq.Ft
                                        $current_rate += $item->construction_area*$itemInv->current_rate;
                                    } 
                                    else if ($b_cost_unit=='5') {// for Fix
                                        $current_rate = $itemInv->current_rate;
                                    }
                                }
                            }
                            // commercial
                            else if($item->project_type==3){
                                    //$size = $item->sa;
                                    //if ($item->sa_unit_name) {
                                    //    $size .= ' '.$item->sa_unit_name;
                                    //}

                                if ($b_cost_unit=='2') {// for Sq.Ft
                                    $current_rate = $item->sa*$itemInv->current_rate;
                                }
                                else if ($b_cost_unit=='5') {// for Fix
                                    $current_rate = $itemInv->current_rate;
                                }
                            }
                        }
                    }
                    else {

                        $b_cost_unit = $item->b_cost_unit;

                        if ($item->basic_cost) {

                            // residencial
                            if($item->project_type==2){
                                // for flat
                                if(($item->property_type==1 || $item->property_type==7)){
                                    //$size = $item->sa;
                                    //if ($item->sa_unit_name) {
                                    //    $size .= ' '.$item->sa_unit_name;
                                    //}

                                    if ($b_cost_unit=='2') {// for Sq.Ft
                                        $current_rate = $item->sa*$item->basic_cost;
                                    }
                                    else if ($b_cost_unit=='5') {// for Fix
                                        $current_rate = $item->basic_cost;
                                    }
                                }
                                // for plot
                                else if(($item->property_type==2 || $item->property_type==3)){
                                    //$size = $item->plot_size;
                                    //if ($item->plot_unit_name) {
                                    //    $size .= ' '.$item->plot_unit_name;
                                    //}
                                    if ($b_cost_unit=='1') {// for Sq.Yd
                                        $current_rate = $item->plot_size*$item->basic_cost;
                                    }
                                    else if ($b_cost_unit=='2') {// for Sq.Ft
                                        $current_rate = $item->construction_area*$item->basic_cost;
                                    } 
                                    else if ($b_cost_unit=='5') {// for Fix
                                        $current_rate = $item->basic_cost;
                                    }
                                }
                            }
                            // commercial
                            else if($item->project_type==3){
                                    //$size = $item->sa;
                                    //if ($item->sa_unit_name) {
                                    //    $size .= ' '.$item->sa_unit_name;
                                    //}

                                if ($b_cost_unit=='2') {// for Sq.Ft
                                    $current_rate = $item->sa*$item->basic_cost;
                                }
                                else if ($b_cost_unit=='5') {// for Fix
                                    $current_rate = $item->basic_cost;
                                }
                            }
                        }
                    }

                    if ($current_rate) {
                        $amount_array[] = $current_rate;
                    }
                }

                $budget = count($amount_array);
                if (count($amount_array)) {
                    $b_min = $this->getMin($amount_array);
                    $b_max = $this->getMax($amount_array);

                    if ($b_min==$b_max) {
                        $budget = "₹".$b_min;
                    }
                    else {
                        $budget = "₹".$b_min." to ₹".$b_max."";
                    }
                }
                $data['size'] = $size;
                $data['budget'] = $budget;

                $where = "product_id='".$record->product_id."'";
                $this->db->select('*');
                $this->db->from('tbl_product_additional_details');
                $this->db->join('tbl_price_components', 'tbl_price_components.price_component_id = tbl_product_additional_details.price_comp_id','left');
                $this->db->join('tbl_units', 'tbl_units.unit_id = tbl_product_additional_details.unit','left');
                $this->db->where($where);
                $query = $this->db->get();
                $additional_details = $query->result();
                $data['additional_details'] = $additional_details;

                $where = "product_id='".$record->product_id."'";
                $this->db->select('*');
                $this->db->from('tbl_product_plc_details');
                $this->db->join('tbl_price_components', 'tbl_price_components.price_component_id = tbl_product_plc_details.price_comp_id','left');
                $this->db->join('tbl_units', 'tbl_units.unit_id = tbl_product_plc_details.unit','left');
                $this->db->where($where);
                $query = $this->db->get();
                $plc_details = $query->result();
                $data['plc_details'] = $plc_details;

                $data['record'] = $record;
                $this->load->view(AGENT_URL.'get_product_unit_single',$data);
            }
            else {
                echo 'error';
            }
        }
        else { 
           echo 'error';
        }
        
    }

    public function get_product_amenities_list()
    {
        $array = array();
        $items = array();

        if ($this->input->post()) {

            $id=$this->input->post('id');
            $where = "product_id='".$id."'";
            $product_data = $this->Action_model->select_single('tbl_products',$where);

            if ($product_data && $product_data->amenitie) {
                $amenitie_ids = $product_data->amenitie;

                $where = "amenitie_id IN (".$amenitie_ids.")";

                $this->db->select('*');
                $this->db->from('tbl_amenities');
                $this->db->where($where);
                $query = $this->db->get();
                $item_data = $query->result();

                if ($item_data) {
                    foreach ($item_data as $item) {
                        $items[] = array(
                            "image"=>base_url('uploads/images/amenitie/'.$item->amenitie_image),
                            "name"=>$item->amenitie_name
                        );
                    }
                }
            }

            $array = array('status'=>'success','message'=>'Data Found','items'=>$items);
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function get_product_specification_list()
    {
        $array = array();
        $items = array();

        if ($this->input->post()) {

            $id=$this->input->post('id');
            $where = "product_id='".$id."'";
            $product_data = $this->Action_model->select_single('tbl_products',$where);

            if ($product_data && $product_data->amenitie) {
                $amenitie_ids = $product_data->amenitie;

                $where = "product_id='".$id."'";

                $this->db->select('*');
                $this->db->from('tbl_product_specifications');
                $this->db->join('tbl_specifications', 'tbl_specifications.specification_id = tbl_product_specifications.specification_id','left');
                $this->db->where($where);
                $query = $this->db->get();
                $item_data = $query->result();

                if ($item_data) {
                    foreach ($item_data as $item) {
                        $items[] = array(
                            "name"=>$item->specification_name,
                            "description"=>$item->description
                        );
                    }
                }
            }

            $array = array('status'=>'success','message'=>'Data Found','items'=>$items);
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function get_product_inventory_list()
    {
        $array = array();
        $items = array();

        if ($this->input->post()) {

            $id=$this->input->post('id');
            $product_unit_detail_id=$this->input->post('product_unit_detail_id');

            $where = "product_id='".$id."'";
            $product_data = $this->Action_model->select_single('tbl_products',$where);

            if ($product_data && $product_data->amenitie) {
                $amenitie_ids = $product_data->amenitie;

                $where = "tbl_inventory.product_id='".$id."' AND tbl_inventory.unit_code='".$product_unit_detail_id."'";

                $this->db->select('*');
                $this->db->from('tbl_inventory');
                $this->db->join('tbl_floors', 'tbl_floors.floor_id = tbl_inventory.floor_id','left');
                $this->db->join('tbl_product_block_details', 'tbl_product_block_details.block_id = tbl_inventory.block_id','left');
                $this->db->join('tbl_product_unit_details', 'tbl_product_unit_details.product_unit_detail_id = tbl_inventory.unit_code','left');
                $this->db->join('tbl_accomodations', 'tbl_accomodations.accomodation_id = tbl_product_unit_details.accomodation','left');
                $this->db->where($where);
                $query = $this->db->get();
                $item_data = $query->result();

                if ($item_data) {
                    foreach ($item_data as $item) {
                        $items[] = array(
                            "inventory_id"=>$item->inventory_id,
                            "unit_no"=>$item->unit_no,
                            "floor_name"=>($item->floor_name)?$item->floor_name:'',
                            "tower_name"=>($item->block_name)?$item->block_name:'',
                            "accomodation_name"=>($item->accomodation_name)?$item->accomodation_name:''
                        );
                    }
                }
            }

            $array = array('status'=>'success','message'=>'Data Found','items'=>$items);
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    public function get_product_site_visit_list()
    {
        $array = array();

        if ($this->input->post()) {

            
                $product_id = $this->input->post('product_id');

                $where="tbl_site_visit.project_id='".$product_id."' AND site_visit_status='2' ORDER BY STR_TO_DATE(visit_date,'%d-%m-%Y') DESC,visit_time DESC";
                $this->db->select("*,tbl_leads.lead_id as lead_id,CONCAT(lead_title, ' ',lead_first_name, ' ', lead_last_name) AS 'lead_name',tbl_builders.firm_name as b_firm_name");
                $this->db->from('tbl_site_visit');
                $this->db->join('tbl_leads', 'tbl_leads.lead_id = tbl_site_visit.lead_id');
                $this->db->join('tbl_products', 'tbl_products.product_id = tbl_site_visit.project_id','left');
                $this->db->join('tbl_users', 'tbl_users.user_id = tbl_site_visit.assign_to','left');
                $this->db->join('tbl_builders', 'tbl_builders.builder_id = tbl_products.builder_id','left');
                $this->db->join('tbl_lead_stages', 'tbl_lead_stages.lead_stage_id = tbl_leads.lead_stage_id','left');
                $this->db->join('tbl_lead_sources', 'tbl_lead_sources.lead_source_id = tbl_leads.lead_source_id','left');
                $this->db->join('tbl_project_share', "tbl_project_share.project_id = tbl_products.product_id",'left');
                $this->db->where($where);
                $query = $this->db->get();
                $record_data = $query->result();

                //print_r(count($record_data));
                $records = array();
                if ($record_data) {
                    foreach ($record_data as $item) {
                        //echo $item->lead_id.", ";
                        $next_followup = "";
                        $next_followup_date = "";
                        $records[] = array(
                            'site_visit_id'=>$item->site_visit_id,
                            'lead_name'=>$item->lead_name,
                            'lead_title'=>$item->lead_title,
                            'lead_first_name'=>$item->lead_first_name,
                            'lead_last_name'=>$item->lead_last_name,
                            'lead_date'=>$item->lead_date,
                            'builder'=>$item->b_firm_name,
                            'assign_to'=>ucwords($item->user_title.' '.$item->first_name.' '.$item->last_name),
                            'project_name'=>$item->project_name,
                            'visit_date'=>$item->visit_date,
                            'visit_time'=>$item->visit_time,
                            'interested'=>$item->interested,
                            'comment'=>$item->comment,
                            'site_visit_status'=>$item->site_visit_status  ,
                            'next_followup_date'=>$next_followup_date,
                            'lead_mobile_no'=>$item->lead_mobile_no,
                            'lead_stage_name'=>(!$item->lead_stage_name)?'':$item->lead_stage_name,
                            'lead_source_name'=>(!$item->lead_source_name)?'':$item->lead_source_name,
                            'lead_email'=>$item->lead_email,
                            'next_followup'=>$next_followup
                        );
                    }
                }

                $array = array('status'=>'success','message'=>count($records).' Records Found','records'=>$records);
            
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }


    public function get_product_inventory_quatation()
    {
        if ($this->input->post()) {

            $inventory_id=$this->input->post('inventory_id');
            $where = "inventory_id='".$inventory_id."'";

            $this->db->select('*,tbl_users.is_individual as a_is_individual,tbl_users.user_title as a_user_title,tbl_users.first_name as a_first_name,tbl_users.last_name as a_last_name,tbl_users.firm_name as a_firm_name,tbl_users.mobile as a_mobile,tbl_builders.firm_name as b_firm_name');
            $this->db->from('tbl_inventory');
            $this->db->join('tbl_floors', 'tbl_floors.floor_id = tbl_inventory.floor_id','left');
            $this->db->join('tbl_product_block_details', 'tbl_product_block_details.block_id = tbl_inventory.block_id','left');
            $this->db->join('tbl_product_unit_details', 'tbl_product_unit_details.product_unit_detail_id = tbl_inventory.unit_code','left');
            $this->db->join('tbl_accomodations', 'tbl_accomodations.accomodation_id = tbl_product_unit_details.accomodation','left');
            $this->db->join('tbl_products', 'tbl_products.product_id = tbl_product_unit_details.product_id','left');
            $this->db->join('tbl_builders', 'tbl_builders.builder_id = tbl_products.builder_id','left');
            $this->db->join('tbl_locations', 'tbl_locations.location_id = tbl_products.location','left');
            $this->db->join('tbl_users', 'tbl_users.user_id = tbl_products.agent_id','left');
            //$this->db->join('tbl_product_block_details', 'tbl_product_block_details.block_id = tbl_inventory.block_id','left');
            $this->db->where($where);
            $query = $this->db->get();
            $inventory_data = $query->row();

            if ($inventory_data) {
                $data['inventory_data'] = $inventory_data;
                $this->load->view(AGENT_URL.'ajax/get_product_inventory_quatation',$data);
            }
            else {
                echo "Inventory Not Found.";
            }
        }
    }
    /* product end */


    # fetch state list

        public function get_state(){

             
        $postData = $this->input->post();

        $select = "*";
        
        $select = "";

        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = '';


        // if($this->input->post('status')!='') {

        //     $searchQuery .= " AND tbl_leads.lead_stage_id=".$this->input->post('status');

        // }   


        if($searchValue != ''){

             if($this->input->post('status')!=''){

                    $searchQuery .= " AND (state_name LIKE '%".$searchValue."%') ";

                }
                else{

                    $searchQuery .= "(state_name LIKE '%".$searchValue."%') ";

             }
        }

        $data = $this->Action_model->ajaxDatatableLeft($postData, $searchQuery, 'tbl_states', $where, $select);

        echo json_encode($data);   
            
        }
        public function get_city_list(){

             
        $postData = $this->input->post();

        $select = "*";
        
        $select = "";

        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = '';


        // if($this->input->post('status')!='') {

        //     $searchQuery .= " AND tbl_leads.lead_stage_id=".$this->input->post('status');

        // }   


        if($searchValue != ''){

            //  if($this->input->post('status')!=''){

            //         $searchQuery .= " AND (city_name LIKE '%".$searchValue."%') ";

            //     }
            //     else{

                    $searchQuery .="( city_name LIKE '%".$searchValue."%' OR state_name LIKE '%".$searchValue."%') ";

            //  }
        }

        $join = array('tbl_states','tbl_states.state_id=tbl_city.state_id');     

        $data = $this->Action_model->ajaxDatatableLeft($postData, $searchQuery, 'tbl_city', $where, $select , $join);

        echo json_encode($data);   
            
        }

    # end fetch state list

    # edit state
        
      public function get_single_state(){

        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_states',"state_id='".$id."'");
            if ($record) {
                $array = array('status'=>'success','message'=>'','record'=>$record );
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);

      }
        
    # end edit state

    # edit City
        
      public function get_single_city(){

        $array = array();

        if ($this->input->post()) {
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_city',"city_id='".$id."'");
            if ($record) {
                $state = $this->Action_model->select_single('tbl_states',"state_id='".$record->state_id."'");
                $array = array('status'=>'success','message'=>'','record'=>$record , 'state' => $state );
            }
            else {
                $array = array('status'=>'error','message'=>'Record Not Found.');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);

      }
        
    # end edit City


    # store state

      public function state_process(){


        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('state_id');
            $record = $this->Action_model->select_single('tbl_states',"state_id='".$id."'");

            $record_array = array(
                'state_name'   => $this->input->post('state_name'),
                'state_status' => $this->input->post('state_status'),
                'country_id'   => 1
            );

            if ($record) {
               

                if ($this->Action_model->select_single('tbl_states',"state_name='".$this->input->post('state_name')."' AND state_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This State is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_states',"state_id='".$id."'");
                    $array = array('status'=>'added','message'=>'State Updated Successfully!!');
                }
            }
            else {
               

                if ($this->Action_model->select_single('tbl_states',"state_name='".$this->input->post('state_name')."'")) {
                    $array = array('status'=>'error','message'=>'This State is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_states');
                    $array = array('status'=>'added','message'=>'State Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);    

      }

      public function city_process(){

         $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('city_id');
            $record = $this->Action_model->select_single('tbl_city',"city_id='".$id."'");

            $record_array = array(
                'state_id'   => $this->input->post('city_state_id'),
                'city_name'  => $this->input->post('city_name'),
                'city_status' => $this->input->post('city_status'),
            );

            if ($record) {
               

                if ($this->Action_model->select_single('tbl_city',"city_name='".$this->input->post('city_name')."' AND city_id!='".$id."'")) {
                    $array = array('status'=>'error','message'=>'This State is already exist.');
                }
                else {
                    $this->Action_model->update_data($record_array,'tbl_city',"city_id='".$id."'");
                    $array = array('status'=>'added','message'=>'State Updated Successfully!!');
                }
            }
            else {
               

                if ($this->Action_model->select_single('tbl_city',"city_name='".$this->input->post('city_name')."'")) {
                    $array = array('status'=>'error','message'=>'This State is already exist.');
                }
                else {
                    $this->Action_model->insert_data($record_array,'tbl_city');
                    $array = array('status'=>'added','message'=>'State Added Successfully!!');
                }
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);    

      }
      
    # end store state


    # delete state
    
    public function delete_state()
    {
        $array = array();

        if ($this->input->post()) {
            
            $id=$this->input->post('id');
            $record = $this->Action_model->select_single('tbl_states',"state_id='".$id."'");

            if ($record) {
                $this->Action_model->delete_query('tbl_states',"state_id='".$id."'");
                $array = array('status'=>'added','message'=>'State Deleted Successfully!!');
            }
            else {
                $array = array('status'=>'added','message'=>'Record Not Found!!');
            }
        }
        else { 
           $array = array('status'=>'error','message'=>'Some error occurred, please try again.');
        }

        echo json_encode($array);
        
    }

    
    # end  delete state 

}
