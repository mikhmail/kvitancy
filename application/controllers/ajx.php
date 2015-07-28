<?php

class Ajx extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('kvitancy_model');
	}
	
	public function __destruct() {
    $this->db->close();
	}
	
	// Фильтрация данных

			public function clearData($data, $type="s"){
					switch($type){
						case "s":
							$a = mysql_real_escape_string(trim(htmlspecialchars($data)));
							return str_replace('\r\n','<br>',$a);
						case "i":
							return (int)$data;
						case "p":
							$data = str_replace(' ','',$data);
							return (int)$data;
					}
				}

	
	function change_status ($id_sost, $id_kvitancy)
	{
	
	
	if ($id_sost == 1) {
	$data = array(
					   'id_sost' => $id_sost,
					   'date_okonchan' => '',
					   'date_vydachi' => ''
					   );
	}
	elseif ($id_sost == 3) {
	$data = array(
					   'id_sost' => $id_sost,
					   'date_okonchan' => '',
					   'date_vydachi' => ''
					   );
	}
	elseif ($id_sost == 4) {
	$data = array(
					   'id_sost' => $id_sost,
					   'date_okonchan' => date("Y-m-j"),
					   'date_vydachi' => ''
					   );
	}
	elseif ($id_sost == 6) {
	$data = array(
					   'id_sost' => $id_sost,
					   'date_okonchan' => date("Y-m-j"),
					   'date_vydachi' => ''
					   );
	}
	elseif ($id_sost == 7 or $id_sost == 8 or $id_sost == 9) {
	$data = array(
					   'id_sost' => $id_sost,
					   'date_okonchan' => '',
					   'date_vydachi' => date("Y-m-j")
					   );
	}						
	elseif ($id_sost == 10) {
	$data = array(
					   'id_sost' => $id_sost,
					   'date_okonchan' => '',
					   'date_vydachi' => ''
					   );
	}							
	elseif ($id_sost == 17) {
	$data = array(
					   'id_sost' => $id_sost,
					   'date_okonchan' => '',
					   'date_vydachi' => ''
					   );
	}
	else {
	$data = array(
					   'id_sost' => $id_sost,
					   'date_okonchan' => '',
					   'date_vydachi' => ''
					   );
	}	  
		
		
		
			
		$this->db->where('id_kvitancy', $id_kvitancy);
		$ret = $this->db->update('kvitancy', $data);
		
		
	}
		
	
	function change_mechanic ($id_meh, $id_kvitancy, $update_user=NULL)
	{
		$data = array(
					   'id_mechanic' => $id_meh,
					   'update_time' => date("j-m-Y, H:i:s"),
					   'update_user' => $update_user
					   );
	
	
		$this->db->where('id_kvitancy', $id_kvitancy);	
		$ret = $this->db->update('kvitancy', $data);
	}
	
	function add_comment ()
	{	
	//var_dump(($this->input->post('comment')));die;
		$user_id = $this->session->userdata['user_id'];
		$date = date("Y-m-d H:i:s");
		
		if ($this->input->post('comment')) {
		$data = array(
					   'date' => $date,
					   'comment' => $this->input->post('comment'),
					   'id_user' => $user_id,
					   'id_kvitancy' => $this->input->post('id')
					   );
		
		$ret = $this->db->insert('comments', $data);
		if ($ret) {
		
		$arr = $this->kvitancy_model->get_comment_by_id(mysql_insert_id());
		foreach($arr as $rowc)
				{	echo '<li id=li_' . $rowc['id_comment'] . '>' . $rowc['date'] . ' ' . $rowc['first_name'] . ' ' . $rowc['last_name'] . ' aka ' . $rowc['user_name'] . ' пишет: ' . '<br><font color="#0066CC"><b>' . $rowc['comment'] . '</b></font>';
					
				}
			}
		}
		else echo 'Надо ввести сообщение';
	}
	
	function delete_comment ()
	{	

		$this->db->delete('comments', array('id_comment' => $this->input->post('id_comment')));
			if ($this->db->affected_rows() > 0) return TRUE;
		
        return FALSE;
		}
		
	function add_kvitancy ()
	{	
		//var_dump($this->input->post());die;
		
		if ($this->input->post('neispravnost')) {
		
						
		
		if ($this->input->post('user_id')) {
				
				$user_id = $this->input->post('user_id');
		
		} else {
		
		$user = array(
									   'fam' => $this->input->post('fam'),
									   'imya' => $this->input->post('imya'),
									   'otch' => $this->input->post('otch'),
									   'phone' => $this->input->post('phone'),
									   'mail' => $this->input->post('mail'),
									   'adres' => $this->input->post('adres')
						);
		
		if ( $this->db->insert('users', $user) )
					
					$user_id = $this->db->insert_id();
		
		}
		
		
		
		
		
		if ($user_id) {
					$data_kvit = array(
								   'user_id' => $user_id,
								   'id_aparat' => $this->input->post('id_aparat'),
								   'id_proizvod' => $this->input->post('id_proizvod'),
								   'model' => $this->input->post('model'),
								   'ser_nomer' => $this->input->post('ser_nomer'),
								   'neispravnost' => $this->input->post('neispravnost'),
								   'komplektnost' => $this->input->post('komplektnost'),
								   'date_priemka' => $date = date("Y-m-d"),
								   'date_okonchan' => '',
								   'date_vydachi' => '',
								   'id_sost' => 1,
								   'vid' => $this->input->post('vid'),
								   'id_remonta' => $this->input->post('id_remonta'),
								   'id_sc' => $this->input->post('id_sc'),
								   'primechaniya' => $this->input->post('primechaniya'),
								   'id_where' => $this->input->post('id_where'),
								   'update_time' => date("Y-m-d H:i:s"),
								   'update_user' => $this->session->userdata['user_id'],
								   'whereid' => $this->input->post('id_sc')
								   );
		
					
					if ( $this->db->insert('kvitancy', $data_kvit) )
						echo $kvit_id = $this->db->insert_id(); exit;
			}
		
		}
		else echo 'Надо ввести';
	}


function look_apparat () {
	    // Существует ли строка POST запроса 'queryString'?
    if ($this->input->post('queryString')) {
        $queryString = $this->input->post('queryString');
		
        // Если длинна строки больше чем 0? Там что то есть
        if(strlen($queryString) > 0) {
        // Запускаем запрос: используем LIKE '$queryString%'
        // Знак процентов(%)это wild-card, в моем примере о странах работает так...
        // $queryString = 'Uni'; если строка запроса начаниется на ...
        // Returned data = 'United States, United Kindom'; должно возвратиться ..
 
        //$row = Filter::select( "Select *  From aparaty where aparat_name LIKE UPPER('".$_POST['queryString']."%') order by aparat_name asc" );
        
		$this->db->select('*');
		$this->db->from('aparaty');
		$this->db->like('aparat_name', $queryString);
		//$this->db->order_by('aparat_name', 'Desc');
		$query = $this->db->get();
		
		$row = array();
		if ($query->num_rows() > 0) {
			$row = $query->result_array();
		}
		
		if($row) {
            
				$div = "\r\n<div  style='position:absolute; background:#fff; overflow:auto; height:99px; width:500px; z-index:1; margin-top:7px; margin-left:0px; border:1px solid #5aa8cc; border-radius: 6px; -webkit-border-radius: 6px; -moz-border-radius: 6px; padding:6px; ' id='apparat_box' >\r\n\r\n<div  style='position:relative; cursor:pointer; color:#def0f8; font:bold 16px Arial; height:15px; width:46px; z-index:2; margin:2px 0 -15px 398px; border:0px solid red; text-shadow:#162b35 2px 2px 3px;' onclick=\"document.getElementById('apparat_box').style.display='none';\">закрыть</div>\r\n<ul class='".__FILE__."'>";
				foreach ($row as $a=>$row9)
					{
					 $div .= '<li style=\'padding:8px 0 0 0; cursor:pointer; height:14px; font-size:12px;\' onclick=\'fill_apparat("'.$row9["id_aparat"].'-'.$row9["aparat_name"].'")\'>
									&nbsp;'.$row9["aparat_name"].' &nbsp;</li>';
					}
				$div .= "</ul></div>";
				echo $div;
		
			} else {
				echo 'Nothing found ...';
			}
		}
	}
}	
	
function look_proizvod () {
	    // Существует ли строка POST запроса 'queryString'?
    if ($this->input->post('queryString')) {
        $queryString = $this->input->post('queryString');
		
        // Если длинна строки больше чем 0? Там что то есть
        if(strlen($queryString) > 0) {
        // Запускаем запрос: используем LIKE '$queryString%'
        // Знак процентов(%)это wild-card, в моем примере о странах работает так...
        // $queryString = 'Uni'; если строка запроса начаниется на ...
        // Returned data = 'United States, United Kindom'; должно возвратиться ..
 
        //$row = Filter::select( "Select *  From aparaty where aparat_name LIKE UPPER('".$_POST['queryString']."%') order by aparat_name asc" );
        
		$this->db->select('*');
		$this->db->from('proizvoditel');
		$this->db->like('name_proizvod', $queryString);
		//$this->db->order_by('name_proizvod', 'Desc');
		$query = $this->db->get();
		
		$row = array();
		if ($query->num_rows() > 0) {
			$row = $query->result_array();
		}
		
		if($row) {
            
				$div = "\r\n<div  style='position:absolute; background:#fff; overflow:auto; height:99px; width:500px; z-index:1; margin-top:7px; margin-left:0px; border:1px solid #5aa8cc; border-radius: 6px; -webkit-border-radius: 6px; -moz-border-radius: 6px; padding:6px; ' id='apparat_box' >\r\n\r\n<div  style='position:relative; cursor:pointer; color:#def0f8; font:bold 16px Arial; height:15px; width:46px; z-index:2; margin:2px 0 -15px 398px; border:0px solid red; text-shadow:#162b35 2px 2px 3px;' onclick=\"document.getElementById('proizvod_box').style.display='none';\">закрыть</div>\r\n<ul class='".__FILE__."'>";
				foreach ($row as $a=>$row9)
					{
					 $div .= '<li style=\'padding:8px 0 0 0; cursor:pointer; height:14px; font-size:12px;\' onclick=\'fill_proizvod("'.$row9["id_proizvod"].'-'.$row9["name_proizvod"].'")\'>
									&nbsp;'.$row9["name_proizvod"].' &nbsp;</li>';
					}
				$div .= "</ul></div>";
				echo $div;
		
			} else {
				echo 'Nothing found ...';
			}
		}
	}
}	




function search_user () {
    if ($this->input->post('queryString')) {
        $queryString = $this->input->post('queryString');
		

        // Если длинна строки больше чем 0? Там что то есть
        if(strlen($queryString) > 0) {
      
		$this->db->select('*');
		$this->db->from('users');
		$this->db->like('fam', $queryString);
		//$this->db->order_by('name_proizvod', 'Desc');
		$query = $this->db->get();
		
		$row = array();
		if ($query->num_rows() > 0) {
			$row = $query->result_array();
		}
		
        if($row) {
            
		$div = "\r\n<div  style='position:absolute; background:#fff; overflow:auto; height:99px; width:450px; z-index:1; margin-top:7px; margin-left:0px; border:1px solid #5aa8cc; border-radius: 6px; -webkit-border-radius: 6px; -moz-border-radius: 6px; padding:6px; ' id='proizvod_box' >\r\n\r\n<div  style='position:relative; cursor:pointer; color:#def0f8; font:bold 16px Arial; height:15px; width:46px; z-index:2; margin:2px 0 -15px 360px; border:0px solid red; text-shadow:#162b35 2px 2px 3px;' onclick=\"document.getElementById('user_box').style.display='none';\">Закрыть</div>\r\n
		<ul class='".__FILE__."' id='user_ul'>";
        foreach ($row as $a=>$row9)
			{
		
    $div .= '<li style=\'padding:8px 0 0 0; cursor:pointer; height:14px; font-size:12px;\' onclick=\'fill_user("'.$row9["user_id"].'-'.$row9["fam"].'-'.$row9["imya"].'-'.$row9["otch"].'-'.$row9["mail"].'-'.$row9["adres"].'-'.$row9["phone"].'")\'>
					&nbsp;'.$row9["fam"].' '.$row9["imya"].' '.$row9["otch"].', тел.'.$row9["phone"].'&nbsp;</li>';
         
			}
		$div .= "</ul></div>";
        echo $div;
		
		
        	
        } else {
        
		echo 0;
		}
	} 
	}
}

// проверкам аппарат на занятость
function check_app($app) {

//$sql = Filter::select("SELECT aparat_name FROM aparaty WHERE aparat_name='".mysql_escape_string($app)."'");
		$this->db->select('*');
		$this->db->from('aparaty');
		$this->db->where('aparat_name', $app);
		$query = $this->db->get();

	return $query->result_array();
				
}

function add_aparat () {
	if ($this->input->post('aparat_name')) {
		$check_app = $this->check_app($this->clearData($this->input->post('aparat_name')));
				if( count($check_app) > 0 ) {
				
					echo 'device is here';
				} else {
					
					$aparat = array('aparat_name' => $this->input->post('aparat_name'));
		
						if ( $this->db->insert('aparaty', $aparat) ) $add_apparat_id = $this->db->insert_id();

							if ($add_apparat_id) echo $add_apparat_id;
				}
		}	
}

function check_brand($app) {
		$this->db->select('*');
		$this->db->from('proizvoditel');
		$this->db->where('name_proizvod', $app);
		$query = $this->db->get();

	//if( count($query->result_array()) > 0 ) {return false;}
	//else return true;
		//return $this->db->last_query();
			return $query->result_array();
}

function add_proizvod () {
	if ($this->input->post('proizvod_name')) {
		$check_brand = $this->check_brand($this->clearData($this->input->post('proizvod_name')));
			
				if( count($check_brand) > 0 ) {
				
					echo 'the brand is here';
					
				} else { 
					$brand = array('name_proizvod' => $this->input->post('proizvod_name'));
		
						if ( $this->db->insert('proizvoditel', $brand) ) $add_apparat_id = $this->db->insert_id();

							if ($add_apparat_id) echo $add_apparat_id;
				}
		}	
}

	
}