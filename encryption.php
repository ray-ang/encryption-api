<?php

/**
 * PHP Encryption API
 * 
 * @version 	v0.9.0
 * @author 		Raymund John Ang <raymund@open-nis.org>
 * @license 	MIT License
 */

require_once __DIR__ . '/Basic.php'; // BasicPHP class library
define('PASS_PHRASE', 'MySecret12345'); // Encryption key

/*
|--------------------------------------------------------------------------
| Middleware
|--------------------------------------------------------------------------
*/

/* Require POST method */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	Basic::apiResponse(405, "Method should be 'POST'.");
	exit();
}

$body = file_get_contents('php://input'); // Request body

/* Require request body (not enctype="multipart/form-data") */
if ( empty($body) ) {
	Basic::apiResponse(400, 'The request should have a body, and must not be enctype="multipart/form-data".');
	exit();
}

/* Require request body to be in JSON format */
$body_array = json_decode($body, TRUE); // Convert JSON body string into array

if (! is_array($body_array)) {
	Basic::apiResponse(400, 'The request body should be in JSON format.');
	exit();
}

/* Require parameter "action" */
if (! isset($_GET['action']) || empty($_GET['action'])) {
	Basic::apiResponse(400, 'Please set "action" parameter to either "encrypt" or "decrypt".');
	exit();
}

/*
|--------------------------------------------------------------------------
| Execute Method
|--------------------------------------------------------------------------
*/

// Execute method using "switch" to prevent Function Injection Attack
switch ($_GET['action']) {
	case 'encrypt':
		$data = array();
		foreach($body_array as $key => $value) {
			$data[$key] = Basic::encrypt($value, PASS_PHRASE);
		}
		echo json_encode($data);
		break;
	case 'decrypt':
		$data = array();
		foreach($body_array as $key => $value) {
			$data[$key] = Basic::decrypt($value, PASS_PHRASE);
		}
		echo json_encode($data);
		break;
	default:
		Basic::apiResponse(400, 'Please set "action" parameter to either "encrypt" or "decrypt".');
		exit();
}