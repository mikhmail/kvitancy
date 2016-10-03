<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if(!$this->session->userdata('is_logged_in')){
			redirect('admin/login');
		}



		if (!$this->users_model->is_admin($this->session->userdata('user_name'))) {
			redirect('admin/login');
		}

		$this->load->model('kvitancy_model');
	}

	public function index()
	{
		$data['count_per_page'] = $this->kvitancy_model->get_tickets_per_page();
		/*Загрузка шаблона*/
		$data['main_content'] = 'settings/index';
		$this->load->view('includes/template', $data);
	}



	public function update_tickets_per_page (){

		$data = array('value' => (int)($_POST['count_per_page']));

		$this->kvitancy_model->update_tickets_per_page($data);

		redirect('settings');


	}




}//end class