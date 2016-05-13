<?php

    class Tag_model extends CI_Model{
       
        
        function getTag(){
             $this->db->select('*');
             $this->db->from('tbl_cyberits_m_tags b');
             $this->db->where('b.isActive', 1);
             $query = $this->db->get();
             return $query->result_array();
        }

        function getTagList($start, $limit){
            $this->db->select('*');
            $this->db->from('tbl_cyberits_m_tags b');
            $this->db->where('b.isActive', 1);

            if($limit != null || $start!= null){
                $this->db->limit($limit,$start);
            }

            $query = $this->db->get();
            return $query->result_array();
        }

        function getCountTagList(){
            $this->db->from('tbl_cyberits_m_tags a');
            return $this->db->count_all_results();
        }

        function checkUniqueTag($tagName, $status, $tagID){
            $this->db->select('*');
            $this->db->from('tbl_cyberits_m_tags b');
            $this->db->where('b.tag', $tagName);
            if($status=="UPDATE"){
                $this->db->where('b.tagID !=', $tagID);
            }
            return $this->db->count_all_results();
        }

        function createTag($data_tag){
            $this->db->insert('tbl_cyberits_m_tags',$data_tag);
            $result=$this->db->affected_rows();
            return $result;
        }

        function updateTag($data, $id){
            $this->db->where('tagID',$id);
            $this->db->update('tbl_cyberits_m_tags',$data);
            $result=$this->db->affected_rows();
            return $result;
        }
        
        function getTagListBySearch($start,$limit, $search_name){
            $this->db->select('*');
            $this->db->from('tbl_cyberits_m_tags a');
            $this->db->where('isActive', 1);
            $this->db->like('a.tag', $search_name);
    
            $this->db->limit($limit, $start);
    
            $this->db->order_by('a.Created','desc');
    
            $query = $this->db->get();
            return $query->result_array();
        }

        function countTagListBySearch($search_name){

            $this->db->select('*');
            $this->db->from('tbl_cyberits_m_tags a');
            $this->db->where('isActive', 1);
            $this->db->like('a.tag', $search_name);
            return $this->db->count_all_results();
        }
        
    }

?>