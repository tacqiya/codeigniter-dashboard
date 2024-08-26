<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Mainpage';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['register'] = 'Mainpage/admin_register';
$route['login'] = 'Mainpage/admin_login';
$route['logout'] = 'Mainpage/logout';
$route['dashboard'] = 'Mainpage/dashboard';