<?php
class Action_model extends CI_Model {  

  public function insert_data($data, $tabel_name ) {
        $this->db->insert($tabel_name, $data);
        return $this->db->insert_id();    
    }
    public function insert_data_multiple($data, $tabel_name ) {
        $this->db->insert($tabel_name, $data);
        return $this->db->insert_batch();    
    }
  
  public function select_all($table)
    {
      $query=$this->db->get($table);
       return $query->result_array();    
    }
  
  function delete_query($table, $where)
  {
            $this->db->where($where);
            $this->db->delete($table); 
    }
  
  public function select_single($table,$where,$select='')
    {
      if($select){
        $this->db->select($select);
      }
      $this->db->where($where);
      $query=$this->db->get($table);
      return $query->row();
    }

    public function get_name($id='')
    {
      $this->db->select("is_individual,user_title,first_name,last_name,firm_name,parent_id");
      $this->db->where("user_id='".$id."'");
      $query=$this->db->get("tbl_users");
      $row = $query->row();

      $name = ($row)?(($row->parent_id==0)?(($row->is_individual)?ucwords($row->user_title.' '.$row->first_name.' '.$row->last_name):$row->firm_name):ucwords($row->user_title.' '.$row->first_name.' '.$row->last_name)):'';
      return $name;
    }

    public function select_single_join($table,$where,$select='',$join='')
    {
      if($select){
        $this->db->select($select);
      }
      $count = count($join);
    $ct=0;
    $ct1=0;
    for ($i=0; $i <($count/2) ; $i++) { 
      $ct1=$ct+1 ;
    $this->db->join($join[$ct],$join[$ct1]);  
    $ct=$ct+2 ;
    } 
      $this->db->where($where);
      $query=$this->db->get($table);
      return $query->row();
    }
   public function detail_result($table,$id,$select='',$limit='')
  {
       if ($select!='') {
         $this->db->select($select);
       }
       
       if ($id!='') {
         $this->db->where($id);
       }if($limit!=''){
        $this->db->limit($limit);
       }
       
      $query=$this->db->get($table);
       return $query->result();    
    }
  public function select_multiple_where($table,$where)
    {
      $this->db->where($where);
      $query=$this->db->get($table);
    return $query->result_array();
    }
  
  public function update_data($data, $table, $where ,$join='')
    {
     $this->db->set($data); 
     $this->db->where($where);
     $this->db->join($join,'left');
     $query= $this->db->update($table, $data);
     return $query;
  }

  public function join_query($table, $where, $join,$select='',$order_by='')
{
    if (!empty($select)) {
      $this->db->select($select);
    }
    else {
      $this->db->select('*');
    }
    $this->db->from($table); 
    $count = count($join);
    $ct=0;
    $ct1=0;
    for ($i=0; $i <($count/2) ; $i++) { 
      $ct1=$ct+1 ;
    $this->db->join($join[$ct],$join[$ct1]);  
    $ct=$ct+2 ;
    } 
     $this->db->where ($where);  
     if ($order_by) {
       $this->db->order_by($order_by[0], $order_by[1]);
     }
    
    $query = $this->db->get(); 
    return $query->result_array();
} 

public function join_query_result($table, $where, $join,$select='',$order_by='')
{
    if (!empty($select)) {
      $this->db->select($select);
    }
    else {
      $this->db->select('*');
    }
    $this->db->from($table); 
    $count = count($join);
    $ct=0;
    $ct1=0;
    for ($i=0; $i <($count/2) ; $i++) { 
      $ct1=$ct+1 ;
    $this->db->join($join[$ct],$join[$ct1]);  
    $ct=$ct+2 ;
    } 
     $this->db->where ($where);  
     if ($order_by) {
       $this->db->order_by($order_by[0], $order_by[1]);
     }
    
    $query = $this->db->get(); 
    return $query->result();
} 

  public function join_query_row($table, $where, $join,$select='')
{
    if (!empty($select)) {
      $this->db->select($select);
    }
    else {
      $this->db->select('*');
    }
    $this->db->from($table); 
    $count = count($join);
    $ct=0;
    $ct1=0;
    for ($i=0; $i <($count/2) ; $i++) { 
      $ct1=$ct+1 ;
    $this->db->join($join[$ct],$join[$ct1]);  
    $ct=$ct+2 ;
    } 
     $this->db->where ($where);      
    $query = $this->db->get(); 
    return $t=$query->result();
}
public function join_query_group_by($table, $where, $join,$select='')
{
    if (!empty($select)) {
      $this->db->select($select);
    }
    else {
      $this->db->select('*');
    }
    $this->db->from($table); 
    $count = count($join);
    $ct=0;
    $ct1=0;
    for ($i=0; $i <($count/2) ; $i++) { 
      $ct1=$ct+1 ;
    $this->db->join($join[$ct],$join[$ct1]);  
    $ct=$ct+2 ;
    } 
     $this->db->where ($where); 
     $this->db->group_by ('projects.project_id');     
    $query = $this->db->get(); 
    return $query->result_array();
}
public function data_pagination($table,$limit,$start,$ght)
  {
    $sql = 'select * FROM '.$table.' where '.$ght.'  limit ' . $start . ', ' . $limit;
        $query = $this->db->query($sql);
        return $query->result();
  }  

  public function detail_result_array($table,$id)
  {
       if ($id!='') {
         $this->db->where($id);

       }
       
      $query=$this->db->get($table);
       return $query->result_array();    
    }

public function send_mail($to,$subject,$mail_message)
{
  $from = MAINEMAIL;
  $this->email->set_newline("\r\n");
  $this->email->from($from, SITE_TITLE);
  $this->email->to($to);
  $this->email->subject($subject);
  $this->email->message($mail_message);
  $this->email->set_mailtype("html");
  $mlsnt=$this->email->send();
  return ($mlsnt)?1:0;
}

function is_numeric_array($array) {

     foreach ($array as $a=>$b) {
        if (!is_numeric($b)) {
           return false;
        }
     }
     return true;
  }
  function base64_to_jpeg($base64_image_string, $output_file_without_extension, $path_with_end_slash="./public/images/user_profile/" ) {
    $splited = explode(',', substr( $base64_image_string , 5 ) , 2);
    $mime=$splited[0];
    $data=$splited[1];

    $mime_split_without_base64=explode(';', $mime,2);
    $mime_split=explode('/', $mime_split_without_base64[0],2);
    if(count($mime_split)==2)
    {
        $extension=$mime_split[1];
        if($extension=='jpeg')$extension='jpg';
        //if($extension=='javascript')$extension='js';
        //if($extension=='text')$extension='txt';
        $output_file_with_extension=$output_file_without_extension.'.'.$extension;
    }
    file_put_contents( $path_with_end_slash . $output_file_with_extension, base64_decode($data) );
    return $output_file_with_extension;
}

public function getlongitudeandlatitude($distance, $minlat='',$minlong='',$where='',$limit='')
{
if($where){
$df="SELECT * , ( 3959 * acos ( cos ( radians($minlat) ) * cos( radians( cordinate_lat ) ) * cos( radians( cordinate_lng ) - radians($minlong) ) + sin ( radians($minlat) ) * sin( radians( cordinate_lat ) ) ) ) AS distance FROM tbl_datacenter WHERE $where HAVING distance < $distance ORDER BY claim_status DESC,distance ASC";}
else{
  $df="SELECT * , ( 3959 * acos ( cos ( radians(-73.9655836) ) * cos( radians( cordinate_lat ) ) * cos( radians( cordinate_lng ) - radians(40.5854918) ) + sin ( radians(-73.9655836) ) * sin( radians( cordinate_lat ) ) ) ) AS distance FROM tbl_datacenter  HAVING distance < $distance ORDER BY distance ASC";
}

if ($limit) {
  $df.="".$limit;
}
$data=$this->db->query($df)->result();
return $data;
}

public function getlongitudeandlatitude_count($distance, $minlat='',$minlong='',$where='',$limit='')
{
if($where){
$df="SELECT * , ( 3959 * acos ( cos ( radians($minlat) ) * cos( radians( cordinate_lat ) ) * cos( radians( cordinate_lng ) - radians($minlong) ) + sin ( radians($minlat) ) * sin( radians( cordinate_lat ) ) ) ) AS distance FROM tbl_datacenter WHERE $where HAVING distance < $distance";}
else{
  $df="SELECT * , ( 3959 * acos ( cos ( radians(-73.9655836) ) * cos( radians( cordinate_lat ) ) * cos( radians( cordinate_lng ) - radians(40.5854918) ) + sin ( radians(-73.9655836) ) * sin( radians( cordinate_lat ) ) ) ) AS distance FROM tbl_datacenter  HAVING distance < $distance ORDER BY distance ASC";
}

if ($limit) {
  $df.="".$limit;
}
$data=$this->db->query($df)->num_rows();
return $data;
}

public function get_menu_items($user_id,$role_id){

        $this->db->select('*');
        if ($role_id) {
          $this->db->where('role_id='.$role_id);
        }
        $this->db->from('tbl_modules');
        $this->db->join('tbl_role_rights', 'tbl_role_rights.module_id = tbl_modules.module_id');
        $this->db->order_by("module_order", "asc");

        $parent = $this->db->get();
        
        $categories = $parent->result_array();
        foreach($categories as $p_cat){

            $categories[$p_cat['module_code']] = $p_cat;
        }
        return $categories;
    }

    public function check_perm($module_code,$perm)
    {
        
        $user_data = $this->Action_model->select_single('tbl_users',"user_hash='".$this->session->userdata('agent_hash')."'");
        $where = "role_id='".$user_data->role_id."' AND module_code='".$module_code."' AND ".$perm."='1'";
        $this->db->select('*');
        $this->db->where($where);
        $this->db->from('tbl_modules');
        $this->db->join('tbl_role_rights', 'tbl_role_rights.module_id = tbl_modules.module_id');
        $query = $this->db->get();
        
        $row = $query->row();
        return ($row)?true:false;
    }

function ajaxDatatable($postData,$searchQuery,$table,$where,$select,$join=array()){

     $response = array();

     //Read value
     $draw = $postData['draw'];
     $start = $postData['start'];
     $rowperpage = $postData['length']; // Rows display per page
     $columnIndex = $postData['order'][0]['column']; // Column index
     $columnName = $postData['columns'][$columnIndex]['data']; // Column name
     $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
     /*//$searchValue = $postData['search']['value']; // Search value

    //Search 
     $searchQuery = "";
     if($searchValue != ''){
        $searchQuery = " (role_name like '%".$searchValue."%' ) ";
     }*/

     //Total number of records without filtering
     $this->db->select('count(*) as allcount');
     $records = $this->db->get($table)->result();
     $totalRecords = $records[0]->allcount;

     //Total number of record with filtering
     $this->db->select('count(*) as allcount');
     if($searchQuery != ''){
        $this->db->where($searchQuery);
     }

    if ($join) {
       $count = count($join);
      $ct=0;
      $ct1=0;
      for ($i=0; $i <($count/2) ; $i++) { 
        $ct1=$ct+1 ;
      $this->db->join($join[$ct],$join[$ct1]);  
      $ct=$ct+2 ;
    }
     }

     $records = $this->db->get($table)->result();
     $totalRecordwithFilter = $records[0]->allcount;

     //Fetch records
     $this->db->select($select);
     if($searchQuery != ''){
        $this->db->where($searchQuery);
     }
     $this->db->order_by($columnName, $columnSortOrder);
     $this->db->limit($rowperpage, $start);

     if ($join) {
       $count = count($join);
      $ct=0;
      $ct1=0;
      for ($i=0; $i <($count/2) ; $i++) { 
        $ct1=$ct+1 ;
      $this->db->join($join[$ct],$join[$ct1]);  
      $ct=$ct+2 ;
    }
     }

     $records = $this->db->get($table)->result();

     $data = array();

     if ($records) {
       $data = $records;
     }
     /*foreach($records as $record ){

        $data[] = array( 
           "role_id"=>$record->role_id,
           "role_name"=>$record->role_name,
           "role_status"=>$record->role_status
        ); 
     }*/

    // role_id,role_name,role_status

     //Response
     $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecordwithFilter,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
     );

     return $response; 
   }

   function ajaxDatatableLeft($postData,$searchQuery,$table,$where,$select,$join=array()){

     $response = array();

     //Read value
     $draw = $postData['draw'];
     $start = $postData['start'];
     $rowperpage = $postData['length']; // Rows display per page
     $columnIndex = $postData['order'][0]['column']; // Column index
     $columnName = $postData['columns'][$columnIndex]['data']; // Column name
     $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
     /*//$searchValue = $postData['search']['value']; // Search value

    //Search 
     $searchQuery = "";
     if($searchValue != ''){
        $searchQuery = " (role_name like '%".$searchValue."%' ) ";
     }*/

     //Total number of records without filtering
     $this->db->select('count(*) as allcount');
     $records = $this->db->get($table)->result();
     $totalRecords = $records[0]->allcount;

     //Total number of record with filtering
     $this->db->select('count(*) as allcount');
     if($searchQuery != '')
        $this->db->where($searchQuery);

    if ($join) {
       $count = count($join);
      $ct=0;
      $ct1=0;
      for ($i=0; $i <($count/2) ; $i++) { 
        $ct1=$ct+1 ;
      $this->db->join($join[$ct],$join[$ct1],'left');  
      $ct=$ct+2 ;
    }
     }

     $records = $this->db->get($table)->result();
     $totalRecordwithFilter = $records[0]->allcount;

     //Fetch records
     $this->db->select($select);
     if($searchQuery != '')
        $this->db->where($searchQuery);
     $this->db->order_by($columnName, $columnSortOrder);
     $this->db->limit($rowperpage, $start);

     if ($join) {
       $count = count($join);
      $ct=0;
      $ct1=0;
      for ($i=0; $i <($count/2) ; $i++) { 
        $ct1=$ct+1 ;
      $this->db->join($join[$ct],$join[$ct1],'left');  
      $ct=$ct+2 ;
    }
     }

     $records = $this->db->get($table)->result();

     $data = array();

     if ($records) {
       $data = $records;
     }
     /*foreach($records as $record ){

        $data[] = array( 
           "role_id"=>$record->role_id,
           "role_name"=>$record->role_name,
           "role_status"=>$record->role_status
        ); 
     }*/

    // role_id,role_name,role_status

     //Response
     $response = array(
        "draw" => intval($draw),
        "iTotalRecords" => $totalRecordwithFilter,
        "iTotalDisplayRecords" => $totalRecordwithFilter,
        "aaData" => $data
     );

     return $response; 
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


public function sendMobileSMS($mobile, $message,$return=false)
{
    
    // Account details
  $apiKey = urlencode(TEXTLOCAL_KEY);
  
  // Message details
  $numbers = array($mobile);
  $sender = urlencode('TXTLCL');
  $message = urlencode($message);
 
  $numbers = implode(',', $numbers);
 
  // Prepare data for POST request
  $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 
  // Send the POST request with cURL
  $ch = curl_init('https://api.textlocal.in/send/');
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  curl_close($ch);

  if ($return) 
  {
    return $response;
  }
  
  // Process your response here
  //echo $response;
}

public function sendWhatsappMessage($mobile,$message)
{
    $cURLConnection = curl_init();

curl_setopt($cURLConnection, CURLOPT_URL, 'https://messageapi.in/MessagingAPI/sendMessage.php?LoginId=9694222444&password=Akesh14701&mobile_number=91'.$mobile.'&message='.urlencode($message));
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($cURLConnection);
curl_close($cURLConnection);

    $status = ($response && $response=="success")?1:0;
    
    return $status;
}


public function sendWhatsappMessageFromAgent($mobile,$message,$user_id=null)
{
    $status = 0;

    $account_id = $user_id!=null?$user_id: getAccountId();
    $where = "tbl_user_details.user_id='".$account_id."'";

    $this->db->select('*');
    $this->db->from('tbl_user_details');
    $this->db->join('tbl_users', 'tbl_users.user_id = tbl_user_details.user_id');
    $this->db->where($where);
    $query = $this->db->get();
    $user_detail = $query->row();

    if ($user_detail && $user_detail->whatsapp_api_mobile && $user_detail->whatsapp_api_password) 
    {
      
      $cURLConnection = curl_init();

      curl_setopt($cURLConnection, CURLOPT_URL, 'https://messageapi.in/MessagingAPI/sendMessage.php?LoginId='.$user_detail->whatsapp_api_mobile.'&password='.$user_detail->whatsapp_api_password.'&mobile_number=91'.$mobile.'&message='.urlencode($message));
      curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

      $response = curl_exec($cURLConnection);
      curl_close($cURLConnection);
      
     
     
    $status = ($response && $response=="success")?1:0;

    }
    else {
      $status = 2;
    }
    
    return $status;
}

public function sendEmailFromAgent($to,$subject,$mail_message,$user_id=null)
{
    $status = 0;

    $account_id = $user_id!=null?$user_id:getAccountId();
   
 
    $where = "tbl_user_details.user_id='".$account_id."'";

    $this->db->select('*');
    $this->db->from('tbl_user_details');
    $this->db->join('tbl_users', 'tbl_users.user_id = tbl_user_details.user_id');
    $this->db->where($where);
    $query = $this->db->get();
    $user_detail = $query->row();

    if ($user_detail && $user_detail->mail_username && $user_detail->mail_password) 
    {
      
      /*$from = MAINEMAIL;
  $this->email->set_newline("\r\n");
  $this->email->from($from, SITE_TITLE);
  $this->email->to($to);
  $this->email->subject($subject);
  $this->email->message($mail_message);
  $this->email->set_mailtype("html");
  $mlsnt=$this->email->send();
  $status = ($mlsnt)?1:0;*/
  $this->load->library('email');
  $from = $user_detail->mail_username;
  $config = Array(
    'protocol' => 'smtp',
    'smtp_host' => 'ssl://smtp.googlemail.com',
    'smtp_port' => 465,
    'smtp_user' => $from,
    'smtp_pass' => $user_detail->mail_password,
    'mailtype'  => 'html', 
    'charset'   => 'iso-8859-1',
    'starttls'  => true,
  );
       
 $this->email->initialize($config);
 $this->email->set_newline("\r\n");
 $this->email->from($from, SITE_TITLE);
 $this->email->to($to);
 $this->email->subject($subject);
 $this->email->message($mail_message);
 $this->email->set_mailtype("html");
 $mlsnt=$this->email->send();
         
 $status = ($mlsnt)?1:0;
  }
    else 
    {
      $status = 2;
    }
    
return $status;
}

}