<?php
class Parallax extends CI_Controller
{
	function __construct(){
			parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->helper('date');
		$this->load->helper('html');
	    $this->load->library("pagination");
	    $this->load->library('form_validation');
	    $this->load->library('upload');
		$this->load->model('Article_model');
		$this->load->model('Article_category_model');

	}
	function index()
	{
		/*demi article*/


		$category = $this->Article_category_model->getArticleCategory();
		$data['category'] = $category;

		$latest_post_data= $this -> Article_model->getLatestPost();
        $data['latest_post_data'] = $latest_post_data;

        $category = $this ->Article_category_model->getArticleCategory();

        $article_per_category = array();

//        foreach($category as $row){
//            $category_id =$row['categoryID'];
//            $article_list = $this->Article_model->getArticleByCategory($category_id);
//
//            $data_article = array(
//                "categoryID"=>$row['categoryID'],
//                "categoryName"=>$row['category'],
//                "listArticle"=>$article_list
//            );
//
//            array_push($article_per_category,$data_article);
//        }
        $data['article_data'] = $article_per_category;
        $data['category_data'] = $category;
        /*demi article ends*/

		$this->load->view('fe/parallax_view', $data);
	}

	function Send_email_contactus(){
		$this->load->library('email');

		$config = Array
            (
                'protocol' => 'mail',
                'smtp_host' => 'cyberits.co.id',
                'smtp_port' => 25,
                'smtp_user' => 'no-reply@cyberits.co.id',
                'smtp_pass' => 'Pass@word1',
                'mailtype'  => 'html',
                'charset' => 'iso-8859-1',
                'wordwrap' => TRUE
            );  
		$message =  'Name          		= '.$this->input->post('contactName').
                '<br>Alamat Email = '.$this->input->post('contactEmail').
                '<br>Pesan				= '.$this->input->post('contactMessage');

		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
        $this->email->from('no-reply@cyberits.co.id', 'Feedback System'); // nanti diganti dengan email sistem pintubaja
        $this->email->to('cs@cyberits.co.id'); // nanti diganti dengan admin yang ngurusin order

        $this->email->subject('[CYBERITS] CONTACT US');
		$this->email->message($message);

		if($this->email->send())
        {
            //echo '1';
            $status = 'Success';
            $msg = 'Please see the detail on your email address.';
        }

        else
        {
            show_error($this->email->print_debugger());
            $status = 'failed';
            $msg = 'Thankyou for your message, but we are sorry your message wont reach us any time soon. We will fix it as soon as posible';
        }

        echo json_encode(array( 'status' => $status, 'msg' => $msg));
    }

    function Send_email_appointment(){
        $this->load->library('email');

        $name_appointment   = $this->input->post('name_appointment');
        $email_address      = $this->input->post('email_address');
        $phone_number       = $this->input->post('phone_number');
        $company_brand_name = $this->input->post('company_brand_name');
        $services_need      = $this->input->post('services_need');
        $describe_project   = $this->input->post('describe_project');
        $meeting_date       = $this->input->post('meeting_date');
        $location           = $this->input->post('location');


        try {
            // insert appointment di dalem database
            $data = array(  'name_appointment' => $name_appointment,
                            'email_address' => $email_address,
                            'phone_number' => $phone_number,
                            'company_brand_name' => $company_brand_name,
                            'services_need' => $services_need,
                            'describe_project' => $describe_project,
                            'meeting_date' => $meeting_date,
                            'location' => $location
                            );

            $status_insert = $this->Insert_appointment_view($data);

            if ($status_insert == 'Error') {
                throw new Exception("Can't insert data to database");
            }

            $config = Array
            (
                'protocol' => 'mail',
                'smtp_host' => 'cyberits.co.id',
                'smtp_port' => 25,
                'smtp_user' => 'no-reply@cyberits.co.id',
                'smtp_pass' => 'Pass@word1',
                'mailtype'  => 'html',
                'charset' => 'iso-8859-1',
                'wordwrap' => TRUE
            );            
            /*$config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'crown.bee2015@gmail.com',
                'smtp_pass' => 'Excaliburr',
                'mailtype'  => 'html', 
                'charset'   => 'iso-8859-1'
            );*/
            $this->load->library('hash');
            $hashed_status = $this->hash->hashPass($status_insert);
            $alamatEmailKlienKonfirmasi = $this->input->post('email_address');

        $data['key']=$hashed_status;
        $data['data_article']= $this->Article_model->getPopularArticle(2);
        $this->load->model('appointment_model');
        $datetime = date('Y-m-d H:i:s', time());
        $dataUpdate = array(  'securityCode' => $hashed_status,
                        'lastUpdated' => $datetime,
                        'lastUpdatedBy' => $name_appointment
                        );
        $this->appointment_model->updateAppointment($dataUpdate, $status_insert);
        //$this->output->enable_profiler(TRUE);
        
        $message = $this->load->view('fe/confirmEmail',$data,true);
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('no-reply@cyberits.co.id', 'Appointment Automation System'); // nanti diganti dengan email sistem
        //$this->email->from('crown.bee2015@gmail.com', 'System');
        $this->email->to($alamatEmailKlienKonfirmasi); // nanti diganti dengan admin yang ngurusin order

        $this->email->subject('[CYBERITS] APPOINTMENT');
        $this->email->message($message);

        if($this->email->send()) {
            $status = 'Success';
            $message_alert = 'Success';
            $msg = 'Please see the detail on your email address';
            echo json_encode(array( 'status' => $status, 'msg_error'=> $message_alert,'msg' => $msg));
        }
        else {
            throw new Exception("Can't send the email");
        }
            
            //*/
            /*
            $status = 'Success';
            $message_alert = 'Success';
            $msg = 'Please see the detail on your email address';
            echo json_encode(array( 'status' => $status, 'msg_error'=> $message_alert,'msg' => $msg));
            */
            
        }catch(Exception $e){
            show_error($this->email->print_debugger());
            $status = 'Error';
            $message_alert = $e->getMessage();
            $msg = 'Sorry your appoinment wont reach us any time soon. Please try again next time';
            echo json_encode(array( 'status' => $status, 'msg_error'=> $message_alert,'msg' => $msg));
        }
    }


    function Insert_appointment_view($data) {
        
        $name_appointment   = $data['name_appointment'];
        $email_address      = $data['email_address'];
        $phone_number       = $data['phone_number'];
        $company_brand_name = $data['company_brand_name'];
        $services_need      = $data['services_need'];
        $describe_project   = $data['describe_project'];
        $meeting_date       = $data['meeting_date'];
        $meeting_date       = str_replace('/', '-', $meeting_date);
        $meeting_date       = date("Y-m-d H:i:s",strtotime($meeting_date));
        $location           = $data['location'];
        $today_time = date('Y-m-d H:i:s');

        //*
        $data = array(  'nama' => $name_appointment,
                        'email' => $email_address,
                        'telp' => $phone_number,
                        'namaPerusahaan' => $company_brand_name,
                        'category' => $services_need,
                        'appointmentDatetime' => $meeting_date,
                        'appointmentLocation' => $location,
                        'deskripsi' => $describe_project,
                        'isCancel' => '0',
                        'isSuccess' => '0',
                        'isActive' => 1,
                        'created' => $today_time,
                        'createdBy' => $name_appointment,
                        'lastUpdated' => $today_time,
                        'lastUpdatedBy' => $name_appointment
                        );
        $status = '';
        $msg = '';
        $this->load->model('appointment_model');
        $result = $this->appointment_model->insertAppoinment($data);

        if(count($result)==0){
            $status = 'Error';
            //$msg = 'Error to add an Appointment';
        }
        else {
            $status = 'Success';
            //$msg = 'Success to create an Appointment';
        }
        return $result;
        //*/
    }

}
?>
