<?php
class cash_model extends CI_Model {


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
        $id_responsible=null,
        $count=null,
        $summ=null
    )
    {
        if($summ) {
            $this->db->select('SUM(cash.plus) AS SUM');


        }else{
            $this->db->select('
cash.id as cash_id,
cash.name,
cash.update_user,
cash.update_time,
cash.update_date,

cash.plus,
cash.id_kvitancy,
cash.total,


service.name_sc,
service.id_sc

		');
        }




        $this->db->from('cash');


        $this->db->join('membership user', 'cash.update_user = user.id');
        $this->db->join('service_centers service', 'cash.id_sc = service.id_sc');


        if($search_string){


            $where = "(cash.name LIKE '%$search_string%')";

            $this->db->where($where);

            if($limit_start && $limit_end){
                $this->db->limit($limit_start, $limit_end);
            }
            elseif($limit_start != null){
                $this->db->limit($limit_start, $limit_end);
            }


            $query = $this->db->get();
            //return($this->db->last_query());die;
            if ($query->num_rows() > 0) {
                if ($count) {return $query->num_rows(); }
                else

                    return $query->result_array();
            }else return null;
        }

        elseif ($id_kvitancy) {

            $this->db->where('cash.id_kvitancy', $id_kvitancy);

            $query = $this->db->get();

            if($limit_start && $limit_end){
                $this->db->limit($limit_start, $limit_end);
            }
            elseif($limit_start != null){
                $this->db->limit($limit_start, $limit_end);
            }

            //return($this->db->last_query());die;

            if ($query->num_rows() > 0) {
                if ($count) {return $query->num_rows(); }
                else

                    return $query->result_array();
                //die($this->db->last_query());
            }else return null;
        }


        if($start_date AND $end_date) {
            $this->db->where(" cash.update_date >='".$start_date."%' AND cash.update_date <= '".$end_date."%' ", NULL, FALSE);
        }

        if ($id_sc != null){
            $this->db->where('cash.id_sc', $id_sc);
        }

        if ($id_responsible != null){
            $this->db->where('cash.update_user', $id_responsible);
        }

        if($order != null){
            $this->db->order_by($order, $order_type);
        }else{
            $this->db->order_by('cash.id', $order_type);
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





    function delete_cash($id){
        $this->db->where('id', $id);
        $this->db->delete('cash');
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