<?php

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
// Подключение к БД.




$id_year = date("Y"); // 2015
$id_month = date("n"); // int 5
$month = date("m"); // int 5

//$s = strtotime('-2 month');
//$first_day = date("Y-m-d", $s);


$months = array("1"=>"Январь","2"=>"Февраль","3"=>"Март","4"=>"Апрель","5"=>"Май", "6"=>"Июнь", "7"=>"Июль","8"=>"Август","9"=>"Сентябрь","10"=>"Октябрь","11"=>"Ноябрь","12"=>"Декабрь");

$arr_month = array ();
foreach ($months as $key=>$value) {
	
    $arr_month[] = $value;
		if ($key-1 == $id_month) break;
}
//print_r($arr_month);die;



$where1 = "";
//$arr_month = array ();

for ($i=1; $i<=$id_month; $i++) {

	if($i != $id_month ) {
		$where1 .= "(SELECT COUNT(*) FROM kvitancy WHERE $and_aparat date_priemka between '$id_year-0$i-01' and '$id_year-0$i-31' $and_proizvod) AS cnt_$i,";
	} else {
		$where1 .= "(SELECT COUNT(*) FROM kvitancy WHERE $and_aparat date_priemka between '$id_year-0$i-01' and '$id_year-0$i-31' $and_proizvod) AS cnt_$i";
	}
}

//echo $where1;die;
//print_r($arr_month);die;

$q1 = (mysql_fetch_array(mysql_query("
					SELECT COUNT(*) AS cnt,
$where1
					FROM kvitancy
									"), MYSQL_NUM));
array_shift($q1);


// end priemki
									

//start zp
$where2 = "";
//$arr_month = array ();

for ($i=1; $i<=$id_month; $i++) {

	if($i != $id_month ) {
		$where2 .= "(SELECT SUM(ABS(plus)) FROM cash WHERE name LIKE '%миша зп%' AND update_date between '$id_year-0$i-01' and '$id_year-0$i-31') AS cnt_$i,";
	} else {
		$where2 .= "(SELECT SUM(ABS(plus)) FROM cash WHERE name LIKE '%миша зп%' AND update_date between '$id_year-0$i-01' and '$id_year-0$i-31') AS cnt_$i";
	}
}

//echo $where2;die;
//print_r($arr_month);die;


$q2 = (mysql_fetch_array(mysql_query("
					SELECT SUM(ABS(plus)) AS cnt,
$where2
					FROM cash
									"), MYSQL_NUM));
//var_dump($q2);die;
array_shift($q2);
//var_dump($q2);die;

function cube($n)
{
    return($n / 1000);
}

$q2 = array_map("cube", $q2);

// end zp




 /*
     Example12 : A true bar graph
 */

 // Standard inclusions   
 include("pChart/pData.class");
 include("pChart/pChart.class");

 // Dataset definition 
 $DataSet = new pData;
 $DataSet->AddPoint($q1,"Serie1");
 $DataSet->AddPoint($q2,"Serie2");
 $DataSet->AddPoint($arr_month,"Serie3");
 
 $DataSet->AddAllSeries();
 $DataSet->RemoveSerie("Serie3");
 $DataSet->SetAbsciseLabelSerie("Serie3");

 $DataSet->SetSerieName("Все аппараты","Serie1");
 $DataSet->SetSerieName("С ремонтом","Serie2");
 
 // Initialise the graph
 $Test = new pChart(1360,450);
 $Test->drawGraphAreaGradient(7, 45, 0, 1,TARGET_BACKGROUND);

 $Test->setFontProperties("Fonts/tahoma.ttf",7);
 $Test->setGraphArea(40,20,1350,400);
 $Test->drawGraphArea(213,217,221,FALSE);
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_ADDALL,553,217,221,TRUE,0,20,TRUE);
 
 $Test->drawGraphAreaGradient(7, 45, 0, 1);
 $Test->drawGrid(4,TRUE,130,130,130,20);

 // Draw the 0 line
 $Test->setFontProperties("Fonts/tahoma.ttf",8);
 $Test->drawTreshold(0,143,55,72,TRUE,TRUE);

 // Draw the bar graph
 $Test->drawBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE,80);

 $Test->writeValues($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie1"); 
 $Test->writeValues($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie2"); 
 $Test->writeValues($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie3"); 

 // Finish the graph
 $Test->setFontProperties("Fonts/tahoma.ttf",8);
 //$Test->drawLegend(596,150,$DataSet->GetDataDescription(),255,255,255);
 $Test->drawLegend(610,10,$DataSet->GetDataDescription(),255,255,255);
 $Test->setFontProperties("Fonts/tahoma.ttf",10);
 //$Test->drawTitle(50,22,"Example 12",50,50,50,585);
 $Test->Stroke("example12.png");
?>