<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['dashboard'] = 'NDUTechController/dashboard';

$route['login'] = 'NDUTechController/index';

$route['logout'] = 'NDUTechController/logout';

$route['register'] = 'NDUTechController/register';

$route['register/process_registration'] = 'NDUTechController/process_registration';

$route['send_otp'] = 'NDUTechController/sendOTP';

$route['verify_email/(:any)'] = 'NDUTechController/verify_email/$1';

$route['verify_otp'] = 'NDUTechController/verify_otp';

$route['default_controller'] = 'NDUTechController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
