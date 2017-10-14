<?php



//error_reporting(E_ERROR | E_WARNING | E_PARSE);
//error_reporting(E_ALL);


/*
// Подключение к БД.
$db1 = mysql_connect('localhost', 'techn157_glafira', 'glafira', 'techn157_glafira');
					mysql_select_db('techn157_glafira', $db1);
					mysql_query("SET NAMES 'utf8'", $db1);
					
*/


// Подключение к БД.
$db1 = mysql_connect('localhost', 'root', '', 'glafira');
					mysql_select_db('glafira', $db1);
					mysql_query("SET NAMES 'utf8'", $db1);

$info = parse_ini_file('../config.ini', true);

		$db = mysql_connect($info['main']['localhost'], $info['main']['user'], $info['main']['password']) or die('No connect with data base'); 
		
		mysql_select_db($info['main']['database'], $db) or die(mysql_error());
		
		mysql_query("SET NAMES UTF8");
		mysql_query("SET CHARACTER SET UTF8");	
// end of Подключение к БД.


$id_year = date("Y"); // 2015
$id_month = date("n"); // int 5
$month = date("m"); // int 5

//$s = strtotime('-2 month');
//$first_day = date("Y-m-d", $s);


$months = array("1"=>"Январь","2"=>"Февраль","3"=>"Март","4"=>"Апрель","5"=>"Май", "6"=>"Июнь", "7"=>"Июль","8"=>"Август","9"=>"Сентябрь","10"=>"Октябрь","11"=>"Ноябрь","12"=>"Декабрь");

$arr_month = array ();
foreach ($months as $key=>$value) {
	
    $arr_month[] = $value;
		if ($key == $id_month) break;
}


$arrs = array();
		
$sql = select("Select id_aparat, aparat_name from aparaty");		

//var_dump($sql);die;		


foreach ($sql as $key=>$val) {
	$id_aparat = $val["id_aparat"];
	$aparat_name = $val["aparat_name"];
		$pieces = explode(" ", $aparat_name);
	$aparat_name = $pieces[0];
	
	
	



$where = "";
for ($i=1; $i<=$id_month; $i++) {
	
	if($i != $id_month ) {
		$where .= "(SELECT COUNT(*) FROM kvitancy WHERE id_aparat = $id_aparat AND date_priemka >= '$id_year-0$i-01' AND date_priemka <= '$id_year-0$i-31') AS cnt_$i,";
	} else {
		$where .= "(SELECT COUNT(*) FROM kvitancy WHERE id_aparat = $id_aparat AND date_priemka >= '$id_year-0$i-01' AND date_priemka <= '$id_year-0$i-31') AS cnt_$i";
	}
}



$ask = 'SELECT COUNT(*) AS cnt, ' . $where . ' FROM kvitancy';
//echo $ask ;die;

$arrs[$id_aparat] = (mysql_fetch_array(mysql_query($ask), MYSQL_NUM));

array_shift ($arrs[$id_aparat]);


}
// end PG

//var_dump($arrs);
//die;







 /*
     Example23 : Playing with background bis
 */

 // Standard inclusions   
 include("pChart/pData.class");
 include("pChart/pChart.class");

 // Dataset definition 
 $DataSet = new pData;
 

  
 //$DataSet->AddPoint($q1,"Serie1");  
 //$DataSet->AddPoint($q2,"Serie2");
 //$DataSet->AddPoint($q3,"Serie4");
 
 foreach ($arrs as $id_aparat=>$val) {
	if($val[0]>10 OR $val[1]>10 OR $val[2]>10) {
		$DataSet->AddPoint($val, $id_aparat);  
		
		foreach ($sql as $key=>$val) {
		
			$aparat_name = $val["aparat_name"];
			$pieces = explode(" ", $aparat_name);
			$aparat_name = $pieces[0];
			if ($id_aparat == $val["id_aparat"]) {
				$DataSet->SetSerieName($aparat_name,$id_aparat);
					break;
				}
		
			}
	}	
 }
 
 $DataSet->AddPoint($arr_month,"Serie1");
 
 $DataSet->AddAllSeries();
 $DataSet->RemoveSerie("Serie1");
 $DataSet->SetAbsciseLabelSerie("Serie1");
 //$DataSet->SetSerieName("Кол-во принятых аппаратов в текущем месяце","Serie1");
 
 
 // Initialise the graph  
  $Test = new pChart(1360,768); 
 $Test->drawGraphAreaGradient(132,153,172,50,TARGET_BACKGROUND);  
 $Test->setFontProperties("Fonts/tahoma.ttf",8);  
 $Test->setGraphArea(60,20,1300,700);  
 $Test->drawGraphArea(0,0,0,FALSE);  
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,113,217,221,TRUE,0,2);  
 $Test->drawGraphAreaGradient(230,230,230,20);  
 $Test->drawGrid(4,TRUE,230,230,230,20);  
  
 // Draw the line chart  
 $Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());  
 $Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),2);  
 
	$Test->writeValues($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie2"); 
 $Test->writeValues($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie1");
 $Test->writeValues($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie4");
 
 
  
 // Draw the legend  
 $Test->setFontProperties("Fonts/tahoma.ttf",8);  
 $Test->drawLegend(605,142,$DataSet->GetDataDescription(),236,238,240,52,58,82);  
  
 // Draw the title  
 //$Title = "Число приемок по каждому сервису ежемесячно";  
 $Test->drawTextBox(0,210,700,230,$Title,0,255,255,255,ALIGN_LEFT,TRUE,0,0,0,30);  
  
 // Render the picture  
 $Test->AddBorder(2);  
 $Test->Stroke("example21.png");
 
 
 function Select($query) {
							$result = mysql_query($query);
							
							if (!$result)
								die(mysql_error());
							if(($num_rows =  mysql_num_rows($result)) > 0) {
							$n = mysql_num_rows($result);
							$arr = array();
						
							for($i = 0; $i < $n; $i++)
							{
								$row = mysql_fetch_assoc($result);		
								$arr[] = $row;
							}

							return $arr;				
						} 
						}
?>