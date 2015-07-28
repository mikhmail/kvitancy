<?php
class Kvitancy extends CI_Controller {

    /**
    * name of the folder responsible for the views 
    * which are manipulated by this controller
    * @constant string
    */
    const VIEW_FOLDER = 'kvitancy';
 
    /**
    * Responsable for auto load the model
    * @return void
    */
    public function __construct() { parent::__construct();
        
        $this->load->model('kvitancy_model');
		$this->load->model('gorod_model');
		$this->load->model('aparaty_model');
		$this->load->model('proizvoditel_model');
		$this->load->model('vid_remonta_model');
		$this->load->model('service_centers_model');
		$this->load->model('users_model');
		$this->load->model('sost_remonta_model');
		$this->load->model('clients_model');
		
		
		
		
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
	
	        //pagination settings
        $config['per_page'] = 20;

        $config['base_url'] = base_url().'kvitancy/';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 3;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
		$config['uri_segment'] = 2;
		$config['display_pages'] = FALSE;
		
        //limit end
        $page = $this->uri->segment(2);

		
		
        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 

		$data['order'] = 'id_kvitancy';
	
	
	// !--------------------------POST------------------------------------- //
		if ($this->input->post() OR $this->uri->segment(2)) {
		
		// надо придумать, данные пост нету при переходе на другую страничку откуда брать ранее введ информ? надо ее засунуть в сесии
		
		//var_dump ($this->input->post());die;
        //all the posts sent by the view
        
		
		//pre selected options
            
            $data['order'] = 'id_kvitancy';
							
							$search_string = $this->input->post("search_string");
							$order = 'id_kvitancy';
							$order_type = $this->input->post("order_type");
							//$limit_start = $config['per_page']; //при навигациии надо включить
							$limit_start='';
							//$limit_end;
							$date = $this->input->post("date");
							$start_date = $this->input->post("start_date");
							$end_date = $this->input->post("end_date");
							$id_mechanic = $this->input->post("id_mechanic");
							$id_aparat = $this->input->post("id_aparat");
							$id_proizvod = $this->input->post("id_proizvod");
							$id_sost = $this->input->post("id_sost");
							$id_sc = $this->input->post("id_sc");
							$id_kvitancy = $this->input->post("id_kvitancy");
							$id_remonta = $this->input->post("id_remonta");	
		
		
		// SEARCH 
				 if($this->input->post()){
            $filter_session_data['search_string'] = $search_string;
        }
        
            //we have something stored in the session? 
            elseif($this->uri->segment(2)){
                $search_string = $this->session->userdata('search_string');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $search_string = '';    
            }
        $data['search_string_selected'] = $search_string; 
		// end SEARCH 
		
		
		// ORDER
         if($this->input->post()){
            $filter_session_data['order_type'] = $order_type;
        }
        
            //we have something stored in the session? 
            elseif($this->uri->segment(2)){
                $order_type = $this->session->userdata('order_type');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'Desc';    
            }
        $data['order_type_selected'] = $order_type;        
		// end ORDER

       
		// DATE type
       if($this->input->post()){
            $filter_session_data['date'] = $date;
        }
        
            //we have something stored in the session? 
            elseif($this->uri->segment(2)){
                $date = $this->session->userdata('date');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $date = 'priemka';    
            }
        $data['date_selected'] = $date; 
		// end DATE type
		
		
		// START_DATE
		if($this->input->post()){
            $filter_session_data['start_date'] = $start_date;
        }
        
            //we have something stored in the session? 
            elseif($this->uri->segment(2)){
                $start_date = $this->session->userdata('start_date');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $start_date = date("Y-m-d", strtotime('-'.date("d"). 'days'));    
            }
		$data['start_date'] = $start_date; 
		// end START_DATE

		// END_DATE
		if($this->input->post()){
            $filter_session_data['end_date'] = $end_date;
        }
        
            //we have something stored in the session? 
            elseif($this->uri->segment(2)){
                $end_date = $this->session->userdata('end_date');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $end_date = date("Y-m-d");    
            }
        $data['end_date'] = $end_date; 
		// end END_DATE

		// ID_MECHANIC
		 if($this->input->post()){
            $filter_session_data['id_mechanic'] = $id_mechanic;
        }
        
            //we have something stored in the session? 
            elseif($this->uri->segment(2)){
                $id_mechanic = $this->session->userdata('id_mechanic');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $id_mechanic = '';    
            }
		$data['id_mechanic_selected'] = $id_mechanic;	
		// end // ID_MECHANIC
		
		
		// ID_APARAT
		if($this->input->post()){
            $filter_session_data['id_aparat'] = $id_aparat;
        }
        
            //we have something stored in the session? 
            elseif($this->uri->segment(2)){
                $id_aparat = $this->session->userdata('id_aparat');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $id_aparat = '';    
            }
		$data['id_aparat_selected'] = $id_aparat;
		// end ID_APARAT
		
		
		// ID_PROIZVOD
		if($this->input->post()){
            $filter_session_data['id_proizvod'] = $id_proizvod;
        }
        
            //we have something stored in the session? 
            elseif($this->uri->segment(2)){
                $id_proizvod = $this->session->userdata('id_proizvod');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $id_proizvod = '';    
            }
		$data['id_proizvod_selected'] = $id_proizvod;
		// end ID_PROIZVOD
		
		
		// ID_SOST
		if($this->input->post()){
            $filter_session_data['id_sost'] = $id_sost;
        }
        
            //we have something stored in the session? 
            elseif($this->uri->segment(2)){
                $id_sost = $this->session->userdata('id_sost');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $id_sost = '';    
            }
		$data['id_sost_selected'] = $id_sost;
		// end ID_SOST
		
		
		// ID_SC
		if($this->input->post()){
            $filter_session_data['id_sc'] = $id_sc;
        }
        
            //we have something stored in the session? 
            elseif($this->uri->segment(2)){
                $id_sc = $this->session->userdata('id_sc');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $id_sc = '';    
            }
		$data['id_sc_selected'] = $id_sc;
		// end ID_SC
		
		// ID_KVITANCY
		if($this->input->post()){
            $filter_session_data['id_kvitancy'] = $id_kvitancy;
        }
        
            //we have something stored in the session? 
            elseif($this->uri->segment(2)){
                $id_kvitancy = $this->session->userdata('id_kvitancy');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $id_kvitancy = '';    
            }
		$data['id_kvitancy_selected'] = $id_kvitancy;
		// end ID_KVITANCY
		
		// ID_REMONTA
		if($this->input->post()){
            $filter_session_data['id_remonta'] = $id_remonta;
        }
        
            //we have something stored in the session? 
            elseif($this->uri->segment(2)){
                $id_remonta = $this->session->userdata('id_remonta');    
            }else{
                //if we have nothing inside session, so it's the default "Asc"
                $id_remonta = '2';    
            }
		$data['id_remonta_selected'] = $id_remonta;
		// end ID_REMONTA
		
		
            //save session data into the session
            if(isset($filter_session_data)){
              $this->session->set_userdata($filter_session_data);    
            }
            

            //fetch sql data into arrays
            $data['count_kvitancys']= $this->kvitancy_model->get_kvitancy(
							$search_string,
							$order,
							$order_type,
							$limit_start,
							$limit_end,
							$date,
							$start_date,
							$end_date,
							$id_mechanic,
							$id_aparat,
							$id_proizvod,
							$id_sost,
							$id_sc,
							$id_kvitancy,
							$id_remonta,
							1
			);
			
            $data['kvitancys'] = $this->kvitancy_model->get_kvitancy(
							
							$search_string,
							$order,
							$order_type,
							$limit_start,
							$limit_end,
							$date,
							$start_date,
							$end_date,
							$id_mechanic,
							$id_aparat,
							$id_proizvod,
							$id_sost,
							$id_sc,
							$id_kvitancy,
							$id_remonta,
							$count=null
			);     
            
			
		
			
			$config['total_rows'] = $data['count_kvitancys'];
			

		}
		// !end--------------------------POST------------------------------------- //
		
		
		
		else{
		
			//clear session data in session
            
			  $this->session->unset_userdata();    
            
		
            //pre selected options from session
            $data['search_string_selected'] = '';
            $data['order'] = 'id_kvitancy';
			$order_type = $data['order_type'] = $data['order_type_selected'] = 'Desc';
			$data['date_selected'] = 'date_priemka';
			$data['start_date'] = date("Y-m-d", strtotime('-'.date("d"). 'days'));  // date("d")
			$data['end_date'] =	date("Y-m-d");
			$data["id_sc_selected"] = '';
			$data["id_mechanic_selected"] = '';
			$data["id_proizvod_selected"] = '';
			$data["id_aparat_selected"] = '';
			$data["id_sost_selected"] = '';
			$data["id_kvitancy_selected"] = '';
			$data["id_remonta_selected"] = '2';
			//end pre selected options
							
							// select to db
							$search_string=null;
							$order='id_kvitancy';
							$order_type='Desc';
							//$limit_start=$config['per_page']; //при навигациии надо включить 
							$limit_start=null;
							//$limit_end;
							$date=null;
							$start_date=null;
							$end_date=null;
							$id_mechanic=null;
							$id_aparat=null;
							$id_proizvod=null;
							$id_sost=array( '1', '3', '4', '5', '6', '10', '17', '18' ); // все что в сервисе кроме выданых.
							$id_sc=null;
							$id_kvitancy=null; 
							$id_remonta = null;
							
							//end select to db
							
							$filter_session_data = array (
													'search_string' => $search_string,
													'order' => $order,
													'order_type' => $order_type,
													'limit_start' => $limit_start,
													'limit_end' => $limit_end,
													'date' => $date,
													'start_date' => $start_date,
													'end_date' => $end_date,
													'id_mechanic' => $id_mechanic,
													'id_aparat' => $id_aparat,
													'id_proizvod' => $id_proizvod,
													'id_sost' => $id_sost,
													'id_sc' => $id_sc,
													'id_kvitancy' => $id_kvitancy,
													'id_remonta' => $id_remonta
							
							);
			
			//save session data into the session
            if(isset($filter_session_data)){
              $this->session->set_userdata($filter_session_data);    
            }
			
            //fetch count kvitancys from db
            $data['count_kvitancys']= $this->kvitancy_model->get_kvitancy(
							$search_string,
							$order,
							$order_type,
							$limit_start,
							$limit_end,
							$date,
							$start_date,
							$end_date,
							$id_mechanic,
							$id_aparat,
							$id_proizvod,
							$id_sost,
							$id_sc,
							$id_kvitancy,
							$id_remonta,
							1
			);
			// end fetch count kvitancys from db
			  
			//fetch kvitancys from db  
            $data['kvitancys'] = $this->kvitancy_model->get_kvitancy(
							$search_string,
							$order,
							$order_type,
							$limit_start,
							$limit_end,
							$date,
							$start_date,
							$end_date,
							$id_mechanic,
							$id_aparat,
							$id_proizvod,
							$id_sost,
							$id_sc,
							$id_kvitancy,
							$id_remonta,
							$count=null
			);     
            
			$config['total_rows'] = $data['count_kvitancys'];
			
        }
		
		//LOAD WIEW
		//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   

		
        //load the view
		$data['ap'] = $this->aparaty_model->get_aparaty();
		$data['sc'] = $this->service_centers_model->get_service_centers('', '', 'Asc', '', '');  
		$data['meh'] = $this->users_model->get_users('3', '', '', '', '', '');  
		$data['proizvoditel'] = $this->proizvoditel_model->get_proizvoditel('', '', '', '', '');  
		$data['sost'] = $this->sost_remonta_model->get_sost_remonta('', '', '', '', '');  
		$data['remont'] = $this->vid_remonta_model->get_vid_remonta();
		$data['soglasovat'] = $this->kvitancy_model->get_kvitancy_soglasovat();
		
        $data['main_content'] = 'kvitancy/list';
        $this->load->view('includes/template', $data);
				

    }//index

public function view ()
{

 //pagination settings
        $config['per_page'] = 20;

        $config['base_url'] = base_url().'kvitancy/';
        $config['use_page_numbers'] = TRUE;
        $config['num_links'] = 3;
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
		$config['uri_segment'] = 2;
		$config['display_pages'] = FALSE;
		
        //limit end
        $page = $this->uri->segment(2);

		
		
        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        } 

		$data['order'] = 'id_kvitancy';


//product id 
       $id_kvitancy = $this->uri->segment(3);
  
		//var_dump ($id_kvitancy);die;

			//clear session data in session
            
			  $this->session->unset_userdata();    
            
		
            //pre selected options
            $data['search_string_selected'] = '';
            $data['order'] = 'id_kvitancy';
			$order_type = $data['order_type'] = $data['order_type_selected'] = 'Desc';
			$data['date_selected'] = 'date_priemka';
			$data['start_date'] = date("Y-m-d", strtotime('-'.date("d"). 'days'));  // date("d")
			$data['end_date'] =	date("Y-m-d");
			$data["id_sc_selected"] = '';
			$data["id_mechanic_selected"] = '';
			$data["id_proizvod_selected"] = '';
			$data["id_aparat_selected"] = '';
			$data["id_sost_selected"] = '';
			$data["id_kvitancy_selected"] = $id_kvitancy;
			$data["id_remonta_selected"] = '2';
							$search_string=null;
							$order='id_kvitancy';
							$order_type='Desc';
							$limit_start=$config['per_page'];
							//$limit_end;
							$date='date_priemka';
							$start_date=date("Y-m-d", strtotime('-'.date("d"). 'days'));  // date("d")
							$end_date=date("Y-m-d");
							$id_mechanic=null;
							$id_aparat=null;
							$id_proizvod=null;
							$id_sost=null;
							$id_sc=null;
							
							$id_remonta = null;
							
							$filter_session_data = array (
							'search_string' => $search_string,
							'order' => $order,
							'order_type' => $order_type,
							'limit_start' => $limit_start,
							'limit_end' => $limit_end,
							'date' => $date,
							'start_date' => $start_date,
							'end_date' => $end_date,
							'id_mechanic' => $id_mechanic,
							'id_aparat' => $id_aparat,
							'id_proizvod' => $id_proizvod,
							'id_sost' => $id_sost,
							'id_sc' => $id_sc,
							'id_kvitancy' => $id_kvitancy,
							'id_remonta' => $id_remonta
							
							);
			
			//save session data into the session
            if(isset($filter_session_data)){
              $this->session->set_userdata($filter_session_data);    
            }
			
            //fetch sql data into arrays
            $data['count_kvitancys']= $this->kvitancy_model->get_kvitancy(
							$search_string,
							$order,
							$order_type,
							$limit_start,
							$limit_end,
							$date,
							$start_date,
							$end_date,
							$id_mechanic,
							$id_aparat,
							$id_proizvod,
							$id_sost,
							$id_sc,
							$id_kvitancy,
							$id_remonta,
							1
			);
			
            $data['kvitancys'] = $this->kvitancy_model->get_kvitancy(
							$search_string,
							$order,
							$order_type,
							$limit_start,
							$limit_end,
							$date,
							$start_date,
							$end_date,
							$id_mechanic,
							$id_aparat,
							$id_proizvod,
							$id_sost,
							$id_sc,
							$id_kvitancy,
							$id_remonta,
							$count=null
			);     
            
			$config['total_rows'] = $data['count_kvitancys'];
			
        
		
		//LOAD WIEW
		//!isset($search_string) && !isset($order)
         
        //initializate the panination helper 
        $this->pagination->initialize($config);   

		
        //load the view
		$data['ap'] = $this->aparaty_model->get_aparaty();
		$data['sc'] = $this->service_centers_model->get_service_centers('', '', 'Asc', '', '');  
		$data['meh'] = $this->users_model->get_users('3', '', '', '', '', '');  
		$data['proizvoditel'] = $this->proizvoditel_model->get_proizvoditel('', '', '', '', '');  
		$data['sost'] = $this->sost_remonta_model->get_sost_remonta('', '', '', '', '');  
		$data['remont'] = $this->vid_remonta_model->get_vid_remonta();
		$data['soglasovat'] = $this->kvitancy_model->get_kvitancy_soglasovat();
        $data['main_content'] = 'kvitancy/list';
        $this->load->view('includes/template', $data);
}

	
    public function add()
    {
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {

            //form validation
            $this->form_validation->set_rules('name_sc', 'name_sc', 'required');
			$this->form_validation->set_rules('adres_sc', 'adres_sc', 'required');
			$this->form_validation->set_rules('rab_sc', 'rab_sc', 'required');
			
			$this->form_validation->set_rules('id_gorod', 'id_gorod', 'required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            

            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
                $data_to_store = array(
                    'name_sc' => $this->input->post('name_sc'),
					'adres_sc' => $this->input->post('adres_sc'),
					'rab_sc' => $this->input->post('rab_sc'),
					'id_gorod' => $this->input->post('id_gorod'),
					'mail_sc' => $this->input->post('mail_sc'),
					'site' => $this->input->post('site')
					
					
                );
				
				
				
                //if the insert has returned true then we show the flash message

                if($this->kvitancy_model->store_kvitancy($data_to_store)){

				    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/kvitancy');
					
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				/*                
				$data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
				*/
                

            }

        }
        //load the view
		$data['gorod'] = $this->gorod_model->get_gorod();
        $data['main_content'] = 'admin/kvitancy/add';
        $this->load->view('includes/template', $data);  
    }       

    /**
    * Update item by his id
    * @return void
    */
    public function update()
    {
        //product id 
        $id = $this->uri->segment(3);
  
        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('id_aparat', 'id_aparat', 'required');
			$this->form_validation->set_rules('id_proizvod', 'id_proizvod', 'required');
			$this->form_validation->set_rules('model', 'Модель', 'required');
			$this->form_validation->set_rules('ser_nomer', 'ser_nomer', 'required');
			
			$this->form_validation->set_rules('neispravnost', 'neispravnost', 'required');
			$this->form_validation->set_rules('komplektnost', 'komplektnost', 'required');
			$this->form_validation->set_rules('id_remonta', 'id_remonta', 'required|numeric');
			$this->form_validation->set_rules('id_sc', 'id_sc', 'required|numeric');
			
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
    
                $data_to_store = array(
                    'id_aparat' => $this->input->post('id_aparat'),
					'id_proizvod' => $this->input->post('id_proizvod'),
					'model' => $this->input->post('model'),
					'ser_nomer' => $this->input->post('ser_nomer'),
					'neispravnost' => $this->input->post('neispravnost'),
					'komplektnost' => $this->input->post('komplektnost'),
					'id_remonta' => $this->input->post('id_remonta'),
					'id_sc' => $this->input->post('id_sc'),
					'primechaniya' => $this->input->post('primechaniya')
					
                );
                //if the insert has returned true then we show the flash message
                if($this->kvitancy_model->update_kvitancy($id, $data_to_store) == TRUE){
				
                //var_dump($data_to_store);
				    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('kvitancy/update/'.$id.'');

            }//validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

		//$data['gorod'] = $this->gorod_model->get_gorod();    
		$data['aparaty'] = $this->aparaty_model->get_aparaty();
		$data['proizvod'] = $this->proizvoditel_model->get_proizvoditel();
		$data['remont'] = $this->vid_remonta_model->get_vid_remonta();
		$data['sc'] = $this->service_centers_model->get_service_centers();
		
		
		
        //product data 
        $data['manufacture'] = $this->kvitancy_model->get_kvitancy_by_id($id);
        //load the view
        $data['main_content'] = 'kvitancy/edit';
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
        $this->kvitancy_model->delete_kvitancy($id);
        redirect('admin/kvitancy');
    }//edit
	
	
	 public function printing()
    {
        //product id 
        $id = $this->uri->segment(3);

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

		
		
		
		
        //product data 
        $data['manufacture'] = $this->kvitancy_model->get_kvitancy_by_id($id);
		
		$id_clienta = $this->kvitancy_model->get_client_by_id($id);
		$data['client'] = $this->clients_model->get_clients_by_id($id_clienta[0]['user_id']);
		
		$data['sc'] = $this->service_centers_model->get_service_centers_by_id($data['manufacture'][0]['id_sc']);
		
		$data['aparat'] = $this->aparaty_model->get_aparaty_by_id($data['manufacture'][0]['id_aparat']);
		$data['proizvod'] = $this->proizvoditel_model->get_proizvoditel_by_id($data['manufacture'][0]['id_proizvod']);
		
        //load the view
        $data['main_content'] = 'kvitancy/printing';
        $this->load->view('includes/print', $data);            

    }
	
	
		 public function printing_check()
    {
        //product id 
        $id = $this->uri->segment(3);

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

		
		
		
		
        //product data 
        $data['manufacture'] = $this->kvitancy_model->get_kvitancy_by_id($id);
		
		$id_clienta = $this->kvitancy_model->get_client_by_id($id);
		$data['client'] = $this->clients_model->get_clients_by_id($id_clienta[0]['user_id']);
		
		$data['sc'] = $this->service_centers_model->get_service_centers_by_id($data['manufacture'][0]['id_sc']);
		
		$data['aparat'] = $this->aparaty_model->get_aparaty_by_id($data['manufacture'][0]['id_aparat']);
		$data['proizvod'] = $this->proizvoditel_model->get_proizvoditel_by_id($data['manufacture'][0]['id_proizvod']);
		
        //load the view
        $data['main_content'] = 'kvitancy/printing_check';
        $this->load->view('includes/print', $data);            

    }

}
?>