<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . "libraries/config_paytm.php");
require_once(APPPATH . "libraries/encdec_paytm.php");
date_default_timezone_set('Asia/Kolkata');

class Front extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Action_model');

        // Test
        //$ss = $this->Action_model->sendWhatsappMessage("7793042536","Hello");
        //print_r($ss);exit;
    }

    public function test(){
        // return false;

        // print_r(transfer_or_assign_lead((object) [ 'lead_id' => 997, 'from_user_id' => 26, 'to_user_id' => 4 ]));
        // die;

        /******************************************************************************
        * Push Notification
        *******************************************************************************/ 

        $device_id                  =   request()->device_id ?? '';
        $title                      =   "Hello";
        $message                    =   "Test";

        $fcm_notify_data      =   (object) [ 
                                                    'device_id' => $device_id ?? '',
                                                    'title'     => $title ?? '',
                                                    'message'   => $message ?? '',
                                                ];

        print_r(fcm()->send($fcm_notify_data));
        /******************************************************************************
        * End Push Notification
        *******************************************************************************/ 
    }

    public function index()
    {
        //$this->Action_model->send_mail("rakeshkumar.softechure@gmail.com","Test","Hello");
        redirect(ADMIN_URL);
        //$this->load->view('index',$data="");
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

    public function property($slug = '', $aid = '')
    {
        
        if ($slug && $aid) {
            $where_pd = "slug='" . $slug . "'";
            //$product_detail = $this->Action_model->select_single('tbl_products',$where_pd);

            $where_user = "user_id='" . $aid . "'";
            $agent_detail = $this->Action_model->select_single('tbl_users', $where_user);
            if (!$agent_detail) {
                redirect(base_url());
            }

            $data['agent_detail'] = $agent_detail;

            $this->db->select('tbl_products.*,builder_group_name,location_name,pcity.city_name as city_name,bcity.city_name as b_city_name,bstate.state_name as b_state_name,builder_logo,about_builder,tbl_builders.address_1 as b_address_1,tbl_builders.address_2 as b_address_2,tbl_builders.address_3 as b_address_3,authority_name');
            $this->db->from('tbl_products');
            $this->db->join('tbl_builder_groups', 'tbl_builder_groups.builder_group_id = tbl_products.builder_group_id', 'left');
            $this->db->join('tbl_locations', 'tbl_locations.location_id = tbl_products.location', 'left');
            $this->db->join('tbl_city as pcity', 'pcity.city_id = tbl_products.city_id', 'left');
            $this->db->join('tbl_authorities', 'tbl_authorities.authority_id = tbl_products.authority_approval', 'left');
            $this->db->join('tbl_builders', 'tbl_builders.builder_id = tbl_products.builder_id', 'left');
            $this->db->join('tbl_city as bcity', 'bcity.city_id = tbl_builders.builder_city_id', 'left');
            $this->db->join('tbl_states as bstate', 'bstate.state_id = tbl_builders.builder_state_id', 'left');
            $this->db->where($where_pd);
            $query = $this->db->get();
            $product_detail = $query->row();

            if (!$product_detail) {
                redirect(base_url());
            }

            $id = $product_detail->product_id;

            $where_pd = "product_id='" . $id . "' AND product_image_status='1'";
            $product_images = $this->Action_model->detail_result('tbl_product_images', $where_pd, "product_image");

            $product_amenities = array();
            if ($product_detail->amenitie) {
                $where_pd = "amenitie_id IN (" . $product_detail->amenitie . ") AND amenitie_status='1'";
                $product_amenitie_data = $this->Action_model->detail_result('tbl_amenities', $where_pd, "amenitie_name,amenitie_image");
                $product_amenities = $product_amenitie_data;
            }

            $where_pd = "product_id='" . $id . "'";
            $this->db->select('specification_name,description');
            $this->db->from('tbl_product_specifications');
            $this->db->join('tbl_specifications', 'tbl_specifications.specification_id = tbl_product_specifications.specification_id', 'left');
            $this->db->where($where_pd);
            $query = $this->db->get();
            $product_specifications = $query->result();

            $where_pd = "product_id='" . $id . "' AND property_type='" . $product_detail->property_type . "' GROUP BY accomodation_id";
            $this->db->select('accomodation_id,accomodation_name');
            $this->db->from('tbl_product_unit_details');
            $this->db->join('tbl_accomodations', 'tbl_accomodations.accomodation_id = tbl_product_unit_details.accomodation', 'left');
            $this->db->where($where_pd);
            $query = $this->db->get();
            $product_accomodation_data = $query->result();
            $product_accomodations = array();
            if ($product_accomodation_data) {

                foreach ($product_accomodation_data as $accomodationRow) {

                    $where_pd = "pud.product_id='" . $id . "' AND pud.accomodation='" . $accomodationRow->accomodation_id . "' AND pud.property_type='" . $product_detail->property_type . "'";
                    $this->db->select('pud.*,munit.unit_name as m_unit_name,tbl_facings.title as facing_title,mplot_unit.unit_name as plot_size_unit_name,mcon_unit.unit_name as con_unit_name,unit_type_name,pud.project_type as project_type,pud.plot_size,pud.plot_unit,punit.unit_name as plot_unit_name,sa_unit.unit_name as sa_unit_name,pud.basic_cost,p.b_cost_unit');
                    $this->db->from('tbl_product_unit_details as pud');
                    $this->db->join('tbl_products as p', 'p.product_id = pud.product_id', 'left');
                    $this->db->join('tbl_units as munit', 'munit.unit_id = pud.unit', 'left');
                    $this->db->join('tbl_units as mplot_unit', 'mplot_unit.unit_id = pud.plot_unit', 'left');
                    $this->db->join('tbl_units as mcon_unit', 'mcon_unit.unit_id = pud.con_unit', 'left');
                    $this->db->join('tbl_facings', 'tbl_facings.facing_id = pud.facing', 'left');
                    $this->db->join('tbl_unit_types', 'tbl_unit_types.unit_type_id = pud.property_type', 'left');


                    $this->db->join('tbl_units as punit', 'punit.unit_id = pud.plot_unit', 'left');
                    $this->db->join('tbl_units as sa_unit', 'sa_unit.unit_id = pud.unit', 'left');

                    $this->db->where($where_pd);
                    $query = $this->db->get();
                    $item_data = $query->result();
                    $product_unit_details = array();
                    if ($item_data) {

                        foreach ($item_data as $item) {

                            $size = "";
                            $budget = 0;

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

                            //$budget = count($amount_array);
                            if (count($amount_array)) {
                                $b_min = $this->getMin($amount_array);
                                $b_max = $this->getMax($amount_array);

                                if ($b_min == $b_max) {
                                    $budget = $b_min;
                                } else {
                                    $budget = $b_min;
                                }
                            }
                            $item->budget = $budget;
                            $product_unit_details[] = $item;
                        }
                    }

                    $accomodationRow->product_unit_details = $product_unit_details;

                    $product_accomodations[] = $accomodationRow;
                }
            }

            $where = "pud.product_id='" . $product_detail->product_id . "'";
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
            $record_data = $query->result();

            $records = array();
            $budget_array = array();
            if ($record_data) {
                foreach ($record_data as $item) {


                    $size = "";
                    $budget = 0;

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

                    //$budget = count($amount_array);
                    if (count($amount_array)) {
                        $b_min = $this->getMin($amount_array);
                        $b_max = $this->getMax($amount_array);

                        if ($b_min == $b_max) {
                            $budget = $b_min;
                        } else {
                            $budget = $b_min;
                        }

                        $budget_array[] = $budget;
                    }
                }
            }

            $onwards = (count($budget_array)) ? $this->getMin($budget_array) : "";

            $data['product_detail'] = $product_detail;
            $data['product_images'] = $product_images;
            $data['product_amenities'] = $product_amenities;
            $data['product_specifications'] = $product_specifications;
            $data['product_accomodations'] = $product_accomodations;
            $data['onwards'] = $onwards;

            $this->load->view('front/property', $data);
        } else {
            redirect(base_url());
        }
    }

    public function inventory($slug = '', $aid = '')
    {
        if ($slug && $aid) {
            $where_pd = "slug='" . $slug . "'";
            //$product_detail = $this->Action_model->select_single('tbl_products',$where_pd);

            $where_user = "user_id='" . $aid . "'";
            $agent_detail = $this->Action_model->select_single('tbl_users', $where_user);
            if (!$agent_detail) {
                redirect(base_url());
            }

            $data['agent_detail'] = $agent_detail;

            $this->db->select('tbl_products.*,builder_group_name,location_name,pcity.city_name as city_name,bcity.city_name as b_city_name,bstate.state_name as b_state_name,builder_logo,about_builder,tbl_builders.address_1 as b_address_1,tbl_builders.address_2 as b_address_2,tbl_builders.address_3 as b_address_3,authority_name');
            $this->db->from('tbl_products');
            $this->db->join('tbl_builder_groups', 'tbl_builder_groups.builder_group_id = tbl_products.builder_group_id', 'left');
            $this->db->join('tbl_locations', 'tbl_locations.location_id = tbl_products.location', 'left');
            $this->db->join('tbl_city as pcity', 'pcity.city_id = tbl_products.city_id', 'left');
            $this->db->join('tbl_authorities', 'tbl_authorities.authority_id = tbl_products.authority_approval', 'left');
            $this->db->join('tbl_builders', 'tbl_builders.builder_id = tbl_products.builder_id', 'left');
            $this->db->join('tbl_city as bcity', 'bcity.city_id = tbl_builders.builder_city_id', 'left');
            $this->db->join('tbl_states as bstate', 'bstate.state_id = tbl_builders.builder_state_id', 'left');
            $this->db->where($where_pd);
            $query = $this->db->get();
            $product_detail = $query->row();

            if (!$product_detail) {
                redirect(base_url());
            }
            $product_id = $product_detail->product_id;
            $product_data = $product_detail;
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

            $data['product_detail'] = $product_detail;

            $this->load->view('front/inventory', $data);
        } else {
            redirect(base_url());
        }
    }

    public function get_update_inventory_status_data()
    {
        $array = array();
        $items = array();


        if ($this->input->post()) {

            $product_id = $this->input->post('product_id');
            $unit_code = $this->input->post('unit_code');
            $tower_id = $this->input->post('tower_id');
            $floor_id = $this->input->post('floor_id');
            $accomodation_id = $this->input->post('accomodation_id');
            $inventory_status = $this->input->post('inventory_status');

            $where_pd = "product_id='" . $product_id . "'";

            $this->db->select('tbl_products.*,builder_group_name,location_name,pcity.city_name as city_name,bcity.city_name as b_city_name,bstate.state_name as b_state_name,builder_logo,about_builder,tbl_builders.address_1 as b_address_1,tbl_builders.address_2 as b_address_2,tbl_builders.address_3 as b_address_3,authority_name');
            $this->db->from('tbl_products');
            $this->db->join('tbl_builder_groups', 'tbl_builder_groups.builder_group_id = tbl_products.builder_group_id', 'left');
            $this->db->join('tbl_locations', 'tbl_locations.location_id = tbl_products.location', 'left');
            $this->db->join('tbl_city as pcity', 'pcity.city_id = tbl_products.city_id', 'left');
            $this->db->join('tbl_authorities', 'tbl_authorities.authority_id = tbl_products.authority_approval', 'left');
            $this->db->join('tbl_builders', 'tbl_builders.builder_id = tbl_products.builder_id', 'left');
            $this->db->join('tbl_city as bcity', 'bcity.city_id = tbl_builders.builder_city_id', 'left');
            $this->db->join('tbl_states as bstate', 'bstate.state_id = tbl_builders.builder_state_id', 'left');
            $this->db->where($where_pd);
            $query = $this->db->get();
            $product_data = $query->row();

            if ($product_data->project_type == 3) {
                $where = "product_id='" . $product_id . "'";
            } else {
                $where = "product_id='" . $product_id . "' AND property_type='" . $product_data->property_type . "'";
            }

            $unit_code_list = array();
            $this->db->select('*');
            $this->db->from('tbl_product_unit_details');
            $this->db->where($where);
            $query = $this->db->get();
            $block_data = $query->result();
            foreach ($block_data as $item) {
                $unit_code_list[] = $item->product_unit_detail_id;
            }


            $where = "pud.product_id='" . $product_id . "'";
            if ($unit_code) {
                $where .= " AND pud.product_unit_detail_id='" . $unit_code . "'";
            } else {
                if ($unit_code_list) {
                    $where .= " AND (pud.product_unit_detail_id IN (" . implode(",", $unit_code_list) . "))";
                }
            }
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
            $product_unit_data = $query->result();

            if ($product_unit_data) {
                foreach ($product_unit_data as $product_unit_detail_data) {
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
                    if ($inventory_status == 1) {
                        $where .= " AND tbl_inventory.inventory_status='" . $inventory_status . "'";
                    }


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

                        $items[] = array('inventory_id' => $item->inventory_id, 'unit_code' => $item->unit_code, 'unit_ref_no' => $item->unit_no, 'current_rate' => $current_rate, 'floor' => ($item->floor_name) ? $item->floor_name : '', 'size' => $size, 'block' => ($item->block_name) ? $item->block_name : '', 'unit_type' => $unit_type, 'selected' => '', 'inventory_status' => $item->inventory_status, 'inventory_status_name' => ($item->inventory_status_name) ? $item->inventory_status_name : '', 'last_update' => ($item->last_update) ? date("d-m-y h:i:s A") : '', 'unit_no' => $item->unit_no);
                    }
                }
            }

            $array = array('status' => 'success', 'message' => 'Data Found', 'items' => $items);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    // cron jobs
    public function check_plans()
    {

        $where = "user_status='1' AND role_id='2'";
        $user_list = $this->Action_model->detail_result('tbl_users', $where, "next_due_date,email,plan_id,user_id,mobile");
        if ($user_list) {

            foreach ($user_list as $user_detail) {

                if ($user_detail->next_due_date) {
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
                            $trial_expired = false;
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

                    $send_mail = 0;
                    if ($expire_today == 1) {
                        echo "Today Expired -  Email:" . $user_detail->email . " Days:" . $trial_remaining_days . " Expire Date:" . $user_detail->next_due_date;
                        echo "<br>";
                        $send_mail = 1;
                    } else if ($trial_remaining_days == 0) {
                        echo "Expired -  Email:" . $user_detail->email . " Days:" . $trial_remaining_days . " Expire Date:" . $user_detail->next_due_date;
                        echo "<br>";
                        $send_mail = 1;
                    } else {
                        echo "Expire in Days:" . $trial_remaining_days . "  Email:" . $user_detail->email . " Expire Date:" . $user_detail->next_due_date;
                        echo "<br>";

                        if ($trial_remaining_days == 1 || $trial_remaining_days == 3 || $trial_remaining_days == 5 || $trial_remaining_days == 10) {
                            $send_mail = 1;
                        }
                    }

                    echo $send_mail;
                    echo "<br>";

                    if ($send_mail) {
                        $pay_link = base_url(AGENT_URL . 'plans');
                        $expire_date = $user_detail->next_due_date;
                        $name = $this->Action_model->get_name($user_detail->user_id);
                        $mobile = $user_detail->mobile;
                        $date1 = new DateTime(date("d-m-Y") . " 00:00:00");
                        $date2 = new DateTime($expire_date . " 00:00:00");
                        $interval = $date1->diff($date2);
                        $expire_days = $interval->days;

                        $data['name'] = $name;
                        $data['expire_date'] = $expire_date;
                        $data['pay_link'] = $pay_link;

                        $email_from = MAINEMAIL;
                        $email_to = MAINEMAIL;
                        $email_subject = SITE_TITLE . " – your account will Expires in Next " . $expire_days . " Days";
                        $email_msg = $this->load->view('email/invoice_create', $data, true);

                        $this->email->from($email_from, SITE_TITLE);
                        $this->email->to($email_to);
                        $this->email->subject($email_subject);
                        $this->email->message($email_msg);
                        $this->email->set_mailtype("html");
                        $this->email->send();
                    }
                }
            }

            exit;
        }
    }

    public function email_template()
    {


        /*$s_account_id = "20";
                $s_team_user_id = "";
                $s_customer_id = "";
                $s_mobile = "8005756759";
                $s_message = "Hello rk";

                $sms_response = $this->Action_model->sendMobileSMS($s_mobile,$s_message,true);
                if ($sms_response) {
                    $sms_response_array = json_decode($sms_response);
                    if ($sms_response_array && isset($sms_response_array->status) && $sms_response_array->status=="success") {

                        $where_agent = "user_id='".$s_account_id."'";
                        $agent_detail = $this->Action_model->select_single('tbl_users',$where_agent);

                        $sms_before = $agent_detail->no_of_sms;
                        $net_no_of_sms = $sms_before - 1;
                        $sms_after = $net_no_of_sms;

                        $user_data = array(
                            'no_of_sms' => $net_no_of_sms
                        );

                        $this->Action_model->update_data($user_data,'tbl_users',$where_agent);

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

                        $this->Action_model->insert_data($sms_credit_array,'tbl_sms_history');

                    }
                }*/

        /*// genrate invoice
                $pay_link = "";//base_url('invoice-pay/'.$order_id);
                $expire_date = "08-09-2020";//$record->next_due_date;
                $name = "Rakesh";//$this->Action_model->get_name($record->user_id);
                $mobile = "8005756759";//$record->mobile;
                $date1 = new DateTime(date("d-m-Y")." 00:00:00");
                $date2 = new DateTime($expire_date." 00:00:00");
                $interval = $date1->diff($date2);
                $expire_days = $interval->days;

                $data['name'] = $name;
                $data['expire_date'] = $expire_date;
                $data['pay_link'] = $pay_link;

                $email_from = MAINEMAIL;
                $email_to = MAINEMAIL;
                $email_subject = SITE_TITLE." – your account will Expires in Next ".$expire_days." Days";
                $email_msg = $this->load->view('email/invoice_create',$data,true);

                $this->email->from($email_from, SITE_TITLE);
                $this->email->to($email_to);
                $this->email->subject($email_subject);
                $this->email->message($email_msg);
                $this->email->set_mailtype("html");
                $this->email->send();*/

        // receipt
        /*$expire_date = "08-09-2020";//$record->next_due_date;
                $name = "Rakesh";//$this->Action_model->get_name($record->user_id);
                $mobile = "8005756759";//$record->mobile;
                $invoice_no = "123";
                $receipt_date = "03-09-2020";
                $invoice_amount = "Rs.1000";
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
                $email_to = MAINEMAIL;
                $email_subject = "Invoice for Agent Diary Subscription (Invoice No: ".$invoice_no.")";
                $email_msg = $this->load->view('email/receipt',$data,true);

                $this->email->from($email_from, SITE_TITLE);
                $this->email->to($email_to);
                $this->email->subject($email_subject);
                $this->email->message($email_msg);
                $this->email->set_mailtype("html");
                $this->email->send();*/

        /*$this->Action_model->sendMobileSMS($mobile,"Dear ".$name."
Greeting For the Day!
Thanks you for using Agent Diary for your Sales Management solution. We hope agent diary has been helping you in managing your leads and growing yours Sales in your Usage.
We regularly rollout, every month, new and interesting features that can further easy your sales management experience.
Your account will Expires in Next ".$expire_days." Days.
We would like to inform you that you account will expire on ".$expire_date.". Please Find the attachment of Performa invoice and use the below link to upgrade you account.
".$pay_link."
Our billing support team is available to support you, for any assistance. Please feel free to contact us at billing@agentdiary.com 
We wish you more lead more customers and more sales.
Thanks & Regards
https://www.agentdiary.com");*/

        //$this->load->view('email/invoice_create',$data);
    }

    public function agent_login()
    {
        if ($this->session->userdata('agent_hash')) {
            redirect(AGENT_URL);
        }
        
        $this->load->view('agent/login', $data = "");
    }

    public function agent_login_process()
    {
        $array = array();

        if ($this->input->post()) {

            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $account_id = $this->input->post('account_id');

            $recordAccount = $this->Action_model->select_single('tbl_users', "email='" . $account_id . "' AND role_id='2'");

            

            if ($recordAccount) {



                if ($recordAccount->username == $username) {
                    $record = $this->Action_model->select_single_join('tbl_users', "username='" . $username . "' AND password='" . $password . "' AND (tbl_users.role_id='2')", "tbl_users.*, tbl_roles.*, tbl_users.user_id as loged_user_id", array("tbl_roles", "tbl_roles.role_id=tbl_users.role_id"));

                    // print_r( $record);
                    // die;

                    if ($record) {
                        if ($record->email_verify == 0) {

                            /*$email_confirm_code = bin2hex(openssl_random_pseudo_bytes(16)).md5(time());

                            $this->Action_model->update_data(array('email_confirm_code'=>$email_confirm_code),'tbl_users',"user_id='".$record->user_id."'");

                            $from = MAINEMAIL;
                            $this->email->from($from, SITE_TITLE);
                            $this->email->to($record->email);
                            $this->email->subject("CONFIRM YOUR EMAIL - ".SITE_TITLE);
                            $message = "<b>Thanks for registering on ".SITE_TITLE.",</b> <br>";
                            $message .= "Click on below link to confirm your email :".base_url('agent/confirm-mail/'.$email_confirm_code);
                            $this->email->message($message);
                            $this->email->set_mailtype("html");
                            $this->email->send();*/

                            $array = array('status' => 'error', 'message' => 'Please Verify Your Email Address to Continue. We have sent an email with a verification link to verify your email address.');
                        } else {

                            $this->Action_model->update_data(array('last_visit' => time()), 'tbl_users', "user_id='" . $record->user_id . "'");

                            $account_id = $record->user_id;
                            if ($record->role_id != 2) {
                                $account_id = $record->parent_id;
                            }
                            $this->session->set_userdata('user_id', $record->loged_user_id);
                            $this->session->set_userdata('agent_hash', $record->user_hash);
                            $this->session->set_userdata('agent_role_id', $record->role_id);
                            $this->session->set_userdata('agent_name', ($record->is_individual) ? $record->user_title . ' ' . $record->first_name . ' ' . $record->last_name : $record->firm_name);
                            $this->session->set_userdata('agent_account_id', $account_id);
                            $array = array('status' => 'success', 'message' => 'Login Successfully.');
                        }
                    } else {
                        $array = array('status' => 'error', 'message' => 'Enter Valid User Id & Password.');
                    }
                } else {
                    $record = $this->Action_model->select_single_join('tbl_users', "parent_id='" . $recordAccount->user_id . "' AND username='" . $username . "' AND password='" . $password . "' AND (tbl_roles.is_agent_member='1')", "tbl_users.*, tbl_roles.*, tbl_users.user_id as loged_user_id", array("tbl_roles", "tbl_roles.role_id=tbl_users.role_id"));

                    // print_r( $record);
                    // die;
                    if ($record) {

                        $this->Action_model->update_data(array('last_visit' => time()), 'tbl_users', "user_id='" . $record->user_id . "'");

                        $account_id = $record->user_id;
                        if ($record->role_id != 2) {
                            $account_id = $record->parent_id;
                        }

                        $this->session->set_userdata('user_id', $record->loged_user_id);
                        $this->session->set_userdata('agent_hash', $record->user_hash);
                        $this->session->set_userdata('agent_role_id', $record->role_id);
                        $this->session->set_userdata('agent_name', $record->first_name . ' ' . $record->last_name);
                        $this->session->set_userdata('agent_account_id', $account_id);

                        $array = array('status' => 'success', 'message' => 'Login Successfully.');
                    } else {
                        $array = array('status' => 'error', 'message' => 'Enter Valid User Id & Password.');
                    }
                }
            } else {
                $array = array('status' => 'error', 'message' => 'Enter Valid Account ID.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function agent_confirm_mail($id = '')
    {

        if ($id) {

            $record = $this->Action_model->select_single('tbl_users', "email_confirm_code='" . $id . "'");

            if ($record) {
                $this->Action_model->update_data(array('email_confirm_code' => '', 'email_verify' => '1'), 'tbl_users', "email_confirm_code='" . $id . "'");
                $this->session->set_flashdata('success_msg', 'Email Verified Successfully, Login to Continue.');
                redirect(AGENT_URL . 'login');
            } else {
                $this->session->set_flashdata('error_msg', 'Invalid Email Verification Link.');
                redirect(AGENT_URL . 'login');
            }
        } else {
            $this->session->set_flashdata('error_msg', 'Invalid Email Verification Link.');
            redirect(AGENT_URL . 'login');
        }
    }

    public function agent_register()
    {
        if ($this->session->userdata('agent_hash')) {
            redirect(AGENT_URL);
        }

        $where = "country_id='1'";
        $state_list = $this->Action_model->detail_result('tbl_states', $where);
        $data['state_list'] = $state_list;

        $where = "builder_group_status='1'";
        $builder_group_list = $this->Action_model->detail_result('tbl_builder_groups', $where);
        $data['builder_group_list'] = $builder_group_list;

        $this->load->view('agent/register', $data);
    }
    public function agent_check_email()
    {
        $array = array();

        if ($this->input->post()) {

            $agent_email = $this->input->post('email');
            $agent_user_id = $this->input->post('user_id');
            $record = $this->Action_model->select_single_join('tbl_users', "email='" . $agent_email . "' AND (tbl_users.role_id='2' OR tbl_roles.is_agent_member='1')", "", array("tbl_roles", "tbl_roles.role_id=tbl_users.role_id"));

            if ($record) {
                $array = array('status' => 'error', 'message' => 'This email address is already exist.');
            } else {
                $record = $this->Action_model->select_single_join('tbl_users', "username='" . $agent_user_id . "' AND (tbl_users.role_id='2' OR tbl_roles.is_agent_member='1')", "", array("tbl_roles", "tbl_roles.role_id=tbl_users.role_id"));
                if ($record) {
                    $array = array('status' => 'error', 'message' => 'This User Id is already exist.');
                } else {
                    $array = array('status' => 'success', 'message' => 'Continue');
                }
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }
    public function agent_register_process()
    {

        $array = array();

        if ($this->input->post()) {

            $agent_email = $this->input->post('email');
            $username = $this->input->post('user_id');
            $mobile = $this->input->post('mobile');
            $otp = $this->input->post('otp');
            $record = $this->Action_model->select_single_join('tbl_users', "email='" . $agent_email . "' AND (tbl_users.role_id='2' OR tbl_roles.is_agent_member='1')", "", array("tbl_roles", "tbl_roles.role_id=tbl_users.role_id"));

            if ($record) {
                $array = array('status' => 'error', 'message' => 'This email address is already exist.');
            } else {

                $record_otp = $this->Action_model->select_single('tbl_otp', "mobile='" . $mobile . "' AND otp='" . $otp . "' AND otp_type='1'");

                if ($record_otp) {

                    $record = $this->Action_model->select_single_join('tbl_users', "username='" . $username . "' AND (tbl_users.role_id='2' OR tbl_roles.is_agent_member='1')", "", array("tbl_roles", "tbl_roles.role_id=tbl_users.role_id"));
                    if ($record) {
                        $array = array('status' => 'error', 'message' => 'This User Id is already exist.');
                    } else {

                        $plan_id = 0;
                        $no_of_user = 0;
                        if ($this->input->post('plan') == 1) {
                            $plan_id = 1;
                            $no_of_user = 1;
                        } else if ($this->input->post('plan') == 2) {
                            $plan_id = 2;
                            $no_of_user = $this->input->post('no_of_user');
                        }

                        $email_confirm_code = bin2hex(openssl_random_pseudo_bytes(16)) . md5(time());

                        $record_array = array(
                            'first_name' => $this->input->post('group_name'),
                            'email' => $this->input->post('email'),
                            'username' => $this->input->post('user_id'),
                            'first_name' => $this->input->post('first_name'),
                            'last_name' => $this->input->post('last_name'),
                            'country_id' => 1,
                            'city_id' => $this->input->post('city'),
                            'state_id' => $this->input->post('state'),
                            'mobile' => $this->input->post('mobile'),
                            'whatsapp_no' => $this->input->post('whatsapp_no'),
                            'date_register' => date("d-m-Y"),
                            'role_id' => 2,
                            'user_status' => 1,
                            'user_hash' => md5(time()) . time() . rand(1000, 9999),
                            'password' => md5($this->input->post('password')),
                            'email_confirm_code' => $email_confirm_code,
                            'created_at' => time(),
                            'updated_at' => time(),
                            'plan_id' => $plan_id,
                            'no_of_user' => $no_of_user,
                            'accept_terms' => $this->input->post('accept'),
                            'unique_code' => rand(100000, 999999),
                            'is_individual' => '',
                            'email_verify' => 0,
                            'mobile_verify' => 1
                        );

                        if ($plan_id == 1) {
                            $record_array['current_plan_date'] = date("d-m-Y");
                            $record_array['next_due_date'] = date("d-m-Y", strtotime('+7 days'));
                        }

                        $this->Action_model->insert_data($record_array, 'tbl_users');

                        $this->Action_model->delete_query('tbl_otp', "mobile='" . $mobile . "' AND otp='" . $otp . "' AND otp_type='1'");

                        $data['name'] = ucfirst($this->input->post('first_name') . ' ' . $this->input->post('last_name'));
                        $data['email_confirm_code'] = $email_confirm_code;

                        $from = MAINEMAIL;
                        $this->email->from($from, SITE_TITLE);
                        $this->email->to($this->input->post('email'));
                        $this->email->subject(SITE_TITLE . " - Verify your Email Address");
                        $message = $this->load->view('email/email_confirm', $data, true);;
                        $this->email->message($message);
                        $this->email->set_mailtype("html");
                        $this->email->send();

                        $this->Action_model->sendMobileSMS($this->input->post('mobile'), "Dear Agent, Thanks for Register with us, you may reach us @ support@agentdiary.com  or 9694555666");

                        $this->session->set_flashdata('success_msg', '<strong>Registration Successfully,</strong><br>We have sent an email with a verification link to verify your email address.');

                        $array = array('status' => 'success', 'message' => '');
                    }
                } else {
                    $array = array('status' => 'error', 'message' => 'Incorrect OTP');
                }
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function agent_get_mobile_otp()
    {
        $array = array();

        if ($this->input->post()) {

            $mobile = $this->input->post('first_mobile');
            $record = $this->Action_model->select_single_join('tbl_users', "mobile='" . $mobile . "' AND (tbl_users.role_id='2' OR tbl_roles.is_agent_member='1')", "", array("tbl_roles", "tbl_roles.role_id=tbl_users.role_id"));

            if ($record) {
                $array = array('status' => 'error', 'message' => 'This mobile number is already exist.');
            } else {
                $otp = rand(999, 9999);
                $record_otp = $this->Action_model->select_single('tbl_otp', "mobile='" . $mobile . "' AND otp_type='1'");

                $record_array = array(
                    'otp' => $otp
                );

                $this->Action_model->sendMobileSMS($mobile, $otp . " IS YOUR OTP FOR GET STARTED WITH AGENT DIARY.");

                if ($record_otp) {
                    $record_array['update_at'] = time();
                    $this->Action_model->update_data($record_array, 'tbl_otp', "mobile='" . $mobile . "' AND otp_type='1'");
                } else {
                    $record_array['mobile'] = $mobile;
                    $record_array['otp'] = $otp;
                    $record_array['otp_type'] = 1;
                    $record_array['create_at'] = time();
                    $this->Action_model->insert_data($record_array, 'tbl_otp');
                }
                $array = array('status' => 'success', 'message' => 'One Time Password (OTP) has been sent to your mobile <b>' . $mobile . '</b>');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function agent_verify_mobile()
    {
        $array = array();

        if ($this->input->post()) {

            $mobile = $this->input->post('verify_mobile');
            $otp = $this->input->post('first_mobile_otp');
            $record = $this->Action_model->select_single_join('tbl_users', "mobile='" . $mobile . "' AND (tbl_users.role_id='2' OR tbl_roles.is_agent_member='1')", "", array("tbl_roles", "tbl_roles.role_id=tbl_users.role_id"));

            if ($record) {
                $array = array('status' => 'error', 'message' => 'This mobile number is already exist.');
            } else {
                $record_otp = $this->Action_model->select_single('tbl_otp', "mobile='" . $mobile . "' AND otp='" . $otp . "' AND otp_type='1'");

                if ($record_otp) {
                    $array = array('status' => 'success', 'message' => 'Mobile Number verified successfully.');
                } else {
                    $array = array('status' => 'error', 'message' => 'Incorrect OTP');
                }
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function associate_registration()
    {

        $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
        $user_detail = $this->Action_model->select_single('tbl_users', $where);

        if ($user_detail) {


            if ($user_detail->associate_complete == 1) {
                redirect(AGENT_URL);
            }

            $where = "firm_type_status='1'";
            $firm_type_list = $this->Action_model->detail_result('tbl_firm_types', $where);

            $where = "country_id!=''";
            $country_list = $this->Action_model->detail_result('tbl_country', $where);
            $data['country_list'] = $country_list;

            $where = "country_id='" . $user_detail->country_id . "'";
            $state_list = $this->Action_model->detail_result('tbl_states', $where);


            $where = "state_id='" . $user_detail->state_id . "'";
            $city_list = $this->Action_model->detail_result('tbl_city', $where);
            $data['city_list'] = $city_list;

            $data['user_detail'] = $user_detail;
            $data['firm_type_list'] = $firm_type_list;
            $data['state_list'] = $state_list;

            $this->load->view('agent/associate_registration', $data);
        } else {
            redirect(AGENT_URL);
        }
    }

    public function associate_save()
    {

        $array = array();

        if ($this->input->post()) {

            $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
            $user = $this->Action_model->select_single('tbl_users', $where);
            if ($user) {

                $logo = "";
                $cin_image = "";
                $tan_image = "";
                $pan_image = "";
                $gst_image = "";
                $adhar_image = "";
                $rera_image = "";
                $image = "";

                $logo = $user->logo;
                $cin_image = $user->cin_image;
                $tan_image = $user->tan_image;
                $pan_image = $user->pan_image;
                $gst_image = $user->gst_image;
                $adhar_image = $user->adhar_image;
                $rera_image = $user->rera_image;
                $image = $user->image;


                $config['upload_path'] = './uploads/images/user/logo/';
                $config['allowed_types'] = 'jpg|png';
                $config['max_size']             = 5 * 1024;
                $config['remove_spaces'] = TRUE;
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);

                $this->upload->initialize($config);

                if (!empty($_FILES['logo']['name'])) {
                    if (!$this->upload->do_upload('logo')) {
                        $error = array('error' => $this->upload->display_errors());
                        $array = array('status' => 'error', 'message' => $error['error']);
                        echo json_encode($array);
                        exit;
                    } else {
                        if ($user && $user->logo && file_exists('./uploads/images/user/logo/' . $user->logo)) {
                            unlink('./uploads/images/user/logo/' . $user->logo);
                        }
                        $logo = $this->upload->data('file_name');
                    }
                }

                $config['upload_path'] = './uploads/images/user/photo/';
                $config['allowed_types'] = 'jpg|png';
                $config['max_size']             = 5 * 1024;
                $config['remove_spaces'] = TRUE;
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);

                $this->upload->initialize($config);

                if (!empty($_FILES['image']['name'])) {
                    if (!$this->upload->do_upload('image')) {
                        $error = array('error' => $this->upload->display_errors());
                        $array = array('status' => 'error', 'message' => $error['error']);
                        echo json_encode($array);
                        exit;
                    } else {
                        if ($user && $user->image && file_exists('./uploads/images/user/photo/' . $user->image)) {
                            unlink('./uploads/images/user/photo/' . $user->image);
                        }
                        $image = $this->upload->data('file_name');
                    }
                }

                $config['upload_path'] = './uploads/images/user/document/';
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
                        if ($user && $user->cin_image && file_exists('./uploads/images/user/document/' . $user->cin_image)) {
                            unlink('./uploads/images/user/document/' . $user->cin_image);
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
                        if ($user && $user->tan_image && file_exists('./uploads/images/user/document/' . $user->tan_image)) {
                            unlink('./uploads/images/user/document/' . $user->tan_image);
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
                        if ($user && $user->pan_image && file_exists('./uploads/images/user/document/' . $user->pan_image)) {
                            unlink('./uploads/images/user/document/' . $user->pan_image);
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
                        if ($user && $user->gst_image && file_exists('./uploads/images/user/document/' . $user->gst_image)) {
                            unlink('./uploads/images/user/document/' . $user->gst_image);
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
                        if ($user && $user->adhar_image && file_exists('./uploads/images/user/document/' . $user->adhar_image)) {
                            unlink('./uploads/images/user/document/' . $user->adhar_image);
                        }
                        $adhar_image = $this->upload->data('file_name');
                    }
                }

                if (!empty($_FILES['rera_image']['name'])) {
                    if (!$this->upload->do_upload('rera_image')) {
                        $error = array('error' => $this->upload->display_errors());
                        $array = array('status' => 'error', 'message' => $error['error']);
                        echo json_encode($array);
                        exit;
                    } else {
                        if ($user && $user->rera_image && file_exists('./uploads/images/user/logo/' . $user->rera_image)) {
                            unlink('./uploads/images/user/logo/' . $user->rera_image);
                        }
                        $rera_image = $this->upload->data('file_name');
                    }
                }


                $record_array = array(
                    'user_title' => $this->input->post('user_title'),
                    'first_name' => $this->input->post('first_name'),
                    'last_name    ' => $this->input->post('last_name'),
                    'sdw_title' => $this->input->post('sdw_title'),
                    'sdw_first_name' => $this->input->post('sdw_first_name'),
                    'sdw_last_name    ' => $this->input->post('sdw_last_name'),
                    'is_individual' => $this->input->post('is_individual'),
                    'firm_type_id' => $this->input->post('firm_type_id'),
                    'firm_name' => $this->input->post('firm_name'),
                    'address_1' => $this->input->post('address_1'),
                    'address_2' => $this->input->post('address_2'),
                    'address_3' => $this->input->post('address_3'),
                    'country_id' => $this->input->post('country_id'),
                    'state_id' => $this->input->post('state_id'),
                    'city_id' => $this->input->post('city_id'),
                    'mobile' => $this->input->post('mobile'),
                    'contact_no' => $this->input->post('contact_no'),
                    'whatsapp_no' => $this->input->post('whatsapp_no'),
                    'email' => $this->input->post('email'),
                    'rera_registered' => $this->input->post('rera_registered'),
                    'rera_no' => $this->input->post('rera_no'),
                    'owner_title' => $this->input->post('owner_title'),
                    'owner_first_name' => $this->input->post('owner_first_name'),
                    'owner_last_name' => $this->input->post('owner_last_name'),
                    'owner_mobile' => $this->input->post('owner_mobile'),
                    'owner_contact_no' => $this->input->post('owner_contact_no'),
                    'owner_whatsapp_no' => $this->input->post('owner_whatsapp_no'),
                    'rera_dor' => $this->input->post('rera_dor'),
                    'rera_valid_till' => $this->input->post('rera_valid_till'),
                    'pan_no' => $this->input->post('pan_no'),
                    'adhar_no' => $this->input->post('adhar_no'),
                    'gst_no' => $this->input->post('gst_no'),
                    'cin_no' => $this->input->post('cin_no'),
                    'tan_no' => $this->input->post('tan_no'),
                    'logo' => $logo,
                    'cin_image' => $cin_image,
                    'tan_image' => $tan_image,
                    'pan_image' => $pan_image,
                    'gst_image' => $gst_image,
                    'adhar_image' => $adhar_image,
                    'rera_image' => $rera_image,
                    'image' => $image,
                    'associate_complete' => 1
                );

                $record_array['updated_at'] = time();
                $this->Action_model->update_data($record_array, 'tbl_users', "user_id='" . $user->user_id . "'");

                $array = array('status' => 'success', 'message' => 'Updated Successfully!!');
            } else {
                $array = array('status' => 'error', 'message' => 'Not Found.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function agent_forgot_password()
    {
        $this->load->view('agent/forgot_password', $data = "");
    }
    public function agent_forgot_password_process()
    {
        $array = array();

        if ($this->input->post()) {

            $username = $this->input->post('username');

            $record = $this->Action_model->select_single_join('tbl_users', "email='" . $username . "' AND (tbl_users.role_id='2' OR tbl_roles.is_agent_member='1')", "*,tbl_users.user_id as uid", array("tbl_roles", "tbl_roles.role_id=tbl_users.role_id"));

            if ($record) {

                $reset_code = bin2hex(openssl_random_pseudo_bytes(16)) . md5(time());
                $this->Action_model->update_data(array('reset_code' => $reset_code), 'tbl_users', "user_id='" . $record->uid . "'");

                $from = MAINEMAIL;
                $this->email->from($from, SITE_TITLE);
                $this->email->to($username);
                $this->email->subject("Reset Your Password");
                $message = "Hi " . $record->first_name . '' . $record->last_name . "<br><br>";
                $message .= "You are receiving this message because you have requested resetting your password on the " . SITE_TITLE . " Site. Please, follow this link to create a new password:<br>";
                $message .= "<a href='" . base_url('agent/reset-password/' . $reset_code) . "'>Reset Password</a><br><br>";
                $message .= "If you have not requested resetting your password, you can just delete this email.<br><br>";
                $message .= "Thank You<br>";
                $message .= SITE_TITLE . " Team";
                $this->email->message($message);
                $this->email->set_mailtype("html");
                $this->email->send();

                $this->session->set_flashdata('success_msg', 'We have sent you a reset password link to <b>' . $record->email . '</b>');
                $array = array('status' => 'success', 'message' => '');
            } else {
                $array = array('status' => 'error', 'message' => 'Enter Valid Valid Email Id.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }
    public function agent_reset_password($id = '')
    {
        if ($id) {

            $record = $this->Action_model->select_single_join('tbl_users', "reset_code='" . $id . "' AND (tbl_users.role_id='2' OR tbl_roles.is_agent_member='1')", "", array("tbl_roles", "tbl_roles.role_id=tbl_users.role_id"));

            if ($record) {
                $data['id'] = $id;
                $this->load->view('agent/reset_password', $data);
            } else {
                $this->session->set_flashdata('error_msg', 'Invalid Reset Password Link!!');
                redirect(AGENT_URL . 'login');
            }
        } else {
            redirect(AGENT_URL . 'login');
        }
    }
    public function agent_reset_password_process()
    {
        $array = array();

        if ($this->input->post()) {

            $reset_code = $this->input->post('reset_code');
            $password = md5($this->input->post('password'));

            $record = $this->Action_model->select_single_join('tbl_users', "reset_code='" . $reset_code . "' AND (tbl_users.role_id='2' OR tbl_roles.is_agent_member='1')", "", array("tbl_roles", "tbl_roles.role_id=tbl_users.role_id"));

            if ($record) {
                $this->Action_model->update_data(array('reset_code' => '', 'password' => $password), 'tbl_users', "reset_code='" . $reset_code . "'");

                $this->session->set_flashdata('success_msg', 'Your password updated successfully, login to continue.');
                $array = array('status' => 'success', 'message' => '');
            } else {
                $array = array('status' => 'error', 'message' => 'Enter Valid Valid Email Id.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }
    public function agent_forgot_userid()
    {
        $this->load->view('agent/forgot_userid', $data = "");
    }
    public function agent_forgot_userid_process()
    {
        $array = array();

        if ($this->input->post()) {

            $username = $this->input->post('username');

            $record = $this->Action_model->select_single_join('tbl_users', "email='" . $username . "' AND (tbl_users.role_id='2' OR tbl_roles.is_agent_member='1')", "", array("tbl_roles", "tbl_roles.role_id=tbl_users.role_id"));

            if ($record) {

                $from = MAINEMAIL;
                $this->email->from($from, SITE_TITLE);
                $this->email->to($username);
                $this->email->subject("Reset User ID");
                $message = "<b>Reset your User ID</b> <br>";
                $message .= "Your User ID is: " . $record->username;
                $this->email->message($message);
                $this->email->set_mailtype("html");
                $this->email->send();

                $this->session->set_flashdata('success_msg', 'We have sent an email ' . $username . ' to together with your User ID.');
                $array = array('status' => 'success', 'message' => '');
            } else {
                $array = array('status' => 'error', 'message' => 'Enter Valid Valid Email Id.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function admin_login()
    {
        if ($this->session->userdata('user_hash')) {
            redirect(ADMIN_URL);
        }
        $this->load->view('admin/login', $data = "");
    }

    public function admin_login_process()
    {
        $array = array();

        if ($this->input->post()) {

            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));

            $record = $this->Action_model->select_single_join('tbl_users', "(username='" . $username . "' OR email='" . $username . "') AND password='" . $password . "' AND (tbl_users.role_id='1' OR tbl_roles.is_admin_member='1')", "", array("tbl_roles", "tbl_roles.role_id=tbl_users.role_id"));

            if ($record) {

                $this->Action_model->update_data(array('last_visit' => time()), 'tbl_users', "user_id='" . $record->user_id . "'");

                $this->session->set_userdata('admin_user_hash', $record->user_hash);
                $this->session->set_userdata('admin_role_id', $record->role_id);
                $this->session->set_userdata('admin_name', $record->first_name . ' ' . $record->last_name);
                $array = array('status' => 'success', 'message' => 'Login Successfully.');
            } else {
                $array = array('status' => 'error', 'message' => 'Enter Valid Username & Password.');
            }
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_city()
    {
        $array = array();
        $city_list = array();

        if ($this->input->post()) {
            $state_id = $this->input->post('state_id');
            $where = "state_id='" . $state_id . "'";
            $city_data = $this->Action_model->detail_result('tbl_city', $where);
            if ($city_data) {
                $city_list = $city_data;
            }
            $array = array('status' => 'success', 'message' => 'Data Found', 'city_list' => $city_list);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
    }

    public function get_state()
    {
        $array = array();
        $state_list = array();

        if ($this->input->post()) {
            $country_id = $this->input->post('country_id');
            $where = "country_id='" . $country_id . "'";
            $state_data = $this->Action_model->detail_result('tbl_states', $where);
            if ($state_data) {
                $state_list = $state_data;
            }
            $array = array('status' => 'success', 'message' => 'Data Found', 'state_list' => $state_list);
        } else {
            $array = array('status' => 'error', 'message' => 'Some error occurred, please try again.');
        }

        echo json_encode($array);
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

    public function plans_deleted()
    {

        $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
        $user_detail = $this->Action_model->select_single('tbl_users', $where);

        if ($user_detail) {
            $data['user_detail'] = $user_detail;
            $where = "plan_id='" . $user_detail->plan_id . "'";
            $plan_detail = $this->Action_model->select_single('tbl_plan', $where);

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
                    $trial_expired = false;
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
            $data['user_detail'] = $user_detail;

            $where = "plan_id!=''";
            $plans = $this->Action_model->detail_result('tbl_plan', $where);
            $data['plans'] = $plans;

            $where = "user_id='" . $user_detail->user_id . "' AND payment_status='1' LIMIT 1";
            $first_payment = $this->Action_model->detail_result('tbl_payment', $where);
            $data['first_payment'] = $first_payment;

            $this->load->view('agent/plans', $data);
        } else {
            redirect(AGENT_URL);
        }
    }

    public function pay()
    {
        $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
        $this->db->select('tbl_users.*,tbl_states.state_name,tbl_city.city_name');
        $this->db->from('tbl_users');
        $this->db->join('tbl_states', 'tbl_states.state_id = tbl_users.state_id', 'left');
        $this->db->join('tbl_city', 'tbl_city.city_id = tbl_users.city_id', 'left');
        $this->db->where($where);
        $query = $this->db->get();
        $user_detail = $query->row();

        if ($user_detail) {
            $data['user_detail'] = $user_detail;

            $where = "plan_id='2'";
            $plan_detail = $this->Action_model->select_single('tbl_plan', $where);
            $data['plan_detail'] = $plan_detail;

            $this->load->view('agent/pay', $data);
        } else {
            redirect(base_url());
        }
    }

    public function pay_request()
    {


        $no_of_user = $this->input->post('no_of_user');

        $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
        $this->db->select('tbl_users.*,tbl_states.state_name,tbl_city.city_name');
        $this->db->from('tbl_users');
        $this->db->join('tbl_states', 'tbl_states.state_id = tbl_users.state_id', 'left');
        $this->db->join('tbl_city', 'tbl_city.city_id = tbl_users.city_id', 'left');
        $this->db->where($where);
        $query = $this->db->get();
        $user_detail = $query->row();

        if ($user_detail) {
            $no_of_user = $user_detail->no_of_user;

            $mobile = $user_detail->mobile;
            $email = $user_detail->email;
            $address = $user_detail->address_1;
            $address .= ($user_detail->address_2) ? "\n" . $user_detail->address_2 : "";
            $address .= ($user_detail->address_3) ? "\n" . $user_detail->address_3 : "";

            $where = "plan_id='2'";
            $plan_detail = $this->Action_model->select_single('tbl_plan', $where);

            $per_user_amount = $plan_detail->per_user_amount;
            $monthly_cost = 0;

            if ($user_detail->monthly_cost || $user_detail->per_user_amount) {
                $per_user_amount = $user_detail->per_user_amount;
                $monthly_cost = ($user_detail->monthly_cost) ? $user_detail->monthly_cost : 0;
            }

            $amt = $per_user_amount * $no_of_user;

            $net_amount = $amt + $monthly_cost;

            $order_id = md5(time()) . rand(999, 9999) . md5(rand(999, 9999));

            $payment_data = array(
                'user_id' => $user_detail->user_id,
                'plan_id' => $plan_detail->plan_id,
                'no_of_user' => $no_of_user,
                'total_amount' => $net_amount,
                'amount_per_user' => $per_user_amount,
                'monthly_cost' => $monthly_cost,
                'payment_status' => 0,
                'order_id' => $order_id,
                'payment_getway' => 'Paytm',
                'paid_type' => '1',
                'create_at' => time(),
                'entry_type' => '1',
                'invoice_type' => '0',
                'name' => $this->Action_model->get_name($user_detail->user_id),
                'state' => $user_detail->state_id,
                'city' => $user_detail->city_id, 'mobile' => $mobile,
                'email' => $email,
                'address' => $address
            );
            $payment_data['invoice_date'] = date("d-m-Y");

            $today = ($user_detail->next_due_date) ? $user_detail->next_due_date : date("d-m-Y");
            $next_month = $this->getDates($today, 1);

            $payment_data['current_plan_date'] = $today;
            $payment_data['next_due_date'] = $next_month;

            $payment_id = $this->Action_model->insert_data($payment_data, 'tbl_payment');

            $invID = str_pad($payment_id, 4, '0', STR_PAD_LEFT);
            $inv_update_array['invoice_id'] = $invID;
            $this->Action_model->update_data($inv_update_array, 'tbl_payment', "payment_id='" . $payment_id . "'");

            $checkSum = "";
            $paramList = array();

            $ORDER_ID = "O" . $payment_id . "T" . time();;
            $CUST_ID = rand();
            $INDUSTRY_TYPE_ID = 'Retail';
            $CHANNEL_ID = 'WEB';
            $TXN_AMOUNT = $net_amount;

            // Create an array having all required parameters for creating checksum.
            $paramList["MID"] = PAYTM_MERCHANT_MID;
            $paramList["ORDER_ID"] = $ORDER_ID;
            $paramList["CUST_ID"] = $CUST_ID;
            $paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
            $paramList["CHANNEL_ID"] = $CHANNEL_ID;
            $paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
            $paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
            $paramList["CALLBACK_URL"] =  base_url('payment_response?order_id=' . $order_id);


            /*$paramList["MSISDN"] = '77777777'; //Mobile number of customer
            $paramList["EMAIL"] = 'pawan.softechure@gmail.com'; //Email ID of customer*/
            $paramList["VERIFIED_BY"] = "EMAIL"; //
            $paramList["IS_USER_VERIFIED"] = "YES"; //
            //$paramList["RKS"] = "rkk"; //

            //foreach($data as $name => $value) {
            //$paramList["cf_".$name] = $value;
            //}

            $checkSum = getChecksumFromArray($paramList, PAYTM_MERCHANT_KEY);

            echo '<center><h1>Please do not refresh this page...</h1></center>';
            echo '<form method="post" action="' . PAYTM_TXN_URL . '" name="f1">';
            foreach ($paramList as $name => $value) {
                echo '<input type="hidden" name="' . $name . '" value="' . $value . '">';
            }

            echo '<input type="hidden" name="CHECKSUMHASH" value="' . $checkSum . '">';
            echo '</form>';

            echo '<script type="text/javascript">document.f1.submit();</script>';
        } else {
            redirect(AGENT_URL);
        }
    }

    public function payment_response()
    {

        $this->load->library('pdf');

        $order_id = $this->input->get('order_id');

        $where = "order_id='" . $order_id . "'";
        $pay_detail = $this->Action_model->select_single('tbl_payment', $where);

        if ($pay_detail) {

            $paytmChecksum = "";
            $paramList = array();
            $isValidChecksum = "FALSE";
            $paramList = $_POST;
            $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
            $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum);

            if ($isValidChecksum == "TRUE") {

                $where = "user_id='" . $pay_detail->user_id . "'";
                $user_detail = $this->Action_model->select_single('tbl_users', $where);

                $this->session->set_userdata('agent_hash', $user_detail->user_hash);
                $this->session->set_userdata('agent_role_id', $user_detail->role_id);
                $this->session->set_userdata('agent_name', ($user_detail->is_individual) ? $user_detail->user_title . ' ' . $user_detail->first_name . ' ' . $user_detail->last_name : $user_detail->firm_name);
                $account_id = $user_detail->user_id;
                if ($user_detail->role_id != 2) {
                    $account_id = $user_detail->parent_id;
                }
                $this->session->set_userdata('agent_account_id', $account_id);

                if ($_POST["STATUS"] == "TXN_SUCCESS") {
                    $payment_status = '1';
                    $txn_status = 'success';
                    $txn_status_for_redirect = '1';
                    $amount = $_POST['TXNAMOUNT'];

                    $pay_array = array('payment_status' => '1', 'txn_id' => $_POST['TXNID'], 'payment_mode' => $_POST['PAYMENTMODE'], 'txn_date' => $_POST['TXNDATE'], 'txn_status' => ucfirst($_POST["STATUS"]));

                    $today = $pay_detail->current_plan_date;
                    $next_month = $pay_detail->next_due_date;

                    $pay_array['current_plan_date'] = $today;
                    $pay_array['next_due_date'] = $next_month;

                    $where = "user_id='" . $user_detail->user_id . "' AND payment_status='1' ORDER BY payment_id ASC LIMIT 1";
                    //$bill_on_detail = $this->Action_model->select_single('tbl_payment',$where,'invoice_date');
                    //if (!$bill_on_detail) {
                    $pay_array['receipt_date'] = date("d-m-Y");
                    $update_array['per_user_amount'] = $pay_detail->amount_per_user;
                    $update_array['monthly_cost'] = $pay_detail->monthly_cost;
                    $update_array['no_of_user'] = $pay_detail->no_of_user;
                    //}

                    $this->Action_model->update_data($pay_array, 'tbl_payment', "order_id='" . $order_id . "' AND payment_status='0'");

                    $update_array['current_plan_date'] = $today;
                    $update_array['next_due_date'] = $next_month;

                    if ($user_detail->plan_id == 1) {
                        $update_array['plan_id'] = 2;
                    }

                    $this->Action_model->update_data($update_array, 'tbl_users', array('user_id' => $user_detail->user_id));

                    $expire_date = $next_month;
                    $name = $this->Action_model->get_name($user_detail->user_id);
                    $mobile = $user_detail->mobile;
                    $invoice_no = $pay_detail->payment_id;
                    $receipt_date = date("d-m-Y");
                    $invoice_amount = "Rs." . str_replace(".00", "", $pay_detail->total_amount);
                    $date1 = new DateTime(date("d-m-Y") . " 00:00:00");
                    $date2 = new DateTime($expire_date . " 00:00:00");
                    $interval = $date1->diff($date2);
                    $expire_days = $interval->days;

                    $data['name'] = $name;
                    $data['expire_date'] = $expire_date;
                    $data['invoice_no'] = $invoice_no;
                    $data['receipt_date'] = $receipt_date;
                    $data['invoice_amount'] = $invoice_amount;

                    $email_from = MAINEMAIL;
                    $email_to = $user_detail->email;
                    $email_subject = "Invoice for Agent Diary Subscription (Invoice No: " . $invoice_no . ")";
                    $email_msg = $this->load->view('email/receipt', $data, true);

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
                    $this->db->where("((entry_type='1' AND payment_status='1') OR (entry_type='2')) AND payment_id='" . $pay_detail->payment_id . "'");
                    $query = $this->db->get();
                    $invoice_detail = $query->row();
                    $data['invoice_detail'] = $invoice_detail;

                    $where = "setting_id='1'";
                    $setting = $this->Action_model->select_single('tbl_setting', $where);
                    $data['setting'] = $setting;

                    $data['pdf_send_mail'] = 1;

                    $this->load->view('template/pdf/receipt', $data);

                    $this->Action_model->sendMobileSMS($mobile, "Dear Agent, Thanks for Received " . $invoice_amount . " Against Invoice No# " . $invoice_no . "  , For Agent Diary Subscription");
                } else {
                    $payment_status = '0';
                    $txn_status = 'failed';
                    $txn_status_for_redirect = '0';
                    $amount = '0.00';

                    $pay_array = array('payment_status' => '2', 'txn_id' => $_POST['TXNID'], 'payment_mode' => $_POST['PAYMENTMODE'], 'txn_date' => $_POST['TXNDATE'], 'txn_status' => ucfirst($_POST["STATUS"]));

                    $this->Action_model->update_data($pay_array, 'tbl_payment', "order_id='" . $order_id . "' AND payment_status='0'");
                }

                redirect(base_url("order-response/" . $order_id));
            } else {
                $this->Action_model->update_data(array('payment_status' => '2'), 'tbl_payment', "order_id='" . $order_id . "' AND payment_status='0'");

                echo "<b>Checksum mismatched.</b>";
            }
        } else {
            redirect(base_url(AGENT_URL));
        }
    }

    function getDates($startDate, $monthsToAdvance)
    {
        $dt = new DateTime($startDate);
        $day = $dt->format('d');
        $dt->setDate($dt->format('Y'), $dt->format('n'), 1);
        $dt->add(new DateInterval('P' . $monthsToAdvance . 'M'));
        $daysInMonth = $dt->format('t');
        if ($day > $daysInMonth) $day = $daysInMonth;
        $dt->setDate($dt->format('Y'), $dt->format('n'), $day);
        return $dt->format('d-m-Y');
    }

    public function order_response($order_id = '')
    {

        $where = "order_id='" . $order_id . "'";
        $pay_detail = $this->Action_model->select_single('tbl_payment', $where);

        if ($pay_detail) {
            $data['pay_detail'] = $pay_detail;
            $this->load->view('agent/order_response', $data);
        } else {

            redirect(base_url());
        }

        /*$where = "user_hash='".$this->session->userdata('agent_hash')."'";
        $user_detail = $this->Action_model->select_single('tbl_users',$where);

        if ($user_detail) {
            $data['pay_detail'] = $pay_detail;
            
            $this->load->view('agent/order_response',$data);
        }
        else {
            redirect(AGENT_URL);
        }*/
    }

    public function invoice_pay($order_id = '')
    {
        $where = "order_id='" . $order_id . "' AND entry_type='2'";
        $pay_detail = $this->Action_model->select_single('tbl_payment', $where);
        $data['pay_detail'] = $pay_detail;
        if ($pay_detail) {

            if ($pay_detail->payment_status == '1') {

                $data['status'] = "invalid";
                $data['msg'] = "Payment Already Paid";
                $this->load->view('agent/invoice_pay', $data);
            } else if ($pay_detail->payment_status == '3') {

                $data['status'] = "invalid";
                $data['msg'] = "Invoice Cancelled";
                $this->load->view('agent/invoice_pay', $data);
            } else {

                $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
                $user_detail = $this->Action_model->select_single('tbl_users', $where);

                if ($user_detail) {
                    $data['pay_detail'] = $pay_detail;
                    $data['user_detail'] = $user_detail;

                    $data['status'] = "unpaid";
                    $data['msg'] = "";
                    $this->load->view('agent/invoice_pay', $data);
                } else {

                    $data['status'] = "login";
                    $data['msg'] = "Please login to Pay";
                    $this->load->view('agent/invoice_pay', $data);
                }
            }
        } else {
            $data['status'] = "invalid";
            $data['msg'] = "Invalid Payment Link";
            $this->load->view('agent/invoice_pay', $data);
        }
    }

    public function invoice_pay_request($order_id = '')
    {
        $where = "order_id='" . $order_id . "' AND entry_type='2'";
        $pay_detail = $this->Action_model->select_single('tbl_payment', $where);
        $data['pay_detail'] = $pay_detail;
        if ($pay_detail) {

            if ($pay_detail->payment_status == '1') {

                redirect(base_url(AGENT_URL));
            } else if ($pay_detail->payment_status == '3') {

                redirect(base_url(AGENT_URL));
            } else {

                $where = "user_hash='" . $this->session->userdata('agent_hash') . "'";
                $user_detail = $this->Action_model->select_single('tbl_users', $where);

                if ($user_detail) {
                    $data['pay_detail'] = $pay_detail;
                    $data['user_detail'] = $user_detail;

                    $checkSum = "";
                    $paramList = array();

                    $ORDER_ID = "O" . $pay_detail->payment_id . "T" . time();
                    $CUST_ID = rand();
                    $INDUSTRY_TYPE_ID = 'Retail';
                    $CHANNEL_ID = 'WEB';
                    $TXN_AMOUNT = $pay_detail->total_amount;

                    // Create an array having all required parameters for creating checksum.
                    $paramList["MID"] = PAYTM_MERCHANT_MID;
                    $paramList["ORDER_ID"] = $ORDER_ID;
                    $paramList["CUST_ID"] = $CUST_ID;
                    $paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
                    $paramList["CHANNEL_ID"] = $CHANNEL_ID;
                    $paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
                    $paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
                    $paramList["CALLBACK_URL"] =  base_url('invoice_payment_response?order_id=' . $pay_detail->order_id);




                    /*$paramList["MSISDN"] = '77777777'; //Mobile number of customer
                    $paramList["EMAIL"] = 'pawan.softechure@gmail.com'; //Email ID of customer*/
                    $paramList["VERIFIED_BY"] = "EMAIL"; //
                    $paramList["IS_USER_VERIFIED"] = "YES"; //
                    //$paramList["RKS"] = "rkk"; //

                    //foreach($data as $name => $value) {
                    //$paramList["cf_".$name] = $value;
                    //}

                    $checkSum = getChecksumFromArray($paramList, PAYTM_MERCHANT_KEY);

                    echo '<center><h1>Please do not refresh this page...</h1></center>';
                    echo '<form method="post" action="' . PAYTM_TXN_URL . '" name="f1">';
                    foreach ($paramList as $name => $value) {
                        echo '<input type="hidden" name="' . $name . '" value="' . $value . '">';
                    }

                    echo '<input type="hidden" name="CHECKSUMHASH" value="' . $checkSum . '">';
                    echo '</form>';

                    echo '<script type="text/javascript">document.f1.submit();</script>';
                } else {

                    redirect(base_url(AGENT_URL));
                }
            }
        } else {
            redirect(base_url(AGENT_URL));
        }
    }

    public function invoice_payment_response()
    {
        $this->load->library('pdf');

        $order_id = $this->input->get('order_id');

        $where = "order_id='" . $order_id . "' AND entry_type='2' AND payment_status='0'";
        $pay_detail = $this->Action_model->select_single('tbl_payment', $where);
        $data['pay_detail'] = $pay_detail;
        if ($pay_detail) {

            $paytmChecksum = "";
            $paramList = array();
            $isValidChecksum = "FALSE";
            $paramList = $_POST;
            $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
            $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum);

            if ($isValidChecksum == "TRUE") {

                $where = "user_id='" . $pay_detail->user_id . "'";
                $user_detail = $this->Action_model->select_single('tbl_users', $where);

                $this->session->set_userdata('agent_hash', $user_detail->user_hash);
                $this->session->set_userdata('agent_role_id', $user_detail->role_id);
                $this->session->set_userdata('agent_name', ($user_detail->is_individual) ? $user_detail->user_title . ' ' . $user_detail->first_name . ' ' . $user_detail->last_name : $user_detail->firm_name);
                $account_id = $user_detail->user_id;
                if ($user_detail->role_id != 2) {
                    $account_id = $user_detail->parent_id;
                }
                $this->session->set_userdata('agent_account_id', $account_id);

                if ($_POST["STATUS"] == "TXN_SUCCESS") {
                    $payment_status = '1';
                    $txn_status = 'success';
                    $txn_status_for_redirect = '1';
                    $amount = $_POST['TXNAMOUNT'];

                    $pay_array = array('payment_status' => '1', 'paid_type' => '1', 'payment_getway' => 'Paytm', 'txn_id' => $_POST['TXNID'], 'payment_mode' => $_POST['PAYMENTMODE'], 'txn_date' => $_POST['TXNDATE'], 'txn_status' => ucfirst($_POST["STATUS"]));

                    $today = $pay_detail->current_plan_date;
                    $next_month = $pay_detail->next_due_date;

                    $pay_array['receipt_date'] = date("d-m-Y");
                    $update_array['per_user_amount'] = $pay_detail->amount_per_user;
                    $update_array['monthly_cost'] = $pay_detail->monthly_cost;
                    $update_array['no_of_user'] = $pay_detail->no_of_user;

                    if ($user_detail->plan_id == 1) {
                        $update_array['plan_id'] = 2;
                    }

                    $this->Action_model->update_data($pay_array, 'tbl_payment', "order_id='" . $order_id . "' AND payment_status='0'");

                    $update_array['current_plan_date'] = $today;
                    $update_array['next_due_date'] = $next_month;

                    $this->Action_model->update_data($update_array, 'tbl_users', array('user_id' => $user_detail->user_id));

                    $expire_date = $next_month;
                    $name = $this->Action_model->get_name($user_detail->user_id);
                    $mobile = $user_detail->mobile;
                    $invoice_no = $pay_detail->payment_id;
                    $receipt_date = date("d-m-Y");
                    $invoice_amount = "Rs." . str_replace(".00", "", $pay_detail->total_amount);
                    $date1 = new DateTime(date("d-m-Y") . " 00:00:00");
                    $date2 = new DateTime($expire_date . " 00:00:00");
                    $interval = $date1->diff($date2);
                    $expire_days = $interval->days;

                    $data['name'] = $name;
                    $data['expire_date'] = $expire_date;
                    $data['invoice_no'] = $invoice_no;
                    $data['receipt_date'] = $receipt_date;
                    $data['invoice_amount'] = $invoice_amount;

                    $email_from = MAINEMAIL;
                    $email_to = MAINEMAIL;
                    $email_subject = "Invoice for Agent Diary Subscription (Invoice No: " . $invoice_no . ")";
                    $email_msg = $this->load->view('email/receipt', $data, true);

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
                    $this->db->where("((entry_type='1' AND payment_status='1') OR (entry_type='2')) AND payment_id='" . $pay_detail->payment_id . "'");
                    $query = $this->db->get();
                    $invoice_detail = $query->row();
                    $data['invoice_detail'] = $invoice_detail;

                    $where = "setting_id='1'";
                    $setting = $this->Action_model->select_single('tbl_setting', $where);
                    $data['setting'] = $setting;

                    $data['pdf_send_mail'] = 1;

                    $this->load->view('template/pdf/receipt', $data);

                    $this->Action_model->sendMobileSMS($mobile, "Dear Agent, Thanks for Received " . $invoice_amount . " Against Invoice No# " . $invoice_no . "  , For Agent Diary Subscription");
                } else {
                    $payment_status = '0';
                    $txn_status = 'failed';
                    $txn_status_for_redirect = '0';
                    $amount = '0.00';

                    //$pay_array = array('payment_status'=>'2','txn_id'=>$_POST['TXNID'],'payment_mode'=>$_POST['PAYMENTMODE'],'txn_date'=>$_POST['TXNDATE'],'txn_status'=>ucfirst($_POST["STATUS"]));

                    //$this->Action_model->update_data($pay_array,'tbl_payment',"order_id='".$order_id."' AND payment_status='0'");
                }

                redirect(base_url("order-response/" . $order_id));
            } else {
                $this->Action_model->update_data(array('payment_status' => '2'), 'tbl_payment', "order_id='" . $order_id . "' AND payment_status='0'");

                echo "<b>Checksum mismatched.</b>";
            }
        } else {
            redirect(base_url("order-response/" . $order_id));
        }
    }


    public function invoice($id = '')
    {
        if ($id) {
            $this->db->select('*');
            $this->db->from('tbl_payment');
            $this->db->join('tbl_paid_type', "tbl_paid_type.paid_type_id = paid_type", 'left');
            $this->db->where("((entry_type='1' AND payment_status='1') OR (entry_type='2')) AND payment_id='" . $id . "'");
            $query = $this->db->get();
            $invoice_detail = $query->row();
            $data['invoice_detail'] = $invoice_detail;
            $this->load->view('invoice', $data);
        } else {
            redirect(ADMIN_URL);
        }
    }

    public function testmail()
    {
        /*$email_from = MAINEMAIL;
        $email_to = MAINEMAIL;
        $subject = "Test Mail";
        $email_subject = $subject;
        $email_msg = "Test Message";//$this->load->view('email/invoice_create',$data,true);

        $this->email->from($email_from, SITE_TITLE);
        $this->email->to($email_to);
        $this->email->subject($email_subject);
        $this->email->message($email_msg);
        $this->email->set_mailtype("html");
        //$this->email->attach(base_url("pdfview"));
        $this->email->send();*/
    }
    public function pdf_invoice($id = "")
    {

        $this->load->library('pdf');

        if ($id) {
            $this->db->select('*');
            $this->db->from('tbl_payment');
            $this->db->join('tbl_paid_type', "tbl_paid_type.paid_type_id = paid_type", 'left');
            $this->db->where("((entry_type='1' AND payment_status='1') OR (entry_type='2')) AND order_id='" . $id . "'");
            $query = $this->db->get();
            $invoice_detail = $query->row();
            $data['invoice_detail'] = $invoice_detail;

            $where = "setting_id='1'";
            $setting = $this->Action_model->select_single('tbl_setting', $where);
            $data['setting'] = $setting;

            $this->load->view('template/pdf/invoice', $data);
        } else {
            redirect(ADMIN_URL);
        }
    }

    public function pdf_receipt($id = "")
    {

        $this->load->library('pdf');

        if ($id) {
            $this->db->select('*');
            $this->db->from('tbl_payment');
            $this->db->join('tbl_paid_type', "tbl_paid_type.paid_type_id = paid_type", 'left');
            $this->db->where("((entry_type='1') OR (entry_type='2')) AND order_id='" . $id . "' AND payment_status='1'");
            $query = $this->db->get();
            $invoice_detail = $query->row();
            $data['invoice_detail'] = $invoice_detail;

            $where = "setting_id='1'";
            $setting = $this->Action_model->select_single('tbl_setting', $where);
            $data['setting'] = $setting;

            $this->load->view('template/pdf/receipt', $data);
        } else {
            redirect(ADMIN_URL);
        }
    }

    
    #  Fetch lead from facebook 

    public function fetch_lead_from_api(){

        
        

   }

    #  End  lead from facebook 

}
