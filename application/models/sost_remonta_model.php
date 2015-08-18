<?php
class sost_remonta_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct() { parent::__construct();
        $this->load->database();
    }

    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_sost_remonta_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('sost_remonta');
		$this->db->where('id_sost', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_sost_remonta_in_remont()
    {
        $this->db->select('id_sost');
        $this->db->from('sost_remonta');
        $this->db->where('type', 1); //type = 1 - in temont, 0 - vidan
        $query = $this->db->get();

        $sost = array();
        foreach($query->result_array() as $key => $arr) {
            foreach($arr as $value){
                $sost[]= $value;
            }

        }

        return $sost;
    }

    public function get_sost_remonta_call()
    {
        $this->db->select('id_sost');
        $this->db->from('sost_remonta');
        $this->db->where('type', 1); //type = 1 - in temont, 0 - vidan
        $this->db->where('call2client', 1); //call = 1 - pozvonit, 0 - net

        $query = $this->db->get();

        $sost = array();
        foreach($query->result_array() as $key => $arr) {
            foreach($arr as $value){
                $sost[]= $value;
            }

        }

        return $sost;
    }




    public function get_sost_remonta($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
	    
		$this->db->select('*');
		$this->db->from('sost_remonta');

		if($search_string){
			$this->db->like('name_sost', $search_string);
		}
		$this->db->group_by('id_sost');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id_sost', $order_type);
		}

        if($limit_start && $limit_end){
          $this->db->limit($limit_start, $limit_end);	
        }

        if($limit_start != null){
          $this->db->limit($limit_start, $limit_end);    
        }
        
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }

    /**
    * Count the number of rows
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_sost_remonta($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('sost_remonta');
		if($search_string){
			$this->db->like('name_sost', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id_sost', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_sost_remonta($data)
    {
		$insert = $this->db->insert('sost_remonta', $data);
	    return $insert;
	}

    /**
    * Update manufacture
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_sost_remonta($id, $data)
    {
		$this->db->where('id_sost', $id);
		$this->db->update('sost_remonta', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

    /**
    * Delete manufacturer
    * @param int $id - manufacture id
    * @return boolean
    */
	function delete_sost_remonta($id){
		$this->db->where('id_sost', $id);
		$this->db->delete('sost_remonta'); 
	}
 
}
?>