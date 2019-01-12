<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['dashboard'] = 'core/dashboard/dashboard/index';
$route['dashboard/front_desk'] = 'core/dashboard/front_desk/index';
$route['dashboard/staffs'] = 'core/dashboard/staffs/index';
$route['dashboard/programs'] = 'core/dashboard/programs/index';
$route['dashboard/api_clients'] = 'core/dashboard/api_clients/index';
$route['dashboard/staff_access'] = 'core/dashboard/staff_access/index';
$route['dashboard/patients'] = 'core/dashboard/patients/index';
$route['dashboard/referrals'] = 'core/dashboard/referrals/index';
$route['dashboard/configurations'] = 'core/dashboard/configurations/index';
$route['dashboard/to_do_list'] = 'core/dashboard/to_do_list/index';
$route['dashboard/reminders'] = 'core/dashboard/reminders/index';
$route['dashboard/drugtest'] = 'core/dashboard/drugtest/index';
$route['dashboard/doctors'] = 'core/dashboard/doctors/index';
$route['dashboard/sessions'] = 'core/dashboard/sessions/index';
$route['dashboard/check_in'] = 'core/dashboard/check_in/index';
$route['login'] = 'login/login/index';
