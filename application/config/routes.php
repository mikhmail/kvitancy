<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['default_controller'] = 'login/index';
$route['404_override'] = '';

/*user*/
$route['login/validate_credentials'] = 'login/validate_credentials';


/*admin*/
$route['admin'] = 'admin/index';
//$route['admin/signup'] = 'admin/signup';
//$route['admin/create_member'] = 'admin/create_member';
$route['admin/login'] = 'admin/index';
$route['admin/logout'] = 'admin/logout';
$route['admin/cache_delete'] = 'admin/cache_delete';

$route['admin/login/validate_credentials'] = 'admin/validate_credentials';

$route['admin/users'] = 'admin_users/index';
$route['admin/users/add'] = 'admin_users/add';
$route['admin/users/update'] = 'admin_users/update';
$route['admin/users/update/(:any)'] = 'admin_users/update/$1';
$route['admin/users/delete/(:any)'] = 'admin_users/delete/$1';
$route['admin/users/(:any)'] = 'admin_users/index/$1'; //$1 = page number

$route['admin/groups_dostupa'] = 'admin_groups_dostupa/index';
$route['admin/groups_dostupa/add'] = 'admin_groups_dostupa/add';
$route['admin/groups_dostupa/update'] = 'admin_groups_dostupa/update';
$route['admin/groups_dostupa/update/(:any)'] = 'admin_groups_dostupa/update/$1';
$route['admin/groups_dostupa/delete/(:any)'] = 'admin_groups_dostupa/delete/$1';
$route['admin/groups_dostupa/(:any)'] = 'admin_groups_dostupa/index/$1'; //$1 = page number

$route['admin/proizvoditel'] = 'admin_proizvoditel/index';
$route['admin/proizvoditel/add'] = 'admin_proizvoditel/add';
$route['admin/proizvoditel/update'] = 'admin_proizvoditel/update';
$route['admin/proizvoditel/update/(:any)'] = 'admin_proizvoditel/update/$1';
$route['admin/proizvoditel/delete/(:any)'] = 'admin_proizvoditel/delete/$1';
$route['admin/proizvoditel/(:any)'] = 'admin_proizvoditel/index/$1'; //$1 = page number

$route['admin/aparaty'] = 'admin_aparaty/index';
$route['admin/aparaty/add'] = 'admin_aparaty/add';
$route['admin/aparaty/update'] = 'admin_aparaty/update';
$route['admin/aparaty/update/(:any)'] = 'admin_aparaty/update/$1';
$route['admin/aparaty/delete/(:any)'] = 'admin_aparaty/delete/$1';
$route['admin/aparaty/(:any)'] = 'admin_aparaty/index/$1'; //$1 = page number

$route['admin/kvitancy'] = 'admin_kvitancy/index';
$route['admin/kvitancy/add'] = 'admin_kvitancy/add';
$route['admin/kvitancy/update'] = 'admin_kvitancy/update';
$route['admin/kvitancy/update/(:any)'] = 'admin_kvitancy/update/$1';
$route['admin/kvitancy/delete/(:any)'] = 'admin_kvitancy/delete/$1';
$route['admin/kvitancy/(:any)'] = 'admin_kvitancy/index/$1'; //$1 = page number


$route['kvitancy'] = 'kvitancy/index';
$route['kvitancy/add'] = 'kvitancy/add';
$route['kvitancy/update'] = 'kvitancy/update';
$route['kvitancy/update/(:any)'] = 'kvitancy/update/$1';
$route['kvitancy/delete/(:any)'] = 'kvitancy/delete/$1';
$route['kvitancy/printing/(:any)'] = 'kvitancy/printing/$1';
$route['kvitancy/printing_check/(:any)'] = 'kvitancy/printing_check/$1';
$route['kvitancy/view/(:any)'] = 'kvitancy/view/$1';


$route['kvitancy/(:any)'] = 'kvitancy/index/$1'; //$1 = page number


$route['tickets'] = 'tickets/index';
$route['tickets/add'] = 'tickets/add';
$route['tickets/update'] = 'tickets/update';
$route['tickets/update/(:any)'] = 'tickets/update/$1';
$route['tickets/delete/(:any)'] = 'tickets/delete/$1';
$route['tickets/printing/(:any)'] = 'tickets/printing/$1';
$route['tickets/printing_check/(:any)'] = 'tickets/printing_check/$1';
$route['tickets/view/(:any)'] = 'tickets/view/$1';
$route['tickets/show/(:any)'] = 'tickets/show/$1';


$route['tickets/(:any)'] = 'tickets/index/$1'; //$1 = page number


$route['admin/service_centers'] = 'admin_service_centers/index';
$route['admin/service_centers/add'] = 'admin_service_centers/add';
$route['admin/service_centers/update'] = 'admin_service_centers/update';
$route['admin/service_centers/update/(:any)'] = 'admin_service_centers/update/$1';
$route['admin/service_centers/delete/(:any)'] = 'admin_service_centers/delete/$1';
$route['admin/service_centers/(:any)'] = 'admin_service_centers/index/$1'; //$1 = page number


$route['admin/gorod'] = 'admin_gorod/index';
$route['admin/gorod/add'] = 'admin_gorod/add';
$route['admin/gorod/update'] = 'admin_gorod/update';
$route['admin/gorod/update/(:any)'] = 'admin_gorod/update/$1';
$route['admin/gorod/delete/(:any)'] = 'admin_gorod/delete/$1';
$route['admin/gorod/(:any)'] = 'admin_gorod/index/$1'; //$1 = page number

$route['admin/vid_remonta'] = 'admin_vid_remonta/index';
$route['admin/vid_remonta/add'] = 'admin_vid_remonta/add';
$route['admin/vid_remonta/update'] = 'admin_vid_remonta/update';
$route['admin/vid_remonta/update/(:any)'] = 'admin_vid_remonta/update/$1';
$route['admin/vid_remonta/delete/(:any)'] = 'admin_vid_remonta/delete/$1';
$route['admin/vid_remonta/(:any)'] = 'admin_vid_remonta/index/$1'; //$1 = page number

$route['admin/clients'] = 'admin_clients/index';
$route['admin/clients/add'] = 'admin_clients/add';
$route['admin/clients/update'] = 'admin_clients/update';
$route['admin/clients/update/(:any)'] = 'admin_clients/update/$1';
$route['admin/clients/delete/(:any)'] = 'admin_clients/delete/$1';
$route['admin/clients/(:any)'] = 'admin_clients/index/$1'; //$1 = page number


$route['admin/comments'] = 'admin_comments/index';
$route['admin/comments/add'] = 'admin_comments/add';
$route['admin/comments/update'] = 'admin_comments/update';
$route['admin/comments/update/(:any)'] = 'admin_comments/update/$1';
$route['admin/comments/delete/(:any)'] = 'admin_comments/delete/$1';
$route['admin/comments/(:any)'] = 'admin_comments/index/$1'; //$1 = page number

$route['admin/sost_remonta'] = 'admin_sost_remonta/index';
$route['admin/sost_remonta/add'] = 'admin_sost_remonta/add';
$route['admin/sost_remonta/update'] = 'admin_sost_remonta/update';
$route['admin/sost_remonta/update/(:any)'] = 'admin_sost_remonta/update/$1';
$route['admin/sost_remonta/delete/(:any)'] = 'admin_sost_remonta/delete/$1';
$route['admin/sost_remonta/(:any)'] = 'admin_sost_remonta/index/$1'; //$1 = page number




/* End of file routes.php */
/* Location: ./application/config/routes.php */