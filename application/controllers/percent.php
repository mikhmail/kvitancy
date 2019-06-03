<?php

class Percent extends CI_Controller
{

    /**
     * name of the folder responsible for the views
     * which are manipulated by this controller
     * @constant string
     */
    const VIEW_FOLDER = 'percent';

    /**
     * Responsable for auto load the model
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->model('kvitancy_model');
        $this->load->model('gorod_model');
        $this->load->model('aparaty_model');
        $this->load->model('proizvoditel_model');
        $this->load->model('vid_remonta_model');
        $this->load->model('service_centers_model');
        $this->load->model('users_model');
        $this->load->model('sost_remonta_model');
        $this->load->model('clients_model');
        $this->load->model('stat_model');



        if (!$this->session->userdata('is_logged_in')) {
            redirect('admin/login');
        }

        if ($this->session->userdata('work_type') == 1) {
            redirect('works');
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
        $config['base_url'] = base_url() . 'stat/';
        $config['use_page_numbers'] = TRUE;
        //$config['num_links'] = 10;
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
        $config['display_pages'] = TRUE;

        //limit end
        $page = $this->uri->segment(2);


        //math to get the initial record to be select in the database
        $limit_end = ($page * $config['per_page']) - $config['per_page'];
        if ($limit_end < 0) {
            $limit_end = 0;
        }


        $sost_in_remont = $this->sost_remonta_model->get_sost_remonta_in_remont();

        // !--------------------------POST------------------------------------- //
        if ($this->input->post() OR $this->uri->segment(2)) {

            /*Очистка масива для сесиии*/
            if ($this->input->post()) {

                $filter_session_data = array(
                    'search_string' => '',
                    'order' => '',
                    'order_type' => '',
                    'limit_start' => '',
                    'limit_end' => '',
                    'date' => '',
                    'start_date' => '',
                    'end_date' => '',
                    'id_mechanic' => '',
                    'id_aparat' => '',
                    'id_proizvod' => '',
                    'id_sost' => '',
                    'id_sc' => '',
                    'id_kvitancy' => '',
                    'id_remonta' => ''

                );
            }
            //save session data into the session
            if (isset($filter_session_data)) {
                $this->session->set_userdata($filter_session_data);
            }


            $search_string = $this->input->post("search_string");
            $order = 'id_kvitancy';
            $order_type = $this->input->post("order_type");
            $limit_start = $config['per_page']; //при навигациии надо включить
            //$limit_start='300';
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
            $id_responsible = null;


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


            // DATE type
            if ($this->input->post("date")) {
                $filter_session_data['date'] = $date;
            } //we have something stored in the session?
            elseif ($this->uri->segment(2)) {
                $date = $this->session->userdata('date');
            } else {
                //if we have nothing inside session, so it's the default "Asc"
                $date = 'priemka';
            }
            $data['date_selected'] = $date;
            // end DATE type


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
            $data['start_date'] = $start_date;
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
            $data['end_date'] = $end_date;
            // end END_DATE

            // ID_MECHANIC
            if ($this->input->post("id_mechanic")) {
                $filter_session_data['id_mechanic'] = $id_mechanic;
            } //we have something stored in the session?
            elseif ($this->uri->segment(2)) {
                $id_mechanic = $this->session->userdata('id_mechanic');
            } else {
                //if we have nothing inside session, so it's the default "Asc"
                $id_mechanic = '';
            }
            $data['id_mechanic_selected'] = $id_mechanic;
            // end // ID_MECHANIC


            // ID_APARAT
            if ($this->input->post("id_aparat")) {
                $filter_session_data['id_aparat'] = $id_aparat;
            } //we have something stored in the session?
            elseif ($this->uri->segment(2)) {
                if ($this->session->userdata('id_aparat')) {
                    $id_aparat = $this->session->userdata('id_aparat');
                }else{
                    $id_aparat = '';
                }

            } else {
                //if we have nothing inside session, so it's the default "Asc"
                $id_aparat = '';
            }
            $data['id_aparat_selected'] = $id_aparat;
            // end ID_APARAT


            // ID_PROIZVOD
            if ($this->input->post("id_proizvod")) {
                $filter_session_data['id_proizvod'] = $id_proizvod;
            } //we have something stored in the session?
            elseif ($this->uri->segment(2)) {
                if ($this->session->userdata('id_proizvod')) {
                    $id_proizvod = $this->session->userdata('id_proizvod');
                }else{
                    $id_proizvod ='';
                }

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
                if ($this->session->userdata('id_sost')) {
                    $id_sost = $this->session->userdata('id_sost');
                }else{
                    $id_sost = '';
                }
            } else {
                $id_sost = '';
            }
            $data['id_sost_selected'] = $id_sost;
            if ($id_sost == '') $id_sost = null;
            // end ID_SOST


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

            // ID_REMONTA
            if ($this->input->post("id_remonta")) {
                $filter_session_data['id_remonta'] = $id_remonta;
            } //we have something stored in the session?
            elseif ($this->uri->segment(2)) {
                $id_remonta = $this->session->userdata('id_remonta');
            } else {
                //if we have nothing inside session, so it's the default "Asc"
                $id_remonta = '';
            }
            $data['id_remonta_selected'] = $id_remonta;
            // end ID_REMONTA


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
            $data['count_kvitancys'] = $this->stat_model->get_kvitancy(
                $search_string,
                $order,
                $order_type,
                $limit_start,
                $limit_end,
                $date,
                $start_date,
                $end_date,
                $this->session->userdata('user_id'),
                $id_aparat,
                $id_proizvod,
                $id_sost,
                $id_sc,
                $id_kvitancy,
                $id_remonta,
                $id_responsible,
                1,
                $summ=null

            );

            $data['kvitancys'] = $this->stat_model->get_kvitancy(

                $search_string,
                $order,
                $order_type,
                $limit_start,
                $limit_end,
                $date,
                $start_date,
                $end_date,
                $this->session->userdata('user_id'),
                $id_aparat,
                $id_proizvod,
                $id_sost,
                $id_sc,
                $id_kvitancy,
                $id_remonta,
                $id_responsible,
                $count = null,
                $summ=null

            );

            $summa = $this->stat_model->get_kvitancy(

                $search_string,
                $order,
                $order_type,
                $limit_start,
                $limit_end,
                $date,
                $start_date,
                $end_date,
                $this->session->userdata('user_id'),
                $id_aparat,
                $id_proizvod,
                $id_sost,
                $id_sc,
                $id_kvitancy,
                $id_remonta,
                $id_responsible,
                $count = null,
                $summ=1

            );

            $data['summ'] = $this->stat_model->get_summ($summa);
            $data['store'] = $this->stat_model->get_all_store($summa);
            $data['works'] = $this->stat_model->get_all_works($summa);


            $config['total_rows'] = $data['count_kvitancys'];


        } // !end--------------------------POST------------------------------------- //


        else {

            $filter_session_data = array(
                'search_string' => '',
                'order' => 'id_kvitancy',
                'order_type' => 'Desc',
                'limit_start' => '',
                'limit_end' => '',
                'date' => 'date_priemka',
                'start_date' => date('Y') . '-'. date('m') . '-01',
                'end_date' => date("Y-m-d"),
                'id_mechanic' => '',
                'id_aparat' => '',
                'id_proizvod' => '',
                'id_sost' => '',
                'id_sc' => '',
                'id_kvitancy' => '',
                'id_remonta' => ''

            );

            //clear session data in session
            $this->session->set_userdata($filter_session_data);

            //pre selected options from session
            $data['search_string_selected'] = '';
            $data['order'] = 'id_kvitancy';
            $order_type = $data['order_type'] = $data['order_type_selected'] = 'Desc';
            $data['date_selected'] = 'date_priemka';
            $data['start_date'] = date('Y') . '-'. date('m') . '-01';
            $data['end_date'] = date("Y-m-d");
            //$data["id_sc_selected"] = '';
            $data["id_mechanic_selected"] = $this->session->userdata('user_id');
            $data["id_proizvod_selected"] = '';
            $data["id_aparat_selected"] = '';
            $data["id_sost_selected"] = '';
            $data["id_kvitancy_selected"] = '';
            $data["id_remonta_selected"] = '';
            //end pre selected options

            // $var for select to db
            $search_string = null;
            $order = 'id_kvitancy';
            $order_type = 'Desc';
            $limit_start = $config['per_page']; //при навигациии надо включить
            //$limit_start=null;
            //$limit_end;
            $date = 'date_priemka';
            $start_date = date('Y') . '-'. date('m') . '-01';
            $end_date = date("Y-m-d");
            $id_mechanic = null;
            $id_aparat = null;
            $id_proizvod = null;
            $id_sost = null;
            $id_kvitancy = null;
            $id_remonta = null;

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


            //fetch count kvitancys from db
            $data['count_kvitancys'] = $this->stat_model->get_kvitancy(
                $search_string,
                $order,
                $order_type,
                $limit_start,
                $limit_end,
                $date,
                $start_date,
                $end_date,
                $this->session->userdata('user_id'),
                $id_aparat,
                $id_proizvod,
                $id_sost,
                $id_sc,
                $id_kvitancy,
                $id_remonta,
                $id_responsible = null,
                1

            );
            // end fetch count kvitancys from db

            //fetch kvitancys from db
            $data['kvitancys'] = $this->stat_model->get_kvitancy(
                $search_string,
                $order,
                $order_type,
                $limit_start,
                $limit_end,
                $date,
                $start_date,
                $end_date,
                $this->session->userdata('user_id'),
                $id_aparat,
                $id_proizvod,
                $id_sost,
                $id_sc,
                $id_kvitancy,
                $id_remonta,
                $id_responsible = null,
                $count = null

            );


            $summa = $this->stat_model->get_kvitancy(

                $search_string,
                $order,
                $order_type,
                $limit_start,
                $limit_end,
                $date,
                $start_date,
                $end_date,
                $this->session->userdata('user_id'),
                $id_aparat,
                $id_proizvod,
                $id_sost,
                $id_sc,
                $id_kvitancy,
                $id_remonta,
                $id_responsible,
                $count = null,
                $summ=1

            );

            $data['summ'] = $this->stat_model->get_percent_summ($summa);
            //$data['store'] = $this->stat_model->get_all_store($summa);
            $data['works'] = $this->stat_model->get_all_works($summa);


        } //end else if POST

        $config['total_rows'] = $data['count_kvitancys'];
        $this->pagination->initialize($config);


        //var_dump($this->session->userdata);die;test




        //load the view
        $data['order'] = 'id_kvitancy';
        $data['ap'] = $this->aparaty_model->get_aparaty();

        //$data['meh'] = $this->users_model->get_users('3', '', '', '', '', '');
        $data['proizvoditel'] = $this->proizvoditel_model->get_proizvoditel('', '', '', '', '');
        $data['sost'] = $this->sost_remonta_model->get_sost_remonta('', '', '', '', '');
        $data['remont'] = $this->vid_remonta_model->get_vid_remonta();

        $data['users'] = $this->users_model->get_users('', '', '', '', '', '');

        /*
        $data['aparats'] = $this->kvitancy_model->get_kvitancy(
            $search_string = null,
            $order = 'aparat.aparat_name',
            $order_type = 'Asc',
            $limit_start = null,
            $limit_end = null,
            $date = null,
            $start_date = null,
            $end_date = null,
            $id_mechanic = null,
            $id_aparat = null,
            $id_proizvod = null,
            $id_sost = $sost_in_remont,
            $id_sc,
            $id_kvitancy = null,
            $id_remonta = null,
            $id_responsible = null,
            $count = null,
            $summ = null

        );
        */

        /*Что видит юзер id_group  */
        switch ($this->session->userdata('id_group')) {
            case 1: // админ

                if($this->session->userdata('show_my_tickets') == 1) {
                    $data['my_kvitancy'] = $this->kvitancy_model->get_my_kvitancy($this->session->userdata('user_id'));
                } else {
                    $data['my_kvitancy'] = array();
                }

                if($this->session->userdata('show_call_tickets') == 1) {
                    $data['soglasovat'] = $this->kvitancy_model->get_kvitancy_soglasovat();
                } else {
                    $data['soglasovat'] = array();
                }

                $data['meh'] = $this->users_model->get_users('', '', '', '', '', '', $this->session->userdata('user_id_sc'));
                $data['resp'] = $this->users_model->get_users('', '', '', '', '', '', '');
                $data['sc'] = $this->service_centers_model->get_service_centers('', '', 'Asc', '', '');
                $data["id_sc_selected"] = '';
                break;


            case 2: // приемщик

                if($this->session->userdata('show_my_tickets') == 1) {
                    $data['my_kvitancy'] = $this->kvitancy_model->get_my_kvitancy($this->session->userdata('user_id'), $this->session->userdata('user_id_sc'));
                } else {
                    $data['my_kvitancy'] = array();
                }

                if($this->session->userdata('show_call_tickets') == 1) {
                    $data['soglasovat'] = $this->kvitancy_model->get_kvitancy_soglasovat($this->session->userdata('user_id_sc'));
                } else {
                    $data['soglasovat'] = array();
                }



                $data['meh'] = $this->users_model->get_users('', '', '', '', '', '', $this->session->userdata('user_id_sc'));
                $data['resp'] = $this->users_model->get_users('', '', '', '', '', '', $this->session->userdata('user_id_sc'));
                $data['sc'] = $this->service_centers_model->get_service_centers('', '', 'Asc', '', '', $this->session->userdata('user_id_sc'));
                $data["id_sc_selected"] = $this->session->userdata('user_id_sc');
                break;


            case 3: // инженер

                if($this->session->userdata('show_my_tickets') == 1) {
                    $data['my_kvitancy'] = $this->kvitancy_model->get_my_kvitancy($this->session->userdata('user_id'), $this->session->userdata('user_id_sc'));
                } else {
                    $data['my_kvitancy'] = array();
                }

                if($this->session->userdata('show_call_tickets') == 1) {
                    $data['soglasovat'] = $this->kvitancy_model->get_kvitancy_soglasovat($this->session->userdata('user_id_sc'));
                } else {
                    $data['soglasovat'] = array();
                }


                $data['meh'] = $this->users_model->get_users('', '', '', '', '','', $this->session->userdata('user_id_sc'));
                $data['resp'] = $this->users_model->get_users('', '', '', '', '', '', $this->session->userdata('user_id_sc'));
                $data['sc'] = $this->service_centers_model->get_service_centers('', '', 'Asc', '', '', $this->session->userdata('user_id_sc'));
                $data["id_sc_selected"] = $this->session->userdata('user_id_sc');
                break;

            default: //мало ли кто еще :)


                if($this->session->userdata('show_my_tickets') == 1) {
                    $data['my_kvitancy'] = $this->kvitancy_model->get_my_kvitancy($this->session->userdata('user_id'), $this->session->userdata('user_id_sc'));
                } else {
                    $data['my_kvitancy'] = array();
                }

                if($this->session->userdata('show_call_tickets') == 1) {
                    $data['soglasovat'] = $this->kvitancy_model->get_kvitancy_soglasovat($this->session->userdata('user_id_sc'));
                } else {
                    $data['soglasovat'] = array();
                }


                $data['meh'] = $this->users_model->get_users('3', '', '', '', '','',$this->session->userdata('user_id_sc'));
                $data['resp'] = $this->users_model->get_users('', '', '', '', '', '', $this->session->userdata('user_id_sc'));
                $data['sc'] = $this->service_centers_model->get_service_centers('', '', 'Asc', '', '', $this->session->userdata('user_id_sc'));
                $data["id_sc_selected"] = $this->session->userdata('user_id_sc');
        }

        /* END Что видит юзер id_group */

        /*Загрузка шаблона*/
        $data['main_content'] = 'admin/percent/list';
        $this->load->view('includes/template', $data);


    }// end index



}//end class

?>