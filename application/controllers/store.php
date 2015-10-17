<?php
class Store extends CI_Controller {

    /**
     * name of the folder responsible for the views
     * which are manipulated by this controller
     * @constant string
     */
    const VIEW_FOLDER = 'store';

    /**
     * Responsable for auto load the model
     * @return void
     */
    public function __construct() { parent::__construct();



        $this->load->model('store_model');
        $this->load->model('users_model');
        $this->load->model('aparaty_model');
        $this->load->model('proizvoditel_model');







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

        $config['base_url'] = base_url().'store';
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
        $page = $this->uri->segment(2);

        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0){
            $limit_end = 0;
        }

        if ($this->input->post() OR $this->uri->segment(2)) {

            /*Очистка масива для сесиии*/
            if ($this->input->post()) {

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
                    'serial' => '',
                    'id_sost' => '',
                    'user_id' => '',
                    'id_resp' => '',
                    'id_where' => '',
                    'id_sc' => '',
                    'id_kvitancy' => '',
                    'status' => ''                );
            }
            //save session data into the session
            if (isset($filter_session_data)) {
                $this->session->set_userdata($filter_session_data);
            }


            $search_string = $this->input->post("search_string");
            $order = 'id';
            $order_type = $this->input->post("order_type");
            $limit_start = $config['per_page']; //при навигациии надо включить
            $start_date = $this->input->post("start_date");
            $end_date = $this->input->post("end_date");
            $id_aparat = $this->input->post("id_aparat");
            $id_aparat_p = $this->input->post("id_aparat_p");
            $id_proizvod = $this->input->post("id_proizvod");
            $id_sost = $this->input->post("id_sost");
            $id_sc = $this->input->post("id_sc");
            $user_id = $this->input->post("user_id");
            $id_where = $this->input->post("id_where");
            $id_resp = $this->input->post("id_resp");
            $status = $this->input->post("status");
            $id_kvitancy = $this->input->post("id_kvitancy");




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


            // ORDER
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
            // end ORDER





            // START_DATE
            if ($this->input->post("start_date")) {
                $filter_session_data['start_date'] = $start_date;
            } //we have something stored in the session?
            elseif ($this->uri->segment(2)) {
                $start_date = $this->session->userdata('start_date');
            } else {
                //if we have nothing inside session, so it's the default "Asc"
                $start_date = '';
            }
            $data['start_date_selected'] = $start_date;
            // end START_DATE

            // END_DATE
            if ($this->input->post("end_date")) {
                $filter_session_data['end_date'] = $end_date;
            } //we have something stored in the session?
            elseif ($this->uri->segment(2)) {
                $end_date = $this->session->userdata('end_date');
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
            if ($id_sost == '') $id_sost = $sost_in_remont;
            // end ID_SOST


            // user_id
            if ($this->input->post("user_id")) {
                $filter_session_data['user_id'] = $user_id;
            }
            elseif ($this->uri->segment(2)) {
                $user_id = $this->session->userdata('user_id');

            } else {
                $user_id = '';
            }
            $data['user_id_selected'] = $user_id;
            // end user_id


            // id_resp
            if ($this->input->post("id_resp")) {
                $filter_session_data['id_resp'] = $id_resp;
            }
            elseif ($this->uri->segment(2)) {
                $id_resp = $this->session->userdata('id_resp');

            } else {
                $id_resp = '';
            }
            $data['id_resp_selected'] = $user_id;
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
                $status = '';
            }
            $data['status_selected'] = $user_id;
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
            switch ($this->session->userdata('id_group')) {
                case 1: // админ
                    $id_sc = $this->input->post("id_sc");
                    break;


                case 2: // приемщик
                    $id_sc = $this->session->userdata('user_id_sc');
                    break;


                case 3: // инженер
                    $id_sc = $this->session->userdata('user_id_sc');
                    break;

                default:
                    $id_sc = $this->session->userdata('user_id_sc');

            }

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
            $data['count_store'] = $this->store_model->get_store(
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
                $id_sost,
                $user_id,
                $id_resp,
                $id_where,
                $id_sc,
                $id_kvitancy,
                $status,
                1
            );

            $data['store'] = $this->store_model->get_store(

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
                $id_sost,
                $user_id,
                $id_resp,
                $id_where,
                $id_sc,
                $id_kvitancy,
                $status,
                $count = null
            );


            $config['total_rows'] = $data['count_store'];


        } // !end--------------------------POST------------------------------------- //

        else{

//clear session data in session
            $this->session->unset_userdata();

            $data['search_string_selected'] = '';
            $data['order_type_selected'] = '';
            $data['start_date_selected'] = '';
            $data['end_date_selected'] = '';
            $data['id_aparat_selected'] = '';
            $data['id_aparat_p_selected'] = '';
            $data['id_proizvod_selected'] = '';
            $data['id_sost_selected'] = '';
            $data['user_id_selected'] = '';
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
            $start_date = '';
            $end_date = '';
            $id_aparat = '';
            $id_aparat_p = '';
            $id_proizvod = '';
            $id_sost = '';
            $id_sc = '';
            $user_id = '';
            $id_where = '';
            $id_resp = '';
            $status = 1;
            $id_kvitancy = '';

            /*WHAT USER SEE? */

            switch ($this->session->userdata('id_group')) {
                case 1: // админ
                    $id_sc = $this->input->post("id_sc");
                    break;


                case 2: // приемщик
                    $id_sc = $this->session->userdata('user_id_sc');
                    break;


                case 3: // инженер
                    $id_sc = $this->session->userdata('user_id_sc');
                    break;

                default:
                    $id_sc = $this->session->userdata('user_id_sc');
            }

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
                'serial' => '',
                'id_sost' => '',
                'user_id' => '',
                'id_resp' => '',
                'id_where' => '',
                'id_sc' => '',
                'id_kvitancy' => '',
                'status' => ''
            );

            //save session data into the session
            if (isset($filter_session_data)) {
                $this->session->set_userdata($filter_session_data);
            }

            //fetch sql data into arrays
            $data['count_store'] = $this->store_model->get_store(
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
                $id_sost,
                $user_id,
                $id_resp,
                $id_where,
                $id_sc,
                $id_kvitancy,
                $status,
                1
            );

            $data['store'] = $this->store_model->get_store(

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
                $id_sost,
                $user_id,
                $id_resp,
                $id_where,
                $id_sc,
                $id_kvitancy,
                $status,
                $count = null
            );


            $config['total_rows'] = $data['count_store'];


        }

        //load the view
        $data['order'] = 'id_kvitancy';
        $data['ap'] = $this->aparaty_model->get_aparaty();
        $data['meh'] = $this->users_model->get_users('3', '', '', '', '', '');
        $data['proizvoditel'] = $this->proizvoditel_model->get_proizvoditel('', '', '', '', '');
        $data['users'] = $this->users_model->get_users('', '', '', '', '', '');


        /*Загрузка шаблона*/
        $data['main_content'] = 'store/list';
        $this->load->view('includes/template', $data);


    }//index



}
?>