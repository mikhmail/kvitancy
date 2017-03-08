<?php

class Tickets extends CI_Controller
{

    /**
     * name of the folder responsible for the views
     * which are manipulated by this controller
     * @constant string
     */
    const VIEW_FOLDER = 'tickets';

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
        //$this->load->model('parts_model');



        if (!$this->session->userdata('is_logged_in')) {
            redirect('admin/login');
        }
    }

    /**
     * Load the main view with all the current model model's data.
     * @return void
     */
    public function index()
    {


        $page = $this->uri->segment(2);
        //pagination settings
        //$config['per_page'] = 20;
        $config['per_page'] = $this->kvitancy_model-> get_tickets_per_page();
        $config['base_url'] = base_url() . 'tickets/';
        $config['use_page_numbers'] = TRUE;
        $config['display_pages'] = TRUE;
        $config['uri_segment'] = 2;
        $config['first_url'] = '1';
        $config['num_links'] = 2;
        //$config['display_pages'] = TRUE;

        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open']  = '<li>';
        $config['num_tag_close'] = '</li>';

        //$config['first_link']      = 'First';
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';

        //$config['last_link']      = 'Last';
        $config['last_tag_open']  = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['next_link']      = '»';
        $config['next_tag_open']  = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['prev_link']      = '«';
        $config['prev_tag_open']  = '<li>';
        $config['prev_tag_close'] = '</li>';



        //limit end



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
                'id_remonta' => '',
                'id_responsible' => '',
                'id_where' => '',

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
            $id_responsible = $this->input->post("id_responsible");
            $id_where = $this->input->post("id_where");



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
            if ($id_sost == '') $id_sost = $sost_in_remont;
            if ($id_sost == 'all') $id_sost = '';

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

            // ID_resp
            if ($this->input->post("id_responsible")) {
                $filter_session_data['id_responsible'] = $id_responsible;
            } //we have something stored in the session?
            elseif ($this->uri->segment(2)) {
                $id_responsible = $this->session->userdata('id_responsible');
            } else {
                //if we have nothing inside session, so it's the default "Asc"
                $id_responsible = '';
            }
            $data['id_responsible_selected'] = $id_responsible;
            // end ID_resp

            // ID_sc
           if ($this->uri->segment(2)) {
                $id_sc = $this->session->userdata('id_sc');
            }
            $data['id_sc_selected'] = $id_sc;
            // end ID_SC

            // ID_where
           if ($this->uri->segment(2)) {
                $id_where = $this->session->userdata('id_where');
            }
            $data['id_where_selected'] = $id_where;
            // end ID_where


            // ID_SC
            switch ($this->session->userdata('id_group')) {
                case 1: // админ
                    $id_sc = $this->input->post("id_sc");
                    break;


                case 2: // приемщик

                    if (!$id_where AND !$id_sc) {
                             $id_where = $this->session->userdata('user_id_sc');

                    }elseif ($id_where AND $id_sc) {
                        if ($id_where == $this->session->userdata('user_id_sc') AND $id_sc != $this->session->userdata('user_id_sc')) {
                            $id_sc = $this->input->post("id_sc");
                            $id_where = $this->input->post("id_where");

                        }elseif ($id_where != $this->session->userdata('user_id_sc') AND $id_sc == $this->session->userdata('user_id_sc')) {
                            $id_sc = $this->input->post("id_sc");
                            $id_where = $this->input->post("id_where");

                        }elseif ($id_where == $this->session->userdata('user_id_sc') AND $id_sc == $this->session->userdata('user_id_sc')) {
                            $id_sc = $this->input->post("id_sc");
                            $id_where = $this->input->post("id_where");

                        }elseif ($id_where != $this->session->userdata('user_id_sc') AND $id_sc != $this->session->userdata('user_id_sc')) {
                            $id_where = $this->session->userdata('user_id_sc');
                            $id_sc = '';
                        }

                    }elseif (!$id_where AND $id_sc) {
                        if ($id_sc == $this->session->userdata('user_id_sc')) {
                            $id_sc = $this->input->post("id_sc");
                            $id_where = '';

                        }else{
                            $id_sc = $this->input->post("id_sc");
                            $id_where = $this->session->userdata('user_id_sc');
                        }

                    }elseif ($id_where AND !$id_sc) {
                        if ($id_where == $this->session->userdata('user_id_sc')) {
                            $id_where = $this->input->post("id_where");
                            $id_sc = '';

                        }else{ // что наход в другом сц но из моего сц
                            $id_sc = $this->session->userdata('user_id_sc'); // ставим свой сц
                            $id_where = $this->input->post("id_where"); // и чужое место
                        }
                    }

                    break;


                case 3: // инженер

                    $id_mechanic = $this->session->userdata('user_id');

                    if (!$id_where AND !$id_sc) {
                        $id_where = $this->session->userdata('user_id_sc');

                    }elseif ($id_where AND $id_sc) {
                        if ($id_where == $this->session->userdata('user_id_sc') AND $id_sc != $this->session->userdata('user_id_sc')) {
                            $id_sc = $this->input->post("id_sc");
                            $id_where = $this->input->post("id_where");

                        }elseif ($id_where != $this->session->userdata('user_id_sc') AND $id_sc == $this->session->userdata('user_id_sc')) {
                            $id_sc = $this->input->post("id_sc");
                            $id_where = $this->input->post("id_where");

                        }elseif ($id_where == $this->session->userdata('user_id_sc') AND $id_sc == $this->session->userdata('user_id_sc')) {
                            $id_sc = $this->input->post("id_sc");
                            $id_where = $this->input->post("id_where");

                        }elseif ($id_where != $this->session->userdata('user_id_sc') AND $id_sc != $this->session->userdata('user_id_sc')) {
                            $id_where = $this->session->userdata('user_id_sc');
                            $id_sc = '';
                        }

                    }elseif (!$id_where AND $id_sc) {
                        if ($id_sc == $this->session->userdata('user_id_sc')) {
                            $id_sc = $this->input->post("id_sc");
                            $id_where = '';

                        }else{
                            $id_sc = $this->input->post("id_sc");
                            $id_where = $this->session->userdata('user_id_sc');
                        }

                    }elseif ($id_where AND !$id_sc) {
                        if ($id_where == $this->session->userdata('user_id_sc')) {
                            $id_where = $this->input->post("id_where");
                            $id_sc = '';

                        }else{ // что наход в другом сц но из моего сц
                            $id_sc = $this->session->userdata('user_id_sc'); // ставим свой сц
                            $id_where = $this->input->post("id_where"); // и чужое место
                        }
                    }

                    break;

                default:

                    break;

            }

            // ID_sc
            if ($id_sc) {
                $filter_session_data['id_sc'] = $id_sc;
            } //we have something stored in the session?
            elseif ($this->uri->segment(2)) {
                $id_sc = $this->session->userdata('id_sc');
            } else {  $id_sc = ''; }

            $data['id_sc_selected'] = $id_sc;
            // end ID_SC

            // ID_where
            if ($id_where) {
                $filter_session_data['id_where'] = $id_where;

            } //we have something stored in the session?
            elseif ($this->uri->segment(2)) {
                $id_where = $this->session->userdata('id_where');
            } else {
                //if we have nothing inside session, so it's the default "Asc"
                $id_where = '';
            }
            $data['id_where_selected'] = $id_where;
            // end ID_where

            //save session data into the session
            if (isset($filter_session_data)) {
                $this->session->set_userdata($filter_session_data);
            }




            //fetch sql data into arrays
            $data['count_kvitancys'] = $this->kvitancy_model->get_kvitancy(
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
                $id_responsible,
                $id_where,
                1
            );

            if ($page !=0) {
                $data['end'] = $page*$config['per_page'];
            }else{
                $data['end'] = $config['per_page'];
            }

            $data['start'] = $data['end'] - $config['per_page'];
            if ($data['start'] <= 0 )  {$data['start'] = 1;}

            if ($data['count_kvitancys'] <= $data['end']) {
                $data['end'] = $data['count_kvitancys'];
            }
					

            if ($data['count_kvitancys'] == 1) {
                $data['end'] = 1;
            }


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
                $id_responsible,
                $id_where,
                $count = null
            );

            $data['aparats'] = $this->kvitancy_model->get_kvitancy(
                $search_string = null,
                $order = 'aparat.aparat_name',
                $order_type = 'Asc',
                $limit_start = null,
                $limit_end = null,
                $date,
                $start_date,
                $end_date,
                $id_mechanic,
                $id_aparat,
                $id_proizvod,
                $id_sost = $sost_in_remont,
                $id_sc,
                $id_kvitancy = null,
                $id_remonta,
                $id_responsible,
                $id_where,
                $count = null
            );

            $config['total_rows'] = $data['count_kvitancys'];



        } // !end--------------------------POST------------------------------------- //


        else {

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
                'id_remonta' => '',
                'id_responsible' => '',
                'id_where' => ''


            );

            //clear session data in session
            $this->session->unset_userdata($filter_session_data);


            //pre selected options from session
            $data['search_string_selected'] = '';
            $data['order'] = 'id_kvitancy';
            $order_type = $data['order_type'] = $data['order_type_selected'] = 'Desc';
            $data['date_selected'] = 'date_priemka';
            $data['start_date'] = ''; // date("d")
            $data['end_date'] = date("Y-m-d");
            $data["id_sc_selected"] = '';
            $data["id_mechanic_selected"] = '';
            $data["id_proizvod_selected"] = '';
            $data["id_aparat_selected"] = '';
            $data["id_sost_selected"] = '';
            $data["id_kvitancy_selected"] = '';
            $data["id_remonta_selected"] = '';
            $data["id_responsible_selected"] = '';
            $data["id_where_selected"] = '';

            //end pre selected options

            // $var for select to db
            $search_string = null;
            $order = 'id_kvitancy';
            $order_type = 'Desc';
            $limit_start = $config['per_page']; //при навигациии надо включить
            //$limit_start=null;
            //$limit_end;
            $date = null;
            $start_date = null;
            $end_date = null;
            $id_mechanic = null;
            $id_aparat = null;
            $id_proizvod = null;
            $id_sost = $sost_in_remont;
            $id_kvitancy = null;
            $id_remonta = null;
            $id_responsible = null;
            $id_where = null;


            /*WHAT USER SEE? */

            switch ($this->session->userdata('id_group')) {
                case 1: // админ
                    $id_sc = $this->input->post("id_sc");
                    break;


                case 2: // приемщик
                    $id_sc = '';
                    $id_where = $this->session->userdata('user_id_sc');
                    break;


                case 3: // инженер
                    $id_sc='';
                    //$id_sc = $this->session->userdata('user_id_sc');
                    //$id_mechanic = $this->session->userdata('user_id');
                    $id_mechanic = $this->session->userdata('user_id');
                    $id_where = $this->session->userdata('user_id_sc');
                    break;

                default:
                    $id_sc = $this->session->userdata('user_id_sc');
            }



            //fetch count kvitancys from db
            $data['count_kvitancys'] = $this->kvitancy_model->get_kvitancy(
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
                $id_responsible,
                $id_where,
                1
            );


            if ($page !=0) {
                $data['end'] = $page*$config['per_page'];
            }else{
                $data['end'] = $config['per_page'];
            }

            $data['start'] = $data['end'] - $config['per_page'];
            if ($data['start'] <= 0 )  {$data['start'] = 1;}

            if ($data['count_kvitancys'] <= $data['end']) {
                $data['end'] = $data['count_kvitancys'];
            }
					

            if ($data['count_kvitancys'] == 1) {
                $data['end'] = 1;
            }






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
                $id_responsible,
                $id_where,
                $count = null
            );

            $data['aparats'] = $this->kvitancy_model->get_kvitancy(
                $search_string = null,
                $order = 'aparat.aparat_name',
                $order_type = 'Asc',
                $limit_start = null,
                $limit_end = null,
                $date,
                $start_date,
                $end_date,
                $id_mechanic,
                $id_aparat,
                $id_proizvod,
                $id_sost = $sost_in_remont,
                $id_sc,
                $id_kvitancy = null,
                $id_remonta,
                $id_responsible,
                $id_where,
                $count = null
            );



        } //end else if POST

        $config['total_rows'] = $data['count_kvitancys'];
        $this->pagination->initialize($config);




        //load the view
        $data['order'] = 'id_kvitancy';
        $data['ap'] = $this->aparaty_model->get_aparaty();

        //$data['meh'] = $this->users_model->get_users('3', '', '', '', '', '');
        $data['proizvoditel'] = $this->proizvoditel_model->get_proizvoditel('', '', '', '', '');
        $data['sost'] = $this->sost_remonta_model->get_sost_remonta('', '', '', '', '');
        $data['remont'] = $this->vid_remonta_model->get_vid_remonta();

        $data['users'] = $this->users_model->get_users('', '', '', '', '', '', '');


        /*Что видит юзер id_group */
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

                $data['meh'] = $this->users_model->get_users('', '', '', '', '', '', '');
                $data['resp'] = $this->users_model->get_users('', '', '', '', '', '', '');
                $data['sc'] = $this->service_centers_model->get_service_centers('', '', 'Asc', '', '');

                $data['where'] = $this->service_centers_model->get_service_centers('', '', 'Asc', '', '', '');
				
				$sc = array();
				foreach ($data['sc'] as $arr_sc){
					$sc[$arr_sc['name_sc']] = $arr_sc['id_sc'];
				}
				//var_dump($sc);die;
				
				$data['count_today'] = $this->kvitancy_model->get_count_today($sc);
				$data['count_month'] = $this->kvitancy_model->get_count_month($sc);
				//var_dump($data['count_today']);die;
                
				
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
                $data['sc'] = $this->service_centers_model->get_service_centers('', '', 'Asc', '', '', '');
                //$data["id_where_selected"] = $this->session->userdata('user_id_sc');
                $data['where'] = $this->service_centers_model->get_service_centers('', '', 'Asc', '', '', '');
				
				$sc = array();
				foreach ($data['sc'] as $arr_sc){
					if ($arr_sc['id_sc'] == $this->session->userdata('user_id_sc')) {
						$sc[$arr_sc['name_sc']] = $arr_sc['id_sc'];
					}
				}
				
				$data['count_today'] =  $this->kvitancy_model->get_count_today($sc);
				$data['count_month'] = $this->kvitancy_model->get_count_month($sc);
				//var_dump($data['count_today']);die;
                
            break;


            case 3: // инженер

                if($this->session->userdata('show_my_tickets') == 1) {
                    $data['my_kvitancy'] = $this->kvitancy_model->get_my_kvitancy($this->session->userdata('user_id'), $this->session->userdata('user_id_sc'));
                } else {
                    $data['my_kvitancy'] = array();
                }

                if($this->session->userdata('show_call_tickets') == 1) {
                    //$data['soglasovat'] = $this->kvitancy_model->get_kvitancy_soglasovat($this->session->userdata('user_id_sc'));
                    $data['soglasovat'] = array();
                } else {
                    $data['soglasovat'] = array();
                }


                $data['meh'] = $this->users_model->get_users('3', '', '', '', '','', $this->session->userdata('user_id_sc'));
                $data['resp'] = $this->users_model->get_users('', '', '', '', '', '', $this->session->userdata('user_id_sc'));
                $data['sc'] = $this->service_centers_model->get_service_centers('', '', 'Asc', '', '', $this->session->userdata('user_id_sc'));
                $data["id_mechanic_selected"] = $this->session->userdata('user_id');
                $data['where'] = $this->service_centers_model->get_service_centers('', '', 'Asc', '', '', '');
				
				$sc = array();
				foreach ($data['sc'] as $arr_sc){
					if ($arr_sc['id_sc'] == $this->session->userdata('user_id_sc')) {
						$sc[$arr_sc['name_sc']] = $arr_sc['id_sc'];
					}
				}
				
				$data['count_today'] =  $this->kvitancy_model->get_count_today($sc);
				$data['count_month'] = $this->kvitancy_model->get_count_month($sc);
				
                break;

            default: //мало ли кто еще :)
                break;
        }

        /* END Что видит юзер id_group */

        /*Загрузка шаблона*/
        $data['main_content'] = 'tickets/list';
        $this->load->view('includes/template', $data);


    }

    //index
/*
    public function view()
    {

        //pagination settings
        $config['per_page'] = 7;

        $config['base_url'] = base_url() . 'tickets/';
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
        if ($limit_end < 0) {
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
        $data['start_date'] = date("Y-m-d", strtotime('-' . date("d") . 'days')); // date("d")
        $data['end_date'] = date("Y-m-d");
        $data["id_sc_selected"] = '';
        $data["id_mechanic_selected"] = '';
        $data["id_proizvod_selected"] = '';
        $data["id_aparat_selected"] = '';
        $data["id_sost_selected"] = '';
        $data["id_kvitancy_selected"] = $id_kvitancy;
        $data["id_remonta_selected"] = '';
        $search_string = null;
        $order = 'id_kvitancy';
        $order_type = 'Desc';
        $limit_start = $config['per_page'];
        //$limit_end;
        $date = 'date_priemka';
        $start_date = date("Y-m-d", strtotime('-' . date("d") . 'days')); // date("d")
        $end_date = date("Y-m-d");
        $id_mechanic = null;
        $id_aparat = null;
        $id_proizvod = null;
        $id_sost = null;
        $id_sc = null;

        $id_remonta = null;

        $filter_session_data = array(
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
        if (isset($filter_session_data)) {
            $this->session->set_userdata($filter_session_data);
        }

        //fetch sql data into arrays
        $data['count_kvitancys'] = $this->kvitancy_model->get_kvitancy(
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
            $count = null
        );

        $data['aparats'] = $this->kvitancy_model->get_kvitancy(

            $search_string = null,
            $order = null,
            $order_type = null,
            $limit_start = null,
            $limit_end = null,
            $date = null,
            $start_date = null,
            $end_date = null,
            $id_mechanic = null,
            $id_aparat = null,
            $id_proizvod = null,
            $id_sost = array('1', '3', '4', '6'),
            $id_sc = null,
            $id_kvitancy = null,
            $id_remonta = null,
            $count = null
        );


        $config['total_rows'] = $data['count_kvitancys'];


        //LOAD WIEW
        //!isset($search_string) && !isset($order)

        //initializate the panination helper 
        $this->pagination->initialize($config);

        //var_dump($this->session->userdata('id_group'));die;
        switch ($this->session->userdata('id_group')) {
            case 1: // админ
                $data['my_kvitancy'] = $this->kvitancy_model->get_my_kvitancy($this->session->userdata('user_id'));
                $data['soglasovat'] = '';
                break;


            case 2: // приемщик
                $data['soglasovat'] = $this->kvitancy_model->get_kvitancy_soglasovat();
                $data['my_kvitancy'] = $this->kvitancy_model->get_my_kvitancy($this->session->userdata('user_id'), $this->session->userdata('user_id_sc'));
                break;


            case 3: // инженер
                $data['my_kvitancy'] = $this->kvitancy_model->get_my_kvitancy($this->session->userdata('user_id'), $this->session->userdata('user_id_sc'));
                $data['soglasovat'] = '';
                break;

            default: //мало ли кто еще :)
                $data['my_kvitancy'] = $this->kvitancy_model->get_my_kvitancy($this->session->userdata('user_id'), $this->session->userdata('user_id_sc'));
                $data['soglasovat'] = '';
        }


        //load the view
        $data['ap'] = $this->aparaty_model->get_aparaty();
        $data['sc'] = $this->service_centers_model->get_service_centers('', '', 'Asc', '', '');
        $data['meh'] = $this->users_model->get_users('3', '', '', '', '', '');
        $data['proizvoditel'] = $this->proizvoditel_model->get_proizvoditel('', '', '', '', '');
        $data['sost'] = $this->sost_remonta_model->get_sost_remonta('', '', '', '', '');
        $data['remont'] = $this->vid_remonta_model->get_vid_remonta();
        $data['main_content'] = 'tickets/list';
        $data['resp'] = $this->users_model->get_users('', '', '', '', '', '', $this->session->userdata('user_id_sc'));
        $this->load->view('includes/template', $data);
    }

*/
    /**
     * Update item by his id
     * @return void
     */
    public function update()
    {
        //product id 
        $id = $this->uri->segment(3);

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
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
            if ($this->form_validation->run()) {

                $data_to_store = array(
                    'id_aparat' => $this->input->post('id_aparat'),
                    'id_proizvod' => $this->input->post('id_proizvod'),
                    'model' => $this->input->post('model'),
                    'ser_nomer' => $this->input->post('ser_nomer'),
                    'neispravnost' => $this->input->post('neispravnost'),
                    'komplektnost' => $this->input->post('komplektnost'),
                    'vid' => $this->input->post('vid'),

                    'id_remonta' => $this->input->post('id_remonta'),
                    'id_sc' => $this->input->post('id_sc'),
                    'primechaniya' => $this->input->post('primechaniya'),
                    'update_time' => date("j-m-Y, H:i:s"),
                    'update_user' => $this->session->userdata('user_id')



                );
                //if the insert has returned true then we show the flash message
                if ($this->kvitancy_model->update_kvitancy($id, $data_to_store) == TRUE) {

                    //var_dump($data_to_store);
                    $this->session->set_flashdata('flash_message', 'updated');
                } else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                redirect('tickets/update/' . $id . '');

            }
            //validation run

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        //$data['gorod'] = $this->gorod_model->get_gorod();
        $data['aparaty'] = $this->aparaty_model->get_aparaty();
        $data['proizvod'] = $this->proizvoditel_model->get_proizvoditel();
        $data['remont'] = $this->vid_remonta_model->get_vid_remonta();
        //$data['sc'] = $this->service_centers_model->get_service_centers();

        switch ($this->session->userdata('id_group')) {
            case 1: // админ
                $data['sc'] = $this->service_centers_model->get_service_centers('', '', 'Asc', '', '');
                break;


            case 2: // приемщик
                $data['sc'] = $this->service_centers_model->get_service_centers('', '', 'Asc', '', '', $this->session->userdata('user_id_sc'));
                break;


            case 3: // инженер
                $data['sc'] = $this->service_centers_model->get_service_centers('', '', 'Asc', '', '', $this->session->userdata('user_id_sc'));
                break;

            default: //мало ли кто еще :)
                $data['sc'] = $this->service_centers_model->get_service_centers('', '', 'Asc', '', '', $this->session->userdata('user_id_sc'));

        }





        //product data 
        $data['manufacture'] = $this->kvitancy_model->get_kvitancy_by_id($id);
        //load the view
        $data['main_content'] = 'tickets/edit';
        $this->load->view('includes/template', $data);

    }//update

    /**
     * Delete product by his id
     * @return void
     */
    public function delete()
    {

        $id = $this->uri->segment(4);
        $this->kvitancy_model->delete_kvitancy($id);
        redirect('admin/kvitancy');
    }

    //edit


    public function printing()
    {
        //product id 
        $id = $this->uri->segment(3);
        if ($id) {
        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
            $this->load->model('print_model');
            $data['text'] = $this->print_model->get_ticket();
        //product data 
        $data['manufacture'] = $this->kvitancy_model->get_kvitancy_by_id($id);

        $id_clienta = $this->kvitancy_model->get_client_by_id($id);
        $data['client'] = $this->clients_model->get_clients_by_id($id_clienta[0]['user_id']);

        $data['sc'] = $this->service_centers_model->get_service_centers_by_id($data['manufacture'][0]['id_sc']);

        $data['aparat'] = $this->aparaty_model->get_aparaty_by_id($data['manufacture'][0]['id_aparat']);
        $data['proizvod'] = $this->proizvoditel_model->get_proizvoditel_by_id($data['manufacture'][0]['id_proizvod']);

        //load the view
        $data['main_content'] = 'tickets/printing';
        $this->load->view('includes/print', $data);

        } else {
            die();
        }
    }


    public function printing_check()
    {
        //product id 
        $id = $this->uri->segment(3);

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        $this->load->model('print_model');
        $data['text'] = $this->print_model->get_check();
        //product data 
        $data['manufacture'] = $this->kvitancy_model->get_kvitancy_by_id($id);

        $id_clienta = $this->kvitancy_model->get_client_by_id($id);
        $data['client'] = $this->clients_model->get_clients_by_id($id_clienta[0]['user_id']);

        $data['sc'] = $this->service_centers_model->get_service_centers_by_id($data['manufacture'][0]['id_sc']);

        $data['aparat'] = $this->aparaty_model->get_aparaty_by_id($data['manufacture'][0]['id_aparat']);
        $data['proizvod'] = $this->proizvoditel_model->get_proizvoditel_by_id($data['manufacture'][0]['id_proizvod']);

        //load the view
        $data['main_content'] = 'tickets/printing_check';
        $this->load->view('includes/print', $data);

    }



    public function printing_invoice()
    {
        //product id
        $id = $this->uri->segment(3);

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        $this->load->model('print_model');
        $data['text'] = $this->print_model->get_invoice();
        //product data
        $data['manufacture'] = $this->kvitancy_model->get_kvitancy_by_id($id);

        $id_clienta = $this->kvitancy_model->get_client_by_id($id);
        $data['client'] = $this->clients_model->get_clients_by_id($id_clienta[0]['user_id']);

        $data['sc'] = $this->service_centers_model->get_service_centers_by_id($data['manufacture'][0]['id_sc']);

        $data['aparat'] = $this->aparaty_model->get_aparaty_by_id($data['manufacture'][0]['id_aparat']);
        $data['proizvod'] = $this->proizvoditel_model->get_proizvoditel_by_id($data['manufacture'][0]['id_proizvod']);

        //load the view
        $data['main_content'] = 'tickets/printing_invoice';
        $this->load->view('includes/print', $data);

    }


    public function printing_works()
    {
        //product id
        $id = $this->uri->segment(3);

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

        $this->load->model('print_model');
        $data['text'] = $this->print_model->get_works();
        //product data
        $data['manufacture'] = $this->kvitancy_model->get_kvitancy_by_id($id);

        $id_clienta = $this->kvitancy_model->get_client_by_id($id);
        $data['client'] = $this->clients_model->get_clients_by_id($id_clienta[0]['user_id']);

        $data['sc'] = $this->service_centers_model->get_service_centers_by_id($data['manufacture'][0]['id_sc']);

        $data['aparat'] = $this->aparaty_model->get_aparaty_by_id($data['manufacture'][0]['id_aparat']);
        $data['proizvod'] = $this->proizvoditel_model->get_proizvoditel_by_id($data['manufacture'][0]['id_proizvod']);

        //load the view
        $data['main_content'] = 'tickets/printing_works';
        $this->load->view('includes/print', $data);

    }

    public function update_client()
    {
        //product id
        $id = $this->uri->segment(3);

        //if save button was clicked, get the data sent via post
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('fam', 'fam', 'required');
            $this->form_validation->set_rules('imya', 'imya', 'required');
            $this->form_validation->set_rules('phone', 'phone', 'required');
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
                redirect('tickets/update_client/'.$id.'');

            }//validation run

        }

        $data['gorod'] = $this->gorod_model->get_gorod();

        //product data
        $data['manufacture'] = $this->clients_model->get_clients_by_id($id);
        $data['sc'] = $this->service_centers_model->get_service_centers();
        //load the view
        $data['main_content'] = 'tickets/update_client';
        $this->load->view('includes/template', $data);

    }//update

}

?>