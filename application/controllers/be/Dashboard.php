<?php
class Dashboard extends CI_Controller 
{

    function __construct(){
        parent::__construct();

        $this->load->helper(array('form', 'url'));
		$this->load->helper('date');
        $this->load->library('form_validation');
        $this->load->library("pagination");
        $this->load->library("authentication");                
    }

    /**
     * @param int $start
     */
    function index($start=1)
    {
        if(!$this->session->userdata('logged_in'))
        {
            redirect(site_url('be/login'));
        }

        $data['main_content'] = 'be/welcome_cms_view';
        $this->load->view('be/includes/template_cms', $data);
    }
    
}
?>