<?php
class Kvitancy_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct() { parent::__construct();	
		
        $this->load->database();
    }
	
	public function __destruct() {
    $this->db->close();
	}

    /**
    * Get product by his is
    * @param int $product_id
    * @return array
    */
	
	   public function get_client_by_id($id)
    {	
	

	
	
		
		$this->db->select('user_id');
		$this->db->from('kvitancy');
		$this->db->where('id_kvitancy', $id);
		$query = $this->db->get();
		
		
		
		return $query->result_array(); 
    } 
	
	
    public function get_kvitancy_by_id($id)
    {	
	

	
	
		
		$this->db->select('*');
		$this->db->from('kvitancy');
		$this->db->join('vid_remonta', 'kvitancy.id_remonta = vid_remonta.id_remonta');
		$this->db->where('id_kvitancy', $id);
		$query = $this->db->get();
		
		
		
		return $query->result_array(); 
    }    

	
	public function get_kvitancy_soglasovat($id_sc=NULL)
    {	
        $call = $this->sost_remonta_model->get_sost_remonta_call();

        foreach($call as $key => $status){

        }

		$this->db->select('kvitancy.id_kvitancy, kvitancy.model, aparaty.aparat_name, proizvoditel.name_proizvod, sost_remonta.id_sost, sost_remonta.name_sost');
		
		$this->db->join('aparaty', 'kvitancy.id_aparat = aparaty.id_aparat');
		$this->db->join('proizvoditel', 'kvitancy.id_proizvod = proizvoditel.id_proizvod');
        $this->db->join('sost_remonta', 'kvitancy.id_sost = sost_remonta.id_sost');


        $this->db->from('kvitancy');
		$this->db->where_in('kvitancy.id_sost',  $call);


        if($id_sc) $this->db->where('kvitancy.id_sc', $id_sc);

        $query = $this->db->get();

		return $query->result_array(); 
    }

	public function get_my_kvitancy ($user_id, $id_sc=null)
    {	
    if($user_id){
		$this->db->select('kvitancy.id_kvitancy, kvitancy.model, aparaty.aparat_name, proizvoditel.name_proizvod');
		
		$this->db->join('aparaty', 'kvitancy.id_aparat = aparaty.id_aparat');
		$this->db->join('proizvoditel', 'kvitancy.id_proizvod = proizvoditel.id_proizvod');
		
		$this->db->from('kvitancy');
		$this->db->where('id_responsible', $user_id);
        if($id_sc) $this->db->where('id_sc', $id_sc);

        $query = $this->db->get();
        //return($this->db->last_query());die;

		return $query->result_array();
    }
    }
	
    
	public function get_critical_kvitancy ($id_sc)
    {	
		
		$time1 = strtotime("-5 day");
		$last_day = date("Y-m-d", $time1);


		$time2 = strtotime("-3 week");
		$first_day = date("Y-m-d", $time2);
		
		$this->db->select('*');
		
		$this->db->join('aparaty', 'kvitancy.id_aparat = aparaty.id_aparat');
		$this->db->join('proizvoditel', 'kvitancy.id_proizvod = proizvoditel.id_proizvod');
		
		$this->db->from('kvitancy');
		$this->db->where('id_sc', $id_sc);
		$query = $this->db->get();

		return $query->result_array(); 
    }
	
    	
	
    public function get_all_kvitancy($search_string=null, $order=null, $order_type='Asc', $limit_start=null, $limit_end=null)
    {
	    
		

		$this->db->select('*');
		
		
		$this->db->from('kvitancy');
		
		
		
		$this->db->join('aparaty', 'kvitancy.id_aparat = aparaty.id_aparat');
		$this->db->join('proizvoditel', 'kvitancy.id_proizvod = proizvoditel.id_proizvod');
		$this->db->join('users', 'kvitancy.user_id = users.user_id');
		$this->db->join('sost_remonta', 'kvitancy.id_sost = sost_remonta.id_sost');
		$this->db->join('service_centers', 'kvitancy.id_sc = service_centers.id_sc');
		
		
		if($search_string){
					$this->db->like('model', $search_string);
					$this->db->or_like('phone', $search_string);
					$this->db->or_like('fam', $search_string); 
				}
				
		//$this->db->group_by('id_kvitancy');

						if($order){
							$this->db->order_by($order, $order_type);
						}else{
							$this->db->order_by('id_kvitancy', $order_type);
						}

						
        if($limit_start && $limit_end){
          $this->db->limit($limit_start, $limit_end);	
        }

        if($limit_start != null){
          $this->db->limit($limit_start, $limit_end);    
        }
        
	$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
    }

	/**
    * Get filter kvitancy
    * @param int $search_string
    * @param int $order
    * @return int
    */
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
                            $id_responsible=null,
							$id_where=null,
							$count=null
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
kvitancy.id_where,



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


            $where = "(kvitancy.model LIKE '%$search_string%' OR user.phone LIKE '%$search_string%' OR user.fam LIKE '%$search_string%')";

            $this->db->where($where);

					//$this->db->where('kvitancy.model LIKE', "%$search_string%");
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
					$this->db->where('kvitancy.id_sc', $id_sc);
				}
					$this->db->where('kvitancy.id_kvitancy', $id_kvitancy);
						$query = $this->db->get();
			
			//return($this->db->last_query());die;
			
						if ($query->num_rows() > 0) {
						if ($count) {return $query->num_rows(); }
							else 
					
						return $query->result_array();
						}else return null;			
			}

			

		if($date != null){
            if($start_date AND !$end_date) {
                $this->db->where(" kvitancy.".$date." >= '".$start_date."%' ", NULL, FALSE);
            }

                elseif(!$start_date AND $end_date) {
                        $this->db->where(" kvitancy.".$date." <= '".$end_date."%' ", NULL, FALSE);
                    }

					elseif($start_date AND $end_date) {
					$this->db->where(" kvitancy.".$date." >= '".$start_date."%' AND kvitancy.".$date." <= '".$end_date."%' ", NULL, FALSE);
					}
					
					
				}
		
		if($id_mechanic != null){
					$this->db->where('kvitancy.id_mechanic', $id_mechanic);
				}
		if ($id_sc != null){
					$this->db->where('kvitancy.id_sc', $id_sc);
				}
		if ($id_where != null){
			$this->db->where('kvitancy.id_where', $id_where);
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
        if ($id_responsible != null){
            $this->db->where('kvitancy.id_responsible', $id_responsible);
        }
	if ($count) {$limit_start= null; $limit_end=null;
	}else {		
        if($limit_start && $limit_end){
          $this->db->limit($limit_start, $limit_end);	
        }
		elseif($limit_start != null){
          $this->db->limit($limit_start, $limit_end);    
        }
       
	}
        
		
	$query = $this->db->get();
		//echo ($this->db->last_query());die;
		
		if ($query->num_rows() > 0) {
			if ($count) {return $query->num_rows(); }
			else 
		
			return $query->result_array();
		}else return null;
}	
	
    /**
    * Count the number of rows
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_kvitancy($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('kvitancy');
		if($search_string){
			$this->db->like('name_sc', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id_kvitancy', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_kvitancy($data)
    {
		$insert = $this->db->insert('kvitancy', $data);
	    return $insert;
	}

    /**
    * Update manufacture
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_kvitancy($id, $data)
    {
		$this->db->where('id_kvitancy', $id);
		$this->db->update('kvitancy', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

    /**
    * Delete manufacturer
    * @param int $id - manufacture id
    * @return boolean
    */
	function delete_kvitancy($id){
		$this->db->where('id_kvitancy', $id);
		$this->db->delete('kvitancy'); 
	}
	
	
	function get_comments($id_kvitancy){
	
	$this->db->select('*');
		$this->db->from('comments');
			
			$this->db->join('membership', 'comments.id_user = membership.id');
			$this->db->where('comments.id_kvitancy', $id_kvitancy);
			
			$query = $this->db->get();
			return $query->result_array();
	
	//return array ('name' => 'mikh');
	}
		
		
	public function get_comment_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('comments');
		$this->db->join('membership', 'comments.id_user = membership.id');
		$this->db->where('id_comment', $id);
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array(); 
    }


    public function get_type_sost_remonta ($id_sost){
        $this->db->select('type');
        $this->db->from('sost_remonta');
        $this->db->where('id_sost', $id_sost);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_works ($id_kvitancy){
        $this->db->select('*');
        $this->db->from('works');
        $this->db->where('id_kvitancy', $id_kvitancy);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_store ($id_kvitancy){
        $this->db->select('*');
        $this->db->from('store');
        $this->db->where('id_kvitancy', $id_kvitancy);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_parts ($id_kvitancy){
        $this->db->select('*');
        $this->db->from('parts');
        $this->db->where('id_kvitancy', $id_kvitancy);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_aparat_p_by_id ($id_aparat_p){
        $this->db->select('title');
        $this->db->from('aparat_p');
        $this->db->where('id_aparat_p', $id_aparat_p);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_cash ($id_kvitancy){
        $this->db->select('*');
        $this->db->from('cash');
        $this->db->join('membership', 'cash.update_user = membership.id');
        $this->db->where('id_kvitancy', $id_kvitancy);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_sum ($id_kvitancy){

    $this->db->select('SUM(cost) as sum');
    $this->db->from('works'); // инженеры
    $this->db->where('id_kvitancy', $id_kvitancy);
    $query = $this->db->get();
    $works = $query->result_array();
    $work = $works[0]['sum'];

    $this->db->select('SUM(cost) as cost');
    $this->db->from('store'); // склад
    $this->db->where('id_kvitancy', $id_kvitancy);
    $query = $this->db->get();
    $cost = $query->result_array();
    $cost = $cost[0]['cost'];
    return $cost+$work;


}

    public function get_stat ($id_kvitancy){

        $stat = array();

        $this->db->select('*');
        $this->db->from('works'); // инженеры
        $this->db->where('id_kvitancy', $id_kvitancy);
        $this->db->join('membership', 'works.user_id = membership.id');
        $query = $this->db->get();
        $works = $query->result_array();
        $stat["work"] = $works;

        $this->db->select('*');
        $this->db->from('store'); // склад
        $this->db->where('id_kvitancy', $id_kvitancy);
        $this->db->join('aparat_p', 'store.id_aparat_p = aparat_p.id_aparat_p');
        $query = $this->db->get();
        $cost = $query->result_array();
        $stat["cost"] = $cost;

        $stat["cash"] = $this->get_cash ($id_kvitancy);

        return $stat;

    }


function show_aparat_p ($id_aparat) {
        // Существует ли строка POST запроса 'queryString'?
        if ($id_aparat) {


            $this->db->select('*');
            $this->db->from('aparat_p');
            $this->db->where('id_aparat', $id_aparat);

            $this->db->order_by('title', 'Acs');
            $query = $this->db->get();

            $row = array();
            if ($query->num_rows() > 0) {
                return $row = $query->result_array();
            }



        }
    }

}//end class
?>