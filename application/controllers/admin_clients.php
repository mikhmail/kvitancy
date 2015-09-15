<?php
class Admin_clients extends CI_Controller {

    /**
    * name of the folder responsible for the views 
    * which are manipulated by this controller
    * @constant string
    */
    const VIEW_FOLDER = 'admin/clients';
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct() { parent::__construct();
        
		
		$this->load->model('service_centers_model');
        $this->load->model('clients_model');
		$this->load->model('gorod_model');


        $this->load->model('users_model');




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
        $search_string = $this->input->post('search_string');        
        $order = $this->input->post('order'); 
        $order_type = $this->input->post('order_type'); 

        //pagination settings
        $config['per_page'] = 20;

        $config['base_url'] = base_url().'admin/clients';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 20;
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 4;

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
        if($search_string !== false && $order !== false || $this->uri->segment(3) == true){
           
            /*
            The comments here are the same for line 79 until 99

            if post is not null, we store it in session data array
            if is null, we use the session data already stored
            we save order into the the var to load the view with the param already selected       
            */
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
            if(isset($filter_session_data)){
              $this->session->set_userdata($filter_session_data);    
            }
            
            //fetch sql data into arrays
            $data['count_products']= $this->clients_model->count_clients($search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['manufacturers'] = $this->clients_model->get_clients($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['manufacturers'] = $this->clients_model->get_clients($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['manufacturers'] = $this->clients_model->get_clients('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['manufacturers'] = $this->clients_model->get_clients('', '', $order_type, $config['per_page'],$limit_end);        
                }
            }

        }else{

            //clean filter data inside section
            $filter_session_data['manufacture_selected'] = null;
            $filter_session_data['search_string_selected'] = null;
            $filter_session_data['order'] = null;
            $filter_session_data['order_type'] = null;
            $this->session->set_userdata($filter_session_data);

            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id';

            //fetch sql data into arrays
            $data['count_products']= $this->clients_model->count_clients();
            $data['manufacturers'] = $this->clients_model->get_clients('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
		$data['service_centers'] = $this->service_centers_model->get_service_centers();
		$data['gorod'] = $this->gorod_model->get_gorod();
        $data['main_content'] = 'admin/clients/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add()
    {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            $this->form_validation->set_rules('fam', 'fam', 'required');
            $this->form_validation->set_rules('imya', 'imya', 'required');
            $this->form_validation->set_rules('phone', 'phone', 'required|numeric');
            $this->form_validation->set_rules('id_sc', 'id_sc', 'required|numeric');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                    'fam' => $this->input->post('fam'),
                    'imya' => $this->input->post('imya'),
                    'otch' => $this->input->post('otch'),
                    'id_group' => $this->input->post('id_group'),
                    'mail' => $this->input->post('mail'),
                    'phone' => $this->input->post('phone'),
                    'adres' => $this->input->post('adres'),
                    'id_sc' => $this->input->post('id_sc')
					
					
                );
				
				
				
                //if the insert has returned true then we show the flash message

                if($id = $this->clients_model->store_clients($data_to_store)){

				    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }

            }
            redirect('admin/clients/update/'.$id.'');
        }
        //load the view
		$data['gorod'] = $this->gorod_model->get_gorod();
        $data['sc'] = $this->service_centers_model->get_service_centers();
		
        $data['main_content'] = 'admin/clients/add';
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
            $this->form_validation->set_rules('fam', 'fam', 'required');
            $this->form_validation->set_rules('imya', 'imya', 'required');
            $this->form_validation->set_rules('phone', 'phone', 'required|numeric');
            $this->form_validation->set_rules('id_sc', 'id_sc', 'required|numeric');


            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {

                $data_to_store = array(
                    'fam' => $this->input->post('fam'),
                    'imya' => $this->input->post('imya'),
                    'otch' => $this->input->post('otch'),
                    'id_group' => $this->input->post('id_group'),
                    'mail' => $this->input->post('mail'),
                    'phone' => $this->input->post('phone'),
                    'adres' => $this->input->post('adres'),
                    'id_sc' => $this->input->post('id_sc')




                );
                //if the insert has returned true then we show the flash message
                if($this->clients_model->update_clients($id, $data_to_store) == TRUE){

                    //var_dump($data_to_store);
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/clients/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        $data['gorod'] = $this->gorod_model->get_gorod();

        //product data
        $data['manufacture'] = $this->clients_model->get_clients_by_id($id);
        $data['sc'] = $this->service_centers_model->get_service_centers();
        //load the view
        $data['main_content'] = 'admin/clients/edit';
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


        $check =  $this->clients_model->check_kvitancy($id);

        if( count($check) >= 1 ) {

            echo "<script language='JavaScript' type='text/javascript'>alert('Не могу удалить клиента!')</script>";
            echo "<script language='JavaScript' type='text/javascript'>window.location.replace('/admin/clients')</script>";

        } else {
            $this->clients_model->delete_clients($id);
            redirect('admin/clients');
        }
    }//edit

}
?>