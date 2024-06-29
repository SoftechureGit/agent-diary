<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
 public function __construct() {
        parent::__construct();
        $this->load->model('Action_model');
        if (!$this->session->userdata('admin_user_hash')) {
            redirect(ADMIN_URL.'login');
        }

       // $sss = $this->Action_model->sendMobileSMS("7610046320","Hello rks",true);
       // print_r($sss);exit;

      /*//UNIX_TIMESTAMP(STR_TO_DATE(next_due_date,'%d-%m-%Y %H')) as plan_active
      echo $today = date("Y-m-d");
      $where = "user_id='12'";
      $user_list = $this->Action_model->detail_result('tbl_users',$where,"user_id,IF(STR_TO_DATE(next_due_date,'%d-%m-%Y')>='".$today."', 1, 0) as plan_active");
      print_r($user_list);exit;*/
    }

	public function index()
	{
      $total_agents = 0;
      $total_activate = 0;
      $total_deactivate = 0;
      $total_login = 0;
      $total_project = 0;
      $total_lead_rent = 0;
      $total_lead_sale = 0;
      $total_property_rent = 0;
      $total_property_sale = 0;
      $current_date = date("d-m-Y");
      $date_after_7days = date("d-m-Y",strtotime("+6 day"));

      $state = ($this->input->get('state') && is_numeric($this->input->get('state')))?$this->input->get('state'):"";
      $city = ($this->input->get('city') && is_numeric($this->input->get('city')))?$this->input->get('city'):"";
      $year = ($this->input->get('year') && is_numeric($this->input->get('year')))?$this->input->get('year'):date("Y");

    $where = "state_id!=''";
    $state_list = $this->Action_model->detail_result('tbl_states',$where);
    $data['state_list'] = $state_list;

    $city_list = array();
    if ($state) {
        $where = "state_id='".$state."'";
        $city_data = $this->Action_model->detail_result('tbl_city',$where);
        if ($city_data) {
           $city_list = $city_data;
        }
    }
    $data['city_list'] = $city_list;

      $where = "role_id='2'".(($state)?" AND state_id='".$state."'":"").(($city)?" AND city_id='".$city."'":"");
      $dd = $this->Action_model->select_single('tbl_users',$where,"count(user_id) as total");
      if ($dd) {
          $total_agents = $dd->total;
      }

      $where = "role_id='2' AND user_status='1' AND UNIX_TIMESTAMP(STR_TO_DATE(next_due_date, '%d-%m- %Y')) >= ".time().(($state)?" AND state_id='".$state."'":"").(($city)?" AND city_id='".$city."'":"");
      $dd = $this->Action_model->select_single('tbl_users',$where,"count(user_id) as total");
      if ($dd) {
          $total_activate = $dd->total;
      }

      $where = "role_id='2' AND user_status='1' AND UNIX_TIMESTAMP(STR_TO_DATE(next_due_date, '%d-%m- %Y')) < ".time().(($state)?" AND state_id='".$state."'":"").(($city)?" AND city_id='".$city."'":"");
      $dd = $this->Action_model->select_single('tbl_users',$where,"count(user_id) as total");
      if ($dd) {
          $total_deactivate = $dd->total;
      }

      $where = "product_status='1'".(($state)?" AND state_id='".$state."'":"").(($city)?" AND city_id='".$city."'":"");
      $dd = $this->Action_model->select_single('tbl_products',$where,"count(product_id) as total");
      if ($dd) {
          $total_project = $dd->total;
      }

      $where = "property_status='1' AND listing_type='1'".(($state)?" AND state_id='".$state."'":"").(($city)?" AND city_id='".$city."'":"");
      $dd = $this->Action_model->select_single('tbl_property',$where,"count(property_id) as total");
      if ($dd) {
          $total_property_rent = $dd->total;
      }

      $where = "property_status='1' AND listing_type='2'".(($state)?" AND state_id='".$state."'":"").(($city)?" AND city_id='".$city."'":"");
      $dd = $this->Action_model->select_single('tbl_property',$where,"count(property_id) as total");
      if ($dd) {
          $total_property_sale = $dd->total;
      }

        $where = "look_for='2'".(($state)?" AND state_id='".$state."'":"").(($city)?" AND city_id='".$city."'":"");
        $this->db->select("count(tbl_requirements.lead_id) as total");
        $this->db->from('tbl_requirements');
        //$this->db->join('tbl_leads', "tbl_leads.lead_id = tbl_requirements.lead_id");
        $this->db->where($where);
        $query = $this->db->get();
        $dd = $query->row();
        if ($dd) {
        $total_lead_rent = $dd->total;
        }

        $where = "(look_for='1' OR look_for='3')".(($state)?" AND state_id='".$state."'":"").(($city)?" AND city_id='".$city."'":"");
        $this->db->select("count(tbl_requirements.lead_id) as total");
        $this->db->from('tbl_requirements');
        $this->db->join('tbl_leads', "tbl_leads.lead_id = tbl_requirements.lead_id");
        $this->db->where($where);
        $query = $this->db->get();
        $dd = $query->row();
        if ($dd) {
        $total_lead_sale = $dd->total;
        }

        $where = "user_status='1' AND role_id='2' AND (next_due_date BETWEEN '".$current_date."' AND '".$date_after_7days."')".(($state)?" AND tbl_users.state_id='".$state."'":"").(($city)?" AND tbl_users.city_id='".$city."'":"")." ORDER BY STR_TO_DATE(next_due_date,'%d-%m-%Y') ASC";
    
        $this->db->select("*");
        $this->db->from('tbl_users');
        $this->db->join('tbl_city', "tbl_city.city_id = tbl_users.city_id",'left');
        $this->db->where($where);
        $query = $this->db->get();
        $user_list = $query->result();
        $data['user_list'] = $user_list;

        $where = "invoice_date LIKE '%".$year."%'".(($state)?" AND tbl_payment.state='".$state."'":"").(($city)?" AND tbl_payment.city='".$city."'":"")." GROUP BY month_wise";
    
        $this->db->select("invoice_date,Month(STR_TO_DATE(invoice_date, '%d-%m- %Y')) as month_wise");
        $this->db->from('tbl_payment');
        $this->db->where($where);
        $query = $this->db->get();
        $data_month_data = $query->result();

        $data_month_list = array();
        foreach ($data_month_data as $row) {
            $billing = 0;
            $recovery = 0;
            $outstanding = 0;

            $month_year = $row->month_wise."-".$year;

            $where = "((entry_type='1' AND payment_status='1') OR (entry_type='2')) AND invoice_date LIKE '%".$month_year."%'".(($state)?" AND tbl_payment.state='".$state."'":"").(($city)?" AND tbl_payment.city='".$city."'":"");
            $this->db->select("SUM(total_amount) as billing");
            $this->db->from('tbl_payment');
            $this->db->where($where);
            $query = $this->db->get();
            $pay_data = $query->row();
            if ($pay_data && $pay_data->billing) {
                $billing = $pay_data->billing;
            }

            $where = "((entry_type='1' AND payment_status='1') OR (entry_type='2' AND payment_status='1')) AND invoice_date LIKE '%".$month_year."%'".(($state)?" AND tbl_payment.state='".$state."'":"").(($city)?" AND tbl_payment.city='".$city."'":"");
            $this->db->select("SUM(total_amount) as recovery");
            $this->db->from('tbl_payment');
            $this->db->where($where);
            $query = $this->db->get();
            $pay_data = $query->row();
            if ($pay_data && $pay_data->recovery) {
                $recovery = $pay_data->recovery;
            }

            $outstanding = $billing - $recovery;

            $data_month_list[] = array(
                'month'=>$row->month_wise,
                'month_name'=>date("F",strtotime($row->invoice_date)),
                'billing' => $billing,
                'recovery' => $recovery,
                'outstanding' => $outstanding
            );
        }

        $data['data_month_list'] = $data_month_list;


      $data['total_agents'] = $total_agents;
      $data['total_activate'] = $total_activate;
      $data['total_deactivate'] = $total_deactivate;
      $data['total_login'] = $total_login;
      $data['total_project'] = $total_project;
      $data['total_property_rent'] = $total_property_rent;
      $data['total_property_sale'] = $total_property_sale;
      $data['total_lead_rent'] = $total_lead_rent;
      $data['total_lead_sale'] = $total_lead_sale;

      $data['current_date'] = $current_date;
      $data['date_after_7days'] = $date_after_7days;

	  $this->load->view(ADMIN_URL.'index',$data);
	}

    public function leads()
    {
        $all_unit_type_list = $this->Action_model->detail_result('tbl_unit_types',"unit_type_status='1'",'unit_type_id,unit_type_name,requirement_accomodation');
        $data['all_unit_type_list'] = $all_unit_type_list;

        $where = "lead_stage_status='1'";
        $lead_stage_list = $this->Action_model->detail_result('tbl_lead_stages',$where,'lead_stage_id,lead_stage_name');
        $data['lead_stage_list'] = $lead_stage_list;

        $where = "lead_type_status='1'";
        $lead_type_list = $this->Action_model->detail_result('tbl_lead_types',$where,'lead_type_id,lead_type_name');
        $data['lead_type_list'] = $lead_type_list;

        $where = "lead_action_status='1'";
        $lead_action_list = $this->Action_model->detail_result('tbl_lead_actions',$where,'lead_action_id,lead_action_name');
        $data['lead_action_list'] = $lead_action_list;

        $where = "country_id='1'";
        $state_list = $this->Action_model->detail_result('tbl_states',$where);
        $data['state_list'] = $state_list;

        $where = "lead_source_status='1'";
        $lead_source_list = $this->Action_model->detail_result('tbl_lead_sources',$where);
        $data['lead_source_list'] = $lead_source_list;

        $where = "unit_status='1'";
        $unit_list = $this->Action_model->detail_result('tbl_units',$where,'unit_id,unit_name');
        $data['unit_list'] = $unit_list;

        $where = "budget_status='1'";
        $budget_list = $this->Action_model->detail_result('tbl_budgets',$where,'budget_id,budget_name');
        $data['budget_list'] = $budget_list;

        /*$account_id = getAccountId();
        
        $where = "user_status='1' AND ((parent_id='".$account_id."') OR (user_id='".$account_id."' AND role_id='2'))";
        $where_ids = "";
        $user_ids = $this->get_level_user_ids();

        if (count($user_ids)) {

            $where_ids .= " AND (tbl_users.user_id='".implode("' OR tbl_users.user_id='", $user_ids)."')";
        }
        $where .= $where_ids;*/

        $where = "user_status='1'";
        $user_list = $this->Action_model->detail_result('tbl_users',$where,'user_id,user_title,first_name,last_name,parent_id,is_individual,firm_name');
        $data['user_list'] = $user_list;

        //$where = "agent_id='".$account_id."' OR share_account_id='".$account_id."'";
        $where = "product_id!=''";
        $this->db->select("product_id,project_name");
        $this->db->from('tbl_products');
        $this->db->join('tbl_project_share', "tbl_project_share.project_id = tbl_products.product_id",'left');
        $this->db->where($where);
        $query = $this->db->get();
        $product_list = $query->result();
        $data['product_list'] = $product_list;

        //$where = "lead_stage_status='1'";
        //$lead_stage_list = $this->Action_model->detail_result('tbl_lead_stages',$where);
        //$data['lead_stage_list'] = $lead_stage_list;

        //$where = "lead_type_status='1'";
        //$lead_type_list = $this->Action_model->detail_result('tbl_lead_types',$where,'lead_type_id,lead_type_name');
        //$data['lead_type_list'] = $lead_type_list;

        //$account_id = getAccountId();
        $where = "role_id='2'";

        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where($where);
        $query = $this->db->get();
        $filter_user_list = $query->result();
        $data['filter_user_list'] = $filter_user_list;

        $this->load->view(ADMIN_URL.'leads',$data);
    }

    public function lead_detail($id='')
    {
       // $account_id = getAccountId();

        $lead_detail = array();
        if ($id) {
            $lead_detail = $this->Action_model->select_single('tbl_leads',"lead_id='".$id."'");
            if (!$lead_detail) {
                redirect(ADMIN_URL);
            }
        }

        $where = "country_id='1'";
        $state_list = $this->Action_model->detail_result('tbl_states',$where);

        $city_list = array();
        if ($id) {
            $where = "state_id='".$lead_detail->lead_state_id."'";
            $city_list = $this->Action_model->detail_result('tbl_city',$where);
        }

        $where = "occupation_status='1'";
        $occupation_list = $this->Action_model->detail_result('tbl_occupations',$where);

        $where = "department_status='1'";
        $department_list = $this->Action_model->detail_result('tbl_departments',$where);

        $where = "lead_source_status='1'";
        $lead_source_list = $this->Action_model->detail_result('tbl_lead_sources',$where);

        $where = "lead_stage_status='1'";
        $lead_stage_list = $this->Action_model->detail_result('tbl_lead_stages',$where);

        $where = "lead_type_status='1'";
        $lead_type_list = $this->Action_model->detail_result('tbl_lead_types',$where,'lead_type_id,lead_type_name');
        $data['lead_type_list'] = $lead_type_list;

        $data['lead_detail'] = $lead_detail;
        $data['id'] = $id;
        $data['state_list'] = $state_list;
        $data['city_list'] = $city_list;
        $data['occupation_list'] = $occupation_list;
        $data['department_list'] = $department_list;
        $data['lead_source_list'] = $lead_source_list;
        $data['lead_stage_list'] = $lead_stage_list;
        $this->load->view(ADMIN_URL.'lead_detail',$data);
    }

    public function followup()
    {
        $all_unit_type_list = $this->Action_model->detail_result('tbl_unit_types',"unit_type_status='1'",'unit_type_id,unit_type_name,requirement_accomodation');
        $data['all_unit_type_list'] = $all_unit_type_list;

        $where = "country_id='1'";
        $state_list = $this->Action_model->detail_result('tbl_states',$where = "country_id='1'",'state_id,state_name');
        $data['state_list'] = $state_list;

        $where = "product_type_status='1'";
        $project_type_list = $this->Action_model->detail_result('tbl_product_types',$where,'product_type_id,product_type_name');
        $data['project_type_list'] = $project_type_list;

        $where = "accomodation_status='1'";
        $accomodation_list = $this->Action_model->detail_result('tbl_accomodations',$where,'accomodation_id,accomodation_name');
        $data['accomodation_list'] = $accomodation_list;

        $where = "lead_option_status='1'";
        $lead_option_list = $this->Action_model->detail_result('tbl_lead_options',$where,'lead_option_id,lead_option_name');
        $data['lead_option_list'] = $lead_option_list;

        $where = "lead_source_status='1'";
        $lead_source_list = $this->Action_model->detail_result('tbl_lead_sources',$where);
        $data['lead_source_list'] = $lead_source_list;

        $where = "budget_status='1'";
        $budget_list = $this->Action_model->detail_result('tbl_budgets',$where,'budget_id,budget_name');
        $data['budget_list'] = $budget_list;

        $where = "unit_status='1'";
        $unit_list = $this->Action_model->detail_result('tbl_units',$where,'unit_id,unit_name');
        $data['unit_list'] = $unit_list;

        $where = "lead_stage_status='1'";
        $lead_stage_list = $this->Action_model->detail_result('tbl_lead_stages',$where,'lead_stage_id,lead_stage_name');
        $data['lead_stage_list'] = $lead_stage_list;

        $where = "lead_type_status='1'";
        $lead_type_list = $this->Action_model->detail_result('tbl_lead_types',$where,'lead_type_id,lead_type_name');
        $data['lead_type_list'] = $lead_type_list;

        $where = "lead_action_status='1'";
        $lead_action_list = $this->Action_model->detail_result('tbl_lead_actions',$where,'lead_action_id,lead_action_name');
        $data['lead_action_list'] = $lead_action_list;

        $total_followup = 0;
        $today_followup = 0;
        $missed_followup = 0;

        //$account_id = getAccountId();

        $where = "lead_id!=''";
        $tb_data = $this->Action_model->select_single('tbl_leads',$where,"COUNT(CASE WHEN added_to_followup = 1 THEN lead_id END) as total_followup,COUNT(CASE WHEN followup_date = '".date('d-m-Y')."' THEN lead_id END) as today_followup,COUNT(CASE WHEN added_to_followup = 0 THEN lead_id END) as missed_followup");  

        $data['total_followup'] = $tb_data->total_followup;
        $data['today_followup'] = $tb_data->today_followup;
        $data['missed_followup'] = $tb_data->missed_followup;

        $where = "lead_id!=''";
        $chart_data = $this->Action_model->select_single('tbl_leads',$where,'COUNT(CASE WHEN lead_stage_id = 3 THEN lead_id END) as total_enquiry,COUNT(CASE WHEN lead_stage_id = 1 THEN lead_id END) as total_initial,COUNT(CASE WHEN lead_stage_id = 4 THEN lead_id END) as total_site_visit,COUNT(CASE WHEN added_to_followup = 1 THEN lead_id END) as total_followup');  

        $pie_chart_values = array();
        $pie_chart_values[] = array('label'=>'Enquiry','color'=>'#ff9f5f','value'=>$chart_data->total_enquiry);
        $pie_chart_values[] = array('label'=>'Initial','color'=>'#7571F9','value'=>$chart_data->total_initial);
        $pie_chart_values[] = array('label'=>'Site Visit','color'=>'#31b925','value'=>$chart_data->total_site_visit);
        $pie_chart_values[] = array('label'=>'Followup','color'=>'#e62739','value'=>$chart_data->total_followup);

        $where = "user_status='1'";
        /*$where_ids = "";
        $user_ids = $this->get_level_user_ids();

        if (count($user_ids)) {

            $where_ids .= " AND (tbl_users.user_id='".implode("' OR tbl_users.user_id='", $user_ids)."')";
        }
        $where .= $where_ids;*/
        $where = "user_status='1'";

        $user_list = $this->Action_model->detail_result('tbl_users',$where,'user_id,user_title,first_name,last_name,parent_id,is_individual,firm_name');
        $data['user_list'] = $user_list;

        $where = "product_id!=''";
        $this->db->select("product_id,project_name");
        $this->db->from('tbl_products');
        $this->db->join('tbl_project_share', "tbl_project_share.project_id = tbl_products.product_id",'left');
        $this->db->where($where);
        $query = $this->db->get();
        $product_list = $query->result();
        $data['product_list'] = $product_list;

        $data['pie_chart_values'] = $pie_chart_values;
        
        //$account_id = getAccountId();
        $where = "role_id='2'";

        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where($where);
        $query = $this->db->get();
        $filter_user_list = $query->result();
        $data['filter_user_list'] = $filter_user_list;

        $this->load->view(ADMIN_URL.'followup',$data);
    }

    public function customers($id="")
    {

        $where = "country_id='1'";
        $state_list = $this->Action_model->detail_result('tbl_states',$where = "country_id='1'",'state_id,state_name');
        $data['state_list'] = $state_list;

        $where = "lead_source_status='1'";
        $lead_source_list = $this->Action_model->detail_result('tbl_lead_sources',$where);
        $data['lead_source_list'] = $lead_source_list;

        $where = "budget_status='1'";
        $budget_list = $this->Action_model->detail_result('tbl_budgets',$where,'budget_id,budget_name');
        $data['budget_list'] = $budget_list;

        $where = "unit_status='1'";
        $unit_list = $this->Action_model->detail_result('tbl_units',$where,'unit_id,unit_name');
        $data['unit_list'] = $unit_list;

        $where = "lead_stage_status='1'";
        $lead_stage_list = $this->Action_model->detail_result('tbl_lead_stages',$where,'lead_stage_id,lead_stage_name');
        $data['lead_stage_list'] = $lead_stage_list;

        $where = "lead_type_status='1'";
        $lead_type_list = $this->Action_model->detail_result('tbl_lead_types',$where,'lead_type_id,lead_type_name');
        $data['lead_type_list'] = $lead_type_list;

        $where = "lead_action_status='1'";
        $lead_action_list = $this->Action_model->detail_result('tbl_lead_actions',$where,'lead_action_id,lead_action_name');
        $data['lead_action_list'] = $lead_action_list;

        $where = "user_id!=''";
        $agent_list = $this->Action_model->detail_result('tbl_users',$where);
        $data['agent_list'] = $agent_list;
        
        //$account_id = getAccountId();
        $where = "role_id='2'";

        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where($where);
        $query = $this->db->get();
        $filter_user_list = $query->result();
        $data['filter_user_list'] = $filter_user_list;

        $this->load->view(ADMIN_URL.'customers',$data);
    }

    public function customer_detail($id="")
    {
        if ($id) {
            $lead_data = $this->Action_model->select_single('tbl_leads',"lead_id='".$id."'","CONCAT(lead_title, ' ',lead_first_name, ' ', lead_last_name) as customer_name");

            if (!$lead_data) {
                redirect(ADMIN_URL);
            }

            $data['lead_data'] = $lead_data;
            $this->load->view(ADMIN_URL.'customer_detail',$data);
        }
        else {
            redirect(ADMIN_URL);
        }
    }

    public function agents($id='')
    {   
        if ($id) {
            $this->db->select('*');
            $this->db->from('tbl_users a');
            $this->db->join('tbl_city c', 'c.city_id = a.city_id', 'left');
            $this->db->join('tbl_states s', 's.state_id = a.state_id', 'left');
            $this->db->where("user_id='".$id."' and role_id='2'");
            $query = $this->db->get(); 
            $agent_detail = $query->row();

            if (!$agent_detail) {
               redirect(ADMIN_URL);
            }

            $where = "user_id='".$agent_detail->user_id."' AND payment_status='1' ORDER BY payment_id ASC LIMIT 1";
            $bill_on_detail = $this->Action_model->select_single('tbl_payment',$where,'invoice_date');

            $this->db->select('*');
            $this->db->from('tbl_payment');
            $this->db->where("user_id='".$agent_detail->user_id."' AND ((entry_type='1' AND payment_status='1') OR (entry_type='2')) order by payment_id desc ");
            $query = $this->db->get(); 
            $payments = $query->result();

            $data['bill_on_detail'] = $bill_on_detail;
            $data['agent_detail'] = $agent_detail;
            $data['payments'] = $payments;

            $this->load->view(ADMIN_URL.'agent_detail',$data);
        }
        else {

            $where = "state_id!=''";
            $state_list = $this->Action_model->detail_result('tbl_states',$where);
            $data['state_list'] = $state_list;

            $city_list = array();
            /*if ($state) {
                $where = "state_id='".$state."'";
                $city_data = $this->Action_model->detail_result('tbl_city',$where);
                if ($city_data) {
                   $city_list = $city_data;
                }
            }*/
            $data['city_list'] = $city_list;

            $this->load->view(ADMIN_URL.'agents',$data);
        }
    }

    public function invoice($id='')
    {   
        if ($id) {
            $this->db->select('*');
            $this->db->from('tbl_payment');
            $this->db->join('tbl_paid_type', "tbl_paid_type.paid_type_id = paid_type", 'left');
            $this->db->where("((entry_type='1' AND payment_status='1') OR (entry_type='2')) AND payment_id='".$id."'");
            $query = $this->db->get(); 
            $invoice_detail = $query->row();
            $data['invoice_detail'] = $invoice_detail;
            $this->load->view(ADMIN_URL.'invoice_detail',$data);
        }
        else {
           redirect(ADMIN_URL);
        }
    }


    public function receipt($id='')
    {   
        if ($id) {
            $this->db->select('*');
            $this->db->from('tbl_payment');
            $this->db->join('tbl_paid_type', "tbl_paid_type.paid_type_id = paid_type", 'left');
            $this->db->where("((entry_type='1') OR (entry_type='2')) AND payment_id='".$id."' AND payment_status='1'");
            $query = $this->db->get(); 
            $invoice_detail = $query->row();

            if ($invoice_detail) {
               
                $data['invoice_detail'] = $invoice_detail;
                $this->load->view(ADMIN_URL.'receipt_detail',$data);
            }
            else {
               redirect(ADMIN_URL);
            }
        }
        else {
           redirect(ADMIN_URL);
        }
    }

    public function transactions($id='')
    {   

        if ($id) {
            $this->db->select('*');
            $this->db->from('tbl_payment');
            $this->db->join('tbl_paid_type', "tbl_paid_type.paid_type_id = paid_type", 'left');
            $this->db->where("((entry_type='1') OR (entry_type='2')) AND payment_id='".$id."'");
            $query = $this->db->get(); 
            $invoice_detail = $query->row();
            $data['invoice_detail'] = $invoice_detail;
            $this->load->view(ADMIN_URL.'transaction_detail',$data);
        }
        else {
           $this->db->select('*');
            $this->db->from('tbl_payment');
            $this->db->join('tbl_paid_type', "tbl_paid_type.paid_type_id = paid_type", 'left');
            $this->db->where("((entry_type='1') OR (entry_type='2')) ORDER BY payment_id DESC");
            $query = $this->db->get(); 
            $payments = $query->result();
            $data['payments'] = $payments;
            $this->load->view(ADMIN_URL.'transactions',$data);
        }
    }

    public function agent_login($unique_code='')
    {
       if (!$unique_code) {
           redirect(ADMIN_URL);
       }

       $record = $this->Action_model->select_single('tbl_users',"unique_code='".$unique_code."'");
       if ($record) {

            $account_id = $record->user_id;
            if ($record->role_id!=2) {
                $account_id = $record->parent_id;
            }

            $this->session->set_userdata('agent_hash', $record->user_hash);
            $this->session->set_userdata('agent_role_id', $record->role_id);
            $this->session->set_userdata('agent_name', ($record->is_individual)?$record->user_title.' '.$record->first_name.' '.$record->last_name:$record->firm_name);
            $this->session->set_userdata('agent_account_id', $account_id);
            
           redirect(AGENT_URL);
       }
       else {
           redirect(ADMIN_URL);
       }
    }

    public function agent_product()
    {
       $agent_id = $this->input->get('agent_id');
       $product_id = $this->input->get('product_id');

       $record = $this->Action_model->select_single('tbl_users',"user_id='".$agent_id."' AND role_id='2'");
       if ($record) {

            $account_id = $record->user_id;
            if ($record->role_id!=2) {
                $account_id = $record->parent_id;
            }

            $this->session->set_userdata('agent_hash', $record->user_hash);
            $this->session->set_userdata('agent_role_id', $record->role_id);
            $this->session->set_userdata('agent_name', $record->first_name.' '.$record->last_name);
            $this->session->set_userdata('agent_account_id', $account_id);
            
           redirect(AGENT_URL.'product-detail/'.$product_id);
       }
       else {
           redirect(ADMIN_URL);
       }
    }

    public function products()
    {
        $builder_list = array();
        
        $data['builder_list'] = $builder_list;

        $agent_list = array();
        $where = "role_id='2' ";
        $agent_data = $this->Action_model->detail_result('tbl_users',$where);
        if ($agent_data) {
            $agent_list  = $agent_data ;
        }
        $data['agent_list'] = $agent_list;

        $where = "builder_group_status='1'";
        $builder_group_list = $this->Action_model->detail_result('tbl_builder_groups',$where);
        $data['builder_group_list'] = $builder_group_list;

        $where = "project_status_flag='1'";
        $project_status_list = $this->Action_model->detail_result('tbl_project_status',$where);
        $data['project_status_list'] = $project_status_list;

        $where = "product_type_status='1'";
        $project_type_list = $this->Action_model->detail_result('tbl_product_types',$where);
        $data['project_type_list'] = $project_type_list;

        $where = "unit_status='1'";
        $unit_list = $this->Action_model->detail_result('tbl_units',$where);
        $data['unit_list'] = $unit_list;

        $where = "state_id!=''";
        $state_list = $this->Action_model->detail_result('tbl_states',$where);
        $data['state_list'] = $state_list;

        $where = "accomodation_status='1'";
        $accomodation_list = $this->Action_model->detail_result('tbl_accomodations',$where,'accomodation_id,accomodation_name');
        $data['accomodation_list'] = $accomodation_list;

        $where = "unit_status='1'";
        $unit_list = $this->Action_model->detail_result('tbl_units',$where,'unit_id,unit_name');
        $data['unit_list'] = $unit_list;

        $where = "facing_status='1'";
        $facing_list = $this->Action_model->detail_result('tbl_facings',$where,'facing_id,title');
        $data['facing_list'] = $facing_list;

        $where = "amenitie_status='1'";
        $amenitie_list = $this->Action_model->detail_result('tbl_amenities',$where,'amenitie_id,amenitie_name');
        $data['amenitie_list'] = $amenitie_list;

        $where = "finance_status='1'";
        $finance_list = $this->Action_model->detail_result('tbl_finances',$where,'finance_id,finance_name');
        $data['finance_list'] = $finance_list;

        $where = "price_component_status='1'";
        $price_component_list = $this->Action_model->detail_result('tbl_price_components',$where,'price_component_id,price_component_name,price_group_id');
        $data['price_component_list'] = $price_component_list;

        $where = "specification_status='1'";
        $specification_list = $this->Action_model->detail_result('tbl_specifications',$where);
        $data['specification_list'] = $specification_list;

        $where = "authority_status='1'";
        $authority_list = $this->Action_model->detail_result('tbl_authorities',$where);
        $data['authority_list'] = $authority_list;

        $comm_product_unit_type_list = array();
        $where = "unit_type_status='1' AND product_type_id='3'";
        $comm_product_unit_type_data = $this->Action_model->detail_result('tbl_unit_types',$where,'unit_type_id,unit_type_name');
        if ($comm_product_unit_type_data) {
            $comm_product_unit_type_list = $comm_product_unit_type_data;
        }
        $data['comm_product_unit_type_list'] = $comm_product_unit_type_list;

        $blocks = array();
        $product_flat_unit_details = array();
        $product_villa_unit_details = array();
        $product_plot_unit_details = array();
        $product_unit_details = array();
        $product_comm_blocks = array();
        $unit_type_list = array();
        $location_list = array();
        
        $data['unit_type_list'] = $unit_type_list;
        $data['blocks'] = $blocks;
        $data['product_flat_unit_details'] = $product_flat_unit_details;
        $data['product_villa_unit_details'] = $product_villa_unit_details;
        $data['product_plot_unit_details'] = $product_plot_unit_details;
        $data['product_unit_details'] = $product_unit_details;
        $data['product_comm_blocks'] = $product_comm_blocks;
        $data['location_list'] = $location_list;


        $city_list = array();
        $data['city_list'] = $city_list;

        $this->load->view(ADMIN_URL.'products',$data);
    }

    public function products1()
    {
        $this->load->view(ADMIN_URL.'products1',$data="");
    }

    public function product_detail($id='')
    {   
        $product_detail = $this->Action_model->select_single('tbl_products',"product_id='".$id."'");
        $data['id'] = $id;
        $data['product_detail'] = $product_detail;

        $builder_list = array();
        if ($id) {

            if (!$product_detail) {
                redirect(ADMIN_URL);
            }
            $where = "builder_status='1' AND builder_group_id='".$product_detail->builder_group_id."'";
            $builder_data = $this->Action_model->detail_result('tbl_builders',$where);
            $builder_list  = $builder_data ;
        }
        $data['builder_list'] = $builder_list;

        $agent_list = array();
        $where = "role_id='2' ";
        $agent_data = $this->Action_model->detail_result('tbl_users',$where);
        if ($agent_data) {
            $agent_list  = $agent_data ;
        }
        $data['agent_list'] = $agent_list;

        $where = "builder_group_status='1'";
        $builder_group_list = $this->Action_model->detail_result('tbl_builder_groups',$where);
        $data['builder_group_list'] = $builder_group_list;

        $where = "project_status_flag='1'";
        $project_status_list = $this->Action_model->detail_result('tbl_project_status',$where);
        $data['project_status_list'] = $project_status_list;

        $where = "product_type_status='1'";
        $project_type_list = $this->Action_model->detail_result('tbl_product_types',$where);
        $data['project_type_list'] = $project_type_list;

        $where = "unit_status='1'";
        $unit_list = $this->Action_model->detail_result('tbl_units',$where);
        $data['unit_list'] = $unit_list;

        $where = "state_id!=''";
        $state_list = $this->Action_model->detail_result('tbl_states',$where);
        $data['state_list'] = $state_list;

        $where = "accomodation_status='1'";
        $accomodation_list = $this->Action_model->detail_result('tbl_accomodations',$where,'accomodation_id,accomodation_name');
        $data['accomodation_list'] = $accomodation_list;

        $where = "unit_status='1'";
        $unit_list = $this->Action_model->detail_result('tbl_units',$where,'unit_id,unit_name');
        $data['unit_list'] = $unit_list;

        $where = "facing_status='1'";
        $facing_list = $this->Action_model->detail_result('tbl_facings',$where,'facing_id,title');
        $data['facing_list'] = $facing_list;

        $where = "amenitie_status='1'";
        $amenitie_list = $this->Action_model->detail_result('tbl_amenities',$where,'amenitie_id,amenitie_name');
        $data['amenitie_list'] = $amenitie_list;

        $where = "finance_status='1'";
        $finance_list = $this->Action_model->detail_result('tbl_finances',$where,'finance_id,finance_name');
        $data['finance_list'] = $finance_list;

        $where = "price_component_status='1'";
        $price_component_list = $this->Action_model->detail_result('tbl_price_components',$where,'price_component_id,price_component_name,price_group_id');
        $data['price_component_list'] = $price_component_list;

        $where = "specification_status='1'";
        $specification_list = $this->Action_model->detail_result('tbl_specifications',$where);
        $data['specification_list'] = $specification_list;

        $where = "authority_status='1'";
        $authority_list = $this->Action_model->detail_result('tbl_authorities',$where);
        $data['authority_list'] = $authority_list;

        $comm_product_unit_type_list = array();
        $where = "unit_type_status='1' AND product_type_id='3'";
        $comm_product_unit_type_data = $this->Action_model->detail_result('tbl_unit_types',$where,'unit_type_id,unit_type_name');
        if ($comm_product_unit_type_data) {
            $comm_product_unit_type_list = $comm_product_unit_type_data;
        }
        $data['comm_product_unit_type_list'] = $comm_product_unit_type_list;

        $blocks = array();
        $product_flat_unit_details = array();
        $product_villa_unit_details = array();
        $product_plot_unit_details = array();
        $product_unit_details = array();
        $product_comm_blocks = array();
        $unit_type_list = array();
        $location_list = array();
        if ($id) {

            $where = "location_status='1' AND state_id='".$product_detail->state_id."' AND city_id='".$product_detail->city_id."'";
            $location_list_data = $this->Action_model->detail_result('tbl_locations',$where,'location_id,location_name');
            if ($location_list_data) {
                $location_list = $location_list_data;
            }

            $where = "unit_type_status='1' AND product_type_id='".$product_detail->project_type."'";
            $unit_type_list = $this->Action_model->detail_result('tbl_unit_types',$where);

            $block_data = $this->Action_model->detail_result('tbl_product_block_details',"product_id='".$product_detail->product_id."' AND property_type='".$product_detail->property_type."' AND project_type='".$product_detail->project_type."' ORDER BY block_id ASC");
            if ($block_data) {
                $blocks = $block_data;
            }

            $tb_data = $this->Action_model->detail_result('tbl_product_unit_details',"product_id='".$product_detail->product_id."' AND property_type='".$product_detail->property_type."' AND project_type='".$product_detail->project_type."' ORDER BY product_unit_detail_id ASC");
            if ($tb_data) {
                $product_flat_unit_details = $tb_data;
            }

            $tb_data = $this->Action_model->detail_result('tbl_product_unit_details',"product_id='".$product_detail->product_id."' AND property_type='".$product_detail->property_type."' AND project_type='".$product_detail->project_type."' ORDER BY product_unit_detail_id ASC");
            if ($tb_data) {
                $product_villa_unit_details = $tb_data;
            }

            $tb_data = $this->Action_model->detail_result('tbl_product_unit_details',"product_id='".$product_detail->product_id."' AND property_type='".$product_detail->property_type."' AND project_type='".$product_detail->project_type."' ORDER BY product_unit_detail_id ASC");
            if ($tb_data) {
                $product_plot_unit_details = $tb_data;
            }

            $tb_data = $this->Action_model->detail_result('tbl_product_unit_details',"property_type='".$product_detail->property_type."' AND project_type='".$product_detail->project_type."' AND product_id='".$product_detail->product_id."' ORDER BY product_unit_detail_id ASC");
            if ($tb_data) {
                $product_unit_details = $tb_data;
            }

            $product_comm_block_data = $this->Action_model->detail_result('tbl_product_block_details',"property_type='".$product_detail->property_type."' AND project_type='".$product_detail->project_type."' AND product_id='".$product_detail->product_id."' ORDER BY block_id ASC");
            
            if ($product_comm_block_data) {
                $product_comm_blocks = $product_comm_block_data;
            }
        }
        $data['unit_type_list'] = $unit_type_list;
        $data['blocks'] = $blocks;
        $data['product_flat_unit_details'] = $product_flat_unit_details;
        $data['product_villa_unit_details'] = $product_villa_unit_details;
        $data['product_plot_unit_details'] = $product_plot_unit_details;
        $data['product_unit_details'] = $product_unit_details;
        $data['product_comm_blocks'] = $product_comm_blocks;
        $data['location_list'] = $location_list;


        $city_list = array();
        if ($id) {
            $where = "state_id='".$product_detail->state_id."'";
            $city_list = $this->Action_model->detail_result('tbl_city',$where);
        }
        $data['city_list'] = $city_list;

        $this->load->view(ADMIN_URL.'product_detail',$data);
    }

    public function product_view($id='')
    {   
        $product_detail = $this->Action_model->select_single('tbl_products',"product_id='".$id."'");
        $data['id'] = $id;
        $data['product_detail'] = $product_detail;

        $builder_list = array();
        if ($id) {

            if (!$product_detail) {
                redirect(ADMIN_URL);
            }
            $where = "builder_status='1' AND builder_group_id='".$product_detail->builder_group_id."'";
            $builder_data = $this->Action_model->detail_result('tbl_builders',$where);
            $builder_list  = $builder_data ;
        }
        $data['builder_list'] = $builder_list;

        $agent_list = array();
        $where = "role_id='2' ";
        $agent_data = $this->Action_model->detail_result('tbl_users',$where);
        if ($agent_data) {
            $agent_list  = $agent_data ;
        }
        $data['agent_list'] = $agent_list;

        $where = "builder_group_status='1'";
        $builder_group_list = $this->Action_model->detail_result('tbl_builder_groups',$where);
        $data['builder_group_list'] = $builder_group_list;

        $where = "project_status_flag='1'";
        $project_status_list = $this->Action_model->detail_result('tbl_project_status',$where);
        $data['project_status_list'] = $project_status_list;

        $where = "product_type_status='1'";
        $project_type_list = $this->Action_model->detail_result('tbl_product_types',$where);
        $data['project_type_list'] = $project_type_list;

        $where = "unit_status='1'";
        $unit_list = $this->Action_model->detail_result('tbl_units',$where);
        $data['unit_list'] = $unit_list;

        $where = "state_id!=''";
        $state_list = $this->Action_model->detail_result('tbl_states',$where);
        $data['state_list'] = $state_list;

        $where = "accomodation_status='1'";
        $accomodation_list = $this->Action_model->detail_result('tbl_accomodations',$where,'accomodation_id,accomodation_name');
        $data['accomodation_list'] = $accomodation_list;

        $where = "unit_status='1'";
        $unit_list = $this->Action_model->detail_result('tbl_units',$where,'unit_id,unit_name');
        $data['unit_list'] = $unit_list;

        $where = "facing_status='1'";
        $facing_list = $this->Action_model->detail_result('tbl_facings',$where,'facing_id,title');
        $data['facing_list'] = $facing_list;

        $where = "amenitie_status='1'";
        $amenitie_list = $this->Action_model->detail_result('tbl_amenities',$where,'amenitie_id,amenitie_name');
        $data['amenitie_list'] = $amenitie_list;

        $where = "finance_status='1'";
        $finance_list = $this->Action_model->detail_result('tbl_finances',$where,'finance_id,finance_name');
        $data['finance_list'] = $finance_list;

        $where = "price_component_status='1'";
        $price_component_list = $this->Action_model->detail_result('tbl_price_components',$where,'price_component_id,price_component_name,price_group_id');
        $data['price_component_list'] = $price_component_list;

        $where = "specification_status='1'";
        $specification_list = $this->Action_model->detail_result('tbl_specifications',$where);
        $data['specification_list'] = $specification_list;

        $where = "authority_status='1'";
        $authority_list = $this->Action_model->detail_result('tbl_authorities',$where);
        $data['authority_list'] = $authority_list;

        $comm_product_unit_type_list = array();
        $where = "unit_type_status='1' AND product_type_id='3'";
        $comm_product_unit_type_data = $this->Action_model->detail_result('tbl_unit_types',$where,'unit_type_id,unit_type_name');
        if ($comm_product_unit_type_data) {
            $comm_product_unit_type_list = $comm_product_unit_type_data;
        }
        $data['comm_product_unit_type_list'] = $comm_product_unit_type_list;

        $blocks = array();
        $product_flat_unit_details = array();
        $product_villa_unit_details = array();
        $product_plot_unit_details = array();
        $product_unit_details = array();
        $product_comm_blocks = array();
        $unit_type_list = array();
        $location_list = array();
        if ($id) {

            $where = "location_status='1' AND state_id='".$product_detail->state_id."' AND city_id='".$product_detail->city_id."'";
            $location_list_data = $this->Action_model->detail_result('tbl_locations',$where,'location_id,location_name');
            if ($location_list_data) {
                $location_list = $location_list_data;
            }

            $where = "unit_type_status='1' AND product_type_id='".$product_detail->project_type."'";
            $unit_type_list = $this->Action_model->detail_result('tbl_unit_types',$where);

            $block_data = $this->Action_model->detail_result('tbl_product_block_details',"product_id='".$product_detail->product_id."' AND property_type='".$product_detail->property_type."' AND project_type='".$product_detail->project_type."' ORDER BY block_id ASC");
            if ($block_data) {
                $blocks = $block_data;
            }

            $tb_data = $this->Action_model->detail_result('tbl_product_unit_details',"product_id='".$product_detail->product_id."' AND property_type='".$product_detail->property_type."' AND project_type='".$product_detail->project_type."' ORDER BY product_unit_detail_id ASC");
            if ($tb_data) {
                $product_flat_unit_details = $tb_data;
            }

            $tb_data = $this->Action_model->detail_result('tbl_product_unit_details',"product_id='".$product_detail->product_id."' AND property_type='".$product_detail->property_type."' AND project_type='".$product_detail->project_type."' ORDER BY product_unit_detail_id ASC");
            if ($tb_data) {
                $product_villa_unit_details = $tb_data;
            }

            $tb_data = $this->Action_model->detail_result('tbl_product_unit_details',"product_id='".$product_detail->product_id."' AND property_type='".$product_detail->property_type."' AND project_type='".$product_detail->project_type."' ORDER BY product_unit_detail_id ASC");
            if ($tb_data) {
                $product_plot_unit_details = $tb_data;
            }

            $tb_data = $this->Action_model->detail_result('tbl_product_unit_details',"property_type='".$product_detail->property_type."' AND project_type='".$product_detail->project_type."' AND product_id='".$product_detail->product_id."' ORDER BY product_unit_detail_id ASC");
            if ($tb_data) {
                $product_unit_details = $tb_data;
            }

            $product_comm_block_data = $this->Action_model->detail_result('tbl_product_block_details',"property_type='".$product_detail->property_type."' AND project_type='".$product_detail->project_type."' AND product_id='".$product_detail->product_id."' ORDER BY block_id ASC");
            
            if ($product_comm_block_data) {
                $product_comm_blocks = $product_comm_block_data;
            }
        }
        $data['unit_type_list'] = $unit_type_list;
        $data['blocks'] = $blocks;
        $data['product_flat_unit_details'] = $product_flat_unit_details;
        $data['product_villa_unit_details'] = $product_villa_unit_details;
        $data['product_plot_unit_details'] = $product_plot_unit_details;
        $data['product_unit_details'] = $product_unit_details;
        $data['product_comm_blocks'] = $product_comm_blocks;
        $data['location_list'] = $location_list;


        $city_list = array();
        if ($id) {
            $where = "state_id='".$product_detail->state_id."'";
            $city_list = $this->Action_model->detail_result('tbl_city',$where);
        }
        $data['city_list'] = $city_list;

        $this->load->view(ADMIN_URL.'product_view',$data);
    }

    public function product_detail1()
    {
        $this->load->view(ADMIN_URL.'product_detail1',$data="");
    }

    public function projects()
    {


        $this->load->view(ADMIN_URL.'projects',$data="");
    }

    public function property_products()
    {

        //$this->load->view(AGENT_URL.'products',$data="");
            $where = "country_id='1'";
            $state_list = $this->Action_model->detail_result('tbl_states',$where = "country_id='1'",'state_id,state_name');
            $data['state_list'] = $state_list;

            $where = "product_type_status='1'";
            $project_type_list = $this->Action_model->detail_result('tbl_product_types',$where,'product_type_id,product_type_name');
            $data['project_type_list'] = $project_type_list;

            $where = "accomodation_status='1'";
            $accomodation_list = $this->Action_model->detail_result('tbl_accomodations',$where,'accomodation_id,accomodation_name');
            $data['accomodation_list'] = $accomodation_list;

            $where = "lead_option_status='1'";
            $lead_option_list = $this->Action_model->detail_result('tbl_lead_options',$where,'lead_option_id,lead_option_name');
            $data['lead_option_list'] = $lead_option_list;

            $where = "budget_status='1'";
            $budget_list = $this->Action_model->detail_result('tbl_budgets',$where,'budget_id,budget_name');
            $data['budget_list'] = $budget_list;

            $where = "unit_status='1'";
            $unit_list = $this->Action_model->detail_result('tbl_units',$where,'unit_id,unit_name');
            $data['unit_list'] = $unit_list;

            $where = "lead_stage_status='1'";
            $lead_stage_list = $this->Action_model->detail_result('tbl_lead_stages',$where,'lead_stage_id,lead_stage_name');
            $data['lead_stage_list'] = $lead_stage_list;

            $where = "lead_type_status='1'";
            $lead_type_list = $this->Action_model->detail_result('tbl_lead_types',$where,'lead_type_id,lead_type_name');
            $data['lead_type_list'] = $lead_type_list;

            $where = "lead_action_status='1'";
            $lead_action_list = $this->Action_model->detail_result('tbl_lead_actions',$where,'lead_action_id,lead_action_name');
            $data['lead_action_list'] = $lead_action_list;

        $this->load->view(ADMIN_URL.'property_products',$data);
    }

    public function input_fields_additional()
    {
        $this->load->view(ADMIN_URL.'input_fields_additional',$data="");
    }

    public function input_fields_plc()
    {
        $this->load->view(ADMIN_URL.'input_fields_plc',$data="");
    }

    public function input_fields_specification()
    {
        $this->load->view(ADMIN_URL.'input_fields_specification',$data="");
    }

    public function input_fields_property_image()
    {
        $this->load->view(ADMIN_URL.'input_fields_property_image',$data="");
    }

    public function prospects()
    {
        $this->load->view(ADMIN_URL.'prospects',$data="");
    }

    public function teams()
    {
        $where = "role_id='1' OR is_admin_member='1'";
        $role_list = $this->Action_model->detail_result('tbl_roles',$where);
        $data['role_list'] = $role_list;
        $this->load->view(ADMIN_URL.'teams',$data);
    }

    public function user_detail()
    {
        $this->load->view(ADMIN_URL.'user_detail',$data="");
    }

    public function builders($id='')
    {
        if ($id) {
          $builder_detail = array();

          if ($id) {
              $where = "builder_id='".$id."'";

              $this->db->select('*');
              $this->db->from('tbl_builders');
              $this->db->join('tbl_country', "tbl_country.country_id = tbl_builders.builder_country_id", 'left');
              $this->db->join('tbl_states', "tbl_states.state_id = tbl_builders.builder_state_id", 'left');
              $this->db->join('tbl_city', "tbl_city.city_id = tbl_builders.builder_city_id", 'left');
              $this->db->join('tbl_firm_types', "tbl_firm_types.firm_type_id = tbl_builders.firm_type_id", 'left');
              $this->db->join('tbl_builder_groups', "tbl_builder_groups.builder_group_id = tbl_builders.builder_group_id", 'left');
              $this->db->where($where);
              $query = $this->db->get(); 
              $builder_detail = $query->row();

              if (!$builder_detail) {
                  redirect(ADMIN_URL);
              }
          }
          $data['id'] = $id;
          $data['builder_detail'] = $builder_detail;
          $this->load->view(ADMIN_URL.'builder_view',$data);
        }
        else {



            $where = "state_id!=''";
            $state_list = $this->Action_model->detail_result('tbl_states',$where);
            $data['state_list'] = $state_list;

            $city_list = array();
            /*if ($state) {
                $where = "state_id='".$state."'";
                $city_data = $this->Action_model->detail_result('tbl_city',$where);
                if ($city_data) {
                   $city_list = $city_data;
                }
            }*/
            $data['city_list'] = $city_list;

          $this->load->view(ADMIN_URL.'builders',$data);
        }
    }

    public function builder_detail($id='')
    {
        $builder_detail = array();

        if ($id) {
            $builder_detail = $this->Action_model->select_single('tbl_builders',"builder_id='".$id."'");
            if (!$builder_detail) {
                redirect(ADMIN_URL);
            }
        }

        $where = "builder_group_id!=''";
        $builder_group_list = $this->Action_model->detail_result('tbl_builder_groups',$where);

        $where = "firm_type_id!=''";
        $firm_type_list = $this->Action_model->detail_result('tbl_firm_types',$where);

        $where = "country_id!=''";
        $country_list = $this->Action_model->detail_result('tbl_country',$where);

        $where = "state_id!=''";
        $state_list = $this->Action_model->detail_result('tbl_states',$where);

        $city_list = array();
        if ($id) {
            $where = "state_id='".$builder_detail->builder_state_id."'";
            $city_list = $this->Action_model->detail_result('tbl_city',$where);
        }

        $data['id'] = $id;
        $data['builder_detail'] = $builder_detail;
        $data['builder_group_list'] = $builder_group_list;
        $data['firm_type_list'] = $firm_type_list;
        $data['country_list'] = $country_list;
        $data['state_list'] = $state_list;
        $data['city_list'] = $city_list;
        $this->load->view(ADMIN_URL.'builder_detail',$data);
    }

    public function lead_types()
    {   
        $this->load->view(ADMIN_URL.'lead_types',$data='');
    }

    public function lead_stages()
    {
        $this->load->view(ADMIN_URL.'lead_stages',$data="");
    }

    public function ideal_business()
    {
        $this->load->view(ADMIN_URL.'ideal_business',$data="");
    }

    public function lead_stage_detail()
    {
        $this->load->view(ADMIN_URL.'lead_stage_detail',$data="");
    }

    public function lead_actions()
    {
        $this->load->view(ADMIN_URL.'lead_actions',$data="");
    }

    public function construction_ages()
    {
        $this->load->view(ADMIN_URL.'construction_ages',$data="");
    }

    public function lead_sources()
    {
        $this->load->view(ADMIN_URL.'lead_sources',$data="");
    }

    public function furnishings()
    {
        $this->load->view(ADMIN_URL.'furnishings',$data="");
    }

    public function lead_source_detail()
    {
        $this->load->view(ADMIN_URL.'lead_source_detail',$data="");
    }

    public function task_actions()
    {
        $this->load->view(ADMIN_URL.'task_actions',$data="");
    }

    public function task_action_detail()
    {
        $this->load->view(ADMIN_URL.'task_action_detail',$data="");
    }

    public function units()
    {
        $this->load->view(ADMIN_URL.'units',$data="");
    }

    public function unit_detail()
    {
        $this->load->view(ADMIN_URL.'unit_detail',$data="");
    }

    public function departments()
    {
        $this->load->view(ADMIN_URL.'departments',$data="");
    }

    public function department_detail()
    {
        $this->load->view(ADMIN_URL.'department_detail',$data="");
    }

    public function locations()
    {
        $where = "state_id!=''";
        $state_list = $this->Action_model->detail_result('tbl_states',$where);
        $data['state_list'] = $state_list;
        $this->load->view(ADMIN_URL.'locations',$data);
    }

    public function location_detail()
    {
        $this->load->view(ADMIN_URL.'location_detail',$data="");
    }

    public function occupations()
    {
        $this->load->view(ADMIN_URL.'occupations',$data="");
    }

    public function occupation_detail()
    {
        $this->load->view(ADMIN_URL.'occupation_detail',$data="");
    }

    public function product_types()
    {
        $this->load->view(ADMIN_URL.'product_types',$data="");
    }

    public function product_type_detail()
    {
        $this->load->view(ADMIN_URL.'product_type_detail',$data="");
    }

    public function unit_types()
    {
        $where = "product_type_id!=''";
        $product_type_list = $this->Action_model->detail_result('tbl_product_types',$where);
        $data['product_type_list'] = $product_type_list;
        $this->load->view(ADMIN_URL.'unit_types',$data);
    }

    public function unit_type_detail()
    {
        $this->load->view(ADMIN_URL.'unit_type_detail',$data="");
    }

    public function price_components()
    {
        $where = "price_group_id!=''";
        $price_group_list = $this->Action_model->detail_result('tbl_price_groups',$where);
        $data['price_group_list'] = $price_group_list;
        $this->load->view(ADMIN_URL.'price_components',$data);
    }

    public function price_component_detail()
    {
        $this->load->view(ADMIN_URL.'price_component_detail',$data="");
    }

    public function firm_types()
    {
        $this->load->view(ADMIN_URL.'firm_types',$data="");
    }

    public function property_types()
    {
        $this->load->view(ADMIN_URL.'property_types',$data="");
    }

    public function builder_groups()
    {
        $this->load->view(ADMIN_URL.'builder_groups',$data="");
    }

    public function accomodations()
    {
        $this->load->view(ADMIN_URL.'accomodations',$data="");
    }

    public function floors()
    {
        $this->load->view(ADMIN_URL.'floors',$data="");
    }

    public function facings()
    {
        $this->load->view(ADMIN_URL.'facings',$data="");
    }

    public function specifications()
    {
        $this->load->view(ADMIN_URL.'specifications',$data="");
    }

    public function amenities()
    {
        $this->load->view(ADMIN_URL.'amenities',$data="");
    }

    public function finances()
    {
        $this->load->view(ADMIN_URL.'finances',$data="");
    }

    public function authorities()
    {
        $where = "state_id!=''";
        $state_list = $this->Action_model->detail_result('tbl_states',$where);
        $data['state_list'] = $state_list;
        $this->load->view(ADMIN_URL.'authorities',$data);
    }

    public function modules()
    {   
        $this->load->view(ADMIN_URL.'modules',$data='');
    }

    public function roles()
    {   
        $this->load->view(ADMIN_URL.'roles',$data='');
    }

    public function role_permission($id='')
    {   
        if (!$id) {
            redirect(ADMIN_URL);
        }

        $where="am.module_status='1'";
        $this->db->select('*,am.module_id as m_id');
        $this->db->from('tbl_modules am');
        $this->db->join('tbl_role_rights arr', "arr.module_id = am.module_id and arr.role_id='".$id."'", 'left');
        $this->db->where($where);
        $query = $this->db->get(); 
        $module_list = $query->result();

        $role_detail = $this->Action_model->select_single('tbl_roles',"role_id='".$id."'");

        $data['module_list'] = $module_list;
        $data['role_detail'] = $role_detail;
        $this->load->view(ADMIN_URL.'role_permission',$data);
    }

    public function role_permission_process()
    {
        if ($this->input->post()) {
            $role_id=$this->input->post('role_id');
            $module_array=$this->input->post('module');
            $module_ids=$this->input->post('module_id');

            $where = "role_id='".$role_id."'";
            $result = $this->Action_model->select_single('tbl_roles',$where);
            

            if ($result) {
                if ($module_ids) {
                    foreach ($module_ids as $mk => $module_id) {

                        $where = "role_id='".$role_id."' and module_id='".$module_id."'";
                        $role_right = $this->Action_model->select_single('tbl_role_rights',$where);

                        $rr_create = 0;
                        $rr_edit = 0;
                        $rr_delete = 0;
                        $rr_view = 0;

                        
                        if (isset($module_array[$module_id]['rr_create'])) {
                            $rr_create = 1;
                        }
                        if (isset($module_array[$module_id]['rr_edit'])) {
                            $rr_edit = 1;
                        }
                        if (isset($module_array[$module_id]['rr_delete'])) {
                            $rr_delete = 1;
                        }
                        if (isset($module_array[$module_id]['rr_view'])) {
                            $rr_view = 1;
                        }

                        if ($role_right) {
                            $array = array('rr_create'=>$rr_create,'rr_edit'=>$rr_edit,'rr_delete'=>$rr_delete,'rr_view'=>$rr_view);

                            $this->Action_model->update_data($array,'tbl_role_rights',array('role_id'=>$role_id,'module_id'=>$module_id));
                        }
                        else {

                            $array = array('rr_create'=>$rr_create,'rr_edit'=>$rr_edit,'rr_delete'=>$rr_delete,'rr_view'=>$rr_view,'role_id'=>$role_id,'module_id'=>$module_id);

                            $this->Action_model->insert_data($array,'tbl_role_rights'); 
                        }
                       
                    }
                }
                $this->session->set_flashdata('success_msg', 'Permission Updated Successfully!!');
                redirect(ADMIN_URL.'role_permission/'.$role_id);
            }
            else {
                redirect(ADMIN_URL);
            }
        }
        else {
            redirect(ADMIN_URL);
        }               
    }

    public function change_password()
    {
        $this->load->view(ADMIN_URL.'change_password',$data="");
    }

    public function update_profile()
    {
        $where = "user_hash='".$this->session->userdata('admin_user_hash')."'";
        $user_detail = $this->Action_model->select_single('tbl_users',$where);
        $data['user_detail'] = $user_detail;
        $this->load->view(ADMIN_URL.'update_profile',$data);
    }

    public function general_setting()
    {
        $where = "setting_id='1'";
        $setting_detail = $this->Action_model->select_single('tbl_setting',$where);
        $data['setting_detail'] = $setting_detail;
        $this->load->view(ADMIN_URL.'general_setting',$data);
    }
    public function sms_configration()
    {
        $where = "setting_id='1'";
        $setting_detail = $this->Action_model->select_single('tbl_setting',$where);
        $data['setting_detail'] = $setting_detail;
        $this->load->view(ADMIN_URL.'sms_configration',$data);
    }

    public function chats()
    {
        $where = "user_hash='".$this->session->userdata('admin_user_hash')."'";
        $user_detail = $this->Action_model->select_single('tbl_users',$where);
        $data['user_detail'] = $user_detail;
        $this->load->view(ADMIN_URL.'chats',$data);
    }

    public function tickets()
    {   

        $this->load->view(ADMIN_URL.'tickets',$data='');
    }

    public function ticket_detail($id='')
    {   
        
        $where = "user_hash='".$this->session->userdata('admin_user_hash')."'";
        $user_detail = $this->Action_model->select_single('tbl_users',$where);

        $user_id = $user_detail->user_id;

        $ticket_detail = $this->Action_model->select_single_join('tbl_tickets',"ticket_track_id='".$id."'","*,tbl_tickets.user_id as user_id",array("tbl_users","tbl_users.user_id=tbl_tickets.user_id"));
        if ($ticket_detail) {

            $ticket_messages = array();

            $where = "ticket_id='".$ticket_detail->ticket_id."' AND ((receiver_id='".$ticket_detail->user_id."' AND sender_id='1') OR (sender_id='".$ticket_detail->user_id."' AND receiver_id='1')) ORDER BY ticket_message_id ASC";
            $this->db->select('s.first_name as s_first_name,s.last_name as s_last_name,r.first_name as r_first_name,r.last_name as r_last_name,s.image as s_image,r.image as r_image,sender_id,receiver_id,ticket_message,tbl_ticket_messages.created_at as created_at');
            $this->db->from('tbl_ticket_messages');
            $this->db->join('tbl_users as s', 's.user_id = tbl_ticket_messages.sender_id');
            $this->db->join('tbl_users as r', 'r.user_id = tbl_ticket_messages.receiver_id');
            $this->db->where($where);
            $query = $this->db->get();
            $ticket_message_data = $query->result();

            if ($ticket_message_data) {
                $ticket_messages = $ticket_message_data;
            }

            $data['ticket_detail']=$ticket_detail;
            $data['ticket_messages']=$ticket_messages;
            $data['user_detail']=$user_detail;
            $this->load->view(ADMIN_URL.'ticket_detail',$data);
        }
        else {
            redirect(ADMIN_URL);
        }
    }

    public function budgets()
    {   
        $this->load->view(ADMIN_URL.'budgets',$data='');
    }

    public function designations()
    {   
        $this->load->view(ADMIN_URL.'designations',$data='');
    }

    public function logout()
    {
        $this->session->sess_destroy();
            redirect(ADMIN_URL.'login');
    }

    public function sms_credit_history($id='')
    {   

        if ($id) {

            $this->db->select('*');
            $this->db->from('tbl_users a');
            $this->db->join('tbl_city c', 'c.city_id = a.city_id', 'left');
            $this->db->join('tbl_states s', 's.state_id = a.state_id', 'left');
            $this->db->where("user_id='".$id."' and role_id='2'");
            $query = $this->db->get(); 
            $agent_detail = $query->row();

            if (!$agent_detail) {
               redirect(ADMIN_URL);
            }
            $data['id']=$id;
            $data['agent_detail']=$agent_detail;

            $this->load->view(ADMIN_URL.'sms_credit_history',$data);
        }
        else {
           redirect(ADMIN_URL);
        }
    }

     public function sms_used_history($id='')
    {   

        if ($id) {

            $this->db->select('*');
            $this->db->from('tbl_users a');
            $this->db->join('tbl_city c', 'c.city_id = a.city_id', 'left');
            $this->db->join('tbl_states s', 's.state_id = a.state_id', 'left');
            $this->db->where("user_id='".$id."' and role_id='2'");
            $query = $this->db->get(); 
            $agent_detail = $query->row();

            if (!$agent_detail) {
               redirect(ADMIN_URL);
            }
            $data['id']=$id;
            $data['agent_detail']=$agent_detail;

            $this->load->view(ADMIN_URL.'sms_used_history',$data);
        }
        else {
           redirect(ADMIN_URL);
        }
    }

    public function templates()
    {
        $this->load->view(ADMIN_URL.'templates',$data="");
    }
}
