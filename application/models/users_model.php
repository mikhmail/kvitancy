<?php

class Users_model extends CI_Model {

 public function __construct() { parent::__construct();
        $this->load->database();
    }
	
	
	
	function is_admin ($user_name)
	{
		$this->db->where('user_name', $user_name);
		//$this->db->where('pass_word', $password);
		$this->db->where('id_group', 1);
		
		$query = $this->db->get('membership');
		
		if($query->num_rows === 1)
		{
			return true;
		}		
	}

	function validate ($user_name, $password)
	{
		$this->db->where('user_name', $user_name);
		$this->db->where('pass_word', $password);
		
		
		$query = $this->db->get('membership');
		
		if($query->num_rows === 1)
		{
			return true;
		}		
	}
	
    /**
    * Serialize the session data stored in the database, 
    * store it in a new array and return it to the controller 
    * @return array
    */
	function get_db_session_data()
	{
		$query = $this->db->select('user_data')->get('ci_sessions');
		$user = array(); /* array to store the user data we fetch */
		foreach ($query->result() as $row)
		{
		    $udata = unserialize($row->user_data);
		    /* put data in array using username as key */
			
			$user['user_id'] = $udata['user_id']; 
		    
		    $user['user_name'] = $udata['user_name']; 
		    $user['is_logged_in'] = $udata['is_logged_in']; 
		}
		return $user;
	}
	
    /**
    * Store the new user's data into the database
    * @return boolean - check the insert
    */	
	function create_member()
	{

		$this->db->where('user_name', $this->input->post('username'));
		$query = $this->db->get('membership');

        if($query->num_rows > 0){
        	echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>';
			  echo "Username already taken";	
			echo '</strong></div>';
		}else{

			$new_member_insert_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email_addres' => $this->input->post('email_address'),			
				'user_name' => $this->input->post('username'),
				'pass_word' => md5($this->input->post('password'))						
			);
			$insert = $this->db->insert('membership', $new_member_insert_data);
		    return $insert;
		}
	      
	}//create_member
	
	
	    public function get_users_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('membership');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

		public function get_user_id_by_user_name($user_name)
    {
		$this->db->select('*');
		$this->db->from('membership');
		$this->db->where('user_name', $user_name);
		$this->db->limit('1');
		$query = $this->db->get();
		foreach ($query->result_array() as $a) {
		return $a['id']; 
		
		}
    }
    /**
    * Fetch users data from the database
    * possibility to mix search, filter and order
    * @param int $manufacuture_id 
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_users($groups_dostupa_id=null, $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end, $id_sc=null)
    {
	    
		$this->db->select('membership.id');
		$this->db->select('membership.first_name');
		$this->db->select('membership.last_name');
		$this->db->select('membership.email_addres');
		$this->db->select('membership.user_name');
		$this->db->select('membership.id_group');
		$this->db->select('membership.id_sc');
		
		//$this->db->select('groups_dostupa.name as groups_dostupa_name');
		$this->db->from('membership');
		if($groups_dostupa_id != null && $groups_dostupa_id != 0){
			$this->db->where('membership.id_group', $groups_dostupa_id);
		}
		if($search_string){
			$this->db->like('user_name', $search_string);
		}

		$this->db->join('groups_dostupa', 'membership.id_group = groups_dostupa.id', 'left');

		$this->db->group_by('membership.id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}

if ($limit_start AND $limit_end) {
		$this->db->limit($limit_start, $limit_end);
		//$this->db->limit('4', '4');
}

		$query = $this->db->get();
		
		return $query->result_array(); 	
    }

    /**
    * Count the number of rows
    * @param int $groups_dostupa_id
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_users($groups_dostupa_id=null, $search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('membership');
		if($groups_dostupa_id != null && $groups_dostupa_id != 0){
			$this->db->where('membership.id_group', $groups_dostupa_id);
		}
		if($search_string){
			$this->db->like('user_name', $search_string);
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
    function store_users($data)
    {
		$insert = $this->db->insert('membership', $data);
	    return $insert;
	}

    /**
    * Update users
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_users($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('membership', $data);
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
    * Delete users
    * @param int $id - users id
    * @return boolean
    */
	function delete_users($id){
		$this->db->where('id', $id);
		$this->db->delete('membership'); 
	}
	
}

