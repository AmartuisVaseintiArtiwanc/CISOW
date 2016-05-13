<?php 
class User extends CI_Controller
{    
    function __construct(){
        parent::__construct();
        
        $this->load->helper(array('url'));
		$this->load->helper('date');
        $this->load->library('authentication');
        $this->load->library('hash');
        $this->load->model('user_model');
    }
    
    function validateUsernamePassword()
    {
        
        if($this->input->post('saveType') == "save")
        {
            $isUsernameExists = $this->user_model->checkUsername($this->input->post('username') );//, $this->input->post('userID'));
        }
        else
        {
            $isUsernameExists = $this->user_model->checkUsernameExceptSelf($this->input->post('username'), $this->input->post('userID'));   
        }
        
        if($this->input->post('isChangePassword')==1)
        {
            $oldPasswordCorrect = $this->user_model->checkPassword($this->input->post('userID'));
            
            /*echo "input : ".$this->input->post('old_password')."<br>";
            echo "db    : ".$oldPasswordCorrect->password."<br>";
            echo password_verify($this->input->post('old_password'), $oldPasswordCorrect->password);*/


            if($this->hash->verifyPass($this->input->post('old_password'), $oldPasswordCorrect->password)){
                $isOldPasswordCorrect = 1; 
                //echo "pass benar<br>";
            }else{
                $isOldPasswordCorrect = 0; 
                //echo "pass salah<br>";
            }
            //echo $oldPasswordCorrect->password;              
        }
        else
        {
            $isOldPasswordCorrect = 1;
        }
        $msgUsername = "";
        $msgPassword = "";   
        
        if($isUsernameExists)
        {
            $msgUsername="error";
        }
        else
        {
            $msgUsername="success";
        }
        
        if(!$isOldPasswordCorrect)
        {
            $msgPassword="error";
        }
        else
        {
            $msgPassword="success";
        }
        echo json_encode(array('msgUsername'=>$msgUsername, 'msgPassword'=>$msgPassword));        
    }
    
    function updateUser()
    {
        $this->load->library('upload');
        $status = "";
        $file_element_name = 'userImageLink';
        
        $isUpdateImg = $this->input->post('isUpdate');
        $userID = $this->input->post('userID');
        $username = $this->input->post('username');
        $password = $this->hash->hashPass($this->input->post('password'));
        $level = $this->input->post('userLevel');
        
        if ($status != "error" && $isUpdateImg==1)
        {
            //For Update partner name or partner Image file
            $url_img = base_url();
            $config['upload_path'] = "./img/user";
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 1024 * 5;
            $config['file_name'] = $username;
            $config['overwrite'] = true;

            $this->upload->initialize($config);
            if (!$this->upload->do_upload($file_element_name))
            {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            }
            else
            {
                $data = $this->upload->data();
                $datetime = date('Y-m-d H:i:s', time());
                $data_user=array(
                    'username'=>$username,
                    'password'=>$password,
                    'level'=>$level,
                    'userImgLink'=>$data['file_name'],                    
                    "lastupdated"=>$datetime,
                    "lastupdatedBy"=> $this->session->userdata('username') // sementara pake input belom ada session                    
                );
                $this->load->model('user_model');
                $file_id = $this->user_model->updateUser($data_user, $userID);
                if($file_id)
                {
                    $status = "success";
                    $msg = "File successfully uploaded";
                }
                else
                {
                    unlink($data['full_path']);
                    $status = "error";
                    $msg = "Something went wrong when saving the file, please try again.";
                }
            }
            @unlink($_FILES[$file_element_name]);
        }else if($status != "error" && $isUpdateImg==0){
            //For Update event title, date, desc
            $datetime = date('Y-m-d H:i:s', time());
                $data_user=array(
                    'username'=>$username,
                    'password'=>$password,
                    'level'=>$level,
                    //'userImgLink'=>$data['file_name'],
                    "lastupdated"=>$datetime,
                    "lastupdatedBy"=> $this->session->userdata('username') // sementara pake input belom ada session
                );
            $this->load->model('user_model');
            $file_id = $this->user_model->updateUser($data_user, $userID);
            if($file_id == "1")
            {
                $status = "success";
                $msg = "File successfully updated";
            }
            else
            {
                $status = "error";
                $msg = "Something went wrong when saving the file, please try again.";
            }
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }
	
    
    function userListCms($start=1)
    {
        $this->load->library("pagination");
        
        $data['upload_status']="";
        
        if(!$this->authentication->isAuthorizeAdmin($this->session->userdata('level')))
        {
            redirect(site_url('be/dashboard/index'));
        }       
        
        //$this->output->enable_profiler(TRUE);
        $num_per_page = 10; 
        $start=($start-1)*$num_per_page;
		$limit= $num_per_page;        
        
        $result =  $this->user_model->getUserCmslist($start,$limit);
        $count_result = $this->user_model->countUserCmsList();
        
        $config['base_url'] = site_url('be/user/userListCms');
		$config['uri_segment'] = 3; 
		$config['total_rows']= $count_result;
		$config['per_page'] =$num_per_page;
		$config['use_page_numbers'] = TRUE; 
        
        $this->pagination->initialize($config);
		$data['pages']=$this->pagination->create_links();
        $data['data'] = $result;
        $data['msg'] = null;
        $data['search_text'] = "";
        
        if ($this->input->post('ajax')){
            $this->load->view('be/user_list_cms_view', $data);	
        }else{
            $data['main_content'] = 'be/user_list_cms_view';
   	        $this->load->view('be/includes/template_cms', $data);	
        }  
    }
    
    function addUser()
    {
        $this->load->library('upload');
        $status = "";
        $msg = "";
        $file_element_name = 'userImageLink';

            $username = $this->input->post('username');
            $password = $this->hash->hashPass($this->input->post('password'));
            $level = $this->input->post('userLevel');
            
            $url_img = base_url();
            $config['upload_path'] = "./img/user";
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 1024 * 2;
            $config['file_name'] = $username;
            $config['overwrite'] = true;

            $this->upload->initialize($config);
            
            if (!$this->upload->do_upload($file_element_name))
            {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            }
            else
            {
                $data = $this->upload->data();
                $datetime = date('Y-m-d H:i:s', time());
                $data_user=array(
                    'username'=>$username,
                    'password'=>$password,
                    'level'=>$level,
                    'userImgLink'=>$data['file_name'],
                    "created" => $datetime,
                    "createdBy" => $this->session->userdata('username'),
                    "lastupdated"=>$datetime,
                    "lastupdatedBy"=> $this->session->userdata('username'),
                    "isActive"=>1
                );
                $this->load->model('user_model');
                $file_id = $this->user_model->createUser($data_user);
                if($file_id)
                {
                    $status = "success";
                    $msg = "User successfully created";
                }
                else
                {
                    unlink($data['full_path']);
                    $status = "error";
                    $msg = "Something went wrong when saving the file, please try again.";
                }
            }
            @unlink($_FILES[$file_element_name]);

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }
    
    function deleteUser($id)
    {
        ob_start();
        $datetime = date('Y-m-d H:i:s', time());
        $data=array(
            "lastUpdated"=>$datetime,
            "lastupdatedBy"=>$this->session->userdata('username'),
            "isActive"=>0
        );
        $this->db->trans_begin();
        $query = $this->user_model->updateUser($data,$id);
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            echo '0';
        }
        else
        {
            if($query==1){
                $this->db->trans_commit();
                echo $query;
            }else{
                $this->db->trans_rollback();
                echo '0';
            }
        }
        redirect(site_url("be/user/userListCms"));
    }
    
    
}
?>