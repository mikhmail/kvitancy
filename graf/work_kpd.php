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

$s = strtotime('-2 month');

$first_day = date("Y-m-d", $s);


// start TD
$where1 = "(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '$id_year-0$i-01' and '$id_year-0$i-31') AS cnt_1,";
		
//echo $where1;die;
		
// SELECT count(*) FROM kvitancy WHERE date_priemka between '2015-01-01' and '2015-01-31'

/*
SELECT COUNT(*) AS cnt,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2015-02-01' and '2015-02-31'	) AS cnt_1,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2015-03-01' and '2015-03-31'	) AS cnt_2,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2015-04-01' and '2015-04-31'	) AS cnt_3
FROM kvitancy
*/			

$where1 = "";
for ($i=1; $i<=$id_month; $i++) {
	
	if($i != $id_month ) {
		$where1 .= "(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '$id_year-0$i-01' and '$id_year-0$i-31' AND id_mechanic = 2) AS cnt_$i,";
	} else {
		$where1 .= "(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '$id_year-0$i-01' and '$id_year-0$i-31' AND id_mechanic = 2) AS cnt_$i";
	}
}

//echo $where1;die;

$q1 = (mysql_fetch_array(mysql_query("
					SELECT COUNT(*) AS cnt,
$where1
					FROM kvitancy
									"), MYSQL_NUM));
array_shift($q1);
// end TD									


// start NB
$where2 = "(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '$id_year-0$i-01' and '$id_year-0$i-31') AS cnt_1,";
		
//echo $where1;die;
		
// SELECT count(*) FROM kvitancy WHERE date_priemka between '2015-01-01' and '2015-01-31'

/*
SELECT COUNT(*) AS cnt,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2015-02-01' and '2015-02-31'	) AS cnt_1,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2015-03-01' and '2015-03-31'	) AS cnt_2,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2015-04-01' and '2015-04-31'	) AS cnt_3
FROM kvitancy
*/			

$where2 = "";
for ($i=1; $i<=$id_month; $i++) {
	
	if($i != $id_month ) {
		$where2 .= "(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '$id_year-0$i-01' and '$id_year-0$i-31' AND id_mechanic = 14) AS cnt_$i,";
	} else {
		$where2 .= "(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '$id_year-0$i-01' and '$id_year-0$i-31' AND id_mechanic = 14) AS cnt_$i";
	}
}

//echo $where1;die;

$q2 = (mysql_fetch_array(mysql_query("
					SELECT COUNT(*) AS cnt,
$where2
					FROM kvitancy
									"), MYSQL_NUM));
array_shift($q2);
// end NB				

//var_dump($q1);
//var_dump($q2);
//die;

$arr1 = array();
	foreach ($q1 as $v) {
		$arr1[] = $v;
}

$arr2 = array();
	foreach ($q2 as $v) {
		$arr2[] = $v;
}

//$a = array(1,4,2,6,2,3,0,1,5,1,2,4,5,2,1,0,6,4,2);
//print_r($a);
//print_r($arr1);
//print_r($q1);die;


 // Standard inclusions     
 include("pChart/pData.class");  
 include("pChart/pChart.class");  
  
 // Dataset definition   
 $DataSet = new pData;  
 $DataSet->AddPoint($q1,"Serie1");  
 $DataSet->AddPoint($q2,"Serie2");  
 $DataSet->AddAllSeries();  
 $DataSet->SetAbsciseLabelSerie();  
 $DataSet->SetSerieName("TechnoDoctor","Serie1");  
 $DataSet->SetSerieName("NBService","Serie2");  
  
 // Initialise the graph  
 $Test = new pChart(700,230);  
 $Test->setFixedScale(0,500);  
 $Test->setFontProperties("Fonts/tahoma.ttf",8);  
 $Test->setGraphArea(50,30,585,200);  
 $Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);  
 $Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);  
 $Test->drawGraphArea(255,255,255,TRUE);  
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2);     
 $Test->drawGrid(4,TRUE,230,230,230,50);  
  
 // Draw the 0 line  
 $Test->setFontProperties("Fonts/tahoma.ttf",6);  
 $Test->drawTreshold(0,143,55,72,TRUE,TRUE);  
  
 // Draw the cubic curve graph  
 $Test->drawCubicCurve($DataSet->GetData(),$DataSet->GetDataDescription());  
  
 // Finish the graph  
 $Test->setFontProperties("Fonts/tahoma.ttf",8);  
 $Test->drawLegend(600,30,$DataSet->GetDataDescription(),255,255,255);  
 $Test->setFontProperties("Fonts/tahoma.ttf",10);  
 $Test->drawTitle(50,22,"Приемки за ".date("Y"),50,50,50,585);  
 $Test->Stroke("example2.png");  
?>  