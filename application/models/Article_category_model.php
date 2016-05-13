<?php

    class Article_category_model extends CI_Model{

        function getArticleCategory(){
             $this->db->select('*');
             $this->db->from('tbl_cyberits_m_categories b');
             $this->db->where('b.isActive', 1);
             $query = $this->db->get();
             return $query->result_array();
        }

        function getArticleCategoryList($start, $limit){
            $this->db->select('*');
            $this->db->from('tbl_cyberits_m_categories b');
            $this->db->where('b.isActive', 1);

            if($limit != null || $start!= null){
                $this->db->limit($limit,$start);
            }

            $query = $this->db->get();
            return $query->result_array();
        }

        function getCountArticleCategoryList(){
            $this->db->from('tbl_cyberits_m_categories a');
            return $this->db->count_all_results();
        }

        function getCategoryListBySearch($start,$limit, $search_name){
            $this->db->select('*');
            $this->db->from('tbl_cyberits_m_categories a');
            $this->db->where('isActive', 1);
            $this->db->like('a.category', $search_name);

            $this->db->limit($limit, $start);

            $this->db->order_by('a.Created','desc');

            $query = $this->db->get();
            return $query->result_array();
        }

        function countCategoryListBySearch($search_name){

            $this->db->select('*');
            $this->db->from('tbl_cyberits_m_categories a');
            $this->db->where('isActive', 1);
            $this->db->like('a.category', $search_name);
            return $this->db->count_all_results();
        }

        function checkUniqueCategory($categoryName, $status, $categoryID){
            $this->db->select('*');
            $this->db->from('tbl_cyberits_m_categories b');
            $this->db->where('b.category', $categoryName);
            if($status=="UPDATE"){
                $this->db->where('b.categoryID !=', $categoryID);
            }
            return $this->db->count_all_results();
        }

        function createCategory($data){
            $this->db->insert('tbl_cyberits_m_categories',$data);
            $result=$this->db->affected_rows();
            return $result;
        }

        function updateCategory($data, $id){
            $this->db->where('categoryID',$id);
            $this->db->update('tbl_cyberits_m_categories',$data);
            $result=$this->db->affected_rows();
            return $result;
        }
        
    }

?>