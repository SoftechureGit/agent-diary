<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! function_exists('getAccountId'))
{

	function getAccountId()
	{
		$account_id = 0;

		$CI	=	get_instance();
		$CI->load->database();

        $where = "user_hash='".$CI->session->userdata('agent_hash')."'";
        $CI->db->where($where);
        $query=$CI->db->get('tbl_users');
        $user_detail = $query->row();
        if ($user_detail) {
            $account_id = $user_detail->user_id;
            if ($user_detail->role_id!=2) {
                $account_id = $user_detail->parent_id;
            }
        }

        return $account_id;
	}
	
	function getAccountIdHash($user_hash)
	{
		$account_id = 0;

		$CI	=	get_instance();
		$CI->load->database();

        $where = "user_hash='".$user_hash."'";
        $CI->db->where($where);
        $query=$CI->db->get('tbl_users');
        $user_detail = $query->row();
     
        if ($user_detail) {
            $account_id = $user_detail->user_id;
            if ($user_detail->role_id!=2) 
            {
                $account_id = $user_detail->parent_id;
            
            }
        }

        return $account_id;
	}
}