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
$route['admin_product']['GET'] = 'Admin_Product/product';
$route['addproduct']['POST'] = 'Admin_Product/addproduct';
$route['admin_product'] = 'Admin_Product/display_product';
$route['update_product']['POST'] = 'Admin_Product/update_product';
$route['delete'] = 'Admin_Product/delete_product';
$route['admin_dashboard'] = 'Admin_Dashboard/dashboard';
$route['signup']['GET'] = 'CustomerSignUp/SignUp_Form';
$route['signup']['POST'] = 'CustomerSignUp/SignUp';
$route['login']['GET'] = 'CustomerLogin/login_Form';
$route['login']['POST'] = 'CustomerLogin/login';
$route['form'] ='CustomerLogin/form';
$route['logout'] = 'CustomerLogout/logout';
$route['forgotpassword']['GET']= 'ForgotPassword/forgotpass_form';
$route['ChangePassword'] = 'ForgotPassword/get_recovery_token';
$route['account_recovery']['POST'] = 'ForgotPassword/sendrecovery_token';
$route['Save'] = 'ForgotPassword/get_recovery_token';
$route['checkout'] = 'CustomerCheackOut/checkout';
$route['myaccount'] = 'CustomerAccount/myaccount';
$route['send'] = 'mail/send';
$route['EmailVerify'] = 'EmailVerify/verify';
$route['default_controller'] = 'CustomerLogin/login_Form';
$route['(:any)'] = 'CustomerHome/Home/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

