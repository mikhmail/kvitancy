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
					

$id_year = date("Y"); // 2015
$id_month = date("n"); // int 5
$month = date("m"); // int 5

$today = date("d");

//$s = strtotime('-2 month');
//$first_day = date("Y-m-d", $s);


$months = array('01','02','03','04','05','06','07','08','09',10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31);

$arr_month = array ();
foreach ($months as $key=>$value) {
	
    $arr_month[] = $value;
		if ($value == $today) break;
}
//print_r($arr_month);die;

/* START GRAPHICs*/

// start TD
//$where1 = "(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '$id_year-0$i-01' and '$id_year-0$i-31') AS cnt_1,";
		
//echo $where1;die;
		
// SELECT count(*) FROM kvitancy WHERE date_priemka between '2015-01-01' and '2015-01-31'

/*
SELECT COUNT(*) AS cnt,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2015-02-01' and '2015-02-31'	) AS cnt_1,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2015-03-01' and '2015-03-31'	) AS cnt_2,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2015-04-01' and '2015-04-31'	) AS cnt_3
FROM kvitancy
*/			

if (!empty($_GET["id_aparat"])) {
$id_aparat = $_GET["id_aparat"];
$aparat_name = $_GET["aparat_name"];
$and_aparat = 'id_aparat = '. $id_aparat . ' AND ';
}else $and_aparat = '';

if (!empty($_GET["id_proizvod"])) {
$id_proizvod = $_GET["id_proizvod"];
$name_proizvod = $_GET["name_proizvod"];
$and_proizvod = ' AND ' . 'id_proizvod = '. $id_proizvod;
}else $and_proizvod = '';


$where1 = "";
//$arr_month = array ();

for ($i=1; $i<=$today; $i++) {

if($i<10) {
	$no=0;
}else {
	unset($no);
}

	if($i != $today ) {
		$where1 .= "(SELECT COUNT(*) FROM kvitancy WHERE $and_aparat date_priemka = '$id_year-$id_month-$no$i' $and_proizvod) AS cnt_$i, ";
	} else {
		$where1 .= "(SELECT COUNT(*) FROM kvitancy WHERE $and_aparat date_priemka = '$id_year-$id_month-$no$i' $and_proizvod) AS cnt_$i";
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

// end TD									

//print_r($q1);die;

 // Standard inclusions        
 include("pChart/pData.class");     
 include("pChart/pChart.class");     

// Dataset definition   
 $DataSet = new pData;  
 $DataSet->AddPoint($q1,"Serie1");  

 
 $DataSet->AddPoint($arr_month,"Serie3");
 
 $DataSet->AddAllSeries();  
 $DataSet->RemoveSerie("Serie3");  
 $DataSet->SetAbsciseLabelSerie("Serie3");  
 $DataSet->SetSerieName("Все","Serie1");  

 
 
 $DataSet->SetYAxisName("Число приемок");  
  $DataSet->SetXAxisName("День");
 //$DataSet->SetYAxisUnit("°C");  
 //$DataSet->SetXAxisUnit("h");  
 

 
 
 
 // Initialise the graph  
 $Test = new pChart(700,230);  
 $Test->drawGraphAreaGradient(132,153,172,50,TARGET_BACKGROUND);  
 $Test->setFontProperties("Fonts/tahoma.ttf",8);  
 $Test->setGraphArea(60,20,585,180);  
 $Test->drawGraphArea(130,130,130,FALSE);  
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,213,217,221,TRUE,0,2);  
 $Test->drawGraphAreaGradient(130,130,130,50);  
 $Test->drawGrid(1,TRUE,140,140,140,0);  
  
 
 // Draw the line chart  
 $Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());  
 $Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),2);  
 

 $Test->writeValues($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie1");


 
  
 // Draw the legend  
 $Test->setFontProperties("Fonts/tahoma.ttf",8);  
 $Test->drawLegend(605,142,$DataSet->GetDataDescription(),236,238,240,52,58,82);  
  
 // Draw the title  
 $Title = "Общее число принятых приемок $aparat_name $name_proizvod по всем сервисам ежеДНЕВНО";  
 $Test->drawTextBox(0,210,700,230,$Title,0,255,255,255,ALIGN_LEFT,TRUE,0,0,0,30);  
  
 // Render the picture  
 $Test->AddBorder(2);  
 $Test->Stroke("example1.png");
	//$Test->Stroke("example21.png");
//$Test->autoOutput("example15.png");
?>