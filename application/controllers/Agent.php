<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agent extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Action_model');


        //$this->session->set_userdata('agent_hash','5516bd3759189f0ab02d2d5d393dc4ca15742763086851');
        if (!$this->session->userdata('agent_hash')) {
            redirect(AGENT_URL . 'login');
        }

        $agent = $this->getAgent();

        if ($agent->role_id == 2) {

            $user_detail = $agent;
            $data['user_detail'] = $user_detail;

            $where = "plan_id='" . $user_detail->plan_id . "'";
            $plan_detail = $this->Action_model->select_single('tbl_plan', $where);

            $is_trial = false;
            $trial_expired = false;
            $trial_remaining_days = 0;
            $expire_today = 0;
            if ($user_detail->plan_id == 1) {

                $date1 = new DateTime(date("d-m-Y") . " 00:00:00");
                $date2 = new DateTime($user_detail->next_due_date . " 00:00:00");
                $interval = $date1->diff($date2);
                $days = $interval->days;

                $is_trial = true;

                if ($user_detail->next_due_date == date("d-m-Y")) {
                    $expire_today = 1;
                } else if (strtotime($user_detail->next_due_date . " 00:00:00") < strtotime(date("d-m-Y") . " 00:00:00")) {
                    $trial_expired = true;
                    $trial_remaining_days = 0;
                } else {
                    $trial_remaining_days = $days;
                }
            } else if ($user_detail->plan_id == 2) {

                $date1 = new DateTime(date("d-m-Y") . " 00:00:00");
                $date2 = new DateTime($user_detail->next_due_date . " 00:00:00");
                $interval = $date1->diff($date2);
                $days = $interval->days;

                if ($user_detail->next_due_date == date("d-m-Y")) {
                    $expire_today = 1;
                } else if (strtotime($user_detail->next_due_date . " 00:00:00") < strtotime(date("d-m-Y") . " 00:00:00")) {
                    $trial_remaining_days = 0;
                } else {
                    $trial_remaining_days = $days;
                }
            }

            if ($expire_today == 0 && $trial_remaining_days <= 0) {
                redirect(AGENT_URL . 'pay');
            }

            if ($agent->role_id == '2' && $agent->associate_complete == 0) {

                //$check_payment = "user_id='".$agent->user_id."' AND payment_status='1'";
                //$check_payment = $this->Action_model->detail_result('tbl_users',$w1);

                redirect(AGENT_URL . 'associate-registration');
            }
        }
    }

    # User
    public function user()
    {
        $user               =   null;

        $agent_hash         =   $this->session->userdata('agent_hash');

        if ($agent_hash):
            $where              =   "user_hash='" . $agent_hash . "'";
                                                    $this->db->select('user.*,  role.role_name');
                                                    $this->db->where($where);
                                                    $this->db->from('tbl_users as user');
                                                    $this->db->join('tbl_roles  as role', 'user.role_id = role.role_id', 'left');
            $user               =                   $this->db->get()->row();
    
        endif;

        if (!$user):
            echo "Unauthorized";
            die;
        endif;

        # Permission Roles
            $permission_roles                       =   [];
            
            # For Agent 
            if($user->role_id == 2):
                $permission_roles                       =   [3,4,5];
            endif;
            # End For Agent 

            # Level 1
            if($user->role_id == 3):
                $permission_roles                       =   [0];
            endif;
            # End Level 1

            # Level 2
            if($user->role_id == 4):
                $permission_roles                       =   [3];
            endif;
            # End Level 2

            # Level 3
            if($user->role_id == 5):
                $permission_roles                       =   [3, 4];
            endif;
            # End Level 3

            $user->permission_roles                 =   implode(',', $permission_roles);
        # Permission Roles

        return $user;
    }
    # End User

    # Panel Icons
    public function icons()
    {
        return $this->load->view('agent/include/icons');
    }
    # End Panel Icons

    public function index()
    {

        # Member Ids
        $selected_member_ids_arr            =   [];
        $selected_member_ids                =  $this->input->get('member');

        # End Member Ids
        $user_detail                        =   $this->user();

        $account_id                         =   getAccountId();
        $user_id                            =   $user_detail->user_id;

        # Init
        $is_trial                           =   false;
        $trial_expired                      =   false;
        $trial_remaining_days               =   0;
        $expire_today                       =   0;
        # End Init

        # Trial Plan

            # Magical Function
            $this->trial_plan($is_trial, $trial_expired, $trial_remaining_days, $expire_today);
            # End Magical Function

            #
            $trial_alert_msg        = '';

            if ($is_trial && $trial_expired):
              $trial_alert_msg        = 'Your trial has ended.';
    
            elseif ($is_trial && $expire_today):
              $trial_alert_msg        = 'Your trial expires today 11:59:00 PM';
    
            elseif ($is_trial && !$trial_expired):
              $trial_alert_msg        = "Your trial expires in $trial_remaining_days days";
    
            elseif (!$is_trial && $expire_today):
              $trial_alert_msg        = "Your plan expires today 11:59:00 PM";
    
            elseif (!$is_trial && $trial_remaining_days && $trial_remaining_days <= 10):
              $trial_alert_msg        = "Your plan expires in $trial_remaining_days days";
    
            elseif (!$is_trial && $trial_remaining_days == 0):
              $trial_alert_msg        = " Your plan has expired. Please update your payment details to reactive it.";
            endif;
            #

            $tiral_data             =   (object) [
                                                    'is_trial'      => $trial_alert_msg ? true : false,
                                                    'message'       => $trial_alert_msg,
                                                    'pay_url'       => base_url(AGENT_URL . 'pay')
                                                ];
        # End Trial Plan

        # Teams Member
        $where                              =   "(user.role_id in ($user_detail->permission_roles) or user.user_id = '$user_detail->user_id') and user.user_status='1' AND (user.user_id='$account_id' OR user.parent_id='$account_id') ORDER BY user.user_id ASC";
        $this->db->select("user.user_id as id, concat(IFNULL(user.user_title, ''),' ', IFNULL(user.first_name, ''), ' ', IFNULL(user.last_name, '')) as full_name, role.role_name");
        $this->db->from('tbl_users as user');
        $this->db->join('tbl_roles  as role', 'user.role_id = role.role_id', 'left');
        $this->db->where($where);
        $members                            =   $this->db->get()->result();

        # End Team Member

        # Member Ids
                // Extracting IDs
                $members_ids_arr                    =  null;
                if(!$selected_member_ids):
                    $members_ids_arr                =   array_map(function($member) {
                                                                        return $member->id;
                                                                    }, $members);
                    
                    $members_ids                    =   implode(",", $members_ids_arr);
                endif;
        # End Member Ids
        # Leads & Followup Query
        

        $where                              =   "(user.role_id in ($user_detail->permission_roles) or user.user_id = '$user_detail->user_id')";
        
        if(!$selected_member_ids):
            $where                          .=   " and lead.user_id in ($members_ids) ";
        else:
            $where                          .=   " and lead.user_id in ($selected_member_ids) ";
        endif;

        $lead_select_query                  =   "
                                                    count(*) as total_count,
                                                    SUM(CASE WHEN STR_TO_DATE(lead_date, '%d-%m-%Y')  = CURDATE() THEN 1 ELSE 0 END) as today_count
                                                ";
                                               
        $this->db->select($lead_select_query);
        $this->db->where($where);
        $this->db->from('tbl_leads as lead');
        $this->db->join('tbl_users  as user', 'user.user_id = lead.user_id', 'left');
        $leads                          =   $this->db->get()->row();
       # End Leads


        # Followup
        $where                              =   "(user.role_id in ($user_detail->permission_roles) or user.user_id = '$user_detail->user_id') and followup.account_id='$account_id'";
        
        
        if(!$selected_member_ids):
            $where                          .=   " and followup.user_id in ($members_ids) ";
        else:
            $where                          .=   " and followup.user_id in ($selected_member_ids) ";
        endif;

        $followup_select_query                  =   "
                                                        count(*) as total_count,
                                                        SUM(CASE WHEN ( STR_TO_DATE(next_followup_date, '%d-%m-%Y')  = CURDATE() AND followup_status = '1' AND lead_status_id = 1 ) THEN 1 ELSE 0 END) as today_count,
                                                        SUM(CASE WHEN ( STR_TO_DATE(next_followup_date, '%d-%m-%Y')  < CURDATE() AND followup_status = '1' AND lead_status_id = 1 ) THEN 1 ELSE 0 END) as missed_count,
                                                        SUM(CASE WHEN lead_stage_id = '1' THEN 1 ELSE 0 END) as total_initial_count,
                                                        SUM(CASE WHEN lead_stage_id = '2' THEN 1 ELSE 0 END) as total_followup_count,
                                                        SUM(CASE WHEN lead_stage_id = '3' THEN 1 ELSE 0 END) as total_enquiry_count,
                                                        SUM(CASE WHEN lead_stage_id = '4' THEN 1 ELSE 0 END) as total_site_visit_count,
                                                        SUM(CASE WHEN lead_stage_id = '5' THEN 1 ELSE 0 END) as total_metting_count,
                                                        SUM(CASE WHEN lead_stage_id = '6' THEN 1 ELSE 0 END) as total_success_count,
                                                        SUM(CASE WHEN lead_stage_id = '7' THEN 1 ELSE 0 END) as total_dump_count
                                                    ";

        $this->db->select($followup_select_query);
        $this->db->where($where);
        $this->db->from('tbl_followup as followup');
        $this->db->join('tbl_users  as user', 'user.user_id = followup.user_id', 'left');
        $followups                          =   $this->db->get()->row();

        # End Followup


        # End Leads & Followup Query

        # Data   
        $data['trial']                      =   $tiral_data;

        # Count
        $data['leads']                      =   $leads;
        $data['followups']                  =   $followups;
        # End Count
        $data['members']                    =   $members;
        $data['property_types']             =   $property_types ?? [];
        $data['user_detail']                =   $user_detail;
        # End Data   

        $this->load->view(AGENT_URL . 'index', $data);
    }

    public function index_old()
    {

        $member = ($this->input->get('member') && is_numeric($this->input->get('member'))) ? $this->input->get('member') : "";
        $project = ($this->input->get('project') && is_numeric($this->input->get('project'))) ? $this->input->get('project') : "";

        $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
        $user_detail = $this->Action_model->select_single('tbl_users', $where);

        $is_trial = false;
        $trial_expired = false;
        $trial_remaining_days = 0;
        $expire_today = 0;

        if ($user_detail) {
            $data['user_detail'] = $user_detail;

            $where = "plan_id='" . $user_detail->plan_id . "'";
            $plan_detail = $this->Action_model->select_single('tbl_plan', $where);


            if ($user_detail->plan_id == 1) {

                $date1 = new DateTime(date("d-m-Y") . " 00:00:00");
                $date2 = new DateTime($user_detail->next_due_date . " 00:00:00");
                $interval = $date1->diff($date2);
                $days = $interval->days;

                $is_trial = true;

                if ($user_detail->next_due_date == date("d-m-Y")) {
                    $expire_today = 1;
                } else if (strtotime($user_detail->next_due_date . " 00:00:00") < strtotime(date("d-m-Y") . " 00:00:00")) {
                    $trial_expired = true;
                    $trial_remaining_days = 0;
                } else {
                    $trial_remaining_days = $days;
                }
            } else if ($user_detail->plan_id == 2) {

                $date1 = new DateTime(date("d-m-Y") . " 00:00:00");
                $date2 = new DateTime($user_detail->next_due_date . " 00:00:00");
                $interval = $date1->diff($date2);
                $days = $interval->days;

                if ($user_detail->next_due_date == date("d-m-Y")) {
                    $expire_today = 1;
                } else if (strtotime($user_detail->next_due_date . " 00:00:00") < strtotime(date("d-m-Y") . " 00:00:00")) {
                    $trial_remaining_days = 0;
                } else {
                    $trial_remaining_days = $days;
                }
            }

            $data['is_trial'] = $is_trial;
            $data['trial_expired'] = $trial_expired;
            $data['trial_remaining_days'] = $trial_remaining_days;
            $data['expire_today'] = $expire_today;
        }


        $upcoming_followup = 0;
        $today_followup = 0;
        $missed_followup = 0;
        $total_project = 0;
        $total_property_rent = 0;
        $total_property_sale = 0;
        $total_lead_rent = 0;
        $total_lead_sale = 0;
        $total_lead_active_rent = 0;
        $total_lead_conversion_rent = 0;
        $total_lead_dead_rent = 0;
        $total_lead_active_sale = 0;
        $total_lead_conversion_sale = 0;
        $total_lead_dead_sale = 0;

        $account_id = getAccountId();

        $where = "account_id='" . $account_id . "'" . (($member) ? " AND tbl_leads.user_id='" . $member . "'" : "");
        $tb_data = $this->Action_model->select_single('tbl_leads', $where, "COUNT(CASE WHEN added_to_followup = 1 THEN lead_id END) as upcoming_followup,COUNT(CASE WHEN followup_date = '" . date('d-m-Y') . "' THEN lead_id END) as today_followup,COUNT(CASE WHEN added_to_followup = 0 THEN lead_id END) as missed_followup");

        $where = "account_id='" . $account_id . "' AND UNIX_TIMESTAMP(STR_TO_DATE(followup_date, '%d-%m- %Y')) >= " . strtotime(date("d-m-Y", strtotime('tomorrow')) . "00:00:00") . (($member) ? " AND tbl_leads.user_id='" . $member . "'" : "");
        $dd = $this->Action_model->select_single('tbl_leads', $where, "count(lead_id) as total");
        if ($dd) {
            $upcoming_followup = $dd->total;
        }

        $data['upcoming_followup'] = $upcoming_followup;
        $data['today_followup'] = $tb_data->today_followup;
        $data['missed_followup'] = $tb_data->missed_followup;

        $data['total_lead_active_rent'] = $total_lead_active_rent;
        $data['total_lead_conversion_rent'] = $total_lead_conversion_rent;
        $data['total_lead_dead_rent'] = $total_lead_dead_rent;
        $data['total_lead_active_sale'] = $total_lead_active_sale;
        $data['total_lead_conversion_sale'] = $total_lead_conversion_sale;
        $data['total_lead_dead_sale'] = $total_lead_dead_sale;

        $where = "tbl_leads.account_id='" . $account_id . "' AND look_for='2'" . (($member) ? " AND tbl_leads.user_id='" . $member . "'" : "");
        $this->db->select("count(tbl_requirements.lead_id) as total");
        $this->db->from('tbl_requirements');
        $this->db->join('tbl_leads', "tbl_leads.lead_id = tbl_requirements.lead_id");
        $this->db->where($where);
        $query = $this->db->get();
        $dd = $query->row();
        if ($dd) {
            $total_lead_rent = $dd->total;
        }

        $where = "tbl_leads.account_id='" . $account_id . "' AND (look_for='1' OR look_for='3')" . (($member) ? " AND tbl_leads.user_id='" . $member . "'" : "");
        $this->db->select("count(tbl_requirements.lead_id) as total");
        $this->db->from('tbl_requirements');
        $this->db->join('tbl_leads', "tbl_leads.lead_id = tbl_requirements.lead_id");
        $this->db->where($where);
        $query = $this->db->get();
        $dd = $query->row();
        if ($dd) {
            $total_lead_sale = $dd->total;
        }


        $where = "tbl_leads.account_id='" . $account_id . "' AND lead_status='1' AND look_for='2'" . (($member) ? " AND tbl_leads.user_id='" . $member . "'" : "");
        $this->db->select("count(tbl_requirements.lead_id) as total");
        $this->db->from('tbl_requirements');
        $this->db->join('tbl_leads', "tbl_leads.lead_id = tbl_requirements.lead_id");
        $this->db->where($where);
        $query = $this->db->get();
        $dd = $query->row();
        if ($dd) {
            $total_lead_active_rent = $dd->total;
        }

        $where = "tbl_leads.account_id='" . $account_id . "' AND lead_status='1' AND (look_for='1' OR look_for='3')" . (($member) ? " AND tbl_leads.user_id='" . $member . "'" : "");
        $this->db->select("count(tbl_requirements.lead_id) as total");
        $this->db->from('tbl_requirements');
        $this->db->join('tbl_leads', "tbl_leads.lead_id = tbl_requirements.lead_id");
        $this->db->where($where);
        $query = $this->db->get();
        $dd = $query->row();
        if ($dd) {
            $total_lead_active_sale = $dd->total;
        }


        $where = "tbl_leads.account_id='" . $account_id . "' AND lead_status='2' AND look_for='2'" . (($member) ? " AND tbl_leads.user_id='" . $member . "'" : "");
        $this->db->select("count(tbl_requirements.lead_id) as total");
        $this->db->from('tbl_requirements');
        $this->db->join('tbl_leads', "tbl_leads.lead_id = tbl_requirements.lead_id");
        $this->db->where($where);
        $query = $this->db->get();
        $dd = $query->row();
        if ($dd) {
            $total_lead_dead_rent = $dd->total;
        }

        $where = "tbl_leads.account_id='" . $account_id . "' AND lead_status='2' AND (look_for='1' OR look_for='3')" . (($member) ? " AND tbl_leads.user_id='" . $member . "'" : "");
        $this->db->select("count(tbl_requirements.lead_id) as total");
        $this->db->from('tbl_requirements');
        $this->db->join('tbl_leads', "tbl_leads.lead_id = tbl_requirements.lead_id");
        $this->db->where($where);
        $query = $this->db->get();
        $dd = $query->row();
        if ($dd) {
            $total_lead_dead_sale = $dd->total;
        }

        $where = "tbl_leads.account_id='" . $account_id . "' AND lead_status='1' AND look_for='2'" . (($member) ? " AND tbl_leads.user_id='" . $member . "'" : "");
        $this->db->select("count(tbl_requirements.lead_id) as total");
        $this->db->from('tbl_requirements');
        $this->db->join('tbl_leads', "tbl_leads.lead_id = tbl_requirements.lead_id");
        $this->db->where($where);
        $query = $this->db->get();
        $dd = $query->row();
        if ($dd) {
            $total_lead_conversion_rent = $dd->total;
        }

        $where = "tbl_leads.account_id='" . $account_id . "' AND lead_status='3' AND (look_for='1' OR look_for='3')" . (($member) ? " AND tbl_leads.user_id='" . $member . "'" : "");
        $this->db->select("count(tbl_requirements.lead_id) as total");
        $this->db->from('tbl_requirements');
        $this->db->join('tbl_leads', "tbl_leads.lead_id = tbl_requirements.lead_id");
        $this->db->where($where);
        $query = $this->db->get();
        $dd = $query->row();
        if ($dd) {
            $total_lead_conversion_sale = $dd->total;
        }

        $where = "account_id='" . $account_id . "' AND property_status='3' AND listing_type='1'" . (($member) ? " AND account_id='" . $member . "'" : "");
        $dd = $this->Action_model->select_single('tbl_property', $where, "count(property_id) as total");
        if ($dd) {
            $total_property_rent = $dd->total;
        }

        $where = "account_id='" . $account_id . "' AND property_status='1' AND listing_type='2'" . (($member) ? " AND account_id='" . $member . "'" : "");
        $dd = $this->Action_model->select_single('tbl_property', $where, "count(property_id) as total");
        if ($dd) {
            $total_property_sale = $dd->total;
        }

        $where = "user_status='1' AND (user_id='" . $account_id . "' OR parent_id='" . $account_id . "') ORDER BY user_id ASC";

        $this->db->select("*");
        $this->db->from('tbl_users');
        $this->db->join('tbl_city', "tbl_city.city_id = tbl_users.city_id", 'left');
        $this->db->where($where);
        $query = $this->db->get();
        $member_list = $query->result();
        $data['member_list'] = $member_list;

        $where = "product_status='1' AND (tbl_products.agent_id='" . $account_id . "') ORDER BY tbl_products.product_id ASC";

        $this->db->select("product_id,project_name");
        $this->db->from('tbl_products');
        $this->db->where($where);
        $query = $this->db->get();
        $project_list = $query->result();
        $data['project_list'] = $project_list;

        $total_project = ($project_list) ? count($project_list) : 0;
        $data['total_project'] = $total_project;

        $where = "user_status='1' AND (user_id='" . $account_id . "' OR parent_id='" . $account_id . "')" . (($member) ? " AND user_id='" . $member . "'" : "") . " ORDER BY user_id ASC";

        $this->db->select("*");
        $this->db->from('tbl_users');
        $this->db->join('tbl_city', "tbl_city.city_id = tbl_users.city_id", 'left');
        $this->db->where($where);
        $query = $this->db->get();
        $user_data = $query->result();
        $user_list = array();
        if ($user_data) {
            foreach ($user_data as $row) {

                $where = "user_id='" . $row->user_id . "'";
                $this->db->select("count(tbl_leads.lead_id) as total");
                $this->db->from('tbl_leads');
                $this->db->where($where);
                $query = $this->db->get();
                $dd = $query->row();
                $total_lead = 0;
                if ($dd) {
                    $total_lead = $dd->total;
                }
                $row->total_lead = $total_lead;

                $where = "user_id='" . $row->user_id . "' AND lead_status='3'";
                $this->db->select("count(tbl_leads.lead_id) as total");
                $this->db->from('tbl_leads');
                $this->db->where($where);
                $query = $this->db->get();
                $dd = $query->row();
                $percentage_conversion = 0;
                $total_conversion = 0;
                if ($dd) {
                    $total_conversion = $dd->total;
                }
                $percentage_conversion = ($total_conversion == 0 && $total_lead == 0) ? 0 : ($total_conversion * 100) / $total_lead;
                $percentage_conversion = number_format((float)$percentage_conversion, 2, '.', '');
                $row->percentage_conversion = str_replace("0.00", "0", $percentage_conversion);

                $where = "tbl_site_visit.user_id='" . $row->user_id . "'";
                $this->db->select("count(tbl_leads.lead_id) as total");
                $this->db->from('tbl_leads');
                $this->db->join('tbl_site_visit', "tbl_site_visit.lead_id = tbl_leads.lead_id", 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $dd = $query->row();
                $percentage_site_visit = 0;
                $total_site_visit = 0;
                if ($dd) {
                    $total_site_visit = $dd->total;
                }

                if ($total_conversion == 0 &&  $total_site_visit == 0) :

                    $percentage_site_visit  =   0;

                else :

                    $percentage_site_visit =    $total_site_visit ? ($total_conversion * 100) / ($total_site_visit) : 0;

                endif;

                // $percentage_site_visit = ($total_conversion==0 && $total_site_visit==0)?0:($total_conversion*100)/$total_site_visit;
                $percentage_site_visit = number_format((float)$percentage_site_visit, 2, '.', '');
                $row->percentage_site_visit = str_replace("0.00", "0", $percentage_site_visit);

                $user_list[] = $row;
            }
        }
        $data['user_list'] = $user_list;
        $data['total_lead_sale'] = $total_lead_sale;
        $data['total_lead_rent'] = $total_lead_rent;
        $data['total_property_rent'] = $total_property_rent;
        $data['total_property_sale'] = $total_property_sale;

        $this->load->view(AGENT_URL . 'index', $data);
    }


    public function get_level_user_ids($value = '')
    {
        $account_id = getAccountId();
        $agent = $this->getAgent();
        $user_role_id = $agent->role_id;

        $user_ids = array();
        if ($user_role_id == 5) {
            $user_ids[] = $agent->user_id;

            $w1 = "role_id='4' AND report_to='" . $agent->user_id . "'";
            $d1 = $this->Action_model->detail_result('tbl_users', $w1);
            if ($d1) {
                foreach ($d1 as $item1) {

                    $user_ids[] = $item1->user_id;

                    $w2 = "role_id='3' AND report_to='" . $item1->user_id . "'";
                    $d2 = $this->Action_model->detail_result('tbl_users', $w2);
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
            $d1 = $this->Action_model->detail_result('tbl_users', $w1);
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

    public function download_inventory()
    {
        $product_id = $this->input->get('pid');
        if ($product_id) {
            $data['product_id'] = $product_id;
            $account_id = getAccountId();
            $where = "product_id='" . $product_id . "' AND tbl_products.agent_id='" . $account_id . "'";
            $product_detail = $this->Action_model->select_single('tbl_products', $where);
            if ($product_detail) {
                $records = array();
                $where = "product_id='" . $product_id . "'";
                $record_data = $this->Action_model->detail_result('tbl_inventory', $where);
                if ($record_data) {
                    $records = $record_data;
                }
                $data['records'] = $records;

                $columns = array();

                $where = "product_id='" . $product_id . "'";
                $this->db->select('*');
                $this->db->from('tbl_product_plc_details');
                $this->db->join('tbl_price_components', 'tbl_price_components.price_component_id = tbl_product_plc_details.price_comp_id');
                $this->db->where($where);
                $query = $this->db->get();
                $column_data = $query->result();
                if ($column_data) {
                    foreach ($column_data as $item) {
                        $columns[] = array('name' => $item->price_component_name, 'code' => 'plc_' . $item->product_plc_detail_id);
                    }
                }

                $this->db->select('*');
                $this->db->from('tbl_product_additional_details');
                $this->db->join('tbl_price_components', 'tbl_price_components.price_component_id = tbl_product_additional_details.price_comp_id');
                $this->db->where($where);
                $query = $this->db->get();
                $column_data = $query->result();
                if ($column_data) {
                    foreach ($column_data as $item) {
                        $columns[] = array('name' => $item->price_component_name, 'code' => 'additional_' . $item->product_additional_detail_id);
                    }
                }

                $record_pd = $this->Action_model->select_single('tbl_products', "product_id='" . $product_id . "'");
                $unit_code_list = array();

                /*if ($record_pd->project_type==3) {
                    $where = "product_id='".$product_id."'";
                }
                else {
                    $where = "product_id='".$product_id."' AND property_type='".$record_pd->property_type."'";
                }*/
                $where = "product_id='" . $product_id . "' AND project_type='" . $record_pd->project_type . "' AND property_type='" . $record_pd->property_type . "'";

                $this->db->select('*');
                $this->db->from('tbl_product_unit_details');
                $this->db->join('tbl_accomodations', 'tbl_accomodations.accomodation_id = tbl_product_unit_details.accomodation', 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $unit_code_data = $query->result();
                foreach ($unit_code_data as $item) {
                    $unit_code_list[] = array('unit_code_id' => $item->product_unit_detail_id, 'unit_code' => ($item->accomodation_name) ? $item->accomodation_name . '/' . $item->code : $item->code);
                }

                $block_list = array();
                $this->db->select('*');
                $this->db->from('tbl_product_block_details');
                $this->db->where($where);
                $query = $this->db->get();
                $block_data = $query->result();
                foreach ($block_data as $item) {
                    $block_list[] = array('block_id' => $item->block_id, 'block_name' => $item->block_name);
                }
                $data['block_list'] = $block_list;

                $data['unit_code_list'] = $unit_code_list;
                $data['columns'] = $columns;


                $data['floor_list'] = $this->Action_model->detail_result('tbl_floors', "floor_id!=''");

                $this->load->view(AGENT_URL . 'ajax/download_inventory', $data);
            } else {
                redirect(base_url(AGENT_URL));
            }
        } else {
            redirect(base_url(AGENT_URL));
        }
    }

    public function upload_inventory()
    {
        $product_id = $this->input->post('product_id');
        if ($product_id) {
            $data['product_id'] = $product_id;
            $account_id = getAccountId();
            $where = "product_id='" . $product_id . "' AND tbl_products.agent_id='" . $account_id . "'";
            $product_detail = $this->Action_model->select_single('tbl_products', $where);
            if ($product_detail) {
                $records = array();
                $where = "product_id='" . $product_id . "'";
                $record_data = $this->Action_model->detail_result('tbl_inventory', $where);
                if ($record_data) {
                    $records = $record_data;
                }
                $data['records'] = $records;

                $columns = array();

                $where = "product_id='" . $product_id . "'";
                $this->db->select('*');
                $this->db->from('tbl_product_plc_details');
                $this->db->join('tbl_price_components', 'tbl_price_components.price_component_id = tbl_product_plc_details.price_comp_id');
                $this->db->where($where);
                $query = $this->db->get();
                $column_data = $query->result();
                if ($column_data) {
                    foreach ($column_data as $item) {
                        $columns[] = array('name' => $item->price_component_name, 'code' => 'plc_' . $item->product_plc_detail_id);
                    }
                }

                $this->db->select('*');
                $this->db->from('tbl_product_additional_details');
                $this->db->join('tbl_price_components', 'tbl_price_components.price_component_id = tbl_product_additional_details.price_comp_id');
                $this->db->where($where);
                $query = $this->db->get();
                $column_data = $query->result();
                if ($column_data) {
                    foreach ($column_data as $item) {
                        $columns[] = array('name' => $item->price_component_name, 'code' => 'additional_' . $item->product_additional_detail_id);
                    }
                }

                $record_pd = $this->Action_model->select_single('tbl_products', "product_id='" . $product_id . "'");
                $unit_code_list = array();

                /*if ($record_pd->project_type==3) {
                    $where = "product_id='".$product_id."'";
                }
                else {
                    $where = "product_id='".$product_id."' AND property_type='".$record_pd->property_type."'";
                }*/
                $where = "product_id='" . $product_id . "' AND project_type='" . $record_pd->project_type . "' AND property_type='" . $record_pd->property_type . "'";

                $this->db->select('*');
                $this->db->from('tbl_product_unit_details');
                $this->db->join('tbl_accomodations', 'tbl_accomodations.accomodation_id = tbl_product_unit_details.accomodation', 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $unit_code_data = $query->result();
                foreach ($unit_code_data as $item) {
                    $unit_code_list[] = array('unit_code_id' => $item->product_unit_detail_id, 'unit_code' => ($item->accomodation_name) ? $item->accomodation_name . '/' . $item->code : $item->code);
                }

                $block_list = array();
                $this->db->select('*');
                $this->db->from('tbl_product_block_details');
                $this->db->where($where);
                $query = $this->db->get();
                $block_data = $query->result();
                foreach ($block_data as $item) {
                    $block_list[] = array('block_id' => $item->block_id, 'block_name' => $item->block_name);
                }
                $data['block_list'] = $block_list;

                $data['unit_code_list'] = $unit_code_list;
                $data['columns'] = $columns;


                $data['floor_list'] = $this->Action_model->detail_result('tbl_floors', "floor_id!=''");

                $this->load->view(AGENT_URL . 'ajax/upload_inventory', $data);
            } else {
                redirect(base_url(AGENT_URL));
            }
        } else {
            redirect(base_url(AGENT_URL));
        }
    }

    public function getAgent()
    {
        $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
        $user_detail = $this->Action_model->select_single('tbl_users', $where);
        return $user_detail;
    }

    public function teams()
    {
        $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
        $user_detail = $this->Action_model->select_single('tbl_users', $where);

        $uid = $user_detail->user_id;
        if ($user_detail->parent_id != 0) {
            $uid = $user_detail->parent_id;
        }

        $where = "is_agent_member='1'";
        $role_list = $this->Action_model->detail_result('tbl_roles', $where);
        $data['role_list'] = $role_list;
        $this->load->view(AGENT_URL . 'teams', $data);
    }

    public function team_detail()
    {
        $this->load->view(AGENT_URL . 'team_detail', $data = "");
    }

    public function roles()
    {
        $this->load->view(AGENT_URL . 'roles', $data = '');
    }

    public function role_permission($id = '')
    {
        $module_list = array();

        if (!$id) {
            redirect(AGENT_URL);
        }


        $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
        $user_detail = $this->Action_model->select_single('tbl_users', $where);

        $role_detail = $this->Action_model->select_single('tbl_roles', "user_id='" . $user_detail->user_id . "' AND role_id='" . $id . "'");
        if (!$role_detail) {
            redirect(AGENT_URL);
        }

        $perm_ids = array();
        $perm = $this->Action_model->detail_result('tbl_role_rights', "role_id='" . $user_detail->role_id . "' AND rr_view='1'");
        foreach ($perm as $key => $value) {
            $perm_ids[] = $value->module_id;
        }

        if ($perm_ids) {
            $where = "am.module_status='1' AND am.module_id IN (" . implode(',', $perm_ids) . ")";
            $this->db->select('*,am.module_id as m_id');
            $this->db->from('tbl_modules am');
            $this->db->join('tbl_role_rights arr', "arr.module_id = am.module_id and arr.role_id='" . $id . "'", 'left');
            $this->db->where($where);
            $query = $this->db->get();
            $module_list = $query->result();
        }

        $data['module_list'] = $module_list;
        $data['role_detail'] = $role_detail;
        $this->load->view(AGENT_URL . 'role_permission', $data);
    }

    public function role_permission_process()
    {
        if ($this->input->post()) {
            $role_id = $this->input->post('role_id');
            $module_array = $this->input->post('module');
            $module_ids = $this->input->post('module_id');

            $where = "role_id='" . $role_id . "'";
            $result = $this->Action_model->select_single('tbl_roles', $where);


            if ($result) {
                if ($module_ids) {
                    foreach ($module_ids as $mk => $module_id) {

                        $where = "role_id='" . $role_id . "' and module_id='" . $module_id . "'";
                        $role_right = $this->Action_model->select_single('tbl_role_rights', $where);

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
                            $array = array('rr_create' => $rr_create, 'rr_edit' => $rr_edit, 'rr_delete' => $rr_delete, 'rr_view' => $rr_view);

                            $this->Action_model->update_data($array, 'tbl_role_rights', array('role_id' => $role_id, 'module_id' => $module_id));
                        } else {

                            $array = array('rr_create' => $rr_create, 'rr_edit' => $rr_edit, 'rr_delete' => $rr_delete, 'rr_view' => $rr_view, 'role_id' => $role_id, 'module_id' => $module_id);

                            $this->Action_model->insert_data($array, 'tbl_role_rights');
                        }
                    }
                }
                $this->session->set_flashdata('success_msg', 'Permission Updated Successfully!!');
                redirect(AGENT_URL . 'role_permission/' . $role_id);
            } else {
                redirect(AGENT_URL);
            }
        } else {
            redirect(AGENT_URL);
        }
    }


    public function property()
    {
        if (!$this->Action_model->check_perm('product_property', 'rr_view')) {
            $this->load->view(AGENT_URL . 'permission_denied');
        } else {
            $this->load->view(AGENT_URL . 'property', $data = "");
        }
    }

    public function property_detail($id = '')
    {
        if (!$this->Action_model->check_perm('product_property', 'rr_create') || ($id && !$this->Action_model->check_perm('product_property', 'rr_edit'))) {
            $this->load->view(AGENT_URL . 'permission_denied');
        } else {
            $property_detail = array();

            $account_id = getAccountId();

            if ($id) {
                $where = "tbl_property.property_id='" . $id . "' AND account_id='" . $account_id . "'";
                $this->db->select('*,tbl_property.property_id');
                $this->db->from('tbl_property');
                $this->db->join('tbl_property_detail', 'tbl_property_detail.property_id = tbl_property.property_id', 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $property_detail = $query->row();
                if (!$property_detail) {
                    redirect(AGENT_URL . "property-detail");
                }
            }

            $where = "facing_status='1'";
            $facing_list = $this->Action_model->detail_result('tbl_facings', $where, 'facing_id,title');
            $data['facing_list'] = $facing_list;

            $where = "ideal_business_status='1'";
            $ideal_business_list = $this->Action_model->detail_result('tbl_ideal_business', $where, 'ideal_business_id,ideal_business_name');
            $data['ideal_business_list'] = $ideal_business_list;

            $where = "listing_type_status='1'";
            $listing_type_list = $this->Action_model->detail_result('tbl_listing_types', $where, 'listing_type_id,title');
            $data['listing_type_list'] = $listing_type_list;

            $where = "product_type_status='1'";
            $product_type_list = $this->Action_model->detail_result('tbl_product_types', $where, 'product_type_id,product_type_name');
            $data['product_type_list'] = $product_type_list;

            $where = "lead_option_status='1'";
            $lead_option_list = $this->Action_model->detail_result('tbl_lead_options', $where, 'lead_option_id,lead_option_name');
            $data['lead_option_list'] = $lead_option_list;

            $where = "unit_status='1'";
            $unit_list = $this->Action_model->detail_result('tbl_units', $where, 'unit_id,unit_name');
            $data['unit_list'] = $unit_list;

            $where = "status='1'";
            $furnised_status_list = $this->Action_model->detail_result('tbl_furnised_status', $where, 'furnised_status_id,title');
            $data['furnised_status_list'] = $furnised_status_list;

            $where = "furnishing_status='1'";
            $furnishing_list = $this->Action_model->detail_result('tbl_furnishings', $where, 'furnishing_id,furnishing_name,input_type');
            $data['furnishing_list'] = $furnishing_list;

            $where = "amenitie_status='1'";
            $amenitie_list = $this->Action_model->detail_result('tbl_amenities', $where, 'amenitie_id,amenitie_name');
            $data['amenitie_list'] = $amenitie_list;

            $furnishing_array = array();
            if ($id) {
                $where = "property_id='" . $id . "'";
                $furnishing_array_data = $this->Action_model->detail_result('tbl_property_furnishing', $where, 'furnishing_id,furnishing_value');
                if ($furnishing_array_data) {
                    foreach ($furnishing_array_data as $key => $value) {
                        $furnishing_array[$value->furnishing_id] = $value->furnishing_value;
                    }
                }
            }
            $data['furnishing_array'] = $furnishing_array;

            $where = "construction_age_status='1'";
            $construction_age_list = $this->Action_model->detail_result('tbl_construction_ages', $where, 'construction_age_id,construction_age_name');
            $data['construction_age_list'] = $construction_age_list;

            $where = "country_id='1' AND state_status=1";
            $state_list = $this->Action_model->detail_result('tbl_states', $where = "country_id='1'", 'state_id,state_name');
            $data['state_list'] = $state_list;


            $city_list = array();
            $location_list = array();
            $unit_type_list = array();

            if ($id) {
                $where = "city_status=1 AND state_id='" . $property_detail->state_id . "'";
                $city_list = $this->Action_model->detail_result('tbl_city', $where, 'city_id,city_name');

                $where = "city_id='" . $property_detail->city_id . "'";
                $location_list = $this->Action_model->detail_result('tbl_locations', $where, 'location_id,location_name');

                $where = "unit_type_status='1' AND product_type_id='" . $property_detail->product_type_id . "'";
                $unit_type_list = $this->Action_model->detail_result('tbl_unit_types', $where, 'unit_type_id,unit_type_name');
            }

            $data['city_list'] = $city_list;
            $data['location_list'] = $location_list;
            $data['unit_type_list'] = $unit_type_list;

            $data['id'] = $id;
            $data['property_detail'] = $property_detail;

            $this->load->view(AGENT_URL . 'property_detail', $data);
        }
    }

    public function requirements()
    {
        $this->load->view(AGENT_URL . 'requirements', $data = "");
    }

    public function requirement_detail()
    {
        $this->load->view(AGENT_URL . 'requirement_detail', $data = "");
    }

    public function products()
    {
        if (!$this->Action_model->check_perm('product_list', 'rr_view')) {
            $this->load->view(AGENT_URL . 'permission_denied');
        } else {
            //$this->load->view(AGENT_URL.'products',$data="");
            $where = "country_id='1' AND state_status=1";
            $state_list = $this->Action_model->detail_result('tbl_states', $where = "country_id='1'", 'state_id,state_name');
            $data['state_list'] = $state_list;

            $where = "product_type_status='1'";
            $project_type_list = $this->Action_model->detail_result('tbl_product_types', $where, 'product_type_id,product_type_name');
            $data['project_type_list'] = $project_type_list;

            $where = "accomodation_status='1'";
            $accomodation_list = $this->Action_model->detail_result('tbl_accomodations', $where, 'accomodation_id,accomodation_name');
            $data['accomodation_list'] = $accomodation_list;

            $where = "lead_option_status='1'";
            $lead_option_list = $this->Action_model->detail_result('tbl_lead_options', $where, 'lead_option_id,lead_option_name');
            $data['lead_option_list'] = $lead_option_list;

            $where = "budget_status='1'";
            $budget_list = $this->Action_model->detail_result('tbl_budgets', $where, 'budget_id,budget_name');
            $data['budget_list'] = $budget_list;

            $where = "unit_status='1'";
            $unit_list = $this->Action_model->detail_result('tbl_units', $where, 'unit_id,unit_name');
            $data['unit_list'] = $unit_list;

            $where = "lead_stage_status='1'";
            $lead_stage_list = $this->Action_model->detail_result('tbl_lead_stages', $where, 'lead_stage_id,lead_stage_name');
            $data['lead_stage_list'] = $lead_stage_list;

            $where = "lead_type_status='1'";
            $lead_type_list = $this->Action_model->detail_result('tbl_lead_types', $where, 'lead_type_id,lead_type_name');
            $data['lead_type_list'] = $lead_type_list;

            $where = "lead_action_status='1'";
            $lead_action_list = $this->Action_model->detail_result('tbl_lead_actions', $where, 'lead_action_id,lead_action_name');
            $data['lead_action_list'] = $lead_action_list;

            $this->load->view(AGENT_URL . 'products', $data);
        }
    }

    public function projects()
    {
        if (!$this->Action_model->check_perm('product_project', 'rr_view')) {
            $this->load->view(AGENT_URL . 'permission_denied');
        } else {
            $this->load->view(AGENT_URL . 'projects', $data = "");
        }
    }
    public function manage_inventory()
    {
        if (!$this->Action_model->check_perm('product_manage_inventory', 'rr_view')) {
            $this->load->view(AGENT_URL . 'permission_denied');
        } else {
            $account_id = getAccountId();

            $builder_list = array();
            $where = "tbl_products.agent_id='" . $account_id . "'";
            $this->db->distinct();
            $this->db->select("tbl_builders.builder_id,tbl_builders.firm_name");
            $this->db->from('tbl_products');
            $this->db->join('tbl_builders', 'tbl_builders.builder_id = tbl_products.builder_id');
            $this->db->where($where);
            $query = $this->db->get();

            $builder_data = $query->result();

            if ($builder_data) {
                $builder_list  = $builder_data;
            }
            $data['builder_list'] = $builder_list;

            $this->load->view(AGENT_URL . 'manage_inventory', $data);
        }
    }
    public function update_inventory_status()
    {
        if (!$this->Action_model->check_perm('product_update_inventory', 'rr_view')) {
            $this->load->view(AGENT_URL . 'permission_denied');
        } else {
            //$this->load->view(AGENT_URL.'update_inventory_status',$data="");

            $data = array();
            $user_id = 0;

            $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
            $user_detail = $this->Action_model->select_single('tbl_users', $where);
            if ($user_detail) {
                $user_id = $user_detail->user_id;
                $account_id = $user_detail->user_id;
                if ($user_detail->role_id != 2) {
                    $account_id = $user_detail->parent_id;
                }
            }

            $where = "product_type_status='1'";
            $product_type_list = $this->Action_model->detail_result('tbl_product_types', $where);
            $data['product_type_list'] = $product_type_list;

            $unit_type_list = array();
            $data['unit_type_list'] = $unit_type_list;

            $this->load->view(AGENT_URL . 'update_inventory_status', $data);
        }
    }
    public function update_basic_cost()
    {
        if (!$this->Action_model->check_perm('product_update_basic_cost', 'rr_view')) {
            $this->load->view(AGENT_URL . 'permission_denied');
        } else {
            $data = array();
            $user_id = 0;

            $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
            $user_detail = $this->Action_model->select_single('tbl_users', $where);
            if ($user_detail) {
                $user_id = $user_detail->user_id;
                $account_id = $user_detail->user_id;
                if ($user_detail->role_id != 2) {
                    $account_id = $user_detail->parent_id;
                }
            }

            $where = "product_type_status='1'";
            $product_type_list = $this->Action_model->detail_result('tbl_product_types', $where);
            $data['product_type_list'] = $product_type_list;

            $unit_type_list = array();
            $data['unit_type_list'] = $unit_type_list;

            $this->load->view(AGENT_URL . 'update_basic_cost', $data);
        }
    }
    public function update_additional_cost()
    {
        if (!$this->Action_model->check_perm('product_update_ad_cost', 'rr_view')) {
            $this->load->view(AGENT_URL . 'permission_denied');
        } else {
            $where = "product_type_status='1'";
            $product_type_list = $this->Action_model->detail_result('tbl_product_types', $where);
            $data['product_type_list'] = $product_type_list;

            $this->load->view(AGENT_URL . 'update_additional_cost', $data);
        }
    }
    public function customers()
    {

        if (!$this->Action_model->check_perm('customer', 'rr_view')) {
            $this->load->view(AGENT_URL . 'permission_denied');
        } else {
            $all_unit_type_list = $this->Action_model->detail_result('tbl_unit_types', "unit_type_status='1'", 'unit_type_id,unit_type_name,requirement_accomodation');
            $data['all_unit_type_list'] = $all_unit_type_list;

            $where = "country_id='1' AND state_status=1";
            $state_list = $this->Action_model->detail_result('tbl_states', $where = "country_id='1'", 'state_id,state_name');
            $data['state_list'] = $state_list;

            $where = "product_type_status='1'";
            $project_type_list = $this->Action_model->detail_result('tbl_product_types', $where, 'product_type_id,product_type_name');
            $data['project_type_list'] = $project_type_list;

            $where = "accomodation_status='1'";
            $accomodation_list = $this->Action_model->detail_result('tbl_accomodations', $where, 'accomodation_id,accomodation_name');
            $data['accomodation_list'] = $accomodation_list;

            $where = "lead_option_status='1'";
            $lead_option_list = $this->Action_model->detail_result('tbl_lead_options', $where, 'lead_option_id,lead_option_name');
            $data['lead_option_list'] = $lead_option_list;

            $where = "lead_source_status='1'";
            $lead_source_list = $this->Action_model->detail_result('tbl_lead_sources', $where);
            $data['lead_source_list'] = $lead_source_list;

            $where = "budget_status='1'";
            $budget_list = $this->Action_model->detail_result('tbl_budgets', $where, 'budget_id,budget_name');
            $data['budget_list'] = $budget_list;

            $where = "unit_status='1'";
            $unit_list = $this->Action_model->detail_result('tbl_units', $where, 'unit_id,unit_name');
            $data['unit_list'] = $unit_list;

            $where = "lead_stage_status='1'";
            $lead_stage_list = $this->Action_model->detail_result('tbl_lead_stages', $where, 'lead_stage_id,lead_stage_name');
            $data['lead_stage_list'] = $lead_stage_list;

            $where = "lead_type_status='1'";
            $lead_type_list = $this->Action_model->detail_result('tbl_lead_types', $where, 'lead_type_id,lead_type_name');
            $data['lead_type_list'] = $lead_type_list;

            $where = "lead_action_status='1'";
            $lead_action_list = $this->Action_model->detail_result('tbl_lead_actions', $where, 'lead_action_id,lead_action_name');
            $data['lead_action_list'] = $lead_action_list;

            $account_id = getAccountId();
            $where = "(tbl_users.user_id='" . $account_id . "' OR tbl_users.parent_id='" . $account_id . "')";

            $this->db->select('*');
            $this->db->from('tbl_users');
            $this->db->where($where);
            $query = $this->db->get();
            $filter_user_list = $query->result();
            $data['filter_user_list'] = $filter_user_list;

            $this->load->view(AGENT_URL . 'customers', $data);
        }
    }

    public function change_password()
    {
        $this->load->view(AGENT_URL . 'change_password', $data = "");
    }

    public function update_profile()
    {
        $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
        $user_detail = $this->Action_model->select_single('tbl_users', $where);
        $data['user_detail'] = $user_detail;
        $this->load->view(AGENT_URL . 'update_profile', $data);
    }

    public function tickets()
    {

        $this->load->view(AGENT_URL . 'tickets', $data = '');
    }

    public function ticket_detail($id = '')
    {

        $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
        $user_detail = $this->Action_model->select_single('tbl_users', $where);

        $user_id = $user_detail->user_id;

        $ticket_detail = $this->Action_model->select_single_join('tbl_tickets', "ticket_track_id='" . $id . "' AND tbl_tickets.user_id='" . $user_id . "'", "*,tbl_tickets.user_id as user_id", array("tbl_users", "tbl_users.user_id=tbl_tickets.user_id"));
        if ($ticket_detail) {

            $ticket_messages = array();

            $where = "ticket_id='" . $ticket_detail->ticket_id . "' AND ((receiver_id='" . $ticket_detail->user_id . "' AND sender_id='1') OR (sender_id='" . $ticket_detail->user_id . "' AND receiver_id='1')) ORDER BY ticket_message_id ASC";
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

            $data['ticket_detail'] = $ticket_detail;
            $data['ticket_messages'] = $ticket_messages;
            $data['user_detail'] = $user_detail;
            $this->load->view(AGENT_URL . 'ticket_detail', $data);
        } else {
            redirect(AGENT_URL);
        }
    }

    public function chats()
    {
        $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
        $user_detail = $this->Action_model->select_single('tbl_users', $where);
        $data['user_detail'] = $user_detail;
        $this->load->view(AGENT_URL . 'chats', $data);
    }

    public function leads_old()
    {
        $all_unit_type_list = $this->Action_model->detail_result('tbl_unit_types', "unit_type_status='1'", 'unit_type_id,unit_type_name,requirement_accomodation');
        $data['all_unit_type_list'] = $all_unit_type_list;

        $where = "lead_stage_status='1'";
        $lead_stage_list = $this->Action_model->detail_result('tbl_lead_stages', $where, 'lead_stage_id,lead_stage_name');
        $data['lead_stage_list'] = $lead_stage_list;

        $where = "lead_type_status='1'";
        $lead_type_list = $this->Action_model->detail_result('tbl_lead_types', $where, 'lead_type_id,lead_type_name');
        $data['lead_type_list'] = $lead_type_list;

        $where = "lead_action_status='1'";
        $lead_action_list = $this->Action_model->detail_result('tbl_lead_actions', $where, 'lead_action_id,lead_action_name');
        $data['lead_action_list'] = $lead_action_list;

        $where = "country_id='1' AND state_status=1";
        $state_list = $this->Action_model->detail_result('tbl_states', $where);
        $data['state_list'] = $state_list;

        $where = "lead_source_status='1'";
        $lead_source_list = $this->Action_model->detail_result('tbl_lead_sources', $where);
        $data['lead_source_list'] = $lead_source_list;

        $where = "unit_status='1'";
        $unit_list = $this->Action_model->detail_result('tbl_units', $where, 'unit_id,unit_name');
        $data['unit_list'] = $unit_list;

        $where = "budget_status='1'";
        $budget_list = $this->Action_model->detail_result('tbl_budgets', $where, 'budget_id,budget_name');
        $data['budget_list'] = $budget_list;

        $account_id = getAccountId();

        $where = "user_status='1' AND ((parent_id='" . $account_id . "') OR (user_id='" . $account_id . "' AND role_id='2'))";
        $where_ids = "";
        $user_ids = $this->get_level_user_ids();

        if (count($user_ids)) {

            $where_ids .= " AND (tbl_users.user_id='" . implode("' OR tbl_users.user_id='", $user_ids) . "')";
        }
        $where .= $where_ids;

        $user_list = $this->Action_model->detail_result('tbl_users', $where, 'user_id,user_title,first_name,last_name,parent_id,is_individual,firm_name');
        $data['user_list'] = $user_list;

        $where = "agent_id='" . $account_id . "' OR share_account_id='" . $account_id . "'";
        $this->db->select("product_id,project_name");
        $this->db->from('tbl_products');
        $this->db->join('tbl_project_share', "tbl_project_share.project_id = tbl_products.product_id AND share_account_id='" . $account_id . "'", 'left');
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

        $account_id = getAccountId();

        /*$where = "(tbl_project_share.account_id='".$account_id."')";
        
        $this->db->select('share_account_id');
        $this->db->from('tbl_project_share');
        $this->db->where($where);
        $query = $this->db->get();
        $user_list_data = $query->result();
        $user_list = array();
        if ($user_list_data) {
            foreach ($user_list_data as $row) {
                $user_list[] = $row->share_account_id;
            }
        }
        $user_list_ids = ($user_list)?implode(",", $user_list):"";*/

        $where = "(tbl_users.user_id='" . $account_id . "' OR tbl_users.parent_id='" . $account_id . "')";
        /*if ($user_list_ids) {
            $where .= " OR tbl_users.user_id IN (".$user_list_ids.")";
        }*/

        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where($where);
        $query = $this->db->get();
        $filter_user_list = $query->result();
        $data['filter_user_list'] = $filter_user_list;

        $this->load->view(AGENT_URL . 'leads', $data);
    }

    public function lead_detail($id = '')
    {

        $account_id = getAccountId();

        $lead_detail = array();
        if ($id) {
            $lead_detail = $this->Action_model->select_single('tbl_leads', "lead_id='" . $id . "' AND account_id='" . $account_id . "'");
            if (!$lead_detail) {
                redirect(AGENT_URL);
            }
        }

        $where = "country_id='1' AND state_status=1";
        $state_list = $this->Action_model->detail_result('tbl_states', $where);

        $city_list = array();
        if ($id) {
            $where = "city_status=1 AND state_id='" . $lead_detail->lead_state_id . "'";
            $city_list = $this->Action_model->detail_result('tbl_city', $where);
        }

        $where = "occupation_status='1'";
        $occupation_list = $this->Action_model->detail_result('tbl_occupations', $where);

        $where = "department_status='1'";
        $department_list = $this->Action_model->detail_result('tbl_departments', $where);

        $where = "lead_source_status='1'";
        $lead_source_list = $this->Action_model->detail_result('tbl_lead_sources', $where);

        $where = "lead_stage_status='1'";
        $lead_stage_list = $this->Action_model->detail_result('tbl_lead_stages', $where);

        $where = "lead_type_status='1'";
        $lead_type_list = $this->Action_model->detail_result('tbl_lead_types', $where, 'lead_type_id,lead_type_name');
        $data['lead_type_list'] = $lead_type_list;

        $data['lead_detail'] = $lead_detail;
        $data['id'] = $id;
        $data['state_list'] = $state_list;
        $data['city_list'] = $city_list;
        $data['occupation_list'] = $occupation_list;
        $data['department_list'] = $department_list;
        $data['lead_source_list'] = $lead_source_list;
        $data['lead_stage_list'] = $lead_stage_list;
        $this->load->view(AGENT_URL . 'lead_detail', $data);
    }

    public function leads()
    {
        $all_unit_type_list = $this->Action_model->detail_result('tbl_unit_types', "unit_type_status='1'", 'unit_type_id,unit_type_name,requirement_accomodation');
        $data['all_unit_type_list'] = $all_unit_type_list;

        $where = "country_id='1' AND state_status=1";
        $state_list = $this->Action_model->detail_result('tbl_states', $where = "country_id='1'", 'state_id,state_name');
        $data['state_list'] = $state_list;

        $where = "product_type_status='1'";
        $project_type_list = $this->Action_model->detail_result('tbl_product_types', $where, 'product_type_id,product_type_name');
        $data['project_type_list'] = $project_type_list;

        $where = "accomodation_status='1'";
        $accomodation_list = $this->Action_model->detail_result('tbl_accomodations', $where, 'accomodation_id,accomodation_name');
        $data['accomodation_list'] = $accomodation_list;

        $where = "lead_option_status='1' and lead_option_id != 1";
        $lead_option_list = $this->Action_model->detail_result('tbl_lead_options', $where, 'lead_option_id,lead_option_name');
        $data['lead_option_list'] = $lead_option_list;

        $where = "lead_source_status='1'";
        $lead_source_list = $this->Action_model->detail_result('tbl_lead_sources', $where);
        $data['lead_source_list'] = $lead_source_list;

        $where = "budget_status='1'";
        $budget_list = $this->Action_model->detail_result('tbl_budgets', $where, 'budget_id,budget_name');
        $data['budget_list'] = $budget_list;

        $where = "unit_status='1'";
        $unit_list = $this->Action_model->detail_result('tbl_units', $where, 'unit_id,unit_name');
        $data['unit_list'] = $unit_list;

        $where = "lead_stage_status='1'";
        $lead_stage_list = $this->Action_model->detail_result('tbl_lead_stages', $where, 'lead_stage_id,lead_stage_name');
        $data['lead_stage_list'] = $lead_stage_list;

        $where = "lead_type_status='1'";
        $lead_type_list = $this->Action_model->detail_result('tbl_lead_types', $where, 'lead_type_id,lead_type_name');
        $data['lead_type_list'] = $lead_type_list;

        $where = "lead_action_status='1'";
        $lead_action_list = $this->Action_model->detail_result('tbl_lead_actions', $where, 'lead_action_id,lead_action_name');
        $data['lead_action_list'] = $lead_action_list;


        # stage 

        # end stage 

        $total_followup = 0;
        $today_followup = 0;
        $missed_followup = 0;

        # user data
            $where_user                 = "user_hash='" . $this->session->userdata('agent_hash') . "'";
            $user_detail                = $this->Action_model->select_single('tbl_users', $where_user);
            $account_id_for_where       = $user_detail->user_id;
            $account_id                 = getAccountId();

            if ($user_detail->role_id < 3 || $user_detail->role_id == 5) {
                if ($user_detail->parent_id == 0) {
                    $where_role = "is_customer = '0' AND tbl_leads.account_id = '" . $account_id_for_where . "'";
                    $where_f = "account_id = '" . $account_id_for_where . "'";
                } else {
                    $where_role = "is_customer = '0' AND tbl_leads.user_id = '" . $account_id_for_where . "'";
                    $where_f = "user_id = '" . $account_id_for_where . "'";
                }
            } else {
                $where_role = "tbl_leads.user_id = '" . $account_id_for_where . "' AND is_customer = '0'";
                $where_f = "followup.user_id = '" . $account_id_for_where . "'";
            }

        // print_r($where_role); die;
        
        #end user data

        // print_r($where_role); die;



        $where      = $where_role;
        $tb_data    = $this->Action_model->select_single('tbl_leads', $where, "COUNT(CASE WHEN added_to_followup = 1 THEN lead_id END) as total_followup,COUNT(CASE WHEN followup_date = '" . date('d-m-Y') . "' THEN lead_id END) as today_followup,COUNT(CASE WHEN added_to_followup = 0 THEN lead_id END) as missed_followup");

        $today_date                 = date('Y-m-d');
        # Total New Leads
        $total_new_leads            = $this->db->where("$where_role and lead_stage_id = '1' AND added_to_followup = '0' ")->get('tbl_leads')->num_rows();

        

        $total_new_leads_2          = $this->db->where("$where_f and lead_stage_id = '1' AND followup_status= '1' ")->get('tbl_followup')->num_rows();

        // print_r($total_new_leads_2); die;

        $total_new_leads            = $total_new_leads + $total_new_leads_2;

        # End Total New Leads

        
        # Today Followup 
        $today_followups            = $this->db->where("$where_role and ( lead_stage_id != '6' or lead_stage_id != '7' )  and DATE(STR_TO_DATE(`followup_date`, '%Y-%m-%d')) = '$today_date'")->get('tbl_leads')->num_rows();
        # Today Followup 
        // print_r($this->db->last_query()); die;

        # Total Followup 
        $total_followups            = $this->db->where("$where_role and ( lead_stage_id = '2' or lead_stage_id = '3' or lead_stage_id = '4' or lead_stage_id = '5'  )  and followup_date IS NOT NULL ")->get('tbl_leads')->num_rows();
        # Total Followup 

        # Missed Followup 
        $missed_followups            =  $this->db->where("$where_role and DATE(STR_TO_DATE(`followup_date`, '%d-%m-%Y')) < '$today_date'")->get('tbl_leads')->num_rows();
        # Missed Followup 

        // print_r($total_new_leads); die;

        $data['total_new_leads']    = $total_new_leads;
        $data['total_followup']     = $total_followups;
        $data['today_followup']     = $today_followups;
        $data['missed_followup']    = $missed_followups;

          # Followup

          $followup_select_query                  =   "
          count(*) as total_count,
          SUM(CASE WHEN ( STR_TO_DATE(next_followup_date, '%d-%m-%Y')  = CURDATE() AND followup_status = '1' AND lead_status_id = 1 ) THEN 1 ELSE 0 END) as today_count,
          SUM(CASE WHEN ( STR_TO_DATE(next_followup_date, '%d-%m-%Y')  < CURDATE() AND followup_status = '1' AND lead_status_id = 1 ) THEN 1 ELSE 0 END) as missed_count,
          SUM(CASE WHEN lead_stage_id = '1' THEN 1 ELSE 0 END) as total_initial_count,
          SUM(CASE WHEN lead_stage_id = '2' THEN 1 ELSE 0 END) as total_followup_count,
          SUM(CASE WHEN lead_stage_id = '3' THEN 1 ELSE 0 END) as total_enquiry_count,
          SUM(CASE WHEN lead_stage_id = '4' THEN 1 ELSE 0 END) as total_site_visit_count,
          SUM(CASE WHEN lead_stage_id = '5' THEN 1 ELSE 0 END) as total_metting_count,
          SUM(CASE WHEN lead_stage_id = '6' THEN 1 ELSE 0 END) as total_success_count,
          SUM(CASE WHEN lead_stage_id = '7' THEN 1 ELSE 0 END) as total_dump_count";

            $this->db->select($followup_select_query);
            $this->db->where($where_f);
            $this->db->from('tbl_followup as followup');
            $this->db->join('tbl_users  as user', 'user.user_id = followup.user_id', 'left');
            $followups                          =   $this->db->get()->row();


          $data['followups']  = $followups;
          # End Followup


        $where      = "account_id='" . $account_id . "'";
        $chart_data = $this->Action_model->select_single('tbl_leads', $where, 'COUNT(CASE WHEN lead_stage_id = 3 THEN lead_id END) as total_enquiry,COUNT(CASE WHEN lead_stage_id = 1 THEN lead_id END) as total_initial,COUNT(CASE WHEN lead_stage_id = 4 THEN lead_id END) as total_site_visit,COUNT(CASE WHEN added_to_followup = 1 THEN lead_id END) as total_followup');

        $pie_chart_values   = array();
        $pie_chart_values[] = array('label' => 'Enquiry', 'color'       => '#ff9f5f', 'value' => $chart_data->total_enquiry);
        $pie_chart_values[] = array('label' => 'Initial', 'color'       => '#7571F9', 'value' => $chart_data->total_initial);
        $pie_chart_values[] = array('label' => 'Site Visit', 'color'    => '#31b925', 'value' => $chart_data->total_site_visit);
        $pie_chart_values[] = array('label' => 'Followup', 'color'      => '#e62739', 'value' => $chart_data->total_followup);

        $where = "user_status='1' AND ((parent_id='" . $account_id . "') OR (user_id='" . $account_id . "' AND role_id='2'))";
        $where_ids = "";
        $user_ids = $this->get_level_user_ids();

        if (count($user_ids)) {

            $where_ids .= " AND (tbl_users.user_id='" . implode("' OR tbl_users.user_id='", $user_ids) . "')";
        }
        $where .= $where_ids;

        $user_list = $this->Action_model->detail_result('tbl_users', $where, 'user_id,user_title,first_name,last_name,parent_id,is_individual,firm_name');
        $data['user_list'] = $user_list;

        $where = "agent_id='" . $account_id . "' OR share_account_id='" . $account_id . "'";
        $this->db->select("product_id,project_name");
        $this->db->from('tbl_products');
        $this->db->join('tbl_project_share', "tbl_project_share.project_id = tbl_products.product_id AND share_account_id='" . $account_id . "'", 'left');
        $this->db->where($where);
        $query = $this->db->get();
        $product_list = $query->result();

        
        $data['product_list'] = $product_list;

        $data['pie_chart_values'] = $pie_chart_values;

        $account_id = getAccountId();
        $where = "(tbl_users.user_id='" . $account_id . "' OR tbl_users.parent_id='" . $account_id . "')";

        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where($where);
        $query = $this->db->get();
        $filter_user_list = $query->result();
        $data['filter_user_list'] = $filter_user_list;

        if ($this->input->get('page') == 'old') :
            $this->load->view(AGENT_URL . 'leads-old', $data);
        else :
            $this->load->view(AGENT_URL . 'leads', $data);
        endif;
    }

    public function followup1()
    {
        $this->load->view(AGENT_URL . 'followup1', $data = "");
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(AGENT_URL . 'login');
    }

    public function product_detail($id = '')
    {

        if (!$this->Action_model->check_perm('project', 'rr_create') || !$this->Action_model->check_perm('project', 'rr_edit')) {
            $this->load->view(AGENT_URL . 'permission_denied');
        } else {
            $account_id = 0;
            $user_id = 0;

            $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
            $user_detail = $this->Action_model->select_single('tbl_users', $where);
            if ($user_detail) {
                $user_id = $user_detail->user_id;
                $account_id = $user_detail->user_id;
                if ($user_detail->role_id != 2) {
                    $account_id = $user_detail->parent_id;
                }
            }

            $product_detail = $this->Action_model->select_single('tbl_products', "product_id='" . $id . "' AND agent_id='" . $account_id . "'");

            if (!$product_detail) {
                redirect(AGENT_URL);
            }

            $data['id'] = $id;
            $data['product_detail'] = $product_detail;

            $builder_list = array();
            $where = "builder_status='1' AND builder_group_id='" . $product_detail->builder_group_id . "'";
            $builder_data = $this->Action_model->detail_result('tbl_builders', $where);
            if ($builder_data) {
                $builder_list  = $builder_data;
            }
            $data['builder_list'] = $builder_list;

            $agent_list = array();
            $where = "role_id='2' ";
            $agent_data = $this->Action_model->detail_result('tbl_users', $where);
            if ($agent_data) {
                $agent_list  = $agent_data;
            }
            $data['agent_list'] = $agent_list;

            $where = "builder_group_status='1'";
            $builder_group_list = $this->Action_model->detail_result('tbl_builder_groups', $where);
            $data['builder_group_list'] = $builder_group_list;

            $where = "project_status_flag='1'";
            $project_status_list = $this->Action_model->detail_result('tbl_project_status', $where);
            $data['project_status_list'] = $project_status_list;

            $where = "product_type_status='1'";
            $project_type_list = $this->Action_model->detail_result('tbl_product_types', $where);
            $data['project_type_list'] = $project_type_list;

            $where = "unit_status='1'";
            $unit_list = $this->Action_model->detail_result('tbl_units', $where);
            $data['unit_list'] = $unit_list;

            $where = "state_id!='' AND state_status=1";
            $state_list = $this->Action_model->detail_result('tbl_states', $where);
            $data['state_list'] = $state_list;

            $where = "accomodation_status='1'";
            $accomodation_list = $this->Action_model->detail_result('tbl_accomodations', $where, 'accomodation_id,accomodation_name');
            $data['accomodation_list'] = $accomodation_list;

            $where = "unit_status='1'";
            $unit_list = $this->Action_model->detail_result('tbl_units', $where, 'unit_id,unit_name');
            $data['unit_list'] = $unit_list;

            $where = "facing_status='1'";
            $facing_list = $this->Action_model->detail_result('tbl_facings', $where, 'facing_id,title');
            $data['facing_list'] = $facing_list;

            $where = "amenitie_status='1'";
            $amenitie_list = $this->Action_model->detail_result('tbl_amenities', $where, 'amenitie_id,amenitie_name');
            $data['amenitie_list'] = $amenitie_list;

            $where = "finance_status='1'";
            $finance_list = $this->Action_model->detail_result('tbl_finances', $where, 'finance_id,finance_name');
            $data['finance_list'] = $finance_list;

            $where = "price_component_status='1'";
            $price_component_list = $this->Action_model->detail_result('tbl_price_components', $where, 'price_component_id,price_component_name,price_group_id');
            $data['price_component_list'] = $price_component_list;

            $where = "specification_status='1'";
            $specification_list = $this->Action_model->detail_result('tbl_specifications', $where);
            $data['specification_list'] = $specification_list;

            $where = "authority_status='1'";
            $authority_list = $this->Action_model->detail_result('tbl_authorities', $where);
            $data['authority_list'] = $authority_list;

            $comm_product_unit_type_list = array();
            $where = "unit_type_status='1' AND product_type_id='3'";
            $comm_product_unit_type_data = $this->Action_model->detail_result('tbl_unit_types', $where, 'unit_type_id,unit_type_name');
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

                $where = "location_status='1' AND state_id='" . $product_detail->state_id . "' AND city_id='" . $product_detail->city_id . "'";
                $location_list_data = $this->Action_model->detail_result('tbl_locations', $where, 'location_id,location_name');
                if ($location_list_data) {
                    $location_list = $location_list_data;
                }

                $where = "unit_type_status='1' AND product_type_id='" . $product_detail->project_type . "'";
                $unit_type_list = $this->Action_model->detail_result('tbl_unit_types', $where);

                $block_data = $this->Action_model->detail_result('tbl_product_block_details', "product_id='" . $product_detail->product_id . "' AND property_type='" . $product_detail->property_type . "' AND project_type='" . $product_detail->project_type . "' ORDER BY block_id ASC");
                if ($block_data) {
                    $blocks = $block_data;
                }

                $tb_data = $this->Action_model->detail_result('tbl_product_unit_details', "product_id='" . $product_detail->product_id . "' AND property_type='" . $product_detail->property_type . "' AND project_type='" . $product_detail->project_type . "' ORDER BY product_unit_detail_id ASC");
                if ($tb_data) {
                    $product_flat_unit_details = $tb_data;
                }

                //print_r($product_flat_unit_details);exit;

                $tb_data = $this->Action_model->detail_result('tbl_product_unit_details', "product_id='" . $product_detail->product_id . "' AND property_type='" . $product_detail->property_type . "' AND project_type='" . $product_detail->project_type . "' ORDER BY product_unit_detail_id ASC");
                if ($tb_data) {
                    $product_villa_unit_details = $tb_data;
                }

                $tb_data = $this->Action_model->detail_result('tbl_product_unit_details', "product_id='" . $product_detail->product_id . "' AND property_type='" . $product_detail->property_type . "' AND project_type='" . $product_detail->project_type . "' ORDER BY product_unit_detail_id ASC");
                if ($tb_data) {
                    $product_plot_unit_details = $tb_data;
                }

                $tb_data = $this->Action_model->detail_result('tbl_product_unit_details', "property_type='" . $product_detail->property_type . "' AND project_type='" . $product_detail->project_type . "' AND product_id='" . $product_detail->product_id . "' ORDER BY product_unit_detail_id ASC");
                if ($tb_data) {
                    $product_unit_details = $tb_data;
                }

                $product_comm_block_data = $this->Action_model->detail_result('tbl_product_block_details', "property_type='" . $product_detail->property_type . "' AND project_type='" . $product_detail->project_type . "' AND product_id='" . $product_detail->product_id . "' ORDER BY block_id ASC");

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
                $where = "city_status=1 AND state_id='" . $product_detail->state_id . "'";
                $city_list = $this->Action_model->detail_result('tbl_city', $where);
            }
            $data['city_list'] = $city_list;

            $this->load->view(AGENT_URL . 'product_detail', $data);
        }
    }

    /* booking report */
    public function booking_report()
    {
        $where = "state_id!='' AND state_status=1";
        $state_list = $this->Action_model->detail_result('tbl_states', $where);
        $data['state_list'] = $state_list;

        $builder_list = array();
        $where = "builder_status='1'";
        $builder_data = $this->Action_model->detail_result('tbl_builders', $where);
        if ($builder_data) {
            $builder_list  = $builder_data;
        }
        $data['builder_list'] = $builder_list;

        $agent_list = array();
        $where = "role_id='2' ";
        $agent_data = $this->Action_model->detail_result('tbl_users', $where);
        if ($agent_data) {
            $agent_list  = $agent_data;
        }
        $data['agent_list'] = $agent_list;

        $product_list = array();
        $where = "product_status='1'";
        $product_data = $this->Action_model->detail_result('tbl_products', $where);
        if ($product_data) {
            $product_list  = $product_data;
        }
        $data['product_list'] = $product_list;

        $this->load->view(AGENT_URL . 'booking_report', $data);
    }
    /* booking report end */

    public function booking_detail($id = '')
    {
        $account_id = 0;
        $user_id = 0;

        $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
        $user_detail = $this->Action_model->select_single('tbl_users', $where);
        if ($user_detail) {
            $user_id = $user_detail->user_id;
            $account_id = $user_detail->user_id;
            if ($user_detail->role_id != 2) {
                $account_id = $user_detail->parent_id;
            }
        }

        $where = "booking_id='" . $id . "' AND ((tbl_products.agent_id='" . $account_id . "') OR (share_account_id='" . $account_id . "' AND tbl_bookings.account_id='" . $account_id . "'))";

        $this->db->select("*");
        $this->db->from('tbl_bookings');
        $this->db->join('tbl_states', 'tbl_states.state_id = tbl_bookings.state_id', 'left');
        $this->db->join('tbl_city', 'tbl_city.city_id = tbl_bookings.city_id', 'left');
        $this->db->join('tbl_products', 'tbl_products.product_id = tbl_bookings.project_id', 'left');
        $this->db->join('tbl_locations', 'tbl_locations.location_id = tbl_products.location', 'left');
        $this->db->join('tbl_floors', 'tbl_floors.floor_id = tbl_bookings.floor', 'left');
        $this->db->join('tbl_product_block_details', 'tbl_product_block_details.block_id = tbl_bookings.tower', 'left');
        $this->db->join('tbl_project_share', "tbl_project_share.project_id = tbl_products.product_id AND share_account_id='" . $account_id . "'", 'left');
        $this->db->where($where);
        $query = $this->db->get();
        $booking_detail = $query->row();


        if ($booking_detail) {

            $where = "builder_id='" . $booking_detail->builder_id . "'";

            $this->db->select("*");
            $this->db->from('tbl_builders');
            $this->db->join('tbl_states', 'tbl_states.state_id = tbl_builders.builder_state_id', 'left');
            $this->db->join('tbl_city', 'tbl_city.city_id = tbl_builders.builder_city_id', 'left');
            $this->db->where($where);
            $query = $this->db->get();
            $builder_detail = $query->row();

            $where = "lead_id='" . $booking_detail->lead_id . "'";
            $lead_detail = $this->Action_model->select_single('tbl_leads', $where);

            $where = "country_id='1' AND state_status=1";
            $state_list = $this->Action_model->detail_result('tbl_states', $where);

            $city_list = array();
            if ($lead_detail) {
                $where = "city_status=1 AND state_id='" . $lead_detail->lead_state_id . "'";
                $city_list = $this->Action_model->detail_result('tbl_city', $where);
            }
            $data['state_list'] = $state_list;
            $data['city_list'] = $city_list;

            $data['builder_detail'] = $builder_detail;
            $data['booking_detail'] = $booking_detail;
            $data['lead_detail'] = $lead_detail;

            $this->load->view(AGENT_URL . 'booking_detail', $data);
        } else {
            redirect(AGENT_URL);
        }
    }

    public function site_visit_report()
    {
        $all_unit_type_list = $this->Action_model->detail_result('tbl_unit_types', "unit_type_status='1'", 'unit_type_id,unit_type_name,requirement_accomodation');
        $data['all_unit_type_list'] = $all_unit_type_list;

        $where = "country_id='1' AND state_status=1";
        $state_list = $this->Action_model->detail_result('tbl_states', $where = "country_id='1'", 'state_id,state_name');
        $data['state_list'] = $state_list;

        $where = "product_type_status='1'";
        $project_type_list = $this->Action_model->detail_result('tbl_product_types', $where, 'product_type_id,product_type_name');
        $data['project_type_list'] = $project_type_list;

        $where = "accomodation_status='1'";
        $accomodation_list = $this->Action_model->detail_result('tbl_accomodations', $where, 'accomodation_id,accomodation_name');
        $data['accomodation_list'] = $accomodation_list;

        $where = "lead_option_status='1'";
        $lead_option_list = $this->Action_model->detail_result('tbl_lead_options', $where, 'lead_option_id,lead_option_name');
        $data['lead_option_list'] = $lead_option_list;

        $where = "lead_source_status='1'";
        $lead_source_list = $this->Action_model->detail_result('tbl_lead_sources', $where);
        $data['lead_source_list'] = $lead_source_list;

        $where = "budget_status='1'";
        $budget_list = $this->Action_model->detail_result('tbl_budgets', $where, 'budget_id,budget_name');
        $data['budget_list'] = $budget_list;

        $where = "unit_status='1'";
        $unit_list = $this->Action_model->detail_result('tbl_units', $where, 'unit_id,unit_name');
        $data['unit_list'] = $unit_list;

        $where = "lead_stage_status='1'";
        $lead_stage_list = $this->Action_model->detail_result('tbl_lead_stages', $where, 'lead_stage_id,lead_stage_name');
        $data['lead_stage_list'] = $lead_stage_list;

        $where = "lead_type_status='1'";
        $lead_type_list = $this->Action_model->detail_result('tbl_lead_types', $where, 'lead_type_id,lead_type_name');
        $data['lead_type_list'] = $lead_type_list;

        $where = "lead_action_status='1'";
        $lead_action_list = $this->Action_model->detail_result('tbl_lead_actions', $where, 'lead_action_id,lead_action_name');
        $data['lead_action_list'] = $lead_action_list;

        $account_id = getAccountId();

        $where = "account_id='" . $account_id . "'";
        $tb_data = $this->Action_model->select_single('tbl_site_visit', $where, "COUNT(site_visit_id) as total_visit,COUNT(CASE WHEN visit_date = '" . date('d-m-Y') . "' THEN site_visit_id END) as today_visit");

        $data['total_visit'] = $tb_data->total_visit;
        $data['today_visit'] = $tb_data->today_visit;

        $where = "user_status='1' AND parent_id='" . $account_id . "'";
        $user_list = $this->Action_model->detail_result('tbl_users', $where, 'user_id,user_title,first_name,last_name');
        $data['user_list'] = $user_list;

        $where = "agent_id='" . $account_id . "' OR share_account_id='" . $account_id . "'";
        $this->db->select("product_id,project_name");
        $this->db->from('tbl_products');
        $this->db->join('tbl_project_share', "tbl_project_share.project_id = tbl_products.product_id AND share_account_id='" . $account_id . "'", 'left');
        $this->db->where($where);
        $query = $this->db->get();
        $product_list = $query->result();
        $data['product_list'] = $product_list;

        $builder_list = array();
        $where = "agent_id='" . $account_id . "' OR share_account_id='" . $account_id . "'";
        $this->db->select("tbl_builders.builder_id,tbl_builders.firm_name");
        $this->db->from('tbl_products');
        $this->db->join('tbl_builders', 'tbl_builders.builder_id = tbl_products.builder_id');
        $this->db->join('tbl_project_share', "tbl_project_share.project_id = tbl_products.product_id AND share_account_id='" . $account_id . "'", 'left');
        $this->db->where($where);
        $query = $this->db->get();
        $builder_data = $query->result();
        if ($builder_data) {
            $builder_list  = $builder_data;
        }
        $data['builder_list'] = $builder_list;

        $this->load->view(AGENT_URL . 'site_visit_report', $data);
    }

    public function invoice($id = '')
    {
        $account_id = 0;
        $user_id = 0;

        $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
        $user_detail = $this->Action_model->select_single('tbl_users', $where);
        if ($user_detail) {
            $user_id = $user_detail->user_id;
            $account_id = $user_detail->user_id;
            if ($user_detail->role_id != 2) {
                $account_id = $user_detail->parent_id;
            }
        }

        if ($id) {
            $this->db->select('*');
            $this->db->from('tbl_payment');
            $this->db->join('tbl_paid_type', "tbl_paid_type.paid_type_id = paid_type", 'left');
            $this->db->where("((entry_type='1' AND payment_status='1') OR (entry_type='2')) AND payment_id='" . $id . "' AND user_id='" . $account_id . "'");
            $query = $this->db->get();
            $invoice_detail = $query->row();
            $data['invoice_detail'] = $invoice_detail;
            $this->load->view(AGENT_URL . 'invoice_detail', $data);
        } else {
            $this->db->select('*');
            $this->db->from('tbl_payment');
            $this->db->join('tbl_paid_type', "tbl_paid_type.paid_type_id = paid_type", 'left');
            $this->db->where("((entry_type='1' AND payment_status='1') OR (entry_type='2')) AND user_id='" . $account_id . "'");
            $query = $this->db->get();
            $payments = $query->result();
            $data['payments'] = $payments;
            $this->load->view(AGENT_URL . 'invoice', $data);
        }
    }

    public function templates()
    {
        $this->load->view(AGENT_URL . 'templates', $data = "");
    }

    public function sms_configration()
    {
        $account_id = getAccountId();
        $where = "tbl_user_details.user_id='" . $account_id . "'";

        $this->db->select('*');
        $this->db->from('tbl_user_details');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_user_details.user_id');
        $this->db->where($where);
        $query = $this->db->get();
        $user_detail = $query->row();

        if (!$user_detail) {
            $record_array = array(
                'user_id' => $account_id
            );

            $this->Action_model->insert_data($record_array, 'tbl_user_details');

            $this->db->select('*');
            $this->db->from('tbl_user_details');
            $this->db->join('tbl_users', 'tbl_users.user_id = tbl_user_details.user_id');
            $this->db->where($where);
            $query = $this->db->get();
            $user_detail = $query->row();
        }
        $data['user_detail'] = $user_detail;
        $this->load->view(AGENT_URL . 'sms_configration', $data);
    }

    public function email_configration()
    {
        $account_id = getAccountId();
        $where = "tbl_user_details.user_id='" . $account_id . "'";

        $this->db->select('*');
        $this->db->from('tbl_user_details');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_user_details.user_id');
        $this->db->where($where);
        $query = $this->db->get();
        $user_detail = $query->row();

        if (!$user_detail) {
            $record_array = array(
                'user_id' => $account_id
            );

            $this->Action_model->insert_data($record_array, 'tbl_user_details');

            $this->db->select('*');
            $this->db->from('tbl_user_details');
            $this->db->join('tbl_users', 'tbl_users.user_id = tbl_user_details.user_id');
            $this->db->where($where);
            $query = $this->db->get();
            $user_detail = $query->row();
        }
        $data['user_detail'] = $user_detail;
        $this->load->view(AGENT_URL . 'email_configration', $data);
    }

    public function whatsapp_configration()
    {
        //$this->Action_model->sendWhatsappMessageFromAgent(1,2);
        //exit;
        $account_id = getAccountId();
        $where = "tbl_user_details.user_id='" . $account_id . "'";

        $this->db->select('*');
        $this->db->from('tbl_user_details');
        $this->db->join('tbl_users', 'tbl_users.user_id = tbl_user_details.user_id');
        $this->db->where($where);
        $query = $this->db->get();
        $user_detail = $query->row();

        if (!$user_detail) {
            $record_array = array(
                'user_id' => $account_id
            );

            $this->Action_model->insert_data($record_array, 'tbl_user_details');

            $this->db->select('*');
            $this->db->from('tbl_user_details');
            $this->db->join('tbl_users', 'tbl_users.user_id = tbl_user_details.user_id');
            $this->db->where($where);
            $query = $this->db->get();
            $user_detail = $query->row();
        }
        $data['user_detail'] = $user_detail;
        $this->load->view(AGENT_URL . 'whatsapp_configration', $data);
    }

    public function download_sample_leads()
    {
        $array = array();

        if ($this->input->get()) {

            $account_id = getAccountId();

            if ($account_id) {

                require_once(APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php');
                require_once(APPPATH . 'third_party/PHPExcel/Classes/PHPExcel/IOFactory.php');

                /* Create new PHPExcel object*/
                $objPHPExcel = new PHPExcel();

                $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");

                /* Create a first sheet, representing sales data*/
                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Serial Number');
                $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Title');
                $objPHPExcel->getActiveSheet()->setCellValue('C1', 'First Name');
                $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Last Name');
                $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Mobile');
                $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Email');

                $i = 0;
                $o = 2;
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $o, "");
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $o, "");
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $o, "");
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $o, "");
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $o, "");
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $o, "");

                $objPHPExcel->getActiveSheet()->setTitle('Leads');


                // Save the spreadsheet
                //$writer->save('download-sample-leads.xlsx');

                header('Content-Type: text/csv');
                header('Content-Disposition: attachment;filename="download-sample-leads.xlsx"');
                header('Cache-Control: max-age=0');
                $writer->save('php://output');
            } else {
                redirect(AGENT_URL . 'leads');
            }
        } else {
            redirect(AGENT_URL . 'leads');
        }
    }

    public function download_leads()
    {
        $array = array();

        if ($this->input->get()) {

            $account_id = getAccountId();

            if ($account_id) {
                $filter_by = $this->input->get('filter_by');
                $page = $this->input->get('page');

                $search_text = $this->input->get('search_text');
                $search_date_from = $this->input->get('search_date_from');
                $search_date_to = $this->input->get('search_date_to');
                $search_state_id = $this->input->get('search_state_id');
                $search_city_id = $this->input->get('search_city_id');
                $search_source_id = $this->input->get('search_source_id');
                $search_stage_id = $this->input->get('search_stage_id');
                $search_status = $this->input->get('search_status');
                $search_location_id = $this->input->get('search_location_id');
                $search_budget_min = $this->input->get('search_budget_min');
                $search_budget_max = $this->input->get('search_budget_max');
                $search_size_min = $this->input->get('search_size_min');
                $search_size_max = $this->input->get('search_size_max');
                $search_size_unit = $this->input->get('search_size_unit');
                $search_agent_id = $this->input->get('search_agent_id');

                $where_ids = "";
                $user_ids = $this->get_level_user_ids();
                if (count($user_ids)) {
                    $where_ids .= " AND (tbl_leads.user_id='" . implode("' OR tbl_leads.user_id='", $user_ids) . "')";
                }

                if ($search_agent_id) {
                    $where_ids .= " AND (tbl_leads.user_id='" . $search_agent_id . "')";
                }

                $where = "tbl_leads.account_id='" . $account_id . "' AND added_to_followup='0' AND is_customer='0'";
                $where .= $where_ids;
                $where_ext = "";
                if ($search_text) {
                    $where_ext .= " AND (lead_mobile_no LIKE '%" . $search_text . "%' OR lead_email LIKE '%" . $search_text . "%' OR CONCAT(lead_title, ' ', lead_first_name, ' ', lead_last_name) LIKE '%" . $search_text . "%')";
                }

                if ($search_date_from && !$search_date_to) {
                    $where_ext .= " AND lead_date>='" . $search_date_from . "'";
                }
                if ($search_date_from && $search_date_to) {
                    $where_ext .= " AND (lead_date BETWEEN '" . $search_date_from . "' AND '" . $search_date_to . "')";
                }
                if ($search_state_id) {
                    $where_ext .= " AND lead_state_id='" . $search_state_id . "'";
                }
                if ($search_city_id) {
                    $where_ext .= " AND lead_city_id='" . $search_city_id . "'";
                }
                if ($search_source_id) {
                    $where_ext .= " AND lead_source_id='" . $search_source_id . "'";
                }
                if ($search_stage_id) {
                    $where_ext .= " AND lead_stage_id='" . $search_stage_id . "'";
                }
                if ($search_status) {
                    $where_ext .= " AND lead_status='" . $search_status . "'";
                }

                if ($search_location_id) {
                    $where_ext .= " AND FIND_IN_SET(" . $search_location_id . ",location)";
                }

                if ($search_budget_min && !$search_budget_max) {
                    $where_ext .= " AND budget_min>='" . $search_budget_min . "'";
                }
                if ($search_budget_min && $search_budget_max) {
                    $where_ext .= " AND (budget_min>='" . $search_budget_min . "' AND budget_max<='" . $search_budget_max . "')";
                }

                if ($search_size_min && !$search_size_max) {
                    $where_ext .= " AND size_min<='" . $search_size_min . "'";
                }
                if ($search_size_min && $search_size_max) {
                    $where_ext .= " AND (size_min<='" . $search_size_min . "' AND size_max>='" . $search_size_max . "')";
                }

                if ($search_size_unit) {
                    $where_ext .= " AND size_unit='" . $search_size_unit . "'";
                }

                $where .= $where_ext;

                if ($filter_by == 1) {
                    $where .= " ORDER BY lead_name";
                } else if ($filter_by == 2) {
                    $where .= " ORDER BY STR_TO_DATE(lead_date,'%d-%m-%Y') DESC, tbl_leads.lead_id DESC";
                } else if ($filter_by == 3) {
                    $where .= " ORDER BY lead_status DESC";
                } else if ($filter_by == 4) {
                    $where .= " ORDER BY lead_status ASC";
                } else {
                    $where .= " ORDER BY STR_TO_DATE(lead_date,'%d-%m-%Y') DESC, tbl_leads.lead_id DESC";
                }


                $this->db->select("*,tbl_leads.lead_id as lead_id,CONCAT(lead_first_name, ' ', lead_last_name) AS 'lead_name'");
                $this->db->from('tbl_leads');
                $this->db->join('tbl_requirements', 'tbl_requirements.lead_id = tbl_leads.lead_id', 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $records = $query->result();

                require_once(APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php');
                require_once(APPPATH . 'third_party/PHPExcel/Classes/PHPExcel/IOFactory.php');

                /* Create new PHPExcel object*/
                $objPHPExcel = new PHPExcel();

                $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");

                /* Create a first sheet, representing sales data*/
                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Lead Id');
                $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Title');
                $objPHPExcel->getActiveSheet()->setCellValue('C1', 'First Name');
                $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Last Name');
                $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Mobile');
                $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Email');

                $i = 0;
                $o = 2;
                foreach ($records as $record) {
                    $objPHPExcel->getActiveSheet()->setCellValue('A' . $o, $record->lead_id);
                    $objPHPExcel->getActiveSheet()->setCellValue('B' . $o, $record->lead_title);
                    $objPHPExcel->getActiveSheet()->setCellValue('C' . $o, $record->lead_first_name);
                    $objPHPExcel->getActiveSheet()->setCellValue('D' . $o, $record->lead_last_name);
                    $objPHPExcel->getActiveSheet()->setCellValue('E' . $o, $record->lead_mobile_no);
                    $objPHPExcel->getActiveSheet()->setCellValue('F' . $o, $record->lead_email);
                    $o++;
                    $i++;
                }

                $objPHPExcel->getActiveSheet()->setTitle('Leads');


                // Save the spreadsheet
                //$writer->save('download-leads.xlsx');

                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="download-leads.xlsx"');
                header('Cache-Control: max-age=0');
                $writer->save('php://output');
            } else {
                redirect(AGENT_URL . 'leads');
            }
        } else {
            redirect(AGENT_URL . 'leads');
        }
    }


    public function upload_lead()
    {

        $account_id     = 0;
        $user_id        = 0;
        $where          = "user_hash='" . $this->session->userdata('agent_hash') . "'";
        $user_detail    = $this->Action_model->select_single('tbl_users', $where);

        if ($user_detail) {
            $user_id    =   $user_detail->user_id;
            $account_id =   $user_detail->user_id;

            if ($user_detail->role_id != 2) {

                $account_id = $user_detail->parent_id;
            }
        }

        if ($account_id) {

            $fileName = $_FILES["file"]["tmp_name"];

            if ($_FILES["file"]["size"] > 0) {

                $file   = fopen($fileName, "r");

                $l      =    0;

                while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {

                    if ($l) {

                        $data_array = array(
                            'data_title'            =>  $column[1],
                            'data_first_name'       =>  $column[2],
                            'data_last_name'        =>  $column[3],
                            'data_mobile'           =>  $column[4],
                            'data_email'            =>  $column[5]
                        );

                        $where          =   "data_mobile='" . $column[4] . "' AND account_id='" . $account_id . "'";
                        $lead_detail    =   $this->Action_model->select_single('tbl_data', $where);

                        if ($lead_detail) {

                            $this->Action_model->update_data($data_array, 'tbl_data', $where);
                        } else {

                            $data_array2 = array(
                                'added_by'          =>  $user_id,
                                'account_id'        =>  $account_id,
                                'data_status'       =>  1,
                                'file_name'         =>  $this->input->post('lead_data_type'),
                            );

                            $data_array     =   array_merge($data_array, $data_array2);
                            $lead_id        =   $this->Action_model->insert_data($data_array, 'tbl_data');
                        }
                    }

                    $l++;
                }
            }

            $this->session->set_flashdata('success_msg', 'Upload Successfully!!');
            redirect(AGENT_URL . 'data');
        } else {
            redirect(AGENT_URL . 'data');
        }
    }

    public function download_followup()
    {
        $array = array();

        if ($this->input->get()) {

            $account_id = getAccountId();

            if ($account_id) {
                $filter_by = $this->input->get('filter_by');
                $page = $this->input->get('page');

                $search_text = $this->input->get('search_text');
                $search_date_from = $this->input->get('search_date_from');
                $search_date_to = $this->input->get('search_date_to');
                $search_state_id = $this->input->get('search_state_id');
                $search_city_id = $this->input->get('search_city_id');
                $search_source_id = $this->input->get('search_source_id');
                $search_stage_id = $this->input->get('search_stage_id');
                $search_status = $this->input->get('search_status');
                $search_location_id = $this->input->get('search_location_id');
                $search_budget_min = $this->input->get('search_budget_min');
                $search_budget_max = $this->input->get('search_budget_max');
                $search_size_min = $this->input->get('search_size_min');
                $search_size_max = $this->input->get('search_size_max');
                $search_size_unit = $this->input->get('search_size_unit');
                $search_agent_id = $this->input->get('search_agent_id');

                $where_ids = "";

                $where = "tbl_leads.account_id='" . $account_id . "' AND added_to_followup='1' AND tbl_leads.lead_status='1' AND is_customer='0'";
                $user_ids = $this->get_level_user_ids();
                if (count($user_ids)) {
                    $where_ids .= " AND ((tbl_followup.user_id='" . implode("' OR tbl_followup.user_id='", $user_ids) . "')  OR (tbl_followup.assign_user_id='" . implode("' OR tbl_followup.assign_user_id='", $user_ids) . "'))";

                    if ($search_agent_id) {
                        $where_ids .= " AND (tbl_followup.user_id='" . $search_agent_id . "')";
                    }
                }
                $where .= $where_ids;
                $where_ext = "";
                if ($search_text) {
                    $where_ext .= " AND (lead_mobile_no LIKE '%" . $search_text . "%' OR lead_email LIKE '%" . $search_text . "%' OR CONCAT(lead_title, ' ', lead_first_name, ' ', lead_last_name) LIKE '%" . $search_text . "%')";
                }

                if ($search_date_from && !$search_date_to) {
                    $where_ext .= " AND lead_date>='" . $search_date_from . "'";
                }
                if ($search_date_from && $search_date_to) {
                    $where_ext .= " AND (lead_date BETWEEN '" . $search_date_from . "' AND '" . $search_date_to . "')";
                }
                if ($search_state_id) {
                    $where_ext .= " AND lead_state_id='" . $search_state_id . "'";
                }
                if ($search_city_id) {
                    $where_ext .= " AND lead_city_id='" . $search_city_id . "'";
                }
                if ($search_source_id) {
                    $where_ext .= " AND lead_source_id='" . $search_source_id . "'";
                }
                if ($search_stage_id) {
                    $where_ext .= " AND lead_stage_id='" . $search_stage_id . "'";
                }
                if ($search_status) {
                    $where_ext .= " AND lead_status='" . $search_status . "'";
                }

                if ($search_location_id) {
                    $where_ext .= " AND FIND_IN_SET(" . $search_location_id . ",location)";
                }

                if ($search_budget_min && !$search_budget_max) {
                    $where_ext .= " AND budget_min>='" . $search_budget_min . "'";
                }
                if ($search_budget_min && $search_budget_max) {
                    $where_ext .= " AND (budget_min>='" . $search_budget_min . "' AND budget_max<='" . $search_budget_max . "')";
                }

                if ($search_size_min && !$search_size_max) {
                    $where_ext .= " AND size_min<='" . $search_size_min . "'";
                }
                if ($search_size_min && $search_size_max) {
                    $where_ext .= " AND (size_min<='" . $search_size_min . "' AND size_max>='" . $search_size_max . "')";
                }

                if ($search_size_unit) {
                    $where_ext .= " AND size_unit='" . $search_size_unit . "'";
                }

                $where .= $where_ext;

                $where .= " GROUP BY tbl_leads.lead_id";

                if ($filter_by == 1) {
                    $where .= " ORDER BY lead_name";
                } else if ($filter_by == 2) {
                    $where .= " ORDER BY STR_TO_DATE(lead_date,'%d-%m-%Y') DESC, tbl_leads.lead_id DESC";
                } else if ($filter_by == 3) {
                    $where .= " ORDER BY lead_status DESC";
                } else if ($filter_by == 4) {
                    $where .= " ORDER BY lead_status ASC";
                } else {
                    $where .= " ORDER BY STR_TO_DATE(lead_date,'%d-%m-%Y') DESC, tbl_leads.lead_id DESC";
                }


                $query = $this->db->query("SELECT tbl_requirements.*,tbl_leads.*,tbl_lead_sources.*,tbl_lead_stages.*,`tbl_leads`.`lead_id` as `lead_id`, CONCAT(lead_first_name, ' ', lead_last_name) AS 'lead_name', `followup_date`, CONCAT(IFNULL(ft.next_followup_date,''), ' ', IFNULL(ft.next_followup_time,'')) AS 'next_followup_date', IFNULL(ft.next_followup_time,'') as next_followup_time FROM `tbl_followup`  LEFT JOIN tbl_leads ON `tbl_leads`.`lead_id` = `tbl_followup`.`lead_id` LEFT JOIN `tbl_requirements` ON `tbl_requirements`.`lead_id` = `tbl_leads`.`lead_id` LEFT JOIN `tbl_lead_stages` ON `tbl_lead_stages`.`lead_stage_id` = `tbl_leads`.`lead_stage_id` LEFT JOIN `tbl_lead_sources` ON `tbl_lead_sources`.`lead_source_id` = `tbl_leads`.`lead_source_id` LEFT JOIN `tbl_followup` as ft ON `ft`.`lead_id` = `tbl_leads`.`lead_id` AND ft.followup_id= (select fs.followup_id from tbl_followup as fs where fs.lead_id=tbl_leads.lead_id order by fs.followup_id desc limit 1) WHERE " . (($user_ids) ? "tbl_followup.followup_id in (select max(followup_id) from tbl_followup where ((tbl_followup.user_id='" . implode("' OR tbl_followup.user_id='", $user_ids) . "')  OR (tbl_followup.assign_user_id='" . implode("' OR tbl_followup.assign_user_id='", $user_ids) . "')) group by lead_id) AND " : "tbl_followup.followup_id in (select max(followup_id) from tbl_followup where lead_id=tbl_leads.lead_id group by lead_id) AND ") . "" . $where);
                $records = $query->result();

                require_once(APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php');
                require_once(APPPATH . 'third_party/PHPExcel/Classes/PHPExcel/IOFactory.php');

                /* Create new PHPExcel object*/
                $objPHPExcel = new PHPExcel();

                $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");

                /* Create a first sheet, representing sales data*/
                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
                $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Lead Id');
                $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Title');
                $objPHPExcel->getActiveSheet()->setCellValue('C1', 'First Name');
                $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Last Name');
                $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Mobile');
                $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Email');
                $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Stage');
                $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Source');
                $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Next Followup');
                $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Assign User');

                $i = 0;
                $o = 2;
                foreach ($records as $item) {

                    $next_followup = "";

                    $next_followup_time = "";
                    $next_followup_user = "";

                    $where = "lead_id='" . $item->lead_id . "' AND next_followup_date!='' ORDER BY followup_id DESC LIMIT 1";
                    $this->db->select('au.first_name as au_first_name,au.last_name as au_last_name,next_followup_date,next_followup_time');
                    $this->db->from('tbl_followup');
                    $this->db->join('tbl_users as au', 'au.user_id = tbl_followup.assign_user_id', 'left');
                    $this->db->where($where);
                    $query = $this->db->get();
                    $followup_detail = $query->row();
                    if ($followup_detail) {
                        $next_followup_time = $followup_detail->next_followup_date . " & " . $followup_detail->next_followup_time;
                        $next_followup_user = $followup_detail->au_first_name . ' ' . $followup_detail->au_last_name;

                        $next_followup = $followup_detail->next_followup_date . " & " . $followup_detail->next_followup_time . " " . $followup_detail->au_first_name . ' ' . $followup_detail->au_last_name;
                    }

                    $next_followup_date = "";
                    if ($item->next_followup_date) {
                        $next_followup_date = "$item->next_followup_date";

                        $next_followup_date = preg_replace("/ /", "<br>", $next_followup_date, 1);
                    }

                    $objPHPExcel->getActiveSheet()->setCellValue('A' . $o, $item->lead_id);
                    $objPHPExcel->getActiveSheet()->setCellValue('B' . $o, $item->lead_title);
                    $objPHPExcel->getActiveSheet()->setCellValue('C' . $o, $item->lead_first_name);
                    $objPHPExcel->getActiveSheet()->setCellValue('D' . $o, $item->lead_last_name);
                    $objPHPExcel->getActiveSheet()->setCellValue('E' . $o, $item->lead_mobile_no);
                    $objPHPExcel->getActiveSheet()->setCellValue('F' . $o, $item->lead_email);
                    $objPHPExcel->getActiveSheet()->setCellValue('G' . $o, $item->lead_stage_name);
                    $objPHPExcel->getActiveSheet()->setCellValue('H' . $o, $item->lead_source_name);
                    $objPHPExcel->getActiveSheet()->setCellValue('I' . $o, $next_followup_time);
                    $objPHPExcel->getActiveSheet()->setCellValue('J' . $o, $next_followup_user);
                    $o++;
                    $i++;
                }

                $objPHPExcel->getActiveSheet()->setTitle('Leads');


                // Save the spreadsheet
                //$writer->save('download-followup.xlsx');

                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="download-followup.xlsx"');
                header('Cache-Control: max-age=0');
                $writer->save('php://output');
            } else {
                redirect(AGENT_URL . 'leads');
            }
        } else {
            redirect(AGENT_URL . 'leads');
        }
    }


    # changes 2024-06-28 add new method

    function data()
    {
        $user_detail    =       user();

        // print_r($user_detail); die;

        $account_id     = $user_detail->user_id;

        $user_id        = user()->user_id;

        $where            = ' 1 = 1 ';
        if (user()->role_id == 2) {
            $where            .= " and account_id = $user_id";
        } else {
            $where            .= " and  added_by = $user_id";
        }

        $all_file_type = $this->db->distinct()->select('file_name')->where($where)->get('tbl_data')->result();



        // print_r($all_file_type) ; die;

        $all_status  =  $this->db->distinct()->select('lead_stage_id,lead_stage_name')->where(['lead_stage_status' => 1])->get('tbl_lead_stages')->result();

        # Reasons
        $reason_where           =   ' 1 = 1';

        if (user()->role_id == 2):
            $reason_where           .=   " and account_id = $user_id ";
        else:
            $reason_where           .=   " and assign_user_id = $user_id or user_id =  $user_id";
        endif;

        $all_reasons  =  $this->db->distinct()->select('comment')->where($reason_where)->get('tbl_followup')->result();

        $data['all_reasons'] = $all_reasons;

        # End Reasons

        $data['all_status'] = $all_status;

        $data['all_file_type'] = $all_file_type;

        $all_unit_type_list = $this->Action_model->detail_result('tbl_unit_types', "unit_type_status='1'", 'unit_type_id,unit_type_name,requirement_accomodation');
        $data['all_unit_type_list'] = $all_unit_type_list;

        $where = "lead_stage_status='1'";
        $lead_stage_list = $this->Action_model->detail_result('tbl_lead_stages', $where, 'lead_stage_id,lead_stage_name');
        $data['lead_stage_list'] = $lead_stage_list;

        $where = "lead_type_status='1'";
        $lead_type_list = $this->Action_model->detail_result('tbl_lead_types', $where, 'lead_type_id,lead_type_name');
        $data['lead_type_list'] = $lead_type_list;

        $where = "lead_action_status='1'";
        $lead_action_list = $this->Action_model->detail_result('tbl_lead_actions', $where, 'lead_action_id,lead_action_name');
        $data['lead_action_list'] = $lead_action_list;

        $where = "country_id='1' AND state_status=1";
        $state_list = $this->Action_model->detail_result('tbl_states', $where);
        $data['state_list'] = $state_list;

        $where = "lead_source_status='1'";
        $lead_source_list = $this->Action_model->detail_result('tbl_lead_sources', $where);
        $data['lead_source_list'] = $lead_source_list;

        $where = "unit_status='1'";
        $unit_list = $this->Action_model->detail_result('tbl_units', $where, 'unit_id,unit_name');
        $data['unit_list'] = $unit_list;

        $where = "budget_status='1'";
        $budget_list = $this->Action_model->detail_result('tbl_budgets', $where, 'budget_id,budget_name');
        $data['budget_list'] = $budget_list;



        $where = "user_status='1' AND ((parent_id='" . $account_id . "') OR (user_id='" . $account_id . "' AND role_id='2'))";
        $where_ids = "";
        $user_ids = $this->get_level_user_ids();


        // print_r($user_ids); die;


        // if (count($user_ids)) {

        //     $where_ids .= " OR (tbl_users.user_id='" . implode("' OR tbl_users.user_id='", $user_ids) . "')";
        // }

        // $where .= $where_ids;


        // echo $where;  die;

        if ($user_detail->parent_id == 0) {
            //    echo 'adf'; die;
            $where  = "user_id=$user_detail->user_id OR parent_id=$user_detail->user_id";
        } else {
            // echo $user_detail->parent_id; die;
            $where = " user_id=$user_detail->user_id OR report_to=$user_detail->user_id";
        }

        $user_list = $this->Action_model->detail_result('tbl_users', $where, 'user_id,user_title,first_name,last_name,parent_id,is_individual,firm_name, role_id');
        $data['user_list'] = $user_list;

        // echo "<pre>";
        // print_r($data['user_list']); die;

        $where = "agent_id='" . $account_id . "' OR share_account_id='" . $account_id . "'";
        $this->db->select("product_id,project_name");
        $this->db->from('tbl_products');
        $this->db->join('tbl_project_share', "tbl_project_share.project_id = tbl_products.product_id AND share_account_id='" . $account_id . "'", 'left');
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

        $account_id = getAccountId();

        /*$where = "(tbl_project_share.account_id='".$account_id."')";
        
        $this->db->select('share_account_id');
        $this->db->from('tbl_project_share');
        $this->db->where($where);
        $query = $this->db->get();
        $user_list_data = $query->result();
        $user_list = array();
        if ($user_list_data) {
            foreach ($user_list_data as $row) {
                $user_list[] = $row->share_account_id;
            }
        }
        $user_list_ids = ($user_list)?implode(",", $user_list):"";*/

        $where = "(tbl_users.user_id='" . $account_id . "' OR tbl_users.parent_id='" . $account_id . "')";
        /*if ($user_list_ids) {
            $where .= " OR tbl_users.user_id IN (".$user_list_ids.")";
        }*/

        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where($where);
        $query = $this->db->get();
        $filter_user_list = $query->result();
        $data['filter_user_list'] = $filter_user_list;

        $this->load->view(AGENT_URL . 'raw-data', $data);
        // $this->load->view('agent/raw-data');
    }

    # changes 2024-06-28 add new method

    # Lead Unit Form View
    public function lead_unit_form_view()
    {
        $id                 =    $this->input->get('id');
        $lead_id            =    $this->input->get('lead_id');

        if ($id) :
            $record             =    lead_unit_details($id);

            # Property Documents
            $property_document_full_url                   =   base_url('public/other/property-documents/');
            $property_documents             =   $this->db->select("id, title, document, CONCAT('$property_document_full_url', document) as document_full_url")->where("lead_unit_id = $id")->get('tbl_property_documents')->result();
            # End Property Documents

            # Gallery Images
            $full_url                   =   base_url('public/other/gallery-images/lead-units/');
            $gallery_images             =   $this->db->select("id, name, CONCAT('$full_url', name) as full_url, type")->where("type = 'lead_unit' and parent_id = $id")->get('tbl_gallery_images')->result();
            # End Gallery Images

            $record->youtube_data       =   $record->youtube_data ? json_decode($record->youtube_data) : null;
        endif;


        $view               =  $this->load->view('components/form-view/lead-unit-form-view', ['lead_id' => $lead_id, 'record' => $record ?? null, 'gallery_images' => $gallery_images ?? null, 'property_documents' => $property_documents ?? []], true);
        echo json_encode(['status' => true, 'message' => 'Record successfully fetched', 'view' => $view]);
    }
    # End Lead Unit Form View


    # Lead Unit Details
    public function lead_unit_details()
    {

        $id                 =    $this->input->get('id');
        $is_view            =    $this->input->get('view') == 'true' ? true : false;

        if (!$id) :
            echo json_encode(['status' => false, 'message' => 'Invalid Record']);
        endif;

        $record             =    lead_unit_details($id);

        if ($record) :
            if ($is_view) :

                # Property Documents
                $property_document_full_url                   =   base_url('public/other/property-documents/');
                $property_documents             =   $this->db->select("id, title, document, CONCAT('$property_document_full_url', document) as document_full_url")->where("lead_unit_id = $id")->get('tbl_property_documents')->result();
                # End Property Documents

                # Gallery Images
                $full_url                   =   base_url('public/other/gallery-images/lead-units/');
                $gallery_images             =   $this->db->select("id, name, CONCAT('$full_url', name) as full_url")->where("type = 'lead_unit' and parent_id = $id")->get('tbl_gallery_images')->result();
                # End Gallery Images

                $details_view     = $this->load->view('components/details-view/lead-unit-details', ['record' => $record, 'gallery_images' => $gallery_images ?? [], 'property_documents' => $property_documents ?? []], true);
            endif;
            echo json_encode(['status' => true, 'message' => 'Record successfully fetched', 'data' => $record, 'details_view' => $details_view ?? null]);
        else :
            echo json_encode(['status' => false, 'message' => 'Invalid Record']);
        endif;
    }
    # End Lead Unit Details

    # Store Lead Unit
    public function store_lead_unit()
    {

        if (!$this->input->post()) :
            echo json_encode(['status' => false, 'message' => 'Reqeust method is not POST']);
        endif;

        $res_arr                                    =   [];

        # Init
        $id                                         =   $this->input->post('id');
        $lead_id                                    =   $this->input->post('lead_id');
        $looking_for                                =   $this->input->post('looking_for');
        $booking_date                               =   $this->input->post('booking_date');
        $project_id                                 =   $this->input->post('project_id');
        $property_id                                =   $this->input->post('property_id');
        $project_type_id                            =   $this->input->post('project_type_id');
        $property_type_id                           =   $this->input->post('property_type_id');
        $state_id                                   =   $this->input->post('state_id');
        $city_id                                    =   $this->input->post('city_id');
        $location_id                                =   $this->input->post('location_id');
        $property_details                           =   $this->input->post('property_details');
        $old_property_layout                        =   $this->input->post('old_property_layout');
        $project_name                               =   $this->input->post('project_name');
        $agent_id                                   =   $this->session->userdata('user_id');
        $costing_price                              =   $this->input->post('costing_price');
        $youtube_data                               =   $this->input->post('youtube_data');
        $inventory_id                               =   $this->input->post('inventory_id');

        # Validation
        # Unit Code Validation
        if (isset($property_details['unit_code'])):
            if ($property_details['unit_code'] == ''):
                echo json_encode(['status' => false, 'message' => 'Unit code requried']);
                exit;
            endif;
        endif;
        # End Unit Code Validation

        # Validation
        if (!isset($property_details['plot_number']) &&  !isset($property_details['unit_no'])):
            echo json_encode(['status' => false, 'message' => 'Either Plot Number or Unit Number is required']);
            exit;
        endif;
        # End Validation

        # Plot Number Validation
        // if(isset($property_details['plot_number']) ):
        //     if($property_details['plot_number'] == '' ||  ):
        //         echo json_encode(['status' => false, 'message' => 'Plot Number requried']);
        //         exit;
        //     endif;
        // endif;
        # End Plot Number Validation

        # Unit Number Validation
        // if(isset($property_details['unit_no']) ):
        //     if($property_details['unit_no'] == '' ):
        //         echo json_encode(['status' => false, 'message' => 'Unit Number requried']);
        //         exit;
        //     endif;
        // endif;
        # End Unit Number Validation

        foreach ($youtube_data ?? [] as $youtube_item) :
            if ($youtube_item['title'] != '' && $youtube_item['link'] != '') :
                $youtube_data_arr[]               =   [
                    'title' => $youtube_item['title'],
                    'link'  => $youtube_item['link']
                ];
            endif;
        endforeach;
        # End Init

        # File Upload
        $upload_response            =   upload_file('property_layout', 'lead-unit-layouts', $old_property_layout);

        if (!isset($upload_response) || !$upload_response->status) :
            echo json_encode(['status' => false, 'message' => $upload_response->message]);
            exit;
        endif;

        $property_layout                            =   $upload_response->file_name;
        # End File Upload

        # Db Data
        $data                                   =   [
            'lead_id'           => $lead_id,
            'added_by'          => $agent_id,
            'looking_for'       => $looking_for,
            'booking_date'      => $booking_date,
            'project_id'        => $project_id,
            'project_name'      => $project_name,
            'property_id'       => $property_id,
            'project_type_id'   => $project_type_id,
            'property_type_id'  => $property_type_id,
            'state_id'          => $state_id,
            'city_id'           => $city_id,
            'location_id'       => $location_id,
            'property_details'  => ($property_details ?? 0) ? json_encode($property_details) : NULL,
            'youtube_data'      => ($youtube_data_arr ?? 0) ? json_encode($youtube_data_arr) : NULL,
            'property_layout'   => $property_layout,
            'costing_price'     => $costing_price,
            'created_at'        => date('Y-m-d h:i:m:s'),
        ];
        # End Db Data

        if ($id) :
            $result                             =   $this->Action_model->update_data($data, 'tbl_lead_units', "id = $id");
            $res_arr                            =   $result ? ['status' => true, 'message' => 'Successfully record updated'] : ['status' => false, 'message' => 'Some error occured'];
        else :
            $result                             =   $this->Action_model->insert_data($data, 'tbl_lead_units');
            $res_arr                            =   $result ? ['status' => true, 'message' => 'Successfully record inserted'] : ['status' => false, 'message' => 'Some error occured'];
        endif;


        # Gallery Images Functionality
        $id        = $id ? $id : $result;

        if ($id) :

            # Property Documents Functionality
            $this->propertyDocumentsFunctionality($this->input->post('property_documents'), 0,  $id);
            # End Property Documents Functionality

            $gallery_images                 =   upload_files('gallery_images', 'lead-units');

            if ($gallery_images->status && count($gallery_images->images)) :
                insert_or_update_gallery_images($gallery_images->images, 'lead_unit', $id);
            elseif (!$gallery_images->status ?? 0) :
                $res_arr   = $gallery_images;
            endif;
        endif;

        # End Gallery Images Functionality


        # Update Inventory Status
        if ($inventory_id):
            $inventory_status = 0;
            switch ($looking_for):
                case 'sale':
                    $inventory_status = 1;
                    break;

                case 'rent':
                    $inventory_status = 5;
                    break;

                case 'no_action':
                    $inventory_status = 4;
                    break;
            endswitch;

            if ($inventory_status):
                $this->db->where("inventory_id = '$inventory_id'")->update('tbl_inventory', ['inventory_status' => $inventory_status]);
            endif;
        endif;
        # End Update Inventory Status

        # Init

        echo json_encode($res_arr);
    }
    # End Store Lead Unit

    # Property Documents Functionality
    public function propertyDocumentsFunctionality($records, $property_id = 0, $lead_unit_id = 0)
    {

        if (!$lead_unit_id && !$property_id) :
            return false;
        endif;

        $property_document_data = [];

        $upload_path      = "./public/other/property-documents/";

        # Create Folder if Folder Not Exits
        if (!file_exists($upload_path)) {
            mkdir($upload_path, 0777, true);
        }
        # End Create Folder if Folder Not Exits

        # File Upload Configuration
        $config = array();
        $config['upload_path'] = $upload_path;


        $config['allowed_types'] = '*';
        $config['max_size'] = 10 * 1024;
        $config['remove_spaces'] = TRUE;

        foreach ($records ?? [] as $key => $record) {
            $id                     =   $record['id'] ?? 0;
            $title                 =   $record['title'] ?? '';

            if (!empty($_FILES['property_documents']['name'][$key]['document_file'])) {
                # Reformat the $_FILES array
                $_FILES['file']['name'] = $_FILES['property_documents']['name'][$key]['document_file'];
                $_FILES['file']['type'] = $_FILES['property_documents']['type'][$key]['document_file'];
                $_FILES['file']['tmp_name'] = $_FILES['property_documents']['tmp_name'][$key]['document_file'];
                $_FILES['file']['error'] = $_FILES['property_documents']['error'][$key]['document_file'];
                $_FILES['file']['size'] = $_FILES['property_documents']['size'][$key]['document_file'];

                # File Name and Config
                $file_name = str_replace(' ', '-', time() . '_' . $_FILES['file']['name']);
                $config['file_name'] = $file_name;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                # File Upload
                if (!$this->upload->do_upload('file')) {
                    $error = array('error' => $this->upload->display_errors());
                    // print_r($error);
                    // die;
                    // return (object) ['status' => false, 'message' => $error['error']];
                } else {
                    $upload_data = $this->upload->data();
                    $file_name = $upload_data['file_name'];
                }

                if (($title && $file_name && !$id)) :
                    # Save the uploaded file data
                    $property_document_data[] = [
                        'property_id'           => $property_id,
                        'lead_unit_id'          => $lead_unit_id,
                        'title'                 => $title,
                        'document'              => $file_name,
                        'updated_at'            => date('Y-m-d h:i:m s'),
                        'created_at'            => date('Y-m-d h:i:m s'),
                    ];
                elseif ($id) :
                    $update_property_document_data = [
                        'property_id'           => $property_id,
                        'lead_unit_id'          => $lead_unit_id,
                        'title'                 => $title,
                        'document'              => $file_name,
                        'updated_at'            => date('Y-m-d h:i:m s'),
                    ];
                    $this->db->where("id = $id")->update('tbl_property_documents', $update_property_document_data);
                endif;
            }
        }

        if (count($property_document_data)) :
            $this->db->insert_batch('tbl_property_documents', $property_document_data);
        endif;

        return true;
    }


    # End Property Documents Functionality

    public function  upload_raw_data()
    {

        $account_id     = 0;
        $user_id        = 0;
        $where          = "user_hash='" . $this->session->userdata('agent_hash') . "'";
        $user_detail    = $this->Action_model->select_single('tbl_users', $where);

        $total_data_count    = 0;
        $total_uploaded_data_count = 0;

        if ($user_detail) {
            $user_id    =   $user_detail->user_id;
            $account_id =   $user_detail->user_id;

            if ($user_detail->role_id != 2) {

                $account_id = $user_detail->parent_id;
            }
        }


        $data_excel = array();


        if ($account_id) {

            $upload_path = FCPATH . './uploads/raw-data/';
            # Create Folder if Folder Not Exits
            if (!file_exists($upload_path)) {
                mkdir($upload_path, 0777, true);
            }
            # End Create Folder if Folder Not Exits

            $config['upload_path']             = $upload_path;

            $config['allowed_types']          =    'xlsx';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file')) {
                $data = $this->upload->data();

                if ($data['file_ext'] == '.xlsx') {

                    require('application/libraries/php-excel-reader/excel_reader2.php');
                    require('application/libraries/SpreadsheetReader.php');


                    $Reader = new SpreadsheetReader($data['full_path']);
                    $Sheets = $Reader->Sheets();


                    foreach ($Sheets as $Index => $Name) {
                        if ($Index == 0) {
                            $Reader->ChangeSheet($Index);
                            foreach ($Reader as $Key => $Row) {

                                if ($Key  > 0) {
                                    $total_data_count++;
                                    $data_array = array(
                                        'data_title'            =>  $Row[1] ?? '',
                                        'data_first_name'       =>  $Row[2] ?? '',
                                        'data_last_name'        =>  $Row[3] ?? '',
                                        'data_mobile'           =>  $Row[4] ?? '',
                                        'data_email'            =>  $Row[5] ?? ''
                                    );

                                    $where          =   "data_mobile='" . $Row[4] . "' AND account_id='" . $account_id . "'";
                                    $lead_detail    =   $this->Action_model->select_single('tbl_data', $where);

                                    if ($lead_detail) {

                                        $this->Action_model->update_data($data_array, 'tbl_data', $where);
                                    } else {
                                        if ($Row[4] && $Row[2]) {
                                            $total_uploaded_data_count++;
                                            $data_array2 = array(
                                                'added_by'          =>  $user_id,
                                                'account_id'        =>  $account_id,
                                                'data_status'       =>  1,
                                                'file_name'         =>  $this->input->post('lead_data_type'),
                                            );

                                            $data_array     =   array_merge($data_array, $data_array2);
                                            $lead_id        =   $this->Action_model->insert_data($data_array, 'tbl_data');
                                        }
                                    }
                                }
                            }
                        }
                    }

                    unlink($data['full_path']);
                }
            }

            $this->session->set_flashdata('success_msg', "Data Uploaded  $total_uploaded_data_count out of $total_data_count (some data is already exist)");
            redirect(AGENT_URL . 'data');
        } else {
            redirect(AGENT_URL . 'data');
        }
    }

    /*************************************************************************************** 
     * Helper Function
     ****************************************************************************************/

    # Trial Plan
    public function trial_plan(&$is_trial, &$trial_expired, &$trial_remaining_days, &$expire_today)
    {
        $where = "plan_id='" .  $this->user()->plan_id . "'";
        $plan_detail = $this->Action_model->select_single('tbl_plan', $where);

        if ($this->user()->plan_id == 1) {

            $date1 = new DateTime(date("d-m-Y") . " 00:00:00");
            $date2 = new DateTime($this->user()->next_due_date . " 00:00:00");
            $interval = $date1->diff($date2);
            $days = $interval->days;

            $is_trial = true;

            if ($this->user()->next_due_date == date("d-m-Y")) {
                $expire_today = 1;
            } else if (strtotime($this->user()->next_due_date . " 00:00:00") < strtotime(date("d-m-Y") . " 00:00:00")) {
                $trial_expired = true;
                $trial_remaining_days = 0;
            } else {
                $trial_remaining_days = $days;
            }
        } else if ($this->user()->plan_id == 2) {

            $date1 = new DateTime(date("d-m-Y") . " 00:00:00");
            $date2 = new DateTime($this->user()->next_due_date . " 00:00:00");
            $interval = $date1->diff($date2);
            $days = $interval->days;

            if ($this->user()->next_due_date == date("d-m-Y")) {
                $expire_today = 1;
            } else if (strtotime($this->user()->next_due_date . " 00:00:00") < strtotime(date("d-m-Y") . " 00:00:00")) {
                $trial_remaining_days = 0;
            } else {
                $trial_remaining_days = $days;
            }
        }
    }
    # End Trial Plan

    /*************************************************************************************** 
     *  Helper Function
     *************************************************************************************** */
}
