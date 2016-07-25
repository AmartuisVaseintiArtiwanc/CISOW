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

        $this->load->model('Article_tag_model');



    }



    /*

     * Article Home

     * */

    function index(){



        $latest_post_data= $this -> Article_model->getLatestPost();

        $data['latest_post_data'] = $latest_post_data;



        $category = $this ->Article_category_model->getArticleCategory();



        $article_per_category = array();



        foreach($category as $row){

            $category_id =$row['categoryID'];

            $article_list = $this->Article_model->getArticleByCategory($category_id);



            $data_article = array(

                "categoryID"=>$row['categoryID'],

                "categoryName"=>$row['category'],

                "listArticle"=>$article_list

            );



            array_push($article_per_category,$data_article);

        }



        $data['article_data'] = $article_per_category;

        $data['main_content'] = 'fe/article_home_view';

        $this->load->view('fe/includes/template_article', $data);

    }



    function homeArticleParallax(){



        $latest_post_data= $this -> Article_model->getLatestPost();

        $data['latest_post_data'] = $latest_post_data;



        $category_home= $this -> Article_category_model->getArticleCategory();

        $data['category_home'] = $category_home;



        $category = $this ->Article_category_model->getArticleCategory();



        $article_per_category = array();



        foreach($category as $row){

            $category_id =$row['categoryID'];

            $article_list = $this->Article_model->getArticleByCategory($category_id);



            $data_article = array(

                "categoryID"=>$row['categoryID'],

                "categoryName"=>$row['category'],

                "listArticle"=>$article_list

            );



            array_push($article_per_category,$data_article);

        }



        $data['article_data'] = $article_per_category;

        $this->load->view('fe/article_home_parallax_view', $data);

    }



    /*

     * Article List

     * */



    function lastArticleList($start=1){



        $num_per_page = 10;

        $start = ($start - 1)* $num_per_page;

        $limit = $num_per_page;



        $latest_post_page = $this -> Article_model->getLatestPostPage($start, $limit);

        $count_latest_post = $this -> Article_model ->getCountLatestPost();



        $config['base_url']= site_url('fe/Article/lastArticleList');

        $config['total_rows'] = $count_latest_post;

        $config['per_page']=$num_per_page;

        $config['use_page_numbers']=TRUE;

        $this->pagination->initialize($config);

        $data['pages'] = $this->pagination->create_links();



        // Data Master Category

        $category = $this ->Article_category_model->getArticleCategory();

        // More Article

        $articleTemp = array();

        array_push($articleTemp,0);

        foreach($latest_post_page as $row){

            array_push($articleTemp,$row['articleID']);

        }

        $more_article = $this->Article_model->getMoreArticle($articleTemp);

        $data['title_tag'] = "Artikel Terbaru";

        $data['articles']= $latest_post_page;

        $data['dataCategory'] = $category;

        $data['moreArticles']=$more_article;

        $data['category'] = '';



        $data['main_content'] = 'fe/article_list_view';

        $this->load->view('fe/includes/template_article', $data);

        //$this->load->view('article/article_list_view');

    }



    function popular(){



        $popular_page = $this -> Article_model->getPopularArticle(10);



        // Data Master Category

        $category = $this ->Article_category_model->getArticleCategory();

        // More Article

        $articleTemp = array();

        array_push($articleTemp,0);

        foreach($popular_page as $row){

            array_push($articleTemp,$row['articleID']);

        }

        $more_article = $this->Article_model->getMoreArticle($articleTemp);



        $data['title_tag'] = "Artikel Populer";

        $data['articles']= $popular_page;

        $data['dataCategory'] = $category;

        $data['moreArticles']=$more_article;

        $data['category'] = '';



        $data['main_content'] = 'fe/article_popular_view';

        $this->load->view('fe/includes/template_article', $data);

        //$this->load->view('article/article_list_view');

    }



    function articleCategory($category_name,$start=1){



        $num_per_page = 10;

        $start = ($start - 1)* $num_per_page;

        $limit = $num_per_page;



        $category_post_page = $this -> Article_model->getArticleByCategoryPage($start, $limit,$category_name);

        $count_category_post = $this -> Article_model ->getCountArticleByCategory($category_name);



        $config['base_url']= site_url('fe/Article/articleListByCategory/'.$category_name);

        $config['total_rows'] = $count_category_post;

        $config['per_page']=$num_per_page;

        $config['use_page_numbers']=TRUE;

        $config['uri_segment']=5;

        $this->pagination->initialize($config);

        $data['pages'] = $this->pagination->create_links();



        // Data Master Category

        $category = $this ->Article_category_model->getArticleCategory();

        // More Article

        $articleTemp = array();

        array_push($articleTemp,0);

        foreach($category_post_page as $row){

            array_push($articleTemp,$row['articleID']);

        }

        $more_article = $this->Article_model->getMoreArticle($articleTemp);



        $data['title_tag'] = "Kategori Artikel | ".$category_name;

        $data['articles']= $category_post_page;

        $data['moreArticles']=$more_article;

        $search_name = "Kategori : ".$category_name;

        $data['dataCategory'] = $category;

        $data['category'] = $search_name;



        $data['main_content'] = 'fe/article_list_view';

        $this->load->view('fe/includes/template_article', $data);

        //$this->load->view('article/article_list_view');

    }



    function articleListSearch($search_name='null00',$start=1){

        $num_per_page = 10;

        $start = ($start - 1)* $num_per_page;

        $limit = $num_per_page;



        $search_param="";

        if(!empty($_GET['search'])){

            $search_name = $this->input->get('search');

            $search_param = $search_name;

        }else{

            if($search_name=="null00"){

                $search_param="";

            }else{

                $search_param = $search_name;

            }

        }

        $category_post_page = $this -> Article_model->getArticleSearch($start, $limit,$search_param);

        $count_category_post = $this -> Article_model ->getCountArticleSearch($search_param);




        $data['title_tag'] = "Cari Artikel | ".$search_name;

        $config['base_url']= site_url('fe/Article/articleListSearch/'.$search_name);

        $config['total_rows'] = $count_category_post;

        $config['per_page']=$num_per_page;

        $config['use_page_numbers']=TRUE;

        $config['uri_segment']=5;

        $this->pagination->initialize($config);

        $data['pages'] = $this->pagination->create_links();


        // Data Master Category

        $category = $this ->Article_category_model->getArticleCategory();

        // More Article

        $articleTemp = array();

        array_push($articleTemp,0);

        foreach($category_post_page as $row){

            array_push($articleTemp,$row['articleID']);

        }

        $more_article = $this->Article_model->getMoreArticle($articleTemp);



        $data['articles']= $category_post_page;

        $data['moreArticles']=$more_article;

        $data['dataCategory'] = $category;



        if($search_name=="null00"){

            $search_name = "Latest Post";

        }else{

            $search_name = "Hasil Pencarian \"".$search_name."\"";

        }

        $data['category'] = $search_name;



        $data['main_content'] = 'fe/article_list_view';

        $this->load->view('fe/includes/template_article', $data);

    }



    /*

     * Article Tags

     * */

     function articleTag($tag_name,$start=1){



        $num_per_page = 10;

        $start = ($start - 1)* $num_per_page;

        $limit = $num_per_page;


        
        $tag_name = str_replace("-"," ",$tag_name);

        $tag_post_page = $this -> Article_model->getTagPostPage($start, $limit,$tag_name);

        $count_tag_post = $this -> Article_model ->getCountTagPost($tag_name);



        $config['base_url']= site_url('fe/Article/articleByTags/'.$tag_name);

        $config['total_rows'] = $count_tag_post;

        $config['per_page']=$num_per_page;

        $config['use_page_numbers']=TRUE;

        $config['uri_segment']=5;

        $this->pagination->initialize($config);

        $data['pages'] = $this->pagination->create_links();



        // Data Master Category

        $category = $this ->Article_category_model->getArticleCategory();

         // More Article

        $articleTemp = array();

         array_push($articleTemp,0);

        foreach($tag_post_page as $row){

            array_push($articleTemp,$row['articleID']);

        }

        $more_article = $this->Article_model->getMoreArticle($articleTemp);



        $data['title_tag'] = "Tag Artikel | ".$tag_name;

        $data['articles']= $tag_post_page;

        $data['moreArticles']=$more_article;

        $search_name = "Tag : ".$tag_name;

        $data['category'] = $search_name;

        $data['dataCategory'] = $category;



        $data['main_content'] = 'fe/article_list_view';

        $this->load->view('fe/includes/template_article', $data);

        //$this->load->view('article/article_list_view');



    }

    /*

     * Article Author

     * */

     function articleAuthor($author_name,$start=1){



        $num_per_page = 10;

        $start = ($start - 1)* $num_per_page;

        $limit = $num_per_page;

        $author_name = str_replace("-"," ",$author_name);

        $author_post_page = $this -> Article_model->getAuthorPostPage($start, $limit,$author_name);

        $count_author_post = $this -> Article_model ->getCountAuthorPost($author_name);



        $config['base_url']= site_url('fe/Article/articleByAuthor/'.$author_name);

        $config['total_rows'] = $count_author_post;

        $config['per_page']=$num_per_page;

        $config['use_page_numbers']=TRUE;

        $config['uri_segment']=5;

        $this->pagination->initialize($config);

        $data['pages'] = $this->pagination->create_links();



        // Data Master Category

        $category = $this ->Article_category_model->getArticleCategory();

        // More Article

        $articleTemp = array();

        array_push($articleTemp,0);

        foreach($author_post_page as $row){

            array_push($articleTemp,$row['articleID']);

        }

        $more_article = $this->Article_model->getMoreArticle($articleTemp);


        $data['title_tag'] = "Pembuat Artikel | ".$author_name;

        $data['articles']= $author_post_page;

        $data['moreArticles']=$more_article;

        $search_name = "Author : ".$author_name;

        $data['category'] = $search_name;

        $data['dataCategory'] = $category;



        $data['main_content'] = 'fe/article_list_view';

        $this->load->view('fe/includes/template_article', $data);

        //$this->load->view('article/article_list_view');



    }

    /*

     * Article Detail

     * */

    function getArticleDetail($id_or_title)

    {


        $num_per_page = 5;

        $start = (1 - 1)* $num_per_page;

        $limit = $num_per_page;

        if(is_numeric($id_or_title)) {
            //echo "<br><br><br><br><br><br><br><br>hahah: ";
            $article =  $this->Article_model->getArticleDetailbyId($id_or_title);
            //echo " <br> : ".$article->title." <br>";
            //$this->getArticleDetail($article->title);
            //exit();
        } else {
            $id_or_title = $this->security->xss_clean($id_or_title);
            $id_or_title = str_replace("(-)",'"',$id_or_title);
            $id_or_title = str_replace("-"," ",$id_or_title);
            $article =  $this->Article_model->getArticleDetailbyTitle($id_or_title);
        }


        // GET ID ARTICLE
        $id = $article->articleID;

        $tags = $this->Article_tag_model->getArticleTagByArticle($id);

        $related_article= $this->Article_model->getRelatedArticle($id);

        $comment = $this -> Article_model->getArticleComments($start,$limit,$id);

        $count_comment = $this -> Article_model ->getCountArticleComments($id);



        $config['base_url']= site_url('fe/Article/getArticleComment/'.$id);

        $config ['total_rows'] = $count_comment;

        $config ['per_page']=$num_per_page;

        $config['use_page_numbers']=TRUE;

        $config['uri_segment']=5;



        $this->pagination->initialize($config);

        $data['pages'] = $this->pagination->create_links();



        // More Article

        $articleTemp = array();

        array_push($articleTemp,0);

        array_push($articleTemp,$id);

        $more_article = $this->Article_model->getMoreArticle($articleTemp);


        $data['title_tag'] = "Artikel | ".$article->title_url_clean;

        $data['data_article'] = $article;

        $data['moreArticles']=$more_article;

        $data['data_tag'] = $tags;

        $data['data_comment'] = $comment;

        $data['related_article'] = $related_article;

        $data['main_content'] = 'fe/article_detail_view';

        //var_dump($data);

        $this->load->view('fe/includes/template_article', $data);

        //$this->output->enable_profiler(TRUE);



        if($article != null) {

            $data_article = array(

                "view" => $article->view + 1

            );

            //update View to DB

            $query = $this->Article_model->updateArticle($data_article, $id);

        }

    }



    function getArticleComment($id, $start=1){

        $num_per_page = 5;

        $start = ($start - 1)* $num_per_page;

        $limit = $num_per_page;



        $comment = $this -> Article_model->getArticleComments($start,$limit,$id);

        $count_comment = $this -> Article_model ->getCountArticleComments($id);



        $config['base_url']= site_url('fe/Article/getArticleComment/'.$id);

        $config ['total_rows'] = $count_comment;

        $config ['per_page']=$num_per_page;

        $config['use_page_numbers']=TRUE;

        $config['uri_segment']=5;



        $this->pagination->initialize($config);

        $data['pages'] = $this->pagination->create_links();

        $data['data_comment'] = $comment;



        $this->load->view('fe/article_comment_page', $data);



    }



    function insertComment($id){

        $datetime = date('Y-m-d H:i:s', time());

        $status = "";

        $msg = "";



        $insert_data_comment=array(

            'name'=>$this->input->post('name'),

            'email'=>$this->input->post('email'),

            'comment'=>$this->input->post('comment'),

            'articleID'=>$id,

            'isAdmin'=>0,

            'isActive'=>1,

            'created'=>$datetime,

            "createdBy" => $this->input->post('name'),

            "lastUpdated"=>$datetime,

            "lastUpdatedBy"=>$this->input->post('name')

        );

        $this->db->trans_begin();

        $query = $this->Article_model->insertComment($insert_data_comment);



        if ($this->db->trans_status() === FALSE) {

            // Failed to save Data to DB

            $this->db->trans_rollback();

            $status = "error";

            $msg = 'Error while saved comment!';

        }

        else {

            if($query==1){

                $this->db->trans_commit();

                $status = 'success';

                $msg = "Your Comment has been saved successfully";

            }else{

                // Error when last saved data ID not retrieve

                $this->db->trans_rollback();

                $status = "error";

                $msg = "Failed to saved comment data!";

            }

        }

        echo json_encode(array('status' => $status, 'msg' => $msg));

    }



    function insertCommentAdmin($id){

        $datetime = date('Y-m-d H:i:s', time());

        $name = $this->session->userdata('username');

        $status = "";

        $msg = "";



        $insert_data_comment=array(

            'name'=>$name,

            'email'=>$name,

            'comment'=>$this->input->post('comment'),

            'articleID'=>$id,

            'isAdmin'=>1,

            'isActive'=>1,

            'created'=>$datetime,

            "createdBy" =>$name,

            "lastUpdated"=>$datetime,

            "lastUpdatedBy"=>$name

        );

        $this->db->trans_begin();

        $query = $this->Article_model->insertComment($insert_data_comment);



        if ($this->db->trans_status() === FALSE) {

            // Failed to save Data to DB

            $this->db->trans_rollback();

            $status = "error";

            $msg = 'Error while saved comment!';

        }

        else {

            if($query==1){

                $this->db->trans_commit();

                $status = 'success';

                $msg = "Your Comment has been saved successfully";

            }else{

                // Error when last saved data ID not retrieve

                $this->db->trans_rollback();

                $status = "error";

                $msg = "Failed to saved comment data!";

            }

        }

        echo json_encode(array('status' => $status, 'msg' => $msg));

    }



    function AllViewArticle(){

      $this->load->view('fe/all_article_view');

    }



}



?>

