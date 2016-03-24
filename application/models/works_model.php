<?php
class works_model extends CI_Model {


    public function __construct() { parent::__construct();

        $this->load->database();
    }


    public function get_works (
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
        $id_kvitancy=null,
        $id_sc=null,
        $count=null,
        $summ=null
    )
    {
        if($summ) {
            $this->db->select('SUM(works.cost) AS SUM');
        }else{
            $this->db->select('
works.id as works_id,
works.name,
works.date_added,
works.cost,

kvitancy.id_kvitancy,
kvitancy.model,



aparat.aparat_name,



proizvod.name_proizvod,

user.id as user_id,

service.name_sc,
service.id_sc

		');
        }




        $this->db->from('works');


        $this->db->join('kvitancy', 'works.id_kvitancy = kvitancy.id_kvitancy');

        $this->db->join('aparaty aparat', 'kvitancy.id_aparat = aparat.id_aparat');


        $this->db->join('proizvoditel proizvod', 'kvitancy.id_proizvod = proizvod.id_proizvod');
        $this->db->join('membership user', 'works.user_id = user.id');
        $this->db->join('service_centers service', 'works.id_sc = service.id_sc');
        //$this->db->join('membership', 'works.id_mechanic = membership.id');


        if($search_string){


            $where = "(works.name LIKE '%$search_string%')";

            $this->db->where($where);

            //$this->db->where('works.model LIKE', "%$search_string%");
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

            $this->db->where('works.id_kvitancy', $id_kvitancy);

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
            $this->db->where(" works.date_added >= '".$start_date."%' AND works.date_added <= '".$end_date."%' ", NULL, FALSE);
        }

        if ($id_sc != null){
            $this->db->where('works.id_sc', $id_sc);
        }

        if ($id_aparat != null){
            $this->db->where('kvitancy.id_aparat', $id_aparat);
        }



        if ($id_proizvod != null){
            $this->db->where('kvitancy.id_proizvod', $id_proizvod);
        }
       


        if($order != null){
            $this->db->order_by($order, $order_type);
        }else{
            $this->db->order_by('works.id', $order_type);
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


    public function get_works_by_id ($id)
    {

        $this->db->select('
works.id as works_id,
works.name,
works.id_aparat,
works.id_aparat_p,
works.id_proizvod,
works.model,
works.serial,
works.vid,
works.id_sost,
works.user_id,
works.date_priemka,
works.date_vydachi,
works.cost,
works.price,
works.status,
works.update_user,
works.update_time,
works.id_resp,
works.id_from,
works.id_where,
works.id_sc,
works.id_kvitancy,


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


        $this->db->from('works');



        $this->db->join('aparaty aparat', 'works.id_aparat = aparat.id_aparat');
        $this->db->join('aparat_p', 'works.id_aparat_p = aparat_p.id_aparat_p');

        $this->db->join('proizvoditel proizvod', 'works.id_proizvod = proizvod.id_proizvod');
        $this->db->join('membership user', 'works.user_id = user.id');
        $this->db->join('service_centers service', 'works.id_sc = service.id_sc');
        //$this->db->join('membership', 'works.id_mechanic = membership.id');




        if ($id) {



            $this->db->where('works.id', $id);
            $query = $this->db->get();

            //return($this->db->last_query());die;

            if ($query->num_rows() > 0) {

                return $query->result_array();
            }else return null;
        }
    }


    function delete_works($id){
        $this->db->where('id', $id);
        $this->db->delete('works');
    }

    function update_works($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('works', $data);
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        if($report !== 0){
            return true;
        }else{
            return false;
        }
    }

    function add_works($data)
    {
        if ( $this->db->insert('works', $data) )
            return $id = $this->db->insert_id();
    }


}
?>