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
|	https://codeigniter.com/userguide3/general/routing.html
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

$route['default_controller'] = 'auth/login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


/*
|--------------------------------------------------------------------------
| Authentication Module
|--------------------------------------------------------------------------
*/
$route['register'] = 'auth/register';
$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['dashboard'] = 'auth/dashboard';

$route['verify-email'] = 'auth/verify_email';
$route['forgot-password'] = 'auth/forgot_password';
$route['reset-password'] = 'auth/reset_password';


/*
|--------------------------------------------------------------------------
| Profile Management Module
|--------------------------------------------------------------------------
*/
$route['profile'] = 'profile/index';
$route['profile/edit-main'] = 'profile/edit_main';

$route['profile/degrees'] = 'profile/degrees';
$route['profile/degrees/add'] = 'profile/add_degree';
$route['profile/degrees/edit/(:num)'] = 'profile/edit_degree/$1';
$route['profile/degrees/delete/(:num)'] = 'profile/delete_degree/$1';

$route['profile/certifications'] = 'profile/certifications';
$route['profile/certifications/add'] = 'profile/add_certification';
$route['profile/certifications/edit/(:num)'] = 'profile/edit_certification/$1';
$route['profile/certifications/delete/(:num)'] = 'profile/delete_certification/$1';

$route['profile/licences'] = 'profile/licences';
$route['profile/licences/add'] = 'profile/add_licence';
$route['profile/licences/edit/(:num)'] = 'profile/edit_licence/$1';
$route['profile/licences/delete/(:num)'] = 'profile/delete_licence/$1';

$route['profile/short-courses'] = 'profile/short_courses';
$route['profile/short-courses/add'] = 'profile/add_short_course';
$route['profile/short-courses/edit/(:num)'] = 'profile/edit_short_course/$1';
$route['profile/short-courses/delete/(:num)'] = 'profile/delete_short_course/$1';

$route['profile/employment'] = 'profile/employment';
$route['profile/employment/add'] = 'profile/add_employment';
$route['profile/employment/edit/(:num)'] = 'profile/edit_employment/$1';
$route['profile/employment/delete/(:num)'] = 'profile/delete_employment/$1';


/*
|--------------------------------------------------------------------------
| Bidding Module
|--------------------------------------------------------------------------
*/
$route['bidding'] = 'bidding/index';
$route['bidding/place'] = 'bidding/place_bid';
$route['bidding/notifications'] = 'bidding/notifications';

/*
| CLI command:
| php index.php bidding award_today_slot
*/


/*
|--------------------------------------------------------------------------
| API Access Management Module
|--------------------------------------------------------------------------
*/
$route['apitokens'] = 'ApiTokens/index';
$route['apitokens/create'] = 'ApiTokens/create';
$route['apitokens/revoke/(:num)'] = 'ApiTokens/revoke/$1';
$route['apitokens/usage'] = 'ApiTokens/usage';


/*
|--------------------------------------------------------------------------
| Public API Module
|--------------------------------------------------------------------------
*/
$route['api/featured-today'] = 'Api/featuredToday';

/*
| Optional future/CW2 API routes.
| Keep only if these methods exist in Api.php.
*/
$route['api/alumni'] = 'Api/alumni';
$route['api/analytics-summary'] = 'Api/analyticsSummary';


/*
|--------------------------------------------------------------------------
| Swagger / OpenAPI Documentation
|--------------------------------------------------------------------------
*/
$route['docs'] = 'Docs/index';
$route['api-docs'] = 'Docs/index';
$route['openapi.json'] = 'OpenApi/json';


/*
|--------------------------------------------------------------------------
| University Analytics Dashboard - CW2
|--------------------------------------------------------------------------
*/
$route['analytics'] = 'analytics/dashboard';
$route['analytics/dashboard'] = 'analytics/dashboard';
$route['analytics/alumni'] = 'analytics/alumni';