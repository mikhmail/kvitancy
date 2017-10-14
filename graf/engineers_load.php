<?php


//error_reporting(E_ERROR | E_WARNING | E_PARSE);
//error_reporting(E_ALL);


/*
// Подключение к БД.
$db1 = mysql_connect('localhost', 'techn157_glafira', 'glafira', 'techn157_glafira');
					mysql_select_db('techn157_glafira', $db1);
					mysql_query("SET NAMES 'utf8'", $db1);
					

// Подключение к БД.
$db1 = mysql_connect('localhost', 'root', '', 'glafira');
					mysql_select_db('glafira', $db1);
					mysql_query("SET NAMES 'utf8'", $db1);
*/
$info = parse_ini_file('../config.ini', true);
		// Подключение к БД.
		$db = mysql_connect($info['main']['localhost'], $info['main']['user'], $info['main']['password']) or die('No connect with data base'); 
		
		mysql_select_db($info['main']['database'], $db) or die(mysql_error());
		
		mysql_query("SET NAMES UTF8");
		mysql_query("SET CHARACTER SET UTF8");		
					

$first_day = date('Y') . '-'. date('m') . '-1';
					
					
$a1 = (mysql_fetch_array(mysql_query("SELECT COUNT(`id_kvitancy`)FROM `kvitancy` WHERE id_responsible=1124 AND date_priemka between '".$first_day."' and '".date("Y-m-d")."'"), MYSQL_NUM));
$a2 = (mysql_fetch_array(mysql_query("SELECT COUNT(`id_kvitancy`)FROM `kvitancy` WHERE id_responsible=1062 AND date_priemka between '".$first_day."' and '".date("Y-m-d")."'"), MYSQL_NUM));
$a3 = (mysql_fetch_array(mysql_query("SELECT COUNT(`id_kvitancy`)FROM `kvitancy` WHERE id_responsible=3536 AND date_priemka between '".$first_day."' and '".date("Y-m-d")."'"), MYSQL_NUM));
$a4 = (mysql_fetch_array(mysql_query("SELECT COUNT(`id_kvitancy`)FROM `kvitancy` WHERE id_responsible=8869 AND date_priemka between '".$first_day."' and '".date("Y-m-d")."'"), MYSQL_NUM));
$a5 = (mysql_fetch_array(mysql_query("SELECT COUNT(`id_kvitancy`)FROM `kvitancy` WHERE id_responsible=9737 AND date_priemka between '".$first_day."' and '".date("Y-m-d")."'"), MYSQL_NUM));



//echo $a1[0];die;

$data_array = array($a1[0], $a2[0], $a3[0], $a4[0], $a5[0]);


$where_uznal = array (
"Техно-Андрей " . $a1[0],
"Техно-Вова ". $a2[0],
"Техно-Олег ". $a3[0],
"Техно-Костя ". $a4[0],
"Кофе-Саша ". $a5[0]);				
					

 // Standard inclusions     
 include("pChart/pData.class");  
 include("pChart/pChart.class");  
  
 // Dataset definition   
 $DataSet = new pData;  
 $DataSet->AddPoint($data_array,"Serie1");
 
 $DataSet->AddPoint($where_uznal,"Serie2");  
 $DataSet->AddAllSeries();  
 $DataSet->SetAbsciseLabelSerie("Serie2");  
  
 // Initialise the graph  
 $Test = new pChart(700,230); 
 $Test->drawFilledRoundedRectangle(7,7,373,193,5,240,240,240);  
 $Test->drawRoundedRectangle(5,5,375,195,5,230,230,230);  
  
 // Draw the pie chart  
 $Test->setFontProperties("Fonts/tahoma.ttf",10);  
 $Test->drawPieGraph($DataSet->GetData(),$DataSet->GetDataDescription(),150,90,110,PIE_PERCENTAGE,TRUE,50,20,5);  
 $Test->drawPieLegend(380,25,$DataSet->GetData(),$DataSet->GetDataDescription(),250,250,250);  
	
	// Draw the title  
 $Title = "Загрузка инженеров в текущем месяце";  
 $Test->drawTextBox(0,210,700,230,$Title,0,255,255,255,ALIGN_LEFT,TRUE,0,0,0,30);  
  
 
 $Test->Stroke("example10.png");  
?>  