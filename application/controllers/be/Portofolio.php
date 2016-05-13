<?php

Class Portofolio extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->helper('date');
        $this->load->library("pagination");
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->model('Portofolio_model');
        $this->load->library('authentication');
    }
    
    function getPortofolioListCms($start=1){

        if(!$this->authentication->isAuthorizeMember($this->session->userdata('level')))
        {
            redirect(site_url('be/dashboard/index'));
        }

        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;

        $portofolio_page = $this->Portofolio_model->getPortofolioList($start, $limit);
        $count_portofolio = $this->Portofolio_model ->getCountPortofolioList();

        $config['base_url']= site_url('be/Article/getPortofolioListCms');

        $config ['total_rows'] = $count_portofolio;
        $config ['per_page']=$num_per_page;
        $config['use_page_numbers']=TRUE;
        $config['uri_segment']=4;

        $this->pagination->initialize($config);
        $data['pages'] = $this->pagination->create_links();
        $data['portofolio']= $portofolio_page;

        if ($this->input->post('ajax')){
            $this->load->view('be/portofolio_list_cms_view', $data);
        }else{
            $data['main_content'] = 'be/portofolio_list_cms_view';
            $this->load->view('be/includes/template_cms', $data);
        }
        //$this->output->enable_profiler(TRUE);
    }

    function searchPortofolio($search_name="null00",$start=1){
        //parse_str($_SERVER['QUERY_STRING'],$_GET);

        $num_per_page = 10;
        $start=($start-1)*$num_per_page;
        $limit= $num_per_page;
        $search_param="";
        //$this->output->enable_profiler(TRUE);
        $total_seg = $this->uri->total_segments();
        if(!empty($_POST['search-text'])){
            $search_name = $this->input->post('search-text');
            $search_param = $search_name;
        }else{
            if($search_name=="null00"){
                $search_param="";
            }else{
                $search_param = $search_name;
            }
        }

        $result = $this->Portofolio_model->getPortofolioListBySearch($start, $limit, $search_param);
        $count_result=$this->Portofolio_model->countPortofolioListBySearch($search_param);

        $config['base_url'] = site_url('be/Portofolio/searchPortofolio/'.$search_name);
        $config['uri_segment'] = 5;
        $config['total_rows']= $count_result;
        $config['per_page'] =$num_per_page;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);

        $data['pages']=$this->pagination->create_links();
        $data['portofolio']= $result;
        $data['msg'] = null;
        $data['search_text'] = $search_param;

        if ($this->input->post('ajax')){
            $this->load->view('be/portofolio_list_cms_view', $data);
        }else{
            $data['main_content'] = 'be/portofolio_list_cms_view';
            $this->load->view('be/includes/template_cms', $data);
        }
    }

    // Create New Category
    function createPortofolio(){
        $status = "";
        $msg = "";

        $datetime = date('Y-m-d H:i:s', time());
        //get data form
        $desc = $this->input->post('portofolioDesc');

            $dir = "./img/portofolio/";
            //config upload Image
            $config['upload_path'] = $dir;
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 1024 * 5;
            $this->upload->initialize($config);

            //Upload Image
            if (!$this->upload->do_upload('img')) {
                // Upload Failed
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            } else {
                // Upload Success
                $data = $this->upload->data();
                $file_name = $data['file_name'];
                $data_portofolio = array(
                    'portofolioImgLink' => $file_name,
                    'description' => $this->input->post('portofolioDesc'),
                    'type' => $this->input->post('portofolioType'),
                    "createdBy" => $this->session->userdata('username'),
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $this->session->userdata('username'),
                    "isActive" => 1
                );

                //save Data to DB
                $this->db->trans_begin();
                $query = $this->Portofolio_model->createPortofolio($data_portofolio);

                if ($this->db->trans_status() === FALSE) {
                    // Failed to save Data to DB
                    $this->db->trans_rollback();
                    $status = "error";
                    $msg = 'Error while saved Portofolio data!';
                    unlink(base_url("img/portofolio/" . $file_name));
                } else {
                    if ($query == 1) {
                        $this->db->trans_commit();
                        $status = 'success';
                        $msg = "Portofolio has been created successfully";
                    } else {
                        // Error when last saved data ID not retrieve
                        $this->db->trans_rollback();
                        $status = "error";
                        $msg = "Failed to saved Portofolio data!";
                        unlink(base_url("img/portofolio/" . $file_name));
                    }
                }
            }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    // Update Article Category
    function updatePortofolio($id){
        $status = "";
        $msg = "";

        $datetime = date('Y-m-d H:i:s', time());
        //get data form
        $isUpdateImg = $this->input->post('isUpdateImg');
        $desc = $this->input->post('portofolioDesc');
        $type = $this->input->post('portofolioType');

            if ($isUpdateImg == 1) {
                $dir = "./img/portofolio/";
                //config upload Image
                $config['upload_path'] = $dir;
                $config['allowed_types'] = 'jpg|png';
                $config['max_size'] = 1024 * 5;
                $this->upload->initialize($config);

                //Upload Image
                if (!$this->upload->do_upload('img')) {
                    // Upload Failed
                    $status = 'error';
                    $msg = $this->upload->display_errors('', '');
                } else {
                    // Upload Success
                    $data = $this->upload->data();
                    $file_name = $data['file_name'];
                    $data_portofolio = array(
                        'portofolioImgLink' => $file_name,
                        'description' => $desc,
                        'type' => $type,
                        "lastUpdated" => $datetime,
                        "lastUpdatedBy" => $this->session->userdata('username')
                    );

                    //save Data to DB
                    $this->db->trans_begin();
                    $query = $this->Portofolio_model->updatePortofolio($data_portofolio, $id);

                    if ($this->db->trans_status() === FALSE) {
                        // Failed to save Data to DB
                        $this->db->trans_rollback();
                        $status = "error";
                        $msg = 'Error while updated portofolio data!';
                        unlink(base_url("img/portofolio/" . $file_name));
                    } else {
                        if ($query == 1) {
                            $this->db->trans_commit();
                            $status = 'success';
                            $msg = "Portofolio has been updated successfully";
                            
                        } else {
                            // Error when last saved data ID not retrieve
                            $this->db->trans_rollback();
                            $status = "error";
                            $msg = "Failed to updated Portofolio data!";
                            unlink(base_url("img/portofolio/" . $file_name));
                        }
                    }
                }
            } else {
                $data_portofolio = array(
                    'description' => $desc,
                    'type' => $type,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $this->session->userdata('username')
                );

                //save Data to DB
                $this->db->trans_begin();
                $query = $this->Portofolio_model->updatePortofolio($data_portofolio, $id);

                if ($this->db->trans_status() === FALSE) {
                    // Failed to save Data to DB
                    $this->db->trans_rollback();
                    $status = "error";
                    $msg = 'Error while updated portofolio data!';
                } else {
                    if ($query == 1) {
                        $this->db->trans_commit();
                        $status = 'success';
                        $msg = "portofolio has been updated successfully";
                    } else {
                        // Error when last saved data ID not retrieve
                        $this->db->trans_rollback();
                        $status = "error";
                        $msg = $query;
                    }
                }
            }
        
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    // Delete Article Category
    function deletePortofolio($id) {
        $status = "";
        $msg = "";

        $datetime = date('Y-m-d H:i:s', time());
        $data=array(
            "isActive"=>0,
            "lastUpdated"=>$datetime,
            "lastUpdatedBy"=>$this->session->userdata('username')
        );
        $this->db->trans_begin();
        $query = $this->Portofolio_model->updatePortofolio($data, $id);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $status="error";
            $msg = 'Error while deleted portofolio data !';
        } else {
            if($query==1){
                $this->db->trans_commit();
                $status="success";
                $msg = "This portofolio has been deleted successfully!";
            }else{
                $this->db->trans_rollback();
                $status="error";
                $msg = 'Failed to delete this portofolio!';
            }
        }

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }
    
    function test(){
        $msg = "This portofolio has been deleted successfully!";
        $status="success";
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }
}

?>