<?php
class Tag extends CI_Controller{
    
    function __construct(){
    parent::__construct();

    $this->load->helper(array('form', 'url'));
    $this->load->helper('date');
    $this->load->library("pagination");
    $this->load->library('form_validation');
    $this->load->library('upload');
    $this->load->model('Tag_model');
    $this->load->library('authentication');
    }
    
    function getTagListCms($start=1){

        if(!$this->authentication->isAuthorizeMember($this->session->userdata('level')))
        {
            redirect(site_url('be/dashboard/index'));
        }

        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;

        $tag_page = $this->Tag_model->getTagList($start, $limit);
        $count_tag = $this->Tag_model ->getCountTagList();

        $config['base_url']= site_url('be/Tag/getTagListCms');

        $config ['total_rows'] = $count_tag;
        $config ['per_page']=$num_per_page;
        $config['use_page_numbers']=TRUE;
        $config['uri_segment']=4;

        $this->pagination->initialize($config);
        $data['pages'] = $this->pagination->create_links();
        $data['tag']= $tag_page;

        if ($this->input->post('ajax')){
            $this->load->view('be/tag_list_cms_view', $data);
        }else{
            $data['main_content'] = 'be/tag_list_cms_view';
            $this->load->view('be/includes/template_cms', $data);
        }
        //$this->output->enable_profiler(TRUE);
    }
    
    function searchTag($search_name="null00",$start=1){
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
        $this->load->model('tag_model');
        $result = $this->tag_model->getTagListBySearch($start, $limit, $search_param);
        $count_result=$this->tag_model->countTagListBySearch($search_param);
        $config['base_url'] = site_url('be/Tag/searchTag/'.$search_name);
        $config['uri_segment'] = 5;
        $config['total_rows']= $count_result;
        $config['per_page'] =$num_per_page;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        $data['pages']=$this->pagination->create_links();
        $data['tag'] = $result;
        $data['msg'] = null;
        $data['search_text'] = $search_param;
        if ($this->input->post('ajax')){
            $this->load->view('be/tag_list_cms_view', $data);
        }else{
            $data['main_content'] = 'be/tag_list_cms_view';
            $this->load->view('be/includes/template_cms', $data);
        }
    }
    
    function createTag(){
        $status = "";
        $msg = "";

        $datetime = date('Y-m-d H:i:s', time());
        //get data form
        $tagName = $this->input->post('tagName');
        $checkTag = $this->Tag_model->checkUniqueTag($tagName, "ADD", 0);

        if($checkTag > 0){
            $status = "error";
            $msg = "Tag already exist";
        }else {
            $data_tag = array(
                'tag' => $tagName,
                "createdBy" => $this->session->userdata('username'),
                "lastUpdated" => $datetime,
                "lastUpdatedBy" => $this->session->userdata('username'),
                "isActive" => 1
            );

            //save Data to DB
            $this->db->trans_begin();
            $query = $this->Tag_model->createTag($data_tag);

            if ($this->db->trans_status() === FALSE) {
                // Failed to save Data to DB
                $this->db->trans_rollback();
                $status = "error";
                $msg = 'Error while saved Tag data!';
            } else {
                if ($query == 1) {
                    $this->db->trans_commit();
                    $status = 'success';
                    $msg = "tag has been created successfully";
                } else {
                    // Error when last saved data ID not retrieve
                    $this->db->trans_rollback();
                    $status = "error";
                    $msg = "Failed to saved tag data!";
                }
            }
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function updateTag($id){
        $status = "";
        $msg = "";

        $datetime = date('Y-m-d H:i:s', time());
        //get data form
        $tagName = $this->input->post('tagName');
        $checkTag = $this->Tag_model->checkUniqueTag($tagName, "UPDATE", $id);

        if($checkTag > 0){
            $status = "error";
            $msg = "Tag already exist";
        }else {
            $data_tag = array(
                'tag' => $tagName,
                "lastUpdated" => $datetime,
                "lastUpdatedBy" => $this->session->userdata('username')
            );

            //save Data to DB
            $this->db->trans_begin();
            $query = $this->Tag_model->updateTag($data_tag, $id);

            if ($this->db->trans_status() === FALSE) {
                // Failed to save Data to DB
                $this->db->trans_rollback();
                $status = "error";
                $msg = 'Error while updated Tag data!';
            } else {
                if ($query == 1) {
                    $this->db->trans_commit();
                    $status = 'success';
                    $msg = "Tag has been updated successfully";
                } else {
                    // Error when last saved data ID not retrieve
                    $this->db->trans_rollback();
                    $status = "error";
                    $msg = "Failed to updated tag data!";
                }
            }
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    function deleteTag($id) {
        $status = "";
        $msg = "";

        $datetime = date('Y-m-d H:i:s', time());
        $data=array(
            "isActive"=>0,
            "lastUpdated"=>$datetime,
            "lastUpdatedBy"=>$this->session->userdata('username')
        );
        $this->db->trans_begin();
        $query = $this->Tag_model->updateTag($data, $id);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $status="error";
            $msg = 'Error while deleted Tag data !';
        } else {
            if($query==1){
                $this->db->trans_commit();
                $status="success";
                $msg = "This Tag has been deleted successfully!";
            }else{
                $this->db->trans_rollback();
                $status="error";
                $msg = 'Failed to delete this Tag!';
            }
        }

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }
    
    
}
?>