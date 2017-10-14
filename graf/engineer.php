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

//$s = strtotime('-2 month');
//$first_day = date("Y-m-d", $s);


$months = array("1"=>"Январь","2"=>"Февраль","3"=>"Март","4"=>"Апрель","5"=>"Май", "6"=>"Июнь", "7"=>"Июль","8"=>"Август","9"=>"Сентябрь","10"=>"Октябрь","11"=>"Ноябрь","12"=>"Декабрь");

$arr_month = array ();
foreach ($months as $key=>$value) {
	
    $arr_month[] = $value;
		if ($key == $id_month) break;
}
//print_r($arr_month);die;

/* START GRAPHICs*/

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
//$arr_month = array ();

for ($i=1; $i<=$id_month; $i++) {

//$arr_month[] = '0'.$i;
	
	if($i != $id_month ) {
		$where1 .= "(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '$id_year-0$i-01' and '$id_year-0$i-31' AND id_mechanic = 2) AS cnt_$i,";
	} else {
		$where1 .= "(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '$id_year-0$i-01' and '$id_year-0$i-31' AND id_mechanic = 2) AS cnt_$i";
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
		$where2 .= "(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '$id_year-0$i-01' and '$id_year-0$i-31' AND id_mechanic = 13) AS cnt_$i,";
	} else {
		$where2 .= "(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '$id_year-0$i-01' and '$id_year-0$i-31' AND id_mechanic = 13) AS cnt_$i";
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


// start PG
//$where3 = "(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '$id_year-0$i-01' and '$id_year-0$i-31') AS cnt_1,";
		
//echo $where1;die;
		
// SELECT count(*) FROM kvitancy WHERE date_priemka between '2015-01-01' and '2015-01-31'

/*
SELECT COUNT(*) AS cnt,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2015-02-01' and '2015-02-31'	) AS cnt_1,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2015-03-01' and '2015-03-31'	) AS cnt_2,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2015-04-01' and '2015-04-31'	) AS cnt_3
FROM kvitancy
*/			

$where3 = "";
for ($i=1; $i<=$id_month; $i++) {
	
	if($i != $id_month ) {
		$where3 .= "(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '$id_year-0$i-01' and '$id_year-0$i-31' AND id_mechanic = 14) AS cnt_$i,";
	} else {
		$where3 .= "(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '$id_year-0$i-01' and '$id_year-0$i-31' AND id_mechanic = 14) AS cnt_$i";
	}
}

//echo $where1;die;

$q3 = (mysql_fetch_array(mysql_query("
					SELECT COUNT(*) AS cnt,
$where3
					FROM kvitancy
									"), MYSQL_NUM));
array_shift($q3);
// end PG

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
 $DataSet->AddPoint($q3,"Serie4");
 
 $DataSet->AddPoint($arr_month,"Serie3");
 
 $DataSet->AddAllSeries();  
 $DataSet->RemoveSerie("Serie3");  
 $DataSet->SetAbsciseLabelSerie("Serie3");  
 $DataSet->SetSerieName("Гончара79","Serie1");  
 $DataSet->SetSerieName("Артёма7","Serie2");  
 $DataSet->SetSerieName("Пирогова2","Serie4");  
 
 $DataSet->SetYAxisName("Число приемок");  
  $DataSet->SetXAxisName("Месяц");
 //$DataSet->SetYAxisUnit("°C");  
 //$DataSet->SetXAxisUnit("h");  
  
 // Initialise the graph  
 $Test = new pChart(700,230);  
 $Test->drawGraphAreaGradient(132,153,172,50,TARGET_BACKGROUND);  
 $Test->setFontProperties("Fonts/tahoma.ttf",8);  
 $Test->setGraphArea(60,20,585,180);  
 $Test->drawGraphArea(213,217,221,FALSE);  
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,213,217,221,TRUE,0,2);  
 $Test->drawGraphAreaGradient(162,183,202,50);  
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
 $Title = "Число приемок по каждому сервису ежемесячно";  
 $Test->drawTextBox(0,210,700,230,$Title,0,255,255,255,ALIGN_LEFT,TRUE,0,0,0,30);  
  
 // Render the picture  
 $Test->AddBorder(2);  
 $Test->Stroke("example21.png");
	//$Test->Stroke("example21.png");
//$Test->autoOutput("example15.png");
?>