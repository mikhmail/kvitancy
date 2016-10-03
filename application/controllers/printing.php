<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Printing extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if(!$this->session->userdata('is_logged_in')){
			redirect('admin/login');
		}



		if (!$this->users_model->is_admin($this->session->userdata('user_name'))) {
			redirect('admin/login');
		}

		$this->load->model('print_model');
	}

	public function index()
	{
		/*Загрузка шаблона*/
		$data['main_content'] = 'print/index';
		$this->load->view('includes/template', $data);
	}

	public function check()
	{

		$data['text'] = $this->print_model->get_check();
		/*Загрузка шаблона*/
		$data['main_content'] = 'print/check';
		$this->load->view('includes/template', $data);
	}

	public function ticket()
	{

		$data['text'] = $this->print_model->get_ticket();
		/*Загрузка шаблона*/
		$data['main_content'] = 'print/ticket';
		$this->load->view('includes/template', $data);
	}

	public function ticket_update (){

		$data = array('value' => addslashes($_POST['text']));

		$this->print_model->update_ticket($data);

		redirect('printing/ticket');


	}

	public function check_update (){

		$data = array('value' => addslashes($_POST['text']));

		$this->print_model->update_check($data);

		redirect('printing/check');


	}




}//end class