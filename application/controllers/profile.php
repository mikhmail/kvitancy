<?php

class Profile extends CI_Controller {


    public function __construct()
    {
        parent::__construct();


        $this->load->model('users_model');
        $this->load->model('groups_dostupa_model');
        $this->load->model('service_centers_model');


        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }

    }



    public function index ()
        {
            //product id
            $id = $this->session->userdata('user_id');

            //if save button was clicked, get the data sent via post
            if ($this->input->server('REQUEST_METHOD') === 'POST')
            {
                //form validation
                $this->form_validation->set_rules('first_name', 'first_name', 'required');
                $this->form_validation->set_rules('last_name', 'last_name', 'required');
                $this->form_validation->set_rules('email_addres', 'email_addres', 'required');
                $this->form_validation->set_rules('user_name', 'user_name', 'required');
                //$this->form_validation->set_rules('groups_dostupa_id', 'groups_dostupa_id', 'required');
                //$this->form_validation->set_rules('id_sc', 'service center', 'required');
                //$this->form_validation->set_rules('active', 'active', 'required');

            if($this->input->post('show_my_tickets')) {
                $show_my_tickets = 1;
            }else {
                $show_my_tickets = 0;
            }

            if($this->input->post('show_call_tickets')) {
                $show_call_tickets = 1;
            }else{
                $show_call_tickets = 0;
            }

                $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
                //if the form has passed through the validation
                if ($this->form_validation->run())
                {

                    $data_to_store = array(
                        'first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),
                        'email_addres' => $this->input->post('email_addres'),
                        'user_name' => $this->input->post('user_name'),
                        'show_my_tickets' => $show_my_tickets,
                        'show_call_tickets' => $show_call_tickets,
                        'pass_word' => trim(md5($this->input->post('pass_word')))



                    );
                    //if the insert has returned true then we show the flash message
                    if($this->users_model->update_users($id, $data_to_store) == TRUE){
                        $this->session->set_flashdata('flash_message', 'updated');
                    }else{
                        $this->session->set_flashdata('flash_message', 'not_updated');
                    }

                    $this->db->cache_delete_all();
                    $this->session->sess_destroy();
                    redirect('login');


                }//validation run

            }

            //if we are updating, and the data did not pass trough the validation
            //the code below wel reload the current data

            //product data
            $data['product'] = $this->users_model->get_users_by_id($id);
            //fetch groups_dostupa data to populate the select field
            $data['groups_dostupa'] = $this->groups_dostupa_model->get_groups_dostupa();
            $data['sc'] = $this->service_centers_model->get_service_centers();
            //load the view
            $data['main_content'] = 'includes/edit_profile';

            $this->load->view('includes/template', $data);


    }

}