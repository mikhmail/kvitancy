<?php

class Login extends CI_Controller {

	  public function __construct() {
        parent::__construct();

	}
		
	function index()
	{
		

			if($this->session->userdata('is_logged_in')){
				redirect('tickets');
				}else{
					$this->load->view('login');	
					}
		

	}

    
	   /**
    * encript the password 
    * @return mixed
    */	
    function __encrip_password($password) {
        return md5($password);
    }	

    /**
    * check the username and the password with the database
    * @return void
    */
	function validate_credentials()
	{	//var_dump($this->input->post());die;
		if ($user_name = $this->input->post('remember')) {
			$remember = 'true';
		}
		
		$this->load->model('Users_model');

		$user_name = $this->input->post('user_name');
		$password = $this->__encrip_password($this->input->post('password'));

		$is_valid = $this->Users_model->validate($user_name, $password);
		
		
		if($is_valid)
		{  
		$user_id = $this->Users_model->get_user_id_by_user_name($user_name);
		
		$user_arr = $this->Users_model->get_users_by_id($user_id);
		
		$id_group = $user_arr[0]["id_group"]; 
		$id_sc = $user_arr[0]["id_sc"];
        $show_my_tickets = $user_arr[0]["show_my_tickets"];
        $show_call_tickets = $user_arr[0]["show_call_tickets"];
        $work_type = $user_arr[0]["work_type"];
        $percent = $user_arr[0]["percent"];



            $data = array(
				'user_id' => $user_id,
				'user_name' => $user_name,
				'id_group' => $id_group,
				'user_id_sc' => $id_sc,
				'is_logged_in' => true,
                'show_call_tickets' => $show_call_tickets,
                'show_my_tickets' => $show_my_tickets,
                'work_type' => $work_type,
                'percent' => $percent,

                                
			);

        $remember = $this->input->post('remember');
		if($remember)
		{
        $data['new_expiration'] = 60*60*24*3;//3 days
        $this->session->sess_expiration = $data['new_expiration'];
		}
			//var_dump($data);die;
			$this->session->set_userdata($data);
			redirect('/');
		}
		else // incorrect username or password
		{
			$data['message_error'] = TRUE;
			$this->load->view('login', $data);
		}
	}	

	function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
	
	function cache_delete()
	{
		$this->db->cache_delete_all();
		$this->session->set_flashdata('flash_message', 'cache deleted');
		redirect('/admin');
	}
	
	

}