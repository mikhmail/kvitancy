<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


// The following values will probably need to be changed.
$db['default']['username'] = "root";
$db['default']['password'] = "";
$db['default']['database'] = "kvitancy";



// The following values can probably stay the same.
$db['default']['hostname'] = "localhost";
$db['default']['dbdriver'] = "mysqli"; //Updated to latest driver.
$db['default']['dbprefix'] = "";
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = "";
$db['default']['char_set'] = "utf8";
$db['default']['dbcollat'] = "utf8_general_ci";

$active_group = "default";
$active_record = TRUE;

/* End of file database.php */
/* Location: ./application/config/database.php */