<?php
class Admin_devices extends CI_Controller {

    /**
    * name of the folder responsible for the views 
    * which are manipulated by this controller
    * @constant string
    */
    const VIEW_FOLDER = 'admin/devices';
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct() { parent::__construct();
        
        $this->load->model('aparaty_model');

        if(!$this->session->userdata('is_logged_in')){
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
        $config['first_url'] = '1';
        $config['base_url'] = base_url().'admin/devices';
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

        //var_dump($search_string);die;

        //filtered && || paginated
        if($search_string !== false || $this->uri->segment(3) == true){
           


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

            //var_dump($search_string);die;

            //save session data into the session
            if(isset($filter_session_data)){
              $this->session->set_userdata($filter_session_data);    
            }
            

            //fetch sql data into arrays
            $data['count_products']= $this->aparaty_model->count_aparaty($search_string, $order);
            $config['total_rows'] = $data['count_products'];

            //fetch sql data into arrays
            if($search_string){
                if($order){
                    $data['manufacturers'] = $this->aparaty_model->get_aparaty($search_string, $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['manufacturers'] = $this->aparaty_model->get_aparaty($search_string, '', $order_type, $config['per_page'],$limit_end);           
                }
            }else{
                if($order){
                    $data['manufacturers'] = $this->aparaty_model->get_aparaty('', $order, $order_type, $config['per_page'],$limit_end);        
                }else{
                    $data['manufacturers'] = $this->aparaty_model->get_aparaty('', '', $order_type, $config['per_page'],$limit_end);        
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
            $data['count_products']= $this->aparaty_model->count_aparaty();
            $data['manufacturers'] = $this->aparaty_model->get_aparaty('', '', $order_type, $config['per_page'],$limit_end);        
            $config['total_rows'] = $data['count_products'];

        }//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   

        //load the view
        $data['main_content'] = 'admin/devices/list';
        $this->load->view('includes/template', $data);  

    }//index

    public function add()
    {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                    'aparat_name' => $this->input->post('name'),
                );
                //if the insert has returned true then we show the flash message
                if($this->aparaty_model->store_aparaty($data_to_store)){
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            }

        }
        //load the view
        $data['main_content'] = 'admin/devices/add';
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
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
                    'aparat_name' => $this->input->post('name'),
                );
                //if the insert has returned true then we show the flash message
                if($this->aparaty_model->update_aparaty($id, $data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('admin/devices/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //product data 
        $data['manufacture'] = $this->aparaty_model->get_aparaty_by_id($id);
        //load the view
        $data['main_content'] = 'admin/devices/edit';
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

        $check =  $this->aparaty_model->check_kvitancy($id);

        if( count($check) >= 1 ) {

            echo "<script language='JavaScript' type='text/javascript'>alert('Не могу удалить аппарат! Есть квитанции с таким аппаратом.')</script>";
            echo "<script language='JavaScript' type='text/javascript'>window.location.replace('/admin/devices')</script>";

        } else {

        $this->aparaty_model->delete_aparaty($id);
        redirect('admin/devices');
        }
    }//edit

}
?>