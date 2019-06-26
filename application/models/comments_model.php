<?php
class Comments_model extends CI_Model {
 
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
    public function get_comments_by_id($id)
    {	
	

	
	
		
		$this->db->select('*');
		$this->db->from('comments');
		$this->db->where('id_comment', $id);
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
    public function get_comments($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
	    
		//echo $search_string;die;

		$this->db->select('*');
		
		
		$this->db->from('comments');
		
		
		
		$this->db->join('membership', 'comments.id_user = membership.id');
        $this->db->join('kvitancy', 'comments.id_kvitancy = kvitancy.id_kvitancy');
        $this->db->join('proizvoditel', 'kvitancy.id_proizvod = proizvoditel.id_proizvod');


		
		
		if($search_string){
					$this->db->like('comment', $search_string);
					
				}
				
		//$this->db->group_by('id_comment');

						if($order){
							$this->db->order_by($order, $order_type);
						}else{
							$this->db->order_by('id_comment', $order_type);
						}

						
        if($limit_start && $limit_end){
          $this->db->limit($limit_start, $limit_end);	
        }

        if($limit_start != null){
          $this->db->limit($limit_start, $limit_end);    
        }
        
	$query = $this->db->get();
		//echo $this->db->last_query();die;

		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
    }

    /**
    * Count the number of rows
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_comments($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('comments');
		if($search_string){
			$this->db->like('name_sc', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id_comment', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_comments($data)
    {
		$insert = $this->db->insert('comments', $data);
	    return $insert;
	}

    /**
    * Update manufacture
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_comments($id, $data)
    {
		$this->db->where('id_comment', $id);
		$this->db->update('comments', $data);
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
	function delete_comments($id){
		$this->db->where('id_comment', $id);
		$this->db->delete('comments'); 
	}
	
	
	function get_membership () {
			$this->db->select('*');
			$this->db->from('membership');
			
			$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
	}
 
}
?>