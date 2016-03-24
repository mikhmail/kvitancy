<?php

class Ajx extends CI_Controller {

	function __construct()
	{
		parent::__construct();

        if(!$this->session->userdata('user_id')){
            redirect('admin/login');
        }

		$this->load->model('kvitancy_model');
        $this->load->model('users_model');
        $this->load->model('store_model');
        $this->load->model('service_centers_model');
        $this->load->model('sost_remonta_model');



    }
	
	public function __destruct() {
    $this->db->close();
	}
	
	// Фильтрация данных

			public function clearData($data, $type="s"){
					switch($type){
						case "s":
							$a = mysqli_real_escape_string($this->db->conn_id,trim(htmlspecialchars($data)));
							return str_replace('\r\n','<br>',$a);
						case "i":
							return (int)$data;
						case "p":
							$data = str_replace(' ','',$data);
							return (int)$data;
					}
				}

	
	function change_status ($id_sost, $id_kvitancy, $update_user=NULL)
	{
	$update_user=$this->session->userdata('user_id');
    $type = $this->kvitancy_model->get_type_sost_remonta ($id_sost);
    $sost_remonta = $this->sost_remonta_model->get_sost_remonta_by_id($id_sost);

        if ($type[0]["type"] == 1) {
        $data = array(
            'id_sost' => $id_sost,
            'date_okonchan' => '',
            'date_vydachi' => '',
            'update_time' => date("j-m-Y, H:i:s"),
            'update_user' => $update_user
        );
    }else{

            $data = array(
                'id_sost' => $id_sost,
                'date_okonchan' => date("Y-m-j"),
                'date_vydachi' => date("Y-m-j"),
                'update_time' => date("j-m-Y, H:i:s"),
                'update_user' => $update_user
            );

        }

    /*
	if ($id_sost == 1) {
	$data = array(
					   'id_sost' => $id_sost,
					   'date_okonchan' => '',
					   'date_vydachi' => '',
                        'update_time' => date("j-m-Y, H:i:s"),
                        'update_user' => $update_user
					   );
	}
	elseif ($id_sost == 3) {
	$data = array(
					   'id_sost' => $id_sost,
					   'date_okonchan' => '',
					   'date_vydachi' => '',
                        'update_time' => date("j-m-Y, H:i:s"),
                        'update_user' => $update_user
					   );
	}
	elseif ($id_sost == 4) {
	$data = array(
					   'id_sost' => $id_sost,
					   'date_okonchan' => date("Y-m-j"),
					   'date_vydachi' => '',
                        'update_time' => date("j-m-Y, H:i:s"),
                        'update_user' => $update_user
					   );
	}
	elseif ($id_sost == 6) {
	$data = array(
					   'id_sost' => $id_sost,
					   'date_okonchan' => date("Y-m-j"),
					   'date_vydachi' => '',
                        'update_time' => date("j-m-Y, H:i:s"),
                        'update_user' => $update_user
					   );
	}
	elseif ($id_sost == 7 or $id_sost == 8 or $id_sost == 9) {
	$data = array(
					   'id_sost' => $id_sost,
					   'date_okonchan' => '',
					   'date_vydachi' => date("Y-m-j"),
                        'update_time' => date("j-m-Y, H:i:s"),
                        'update_user' => $update_user
					   );
	}						
	elseif ($id_sost == 10) {
	$data = array(
					   'id_sost' => $id_sost,
					   'date_okonchan' => '',
					   'date_vydachi' => '',
                        'update_time' => date("j-m-Y, H:i:s"),
                        'update_user' => $update_user
					   );
	}							
	elseif ($id_sost == 17) {
	$data = array(
					   'id_sost' => $id_sost,
					   'date_okonchan' => '',
					   'date_vydachi' => '',
                        'update_time' => date("j-m-Y, H:i:s"),
                        'update_user' => $update_user
					   );
	}
	else {
	$data = array(
					   'id_sost' => $id_sost,
					   'date_okonchan' => '',
					   'date_vydachi' => '',
                        'update_time' => date("j-m-Y, H:i:s"),
                        'update_user' => $update_user
					   );

	}	  
    */
		
		
			
		$this->db->where('id_kvitancy', $id_kvitancy);
		$ret = $this->db->update('kvitancy', $data);
        if ($ret) echo json_encode($sost_remonta[0]);
		
	}
		
	
	function change_mechanic ($id_meh, $id_kvitancy, $update_user=NULL)
	{
    $update_user = $this->session->userdata('user_id');
		$data = array(
					   'id_mechanic' => $id_meh,
					   'update_time' => date("j-m-Y, H:i:s"),
					   'update_user' => $update_user
					   );
	
	
		$this->db->where('id_kvitancy', $id_kvitancy);	
		$ret = $this->db->update('kvitancy', $data);
	}


    function change_resp ($id_responsible, $id_kvitancy, $update_user=NULL )
    {
     $update_user = $this->session->userdata('user_id');
        $data = array(
            'id_responsible' => $id_responsible,
            'update_time' => date("j-m-Y, H:i:s"),
            'update_user' => $update_user
        );


        $this->db->where('id_kvitancy', $id_kvitancy);
        $ret = $this->db->update('kvitancy', $data);
    }



    function update_part ()
    {

        $data = array(
            'update_time' => date("j-m-Y, H:i:s"),
            'update_user' => $this->session->userdata('user_id'),
            'id_kvitancy' => '',
            'status' => 1,


        );
        $this->db->where('id', $this->input->post('id_part'));
        $ret = $this->db->update('store', $data);
    }



    function add_work ()
    {

        $date = date("Y-m-d H:i:s");

        if ($this->input->post('name')) {
            $data = array(
                'date_added' => $date,
                'name' => $this->clearData($this->input->post('name')),
                'user_id' => $this->input->post('user_id'),
                'id_kvitancy' => $this->input->post('id_kvitancy'),
                'cost' => $this->input->post('cost'),
                'id_sc' => $this->session->userdata['user_id_sc']
            );

            $ret = $this->db->insert('works', $data);
            if ($ret) {
                $user = $this->users_model->get_users_by_id ($this->input->post('user_id'));
            echo '<tr>
                     <td>' . $user[0]['user_name'] . '</td>
                     <td>' . $this->input->post('name') . '</td>
                     <td>' . $this->input->post('cost') . '</td>
                     <td>' . $date . '</td>
                 </tr>';
            }
        }
        else echo 'Надо ввести значение';
    }

    function delete_work ()
    {

        $this->db->delete('works', array('id' => $this->input->post('id_work')));
        if ($this->db->affected_rows() > 0) return TRUE;

        return FALSE;
    }



    function add_comment ()
	{	
	//var_dump(($this->input->post('comment')));die;
		$user_id = $this->session->userdata['user_id'];
		$date = date("Y-m-d H:i:s");
		
		if ($this->input->post('comment')) {
		$data = array(
					   'date' => $date,
					   'comment' => $this->clearData($this->input->post('comment')),
					   'id_user' => $user_id,
					   'id_kvitancy' => $this->input->post('id')
					   );
		
		$ret = $this->db->insert('comments', $data);
		if ($ret) {
		
		$arr = $this->kvitancy_model->get_comment_by_id($this->db->insert_id());
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
									   'fam' => $this->clearData($this->input->post('fam')),
									   'imya' => $this->clearData($this->input->post('imya')),
									   'otch' => $this->clearData($this->input->post('otch')),
									   'phone' => $this->clearData($this->input->post('phone')),
									   'mail' => $this->clearData($this->input->post('mail')),
									   'adres' => $this->clearData($this->input->post('adres'))
						);
		
		if ( $this->db->insert('users', $user) )
					
					$user_id = $this->db->insert_id();
		
		}
		
		
		
		
		
		if ($user_id) {
					$data_kvit = array(
								   'user_id' => $user_id,
								   'id_aparat' => $this->input->post('id_aparat'),
								   'id_proizvod' => $this->input->post('id_proizvod'),
								   'model' => $this->clearData($this->input->post('model')),
								   'ser_nomer' => $this->clearData($this->input->post('ser_nomer')),
								   'neispravnost' => $this->clearData($this->input->post('neispravnost')),
								   'komplektnost' => $this->clearData($this->input->post('komplektnost')),
								   'date_priemka' => $date = date("Y-m-d"),
								   'date_okonchan' => '',
								   'date_vydachi' => '',
								   'id_sost' => 1,
								   'vid' => $this->clearData($this->input->post('vid')),
								   'id_remonta' => $this->input->post('id_remonta'),
								   'id_sc' => $this->input->post('id_sc'),
								   'primechaniya' => $this->clearData($this->input->post('primechaniya')),
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


    function look_aparat_p () {
        // Существует ли строка POST запроса 'queryString'?
        if ($this->input->post('queryString')) {
            $queryString = $this->input->post('queryString');
            $id_kvitancy = $this->input->post('id_kvitancy');

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

            // Если длинна строки больше чем 0? Там что то есть
            if(strlen($queryString) > 0) {
                // Запускаем запрос: используем LIKE '$queryString%'
                // Знак процентов(%)это wild-card, в моем примере о странах работает так...
                // $queryString = 'Uni'; если строка запроса начаниется на ...
                // Returned data = 'United States, United Kindom'; должно возвратиться ..

                //$row = Filter::select( "Select *  From aparaty where aparat_name LIKE UPPER('".$_POST['queryString']."%') order by aparat_name asc" );

                $this->db->select('*');
                $this->db->from('aparat_p');
                $this->db->where('id_aparat', $kvitancy[0]['id_aparat']);
                $this->db->like('title', $queryString, 'after');
                $this->db->order_by('title', 'Acs');
                $query = $this->db->get();

                $row = array();
                if ($query->num_rows() > 0) {
                    $row = $query->result_array();
                }

                if($row) {

                    $div = "\r\n<div  style='position:absolute; background:#fff; overflow:auto; height:99px; width:300px; z-index:1; margin-top:7px; margin-left:0px; border:1px solid #5aa8cc; border-radius: 6px; -webkit-border-radius: 6px; -moz-border-radius: 6px; padding:6px; ' id='apparat_box' >\r\n\r\n<div  style='position:relative; cursor:pointer; color:#def0f8; font:bold 16px Arial; height:15px; width:46px; z-index:2; margin:2px 0 -15px 230px; border:0px solid red; text-shadow:#162b35 2px 2px 3px;' onclick=\"document.getElementById('apparat_box').style.display='none';\">закрыть</div>\r\n<ul class='".__FILE__."'>";
                    foreach ($row as $a=>$row9)
                    {
                        $div .= '<li style=\'padding:8px 0 0 0; cursor:pointer; height:14px; font-size:12px;\' onclick=\'fill_apparat_p("'.$row9["id_aparat_p"].'__'.$row9["title"].'__'.$id_kvitancy.'")\'>
									&nbsp;'.$row9["title"].' &nbsp;</li>';
                    }
                    $div .= "</ul></div>";
                    echo $div;

                }
            }
        }
    }


    function show_aparat_p () {
        // Существует ли строка POST запроса 'queryString'?
        if ($this->input->post('id_aparat')) {

            $id_aparat = $this->input->post('id_aparat');



                $this->db->select('*');
                $this->db->from('aparat_p');
                $this->db->where('id_aparat', $id_aparat);

                $this->db->order_by('title', 'Acs');
                $query = $this->db->get();

                $row = array();
                if ($query->num_rows() > 0) {
                    $row = $query->result_array();
                }

                if($row) {

                    echo '<option value=0 selected>- выбрать -</option>';
                    foreach($row as $r){
                        echo "<option value='".$r['id_aparat_p']."'>".$r['title']."</option>\n";
                    }
                    exit();

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

        $id_sc = $this->input->post('id_sc');

        // Если длинна строки больше чем 0? Там что то есть
        if(strlen($queryString) > 0) {
      
		$this->db->select('*');
		$this->db->from('users');

            /*
            if($id_sc) {
                $this->db->where('id_sc', $id_sc);
            }
            */

            $this->db->like('fam', $queryString);

        //return($this->db->last_query());die;
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
                $adres = str_replace(array('"', '&quot;'), '', $row9["adres"]);
		
    $div .= '<li style=\'padding:8px 0 0 0; cursor:pointer; height:14px; font-size:12px;\' onclick=\'fill_user("'.$row9["user_id"].'-'.$row9["fam"].'-'.$row9["imya"].'-'.$row9["otch"].'-'.$row9["mail"].'-'.$adres.'-'.$row9["phone"].'")\'>
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



function add_store(){
    if ($this->input->post()) {

    $count = $this->input->post('count');
    $data = array(
        'name' => $this->clearData($this->input->post('text')),
        'id_aparat' => $this->input->post('id_aparat'),
        'id_aparat_p' => $this->input->post('id_aparat_p'),
        'id_proizvod' => '',
        'model' => '',
        'serial' => '',
        'vid' => '',
        'id_sost' => $this->input->post('id_sost'),
        'user_id' => $this->session->userdata['user_id'],
        'date_priemka' => date("Y-m-j"),
        'cost' => $this->input->post('cost'),
        'price' => $this->input->post('price'),
        'status' => 0,
        'id_kvitancy' => $this->input->post('id_kvitancy'),
        'update_user' => $this->session->userdata['user_id'],
        'update_time' => date("j-m-Y, H:i:s"),
        'id_resp' => $this->session->userdata['user_id'],
        'id_from' => $this->session->userdata['user_id_sc'],
        'id_where' => $this->session->userdata['user_id_sc'],
        'id_sc' => $this->session->userdata['user_id_sc']

    );

        $ok ='';
        for ($i=1;$i<=$count;$i++){
            $this->db->insert('store', $data);
                $ok = $this->db->insert_id();
        }
        if ($ok) {

            if($this->input->post('id_sost') == 1) {$sost = 'Новый';} else $sost = 'Б.У.';
            echo '<tr>
                     <td>' . $this->clearData($this->input->post('name')) . '</td>
                     <td>' . $this->clearData($this->input->post('text')) . '</td>
                     <td>' . $sost . '</td>
                     <td>' . $this->input->post('cost') . '</td>
                     <td>' . $this->input->post('price') . '</td>
                     <td>' . $this->session->userdata['user_name'] . '</td>
                     <td>' . date('j-m-Y, H:i:s') . '</td>

                     <td></td>
                 </tr>';
        }

    }

}



    function check_aparat_p_by_id () {


        $name = $this->input->post('name');


        $this->db->select('*');
        $this->db->from('aparat_p');
        $this->db->where('title', $name);
        $query = $this->db->get();

        $rez = $query->result_array();
        if( count($rez) > 0 ) {
            echo 1;
        } else echo 0;

    }


// проверкам аппарат_p на занятость
    function check_app_p($aparat_p) {

//$sql = Filter::select("SELECT aparat_name FROM aparaty WHERE aparat_name='".mysql_escape_string($app)."'");
        $this->db->select('*');
        $this->db->from('aparat_p');
        $this->db->where('title', $aparat_p);
        $query = $this->db->get();

        return $query->result_array();

    }

//добавить aparat_p
    function add_aparat_p () {
        if ($this->input->post('aparat_p')) {
            $check_app = $this->check_app_p($this->clearData($this->input->post('aparat_p')));
            if( count($check_app) > 0 ) {

                echo '0';
            } else {

                $aparat_p = array('title' => $this->input->post('aparat_p'), 'id_aparat' => $this->input->post('id_aparat'));

                if ( $this->db->insert('aparat_p', $aparat_p) ) $add_apparat_id = $this->db->insert_id();

                if ($add_apparat_id) echo $add_apparat_id;
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
					
					$aparat = array('aparat_name' => $this->clearData($this->input->post('aparat_name')));
		
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
					$brand = array('name_proizvod' => $this->clearData($this->input->post('proizvod_name')));
		
						if ( $this->db->insert('proizvoditel', $brand) ) $add_apparat_id = $this->db->insert_id();

							if ($add_apparat_id) echo $add_apparat_id;
				}
		}	
}


function show_store () {
        if ($this->input->post('id_aparat_p') AND $this->input->post('id_kvitancy')) {
            $id_aparat_p = $this->input->post('id_aparat_p');
            $id_kvit = $this->input->post('id_kvitancy');

            $store = $this->store_model->get_store (
                    $search_string=null,
                    $order=null,
                    $order_type=null,
                    $limit_start=null,
                    $limit_end=null,
                    $start_date=null,
                    $end_date=null,
                    $id_aparat=null,
                    $id_aparat_p = $id_aparat_p,
                    $id_proizvod=null,

                    $id_sost=null,
                    $user_id=null,
                    $id_resp=null,

                    $id_where=null,
                    $id_sc=null,

                    $id_kvitancy=null,
                    $status=1,
                    $count=null,
                    $summ=null
            );
    //print_r($store);exit;

            $rezult = '
            <table class="table table-striped table-bordered table-condensed">
                <thead>
                <tr>

                    <th class="yellow header headerSortDown">Название</th>
                    <th class="yellow header headerSortDown">Состояние</th>
                    <th class="yellow header headerSortDown">Стоимость/Цена</th>
                    <th class="yellow header headerSortDown">Ответственный</th>
                    <th class="yellow header headerSortDown">Склад</th>





                </tr>
                </thead>
            ';
if (count($store)>0){
    //var_dump($store);die;
foreach($store as $row)
{
    if($row['id_sost'] == 1) {$row['id_sost']= 'Новый';} else {$row['id_sost'] = 'Б.У.';}

    /*

    switch ($this->session->userdata('id_group')) {
        case 1: // админ
            $sc = $this->service_centers_model->get_service_centers('', '', 'Asc', '', '', '');
            break;


        case 2: // приемщик
            $sc = $this->service_centers_model->get_service_centers('', '', 'Asc', '', '', $this->session->userdata('user_id_sc'));
            break;


        case 3: // инженер
            $sc = $this->service_centers_model->get_service_centers('', '', 'Asc', '', '', $this->session->userdata('user_id_sc'));
            break;

        default:
            $sc = $this->service_centers_model->get_service_centers('', '', 'Asc', '', '', $this->session->userdata('user_id_sc'));
    }

   */

    $sc = $this->service_centers_model->get_service_centers('', '', 'Asc', '', '', '');
    foreach ($sc as $rows)
    {
        if ($rows['id_sc'] == $row['id_where']) $id_where = $rows['name_sc'];
    }

    $users = $this->users_model->get_users('', '', '', '', '', '', '');
    foreach ($users as $rowu)
    {
        if ($rowu['id'] == $row['id_resp']) $id_resp = $rowu['user_name'];
    }

    $rezult .= '<tr id="online_store_tr_'.$row['store_id'].'">';
    $rezult .= '<td><a href="#" onclick="fill_store('.$row['store_id'].', '.$id_kvit.');return false">'.$row['name'].'</a></td>';
    $rezult .= '<td>'.$row['id_sost'].'</td>';
    $rezult .= '<td>'.$row['cost'].' / '.$row['price'].'</td>';
    $rezult .= '<td>'.$id_resp.'</td>';
    $rezult .= '<td>'.$id_where.'</td>';
    $rezult .= '</tr>';

}
$rezult .= '</tbody>
</table>';

             echo $rezult;
                }else {
            echo '<p>По вашему запросу ничего не найдено.</p>
            <p>Если вы хотите списать запчасти с другого склада попросите у администратора сделать перемещение.</p>';
        }
    }
}



function get_store_by_id () {
    $id = $this->input->post('id');

    $store = $this->store_model->get_store_by_id ($id);

    if (count($store)>0) {

        foreach($store as $row){

            if($row['id_sost'] == 1) {$sost = 'Новый';} else $sost = 'Б.У.';

            $rezult  = '<tr id="part_tr_'.$row['store_id'].'">';
            $rezult .= '<td>'.$row['title'].'</td>';
            $rezult .= '<td>'.$row['name'].'</td>';
            $rezult .= '<td>'.$sost.'</td>';
            $rezult .= '<td>'.$row['cost'].'</td>';
            $rezult .= '<td>'.$row['price'].'</td>';
            $rezult .= '<td>'.$this->session->userdata['user_name'].'</td>';
            $rezult .= '<td>'.date('j-m-Y').'</td>';
            $rezult .= '<td>
            <div class="btn-group margin-bottom-10px">
                 <button name="'.$row['store_id'].'" id="part_dell_'.$row['store_id'].'" class="btn btn-danger">
                    <i class="icon-remove icon-white"></i>
                 </button>
            </div>
            </td>';
            $rezult .= '</tr>';

        }
        echo $rezult;
    }

}

function update_ajax_store ()
{
    $id = $this->input->post('id');
    $id_kvitancy = $this->input->post('id_kvitancy');

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
    //print_r($kvitancy);exit;
    if($kvitancy){
        $data = array(
            'update_time' => date("j-m-Y, H:i:s"),
            'update_user' => $this->session->userdata('user_id'),
            'id_kvitancy' => $id_kvitancy,
            'status' => 0,
        );
        $this->db->where('id', $id);
        $ret = $this->db->update('store', $data);
        if ($ret) echo 1;
    }else{
        echo 0;
    }


}

    function setup_ajax_store ()
    {
        $id = $this->input->post('id');
        $text = $this->input->post('text');


        if($text AND $id){
            $data = array(
                'update_time' => date("j-m-Y, H:i:s"),
                'update_user' => $this->session->userdata('user_id'),
                'text' => $text,
                'status' => 0,
            );
            $this->db->where('id', $id);
            $ret = $this->db->update('store', $data);
            if ($ret) echo 1;
        }else{
            echo 0;
        }


    }

    function save_price ()
    {
        $id_kvitancy = $this->input->post('id');
        $price = $this->input->post('price');


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
        //print_r($kvitancy[0]['id_sc']);exit;
        $id_sc = $kvitancy[0]['id_sc'];

        $check = $this->db->get_where('cash', array('id_kvitancy' => $id_kvitancy));

        if($price AND $id_kvitancy AND count($check->result_array())<1 ){
            $data = array(
                'update_time' => date("H:i:s"),
                'update_date' => date("Y-m-d"),
                'update_user' => $this->session->userdata('user_id'),
                'id_kvitancy' => $id_kvitancy,
                'plus' => $price,
                'name' => 'Получено от клиента',
                'id_sc' => $id_sc,

            );
            $ret = $this->db->insert('cash', $data);
            if ($ret) echo 1;
        }else{
            echo 0;
        }

        /*
        if($price AND $id_kvitancy){
            $data = array(
                'update_time' => date("j-m-Y, H:i:s"),
                'update_user' => $this->session->userdata('user_id'),
                'full_cost' => $price
            );
            $this->db->where('id_kvitancy', $id_kvitancy);
            $ret = $this->db->update('kvitancy', $data);
        if ($ret) echo 1;
        }else{
            echo 0;
        }
        */

    }

    function add_cash ()
    {
        $id_kvitancy = $this->input->post('id_kvitancy');
        $plus = $this->input->post('plus');
        $name =  $this->input->post('name');




        if ($plus AND $name) {
            $data = array(
                'update_time' => date("H:i:s"),
                'update_date' => date("Y-m-d"),
                'update_user' => $this->session->userdata('user_id'),
                'id_kvitancy' => $id_kvitancy,
                'plus' => $plus,
                'name' => $name,
                'id_sc' => $this->session->userdata('user_id_sc')
            );
            $ret = $this->db->insert('cash', $data);

            /*
            $data2 = array(
                'update_time' => date("j-m-Y, H:i:s"),
                'update_user' => $this->session->userdata('user_id'),
                'full_cost' => $plus,
                );
            $this->db->where('id_kvitancy', $id_kvitancy);
            $ret2 = $this->db->update('kvitancy', $data2);
            */

            if ($ret) echo 1;
        }else{
            echo 0;
        }

        /*
        if($price AND $id_kvitancy){
            $data = array(
                'update_time' => date("j-m-Y, H:i:s"),
                'update_user' => $this->session->userdata('user_id'),
                'full_cost' => $price
            );
            $this->db->where('id_kvitancy', $id_kvitancy);
            $ret = $this->db->update('kvitancy', $data);
        if ($ret) echo 1;
        }else{
            echo 0;
        }
        */

    }


//end class
}