<?php
class gorod_model extends CI_Model {
 
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
    public function get_gorod_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('goroda');
		$this->db->where('gorod_id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }    

    /**
    * Fetch manufacturers data from the database
    * possibility to mix search, filter and order
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_gorod($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
	    
		$this->db->select('*');
		$this->db->from('goroda');

		if($search_string){
			$this->db->like('gorod', $search_string);
		}
		$this->db->group_by('gorod_id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('gorod_id', $order_type);
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
    function count_gorod($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('goroda');
		if($search_string){
			$this->db->like('gorod', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('gorod_id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_gorod($data)
    {
		$insert = $this->db->insert('goroda', $data);
	    return $insert;
	}

    /**
    * Update manufacture
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_gorod($id, $data)
    {
		$this->db->where('gorod_id', $id);
		$this->db->update('goroda', $data);
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
	function delete_gorod($id){
		$this->db->where('gorod_id', $id);
		$this->db->delete('goroda'); 
	}
 
}
?>