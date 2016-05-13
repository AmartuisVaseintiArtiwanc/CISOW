<?php

class User_model extends CI_Model
{
    /*
    ==========================================================================================================================================================================
    Created By                          Satria W Sandi[A]   on 22/08/2015
    Last Updated By                     Satria W Sandi      on 03/09/2015          
    Controller                          user             for tbl_ga_m_gallery
    ==========================================================================================================================================================================
    functions :
    1. login()                          [A] [Backend]      Mendapatkan semua data user yang diperlukan berkaitan dengan tabel user berdasarkan $username dan $password tertentu  
    */
    /*function login($username, $password)
    {
        $where=array(
            'username'=>$username,
            'password'=>sha1($password),
            'isActive'=>1
        );
        $this->db->select()->from('tbl_ga_m_users')->where($where);
        $query=$this->db->get();
        return $query->first_row('array');
    }*/
        
    function getUserDetail($id)
    {
        $where=array(
            'userID'=>$id,
            'isActive'=>1
        );
        $this->db->select()->from('tbl_cyberits_m_users')->where($where);
        $query=$this->db->get();
        return $query->first_row('array');
    }
    
    function checkUsername($username)//, $id)
    {
        $this->db->select('*');
        $this->db->from('tbl_cyberits_m_users');
        $this->db->where('username',$username);
        //$this->db->where('userID !=',$id);
        $this->db->where('isActive', 1);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return 1; // allready exist
        }else{
            return 0; //blom ada
        }
    }
    function checkUsernameExceptSelf($username, $id)
    {
        $this->db->select('*');
        $this->db->from('tbl_cyberits_m_users');
        $this->db->where('username',$username);
        $this->db->where('userID !=',$id);
        $this->db->where('isActive', 1);
        $query = $this->db->get();
        if($query->num_rows()>0){
            return 1; // allready exist
        }else{
            return 0; //blom ada
        }
    }
    
    function checkPassword($id)
    {        
        $where=array(
            'userID'=>$id,        
            'isActive'=>1
        );
        
        $this->db->select('*');
        $this->db->from('tbl_cyberits_m_users');
        $this->db->where($where);    
        $this->db->where('isActive', 1);
        $query = $this->db->get();
        /*if($query->num_rows()>0){
            return 1; // benar
        }else{
            return 0; //sala
        }*/
        return $query->row();
    }

    function checkPasswordByUsername($username)
    {        
        $where=array(
            'username'=>$username,        
            'isActive'=>1
        );
        
        $this->db->select('*');
        $this->db->from('tbl_cyberits_m_users');
        $this->db->where($where);    
        $this->db->where('isActive', 1);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    function createUser($data){        
        $this->db->insert('tbl_cyberits_m_users',$data);
        $result=$this->db->affected_rows();
        return $result;
    }
    
    function updateUser($data, $id){
        $this->db->where('userID',$id);
        $this->db->update('tbl_cyberits_m_users',$data);
        $result=$this->db->affected_rows();
        return $result;
    }
    
    function getUserCmsList($start, $limit)
    {
        $this->db->select('*'); 
		$this->db->from('tbl_cyberits_m_users');
		$this->db->where('isActive', 1);
		if($limit!=null || $start!=null){
			$this->db->limit($limit, $start);
		}
		$this->db->order_by('lastUpdated','desc');
		$this->db->order_by('userID','desc');
		$query = $this->db->get();
		return $query->result_array();        
    }
    
    function countUserCmsList()
    {
        $this->db->select('*'); 
		$this->db->from('tbl_cyberits_m_users');
        $this->db->where('isActive', 1);
        //$query = $this->db->get();
        return $this->db->count_all_results();
    }
}

?>