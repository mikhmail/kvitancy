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
// Подключение к БД.

$all = array();
$aparats_all = array();
$hits_all = array();
 
 $last_day = date("Y-m-d");
 $first_day = date('Y') . '-'.date('m') . '-01';
 
		
$sql = select("Select id_aparat, aparat_name from aparaty");		

//var_dump($sql);die;		


foreach ($sql as $key=>$val) {
	$id_aparat = $val["id_aparat"];
	$aparat_name = $val["aparat_name"];
		$pieces = explode(" ", $aparat_name);
	$aparat_name = $pieces[0];
	
		$sql = select("Select COUNT(*) AS cnt from kvitancy WHERE id_aparat = $id_aparat AND date_priemka >= '$first_day' AND date_priemka <= '$last_day'");
			if ($sql[0]["cnt"] > 1) {
					$all[ $aparat_name ] = (int)($sql[0]["cnt"]);
			}
//var_dump($sql[0]["cnt"]);continue;		
}		

arsort($all);
//var_dump($all);die;

foreach ($all as $key=>$val) {
	$aparats_all[] = $key;
	$hits_all[] = $val;
}

//var_dump($aparats);die;



$all_r = array();
$aparats_r = array();
$hits_r = array();
 
 $last_day = date("Y-m-d");
 $first_day = date('Y') . '-'.date('m') . '-01';
 
		
$sql = select("Select id_aparat, aparat_name from aparaty");		

//var_dump($sql);die;		


foreach ($sql as $key=>$val) {
	$id_aparat = $val["id_aparat"];
	$aparat_name = $val["aparat_name"];
		$pieces = explode(" ", $aparat_name);
	$aparat_name = $pieces[0];
	
	$w = "Select COUNT(*) AS cnt from kvitancy WHERE id_aparat = $id_aparat AND id_sost IN (6, 7, 17) AND date_priemka >= '$first_day' AND date_priemka <= '$last_day'";
	//echo $w;die;
		$sql = select($w);
			if ($sql[0]["cnt"] > 1) {
					$all_r[ $aparat_name ] = (int)($sql[0]["cnt"]);
			}
//var_dump($sql[0]["cnt"]);continue;		
}		

arsort($all_r);
//var_dump($all_r);die;

foreach ($all_r as $key=>$val) {
	$aparats_r[] = $key;
	$hits_r[] = $val;
}

//var_dump($aparats);die;




 /*
     Example23 : Playing with background bis
 */

 // Standard inclusions   
 include("pChart/pData.class");
 include("pChart/pChart.class");

 // Dataset definition 
 $DataSet = new pData;
 
 $DataSet->AddPoint($hits_all,"Serie1");
 //$DataSet->AddPoint($hits_r,"Serie2");
 $DataSet->AddPoint($aparats_all,"Serie3");
 
 $DataSet->AddAllSeries();
 $DataSet->RemoveSerie("Serie3");
 $DataSet->SetAbsciseLabelSerie("Serie3");
 $DataSet->SetSerieName("Кол-во принятых аппаратов в текущем месяце","Serie1");
 
 
 // Initialise the graph
 $Test = new pChart(1360,450);
 $Test->drawGraphAreaGradient(7, 45, 0, 1,TARGET_BACKGROUND);

 $Test->setFontProperties("Fonts/tahoma.ttf",7);
 $Test->setGraphArea(40,20,1350,390);
 $Test->drawGraphArea(213,217,221,FALSE);
 $Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_ADDALL,213,217,221,TRUE,0,2,TRUE);
 
 $Test->drawGraphAreaGradient(7, 45, 0, 1);
 $Test->drawGrid(4,TRUE,130,130,130,20);
 
 //$serieSettings = array("R"=>229,"G"=>11,"B"=>11,"Alpha"=>80);
// $Test->setPalette("Serie1",$serieSettings);

 // Draw the bar chart
 $Test->drawStackedBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(),70);
 
 //рисуем числа над графиками
 $Test->writeValues($DataSet->GetData(),$DataSet->GetDataDescription(),"Serie1");  
 
 // Draw the title
 //$Title = "  Количество аппаратов в текущем месяце  ";
 //$Test->drawTextBox(0,0,50,230,$Title,90,255,255,255,ALIGN_BOTTOM_CENTER,TRUE,0,0,0,30);

 // Draw the legend
 $Test->setFontProperties("Fonts/tahoma.ttf",8);
 $Test->drawLegend(610,10,$DataSet->GetDataDescription(),236,238,240,52,58,82);

 // Render the picture
 $Test->addBorder(2);
 $Test->Stroke("example23.png");
 
 
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