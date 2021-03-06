<?php
class Works extends CI_Controller {

    /**
     * name of the folder responsible for the views
     * which are manipulated by this controller
     * @constant string
     */
    const VIEW_FOLDER = 'works';

    /**
     * Responsable for auto load the model
     * @return void
     */
    public function __construct() { parent::__construct();

    //var_dump($this->session->userdata);die;

        $this->load->model('works_model');
        $this->load->model('users_model');
        $this->load->model('aparaty_model');
        $this->load->model('proizvoditel_model');
        $this->load->model('service_centers_model');


        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }

        if ($this->session->userdata('work_type') == 2) {
            redirect('percent');
        }

    }

    public function index()
    {

        //all the posts sent by the view


        //pagination settings
        //pagination settings
        $config['per_page'] = 10;
        $config['base_url'] = base_url() . 'works/';
        $config['use_page_numbers'] = TRUE;
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

        $config['uri_segment'] = 2;

        //limit end
        $page = $this->uri->segment(count($this->uri->segment_array()));

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        }

        if ($this->input->post() OR $this->uri->segment(2)) {

            $search_string = $this->input->post('search_string');
            $order = $this->input->post('order');
            $order_type = $this->input->post('order_type');

            /*Очистка масива для сесиии*/
            if ($this->input->post()) {

                $filter_session_data = array(
                    'search_string' => '',
                    'order' => '',
                    'order_type' => '',
                    'limit_start' => '',
                    'start_date' => '',
                    'end_date' => '',
                    'id_aparat' => '',
                    'id_proizvod' => '',
                    'id_kvitancy' => '',
                    'id_sc' => ''

                                 );
            }
            //save session data into the session
            if (isset($filter_session_data)) {
                $this->session->set_userdata($filter_session_data);
            }


            $search_string = $this->input->post("search_string");
            $order = $this->input->post("order");
            $order_type = $this->input->post("order_type");
            $limit_start = $config['per_page']; //при навигациии надо включить
            $start_date = $this->input->post("start_date");
            $end_date = $this->input->post("end_date");
            $id_aparat = $this->input->post("id_aparat");
            $id_proizvod = $this->input->post("id_proizvod");
            $id_kvitancy = $this->input->post("id_kvitancy");
            $id_sc = $this->input->post("id_sc");





            // SEARCH
            if ($this->input->post("search_string")) {
                $filter_session_data['search_string'] = $search_string;
            } //we have something stored in the session?
            elseif ($this->uri->segment(2)) {
                $search_string = $this->session->userdata('search_string');
            } else {
                //if we have nothing inside session, so it's the default "Asc"
                $search_string = '';
            }
            $data['search_string_selected'] = $search_string;
            // end SEARCH


            // ORDER type
            if ($this->input->post("order_type")) {
                $filter_session_data['order_type'] = $order_type;
            } //we have something stored in the session?
            elseif ($this->uri->segment(2)) {
                $order_type = $this->session->userdata('order_type');
            } else {
                //if we have nothing inside session, so it's the default "Asc"
                $order_type = 'Desc';
            }
            $data['order_type_selected'] = $order_type;
            // end ORDER type

            // ORDER
            if ($this->input->post("order")) {
                $filter_session_data['order'] = $order;
            } //we have something stored in the session?
            elseif ($this->uri->segment(2)) {
                $order = $this->session->userdata('order');
            } else {
                //if we have nothing inside session, so it's the default "Asc"
                $order = 'id';
            }
            $data['order_selected'] = $order;
            // end ORDER


            //$s = strtotime('-1 month');
            //$m = date("m", $s);
            $m = date("m");

            // START_DATE
            if ($this->input->post("start_date")) {
                $filter_session_data['start_date'] = $start_date;
            } //we have something stored in the session?
            elseif ($this->uri->segment(2)) {
                if ($this->session->userdata('start_date')) {
                    $start_date = $this->session->userdata('start_date');
                }else{
                    $start_date = date('Y') . '-'. $m . '-01';
                }

            } else {
                //if we have nothing inside session, so it's the default "Asc"
                $start_date = date('Y') . '-'. $m . '-01';
            }
            $data['start_date_selected'] = $start_date;
            // end START_DATE

            // END_DATE
            if ($this->input->post("end_date")) {
                $filter_session_data['end_date'] = $end_date;
            } //we have something stored in the session?
            elseif ($this->uri->segment(2)) {
                if ($this->session->userdata('end_date')) {
                    $end_date = $this->session->userdata('end_date');
                }else{
                    $end_date = date("Y-m-d");
                }

            } else {
                //if we have nothing inside session, so it's the default "Asc"
                $end_date = date("Y-m-d");
            }
            $data['end_date_selected'] = $end_date;
            // end END_DATE




            // ID_APARAT
            if ($this->input->post("id_aparat")) {
                $filter_session_data['id_aparat'] = $id_aparat;
            } //we have something stored in the session?
            elseif ($this->uri->segment(2)) {
                $id_aparat = $this->session->userdata('id_aparat');
            } else {
                //if we have nothing inside session, so it's the default "Asc"
                $id_aparat = '';
            }
            $data['id_aparat_selected'] = $id_aparat;
            // end ID_APARAT

            // ID_APARAT_P
            if ($this->input->post("id_aparat_p")) {
                $filter_session_data['id_aparat_p'] = $id_aparat_p;
            } //we have something stored in the session?
            elseif ($this->uri->segment(2)) {
                $id_aparat_p = $this->session->userdata('id_aparat_p');
            } else {
                //if we have nothing inside session, so it's the default "Asc"
                $id_aparat_p = '';
            }
            $data['id_aparat_p_selected'] = $id_aparat;
            // end ID_APARAT_P

            // ID_PROIZVOD
            if ($this->input->post("id_proizvod")) {
                $filter_session_data['id_proizvod'] = $id_proizvod;
            } //we have something stored in the session?
            elseif ($this->uri->segment(2)) {
                $id_proizvod = $this->session->userdata('id_proizvod');
            } else {
                //if we have nothing inside session, so it's the default "Asc"
                $id_proizvod = '';
            }
            $data['id_proizvod_selected'] = $id_proizvod;
            // end ID_PROIZVOD


            // ID_SOST
            if ($this->input->post("id_sost")) {
                $filter_session_data['id_sost'] = $id_sost;
            }
            elseif ($this->uri->segment(2)) {
                $id_sost = $this->session->userdata('id_sost');

            } else {
                $id_sost = '';
            }
            $data['id_sost_selected'] = $id_sost;
            // end ID_SOST


            // store_user_id
            if ($this->input->post("store_user_id")) {
                $filter_session_data['store_user_id'] = $store_user_id;
            }
            elseif ($this->uri->segment(2)) {
                $store_user_id = $this->session->userdata('store_user_id');

            } else {
                $store_user_id = '';
            }
            $data['store_user_id_selected'] = $store_user_id;
            // end store_user_id


            // id_resp
            if ($this->input->post("id_resp")) {
                $filter_session_data['id_resp'] = $id_resp;
            }
            elseif ($this->uri->segment(2)) {
                $id_resp = $this->session->userdata('id_resp');

            } else {
                $id_resp = '';
            }
            $data['id_resp_selected'] = $id_resp;
            // end id_resp

            // id_where
            if ($this->input->post("id_where")) {
                $filter_session_data['id_where'] = $id_where;
            }
            elseif ($this->uri->segment(2)) {
                $id_where = $this->session->userdata('id_where');

            } else {
                $id_where = '';
            }
            $data['id_where_selected'] = $id_where;
            // end id_where

            // status
            if ($this->input->post("status")) {
                $filter_session_data['status'] = $status;
            }
            elseif ($this->uri->segment(2)) {
                $status = $this->session->userdata('status');

            } else {
                $status = '1';
            }
            $data['status_selected'] = $status;
            // end status


            // ID_KVITANCY
            if ($this->input->post("id_kvitancy")) {
                $filter_session_data['id_kvitancy'] = $id_kvitancy;
            } //we have something stored in the session?
            elseif ($this->uri->segment(2)) {
                //$id_kvitancy = $this->session->userdata('id_kvitancy');
                $id_kvitancy = '';
            } else {
                //if we have nothing inside session, so it's the default "Asc"
                $id_kvitancy = '';
            }
            $data['id_kvitancy_selected'] = $id_kvitancy;
            // end ID_KVITANCY



            // ID_SC


            if ($id_sc) {
                $filter_session_data['id_sc'] = $id_sc;
            } //we have something stored in the session?
            elseif ($this->uri->segment(2)) {
                $id_sc = $this->session->userdata('id_sc');
            } else {  $id_sc = ''; }

            $data['id_sc_selected'] = $id_sc;
            // end ID_SC


            //save session data into the session
            if (isset($filter_session_data)) {
                $this->session->set_userdata($filter_session_data);
            }


            //fetch sql data into arrays
            $data['count_works'] = $this->works_model->get_works(
                $search_string,
                $order,
                $order_type,
                $limit_start,
                $limit_end,
                $start_date,
                $end_date,
                $id_aparat,
                $id_aparat_p,
                $id_proizvod,

                $id_kvitancy,
                $id_sc,

                1,
                $summ=null
            );

            $data['summ'] = $this->works_model->get_works(
                $search_string,
                $order,
                $order_type,
                $limit_start,
                $limit_end,
                $start_date,
                $end_date,
                $id_aparat,
                $id_aparat_p,
                $id_proizvod,

                $id_kvitancy,
                $id_sc,

                0,
                $summ=1
            );

            $data['works'] = $this->works_model->get_works(

                $search_string,
                $order,
                $order_type,
                $limit_start,
                $limit_end,
                $start_date,
                $end_date,
                $id_aparat,
                $id_aparat_p,
                $id_proizvod,

                $id_kvitancy,
                $id_sc,

                $count = null,
                $summ=null
            );



            $config['total_rows'] = $data['count_works'];


        } // !end--------------------------POST------------------------------------- //

        else{



//clear session data in session
            $this->session->unset_userdata();

            $s = strtotime('-1 month');
            $m = date("m", $s);

            $data['search_string_selected'] = '';
            $data['order_type_selected'] = '';
            $data['order_selected'] = 'id';
            $data['start_date_selected'] = date('Y') . '-'. date('m') . '-01';
            $data['end_date_selected'] = date("Y-m-d");
            $data['id_aparat_selected'] = '';
            $data['id_aparat_p_selected'] = '';
            $data['id_proizvod_selected'] = '';
            $data['id_sost_selected'] = '';
            $data['store_user_id_selected'] = '';
            $data['id_resp_selected'] = '';
            $data['id_where_selected'] = '';
            $data['status_selected'] = 1;
            $data['id_kvitancy_selected'] = '';
            $data['id_sc_selected'] = '';
            //end pre selected options




            $search_string = '';
            $order = '';
            $order_type = '';
            $limit_start = $config['per_page']; //при навигациии надо включить
            $start_date = date('Y') . '-'. $m . '-31';
            $end_date = date("Y-m-d");
            $id_aparat = '';
            $id_aparat_p = '';
            $id_proizvod = '';
            $id_kvitancy = '';
            $id_sc = '';
            $summ=null;

           

            /*WHAT USER SEE? */

            //end $vars to select to db




            /*Масив для сесиии*/
            $filter_session_data = array(
                'search_string' => '',
                'order' => '',
                'order_type' => '',
                'limit_start' => '',
                'limit_end' => '',
                'start_date' => '',
                'end_date' => '',
                'id_aparat' => '',
                'id_aparat_p' => '',
                'id_proizvod' => '',
                'id_kvitancy' => '',
                'id_sc' => ''

            );

            //save session data into the session
            if (isset($filter_session_data)) {
                $this->session->set_userdata($filter_session_data);
            }

            //fetch sql data into arrays
            $data['count_works'] = $this->works_model->get_works(
                $search_string,
                $order,
                $order_type,
                $limit_start,
                $limit_end,
                $start_date,
                $end_date,
                $id_aparat,
                $id_aparat_p,
                $id_proizvod,

                $id_kvitancy,
                $id_sc,

                1,
                $summ=null
            );

            $data['summ'] = $this->works_model->get_works(
                $search_string,
                $order,
                $order_type,
                $limit_start,
                $limit_end,
                $start_date,
                $end_date,
                $id_aparat,
                $id_aparat_p,
                $id_proizvod,

                $id_kvitancy,
                $id_sc,

                0,
                $summ=1
            );

            $data['works'] = $this->works_model->get_works(

                $search_string,
                $order,
                $order_type,
                $limit_start,
                $limit_end,
                $start_date,
                $end_date,
                $id_aparat,
                $id_aparat_p,
                $id_proizvod,

                $id_kvitancy,
                $id_sc,

                $count = null,
                $summ=null
            );

        }

        $config['total_rows'] = $data['count_works'];

        $this->pagination->initialize($config);

        //load the view
        $data['order'] = 'id_kvitancy';

        $data['ap'] = $this->aparaty_model->get_aparaty();
        $data['meh'] = $this->users_model->get_users('3', '', '', '', '', '');
        $data['proizvoditel'] = $this->proizvoditel_model->get_proizvoditel('', '', '', '', '');
        $data['users'] = $this->users_model->get_users('', '', '', '', '', '');
        $data['sc'] = $this->service_centers_model->get_service_centers('', '', 'Asc', '', '', '');



        /*Загрузка шаблона*/
        $data['main_content'] = 'works/list';
        $this->load->view('includes/template', $data);


    }//index

    public function delete()
    {
        //product id
        $id = $this->uri->segment(3);
        //var_dump($id);die;
        $this->works_model->delete_works($id);
        redirect('works');

    }//delete

    public function update()
    {
        //product id
        $id = $this->uri->segment(3);

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('id_aparat', 'id_aparat', 'required|numeric');
            $this->form_validation->set_rules('id_aparat_p', 'id_aparat_p', 'required|numeric');
            $this->form_validation->set_rules('id_proizvod', 'id_proizvod', 'required|numeric');
            $this->form_validation->set_rules('id_sost', 'id_sost', 'required|numeric');
            $this->form_validation->set_rules('cost', 'cost', 'required|numeric');
            $this->form_validation->set_rules('price', 'price', 'required|numeric');
            $this->form_validation->set_rules('id_resp', 'id_resp', 'required|numeric');
            $this->form_validation->set_rules('id_where', 'id_where', 'required|numeric');








            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {

                $data_to_store = array(
                    'name' => $this->input->post('name'),
                    'id_aparat' => $this->input->post('id_aparat'),
                    'id_aparat_p' => $this->input->post('id_aparat_p'),
                    'id_proizvod' => $this->input->post('id_proizvod'),
                    'id_sost' => $this->input->post('id_sost'),
                    'cost' => $this->input->post('cost'),
                    'price' => $this->input->post('price'),
                    'id_resp' => $this->input->post('id_resp'),
                    'id_where' => $this->input->post('id_where'),
                    'serial' => $this->input->post('serial'),
                    'vid' => $this->input->post('vid')
                );
                //if the insert has returned true then we show the flash message
                if($this->works_model->update_store($id, $data_to_store) == TRUE){

                    //var_dump($data_to_store);
                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('store/update/'.$id.'');

            }//validation run

        }



        //product data
        $data['store'] = $this->works_model->get_store_by_id($id);
        $data['sc'] = $this->service_centers_model->get_service_centers();
        $data['resp'] = $this->users_model->get_users('', '', '', '', '', '', '');
        $data['aparat'] = $this->aparaty_model->get_aparaty();
        $data['proizvoditel'] = $this->proizvoditel_model->get_proizvoditel('', '', '', '', '');
        //load the view
        $data['main_content'] = 'store/edit';
        $this->load->view('includes/template', $data);

    }//update


    public function add()
    {

        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('id_aparat', 'id_aparat', 'required|numeric');
            //$this->form_validation->set_rules('id_aparat_p', 'id_aparat_p', 'required|numeric');
            $this->form_validation->set_rules('id_proizvod', 'id_proizvod', 'required|numeric');
            $this->form_validation->set_rules('id_sost', 'id_sost', 'required|numeric');
            $this->form_validation->set_rules('cost', 'cost', 'required|numeric');
            $this->form_validation->set_rules('price', 'price', 'required|numeric');
            $this->form_validation->set_rules('id_resp', 'id_resp', 'required|numeric');
            $this->form_validation->set_rules('id_where', 'id_where', 'required|numeric');
            $this->form_validation->set_rules('count', 'count', 'required|numeric');



            $this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {

                $data_to_store = array(
                    'name' => $this->input->post('name'),
                    'id_aparat' => $this->input->post('id_aparat'),
                    'id_aparat_p' => $this->input->post('id_aparat_p'),
                    'id_proizvod' => $this->input->post('id_proizvod'),
                    'model' => '',
                    'serial' => $this->input->post('serial'),
                    'vid' => $this->input->post('vid'),
                    'id_sost' => $this->input->post('id_sost'),
                    'user_id' => $this->session->userdata['user_id'],
                    'date_priemka' => date("Y-m-j"),
                    'cost' => $this->input->post('cost'),
                    'price' => $this->input->post('price'),
                    'status' => 1,

                    'update_user' => $this->session->userdata['user_id'],
                    'update_time' => date("j-m-Y, H:i:s"),
                    'id_resp' => $this->session->userdata['user_id'],
                    'id_from' => $this->session->userdata['user_id_sc'],
                    'id_where' => $this->session->userdata['user_id_sc'],
                    'id_sc' => $this->session->userdata['user_id_sc']

                );

                $count =  $this->input->post('count');
                if($count>=1) {
                    for($i=1;$i<=$count;$i++) {
                        $id = $this->works_model->add_store($data_to_store);
                    }
                }


                if($id == TRUE){


                    $this->session->set_flashdata('flash_message', 'updated');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('store');

            }//validation run

        }



        //product data
        //$data['sc'] = $this->service_centers_model->get_service_centers();
        //$data['resp'] = $this->users_model->get_users('', '', '', '', '', '', '');
        //$data['aparat'] = $this->aparaty_model->get_aparaty();
        //$data['proizvoditel'] = $this->proizvoditel_model->get_proizvoditel('', '', '', '', '');
        //load the view
        $data['main_content'] = 'store/add';
        $this->load->view('includes/template', $data);

    }//add


}
?>