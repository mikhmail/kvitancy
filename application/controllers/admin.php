<?php

class Admin extends CI_Controller {


    public function __construct() {

        parent::__construct();

        $this->load->model('users_model');






	}

    function index()
    {

        if ($this->users_model->is_admin($this->session->userdata('user_name'))) {
            //var_dump($this->session->userdata);die;
            redirect('admin/users');
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
	{	

		$this->load->model('Users_model');

		$user_name = $this->input->post('user_name');
		$password = $this->__encrip_password($this->input->post('password'));

		$is_valid = $this->Users_model->validate ($user_name, $password);
		$is_admin = $this->Users_model->is_admin ($user_name);
		
		echo $is_valid . $is_admin;die;
		
		if($is_valid)
		{
			$data = array(
				'user_name' => $user_name,
				'id_group' => 1,
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);
			redirect('admin/users');
		}
		else // incorrect username or password
		{
			$data['message_error'] = TRUE;
			$this->load->view('login', $data);	
		}
	}	

    /**
    * The method just loads the signup view
    * @return void
    */
	function signup()
	{
		$this->load->view('admin/signup_form');	
	}
	

    /**
    * Create new user and store it in the database
    * @return void
    */	
	function create_member()
	{
		$this->load->library('form_validation');
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">?</a><strong>', '</strong></div>');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/signup_form');
		}
		
		else
		{			
			$this->load->model('Users_model');
			
			if($query = $this->Users_model->create_member())
			{
				$this->load->view('admin/signup_successful');			
			}
			else
			{
				$this->load->view('admin/signup_form');			
			}
		}
		
	}
	
	/**
    * Destroy the session, and logout the user.
    * @return void
    */		
function logout()
	{	
		//var_dump($this->session->set_userdata);die;
		$this->db->cache_delete_all();
		
		$this->session->sess_destroy();
		
		$this->session->set_userdata(array('is_logged_in' => false));
		
		redirect('/login');
	}
	
	
function cache_delete()
	{
		$this->db->cache_delete_all();
		$this->session->set_flashdata('flash_message', 'cache deleted');
		redirect('login');
	}
}
?>