<?php

class Test extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->helper('date');
        $this->load->library("pagination");
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->model('Tag_model');
    }

    function getTagListCms($start = 1)
    {

        $num_per_page = 10;
        $start = ($start - 1) * $num_per_page;
        $limit = $num_per_page;

        $tag_page = $this->Tag_model->getTagList($start, $limit);
        $count_tag = $this->Tag_model->getCountTagList();

        $config['base_url'] = site_url('be/Tag/getTagListCms');

        $config ['total_rows'] = $count_tag;
        $config ['per_page'] = $num_per_page;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);
        $data['pages'] = $this->pagination->create_links();
        $data['tag'] = $tag_page;

        if ($this->input->post('ajax')) {
            $this->load->view('article/test_view', $data);
        } else {
            $data['main_content'] = 'article/test_view';
            $this->load->view('be/includes/template_cms', $data);
        }
        //$this->output->enable_profiler(TRUE);
    }

    function createTag(){
        $status = "";
        $msg = "";

        $datetime = date('Y-m-d H:i:s', time());
        //get data form
        $name = $this->input->post('tagName');

        $data_tag=array(
            'tag'=>$this->input->post('tagName'),
            "createdBy" =>$this->session->userdata('username'),
            "lastUpdated"=>$datetime,
            "lastUpdatedBy"=>$this->session->userdata('username'),
            "isActive"=>1
        );

        if(!empty($_FILES)){
            $msg="ada";
            $files = count($_FILES['files']['name']);
            $msg = $files;
        }else{
            $msg="ga ada";
        }

        //save Data to DB
//        $this->db->trans_begin();
//        $query = $this->Tag_model->createTag($data_tag);
//
//        if ($this->db->trans_status() === FALSE) {
//            // Failed to save Data to DB
//            $this->db->trans_rollback();
//            $status = "error";
//            $msg = 'Error while saved Tag data!';
//        }
//        else {
//            if($query==1){
//                $this->db->trans_commit();
//                $status = 'success';
//                $msg = "tag has been created successfully";
//            }else{
//                // Error when last saved data ID not retrieve
//                $this->db->trans_rollback();
//                $status = "error";
//                $msg = "Failed to saved tag data!";
//            }
//        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }
}