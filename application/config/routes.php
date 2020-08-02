<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// all API routes
$route['create-token'] 			= 	'ApiController/CreateToken'; // to create new token
$route['create-customer'] 		= 	'ApiController/CreateCustomer'; // to create new cust.
$route['update-customer'] 		= 	'ApiController/UpdateCustomer'; // to update cust.
$route['show-customers'] 		= 	'ApiController/AllCustomers'; // to display all cust.
$route['delete-customers'] 		= 	'ApiController/DeleteCustomerApi'; // to delete cust.
