<?php 
class Appointment extends CI_Controller
{
    function __construct(){
        parent::__construct();
        
        $this->load->helper(array('url'));
		$this->load->helper('date');
        $this->load->library("pagination");
        $this->load->library('authentication');
        $this->load->model('appointment_model','a');
    }

    
    function appointmentListCms($start=1)
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
        
        $result =  $this->a->getAppointmentCmslist($start,$limit);
        $count_result = $this->a->countAppointmentCmsList();
        
        $config['base_url'] = site_url('be/appointment/appointmentListCms');
		$config['uri_segment'] = 4; 
		$config['total_rows']= $count_result;
		$config['per_page'] =$num_per_page;
		$config['use_page_numbers'] = TRUE; 
        
        $this->pagination->initialize($config);
		$data['pages']=$this->pagination->create_links();
        $data['data'] = $result;
        $data['msg'] = null;
        $data['search_text'] = "";
        
        if ($this->input->post('ajax')){
            $this->load->view('be/appointment_list_cms_view', $data);	
        }else{
            $data['main_content'] = 'be/appointment_list_cms_view';
   	        $this->load->view('be/includes/template_cms', $data);	
        }  
    }
       
    function confirmAppointment($id)
    {
        ob_start();
        $datetime = date('Y-m-d H:i:s', time());
        $data=array(
            "lastUpdated"=>$datetime,
            "lastUpdatedBy"=>$this->session->userdata('username'),
            "isSuccess"=>1
        );
        $this->db->trans_begin();
        $query = $this->a->updateAppointment($data,$id);
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
        redirect(site_url("be/appointment/appointmentListCms"));
    }

    function cancelAppointment($id, $reason)
    {
        ob_start();
        $datetime = date('Y-m-d H:i:s', time());
        $data=array(
            "lastUpdated"=>$datetime,
            "lastUpdatedBy"=>$this->session->userdata('username'),
            "isCancel"=>1,
            "cancelReason"=>$reason
        );
        $this->db->trans_begin();
        $query = $this->a->updateAppointment($data,$id);
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
        redirect(site_url("be/appointment/appointmentListCms"));
    }
    
    function deleteAppointment()
    {
        ob_start();
        $id = $this->input->post("appointmentID");
        $datetime = date('Y-m-d H:i:s', time());
        $data=array(
            "lastUpdated"=>$datetime,
            "lastUpdatedBy"=>"Klien",
            "isActive"=>0
        );
        $this->db->trans_begin();
        $query = $this->a->updateAppointment($data,$id);
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
        redirect(site_url("parallax"));
    }
    
}
?>