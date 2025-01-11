<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'UserAction';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['home'] = 'UserAction';
$route['applyLeave'] = 'UserAction/applyLeave';
$route['leaveReporting'] = 'UserAction/leaveReporting';
$route['dashboard'] = 'UserAction/dashboard';
$route['signIn'] = 'UserAction/signIn';
$route['signUp'] = 'UserAction/signUp';
$route['logout'] = 'UserAction/logout';