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