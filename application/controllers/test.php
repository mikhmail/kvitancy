<?php

class Test extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

    }



public function index () {

    $filter_session_data = array(
        'search_string' => '',
        'order' => 'id_kvitancy',
        'order_type' => 'ASC',
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
    $this->session->set_userdata($filter_session_data);

    exit;
}

}//end class
?>