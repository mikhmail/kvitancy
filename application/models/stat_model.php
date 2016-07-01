<?php
class Stat_model extends CI_Model {

    /**
     * Responsable for auto load the database
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function __destruct() {
        $this->db->close();
    }


    public function get_kvitancy(
        $search_string=null,
        $order=null,
        $order_type=null,
        $limit_start=null,
        $limit_end=null,
        $date=null,
        $start_date=null,
        $end_date=null,
        $id_mechanic=null,
        $id_aparat=null,
        $id_proizvod=null,
        $id_sost=null,
        $id_sc=null,
        $id_kvitancy=null,
        $id_remonta=null,
        $id_responsible,
        $count=null,
        $summ =null

    )
    {

        $this->db->select('
kvitancy.id_kvitancy,
kvitancy.user_id,
kvitancy.id_aparat,
kvitancy.id_proizvod,
kvitancy.model,
kvitancy.ser_nomer,
kvitancy.id_remonta,
kvitancy.neispravnost,
kvitancy.vid,
kvitancy.komplektnost,
kvitancy.date_priemka,
kvitancy.date_okonchan,
kvitancy.date_vydachi,
kvitancy.id_sost,
kvitancy.id_mechanic,
kvitancy.id_sc,
kvitancy.primechaniya,
kvitancy.update_time,
kvitancy.update_user,
kvitancy.id_responsible,
kvitancy.full_cost,



aparat.id_aparat,
aparat.aparat_name,

proizvod.id_proizvod,
proizvod.name_proizvod,

user.user_id,
user.fam,
user.imya,
user.otch,
user.phone,
user.adres,
user.gorod_id,

sost.id_sost,
sost.name_sost,
sost.background,
sost.type,

service.id_sc,
service.id_gorod,
service.site,
service.name_sc,
service.adres_sc,
service.phone_sc,
service.kontakt_sc,
service.mail_sc,
service.rab_sc
		');


        $this->db->from('kvitancy');



        $this->db->join('aparaty aparat', 'kvitancy.id_aparat = aparat.id_aparat');
        $this->db->join('proizvoditel proizvod', 'kvitancy.id_proizvod = proizvod.id_proizvod');
        $this->db->join('users user', 'kvitancy.user_id = user.user_id');
        $this->db->join('sost_remonta sost', 'kvitancy.id_sost = sost.id_sost');
        $this->db->join('service_centers service', 'kvitancy.id_sc = service.id_sc');
        //$this->db->join('membership', 'kvitancy.id_mechanic = membership.id');


        if($search_string){

            if ($id_sc != null){
                $this->db->where('kvitancy.id_sc', $id_sc);
            }
            $search_string = trim($search_string);
            $where = "(kvitancy.model LIKE '%$search_string%' OR user.phone LIKE '%$search_string%' OR user.fam LIKE '%$search_string%')";

            $this->db->where($where);



            $query = $this->db->get();
            //return($this->db->last_query());die;
            if ($query->num_rows() > 0) {
                if ($count) {return $query->num_rows(); }

                 else {   return $query->result_array(); }



            }else return null;
        } elseif ($id_kvitancy) {


            if ($id_sc != null){
                $this->db->where('kvitancy.id_sc', $id_sc);
            }
            $this->db->where('kvitancy.id_kvitancy', $id_kvitancy);
            $query = $this->db->get();


           //return($this->db->last_query());die;

            if ($query->num_rows() > 0) {
                if ($count) {return $query->num_rows(); }
                else
                    {return $query->result_array();}
            }else return  null;
        }



        if($date != null){

            if($start_date AND $end_date) {
                $this->db->where(" kvitancy.".$date." <= '".$end_date."%' AND kvitancy.".$date." >= '".$start_date."%' ", NULL, FALSE);
            }


        }

        if($id_mechanic != null){
            $this->db->where('kvitancy.id_mechanic', $id_mechanic);
        }
        if ($id_sc != null){
            $this->db->where('kvitancy.id_sc', $id_sc);
        }
        if ($id_aparat != null){
            $this->db->where('kvitancy.id_aparat', $id_aparat);
        }
        if ($id_proizvod != null){
            $this->db->where('kvitancy.id_proizvod', $id_proizvod);
        }
        if ($id_sost != null){
            //$this->db->where('kvitancy.id_sost', $id_sost);

            $this->db->where_in('kvitancy.id_sost', $id_sost);
        }

        if($order != null){
            $this->db->order_by($order, $order_type);
        }else{
            $this->db->order_by('id_kvitancy', $order_type);
        }
        if ($id_remonta != null){
            $this->db->where('kvitancy.id_remonta', $id_remonta);
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
        }else return  null;



}


    public function get_summ($kvitancys){

        $store_summ =0;
        $cash_summ=0;
        $work_summ=0;

        //var_dump($kvitancys);die;
        if (count($kvitancys)>0){
        foreach($kvitancys as $row){

            $store = $this->stat_model->get_store($row['id_kvitancy']);
                foreach ($store as $str){
                    $store_summ += $str["cost"];
                }

            $cash = $this->stat_model->get_cash($row['id_kvitancy']);
                foreach ($cash as $csh){
                    $cash_summ += $csh["plus"];
                }

            $work = $this->stat_model->get_work($row['id_kvitancy']);
                foreach ($work as $works){
                    $work_summ += $works["cost"];
                }

        }
        //echo  $store_summ;die;
        return $profit =  $cash_summ - $work_summ -  $store_summ;
    }else return NULL;
    }


    public function get_cash ($id_kvitancy){
        $this->db->select('*');
        $this->db->from('cash');
        $this->db->join('membership', 'cash.update_user = membership.id');
        $this->db->where('id_kvitancy', $id_kvitancy);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_work ($id_kvitancy){
        $this->db->select('*');
        $this->db->from('works'); // инженеры
        $this->db->where('id_kvitancy', $id_kvitancy);
        $this->db->join('membership', 'works.user_id = membership.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_store ($id_kvitancy){
        $this->db->select('*');
        $this->db->from('store'); // склад
        $this->db->where('id_kvitancy', $id_kvitancy);
        $this->db->join('aparat_p', 'store.id_aparat_p = aparat_p.id_aparat_p');
        $query = $this->db->get();
        return $query->result_array();
    }


}//end class
?>