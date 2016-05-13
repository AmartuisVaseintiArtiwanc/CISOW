<?php

class Login extends CI_Controller{
    
    function index(){
        if($this->session->userdata('logged_in'))
        {
            redirect(site_url('be/dashboard'));
        }
        $this->load->view("be/login_view");
    }
    function showLogout(){
        $this->load->view("be/logout_view");
    }
    
    function doLogin(){
        $this->load->library('hash');
        $msg ="";
        $err ="";
        
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        $this->load->model("user_model");
        $userVerifier = $this->user_model->checkUsername($username);
        $passVerifier = $this->user_model->checkPasswordByUsername($username);

        if(!$userVerifier){
            $result = 0;
            //echo "username ga ada"; 
        }
        else if($this->hash->verifyPass($password, $passVerifier->password)){
            $result = 1; 
           // echo "username ada dan password benar"; 
        }else{
            $result = 0; 
            //echo "username ada tapi password salah"; 
        }

        if($result==0){
            $err ="error";
            $msg = "username atau password anda salah";
            
        }else{
            $err ="sukses";
            $newdata = array(
                   'username'  => $passVerifier->username,
                   'user_id'  => $passVerifier->userID,
                   'level'     => $passVerifier->level,
                   'logged_in' => TRUE
               );

            $this->session->set_userdata($newdata);
        }
        
        echo json_encode(array("status"=>$err, "msg"=>$msg));
    }
    
    function doLogout(){
         $this->session->sess_destroy();
         redirect('be/login');
        
    }
}

?>