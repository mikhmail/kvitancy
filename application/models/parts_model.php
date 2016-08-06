<?php
class Parts_model extends CI_Model {


    public function __construct() { parent::__construct();

        $this->load->database();
        $this->load->model('kvitancy_model');
    }


    public function get_store (
                                    $search_string=null,
                                    $order=null,
                                    $order_type=null,
                                    $limit_start=null,
                                    $limit_end=null,
                                    $start_date=null,
                                    $end_date=null,
                                    $id_aparat=null,
                                    $id_aparat_p=null,
                                    $id_proizvod=null,

                                    $id_sost=null,
                                    $user_id=null,
                                    $id_resp=null,

                                    $id_where=null,
                                    $id_sc=null,

                                    $id_kvitancy=null,
                                    $id_status=null,
                                    $count=null,
                                    $summ=null
                                )
    {
        if($summ) {
            $this->db->select('SUM(parts.cost) AS SUM');
        }else{
            $this->db->select('
parts.id as store_id,
parts.name,
parts.id_aparat,
parts.id_aparat_p,
parts.id_proizvod,
parts.model,
parts.serial,
parts.vid,
parts.id_sost,
parts.user_id,
parts.date_priemka,
parts.date_vydachi,
parts.cost,
parts.price,
parts.status,
parts.update_user,
parts.update_time,
parts.id_resp,
parts.id_from,
parts.id_where,
parts.id_sc,
parts.id_kvitancy,
parts.text,



aparat.id_aparat,
aparat.aparat_name,

aparat_p.title,


proizvod.id_proizvod,
proizvod.name_proizvod,

user.id as user_id,
user.first_name,
user.last_name,
user.user_name,

service.name_sc
		');
        }




        $this->db->from('parts');



        $this->db->join('aparaty aparat', 'parts.id_aparat = aparat.id_aparat');
        $this->db->join('aparat_p', 'parts.id_aparat_p = aparat_p.id_aparat_p');

        $this->db->join('proizvoditel proizvod', 'parts.id_proizvod = proizvod.id_proizvod');
        $this->db->join('membership user', 'parts.user_id = user.id');
        $this->db->join('service_centers service', 'parts.id_sc = service.id_sc');
        //$this->db->join('membership', 'parts.id_mechanic = membership.id');


        if($search_string){

            if ($id_sc != null){
                $this->db->where('parts.id_sc', $id_sc);
            }


                $this->db->where('parts.status', 1);



            $where = "(parts.model LIKE '%$search_string%' OR parts.name LIKE '%$search_string%' OR parts.serial LIKE '%$search_string%')";

            $this->db->where($where);

            //$this->db->where('parts.model LIKE', "%$search_string%");
            //$this->db->or_where('user.phone LIKE', "%$search_string%");
            //$this->db->or_where('user.fam LIKE', "%$search_string%");



            $query = $this->db->get();
            //return($this->db->last_query());die;
            if ($query->num_rows() > 0) {
                if ($count) {return $query->num_rows(); }
                else

                    return $query->result_array();
            }else return null;
        }

        elseif ($id_kvitancy) {


            if ($id_sc != null){
                $this->db->where('parts.id_sc', $id_sc);
            }
            $this->db->where('parts.id_kvitancy', $id_kvitancy);

            $query = $this->db->get();

            //return($this->db->last_query());die;

            if ($query->num_rows() > 0) {
                if ($count) {return $query->num_rows(); }
                else

                return $query->result_array();
                //die($this->db->last_query());
                }else return null;
        }


        if($start_date AND $end_date) {
                $this->db->where(" parts.".$date." BETWEEN '".$start_date."%' AND '".$end_date."%' ", NULL, FALSE);
            }


        if ($id_sc != null){
            $this->db->where('parts.id_sc', $id_sc);
        }
        if ($id_aparat != null){
            $this->db->where('parts.id_aparat', $id_aparat);
        }

        if ($id_aparat_p != null){
            $this->db->where('parts.id_aparat_p', $id_aparat_p);
        }

        if ($id_proizvod != null){
            $this->db->where('parts.id_proizvod', $id_proizvod);
        }
        if ($id_sost != null){
            $this->db->where('parts.id_sost', $id_sost);
        }

        if ($user_id != null){
            $this->db->where('parts.user_id', $user_id);
        }

        if ($id_resp != null){
            $this->db->where('parts.id_resp', $id_resp);
        }

        if ($id_where != null){
            $this->db->where('parts.id_where', $id_where);
        }

        if ($id_status OR $id_status==0){
            $this->db->where('parts.status', $id_status);
        }else{
            $this->db->where('parts.status', 1);
        }


        if($order != null){
            $this->db->order_by($order, $order_type);
        }else{
            $this->db->order_by('parts.id', $order_type);
        }


        if ($count OR $summ) {$limit_start= null; $limit_end=null;
        }else {
            if($limit_start && $limit_end){
                $this->db->limit($limit_start, $limit_end);
            }
            elseif($limit_start != null){
                $this->db->limit($limit_start, $limit_end);
            }

        }


        $query = $this->db->get();
        //return($this->db->last_query());exit;

        if ($query->num_rows() > 0) {
            if ($count) {return $query->num_rows(); }
            else

                return $query->result_array();
        }else return null;
    }


    public function get_store_by_id ($id)
    {

        $this->db->select('
parts.id as store_id,
parts.name,
parts.id_aparat,
parts.id_aparat_p,
parts.id_proizvod,
parts.model,
parts.serial,
parts.vid,
parts.id_sost,
parts.user_id,
parts.date_priemka,
parts.date_vydachi,
parts.cost,
parts.price,
parts.status,
parts.update_user,
parts.update_time,
parts.id_resp,
parts.id_from,
parts.id_where,
parts.id_sc,
parts.id_kvitancy,


aparat.id_aparat,
aparat.aparat_name,

aparat_p.title,


proizvod.id_proizvod,
proizvod.name_proizvod,

user.id as user_id,
user.first_name,
user.last_name,
user.user_name,

service.name_sc
		');


        $this->db->from('store');



        $this->db->join('aparaty aparat', 'parts.id_aparat = aparat.id_aparat');
        $this->db->join('aparat_p', 'parts.id_aparat_p = aparat_p.id_aparat_p');

        $this->db->join('proizvoditel proizvod', 'parts.id_proizvod = proizvod.id_proizvod');
        $this->db->join('membership user', 'parts.user_id = user.id');
        $this->db->join('service_centers service', 'parts.id_sc = service.id_sc');
        //$this->db->join('membership', 'parts.id_mechanic = membership.id');




        if ($id) {



            $this->db->where('parts.id', $id);
            $query = $this->db->get();

            //return($this->db->last_query());die;

            if ($query->num_rows() > 0) {

                    return $query->result_array();
            }else return null;
        }
    }


    function return_store($id){

        $data = array(

            'status' => 1,
            'id_kvitancy' => NULL,
            'update_user' => $this->session->userdata['user_id'],
            'update_time' => date("j-m-Y, H:i:s")
        );

        $this->db->where('id', $id);
        $this->db->update('store', $data);
    }


    function delete_store($id){
        $this->db->where('id', $id);
        $this->db->delete('parts');
    }

    function update_store($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('store', $data);
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if($report !== 0){
            return true;
        }else{
            return false;
        }
    }

    function add_store($data)
    {
        if ( $this->db->insert('store', $data) )
                return $id = $this->db->insert_id();
    }

    function get_sost ($id_kvitancy) {

        $kvitancy = $this->kvitancy_model->get_kvitancy(
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            $id_kvitancy,
            '',
            $count = null
        );

        if($kvitancy){

            $id_sost = $kvitancy[0]['id_sost'];

            $this->db->select('*');
            $this->db->from('sost_remonta');
            $this->db->where('id_sost', $id_sost);
            $query = $this->db->get();
                return $query->result_array();
        }

    }


}
?>