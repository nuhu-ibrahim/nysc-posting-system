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
$route['default_controller'] = 'student/land_student';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['student'] = 'student/land_student';
$route['dashboard'] = 'student/dashboard';
$route['slogin'] = 'student/login';
$route['slogout'] = 'student/logout';
$route['register'] = 'student/register';
$route['print-deployment-letter'] = 'student/print_deployment';
$route['print-green-card'] = 'student/print_green_card';

$route['admin'] = 'admin/land_admin';
$route['login'] = 'admin/login';
$route['logout'] = 'admin/logout';

$route['add-batch'] = 'batch/add_batch';
$route['edit-batch'] = 'batch/edit_batch';
$route['reset'] = 'batch/reset';

$route['add-institution'] = 'institution/add_institution';
$route['view-institutions'] = 'institution/view_institutions';
$route['edit-institution/(:num)'] = 'institution/edit_institution/$1';

$route['add-ppa'] = 'ppa/add_PPA';
$route['view-ppa'] = 'ppa/view_PPA';
$route['edit-ppa/(:num)'] = 'ppa/edit_PPA/$1';

$route['upload'] = 'mobilization/upload_students';
$route['view-mobilization-list'] = 'mobilization/view_mobilization_list';
$route['view-mobilization-status'] = 'mobilization/view_mobilization_status';
$route['status'] = 'mobilization/student_mobilization_status';

$route['deploy-students'] = 'deployment/deploy_students';
$route['view-deployment-list'] = 'deployment/view_deployment_list';
$route['view-deployment-status'] = 'deployment/view_deployment_status';
$route['redeploy-student'] = 'deployment/redeploy_student';

