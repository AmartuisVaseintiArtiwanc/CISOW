<?php
    Class Portofolio_model extends CI_Model{
        
        function getPortofolio(){
            $this->db->select('*');
            $this->db->from('tbl_cyberits_t_portofolios p');
            $this->db->where('p.isActive', 1);
            $query = $this->db->get();
            return $query->result_array();
        }
        
        function getPortofolioList($start, $limit){
            $this->db->select('*');
            $this->db->from('tbl_cyberits_t_portofolios p');
            $this->db->where('p.isActive', 1);
            $this->db->order_by('p.portofolioID','desc');

            if($limit != null || $start!= null){
                $this->db->limit($limit,$start);
            }

            $query = $this->db->get();
            return $query->result_array();
        }
        
        function getCountPortofolioList(){
            $this->db->from('tbl_cyberits_t_portofolios p');
            return $this->db->count_all_results();
        }
        
        function countPortofolioListBySearch($search_name){

            $this->db->select('*');
            $this->db->from('tbl_cyberits_t_Portofolios p');
            $this->db->where('isActive', 1);
            $this->db->like('p.description', $search_name);
            return $this->db->count_all_results();
        }
        
        function createPortofolio($data){
            $this->db->insert('tbl_cyberits_t_Portofolios',$data);
            $result=$this->db->affected_rows();
            return $result;
        }

        function updatePortofolio($data, $id){
            $this->db->where('portofolioID',$id);
            $this->db->update('tbl_cyberits_t_Portofolios',$data);
            $result=$this->db->affected_rows();
            return $result;
        }
        
        
    }
?>