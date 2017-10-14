<?


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


?>

<form name="MAIN" action="<?=$_SERVER['PHP_SELF']?>" method="GET">

<!--/фильтр аппаратов -->
<select name="id_aparat">
	<option value="">Выбрать аппарат</option>
	<?
	$apparati = select_aparat ();
	foreach ($apparati as $a=>$rowap)
   { 
   ?>
   
	   <option value="<?=$rowap['id_aparat']?>" <?if($rowap['id_aparat'] == $_GET['id_aparat']) {echo 'selected'; $aparat_name = $rowap['aparat_name'];}?>><?=$rowap['aparat_name']?></option>
   <?}
	?>
   </select>
<!--/////////фильтр аппаратов кончился -->

<!--/фильтр производителя -->
<select name="id_proizvod">
	<option value="">Производитель</option>
	<?
	$brand = select_proizvoditel ();
	foreach ($brand as $a=>$rowbr)
   {?>
	   <option value="<?=$rowbr['id_proizvod']?>" <?if($rowbr['id_proizvod'] == $_GET['id_proizvod']) {echo 'selected'; $name_proizvod = $rowbr['name_proizvod'];}?>><?=$rowbr['name_proizvod']?></option>
   <?}
	?>
   </select>
<!--/////////фильтр производителя кончился -->




<input id="signIn" name="signIn" class="rc-button rc-button-submit" type="submit" value="Показать">

</form>



<?
if (!empty($_GET["id_aparat"]) OR !empty($_GET["id_proizvod"])) {?>

<img src="http://technodoctor.com.ua/stat/graf/count_apparat_all_by_day.php?id_aparat=<?=$_GET["id_aparat"]?>&aparat_name=<?=$aparat_name?>&id_proizvod=<?=$_GET["id_proizvod"]?>&name_proizvod=<?=$name_proizvod?>"><hr>

<?}
?>










<?


// выбрать производителя.
function select_proizvoditel () {
$sql = Select("SELECT id_proizvod, name_proizvod FROM proizvoditel ORDER BY name_proizvod ");
return $sql;
}

// выбрать аппараты.
function select_aparat () {
$sql = Select("SELECT id_aparat, aparat_name FROM aparaty ORDER BY aparat_name ");
return $sql;
}

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