<?php
    Class Appointment extends CI_Controller{
        
        function __construct(){
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->helper('date');
        $this->load->library('form_validation');
        $this->load->model('Appointment_model');
        }
        
        function confirmEmail(){
            $this->load->view('fe/confirmEmail.php');
        }
    
        function appointment1(){
            $k = $this->input->get('k');
            $data['data'] = $this->Appointment_model->getHashedAppointmentDetail($k);
            $this->load->view('fe/appointment1', $data);
        }
        
        function appointment2(){
            $id = 1;
            $data['data'] = $this->Appointment_model->getAppointmentDetail($id);
            $this->load->view('fe/appointment2', $data);
        }
        function securityCode(){
            echo password_hash('lol', PASSWORD_BCRYPT);
        }
    }
?>