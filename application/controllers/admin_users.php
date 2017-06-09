<?php
class Admin_users extends CI_Controller {
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('groups_dostupa_model');
		$this->load->model('service_centers_model');





        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }



        if (!$this->users_model->is_admin($this->session->userdata('user_name'))) {
            redirect('admin/login');
        }
    }
 
    /**
    * Load the main view with all the current model model's data.
    * @return void
    */
    public function index()
    {

        //all the posts sent by the view
        $groups_dostupa_id = $this->input->post('groups_dostupa_id');        
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 

        //pagination settings
        $config['per_page'] = 10;
        $config['base_url'] = base_url().'admin/users';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 4;
        $config['first_url'] = '1';
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open']  = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['first_link']      = 'First';
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['last_link']      = 'Last';
        $config['last_tag_open']  = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_link']      = '»';
        $config['next_tag_open']  = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['prev_link']      = '«';
        $config['prev_tag_open']  = '<li>';
        $config['prev_tag_close'] = '</li>';

        //limit end
        $page = $this->uri->segment(3);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 

        //if order type was changed
        if($order_type){
            $filter_session_data['order_type'] = $order_type;
        }
        else{
            //we have something stored in the session? 
            if($this->session->userdata('order_type')){
                $order_type = $this->session->userdata('order_type');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'Asc';    
            }
        }
        //make the data type var avaible to our view
        $data['order_type_selected'] = $order_type;        


        //we must avoid a page reload with the previous session data
        //if any filter post was sent, then it's the first time we load the content
        //in this case we clean the session filter data
        //if any filter post was sent but we are in some page, we must load the session data

        //filtered && || paginated
        if($groups_dostupa_id !== false && $search_string !== false && $order !== false || $this->uri->segment(3) == true){
           
            /*
            The comments here are the same for line 79 until 99

            if post is not null, we store it in session data array
            if is null, we use the session data already stored
            we save order into the the var to load the view with the param already selected       
            */

            if($groups_dostupa_id !== 0){
                $filter_session_data['groups_dostupa_selected'] = $groups_dostupa_id;
            }else{
                $groups_dostupa_id = $this->session->userdata('groups_dostupa_selected');
            }
            $data['groups_dostupa_selected'] = $groups_dostupa_id;

            if($search_string){
                $filter_session_data['search_string_selected'] = $search_string;
            }else{
                $search_string = $this->session->userdata('search_string_selected');
            }
            $data['search_string_selected'] = $search_string;

            if($order){
                $filter_session_data['order'] = $order;
            }
            else{
                $order = $this->session->userdata('order');
            }
            $data['order'] = $order;

            //save session data into the session
            $this->session->set_userdata($filter_session_data);

            //fetch groups_dostupa data into arrays
            $data['groups_dostupa'] = $this->groups_dostupa_model->get_groups_dostupa();
            $data['sc'] = $this->service_centers_model->get_service_centers();
            $data['count_users']= $this->users_model->count_users($groups_dostupa_id, $search_string, $order);
            $config['total_rows'] = $data['count_users'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['users'] = $this->users_model->get_users($groups_dostupa_id, $search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['users'] = $this->users_model->get_users($groups_dostupa_id, $search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['users'] = $this->users_model->get_users($groups_dostupa_id, '', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['users'] = $this->users_model->get_users($groups_dostupa_id, '', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['groups_dostupa_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['groups_dostupa_selected'] = 0;
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['groups_dostupa'] = $this->groups_dostupa_model->get_groups_dostupa();
			$data['sc'] = $this->service_centers_model->get_service_centers();
			
            $data['count_users']= $this->users_model->count_users();
            $data['users'] = $this->users_model->get_users('', '', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_users'];

        }//!isset($groups_dostupa_id) && !isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/users/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add()
    {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            $this->form_validation->set_rules('first_name', 'first_name', 'required');
            $this->form_validation->set_rules('last_name', 'last_name', 'required');
            $this->form_validation->set_rules('email_addres', 'email_addres', 'required');
            $this->form_validation->set_rules('user_name', 'user_name', 'required');
            $this->form_validation->set_rules('groups_dostupa_id', 'groups_dostupa_id', 'required');
			$this->form_validation->set_rules('id_sc', 'service center', 'required');
            $this->form_validation->set_rules('active', 'active', 'required');
            $this->form_validation->set_rules('work_type', 'work_type', 'required');

			
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'email_addres' => $this->input->post('email_addres'),
                    'user_name' => $this->input->post('user_name'),          
                    'id_group' => $this->input->post('groups_dostupa_id'),
					'id_sc' => $this->input->post('id_sc'),
					'pass_word' => trim(md5($this->input->post('pass_word'))),
                    'active' => (int)$this->input->post('active'),
                    'percent' => (int)$this->input->post('percent'),
                    'work_type' => (int)$this->input->post('work_type')



                );
                //if the insert has returned true then we show the flash message
                if($this->users_model->store_users($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        //fetch groups_dostupa data to populate the select field
        $data['groups_dostupa'] = $this->groups_dostupa_model->get_groups_dostupa();
		$data['sc'] = $this->service_centers_model->get_service_centers();
        //load the view
        $data['main_content'] = 'admin/users/add';
        $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //product id 
        $id = $this->uri->segment(4);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('first_name', 'first_name', 'required');
            $this->form_validation->set_rules('last_name', 'last_name', 'required');
            $this->form_validation->set_rules('email_addres', 'email_addres', 'required');
            $this->form_validation->set_rules('user_name', 'user_name', 'required');
            $this->form_validation->set_rules('groups_dostupa_id', 'groups_dostupa_id', 'required');
			$this->form_validation->set_rules('id_sc', 'service center', 'required');
            $this->form_validation->set_rules('active', 'active', 'required');
            $this->form_validation->set_rules('work_type', 'work_type', 'required');



            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'email_addres' => $this->input->post('email_addres'),
                    'user_name' => $this->input->post('user_name'),          
                    'id_group' => $this->input->post('groups_dostupa_id'),
					'id_sc' => $this->input->post('id_sc'),
                    'active' => $this->input->post('active'),
                    'pass_word' => trim(md5($this->input->post('pass_word'))),
                    'percent' => (int)$this->input->post('percent'),
                    'work_type' => (int)$this->input->post('work_type')
                );
                //if the insert has returned true then we show the flash message
                if($this->users_model->update_users($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');

            /*
                $data = array(
                    'user_name' => $this->input->post('user_name'),
                    'id_group' => $this->input->post('groups_dostupa_id'),
                    'user_id_sc' => $this->input->post('id_sc'),
                    'work_type' => (int)$this->input->post('work_type')
			    );
                $this->session->set_userdata($data);
            */

                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/users/update/'.$id.'');

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
        $data['main_content'] = 'admin/users/edit';
        $this->load->view('includes/template', $data);            

    }//update

    /**
    * Delete product by his id
    * @return void
    */
    public function delete()
    {
        //product id 
        $id = $this->uri->segment(4);

        $check =  $this->users_model->check_kvitancy($id);

        if( count($check) >= 1 ) {

            echo "<script language='JavaScript' type='text/javascript'>alert('Не могу удалить пользователя! Есть его комментарии. Вы можете его заблокировать.')</script>";
            echo "<script language='JavaScript' type='text/javascript'>window.location.replace('/admin/users')</script>";

        } else {
        $this->users_model->delete_users($id);
        redirect('admin/users');
        }
    }//edit

}
?>