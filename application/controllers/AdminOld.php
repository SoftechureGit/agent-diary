<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Admin extends CI_Controller {  

     public function __construct() {
        parent::__construct();
        $this->load->model('Action_model');
        /*if(!$this->session->userdata('admin_id')){
          redirect('admin-login');
        }*/
    }
    public function index()
     {
        $this->load->view(ADMIN_URL.'/index');
     }
    public function news_list()
     {
        $dat1['news_list']=$this->Action_model->detail_query('newspost');
        $this->load->view(ADMIN_URL.'/news_list',$dat1);
     }
    public function news_single($id='')
     {
        $dat1['id']='';
       $dat1['states']=$this->Action_model->detail_query('states');
        $dat1['news_cat']=$this->Action_model->detail_query('newscategory');
        if($id){
        $dat1['id']=$id;
        $dat1['news_single']=$data=$this->Action_model->detail_where('newspost',array('news_id'=>$id));
        }
        $this->load->view(ADMIN_URL.'/news_single',$dat1);
     }

      public function news_category_list()
            {
               $dat1['news_cat_list']=$this->Action_model->detail_query('newscategory'); 
               $this->load->view(ADMIN_URL.'/news_category_list',$dat1);
            }
            public function news_category_single($id='')
             {
                $dat1['id']='';
        
                if($id){
                    $dat1['id']=$id;
                        $dat1['news_cat_single']=$this->Action_model->detail_where('newscategory',array('news_cat_id'=>$id));
                }
                $this->load->view(ADMIN_URL.'/news_category_single',$dat1);
             }

              public function news_cat_query($id='')
     {

                
            $news_cat_title    =$this->input->post('news_cat_title');
            $news_cat_url      =$this->input->post('news_cat_url');

            $value['category_title']       =$news_cat_title;
            $value['category_url']         =strtolower(str_replace(" ", "-",$news_cat_url));
            if($id){
                $this->Action_model->update_query($value,'newscategory',array('news_cat_id'=>$id));
                $this->session->set_flashdata('success_msg','News category Successfully Updated...');
                redirect(ADMIN_URL.'/news-category-single/'.$id);
            }else{ 
                $this->Action_model->insert_data($value,'newscategory');
                redirect(ADMIN_URL.'/news-category-list');
            }
        }

    public function courses_list()
     {
         $data['event_list']=$this->Action_model->detail_query('courses');
        $this->load->view(ADMIN_URL.'/porfolio_list',$data);
     }
    public function add_courses($id='')
     {
         $data['id']='';
         $data['states']=$this->Action_model->detail_query('states');
        if($id){
        $data['id']=$id;
        $data['portfolio_single']=$this->Action_model->detail_where('courses',array('event_id'=>$id));
        }
        $this->load->view(ADMIN_URL.'/porfolio_single',$data);
     } 

     public function news_query($id='')
     {

                $config['upload_path'] = './public/front/news/';
                $config['allowed_types']= 'gif|jpg|png|jpeg';
                $config['remove_spaces'] = TRUE;
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                 $this->upload->initialize($config);
                 if($id){
                    $file_name=$this->input->post('old_image');
                 }else{
                    $file_name='';
                 }
                 
                if (!empty($_FILES['news_image']['name'])) {
                if ( ! $this->upload->do_upload('news_image'))
                { $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error_msg', $error['error']);
                redirect(ADMIN_URL.'/news-single/'.$id);
                }
                else
                { $data = array('
                    upload_data' => $this->upload->data());
                    $file_name=$this->upload->data('file_name');
                }
                }
            $blog_title    =$this->input->post('news_title');
            $blog_url      =strtolower(str_replace(" ","-",trim($this->input->post('news_url'))));
            $popular       =$this->input->post('popular');
            $blog_tag      =$this->input->post('news_tag');
            $robots        =$this->input->post('robots');
            $meta_title    =$this->input->post('meta_title');
            $meta_desc     =$this->input->post('meta_desc');
            $blog_desc     =$this->input->post('news_desc');
            $blog_category =$this->input->post('news_category');
            $keywords      =$this->input->post('keywords');
            $post_status   =$this->input->post('news_status');
            $comment_status=$this->input->post('comment_status');

            $value['news_title']       =$blog_title;
            $value['news_url']         =$blog_url;
            $value['category']         =$blog_category;
            $value['news_content']     =$blog_desc;
            $value['news_image']       =$file_name;
            $value['news_status']      =$post_status;
            $value['comment_status']   =$comment_status;
            $value['popular']          =$popular;
            $value['tag']              =$blog_tag;
            $value['meta_description'] =$meta_desc;
            $value['keywords']         =$keywords;
            $value['robots']           =$robots;
            $value['posted_by']=$this->session->userdata('admin_id');
            if($id){
                $value['news_modified']=date('d-m-Y');
                $this->Action_model->update_query($value,'newspost',array('news_id'=>$id));
                $this->session->set_flashdata('success_msg','News Successfully Updated...');
                redirect(ADMIN_URL.'/news-single/'.$id);
            }else{
                 $value['news_date']=date('d-m-Y');
                $this->Action_model->insert_data($value,'newspost');
                redirect(ADMIN_URL.'/news-list');
            }
     }


     public function portfolio_query($id='')
     {

                $config['upload_path'] = './public/front/images/event/';
                $config['allowed_types']= 'gif|jpg|png|jpeg';
                $config['remove_spaces'] = TRUE;
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                 $this->upload->initialize($config);
                 if($id){
                    $file_name=$this->input->post('old_image');
                 }else{
                    $file_name='';
                 }
                 
                if (!empty($_FILES['image']['name'])) {
                if ( ! $this->upload->do_upload('image'))
                { $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error_msg', $error['error']);
                redirect(ADMIN_URL.'/event-single/'.$id);
                }
                else
                { $data = array('
                    upload_data' => $this->upload->data());
                    $file_name=$this->upload->data('file_name');
                    if($this->input->post('old_image')){
                        unlink('./public/front/images/event/'.$this->input->post('old_image'));
                    }
                }
                }

               

            $value['event_title']       =   $this->input->post('event_title');
            $value['event_url']         =   $this->input->post('event_url');
            $value['event_date']        =   $this->input->post('event_date');
            $value['event_description'] =   $this->input->post('event_description');
            $value['event_time']        =   $this->input->post('event_time');
            $value['event_location']    =   $this->input->post('event_location');
            $value['event_image']       =   $file_name;
            $value['state_id']      =$this->input->post('state_id');
            if($id){
                $this->Action_model->update_query($value,'courses',array('event_id'=>$id));
                $this->session->set_flashdata('success_msg','Event Successfully Updated...');
                redirect(ADMIN_URL.'/add-courses/'.$id);
            }else{
                $this->Action_model->insert_data($value,'courses');
                redirect(ADMIN_URL.'/courses-list');
            }
     }
     public function portfolio_remove($value)
     {
        if($value){
            $this->Action_model->delete_query(array('event_id'=>$value),'courses');
            redirect(ADMIN_URL.'/courses-list'); 
        }else{
            redirect(ADMIN_URL.'/courses-list');
        }
    }

   






             public function event_comments($id='')
            {
              if($id){
              $dat1['id']=$id;
               $dat1['news_list']=$this->Action_model->join_query('courses',array('courses.event_id'=>$id),array('eventcomment','courses.event_id=eventcomment.event_id')); 
               $this->load->view(ADMIN_URL.'/events_comments',$dat1);
             }else{
              redirect(ADMIN_URL.'/event-list');
             }
            }

            public function event_update_comment($id='')
            {
              $dat1['id']=$id;
               $dat1['news_id']='';
              if($id){
              $dat1['comment_single']=$this->Action_model->detail_where('eventcomment',array('comment_id'=>$id));
              if($dat1['comment_single']){
               $this->load->view(ADMIN_URL.'/event_update_comment',$dat1);
              }else{
                redirect(ADMIN_URL.'/event-list');
              }
             }else{
                redirect(ADMIN_URL.'/event-list');
             }
            }

             public function event_add_comment($id='')
            {
              $dat1['id']='';
              $dat1['news_id']=$id;
               $this->load->view(ADMIN_URL.'/event_update_comment',$dat1);
             
            }

        public function event_comment_query($id='')
         {

                   
                $value['event_id']         =$this->input->post('news_id');
                $value['commented_by']      =$this->input->post('commented_by');
                $value['commenter_email']      =$this->input->post('commenter_email');
                $value['comment_content']      =$this->input->post('comment_content');
                $value['commenter_url']      =$this->input->post('commenter_url');
                $value['comment_parent']      =$this->input->post('comment_parent');
                $value['comment_date']      =$this->input->post('comment_date');
                $value['comment_approved']      =$this->input->post('comment_approved');
                
                if($id){
                    $this->Action_model->update_query($value,'eventcomment',array('comment_id'=>$id));
                    $this->session->set_flashdata('success_msg','Comment Successfully Updated...');
                    redirect(ADMIN_URL.'/event_comments/'.$value['event_id']);
                }else{
                    $this->Action_model->insert_data($value,'eventcomment');
                    $this->session->set_flashdata('success_msg','Comment Successfully Added...');
                    redirect(ADMIN_URL.'/event_comments/'.$value['event_id']);
                }
            }
             


       public function user_list()
      {
        
        $data['users']=$this->Action_model->detail_query2('contact_users');
        $this->load->view(ADMIN_URL.'/user_data',$data);
      }
    
     

    
}