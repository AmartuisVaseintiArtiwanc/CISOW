<?php

class Article extends CI_Controller{

    function __construct(){
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->helper('date');
        $this->load->library("pagination");
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->model('Article_model');
        $this->load->model('Article_category_model');
        $this->load->model('Tag_model');
        $this->load->model('Article_tag_model');
        $this->load->library('authentication');
    }

    /**
     * Article List
     */
    function getArticleListCms($start=1){

        if(!$this->authentication->isAuthorizeMember($this->session->userdata('level')))
        {
            redirect(site_url('be/dashboard/index'));
        }
        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;

        $article_page = $this->Article_model->getArticleList($start,$limit);
        $count_article = $this->Article_model ->getCountArticleList();

        $config['base_url']= site_url('be/Article/getArticleListCms');

        $config ['total_rows'] = $count_article;
        $config ['per_page']=$num_per_page;
        $config['use_page_numbers']=TRUE;
        $config['uri_segment']=3;

        $this->pagination->initialize($config);
        $data['pages'] = $this->pagination->create_links();
        $data['articles']= $article_page;
        $data['category'] = $this->Article_category_model->getArticleCategory();

        if ($this->input->post('ajax')){
            $this->load->view('be/article_list_cms_view', $data);
        }else{
            $data['main_content'] = 'be/article_list_cms_view';
            $this->load->view('be/includes/template_cms', $data);
        }
    }

    function searchArticle($search_title="null00",$search_category=0,$search_author="null00",$start=1){
        $num_per_page = 10;
        $start=($start-1)*$num_per_page;
        $limit= $num_per_page;
        $search_title_param="";
        $search_category_param="";
        $search_author_param="";

        if(!empty($_POST['search-title'])){
            $search_title = $this->input->post('search-title');
            $search_title_param = $search_title;
        }else{
            if($search_title=="null00"){
                $search_title_param="";
            }else{
                $search_title_param = $search_title;
            }
        }

        if(!empty($_POST['search-category'])){
            $search_category = $this->input->post('search-category');
            $search_category_param = $search_category;
        }else{
            if($search_category==0){
                $search_category_param="";
            }else{
                $search_category_param = $search_category;
            }
        }

        if(!empty($_POST['search-author'])){
            $search_author = $this->input->post('search-author');
            $search_author_param = $search_author;
        }else{
            if($search_author=="null00"){
                $search_author_param="";
            }else{
                $search_author_param = $search_author;
            }
        }

        $this->load->model('tag_model');
        $result = $this->Article_model->getArticleListBySearch($search_title_param, $search_category_param, $search_author_param,$start, $limit );
        $count_result=$this->Article_model->countArticleListBySearch($search_title_param, $search_category_param, $search_author_param);

        $config['base_url'] = site_url('be/Article/searchArticle/'.$search_title.'/'.$search_category.'/'.$search_author);
        $config['uri_segment'] = 7;
        $config['total_rows']= $count_result;
        $config['per_page'] =$num_per_page;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        $data['pages']=$this->pagination->create_links();

        $data['articles'] = $result;
        $data['category'] = $this->Article_category_model->getArticleCategory();
        $data['msg'] = null;

        $data['search_title'] = $search_title_param;
        $data['search_category'] = $search_category_param;
        $data['search_author'] = $search_author_param;

        if ($this->input->post('ajax')){
            $this->load->view('be/article_list_cms_view', $data);
        }else{
            $data['main_content'] = 'be/article_list_cms_view';
            $this->load->view('be/includes/template_cms', $data);
        }
    }

    // Article Add View
    function getArticleAddView(){
        if(!$this->authentication->isAuthorizeMember($this->session->userdata('level')))
        {
            redirect(site_url('be/dashboard/index'));
        }

        $category = $this ->Article_category_model->getArticleCategoryList(null,null);
        $tag = $this->Tag_model->getTagList(null,null);

        $data['category'] = $category;
        $data['tag'] = $tag;
        $data['article']= null;
        $data['article_tags']= null;
        $data['main_content'] = 'be/article_add_edit_cms_view';
        $this->load->view('be/includes/template_cms', $data);
    }

    // Article Edit View
    function getArticleEditView($id){
        if(!$this->authentication->isAuthorizeMember($this->session->userdata('level')))
        {
            redirect(site_url('be/dashboard/index'));
        }

        $category = $this ->Article_category_model->getArticleCategoryList(null,null);
        $article = $this ->Article_model->getArticleDetail($id);
        $tag = $this->Tag_model->getTagList(null,null);
        $data_article_tag = $this->Article_tag_model->getArticleTagByArticle($id);
        $article_tags = [];
        foreach($data_article_tag as $row){
           array_push($article_tags,$row['tagID']);
        }

        $data['category'] = $category;
        $data['tag'] = $tag;
        $data['article']= $article;
        $data['article_tags']= $article_tags;
        $data['main_content'] = 'be/article_add_edit_cms_view';
        $this->load->view('be/includes/template_cms', $data);
    }


    // Create New Article
    function createArticle(){
        $status = "";
        $msg="";
        $productID="";
        $datetime = date('Y-m-d H:i:s', time());

        //get data form
        $title = $this->input->post('title');
        $category = $this->input->post('category');
        $desc = $this->input->post('desc');
        $content = $this->input->post('content');
        $filename = $_FILES['img']['name'];
        $tags = json_decode($this->input->post('tags'));
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        //set Data for insert to DB
        $data_article=array(
            "title"=>$title,
            "categoryID"=>$category,
            "authorID"=>$this->session->userdata('user_id'),
            "articleImgLink"=> "default.".$ext,
            "description"=>$desc,
            "content"=>$content,
            "view"=>0,
            "created" => $datetime,
            "createdBy" => $this->session->userdata('username'),
            "lastUpdated"=>$datetime,
            "lastUpdatedBy"=>$this->session->userdata('username'),
            "isActive"=>1
        );

        //save Data to DB
        $this->db->trans_begin();
        $query = $this->Article_model->createArticle($data_article);

        if ($this->db->trans_status() === FALSE) {
            // Failed to save Data to DB
            $this->db->trans_rollback();
            $status = "error";
            $msg="Error while saved data!";
        }
        else {
            //Prepare for upload image
            if($query != null || $query != ""){
                //create folder with saved id
                $dir = "./img/article/".$query;
                if(file_exists($dir)!=1)
                {
                    mkdir($dir);
                }

                //config upload Image
                $config['upload_path'] = $dir;
                $config['allowed_types'] = 'jpg|png';
                $config['max_size'] = 1024 * 5;
                $config['file_name'] = "default";
                $config['overwrite'] = 'TRUE';

                $this->upload->initialize($config);

                //Upload Image
                if (!$this->upload->do_upload('img'))
                {
                    // Upload Failed
                    $this->db->trans_rollback();
                    $status = 'error';
                    $msg = $this->upload->display_errors('', '');
                }
                else {
                    // Upload Success
                    $img = $this->upload->data();
                    $file_img_name = $img['file_name'];

                    //Tag Article
                    foreach($tags as $row){
                        $data_tag=array(
                            "articleID"=>$query,
                            "tagID"=>$row,
                            "created" => $datetime,
                            "createdBy" => $this->session->userdata('username'),
                            "lastUpdated"=>$datetime,
                            "lastUpdatedBy"=>$this->session->userdata('username'),
                            "isActive"=>1
                        );
                        $this->Article_tag_model->createArticleTag($data_tag);
                    }
                    $this->db->trans_commit();
                    $status = 'success';
                    $msg = "File has been save successfully";
                }
            }else{
                // Error when last saved data ID not retrieve
                $this->db->trans_rollback();
                $status = "error";
                $msg="Failed to save data";
            }
        }
        // return message to AJAX
        echo json_encode(array('status' => $status, 'msg' => $msg, 'tag'=>$tags));
    }

    // Update Article
    function updateArticle($id){
        $status = "";
        $msg="";
        $datetime = date('Y-m-d H:i:s', time());

        //get data form
        $title = $this->input->post('title');
        $category = $this->input->post('category');
        $desc = $this->input->post('desc');
        $content = $this->input->post('content');
        $isUpdateImg = $this->input->post('isUpdateImg');
        $isUpdateContent = $this->input->post('isUpdateContent');
        $newTags = json_decode($this->input->post('newTags'));
        $delTags = json_decode($this->input->post('delTags'));

        foreach($newTags as $row) {
            $data_tag = array(
                "articleID" => $id,
                "tagID" => $row,
                "created" => $datetime,
                "createdBy" => $this->session->userdata('username'),
                "lastUpdated" => $datetime,
                "lastUpdatedBy" => $this->session->userdata('username'),
                "isActive" => 1
            );
            $this->Article_tag_model->createArticleTag($data_tag);
        }
        foreach($delTags as $row) {
            $this->Article_tag_model->deleteArticleTag($id,$row);
        }

        //create folder with saved id
        $dir = "./img/article/".$id;

        if($isUpdateImg == 1) {
            //config upload Image
            $config['upload_path'] = $dir;
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 1024 * 5;
            $config['file_name'] = "default";
            $config['overwrite'] = 'TRUE';

            $this->upload->initialize($config);

            //Upload Image
            if (!$this->upload->do_upload('img')) {
                // Upload Failed
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            } else {
                // Upload Success
                $img = $this->upload->data();
                $file_img_name = $img['file_name'];
                $data_article['articleImgLink'] = $file_img_name;
                $status = 'success';
                $msg = "File has been save successfully";
            }
        }

        //set Data for update to DB
        $data_article['title']=$title;
        $data_article['categoryID']=$category;
        $data_article['content']=$content;
        $data_article['description']=$desc;
        $data_article['lastUpdated']=$datetime;
        $data_article['lastUpdatedBy']=$this->session->userdata('username');

        //update Data to DB
        $this->db->trans_begin();
        $query = $this->Article_model->updateArticle($data_article, $id);

        if ($this->db->trans_status() === FALSE) {
            // Failed to save Data to DB
            $this->db->trans_rollback();
            $status = "error";
            $msg="Error while updated data!";
        }
        else {
            //Prepare for upload image
            if($query == 1){
                $this->db->trans_commit();
                $status = 'success';
                $msg = "File has been updated successfully";
            }else{
                // Error when last saved data ID not retrieve
                $this->db->trans_rollback();
                $status = "error";
                $msg="Failed to updated data";
            }
        }
        // return message to AJAX
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    //Delete Article
    function deleteArticle(){
        $status = "";
        $msg="";
        $datetime = date('Y-m-d H:i:s', time());

        $id = $this->input->post('articleID');

        $data_article=array(
            "lastUpdated"=>$datetime,
            "lastUpdatedBy"=>$this->session->userdata('username'),
            "isActive"=>0
        );

        //update Data to DB
        $this->db->trans_begin();
        $query = $this->Article_model->updateArticle($data_article, $id);

        if ($this->db->trans_status() === FALSE) {
            // Failed to save Data to DB
            $this->db->trans_rollback();
            $status = "error";
            $msg="Error while updated data!";
        }
        else {
            //Prepare for upload image
            if($query == 1){
                $this->db->trans_commit();
                $status = 'success';
                $msg = "File has been deleted successfully";
            }else{
                // Error when last saved data ID not retrieve
                $this->db->trans_rollback();
                $status = "error";
                $msg="Failed to deleted data";
            }
        }
        // return message to AJAX
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    // Article Category List
    function getCategoryArticleListCms($start=1){

        if(!$this->authentication->isAuthorizeMember($this->session->userdata('level')))
        {
            redirect(site_url('be/dashboard/index'));
        }

        $num_per_page = 10;
        $start = ($start - 1)* $num_per_page;
        $limit = $num_per_page;

        $category_page = $this->Article_category_model->getArticleCategoryList($start, $limit);
        $count_category = $this->Article_category_model ->getCountArticleCategoryList();

        $config['base_url']= site_url('be/Article/getCategoryArticleListCms');

        $config ['total_rows'] = $count_category;
        $config ['per_page']=$num_per_page;
        $config['use_page_numbers']=TRUE;
        $config['uri_segment']=4;

        $this->pagination->initialize($config);
        $data['pages'] = $this->pagination->create_links();
        $data['categories']= $category_page;

        if ($this->input->post('ajax')){
            $this->load->view('be/article_category_list_cms_view', $data);
        }else{
            $data['main_content'] = 'be/article_category_list_cms_view';
            $this->load->view('be/includes/template_cms', $data);
        }
        //$this->output->enable_profiler(TRUE);
    }

    function searchCategory($search_name="null00",$start=1){
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

        $result = $this->Article_category_model->getCategoryListBySearch($start, $limit, $search_param);
        $count_result=$this->Article_category_model->countCategoryListBySearch($search_param);

        $config['base_url'] = site_url('be/Article/searchCategory/'.$search_name);
        $config['uri_segment'] = 5;
        $config['total_rows']= $count_result;
        $config['per_page'] =$num_per_page;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);

        $data['pages']=$this->pagination->create_links();
        $data['categories']= $result;
        $data['msg'] = null;
        $data['search_text'] = $search_param;

        if ($this->input->post('ajax')){
            $this->load->view('be/article_category_list_cms_view', $data);
        }else{
            $data['main_content'] = 'be/article_category_list_cms_view';
            $this->load->view('be/includes/template_cms', $data);
        }
    }

    // Create New Category
    function createCategory(){
        $status = "";
        $msg = "";

        $datetime = date('Y-m-d H:i:s', time());
        //get data form
        $name = $this->input->post('categoryName');
        $checkCategory = $this->Article_category_model->checkUniqueCategory($name,"ADD",0);

        if($checkCategory > 0){
            $status = "error";
            $msg = "Category already exist";
        }else {
            $dir = "./img/category/";
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
                $data_category = array(
                    'category' => $this->input->post('categoryName'),
                    'categoryImgLink' => $file_name,
                    "createdBy" => $this->session->userdata('username'),
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $this->session->userdata('username'),
                    "isActive" => 1
                );

                //save Data to DB
                $this->db->trans_begin();
                $query = $this->Article_category_model->createCategory($data_category);

                if ($this->db->trans_status() === FALSE) {
                    // Failed to save Data to DB
                    $this->db->trans_rollback();
                    $status = "error";
                    $msg = 'Error while saved category data!';
                    unlink(base_url("img/category/" . $file_name));
                } else {
                    if ($query == 1) {
                        $this->db->trans_commit();
                        $status = 'success';
                        $msg = "Category has been created successfully";
                    } else {
                        // Error when last saved data ID not retrieve
                        $this->db->trans_rollback();
                        $status = "error";
                        $msg = "Failed to saved category data!";
                        unlink(base_url("img/category/" . $file_name));
                    }
                }
            }
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    // Update Article Category
    function updateCategory($id){
        $status = "";
        $msg = "";

        $datetime = date('Y-m-d H:i:s', time());
        //get data form
        $name = $this->input->post('categoryName');
        $isUpdateImg = $this->input->post('isUpdateImg');
        $checkCategory = $this->Article_category_model->checkUniqueCategory($name,"UPDATE",$id);

        if($checkCategory > 0){
            $status = "error";
            $msg = "Category already exist";
        }else {
            if ($isUpdateImg == 1) {
                $dir = "./img/category/";
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
                    $data_category = array(
                        'category' => $name,
                        'categoryImgLink' => $file_name,
                        "lastUpdated" => $datetime,
                        "lastUpdatedBy" => $this->session->userdata('username')
                    );

                    //save Data to DB
                    $this->db->trans_begin();
                    $query = $this->Article_category_model->updateCategory($data_category, $id);

                    if ($this->db->trans_status() === FALSE) {
                        // Failed to save Data to DB
                        $this->db->trans_rollback();
                        $status = "error";
                        $msg = 'Error while updated category data!';
                        unlink(base_url("img/category/" . $file_name));
                    } else {
                        if ($query == 1) {
                            $this->db->trans_commit();
                            $status = 'success';
                            $msg = "Category has been updated successfully";
                        } else {
                            // Error when last saved data ID not retrieve
                            $this->db->trans_rollback();
                            $status = "error";
                            $msg = "Failed to updated category data!";
                            unlink(base_url("img/category/" . $file_name));
                        }
                    }
                }
            } else {
                $data_category = array(
                    'category' => $name,
                    "lastUpdated" => $datetime,
                    "lastUpdatedBy" => $this->session->userdata('username')
                );

                //save Data to DB
                $this->db->trans_begin();
                $query = $this->Article_category_model->updateCategory($data_category, $id);

                if ($this->db->trans_status() === FALSE) {
                    // Failed to save Data to DB
                    $this->db->trans_rollback();
                    $status = "error";
                    $msg = 'Error while updated category data!';
                } else {
                    if ($query == 1) {
                        $this->db->trans_commit();
                        $status = 'success';
                        $msg = "Category has been updated successfully";
                    } else {
                        // Error when last saved data ID not retrieve
                        $this->db->trans_rollback();
                        $status = "error";
                        $msg = "Failed to updated category data!";
                    }
                }
            }
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }

    // Delete Article Category
    function deleteCategory($id) {
        $status = "";
        $msg = "";

        $datetime = date('Y-m-d H:i:s', time());
        $data=array(
            "isActive"=>0,
            "lastUpdated"=>$datetime,
            "lastUpdatedBy"=>$this->session->userdata('username')
        );
        $this->db->trans_begin();
        $query = $this->Article_category_model->updateCategory($data, $id);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $status="error";
            $msg = 'Error while deleted category data !';
        } else {
            if($query==1){
                $this->db->trans_commit();
                $status="success";
                $msg = "This category has been deleted successfully!";
            }else{
                $this->db->trans_rollback();
                $status="error";
                $msg = 'Failed to delete this category!';
            }
        }

        echo json_encode(array('status' => $status, 'msg' => $msg));
    }




}

?>