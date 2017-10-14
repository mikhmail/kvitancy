<?php


//error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(E_ALL);



// Подключение к БД.
$db1 = mysql_connect('localhost', 'techn157_glafira', 'glafira', 'techn157_glafira');
					mysql_select_db('techn157_glafira', $db1);
					mysql_query("SET NAMES 'utf8'", $db1);
					

// Подключение к БД.
/*
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
					
//SELECT COUNT(`whereid`)FROM `kvitancy` WHERE whereid=1


$a1 = (mysql_fetch_array(mysql_query("SELECT COUNT(`whereid`)FROM `kvitancy` WHERE whereid=1"), MYSQL_NUM));
$a2 = (mysql_fetch_array(mysql_query("SELECT COUNT(`whereid`)FROM `kvitancy` WHERE whereid=2"), MYSQL_NUM));
$a3 = (mysql_fetch_array(mysql_query("SELECT COUNT(`whereid`)FROM `kvitancy` WHERE whereid=3"), MYSQL_NUM));
$a4 = (mysql_fetch_array(mysql_query("SELECT COUNT(`whereid`)FROM `kvitancy` WHERE whereid=4"), MYSQL_NUM));
$a5 = (mysql_fetch_array(mysql_query("SELECT COUNT(`whereid`)FROM `kvitancy` WHERE whereid=5"), MYSQL_NUM));
$a6 = (mysql_fetch_array(mysql_query("SELECT COUNT(`whereid`)FROM `kvitancy` WHERE whereid=6"), MYSQL_NUM));
$a7 = (mysql_fetch_array(mysql_query("SELECT COUNT(`whereid`)FROM `kvitancy` WHERE whereid=7"), MYSQL_NUM));
$a8 = (mysql_fetch_array(mysql_query("SELECT COUNT(`whereid`)FROM `kvitancy` WHERE whereid=8"), MYSQL_NUM));
$a9 = (mysql_fetch_array(mysql_query("SELECT COUNT(`whereid`)FROM `kvitancy` WHERE whereid=9"), MYSQL_NUM));
$a10 = (mysql_fetch_array(mysql_query("SELECT COUNT(`whereid`)FROM `kvitancy` WHERE whereid=10"), MYSQL_NUM));



//echo $a1[0];die;

$data_array = array($a1[0], $a2[0], $a3[0], $a4[0], $a5[0], $a6[0], $a7[0], $a8[0], $a9[0], $a9[10]);


$where_uznal = array (
"В поисковике нашел " . $a1[0],
"В каталогах сервисных центоров ". $a2[0],
"По отзывам в интернете ". $a3[0],
"На улице увидел ". $a4[0],
"КАРТЫ: google,yandex ". $a5[0],
"Доски: типа сландо ". $a6[0],
"Знакомые рекомендовали ". $a7[0],
"Затрудняюсь ответить, не помню ". $a8[0],
"Уже был у нас ". $a9[0],
"Расклейка объяв ". $a10[0]


					);				
					

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
 $Title = "Статистика откуда к нам пришли за все время.";  
 $Test->drawTextBox(0,210,700,230,$Title,0,255,255,255,ALIGN_LEFT,TRUE,0,0,0,30);  
  
 $Test->Stroke("example10.png");  
?>  