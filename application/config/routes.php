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
$route['default_controller'] = 'Front';
$route['inventory/(:any)/(:any)']='Front/inventory/$1/$2';
$route['property/(:any)/(:any)']='Front/property/$1/$2';
$route['invoice/(:any)']='Front/invoice/$1';
$route['pdf-invoice/(:any)']='Front/pdf_invoice/$1';
$route['pdf-receipt/(:any)']='Front/pdf_receipt/$1';
$route['invoice-pay/(:any)']='Front/invoice_pay/$1';
$route['invoice-pay-request/(:any)']='Front/invoice_pay_request/$1';
$route['order-response/(:any)']='Front/order_response/$1';
$route['agent/plans']='Front/plans';
$route['agent/pay']='Front/pay';
$route['agent/login']='Front/agent_login';
$route['agent/agent_login_process']='Front/agent_login_process';
$route['agent/register']='Front/agent_register';
$route['agent/agent_check_email']='Front/agent_check_email';
$route['agent/agent_register_process']='Front/agent_register_process';
$route['agent/associate-registration']='Front/associate_registration';
$route['agent/associate_save']='Front/associate_save';
$route['agent/forgot-password']='Front/agent_forgot_password';
$route['agent/forgot_password_process']='Front/agent_forgot_password_process';
$route['agent/reset-password/(:any)']='Front/agent_reset_password/$1';
$route['agent/reset_password_process']='Front/agent_reset_password_process';
$route['agent/forgot-userid']='Front/agent_forgot_userid';
$route['agent/forgot_userid_process']='Front/agent_forgot_userid_process';
$route['agent/confirm-mail/(:any)']='Front/agent_confirm_mail/$1';
$route['agent/agent_get_mobile_otp']='Front/agent_get_mobile_otp';
$route['agent/agent_verify_mobile']='Front/agent_verify_mobile';
$route['admin/login']='Front/admin_login';
$route['admin/admin_login_process']='Front/admin_login_process';
$route['admin'] = 'admin/index';

$route['admin/api'] = 'admin_api/index';
$route['admin/api/(:any)'] = 'admin_api/$1';

$route['agent/api'] = 'agent_api/index';
$route['agent/api/(:any)'] = 'agent_api/$1';

$route['api/(:any)'] = 'Api/$1';

$route['agent'] = 'agent/index';
/*$route['customer/(:any)']='admin/customer/$1';
$route['agents/(:any)']='admin/agents/$1';
$route['news/(:any)']='Front/news/$1';
$route['events/(:any)']='Front/events/$1';
$route['news/(:any)'] = 'Front/news_details/$1';
$route['add_courses/(:any)'] = 'Front/add_courses/$1';
$route['courses-details/(:any)'] = 'Front/courses_details/$1';
$route['famous/(:any)']='Front/famous/$1';
$route['gallery/(:any)']='Front/gallery/$1';*/
$route['(:any)'] = 'Front/$1';
$route['helper/(:any)'] = 'Helper/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;
