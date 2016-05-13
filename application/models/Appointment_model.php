<?php

class Appointment_model extends CI_Model
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
        
    function getAppointmentDetail($id)
    {
        $where=array(
            'appointmentID'=>$id,
            'isActive'=>1
        );
        $this->db->select()->from('tbl_cyberits_t_appointments')->where($where);
        $query=$this->db->get();
        return $query->first_row('array');
    }

    function getHashedAppointmentDetail($HashedID)
    {
        $where=array(
            'securityCode'=>$HashedID,
            'isActive'=>1
        );
        $this->db->select()->from('tbl_cyberits_t_appointments')->where($where);
        $query=$this->db->get();
        return $query->first_row('array');
    }    
	
    function getAppointmentCmsList($start, $limit)
    {
        $this->db->select('*'); 
		$this->db->from('tbl_cyberits_t_appointments');
		$this->db->where('isActive', 1);
		if($limit!=null || $start!=null){
			$this->db->limit($limit, $start);
		}
		$this->db->order_by('created','desc');
		$this->db->order_by('appointmentID','desc');
		$query = $this->db->get();
		return $query->result_array();        
    }
	
	function countAppointmentCmsList()
    {
        $this->db->select('*'); 
		$this->db->from('tbl_cyberits_t_appointments');
        $this->db->where('isActive', 1);
        //$query = $this->db->get();
        return $this->db->count_all_results();
    }

    function updateAppointment($data, $id){
        $this->db->where('appointmentID',$id);
        $this->db->update('tbl_cyberits_t_appointments',$data);
        $result=$this->db->affected_rows();
        return $result;
    }

    
    // untuk buat janji temu
    function insertAppoinment($data){
        $this->db->insert('tbl_cyberits_t_appointments',$data);
        $result=$this->db->insert_id();
        return $result;
    }
    
}

?>