<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agent_api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Action_model');
    }

    public function index()
    {

        $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        echo json_encode($array);
    }

    public function followup_property()
    {

        //$where="am.module_status='1' AND am.module_id IN (".implode(',', $perm_ids).")";
        //$this->db->select('pty.property_id');
        //$this->db->from('tbl_property as pty');
        //$this->db->join('tbl_role_rights arr', "arr.module_id = am.module_id and arr.role_id='".$id."'", 'left');
        //$this->db->where($where);
        //$query = $this->db->get(); 

        $sql = "
SELECT req.requirement_id,pty.property_id,COALESCE('simple_property') as  type,bgt_min.budget_amount as req_budget_min,bgt_max.budget_amount as req_budget_max FROM tbl_requirements as req 
JOIN tbl_property as pty ON pty.product_type_id = req.product_type_id AND pty.unit_type_id = req.unit_type_id AND pty.state_id = req.state_id AND pty.city_id = req.city_id AND FIND_IN_SET(pty.location_id,req.location)
LEFT JOIN tbl_budgets as bgt_min ON bgt_min.budget_id = req.budget_min 
LEFT JOIN tbl_budgets as bgt_max ON bgt_max.budget_id = req.budget_max 
UNION ALL
SELECT req.requirement_id,pty.product_unit_detail_id,COALESCE('project_property') as  type,bgt_min.budget_amount as req_budget_min,bgt_max.budget_amount as req_budget_max FROM tbl_requirements as req
JOIN tbl_product_unit_details as pty ON pty.project_type = req.product_type_id AND pty.property_type = req.unit_type_id  
JOIN tbl_products as pdt ON pdt.product_id = pty.product_id  AND pdt.state_id = req.state_id AND pdt.city_id = req.city_id AND FIND_IN_SET(pdt.location,req.location) 
LEFT JOIN tbl_budgets as bgt_min ON bgt_min.budget_id = req.budget_min 
LEFT JOIN tbl_budgets as bgt_max ON bgt_max.budget_id = req.budget_max 
";
        $query = $this->db->query($sql);
        $property_list = $query->result();


        header('Content-Type: application/json');
        echo count($property_list);
        echo "\n";
        $json_string = json_encode($property_list, JSON_PRETTY_PRINT);
        echo $json_string;

        $items = array();
        $property_items = array();
        foreach ($property_list as $itemRow) {
            $budget = 0;
            $b_min = 0;
            $b_max = 0;

            $req_b_min = $itemRow->req_budget_min;
            $req_b_max = $itemRow->req_budget_max;
            if ($itemRow->type == "simple_property") {

                $budget = 0;
                $b_min = 0;
                $b_max = 0;

                $i1 = array(
                    'requirement_id' => $itemRow->requirement_id,
                    'property_id' => $itemRow->property_id,
                    'type' => $itemRow->type,
                    'budget' => $budget,
                    'budget_min' => $b_min,
                    'budget_max' => $b_max,
                    'req_budget_min' => $req_b_min,
                    'req_budget_max' => $req_b_max
                );

                $items[] = $i1;

                $rq = $this->Action_model->select_single('tbl_requirements', "requirement_id='" . $itemRow->requirement_id . "'");
                $pt = $this->Action_model->select_single('tbl_property', "property_id='" . $itemRow->property_id . "'");

                // sale
                if ($rq->look_for == 1 && $pt->listing_type == 2) {

                    if ($pt->sale_price >= $req_b_min && $pt->sale_price <= $req_b_max) {

                        $budget = "Budget: Rs." . $pt->sale_price;
                        $b_min = $pt->sale_price;
                        $b_max = $pt->sale_price;

                        $i1 = array(
                            'requirement_id' => $itemRow->requirement_id,
                            'property_id' => $itemRow->property_id,
                            'type' => $itemRow->type,
                            'budget' => $budget,
                            'budget_min' => $b_min,
                            'budget_max' => $b_max,
                            'req_budget_min' => $req_b_min,
                            'req_budget_max' => $req_b_max
                        );

                        $property_items[] = $i1;
                    }
                }
                // rent
                if ($rq->look_for == 2 && $pt->listing_type == 1) {
                    # code...
                }
                //if ($b_min>=$req_b_min && $req_b_max<=$req_b_max) {
                //  $property_items[] = $i1;
                //}
            } else if ($itemRow->type == "project_property") {

                $where = "product_unit_detail_id='" . $itemRow->property_id . "'";
                $this->db->select("pud.product_unit_detail_id,tbl_product_types.product_type_name,tbl_unit_types.unit_type_name,tbl_city.city_name,tbl_states.state_name,tbl_locations.location_name,tbl_accomodations.accomodation_name,pud.project_type,pud.property_type,pud.sa,pud.plot_size,pud.plot_unit,punit.unit_name as plot_unit_name,sa_unit.unit_name as sa_unit_name,pud.basic_cost,p.b_cost_unit");
                $this->db->from('tbl_product_unit_details as pud');
                $this->db->join('tbl_products as p', 'p.product_id = pud.product_id', 'left');
                $this->db->join('tbl_product_types', 'tbl_product_types.product_type_id=p.project_type', 'left');
                $this->db->join('tbl_unit_types', 'tbl_unit_types.unit_type_id=p.property_type', 'left');
                $this->db->join('tbl_states', 'tbl_states.state_id = p.state_id', 'left');
                $this->db->join('tbl_city', 'tbl_city.city_id = p.city_id', 'left');
                $this->db->join('tbl_locations', 'tbl_locations.location_id = p.location', 'left');
                $this->db->join('tbl_accomodations', 'tbl_accomodations.accomodation_id = pud.accomodation', 'left');
                $this->db->join('tbl_units as punit', 'punit.unit_id = pud.plot_unit', 'left');
                $this->db->join('tbl_units as sa_unit', 'sa_unit.unit_id = pud.unit', 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $item = $query->row();


                $this->db->select('*');
                $this->db->from('tbl_inventory');
                $this->db->join('tbl_basic_cost', 'tbl_basic_cost.inventory_id = tbl_inventory.inventory_id', 'left');
                $this->db->where("unit_code='" . $item->product_unit_detail_id . "'");
                $query = $this->db->get();
                $item_inv_data = $query->result();
                $o = 0;

                $amount_array = array();
                foreach ($item_inv_data as $itemInv) {
                    $current_rate = 0;
                    if ($itemInv->basic_cost_id) {

                        $b_cost_unit = $itemInv->current_rate_unit;
                        if ($itemInv->current_rate) {
                            //$current_rate += $itemInv->current_rate;

                            // residencial
                            if ($item->project_type == 2) {

                                // for flat
                                if (($item->property_type == 1 || $item->property_type == 7)) {
                                    //$size = $item->sa;
                                    //if ($item->sa_unit_name) {
                                    //    $size .= ' '.$item->sa_unit_name;
                                    //}

                                    if ($b_cost_unit == '2') { // for Sq.Ft
                                        $current_rate = $item->sa * $itemInv->current_rate;
                                    } else if ($b_cost_unit == '5') { // for Fix
                                        $current_rate = $itemInv->current_rate;
                                    }
                                }
                                // for plot
                                else if (($item->property_type == 2 || $item->property_type == 3)) {
                                    //$size = $item->plot_size;
                                    //if ($item->plot_unit_name) {
                                    //    $size .= ' '.$item->plot_unit_name;
                                    //}
                                    if ($b_cost_unit == '1') { // for Sq.Yd
                                        $current_rate = $item->plot_size * $itemInv->current_rate;
                                    } else if ($b_cost_unit == '2') { // for Sq.Ft
                                        $current_rate += $item->construction_area * $itemInv->current_rate;
                                    } else if ($b_cost_unit == '5') { // for Fix
                                        $current_rate = $itemInv->current_rate;
                                    }
                                }
                            }
                            // commercial
                            else if ($item->project_type == 3) {
                                //$size = $item->sa;
                                //if ($item->sa_unit_name) {
                                //    $size .= ' '.$item->sa_unit_name;
                                //}

                                if ($b_cost_unit == '2') { // for Sq.Ft
                                    $current_rate = $item->sa * $itemInv->current_rate;
                                } else if ($b_cost_unit == '5') { // for Fix
                                    $current_rate = $itemInv->current_rate;
                                }
                            }
                        }
                    } else {

                        $b_cost_unit = $item->b_cost_unit;

                        if ($item->basic_cost) {

                            // residencial
                            if ($item->project_type == 2) {
                                // for flat
                                if (($item->property_type == 1 || $item->property_type == 7)) {
                                    //$size = $item->sa;
                                    //if ($item->sa_unit_name) {
                                    //    $size .= ' '.$item->sa_unit_name;
                                    //}

                                    if ($b_cost_unit == '2') { // for Sq.Ft
                                        $current_rate = $item->sa * $item->basic_cost;
                                    } else if ($b_cost_unit == '5') { // for Fix
                                        $current_rate = $item->basic_cost;
                                    }
                                }
                                // for plot
                                else if (($item->property_type == 2 || $item->property_type == 3)) {
                                    //$size = $item->plot_size;
                                    //if ($item->plot_unit_name) {
                                    //    $size .= ' '.$item->plot_unit_name;
                                    //}
                                    if ($b_cost_unit == '1') { // for Sq.Yd
                                        $current_rate = $item->plot_size * $item->basic_cost;
                                    } else if ($b_cost_unit == '2') { // for Sq.Ft
                                        $current_rate = $item->construction_area * $item->basic_cost;
                                    } else if ($b_cost_unit == '5') { // for Fix
                                        $current_rate = $item->basic_cost;
                                    }
                                }
                            }
                            // commercial
                            else if ($item->project_type == 3) {
                                //$size = $item->sa;
                                //if ($item->sa_unit_name) {
                                //    $size .= ' '.$item->sa_unit_name;
                                //}

                                if ($b_cost_unit == '2') { // for Sq.Ft
                                    $current_rate = $item->sa * $item->basic_cost;
                                } else if ($b_cost_unit == '5') { // for Fix
                                    $current_rate = $item->basic_cost;
                                }
                            }
                        }
                    }

                    if ($current_rate) {
                        $amount_array[] = $current_rate;
                    }
                }

                if (count($amount_array)) {
                    $b_min = $this->getMin($amount_array);
                    $b_max = $this->getMax($amount_array);

                    if ($b_min == $b_max) {
                        $budget = " Budget: Rs." . $b_min;
                    } else {
                        $budget = " Budget: Rs." . $b_min . " to Rs." . $b_max . "";
                    }
                }




                $i1 = array(
                    'requirement_id' => $itemRow->requirement_id,
                    'property_id' => $itemRow->property_id,
                    'type' => $itemRow->type,
                    'budget' => $budget,
                    'budget_min' => $b_min,
                    'budget_max' => $b_max,
                    'req_budget_min' => $req_b_min,
                    'req_budget_max' => $req_b_max
                );

                $items[] = $i1;

                if ($b_min >= $req_b_min && $req_b_max <= $req_b_max) {
                    $property_items[] = $i1;
                }
            }
        }

        echo "\n\n";
        echo count($items);
        echo "\n";
        $json_string = json_encode($items, JSON_PRETTY_PRINT);
        echo $json_string;

        echo "\n\n";
        echo count($property_items);
        echo "\n";
        $json_string = json_encode($property_items, JSON_PRETTY_PRINT);
        echo $json_string;
    }

    public function getAgent()
    {
        $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
        $user_detail = $this->Action_model->select_single('tbl_users', $where);
        return $user_detail;
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

    public function associate_save()
    {

        $array = array();

        if ($this->input->post()) {

            $agent = $this->getAgent();
            if ($agent) {

                $agent_logo = "";
                $cin_image = "";
                $tan_image = "";
                $pan_image = "";
                $gst_image = "";
                $adhar_image = "";

                $agent_logo = $agent->agent_logo;
                $cin_image = $agent->cin_image;
                $tan_image = $agent->tan_image;
                $pan_image = $agent->pan_image;
                $gst_image = $agent->gst_image;
                $adhar_image = $agent->adhar_image;


                $config['upload_path'] = './uploads/images/agent/logo/';
                $config['allowed_types'] = 'jpg|png';
                $config['max_size']             = 5 * 1024;
                $config['remove_spaces'] = TRUE;
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);

                $this->upload->initialize($config);

                if (!empty($_FILES['agent_logo']['name'])) {
                    if (!$this->upload->do_upload('agent_logo')) {
                        $error = array('error' => $this->upload->display_errors());
                        $array = array('status' => 'error', 'message' => $error['error']);
                        echo json_encode($array);
                        exit;
                    } else {
                        if ($agent && $agent->agent_logo && file_exists('./uploads/images/agent/logo/' . $agent->agent_logo)) {
                            unlink('./uploads/images/agent/logo/' . $agent->agent_logo);
                        }
                        $agent_logo = $this->upload->data('file_name');
                    }
                }

                $config['upload_path'] = './uploads/images/agent/document/';
                $config['allowed_types'] = 'jpg|png|pdf';
                $config['max_size']             = 5 * 1024;
                $config['remove_spaces'] = TRUE;
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);

                $this->upload->initialize($config);

                if (!empty($_FILES['cin_image']['name'])) {
                    if (!$this->upload->do_upload('cin_image')) {
                        $error = array('error' => $this->upload->display_errors());
                        $array = array('status' => 'error', 'message' => $error['error']);
                        echo json_encode($array);
                        exit;
                    } else {
                        if ($agent && $agent->cin_image && file_exists('./uploads/images/agent/logo/' . $agent->cin_image)) {
                            unlink('./uploads/images/agent/logo/' . $agent->cin_image);
                        }
                        $cin_image = $this->upload->data('file_name');
                    }
                }


                if (!empty($_FILES['tan_image']['name'])) {
                    if (!$this->upload->do_upload('tan_image')) {
                        $error = array('error' => $this->upload->display_errors());
                        $array = array('status' => 'error', 'message' => $error['error']);
                        echo json_encode($array);
                        exit;
                    } else {
                        if ($agent && $agent->tan_image && file_exists('./uploads/images/agent/logo/' . $agent->tan_image)) {
                            unlink('./uploads/images/agent/logo/' . $agent->tan_image);
                        }
                        $tan_image = $this->upload->data('file_name');
                    }
                }


                if (!empty($_FILES['pan_image']['name'])) {
                    if (!$this->upload->do_upload('pan_image')) {
                        $error = array('error' => $this->upload->display_errors());
                        $array = array('status' => 'error', 'message' => $error['error']);
                        echo json_encode($array);
                        exit;
                    } else {
                        if ($agent && $agent->pan_image && file_exists('./uploads/images/agent/logo/' . $agent->pan_image)) {
                            unlink('./uploads/images/agent/logo/' . $agent->pan_image);
                        }
                        $pan_image = $this->upload->data('file_name');
                    }
                }


                if (!empty($_FILES['gst_image']['name'])) {
                    if (!$this->upload->do_upload('gst_image')) {
                        $error = array('error' => $this->upload->display_errors());
                        $array = array('status' => 'error', 'message' => $error['error']);
                        echo json_encode($array);
                        exit;
                    } else {
                        if ($agent && $agent->gst_image && file_exists('./uploads/images/agent/logo/' . $agent->gst_image)) {
                            unlink('./uploads/images/agent/logo/' . $agent->gst_image);
                        }
                        $gst_image = $this->upload->data('file_name');
                    }
                }

                if (!empty($_FILES['adhar_image']['name'])) {
                    if (!$this->upload->do_upload('adhar_image')) {
                        $error = array('error' => $this->upload->display_errors());
                        $array = array('status' => 'error', 'message' => $error['error']);
                        echo json_encode($array);
                        exit;
                    } else {
                        if ($agent && $agent->adhar_image && file_exists('./uploads/images/agent/logo/' . $agent->adhar_image)) {
                            unlink('./uploads/images/agent/logo/' . $agent->adhar_image);
                        }
                        $adhar_image = $this->upload->data('file_name');
                    }
                }

                $record_array = array(
                    'is_verify' => $this->input->post('is_verify'),
                    'firm_type_id' => $this->input->post('firm_type_id'),
                    'firm_name' => $this->input->post('firm_name'),
                    'address_1' => $this->input->post('address_1'),
                    'address_2' => $this->input->post('address_2'),
                    'address_3' => $this->input->post('address_3'),
                    'agent_country_id' => $this->input->post('country_id'),
                    'agent_state_id' => $this->input->post('state_id'),
                    'agent_city_id' => $this->input->post('city_id'),
                    'agent_mobile' => $this->input->post('agent_mobile'),
                    'agent_contact_no' => $this->input->post('agent_contact_no'),
                    'agent_contact_person' => $this->input->post('agent_contact_person'),
                    'agent_whatsapp_no' => $this->input->post('agent_whatsapp_no'),
                    'agent_email' => $this->input->post('agent_email'),
                    'rera_registered' => $this->input->post('rera_registered'),
                    'rera_no' => $this->input->post('rera_no'),
                    'owner_title' => $this->input->post('owner_title'),
                    'owner_first_name' => $this->input->post('owner_first_name'),
                    'owner_last_name	' => $this->input->post('owner_last_name	'),
                    'rera_dor' => $this->input->post('rera_dor'),
                    'rera_valid_till' => $this->input->post('rera_valid_till'),
                    'pan_no' => $this->input->post('pan_no'),
                    'adhar_no' => $this->input->post('adhar_no'),
                    'gst_no' => $this->input->post('gst_no'),
                    'cin_no' => $this->input->post('cin_no'),
                    'tan_no' => $this->input->post('tan_no'),
                    'agent_logo' => $agent_logo,
                    'cin_image' => $cin_image,
                    'tan_image' => $tan_image,
                    'pan_image' => $pan_image,
                    'gst_image' => $gst_image,
                    'adhar_image' => $adhar_image
                );

                $record_array['updated_at'] = time();
                $this->Action_model->update_data($record_array, 'tbl_agents', "agent_id='" . $agent->agent_id . "'");

                $this->session->set_flashdata('success_msg', 'Updated Successfully!!');
                $array = array('status' => 'success', 'message' => 'Updated Successfully!!');
            } else {
                $array = array('status' => 'error', 'message' => 'Not Found.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function update_password()
    {
        $array = array();

        if ($this->input->post()) {

            $current_password = md5($this->input->post('current_password'));

            $where = "user_hash='" . $this->session->userdata('agent_hash') . "' AND password='" . $current_password . "'";
            $user_detail = $this->Action_model->select_single('tbl_users', $where);

            $record_array = array(
                'password' => md5($this->input->post('password'))
            );

            if ($user_detail) {
                $this->Action_model->update_data($record_array, 'tbl_users', $where);
                $array = array('status' => 'success', 'message' => 'Password Updated Successfully!!');
            } else {
                $array = array('status' => 'error', 'message' => 'Invalid Current Password!!');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function update_profile()
    {
        $array = array();

        if ($this->input->post()) {

            $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
            $user_detail = $this->Action_model->select_single('tbl_users', $where);

            $record_array = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name')
            );

            if ($user_detail) {
                $this->Action_model->update_data($record_array, 'tbl_users', $where);
                $array = array('status' => 'success', 'message' => 'Profile Updated Successfully!!');
            } else {
                $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    function time_elapsed_string($ptime)
    {
        $etime = time() - $ptime;

        if ($etime < 1) {
            return '1 seconds';
        }

        $a = array(
            365 * 24 * 60 * 60  =>  'year',
            30 * 24 * 60 * 60  =>  'month',
            24 * 60 * 60  =>  'day',
            60 * 60  =>  'hour',
            60  =>  'minute',
            1  =>  'second'
        );
        $a_plural = array(
            'year'   => 'years',
            'month'  => 'months',
            'day'    => 'days',
            'hour'   => 'hours',
            'minute' => 'minutes',
            'second' => 'seconds'
        );

        foreach ($a as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
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

            $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
            $user_detail = $this->Action_model->select_single('tbl_users', $where);

            if ($user_detail) {
                $user_id = $user_detail->user_id;

                $this->Action_model->update_data(array('last_visit' => time()), 'tbl_users', "user_id='" . $user_detail->user_id . "'");

                $where = "user_status='1' AND (tbl_roles.role_id='1' OR tbl_roles.is_agent_member='1')";
                $this->db->select('tbl_users.user_id as uid,first_name,last_name,role_name,last_visit,image');
                $this->db->from('tbl_users');
                $this->db->join('tbl_roles', 'tbl_roles.role_id = tbl_users.role_id');
                $this->db->where($where);
                $query = $this->db->get();
                $chat_user_data = $query->result();

                $timestamp = time();

                $where = "(sender_id='" . $user_id . "' OR receiver_id='" . $user_id . "') ORDER BY sent_on DESC LIMIT 1";
                $this->db->select('s.first_name as s_first_name,s.last_name as s_last_name,r.first_name as r_first_name,r.last_name as r_last_name,s.image as s_image,r.image as r_image,message,sender_id,receiver_id,message,sent_on');
                $this->db->from('tbl_chats');
                $this->db->join('tbl_users as s', 's.user_id = tbl_chats.sender_id');
                $this->db->join('tbl_users as r', 'r.user_id = tbl_chats.receiver_id');
                $this->db->where($where);
                $query = $this->db->get();
                $chat_data = $query->row();

                $current_chat_user_id = 0;
                if ($chat_data && $chat_data->sender_id != $user_id) {
                    $current_chat_user_id = $chat_data->sender_id;
                } else if ($chat_data && $chat_data->receiver_id != $user_id) {
                    $current_chat_user_id = $chat_data->receiver_id;
                }

                if ($chat_user_data) {
                    $i = 0;
                    foreach ($chat_user_data as $chat_user) {
                        $status = 1;

                        if ($timestamp - ($chat_user->last_visit) > 900) {
                            $status = 0;
                        }

                        $user_image = base_url('uploads/images/user/photo/user.png');
                        if ($chat_user->image) {
                            $user_image = base_url('uploads/images/user/photo/' . $chat_user->image);
                        }

                        $chat_users[] = array('user_id' => $chat_user->uid, 'user_name' => $chat_user->first_name . ' ' . $chat_user->last_name, 'role_name' => $chat_user->role_name, 'status' => $status, 'user_image' => $user_image);

                        $i++;
                    }
                }
                $array = array('status' => 'success', 'message' => 'Data Found', 'chat_users' => $chat_users, 'chat_messages' => $chat_messages, 'current_chat_user_id' => $current_chat_user_id);
            } else {
                $array = array('status' => 'expired', 'message' => 'Your session has been expired, login to continue.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_chat_messages()
    {
        $array = array();
        $chat_messages = array();

        if ($this->input->post()) {

            $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
            $user_detail = $this->Action_model->select_single('tbl_users', $where);

            if ($user_detail) {
                $user_id = $user_detail->user_id;

                $this->Action_model->update_data(array('last_visit' => time()), 'tbl_users', "user_id='" . $user_detail->user_id . "'");

                $chat_user_id = $this->input->post('chat_user_id');

                $record_chat_user = $this->Action_model->select_single('tbl_users', "user_id='" . $chat_user_id . "'");
                $chat_status = 'online';
                $timestamp = time();
                if ($timestamp - ($record_chat_user->last_visit) > 900) {
                    $chat_status = 'offline';
                }

                $where = "((receiver_id='" . $chat_user_id . "' AND sender_id='" . $user_id . "') OR (sender_id='" . $chat_user_id . "' AND receiver_id='" . $user_id . "')) ORDER BY sent_on ASC";
                $this->db->select('s.first_name as s_first_name,s.last_name as s_last_name,r.first_name as r_first_name,r.last_name as r_last_name,s.image as s_image,r.image as r_image,message,message,sender_id,receiver_id,message,sent_on');
                $this->db->from('tbl_chats');
                $this->db->join('tbl_users as s', 's.user_id = tbl_chats.sender_id');
                $this->db->join('tbl_users as r', 'r.user_id = tbl_chats.receiver_id');
                $this->db->where($where);
                $query = $this->db->get();
                $chat_data = $query->result();

                foreach ($chat_data as $chat) {
                    $is_sender = 'no';
                    if ($chat->sender_id == $user_id) {
                        $is_sender = 'yes';
                    }

                    $user_image = base_url('uploads/images/user/photo/user.png');
                    if ($chat->sender_id == $user_id) {
                        if ($chat->s_image) {
                            $user_image = base_url('uploads/images/user/photo/' . $chat->s_image);
                        }
                    } else {
                        if ($chat->s_image) {
                            $user_image = base_url('uploads/images/user/photo/' . $chat->s_image);
                        }
                    }
                    $chat_messages[] = array('sender_id' => $chat->sender_id, 'sender_name' => $chat->s_first_name . ' ' . $chat->s_last_name, 'receiver_id' => $chat->receiver_id, 'receiver_name' => $chat->r_first_name . ' ' . $chat->r_last_name, 'message' => $chat->message, 'sent_on' => $this->time_elapsed_string($chat->sent_on), 'is_sender' => $is_sender, 'user_image' => $user_image);
                }

                $where = "user_status='1' AND (tbl_roles.role_id='1' OR tbl_roles.is_agent_member='1')";
                $this->db->select('tbl_users.user_id as uid,first_name,last_name,role_name,last_visit,image');
                $this->db->from('tbl_users');
                $this->db->join('tbl_roles', 'tbl_roles.role_id = tbl_users.role_id');
                $this->db->where($where);
                $query = $this->db->get();
                $chat_user_data = $query->result();

                $timestamp = time();

                if ($chat_user_data) {
                    $i = 0;
                    foreach ($chat_user_data as $chat_user) {
                        $status = 1;

                        if ($timestamp - ($chat_user->last_visit) > 900) {
                            $status = 0;
                        }

                        $user_image = base_url('uploads/images/user/photo/user.png');
                        if ($chat_user->image) {
                            $user_image = base_url('uploads/images/user/photo/' . $chat_user->image);
                        }

                        $chat_users[] = array('user_id' => $chat_user->uid, 'user_name' => $chat_user->first_name . ' ' . $chat_user->last_name, 'role_name' => $chat_user->role_name, 'status' => $status, 'user_image' => $user_image);

                        $i++;
                    }
                }

                $array = array('status' => 'success', 'message' => 'Data Found', 'chat_messages' => $chat_messages, 'chat_users' => $chat_users, 'chat_status' => $chat_status);
            } else {
                $array = array('status' => 'expired', 'message' => 'Your session has been expired, login to continue.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function send_message()
    {
        $array = array();

        if ($this->input->post()) {

            $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
            $user_detail = $this->Action_model->select_single('tbl_users', $where);
            $chat_user_id = $this->input->post('receiver_id');

            if ($user_detail) {
                $user_id = $user_detail->user_id;

                $this->Action_model->update_data(array('last_visit' => time()), 'tbl_users', "user_id='" . $user_detail->user_id . "'");

                $record_chat_user = $this->Action_model->select_single('tbl_users', "user_id='" . $chat_user_id . "'");
                $chat_status = 'online';
                $timestamp = time();
                if ($timestamp - ($record_chat_user->last_visit) > 900) {
                    $chat_status = 'offline';
                }

                $record_array = array(
                    'message' => $this->input->post('message'),
                    'sender_id' => $user_detail->user_id,
                    'receiver_id' => $this->input->post('receiver_id'),
                    'message' => $this->input->post('message'),
                    'sent_on' => time()
                );

                $this->Action_model->insert_data($record_array, 'tbl_chats');

                $where = "((receiver_id='" . $chat_user_id . "' AND sender_id='" . $user_id . "') OR (sender_id='" . $chat_user_id . "' AND receiver_id='" . $user_id . "')) ORDER BY sent_on ASC";
                $this->db->select('s.first_name as s_first_name,s.last_name as s_last_name,r.first_name as r_first_name,r.last_name as r_last_name,s.image as s_image,r.image as r_image,message,message,sender_id,receiver_id,message,sent_on');
                $this->db->from('tbl_chats');
                $this->db->join('tbl_users as s', 's.user_id = tbl_chats.sender_id');
                $this->db->join('tbl_users as r', 'r.user_id = tbl_chats.receiver_id');
                $this->db->where($where);
                $query = $this->db->get();
                $chat_data = $query->result();

                foreach ($chat_data as $chat) {
                    $is_sender = 'no';
                    if ($chat->sender_id == $user_id) {
                        $is_sender = 'yes';
                    }

                    $user_image = base_url('uploads/images/user/photo/user.png');
                    if ($chat->sender_id == $user_id) {
                        if ($chat->s_image) {
                            $user_image = base_url('uploads/images/user/photo/' . $chat->s_image);
                        }
                    } else {
                        if ($chat->s_image) {
                            $user_image = base_url('uploads/images/user/photo/' . $chat->s_image);
                        }
                    }

                    $chat_messages[] = array('sender_id' => $chat->sender_id, 'sender_name' => $chat->s_first_name . ' ' . $chat->s_last_name, 'receiver_id' => $chat->receiver_id, 'receiver_name' => $chat->r_first_name . ' ' . $chat->r_last_name, 'message' => $chat->message, 'sent_on' => $this->time_elapsed_string($chat->sent_on), 'is_sender' => $is_sender, 'user_image' => $user_image);
                }

                $where = "user_status='1' AND (tbl_roles.role_id='1' OR tbl_roles.is_agent_member='1')";
                $this->db->select('tbl_users.user_id as uid,first_name,last_name,role_name,last_visit,image');
                $this->db->from('tbl_users');
                $this->db->join('tbl_roles', 'tbl_roles.role_id = tbl_users.role_id');
                $this->db->where($where);
                $query = $this->db->get();
                $chat_user_data = $query->result();

                $timestamp = time();

                if ($chat_user_data) {
                    $i = 0;
                    foreach ($chat_user_data as $chat_user) {
                        $status = 1;

                        if ($timestamp - ($chat_user->last_visit) > 900) {
                            $status = 0;
                        }

                        $user_image = base_url('uploads/images/user/photo/user.png');
                        if ($chat_user->image) {
                            $user_image = base_url('uploads/images/user/photo/' . $chat_user->image);
                        }

                        $chat_users[] = array('user_id' => $chat_user->uid, 'user_name' => $chat_user->first_name . ' ' . $chat_user->last_name, 'role_name' => $chat_user->role_name, 'status' => $status, 'user_image' => $user_image);

                        $i++;
                    }
                }

                $array = array('status' => 'success', 'message' => 'Message Send Successfully!!', 'chat_messages' => $chat_messages, 'chat_users' => $chat_users, 'chat_status' => $chat_status);
            } else {
                $array = array('status' => 'expired', 'message' => 'Your session has been expired, login to continue.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    /* role start */
    public function role_list()
    {
        if ($this->input->post()) {

            $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
            $user_detail = $this->Action_model->select_single('tbl_users', $where);

            $postData = $this->input->post();
            $select = 'role_id,role_name,role_status';
            $where = '';

            $searchValue = $postData['search']['value'];
            $searchQuery = "";
            if ($searchValue != '') {
                $searchQuery = " (role_name like '%" . $searchValue . "%' ) AND (is_agent_member='1') AND user_id='" . $user_detail->user_id . "'";
            } else {
                $searchQuery .= "(is_agent_member='1') AND user_id='" . $user_detail->user_id . "'";
            }
            $data = $this->Action_model->ajaxDatatable($postData, $searchQuery, 'tbl_roles', $where, $select);

            echo json_encode($data);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
            echo json_encode($array);
        }
    }

    public function get_role()
    {
        $array = array();

        if ($this->input->post()) {
            $id = $this->input->post('id');
            $record = $this->Action_model->select_single('tbl_roles', "role_id='" . $id . "'");
            if ($record) {
                $array = array('status' => 'success', 'message' => '', 'record' => $record);
            } else {
                $array = array('status' => 'error', 'message' => 'Record Not Found.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function role_process()
    {
        $array = array();

        if ($this->input->post()) {

            $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
            $user_detail = $this->Action_model->select_single('tbl_users', $where);

            $uid = $user_detail->user_id;
            if ($user_detail->parent_id != 0) {
                $uid = $user_detail->parent_id;
            }

            $id = $this->input->post('id');
            $record = $this->Action_model->select_single('tbl_roles', "role_id='" . $id . "'");

            $record_array = array(
                'role_name' => $this->input->post('role_name'),
                'role_status' => $this->input->post('role_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_roles', "role_name='" . $this->input->post('role_name') . "' AND user_id='" . $uid . "' AND role_id!='" . $id . "'")) {
                    $array = array('status' => 'error', 'message' => 'This Role Name is already exist.');
                } else {
                    $this->Action_model->update_data($record_array, 'tbl_roles', "role_id='" . $id . "'");
                    $array = array('status' => 'added', 'message' => 'Role Updated Successfully!!');
                }
            } else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();
                $record_array['is_agent_member'] = 1;
                $record_array['user_id'] = $uid;

                if ($this->Action_model->select_single('tbl_roles', "role_name='" . $this->input->post('role_name') . "' AND user_id='" . $uid . "'")) {
                    $array = array('status' => 'error', 'message' => 'This Role Name is already exist.');
                } else {
                    $this->Action_model->insert_data($record_array, 'tbl_roles');
                    $array = array('status' => 'added', 'message' => 'Role Added Successfully!!');
                }
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function delete_role()
    {
        $array = array();

        if ($this->input->post()) {

            $id = $this->input->post('id');
            $record = $this->Action_model->select_single('tbl_roles', "role_id='" . $id . "'");

            if ($record) {
                $this->Action_model->delete_query('tbl_roles', "role_id='" . $id . "'");
                $array = array('status' => 'added', 'message' => 'Role Deleted Successfully!!');
            } else {
                $array = array('status' => 'added', 'message' => 'Record Not Found!!');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }
    /* role end */

    /* team start */
    public function team_list()
    {

        $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
        $user_detail = $this->Action_model->select_single('tbl_users', $where);

        $uid = $user_detail->user_id;
        if ($user_detail->parent_id != 0) {
            $uid = $user_detail->parent_id;
        }

        $postData = $this->input->post();
        $select = 'tbl_users.user_id,date_register,mobile,user_title,first_name,last_name,user_status,role_name,username';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (first_name like '%" . $searchValue . "%' ) AND tbl_roles.is_agent_member='1' AND tbl_users.parent_id='" . $uid . "'";
        } else {
            $searchQuery = "tbl_roles.is_agent_member='1' AND tbl_users.parent_id='" . $uid . "'";
        }
        $data = $this->Action_model->ajaxDatatable($postData, $searchQuery, 'tbl_users', $where, $select, array('tbl_roles', "tbl_roles.role_id=tbl_users.role_id"));

        echo json_encode($data);
    }

    public function get_team()
    {
        $array = array();

        if ($this->input->post()) {
            $id = $this->input->post('id');
            $record = $this->Action_model->select_single('tbl_users', "user_id='" . $id . "'");
            if ($record) {

                $user_role_id = $record->role_id;
                $account_id = getAccountId();

                $where = "";
                if ($user_role_id == 5) {
                    $where = "user_id='" . $account_id . "'";
                } else if ($user_role_id == 4) {
                    $where = "(role_id='5' AND parent_id='" . $account_id . "') OR user_id='" . $account_id . "'";
                } else if ($user_role_id == 3) {
                    $where = "((role_id='4' OR role_id='5') AND parent_id='" . $account_id . "') OR user_id='" . $account_id . "'";
                }

                if ($where) {
                    $user_data = $this->Action_model->detail_result('tbl_users', $where);

                    if ($user_data) {
                        foreach ($user_data as $item) {
                            if ($item->parent_id == 0) {
                                $name = ($item->is_individual) ? (ucwords($item->user_title . ' ' . $item->first_name . ' ' . $item->last_name)) : $item->firm_name;
                            } else {
                                $name = ucwords($item->user_title . ' ' . $item->first_name . ' ' . $item->last_name);
                            }
                            $user_list[] = array('name' => $name, 'id' => $item->user_id);
                        }
                    }
                }

                $array = array('status' => 'success', 'message' => '', 'record' => $record, 'user_list' => $user_list);
            } else {
                $array = array('status' => 'error', 'message' => 'Record Not Found.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_report_users()
    {
        $array = array();
        $user_list = array();

        if ($this->input->post()) {
            $user_role_id = $this->input->post('user_role_id');
            $account_id = getAccountId();

            $where = "";
            if ($user_role_id == 5) {
                $where = "user_id='" . $account_id . "'";
            } else if ($user_role_id == 4) {
                $where = "(role_id='5' AND parent_id='" . $account_id . "') OR user_id='" . $account_id . "'";
            } else if ($user_role_id == 3) {
                $where = "((role_id='4' OR role_id='5') AND parent_id='" . $account_id . "') OR user_id='" . $account_id . "'";
            }

            if ($where) {
                $user_data = $this->Action_model->detail_result('tbl_users', $where);
                if ($user_data) {
                    foreach ($user_data as $item) {
                        if ($item->parent_id == 0) {
                            $name = ($item->is_individual) ? (ucwords($item->user_title . ' ' . $item->first_name . ' ' . $item->last_name)) : $item->firm_name;
                        } else {
                            $name = ucwords($item->user_title . ' ' . $item->first_name . ' ' . $item->last_name);
                        }

                        $user_list[] = array('name' => $name, 'id' => $item->user_id);
                    }
                }
            }
            $array = array('status' => 'success', 'message' => 'Data Found', 'user_list' => $user_list);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function team_process()
    {
        $array = array();

        if ($this->input->post()) {

            $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
            $user_detail = $this->Action_model->select_single('tbl_users', $where);

            $uid = $user_detail->user_id;
            if ($user_detail->parent_id != 0) {
                $uid = $user_detail->parent_id;
            }

            $id = $this->input->post('id');
            $record = $this->Action_model->select_single('tbl_users', "user_id='" . $id . "'");

            $record_array = array(
                'user_title' => $this->input->post('user_title'),
                'first_name' => $this->input->post('user_first_name'),
                'last_name' => $this->input->post('user_last_name'),
                'email' => $this->input->post('user_email'),
                'username' => $this->input->post('user_user_id'),
                'mobile' => $this->input->post('user_mobile'),
                'whatsapp_no' => $this->input->post('user_whatsapp_no'),
                'role_id' => $this->input->post('user_role_id'),
                'work_time_from' => $this->input->post('work_time_from'),
                'work_time_to' => $this->input->post('work_time_to'),
                'date_register' => $this->input->post('date_register'),
                'user_status' => $this->input->post('user_status'),
                'report_to' => $this->input->post('report_to'),
                'user_hash' => md5(time()) . time() . rand(1000, 9999)
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->input->post('user_password')) {
                    $record_array['password'] = md5($this->input->post('user_password'));
                }

                $this->Action_model->update_data($record_array, 'tbl_users', "user_id='" . $id . "'");
                $array = array('status' => 'added', 'message' => 'Team Updated Successfully!!');
            } else {


                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();
                $record_array['parent_id'] = $uid;
                $record_array['email_verify'] = 1;
                $record_array['password'] = md5($this->input->post('user_password'));

                if ($this->Action_model->select_single('tbl_users', "username='" . $this->input->post('user_user_id') . "'")) {
                    $array = array('status' => 'error', 'message' => 'This Username is already exist.');
                } else if ($this->Action_model->select_single('tbl_users', "email='" . $this->input->post('user_email') . "'")) {
                    $array = array('status' => 'error', 'message' => 'This email address is already exist.');
                } else {
                    $this->Action_model->insert_data($record_array, 'tbl_users');
                    $array = array('status' => 'added', 'message' => 'Team Added Successfully!!');
                }
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function delete_team()
    {
        $array = array();

        if ($this->input->post()) {

            $id = $this->input->post('id');
            $record = $this->Action_model->select_single('tbl_users', "user_id='" . $id . "'");

            if ($record) {
                $this->Action_model->delete_query('tbl_users', "user_id='" . $id . "'");
                $array = array('status' => 'added', 'message' => 'Team Deleted Successfully!!');
            } else {
                $array = array('status' => 'added', 'message' => 'Record Not Found!!');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }
    /* team end */

    /* ticket start */
    public function ticket_list()
    {

        $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
        $user_detail = $this->Action_model->select_single('tbl_users', $where);

        if ($user_detail) {
            $user_id = $user_detail->user_id;
            $postData = $this->input->post();
            $select = 'ticket_id,ticket_title,ticket_status,created_at,ticket_track_id';
            $where = '';

            $searchValue = $postData['search']['value'];
            $searchQuery = "";
            if ($searchValue != '') {
                $searchQuery = " (ticket_title like '%" . $searchValue . "%' )  AND user_id='" . $user_id . "'";
            } else {
                $searchQuery = "user_id='" . $user_id . "'";
            }
            $data = $this->Action_model->ajaxDatatable($postData, $searchQuery, 'tbl_tickets', $where, $select);

            echo json_encode($data);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }
    }

    public function get_ticket()
    {
        $array = array();

        if ($this->input->post()) {

            $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
            $user_detail = $this->Action_model->select_single('tbl_users', $where);

            if ($user_detail) {
                $user_id = $user_detail->user_id;
                $id = $this->input->post('id');
                $record = $this->Action_model->select_single('tbl_tickets', "ticket_id='" . $id . "' AND user_id='" . $user_id . "'");
                if ($record) {
                    $array = array('status' => 'success', 'message' => '', 'record' => $record);
                } else {
                    $array = array('status' => 'error', 'message' => 'Record Not Found.');
                }
            } else {
                $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function ticket_process()
    {
        $array = array();

        if ($this->input->post()) {

            $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
            $user_detail = $this->Action_model->select_single('tbl_users', $where);

            if ($user_detail) {
                $user_id = $user_detail->user_id;

                $id = $this->input->post('id');
                $record = $this->Action_model->select_single('tbl_tickets', "ticket_id='" . $id . "' AND user_id='" . $user_id . "'");

                $record_array = array(
                    'ticket_title' => $this->input->post('ticket_title'),
                    'ticket_message' => $this->input->post('ticket_message'),
                    'ticket_status' => $this->input->post('ticket_status')
                );

                if ($record) {
                    $record_array['updated_at'] = date("d-m-Y h:i:s a");

                    $this->Action_model->update_data($record_array, 'tbl_tickets', "ticket_id='" . $id . "'");
                    $array = array('status' => 'added', 'message' => 'Ticket Updated Successfully!!');
                } else {
                    $record_array['created_at'] = date("d-m-Y h:i:s a");
                    $record_array['updated_at'] = date("d-m-Y h:i:s a");
                    $record_array['user_id'] = $user_id;

                    $record = $this->Action_model->select_single('tbl_tickets', "ticket_id!='' ORDER BY ticket_id DESC LIMIT 1");
                    $tlast = 1;
                    if ($record) {
                        $tlast = $record->ticket_id + 1;
                    }
                    $ticket_track_id = "TK-" . str_pad($tlast, 4, '0', STR_PAD_LEFT);
                    $record_array['ticket_track_id'] = $ticket_track_id;

                    $ticket_id = $this->Action_model->insert_data($record_array, 'tbl_tickets');

                    $message_array = array(
                        'ticket_id' => $ticket_id,
                        'sender_id' => $user_id,
                        'receiver_id' => 1,
                        'ticket_message' => $this->input->post('ticket_message'),
                        'created_at' => date("d-m-Y h:i:s a")
                    );
                    $this->Action_model->insert_data($message_array, 'tbl_ticket_messages');
                    $array = array('status' => 'added', 'message' => 'Ticket Added Successfully!!');
                }
            } else {
                $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function delete_ticket()
    {
        $array = array();

        if ($this->input->post()) {

            $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
            $user_detail = $this->Action_model->select_single('tbl_users', $where);

            if ($user_detail) {
                $user_id = $user_detail->user_id;
                $id = $this->input->post('id');
                $record = $this->Action_model->select_single('tbl_tickets', "ticket_id='" . $id . "' AND user_id='" . $user_id . "'");

                if ($record) {
                    $this->Action_model->delete_query('tbl_tickets', "ticket_id='" . $id . "'");
                    $array = array('status' => 'added', 'message' => 'Ticket Deleted Successfully!!');
                } else {
                    $array = array('status' => 'added', 'message' => 'Record Not Found!!');
                }
            } else {
                $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function update_ticket_status()
    {
        $array = array();

        if ($this->input->post()) {

            $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
            $user_detail = $this->Action_model->select_single('tbl_users', $where);

            if ($user_detail) {
                $user_id = $user_detail->user_id;
                $id = $this->input->post('id');
                $ticket_status = $this->input->post('ticket_status');
                $record = $this->Action_model->select_single('tbl_tickets', "ticket_id='" . $id . "' AND user_id='" . $user_id . "'");

                if ($record) {
                    $ticket_status_label = "";
                    if ($ticket_status == 1) {
                        $ticket_status_label = "Open";
                    } else if ($ticket_status == 2) {
                        $ticket_status_label = "Closed";
                    }
                    $this->Action_model->update_data(array('ticket_status' => $ticket_status), 'tbl_tickets', "ticket_id='" . $id . "'");

                    $this->session->set_flashdata('success_msg', 'Ticket ' . $ticket_status_label . ' Successfully!!');
                    $array = array('status' => 'success', 'message' => 'Ticket ' . $ticket_status_label . ' Successfully!!');
                } else {
                    $array = array('status' => 'error', 'message' => 'Record Not Found!!');
                }
            } else {
                $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function ticket_reply()
    {
        $array = array();

        if ($this->input->post()) {

            $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
            $user_detail = $this->Action_model->select_single('tbl_users', $where);

            if ($user_detail) {
                $user_id = $user_detail->user_id;
                $id = $this->input->post('id');
                $record = $this->Action_model->select_single('tbl_tickets', "ticket_id='" . $id . "' AND user_id='" . $user_id . "'");

                if ($record) {

                    if ($record->ticket_status == 2) {

                        $array = array('status' => 'error', 'message' => 'Ticket Closed.');
                    } else {
                        $message_array = array(
                            'ticket_id' => $id,
                            'sender_id' => $user_id,
                            'receiver_id' => 1,
                            'ticket_message' => $this->input->post('ticket_message'),
                            'created_at' => date("d-m-Y h:i:s a")
                        );

                        $tm_id = $this->Action_model->insert_data($message_array, 'tbl_ticket_messages');

                        $ticket_messages = array();

                        $where = "ticket_message_id='" . $tm_id . "' AND ticket_id='" . $id . "' AND ((receiver_id='" . $user_id . "' AND sender_id='1') OR (sender_id='" . $user_id . "' AND receiver_id='1')) ORDER BY ticket_message_id ASC";
                        $this->db->select('s.first_name as s_first_name,s.last_name as s_last_name,r.first_name as r_first_name,r.last_name as r_last_name,s.image as s_image,r.image as r_image,sender_id,receiver_id,ticket_message,tbl_ticket_messages.created_at as created_at');
                        $this->db->from('tbl_ticket_messages');
                        $this->db->join('tbl_users as s', 's.user_id = tbl_ticket_messages.sender_id');
                        $this->db->join('tbl_users as r', 'r.user_id = tbl_ticket_messages.receiver_id');
                        $this->db->where($where);
                        $query = $this->db->get();
                        $ticket_message_data = $query->row();

                        if ($ticket_message_data) {
                            $user_image = base_url('uploads/images/user/photo/user.png');
                            if ($ticket_message_data->sender_id == $user_id) {
                                if ($ticket_message_data->s_image) {
                                    $user_image = base_url('uploads/images/user/photo/' . $ticket_message_data->s_image);
                                }
                            } else {
                                if ($ticket_message_data->s_image) {
                                    $user_image = base_url('uploads/images/user/photo/' . $ticket_message_data->s_image);
                                }
                            }
                            $ticket_messages = array('user_image' => $user_image, 'ticket_message' => $ticket_message_data->ticket_message, 'name' => $ticket_message_data->s_first_name . ' ' . $ticket_message_data->s_last_name, 'created_at' => $ticket_message_data->created_at);
                        }

                        $array = array('status' => 'success', 'message' => 'Ticket Reply Added Successfully!!', 'ticket_messages' => $ticket_messages);
                    }
                } else {
                    $array = array('status' => 'error', 'message' => 'Record Not Found!!');
                }
            } else {
                $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }
    /* ticket end */

    /* lead start */
    public function lead_list()
    {

        $postData = $this->input->post();
        $select = 'lead_id,lead_title,lead_first_name,lead_last_name,lead_status';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (lead_name like '%" . $searchValue . "%' ) ";
        }
        $data = $this->Action_model->ajaxDatatable($postData, $searchQuery, 'tbl_leads', $where, $select);

        echo json_encode($data);
    }

    public function get_lead()
    {

        $account_id = getAccountId();

        if ($account_id && $this->input->post()) {
            $id = $this->input->post('id');

            $where = "lead_id='" . $id . "' AND account_id='" . $account_id . "'";

            $this->db->select("*");
            $this->db->from('tbl_leads');
            $this->db->join('tbl_states', 'tbl_states.state_id = tbl_leads.lead_state_id', 'left');
            $this->db->join('tbl_city', 'tbl_city.city_id = tbl_leads.lead_city_id', 'left');
            $this->db->join('tbl_occupations', 'tbl_occupations.occupation_id = tbl_leads.lead_occupation_id', 'left');
            $this->db->join('tbl_lead_types', 'tbl_lead_types.lead_type_id = tbl_leads.lead_status', 'left');
            $this->db->join('tbl_lead_stages', 'tbl_lead_stages.lead_stage_id = tbl_leads.lead_stage_id', 'left');
            $this->db->join('tbl_lead_sources', 'tbl_lead_sources.lead_source_id = tbl_leads.lead_source_id', 'left');
            $this->db->join('tbl_designations', 'tbl_designations.designation_id = tbl_leads.lead_designation', 'left');
            $this->db->where($where);
            $query = $this->db->get();
            $record = $query->row();

            if ($record) {
                $data['record'] = $record;

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

                $this->load->view(AGENT_URL . 'get_lead', $data);
            } else {
                echo 'error';
            }
        } else {
            echo 'error';
        }
    }

    public function lead_process()
    {

        $array = array();

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

        if ($user_detail && $this->input->post()) {

            $id             =   $this->input->post('id');
            $record         =   $this->Action_model->select_single('tbl_leads', "lead_id='" . $id . "'");

            # Init
            $primary_mobile_number_country_data                 =   $this->input->post('primary_mobile_number_country_data');
            $secondary_mobile_number_country_data               =   $this->input->post('secondary_mobile_number_country_data');
            $location_id                                        =   $this->input->post('location_id');

            # Profile
            $profile     = upload_file('profile', 'profile', $this->input->post('old_profile'));
            # End Profile

            # End Init

            $record_array           =   array(
                'lead_title'                                 => $this->input->post('lead_title'),
                'lead_first_name'                            => $this->input->post('lead_first_name'),
                'lead_last_name'                             => $this->input->post('lead_last_name'),
                'lead_date'                                  => $this->input->post('lead_date'),
                'lead_time'                                  => $this->input->post('lead_time'),
                'lead_mobile_no_2'                           => $this->input->post('lead_mobile_no_2'),
                'lead_address'                               => $this->input->post('lead_address'),
                'lead_state_id'                              => $this->input->post('lead_state_id'),
                'lead_city_id'                               => $this->input->post('lead_city_id'),
                'lead_occupation_id'                         => $this->input->post('lead_occupation_id'),
                'lead_department_id'                         => $this->input->post('lead_department_id'),
                'lead_dob'                                   => $this->input->post('lead_dob'),
                'lead_doa'                                   => $this->input->post('lead_doa'),
                'lead_source_id'                             => $this->input->post('lead_source_id'),
                'lead_stage_id'                              => $this->input->post('lead_stage_id'),
                'lead_status'                                => $this->input->post('lead_status'),
                'user_id'                                    => $user_id,
                'added_by'                                   => $user_id,
                'account_id'                                 => $account_id,
                'lead_pan_no'                                => $this->input->post('lead_pan_no'),
                'lead_adhar_no'                              => $this->input->post('lead_adhar_no'),
                'lead_voter_id'                              => $this->input->post('lead_voter_id'),
                'lead_passport_no'                           => $this->input->post('lead_passport_no'),
                'lead_gender'                                => $this->input->post('lead_gender'),
                'lead_marital_status'                        => $this->input->post('lead_marital_status'),
                'lead_designation'                           => $this->input->post('lead_designation'),
                'lead_company'                               => $this->input->post('lead_company'),
                'lead_annual_income'                         => $this->input->post('lead_annual_income'),

                'primary_mobile_number_country_data'         => $primary_mobile_number_country_data,
                'secondary_mobile_number_country_data'       => $secondary_mobile_number_country_data,
                'location_id'                                => $this->input->post('location_id'),
                'profile'                                    => $profile->file_name ?? '',
            );

            if ($record) {

                if ($this->Action_model->select_single('tbl_leads', "lead_mobile_no='" . $this->input->post('lead_mobile_no') . "' AND account_id='" . $account_id . "' AND lead_id!='" . $id . "'")) {
                    $array = array('status' => 'error', 'message' => 'Mobile No Already Exist.');
                    echo json_encode($array);
                    exit;
                }

                $record_array['lead_mobile_no'] = $this->input->post('lead_mobile_no');

                $record_array['updated_at'] = time();

                $this->Action_model->update_data($record_array, 'tbl_leads', "lead_id='" . $id . "'");
                //$this->session->set_flashdata('success_msg', 'Lead Updated Successfully!!');

                # Fetch Fresh Record
                $lead               = $this->lead($id);
                # Fetch Fresh Record

                $array = array('status' => 'updated', 'message' => 'Lead Updated Successfully!!', 'data' => $lead);
            } else {

                // if($this->Action_model->select_single('tbl_leads',"lead_email='".$this->input->post('lead_email')."' AND account_id='".$account_id."'")){
                //     $array = array('status'=>'error','message'=>'Email Already Exist.');
                //     echo json_encode($array);
                //     exit;
                // }

                if ($this->Action_model->select_single('tbl_leads', "lead_mobile_no='" . $this->input->post('lead_mobile_no') . "' AND account_id='" . $account_id . "'")) {
                    $array = array('status' => 'error', 'message' => 'Mobile No Already Exist.');
                    echo json_encode($array);
                    exit;
                }

                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();
                $record_array['lead_email'] = $this->input->post('lead_email');
                $record_array['lead_mobile_no'] = $this->input->post('lead_mobile_no');


                $lead_id = $this->Action_model->insert_data($record_array, 'tbl_leads');

                $lead_history_array = array(
                    'title' => 'Lead Created',
                    'description' => 'Lead created by ' . $this->Action_model->get_name($user_id),
                    'lead_id' => $lead_id,
                    'created_at' => time(),
                    "account_id" => $account_id,
                    "user_id" => $user_id
                );
                $this->Action_model->insert_data($lead_history_array, 'tbl_lead_history');

                $this->session->set_flashdata('success_msg', 'Lead Added Successfully!!');
                $array = array('status' => 'added', 'message' => 'Lead Added Successfully!!');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function delete_lead()
    {
        $array = array();

        $account_id = getAccountId();

        if ($account_id && $this->input->post()) {

            $id = $this->input->post('id');
            $record = $this->Action_model->select_single('tbl_leads', "lead_id='" . $id . "' AND account_id='" . $account_id . "'");

            if ($record) {
                $this->Action_model->delete_query('tbl_leads', "lead_id='" . $id . "'");
                $array = array('status' => 'added', 'message' => 'Lead Deleted Successfully!!');
            } else {
                $array = array('status' => 'added', 'message' => 'Record Not Found!!');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_lead_list()
    {



        $array = array();

        if ($this->input->post()) {

            $account_id = getAccountId();

            if ($account_id) {
                $filter_by = $this->input->post('filter_by');
                $page = $this->input->post('page');

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
                $start = ($page - 1) * $limit;

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

                $this->db->select("count(tbl_leads.lead_id) as total_records,CONCAT(lead_first_name, ' ', lead_last_name) AS 'lead_name'");
                $this->db->from('tbl_leads');
                $this->db->join('tbl_requirements', 'tbl_requirements.lead_id = tbl_leads.lead_id', 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $record_all = $query->row();

                $total_records = 0;
                if ($record_all) {
                    $total_records = $record_all->total_records;
                    $total_pages = ceil($total_records / $limit);
                }


                $where = "tbl_leads.account_id='" . $account_id . "' AND added_to_followup='0' AND is_customer='0'";
                $where .= $where_ids;
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

                $where .= " limit " . $start . "," . $limit;
                $this->db->select("*,tbl_leads.lead_id as lead_id,CONCAT(lead_first_name, ' ', lead_last_name) AS 'lead_name'");
                $this->db->from('tbl_leads');
                $this->db->join('tbl_requirements', 'tbl_requirements.lead_id = tbl_leads.lead_id', 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $records = $query->result();



                if ($total_pages != $page) {
                    $next_page = $page + 1;
                }
                $array = array('status' => 'success', 'message' => 'Lead Found', 'records' => $records, 'total_records' => $total_records, 'total_pages' => $total_pages, 'next_page' => $next_page, 'records' => $records);
            } else {
                $array = array('status' => 'error', 'message' => 'No Leads');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function add_to_followup()
    {

        $array = array();

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

        if ($user_detail && $this->input->post()) {
            $followup_lead_id = $this->input->post('followup_lead_id');
            $record = $this->Action_model->select_single('tbl_leads', "lead_id=$followup_lead_id");

            if ($record) {
                $record = $this->Action_model->select_single('tbl_leads', "lead_id='" . $followup_lead_id . "' AND added_to_followup='1' AND account_id='" . $account_id . "'");
                if ($record) {

                    $array = array('status' => 'error', 'message' => 'Already Added to Followup');
                } else {

                    if ($this->input->post("lead_stage_id") == 6) {
                        $inv_data = $this->Action_model->select_single('tbl_inventory', "inventory_id='" . $this->input->post("bk_inventory_id") . "' AND inventory_status='1'");
                        if ($inv_data) {
                            $check = $this->Action_model->select_single('tbl_bookings', "inventory_id='" . $this->input->post("bk_inventory_id") . "' AND (booking_status='0' || booking_status='1')");
                            if ($check) {
                                $array = array('status' => 'error', 'message' => 'Already Booked');
                                echo json_encode($array);
                                exit;
                            }
                        } else {
                            $array = array('status' => 'error', 'message' => 'Not available for booking.');
                            echo json_encode($array);
                            exit;
                        }
                    }

                    $lead_status_id = "";
                    if ($this->input->post("lead_status_id")) {
                        $lead_status_id = $this->input->post("lead_status_id");
                    }

                    if ($this->input->post("lead_stage_id") == 7) {
                        $lead_status_id = 2;
                    }
                    if ($this->input->post("lead_stage_id") == 6) {
                        $lead_status_id = 3;
                    }

                    $this->Action_model->update_data(array('lead_status' => $lead_status_id, 'lead_stage_id' => $this->input->post("lead_stage_id"), 'added_to_followup' => 1, 'followup_date' => date("d-m-Y")), 'tbl_leads', "lead_id='" . $followup_lead_id . "' AND account_id='" . $account_id . "'");

                    $next_followup_date = "";
                    $next_followup_time = "";
                    $project_id = "";
                    $next_action = "";
                    $task_desc = "";

                    if ($this->input->post("next_followup_date")) {
                        $next_followup_date = $this->input->post("next_followup_date");
                    }
                    if ($this->input->post("next_followup_time")) {
                        // $next_followup_time = $this->input->post("next_followup_time");
                        $next_followup_time = str_replace(['am', 'pm'], ['', ''], $this->input->post('next_followup_time'));
                    }
                    if ($this->input->post("project_id")) {
                        $project_id = $this->input->post("project_id");
                    }
                    if ($this->input->post("next_action")) {
                        $next_action = $this->input->post("next_action");
                    }
                    if ($this->input->post("task_desc")) {
                        $task_desc = $this->input->post("task_desc");
                    }


                    $followup_array = array(
                        "lead_stage_id" => $this->input->post("lead_stage_id"),
                        "lead_status_id" => $lead_status_id,
                        "comment" => null,
                        "next_followup_date" => $next_followup_date,
                        "next_followup_time" => $next_followup_time,
                        "project_id" => $project_id,
                        "next_action" => $next_action,
                        "task_desc" => $task_desc,
                        "lead_id" => $followup_lead_id,
                        "user_id" => $user_id,
                        "added_by" => $user_id,
                        "account_id" => $account_id,
                        "assign_user_id" => $this->input->post("fp_assign_to"),
                        "followup_status" => 1,
                        "created_at" => time(),
                        "updated_at" => time()
                    );


                    $followup_id = $this->Action_model->insert_data($followup_array, 'tbl_followup');

                    $lead_history_array = array(
                        'title' => 'Lead Added To Followup',
                        'description' => 'Lead added to followup and assign to ' . $this->Action_model->get_name($this->input->post("fp_assign_to")) . ' by ' . $this->Action_model->get_name($user_id),
                        'lead_id' => $followup_lead_id,
                        'created_at' => time(),
                        "account_id" => $account_id,
                        "user_id" => $user_id
                    );
                    $this->Action_model->insert_data($lead_history_array, 'tbl_lead_history');

                    //site visit
                    $prject_names = array();
                    if ($this->input->post("next_action") == 2 && $this->input->post("fp_project_id")) {
                        $fp_project = $this->input->post("fp_project_id");
                        foreach ($fp_project as $rowItem) {

                            $recordProject = $this->Action_model->select_single('tbl_products', "product_id='" . $rowItem . "'", "project_name");
                            if ($recordProject) {
                                $prject_names[] = $recordProject->project_name;
                            }

                            $sv_array = array(
                                "lead_id" => $followup_lead_id,
                                "project_id " => $rowItem,
                                "visit_date " => $this->input->post("next_followup_date"),
                                "visit_time " => $this->input->post("next_followup_time"),
                                "attend_by" => '',
                                "site_visit_status" => 1,
                                "interested " => 0,
                                "comment" => null,
                                "account_id" => $account_id,
                                "added_by" => $user_id,
                                "user_id" => $user_id,
                                "assign_to" => $this->input->post("fp_assign_to"),
                                "created_at" => time()
                            );

                            $this->Action_model->insert_data($sv_array, 'tbl_site_visit');

                            $lead_history_array = array(
                                'title' => 'Site Visit',
                                'description' => 'Site Visit assign to ' . $this->Action_model->get_name($this->input->post("fp_assign_to")) . ' by ' . $this->Action_model->get_name($user_id),
                                'lead_id' => $followup_lead_id,
                                'created_at' => time(),
                                "account_id" => $account_id,
                                "user_id" => $user_id
                            );
                            $this->Action_model->insert_data($lead_history_array, 'tbl_lead_history');
                        }


                        if ($this->input->post("lead_stage_id") == 4) {


                            $recordLead = $this->Action_model->select_single('tbl_leads', "lead_id='" . $followup_lead_id . "'", "lead_mobile_no,lead_id");

                            if ($recordLead) {
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

                                $s_account_id = $account_id;
                                $s_team_user_id = $user_id;
                                $s_customer_id = $recordLead->lead_id;
                                $s_mobile = $recordLead->lead_mobile_no;
                                $project_name = ($prject_names) ? implode(", ", $prject_names) : "";

                                $where_agent = "user_id='" . $s_account_id . "'";
                                $agent_detail = $this->Action_model->select_single('tbl_users', $where_agent);

                                if ($agent_detail->no_of_sms) {


                                    $s_message = "Hi! Thank you for confirming your appointment @ " . $this->input->post("next_followup_time") . " on " . $this->input->post("next_followup_date") . " to visit the " . $project_name . ". for any assistance call us @ " . $this->Action_model->get_name($this->input->post("fp_assign_to"));

                                    $sms_response = $this->Action_model->sendMobileSMS($s_mobile, $s_message, true);
                                    if ($sms_response) {
                                        $sms_response_array = json_decode($sms_response);
                                        if ($sms_response_array && isset($sms_response_array->status) && $sms_response_array->status == "success") {



                                            $sms_before = $agent_detail->no_of_sms;
                                            $net_no_of_sms = $sms_before - 1;
                                            $sms_after = $net_no_of_sms;

                                            $user_data = array(
                                                'no_of_sms' => $net_no_of_sms
                                            );

                                            $this->Action_model->update_data($user_data, 'tbl_users', $where_agent);

                                            $sms_credit_array = array(
                                                'account_id' => $s_account_id,
                                                'team_user_id' => $s_team_user_id,
                                                'customer_id' => $s_customer_id,
                                                'sms_before' => $sms_before,
                                                'sms_after' => $sms_after,
                                                'mobile' => $s_mobile,
                                                'message' => $s_message,
                                                'create_at' => date("d-m-Y H:i:s A")
                                            );

                                            $this->Action_model->insert_data($sms_credit_array, 'tbl_sms_history');
                                        }
                                    }
                                }
                            }
                        }
                    }
                    //site visit end

                    // booking
                    if ($this->input->post("lead_stage_id") == 6) {

                        $this->Action_model->update_data(array('followup_status' => 2), 'tbl_followup', "followup_id='" . $followup_id . "' AND account_id='" . $account_id . "'");

                        $where = "inventory_id='" . $this->input->post("bk_inventory_id") . "'";
                        $inv_data = $this->Action_model->select_single('tbl_inventory', $where);

                        if ($inv_data) {
                            $data_array = array(
                                'inventory_status' => '2', 'last_update' => time()
                            );
                            $this->Action_model->update_data($data_array, 'tbl_inventory', $where);

                            $check = $this->Action_model->select_single('tbl_bookings', "inventory_id='" . $this->input->post("bk_inventory_id") . "'");
                            if (!$check) {
                                $bk_size = "";
                                if ($this->input->post("bk_size")) {
                                    $bk_size = $this->input->post("bk_size");
                                    $bk_size = explode("##", $bk_size);
                                    $bk_size = $bk_size[0];
                                }

                                $bk_unit_no = "";
                                if ($this->input->post("bk_unit_no")) {
                                    $bk_unit_no = $this->input->post("bk_unit_no");
                                    $bk_unit_no = explode("##", $bk_unit_no);
                                    $bk_unit_no = $bk_unit_no[0];
                                }

                                $bk_array = array(
                                    "customer_name" => $this->input->post("bk_customer_name"),
                                    "dob" => $this->input->post("bk_dob"),
                                    "sdw" => $this->input->post("bk_sdw"),
                                    "sdw_title" => $this->input->post("bk_sdw_title"),
                                    "unit_no" => $bk_unit_no,
                                    "unit_ref_no" => $this->input->post("bk_unit_ref_no"),
                                    "address" => $this->input->post("bk_address"),
                                    "state_id" => $this->input->post("bk_state_id"),
                                    "city_id" => $this->input->post("bk_city_id"),
                                    "project_id" => $this->input->post("bk_project_id"),
                                    "tower" => $this->input->post("bk_tower"),
                                    "floor" => $this->input->post("bk_floor"),
                                    "size" => $bk_size,
                                    "accommodation" => $this->input->post("bk_accommodation"),
                                    "product_unit_detail_id" => $this->input->post("bk_product_unit_detail_id"),
                                    "inventory_id" => $this->input->post("bk_inventory_id"),
                                    "deal_amount" => $this->input->post("bk_deal_amount"),
                                    "booking_amount" => $this->input->post("bk_booking_amount"),
                                    "payment_mode" => $this->input->post("bk_payment_mode"),
                                    "cheque_no" => $this->input->post("bk_cheque_no"),
                                    "drawn_on" => $this->input->post("bk_drawn_on"),
                                    "booking_date" => $this->input->post("bk_booking_date"),
                                    "remark" => $this->input->post("bk_remark")
                                );

                                $bk_array['account_id'] = $account_id;
                                $bk_array['user_id'] = $user_id;
                                $bk_array['lead_id'] = $followup_lead_id;
                                $bk_array['created_at'] = time();

                                $this->Action_model->insert_data($bk_array, 'tbl_bookings');
                            }
                        }
                    }
                    // booking end

                    $array = array('status' => 'success', 'message' => 'Lead Added to Followup Successfully!!');
                }
            } else {
                $array = array('status' => 'error', 'message' => 'Lead Not Found!!');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }
    /* lead end */

    /* followup start */
    public function get_followup_list()
    {

        //  echo $menu_item_array['leads']['rr_view']; die;

        $array = array();

        if ($this->input->post()) {

            $account_id = getAccountId();
            $agent = $this->getAgent();
            $user_id = $agent->user_id ?? 0;

            $where          = "user_hash='" . $this->session->userdata('agent_hash') . "'";
            $user_detail    = $this->Action_model->select_single('tbl_users', $where);




            // echo '<pre>';
            // print_r($user_detail); die;

            $account_id = $user_detail->user_id;

            if ($account_id) {
                $filter_by = $this->input->post('filter_by');
                $page = $this->input->post('page');

                $search_text = $this->input->post('search_text');

                $search_date_from = $this->input->post('search_date_from');
                $search_date_to = $this->input->post('search_date_to');

                # Lead Filter
                $lead_from = $this->input->post('lead_from');
                $lead_to = $this->input->post('lead_to');
                # End Lead Filter

                # Followup Filter
                $followup_from = $this->input->post('followup_from');
                $followup_to = $this->input->post('followup_to');
                # End Followup Filter

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
                $start = ($page - 1) * $limit;

                // echo '<pre>';
                // print_r($user_detail); die;

                // $where = "tbl_leads.account_id='".$account_id."' AND added_to_followup='1' AND tbl_leads.lead_status='1' AND is_customer='0'";

                if ($user_detail->role_id < 3 || $user_detail->role_id == 5) {

                    if ($user_detail->parent_id == 0) {
                        $where = "tbl_leads.lead_status='1' AND is_customer ='0' AND tbl_leads.account_id='" . $account_id . "'";
                    } else {
                        $where = "tbl_leads.lead_status='1' AND is_customer ='0' AND tbl_leads.user_id='" . $account_id . "'";
                    }
                } else {

                    $where = "tbl_leads.user_id='" . $account_id . "' AND tbl_leads.lead_status='1' AND is_customer='0'";
                }

                // echo $account_id; die;

                $where_ids = "";
                $user_ids = $this->get_level_user_ids();


                // if (count($user_ids)) {
                //     $where_ids .= " AND ((tbl_followup.user_id='" . implode("' OR tbl_followup.user_id='", $user_ids) . "')  OR (tbl_followup.assign_user_id='" . implode("' OR tbl_followup.assign_user_id='", $user_ids) . "'))";

                // }

                if ($search_agent_id) {
                    $where_ids .= " AND (tbl_followup.user_id='" . $search_agent_id . "')";
                }

                $where .= $where_ids;
                $where_ext = "";
                if ($search_text) {
                    $where_ext .= " AND (lead_mobile_no LIKE '%" . $search_text . "%' OR lead_email LIKE '%" . $search_text . "%' OR CONCAT(lead_title, ' ', lead_first_name, ' ', lead_last_name) LIKE '%" . $search_text . "%')";
                }

                if ($lead_from && !$lead_to) {
                    $where_ext .= " AND DATE(STR_TO_DATE(tbl_leads.lead_date, '%d-%m-%Y')) >= '$lead_from'";
                }

                if ($lead_from && $lead_to) {
                    $where_ext .= " AND DATE(STR_TO_DATE(tbl_leads.lead_date, '%d-%m-%Y')) BETWEEN '$lead_from' AND '$lead_to'";
                }

                if ($followup_from && !$followup_to) {
                    $where_ext .= " AND DATE(STR_TO_DATE(tbl_leads.followup_date, '%d-%m-%Y')) >= '$followup_from'";
                }

                if ($followup_from && $followup_to) {

                    $where_ext .= " AND DATE(STR_TO_DATE(tbl_leads.followup_date, '%d-%m-%Y')) BETWEEN '$followup_from' AND '$followup_to'";
                }

                if ($search_state_id) {
                    $where_ext .= " AND lead_state_id='" . $search_state_id . "'";
                }

                if ($search_city_id) {
                    $where_ext .= " AND lead_city_id='" . $search_city_id . "'";
                }

                if ($search_source_id) {
                    $where_ext .= " AND tbl_leads.lead_source_id='" . $search_source_id . "'";
                }

                if ($search_stage_id) {
                    $where_ext .= " AND tbl_leads.lead_stage_id='" . $search_stage_id . "'";
                }
                if ($search_status) {
                    $where_ext .= " AND tbl_leads.lead_status='" . $search_status . "'";
                }

                if ($search_location_id) {
                    $where_ext .= " AND tbl_leads.location_id='" . $search_location_id . "'";
                    // $where_ext .= " AND FIND_IN_SET(" . $search_location_id . ",location)";
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

                // $where .= " GROUP BY tbl_followup.lead_id";
                // $where .= " GROUP BY tbl_leads.lead_id";

                # Sorting
                switch ($filter_by):
                    case 'due_followup':
                        $where .= " and tbl_leads.added_to_followup = 1";
                        $where .= " GROUP BY tbl_leads.lead_id";
                        $where .= " ORDER BY DATE(STR_TO_DATE(`followup_date`, '%d-%m-%Y')) DESC , next_followup_time DESC";
                        break;

                    case 'new_leads':
                        $where .= " and tbl_leads.added_to_followup = 0";
                        $where .= " GROUP BY tbl_leads.lead_id";
                        $where .= " ORDER BY DATE(STR_TO_DATE(`lead_date`, '%d-%m-%Y')) DESC, lead_time DESC";
                        break;
                    default:
                        $where .= " GROUP BY tbl_leads.lead_id";
                        break;
                endswitch;
                # End Sorting

                $this->db->select("count(tbl_leads.lead_id) as total_records");
                // $this->db->select("count(tbl_followup.lead_id) as total_records");
                // $this->db->from('tbl_followup');
                // $this->db->join('tbl_leads', 'tbl_leads.lead_id = tbl_followup.lead_id');
                // $this->db->join('tbl_requirements', 'tbl_requirements.lead_id = tbl_leads.lead_id','left');
                // $this->db->where($where);
                // $query = $this->db->get();
                // $this->db->join("tbl_lead_transfer","tbl_lead_transfer.transfer_to=tbl_leads.user_id");
                $this->db->join('tbl_followup', 'tbl_followup.followup_id = tbl_leads.user_id', 'left');
                $this->db->where($where);
                $query = $this->db->get('tbl_leads');
                $record_all = $query->result();

                // print_r($record_all);
                // die;
                // echo $where.'<br>';

                // echo count($record_all); die;

                $total_records = 0;
                if ($record_all) {
                    $total_records = count($record_all); // $record_all->total_records;
                    $total_pages = ceil($total_records / $limit);
                }


                // $where = "tbl_leads.lead_status='1' AND is_customer='0'";

                if ($user_detail->role_id < 3 || $user_detail->role_id == 5) {

                    if ($user_detail->parent_id == 0) {
                        $where = "tbl_leads.lead_status='1' AND is_customer ='0' AND tbl_leads.account_id='" . $account_id . "'";
                    } else {
                        $where = "tbl_leads.lead_status='1' AND is_customer ='0' AND tbl_leads.user_id='" . $account_id . "'";
                    }
                } else {
                    $where = "tbl_leads.user_id='" . $account_id . "' AND tbl_leads.lead_status='1' AND is_customer='0'";
                }
                $where_ids = "";
                $user_ids = $this->get_level_user_ids();

                $where .= $where_ids;

                $where .= $where_ext;

                # Sorting
                switch ($filter_by):
                    case 'due_followup':
                        $where .= " and tbl_leads.added_to_followup = '1'";
                        $where .= " GROUP BY tbl_leads.lead_id";
                        // $where .= " ORDER BY DATE(STR_TO_DATE(tbl_followup.next_followup_date, '%d-%m-%Y')) desc , tbl_followup.next_followup_time DESC";
                        $where .= " ORDER BY DATE(STR_TO_DATE(tbl_followup.next_followup_date, '%d-%m-%Y')) desc , tbl_followup.next_followup_time DESC";
                        break;

                    case 'new_leads':
                        $where .= " and tbl_leads.added_to_followup = 0";
                        $where .= " GROUP BY tbl_leads.lead_id";
                        $where .= " ORDER BY DATE(STR_TO_DATE(`lead_date`, '%d-%m-%Y')) DESC, lead_time DESC";
                        break;
                    default:
                        $where .= " GROUP BY tbl_leads.lead_id";
                        break;
                endswitch;
                # End Sorting


                $where .= " limit " . $start . "," . $limit;

                $profile_base_url           =   base_url('public/other/profile/');

                $this->db->select(
                    "tbl_leads.*, 
                                    CONCAT(user.user_title, user.first_name, user.last_name) as assgin_user_full_name, 
                                    stages.lead_stage_name as stage_name, 
                                    lead_source.lead_source_name,
                                    concat(tbl_leads.profile) as full_profile_url,
                                    tbl_followup.next_followup_date,
                                    tbl_followup.next_followup_time"
                );

                //  echo $where; die;               

                $this->db->where($where);
                $this->db->join('tbl_lead_sources as lead_source', 'lead_source.lead_source_id = tbl_leads.lead_source_id', 'left');
                $this->db->join('tbl_lead_stages as stages', 'stages.lead_stage_id = tbl_leads.lead_stage_id', 'left');
                $this->db->join('tbl_users as user', 'user.user_id = tbl_leads.user_id', 'left');
                // $this->db->join('tbl_followup', 'tbl_followup.lead_id = tbl_leads.lead_id', 'left');
                $this->db->join('(SELECT * FROM tbl_followup WHERE followup_id IN (SELECT MAX(followup_id) FROM tbl_followup GROUP BY lead_id)) as tbl_followup', 'tbl_followup.lead_id = tbl_leads.lead_id', 'left');

                $query = $this->db->get('tbl_leads');

                $record_data = $query->result();

                // print_r($this->db->last_query());
                // // print_r($record_data);
                // die;

                $records = array();
                if ($record_data) {
                    foreach ($record_data as $item) {

                        $lead_or_next_followp_date                  =   $item->next_followup_date ? date('d-m-Y', strtotime($item->next_followup_date)) : ($item->lead_date ? date('d-m-Y', strtotime($item->lead_date)) : 'N/A');

                        $lead_or_next_followp_time                  =   $item->next_followup_time ? $item->next_followup_time : ($item->lead_time ? date('H:i', strtotime($item->lead_time)) : 'N/A');

                        $records[] = array(
                            'lead_id'                               => $item->lead_id,
                            'lead_title'                            => $item->lead_title,
                            'lead_first_name'                       => $item->lead_first_name,
                            'lead_last_name'                        => $item->lead_last_name,
                            'lead_mobile_no'                        => $item->lead_mobile_no,
                            'lead_stage_name'                       => $item->lead_stage_name ?? '',
                            'lead_source_name'                      => $item->lead_source_name ?? 'N/A',
                            'lead_email'                            => $item->lead_email,
                            'is_followup'                           => $item->added_to_followup,
                            'assgin_user_full_name'                 => $item->assgin_user_full_name,
                            'stage_name'                            => $item->stage_name ?? 'N/A',
                            'full_profile_url'                      => $item->full_profile_url ? ($profile_base_url . $item->full_profile_url) : base_url('public/front/user.png'),
                            'lead_or_next_followp_date'             => $lead_or_next_followp_date,
                            'lead_or_next_followp_time'             => $lead_or_next_followp_time,
                            'lead_or_next_followp_date_and_time'    => $lead_or_next_followp_date . ' ( ' . $lead_or_next_followp_time . ' )'
                        );
                    }
                }

                if ($total_pages != $page) {
                    $next_page = $page + 1;
                }

                $array = array('status' => 'success', 'message' => 'Lead Found', 'records' => $records, 'total_records' => $total_records, 'total_pages' => $total_pages, 'next_page' => $next_page, 'records' => $records);
            } else {
                $array = array('status' => 'error', 'message' => 'No Leads');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_followup()
    {

        $account_id = getAccountId();

        $where          = "user_hash='" . $this->session->userdata('agent_hash') . "'";
        $user_detail    = $this->Action_model->select_single('tbl_users', $where);

        $account_id  =  $user_detail->user_id;

        if ($account_id && $this->input->post()) {

            $id = $this->input->post('id');

            // echo $id ; die;

            $where = "lead_id=$id";
            $profile_base_url           =   base_url('public/other/profile/');
            $this->db->select("*, concat('$profile_base_url' , tbl_leads.profile) as full_profile_url , tbl_leads.profile");
            $this->db->from('tbl_leads');
            $this->db->join('tbl_states', 'tbl_states.state_id = tbl_leads.lead_state_id', 'left');
            $this->db->join('tbl_city', 'tbl_city.city_id = tbl_leads.lead_city_id', 'left');
            $this->db->join('tbl_occupations', 'tbl_occupations.occupation_id = tbl_leads.lead_occupation_id', 'left');
            $this->db->join('tbl_lead_stages', 'tbl_lead_stages.lead_stage_id = tbl_leads.lead_stage_id', 'left');
            $this->db->join('tbl_lead_sources', 'tbl_lead_sources.lead_source_id = tbl_leads.lead_source_id', 'left');
            $this->db->join('tbl_lead_types', 'tbl_lead_types.lead_type_id = tbl_leads.lead_status', 'left');
            $this->db->join('tbl_users', 'tbl_users.user_id = tbl_leads.user_id', 'left');
            $this->db->join('tbl_designations', 'tbl_designations.designation_id = tbl_leads.lead_designation', 'left');
            $this->db->where($where);
            $query = $this->db->get();
            $record = $query->row();

            // print_r($record); die;

            if ($record) {
                $next_followup = "";
                $next_followup_date = "";

                $where = "lead_id='" . $record->lead_id . "' ORDER BY followup_id DESC LIMIT 1";
                $this->db->select('au.first_name as au_first_name,au.last_name as au_last_name,next_followup_date,next_followup_time');
                $this->db->from('tbl_followup');
                $this->db->join('tbl_users as au', 'au.user_id = tbl_followup.assign_user_id', 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $followup_detail = $query->row();
                if ($followup_detail && $followup_detail->next_followup_date) {
                    $next_followup = "<i class='fa fa-clock-o'></i> " . $followup_detail->next_followup_date . " ( " . $followup_detail->next_followup_time . " ) &nbsp; <i class='fa fa-bookmark'></i> " . $followup_detail->au_first_name . ' ' . $followup_detail->au_last_name;
                    $next_followup_date = $followup_detail->next_followup_date . "<br>" . $followup_detail->next_followup_time;
                }

                $data['record'] = $record;
                $data['next_followup'] = $next_followup;
                $data['next_followup_date'] = $next_followup_date;



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

                // echo '<pre>';
                // print_r($data); die;

                $this->load->view(AGENT_URL . 'get_followup', $data);
            } else {
                echo 'error';
            }
        } else {
            echo 'error';
        }
    }

    public function get_locations()
    {
        $array = array();
        $location_list = array();

        if ($this->input->post()) {
            $city_id = $this->input->post('city_id');
            $where = "city_id='" . $city_id . "' AND location_status='1'";
            $location_data = $this->Action_model->detail_result('tbl_locations', $where, 'location_id,location_name');
            if ($location_data) {
                $location_list = $location_data;
            }
            $array = array('status' => 'success', 'message' => 'Data Found', 'location_list' => $location_list);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_unit_types()
    {
        $array = array();
        $unit_type_list = array();

        if ($this->input->post()) {
            $product_type_id = $this->input->post('product_type_id');
            $where = "product_type_id='" . $product_type_id . "' AND unit_type_status='1'";
            $unit_type_data = $this->Action_model->detail_result('tbl_unit_types', $where, 'unit_type_id,unit_type_name');
            if ($unit_type_data) {
                $unit_type_list = $unit_type_data;
            }
            $array = array('status' => 'success', 'message' => 'Data Found', 'unit_type_list' => $unit_type_list);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }


    public function add_requirement()
    {
        $array = array();

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

        if ($user_detail && $this->input->post()) {

            $id = $this->input->post('id');
            $record = $this->Action_model->select_single('tbl_requirements', "requirement_id='" . $id . "' AND account_id='" . $account_id . "'");

            $location = $this->input->post('location');
            if ($location) {
                $location = implode(",", $location);
            }

            $record_array = array(
                'look_for' => $this->input->post('look_for'),
                'product_type_id' => $this->input->post('product_type_id'),
                'unit_type_id' => $this->input->post('unit_type_id'),
                'accomodation_id' => $this->input->post('accomodation_id'),
                'state_id' => $this->input->post('state_id'),
                'city_id' => $this->input->post('city_id'),
                'location' => $location,
                'budget_min' => $this->input->post('budget_min'),
                'budget_max' => $this->input->post('budget_max'),
                'size_min' => $this->input->post('size_min'),
                'size_max' => $this->input->post('size_max'),
                'size_unit' => $this->input->post('size_unit'),
                'remark' => $this->input->post('remark'),
                'requirement_status' => $this->input->post('requirement_status')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                $this->Action_model->update_data($record_array, 'tbl_requirements', "requirement_id='" . $id . "'");

                $array = array('status' => 'added', 'message' => 'Requirement Updated Successfully!!');
            } else {
                $record_array['dor'] = date("d-m-Y");
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();
                $record_array['user_id'] = $user_id;
                $record_array['account_id'] = $account_id;
                $record_array['lead_id'] = $this->input->post('lead_id');

                $id = $this->Action_model->insert_data($record_array, 'tbl_requirements');

                $lead_history_array = array(
                    'title' => 'New Requirement',
                    'description' => 'Requirement created by ' . $this->Action_model->get_name($user_id),
                    'lead_id' => $this->input->post('lead_id'),
                    'created_at' => time(),
                    "account_id" => $account_id,
                    "user_id" => $user_id
                );
                $this->Action_model->insert_data($lead_history_array, 'tbl_lead_history');

                $array = array('status' => 'added', 'message' => 'Requirement Added Successfully!!');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_requirement()
    {
        $array = array();

        $account_id = getAccountId();
        if ($account_id && $this->input->post()) {

            $id = $this->input->post('id');
            $record = $this->Action_model->select_single('tbl_requirements', "requirement_id='" . $id . "' AND account_id='" . $account_id . "'");
            if ($record) {

                $where = "city_status=1 AND state_id='" . $record->state_id . "'";
                $city_data = $this->Action_model->detail_result('tbl_city', $where, 'city_id,city_name');
                $city_list = array();
                if ($city_data) {
                    $city_list = $city_data;
                }

                $where = "city_id='" . $record->city_id . "' AND location_status='1'";
                $location_data = $this->Action_model->detail_result('tbl_locations', $where, 'location_id,location_name');
                $location_list = array();
                if ($location_data) {
                    $location_list = $location_data;
                }

                $where = "product_type_id='" . $record->product_type_id . "'";
                $unit_type_data = $this->Action_model->detail_result('tbl_unit_types', $where, 'unit_type_id,unit_type_name');
                $unit_type_list = array();
                if ($unit_type_data) {
                    $unit_type_list = $unit_type_data;
                }

                $array = array('status' => 'success', 'message' => '', 'record' => $record, 'city_list' => $city_list, 'location_list' => $location_list, 'unit_type_list' => $unit_type_list);
            } else {
                $array = array('status' => 'error', 'message' => 'Requirement Not Found.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_requirement_list()
    {
        $array = array();
        $requirement_list = array();

        $account_id = getAccountId();

        if ($account_id && $this->input->post()) {

            $lead_id = $this->input->post('lead_id');
            $where = "lead_id='" . $lead_id . "' AND tbl_requirements.account_id='" . $account_id . "'";
            $where_ids = "";
            $user_ids = $this->get_level_user_ids();
            //if (count($user_ids)) {
            //    $where_ids .= " AND (tbl_requirements.user_id='".implode("' OR tbl_requirements.user_id='", $user_ids)."')";
            //}
            $where .= $where_ids;
            $where .= " ORDER BY requirement_id DESC";

            $this->db->select('requirement_id,lead_id,look_for,product_type_name,unit_type_name,accomodation_name,location,size_min,size_max,size_unit,remark,dor,lead_option_name as look_for,requirement_status,state_name,city_name,b_min.budget_name as budget_minimum,b_max.budget_name as budget_maximum,su.unit_name as size_unit_name,au.is_individual as au_is_individual,au.firm_name as au_firm_name,au.parent_id as au_parent_id,au.user_title as au_user_title,au.first_name as au_first_name,au.last_name as au_last_name');
            $this->db->from('tbl_requirements');
            $this->db->join('tbl_lead_options', 'tbl_lead_options.lead_option_id = tbl_requirements.look_for', 'left');
            $this->db->join('tbl_states', 'tbl_states.state_id = tbl_requirements.state_id', 'left');
            $this->db->join('tbl_city', 'tbl_city.city_id = tbl_requirements.city_id', 'left');
            $this->db->join('tbl_accomodations', 'tbl_accomodations.accomodation_id = tbl_requirements.accomodation_id', 'left');
            $this->db->join('tbl_product_types', 'tbl_product_types.product_type_id = tbl_requirements.product_type_id', 'left');
            $this->db->join('tbl_unit_types', 'tbl_unit_types.unit_type_id = tbl_requirements.unit_type_id', 'left');
            $this->db->join('tbl_units as su', 'su.unit_id = tbl_requirements.size_unit', 'left');
            $this->db->join('tbl_budgets as b_min', 'b_min.budget_id = tbl_requirements.budget_min', 'left');
            $this->db->join('tbl_budgets as b_max', 'b_max.budget_id = tbl_requirements.budget_max', 'left');
            $this->db->join('tbl_users as au', 'au.user_id = tbl_requirements.user_id', 'left');
            $this->db->where($where);
            $query = $this->db->get();
            $requirement_data = $query->result();

            if ($requirement_data) {
                //$requirement_list = $requirement_data;
                foreach ($requirement_data as $item) {
                    $location = "";
                    if ($item->location) {
                        $location_data = $this->Action_model->detail_result('tbl_locations', "location_id IN (" . $item->location . ")", 'location_name');
                        $location_list = array();
                        if ($location_data) {
                            foreach ($location_data as $item_location) {
                                $location_list[] = $item_location->location_name;
                            }

                            $location .= implode(", ", $location_list);
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
                        $look_for .= " " . $item->accomodation_name;
                    }

                    if ($item->product_type_name) {
                        $look_for .= " " . $item->product_type_name;
                    }

                    if ($item->unit_type_name) {
                        $look_for .= " " . $item->unit_type_name;
                    }

                    $requirement_list[] = array(
                        "requirement_id" => $item->requirement_id,
                        "lead_id" => $item->lead_id,
                        "look_for" => $item->look_for,
                        "budget_min" => ($item->budget_minimum) ? $item->budget_minimum : '',
                        "budget_max" => ($item->budget_maximum) ? $item->budget_maximum : '',
                        "size_min" => $item->size_min,
                        "size_max" => $item->size_max,
                        "size_unit" => $item->size_unit_name,
                        "remark" => $item->remark,
                        "dor" => $item->dor,
                        "look_for" => $look_for,
                        "location" => $location,
                        "requirement_status" => $item->requirement_status,
                        "added_by" => (($item->au_parent_id == 0) ? (($item->au_is_individual) ? ucwords($item->au_user_title . ' ' . $item->au_first_name . ' ' . $item->au_last_name) : $item->au_firm_name) : ucwords($item->au_user_title . ' ' . $item->au_first_name . ' ' . $item->au_last_name))
                    );
                }
            }
            $array = array('status' => 'success', 'message' => 'Data Found', 'requirement_list' => $requirement_list);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function add_feedback()
    {
        $array = array();

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

        if ($user_detail && $this->input->post()) {

            if ($this->input->post('f_id')) {
                $feedback_id = $this->input->post('f_id');
                $like_property = 0;
                if ($this->input->post('like_property')) {
                    $like_property = $this->input->post('like_property');
                }

                $record_array = array(
                    'visit_date' => $this->input->post('visit_date'),
                    'visit_time' => $this->input->post('visit_time'),
                    'comment' => $this->input->post('comment'),
                    'customer_offer' => $this->input->post('customer_offer'),
                    'like_property' => $like_property
                );

                $this->Action_model->update_data($record_array, 'tbl_feedbacks', "feedback_id='" . $feedback_id . "'");


                $array = array('status' => 'added', 'message' => 'Feedback Updated Successfully!!');
            } else {
                $like_property = 0;
                if ($this->input->post('like_property')) {
                    $like_property = $this->input->post('like_property');
                }

                $feedback_ids = $this->input->post('feedback_ids');
                $feedback_ids = explode(",", $feedback_ids);

                foreach ($feedback_ids as $item) {

                    $exp = explode("#", $item);

                    $record_array = array(
                        'visit_date' => $this->input->post('visit_date'),
                        'visit_time' => $this->input->post('visit_time'),
                        'comment' => $this->input->post('comment'),
                        'customer_offer' => $this->input->post('customer_offer'),
                        'like_property' => $like_property,
                        'requirement_id' => $exp[0],
                        'property_id' => $exp[1],
                        'type' => $exp[2]
                    );


                    $record_array['created_at'] = time();
                    $record_array['user_id'] = $user_id;
                    $record_array['account_id'] = $account_id;
                    $record_array['lead_id'] = $this->input->post('lead_id');

                    $id = $this->Action_model->insert_data($record_array, 'tbl_feedbacks');
                }

                $array = array('status' => 'added', 'message' => 'Feedback Added Successfully!!');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_feedback_list()
    {
        $array = array();
        $feedback_list = array();

        $account_id = getAccountId();

        if ($account_id && $this->input->post()) {

            $lead_id = $this->input->post('lead_id');

            $sql = "
SELECT req.requirement_id,pty.property_id,COALESCE('simple_property') as  type,bgt_min.budget_amount as req_budget_min,bgt_max.budget_amount as req_budget_max,state_name,city_name,location_name,product_type_name,unit_type_name,COALESCE('') as  project_name, pty.property_id as pid FROM tbl_requirements as req 
JOIN tbl_property as pty ON pty.product_type_id = req.product_type_id AND pty.unit_type_id = req.unit_type_id AND pty.state_id = req.state_id AND pty.city_id = req.city_id 
LEFT JOIN tbl_budgets as bgt_min ON bgt_min.budget_id = req.budget_min 
LEFT JOIN tbl_budgets as bgt_max ON bgt_max.budget_id = req.budget_max 
LEFT JOIN tbl_states ON tbl_states.state_id = pty.state_id 
LEFT JOIN tbl_city ON tbl_city.city_id = pty.city_id 
LEFT JOIN tbl_locations ON tbl_locations.location_id = pty.location_id  
LEFT JOIN tbl_product_types ON tbl_product_types.product_type_id = req.product_type_id 
LEFT JOIN tbl_unit_types ON tbl_unit_types.unit_type_id = req.unit_type_id  
WHERE lead_id='" . $lead_id . "'
UNION ALL
SELECT req.requirement_id,pty.product_unit_detail_id,COALESCE('project_property') as  type,bgt_min.budget_amount as req_budget_min,bgt_max.budget_amount as req_budget_max,state_name,city_name,location_name,product_type_name,unit_type_name,COALESCE(pdt.project_name) as  project_name,pdt.product_id as pid FROM tbl_requirements as req
JOIN tbl_product_unit_details as pty ON pty.project_type = req.product_type_id AND ((pty.project_type != '3' AND pty.property_type = req.unit_type_id) OR (pty.project_type = '3' AND pty.sub_category = req.unit_type_id))  
JOIN tbl_products as pdt ON pdt.product_id = pty.product_id  AND pdt.state_id = req.state_id AND pdt.city_id = req.city_id 
LEFT JOIN tbl_budgets as bgt_min ON bgt_min.budget_id = req.budget_min 
LEFT JOIN tbl_budgets as bgt_max ON bgt_max.budget_id = req.budget_max 
LEFT JOIN tbl_states ON tbl_states.state_id = pdt.state_id 
LEFT JOIN tbl_city ON tbl_city.city_id = pdt.city_id 
LEFT JOIN tbl_locations ON tbl_locations.location_id = pdt.location 
LEFT JOIN tbl_product_types ON tbl_product_types.product_type_id = req.product_type_id 
LEFT JOIN tbl_unit_types ON tbl_unit_types.unit_type_id = req.unit_type_id  
WHERE lead_id='" . $lead_id . "'
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
                if ($itemRow->type == "simple_property") {

                    $budget = 0;
                    $b_min = 0;
                    $b_max = 0;

                    $i1 = array(
                        'requirement_id' => $itemRow->requirement_id,
                        'property_id' => $itemRow->property_id,
                        'state_name' => $itemRow->state_name,
                        'city_name' => $itemRow->city_name,
                        'location_name' => $itemRow->location_name,
                        'product_type_name' => $itemRow->product_type_name,
                        'unit_type_name' => $itemRow->unit_type_name,
                        'project_name' => $itemRow->project_name,
                        'type' => $itemRow->type,
                        'budget' => $budget,
                        'budget_min' => $b_min,
                        'budget_max' => $b_max,
                        'req_budget_min' => $req_b_min,
                        'req_budget_max' => $req_b_max,
                        'size' => "",
                        'accomodation_name' => '',
                        'pid' => $itemRow->pid
                    );

                    $items[] = $i1;

                    $rq = $this->Action_model->select_single('tbl_requirements', "requirement_id='" . $itemRow->requirement_id . "'");
                    //$pt = $this->Action_model->select_single('tbl_property',"property_id='".$itemRow->property_id."'");

                    $this->db->select("*");
                    $this->db->from('tbl_property');
                    $this->db->join('tbl_units', 'tbl_units.unit_id = tbl_property.covered_area_unit', 'left');
                    $this->db->where("property_id='" . $itemRow->property_id . "'");
                    $query = $this->db->get();
                    $pt = $query->row();

                    if ($rq && $pt && $rq->size_unit == $pt->covered_area_unit && ($pt->covered_area >= $rq->size_min && $pt->covered_area <= $rq->size_max)) {
                        // sale
                        if ($rq->look_for == 1 && $pt->listing_type == 2) {

                            if ($pt->sale_price >= $req_b_min && $pt->sale_price <= $req_b_max) {

                                $budget = "Budget: Rs." . $pt->sale_price;
                                $b_min = $pt->sale_price;
                                $b_max = $pt->sale_price;

                                $i1 = array(
                                    'requirement_id' => $itemRow->requirement_id,
                                    'property_id' => $itemRow->property_id,
                                    'state_name' => $itemRow->state_name,
                                    'city_name' => $itemRow->city_name,
                                    'location_name' => $itemRow->location_name,
                                    'product_type_name' => $itemRow->product_type_name,
                                    'unit_type_name' => $itemRow->unit_type_name,
                                    'project_name' => $itemRow->project_name,
                                    'type' => $itemRow->type,
                                    'budget' => $budget,
                                    'budget_min' => $b_min,
                                    'budget_max' => $b_max,
                                    'req_budget_min' => $req_b_min,
                                    'req_budget_max' => $req_b_max,
                                    'size' => $pt->covered_area . " " . $pt->unit_name,
                                    'accomodation_name' => '',
                                    'pid' => $itemRow->pid
                                );

                                $property_items[] = $i1;
                            }
                        }
                        // rent
                        if ($rq->look_for == 2 && $pt->listing_type == 1) {
                            if ($pt->rent_price >= $req_b_min && $pt->rent_price <= $req_b_max) {

                                $budget = "Budget: Rs." . $pt->rent_price;
                                $b_min = $pt->rent_price;
                                $b_max = $pt->rent_price;

                                $i1 = array(
                                    'requirement_id' => $itemRow->requirement_id,
                                    'property_id' => $itemRow->property_id,
                                    'state_name' => $itemRow->state_name,
                                    'city_name' => $itemRow->city_name,
                                    'location_name' => $itemRow->location_name,
                                    'product_type_name' => $itemRow->product_type_name,
                                    'unit_type_name' => $itemRow->unit_type_name,
                                    'project_name' => $itemRow->project_name,
                                    'type' => $itemRow->type,
                                    'budget' => $budget,
                                    'budget_min' => $b_min,
                                    'budget_max' => $b_max,
                                    'req_budget_min' => $req_b_min,
                                    'req_budget_max' => $req_b_max,
                                    'size' => $pt->covered_area . " " . $pt->unit_name,
                                    'accomodation_name' => '',
                                    'pid' => $itemRow->pid
                                );

                                $property_items[] = $i1;
                            }
                        }
                    }
                } else if ($itemRow->type == "project_property") {

                    $where = "pud.product_unit_detail_id='" . $itemRow->property_id . "'";
                    $this->db->select("pud.product_unit_detail_id,tbl_accomodations.accomodation_name,pud.project_type,pud.property_type,pud.sa,pud.plot_size,pud.plot_unit,punit.unit_name as plot_unit_name,sa_unit.unit_name as sa_unit_name,pud.basic_cost,p.b_cost_unit,pud.unit");
                    $this->db->from('tbl_product_unit_details as pud');
                    $this->db->join('tbl_products as p', 'p.product_id = pud.product_id', 'left');
                    $this->db->join('tbl_accomodations', 'tbl_accomodations.accomodation_id = pud.accomodation', 'left');
                    $this->db->join('tbl_units as punit', 'punit.unit_id = pud.plot_unit', 'left');
                    $this->db->join('tbl_units as sa_unit', 'sa_unit.unit_id = pud.unit', 'left');
                    $this->db->where($where);
                    $query = $this->db->get();
                    $item = $query->row();

                    $size_value = 0;
                    $size_unit = "";
                    $size = "";

                    if ($item->project_type == '2') {

                        if ($item->sa) {
                            $size_value = $item->sa;
                            $size_unit = $item->unit;

                            $size = $item->sa;
                            if ($item->sa_unit_name) {
                                $size .= ' ' . $item->sa_unit_name;
                            }
                        }

                        if ($item->plot_size) {
                            $size_value = $item->plot_size;
                            $size_unit = $item->plot_unit;

                            $size = $item->plot_size;
                            if ($item->plot_unit_name) {
                                $size .= ' ' . $item->plot_unit_name;
                            }
                        }
                    }
                    if ($item->project_type == '3') {

                        $size_value = $item->sa;
                        $size_unit = $item->unit;

                        $size = $item->sa;
                        if ($item->sa_unit_name) {
                            $size .= ' ' . $item->sa_unit_name;
                        }
                    }

                    $rq = $this->Action_model->select_single('tbl_requirements', "requirement_id='" . $itemRow->requirement_id . "'");

                    if ($rq && $rq->size_unit == $size_unit && ($size_value >= $rq->size_min && $size_value <= $rq->size_max)) {


                        $this->db->select('*');
                        $this->db->from('tbl_inventory');
                        $this->db->join('tbl_basic_cost', 'tbl_basic_cost.inventory_id = tbl_inventory.inventory_id', 'left');
                        $this->db->where("unit_code='" . $item->product_unit_detail_id . "'");
                        $query = $this->db->get();
                        $item_inv_data = $query->result();
                        $o = 0;

                        $amount_array = array();
                        if ($item_inv_data) {
                            foreach ($item_inv_data as $itemInv) {
                                $current_rate = 0;
                                if ($itemInv->basic_cost_id) {

                                    $b_cost_unit = $itemInv->current_rate_unit;
                                    if ($itemInv->current_rate) {
                                        //$current_rate += $itemInv->current_rate;

                                        // residencial
                                        if ($item->project_type == 2) {

                                            // for flat
                                            if (($item->property_type == 1 || $item->property_type == 7)) {
                                                //$size = $item->sa;
                                                //if ($item->sa_unit_name) {
                                                //    $size .= ' '.$item->sa_unit_name;
                                                //}

                                                if ($b_cost_unit == '2') { // for Sq.Ft
                                                    $current_rate = $item->sa * $itemInv->current_rate;
                                                } else if ($b_cost_unit == '5') { // for Fix
                                                    $current_rate = $itemInv->current_rate;
                                                }
                                            }
                                            // for plot
                                            else if (($item->property_type == 2 || $item->property_type == 3)) {
                                                //$size = $item->plot_size;
                                                //if ($item->plot_unit_name) {
                                                //    $size .= ' '.$item->plot_unit_name;
                                                //}
                                                if ($b_cost_unit == '1') { // for Sq.Yd
                                                    $current_rate = $item->plot_size * $itemInv->current_rate;
                                                } else if ($b_cost_unit == '2') { // for Sq.Ft
                                                    $current_rate += $item->construction_area * $itemInv->current_rate;
                                                } else if ($b_cost_unit == '5') { // for Fix
                                                    $current_rate = $itemInv->current_rate;
                                                }
                                            }
                                        }
                                        // commercial
                                        else if ($item->project_type == 3) {
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                            if ($b_cost_unit == '2') { // for Sq.Ft
                                                $current_rate = $item->sa * $itemInv->current_rate;
                                            } else if ($b_cost_unit == '5') { // for Fix
                                                $current_rate = $itemInv->current_rate;
                                            }
                                        }
                                    }
                                } else {

                                    $b_cost_unit = $item->b_cost_unit;

                                    if ($item->basic_cost) {

                                        // residencial
                                        if ($item->project_type == 2) {
                                            // for flat
                                            if (($item->property_type == 1 || $item->property_type == 7)) {
                                                //$size = $item->sa;
                                                //if ($item->sa_unit_name) {
                                                //    $size .= ' '.$item->sa_unit_name;
                                                //}

                                                if ($b_cost_unit == '2') { // for Sq.Ft
                                                    $current_rate = $item->sa * $item->basic_cost;
                                                } else if ($b_cost_unit == '5') { // for Fix
                                                    $current_rate = $item->basic_cost;
                                                }
                                            }
                                            // for plot
                                            else if (($item->property_type == 2 || $item->property_type == 3)) {
                                                //$size = $item->plot_size;
                                                //if ($item->plot_unit_name) {
                                                //    $size .= ' '.$item->plot_unit_name;
                                                //}
                                                if ($b_cost_unit == '1') { // for Sq.Yd
                                                    $current_rate = $item->plot_size * $item->basic_cost;
                                                } else if ($b_cost_unit == '2') { // for Sq.Ft
                                                    $current_rate = $item->construction_area * $item->basic_cost;
                                                } else if ($b_cost_unit == '5') { // for Fix
                                                    $current_rate = $item->basic_cost;
                                                }
                                            }
                                        }


                                        // commercial
                                        else if ($item->project_type == 3) {

                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                            if ($b_cost_unit == '2') { // for Sq.Ft
                                                $current_rate = $item->sa * $item->basic_cost;
                                            } else if ($b_cost_unit == '5') { // for Fix
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
                        } else {
                            $b_cost_unit = $item->b_cost_unit;

                            if ($item->basic_cost) {

                                // residencial
                                if ($item->project_type == 2) {
                                    // for flat
                                    if (($item->property_type == 1 || $item->property_type == 7)) {
                                        //$size = $item->sa;
                                        //if ($item->sa_unit_name) {
                                        //    $size .= ' '.$item->sa_unit_name;
                                        //}

                                        if ($b_cost_unit == '2') { // for Sq.Ft
                                            $current_rate = $item->sa * $item->basic_cost;
                                        } else if ($b_cost_unit == '5') { // for Fix
                                            $current_rate = $item->basic_cost;
                                        }
                                    }
                                    // for plot
                                    else if (($item->property_type == 2 || $item->property_type == 3)) {
                                        //$size = $item->plot_size;
                                        //if ($item->plot_unit_name) {
                                        //    $size .= ' '.$item->plot_unit_name;
                                        //}
                                        if ($b_cost_unit == '1') { // for Sq.Yd
                                            $current_rate = $item->plot_size * $item->basic_cost;
                                        } else if ($b_cost_unit == '2') { // for Sq.Ft
                                            $current_rate = $item->construction_area * $item->basic_cost;
                                        } else if ($b_cost_unit == '5') { // for Fix
                                            $current_rate = $item->basic_cost;
                                        }
                                    }
                                }


                                // commercial
                                else if ($item->project_type == 3) {

                                    //$size = $item->sa;
                                    //if ($item->sa_unit_name) {
                                    //    $size .= ' '.$item->sa_unit_name;
                                    //}

                                    if ($b_cost_unit == '2') { // for Sq.Ft
                                        $current_rate = $item->sa * $item->basic_cost;
                                    } else if ($b_cost_unit == '5') { // for Fix
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

                            if ($b_min == $b_max) {
                                $budget = " Budget: Rs." . $b_min;
                            } else {
                                $budget = " Budget: Rs." . $b_min . " to Rs." . $b_max . "";
                            }
                        }




                        $i1 = array(
                            'requirement_id' => $itemRow->requirement_id,
                            'property_id' => $itemRow->property_id,
                            'state_name' => $itemRow->state_name,
                            'city_name' => $itemRow->city_name,
                            'location_name' => $itemRow->location_name,
                            'product_type_name' => $itemRow->product_type_name,
                            'unit_type_name' => $itemRow->unit_type_name,
                            'project_name' => $itemRow->project_name,
                            'type' => $itemRow->type,
                            'budget' => $budget,
                            'budget_min' => $b_min,
                            'budget_max' => $b_max,
                            'req_budget_min' => $req_b_min,
                            'req_budget_max' => $req_b_max,
                            'size' => $size,
                            'accomodation_name' => $item->accomodation_name,
                            'pid' => $itemRow->pid
                        );

                        $items[] = $i1;

                        if ($b_min >= $req_b_min && $b_max <= $req_b_max) {
                            $property_items[] = $i1;
                        }
                    }
                }
            }

            foreach ($property_items as $itemPrp) {
                $where = "requirement_id='" . $itemPrp['requirement_id'] . "'";

                $this->db->select('requirement_id,tbl_requirements.created_at,lead_id,user_id,look_for,product_type_name,unit_type_name,accomodation_name,location,size_min,size_max,size_unit,remark,dor,lead_option_name as look_for,requirement_status,state_name,city_name,b_min.budget_name as budget_minimum,b_max.budget_name as budget_maximum,su.unit_name as size_unit_name');
                $this->db->from('tbl_requirements');
                $this->db->join('tbl_lead_options', 'tbl_lead_options.lead_option_id = tbl_requirements.look_for', 'left');
                $this->db->join('tbl_states', 'tbl_states.state_id = tbl_requirements.state_id', 'left');
                $this->db->join('tbl_city', 'tbl_city.city_id = tbl_requirements.city_id', 'left');
                $this->db->join('tbl_accomodations', 'tbl_accomodations.accomodation_id = tbl_requirements.accomodation_id', 'left');
                $this->db->join('tbl_product_types', 'tbl_product_types.product_type_id = tbl_requirements.product_type_id', 'left');
                $this->db->join('tbl_unit_types', 'tbl_unit_types.unit_type_id = tbl_requirements.unit_type_id', 'left');
                $this->db->join('tbl_budgets as b_min', 'b_min.budget_id = tbl_requirements.budget_min', 'left');
                $this->db->join('tbl_budgets as b_max', 'b_max.budget_id = tbl_requirements.budget_max', 'left');
                $this->db->join('tbl_units as su', 'su.unit_id = tbl_requirements.size_unit', 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $feedback_data = $query->row();

                if ($feedback_data) {
                    $date_user = ""; //$itemPrp->visit_date." & ".$itemPrp->visit_time." By ".ucwords($itemPrp->first_name." ".$itemPrp->last_name);

                    $this->db->select('*');
                    $this->db->from('tbl_feedbacks');
                    $this->db->join('tbl_users', 'tbl_users.user_id = tbl_feedbacks.account_id', 'left');
                    $this->db->where("requirement_id='" . $itemPrp['requirement_id'] . "' AND property_id='" . $itemPrp['property_id'] . "' AND type='" . $itemPrp['type'] . "' AND lead_id='" . $lead_id . "' AND account_id='" . $account_id . "'");
                    $query = $this->db->get();
                    $feedback_dd = $query->row();

                    $feedback_id = "";
                    $comment = "";
                    $visit_status = "";
                    if ($feedback_dd) {
                        $feedback_id = $feedback_dd->feedback_id;
                        $comment = $feedback_dd->comment;
                        $visit_status = ($feedback_dd->like_property) ? 'Yes' : 'No';
                        $date_user = $feedback_dd->visit_date . " & " . $feedback_dd->visit_time . " By " . ucwords($feedback_dd->first_name . " " . $feedback_dd->last_name);
                    }


                    $recordLead = $this->Action_model->select_single('tbl_leads', "lead_id='" . $lead_id . "'");
                    $lead_mobile = "";
                    $lead_email = "";
                    $project_link = "";
                    if ($recordLead) {
                        $lead_mobile = $recordLead->lead_mobile_no;
                        $lead_email = $recordLead->lead_email;
                    }

                    $where = "product_id='" . $itemPrp['pid'] . "'";
                    $prod_detail = $this->Action_model->select_single('tbl_products', $where);
                    if ($prod_detail) {
                        $project_link = base_url('property/' . $prod_detail->slug . '/' . $account_id . '/');
                    }

                    $feedback_list[] = array(
                        'feedback_id' => $feedback_id,
                        'requirement_id' => $itemPrp['requirement_id'],
                        'property_id' => $itemPrp['property_id'],
                        'type' => $itemPrp['type'],
                        'state_name' => $itemPrp['state_name'],
                        'city_name' => $itemPrp['city_name'],
                        'location_name' => $itemPrp['location_name'],
                        'product_type_name' => $itemPrp['product_type_name'],
                        'unit_type_name' => $itemPrp['unit_type_name'],
                        'budget' => $itemPrp['budget'],
                        "comment" => $comment,
                        "visit_status" => $visit_status,
                        "created_at" => $feedback_data->created_at,
                        "accomodation_name" => ($itemPrp['accomodation_name']) ? $itemPrp['accomodation_name'] : '',
                        "size_min" => $feedback_data->size_min,
                        "size_max" => $feedback_data->size_max,
                        "size_unit" => $feedback_data->size_unit_name,
                        'project_name' => $itemPrp['project_name'],
                        "date_user" => $date_user,
                        'size' => $itemPrp['size'],
                        'pid' => $itemPrp['pid'],
                        'project_url' => $project_link,
                        'lead_mobile' => $lead_mobile,
                        'lead_email' => $lead_email,
                        'lead_id' => $lead_id,
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
            $array = array('status' => 'success', 'message' => 'Data Found', 'feedback_list' => $feedback_list);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_lead_history_list()
    {
        $array = array();
        $lead_history_list = array();

        $account_id = getAccountId();

        if ($account_id && $this->input->post()) {

            $lead_id = $this->input->post('lead_id');
            $where = "lead_id='" . $lead_id . "' AND account_id='" . $account_id . "' ORDER BY lead_history_id DESC";

            $this->db->select('lead_history_id,title,description,created_at');
            $this->db->from('tbl_lead_history');
            $this->db->where($where);
            $query = $this->db->get();
            $lead_history_data = $query->result();

            if ($lead_history_data) {
                foreach ($lead_history_data as $item) {

                    $lead_history_list[] = array(
                        "lead_history_id" => $item->lead_history_id,
                        "title" => $item->title,
                        "description" => $item->description,
                        "created_at" => date("d-m-Y", $item->created_at) . '<br>' . date("h:i a", $item->created_at)
                    );
                }
            }
            $array = array('status' => 'success', 'message' => 'Data Found', 'lead_history_list' => $lead_history_list);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function load_followup_list()
    {
        $array = array();
        $followup_list = array();

        $account_id = getAccountId();

        if ($account_id && $this->input->post()) {

            $lead_id = $this->input->post('lead_id');

            $where = "lead_id='" . $lead_id . "' AND tbl_followup.account_id='" . $account_id . "'";
            /*$where_ids = "";
            $user_ids = $this->get_level_user_ids();
            if (count($user_ids)) {
                $where_ids .= " AND (tbl_followup.user_id='".implode("' OR tbl_followup.user_id='", $user_ids)."')";
            }
            $where .= $where_ids;*/
            $where .= " ORDER BY followup_id DESC";

            $this->db->select('followup_id,followup_status,comment,task_desc,lead_id,tbl_followup.created_at as created_at,cu.is_individual as cu_is_individual,cu.firm_name as cu_firm_name,cu.parent_id as cu_parent_id,cu.user_title as cu_user_title,cu.first_name as cu_first_name,cu.last_name as cu_last_name,au.is_individual as au_is_individual,au.firm_name as au_firm_name,au.parent_id as au_parent_id,au.user_title as au_user_title,au.first_name as au_first_name,au.last_name as au_last_name,next_followup_date,next_followup_time,lead_action_name');
            $this->db->from('tbl_followup');
            $this->db->join('tbl_users as cu', 'cu.user_id = tbl_followup.user_id', 'left');
            $this->db->join('tbl_users as au', 'au.user_id = tbl_followup.user_id', 'left');
            $this->db->join('tbl_lead_actions', 'tbl_lead_actions.lead_action_id = tbl_followup.next_action', 'left');
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
                        "followup_id" => $item->followup_id,
                        "lead_id" => $item->lead_id,
                        "followup_status" => $item->followup_status,
                        "comment" => $item->comment,
                        "task_desc" => $item->task_desc,
                        "created" => date("d-m-Y & h:i A", $item->created_at),
                        "cu_name" => (($item->cu_parent_id == 0) ? (($item->cu_is_individual) ? ucwords($item->cu_user_title . ' ' . $item->cu_first_name . ' ' . $item->cu_last_name) : $item->cu_firm_name) : ucwords($item->cu_user_title . ' ' . $item->cu_first_name . ' ' . $item->cu_last_name)),
                        "au_name" => (($item->au_parent_id == 0) ? (($item->au_is_individual) ? ucwords($item->au_user_title . ' ' . $item->au_first_name . ' ' . $item->au_last_name) : $item->au_firm_name) : ucwords($item->au_user_title . ' ' . $item->au_first_name . ' ' . $item->au_last_name)),
                        "next_action" => $next_action,
                        "lead_action_name" => $item->lead_action_name
                    );
                }
            }
            $array = array('status' => 'success', 'message' => 'Data Found', 'followup_list' => $followup_list);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function followup_status_update()
    {
        $array = array();

        if ($this->input->post()) {

            $id = $this->input->post('id');
            $record = $this->Action_model->select_single('tbl_followup', "followup_id='" . $id . "'");

            if ($record) {
                $this->Action_model->update_data(array('followup_status' => 3), 'tbl_followup', "followup_id='" . $id . "'");
                $array = array('status' => 'success', 'message' => 'Updated Successfully!!');
            } else {
                $array = array('status' => 'error', 'message' => 'Record Not Found!!');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function followup_save()
    {
        $array = array();

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

        if ($user_detail && $this->input->post()) {

            $followup_id = $this->input->post('followup_id');
            $followup_lead_id = $this->input->post('followup_lead_id');
            $followup_status = $this->input->post('followup_status');

            if ($this->input->post("lead_stage_id") == 6) {
                $inv_data = $this->Action_model->select_single('tbl_inventory', "inventory_id='" . $this->input->post("bk_inventory_id") . "' AND inventory_status='1'");
                if ($inv_data) {
                    $check = $this->Action_model->select_single('tbl_bookings', "inventory_id='" . $this->input->post("bk_inventory_id") . "' AND (booking_status='0' || booking_status='1')");
                    if ($check) {
                        $array = array('status' => 'error', 'message' => 'Already Booked');
                        echo json_encode($array);
                        exit;
                    }
                } else {
                    $array = array('status' => 'error', 'message' => 'Not available for booking.');
                    echo json_encode($array);
                    exit;
                }
            }

            $comment = "";
            if ($this->input->post('comment')) {
                $comment = $this->input->post('comment');
            }

            $record = $this->Action_model->select_single('tbl_followup', "followup_id='" . $followup_id . "' AND account_id='" . $account_id . "'");

            if ($record) {
                $followup_next_status = 0;
                if ($followup_status == 2) {
                    $followup_next_status = 1;
                    $this->Action_model->update_data(array('followup_status' => 2, "comment" => $comment), 'tbl_followup', "followup_id='" . $followup_id . "' AND account_id='" . $account_id . "'");
                } else if ($followup_status == 3) {
                    $followup_next_status = 1;
                    $this->Action_model->update_data(array('followup_status' => 3, "comment" => $comment), 'tbl_followup', "followup_id='" . $followup_id . "' AND account_id='" . $account_id . "'");
                }

                $lead_status_id = "";
                if ($this->input->post("lead_status_id")) {
                    $lead_status_id = $this->input->post("lead_status_id");
                }

                if ($this->input->post("lead_stage_id") == 7) {
                    $lead_status_id = 2;
                }
                if ($this->input->post("lead_stage_id") == 6) {
                    $lead_status_id = 3;
                }

                $this->Action_model->update_data(array('lead_status' => $lead_status_id, 'lead_stage_id' => $this->input->post("lead_stage_id")), 'tbl_leads', "lead_id='" . $followup_lead_id . "' AND account_id='" . $account_id . "'");

                $next_followup_date = "";
                $next_followup_time = "";
                $next_followup = "";
                $project_id = "";
                $next_action = "";
                $task_desc = "";

                if ($this->input->post("next_followup_date")) {
                    $next_followup_date = $this->input->post("next_followup_date");
                }
                if ($this->input->post("next_followup_time")) {
                    // $next_followup_time = $this->input->post("next_followup_time");
                    $next_followup_time = str_replace(['am', 'pm'], ['', ''], $this->input->post('next_followup_time'));
                }
                if ($this->input->post("project_id")) {
                    $project_id = $this->input->post("project_id");
                }
                if ($this->input->post("next_action")) {
                    $next_action = $this->input->post("next_action");
                }
                if ($this->input->post("task_desc")) {
                    $task_desc = $this->input->post("task_desc");
                }

                if ($this->input->post("lead_stage_id") != 6) {
                    $followup_array = array(
                        "lead_stage_id" => $this->input->post("lead_stage_id"),
                        "lead_status_id" => $lead_status_id,
                        "next_action" => $next_action,
                        "next_followup_date" => $next_followup_date,
                        "next_followup_time" => $next_followup_time,
                        "project_id" => $project_id,
                        "task_desc" => $task_desc,
                        "comment" => '',
                        "lead_id" => $followup_lead_id,
                        "added_by" => $user_id,
                        "user_id" => $user_id,
                        "account_id" => $account_id,
                        "assign_user_id" => $this->input->post("fp_assign_to"),
                        "followup_status" => $followup_next_status,
                        "created_at" => time(),
                        "updated_at" => time()
                    );

                    $this->Action_model->insert_data($followup_array, 'tbl_followup');

                    $where = "lead_id='" . $followup_lead_id . "' AND account_id='" . $account_id . "' ORDER BY followup_id DESC LIMIT 1";
                    $this->db->select('au.first_name as au_first_name,au.last_name as au_last_name,next_followup_date,next_followup_time');
                    $this->db->from('tbl_followup');
                    $this->db->join('tbl_users as au', 'au.user_id = tbl_followup.assign_user_id', 'left');
                    $this->db->where($where);
                    $query = $this->db->get();
                    $followup_detail = $query->row();
                    if ($followup_detail && $followup_detail->next_followup_date) {
                        $next_followup = "<i class='fa fa-clock-o'></i> " . $followup_detail->next_followup_date . " & " . $followup_detail->next_followup_time . " &nbsp; <i class='fa fa-bookmark'></i> " . $followup_detail->au_first_name . ' ' . $followup_detail->au_last_name;
                        $next_followup_date = $followup_detail->next_followup_date . " " . $followup_detail->next_followup_time;
                    }

                    $lead_history_array = array(
                        'title' => 'Followup',
                        'description' => 'Followup assign to ' . $this->Action_model->get_name($this->input->post("fp_assign_to")) . ' by ' . $this->Action_model->get_name($user_id),
                        'lead_id' => $followup_lead_id,
                        'created_at' => time(),
                        "account_id" => $account_id,
                        "user_id" => $user_id
                    );
                    $this->Action_model->insert_data($lead_history_array, 'tbl_lead_history');
                }

                //site visit
                if ($this->input->post("next_action") == 2 && $this->input->post("fp_project_id")) {
                    $fp_project = $this->input->post("fp_project_id");

                    $prject_names = array();
                    foreach ($fp_project as $rowItem) {

                        $recordProject = $this->Action_model->select_single('tbl_products', "product_id='" . $rowItem . "'", "project_name");
                        if ($recordProject) {
                            $prject_names[] = $recordProject->project_name;
                        }

                        $sv_array = array(
                            "lead_id" => $followup_lead_id,
                            "project_id " => $rowItem,
                            "visit_date " => $this->input->post("next_followup_date"),
                            "visit_time " => $this->input->post("next_followup_time"),
                            "attend_by" => '',
                            "site_visit_status" => 1,
                            "interested " => 0,
                            "comment" => '',
                            "account_id" => $account_id,
                            "added_by" => $user_id,
                            "user_id" => $user_id,
                            "assign_to" => $this->input->post("fp_assign_to"),
                            "created_at" => time()
                        );

                        $this->Action_model->insert_data($sv_array, 'tbl_site_visit');

                        $lead_history_array = array(
                            'title' => 'Site Visit',
                            'description' => 'Site Visit assign to ' . $this->Action_model->get_name($this->input->post("fp_assign_to")) . ' by ' . $this->Action_model->get_name($user_id),
                            'lead_id' => $followup_lead_id,
                            'created_at' => time(),
                            "account_id" => $account_id,
                            "user_id" => $user_id
                        );
                        $this->Action_model->insert_data($lead_history_array, 'tbl_lead_history');
                    }


                    if ($this->input->post("lead_stage_id") == 4) {


                        $recordLead = $this->Action_model->select_single('tbl_leads', "lead_id='" . $followup_lead_id . "'", "lead_mobile_no,lead_id");

                        if ($recordLead) {
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

                            $s_account_id = $account_id;
                            $s_team_user_id = $user_id;
                            $s_customer_id = $recordLead->lead_id;
                            $s_mobile = $recordLead->lead_mobile_no;
                            $project_name = ($prject_names) ? implode(", ", $prject_names) : "";

                            $where_agent = "user_id='" . $s_account_id . "'";
                            $agent_detail = $this->Action_model->select_single('tbl_users', $where_agent);

                            if ($agent_detail->no_of_sms) {

                                $s_message = "Hi! Thank you for confirming your appointment @ " . $this->input->post("next_followup_time") . " on " . $this->input->post("next_followup_date") . " to visit the " . $project_name . ". for any assistance call us @ " . $this->Action_model->get_name($this->input->post("fp_assign_to"));

                                $sms_response = $this->Action_model->sendMobileSMS($s_mobile, $s_message, true);
                                if ($sms_response) {
                                    $sms_response_array = json_decode($sms_response);
                                    if ($sms_response_array && isset($sms_response_array->status) && $sms_response_array->status == "success") {



                                        $sms_before = $agent_detail->no_of_sms;
                                        $net_no_of_sms = $sms_before - 1;
                                        $sms_after = $net_no_of_sms;

                                        $user_data = array(
                                            'no_of_sms' => $net_no_of_sms
                                        );

                                        $this->Action_model->update_data($user_data, 'tbl_users', $where_agent);

                                        $sms_credit_array = array(
                                            'account_id' => $s_account_id,
                                            'team_user_id' => $s_team_user_id,
                                            'customer_id' => $s_customer_id,
                                            'sms_before' => $sms_before,
                                            'sms_after' => $sms_after,
                                            'mobile' => $s_mobile,
                                            'message' => $s_message,
                                            'create_at' => date("d-m-Y H:i:s A")
                                        );

                                        $this->Action_model->insert_data($sms_credit_array, 'tbl_sms_history');
                                    }
                                }
                            }
                        }
                    }
                }
                //site visit end


                // booking
                if ($this->input->post("lead_stage_id") == 6) {

                    $this->Action_model->update_data(array('followup_status' => 2), 'tbl_followup', "followup_id='" . $followup_id . "' AND account_id='" . $account_id . "'");

                    $where = "inventory_id='" . $this->input->post("bk_inventory_id") . "'";
                    $inv_data = $this->Action_model->select_single('tbl_inventory', $where);

                    if ($inv_data) {
                        $data_array = array(
                            'inventory_status' => '2', 'last_update' => time()
                        );
                        $this->Action_model->update_data($data_array, 'tbl_inventory', $where);

                        $check = $this->Action_model->select_single('tbl_bookings', "inventory_id='" . $this->input->post("bk_inventory_id") . "'");
                        if (!$check) {
                            $bk_size = "";
                            if ($this->input->post("bk_size")) {
                                $bk_size = $this->input->post("bk_size");
                                $bk_size = explode("##", $bk_size);
                                $bk_size = $bk_size[0];
                            }

                            $bk_unit_no = "";
                            if ($this->input->post("bk_unit_no")) {
                                $bk_unit_no = $this->input->post("bk_unit_no");
                                $bk_unit_no = explode("##", $bk_unit_no);
                                $bk_unit_no = $bk_unit_no[0];
                            }

                            $bk_array = array(
                                "customer_name" => $this->input->post("bk_customer_name"),
                                "dob" => $this->input->post("bk_dob"),
                                "sdw" => $this->input->post("bk_sdw"),
                                "sdw_title" => $this->input->post("bk_sdw_title"),
                                "unit_no" => $bk_unit_no,
                                "unit_ref_no" => $this->input->post("bk_unit_ref_no"),
                                "address" => $this->input->post("bk_address"),
                                "state_id" => $this->input->post("bk_state_id"),
                                "city_id" => $this->input->post("bk_city_id"),
                                "project_id" => $this->input->post("bk_project_id"),
                                "tower" => $this->input->post("bk_tower"),
                                "floor" => $this->input->post("bk_floor"),
                                "size" => $bk_size,
                                "accommodation" => $this->input->post("bk_accommodation"),
                                "product_unit_detail_id" => $this->input->post("bk_product_unit_detail_id"),
                                "inventory_id" => $this->input->post("bk_inventory_id"),
                                "deal_amount" => $this->input->post("bk_deal_amount"),
                                "booking_amount" => $this->input->post("bk_booking_amount"),
                                "payment_mode" => $this->input->post("bk_payment_mode"),
                                "cheque_no" => $this->input->post("bk_cheque_no"),
                                "drawn_on" => $this->input->post("bk_drawn_on"),
                                "booking_date" => $this->input->post("bk_booking_date"),
                                "remark" => $this->input->post("bk_remark")
                            );

                            $bk_array['account_id'] = $account_id;
                            $bk_array['user_id'] = $user_id;
                            $bk_array['lead_id'] = $followup_lead_id;
                            $bk_array['created_at'] = time();

                            $this->Action_model->insert_data($bk_array, 'tbl_bookings');

                            $lead_history_array = array(
                                'title' => 'Booking',
                                'description' => 'New Booking by ' . $this->Action_model->get_name($user_id),
                                'lead_id' => $followup_lead_id,
                                'created_at' => time(),
                                "account_id" => $account_id,
                                "user_id" => $user_id
                            );
                            $this->Action_model->insert_data($lead_history_array, 'tbl_lead_history');
                        }
                    }
                }
                // booking end

                $array = array('status' => 'success', 'message' => 'Updated Successfully!!', 'next_followup' => $next_followup, 'next_followup_date' => $next_followup_date);
            } else {



                $array = array('status' => 'error', 'message' => 'Record Not Found!!');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_followup_stage_status()
    {
        $array = array();

        $account_id = getAccountId();

        if ($account_id && $this->input->post()) {
            $id = $this->input->post('id');

            $where = "lead_id=$id";

            $this->db->select("lead_stage_id,lead_status");
            $this->db->from('tbl_leads');
            $this->db->where($where);
            $query = $this->db->get();
            $record = $query->row();

            if ($record) {
                $array = array('status' => 'success', 'message' => 'Record Found', 'record' => $record);
            } else {
                $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    function get_lead_form()
    {

        $account_id = getAccountId();
        if ($account_id && $this->input->post("id")) {

            $profile_base_url           =   base_url('public/other/profile/');

            $id = $this->input->post("id");
            $this->db->select("*, concat('$profile_base_url' , tbl_leads.profile) as profile_url");

            $lead_detail = $this->Action_model->select_single('tbl_leads', "lead_id=$id");

            if ($lead_detail) {

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

                $where = "designation_status='1'";
                $designation_list = $this->Action_model->detail_result('tbl_designations', $where, 'designation_id,designation_name');
                $data['designation_list'] = $designation_list;

                $data['lead_detail'] = $lead_detail;
                $data['id'] = $id;
                $data['state_list'] = $state_list;
                $data['city_list'] = $city_list;
                $data['occupation_list'] = $occupation_list;
                $data['department_list'] = $department_list;
                $data['lead_source_list'] = $lead_source_list;
                $data['lead_stage_list'] = $lead_stage_list;

                $this->load->view(AGENT_URL . 'get_lead_form', $data);
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    }
    /* followup end */


    public function property_save()
    {
        $array = array();

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

        if ($user_detail && $this->input->post()) {
            $id = $this->input->post('id');
            $step = $this->input->post('step');
            $record = $this->Action_model->select_single('tbl_property', "property_id='" . $id . "' AND account_id='" . $account_id . "'");


            $furnishing = $this->input->post('furnishing');

            $record_array = array();
            $property_detail_array = array();

            if ($step == 1) {
                $record_array = array(
                    'listing_type' => $this->input->post('listing_type'),
                    'latitude' => $this->input->post('latitude'),
                    'longitude' => $this->input->post('longitude'),
                    'state_id' => $this->input->post('state_id'),
                    'city_id' => $this->input->post('city_id'),
                    'location_id' => $this->input->post('location_id'),
                    'product_type_id' => $this->input->post('product_type_id'),
                    'unit_type_id' => $this->input->post('unit_type_id'),
                    'address' => $this->input->post('address')
                );
            } else if ($step == 2) {
                $ideal_business_id = "";
                if ($this->input->post('ideal_business_id')) {
                    $ideal_business_id = implode(",", $this->input->post('ideal_business_id'));
                }

                $personal_washroom = "";
                if ($record->product_type_id == 3) {
                    if ($this->input->post('personal_washroom_checkbox')) {
                        $personal_washroom = 1;
                    }
                } else {
                    $personal_washroom = $this->input->post('personal_washroom');
                }


                $record_array = array(
                    'project_society' => $this->input->post('project_society'),
                    'land_zone' => $this->input->post('land_zone'),
                    'ideal_business_id' => $ideal_business_id,
                    'bedroom' => $this->input->post('bedroom'),
                    'balconies' => $this->input->post('balconies'),
                    'floor' => $this->input->post('floor'),
                    'total_floor' => $this->input->post('total_floor'),
                    'furnised_status_id' => $this->input->post('furnised_status_id'),
                    'bathroom' => $this->input->post('bathroom'),
                    'covered_area' => $this->input->post('covered_area'),
                    'covered_area_unit' => $this->input->post('covered_area_unit'),
                    'plot_area' => $this->input->post('plot_area'),
                    'plot_area_unit' => $this->input->post('plot_area_unit'),
                    'plot_size_length' => $this->input->post('plot_size_length'),
                    'plot_size_wirth' => $this->input->post('plot_size_wirth'),
                    'plot_size_unit' => $this->input->post('plot_size_unit'),
                    'built_up_area' => $this->input->post('built_up_area'),
                    'built_up_area_unit' => $this->input->post('built_up_area_unit'),
                    'super_built_up_area' => $this->input->post('super_built_up_area'),
                    'super_built_up_area_unit' => $this->input->post('super_built_up_area_unit'),
                    'property_status' => $this->input->post('property_status'),
                    'corner_plot' => $this->input->post('corner_plot'),
                    'facing_id' => $this->input->post('facing_id'),
                    'modify_interiors' => $this->input->post('modify_interiors'),
                    'lock_period_year' => $this->input->post('lock_period_year'),
                    'personal_washroom' => $personal_washroom,
                    'pantry_cafeteria' => $this->input->post('pantry_cafeteria'),
                    'super_area' => $this->input->post('super_area'),
                    'super_area_unit' => $this->input->post('super_area_unit'),
                    'shop_size_length' => $this->input->post('shop_size_length'),
                    'shop_size_wirth' => $this->input->post('shop_size_wirth'),
                    'shop_size_unit' => $this->input->post('shop_size_unit'),
                    'corner_shop' => $this->input->post('corner_shop'),
                    'main_road_shop' => $this->input->post('main_road_shop'),
                );

                $property_detail_array = array(
                    'road_wirth' => $this->input->post('road_wirth'),
                    'road_wirth_unit' => $this->input->post('road_wirth_unit'),
                    'park_facing' => $this->input->post('park_facing'),
                    'approval_state' => $this->input->post('approval_state'),
                    'sociaty_name' => $this->input->post('sociaty_name')
                );

                if ($furnishing) {
                    foreach ($furnishing as $key => $value) {

                        $f_where = "property_id='" . $id . "' AND furnishing_id='" . $key . "'";
                        $f_record = $this->Action_model->select_single('tbl_property_furnishing', $f_where);

                        $f_array = array(
                            'property_id' => $id,
                            'furnishing_id' => $key,
                            'furnishing_value' => $value
                        );

                        if ($f_record) {
                            $f_array['updated_at'] = time();
                            $this->Action_model->update_data($f_array, 'tbl_property_furnishing', $f_where);
                        } else {
                            $f_array['created_at'] = time();
                            $this->Action_model->insert_data($f_array, 'tbl_property_furnishing');
                        }
                    }
                }
            } else if ($step == 3) {
                $record_array = array(
                    'avaliability_from' => $this->input->post('avaliability_from'),
                    'immediately' => $this->input->post('immediately'),
                    'construction_age' => $this->input->post('construction_age'),
                    'monthly_rent' => $this->input->post('monthly_rent'),
                    'monthly_rent_unit' => $this->input->post('monthly_rent_unit'),
                    'security_deposit' => $this->input->post('security_deposit'),
                    'maintenance' => $this->input->post('maintenance'),
                    'maintenance_unit' => $this->input->post('maintenance_unit'),
                    'electrticity_charge' => $this->input->post('electrticity_charge'),
                    'water_bill_charge' => $this->input->post('water_bill_charge'),
                    'sale_price' => $this->input->post('sale_price'),
                    'sale_price_unit' => $this->input->post('sale_price_unit'),
                    'sale_other_charge' => $this->input->post('sale_other_charge')
                );

                $property_detail_array = array(
                    'rate' => $this->input->post('rate'),
                    'rate_unit' => $this->input->post('rate_unit'),
                    'inclusive_all' => $this->input->post('inclusive_all'),
                    'remark' => $this->input->post('remark'),
                    'amenities' => ($this->input->post('amenitie')) ? implode(',', $this->input->post('amenitie')) : '',
                    'sale_amenities' => ($this->input->post('sale_amenities')) ? implode(',', $this->input->post('sale_amenities')) : '',
                    'rent_amenities' => ($this->input->post('rent_amenities')) ? implode(',', $this->input->post('rent_amenities')) : ''
                );
            } else if ($step == 4) {
                $photo = "";

                if ($record) {
                    $photo = $record->photo;
                }

                $config['upload_path'] = './uploads/images/property/photo/';
                $config['allowed_types'] = 'jpg|png';
                $config['max_size']             = 5 * 1024;
                $config['remove_spaces'] = TRUE;
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);

                $this->upload->initialize($config);

                if (!empty($_FILES['photo']['name'])) {
                    if (!$this->upload->do_upload('photo')) {
                        $error = array('error' => $this->upload->display_errors());
                        $array = array('status' => 'error', 'message' => $error['error']);
                        echo json_encode($array);
                        exit;
                    } else {
                        if ($record && $record->photo && file_exists('./uploads/images/property/photo/' . $record->photo)) {
                            unlink('./uploads/images/property/photo/' . $record->photo);
                        }
                        $photo = $this->upload->data('file_name');
                    }
                }

                $record_array = array(
                    'owner_title' => $this->input->post('owner_title'),
                    'owner_first_name' => $this->input->post('owner_first_name'),
                    'owner_last_name' => $this->input->post('owner_last_name'),
                    'owner_mobile_no' => $this->input->post('owner_mobile_no'),
                    'owner_contact_no' => $this->input->post('owner_contact_no'),
                    'owner_email' => $this->input->post('owner_email'),
                    'photo' => $photo,
                    'youtube_video' => $this->input->post('youtube_video')
                );
            }

            if ($record_array) {

                if ($record) {

                    $message = "Property Updated Successfully.";

                    $record_array['updated_at'] = time();

                    if ($step == 4 && $record->is_post == 0) {
                        $record_array['is_post'] = 1;
                        $message = "Property Posted Successfully.";
                    }

                    $this->Action_model->update_data($record_array, 'tbl_property', "property_id='" . $id . "'");

                    if ($property_detail_array) {
                        if ($this->Action_model->select_single('tbl_property_detail', "property_id='" . $id . "'")) {
                            $this->Action_model->update_data($property_detail_array, 'tbl_property_detail', "property_id='" . $id . "'");
                        } else {
                            $property_detail_array['property_id'] = $id;
                            $this->Action_model->insert_data($property_detail_array, 'tbl_property_detail');
                        }
                    }

                    if ($step == 4) {
                        $this->session->set_flashdata('success_msg', $message);
                    }

                    $prop_where = "property_id='" . $id . "'";
                    $prop_record = $this->Action_model->select_single('tbl_property', $prop_where);

                    // for sale property create requirement
                    if ($prop_record && $prop_record->owner_mobile_no && $prop_record->listing_type == 2) {

                        $record_lead = $this->Action_model->select_single('tbl_leads', "account_id='" . $prop_record->account_id . "' AND lead_mobile_no='" . $prop_record->owner_mobile_no . "'");

                        $lead_id = "";
                        if ($record_lead) {
                            $lead_id = $record_lead->lead_id;
                            $record_lead_array = array('updated_at' => time());

                            $this->Action_model->update_data($record_lead_array, 'tbl_leads', "lead_id='" . $record_lead->lead_id . "'");
                        } else {

                            $record_lead_array = array(
                                'lead_title' => $prop_record->owner_title,
                                'lead_first_name' => $prop_record->owner_first_name,
                                'lead_last_name' => $prop_record->owner_last_name,
                                'lead_date' => date("d-m-Y"),
                                'lead_time' => date("h:i:s a"),
                                'lead_email' => $prop_record->owner_email,
                                'lead_mobile_no' => $prop_record->owner_mobile_no,
                                'lead_mobile_no_2' => $prop_record->owner_contact_no,
                                'lead_address' => $prop_record->address,
                                'lead_state_id' => $prop_record->state_id,
                                'lead_city_id' => $prop_record->state_id,
                                'lead_occupation_id' => '',
                                'lead_department_id' => '',
                                'lead_dob' => '',
                                'lead_doa' => '',
                                'lead_source_id' => '',
                                'lead_stage_id' => '',
                                'lead_status' => '',
                                'added_by' => $prop_record->user_id,
                                'user_id' => $prop_record->user_id,
                                'account_id' => $prop_record->account_id,
                                'lead_pan_no' => '',
                                'lead_adhar_no' => '',
                                'lead_voter_id' => '',
                                'lead_passport_no' => '',
                                'lead_gender' => '',
                                'lead_marital_status' => '',
                                'lead_designation' => '',
                                'lead_company' => '',
                                'lead_annual_income' => '',
                                'created_at' => time(),
                                'updated_at' => time(),
                                'property_id' => $prop_record->property_id,
                                'is_customer' => '1'
                            );

                            $lead_id = $this->Action_model->insert_data($record_lead_array, 'tbl_leads');

                            $lead_history_array = array(
                                'title' => 'Lead Created',
                                'description' => 'Lead created by ' . $this->Action_model->get_name($user_id),
                                'lead_id' => $lead_id,
                                'created_at' => time(),
                                "account_id" => $account_id,
                                "user_id" => $user_id
                            );
                            $this->Action_model->insert_data($lead_history_array, 'tbl_lead_history');
                        }

                        if ($lead_id) {
                            $req_where = "lead_id='" . $lead_id . "'";
                            $req_record = $this->Action_model->select_single('tbl_requirements', $req_where);

                            $look_for = "";
                            if ($prop_record->listing_type == 1) {
                                $look_for = "2";
                            } else if ($prop_record->listing_type == 2) {
                                $look_for = "1";
                            } else {
                                $look_for = "3";
                            }
                            $req_record_array = array(
                                'look_for' => $look_for,
                                'product_type_id' => $prop_record->product_type_id,
                                'unit_type_id' => $prop_record->unit_type_id,
                                'accomodation_id' => '',
                                'state_id' => $prop_record->state_id,
                                'city_id' => $prop_record->city_id,
                                'location' => '',
                                'budget_min' => '',
                                'budget_max' => '',
                                'size_min' => '',
                                'size_max' => '',
                                'size_unit' => '',
                                'remark' => '',
                                'requirement_status' => 1
                            );

                            if ($req_record) {
                                $req_record_array['updated_at'] = time();

                                $this->Action_model->update_data($req_record_array, 'tbl_requirements', "requirement_id='" . $req_record->requirement_id . "'");
                            } else {
                                $req_record_array['dor'] = date("d-m-Y");
                                $req_record_array['created_at'] = time();
                                $req_record_array['updated_at'] = time();
                                $req_record_array['user_id'] = $prop_record->user_id;
                                $req_record_array['account_id'] = $prop_record->account_id;
                                $req_record_array['property_id'] = $prop_record->property_id;
                                $req_record_array['customer_mobile'] = $prop_record->owner_mobile_no;
                                $req_record_array['lead_id'] = $lead_id;

                                $this->Action_model->insert_data($req_record_array, 'tbl_requirements');
                            }
                        }
                    }

                    $array = array('status' => 'success', 'message' => $message, 'property_id' => $id);
                } else {

                    $record_array['created_at'] = time();
                    $record_array['updated_at'] = time();
                    $record_array['post_date'] = $this->input->post('post_date');
                    $record_array['account_id'] = $account_id;
                    $record_array['user_id'] = $user_id;

                    $property_id = $this->Action_model->insert_data($record_array, 'tbl_property');

                    if ($property_detail_array) {
                        $property_detail_array['property_id'] = $property_id;
                        $this->Action_model->insert_data($property_detail_array, 'tbl_property_detail');
                    }

                    $array = array('status' => 'success', 'message' => 'Property Added Successfully.', 'property_id' => $property_id);
                }
            } else {
                $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    /* property start */
    public function property_list()
    {

        $account_id = getAccountId();

        $postData = $this->input->post();
        $select = 'property_id,owner_title,property_status,post_date,tbl_listing_types.title as listing_type_name,product_type_name,unit_type_name';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (owner_title like '%" . $searchValue . "%' ) AND account_id='" . $account_id . "'";
        } else {
            $searchQuery = "account_id='" . $account_id . "'";
        }

        $data = $this->Action_model->ajaxDatatable(
            $postData,
            $searchQuery,
            'tbl_property',
            $where,
            $select,
            array(
                'tbl_listing_types', "tbl_listing_types.listing_type_id=tbl_property.listing_type",
                'tbl_product_types', "tbl_product_types.product_type_id=tbl_property.product_type_id",
                'tbl_unit_types', "tbl_unit_types.unit_type_id=tbl_property.unit_type_id"
            )
        );

        echo json_encode($data);
    }


    public function delete_property()
    {
        $array = array();

        $account_id = getAccountId();

        if ($account_id && $this->input->post()) {

            $id = $this->input->post('id');
            $record = $this->Action_model->select_single('tbl_property', "property_id='" . $id . "' AND account_id='" . $account_id . "'");

            if ($record) {
                $this->Action_model->delete_query('tbl_property', "property_id='" . $id . "'");
                $array = array('status' => 'added', 'message' => 'Property Deleted Successfully!!');
            } else {
                $array = array('status' => 'added', 'message' => 'Record Not Found!!');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }
    /* property end */

    /* manage inventory */
    /**
     * Table Used
     * - tbl_inventory - m
     * - tbl_product_plc_details
     * - tbl_price_components
     * - tbl_product_additional_details
     * - tbl_product_unit_details
     * - tbl_accomodations
     * - tbl_product_block_details
     * - tbl_floors
     */
    public function get_project_inventory()
    {
        $product_id = $this->input->post('product_id');

        $data['product_id'] = $product_id;

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

        $data['unit_code_list']             = $unit_code_list;
        $data['columns'] = $columns;


        $data['floor_list'] = $this->Action_model->detail_result('tbl_floors', "floor_id!=''");


        # Table View
        $table_view                 =   "<div class='table-responsive'>
                                        <table class='table table-bordered'>
                                        <tr>
                                            <th>#</th>
                                            <th>Unit Code</th>
                                            <th>Referance Number</th>
                                            <th>Unit no</th>
                                            <th class='text-center'>Action</th>
                                        </tr>
                                        ";

        if(!count($records ?? [])):
             $table_view                     .= "<tr><td colspan='4' class='text-center'>No inventory found</td></tr>";
        endif;

        foreach ($records ?? [] as $inventory_key => $inventory) :


            $inventory_id                   =   $inventory->inventory_id;
            $inventory_key                  =   ++$inventory_key;
            $property_details               =   $inventory->property_details ? json_decode($inventory->property_details) : null;

            #
            if ($inventory->product_id) :
                $property               = get_product_details($inventory->product_id);
                if ($property_details->unit_code ?? 0) :
                    $property_accomodation  = getPropertyAccomodations($property->project_type_id, $property->property_type_id, $inventory->product_id, $property_details->unit_code);
                endif;

                $unit_code_name  = $property_accomodation->unit_code_with_accomodation_name ?? $property_accomodation->inventory_unit_code ?? '';
            endif;
            #

            $unit_code                      =   $property_details->unit_code ?? '';
            $unit_no                        =    $property_details->unit_no ?? '';
            $referance_number               =   $property_details->referance_number ?? $inventory->reference ?? '';

            $table_view                     .=  "<tr>
                                                        <td>$inventory_key</td>
                                                        <td>$unit_code_name</td>
                                                        <td>$referance_number</td>
                                                        <td>$unit_no</td>
                                                        <td class='text-center'>
                                                            <span class='text-primary px-2 view-inventory-record' data-id='$inventory_id'><i class='fa fa-eye'></i></span>
                                                            <span class='text-success px-2 add-edit-inventory' data-id='$inventory_id'><i class='fa fa-edit'></i></span>
                                                            <span class='text-danger px-2 delete-inventory-record' data-id='$inventory_id'><i class='fa fa-trash'></i></span>
                                                        </td>
                                                    </tr>
                                                ";
        endforeach;

        $table_view                         .=   "</table><div>";

        # End Table View

        $data_view    = $this->load->view(AGENT_URL . 'ajax/get_project_inventory', $data, true);

        echo json_encode(['status' => true, 'message' => 'data fetched', 'data_view' => $data_view, 'table_view' => $table_view]);
    }

    public function project_inventory_update()
    {
        $array = array();

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

        if ($user_detail && $this->input->post()) {
            $product_id = $this->input->post('product_id');
            $builder_id = $this->input->post('builder_id');
            $comm_unit = $this->input->post('comm_unit');
            $ids = array();
            foreach ($comm_unit as $key => $value) {

                //$extra_entry_data = "";
                $extra_entry_array = array();
                if (isset($value['extra_entry'])) {
                    $extra_entry_array = $value['extra_entry'];
                    //$extra_entry_data = json_encode($value['extra_entry']);
                }
                $data_array = array(
                    'unit_code' => $value['unit_code'],
                    'unit_no' => $value['unit_no'],
                    'basic_cost' => $value['basic_cost'],
                    'club_cost' => $value['club_cost'],
                    'parking' => $value['parking'],
                    'floor_id' => $value['floor_id'],
                    'product_id' => $product_id,
                    'builder_id' => $builder_id,
                    'extra_entry' => '',
                    'reference' => $value['reference'],
                    'block_id' => $value['block_id']
                );

                if ($value['id']) {
                    $data_array['updated_at'] = time();

                    $inven_id = $value['id'];
                    $ids[] = $inven_id;

                    $this->Action_model->update_data($data_array, 'tbl_inventory', "inventory_id='" . $value['id'] . "'");
                } else {
                    $data_array['created_at'] = time();
                    $data_array['updated_at'] = time();

                    $inven_id = $this->Action_model->insert_data($data_array, 'tbl_inventory');
                    $ids[] = $inven_id;
                }

                if ($extra_entry_array) {
                    foreach ($extra_entry_array as $keyEntry => $valueEntry) {

                        if (strpos($keyEntry, "additional_") !== false) {
                            $data_array = array(
                                'inventory_id' => $inven_id,
                                'product_additional_detail_id' => str_replace("additional_", "", $keyEntry),
                                'is_active' => $valueEntry
                            );

                            $where_ent = "inventory_id='" . $inven_id . "' AND product_additional_detail_id='" . str_replace("additional_", "", $keyEntry) . "'";
                            $dd_ent = $this->Action_model->select_single('tbl_inventory_additional', $where_ent);
                            if ($dd_ent) {
                                $this->Action_model->update_data($data_array, 'tbl_inventory_additional', $where_ent);
                            } else {
                                $this->Action_model->insert_data($data_array, 'tbl_inventory_additional');
                            }
                        }

                        if (strpos($keyEntry, "plc_") !== false) {
                            $data_array = array(
                                'inventory_id' => $inven_id,
                                'product_plc_detail_id' => str_replace("plc_", "", $keyEntry),
                                'is_active' => $valueEntry
                            );

                            $where_ent = "inventory_id='" . $inven_id . "' AND product_plc_detail_id='" . str_replace("plc_", "", $keyEntry) . "'";
                            $dd_ent = $this->Action_model->select_single('tbl_inventory_plc', $where_ent);
                            if ($dd_ent) {
                                $this->Action_model->update_data($data_array, 'tbl_inventory_plc', $where_ent);
                            } else {
                                $this->Action_model->insert_data($data_array, 'tbl_inventory_plc');
                            }
                        }
                    }
                }

                /*$where = "product_unit_detail_id='".$unit_code."'";
                $dd = $this->Action_model->select_single('tbl_additional_parking_cost',$where);

                if ($dd) {
                    $data_array = array(
                        'add_o_price'=>($this->input->post('add_o_price'))?$this->input->post('add_o_price'):$dd->add_o_price,
                        'add_s_price'=>($this->input->post('add_s_price'))?$this->input->post('add_s_price'):$dd->add_s_price,
                        'add_b_price'=>($this->input->post('add_b_price'))?$this->input->post('add_b_price'):$dd->add_b_price
                    );
                    $this->Action_model->update_data($data_array,'tbl_additional_parking_cost',$where);
                }
                else {
                    $data_array = array(
                        'product_unit_detail_id'=>$unit_code,
                        'add_o_price'=>($this->input->post('add_o_price'))?$this->input->post('add_o_price'):$product_unit_detail_data->o_price,
                        'add_s_price'=>($this->input->post('add_s_price'))?$this->input->post('add_s_price'):$product_unit_detail_data->s_price,
                        'add_b_price'=>($this->input->post('add_b_price'))?$this->input->post('add_b_price'):$product_unit_detail_data->b_price
                    );
                    $this->Action_model->insert_data($data_array,'tbl_additional_parking_cost');
                }*/
            }

            if ($ids) {
                $where = "product_id='" . $product_id . "' AND builder_id='" . $builder_id . "' AND (inventory_id NOT IN (" . implode(',', $ids) . "))";
                $this->Action_model->delete_query('tbl_inventory', $where);
            }
            $array = array('status' => 'success', 'message' => 'Update Successfully');
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function insertdata()
    {
        /*$rrr=$this->Action_model->detail_result('tbl_product_block_details',"block_id!=''");
        foreach ($rrr as $rItem) {
            $rrrp=$this->Action_model->select_single('tbl_products',"product_id='".$rItem->product_id."'");
            $data_array = array('project_type'=>$rrrp->project_type,'property_type'=>$rrrp->property_type);
            $this->Action_model->update_data($data_array,'tbl_product_block_details',"block_id='".$rItem->block_id."'");
        }

        $rrr=$this->Action_model->detail_result('tbl_product_unit_details',"product_unit_detail_id!=''");
        foreach ($rrr as $rItem) {
            $rrrp=$this->Action_model->select_single('tbl_products',"product_id='".$rItem->product_id."'");
            $data_array = array('project_type'=>$rrrp->project_type,'property_type'=>$rrrp->property_type);
            $this->Action_model->update_data($data_array,'tbl_product_unit_details',"product_unit_detail_id='".$rItem->product_unit_detail_id."'");
        }*/

        /*if ($rItem->extra_entry) {
                $inven_id = $rItem->inventory_id;
                $extra_entry_array = json_decode($rItem->extra_entry,true);
                    foreach ($extra_entry_array as $keyEntry => $valueEntry) {
                       
                       if(strpos($keyEntry, "additional_") !== false){
                           $data_array = array(
                            'inventory_id'=>$inven_id,
                            'product_additional_detail_id'=>str_replace("additional_", "", $keyEntry),
                            'is_active'=>$valueEntry
                            );

                           $where_ent = "inventory_id='".$inven_id."' AND product_additional_detail_id='".str_replace("additional_", "", $keyEntry)."'";
                           $dd_ent = $this->Action_model->select_single('tbl_inventory_additional',$where_ent);
                           if ($dd_ent) {
                                $this->Action_model->update_data($data_array,'tbl_inventory_additional',$where_ent);
                           }
                           else {
                                $this->Action_model->insert_data($data_array,'tbl_inventory_additional');
                           }
                       }

                       if(strpos($keyEntry, "plc_") !== false){
                           $data_array = array(
                            'inventory_id'=>$inven_id,
                            'product_plc_detail_id'=>str_replace("plc_", "", $keyEntry),
                            'is_active'=>$valueEntry
                            );

                           $where_ent = "inventory_id='".$inven_id."' AND product_plc_detail_id='".str_replace("plc_", "", $keyEntry)."'";
                           $dd_ent = $this->Action_model->select_single('tbl_inventory_plc',$where_ent);
                           if ($dd_ent) {
                                $this->Action_model->update_data($data_array,'tbl_inventory_plc',$where_ent);
                           }
                           else {
                                $this->Action_model->insert_data($data_array,'tbl_inventory_plc');
                           }
                       }
                    }
                }

                $this->Action_model->update_data(array('extra_entry'=>''),'tbl_inventory',"inventory_id='".$inven_id."'");*/
        //}
    }

    public function get_project_by_builder()
    {
        $array = array();
        $product_list = array();

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

        if ($this->input->post()) {
            $builder_id = $this->input->post('builder_id');
            $where = "tbl_products.agent_id='" . $account_id . "' AND tbl_products.builder_id='" . $builder_id . "'";
            $product_data = $this->Action_model->detail_result('tbl_products', $where, 'product_id,project_name, property_type as property_type_id');
            if ($product_data) {
                $product_list = $product_data;
            }
            $array = array('status' => 'success', 'message' => 'Data Found', 'product_list' => $product_list);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }
    /* manage inventory end */


    /* product edit */
    public function product_save()
    {

        $array = array();

        if ($this->input->post()) {

            $id = $this->input->post('id');
            $record = $this->Action_model->select_single('tbl_products', "product_id='" . $id . "'");
            $property_type = $this->input->post('property_type');

            $block = $this->input->post('block');
            $flat_unit = $this->input->post('flat_unit');
            $villa_unit = $this->input->post('villa_unit');
            $plot_unit = $this->input->post('plot_unit');
            $comm_block = $this->input->post('comm_block');
            $comm_unit = $this->input->post('comm_unit');

            $slug = url_title($this->input->post('project_name'), 'dash', true);

            //print_r($plot_unit);exit;

            $record_array = array(
                'builder_id' => $this->input->post('builder_id'),
                'builder_group_id' => $this->input->post('builder_group_id'),
                'project_name' => $this->input->post('project_name'),
                'rera_application' => $this->input->post('rera_application'),
                'rera_no' => $this->input->post('rera_no'),
                'project_status' => $this->input->post('project_status'),
                'project_type' => $this->input->post('project_type'),
                'commisment_date' => $this->input->post('commisment_date'),
                'land_area' => $this->input->post('land_area'),
                'land_area_unit' => $this->input->post('land_area_unit'),
                'buildup_area' => $this->input->post('buildup_area'),
                'buildup_area_unit' => $this->input->post('buildup_area_unit'),
                'state_id' => $this->input->post('state_id'),
                'city_id' => $this->input->post('city_id'),
                'location' => $this->input->post('location'),
                'address1' => $this->input->post('address1'),
                'lattitude' => $this->input->post('lattitude'),
                'longitude' => $this->input->post('longitude'),
                'property_type' => $this->input->post('property_type')
            );

            if ($record) {
                $record_array['updated_at'] = time();
                $this->Action_model->update_data($record_array, 'tbl_products', "product_id='" . $id . "'");

                if ($this->input->post('project_type') == 3) {
                    if ($comm_block) {
                        $block_id_array = array();

                        foreach ($comm_block as $key => $value) {
                            $block_array = array(
                                'block_name' => $value['block_name'],
                                'no_of_floor' => $value['no_of_floor'],
                                'unit_per_floor' => $value['unit_per_floor'],
                                'no_of_ps_lift' => $value['no_of_ps_lift'],
                                'no_of_service_lift' => $value['no_of_service_lift'],
                                'edp' => $value['edp']
                            );

                            if ($value['block_id'] != '') {
                                $block_id = $value['block_id'];
                                $block_id_array[] = $block_id;

                                $block_array['updated_at'] = time();

                                $this->Action_model->update_data($block_array, 'tbl_product_block_details', "block_id='" . $block_id . "'");
                            } else {
                                if ($value['block_name']) {
                                    $block_array['product_id'] = $id;
                                    $block_array['project_type'] = $this->input->post('project_type');
                                    $block_array['property_type'] = $this->input->post('property_type');
                                    $block_array['created_at'] = time();
                                    $block_array['updated_at'] = time();
                                    $block_id = $this->Action_model->insert_data($block_array, 'tbl_product_block_details');
                                    $block_id_array[] = $block_id;
                                }
                            }
                        }

                        if ($block_id_array) {
                            $this->Action_model->delete_query('tbl_product_block_details', "product_id='" . $id . "' AND project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND (block_id NOT IN (" . implode(',', $block_id_array) . "))");
                        }
                    } else {
                        $this->Action_model->delete_query('tbl_product_block_details', "product_id='" . $id . "' AND project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "'");
                    }

                    if ($comm_unit) {
                        $product_unit_detail_id_array = array();

                        foreach ($comm_unit as $key => $value) {

                            $unit_data = $this->Action_model->select_single('tbl_product_unit_details', "product_unit_detail_id='" . $value['product_unit_detail_id'] . "'");

                            $comm_unit_array = array(
                                'code' => $value['code'],
                                'no_of_unit' => $value['no_of_unit'],
                                'ca' => $value['ca'],
                                'ba' => $value['ba'],
                                'sa' => $value['sa'],
                                'unit' => $value['unit'],
                                'dimension' => $value['dimension'],
                                'sub_category' => $value['sub_category']
                            );

                            if ($value['product_unit_detail_id'] != '') {
                                $product_unit_detail_id = $value['product_unit_detail_id'];
                                $product_unit_detail_id_array[] = $product_unit_detail_id;

                                $comm_unit_array['updated_at'] = time();

                                $this->Action_model->update_data($comm_unit_array, 'tbl_product_unit_details', "product_unit_detail_id='" . $product_unit_detail_id . "'");
                            } else {
                                if ($value['code']) {
                                    $comm_unit_array['product_id'] = $id;
                                    $comm_unit_array['project_type'] = $this->input->post('project_type');
                                    $comm_unit_array['property_type'] = $this->input->post('property_type');
                                    $comm_unit_array['created_at'] = time();
                                    $comm_unit_array['updated_at'] = time();
                                    $product_unit_detail_id = $this->Action_model->insert_data($comm_unit_array, 'tbl_product_unit_details');
                                    $product_unit_detail_id_array[] = $product_unit_detail_id;
                                }
                            }
                        }

                        if ($product_unit_detail_id_array) {
                            $this->Action_model->delete_query('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "' AND (product_unit_detail_id NOT IN (" . implode(',', $product_unit_detail_id_array) . "))");
                        }
                    } else {
                        $this->Action_model->delete_query('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "'");
                    }
                }


                if ($this->input->post('project_type') == 2) {

                    if ($this->input->post('property_type') == 1 || $this->input->post('property_type') == 7) {
                        if ($block) {
                            $block_id_array = array();

                            foreach ($block as $key => $value) {
                                $block_array = array(
                                    'block_name' => $value['block_name'],
                                    'no_of_floor' => $value['no_of_floor'],
                                    'no_of_flat' => $value['no_of_flat'],
                                    'unit_per_floor' => $value['unit_per_floor'],
                                    'no_of_ps_lift' => $value['no_of_ps_lift'],
                                    'no_of_service_lift' => $value['no_of_service_lift'],
                                    'edp' => $value['edp']
                                );

                                if ($value['block_id'] != '') {
                                    $block_id = $value['block_id'];
                                    $block_id_array[] = $block_id;

                                    $block_array['updated_at'] = time();

                                    $this->Action_model->update_data($block_array, 'tbl_product_block_details', "block_id='" . $block_id . "'");
                                } else {
                                    if ($value['block_name']) {
                                        $block_array['product_id'] = $id;
                                        $block_array['project_type'] = $this->input->post('project_type');
                                        $block_array['property_type'] = $this->input->post('property_type');
                                        $block_array['created_at'] = time();
                                        $block_array['updated_at'] = time();
                                        $block_id = $this->Action_model->insert_data($block_array, 'tbl_product_block_details');
                                        $block_id_array[] = $block_id;
                                    }
                                }
                            }

                            if ($block_id_array) {
                                $this->Action_model->delete_query('tbl_product_block_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "' AND (block_id NOT IN (" . implode(',', $block_id_array) . "))");
                            }
                        } else {
                            $this->Action_model->delete_query('tbl_product_block_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "'");
                        }



                        if ($flat_unit) {
                            $product_unit_detail_id_array = array();

                            foreach ($flat_unit as $key => $value) {

                                $image = "";
                                $unit_data = $this->Action_model->select_single('tbl_product_unit_details', "product_unit_detail_id='" . $value['product_unit_detail_id'] . "'");
                                if ($unit_data) {
                                    $image = $unit_data->image;
                                }

                                $config['upload_path'] = './uploads/images/property/unit/';
                                $config['allowed_types'] = 'jpg|png|jpeg';
                                $config['max_size']             = 5 * 1024;
                                $config['remove_spaces'] = TRUE;
                                $config['encrypt_name'] = TRUE;

                                $this->load->library('upload', $config);

                                $this->upload->initialize($config);

                                if (!empty($_FILES['flat_image_' . $key]['name'])) {
                                    if (!$this->upload->do_upload('flat_image_' . $key)) {
                                    } else {
                                        if ($unit_data && $unit_data->image && file_exists('./uploads/images/property/unit/' . $unit_data->image)) {
                                            unlink('./uploads/images/property/unit/' . $unit_data->image);
                                        }

                                        $image = $this->upload->data('file_name');
                                    }
                                }

                                $flat_unit_array = array(
                                    'code' => $value['code'],
                                    'no_of_unit' => $value['no_of_unit'],
                                    'ca' => $value['ca'],
                                    'ba' => $value['ba'],
                                    'sa' => $value['sa'],
                                    'unit' => $value['unit'],
                                    'no_of_bedroom' => $value['no_of_bedroom'],
                                    'no_of_bathroom' => $value['no_of_bathroom'],
                                    'accomodation' => $value['accomodation'],
                                    'basic_cost' => $value['basic_cost'],
                                    'charges' => $value['charges'],
                                    'image' => $image
                                );

                                if ($value['product_unit_detail_id'] != '') {
                                    $product_unit_detail_id = $value['product_unit_detail_id'];
                                    $product_unit_detail_id_array[] = $product_unit_detail_id;

                                    $flat_unit_array['updated_at'] = time();

                                    $this->Action_model->update_data($flat_unit_array, 'tbl_product_unit_details', "product_unit_detail_id='" . $product_unit_detail_id . "'");
                                } else {
                                    if ($value['code']) {
                                        $flat_unit_array['product_id'] = $id;
                                        $flat_unit_array['project_type'] = $this->input->post('project_type');
                                        $flat_unit_array['property_type'] = $this->input->post('property_type');
                                        $flat_unit_array['created_at'] = time();
                                        $flat_unit_array['updated_at'] = time();
                                        $product_unit_detail_id = $this->Action_model->insert_data($flat_unit_array, 'tbl_product_unit_details');
                                        $product_unit_detail_id_array[] = $product_unit_detail_id;
                                    }
                                }
                            }

                            if ($product_unit_detail_id_array) {

                                $unit_detail_imgs = $this->Action_model->detail_result('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "' AND (product_unit_detail_id NOT IN (" . implode(',', $product_unit_detail_id_array) . "))");
                                foreach ($unit_detail_imgs as $unit_detail_img) {
                                    if ($unit_detail_img->image) {
                                        unlink('./uploads/images/property/unit/' . $unit_detail_img->image);
                                    }
                                }
                                $this->Action_model->delete_query('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "' AND (product_unit_detail_id NOT IN (" . implode(',', $product_unit_detail_id_array) . "))");
                            }
                        } else {
                            $unit_detail_imgs = $this->Action_model->detail_result('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "'");
                            foreach ($unit_detail_imgs as $unit_detail_img) {
                                if ($unit_detail_img->image) {
                                    unlink('./uploads/images/property/unit/' . $unit_detail_img->image);
                                }
                            }
                            $this->Action_model->delete_query('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "'");
                        }
                    }


                    if ($this->input->post('property_type') == 2) {
                        if ($villa_unit) {
                            $product_unit_detail_id_array = array();

                            foreach ($villa_unit as $key => $value) {

                                $image = "";
                                $unit_data = $this->Action_model->select_single('tbl_product_unit_details', "product_unit_detail_id='" . $value['product_unit_detail_id'] . "'");
                                if ($unit_data) {
                                    $image = $unit_data->image;
                                }

                                $config['upload_path'] = './uploads/images/property/unit/';
                                $config['allowed_types'] = 'jpg|png|jpeg';
                                $config['max_size']             = 5 * 1024;
                                $config['remove_spaces'] = TRUE;
                                $config['encrypt_name'] = TRUE;

                                $this->load->library('upload', $config);

                                $this->upload->initialize($config);

                                if (!empty($_FILES['villa_image_' . $key]['name'])) {
                                    if (!$this->upload->do_upload('villa_image_' . $key)) {
                                    } else {
                                        if ($unit_data && $unit_data->image && file_exists('./uploads/images/property/unit/' . $unit_data->image)) {
                                            unlink('./uploads/images/property/unit/' . $unit_data->image);
                                        }

                                        $image = $this->upload->data('file_name');
                                    }
                                }

                                $villa_unit_array = array(
                                    'code' => $value['code'],
                                    'plot_size' => $value['plot_size'],
                                    'plot_unit' => $value['plot_unit'],
                                    'dimension' => $value['dimension'],
                                    'facing' => $value['facing'],
                                    'no_of_unit' => $value['no_of_unit'],
                                    'accomodation' => $value['accomodation'],
                                    'no_of_floor' => $value['no_of_floor'],
                                    'construction_area' => $value['construction_area'],
                                    'con_unit' => $value['con_unit'],
                                    'no_of_bedroom' => $value['no_of_bedroom'],
                                    'no_of_bathroom' => $value['no_of_bathroom'],
                                    'no_of_unit' => $value['no_of_unit'],
                                    'basic_cost' => $value['basic_cost'],
                                    'charges' => $value['charges'],
                                    'image' => $image
                                );

                                if ($value['product_unit_detail_id'] != '') {
                                    $product_unit_detail_id = $value['product_unit_detail_id'];
                                    $product_unit_detail_id_array[] = $product_unit_detail_id;

                                    $villa_unit_array['updated_at'] = time();

                                    $this->Action_model->update_data($villa_unit_array, 'tbl_product_unit_details', "product_unit_detail_id='" . $product_unit_detail_id . "'");
                                } else {
                                    if ($value['code']) {
                                        $villa_unit_array['product_id'] = $id;
                                        $villa_unit_array['project_type'] = $this->input->post('project_type');
                                        $villa_unit_array['property_type'] = $this->input->post('property_type');
                                        $villa_unit_array['created_at'] = time();
                                        $villa_unit_array['updated_at'] = time();
                                        $product_unit_detail_id = $this->Action_model->insert_data($villa_unit_array, 'tbl_product_unit_details');
                                        $product_unit_detail_id_array[] = $product_unit_detail_id;
                                    }
                                }
                            }

                            if ($product_unit_detail_id_array) {

                                $unit_detail_imgs = $this->Action_model->detail_result('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "' AND (product_unit_detail_id NOT IN (" . implode(',', $product_unit_detail_id_array) . "))");
                                foreach ($unit_detail_imgs as $unit_detail_img) {
                                    if ($unit_detail_img->image) {
                                        unlink('./uploads/images/property/unit/' . $unit_detail_img->image);
                                    }
                                }
                                $this->Action_model->delete_query('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "' AND (product_unit_detail_id NOT IN (" . implode(',', $product_unit_detail_id_array) . "))");
                            }
                        } else {
                            $unit_detail_imgs = $this->Action_model->detail_result('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "'");
                            foreach ($unit_detail_imgs as $unit_detail_img) {
                                if ($unit_detail_img->image) {
                                    unlink('./uploads/images/property/unit/' . $unit_detail_img->image);
                                }
                            }
                            $this->Action_model->delete_query('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "'");
                        }
                    }



                    if ($this->input->post('property_type') == 3) {
                        if ($plot_unit) {
                            $product_unit_detail_id_array = array();

                            foreach ($plot_unit as $key => $value) {

                                $image = "";
                                $unit_data = $this->Action_model->select_single('tbl_product_unit_details', "product_unit_detail_id='" . $value['product_unit_detail_id'] . "'");
                                if ($unit_data) {
                                    $image = $unit_data->image;
                                }

                                $config['upload_path'] = './uploads/images/property/unit/';
                                $config['allowed_types'] = 'jpg|png|jpeg';
                                $config['max_size']             = 5 * 1024;
                                $config['remove_spaces'] = TRUE;
                                $config['encrypt_name'] = TRUE;

                                $this->load->library('upload', $config);

                                $this->upload->initialize($config);

                                if (!empty($_FILES['plot_image_' . $key]['name'])) {
                                    if (!$this->upload->do_upload('plot_image_' . $key)) {
                                    } else {
                                        if ($unit_data && $unit_data->image && file_exists('./uploads/images/property/unit/' . $unit_data->image)) {
                                            unlink('./uploads/images/property/unit/' . $unit_data->image);
                                        }

                                        $image = $this->upload->data('file_name');
                                    }
                                }

                                $plot_unit_array = array(
                                    'code' => $value['code'],
                                    'plot_size' => $value['plot_size'],
                                    'plot_unit' => $value['plot_unit'],
                                    'dimension' => $value['dimension'],
                                    'facing' => $value['facing'],
                                    'no_of_unit' => $value['no_of_unit'],
                                    'basic_cost' => $value['basic_cost'],
                                    'charges' => $value['charges'],
                                    'image' => $image
                                );

                                if ($value['product_unit_detail_id'] != '') {
                                    $product_unit_detail_id = $value['product_unit_detail_id'];
                                    $product_unit_detail_id_array[] = $product_unit_detail_id;

                                    $plot_unit_array['updated_at'] = time();

                                    $this->Action_model->update_data($plot_unit_array, 'tbl_product_unit_details', "product_unit_detail_id='" . $product_unit_detail_id . "'");
                                } else {
                                    if ($value['code']) {
                                        $plot_unit_array['product_id'] = $id;
                                        $plot_unit_array['project_type'] = $this->input->post('project_type');
                                        $plot_unit_array['property_type'] = $this->input->post('property_type');
                                        $plot_unit_array['created_at'] = time();
                                        $plot_unit_array['updated_at'] = time();
                                        $product_unit_detail_id = $this->Action_model->insert_data($plot_unit_array, 'tbl_product_unit_details');
                                        $product_unit_detail_id_array[] = $product_unit_detail_id;
                                    }
                                }
                            }

                            if ($product_unit_detail_id_array) {

                                $unit_detail_imgs = $this->Action_model->detail_result('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "' AND (product_unit_detail_id NOT IN (" . implode(',', $product_unit_detail_id_array) . "))");
                                foreach ($unit_detail_imgs as $unit_detail_img) {
                                    if ($unit_detail_img->image) {
                                        unlink('./uploads/images/property/unit/' . $unit_detail_img->image);
                                    }
                                }
                                $this->Action_model->delete_query('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "' AND (product_unit_detail_id NOT IN (" . implode(',', $product_unit_detail_id_array) . "))");
                            }
                        } else {
                            $unit_detail_imgs = $this->Action_model->detail_result('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "'");
                            foreach ($unit_detail_imgs as $unit_detail_img) {
                                if ($unit_detail_img->image) {
                                    unlink('./uploads/images/property/unit/' . $unit_detail_img->image);
                                }
                            }
                            $this->Action_model->delete_query('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "'");
                        }
                    }
                }

                $comm_blocks = array();
                $comm_block_data = $this->Action_model->detail_result('tbl_product_block_details', "product_id='" . $id . "' AND project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' ORDER BY block_id ASC");
                if ($comm_block_data) {
                    $comm_blocks = $comm_block_data;
                }

                $comm_units = array();
                $comm_unit_data = $this->Action_model->detail_result('tbl_product_unit_details', "product_id='" . $id . "' AND project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' ORDER BY product_unit_detail_id ASC");
                if ($comm_unit_data) {
                    $comm_units = $comm_unit_data;
                }

                $blocks = array();
                $block_data = $this->Action_model->detail_result('tbl_product_block_details', "product_id='" . $id . "' AND project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' ORDER BY block_id ASC");
                if ($block_data) {
                    $blocks = $block_data;
                }


                $product_flat_unit_details = array();
                $product_flat_unit_detail_data = $this->Action_model->detail_result('tbl_product_unit_details', "product_id='" . $id . "' AND project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' ORDER BY product_unit_detail_id ASC");
                if ($product_flat_unit_detail_data) {
                    $product_flat_unit_details = $product_flat_unit_detail_data;
                }

                $product_villa_unit_details = array();
                $product_villa_unit_detail_data = $this->Action_model->detail_result('tbl_product_unit_details', "product_id='" . $id . "' AND project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' ORDER BY product_unit_detail_id ASC");
                if ($product_villa_unit_detail_data) {
                    $product_villa_unit_details = $product_villa_unit_detail_data;
                }

                $product_plot_unit_details = array();
                $product_plot_unit_detail_data = $this->Action_model->detail_result('tbl_product_unit_details', "product_id='" . $id . "' AND project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' ORDER BY product_unit_detail_id ASC");
                if ($product_plot_unit_detail_data) {
                    $product_plot_unit_details = $product_plot_unit_detail_data;
                }

                $additional_details = array();
                $additional_detail_data = $this->Action_model->detail_result('tbl_product_additional_details', "product_id='" . $id . "' ORDER BY product_additional_detail_id ASC");
                if ($additional_detail_data) {
                    $additional_details = $additional_detail_data;
                }

                $plc_details = array();
                $plc_detail_data = $this->Action_model->detail_result('tbl_product_plc_details', "product_id='" . $id . "' ORDER BY product_plc_detail_id ASC");
                if ($plc_detail_data) {
                    $plc_details = $plc_detail_data;
                }

                $product_specifications = array();
                $product_specification_data = $this->Action_model->detail_result('tbl_product_specifications', "product_id='" . $id . "' ORDER BY product_specification_id ASC");
                if ($product_specification_data) {
                    $product_specifications = $product_specification_data;
                }

                $record = $this->Action_model->select_single('tbl_products', "product_id='" . $id . "'");

                $array = array('status' => 'success', 'message' => 'Project Updated Successfully!!', 'pid' => $id, 'blocks' => $blocks, 'product_flat_unit_details' => $product_flat_unit_details, 'product_villa_unit_details' => $product_villa_unit_details, 'product_plot_unit_details' => $product_plot_unit_details, 'record' => $record, 'additional_details' => $additional_details, 'plc_details' => $plc_details, 'product_specifications' => $product_specifications, 'comm_blocks' => $comm_blocks, 'comm_units' => $comm_units);
            } else {
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();
                $record_array['slug'] = $slug;
                $record_array['product_status'] = 1;
                $record_array['date_register'] = date("d-m-Y");
                $id = $this->Action_model->insert_data($record_array, 'tbl_products');

                if ($this->input->post('project_type') == 3) {
                    if ($comm_block) {
                        $block_id_array = array();

                        foreach ($comm_block as $key => $value) {
                            $block_array = array(
                                'block_name' => $value['block_name'],
                                'no_of_floor' => $value['no_of_floor'],
                                'unit_per_floor' => $value['unit_per_floor'],
                                'no_of_ps_lift' => $value['no_of_ps_lift'],
                                'no_of_service_lift' => $value['no_of_service_lift'],
                                'edp' => $value['edp']
                            );

                            if ($value['block_id'] != '') {
                                $block_id = $value['block_id'];
                                $block_id_array[] = $block_id;

                                $block_array['updated_at'] = time();

                                $this->Action_model->update_data($block_array, 'tbl_product_block_details', "block_id='" . $block_id . "'");
                            } else {
                                if ($value['block_name']) {
                                    $block_array['product_id'] = $id;
                                    $block_array['project_type'] = $this->input->post('project_type');
                                    $block_array['property_type'] = $this->input->post('property_type');
                                    $block_array['created_at'] = time();
                                    $block_array['updated_at'] = time();
                                    $block_id = $this->Action_model->insert_data($block_array, 'tbl_product_block_details');
                                    $block_id_array[] = $block_id;
                                }
                            }
                        }

                        if ($block_id_array) {
                            $this->Action_model->delete_query('tbl_product_block_details', "product_id='" . $id . "' AND project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND (block_id NOT IN (" . implode(',', $block_id_array) . "))");
                        }
                    } else {
                        $this->Action_model->delete_query('tbl_product_block_details', "product_id='" . $id . "' AND project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "'");
                    }

                    if ($comm_unit) {
                        $product_unit_detail_id_array = array();

                        foreach ($comm_unit as $key => $value) {

                            $unit_data = $this->Action_model->select_single('tbl_product_unit_details', "product_unit_detail_id='" . $value['product_unit_detail_id'] . "'");

                            $comm_unit_array = array(
                                'code' => $value['code'],
                                'no_of_unit' => $value['no_of_unit'],
                                'ca' => $value['ca'],
                                'ba' => $value['ba'],
                                'sa' => $value['sa'],
                                'unit' => $value['unit'],
                                'dimension' => $value['dimension'],
                                'sub_category' => $value['sub_category']
                            );

                            if ($value['product_unit_detail_id'] != '') {
                                $product_unit_detail_id = $value['product_unit_detail_id'];
                                $product_unit_detail_id_array[] = $product_unit_detail_id;

                                $comm_unit_array['updated_at'] = time();

                                $this->Action_model->update_data($comm_unit_array, 'tbl_product_unit_details', "product_unit_detail_id='" . $product_unit_detail_id . "'");
                            } else {
                                if ($value['code']) {
                                    $comm_unit_array['product_id'] = $id;
                                    $comm_unit_array['project_type'] = $this->input->post('project_type');
                                    $comm_unit_array['property_type'] = $this->input->post('property_type');
                                    $comm_unit_array['created_at'] = time();
                                    $comm_unit_array['updated_at'] = time();
                                    $product_unit_detail_id = $this->Action_model->insert_data($comm_unit_array, 'tbl_product_unit_details');
                                    $product_unit_detail_id_array[] = $product_unit_detail_id;
                                }
                            }
                        }

                        if ($product_unit_detail_id_array) {
                            $this->Action_model->delete_query('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "' AND (product_unit_detail_id NOT IN (" . implode(',', $product_unit_detail_id_array) . "))");
                        }
                    } else {
                        $this->Action_model->delete_query('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "'");
                    }
                }


                if ($this->input->post('project_type') == 2) {

                    if ($this->input->post('property_type') == 1 || $this->input->post('property_type') == 7) {
                        if ($block) {
                            $block_id_array = array();

                            foreach ($block as $key => $value) {
                                $block_array = array(
                                    'block_name' => $value['block_name'],
                                    'no_of_floor' => $value['no_of_floor'],
                                    'no_of_flat' => $value['no_of_flat'],
                                    'unit_per_floor' => $value['unit_per_floor'],
                                    'no_of_ps_lift' => $value['no_of_ps_lift'],
                                    'no_of_service_lift' => $value['no_of_service_lift'],
                                    'edp' => $value['edp']
                                );

                                if ($value['block_id'] != '') {
                                    $block_id = $value['block_id'];
                                    $block_id_array[] = $block_id;

                                    $block_array['updated_at'] = time();

                                    $this->Action_model->update_data($block_array, 'tbl_product_block_details', "block_id='" . $block_id . "'");
                                } else {
                                    if ($value['block_name']) {
                                        $block_array['product_id'] = $id;
                                        $block_array['project_type'] = $this->input->post('project_type');
                                        $block_array['property_type'] = $this->input->post('property_type');
                                        $block_array['created_at'] = time();
                                        $block_array['updated_at'] = time();
                                        $block_id = $this->Action_model->insert_data($block_array, 'tbl_product_block_details');
                                        $block_id_array[] = $block_id;
                                    }
                                }
                            }

                            if ($block_id_array) {
                                $this->Action_model->delete_query('tbl_product_block_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "' AND (block_id NOT IN (" . implode(',', $block_id_array) . "))");
                            }
                        } else {
                            $this->Action_model->delete_query('tbl_product_block_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "'");
                        }



                        if ($flat_unit) {
                            $product_unit_detail_id_array = array();

                            foreach ($flat_unit as $key => $value) {

                                $image = "";
                                $unit_data = $this->Action_model->select_single('tbl_product_unit_details', "product_unit_detail_id='" . $value['product_unit_detail_id'] . "'");
                                if ($unit_data) {
                                    $image = $unit_data->image;
                                }

                                $config['upload_path'] = './uploads/images/property/unit/';
                                $config['allowed_types'] = 'jpg|png|jpeg';
                                $config['max_size']             = 5 * 1024;
                                $config['remove_spaces'] = TRUE;
                                $config['encrypt_name'] = TRUE;

                                $this->load->library('upload', $config);

                                $this->upload->initialize($config);

                                if (!empty($_FILES['flat_image_' . $key]['name'])) {
                                    if (!$this->upload->do_upload('flat_image_' . $key)) {
                                    } else {
                                        if ($unit_data && $unit_data->image && file_exists('./uploads/images/property/unit/' . $unit_data->image)) {
                                            unlink('./uploads/images/property/unit/' . $unit_data->image);
                                        }

                                        $image = $this->upload->data('file_name');
                                    }
                                }

                                $flat_unit_array = array(
                                    'code' => $value['code'],
                                    'no_of_unit' => $value['no_of_unit'],
                                    'ca' => $value['ca'],
                                    'ba' => $value['ba'],
                                    'sa' => $value['sa'],
                                    'unit' => $value['unit'],
                                    'no_of_bedroom' => $value['no_of_bedroom'],
                                    'no_of_bathroom' => $value['no_of_bathroom'],
                                    'accomodation' => $value['accomodation'],
                                    'basic_cost' => $value['basic_cost'],
                                    'charges' => $value['charges'],
                                    'image' => $image
                                );

                                if ($value['product_unit_detail_id'] != '') {
                                    $product_unit_detail_id = $value['product_unit_detail_id'];
                                    $product_unit_detail_id_array[] = $product_unit_detail_id;

                                    $flat_unit_array['updated_at'] = time();

                                    $this->Action_model->update_data($flat_unit_array, 'tbl_product_unit_details', "product_unit_detail_id='" . $product_unit_detail_id . "'");
                                } else {
                                    if ($value['code']) {
                                        $flat_unit_array['product_id'] = $id;
                                        $flat_unit_array['project_type'] = $this->input->post('project_type');
                                        $flat_unit_array['property_type'] = $this->input->post('property_type');
                                        $flat_unit_array['created_at'] = time();
                                        $flat_unit_array['updated_at'] = time();
                                        $product_unit_detail_id = $this->Action_model->insert_data($flat_unit_array, 'tbl_product_unit_details');
                                        $product_unit_detail_id_array[] = $product_unit_detail_id;
                                    }
                                }
                            }

                            if ($product_unit_detail_id_array) {

                                $unit_detail_imgs = $this->Action_model->detail_result('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "' AND (product_unit_detail_id NOT IN (" . implode(',', $product_unit_detail_id_array) . "))");
                                foreach ($unit_detail_imgs as $unit_detail_img) {
                                    if ($unit_detail_img->image) {
                                        unlink('./uploads/images/property/unit/' . $unit_detail_img->image);
                                    }
                                }
                                $this->Action_model->delete_query('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "' AND (product_unit_detail_id NOT IN (" . implode(',', $product_unit_detail_id_array) . "))");
                            }
                        } else {
                            $unit_detail_imgs = $this->Action_model->detail_result('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "'");
                            foreach ($unit_detail_imgs as $unit_detail_img) {
                                if ($unit_detail_img->image) {
                                    unlink('./uploads/images/property/unit/' . $unit_detail_img->image);
                                }
                            }
                            $this->Action_model->delete_query('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "'");
                        }
                    }


                    if ($this->input->post('property_type') == 2) {
                        if ($villa_unit) {
                            $product_unit_detail_id_array = array();

                            foreach ($villa_unit as $key => $value) {

                                $image = "";
                                $unit_data = $this->Action_model->select_single('tbl_product_unit_details', "product_unit_detail_id='" . $value['product_unit_detail_id'] . "'");
                                if ($unit_data) {
                                    $image = $unit_data->image;
                                }

                                $config['upload_path'] = './uploads/images/property/unit/';
                                $config['allowed_types'] = 'jpg|png|jpeg';
                                $config['max_size']             = 5 * 1024;
                                $config['remove_spaces'] = TRUE;
                                $config['encrypt_name'] = TRUE;

                                $this->load->library('upload', $config);

                                $this->upload->initialize($config);

                                if (!empty($_FILES['villa_image_' . $key]['name'])) {
                                    if (!$this->upload->do_upload('villa_image_' . $key)) {
                                    } else {
                                        if ($unit_data && $unit_data->image && file_exists('./uploads/images/property/unit/' . $unit_data->image)) {
                                            unlink('./uploads/images/property/unit/' . $unit_data->image);
                                        }

                                        $image = $this->upload->data('file_name');
                                    }
                                }

                                $villa_unit_array = array(
                                    'code' => $value['code'],
                                    'plot_size' => $value['plot_size'],
                                    'plot_unit' => $value['plot_unit'],
                                    'dimension' => $value['dimension'],
                                    'facing' => $value['facing'],
                                    'no_of_unit' => $value['no_of_unit'],
                                    'accomodation' => $value['accomodation'],
                                    'no_of_floor' => $value['no_of_floor'],
                                    'construction_area' => $value['construction_area'],
                                    'con_unit' => $value['con_unit'],
                                    'no_of_bedroom' => $value['no_of_bedroom'],
                                    'no_of_bathroom' => $value['no_of_bathroom'],
                                    'no_of_unit' => $value['no_of_unit'],
                                    'basic_cost' => $value['basic_cost'],
                                    'charges' => $value['charges'],
                                    'image' => $image
                                );

                                if ($value['product_unit_detail_id'] != '') {
                                    $product_unit_detail_id = $value['product_unit_detail_id'];
                                    $product_unit_detail_id_array[] = $product_unit_detail_id;

                                    $villa_unit_array['updated_at'] = time();

                                    $this->Action_model->update_data($villa_unit_array, 'tbl_product_unit_details', "product_unit_detail_id='" . $product_unit_detail_id . "'");
                                } else {
                                    if ($value['code']) {
                                        $villa_unit_array['product_id'] = $id;
                                        $villa_unit_array['project_type'] = $this->input->post('project_type');
                                        $villa_unit_array['property_type'] = $this->input->post('property_type');
                                        $villa_unit_array['created_at'] = time();
                                        $villa_unit_array['updated_at'] = time();
                                        $product_unit_detail_id = $this->Action_model->insert_data($villa_unit_array, 'tbl_product_unit_details');
                                        $product_unit_detail_id_array[] = $product_unit_detail_id;
                                    }
                                }
                            }

                            if ($product_unit_detail_id_array) {

                                $unit_detail_imgs = $this->Action_model->detail_result('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "' AND (product_unit_detail_id NOT IN (" . implode(',', $product_unit_detail_id_array) . "))");
                                foreach ($unit_detail_imgs as $unit_detail_img) {
                                    if ($unit_detail_img->image) {
                                        unlink('./uploads/images/property/unit/' . $unit_detail_img->image);
                                    }
                                }
                                $this->Action_model->delete_query('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "' AND (product_unit_detail_id NOT IN (" . implode(',', $product_unit_detail_id_array) . "))");
                            }
                        } else {
                            $unit_detail_imgs = $this->Action_model->detail_result('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "'");
                            foreach ($unit_detail_imgs as $unit_detail_img) {
                                if ($unit_detail_img->image) {
                                    unlink('./uploads/images/property/unit/' . $unit_detail_img->image);
                                }
                            }
                            $this->Action_model->delete_query('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "'");
                        }
                    }



                    if ($this->input->post('property_type') == 3) {
                        if ($plot_unit) {
                            $product_unit_detail_id_array = array();

                            foreach ($plot_unit as $key => $value) {

                                $image = "";
                                $unit_data = $this->Action_model->select_single('tbl_product_unit_details', "product_unit_detail_id='" . $value['product_unit_detail_id'] . "'");
                                if ($unit_data) {
                                    $image = $unit_data->image;
                                }

                                $config['upload_path'] = './uploads/images/property/unit/';
                                $config['allowed_types'] = 'jpg|png|jpeg';
                                $config['max_size']             = 5 * 1024;
                                $config['remove_spaces'] = TRUE;
                                $config['encrypt_name'] = TRUE;

                                $this->load->library('upload', $config);

                                $this->upload->initialize($config);

                                if (!empty($_FILES['plot_image_' . $key]['name'])) {
                                    if (!$this->upload->do_upload('plot_image_' . $key)) {
                                    } else {
                                        if ($unit_data && $unit_data->image && file_exists('./uploads/images/property/unit/' . $unit_data->image)) {
                                            unlink('./uploads/images/property/unit/' . $unit_data->image);
                                        }

                                        $image = $this->upload->data('file_name');
                                    }
                                }

                                $plot_unit_array = array(
                                    'code' => $value['code'],
                                    'plot_size' => $value['plot_size'],
                                    'plot_unit' => $value['plot_unit'],
                                    'dimension' => $value['dimension'],
                                    'facing' => $value['facing'],
                                    'no_of_unit' => $value['no_of_unit'],
                                    'basic_cost' => $value['basic_cost'],
                                    'charges' => $value['charges'],
                                    'image' => $image
                                );

                                if ($value['product_unit_detail_id'] != '') {
                                    $product_unit_detail_id = $value['product_unit_detail_id'];
                                    $product_unit_detail_id_array[] = $product_unit_detail_id;

                                    $plot_unit_array['updated_at'] = time();

                                    $this->Action_model->update_data($plot_unit_array, 'tbl_product_unit_details', "product_unit_detail_id='" . $product_unit_detail_id . "'");
                                } else {
                                    if ($value['code']) {
                                        $plot_unit_array['product_id'] = $id;
                                        $plot_unit_array['project_type'] = $this->input->post('project_type');
                                        $plot_unit_array['property_type'] = $this->input->post('property_type');
                                        $plot_unit_array['created_at'] = time();
                                        $plot_unit_array['updated_at'] = time();
                                        $product_unit_detail_id = $this->Action_model->insert_data($plot_unit_array, 'tbl_product_unit_details');
                                        $product_unit_detail_id_array[] = $product_unit_detail_id;
                                    }
                                }
                            }

                            if ($product_unit_detail_id_array) {

                                $unit_detail_imgs = $this->Action_model->detail_result('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "' AND (product_unit_detail_id NOT IN (" . implode(',', $product_unit_detail_id_array) . "))");
                                foreach ($unit_detail_imgs as $unit_detail_img) {
                                    if ($unit_detail_img->image) {
                                        unlink('./uploads/images/property/unit/' . $unit_detail_img->image);
                                    }
                                }
                                $this->Action_model->delete_query('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "' AND (product_unit_detail_id NOT IN (" . implode(',', $product_unit_detail_id_array) . "))");
                            }
                        } else {
                            $unit_detail_imgs = $this->Action_model->detail_result('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "'");
                            foreach ($unit_detail_imgs as $unit_detail_img) {
                                if ($unit_detail_img->image) {
                                    unlink('./uploads/images/property/unit/' . $unit_detail_img->image);
                                }
                            }
                            $this->Action_model->delete_query('tbl_product_unit_details', "project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' AND product_id='" . $id . "'");
                        }
                    }
                }

                $comm_blocks = array();
                $comm_block_data = $this->Action_model->detail_result('tbl_product_block_details', "product_id='" . $id . "' AND project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' ORDER BY block_id ASC");
                if ($comm_block_data) {
                    $comm_blocks = $comm_block_data;
                }

                $comm_units = array();
                $comm_unit_data = $this->Action_model->detail_result('tbl_product_unit_details', "product_id='" . $id . "' AND project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' ORDER BY product_unit_detail_id ASC");
                if ($comm_unit_data) {
                    $comm_units = $comm_unit_data;
                }

                $blocks = array();
                $block_data = $this->Action_model->detail_result('tbl_product_block_details', "product_id='" . $id . "' AND project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' ORDER BY block_id ASC");
                if ($block_data) {
                    $blocks = $block_data;
                }


                $product_flat_unit_details = array();
                $product_flat_unit_detail_data = $this->Action_model->detail_result('tbl_product_unit_details', "product_id='" . $id . "' AND project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' ORDER BY product_unit_detail_id ASC");
                if ($product_flat_unit_detail_data) {
                    $product_flat_unit_details = $product_flat_unit_detail_data;
                }

                $product_villa_unit_details = array();
                $product_villa_unit_detail_data = $this->Action_model->detail_result('tbl_product_unit_details', "product_id='" . $id . "' AND project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' ORDER BY product_unit_detail_id ASC");
                if ($product_villa_unit_detail_data) {
                    $product_villa_unit_details = $product_villa_unit_detail_data;
                }

                $product_plot_unit_details = array();
                $product_plot_unit_detail_data = $this->Action_model->detail_result('tbl_product_unit_details', "product_id='" . $id . "' AND project_type='" . $this->input->post('project_type') . "' AND property_type='" . $this->input->post('property_type') . "' ORDER BY product_unit_detail_id ASC");
                if ($product_plot_unit_detail_data) {
                    $product_plot_unit_details = $product_plot_unit_detail_data;
                }

                $additional_details = array();
                $additional_detail_data = $this->Action_model->detail_result('tbl_product_additional_details', "product_id='" . $id . "' ORDER BY product_additional_detail_id ASC");
                if ($additional_detail_data) {
                    $additional_details = $additional_detail_data;
                }

                $plc_details = array();
                $plc_detail_data = $this->Action_model->detail_result('tbl_product_plc_details', "product_id='" . $id . "' ORDER BY product_plc_detail_id ASC");
                if ($plc_detail_data) {
                    $plc_details = $plc_detail_data;
                }

                $product_specifications = array();
                $product_specification_data = $this->Action_model->detail_result('tbl_product_specifications', "product_id='" . $id . "' ORDER BY product_specification_id ASC");
                if ($product_specification_data) {
                    $product_specifications = $product_specification_data;
                }

                $record = $this->Action_model->select_single('tbl_products', "product_id='" . $id . "'");

                $array = array('status' => 'success', 'message' => 'Project Added Successfully!!', 'pid' => $id, 'blocks' => $blocks, 'product_flat_unit_details' => $product_flat_unit_details, 'product_villa_unit_details' => $product_villa_unit_details, 'product_plot_unit_details' => $product_plot_unit_details, 'record' => $record, 'additional_details' => $additional_details, 'plc_details' => $plc_details, 'product_specifications' => $product_specifications, 'comm_blocks' => $comm_blocks, 'comm_units' => $comm_units);
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function product_save2()
    {
        $array = array();

        if ($this->input->post()) {

            $id = $this->input->post('id');
            $parking_type = $this->input->post('parking_type');
            $record = $this->Action_model->select_single('tbl_products', "product_id='" . $id . "'");

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
                'b_cost_gst' => $b_cost_gst,
                'b_cost_unit' => $this->input->post('b_cost_unit'),
                'club_cost_unit' => $this->input->post('club_cost_unit'),
                'club_gst' => $club_gst,
                'o_price' => $this->input->post('o_price'),
                's_price' => $this->input->post('s_price'),
                'b_price' => $this->input->post('b_price'),
                'parking_open' => $this->input->post('parking_open'),
                'parking_stilt' => $this->input->post('parking_stilt'),
                'parking_basment' => $this->input->post('parking_basment'),
                'parking_gst' => $parking_gst,
                'amenitie' => $amenitie,
                'finance' => $finance
            );

            if ($record) {
                $record_array['updated_at'] = time();
                $this->Action_model->update_data($record_array, 'tbl_products', "product_id='" . $id . "'");


                $add_detail = $this->input->post('add_detail');
                if ($add_detail) {
                    $product_additional_detail_id_array = array();

                    foreach ($add_detail as $key => $value) {

                        $id = $this->input->post('id');
                        $unit_data = $this->Action_model->select_single('tbl_product_additional_details', "product_id='" . $id . "' AND product_additional_detail_id='" . $value['product_additional_detail_id'] . "'");

                        $gst = 0.00;
                        if (isset($value['gst_check'])) {
                            $gst = $this->input->post('gst');
                        }

                        $add_detail_array = array(
                            'price_comp_id' => $value['price_comp_id'],
                            'gst' => $value['gst'],
                            'price' => $value['price'],
                            'unit' => $value['unit']
                        );

                        if ($value['product_additional_detail_id'] != '') {
                            $product_additional_detail_id = $value['product_additional_detail_id'];
                            $product_additional_detail_id_array[] = $product_additional_detail_id;

                            $add_detail_array['updated_at'] = time();

                            $this->Action_model->update_data($add_detail_array, 'tbl_product_additional_details', "product_id='" . $id . "' 
                                AND product_additional_detail_id='" . $product_additional_detail_id . "'");
                        } else {
                            $add_detail_array['product_id'] = $id;
                            $add_detail_array['created_at'] = time();
                            $add_detail_array['updated_at'] = time();
                            $product_additional_detail_id = $this->Action_model->insert_data($add_detail_array, 'tbl_product_additional_details');
                            $product_additional_detail_id_array[] = $product_additional_detail_id;
                        }
                    }

                    if ($product_additional_detail_id_array) {

                        $this->Action_model->delete_query('tbl_product_additional_details', "product_id='" . $id . "' AND (product_additional_detail_id NOT IN (" . implode(',', $product_additional_detail_id_array) . "))");
                    }
                } else {
                    $this->Action_model->delete_query('tbl_product_additional_details', "product_id='" . $id . "'");
                }

                $product_add_detail_details = array();
                $product_add_detail_detail_data = $this->Action_model->detail_result('tbl_product_additional_details', "product_id='" . $id . "' ORDER BY product_additional_detail_id ASC");
                if ($product_add_detail_detail_data) {
                    $product_add_detail_details = $product_add_detail_detail_data;
                }

                $plc_detail = $this->input->post('plc_detail');
                if ($plc_detail) {
                    $product_plc_detail_id_array = array();

                    foreach ($plc_detail as $key => $value) {

                        $id = $this->input->post('id');
                        $unit_data = $this->Action_model->select_single('tbl_product_plc_details', "product_id='" . $id . "' AND product_plc_detail_id='" . $value['product_plc_detail_id'] . "'");

                        $gst = 0.00;
                        if (isset($value['gst_check'])) {
                            $gst = $this->input->post('gst');
                        }

                        $plc_detail_array = array(
                            'price_comp_id' => $value['price_comp_id'],
                            'gst' => $value['gst'],
                            'price' => $value['price'],
                            'unit' => $value['unit']
                        );

                        if ($value['product_plc_detail_id'] != '') {
                            $product_plc_detail_id = $value['product_plc_detail_id'];
                            $product_plc_detail_id_array[] = $product_plc_detail_id;

                            $plc_detail_array['updated_at'] = time();

                            $this->Action_model->update_data($plc_detail_array, 'tbl_product_plc_details', "product_id='" . $id . "' 
                                AND product_plc_detail_id='" . $product_plc_detail_id . "'");
                        } else {
                            $plc_detail_array['product_id'] = $id;
                            $plc_detail_array['created_at'] = time();
                            $plc_detail_array['updated_at'] = time();
                            $product_plc_detail_id = $this->Action_model->insert_data($plc_detail_array, 'tbl_product_plc_details');
                            $product_plc_detail_id_array[] = $product_plc_detail_id;
                        }
                    }

                    if ($product_plc_detail_id_array) {

                        $this->Action_model->delete_query('tbl_product_plc_details', "product_id='" . $id . "' AND (product_plc_detail_id NOT IN (" . implode(',', $product_plc_detail_id_array) . "))");
                    }
                } else {
                    $this->Action_model->delete_query('tbl_product_plc_details', "product_id='" . $id . "'");
                }

                $product_plc_detail_details = array();
                $product_plc_detail_detail_data = $this->Action_model->detail_result('tbl_product_plc_details', "product_id='" . $id . "' ORDER BY product_plc_detail_id ASC");
                if ($product_plc_detail_detail_data) {
                    $product_plc_detail_details = $product_plc_detail_detail_data;
                }

                $spec = $this->input->post('spec');
                if ($spec) {
                    $product_specification_id_array = array();

                    foreach ($spec as $key => $value) {

                        $id = $this->input->post('id');
                        $unit_data = $this->Action_model->select_single('tbl_product_specifications', "product_id='" . $id . "' AND product_specification_id='" . $value['product_specification_id'] . "'");

                        $spec_array = array(
                            'specification_id' => $value['specification_id'],
                            'description' => $value['description']
                        );

                        if ($value['product_specification_id'] != '') {
                            $product_specification_id = $value['product_specification_id'];
                            $product_specification_id_array[] = $product_specification_id;

                            $spec_array['updated_at'] = time();

                            $this->Action_model->update_data($spec_array, 'tbl_product_specifications', "product_id='" . $id . "' 
                                AND product_specification_id='" . $product_specification_id . "'");
                        } else {
                            $spec_array['product_id'] = $id;
                            $spec_array['created_at'] = time();
                            $spec_array['updated_at'] = time();
                            $product_specification_id = $this->Action_model->insert_data($spec_array, 'tbl_product_specifications');
                            $product_specification_id_array[] = $product_specification_id;
                        }
                    }

                    if ($product_specification_id_array) {

                        $this->Action_model->delete_query('tbl_product_specifications', "product_id='" . $id . "' AND (product_specification_id NOT IN (" . implode(',', $product_specification_id_array) . "))");
                    }
                } else {
                    $this->Action_model->delete_query('tbl_product_specifications', "product_id='" . $id . "'");
                }

                $product_specification_details = array();
                $product_specification_detail_data = $this->Action_model->detail_result('tbl_product_specifications', "product_id='" . $id . "' ORDER BY product_specification_id ASC");
                if ($product_specification_detail_data) {
                    $product_specification_details = $product_specification_detail_data;
                }

                $record = $this->Action_model->select_single('tbl_products', "product_id='" . $id . "'");

                $product_images = array();
                $product_image_detail_data = $this->Action_model->detail_result('tbl_product_images', "product_id='" . $id . "' ORDER BY product_image_id ASC");
                if ($product_image_detail_data) {
                    $product_images = $product_image_detail_data;
                }

                $array = array('status' => 'success', 'message' => 'Success', 'additional_details' => $product_add_detail_details, 'plc_details' => $product_plc_detail_details, 'product_specifications' => $product_specification_details, 'record' => $record, 'product_images' => $product_images);
            } else {
                $array = array('status' => 'error', 'message' => 'Not Found');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function product_save3()
    {
        $array = array();

        if ($this->input->post()) {
            $banner_image = "";
            $project_logo = "";
            $id = $this->input->post('id');
            $record = $this->Action_model->select_single('tbl_products', "product_id='" . $id . "'");

            if ($record) {
                $banner_image = $record->banner_image;
                $project_logo = $record->project_logo;
            }

            $config['upload_path'] = './uploads/images/project/banner/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']             = 5 * 1024;
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if (!empty($_FILES['banner_image']['name'])) {
                if (!$this->upload->do_upload('banner_image')) {
                } else {
                    if ($record && $record->banner_image && file_exists('./uploads/images/project/banner/' . $record->banner_image)) {
                        unlink('./uploads/images/project/banner/' . $record->banner_image);
                    }

                    $banner_image = $this->upload->data('file_name');
                }
            }

            $config['upload_path'] = './uploads/images/project/logo/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']             = 5 * 1024;
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if (!empty($_FILES['project_logo']['name'])) {
                if (!$this->upload->do_upload('project_logo')) {
                } else {
                    if ($record && $record->project_logo && file_exists('./uploads/images/project/logo/' . $record->project_logo)) {
                        unlink('./uploads/images/project/logo/' . $record->project_logo);
                    }

                    $project_logo = $this->upload->data('file_name');
                }
            }

            $config['upload_path'] = './uploads/images/project/image/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']             = 5 * 1024;
            $config['remove_spaces'] = TRUE;
            $config['encrypt_name'] = TRUE;

            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            $project_images = array();
            $project_image_id = $this->input->post('project_image_id');
            if ($project_image_id) {
                foreach ($project_image_id as $key => $value) {
                    if (!empty($_FILES['project_image_' . $key]['name'])) {
                        if (!$this->upload->do_upload('project_image_' . $key)) {
                        } else {
                            $image = $this->upload->data('file_name');
                            $project_images[] = array('product_id' => $id, 'product_image' => $image, 'product_image_status' => '1', 'created_at' => time(), 'updated_at' => time());
                        }
                    }
                }
            }

            $record_array = array(
                'authority_approval' => $this->input->post('authority_approval'),
                'cc_certificate' => $this->input->post('cc_certificate'),
                'oc_certificate' => $this->input->post('oc_certificate'),
                'description' => $this->input->post('description'),
                'banner_image' => $banner_image,
                'project_logo' => $project_logo
            );

            if ($record) {
                $record_array['updated_at'] = time();
                $this->Action_model->update_data($record_array, 'tbl_products', "product_id='" . $id . "'");

                if ($project_images) {
                    $this->db->insert_batch('tbl_product_images', $project_images);
                }

                $message = "Project has been updated successfully!";
                $this->session->set_flashdata('success_msg', $message);
                $array = array('status' => 'success', 'message' => $message);
            } else {
                $array = array('status' => 'error', 'message' => 'Not Found');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function delete_product_image()
    {
        $array = array();

        if ($this->input->post()) {
            $id = $this->input->post('id');
            $record = $this->Action_model->select_single('tbl_product_images', "product_image_id='" . $id . "'");

            if ($record) {
                if ($record && $record->product_image && file_exists('./uploads/images/project/image/' . $record->product_image)) {
                    unlink('./uploads/images/project/image/' . $record->product_image);
                }
                $this->Action_model->delete_query('tbl_product_images', "product_image_id='" . $id . "'");

                $message = "Image Deleted Successfully!";
                $array = array('status' => 'success', 'message' => $message);
            } else {
                $array = array('status' => 'error', 'message' => 'Image Not Found');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_builders()
    {
        $array = array();
        $builder_list = array();

        if ($this->input->post()) {
            $builder_group_id = $this->input->post('builder_group_id');
            $where = "builder_group_id='" . $builder_group_id . "' AND builder_status='1'";
            $builder_data = $this->Action_model->detail_result('tbl_builders', $where, 'builder_id,firm_name');
            if ($builder_data) {
                $builder_list = $builder_data;
            }
            $array = array('status' => 'success', 'message' => 'Data Found', 'builder_list' => $builder_list);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_unit_details()
    {
        $array = array();
        $unit_details = array();
        $comm_block_details = array();

        if ($this->input->post()) {
            $project_type = $this->input->post('project_type');
            $property_type = $this->input->post('property_type');
            $product_id = $this->input->post('product_id');
            $where = "project_type='" . $project_type . "' AND property_type='" . $property_type . "' AND product_id='" . $product_id . "'";
            $unit_detail_data = $this->Action_model->detail_result('tbl_product_unit_details', $where, '*');
            if ($unit_detail_data) {
                $unit_details = $unit_detail_data;
            }

            $comm_block_data = $this->Action_model->detail_result('tbl_product_block_details', $where, '*');
            if ($comm_block_data) {
                $comm_block_details = $comm_block_data;
            }

            $blocks = array();
            $block_data = $this->Action_model->detail_result('tbl_product_block_details', "project_type='" . $project_type . "' AND property_type='" . $property_type . "' AND product_id='" . $product_id . "' ORDER BY block_id ASC");
            if ($block_data) {
                $blocks = $block_data;
            }


            $product_flat_unit_details = array();
            $product_flat_unit_detail_data = $this->Action_model->detail_result('tbl_product_unit_details', "project_type='" . $project_type . "' AND property_type='" . $property_type . "' AND product_id='" . $product_id . "' ORDER BY product_unit_detail_id ASC");
            if ($product_flat_unit_detail_data) {
                $product_flat_unit_details = $product_flat_unit_detail_data;
            }

            $product_villa_unit_details = array();
            $product_villa_unit_detail_data = $this->Action_model->detail_result('tbl_product_unit_details', "project_type='" . $project_type . "' AND property_type='" . $property_type . "' AND product_id='" . $product_id . "' ORDER BY product_unit_detail_id ASC");
            if ($product_villa_unit_detail_data) {
                $product_villa_unit_details = $product_villa_unit_detail_data;
            }

            $product_plot_unit_details = array();
            $product_plot_unit_detail_data = $this->Action_model->detail_result('tbl_product_unit_details', "project_type='" . $project_type . "' AND property_type='" . $property_type . "' AND product_id='" . $product_id . "' ORDER BY product_unit_detail_id ASC");
            if ($product_plot_unit_detail_data) {
                $product_plot_unit_details = $product_plot_unit_detail_data;
            }

            $array = array('status' => 'success', 'message' => 'Data Found', 'unit_details' => $unit_details, 'comm_block_details' => $comm_block_details, 'blocks' => $blocks, 'product_flat_unit_details' => $product_flat_unit_details, 'product_villa_unit_details' => $product_villa_unit_details, 'product_plot_unit_details' => $product_plot_unit_details);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }
    /* product edit end */

    /* projects */
    public function project_list()
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

        $postData = $this->input->post();
        $select = 'product_id,project_name,tbl_products.date_register,city_name,location_name,tbl_builders.firm_name as firm_name,tbl_users.is_individual,tbl_users.user_title as a_user_title,tbl_users.firm_name as a_firm_name,tbl_users.first_name as a_first_name,tbl_users.last_name as a_last_name,share_account_id';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (project_name like '%" . $searchValue . "%' ) AND (agent_id='" . $account_id . "' OR tbl_project_share.share_account_id='" . $account_id . "')";
        } else {
            $searchQuery = "(tbl_products.agent_id='" . $account_id . "' OR share_account_id='" . $account_id . "')";
        }
        $data = $this->Action_model->ajaxDatatableLeft($postData, $searchQuery, 'tbl_products', $where, $select, array('tbl_builders', 'tbl_builders.builder_id=tbl_products.builder_id', 'tbl_city', 'tbl_city.city_id=tbl_products.city_id', 'tbl_locations', 'tbl_locations.location_id=tbl_products.location', 'tbl_project_share', "tbl_project_share.project_id=tbl_products.product_id  AND tbl_project_share.share_account_id='" . $account_id . "'", 'tbl_users', 'tbl_users.user_id=tbl_project_share.account_id'));

        echo json_encode($data);
    }
    /* projects end */

    /* customer start */
    public function get_customer_list()
    {
        $array = array();

        if ($this->input->post()) {

            $account_id = getAccountId();

            if ($account_id) {
                $filter_by = $this->input->post('filter_by');
                $page = $this->input->post('page');

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
                $start = ($page - 1) * $limit;

                $where = "tbl_leads.account_id='" . $account_id . "'";
                $where_ids = "";
                $user_ids = $this->get_level_user_ids();
                if (count($user_ids)) {
                    $where_ids .= " AND (tbl_leads.user_id='" . implode("' OR tbl_leads.user_id='", $user_ids) . "')";
                }

                if ($search_agent_id) {
                    $where_ids .= " AND (tbl_leads.user_id='" . $search_agent_id . "')";
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

                $where .= " GROUP BY tbl_leads.lead_id";
                $where .= $where_ext;

                $this->db->select("tbl_leads.lead_id");
                $this->db->from('tbl_leads');
                $this->db->join('tbl_requirements', 'tbl_requirements.lead_id = tbl_leads.lead_id', 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $record_all = $query->result();

                $total_records = count($record_all);
                if ($record_all) {
                    $total_pages = ceil($total_records / $limit);
                }
                /*if ($record_all) {
                    $total_records = $record_all->total_records;
                    $total_pages = ceil($total_records/$limit);
                }*/


                $where = "tbl_leads.account_id='" . $account_id . "'";
                $where_ids = "";
                $user_ids = $this->get_level_user_ids();
                if (count($user_ids)) {
                    $where_ids .= " AND (tbl_leads.user_id='" . implode("' OR tbl_leads.user_id='", $user_ids) . "')";
                }
                $where .= $where_ids;
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
                    //$where.=" ORDER BY STR_TO_DATE(lead_date,'%d-%m-%Y') DESC";
                    $where .= " ORDER BY tbl_leads.created_at DESC";
                }

                $where .= " limit " . $start . "," . $limit;
                $this->db->select("*,tbl_leads.lead_id as lead_id,CONCAT(lead_first_name, ' ', lead_last_name) AS 'lead_name'");
                $this->db->from('tbl_leads');
                $this->db->join('tbl_lead_stages', 'tbl_lead_stages.lead_stage_id = tbl_leads.lead_stage_id', 'left');
                $this->db->join('tbl_lead_sources', 'tbl_lead_sources.lead_source_id = tbl_leads.lead_source_id', 'left');
                $this->db->join('tbl_requirements', 'tbl_requirements.lead_id = tbl_leads.lead_id', 'left');
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
                            'lead_id' => $item->lead_id,
                            'lead_title' => $item->lead_title,
                            'lead_first_name' => $item->lead_first_name,
                            'lead_last_name' => $item->lead_last_name,
                            'lead_date' => $item->lead_date,
                            'next_followup_date' => $next_followup_date,
                            'lead_mobile_no' => $item->lead_mobile_no,
                            'lead_stage_name' => (!$item->lead_stage_name) ? '' : $item->lead_stage_name,
                            'lead_source_name' => (!$item->lead_source_name) ? '' : $item->lead_source_name,
                            'lead_email' => $item->lead_email,
                            'next_followup' => $next_followup
                        );
                    }
                }

                if ($total_pages != $page) {
                    $next_page = $page + 1;
                }
                $array = array('status' => 'success', 'message' => 'Lead Found', 'records' => $records, 'total_records' => $total_records, 'total_pages' => $total_pages, 'next_page' => $next_page, 'records' => $records);
            } else {
                $array = array('status' => 'error', 'message' => 'No Leads');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_customer()
    {

        $account_id = getAccountId();

        if ($account_id && $this->input->post()) {
            $id = $this->input->post('id');

            $where = "lead_id='" . $id . "' AND account_id='" . $account_id . "'";

            $this->db->select("*");
            $this->db->from('tbl_leads');
            $this->db->join('tbl_states', 'tbl_states.state_id = tbl_leads.lead_state_id', 'left');
            $this->db->join('tbl_city', 'tbl_city.city_id = tbl_leads.lead_city_id', 'left');
            $this->db->join('tbl_occupations', 'tbl_occupations.occupation_id = tbl_leads.lead_occupation_id', 'left');
            $this->db->join('tbl_lead_types', 'tbl_lead_types.lead_type_id = tbl_leads.lead_status', 'left');
            $this->db->join('tbl_lead_stages', 'tbl_lead_stages.lead_stage_id = tbl_leads.lead_stage_id', 'left');
            $this->db->join('tbl_lead_sources', 'tbl_lead_sources.lead_source_id = tbl_leads.lead_source_id', 'left');
            $this->db->join('tbl_designations', 'tbl_designations.designation_id = tbl_leads.lead_designation', 'left');
            $this->db->where($where);
            $query = $this->db->get();
            $record = $query->row();

            if ($record) {
                $data['record'] = $record;
                $this->load->view(AGENT_URL . 'get_customer', $data);
            } else {
                echo 'error';
            }
        } else {
            echo 'error';
        }
    }

    public function get_customer_requirement_list()
    {
        $array = array();
        $requirement_list = array();

        $account_id = getAccountId();

        if ($account_id && $this->input->post()) {

            $lead_id = $this->input->post('lead_id');
            $where = "lead_id='" . $lead_id . "' AND tbl_requirements.account_id='" . $account_id . "' ORDER BY requirement_id DESC";

            $this->db->select('requirement_id,lead_id,user_id,look_for,product_type_name,unit_type_name,accomodation_name,location,size_min,size_max,size_unit,remark,dor,lead_option_name as look_for,requirement_status,state_name,city_name,b_min.budget_name as budget_minimum,b_max.budget_name as budget_maximum');
            $this->db->from('tbl_requirements');
            $this->db->join('tbl_lead_options', 'tbl_lead_options.lead_option_id = tbl_requirements.look_for', 'left');
            $this->db->join('tbl_states', 'tbl_states.state_id = tbl_requirements.state_id', 'left');
            $this->db->join('tbl_city', 'tbl_city.city_id = tbl_requirements.city_id', 'left');
            $this->db->join('tbl_accomodations', 'tbl_accomodations.accomodation_id = tbl_requirements.accomodation_id', 'left');
            $this->db->join('tbl_product_types', 'tbl_product_types.product_type_id = tbl_requirements.product_type_id', 'left');
            $this->db->join('tbl_unit_types', 'tbl_unit_types.unit_type_id = tbl_requirements.unit_type_id', 'left');
            $this->db->join('tbl_budgets as b_min', 'b_min.budget_id = tbl_requirements.budget_min', 'left');
            $this->db->join('tbl_budgets as b_max', 'b_max.budget_id = tbl_requirements.budget_max', 'left');
            $this->db->where($where);
            $query = $this->db->get();
            $requirement_data = $query->result();

            if ($requirement_data) {
                //$requirement_list = $requirement_data;
                foreach ($requirement_data as $item) {
                    $location = "";
                    if ($item->location) {
                        $location_data = $this->Action_model->detail_result('tbl_locations', "location_id IN (" . $item->location . ")", 'location_name');
                        $location_list = array();
                        if ($location_data) {
                            foreach ($location_data as $item_location) {
                                $location_list[] = $item_location->location_name;
                            }

                            $location .= implode(", ", $location_list);
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
                        $look_for .= " " . $item->accomodation_name;
                    }

                    if ($item->product_type_name) {
                        $look_for .= " " . $item->product_type_name;
                    }

                    if ($item->unit_type_name) {
                        $look_for .= " " . $item->unit_type_name;
                    }

                    $requirement_list[] = array(
                        "requirement_id" => $item->requirement_id,
                        "lead_id" => $item->lead_id,
                        "look_for" => $item->look_for,
                        "budget_min" => $item->budget_minimum,
                        "budget_max" => $item->budget_maximum,
                        "size_min" => $item->size_min,
                        "size_max" => $item->size_max,
                        "size_unit" => $item->size_unit,
                        "remark" => $item->remark,
                        "dor" => $item->dor,
                        "look_for" => $look_for,
                        "location" => $location,
                        "requirement_status" => $item->requirement_status
                    );
                }
            }
            $array = array('status' => 'success', 'message' => 'Data Found', 'requirement_list' => $requirement_list);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_customer_reference_list()
    {
        $array = array();
        $reference_list = array();

        $account_id = getAccountId();

        if ($account_id && $this->input->post()) {

            $lead_id = $this->input->post('lead_id');

            $where = "user_id='" . $account_id . "'";
            $user_detail = $this->Action_model->select_single('tbl_users', $where);

            $reference_list[] = array("reference_id" => '', "reference_name" => ucwords($user_detail->user_title . ' ' . $user_detail->first_name . ' ' . $user_detail->last_name), "dor" => '', "purpose" => '', "status" => '');

            $where = "lead_id='" . $lead_id . "'";
            $lead_detail = $this->Action_model->select_single('tbl_leads', $where);


            /*$where = "owner_mobile_no='".$lead_detail->lead_mobile_no."'";
            $where .= " GROUP BY tbl_property.account_id";

            $this->db->select('*');
            $this->db->from('tbl_property');
            $this->db->join('tbl_users', 'tbl_users.user_id = tbl_property.account_id','left');
            $this->db->join('tbl_locations', 'tbl_locations.location_id = tbl_property.location_id','left');
            $this->db->join('tbl_states', 'tbl_states.state_id = tbl_property.state_id','left');
            $this->db->join('tbl_city', 'tbl_city.city_id = tbl_property.city_id','left');
            $this->db->join('tbl_listing_types',"tbl_listing_types.listing_type_id=tbl_property.listing_type",'left');
            $this->db->join('tbl_product_types',"tbl_product_types.product_type_id=tbl_property.product_type_id",'left');
            $this->db->join('tbl_unit_types',"tbl_unit_types.unit_type_id=tbl_property.unit_type_id",'left');
            $this->db->where($where);
            $query = $this->db->get();
            $requirement_data = $query->result();

            if ($requirement_data) {
                foreach ($requirement_data as $item) {

                    $reference_list[] = array(
                        "agent_name"=>ucwords($item->user_title.' '.$item->first_name.' '.$item->last_name),
                        "location_name"=>(!$item->location_name)?'':$item->location_name,
                        "post_date"=>$item->post_date,
                        "city_name"=>(!$item->city_name)?'':$item->city_name,
                        "state_name"=>(!$item->state_name)?'':$item->state_name,
                        "listing_type"=>(!$item->title)?'':$item->title,
                        "product_type_name"=>(!$item->product_type_name)?'':$item->product_type_name,
                        "unit_type_name"=>(!$item->unit_type_name)?'':$item->unit_type_name,
                        "status"=>1
                    );
                }
            }*/

            $array = array('status' => 'success', 'message' => 'Data Found', 'reference_list' => $reference_list);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_customer_unit_list()
    {
        $array = array();
        $unit_list = array();

        $account_id = getAccountId();

        if ($account_id && $this->input->post()) {

            $lead_id = $this->input->post('lead_id');

            $where = "lead_id='" . $lead_id . "'";
            $lead_detail = $this->Action_model->select_single('tbl_leads', $where);

            $this->db->select('*');
            $this->db->from('tbl_bookings');
            $this->db->join('tbl_products', 'tbl_products.product_id = tbl_bookings.project_id', 'left');
            //$this->db->join('tbl_locations', 'tbl_locations.location_id = tbl_bookings.address','left');
            $this->db->join('tbl_states', 'tbl_states.state_id = tbl_bookings.state_id', 'left');
            $this->db->join('tbl_city', 'tbl_city.city_id = tbl_bookings.city_id', 'left');
            $this->db->join('tbl_product_unit_details', 'tbl_product_unit_details.product_unit_detail_id = tbl_bookings.product_unit_detail_id');
            $this->db->join('tbl_product_types', "tbl_product_types.product_type_id=tbl_product_unit_details.project_type", 'left');
            $this->db->join('tbl_unit_types', "(tbl_product_unit_details.project_type!='3' AND tbl_unit_types.unit_type_id=tbl_product_unit_details.property_type) OR (tbl_product_unit_details.project_type='3' AND tbl_unit_types.unit_type_id=tbl_product_unit_details.sub_category)", 'left');
            $this->db->join('tbl_accomodations', 'tbl_accomodations.accomodation_id = tbl_bookings.accommodation', 'left');
            $this->db->join('tbl_floors', 'tbl_floors.floor_id = tbl_bookings.floor', 'left');
            $this->db->join('tbl_product_block_details', 'tbl_product_block_details.block_id = tbl_bookings.tower', 'left');
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
                    if ($item->payment_mode == "cheque") {
                        $payment_mode = "By Cheque";
                    }
                    if ($item->payment_mode == "cash") {
                        $payment_mode = "By Cash";
                    }
                    if ($item->payment_mode == "online_transfer") {
                        $payment_mode = "Online Transfer";
                    }

                    $unit_list[] = array(
                        "lead_id" => $item->lead_id,
                        "customer_name" => $item->customer_name,
                        "sdw_title" => $item->sdw_title,
                        "sdw" => $item->sdw,
                        "dob" => $item->dob,
                        "project_name" => $item->project_name,
                        "address" => (!$item->address) ? '' : $item->address,
                        "city_name" => (!$item->city_name) ? '' : $item->city_name,
                        "state_name" => (!$item->state_name) ? '' : $item->state_name,
                        "product_type_name" => (!$item->product_type_name) ? '' : $item->product_type_name,
                        "unit_type_name" => (!$item->unit_type_name) ? '' : $item->unit_type_name,
                        "deal_amount" => $item->deal_amount,
                        "booking_amount" => $item->booking_amount,
                        "payment_mode" => $payment_mode,
                        "cheque_no" => $item->cheque_no,
                        "drawn_on" => $item->drawn_on,
                        "booking_date" => $item->booking_date,
                        "remark" => $item->remark,
                        "unit_ref_no" => $item->unit_ref_no,
                        "size" => $item->size,
                        "unit_no" => $item->unit_no,
                        "accomodation_name" => (!$item->accomodation_name) ? '' : $item->accomodation_name,
                        "floor_name" => (!$item->floor_name) ? '' : $item->floor_name,
                        "tower_name" => (!$item->block_name) ? '' : $item->block_name,
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
            $array = array('status' => 'success', 'message' => 'Data Found', 'unit_list' => $unit_list);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    /* customer end */

    public function get_customer_by_mobile()
    {

        $account_id = getAccountId();

        if ($account_id && $this->input->post()) {
            $mobile = $this->input->post('mobile');

            $where = "lead_mobile_no='" . $mobile . "' AND account_id='" . $account_id . "'";

            $this->db->select("lead_title,lead_first_name,lead_last_name,lead_mobile_no,lead_mobile_no_2,lead_email");
            $this->db->from('tbl_leads');
            $this->db->where($where);
            $query = $this->db->get();
            $record = $query->row();

            if ($record) {
                $array = array('status' => 'success', 'message' => '', 'customer_detail' => $record);
            } else {
                $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    /* product start */
    public function get_product_list()
    {
        $array = array();

        if ($this->input->post()) {

            $account_id = getAccountId();

            if ($account_id) {
                $filter_by = $this->input->post('filter_by');
                $page = $this->input->post('page');

                $limit = 10;
                $total_pages = 0;
                $start = 0;
                $next_page = 0;
                $start = ($page - 1) * $limit;

                $where = "p.agent_id='" . $account_id . "' OR share_account_id='" . $account_id . "'";
                $this->db->select("count(tbl_product_unit_details.product_unit_detail_id) as total_records");
                $this->db->from('tbl_product_unit_details');
                $this->db->join('tbl_products as p', 'p.product_id = tbl_product_unit_details.product_id', 'left');
                $this->db->join('tbl_project_share', "tbl_project_share.project_id = p.product_id AND share_account_id='" . $account_id . "'", 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $record_all = $query->row();

                $total_records = 0;
                if ($record_all) {
                    $total_records = $record_all->total_records;
                    $total_pages = ceil($total_records / $limit);
                }


                $where = "p.agent_id='" . $account_id . "' OR share_account_id='" . $account_id . "'";
                if ($filter_by == 1) {
                    //$where.=" ORDER BY lead_name";
                } else if ($filter_by == 2) {
                    //$where.=" ORDER BY lead_date";
                } else if ($filter_by == 3) {
                    //$where.=" ORDER BY lead_status DESC";
                } else if ($filter_by == 4) {
                    //$where.=" ORDER BY lead_status ASC";
                } else {
                    //$where.=" ORDER BY STR_TO_DATE(lead_date,'%d-%m-%Y') DESC";
                    $where .= " ORDER BY pud.created_at DESC";
                }

                $where .= " limit " . $start . "," . $limit;
                $this->db->select("pud.product_unit_detail_id,tbl_product_types.product_type_name,tbl_unit_types.unit_type_name,tbl_city.city_name,tbl_states.state_name,tbl_locations.location_name,tbl_accomodations.accomodation_name,pud.project_type,pud.property_type,pud.sa,pud.plot_size,pud.plot_unit,punit.unit_name as plot_unit_name,sa_unit.unit_name as sa_unit_name,pud.basic_cost,p.b_cost_unit");
                $this->db->from('tbl_product_unit_details as pud');
                $this->db->join('tbl_products as p', 'p.product_id = pud.product_id', 'left');
                $this->db->join('tbl_product_types', 'tbl_product_types.product_type_id=p.project_type', 'left');
                $this->db->join('tbl_unit_types', 'tbl_unit_types.unit_type_id=p.property_type', 'left');
                $this->db->join('tbl_states', 'tbl_states.state_id = p.state_id', 'left');
                $this->db->join('tbl_city', 'tbl_city.city_id = p.city_id', 'left');
                $this->db->join('tbl_locations', 'tbl_locations.location_id = p.location', 'left');
                $this->db->join('tbl_accomodations', 'tbl_accomodations.accomodation_id = pud.accomodation', 'left');
                $this->db->join('tbl_units as punit', 'punit.unit_id = pud.plot_unit', 'left');
                $this->db->join('tbl_units as sa_unit', 'sa_unit.unit_id = pud.unit', 'left');
                $this->db->join('tbl_project_share', "tbl_project_share.project_id = p.product_id AND share_account_id='" . $account_id . "'", 'left');
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

                        if ($item->project_type == 2) {

                            if (($item->property_type == 1 || $item->property_type == 7) && $item->sa) {
                                $size = $item->sa;
                                if ($item->sa_unit_name) {
                                    $size .= ' ' . $item->sa_unit_name;
                                }
                            }
                            if (($item->property_type == 2 || $item->property_type == 3) && $item->plot_size) {
                                $size = $item->plot_size;
                                if ($item->plot_unit_name) {
                                    $size .= ' ' . $item->plot_unit_name;
                                }
                            }
                        }

                        if ($item->project_type == 3 && $item->sa) {
                            $size = $item->sa;
                            if ($item->sa_unit_name) {
                                $size .= ' ' . $item->sa_unit_name;
                            }
                        }

                        $this->db->select('*');
                        $this->db->from('tbl_inventory');
                        $this->db->join('tbl_basic_cost', 'tbl_basic_cost.inventory_id = tbl_inventory.inventory_id', 'left');
                        $this->db->where("unit_code='" . $item->product_unit_detail_id . "'");
                        $query = $this->db->get();
                        $item_inv_data = $query->result();
                        $o = 0;

                        $amount_array = array();
                        foreach ($item_inv_data as $itemInv) {
                            $current_rate = 0;
                            if ($itemInv->basic_cost_id) {

                                $b_cost_unit = $itemInv->current_rate_unit;
                                if ($itemInv->current_rate) {
                                    //$current_rate += $itemInv->current_rate;

                                    // residencial
                                    if ($item->project_type == 2) {

                                        // for flat
                                        if (($item->property_type == 1 || $item->property_type == 7)) {
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                            if ($b_cost_unit == '2') { // for Sq.Ft
                                                $current_rate = $item->sa * $itemInv->current_rate;
                                            } else if ($b_cost_unit == '5') { // for Fix
                                                $current_rate = $itemInv->current_rate;
                                            }
                                        }
                                        // for plot
                                        else if (($item->property_type == 2 || $item->property_type == 3)) {
                                            //$size = $item->plot_size;
                                            //if ($item->plot_unit_name) {
                                            //    $size .= ' '.$item->plot_unit_name;
                                            //}
                                            if ($b_cost_unit == '1') { // for Sq.Yd
                                                $current_rate = $item->plot_size * $itemInv->current_rate;
                                            } else if ($b_cost_unit == '2') { // for Sq.Ft
                                                $current_rate += $item->construction_area * $itemInv->current_rate;
                                            } else if ($b_cost_unit == '5') { // for Fix
                                                $current_rate = $itemInv->current_rate;
                                            }
                                        }
                                    }
                                    // commercial
                                    else if ($item->project_type == 3) {
                                        //$size = $item->sa;
                                        //if ($item->sa_unit_name) {
                                        //    $size .= ' '.$item->sa_unit_name;
                                        //}

                                        if ($b_cost_unit == '2') { // for Sq.Ft
                                            $current_rate = $item->sa * $itemInv->current_rate;
                                        } else if ($b_cost_unit == '5') { // for Fix
                                            $current_rate = $itemInv->current_rate;
                                        }
                                    }
                                }
                            } else {

                                $b_cost_unit = $item->b_cost_unit;

                                if ($item->basic_cost) {

                                    // residencial
                                    if ($item->project_type == 2) {
                                        // for flat
                                        if (($item->property_type == 1 || $item->property_type == 7)) {
                                            //$size = $item->sa;
                                            //if ($item->sa_unit_name) {
                                            //    $size .= ' '.$item->sa_unit_name;
                                            //}

                                            if ($b_cost_unit == '2') { // for Sq.Ft
                                                $current_rate = $item->sa * $item->basic_cost;
                                            } else if ($b_cost_unit == '5') { // for Fix
                                                $current_rate = $item->basic_cost;
                                            }
                                        }
                                        // for plot
                                        else if (($item->property_type == 2 || $item->property_type == 3)) {
                                            //$size = $item->plot_size;
                                            //if ($item->plot_unit_name) {
                                            //    $size .= ' '.$item->plot_unit_name;
                                            //}
                                            if ($b_cost_unit == '1') { // for Sq.Yd
                                                $current_rate = $item->plot_size * $item->basic_cost;
                                            } else if ($b_cost_unit == '2') { // for Sq.Ft
                                                $current_rate = $item->construction_area * $item->basic_cost;
                                            } else if ($b_cost_unit == '5') { // for Fix
                                                $current_rate = $item->basic_cost;
                                            }
                                        }
                                    }
                                    // commercial
                                    else if ($item->project_type == 3) {
                                        //$size = $item->sa;
                                        //if ($item->sa_unit_name) {
                                        //    $size .= ' '.$item->sa_unit_name;
                                        //}

                                        if ($b_cost_unit == '2') { // for Sq.Ft
                                            $current_rate = $item->sa * $item->basic_cost;
                                        } else if ($b_cost_unit == '5') { // for Fix
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

                            if ($b_min == $b_max) {
                                $budget = " Budget: ₹" . $b_min;
                            } else {
                                $budget = " Budget: ₹" . $b_min . " to ₹" . $b_max . "";
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

                        $bottom_label = $size . (($size) ? ', ' : ' ') . $budget;

                        $records[] = array(
                            'product_unit_detail_id' => $item->product_unit_detail_id,
                            "accomodation_name" => (!$item->accomodation_name) ? '' : $item->accomodation_name,
                            'product_type_name' => ($item->product_type_name) ? $item->product_type_name : '',
                            'unit_type_name' => ($item->unit_type_name) ? $item->unit_type_name : '',
                            "city_name" => (!$item->city_name) ? '' : $item->city_name,
                            "state_name" => (!$item->state_name) ? '' : $item->state_name,
                            "location_name" => (!$item->location_name) ? '' : $item->location_name,
                            'bottom_label' => $bottom_label,
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

                if ($total_pages != $page) {
                    $next_page = $page + 1;
                }
                $array = array('status' => 'success', 'message' => 'Lead Found', 'records' => $records, 'total_records' => $total_records, 'total_pages' => $total_pages, 'next_page' => $next_page, 'records' => $records);
            } else {
                $array = array('status' => 'error', 'message' => 'No Leads');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
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

    public function get_product_unit_single()
    {

        $account_id = getAccountId();

        if ($account_id && $this->input->post()) {
            $id = $this->input->post('id');

            $where = "pud.product_unit_detail_id='" . $id . "' AND (p.agent_id='" . $account_id . "' OR share_account_id='" . $account_id . "')";

            $this->db->select("pud.product_unit_detail_id,pud.no_of_bathroom,pud.no_of_unit,pud.ca,pud.ba,pud.sa,p.description,tbl_product_types.product_type_name,tbl_unit_types.unit_type_name,tbl_city.city_name,tbl_states.state_name,tbl_locations.location_name,tbl_accomodations.accomodation_name,p.product_id,p.project_name,p.no_of_tower,p.cc_certificate,p.oc_certificate,p.parking_open,p.o_price,p.parking_stilt,p.s_price,p.parking_basment,p.b_price,p.parking_gst,tbl_builders.firm_name as b_firm_name,p.project_type,p.property_type,pud.sa,pud.plot_size,pud.plot_unit,punit.unit_name as plot_unit_name,sa_unit.unit_name as sa_unit_name,pud.basic_cost,p.b_cost_unit");
            $this->db->from('tbl_product_unit_details as pud');
            $this->db->join('tbl_products as p', 'p.product_id = pud.product_id', 'left');
            $this->db->join('tbl_product_types', 'tbl_product_types.product_type_id=p.project_type', 'left');
            $this->db->join('tbl_unit_types', 'tbl_unit_types.unit_type_id=p.property_type', 'left');
            $this->db->join('tbl_states', 'tbl_states.state_id = p.state_id', 'left');
            $this->db->join('tbl_city', 'tbl_city.city_id = p.city_id', 'left');
            $this->db->join('tbl_locations', 'tbl_locations.location_id = p.location', 'left');
            $this->db->join('tbl_accomodations', 'tbl_accomodations.accomodation_id = pud.accomodation', 'left');
            $this->db->join('tbl_builders', 'tbl_builders.builder_id = p.builder_id', 'left');
            $this->db->join('tbl_units as punit', 'punit.unit_id = pud.plot_unit', 'left');
            $this->db->join('tbl_units as sa_unit', 'sa_unit.unit_id = pud.unit', 'left');
            $this->db->join('tbl_project_share', "tbl_project_share.project_id = p.product_id AND share_account_id='" . $account_id . "'", 'left');
            $this->db->where($where);
            $query = $this->db->get();
            $record = $query->row();

            if ($record) {
                $item = $record;
                $size = "";
                $budget = "";

                if ($item->project_type == 2) {

                    if (($item->property_type == 1 || $item->property_type == 7) && $item->sa) {
                        $size = $item->sa;
                        if ($item->sa_unit_name) {
                            $size .= ' ' . $item->sa_unit_name;
                        }
                    }
                    if (($item->property_type == 2 || $item->property_type == 3) && $item->plot_size) {
                        $size = $item->plot_size;
                        if ($item->plot_unit_name) {
                            $size .= ' ' . $item->plot_unit_name;
                        }
                    }
                }

                if ($item->project_type == 3 && $item->sa) {
                    $size = $item->sa;
                    if ($item->sa_unit_name) {
                        $size .= ' ' . $item->sa_unit_name;
                    }
                }

                $this->db->select('*');
                $this->db->from('tbl_inventory');
                $this->db->join('tbl_basic_cost', 'tbl_basic_cost.inventory_id = tbl_inventory.inventory_id', 'left');
                $this->db->where("unit_code='" . $item->product_unit_detail_id . "'");
                $query = $this->db->get();
                $item_inv_data = $query->result();
                $o = 0;

                $amount_array = array();
                foreach ($item_inv_data as $itemInv) {
                    $current_rate = 0;
                    if ($itemInv->basic_cost_id) {

                        $b_cost_unit = $itemInv->current_rate_unit;
                        if ($itemInv->current_rate) {
                            //$current_rate += $itemInv->current_rate;

                            // residencial
                            if ($item->project_type == 2) {

                                // for flat
                                if (($item->property_type == 1 || $item->property_type == 7)) {
                                    //$size = $item->sa;
                                    //if ($item->sa_unit_name) {
                                    //    $size .= ' '.$item->sa_unit_name;
                                    //}

                                    if ($b_cost_unit == '2') { // for Sq.Ft
                                        $current_rate = $item->sa * $itemInv->current_rate;
                                    } else if ($b_cost_unit == '5') { // for Fix
                                        $current_rate = $itemInv->current_rate;
                                    }
                                }
                                // for plot
                                else if (($item->property_type == 2 || $item->property_type == 3)) {
                                    //$size = $item->plot_size;
                                    //if ($item->plot_unit_name) {
                                    //    $size .= ' '.$item->plot_unit_name;
                                    //}
                                    if ($b_cost_unit == '1') { // for Sq.Yd
                                        $current_rate = $item->plot_size * $itemInv->current_rate;
                                    } else if ($b_cost_unit == '2') { // for Sq.Ft
                                        $current_rate += $item->construction_area * $itemInv->current_rate;
                                    } else if ($b_cost_unit == '5') { // for Fix
                                        $current_rate = $itemInv->current_rate;
                                    }
                                }
                            }
                            // commercial
                            else if ($item->project_type == 3) {
                                //$size = $item->sa;
                                //if ($item->sa_unit_name) {
                                //    $size .= ' '.$item->sa_unit_name;
                                //}

                                if ($b_cost_unit == '2') { // for Sq.Ft
                                    $current_rate = $item->sa * $itemInv->current_rate;
                                } else if ($b_cost_unit == '5') { // for Fix
                                    $current_rate = $itemInv->current_rate;
                                }
                            }
                        }
                    } else {

                        $b_cost_unit = $item->b_cost_unit;

                        if ($item->basic_cost) {

                            // residencial
                            if ($item->project_type == 2) {
                                // for flat
                                if (($item->property_type == 1 || $item->property_type == 7)) {
                                    //$size = $item->sa;
                                    //if ($item->sa_unit_name) {
                                    //    $size .= ' '.$item->sa_unit_name;
                                    //}

                                    if ($b_cost_unit == '2') { // for Sq.Ft
                                        $current_rate = $item->sa * $item->basic_cost;
                                    } else if ($b_cost_unit == '5') { // for Fix
                                        $current_rate = $item->basic_cost;
                                    }
                                }
                                // for plot
                                else if (($item->property_type == 2 || $item->property_type == 3)) {
                                    //$size = $item->plot_size;
                                    //if ($item->plot_unit_name) {
                                    //    $size .= ' '.$item->plot_unit_name;
                                    //}
                                    if ($b_cost_unit == '1') { // for Sq.Yd
                                        $current_rate = $item->plot_size * $item->basic_cost;
                                    } else if ($b_cost_unit == '2') { // for Sq.Ft
                                        $current_rate = $item->construction_area * $item->basic_cost;
                                    } else if ($b_cost_unit == '5') { // for Fix
                                        $current_rate = $item->basic_cost;
                                    }
                                }
                            }
                            // commercial
                            else if ($item->project_type == 3) {
                                //$size = $item->sa;
                                //if ($item->sa_unit_name) {
                                //    $size .= ' '.$item->sa_unit_name;
                                //}

                                if ($b_cost_unit == '2') { // for Sq.Ft
                                    $current_rate = $item->sa * $item->basic_cost;
                                } else if ($b_cost_unit == '5') { // for Fix
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

                    if ($b_min == $b_max) {
                        $budget = "₹" . $b_min;
                    } else {
                        $budget = "₹" . $b_min . " to ₹" . $b_max . "";
                    }
                }
                $data['size'] = $size;
                $data['budget'] = $budget;

                $where = "product_id='" . $record->product_id . "'";
                $this->db->select('*');
                $this->db->from('tbl_product_additional_details');
                $this->db->join('tbl_price_components', 'tbl_price_components.price_component_id = tbl_product_additional_details.price_comp_id', 'left');
                $this->db->join('tbl_units', 'tbl_units.unit_id = tbl_product_additional_details.unit', 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $additional_details = $query->result();
                $data['additional_details'] = $additional_details;

                $where = "product_id='" . $record->product_id . "'";
                $this->db->select('*');
                $this->db->from('tbl_product_plc_details');
                $this->db->join('tbl_price_components', 'tbl_price_components.price_component_id = tbl_product_plc_details.price_comp_id', 'left');
                $this->db->join('tbl_units', 'tbl_units.unit_id = tbl_product_plc_details.unit', 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $plc_details = $query->result();
                $data['plc_details'] = $plc_details;

                $data['record'] = $record;
                $this->load->view(AGENT_URL . 'get_product_unit_single', $data);
            } else {
                echo 'error';
            }
        } else {
            echo 'error';
        }
    }

    public function get_product_amenities_list()
    {
        $array = array();
        $items = array();
        $account_id = getAccountId();

        if ($account_id && $this->input->post()) {

            $id = $this->input->post('id');
            $where = "product_id='" . $id . "'";
            $product_data = $this->Action_model->select_single('tbl_products', $where);

            if ($product_data && $product_data->amenitie) {
                $amenitie_ids = $product_data->amenitie;

                $where = "amenitie_id IN (" . $amenitie_ids . ")";

                $this->db->select('*');
                $this->db->from('tbl_amenities');
                $this->db->where($where);
                $query = $this->db->get();
                $item_data = $query->result();

                if ($item_data) {
                    foreach ($item_data as $item) {
                        $items[] = array(
                            "image" => base_url('uploads/images/amenitie/' . $item->amenitie_image),
                            "name" => $item->amenitie_name
                        );
                    }
                }
            }

            $array = array('status' => 'success', 'message' => 'Data Found', 'items' => $items);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_product_specification_list()
    {
        $array = array();
        $items = array();
        $account_id = getAccountId();

        if ($account_id && $this->input->post()) {

            $id = $this->input->post('id');
            $where = "product_id='" . $id . "'";
            $product_data = $this->Action_model->select_single('tbl_products', $where);

            if ($product_data && $product_data->amenitie) {
                $amenitie_ids = $product_data->amenitie;

                $where = "product_id='" . $id . "'";

                $this->db->select('*');
                $this->db->from('tbl_product_specifications');
                $this->db->join('tbl_specifications', 'tbl_specifications.specification_id = tbl_product_specifications.specification_id', 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $item_data = $query->result();

                if ($item_data) {
                    foreach ($item_data as $item) {
                        $items[] = array(
                            "name" => $item->specification_name,
                            "description" => $item->description
                        );
                    }
                }
            }

            $array = array('status' => 'success', 'message' => 'Data Found', 'items' => $items);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_product_inventory_list()
    {
        $array = array();
        $items = array();
        $account_id = getAccountId();

        if ($account_id && $this->input->post()) {

            $id = $this->input->post('id');
            $product_unit_detail_id = $this->input->post('product_unit_detail_id');

            $where = "product_id='" . $id . "'";
            $product_data = $this->Action_model->select_single('tbl_products', $where);

            if ($product_data && $product_data->amenitie) {
                $amenitie_ids = $product_data->amenitie;

                $where = "tbl_inventory.product_id='" . $id . "' AND tbl_inventory.unit_code='" . $product_unit_detail_id . "'";

                $this->db->select('*');
                $this->db->from('tbl_inventory');
                $this->db->join('tbl_floors', 'tbl_floors.floor_id = tbl_inventory.floor_id', 'left');
                $this->db->join('tbl_product_block_details', 'tbl_product_block_details.block_id = tbl_inventory.block_id', 'left');
                $this->db->join('tbl_product_unit_details', 'tbl_product_unit_details.product_unit_detail_id = tbl_inventory.unit_code', 'left');
                $this->db->join('tbl_accomodations', 'tbl_accomodations.accomodation_id = tbl_product_unit_details.accomodation', 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $item_data = $query->result();

                if ($item_data) {
                    foreach ($item_data as $item) {
                        $items[] = array(
                            "inventory_id" => $item->inventory_id,
                            "unit_no" => $item->unit_no,
                            "floor_name" => ($item->floor_name) ? $item->floor_name : '',
                            "tower_name" => ($item->block_name) ? $item->block_name : '',
                            "accomodation_name" => ($item->accomodation_name) ? $item->accomodation_name : ''
                        );
                    }
                }
            }

            $array = array('status' => 'success', 'message' => 'Data Found', 'items' => $items);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }
    /* product end */

    public function get_project_list_by_product_type()
    {
        $array = array();
        $items = array();

        if ($this->input->post()) {

            $account_id = getAccountId();

            $product_type_id = $this->input->post('product_type_id');
            $where = "project_type='" . $product_type_id . "' AND agent_id='" . $account_id . "'";
            $item_data = $this->Action_model->detail_result('tbl_products', $where, 'product_id as id,project_name as name');
            if ($item_data) {
                $items = $item_data;
            }
            $array = array('status' => 'success', 'message' => 'Data Found', 'items' => $items);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_update_basic_cost_fields()
    {
        if ($this->input->post()) {

            $account_id = getAccountId();

            $product_id = $this->input->post('product_id');
            $where = "product_id='" . $product_id . "' AND agent_id='" . $account_id . "'";
            $product_data = $this->Action_model->select_single('tbl_products', $where);
            if ($product_data) {
                $data['product_data'] = $product_data;

                if ($product_data->project_type == 3) {
                    $where = "product_id='" . $product_id . "'";
                } else {
                    $where = "product_id='" . $product_id . "' AND property_type='" . $product_data->property_type . "'";
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

                $unit_code_list = array();
                $this->db->select('*');
                $this->db->from('tbl_product_unit_details');
                $this->db->where($where);
                $query = $this->db->get();
                $block_data = $query->result();
                foreach ($block_data as $item) {
                    $unit_code_list[] = array('id' => $item->product_unit_detail_id, 'name' => $item->code);
                }
                $data['unit_code_list'] = $unit_code_list;

                $data['floor_list'] = $this->Action_model->detail_result('tbl_floors', "floor_id!=''");
                $data['unit_list'] = $this->Action_model->detail_result('tbl_units', "unit_id!=''");

                $this->load->view(AGENT_URL . 'ajax/get_update_basic_cost_fields', $data);
            }
        }
    }

    public function get_update_basic_cost_list()
    {
        if ($this->input->post()) {

            $account_id = getAccountId();

            $product_id = $this->input->post('product_id');
            $where = "product_id='" . $product_id . "' AND agent_id='" . $account_id . "'";
            $product_data = $this->Action_model->detail_result('tbl_products', $where);
            if ($product_data) {
                $data['product_data'] = $product_data;
                $this->load->view(AGENT_URL . 'ajax/get_update_basic_cost_list', $data);
            }
        }
    }

    public function get_basic_cost_data()
    {
        $array = array();
        $items = array();

        if ($this->input->post()) {

            $account_id = getAccountId();

            $product_id = $this->input->post('product_id');
            $unit_code = $this->input->post('unit_code');
            $tower_id = $this->input->post('tower_id');
            $floor_id = $this->input->post('floor_id');

            $where = "pud.product_id='" . $product_id . "' AND pud.product_unit_detail_id='" . $unit_code . "'";
            //$product_unit_detail_data = $this->Action_model->select_single('tbl_product_unit_details',$where);
            $this->db->select("*,sa_unit.unit_name as sa_unit_name,plt_unit.unit_name as plot_unit_name");
            $this->db->from('tbl_product_unit_details as pud');
            $this->db->join('tbl_products as p', 'p.product_id = pud.product_id', 'left');
            $this->db->join('tbl_units as punit', 'punit.unit_id = pud.plot_unit', 'left');
            $this->db->join('tbl_units as sa_unit', 'sa_unit.unit_id = pud.unit', 'left');
            $this->db->join('tbl_accomodations as accom', 'accom.accomodation_id = pud.accomodation', 'left');
            $this->db->join('tbl_unit_types as unit_type', 'unit_type.unit_type_id = pud.sub_category', 'left');
            $this->db->join('tbl_units as plt_unit', 'plt_unit.unit_id = pud.plot_unit', 'left');
            $this->db->where($where);
            $query = $this->db->get();
            $product_unit_detail_data = $query->row();

            if ($product_unit_detail_data) {
                $size = "";
                if ($product_unit_detail_data->project_type == 2) {

                    if (($product_unit_detail_data->property_type == 1 || $product_unit_detail_data->property_type == 7) && $product_unit_detail_data->sa) {
                        $size = $product_unit_detail_data->sa;
                        if ($product_unit_detail_data->sa_unit_name) {
                            $size .= ' ' . $product_unit_detail_data->sa_unit_name;
                        }
                    }
                    if (($product_unit_detail_data->property_type == 2 || $product_unit_detail_data->property_type == 3) && $product_unit_detail_data->plot_size) {
                        $size = $product_unit_detail_data->plot_size;
                        if ($product_unit_detail_data->plot_unit_name) {
                            $size .= ' ' . $product_unit_detail_data->plot_unit_name;
                        }
                    }
                }

                if ($product_unit_detail_data->project_type == 3 && $product_unit_detail_data->sa) {
                    $size = $product_unit_detail_data->sa;
                    if ($product_unit_detail_data->sa_unit_name) {
                        $size .= ' ' . $product_unit_detail_data->sa_unit_name;
                    }
                }

                $current_rate = "";
                $current_rate_unit = "";

                /*$where = "product_unit_detail_id='".$product_unit_detail_data->product_unit_detail_id."'";
                $basic_cost_data = $this->Action_model->select_single('tbl_basic_cost',$where);
                if ($basic_cost_data) {
                    $current_rate = $basic_cost_data->current_rate;
                    $current_rate_unit = $basic_cost_data->current_rate_unit;
                }*/

                $where = "tbl_inventory.product_id='" . $product_id . "' AND unit_code='" . $product_unit_detail_data->product_unit_detail_id . "'";
                if ($tower_id) {
                    $where .= " AND tbl_inventory.block_id='" . $tower_id . "'";
                }
                if ($floor_id) {
                    $where .= " AND tbl_inventory.floor_id='" . $floor_id . "'";
                }

                $items = array();
                $this->db->select('*,tbl_inventory.inventory_id,b_unit.unit_name as current_rate_unit_name');
                $this->db->from('tbl_inventory');
                $this->db->join('tbl_product_block_details', 'tbl_product_block_details.block_id = tbl_inventory.block_id', 'left');
                $this->db->join('tbl_floors', 'tbl_floors.floor_id = tbl_inventory.floor_id', 'left');
                $this->db->join('tbl_basic_cost', 'tbl_basic_cost.inventory_id = tbl_inventory.inventory_id', 'left');
                $this->db->join('tbl_units as b_unit', 'b_unit.unit_id = tbl_basic_cost.current_rate_unit', 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $item_data = $query->result();
                foreach ($item_data as $item) {

                    $current_rate = "";
                    if ($item->basic_cost_id) {
                        if ($item->current_rate) {
                            $current_rate = $item->current_rate . ' ' . $item->current_rate_unit_name;
                        }
                    } else {
                        $current_rate = $product_unit_detail_data->basic_cost;
                    }

                    $unit_type = "";
                    $size = "";

                    if ($product_unit_detail_data->project_type == '2') {
                        $unit_type = $product_unit_detail_data->accomodation_name;

                        if ($product_unit_detail_data->sa) {
                            $size = $product_unit_detail_data->sa;
                            if ($product_unit_detail_data->sa_unit_name) {
                                $size .= ' ' . $product_unit_detail_data->sa_unit_name;
                            }
                        }

                        if ($product_unit_detail_data->plot_size) {
                            $size = $product_unit_detail_data->plot_size;
                            if ($product_unit_detail_data->plot_unit_name) {
                                $size .= ' ' . $product_unit_detail_data->plot_unit_name;
                            }
                        }
                    }
                    if ($product_unit_detail_data->project_type == '3') {
                        $unit_type = $product_unit_detail_data->unit_type_name;

                        $size = $product_unit_detail_data->sa;
                        if ($product_unit_detail_data->sa_unit_name) {
                            $size .= ' ' . $product_unit_detail_data->sa_unit_name;
                        }
                    }

                    $items[] = array('inventory_id' => $item->inventory_id, 'unit_code' => $item->unit_code, 'unit_ref_no' => $item->unit_no, 'current_rate' => $current_rate, 'floor' => ($item->floor_name) ? $item->floor_name : '', 'size' => $size, 'block' => ($item->block_name) ? $item->block_name : '', 'unit_type' => $unit_type, 'selected' => '');
                }

                $array = array('status' => 'success', 'message' => 'Data Found', 'size' => $size, 'items' => $items, 'current_rate' => $current_rate, 'current_rate_unit' => $current_rate_unit);
            } else {
                $array = array('status' => 'error', 'message' => 'Data Not Found');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function basic_cost_update()
    {
        $array = array();

        if ($this->input->post()) {

            $account_id = getAccountId();

            $product_id = $this->input->post('product_id');
            $unit_code = $this->input->post('unit_code');
            $new_rate = $this->input->post('new_rate');
            $new_rate_unit = $this->input->post('new_rate_unit');

            $where = "product_id='" . $product_id . "' AND product_unit_detail_id='" . $unit_code . "'";
            $product_unit_detail_data = $this->Action_model->select_single('tbl_product_unit_details', $where);

            if ($product_unit_detail_data) {
                /*$where = "product_unit_detail_id='".$product_unit_detail_data->product_unit_detail_id."'";
                $basic_cost_data = $this->Action_model->select_single('tbl_basic_cost',$where);

                $basic_cost_id = "";
                if ($basic_cost_data) {
                    $basic_cost_id = $basic_cost_data->basic_cost_id;
                    if ($new_rate) {
                        $basic_cost_array = array(
                            'product_unit_detail_id'=>$product_unit_detail_data->product_unit_detail_id,
                            'current_rate'=>$new_rate,
                            'current_rate_unit'=>$new_rate_unit,
                            'updated_at'=>time()
                        );
                        $this->Action_model->update_data($basic_cost_array,'tbl_basic_cost',$where);
                    }
                }
                else {
                    $basic_cost_array = array(
                        'product_unit_detail_id'=>$product_unit_detail_data->product_unit_detail_id,
                        'current_rate'=>$new_rate,
                        'current_rate_unit'=>$new_rate_unit,
                        'created_at'=>time()
                    );
                    $basic_cost_id = $this->Action_model->insert_data($basic_cost_array,'tbl_basic_cost');
                }*/

                $in_unit = $this->input->post('in_unit');

                if ($in_unit) {
                    foreach ($in_unit as $item) {

                        $selected = 0;
                        if (isset($item['chk'])) {
                            $selected = '';

                            $where = "inventory_id='" . $item['unit_id'] . "'";
                            $basic_cost_unit_data = $this->Action_model->select_single('tbl_basic_cost', $where);

                            if ($basic_cost_unit_data) {
                                $basic_cost_unit_array = array(
                                    'inventory_id' => $item['unit_id'],
                                    'current_rate' => $new_rate,
                                    'current_rate_unit' => $new_rate_unit
                                );
                                $this->Action_model->update_data($basic_cost_unit_array, 'tbl_basic_cost', $where);
                            } else {
                                $basic_cost_unit_array = array(
                                    'inventory_id' => $item['unit_id'],
                                    'current_rate' => $new_rate,
                                    'current_rate_unit' => $new_rate_unit
                                );
                                $this->Action_model->insert_data($basic_cost_unit_array, 'tbl_basic_cost');
                            }
                        }
                    }
                }

                $this->session->set_flashdata('success_msg', 'Basic Cost Updated Successfully.');

                $array = array('status' => 'success', 'message' => 'Basic Cost Updated Successfully.');
            } else {
                $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_update_additional_cost_fields()
    {
        if ($this->input->post()) {

            $account_id = getAccountId();

            $product_id = $this->input->post('product_id');
            $where = "product_id='" . $product_id . "' AND agent_id='" . $account_id . "'";
            $product_data = $this->Action_model->select_single('tbl_products', $where);
            if ($product_data) {
                $data['product_data'] = $product_data;

                /*if ($product_data->project_type==3) {
                    $where = "product_id='".$product_id."'";
                }
                else {
                    $where = "product_id='".$product_id."' AND property_type='".$product_data->property_type."'";
                }*/

                $where = "product_id='" . $product_id . "' AND project_type='" . $product_data->project_type . "' AND property_type='" . $product_data->property_type . "'";

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

                $unit_code_list = array();
                $this->db->select('*');
                $this->db->from('tbl_product_unit_details');
                $this->db->where($where);
                $query = $this->db->get();
                $block_data = $query->result();
                foreach ($block_data as $item) {
                    $unit_code_list[] = array('id' => $item->product_unit_detail_id, 'name' => $item->code);
                }
                $data['unit_code_list'] = $unit_code_list;

                $data['floor_list'] = $this->Action_model->detail_result('tbl_floors', "floor_id!=''");
                $data['unit_list'] = $this->Action_model->detail_result('tbl_units', "unit_id!=''");

                $where = "product_id='" . $product_id . "'";
                $this->db->select('*,tbl_product_additional_details.product_additional_detail_id as product_additional_detail_id,u.unit_name as unit_name,cru.unit_name as current_rate_unit_name');
                $this->db->from('tbl_product_additional_details');
                $this->db->join('tbl_price_components', 'tbl_price_components.price_component_id = tbl_product_additional_details.price_comp_id', 'left');
                $this->db->join('tbl_units as u', 'u.unit_id = tbl_product_additional_details.unit', 'left');
                $this->db->join('tbl_additional_cost', 'tbl_additional_cost.product_additional_detail_id = tbl_product_additional_details.product_additional_detail_id', 'left');
                $this->db->join('tbl_units as cru', 'cru.unit_id = tbl_additional_cost.current_rate_unit', 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $additional_details = $query->result();
                $data['additional_details'] = $additional_details;

                $where = "product_id='" . $product_id . "'";
                $this->db->select('*,tbl_product_plc_details.product_plc_detail_id as product_plc_detail_id,u.unit_name as unit_name,cru.unit_name as current_rate_unit_name');
                $this->db->from('tbl_product_plc_details');
                $this->db->join('tbl_price_components', 'tbl_price_components.price_component_id = tbl_product_plc_details.price_comp_id', 'left');
                $this->db->join('tbl_units as u', 'u.unit_id = tbl_product_plc_details.unit', 'left');
                $this->db->join('tbl_additional_plc_cost', 'tbl_additional_plc_cost.product_plc_detail_id = tbl_product_plc_details.product_plc_detail_id', 'left');
                $this->db->join('tbl_units as cru', 'cru.unit_id = tbl_additional_plc_cost.current_rate_unit', 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $plc_details = $query->result();
                $data['plc_details'] = $plc_details;

                $this->load->view(AGENT_URL . 'ajax/get_update_additional_cost_fields', $data);
            }
        }
    }

    public function get_additional_cost_data()
    {
        $array = array();
        $items = array();

        if ($this->input->post()) {

            $account_id = getAccountId();

            $product_id = $this->input->post('product_id');
            $unit_code = $this->input->post('unit_code');
            $tower_id = $this->input->post('tower_id');
            $floor_id = $this->input->post('floor_id');
            $cost_type = $this->input->post('cost_type');

            $where = "pud.product_id='" . $product_id . "' AND pud.product_unit_detail_id='" . $unit_code . "'";
            //$product_unit_detail_data = $this->Action_model->select_single('tbl_product_unit_details',$where);
            $this->db->select("*,sa_unit.unit_name as sa_unit_name,plt_unit.unit_name as plot_unit_name");
            $this->db->from('tbl_product_unit_details as pud');
            $this->db->join('tbl_products as p', 'p.product_id = pud.product_id', 'left');
            $this->db->join('tbl_units as punit', 'punit.unit_id = pud.plot_unit', 'left');
            $this->db->join('tbl_units as sa_unit', 'sa_unit.unit_id = pud.unit', 'left');
            $this->db->join('tbl_accomodations as accom', 'accom.accomodation_id = pud.accomodation', 'left');
            $this->db->join('tbl_unit_types as unit_type', 'unit_type.unit_type_id = pud.sub_category', 'left');
            $this->db->join('tbl_units as plt_unit', 'plt_unit.unit_id = pud.plot_unit', 'left');
            $this->db->where($where);
            $query = $this->db->get();
            $product_unit_detail_data = $query->row();

            if ($product_unit_detail_data && $cost_type) {
                $size = "";
                if ($product_unit_detail_data->project_type == 2) {

                    if (($product_unit_detail_data->property_type == 1 || $product_unit_detail_data->property_type == 7) && $product_unit_detail_data->sa) {
                        $size = $product_unit_detail_data->sa;
                        if ($product_unit_detail_data->sa_unit_name) {
                            $size .= ' ' . $product_unit_detail_data->sa_unit_name;
                        }
                    }
                    if (($product_unit_detail_data->property_type == 2 || $product_unit_detail_data->property_type == 3) && $product_unit_detail_data->plot_size) {
                        $size = $product_unit_detail_data->plot_size;
                        if ($product_unit_detail_data->plot_unit_name) {
                            $size .= ' ' . $product_unit_detail_data->plot_unit_name;
                        }
                    }
                }

                if ($product_unit_detail_data->project_type == 3 && $product_unit_detail_data->sa) {
                    $size = $product_unit_detail_data->sa;
                    if ($product_unit_detail_data->sa_unit_name) {
                        $size .= ' ' . $product_unit_detail_data->sa_unit_name;
                    }
                }

                $current_rate = "";
                $current_rate_unit = "";

                //$where = "product_unit_detail_id='".$product_unit_detail_data->product_unit_detail_id."'";
                //$basic_cost_data = $this->Action_model->select_single('tbl_basic_cost',$where);
                //if ($basic_cost_data) {
                //    $current_rate = $basic_cost_data->current_rate;
                //    $current_rate_unit = $basic_cost_data->current_rate_unit;
                //}

                $where = "tbl_inventory.product_id='" . $product_id . "' AND unit_code='" . $product_unit_detail_data->product_unit_detail_id . "'";
                if ($tower_id) {
                    $where .= " AND tbl_inventory.block_id='" . $tower_id . "'";
                }
                if ($floor_id) {
                    $where .= " AND tbl_inventory.floor_id='" . $floor_id . "'";
                }

                $items = array();

                if (strpos($cost_type, "Additional_") !== false) {

                    $tmp_id = str_replace("Additional_", "", $cost_type);

                    $where_pd = "product_additional_detail_id='" . $tmp_id . "'";
                    $this->db->select('*,tbl_product_additional_details.product_additional_detail_id as product_additional_detail_id,u.unit_name as unit_name');
                    $this->db->from('tbl_product_additional_details');
                    $this->db->join('tbl_units as u', 'u.unit_id = tbl_product_additional_details.unit', 'left');
                    $this->db->where($where_pd);
                    $query = $this->db->get();
                    $additional_detail_data = $query->row();

                    $where .= " AND tbl_inventory_additional.product_additional_detail_id='" . $tmp_id . "' AND is_active='1'";

                    $this->db->select('*,tbl_inventory.inventory_id,b_unit.unit_name as current_rate_unit_name');
                    $this->db->from('tbl_inventory');
                    $this->db->join('tbl_product_block_details', 'tbl_product_block_details.block_id = tbl_inventory.block_id', 'left');
                    $this->db->join('tbl_floors', 'tbl_floors.floor_id = tbl_inventory.floor_id', 'left');
                    $this->db->join('tbl_inventory_additional', 'tbl_inventory_additional.inventory_id = tbl_inventory.inventory_id');
                    $this->db->join('tbl_units as b_unit', 'b_unit.unit_id = tbl_inventory_additional.current_rate_unit', 'left');
                    $this->db->where($where);
                    $query = $this->db->get();
                    $item_data = $query->result();
                    foreach ($item_data as $item) {

                        $current_rate = "";
                        if ($item->cost_update) {
                            if ($item->current_rate) {
                                $current_rate = $item->current_rate . ' ' . $item->current_rate_unit_name;
                                if ($item->current_rate_gst) {
                                    $current_rate .= ", GST:" . $item->current_rate_gst . "%";
                                }
                            }
                        } else {
                            $current_rate = $additional_detail_data->price . ' ' . $additional_detail_data->unit_name;
                            if ($additional_detail_data->gst) {
                                $current_rate .= ", GST:" . $additional_detail_data->gst . "%";
                            }
                        }

                        $unit_type = "";
                        $size = "";

                        if ($product_unit_detail_data->project_type == '2') {
                            $unit_type = $product_unit_detail_data->accomodation_name;

                            if ($product_unit_detail_data->sa) {
                                $size = $product_unit_detail_data->sa;
                                if ($product_unit_detail_data->sa_unit_name) {
                                    $size .= ' ' . $product_unit_detail_data->sa_unit_name;
                                }
                            }

                            if ($product_unit_detail_data->plot_size) {
                                $size = $product_unit_detail_data->plot_size;
                                if ($product_unit_detail_data->plot_unit_name) {
                                    $size .= ' ' . $product_unit_detail_data->plot_unit_name;
                                }
                            }
                        }
                        if ($product_unit_detail_data->project_type == '3') {
                            $unit_type = $product_unit_detail_data->unit_type_name;

                            $size = $product_unit_detail_data->sa;
                            if ($product_unit_detail_data->sa_unit_name) {
                                $size .= ' ' . $product_unit_detail_data->sa_unit_name;
                            }
                        }

                        $items[] = array('inventory_id' => $item->inventory_id, 'unit_code' => $item->unit_code, 'unit_ref_no' => $item->unit_no, 'current_rate' => $current_rate, 'floor' => ($item->floor_name) ? $item->floor_name : '', 'size' => $size, 'block' => ($item->block_name) ? $item->block_name : '', 'unit_type' => $unit_type, 'selected' => '0');
                    }
                }



                if (strpos($cost_type, "PLC_") !== false) {

                    $tmp_id = str_replace("PLC_", "", $cost_type);

                    $where_pd = "product_plc_detail_id='" . $tmp_id . "'";
                    $this->db->select('*,tbl_product_plc_details.product_plc_detail_id as product_plc_detail_id,u.unit_name as unit_name');
                    $this->db->from('tbl_product_plc_details');
                    $this->db->join('tbl_units as u', 'u.unit_id = tbl_product_plc_details.unit', 'left');
                    $this->db->where($where_pd);
                    $query = $this->db->get();
                    $plc_detail_data = $query->row();

                    $where .= " AND tbl_inventory_plc.product_plc_detail_id='" . $tmp_id . "' AND is_active='1'";

                    $this->db->select('*,tbl_inventory.inventory_id,b_unit.unit_name as current_rate_unit_name');
                    $this->db->from('tbl_inventory');
                    $this->db->join('tbl_product_block_details', 'tbl_product_block_details.block_id = tbl_inventory.block_id', 'left');
                    $this->db->join('tbl_floors', 'tbl_floors.floor_id = tbl_inventory.floor_id', 'left');
                    $this->db->join('tbl_inventory_plc', 'tbl_inventory_plc.inventory_id = tbl_inventory.inventory_id');
                    $this->db->join('tbl_units as b_unit', 'b_unit.unit_id = tbl_inventory_plc.current_rate_unit', 'left');
                    $this->db->where($where);
                    $query = $this->db->get();
                    $item_data = $query->result();
                    foreach ($item_data as $item) {

                        $current_rate = "";
                        if ($item->cost_update) {
                            if ($item->current_rate) {
                                $current_rate = $item->current_rate . ' ' . $item->current_rate_unit_name;
                                if ($item->current_rate_gst) {
                                    $current_rate .= ", GST:" . $item->current_rate_gst . "%";
                                }
                            }
                        } else {
                            $current_rate = $plc_detail_data->price . ' ' . $plc_detail_data->unit_name;
                            if ($plc_detail_data->gst) {
                                $current_rate .= ", GST:" . $plc_detail_data->gst . "%";
                            }
                        }

                        $unit_type = "";
                        $size = "";

                        if ($product_unit_detail_data->project_type == '2') {
                            $unit_type = $product_unit_detail_data->accomodation_name;

                            if ($product_unit_detail_data->sa) {
                                $size = $product_unit_detail_data->sa;
                                if ($product_unit_detail_data->sa_unit_name) {
                                    $size .= ' ' . $product_unit_detail_data->sa_unit_name;
                                }
                            }

                            if ($product_unit_detail_data->plot_size) {
                                $size = $product_unit_detail_data->plot_size;
                                if ($product_unit_detail_data->plot_unit_name) {
                                    $size .= ' ' . $product_unit_detail_data->plot_unit_name;
                                }
                            }
                        }
                        if ($product_unit_detail_data->project_type == '3') {
                            $unit_type = $product_unit_detail_data->unit_type_name;

                            $size = $product_unit_detail_data->sa;
                            if ($product_unit_detail_data->sa_unit_name) {
                                $size .= ' ' . $product_unit_detail_data->sa_unit_name;
                            }
                        }

                        $items[] = array('inventory_id' => $item->inventory_id, 'unit_code' => $item->unit_code, 'unit_ref_no' => $item->unit_no, 'current_rate' => $current_rate, 'floor' => ($item->floor_name) ? $item->floor_name : '', 'size' => $size, 'block' => ($item->block_name) ? $item->block_name : '', 'unit_type' => $unit_type, 'selected' => '0');
                    }
                }

                if (strpos($cost_type, "Parking_Open") !== false) {
                    $where .= " AND parking='1' AND parking_open='1'";
                    $this->db->select('*,tbl_inventory.inventory_id,b_unit.unit_name as current_rate_unit_name');
                    $this->db->from('tbl_inventory');
                    $this->db->join('tbl_product_unit_details', 'tbl_product_unit_details.product_unit_detail_id = tbl_inventory.unit_code');
                    $this->db->join('tbl_products', 'tbl_products.product_id = tbl_product_unit_details.product_id');
                    $this->db->join('tbl_product_block_details', 'tbl_product_block_details.block_id = tbl_inventory.block_id', 'left');
                    $this->db->join('tbl_floors', 'tbl_floors.floor_id = tbl_inventory.floor_id', 'left');
                    $this->db->join('tbl_units as b_unit', 'b_unit.unit_id = tbl_inventory.o_current_rate_unit', 'left');
                    $this->db->where($where);
                    $query = $this->db->get();
                    $item_data = $query->result();
                    foreach ($item_data as $item) {

                        $current_rate = "";
                        if ($item->o_cost_update) {
                            if ($item->o_current_rate) {
                                $current_rate = $item->o_current_rate . ' ' . $item->current_rate_unit_name;
                                if ($item->o_current_rate_gst) {
                                    $current_rate .= ", GST:" . $item->o_current_rate_gst . "%";
                                }
                            }
                        } else {
                            $current_rate = ($product_unit_detail_data->o_price) ? $product_unit_detail_data->o_price : '';
                            if ($product_unit_detail_data->parking_gst && $product_unit_detail_data->parking_gst) {
                                $current_rate .= ", GST:" . $product_unit_detail_data->parking_gst . "%";
                            }
                        }

                        $unit_type = "";
                        $size = "";

                        if ($product_unit_detail_data->project_type == '2') {
                            $unit_type = $product_unit_detail_data->accomodation_name;

                            if ($product_unit_detail_data->sa) {
                                $size = $product_unit_detail_data->sa;
                                if ($product_unit_detail_data->sa_unit_name) {
                                    $size .= ' ' . $product_unit_detail_data->sa_unit_name;
                                }
                            }

                            if ($product_unit_detail_data->plot_size) {
                                $size = $product_unit_detail_data->plot_size;
                                if ($product_unit_detail_data->plot_unit_name) {
                                    $size .= ' ' . $product_unit_detail_data->plot_unit_name;
                                }
                            }
                        }
                        if ($product_unit_detail_data->project_type == '3') {
                            $unit_type = $product_unit_detail_data->unit_type_name;

                            $size = $product_unit_detail_data->sa;
                            if ($product_unit_detail_data->sa_unit_name) {
                                $size .= ' ' . $product_unit_detail_data->sa_unit_name;
                            }
                        }

                        $items[] = array('inventory_id' => $item->inventory_id, 'unit_code' => $item->unit_code, 'unit_ref_no' => $item->unit_no, 'current_rate' => $current_rate, 'floor' => ($item->floor_name) ? $item->floor_name : '', 'size' => $size, 'block' => ($item->block_name) ? $item->block_name : '', 'unit_type' => $unit_type, 'selected' => '0');
                    }
                }

                if (strpos($cost_type, "Parking_Stilt") !== false) {
                    $where .= " AND parking='1' AND parking_stilt='1'";

                    $this->db->select('*,tbl_inventory.inventory_id,b_unit.unit_name as current_rate_unit_name');
                    $this->db->from('tbl_inventory');
                    $this->db->join('tbl_product_unit_details', 'tbl_product_unit_details.product_unit_detail_id = tbl_inventory.unit_code');
                    $this->db->join('tbl_products', 'tbl_products.product_id = tbl_product_unit_details.product_id');
                    $this->db->join('tbl_product_block_details', 'tbl_product_block_details.block_id = tbl_inventory.block_id', 'left');
                    $this->db->join('tbl_floors', 'tbl_floors.floor_id = tbl_inventory.floor_id', 'left');
                    $this->db->join('tbl_units as b_unit', 'b_unit.unit_id = tbl_inventory.s_current_rate_unit', 'left');
                    $this->db->where($where);
                    $query = $this->db->get();
                    $item_data = $query->result();
                    foreach ($item_data as $item) {

                        $current_rate = "";
                        if ($item->s_cost_update) {
                            if ($item->s_current_rate) {
                                $current_rate = $item->s_current_rate . ' ' . $item->current_rate_unit_name;
                                if ($item->s_current_rate_gst) {
                                    $current_rate .= ", GST:" . $item->s_current_rate_gst . "%";
                                }
                            }
                        } else {
                            $current_rate = ($product_unit_detail_data->s_price) ? $product_unit_detail_data->s_price : '';
                            if ($product_unit_detail_data->parking_gst && $product_unit_detail_data->parking_gst) {
                                $current_rate .= ", GST:" . $product_unit_detail_data->parking_gst . "%";
                            }
                        }

                        $unit_type = "";
                        $size = "";

                        if ($product_unit_detail_data->project_type == '2') {
                            $unit_type = $product_unit_detail_data->accomodation_name;

                            if ($product_unit_detail_data->sa) {
                                $size = $product_unit_detail_data->sa;
                                if ($product_unit_detail_data->sa_unit_name) {
                                    $size .= ' ' . $product_unit_detail_data->sa_unit_name;
                                }
                            }

                            if ($product_unit_detail_data->plot_size) {
                                $size = $product_unit_detail_data->plot_size;
                                if ($product_unit_detail_data->plot_unit_name) {
                                    $size .= ' ' . $product_unit_detail_data->plot_unit_name;
                                }
                            }
                        }
                        if ($product_unit_detail_data->project_type == '3') {
                            $unit_type = $product_unit_detail_data->unit_type_name;

                            $size = $product_unit_detail_data->sa;
                            if ($product_unit_detail_data->sa_unit_name) {
                                $size .= ' ' . $product_unit_detail_data->sa_unit_name;
                            }
                        }

                        $items[] = array('inventory_id' => $item->inventory_id, 'unit_code' => $item->unit_code, 'unit_ref_no' => $item->unit_no, 'current_rate' => $current_rate, 'floor' => ($item->floor_name) ? $item->floor_name : '', 'size' => $size, 'block' => ($item->block_name) ? $item->block_name : '', 'unit_type' => $unit_type, 'selected' => '0');
                    }
                }

                if (strpos($cost_type, "Parking_Basment") !== false) {
                    $where .= " AND parking='1' AND parking_basment='1'";

                    $this->db->select('*,tbl_inventory.inventory_id,b_unit.unit_name as current_rate_unit_name');
                    $this->db->from('tbl_inventory');
                    $this->db->join('tbl_product_unit_details', 'tbl_product_unit_details.product_unit_detail_id = tbl_inventory.unit_code');
                    $this->db->join('tbl_products', 'tbl_products.product_id = tbl_product_unit_details.product_id');
                    $this->db->join('tbl_product_block_details', 'tbl_product_block_details.block_id = tbl_inventory.block_id', 'left');
                    $this->db->join('tbl_floors', 'tbl_floors.floor_id = tbl_inventory.floor_id', 'left');
                    $this->db->join('tbl_units as b_unit', 'b_unit.unit_id = tbl_inventory.b_current_rate_unit', 'left');
                    $this->db->where($where);
                    $query = $this->db->get();
                    $item_data = $query->result();
                    foreach ($item_data as $item) {

                        $current_rate = "";
                        if ($item->b_cost_update) {
                            if ($item->b_current_rate) {
                                $current_rate = $item->b_current_rate . ' ' . $item->current_rate_unit_name;
                                if ($item->b_current_rate_gst) {
                                    $current_rate .= ", GST:" . $item->b_current_rate_gst . "%";
                                }
                            }
                        } else {
                            $current_rate = ($product_unit_detail_data->b_price) ? $product_unit_detail_data->b_price : '';
                            if ($product_unit_detail_data->parking_gst && $product_unit_detail_data->parking_gst) {
                                $current_rate .= ", GST:" . $product_unit_detail_data->parking_gst . "%";
                            }
                        }

                        $unit_type = "";
                        $size = "";

                        if ($product_unit_detail_data->project_type == '2') {
                            $unit_type = $product_unit_detail_data->accomodation_name;

                            if ($product_unit_detail_data->sa) {
                                $size = $product_unit_detail_data->sa;
                                if ($product_unit_detail_data->sa_unit_name) {
                                    $size .= ' ' . $product_unit_detail_data->sa_unit_name;
                                }
                            }

                            if ($product_unit_detail_data->plot_size) {
                                $size = $product_unit_detail_data->plot_size;
                                if ($product_unit_detail_data->plot_unit_name) {
                                    $size .= ' ' . $product_unit_detail_data->plot_unit_name;
                                }
                            }
                        }
                        if ($product_unit_detail_data->project_type == '3') {
                            $unit_type = $product_unit_detail_data->unit_type_name;

                            $size = $product_unit_detail_data->sa;
                            if ($product_unit_detail_data->sa_unit_name) {
                                $size .= ' ' . $product_unit_detail_data->sa_unit_name;
                            }
                        }

                        $items[] = array('inventory_id' => $item->inventory_id, 'unit_code' => $item->unit_code, 'unit_ref_no' => $item->unit_no, 'current_rate' => $current_rate, 'floor' => ($item->floor_name) ? $item->floor_name : '', 'size' => $size, 'block' => ($item->block_name) ? $item->block_name : '', 'unit_type' => $unit_type, 'selected' => '0');
                    }
                }

                $array = array('status' => 'success', 'message' => 'Data Found', 'size' => $size, 'items' => $items, 'current_rate' => $current_rate, 'current_rate_unit' => $current_rate_unit);
            } else {
                $array = array('status' => 'error', 'message' => 'Data Not Found');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_update_additional_cost_list1()
    {
        $array = array();
        $items = array();

        if ($this->input->post()) {

            $account_id = getAccountId();

            $product_id = $this->input->post('product_id');
            $unit_code = $this->input->post('unit_code');

            $where = "pud.product_id='" . $product_id . "' AND pud.product_unit_detail_id='" . $unit_code . "'";
            //$product_unit_detail_data = $this->Action_model->select_single('tbl_product_unit_details',$where);
            $this->db->select("*,sa_unit.unit_name as sa_unit_name,plt_unit.unit_name as plot_unit_name");
            $this->db->from('tbl_product_unit_details as pud');
            $this->db->join('tbl_products as p', 'p.product_id = pud.product_id', 'left');
            $this->db->join('tbl_units as punit', 'punit.unit_id = pud.plot_unit', 'left');
            $this->db->join('tbl_units as sa_unit', 'sa_unit.unit_id = pud.unit', 'left');
            $this->db->join('tbl_accomodations as accom', 'accom.accomodation_id = pud.accomodation', 'left');
            $this->db->join('tbl_unit_types as unit_type', 'unit_type.unit_type_id = pud.sub_category', 'left');
            $this->db->join('tbl_units as plt_unit', 'plt_unit.unit_id = pud.plot_unit', 'left');
            $this->db->join('tbl_additional_parking_cost', 'tbl_additional_parking_cost.product_unit_detail_id = pud.product_unit_detail_id', 'left');
            $this->db->where($where);
            $query = $this->db->get();
            $product_unit_detail_data = $query->row();
            $data['product_unit_detail_data'] = $product_unit_detail_data;

            if ($product_unit_detail_data) {

                $data['unit_list'] = $this->Action_model->detail_result('tbl_units', "unit_id!=''");

                $where = "product_id='" . $product_id . "'";
                $this->db->select('*,tbl_product_additional_details.product_additional_detail_id as product_additional_detail_id,u.unit_name as unit_name,cru.unit_name as current_rate_unit_name');
                $this->db->from('tbl_product_additional_details');
                $this->db->join('tbl_price_components', 'tbl_price_components.price_component_id = tbl_product_additional_details.price_comp_id', 'left');
                $this->db->join('tbl_units as u', 'u.unit_id = tbl_product_additional_details.unit', 'left');
                $this->db->join('tbl_additional_cost', 'tbl_additional_cost.product_additional_detail_id = tbl_product_additional_details.product_additional_detail_id', 'left');
                $this->db->join('tbl_units as cru', 'cru.unit_id = tbl_additional_cost.current_rate_unit', 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $additional_details = $query->result();
                $data['additional_details'] = $additional_details;

                $where = "product_id='" . $product_id . "'";
                $this->db->select('*,tbl_product_plc_details.product_plc_detail_id as product_plc_detail_id,u.unit_name as unit_name,cru.unit_name as current_rate_unit_name');
                $this->db->from('tbl_product_plc_details');
                $this->db->join('tbl_price_components', 'tbl_price_components.price_component_id = tbl_product_plc_details.price_comp_id', 'left');
                $this->db->join('tbl_units as u', 'u.unit_id = tbl_product_plc_details.unit', 'left');
                $this->db->join('tbl_additional_plc_cost', 'tbl_additional_plc_cost.product_plc_detail_id = tbl_product_plc_details.product_plc_detail_id', 'left');
                $this->db->join('tbl_units as cru', 'cru.unit_id = tbl_additional_plc_cost.current_rate_unit', 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $plc_details = $query->result();
                $data['plc_details'] = $plc_details;

                $this->load->view(AGENT_URL . 'ajax/get_update_additional_cost_list', $data);
            } else {
            }
        } else {
        }
    }

    public function additional_cost_update()
    {
        $array = array();

        if ($this->input->post()) {

            $account_id = getAccountId();

            $product_id = $this->input->post('product_id');
            $unit_code = $this->input->post('unit_code');
            $new_rate = $this->input->post('new_rate');
            $new_rate_unit = $this->input->post('new_rate_unit');
            $new_rate_gst = $this->input->post('new_rate_gst');
            $cost_type = $this->input->post('cost_type');

            $where = "product_id='" . $product_id . "' AND product_unit_detail_id='" . $unit_code . "'";
            $product_unit_detail_data = $this->Action_model->select_single('tbl_product_unit_details', $where);

            if ($product_unit_detail_data) {
                //$where = "product_unit_detail_id='".$product_unit_detail_data->product_unit_detail_id."'";
                //$basic_cost_data = $this->Action_model->select_single('tbl_basic_cost',$where);

                /*$basic_cost_id = "";
                if ($basic_cost_data) {
                    $basic_cost_id = $basic_cost_data->basic_cost_id;
                    if ($new_rate) {
                        $basic_cost_array = array(
                            'product_unit_detail_id'=>$product_unit_detail_data->product_unit_detail_id,
                            'current_rate'=>$new_rate,
                            'current_rate_unit'=>$new_rate_unit,
                            'updated_at'=>time()
                        );
                        $this->Action_model->update_data($basic_cost_array,'tbl_basic_cost',$where);
                    }
                }
                else {
                    $basic_cost_array = array(
                        'product_unit_detail_id'=>$product_unit_detail_data->product_unit_detail_id,
                        'current_rate'=>$new_rate,
                        'current_rate_unit'=>$new_rate_unit,
                        'created_at'=>time()
                    );
                    $basic_cost_id = $this->Action_model->insert_data($basic_cost_array,'tbl_basic_cost');
                }*/

                $in_unit = $this->input->post('in_unit');

                if ($in_unit) {
                    foreach ($in_unit as $item) {

                        $selected = 0;
                        if (isset($item['chk'])) {
                            $selected = 1;

                            if (strpos($cost_type, "Additional_") !== false) {

                                $tmp_id = str_replace("Additional_", "", $cost_type);
                                $where = "inventory_id='" . $item['unit_id'] . "' AND product_additional_detail_id='" . $tmp_id . "'";
                                $additional_detail_data = $this->Action_model->select_single('tbl_inventory_additional', $where);

                                if ($additional_detail_data) {
                                    $data_array = array(
                                        'current_rate' => $new_rate,
                                        'current_rate_unit' => $new_rate_unit,
                                        'current_rate_gst' => $new_rate_gst,
                                        'cost_update' => 1
                                    );
                                    $this->Action_model->update_data($data_array, 'tbl_inventory_additional', $where);
                                }
                            }

                            if (strpos($cost_type, "PLC_") !== false) {

                                $tmp_id = str_replace("PLC_", "", $cost_type);
                                $where = "inventory_id='" . $item['unit_id'] . "' AND product_plc_detail_id='" . $tmp_id . "'";
                                $plc_detail_data = $this->Action_model->select_single('tbl_inventory_plc', $where);

                                if ($plc_detail_data) {
                                    $data_array = array(
                                        'current_rate' => $new_rate,
                                        'current_rate_unit' => $new_rate_unit,
                                        'current_rate_gst' => $new_rate_gst,
                                        'cost_update' => 1
                                    );
                                    $this->Action_model->update_data($data_array, 'tbl_inventory_plc', $where);
                                }
                            }

                            if (strpos($cost_type, "Parking_Open") !== false) {

                                $where = "inventory_id='" . $item['unit_id'] . "'";
                                $plc_detail_data = $this->Action_model->select_single('tbl_inventory', $where);

                                if ($plc_detail_data) {
                                    $data_array = array(
                                        'o_current_rate' => $new_rate,
                                        'o_current_rate_unit' => $new_rate_unit,
                                        'o_current_rate_gst' => $new_rate_gst,
                                        'o_cost_update' => 1
                                    );
                                    $this->Action_model->update_data($data_array, 'tbl_inventory', $where);
                                }
                            }

                            if (strpos($cost_type, "Parking_Stilt") !== false) {

                                $where = "inventory_id='" . $item['unit_id'] . "'";
                                $plc_detail_data = $this->Action_model->select_single('tbl_inventory', $where);

                                if ($plc_detail_data) {
                                    $data_array = array(
                                        's_current_rate' => $new_rate,
                                        's_current_rate_unit' => $new_rate_unit,
                                        's_current_rate_gst' => $new_rate_gst,
                                        's_cost_update' => 1
                                    );
                                    $this->Action_model->update_data($data_array, 'tbl_inventory', $where);
                                }
                            }

                            if (strpos($cost_type, "Parking_Basment") !== false) {

                                $where = "inventory_id='" . $item['unit_id'] . "'";
                                $plc_detail_data = $this->Action_model->select_single('tbl_inventory', $where);

                                if ($plc_detail_data) {
                                    $data_array = array(
                                        'b_current_rate' => $new_rate,
                                        'b_current_rate_unit' => $new_rate_unit,
                                        'b_current_rate_gst' => $new_rate_gst,
                                        'b_cost_update' => 1
                                    );
                                    $this->Action_model->update_data($data_array, 'tbl_inventory', $where);
                                }
                            }
                        }
                    }
                }

                $this->session->set_flashdata('success_msg', 'Additional Cost Updated Successfully.');

                $array = array('status' => 'success', 'message' => 'Additional Cost Updated Successfully.');
            } else {
                $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function additional_cost_update1()
    {

        if ($this->input->post()) {

            $account_id = getAccountId();

            $product_id = $this->input->post('product_id');
            $unit_code = $this->input->post('unit_code');
            $new_rate = $this->input->post('new_rate');
            $new_rate_unit = $this->input->post('new_rate_unit');

            $where = "p.product_id='" . $product_id . "' AND product_unit_detail_id='" . $unit_code . "'";
            $this->db->select("*,p.product_id");
            $this->db->from('tbl_product_unit_details as pud');
            $this->db->join('tbl_products as p', 'p.product_id = pud.product_id', 'left');
            $this->db->where($where);
            $query = $this->db->get();
            $product_unit_detail_data = $query->row();

            if ($product_unit_detail_data) {

                $additional = $this->input->post('additional');

                if ($additional) {
                    foreach ($additional as $k => $item) {

                        if (isset($item['current_rate']) && $item['current_rate']) {

                            $where = "product_additional_detail_id='" . $k . "' AND product_unit_detail_id='" . $unit_code . "'";
                            $dd = $this->Action_model->select_single('tbl_additional_cost', $where);

                            if ($dd) {
                                $data_array = array(
                                    'current_rate' => $item['current_rate'],
                                    'current_rate_unit' => $item['current_rate_unit'],
                                    'current_rate_gst' => $item['current_rate_gst']
                                );
                                $this->Action_model->update_data($data_array, 'tbl_additional_cost', $where);
                            } else {
                                $data_array = array(
                                    'product_unit_detail_id' => $k,
                                    'product_additional_detail_id' => $unit_code,
                                    'current_rate' => $item['current_rate'],
                                    'current_rate_unit' => $item['current_rate_unit'],
                                    'current_rate_gst' => $item['current_rate_gst']
                                );
                                $this->Action_model->insert_data($data_array, 'tbl_additional_cost');
                            }
                        }
                    }
                }

                $plc = $this->input->post('plc');

                if ($plc) {
                    foreach ($plc as $k => $item) {

                        if (isset($item['current_rate']) && $item['current_rate']) {

                            $where = "product_plc_detail_id='" . $k . "' AND product_unit_detail_id='" . $unit_code . "'";
                            $dd = $this->Action_model->select_single('tbl_additional_plc_cost', $where);

                            if ($dd) {
                                $data_array = array(
                                    'current_rate' => $item['current_rate'],
                                    'current_rate_unit' => $item['current_rate_unit'],
                                    'current_rate_gst' => $item['current_rate_gst']
                                );
                                $this->Action_model->update_data($data_array, 'tbl_additional_plc_cost', $where);
                            } else {
                                $data_array = array(
                                    'product_unit_detail_id' => $k,
                                    'product_plc_detail_id' => $unit_code,
                                    'current_rate' => $item['current_rate'],
                                    'current_rate_unit' => $item['current_rate_unit'],
                                    'current_rate_gst' => $item['current_rate_gst']
                                );
                                $this->Action_model->insert_data($data_array, 'tbl_additional_plc_cost');
                            }
                        }
                    }
                }

                $where = "product_unit_detail_id='" . $unit_code . "'";
                $dd = $this->Action_model->select_single('tbl_additional_parking_cost', $where);

                if ($dd) {
                    $data_array = array(
                        'add_o_price' => ($this->input->post('add_o_price')) ? $this->input->post('add_o_price') : $dd->add_o_price,
                        'add_s_price' => ($this->input->post('add_s_price')) ? $this->input->post('add_s_price') : $dd->add_s_price,
                        'add_b_price' => ($this->input->post('add_b_price')) ? $this->input->post('add_b_price') : $dd->add_b_price
                    );
                    $this->Action_model->update_data($data_array, 'tbl_additional_parking_cost', $where);
                } else {
                    $data_array = array(
                        'product_unit_detail_id' => $unit_code,
                        'add_o_price' => ($this->input->post('add_o_price')) ? $this->input->post('add_o_price') : $product_unit_detail_data->o_price,
                        'add_s_price' => ($this->input->post('add_s_price')) ? $this->input->post('add_s_price') : $product_unit_detail_data->s_price,
                        'add_b_price' => ($this->input->post('add_b_price')) ? $this->input->post('add_b_price') : $product_unit_detail_data->b_price
                    );
                    $this->Action_model->insert_data($data_array, 'tbl_additional_parking_cost');
                }

                $this->session->set_flashdata('success_msg', 'Additional Cost Updated Successfully.');

                $array = array('status' => 'success', 'message' => 'Additional Cost Updated Successfully.');
            } else {
                $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    /* booking */

    public function get_booking_product_data()
    {
        $array = array();
        $city_list = array();

        if ($this->input->post()) {
            $product_id = $this->input->post('product_id');
            $product_data = $this->Action_model->select_single('tbl_products', "product_id='" . $product_id . "'");

            if ($product_data) {
                $where = "pud.product_id='" . $product_id . "' AND pud.project_type='" . $product_data->project_type . "' AND pud.property_type='" . $product_data->property_type . "'";

                $block_list = array();
                $this->db->select('*');
                $this->db->from('tbl_product_block_details as pud');
                $this->db->where($where);
                $query = $this->db->get();
                $block_data = $query->result();
                foreach ($block_data as $item) {
                    $block_list[] = array('block_id' => $item->block_id, 'block_name' => $item->block_name);
                }
                $data['block_list'] = $block_list;

                $size_list = array();
                $this->db->select('*,sa_unit.unit_name as sa_unit_name,plt_unit.unit_name as plot_unit_name');
                $this->db->from('tbl_product_unit_details as pud');
                $this->db->join('tbl_accomodations', 'tbl_accomodations.accomodation_id = pud.accomodation', 'left');
                $this->db->join('tbl_products as p', 'p.product_id = pud.product_id', 'left');
                $this->db->join('tbl_units as sa_unit', 'sa_unit.unit_id = pud.unit', 'left');
                $this->db->join('tbl_units as plt_unit', 'plt_unit.unit_id = pud.plot_unit', 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $unit_data = $query->result();
                foreach ($unit_data as $item) {

                    $size = "";
                    if ($item->project_type == '2') {

                        if ($item->sa) {
                            $size = $item->sa;
                            if ($item->sa_unit_name) {
                                $size .= ' ' . $item->sa_unit_name;
                            }
                        }

                        if ($item->plot_size) {
                            $size = $item->plot_size;
                            if ($item->plot_unit_name) {
                                $size .= ' ' . $item->plot_unit_name;
                            }
                        }
                    }
                    if ($item->project_type == '3') {

                        $size = $item->sa;
                        if ($item->sa_unit_name) {
                            $size .= ' ' . $item->sa_unit_name;
                        }
                    }
                    $size_list[] = array('size_id' => $size . "##" . $item->product_unit_detail_id . "##" . $item->accomodation . "##" . (($item->accomodation_name) ? $item->accomodation_name : ''), 'size_name' => $size);
                }

                $array = array('status' => 'success', 'message' => 'Data Found', 'block_list' => $block_list, 'size_list' => $size_list);
            } else {
                $array = array('status' => 'success', 'message' => 'Data Found', 'block_list' => array(), 'size_list' => array());
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_booking_unit_no()
    {
        $array = array();
        $city_list = array();

        if ($this->input->post()) {
            $product_unit_detail_id = $this->input->post('product_unit_detail_id');
            $tower = $this->input->post('tower');
            $floor = $this->input->post('floor');

            $where = "inv.unit_code='" . $product_unit_detail_id . "'";
            if ($tower) {
                $where .= " AND block_id='" . $tower . "'";
            }
            if ($floor) {
                $where .= " AND floor_id='" . $floor . "'";
            }
            $where .= " AND inventory_status='1'";
            $unit_no_list = array();
            $this->db->select('*,sa_unit.unit_name as sa_unit_name,plt_unit.unit_name as plot_unit_name');
            $this->db->from('tbl_inventory as inv');
            $this->db->join('tbl_product_unit_details as pud', 'pud.product_unit_detail_id=inv.unit_code');
            $this->db->join('tbl_products as p', 'p.product_id = pud.product_id', 'left');
            $this->db->join('tbl_units as sa_unit', 'sa_unit.unit_id = pud.unit', 'left');
            $this->db->join('tbl_units as plt_unit', 'plt_unit.unit_id = pud.plot_unit', 'left');
            $this->db->where($where);
            $query = $this->db->get();
            $unit_data = $query->result();
            foreach ($unit_data as $item) {
                $check = $this->Action_model->select_single('tbl_bookings', "inventory_id='" . $item->inventory_id . "'");
                if (!$check) {
                    $unit_no_list[] = array('unit_no' => $item->unit_no, 'unit_ref_no' => $item->unit_no . '##' . $item->reference . '##' . $item->inventory_id);
                }
            }

            $array = array('status' => 'success', 'message' => 'Data Found', 'unit_no_list' => $unit_no_list);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_feedback_single()
    {
        $array = array();
        $city_list = array();

        if ($this->input->post()) {
            $feedback_id = $this->input->post('feedback_id');

            $where = "feedback_id='" . $feedback_id . "'";

            $unit_no_list = array();
            $this->db->select('*');
            $this->db->from('tbl_feedbacks');
            $this->db->where($where);
            $query = $this->db->get();
            $feedback_data = $query->row();

            if ($feedback_data) {
                $array = array('status' => 'success', 'message' => 'Data Found', 'feedback_data' => $feedback_data);
            } else {
                $array = array('status' => 'error', 'message' => 'Record Not Found');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_booking_form()
    {
        if ($this->input->post()) {

            $account_id = getAccountId();

            $lead_id = $this->input->post('lead_id');
            $where = "lead_id='" . $lead_id . "' AND account_id='" . $account_id . "'";
            $lead_data = $this->Action_model->select_single('tbl_leads', $where);
            if ($lead_data) {
                $data['lead_data'] = $lead_data;

                $where = "country_id='1' AND state_status=1";
                $state_list = $this->Action_model->detail_result('tbl_states', $where);
                $data['state_list'] = $state_list;

                $city_list = array();
                $where = "city_status=1 AND state_id='" . $lead_data->lead_state_id . "'";
                $city_list = $this->Action_model->detail_result('tbl_city', $where);
                $data['city_list'] = $city_list;

                $data['accomodation_list'] = $this->Action_model->detail_result('tbl_accomodations', "accomodation_status='1'");
                $data['floor_list'] = $this->Action_model->detail_result('tbl_floors', "floor_id!=''");

                $where = "agent_id='" . $account_id . "' OR share_account_id='" . $account_id . "'";
                //$project_list = $this->Action_model->detail_result('tbl_products',$where);
                //$data['project_list'] = $project_list;
                $this->db->select("*");
                $this->db->from('tbl_products');
                $this->db->join('tbl_project_share', "tbl_project_share.project_id = tbl_products.product_id AND share_account_id='" . $account_id . "'", 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $project_list = $query->result();
                $data['project_list'] = $project_list;

                $this->load->view(AGENT_URL . 'ajax/get_booking_form', $data);
            }
        }
    }
    /* booking end */

    public function get_update_inventory_status_fields()
    {
        if ($this->input->post()) {

            $account_id = getAccountId();

            $product_id = $this->input->post('product_id');
            $where = "product_id='" . $product_id . "' AND agent_id='" . $account_id . "'";
            $product_data = $this->Action_model->select_single('tbl_products', $where);
            if ($product_data) {
                $data['product_data'] = $product_data;

                if ($product_data->project_type == 3) {
                    $where = "product_id='" . $product_id . "'";
                } else {
                    $where = "product_id='" . $product_id . "' AND property_type='" . $product_data->property_type . "'";
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

                $unit_code_list = array();
                $this->db->select('*');
                $this->db->from('tbl_product_unit_details');
                $this->db->where($where);
                $query = $this->db->get();
                $block_data = $query->result();
                foreach ($block_data as $item) {
                    $unit_code_list[] = array('id' => $item->product_unit_detail_id, 'name' => $item->code);
                }
                $data['unit_code_list'] = $unit_code_list;

                $data['floor_list'] = $this->Action_model->detail_result('tbl_floors', "floor_id!=''");
                $data['unit_list'] = $this->Action_model->detail_result('tbl_units', "unit_id!=''");
                $data['inventory_status_list'] = $this->Action_model->detail_result('tbl_inventory_status', "inventory_status_id!=''");
                $data['accomodation_list'] = $this->Action_model->detail_result('tbl_accomodations', "accomodation_id!=''");

                $this->load->view(AGENT_URL . 'ajax/get_update_inventory_status_fields', $data);
            }
        }
    }

    public function get_update_inventory_status_data()
    {
        $array = array();
        $items = array();

        if ($this->input->post()) {

            $account_id = getAccountId();

            $product_id = $this->input->post('product_id');
            $unit_code = $this->input->post('unit_code');
            $tower_id = $this->input->post('tower_id');
            $floor_id = $this->input->post('floor_id');
            $accomodation_id = $this->input->post('accomodation_id');
            $inventory_status = $this->input->post('inventory_status');

            $where = "pud.product_id='" . $product_id . "' AND pud.product_unit_detail_id='" . $unit_code . "'";
            if ($accomodation_id) {
                $where .= " AND pud.accomodation='" . $accomodation_id . "'";
            }
            //$product_unit_detail_data = $this->Action_model->select_single('tbl_product_unit_details',$where);
            $this->db->select("*,sa_unit.unit_name as sa_unit_name,plt_unit.unit_name as plot_unit_name");
            $this->db->from('tbl_product_unit_details as pud');
            $this->db->join('tbl_products as p', 'p.product_id = pud.product_id', 'left');
            $this->db->join('tbl_units as punit', 'punit.unit_id = pud.plot_unit', 'left');
            $this->db->join('tbl_units as sa_unit', 'sa_unit.unit_id = pud.unit', 'left');
            $this->db->join('tbl_accomodations as accom', 'accom.accomodation_id = pud.accomodation', 'left');
            $this->db->join('tbl_unit_types as unit_type', 'unit_type.unit_type_id = pud.sub_category', 'left');
            $this->db->join('tbl_units as plt_unit', 'plt_unit.unit_id = pud.plot_unit', 'left');
            $this->db->where($where);
            $query = $this->db->get();
            $product_unit_detail_data = $query->row();

            if ($product_unit_detail_data) {
                $size = "";
                if ($product_unit_detail_data->project_type == 2) {

                    if (($product_unit_detail_data->property_type == 1 || $product_unit_detail_data->property_type == 7) && $product_unit_detail_data->sa) {
                        $size = $product_unit_detail_data->sa;
                        if ($product_unit_detail_data->sa_unit_name) {
                            $size .= ' ' . $product_unit_detail_data->sa_unit_name;
                        }
                    }
                    if (($product_unit_detail_data->property_type == 2 || $product_unit_detail_data->property_type == 3) && $product_unit_detail_data->plot_size) {
                        $size = $product_unit_detail_data->plot_size;
                        if ($product_unit_detail_data->plot_unit_name) {
                            $size .= ' ' . $product_unit_detail_data->plot_unit_name;
                        }
                    }
                }

                if ($product_unit_detail_data->project_type == 3 && $product_unit_detail_data->sa) {
                    $size = $product_unit_detail_data->sa;
                    if ($product_unit_detail_data->sa_unit_name) {
                        $size .= ' ' . $product_unit_detail_data->sa_unit_name;
                    }
                }

                $current_rate = "";
                $current_rate_unit = "";

                /*$where = "product_unit_detail_id='".$product_unit_detail_data->product_unit_detail_id."'";
                $basic_cost_data = $this->Action_model->select_single('tbl_basic_cost',$where);
                if ($basic_cost_data) {
                    $current_rate = $basic_cost_data->current_rate;
                    $current_rate_unit = $basic_cost_data->current_rate_unit;
                }*/

                $where = "tbl_inventory.product_id='" . $product_id . "' AND unit_code='" . $product_unit_detail_data->product_unit_detail_id . "'";
                if ($tower_id) {
                    $where .= " AND tbl_inventory.block_id='" . $tower_id . "'";
                }
                if ($floor_id) {
                    $where .= " AND tbl_inventory.floor_id='" . $floor_id . "'";
                }
                if ($inventory_status) {
                    $where .= " AND tbl_inventory.inventory_status='" . $inventory_status . "'";
                }

                $items = array();
                $this->db->select('*,tbl_inventory.inventory_id,b_unit.unit_name as current_rate_unit_name');
                $this->db->from('tbl_inventory');
                $this->db->join('tbl_product_block_details', 'tbl_product_block_details.block_id = tbl_inventory.block_id', 'left');
                $this->db->join('tbl_floors', 'tbl_floors.floor_id = tbl_inventory.floor_id', 'left');
                $this->db->join('tbl_basic_cost', 'tbl_basic_cost.inventory_id = tbl_inventory.inventory_id', 'left');
                $this->db->join('tbl_units as b_unit', 'b_unit.unit_id = tbl_basic_cost.current_rate_unit', 'left');
                $this->db->join('tbl_inventory_status', 'tbl_inventory_status.inventory_status_id = tbl_inventory.inventory_status', 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $item_data = $query->result();
                foreach ($item_data as $item) {

                    $current_rate = "";
                    if ($item->basic_cost_id) {
                        if ($item->current_rate) {
                            $current_rate = $item->current_rate . ' ' . $item->current_rate_unit_name;
                        }
                    } else {
                        $current_rate = $product_unit_detail_data->basic_cost;
                    }

                    $unit_type = "";
                    $size = "";

                    if ($product_unit_detail_data->project_type == '2') {
                        $unit_type = $product_unit_detail_data->accomodation_name;

                        if ($product_unit_detail_data->sa) {
                            $size = $product_unit_detail_data->sa;
                            if ($product_unit_detail_data->sa_unit_name) {
                                $size .= ' ' . $product_unit_detail_data->sa_unit_name;
                            }
                        }

                        if ($product_unit_detail_data->plot_size) {
                            $size = $product_unit_detail_data->plot_size;
                            if ($product_unit_detail_data->plot_unit_name) {
                                $size .= ' ' . $product_unit_detail_data->plot_unit_name;
                            }
                        }
                    }
                    if ($product_unit_detail_data->project_type == '3') {
                        $unit_type = $product_unit_detail_data->unit_type_name;

                        $size = $product_unit_detail_data->sa;
                        if ($product_unit_detail_data->sa_unit_name) {
                            $size .= ' ' . $product_unit_detail_data->sa_unit_name;
                        }
                    }

                    $items[] = array('inventory_id' => $item->inventory_id, 'unit_code' => $item->unit_code, 'unit_ref_no' => $item->unit_no, 'current_rate' => $current_rate, 'floor' => ($item->floor_name) ? $item->floor_name : '', 'size' => $size, 'block' => ($item->block_name) ? $item->block_name : '', 'unit_type' => $unit_type, 'selected' => '', 'inventory_status' => $item->inventory_status, 'inventory_status_name' => ($item->inventory_status_name) ? $item->inventory_status_name : '', 'last_update' => ($item->last_update) ? date("d-m-y h:i:s A") : '');
                }

                $array = array('status' => 'success', 'message' => 'Data Found', 'size' => $size, 'items' => $items, 'current_rate' => $current_rate, 'current_rate_unit' => $current_rate_unit);
            } else {
                $array = array('status' => 'error', 'message' => 'Data Not Found');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function update_inventory_status()
    {
        $array = array();

        if ($this->input->post()) {

            $account_id = getAccountId();

            $product_id = $this->input->post('product_id');
            $unit_code = $this->input->post('unit_code');
            $new_inventory_status = $this->input->post('new_inventory_status');

            $where = "product_id='" . $product_id . "' AND product_unit_detail_id='" . $unit_code . "'";
            $product_unit_detail_data = $this->Action_model->select_single('tbl_product_unit_details', $where);

            if ($product_unit_detail_data) {

                $in_unit = $this->input->post('in_unit');

                if ($in_unit) {
                    foreach ($in_unit as $item) {

                        $selected = 0;
                        if (isset($item['chk'])) {
                            $selected = '';

                            $where = "inventory_id='" . $item['unit_id'] . "'";
                            $inv_data = $this->Action_model->select_single('tbl_inventory', $where);

                            if ($inv_data) {
                                $data_array = array(
                                    'inventory_status' => $new_inventory_status, 'last_update' => time()
                                );
                                $this->Action_model->update_data($data_array, 'tbl_inventory', $where);
                            }
                        }
                    }
                }

                $this->session->set_flashdata('success_msg', 'Inventory Status Updated Successfully.');

                $array = array('status' => 'success', 'message' => 'Inventory Status Updated Successfully.');
            } else {
                $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    /* booking report start */
    public function booking_report_list()
    {

        $account_id = getAccountId();

        $postData = $this->input->post();
        $search_text = $this->input->post('search_text');
        $search_agent_id = $this->input->post('search_agent_id');
        $search_builder_id = $this->input->post('search_builder_id');
        $search_product_id = $this->input->post('search_product_id');
        $search_booking_status = $this->input->post('search_booking_status');
        $search_from = $this->input->post('search_from');
        $search_to = $this->input->post('search_to');

        $select = 'booking_id,customer_name,booking_date,unit_ref_no,project_name,tbl_builders.firm_name as b_firm_name,tbl_users.is_individual,tbl_users.firm_name as a_firm_name,tbl_users.first_name as a_first_name,tbl_users.last_name as a_last_name,booking_status';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "booking_id!=''";

        if ($search_text != '') {
            $searchQuery .= " and (tbl_bookings.customer_name like '%" . $search_text . "%' || tbl_bookings.unit_ref_no like '%" . $search_text . "%') ";
        }

        //$search_agent_id =$account_id;

        if ($search_agent_id != '') {
            $searchQuery .= " and tbl_bookings.account_id='" . $search_agent_id . "' ";
        }

        if ($search_builder_id != '') {
            $searchQuery .= " and tbl_products.builder_id='" . $search_builder_id . "' ";
        }

        if ($search_product_id != '') {
            $searchQuery .= " and tbl_bookings.project_id='" . $search_product_id . "' ";
        }

        if ($search_booking_status != '') {
            $searchQuery .= " and tbl_bookings.booking_status='" . $search_booking_status . "' ";
        }

        if ($search_from && $search_to) {
            $searchQuery .= " and (str_to_date(tbl_bookings.booking_date,'%d-%m-%Y') BETWEEN str_to_date('" . $search_from . "','%d-%m-%Y') AND str_to_date('" . $search_to . "','%d-%m-%Y'))";
        } else if ($search_from && !$search_to) {
            $searchQuery .= " and (str_to_date(tbl_bookings.booking_date,'%d-%m-%Y')>=str_to_date('" . $search_from . "','%d-%m-%Y'))";
        } else if (!$search_from && $search_to) {
            $searchQuery .= " and (str_to_date(tbl_bookings.booking_date,'%d-%m-%Y')<=str_to_date('" . $search_to . "','%d-%m-%Y'))";
        }

        if ($searchQuery != '') {
            $searchQuery .= " and ((tbl_products.agent_id='" . $account_id . "') OR (share_account_id='" . $account_id . "' AND tbl_bookings.account_id='" . $account_id . "'))";
        } else {
            $searchQuery .= "((tbl_products.agent_id='" . $account_id . "') OR (share_account_id='" . $account_id . "' AND tbl_bookings.account_id='" . $account_id . "'))";
        }

        //echo $searchQuery;

        /* if($searchValue != ''){
            $searchQuery = " (location_name like '%".$searchValue."%' OR state_name like '%".$searchValue."%' OR city_name like '%".$searchValue."%') ";
         }

        if($search_state_id != ''){
           $searchQuery .= " and tbl_locations.state_id='".$search_state_id."' ";
        }

        if($search_city_id != ''){
           $searchQuery .= " and tbl_locations.city_id='".$search_city_id."' ";
        }*/

        //,array('tbl_states','tbl_states.state_id=tbl_locations.state_id','tbl_city','tbl_city.city_id=tbl_locations.city_id' )
        $data = $this->Action_model->ajaxDatatableLeft($postData, $searchQuery, 'tbl_bookings', $where, $select, array('tbl_products', 'tbl_products.product_id=tbl_bookings.project_id', 'tbl_builders', 'tbl_builders.builder_id=tbl_products.builder_id', 'tbl_users', 'tbl_users.user_id=tbl_bookings.account_id', 'tbl_project_share', "tbl_project_share.project_id = tbl_products.product_id AND share_account_id='" . $account_id . "'"));

        $aaData = $data['aaData'];

        foreach ($aaData as $item) {
            $item->agent_name = ($item->is_individual) ? (ucwords($item->a_first_name . ' ' . $item->a_last_name)) : $item->a_firm_name;
        }
        $data['aaData'] = $aaData;

        echo json_encode($data);
    }

    public function update_booking_status()
    {
        $array = array();

        if ($this->input->post()) {

            $id = $this->input->post('id');
            $status = $this->input->post('status');
            $record = $this->Action_model->select_single('tbl_bookings', "booking_id='" . $id . "'");

            $status_label = "";

            if ($record) {

                if ($status == 1) {
                    $status_label = "Accepted";
                    $this->Action_model->update_data(array('inventory_status' => 4), 'tbl_inventory', "inventory_id='" . $record->inventory_id . "'");
                } else if ($status == 2) {
                    $status_label = "Rejected";
                    $this->Action_model->update_data(array('inventory_status' => 1), 'tbl_inventory', "inventory_id='" . $record->inventory_id . "'");
                } else if ($status == 3) {
                    $status_label = "Cancelled";
                    $this->Action_model->update_data(array('inventory_status' => 1), 'tbl_inventory', "inventory_id='" . $record->inventory_id . "'");
                }

                $this->Action_model->update_data(array('booking_status' => $status, 'comment' => $this->input->post('comment')), 'tbl_bookings', "booking_id='" . $id . "'");
                $array = array('status' => 'success', 'message' => 'Booking ' . $status_label . ' Successfully!!');
                $this->session->set_flashdata('success_msg', 'Booking ' . $status_label . ' Successfully!!');
            } else {
                $array = array('status' => 'error', 'message' => 'Booking Not Found!!');
                $this->session->set_flashdata('error_msg', 'Booking Not Found!!');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function update_booking()
    {
        $array = array();

        if ($this->input->post()) {

            $id = $this->input->post('booking_id');
            $record = $this->Action_model->select_single('tbl_bookings', "booking_id='" . $id . "'");

            $record_array = array(
                'remark' => $this->input->post('remark'),
                'address' => $this->input->post('address'),
                'sdw_title' => $this->input->post('sdw_title'),
                'sdw' => $this->input->post('sdw'),
                'state_id' => $this->input->post('lead_state_id'),
                'city_id' => $this->input->post('lead_city_id'),
                'customer_name' => $this->input->post('lead_title') . ' ' . $this->input->post('lead_first_name') . ' ' . $this->input->post('lead_last_name')
            );

            if ($record) {

                $this->Action_model->update_data($record_array, 'tbl_bookings', "booking_id='" . $id . "'");

                $record_array = array(
                    'lead_title' => $this->input->post('lead_title'),
                    'lead_first_name' => $this->input->post('lead_first_name'),
                    'lead_last_name' => $this->input->post('lead_last_name'),
                    'lead_state_id' => $this->input->post('lead_state_id'),
                    'lead_city_id' => $this->input->post('lead_city_id'),
                    'lead_mobile_no' => $this->input->post('lead_mobile_no'),
                    'lead_email' => $this->input->post('lead_email'),
                    'lead_adhar_no' => $this->input->post('lead_adhar_no'),
                    'lead_pan_no' => $this->input->post('lead_pan_no'),
                );

                $this->Action_model->update_data($record_array, 'tbl_leads', "lead_id='" . $record->lead_id . "'");
                $array = array('status' => 'updated', 'message' => 'Booking Updated Successfully!!');
                $this->session->set_flashdata('success_msg', 'Booking Updated Successfully!!');
            } else {
                $array = array('status' => 'error', 'message' => 'Booking Not Found!!');
                $this->session->set_flashdata('error_msg', 'Booking Not Found!!');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }
    /* booking report end */

    public function get_product_inventory_quatation()
    {
        if ($this->input->post()) {

            $account_id = getAccountId();

            $inventory_id = $this->input->post('inventory_id');
            $where = "inventory_id='" . $inventory_id . "'";

            $this->db->select('*,tbl_users.is_individual as a_is_individual,tbl_users.user_title as a_user_title,tbl_users.first_name as a_first_name,tbl_users.last_name as a_last_name,tbl_users.firm_name as a_firm_name,tbl_users.mobile as a_mobile,tbl_builders.firm_name as b_firm_name');
            $this->db->from('tbl_inventory');
            $this->db->join('tbl_floors', 'tbl_floors.floor_id = tbl_inventory.floor_id', 'left');
            $this->db->join('tbl_product_block_details', 'tbl_product_block_details.block_id = tbl_inventory.block_id', 'left');
            $this->db->join('tbl_product_unit_details', 'tbl_product_unit_details.product_unit_detail_id = tbl_inventory.unit_code', 'left');
            $this->db->join('tbl_accomodations', 'tbl_accomodations.accomodation_id = tbl_product_unit_details.accomodation', 'left');
            $this->db->join('tbl_products', 'tbl_products.product_id = tbl_product_unit_details.product_id', 'left');
            $this->db->join('tbl_builders', 'tbl_builders.builder_id = tbl_products.builder_id', 'left');
            $this->db->join('tbl_locations', 'tbl_locations.location_id = tbl_products.location', 'left');
            $this->db->join('tbl_users', 'tbl_users.user_id = tbl_products.agent_id', 'left');
            //$this->db->join('tbl_product_block_details', 'tbl_product_block_details.block_id = tbl_inventory.block_id','left');
            $this->db->where($where);
            $query = $this->db->get();
            $inventory_data = $query->row();

            if ($inventory_data) {
                $data['inventory_data'] = $inventory_data;
                $this->load->view(AGENT_URL . 'ajax/get_product_inventory_quatation', $data);
            } else {
                echo "Inventory Not Found.";
            }
        }
    }

    public function get_site_visit_list()
    {
        $array = array();

        if ($this->input->post()) {

            $account_id = getAccountId();
            $agent = $this->getAgent();
            $user_id = $agent->user_id;

            if ($account_id) {
                $filter_by = $this->input->post('filter_by');
                $page = $this->input->post('page');

                $search_text = $this->input->post('search_text');
                $search_date_from = $this->input->post('search_date_from');
                $search_date_to = $this->input->post('search_date_to');
                $search_project_id = $this->input->post('search_project_id');
                $search_builder_id = $this->input->post('search_builder_id');
                $search_staff_id = $this->input->post('search_staff_id');
                $search_response = $this->input->post('search_response');
                $search_status = $this->input->post('search_status');
                /*
                $search_location_id = $this->input->post('search_location_id');
                $search_budget_min = $this->input->post('search_budget_min');
                $search_budget_max = $this->input->post('search_budget_max');
                $search_size_min = $this->input->post('search_size_min');
                $search_size_max = $this->input->post('search_size_max');
                $search_size_unit = $this->input->post('search_size_unit');*/

                $limit = 10;
                $total_pages = 0;
                $start = 0;
                $next_page = 0;
                $start = ($page - 1) * $limit;



                $sp_users = array();
                $sp_projects = array();
                $share_project_data = $this->Action_model->detail_result('tbl_project_share', "account_id='" . $account_id . "'");
                if ($share_project_data) {
                    foreach ($share_project_data as $rowSP) {

                        $sp_users[] = $rowSP->share_account_id;
                        $sp_projects[] = $rowSP->project_id;
                    }
                }


                $where_ids = "";

                /*$where = "tbl_leads.account_id='".$account_id."'";
                $where_ids = "";
                $user_ids = $this->get_level_user_ids();
                if (count($user_ids)) {
                   $where_ids .= " AND ((tbl_site_visit.user_id='".implode("' OR tbl_site_visit.user_id='", $user_ids)."')  OR (tbl_site_visit.assign_to='".implode("' OR tbl_site_visit.assign_to='", $user_ids)."'))";
                }
                $where .= $where_ids;*/

                $where = "((tbl_leads.account_id='" . $account_id . "'";
                $user_ids = $this->get_level_user_ids();
                if (count($user_ids)) {
                    $where .= " AND ((tbl_site_visit.user_id='" . implode("' OR tbl_site_visit.user_id='", $user_ids) . "')  OR (tbl_site_visit.assign_to='" . implode("' OR tbl_site_visit.assign_to='", $user_ids) . "'))";
                }
                $where .= ")";

                if (count($sp_users)) {
                    $strr = array();
                    $si = 0;
                    foreach ($sp_users as $kkk) {
                        $strr[] = "(tbl_leads.account_id='" . $kkk . "' AND tbl_site_visit.project_id='" . $sp_projects[$si] . "')";
                        $si++;
                    }

                    if ($strr) {
                        $where .= " OR (" . implode(" OR ", $strr) . ")";
                    }
                }
                $where .= ")";

                $where_ext = "";
                if ($search_text) {
                    $where_ext .= " AND (lead_mobile_no LIKE '%" . $search_text . "%' OR lead_email LIKE '%" . $search_text . "%' OR CONCAT(lead_title, ' ', lead_first_name, ' ', lead_last_name) LIKE '%" . $search_text . "%')";
                }
                if ($search_date_from && !$search_date_to) {
                    $where_ext .= " AND visit_date>='" . $search_date_from . "'";
                }
                if (!$search_date_from && $search_date_to) {
                    $where_ext .= " AND visit_date<='" . $search_date_to . "'";
                }
                if ($search_date_from && $search_date_to) {
                    $where_ext .= " AND (visit_date BETWEEN '" . $search_date_from . "' AND '" . $search_date_to . "')";
                }
                if ($search_project_id) {
                    $where_ext .= " AND tbl_site_visit.project_id='" . $search_project_id . "'";
                }
                if ($search_builder_id) {
                    $where_ext .= " AND tbl_products.builder_id='" . $search_builder_id . "'";
                }
                if ($search_staff_id) {
                    $where_ext .= " AND assign_to='" . $search_staff_id . "'";
                }
                if ($search_response) {
                    $where_ext .= " AND interested='" . $search_response . "'";
                }
                if ($search_status) {
                    $where_ext .= " AND site_visit_status='" . $search_status . "'";
                }
                /*

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
                }*/

                //$where.=" GROUP BY tbl_leads.lead_id";
                $where .= $where_ext;

                $this->db->select("tbl_site_visit.lead_id");
                $this->db->from('tbl_site_visit');
                $this->db->join('tbl_leads', 'tbl_leads.lead_id = tbl_site_visit.lead_id');
                $this->db->join('tbl_products', 'tbl_products.product_id = tbl_site_visit.project_id', 'left');
                $this->db->join('tbl_builders', 'tbl_builders.builder_id = tbl_products.builder_id', 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $record_all = $query->result();

                $total_records = count($record_all);
                if ($record_all) {
                    $total_pages = ceil($total_records / $limit);
                }
                /*if ($record_all) {
                    $total_records = $record_all->total_records;
                    $total_pages = ceil($total_records/$limit);
                }*/


                $where = "((tbl_leads.account_id='" . $account_id . "'";
                $user_ids = $this->get_level_user_ids();
                if (count($user_ids)) {
                    $where .= " AND ((tbl_site_visit.user_id='" . implode("' OR tbl_site_visit.user_id='", $user_ids) . "')  OR (tbl_site_visit.assign_to='" . implode("' OR tbl_site_visit.assign_to='", $user_ids) . "'))";
                }
                $where .= ")";

                if (count($sp_users)) {
                    $strr = array();
                    $si = 0;
                    foreach ($sp_users as $kkk) {
                        $strr[] = "(tbl_leads.account_id='" . $kkk . "' AND tbl_site_visit.project_id='" . $sp_projects[$si] . "')";
                        $si++;
                    }

                    if ($strr) {
                        $where .= " OR (" . implode(" OR ", $strr) . ")";
                    }
                }
                $where .= ")";


                $where .= $where_ids;
                $where .= $where_ext;
                if ($filter_by == 1) {
                    $where .= " ORDER BY FIELD(site_visit_status, 1) DESC,STR_TO_DATE(visit_date,'%d-%m-%Y') DESC,visit_time DESC";
                } else if ($filter_by == 2) {
                    $where .= " ORDER BY FIELD(site_visit_status, 2) DESC,STR_TO_DATE(visit_date,'%d-%m-%Y') DESC,visit_time DESC";
                } else {
                    $where .= " ORDER BY STR_TO_DATE(visit_date,'%d-%m-%Y') DESC,visit_time DESC";
                }
                /*$where.=" GROUP BY tbl_leads.lead_id";
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
                }*/

                $where .= " limit " . $start . "," . $limit;
                //$where = "tbl_leads.lead_id!=''";
                $this->db->select("*,tbl_leads.lead_id as lead_id,CONCAT(lead_first_name, ' ', lead_last_name) AS 'lead_name',tbl_builders.firm_name as b_firm_name,tbl_leads.account_id as ai");
                $this->db->from('tbl_site_visit');
                $this->db->join('tbl_leads', 'tbl_leads.lead_id = tbl_site_visit.lead_id');
                $this->db->join('tbl_products', 'tbl_products.product_id = tbl_site_visit.project_id', 'left');
                $this->db->join('tbl_users', 'tbl_users.user_id = tbl_site_visit.assign_to', 'left');
                $this->db->join('tbl_builders', 'tbl_builders.builder_id = tbl_products.builder_id', 'left');
                $this->db->join('tbl_lead_stages', 'tbl_lead_stages.lead_stage_id = tbl_leads.lead_stage_id', 'left');
                $this->db->join('tbl_lead_sources', 'tbl_lead_sources.lead_source_id = tbl_leads.lead_source_id', 'left');
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
                            'site_visit_id' => $item->site_visit_id,
                            'lead_title' => $item->lead_title,
                            'lead_first_name' => $item->lead_first_name,
                            'lead_last_name' => $item->lead_last_name,
                            'lead_date' => $item->lead_date,
                            'builder' => $item->b_firm_name,
                            'assign_to' => ucwords($item->user_title . ' ' . $item->first_name . ' ' . $item->last_name),
                            'project_name' => $item->project_name,
                            'visit_date' => $item->visit_date,
                            'visit_time' => $item->visit_time,
                            'site_visit_status' => $item->site_visit_status,
                            'next_followup_date' => $next_followup_date,
                            'lead_mobile_no' => $item->lead_mobile_no,
                            'lead_stage_name' => (!$item->lead_stage_name) ? '' : $item->lead_stage_name,
                            'lead_source_name' => (!$item->lead_source_name) ? '' : $item->lead_source_name,
                            'lead_email' => $item->lead_email,
                            'next_followup' => $next_followup,
                            'is_share' => ($item->ai == $account_id) ? '' : 'none'
                        );
                    }
                }

                if ($total_pages != $page) {
                    $next_page = $page + 1;
                }
                $array = array('status' => 'success', 'message' => count($records) . ' Records Found', 'records' => $records, 'total_records' => $total_records, 'total_pages' => $total_pages, 'next_page' => $next_page, 'records' => $records);
            } else {
                $array = array('status' => 'error', 'message' => 'No Leads');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_site_visit()
    {

        $account_id = getAccountId();

        if ($account_id && $this->input->post()) {
            $id = $this->input->post('id');

            $sp_users = array();
            $sp_projects = array();
            $share_project_data = $this->Action_model->detail_result('tbl_project_share', "account_id='" . $account_id . "'");
            if ($share_project_data) {
                foreach ($share_project_data as $rowSP) {

                    $sp_users[] = $rowSP->share_account_id;
                    $sp_projects[] = $rowSP->project_id;
                }
            }

            $where = "(site_visit_id='" . $id . "' AND tbl_site_visit.account_id='" . $account_id . "'";

            if (count($sp_users)) {
                $strr = array();
                $si = 0;
                foreach ($sp_users as $kkk) {
                    $strr[] = "(tbl_leads.account_id='" . $kkk . "' AND tbl_site_visit.project_id='" . $sp_projects[$si] . "')";
                    $si++;
                }

                if ($strr) {
                    $where .= " OR (site_visit_id='" . $id . "' AND (" . implode(" OR ", $strr) . "))";
                }
            }
            $where .= ")";

            $this->db->select("*,tbl_leads.lead_id as lead_id,CONCAT(lead_first_name, ' ', lead_last_name) AS 'lead_name',tbl_builders.firm_name as b_firm_name,tbl_leads.account_id as ai");
            $this->db->from('tbl_site_visit');
            $this->db->join('tbl_leads', 'tbl_leads.lead_id = tbl_site_visit.lead_id');
            $this->db->join('tbl_products', 'tbl_products.product_id = tbl_site_visit.project_id', 'left');
            $this->db->join('tbl_users', 'tbl_users.user_id = tbl_site_visit.assign_to', 'left');
            $this->db->join('tbl_builders', 'tbl_builders.builder_id = tbl_products.builder_id', 'left');
            $this->db->join('tbl_lead_stages', 'tbl_lead_stages.lead_stage_id = tbl_leads.lead_stage_id', 'left');
            $this->db->join('tbl_lead_sources', 'tbl_lead_sources.lead_source_id = tbl_leads.lead_source_id', 'left');
            $this->db->where($where);
            $query = $this->db->get();
            $record = $query->row();

            if ($record) {

                $record->is_share = ($record->ai == $account_id) ? '1' : '0';

                $data['record'] = $record;
                $this->load->view(AGENT_URL . 'get_site_visit', $data);
            } else {
                echo 'error';
            }
        } else {
            echo 'error';
        }
    }

    public function update_site_visit_status()
    {
        $array = array();

        if ($this->input->post()) {

            $id = $this->input->post('bk_id');
            $status = $this->input->post('bk_status');
            $record = $this->Action_model->select_single('tbl_site_visit', "site_visit_id='" . $id . "'");

            $status_label = "";

            if ($record) {

                if ($status == 2) {
                    $status_label = "Success";
                    $this->Action_model->update_data(array('interested' => $this->input->post('bk_interested'), 'visit_date' => $this->input->post('bk_visit_date'), 'visit_time' => $this->input->post('bk_visit_time'), 'attend_by' => $this->input->post('bk_attend_by'), 'site_visit_status' => 2, 'comment' => $this->input->post('comment'), 'updated_at' => time()), 'tbl_site_visit', "site_visit_id='" . $id . "'");

                    $recordLead = $this->Action_model->select_single('tbl_leads', "lead_id='" . $record->lead_id . "'");

                    $recordProject = $this->Action_model->select_single('tbl_products', "product_id='" . $record->project_id . "'");

                    if ($recordLead && $recordProject) {
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

                        $s_account_id = $account_id;
                        $s_team_user_id = $user_id;
                        $s_customer_id = $recordLead->lead_id;
                        $s_mobile = $recordLead->lead_mobile_no;
                        $project_name = ($recordProject) ? $recordProject->project_name : "";

                        $where_agent = "user_id='" . $s_account_id . "'";
                        $agent_detail = $this->Action_model->select_single('tbl_users', $where_agent);

                        if ($agent_detail->no_of_sms) {

                            $s_message = "Hi! Thanks for giving your valuable time to visit our project " . $project_name . ". any further detail call # " . $agent_detail->mobile;

                            $sms_response = $this->Action_model->sendMobileSMS($s_mobile, $s_message, true);
                            if ($sms_response) {
                                $sms_response_array = json_decode($sms_response);
                                if ($sms_response_array && isset($sms_response_array->status) && $sms_response_array->status == "success") {



                                    $sms_before = $agent_detail->no_of_sms;
                                    $net_no_of_sms = $sms_before - 1;
                                    $sms_after = $net_no_of_sms;

                                    $user_data = array(
                                        'no_of_sms' => $net_no_of_sms
                                    );

                                    $this->Action_model->update_data($user_data, 'tbl_users', $where_agent);

                                    $sms_credit_array = array(
                                        'account_id' => $s_account_id,
                                        'team_user_id' => $s_team_user_id,
                                        'customer_id' => $s_customer_id,
                                        'sms_before' => $sms_before,
                                        'sms_after' => $sms_after,
                                        'mobile' => $s_mobile,
                                        'message' => $s_message,
                                        'create_at' => date("d-m-Y H:i:s A")
                                    );

                                    $this->Action_model->insert_data($sms_credit_array, 'tbl_sms_history');
                                }
                            }
                        }
                    }
                } else if ($status == 3) {
                    $status_label = "Postpone";
                    $this->Action_model->update_data(array('site_visit_status' => 3, 'comment' => $this->input->post('comment'), 'updated_at' => time()), 'tbl_site_visit', "site_visit_id='" . $id . "'");
                }

                $record = $this->Action_model->select_single('tbl_site_visit', "site_visit_id='" . $id . "'");

                $array = array('status' => 'success', 'message' => 'Site Visit Status ' . $status_label . ' Updated Successfully!!', 'site_visit_id' => $record->site_visit_id, 'visit_date' => $record->visit_date, 'visit_time' => $record->visit_time, 'site_visit_status' => $record->site_visit_status);
            } else {
                $array = array('status' => 'error', 'message' => 'Record Not Found!!');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function download_site_visit()
    {
        $array = array();

        if ($this->input->get()) {

            $account_id = getAccountId();

            if ($account_id) {
                $filter_by = $this->input->get('filter_by');

                $search_text = $this->input->get('search_text');
                $search_date_from = $this->input->get('search_date_from');
                $search_date_to = $this->input->get('search_date_to');
                $search_project_id = $this->input->get('search_project_id');
                $search_builder_id = $this->input->get('search_builder_id');
                $search_staff_id = $this->input->get('search_staff_id');
                $search_response = $this->input->get('search_response');
                $search_status = $this->input->get('search_status');

                $where_ext = "";
                if ($search_text) {
                    $where_ext .= " AND (lead_mobile_no LIKE '%" . $search_text . "%' OR lead_email LIKE '%" . $search_text . "%' OR CONCAT(lead_title, ' ', lead_first_name, ' ', lead_last_name) LIKE '%" . $search_text . "%')";
                }
                if ($search_date_from && !$search_date_to) {
                    $where_ext .= " AND visit_date>='" . $search_date_from . "'";
                }
                if (!$search_date_from && $search_date_to) {
                    $where_ext .= " AND visit_date<='" . $search_date_to . "'";
                }
                if ($search_date_from && $search_date_to) {
                    $where_ext .= " AND (visit_date BETWEEN '" . $search_date_from . "' AND '" . $search_date_to . "')";
                }
                if ($search_project_id) {
                    $where_ext .= " AND tbl_site_visit.project_id='" . $search_project_id . "'";
                }
                if ($search_builder_id) {
                    $where_ext .= " AND tbl_products.builder_id='" . $search_builder_id . "'";
                }
                if ($search_staff_id) {
                    $where_ext .= " AND assign_to='" . $search_staff_id . "'";
                }
                if ($search_response) {
                    $where_ext .= " AND interested='" . $search_response . "'";
                }
                if ($search_status) {
                    $where_ext .= " AND site_visit_status='" . $search_status . "'";
                }


                $where = "tbl_leads.account_id='" . $account_id . "'";
                $where .= $where_ext;
                if ($filter_by == 1) {
                    $where .= " ORDER BY FIELD(site_visit_status, 1) DESC,tbl_site_visit.created_at DESC";
                } else if ($filter_by == 2) {
                    $where .= " ORDER BY FIELD(site_visit_status, 2) DESC,tbl_site_visit.created_at DESC";
                } else {
                    $where .= " ORDER BY tbl_site_visit.created_at DESC";
                }

                $this->db->select("*,tbl_leads.lead_id as lead_id,CONCAT(lead_first_name, ' ', lead_last_name) AS 'lead_name',tbl_builders.firm_name as b_firm_name");
                $this->db->from('tbl_site_visit');
                $this->db->join('tbl_leads', 'tbl_leads.lead_id = tbl_site_visit.lead_id');
                $this->db->join('tbl_products', 'tbl_products.product_id = tbl_site_visit.project_id', 'left');
                $this->db->join('tbl_users', 'tbl_users.user_id = tbl_site_visit.assign_to', 'left');
                $this->db->join('tbl_builders', 'tbl_builders.builder_id = tbl_products.builder_id', 'left');
                $this->db->join('tbl_lead_stages', 'tbl_lead_stages.lead_stage_id = tbl_leads.lead_stage_id', 'left');
                $this->db->join('tbl_lead_sources', 'tbl_lead_sources.lead_source_id = tbl_leads.lead_source_id', 'left');
                $this->db->where($where);
                $query = $this->db->get();
                $record_data = $query->result();

                //print_r(count($record_data));
                $records = array();
                if ($record_data) {
                    foreach ($record_data as $item) {
                        $records[] = array(
                            'site_visit_id' => $item->site_visit_id,
                            'lead_title' => $item->lead_title,
                            'lead_first_name' => $item->lead_first_name,
                            'lead_last_name' => $item->lead_last_name,
                            'lead_date' => $item->lead_date,
                            'builder' => $item->b_firm_name,
                            'assign_to' => ucwords($item->user_title . ' ' . $item->first_name . ' ' . $item->last_name),
                            'project_name' => $item->project_name,
                            'visit_date' => $item->visit_date,
                            'visit_time' => $item->visit_time,
                            'site_visit_status' => $item->site_visit_status,
                            'lead_mobile_no' => $item->lead_mobile_no,
                            'lead_stage_name' => (!$item->lead_stage_name) ? '' : $item->lead_stage_name,
                            'lead_source_name' => (!$item->lead_source_name) ? '' : $item->lead_source_name,
                            'lead_email' => $item->lead_email
                        );
                    }

                    require_once(APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php');
                    require_once(APPPATH . 'third_party/PHPExcel/Classes/PHPExcel/IOFactory.php');




                    /* Create new PHPExcel object*/
                    $objPHPExcel = new PHPExcel();

                    $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");


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
                    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);


                    $objPHPExcel->getActiveSheet()->setCellValue('A1', 'S No');
                    $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Customer Name');
                    $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Project');
                    $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Builder');
                    $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Assign To');
                    $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Visit Date');
                    $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Visit Time');
                    $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Status');
                    $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Attend By');
                    $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Response');
                    $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Comment');

                    $o = 2;
                    foreach ($record_data as $item) {

                        $status = "";
                        $response = "";
                        if ($item->site_visit_status == 1) {
                            $status = "Pending";
                        } else if ($item->site_visit_status == 2) {
                            $status = "Success";
                        } else if ($item->site_visit_status == 3) {
                            $status = "Postpone";
                        }

                        if ($item->interested == 1) {
                            $response = "Interested";
                        } else if ($item->interested == 2) {
                            $response = "Not Interested";
                        }

                        $objPHPExcel->getActiveSheet()->setCellValue('A' . $o, $o - 1);
                        $objPHPExcel->getActiveSheet()->setCellValue('B' . $o, ucwords($item->lead_title . ' ' . $item->lead_first_name . ' ' . $item->lead_last_name));
                        $objPHPExcel->getActiveSheet()->setCellValue('C' . $o, $item->project_name);
                        $objPHPExcel->getActiveSheet()->setCellValue('D' . $o, $item->b_firm_name);
                        $objPHPExcel->getActiveSheet()->setCellValue('E' . $o, ucwords($item->user_title . ' ' . $item->first_name . ' ' . $item->last_name));
                        $objPHPExcel->getActiveSheet()->setCellValue('F' . $o, $item->visit_date);
                        $objPHPExcel->getActiveSheet()->setCellValue('G' . $o, $item->visit_time);
                        $objPHPExcel->getActiveSheet()->setCellValue('H' . $o, $status);
                        $objPHPExcel->getActiveSheet()->setCellValue('I' . $o, $item->attend_by);
                        $objPHPExcel->getActiveSheet()->setCellValue('J' . $o, $response);
                        $objPHPExcel->getActiveSheet()->setCellValue('K' . $o, $item->comment);
                        $o++;
                    }

                    /*Rename sheet*/
                    $objPHPExcel->getActiveSheet()->setTitle('Site Visit');

                    // Save the spreadsheet
                    $writer->save('products.xlsx');

                    header('Content-Type: application/vnd.ms-excel');
                    header('Content-Disposition: attachment;filename="DownloadSiteVisit-' . date("d-m-Y") . '.xlsx"');
                    header('Cache-Control: max-age=0');
                    $writer->save('php://output');
                } else {
                    echo "No Records";
                }
            } else {
                echo "No Records";
            }
        } else {
            echo "No Records";
        }
    }

    public function get_product_site_visit_list()
    {
        $array = array();

        if ($this->input->post()) {

            $account_id = getAccountId();

            if ($account_id) {
                $product_id = $this->input->post('product_id');

                $where = "(tbl_products.agent_id='" . $account_id . "' OR (tbl_site_visit.account_id='" . $account_id . "' AND share_account_id='" . $account_id . "')) AND tbl_site_visit.project_id='" . $product_id . "' AND site_visit_status='2' ORDER BY STR_TO_DATE(visit_date,'%d-%m-%Y') DESC,visit_time DESC";
                $this->db->select("*,tbl_leads.lead_id as lead_id,CONCAT(lead_title, ' ',lead_first_name, ' ', lead_last_name) AS 'lead_name',tbl_builders.firm_name as b_firm_name");
                $this->db->from('tbl_site_visit');
                $this->db->join('tbl_leads', 'tbl_leads.lead_id = tbl_site_visit.lead_id');
                $this->db->join('tbl_products', 'tbl_products.product_id = tbl_site_visit.project_id', 'left');
                $this->db->join('tbl_users', 'tbl_users.user_id = tbl_site_visit.assign_to', 'left');
                $this->db->join('tbl_builders', 'tbl_builders.builder_id = tbl_products.builder_id', 'left');
                $this->db->join('tbl_lead_stages', 'tbl_lead_stages.lead_stage_id = tbl_leads.lead_stage_id', 'left');
                $this->db->join('tbl_lead_sources', 'tbl_lead_sources.lead_source_id = tbl_leads.lead_source_id', 'left');
                $this->db->join('tbl_project_share', "tbl_project_share.project_id = tbl_products.product_id AND share_account_id='" . $account_id . "'", 'left');
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
                            'site_visit_id' => $item->site_visit_id,
                            'lead_name' => $item->lead_name,
                            'lead_title' => $item->lead_title,
                            'lead_first_name' => $item->lead_first_name,
                            'lead_last_name' => $item->lead_last_name,
                            'lead_date' => $item->lead_date,
                            'builder' => $item->b_firm_name,
                            'assign_to' => ucwords($item->user_title . ' ' . $item->first_name . ' ' . $item->last_name),
                            'project_name' => $item->project_name,
                            'visit_date' => $item->visit_date,
                            'visit_time' => $item->visit_time,
                            'interested' => $item->interested,
                            'comment' => $item->comment,
                            'site_visit_status' => $item->site_visit_status,
                            'next_followup_date' => $next_followup_date,
                            'lead_mobile_no' => $item->lead_mobile_no,
                            'lead_stage_name' => (!$item->lead_stage_name) ? '' : $item->lead_stage_name,
                            'lead_source_name' => (!$item->lead_source_name) ? '' : $item->lead_source_name,
                            'lead_email' => $item->lead_email,
                            'next_followup' => $next_followup
                        );
                    }
                }

                $array = array('status' => 'success', 'message' => count($records) . ' Records Found', 'records' => $records);
            } else {
                $array = array('status' => 'error', 'message' => 'No Leads');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function product_list()
    {

        $postData = $this->input->post();
        $select = 'product_id,project_name,product_status,tbl_products.date_register as date_register,product_type_name,unit_type_name,project_status_name,location,city_name,state_name,location_name,firm_name,agent_id';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (project_name like '%" . $searchValue . "%' ) ";
        }
        $data = $this->Action_model->ajaxDatatableLeft($postData, $searchQuery, 'tbl_products', $where, $select, array('tbl_product_types', 'tbl_product_types.product_type_id=tbl_products.project_type', 'tbl_unit_types', 'tbl_unit_types.unit_type_id=tbl_products.property_type', 'tbl_project_status', 'tbl_project_status.project_status_id=tbl_products.project_status', 'tbl_city', 'tbl_city.city_id=tbl_products.city_id', 'tbl_states', 'tbl_states.state_id=tbl_products.state_id', 'tbl_locations', 'tbl_locations.location_id=tbl_products.location', 'tbl_builders', 'tbl_builders.builder_id=tbl_products.builder_id'));

        echo json_encode($data);
    }

    public function share_project_user_list()
    {

        $postData = $this->input->post();
        $account_id = getAccountId();
        $search_by = $this->input->post('search_by');
        $project_id = $this->input->post('project_id');
        $select = 'project_share_id,user_id,is_individual,date_register,mobile,user_title,first_name,last_name,email,user_status,rera_no,firm_name,city_name,unique_code';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "";
        if ($searchValue != '') {
            $searchQuery = " (first_name like '%" . $searchValue . "%' OR last_name like '%" . $searchValue . "%' OR mobile like '%" . $searchValue . "%' OR email like '%" . $searchValue . "%') ";
        }

        if ($search_by) {
            if ($searchQuery) {
                $searchQuery .= " AND ";
            }
            $searchQuery .= " (first_name like '%" . $search_by . "%' OR mobile like '%" . $search_by . "%' OR email like '%" . $search_by . "%')";
        }
        if ($searchQuery) {
            $searchQuery .= " AND role_id='2' AND account_id='" . $account_id . "' AND project_id='" . $project_id . "'";
        } else {
            $searchQuery .= "role_id='2' AND account_id='" . $account_id . "' AND project_id='" . $project_id . "'";
        }
        $data = $this->Action_model->ajaxDatatableLeft($postData, $searchQuery, 'tbl_project_share', $where, $select, array('tbl_users', 'tbl_users.user_id=tbl_project_share.share_account_id', 'tbl_city', 'tbl_city.city_id=tbl_users.city_id'));

        echo json_encode($data);
    }

    public function share_project()
    {
        $array = array();

        if ($this->input->post()) {
            $account_id = getAccountId();
            $project_id = $this->input->post('project_id');
            $share_account_id = $this->input->post('account_id');

            $record_user = $this->Action_model->select_single('tbl_users', "user_id='" . $account_id . "' AND role_id='2' AND email='" . $share_account_id . "'");
            if ($record_user) {
                $array = array('status' => 'error', 'message' => 'Enter Valid Account Id.');
            } else {


                $record_account = $this->Action_model->select_single('tbl_users', "role_id='2' AND email='" . $share_account_id . "'");

                if ($record_account) {
                    $record_project = $this->Action_model->select_single('tbl_products', "agent_id='" . $account_id . "' AND product_id='" . $project_id . "'");

                    if ($record_project) {

                        $record_project = $this->Action_model->select_single('tbl_project_share', "account_id='" . $account_id . "' AND share_account_id='" . $record_account->user_id . "' AND project_id='" . $project_id . "'");

                        if ($record_project) {
                            $array = array('status' => 'error', 'message' => 'Project Already Shared to ' . $share_account_id);
                        } else {
                            $record_array = array(
                                'account_id' => $account_id,
                                'share_account_id' => $record_account->user_id,
                                'project_id' => $project_id,
                                'created_at' => time()
                            );
                            $this->Action_model->insert_data($record_array, 'tbl_project_share');

                            $array = array('status' => 'success', 'message' => 'Project Shared Successfully.');
                        }
                    } else {
                        $array = array('status' => 'error', 'message' => 'Project Not Found.');
                    }
                } else {
                    $array = array('status' => 'error', 'message' => 'Account Id Not Found.');
                }
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function delete_share_project()
    {
        $array = array();

        if ($this->input->post()) {

            $id = $this->input->post('id');
            $record = $this->Action_model->select_single('tbl_project_share', "project_share_id='" . $id . "'");

            if ($record) {
                $this->Action_model->delete_query('tbl_project_share', "project_share_id='" . $id . "'");
                $array = array('status' => 'added', 'message' => 'Share Project Removed Successfully!!');
            } else {
                $array = array('status' => 'added', 'message' => 'Record Not Found!!');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }


    #  DATA ASSIGN
    public function data_assign()
    {

        // print_r($this->input->post()); die;

        $account_id     = 0;
        $user_id        = 0;
        $where          = "user_hash='" . $this->session->userdata('agent_hash') . "'";
        $user_detail    = $this->Action_model->select_single('tbl_users', $where);


        // echo '<pre>';
        // print_r($user_detail); die;  


        if ($user_detail) {
            $user_id    =   $user_detail->user_id;
            $account_id =   $user_detail->user_id;
            if ($user_detail->role_id != 2) {
                $account_id = $user_detail->parent_id;
            }
        }



        $transfer_lead_ids =  $this->input->post('selected_lead_ids');
        $transfer_lead_ids = explode(',', $transfer_lead_ids);
        $assign_to = $this->input->post('transfer_to');


        foreach ($transfer_lead_ids as   $transfer_lead_id) {
            $raw_data =     $this->db->select('*')->where('data_id', $transfer_lead_id)->get('tbl_data')->row();


            if ($raw_data) {

                $data_array = array(
                    'lead_title'            =>  $raw_data->data_title,
                    'data_id'               =>  $raw_data->data_id,
                    'lead_first_name'       =>  $raw_data->data_first_name,
                    'lead_last_name'        =>  $raw_data->data_last_name,
                    'lead_mobile_no'        =>  $raw_data->data_mobile,
                    'lead_email'            =>  $raw_data->data_email,
                    'lead_date'             =>  date("d-m-Y"),
                    'lead_time'             =>  date("h:i:s a"),
                    'lead_status'           =>  1,
                    'lead_stage_id'         =>  1,
                    'user_id'               =>  $assign_to,
                );

                $where          =   "lead_mobile_no='" . $raw_data->data_mobile . "' AND account_id='" . $account_id . "'";
                $lead_detail    =   $this->Action_model->select_single('tbl_leads', $where);
                if ($lead_detail) {
                    $this->Action_model->update_data($data_array, 'tbl_leads', $where);

                    $this->db->where('data_id', $raw_data->data_id);
                    $this->db->update('tbl_data', array('data_reason' => 'Already in Leads', 'data_status' => 0));
                } else {

                    $data_array2 = array(
                        'account_id'        =>  $account_id,
                        'added_by'          =>  $user_detail->user_id,
                    );

                    $data_array     =   array_merge($data_array, $data_array2);
                    $lead_id        =   $this->Action_model->insert_data($data_array, 'tbl_leads');
                    $this->db->where('data_id', $raw_data->data_id);
                    $this->db->update('tbl_data', array('is_in_lead' => 1));
                }
            }
        }
        $array = array('status' => 'success', 'message' => 'Lead Transfered Successfully!!');
        echo json_encode($array);
    }
    # END DATA ASSIGN




    public function transfer_lead()
    {
        $array = array();

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

        if ($user_detail && $this->input->post()) {
            $transfer_lead_id = $this->input->post('transfer_lead_id');
            $transfer_to = $this->input->post('transfer_to');

            $record = $this->Action_model->select_single('tbl_leads', "lead_id='" . $transfer_lead_id . "' AND account_id='" . $account_id . "'");

            if ($record) {

                $record_array = array(
                    'user_id' => $transfer_to
                );

                $this->Action_model->update_data($record_array, 'tbl_leads', "lead_id='" . $transfer_lead_id . "' AND account_id='" . $account_id . "'");

                $this->Action_model->update_data($record_array, 'tbl_followup', "lead_id='" . $transfer_lead_id . "' AND user_id='" . $record->user_id . "'");
                $this->Action_model->update_data($record_array, 'tbl_requirements', "lead_id='" . $transfer_lead_id . "' AND user_id='" . $record->user_id . "'");
                $this->Action_model->update_data($record_array, 'tbl_site_visit', "lead_id='" . $transfer_lead_id . "' AND user_id='" . $record->user_id . "'");

                $record_array = array(
                    'lead_id' => $transfer_lead_id,
                    'transfer_from' => $record->user_id,
                    'transfer_to' => $transfer_to,
                    'transfer_by' => $user_id,
                    'created_at' => time()
                );

                $this->Action_model->insert_data($record_array, 'tbl_lead_transfer');

                $lead_history_array = array(
                    'title' => 'Transfer Lead',
                    'description' => 'Lead transfer to ' . $this->Action_model->get_name($transfer_to) . ' by ' . $this->Action_model->get_name($user_id),
                    'lead_id' => $transfer_lead_id,
                    'created_at' => time(),
                    "account_id" => $account_id,
                    "user_id" => $user_id
                );
                $this->Action_model->insert_data($lead_history_array, 'tbl_lead_history');

                $array = array('status' => 'success', 'message' => 'Lead Transfered Successfully!!');
            } else {
                $array = array('status' => 'error', 'message' => 'Lead Not Found!!');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }
    /* lead end */

    public function get_verify_mobile_otp()
    {
        $array = array();

        $account_id = 0;
        $user_id = 0;
        $mobile = "";

        $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
        $user_detail = $this->Action_model->select_single('tbl_users', $where);
        if ($user_detail) {
            $mobile = $user_detail->mobile;
            $user_id = $user_detail->user_id;
            $account_id = $user_detail->user_id;
            if ($user_detail->role_id != 2) {
                $account_id = $user_detail->parent_id;
            }
        }

        if ($user_detail && $this->input->post()) {
            $mobile_otp = rand(999, 9999);
            $this->Action_model->update_data(array('mobile_otp' => $mobile_otp), 'tbl_users', "user_hash='" . $this->session->userdata('agent_hash') . "'");
            $array = array('status' => 'success', 'message' => 'OTP sent to ' . $mobile);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function verify_mobile()
    {
        $array = array();

        $account_id = 0;
        $user_id = 0;
        $mobile = "";

        $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
        $user_detail = $this->Action_model->select_single('tbl_users', $where);
        if ($user_detail) {
            $mobile = $user_detail->mobile;
            $user_id = $user_detail->user_id;
            $account_id = $user_detail->user_id;
            if ($user_detail->role_id != 2) {
                $account_id = $user_detail->parent_id;
            }
        }

        if ($user_detail && $this->input->post()) {
            $mobile_otp = $this->input->post('mobile_otp');
            if ($user_detail->mobile_otp == $mobile_otp) {
                $this->Action_model->update_data(array('mobile_otp' => '', 'mobile_verify' => 1), 'tbl_users', "user_hash='" . $this->session->userdata('agent_hash') . "'");
                $this->session->set_flashdata('success_msg', 'Mobile Verified Successfully.');
                $array = array('status' => 'success', 'message' => 'Mobile Verified');
            } else {
                $array = array('status' => 'error', 'message' => 'Incorrect OTP');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function share_project_link()
    {
        $array = array();
        $type = $this->input->post('send_type');
        $user_id = $this->input->post('share_lead_id');
        $message = "";
        $subject = "";
        $share_project_link = $this->input->post('share_project_link');
        $share_project_name = $this->input->post('share_project_name');

        $where = "lead_id='" . $user_id . "'";
        $lead_detail = $this->Action_model->select_single('tbl_leads', $where);


        if ($type == 1) {
            $where = "template_name='share_project_sms'";
            $template_detail = $this->Action_model->select_single('tbl_templates', $where);
            if ($template_detail) {
                $message = $template_detail->template_message;
            }
        } else if ($type == 3) {
            $where = "template_name='share_project_whatsapp'";
            $template_detail = $this->Action_model->select_single('tbl_templates', $where);
            if ($template_detail) {
                $message = $template_detail->template_message;
            }
        } else if ($type == 2) {
            $where = "template_name='share_project_email'";
            $template_detail = $this->Action_model->select_single('tbl_templates', $where);
            if ($template_detail) {
                $subject = $template_detail->template_subject;
                $message = $template_detail->template_message;
                $message = nl2br($message);
            }
        }


        $send_to = ($type == 1 || $type == 3) ? $lead_detail->lead_mobile_no : $lead_detail->lead_email;

        $message = str_replace("[name]", ucwords(($lead_detail->lead_title . " " . $lead_detail->lead_first_name . " " . $lead_detail->lead_last_name)), $message);
        $message = str_replace("[email]", $lead_detail->lead_email, $message);
        $message = str_replace("[mobile]", $lead_detail->lead_mobile_no, $message);
        $message = str_replace("[project_link]", $share_project_link, $message);
        $message = str_replace("[project_name]", $share_project_name, $message);
        //$message = str_replace("[expire_date]", $user_detail->next_due_date, $message);

        //echo $message;exit;

        if ($lead_detail && $this->input->post()) {
            $msg = "";
            if ($type == "1") {
                $msg = "SMS Sent Successfully";

                $account_id = getAccountId();
                $where = "tbl_user_details.user_id='" . $account_id . "'";

                $this->db->select('*');
                $this->db->from('tbl_user_details');
                $this->db->join('tbl_users', 'tbl_users.user_id = tbl_user_details.user_id');
                $this->db->where($where);
                $query = $this->db->get();
                $agent_detail = $query->row();
                if ($agent_detail && $agent_detail->no_of_sms > 0) {


                    $s_account_id = $account_id;
                    $s_team_user_id = "";
                    $s_customer_id = "";
                    $s_mobile = $send_to;
                    $s_message  = $message;

                    $sms_response = $this->Action_model->sendMobileSMS($s_mobile, $s_message, true);
                    if ($sms_response) {
                        $sms_response_array = json_decode($sms_response);
                        if ($sms_response_array && isset($sms_response_array->status) && $sms_response_array->status == "success") {

                            $sms_before = $agent_detail->no_of_sms;
                            $net_no_of_sms = $sms_before - 1;
                            $sms_after = $net_no_of_sms;

                            $user_data = array(
                                'no_of_sms' => $net_no_of_sms
                            );
                            $where = "user_id='" . $account_id . "'";
                            $this->Action_model->update_data($user_data, 'tbl_users', $where);

                            $sms_credit_array = array(
                                'account_id' => $s_account_id,
                                'team_user_id' => $s_team_user_id,
                                'customer_id' => $s_customer_id,
                                'sms_before' => $sms_before,
                                'sms_after' => $sms_after,
                                'mobile' => $s_mobile,
                                'message' => $s_message,
                                'create_at' => date("d-m-Y H:i:s A")
                            );

                            $this->Action_model->insert_data($sms_credit_array, 'tbl_sms_history');


                            $array = array('status' => 'success', 'message' => $msg);
                        } else {
                            $array = array('status' => 'error', 'message' => "SMS API Error, Please Try Again");
                        }
                    } else {
                        $array = array('status' => 'error', 'message' => "SMS API Error, Please Try Again");
                    }
                } else {
                    $array = array('status' => 'error', 'message' => "Please purchase sms and try again.");
                }

                /*$sms_response = $this->Action_model->sendMobileSMS($send_to,$message,true);
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
                }*/
            } else if ($type == "2") {
                $msg = "Email Sent Successfully";
                $result_status = $this->Action_model->sendEmailFromAgent($send_to, $subject, $message);
                if ($result_status == 1) {
                    $array = array('status' => 'success', 'message' => $msg);
                } else if ($result_status == 2) {
                    $array = array('status' => 'error', 'message' => "Please update your email configuration and try again");
                } else {
                    $array = array('status' => 'error', 'message' => "Error in sending email, Please Try Again");
                }
            } else if ($type == "3") {
                $msg = "Whatsapp Message Sent Successfully";
                $result_status = $this->Action_model->sendWhatsappMessageFromAgent($send_to, $message);
                if ($result_status == 1) {
                    $array = array('status' => 'success', 'message' => $msg);
                } else if ($result_status == 2) {
                    $array = array('status' => 'error', 'message' => "Please update your whatsapp configuration and try again");
                } else {
                    $array = array('status' => 'error', 'message' => "Whatsapp API Error, Please Try Again");
                }
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    /* template start */
    public function template_list()
    {

        $account_id = getAccountId();

        $postData = $this->input->post();
        $select = 'template_id,template_name,template_status,template_type,template_message,disable_delete';
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = "template_id!='' AND user_id='" . $account_id . "'";
        if ($searchValue != '') {
            $searchQuery .= " AND (template_name like '%" . $searchValue . "%' ) ";
        }
        $data = $this->Action_model->ajaxDatatable($postData, $searchQuery, 'tbl_templates', $where, $select);

        echo json_encode($data);
    }

    public function get_template()
    {
        $array = array();

        if ($this->input->post()) {
            $id = $this->input->post('id');
            $account_id = getAccountId();
            $record = $this->Action_model->select_single('tbl_templates', "template_id='" . $id . "' AND user_id='" . $account_id . "'");
            if ($record) {
                $array = array('status' => 'success', 'message' => '', 'record' => $record);
            } else {
                $array = array('status' => 'error', 'message' => 'Record Not Found.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function template_process()
    {
        $array = array();

        if ($this->input->post()) {

            $id = $this->input->post('id');
            $account_id = getAccountId();

            $record = $this->Action_model->select_single('tbl_templates', "template_id='" . $id . "' AND user_id='" . $account_id . "'");

            $record_array = array(
                'template_name' => $this->input->post('template_name'),
                'template_status' => $this->input->post('template_status'),
                'template_message' => $this->input->post('template_message'),
                'template_type' => $this->input->post('template_type'),
                'template_subject' => $this->input->post('template_subject')
            );

            if ($record) {
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_templates', "template_name='" . $this->input->post('template_name') . "' AND template_id!='" . $id . "' AND user_id='" . $account_id . "'")) {
                    $array = array('status' => 'error', 'message' => 'This Template is already exist.');
                } else {
                    $this->Action_model->update_data($record_array, 'tbl_templates', "template_id='" . $id . "'");
                    $array = array('status' => 'added', 'message' => 'Template Updated Successfully!!');
                }
            } else {
                $record_array['user_id'] = $account_id;
                $record_array['created_at'] = time();
                $record_array['updated_at'] = time();

                if ($this->Action_model->select_single('tbl_templates', "template_name='" . $this->input->post('template_name') . "' AND user_id='" . $account_id . "'")) {
                    $array = array('status' => 'error', 'message' => 'This Template is already exist.');
                } else {
                    $this->Action_model->insert_data($record_array, 'tbl_templates');
                    $array = array('status' => 'added', 'message' => 'Template Added Successfully!!');
                }
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function delete_template()
    {
        $array = array();

        if ($this->input->post()) {

            $id = $this->input->post('id');
            $account_id = getAccountId();
            $record = $this->Action_model->select_single('tbl_templates', "template_id='" . $id . "' AND user_id='" . $account_id . "'");

            if ($record) {
                $this->Action_model->delete_query('tbl_templates', "template_id='" . $id . "'");
                $array = array('status' => 'added', 'message' => 'Template Deleted Successfully!!');
            } else {
                $array = array('status' => 'added', 'message' => 'Record Not Found!!');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }
    /* template end */





    public function update_email_configration()
    {
        $array = array();

        if ($this->input->post()) {
            $account_id = getAccountId();
            $where = "user_id='" . $account_id . "'";
            $user_detail = $this->Action_model->select_single('tbl_users', $where);

            $record_array = array(
                'mail_username' => $this->input->post('mail_username'),
                'mail_password' => $this->input->post('mail_password')
            );

            if ($user_detail) {
                $this->Action_model->update_data($record_array, 'tbl_user_details', $where);
                $array = array('status' => 'success', 'message' => 'Email Configration Updated Successfully!!');
            } else {
                $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function update_whatsapp_configration()
    {
        $array = array();

        if ($this->input->post()) {
            $account_id = getAccountId();
            $where = "user_id='" . $account_id . "'";
            $user_detail = $this->Action_model->select_single('tbl_users', $where);

            $record_array = array(
                'whatsapp_api_mobile' => $this->input->post('whatsapp_api_mobile'),
                'whatsapp_api_password' => $this->input->post('whatsapp_api_password')
            );

            if ($user_detail) {
                $this->Action_model->update_data($record_array, 'tbl_user_details', $where);
                $array = array('status' => 'success', 'message' => 'Whatsapp Configration Updated Successfully!!');
            } else {
                $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    // custom sms
    public function get_sms_form()
    {
        $array = array();

        if ($this->input->post()) {
            $type = $this->input->post('type');

            $account_id = getAccountId();
            $where = "template_status='1' AND user_id='" . $account_id . "' AND template_type='" . $type . "'";
            $template_data = $this->Action_model->detail_result('tbl_templates', $where);
            $template_list = array();
            if ($template_data) {
                $template_list = $template_data;
            }

            $array = array('status' => 'success', 'message' => 'Success', 'template_list' => $template_list);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
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

        if ($send_type == "lead") {

            $where = "lead_id='" . $user_id . "'";
            $user_detail = $this->Action_model->select_single('tbl_leads', $where, "*,CONCAT(lead_first_name, ' ', lead_last_name) AS lead_name");

            if ($user_detail) {
                $message = str_replace("[customer_name]", $user_detail->lead_name, $message);
                $message = str_replace("[customer_email]", $user_detail->lead_email, $message);
                $message = str_replace("[customer_mobile]", $user_detail->lead_mobile_no, $message);
            }
        } else if ($send_type == "agent") {

            $where = "user_id='" . $user_id . "'";
            $user_detail = $this->Action_model->select_single('tbl_users', $where);

            if ($user_detail) {
                $message = str_replace("[name]", $this->Action_model->get_name($user_detail->user_id), $message);
                $message = str_replace("[email]", $user_detail->email, $message);
                $message = str_replace("[mobile]", $user_detail->mobile, $message);
                $message = str_replace("[expire_date]", $user_detail->next_due_date, $message);
            }
        } else {

            $where = "user_id='" . $user_id . "'";
            $user_detail = $this->Action_model->select_single('tbl_users', $where);

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
            if ($type == "1") {
                $msg = "SMS Sent Successfully";

                $account_id = getAccountId();
                $where = "tbl_user_details.user_id='" . $account_id . "'";

                $this->db->select('*');
                $this->db->from('tbl_user_details');
                $this->db->join('tbl_users', 'tbl_users.user_id = tbl_user_details.user_id');
                $this->db->where($where);
                $query = $this->db->get();
                $agent_detail = $query->row();
                if ($agent_detail && $agent_detail->no_of_sms > 0) {


                    $s_account_id = $account_id;
                    $s_team_user_id = "";
                    $s_customer_id = "";
                    $s_mobile = $send_to;
                    $s_message  = $message;

                    $sms_response = $this->Action_model->sendMobileSMS($s_mobile, $s_message, true);
                    if ($sms_response) {
                        $sms_response_array = json_decode($sms_response);
                        if ($sms_response_array && isset($sms_response_array->status) && $sms_response_array->status == "success") {

                            $sms_before = $agent_detail->no_of_sms;
                            $net_no_of_sms = $sms_before - 1;
                            $sms_after = $net_no_of_sms;

                            $user_data = array(
                                'no_of_sms' => $net_no_of_sms
                            );
                            $where = "user_id='" . $account_id . "'";
                            $this->Action_model->update_data($user_data, 'tbl_users', $where);

                            $sms_credit_array = array(
                                'account_id' => $s_account_id,
                                'team_user_id' => $s_team_user_id,
                                'customer_id' => $s_customer_id,
                                'sms_before' => $sms_before,
                                'sms_after' => $sms_after,
                                'mobile' => $s_mobile,
                                'message' => $s_message,
                                'create_at' => date("d-m-Y H:i:s A")
                            );

                            $this->Action_model->insert_data($sms_credit_array, 'tbl_sms_history');


                            $array = array('status' => 'success', 'message' => $msg);
                        } else {
                            $array = array('status' => 'error', 'message' => "SMS API Error, Please Try Again");
                        }
                    } else {
                        $array = array('status' => 'error', 'message' => "SMS API Error, Please Try Again");
                    }
                } else {
                    $array = array('status' => 'error', 'message' => "Please purchase sms and try again.");
                }
            } else if ($type == "2") {
                $msg = "Email Sent Successfully";
                $result_status = $this->Action_model->sendEmailFromAgent($send_to, $subject, $message);
                if ($result_status == 1) {
                    $array = array('status' => 'success', 'message' => $msg);
                } else if ($result_status == 2) {
                    $array = array('status' => 'error', 'message' => "Please update your email configuration and try again");
                } else {
                    $array = array('status' => 'error', 'message' => "Error in sending email, Please Try Again");
                }
            } else if ($type == "3") {
                $msg = "Whatsapp Message Sent Successfully";
                $result_status = $this->Action_model->sendWhatsappMessageFromAgent($send_to, $message);
                if ($result_status == 1) {
                    $array = array('status' => 'success', 'message' => $msg);
                } else if ($result_status == 2) {
                    $array = array('status' => 'error', 'message' => "Please update your whatsapp configuration and try again");
                } else {
                    $array = array('status' => 'error', 'message' => "Whatsapp API Error, Please Try Again");
                }
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    function get_data()
    {

        $postData = $this->input->post();

        // $select = "data_id,CONCAT(data_first_name,' ',data_last_name) as data_name, data_mobile as mobile  ,data_status as  status , CONCAT(first_name,' ',last_name) as user_name , 'file_name' , data_reason as reason";
        $select = "tbl_data.data_id,CONCAT(data_first_name,' ',data_last_name) as data_name, data_mobile as mobile  ,data_status as  status , 'file_name' , data_reason as reason , tbl_leads.lead_id, tbl_leads.lead_stage_id, , tbl_users.user_id, concat(tbl_users.user_title, ' ',tbl_users.first_name, ' ',tbl_users.last_name) as assigned_user_full_name,tbl_lead_stages.lead_stage_name,followup.comment as followup_comment";
        $where = '';

        $searchValue = $postData['search']['value'];
        $searchQuery = '';


        if ($this->input->post('file_name') != '') {

            $file_name = $this->input->post('file_name');
            $searchQuery .= " file_name= '$file_name'";
        }

        if ($this->input->post('account_id')) {

            $account_id = $this->input->post('account_id');
            $searchQuery .= " AND tbl_data.added_by= '$account_id'";
        }

        if ($this->input->post('reason')) {

            $reason = $this->input->post('reason');
            $searchQuery .= " AND followup.comment= '$reason'";
        }




        if ($this->input->post('status') != '') {

            $searchQuery .= " AND tbl_leads.lead_stage_id=" . $this->input->post('status');
        }


        if ($searchValue != '') {

            if ($this->input->post('file_name') != '') {

                $searchQuery .= " AND (tbl_data.data_first_name LIKE '%" . $searchValue . "%' OR tbl_data.data_mobile LIKE '%" . $searchValue . "%') ";
            } else {

                $searchQuery .= "(tbl_data.data_first_name LIKE '%" . $searchValue . "%' OR tbl_data.data_mobile LIKE '%" . $searchValue . "%') ";
            }
        }

        //     print_r($searchQuery);
        // die;
        $data = $this->Action_model->ajaxDatatableLeft($postData, $searchQuery, 'tbl_data', $where, $select, array('tbl_leads', 'tbl_leads.data_id=tbl_data.data_id', 'tbl_users', 'tbl_users.user_id=tbl_leads.user_id', 'tbl_lead_stages', 'tbl_lead_stages.lead_stage_id=tbl_leads.lead_stage_id', '(SELECT * FROM tbl_followup WHERE followup_id IN (SELECT MAX(followup_id) FROM tbl_followup GROUP BY lead_id))  as followup', 'followup.lead_id = tbl_leads.lead_id'));

        echo json_encode($data);
    }

    public function data_delete()
    {
        // echo $this->input->post('data_ids'); die;
        if ($this->input->post('data_ids')) {

            $data_ids = explode(',', $this->input->post('data_ids'));

            foreach ($data_ids as $data_id) {

                $file_name = $this->input->post('file_name');
                +$res =  $this->db->where('file_name', $file_name)->where('data_id', $data_id)->delete('tbl_data');
            }
        } else {
            $file_name = $this->input->post('file_name');

            $res =  $this->db->where('file_name', $file_name)->delete('tbl_data');
        }


        if ($res) {
            $array = array('status' => 'success', 'message' => 'Data deleted ');
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    # Lead
    function lead($id)
    {
        if (!$id) return null;
        $profile_base_url           =   base_url('public/other/profile/');
        $record  =  db_instance()->select("*,concat('$profile_base_url' , tbl_leads.profile) as full_profile_url")->where("lead_id = $id")->join('tbl_lead_stages', 'tbl_lead_stages.lead_stage_id=tbl_leads.lead_stage_id', 'left')->join('tbl_lead_sources', 'tbl_lead_sources.lead_source_id=tbl_leads.lead_source_id', 'left')->get('tbl_leads')->row();

        $record->full_profile_url = $record->profile ? $record->full_profile_url : base_url('public/front/user.png');

        return $record;
    }
    # Lead

    # Store Inventory
    function store_inventory()
    {
        if ($this->input->post()) :
            if (!$this->input->post()) :
                echo json_encode(['status' => false, 'message' => 'Reqeust method is not POST']);
            endif;

            $res_arr                                    =   [];

            # Init
            $id                                         =   $this->input->post('id');
            $product_id                                 =   $this->input->post('product_id');
            $builder_id                                 =   $this->input->post('builder_id');
            $old_property_layout                        =   $this->input->post('old_property_layout');
            $property_details                           =   $this->input->post('property_details');

            # End Init

            # File Upload
            $upload_response            =   upload_file('property_layout', './uploads/images/property/unit', $old_property_layout, false);

            if (!isset($upload_response) || !$upload_response->status) :
                echo json_encode(['status' => false, 'message' => $upload_response->message]);
                exit;
            endif;

            $property_layout                            =   $upload_response->file_name;
            # End File Upload

            # Db Data
            $data                                   =   [
                'product_id'            => $product_id,
                'builder_id'            => $builder_id,
                'property_details'      => $property_details ? json_encode($property_details) : NULL,
                'property_layout'       => $property_layout,
            ];
            # End Db Data

            if ($id) :
                $result                             =   $this->Action_model->update_data($data, 'tbl_inventory', "inventory_id = $id");
                $res_arr                            =   $result ? ['status' => true, 'message' => 'Successfully record updated'] : ['status' => false, 'message' => 'Some error occured'];
            else :
                $result                             =   $this->Action_model->insert_data($data, 'tbl_inventory');
                $res_arr                            =   $result ? ['status' => true, 'message' => 'Successfully record inserted'] : ['status' => false, 'message' => 'Some error occured'];
            endif;


            echo json_encode($res_arr);
        endif;
    }
    # End Store Inventory

    # Get Inventory Details
    public function get_inventory_details()
    {
        $id                 =   $this->input->get('id');
        $arr                =   [];

        $data               =   $this->db->where("inventory_id = $id")->get('tbl_inventory')->row();

        if ($data->property_details ?? 0) :

            $property_details = json_decode($data->property_details);
            $property_id = $property_details->product_id ?? 0;
            $unit_code = $property_details->unit_code ?? 0;

            if ($property_id) :
                $property  = get_product_details($property_id);
                $property_accomodation  = getPropertyAccomodations($property->project_type_id ?? 0, $property->property_type_id ?? 0, $property_id, $property_details->unit_code);
                $data->unit_code_name  = $property_accomodation->unit_code_with_accomodation_name ?? $property_accomodation->inventory_unit_code ?? '';
            endif;

        endif;

        $detail_view        = $this->load->view('components/details-view/inventory-details', ['data' => $data], true);

        if ($data) :
            $res_arr        =  ['status' => true, 'message' => 'Data fetched', 'detail_view' => $detail_view, 'data' =>  $data];
        else :
            $res_arr        =  ['status' => false, 'message' => 'Data not found'];
        endif;


        echo json_encode($res_arr);
    }
    # End Get Inventory Details

    # Delete Inventory Details
    public function delete_inventory_details()
    {
        if (!$this->input->post()) :
            $res_arr        =  ['status' => false, 'message' => 'Reqeust method is not POST'];
        endif;

        $id     =   $this->input->post('id');
        $arr    =   [];

        $data             =   $this->db->where("inventory_id = $id")->delete('tbl_inventory');

        if ($data) :
            $res_arr        =  ['status' => true, 'message' => 'Data fetched'];
        else :
            $res_arr        =  ['status' => false, 'message' => 'Data not found'];
        endif;


        echo json_encode($res_arr);
    }
    # End Delete Inventory Details
}
