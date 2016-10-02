<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

 
class Print_model extends CI_Model
{

    public function __construct() 
    {
        parent::__construct();
    }


    public function get_ticket()
    {
        return $this->db
            ->get_where('settings',array('name' => 'ticket'))
            ->row();
    }

    function update_ticket($data)
    {
        $this->db->where('name', 'ticket');
        $this->db->update('settings', $data);
        //echo $this->db->last_query();die;

        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if($report !== 0){
            return true;
        }else{
            return false;
        }
    }


    public function get_check()
    {
        return $this->db
            ->get_where('settings',array('name' => 'check'))
            ->row();
    }

    function update_check($data)
    {
        $this->db->where('name', 'check');
        $this->db->update('settings', $data);
        //echo $this->db->last_query();die;

        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if($report !== 0){
            return true;
        }else{
            return false;
        }
    }



}//end class
