<?php
class Stat_model extends CI_Model {


    public function __construct() { parent::__construct();

        $this->load->database();
    }


    public function get_stat (
        $search_string,
        $order,
        $order_type,
        $limit_start,
        $limit_end,
        $start_date,
        $end_date,
        $id_aparat,
        $id_proizvod,
        $id_kvitancy,
        $id_sc
                                )
{


        $this->db->select('kvitancy.id_kvitancy, kvitancy.model, aparaty.aparat_name, proizvoditel.name_proizvod');

        $this->db->join('aparaty', 'kvitancy.id_aparat = aparaty.id_aparat');
        $this->db->join('proizvoditel', 'kvitancy.id_proizvod = proizvoditel.id_proizvod');

        $this->db->from('kvitancy');


        if($limit_start && $limit_end){
                  $this->db->limit($limit_start, $limit_end);
                }

        if($start_date AND $end_date) {
            $this->db->where(" kvitancy.date_vydachi BETWEEN '".$start_date."%' AND '".$end_date."%' ", NULL, FALSE);
        }

        $query = $this->db->get();
        //return($this->db->last_query());die;

        return $query->result_array();


}


//end class Stat_model
}
?>