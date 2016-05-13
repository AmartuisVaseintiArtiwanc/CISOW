<?php

    class Article_model extends CI_Model{
       
        
        function getLatestPost(){
            $this->db->select('*');
            $this->db->from('tbl_cyberits_t_articles a');
            $this->db->join('tbl_cyberits_m_categories b', 'a.categoryID = b.categoryID');
            $this->db->where('a.isActive', 1);
            $this->db->order_by('a.Created','desc');
            $this->db->limit('4');
            $query = $this->db->get();
            return $query->result_array();
             
        }
        
        function getArticleByCategory($categoryID){
            $this->db->select('a.categoryID as categoryID, category, articleID, title, articleImgLink, a.created as created');
            $this->db->from('tbl_cyberits_t_articles a');
            $this->db->join('tbl_cyberits_m_categories b', 'a.categoryID = b.categoryID');
            $this->db->where('a.isActive', 1);
            $this->db->where('a.categoryID', $categoryID);
            $this->db->order_by('a.Created','desc');
            $this->db->limit('4');
            $query = $this->db->get();
            return $query->result_array();
             
        }
        
        //William
        
        function getLatestPostPage($start, $limit){
            $this->db->select('a.categoryID as categoryID, category, articleID, title, 
            description,
            articleImgLink, a.created as created');
            $this->db->from('tbl_cyberits_t_articles a');
            $this->db->join('tbl_cyberits_m_categories b', 'a.categoryID = b.categoryID');
            $this->db->where('a.isActive', 1);
            $this->db->order_by('a.Created','desc');
            
            if($limit != null || $start!= null){
                $this->db->limit($limit,$start);    
            }
            $query = $this->db->get();
            return $query->result_array();
            
        }
        
        function getCountLatestPost(){
            $this->db->from('tbl_cyberits_t_articles a');
            return $this->db->count_all_results();
        }
        
        function getArticleByCategoryPage($start, $limit, $categoryName){
            $this->db->select('a.categoryID as categoryID, category, articleID, title, 
            description,
            articleImgLink, a.created as created');
            $this->db->from('tbl_cyberits_t_articles a');
            $this->db->join('tbl_cyberits_m_categories b', 'a.categoryID = b.categoryID');
            $this->db->where('a.isActive', 1);
            $this->db->where('b.category',$categoryName);
            $this->db->order_by('a.Created','desc');
            
            if($limit != null || $start!= null){
                $this->db->limit($limit,$start);    
            }
            $query = $this->db->get();
            return $query->result_array();
            
        }
        
        function getCountArticleByCategory($categoryName){
            $this->db->from('tbl_cyberits_t_articles a');
            $this->db->join('tbl_cyberits_m_categories b', 'a.categoryID = b.categoryID');
            $this->db->where('b.category',$categoryName);
            return $this->db->count_all_results();
        }
        
        function getArticleSearch($start, $limit, $search_name){
            $this->db->select('a.categoryID as categoryID, category, articleID, title, 
            description,
            articleImgLink, a.created as created');
            $this->db->from('tbl_cyberits_t_articles a');
            $this->db->join('tbl_cyberits_m_categories b', 'a.categoryID = b.categoryID');
            $this->db->where('a.isActive', 1);
            $this->db->like('a.title',$search_name);
            $this->db->order_by('a.Created','desc');
            
            if($limit != null || $start!= null){
                $this->db->limit($limit,$start);    
            }
            $query = $this->db->get();
            return $query->result_array();
            
        }
        
        function getCountArticleSearch($search_name){
            $this->db->from('tbl_cyberits_t_articles a');
            $this->db->like('a.title',$search_name);
            return $this->db->count_all_results();
        }   
             
        /*
         * Tag William
         * */
         function getTagPostPage($start, $limit,$tagName){
            $this->db->select('b.tagID as tagID, a.articleID, title, 
            description, category, a.categoryID,
            articleImgLink, a.created as created');
            $this->db->from('tbl_cyberits_t_articles a');
            $this->db->join('tbl_cyberits_s_articles_tags b', 'a.articleID = b.articleID');
            $this->db->join('tbl_cyberits_m_tags c', 'c.tagID = b.tagID');
            $this->db->join('tbl_cyberits_m_categories d', 'a.categoryID = d.categoryID');
            $this->db->where('a.isActive', 1);
            $this->db->where('c.tag', $tagName);
            $this->db->order_by('a.Created','desc');
            
            if($limit != null || $start!= null){
                $this->db->limit($limit,$start);    
            }
            $query = $this->db->get();
            return $query->result_array();
        }
        
        function getCountTagPost($tagName){
            $this->db->from('tbl_cyberits_t_articles a');
            $this->db->join('tbl_cyberits_s_articles_tags b', 'a.articleID = b.articleID');
            $this->db->join('tbl_cyberits_m_tags c', 'c.tagID = b.tagID');
            $this->db->where('a.isActive', 1);
            $this->db->where('c.tag', $tagName);
            return $this->db->count_all_results();
        }

        /*
         * List Author William
         * */
        function getAuthorPostPage($start, $limit,$authorName){
            $this->db->select('b.userID as userID, a.articleID, title, 
            description, category, a.categoryID,
            articleImgLink, a.created as created');
            $this->db->from('tbl_cyberits_t_articles a');
            $this->db->join('tbl_cyberits_m_users b', 'a.authorID = b.userID');
            $this->db->join('tbl_cyberits_m_categories d', 'a.categoryID = d.categoryID');
            $this->db->where('a.isActive', 1);
            $this->db->where('b.name', $authorName);
            $this->db->order_by('a.Created','desc');
            
            if($limit != null || $start!= null){
                $this->db->limit($limit,$start);    
            }
            $query = $this->db->get();
            return $query->result_array();
        }
        
        function getCountAuthorPost($authorName){
            $this->db->from('tbl_cyberits_t_articles a');
            $this->db->join('tbl_cyberits_m_users b', 'a.authorID = b.userID');
            $this->db->where('a.isActive', 1);
            $this->db->where('b.name', $authorName);
            return $this->db->count_all_results();
        }
         
        /*
         * Vicky
         * */
        function getArticleList($start, $limit){
            $this->db->select('a.categoryID as categoryID, category, articleID, title,
            description, view, articleImgLink, a.created as created, username ');
            $this->db->from('tbl_cyberits_t_articles a');
            $this->db->join('tbl_cyberits_m_categories b', 'a.categoryID = b.categoryID');
            $this->db->join('tbl_cyberits_m_users c', 'a.authorID = c.userID');
            $this->db->where('a.isActive', 1);
            $this->db->order_by('a.Created','desc');

            if($limit != null || $start!= null){
                $this->db->limit($limit,$start);
            }
            $query = $this->db->get();
            return $query->result_array();
        }

        function getCountArticleList()
        {
            $this->db->from('tbl_cyberits_t_articles a');
            return $this->db->count_all_results();
        }

        function getArticleListBySearch($title, $category, $author,$start, $limit){
            $this->db->select('a.categoryID as categoryID, category, articleID, title,
            description, view, articleImgLink, a.created as created, username ');
            $this->db->from('tbl_cyberits_t_articles a');
            $this->db->join('tbl_cyberits_m_categories b', 'a.categoryID = b.categoryID');
            $this->db->join('tbl_cyberits_m_users c', 'a.authorID = c.userID');

            $this->db->like('a.title', $title);
            if($category!="") {
                $this->db->where('a.categoryID', $category);
            }
            $this->db->like('c.username', $author);
            $this->db->where('a.isActive', 1);
            $this->db->order_by('a.Created','desc');

            if($limit != null || $start!= null){
                $this->db->limit($limit,$start);
            }
            $query = $this->db->get();
            return $query->result_array();
        }

        function countArticleListBySearch($title, $category, $author){
            $this->db->from('tbl_cyberits_t_articles a');
            $this->db->join('tbl_cyberits_m_categories b', 'a.categoryID = b.categoryID');
            $this->db->join('tbl_cyberits_m_users c', 'a.authorID = c.userID');
            $this->db->like('a.title', $title);
            if($category!="") {
                $this->db->where('a.categoryID', $category);
            }
            $this->db->like('c.username', $author);
            $this->db->where('a.isActive', 1);
            return $this->db->count_all_results();
        }

        /*
         * Article Detail
         * */
        function getArticleDetail($articleID)
        {
            $this->db->select('a.articleID as articleID, title,
			DATE_FORMAT(a.created,\'%d %M %Y\') AS created , a.categoryID as categoryID, category, categoryImgLink,
			b.name ,userDescription,view ,description,content ,AVG(rating) as ratingPerArticle, articleImgLink, userImgLink');

            $this->db->from('tbl_cyberits_t_articles a');
            $this->db->join('tbl_cyberits_m_users b', 'b.userID = a.authorID');
            $this->db->join('tbl_cyberits_t_comments c', 'c.articleID = a.articleID', 'left');
            $this->db->join('tbl_cyberits_m_categories d', 'd.categoryID = a.categoryID');

            $this->db->where(array('a.isActive' =>
                true, 'a.articleID' => $articleID));

            $this->db->order_by('a.created', 'desc');
            $this->db->group_by('a.articleID');
            $query = $this->db->get();
            return $query->row();
        }

        /*
         * Related Article
         */

        function getRelatedArticleTag($articleId){
            $this->db->select('tagID');
            $this->db->from('tbl_cyberits_s_articles_tags a');
            $this->db->where('a.articleID', $articleId);
            $query = $this->db->get();
            return $query->result_array();
        }

        function getRelatedArticle($articleId){

            $this->db->select('tagID');
            $this->db->from('tbl_cyberits_s_articles_tags a');
            $this->db->where('a.articleID', $articleId);
            $subQuery = $this->db->get_compiled_select();

            $this->db->select('*');
            $this->db->from('tbl_cyberits_t_articles a');
            $this->db->join('tbl_cyberits_s_articles_tags b', 'a.articleID=b.articleID');
            $this->db->where("b.tagID IN ($subQuery)", NULL, FALSE);
            $this->db->where("a.articleID !=", $articleId);
            $this->db->group_by('a.articleID');
            $this->db->order_by('a.created', 'desc');
            $this->db->limit('4');
            $query = $this->db->get();
            return $query->result_array();
        }

        function getMoreArticle($dataArticle){
            $this->db->select('b.userID as userID, a.articleID, title,
            description, category, a.categoryID,
            articleImgLink, a.created as created');
            $this->db->from('tbl_cyberits_t_articles a');
            $this->db->join('tbl_cyberits_m_users b', 'a.authorID = b.userID');
            $this->db->join('tbl_cyberits_m_categories d', 'a.categoryID = d.categoryID');
            $this->db->where('a.isActive', 1);
            $this->db->where_not_in('a.articleID ', $dataArticle);
            $this->db->order_by('a.articleID', 'RANDOM');
            $this->db->limit(5);
            $query = $this->db->get();
            return $query->result_array();
        }

        function getPopularArticle($limit){
            $this->db->select('b.userID as userID, a.articleID, title,
            description, category, a.categoryID,
            articleImgLink, a.created as created');
            $this->db->from('tbl_cyberits_t_articles a');
            $this->db->join('tbl_cyberits_m_users b', 'a.authorID = b.userID');
            $this->db->join('tbl_cyberits_m_categories d', 'a.categoryID = d.categoryID');
            $this->db->where('a.isActive', 1);
            $this->db->order_by('a.view', 'DESC');
            $this->db->limit($limit);
            $query = $this->db->get();
            return $query->result_array();
        }


        /*
         * Article Comment
         */

        function getArticleComments($start, $limit, $articleID){
            $this->db->select('tbl_cyberits_t_comments.created AS created, name, rating, comment, isAdmin');
            $this->db->from('tbl_cyberits_t_comments');
            $this->db->join('tbl_cyberits_t_articles', 'tbl_cyberits_t_articles.articleID = tbl_cyberits_t_comments.articleID');

            $this->db->where(array('tbl_cyberits_t_articles.isActive'=> true,
                'tbl_cyberits_t_articles.articleID'=>$articleID));

            $this->db->order_by('tbl_cyberits_t_comments.created','desc');
            $this->db->limit($limit,$start);
            $query=$this->db->get();
            return $query->result_array();
        }

        function getCountArticleComments($articleID){
            $this->db->from('tbl_cyberits_t_comments a');
            $this->db->where('articleID',$articleID);
            return $this->db->count_all_results();
        }

		function insertComment($data)
		{
			$this->db->insert('tbl_cyberits_t_comments',$data);
			$result=$this->db->affected_rows();
            return $result;
		}
        
        function test(){
            $query = $this->db->query("SELECT * FROM tbl_cyberits_t_comments");
			return $query;
        }

        function createArticle($data){
            $this->db->insert('tbl_cyberits_t_articles',$data);
            return $this->db->insert_id();
        }

        function updateArticle($data, $id){
            $this->db->where('articleID',$id);
            $this->db->update('tbl_cyberits_t_articles',$data);
            $result=$this->db->affected_rows();
            return $result;
        }

    }

?>