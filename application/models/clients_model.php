<?php
class Clients_model extends CI_Model {
 
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
    public function get_clients_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_id', $id);
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
    public function get_clients($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
	    
		$this->db->select('*');
		$this->db->from('users');

		if($search_string){
			$this->db->like('fam', $search_string);
		}
		$this->db->group_by('user_id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('user_id', $order_type);
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
    function count_clients($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('users');
		if($search_string){
			$this->db->like('fam', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('user_id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

	
	public function get_group1(){
	
	}
	
    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_clients($data)
    {
		$insert = $this->db->insert('users', $data);
	    return $this->db->insert_id();
	}

    /**
    * Update manufacture
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_clients($id, $data)
    {
		$this->db->where('user_id', $id);
		$this->db->update('users', $data);
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
	function delete_clients($id){
		$this->db->where('user_id', $id);
		$this->db->delete('users'); 
	}
 
}
?>