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
$route['default_controller'] = 'Home';

//admin page
$route['administrator']         = 'admin/Login';
$route['admin/logout']          = 'admin/login/logout';
$route['admin/blog-kategori']   = 'admin/kategori';
$route['admin/blog-komentar']   = 'admin/komentar/blog';
$route['admin/suratmasuk-list'] = 'admin/suratmasuk';
$route['admin/suratdigital-list']    = 'admin/download';
$route['admin/setting-general'] = 'admin/setting';
$route['admin/setting-seo']     = 'admin/setting/seo';
$route['admin/setting-socmed']  = 'admin/setting/socmed';
$route['admin/about-text']      = 'admin/about';
$route['admin/about-struktur']  = 'admin/about/struktur';
$route['admin/bidangusaha-list']    = 'admin/bidangusaha';
$route['admin/bidangusaha-komentar']    = 'admin/komentar/bidangusaha';
$route['admin/subscriber']    = 'admin/newsletter';

//front end
$route['c/(:any)']           = 'blog';
$route['p/(:any)']           = 'blog/detail';
$route['send-newsletter']    = 'admin/newsletter/save';
// $route['business/(:any)']           = 'business/det';

$route['404_override']       = '';
$route['translate_uri_dashes'] = FALSE;
