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


$where1 ="

SELECT COUNT(*) AS cnt,

(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2011-09-01' and '2011-09-31'	) AS cnt_1as,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2011-10-01' and '2011-10-31'	) AS cnt_1asa2,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2011-11-01' and '2011-11-31'	) AS cnt_14ed,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2011-12-01' and '2011-12-31'	) AS cnt_13e2q,

(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2012-01-01' and '2012-01-31'	) AS cnt_1,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2012-02-01' and '2012-02-31'	) AS cnt_2,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2012-03-01' and '2012-03-31'	) AS cnt_3,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2012-04-01' and '2012-04-31'	) AS cnt_4,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2012-05-01' and '2012-05-31'	) AS cnt_5,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2012-06-01' and '2012-06-31'	) AS cnt_6,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2012-07-01' and '2012-07-31'	) AS cnt_7,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2012-08-01' and '2012-08-31'	) AS cnt_8,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2012-09-01' and '2012-09-31'	) AS cnt_9,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2012-10-01' and '2012-10-31'	) AS cnt_10,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2012-11-01' and '2012-11-31'	) AS cnt_11,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2012-12-01' and '2012-12-31'	) AS cnt_12,


(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2013-01-01' and '2013-01-31'	) AS cnt_13,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2013-02-01' and '2013-02-31'	) AS cnt_14,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2013-03-01' and '2013-03-31'	) AS cnt_15,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2013-04-01' and '2013-04-31'	) AS cnt_16,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2013-05-01' and '2013-05-31'	) AS cnt_17,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2013-06-01' and '2013-06-31'	) AS cnt_18,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2013-07-01' and '2013-07-31'	) AS cnt_19,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2013-08-01' and '2013-08-31'	) AS cnt_20,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2013-09-01' and '2013-09-31'	) AS cnt_21,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2013-10-01' and '2013-10-31'	) AS cnt_22,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2013-11-01' and '2013-11-31'	) AS cnt_23,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2013-12-01' and '2013-12-31'	) AS cnt_24,


(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2014-01-01' and '2014-01-31'	) AS cnt_25,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2014-02-01' and '2014-02-31'	) AS cnt_26,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2014-03-01' and '2014-03-31'	) AS cnt_27,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2014-04-01' and '2014-04-31'	) AS cnt_28,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2014-05-01' and '2014-05-31'	) AS cnt_29,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2014-06-01' and '2014-06-31'	) AS cnt_30,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2014-07-01' and '2014-07-31'	) AS cnt_31,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2014-08-01' and '2014-08-31'	) AS cnt_32,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2014-09-01' and '2014-09-31'	) AS cnt_33,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2014-10-01' and '2014-10-31'	) AS cnt_34,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2014-11-01' and '2014-11-31'	) AS cnt_35,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2014-12-01' and '2014-12-31'	) AS cnt_36,

(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2015-01-01' and '2015-01-31'	) AS cnt_37,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2015-02-01' and '2015-02-31'	) AS cnt_38,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2015-03-01' and '2015-03-31'	) AS cnt_39,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2015-04-01' and '2015-04-31'	) AS cnt_40,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2015-05-01' and '2015-05-31'	) AS cnt_41,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2015-06-01' and '2015-06-31'	) AS cnt_42,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2015-07-01' and '2015-07-31'	) AS cnt_43,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2015-08-01' and '2015-08-31'	) AS cnt_44,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2015-09-01' and '2015-09-31'	) AS cnt_45,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2015-10-01' and '2015-10-31'	) AS cnt_46,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2015-11-01' and '2015-11-31'	) AS cnt_47,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2015-12-01' and '2015-12-31'	) AS cnt_48,


(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2016-01-01' and '2016-01-31'	) AS cnt_49,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2016-02-01' and '2016-02-31'	) AS cnt_50,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2016-03-01' and '2016-03-31'	) AS cnt_51,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2016-04-01' and '2016-04-31'	) AS cnt_52,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2016-05-01' and '2016-05-31'	) AS cnt_53,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2016-06-01' and '2016-06-31'	) AS cnt_54,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2016-07-01' and '2016-07-31'	) AS cnt_55,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2016-08-01' and '2016-08-31'	) AS cnt_56,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2016-09-01' and '2016-09-31'	) AS cnt_57,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2016-10-01' and '2016-10-31'	) AS cnt_58,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2016-11-01' and '2016-11-31'	) AS cnt_59,
(SELECT COUNT(*) FROM kvitancy WHERE id_aparat=22 AND date_priemka between '2016-12-01' and '2016-12-31'	) AS cnt_60


FROM kvitancy";

$q1 = (mysql_fetch_array(mysql_query($where1), MYSQL_NUM));
array_shift($q1);


$arr_month = array ();
for ($i=1; $i<=48; $i++) {
	
    $arr_month[] = $i;
		
}


  
 // Standard inclusions     
 include("pChart/pData.class");  
 include("pChart/pChart.class");  
  
 // Dataset definition   
 $DataSet = new pData;  
 //$DataSet->ImportFromCSV("Sample/CO2.csv",",",array(1,2,3,4),TRUE,0);
 $DataSet->AddPoint($q1,"Serie1");
 $DataSet->AddAllSeries();  
 $DataSet->SetAbsciseLabelSerie();  
 $DataSet->SetYAxisName("Число приемок");  
  
  $DataSet->SetSerieName("Всего","Serie1");  
  
 // Initialise the graph  
 $Test = new pChart(700,230);  
 $Test->reportWarnings("GD");  
 $Test->setFontProperties("Fonts/tahoma.ttf",8);  
 $Test->setGraphArea(60,30,680,180);  
 $Test->drawFilledRoundedRectangle(7,7,693,223,5,240,240,240);  
 $Test->drawRoundedRectangle(5,5,695,225,5,230,230,230);  
 $Test->drawGraphArea(255,255,255,TRUE);  
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,90,2);  
 $Test->drawGrid(4,TRUE,230,230,230,50);  
  
 // Draw the 0 line  
 $Test->setFontProperties("Fonts/tahoma.ttf",6);  
 $Test->drawTreshold(0,143,55,72,TRUE,TRUE);  
  
 // Draw the line graph  
 $Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());  
 $Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);  
  
 // Finish the graph  
 $Test->setFontProperties("Fonts/tahoma.ttf",8);     
 $Test->drawLegend(70,40,$DataSet->GetDataDescription(),255,255,255);     
 $Test->setFontProperties("Fonts/tahoma.ttf",10);  
 $Test->drawTitle(60,22,"Планшеты с 2011 до 2015",50,50,50,585);  
 $Test->Stroke("example16.png");     

?>