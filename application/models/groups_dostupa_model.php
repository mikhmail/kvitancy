<?php
class Groups_dostupa_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {   parent::__construct();
        $this->load->database();
    }

    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_groups_dostupa_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('groups_dostupa');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }    

    /**
    * Fetch groups_dostupa data from the database
    * possibility to mix search, filter and order
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_groups_dostupa($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
	    
		$this->db->select('*');
		$this->db->from('groups_dostupa');

		if($search_string){
			$this->db->like('name', $search_string);
		}
		$this->db->group_by('id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
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
    function count_groups_dostupa($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('groups_dostupa');
		if($search_string){
			$this->db->like('name', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_groups_dostupa($data)
    {
		$insert = $this->db->insert('groups_dostupa', $data);
	    return $insert;
	}

    /**
    * Update groups_dostupa
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_groups_dostupa($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('groups_dostupa', $data);
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
    * Delete groups_dostupar
    * @param int $id - groups_dostupa id
    * @return boolean
    */
	function delete_groups_dostupa($id){
		$this->db->where('id', $id);
		$this->db->delete('groups_dostupa'); 
	}
 
}
?>