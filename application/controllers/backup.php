<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {


    public function __construct() {

        parent::__construct();

        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }

        if (!$this->users_model->is_admin($this->session->userdata('user_name'))) {
            redirect('admin/login');
        }

        $this->load->model('backupdb');

    }

	public function index()
	{

/*
        $file = 'backup-'.date('d-m-Y').'.zip';
            $this->load->helper('download');
                 force_download($file, $this->backupdb->backup());

*/
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            if($this->input->post('backup') == 1) {
                if ($this->backupdb->backup()){

                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');

                }
                redirect('backup/');

            }elseif ($this->input->post('backup') == 2){
                $file = 'backup-'.date('d-m-Y').'.zip';
                    $this->load->helper('download');
                         force_download($file, $this->backupdb->backup());
                redirect('backup/');

            }


        }
        /*Загрузка шаблона*/
        $data['main_content'] = 'admin/backup';
        $this->load->view('includes/template', $data);
	}
}