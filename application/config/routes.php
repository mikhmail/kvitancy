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
$route['admin/login'] = 'login/index';
$route['admin/logout'] = 'login/logout';
$route['admin/cache_delete'] = 'login/cache_delete';

$route['admin/login/validate_credentials'] = 'admin/validate_credentials';

$route['admin/users'] = 'admin_users/index';
$route['admin/users/add'] = 'admin_users/add';
$route['admin/users/update'] = 'admin_users/update';
$route['admin/users/update/(:any)'] = 'admin_users/update/$1';
$route['admin/users/delete/(:any)'] = 'admin_users/delete/$1';
$route['admin/users/(:any)'] = 'admin_users/index/$1'; //$1 = page number

$route['admin/groups'] = 'admin_groups/index';
$route['admin/groups/add'] = 'admin_groups/add';
$route['admin/groups/update'] = 'admin_groups/update';
$route['admin/groups/update/(:any)'] = 'admin_groups/update/$1';
$route['admin/groups/delete/(:any)'] = 'admin_groups/delete/$1';
$route['admin/groups/(:any)'] = 'admin_groups/index/$1'; //$1 = page number

$route['admin/brands'] = 'admin_brands/index';
$route['admin/brands/add'] = 'admin_brands/add';
$route['admin/brands/update'] = 'admin_brands/update';
$route['admin/brands/update/(:any)'] = 'admin_brands/update/$1';
$route['admin/brands/delete/(:any)'] = 'admin_brands/delete/$1';
$route['admin/brands/(:any)'] = 'admin_brands/index/$1'; //$1 = page number

$route['admin/devices'] = 'admin_devices/index';
$route['admin/devices/add'] = 'admin_devices/add';
$route['admin/devices/update'] = 'admin_devices/update';
$route['admin/devices/update/(:any)'] = 'admin_devices/update/$1';
$route['admin/devices/delete/(:any)'] = 'admin_devices/delete/$1';
$route['admin/devices/(:any)'] = 'admin_devices/index/$1'; //$1 = page number

$route['admin/tickets'] = 'admin_tickets/index';
$route['admin/tickets/add'] = 'admin_tickets/add';
$route['admin/tickets/update'] = 'admin_tickets/update';
$route['admin/tickets/update/(:any)'] = 'admin_tickets/update/$1';
$route['admin/tickets/delete/(:any)'] = 'admin_tickets/delete/$1';
$route['admin/tickets/(:any)'] = 'admin_tickets/index/$1'; //$1 = page number

$route['tickets'] = 'tickets/index';
$route['tickets/add'] = 'tickets/add';
$route['tickets/update'] = 'tickets/update';
$route['tickets/update/(:any)'] = 'tickets/update/$1';
$route['tickets/delete/(:any)'] = 'tickets/delete/$1';
$route['tickets/printing/(:any)'] = 'tickets/printing/$1';
$route['tickets/printing_check/(:any)'] = 'tickets/printing_check/$1';
$route['tickets/printing_invoice/(:any)'] = 'tickets/printing_invoice/$1';
$route['tickets/printing_works/(:any)'] = 'tickets/printing_works/$1';

$route['tickets/view/(:any)'] = 'tickets/view/$1';
$route['tickets/show/(:any)'] = 'tickets/show/$1';
$route['tickets/update_client'] = 'tickets/update_client';
$route['tickets/update_client/(:any)'] = 'tickets/update_client/$1';
$route['tickets/(:any)'] = 'tickets/index/$1'; //$1 = page number


$route['admin/service_centers'] = 'admin_service_centers/index';
$route['admin/service_centers/add'] = 'admin_service_centers/add';
$route['admin/service_centers/update'] = 'admin_service_centers/update';
$route['admin/service_centers/update/(:any)'] = 'admin_service_centers/update/$1';
$route['admin/service_centers/delete/(:any)'] = 'admin_service_centers/delete/$1';
$route['admin/service_centers/(:any)'] = 'admin_service_centers/index/$1'; //$1 = page number


$route['admin/cities'] = 'admin_cities/index';
$route['admin/cities/add'] = 'admin_cities/add';
$route['admin/cities/update'] = 'admin_cities/update';
$route['admin/cities/update/(:any)'] = 'admin_cities/update/$1';
$route['admin/cities/delete/(:any)'] = 'admin_cities/delete/$1';
$route['admin/cities/(:any)'] = 'admin_cities/index/$1'; //$1 = page number

$route['admin/types'] = 'admin_types/index';
$route['admin/types/add'] = 'admin_types/add';
$route['admin/types/update'] = 'admin_types/update';
$route['admin/types/update/(:any)'] = 'admin_types/update/$1';
$route['admin/types/delete/(:any)'] = 'admin_types/delete/$1';
$route['admin/types/(:any)'] = 'admin_types/index/$1'; //$1 = page number

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

$route['admin/status'] = 'admin_status/index';
$route['admin/status/add'] = 'admin_status/add';
$route['admin/status/update'] = 'admin_status/update';
$route['admin/status/update/(:any)'] = 'admin_status/update/$1';
$route['admin/status/delete/(:any)'] = 'admin_status/delete/$1';
$route['admin/status/(:any)'] = 'admin_status/index/$1'; //$1 = page number

$route['store'] = 'store/index';
$route['store/add'] = 'store/add';
$route['store/update/(:any)'] = 'store/update/$1';
$route['store/delete/(:any)'] = 'store/delete/$1';
$route['store/return_store/(:any)'] = 'store/return_store/$1';
$route['store/(:any)'] = 'store/index'; //$1 = page number

$route['parts'] = 'parts/index';
$route['parts/add'] = 'parts/add';
$route['parts/(:any)'] = 'parts/index'; //$1 = page number


$route['works'] = 'works/index';
$route['works/add'] = 'works/add';
$route['works/update/(:any)'] = 'works/update/$1';
$route['works/delete/(:any)'] = 'works/delete/$1';
$route['works/(:any)'] = 'works/index'; //$1 = page number

$route['cash'] = 'cash/index';
$route['cash/add'] = 'cash/add';
$route['cash/update/(:any)'] = 'cash/update/$1';
$route['cash/delete/(:any)'] = 'cash/delete/$1';
$route['cash/(:any)'] = 'cash/index'; //$1 = page number

$route['stat'] = 'stat/index';
$route['stat/add'] = 'stat/add';
$route['stat/update/(:any)'] = 'stat/update/$1';
$route['stat/delete/(:any)'] = 'stat/delete/$1';
$route['stat/(:any)'] = 'stat/index'; //$1 = page number


$route['backup/(:any)'] = 'backup/index/$1'; //$1 = page number

/* End of file routes.php */
/* Location: ./application/config/routes.php */