<?php
class Aparaty_model extends CI_Model {
 
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
    public function get_aparaty_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('aparaty');
		$this->db->where('id_aparat', $id);
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
    public function get_aparaty($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
	    
		$this->db->select('*');
		$this->db->from('aparaty');

		if($search_string){
			$this->db->like('aparat_name', $search_string);
		}
		$this->db->group_by('id_aparat');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id_aparat', $order_type);
		}

        if($limit_start && $limit_end){
          $this->db->limit($limit_start, $limit_end);	
        }

        if($limit_start != null){
          $this->db->limit($limit_start, $limit_end);    
        }
        
		$query = $this->db->get();
		//echo $this->db->last_query();die;

		return $query->result_array(); 	
    }

    public function get_aparat_p($id_aparat)
    {

        $this->db->select('*');
        $this->db->from('aparat_p');
        $this->db->where('id_aparat', $id_aparat);

        $this->db->group_by('title');

        $query = $this->db->get();

        return $query->result_array();

    }

    /**
    * Count the number of rows
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_aparaty($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('aparaty');
		if($search_string){
			$this->db->like('aparat_name', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id_aparat', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_aparaty($data)
    {
		$insert = $this->db->insert('aparaty', $data);
	    return $insert;
	}

    /**
    * Update manufacture
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_aparaty($id, $data)
    {
		$this->db->where('id_aparat', $id);
		$this->db->update('aparaty', $data);
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
	function delete_aparaty($id){
		$this->db->where('id_aparat', $id);
		$this->db->delete('aparaty'); 
	}

    function check_kvitancy($id_aparat){

        $this->db->select('id_kvitancy');
        $this->db->from('kvitancy');
        $this->db->where('id_aparat', $id_aparat);

        $query = $this->db->get();

        return $query->result_array();
    }
 
}
?>