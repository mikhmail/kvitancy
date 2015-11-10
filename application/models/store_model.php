<?php
class Store_model extends CI_Model {


    public function __construct() { parent::__construct();

        $this->load->database();
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
                                    $status=null,
                                    $count=null,
                                    $summ=null
                                )
    {
        if($summ) {
            $this->db->select('SUM(store.cost) AS SUM');
        }else{
            $this->db->select('
store.id as store_id,
store.name,
store.id_aparat,
store.id_aparat_p,
store.id_proizvod,
store.model,
store.serial,
store.vid,
store.id_sost,
store.user_id,
store.date_priemka,
store.date_vydachi,
store.cost,
store.price,
store.status,
store.update_user,
store.update_time,
store.id_resp,
store.id_from,
store.id_where,
store.id_sc,
store.id_kvitancy,


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




        $this->db->from('store');



        $this->db->join('aparaty aparat', 'store.id_aparat = aparat.id_aparat');
        $this->db->join('aparat_p', 'store.id_aparat_p = aparat_p.id_aparat_p');

        $this->db->join('proizvoditel proizvod', 'store.id_proizvod = proizvod.id_proizvod');
        $this->db->join('membership user', 'store.user_id = user.id');
        $this->db->join('service_centers service', 'store.id_sc = service.id_sc');
        //$this->db->join('membership', 'store.id_mechanic = membership.id');


        if($search_string){

            if ($id_sc != null){
                $this->db->where('store.id_sc', $id_sc);
            }


                $this->db->where('store.status', 1);



            $where = "(store.model LIKE '%$search_string%' OR store.name LIKE '%$search_string%' OR store.serial LIKE '%$search_string%')";

            $this->db->where($where);

            //$this->db->where('store.model LIKE', "%$search_string%");
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
                $this->db->where('store.id_sc', $id_sc);
            }
            $this->db->where('store.id_kvitancy', $id_kvitancy);

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
                $this->db->where(" store.".$date." BETWEEN '".$start_date."%' AND '".$end_date."%' ", NULL, FALSE);
            }


        if ($id_sc != null){
            $this->db->where('store.id_sc', $id_sc);
        }
        if ($id_aparat != null){
            $this->db->where('store.id_aparat', $id_aparat);
        }

        if ($id_aparat_p != null){
            $this->db->where('store.id_aparat_p', $id_aparat_p);
        }

        if ($id_proizvod != null){
            $this->db->where('store.id_proizvod', $id_proizvod);
        }
        if ($id_sost != null){
            $this->db->where('store.id_sost', $id_sost);
        }

        if ($user_id != null){
            $this->db->where('store.user_id', $user_id);
        }

        if ($id_resp != null){
            $this->db->where('store.id_resp', $id_resp);
        }

        if ($id_where != null){
            $this->db->where('store.id_where', $id_where);
        }

        if ($status != null){
            $this->db->where('store.status', $status);
        }else{
            $this->db->where('store.status', 1);
        }


        if($order != null){
            $this->db->order_by($order, $order_type);
        }else{
            $this->db->order_by('store.id', $order_type);
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
        //return($this->db->last_query());die;

        if ($query->num_rows() > 0) {
            if ($count) {return $query->num_rows(); }
            else

                return $query->result_array();
        }else return null;
    }


    public function get_store_by_id ($id)
    {

        $this->db->select('
store.id as store_id,
store.name,
store.id_aparat,
store.id_aparat_p,
store.id_proizvod,
store.model,
store.serial,
store.vid,
store.id_sost,
store.user_id,
store.date_priemka,
store.date_vydachi,
store.cost,
store.price,
store.status,
store.update_user,
store.update_time,
store.id_resp,
store.id_from,
store.id_where,
store.id_sc,
store.id_kvitancy,


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



        $this->db->join('aparaty aparat', 'store.id_aparat = aparat.id_aparat');
        $this->db->join('aparat_p', 'store.id_aparat_p = aparat_p.id_aparat_p');

        $this->db->join('proizvoditel proizvod', 'store.id_proizvod = proizvod.id_proizvod');
        $this->db->join('membership user', 'store.user_id = user.id');
        $this->db->join('service_centers service', 'store.id_sc = service.id_sc');
        //$this->db->join('membership', 'store.id_mechanic = membership.id');




        if ($id) {



            $this->db->where('store.id', $id);
            $query = $this->db->get();

            //return($this->db->last_query());die;

            if ($query->num_rows() > 0) {

                    return $query->result_array();
            }else return null;
        }
    }


    function delete_store($id){
        $this->db->where('id', $id);
        $this->db->delete('store');
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


}
?>