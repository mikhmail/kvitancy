<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require FCPATH.'/config.php';

// The following values will probably need to be changed.
$db['default']['username'] = $username;
$db['default']['password'] = $password;
$db['default']['database'] = $database;
$db['default']['hostname'] = $hostname;


// The following values can probably stay the same.

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