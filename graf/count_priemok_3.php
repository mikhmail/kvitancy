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


$where3 ="

SELECT COUNT(*) AS cnt,

(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2012-01-01' and '2012-01-31'	) AS cnt_1,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2012-02-01' and '2012-02-31'	) AS cnt_2,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2012-03-01' and '2012-03-31'	) AS cnt_3,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2012-04-01' and '2012-04-31'	) AS cnt_4,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2012-05-01' and '2012-05-31'	) AS cnt_5,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2012-06-01' and '2012-06-31'	) AS cnt_6,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2012-07-01' and '2012-07-31'	) AS cnt_7,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2012-08-01' and '2012-08-31'	) AS cnt_8,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2012-09-01' and '2012-09-31'	) AS cnt_9,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2012-10-01' and '2012-10-31'	) AS cnt_10,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2012-11-01' and '2012-11-31'	) AS cnt_11,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2012-12-01' and '2012-12-31'	) AS cnt_12,


(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2013-01-01' and '2013-01-31'	) AS cnt_13,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2013-02-01' and '2013-02-31'	) AS cnt_14,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2013-03-01' and '2013-03-31'	) AS cnt_15,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2013-04-01' and '2013-04-31'	) AS cnt_16,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2013-05-01' and '2013-05-31'	) AS cnt_17,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2013-06-01' and '2013-06-31'	) AS cnt_18,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2013-07-01' and '2013-07-31'	) AS cnt_19,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2013-08-01' and '2013-08-31'	) AS cnt_20,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2013-09-01' and '2013-09-31'	) AS cnt_21,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2013-10-01' and '2013-10-31'	) AS cnt_22,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2013-11-01' and '2013-11-31'	) AS cnt_23,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2013-12-01' and '2013-12-31'	) AS cnt_24,


(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2014-01-01' and '2014-01-31'	) AS cnt_25,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2014-02-01' and '2014-02-31'	) AS cnt_26,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2014-03-01' and '2014-03-31'	) AS cnt_27,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2014-04-01' and '2014-04-31'	) AS cnt_28,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2014-05-01' and '2014-05-31'	) AS cnt_29,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2014-06-01' and '2014-06-31'	) AS cnt_30,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2014-07-01' and '2014-07-31'	) AS cnt_31,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2014-08-01' and '2014-08-31'	) AS cnt_32,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2014-09-01' and '2014-09-31'	) AS cnt_33,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2014-10-01' and '2014-10-31'	) AS cnt_34,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2014-11-01' and '2014-11-31'	) AS cnt_35,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2014-12-01' and '2014-12-31'	) AS cnt_36,

(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2015-01-01' and '2015-01-31'	) AS cnt_37,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2015-02-01' and '2015-02-31'	) AS cnt_38,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2015-03-01' and '2015-03-31'	) AS cnt_39,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2015-04-01' and '2015-04-31'	) AS cnt_40,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2015-05-01' and '2015-05-31'	) AS cnt_41,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2015-06-01' and '2015-06-31'	) AS cnt_42,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2015-07-01' and '2015-07-31'	) AS cnt_43,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2015-08-01' and '2015-08-31'	) AS cnt_44,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2015-09-01' and '2015-09-31'	) AS cnt_45,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2015-10-01' and '2015-10-31'	) AS cnt_46,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2015-11-01' and '2015-11-31'	) AS cnt_47,
(SELECT COUNT(*) FROM kvitancy WHERE date_priemka between '2015-12-01' and '2015-12-31'	) AS cnt_48



FROM kvitancy";

$q3 = (mysql_fetch_array(mysql_query($where3), MYSQL_NUM));
array_shift($q3);


$arr_month = array ();
for ($i=1; $i<=48; $i++) {
	
    $arr_month[] = $i;
		
}

 // Standard inclusions        
 include("pChart/pData.class");     
 include("pChart/pChart.class");     

// Dataset definition   
 $DataSet = new pData;  

 $DataSet->AddPoint($q3,"Serie4");
 
 $DataSet->AddPoint($arr_month,"Serie3");
 
 $DataSet->AddAllSeries();  
 $DataSet->RemoveSerie("Serie3");  
 $DataSet->SetAbsciseLabelSerie("Serie3");  


 $DataSet->SetSerieName("all","Serie4");  
 
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
 $Test->drawGraphAreaGradient(130,130,130,50);  
 $Test->drawGrid(1,TRUE,140,140,140,0);  
  
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
 $Title = "Число сервису ежемесячно";  
 $Test->drawTextBox(0,210,700,230,$Title,0,255,255,255,ALIGN_LEFT,TRUE,0,0,0,30);  
  
 // Render the picture  
 $Test->AddBorder(2);  
 $Test->Stroke("example21.png");
	//$Test->Stroke("example21.png");
//$Test->autoOutput("example15.png");
?>