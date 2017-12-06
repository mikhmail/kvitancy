<?php

class Logout extends CI_Controller {


    public function __construct() {

        parent::__construct();


                //$this->db->cache_delete_all();
		
		$this->session->sess_destroy();
		
		$data = array(
				'user_id' => '',
				'user_name' => '',
				'id_group' => '',
				'user_id_sc' => '',
				'is_logged_in' => '',
               			 'show_call_tickets' => '',
                		'show_my_tickets' => '',
                		'work_type' => '',
                		'percent' => '',
			);

		delete_cookie('is_logged_in');
		





	}

    function index()
  	  {
  	      	
		$this->load->view('login');
        }

    


}