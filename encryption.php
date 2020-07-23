<?php

/**
 * PHP Encryption API
 * 
 * @author		Raymund John Ang <raymund@open-nis.org>
 * @version		1.0
 * @license		MIT License
 */

// Change 'MySecret12345' to own secret passphrase
 define('PASS_PHRASE', 'MySecret12345');

/**
 * Encrypt data using AES CTR-HMAC
 *
 * @param string $plaintext - Plaintext to be encrypted
 * @return string           - contains base64-encoded ciphertext 
 */

function encrypt($plaintext)
{
	if (! function_exists('encrypt_v1')) {
		function encrypt_v1($plaintext)
		{
			$version = 'enc-v1'; // Version
			$cipher = 'aes-256-ctr'; // Cipher Method
			$salt = random_bytes(16); // Salt (randomness)
			$iv = $salt; // Initialization Vector

			// Derive keys
			$masterKey = hash_pbkdf2('sha256', PASS_PHRASE, $salt, 10000); // Master Key
			$encKey = hash_hkdf('sha256', $masterKey, 32, 'aes-256-encryption', $salt); // Encryption Key
			$hmacKey = hash_hkdf('sha256', $masterKey, 32, 'sha-256-authentication', $salt); // HMAC Key

			// Ciphertext and Hash
			$ciphertext = openssl_encrypt($plaintext, $cipher, $encKey, $options=0, $iv);
			$hash = hash_hmac('sha256', $ciphertext, $hmacKey);

			return $version . '::' . base64_encode($ciphertext) . '::' . base64_encode($hash) . '::' . base64_encode($salt);
		}
	}
	
	/* Version-based Encryption */
	// Default encryption function
	return encrypt_v1($plaintext);
}

/**
 * Decrypt data using AES CTR-HMAC
 *
 * @param string $encypted - base64-encoded data
 * @return string          - decrypted data
 */

function decrypt($encrypted)
{
	if (! function_exists('decrypt_v1')) {
		function decrypt_v1($encrypted)
		{
			$cipher = 'aes-256-ctr'; // Cipher Method

			list($version, $ciphertext, $hash, $salt) = explode('::', $encrypted);
			$ciphertext = base64_decode($ciphertext);
			$hash = base64_decode($hash);
			$salt = base64_decode($salt);

			$iv = $salt; // Initialization Vector

			// Derive keys
			$masterKey = hash_pbkdf2('sha256', PASS_PHRASE, $salt, 10000); // Master Key
			$encKey = hash_hkdf('sha256', $masterKey, 32, 'aes-256-encryption', $salt); // Encryption Key
			$hmacKey = hash_hkdf('sha256', $masterKey, 32, 'sha-256-authentication', $salt); // HMAC Key

			// Calculate hash of ciphertext
			$digest = hash_hmac('sha256', $ciphertext, $hmacKey);

			// HMAC Authentication
			if  ( hash_equals($hash, $digest) ) {
				return openssl_decrypt($ciphertext, $cipher, $encKey, $options=0, $iv);
			} else {
				exit('Please verify authenticity of ciphertext.');
			}
		}
	}

	/* Version-based Decryption */
	$version = explode('::', $encrypted)[0];

	switch ($version) {
		case 'enc-v1':
			return decrypt_v1($encrypted);
			break;
		default:
			return $encrypted; // Return $encrypted if no encryption detected.
	}
}

/**
 * Remote Procedure Call (RPC) API
 */

/* Require POST method */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	header('HTTP/1.1 405 Method should be \'POST\'');
	exit();
}

$body = file_get_contents('php://input'); // Javascript JSON.stringify() format

/* Require request body (not enctype="multipart/form-data") */
if (empty($body)) {
	header('HTTP/1.1 400 The request should have a body, and must not be enctype="multipart/form-data".');
	exit();
}

/* Require request body to be in JSON format */
$body_array = json_decode($body, TRUE); // Convert JSON body string into array

if (! is_array($body_array)) {
	header('HTTP/1.1 400 The request body should be in JSON format.');
	exit();
}

/* Require parameter "action" */
if (! isset($_GET['action']) || empty($_GET['action'])) {
	header('HTTP/1.1 400 Please set "action" parameter to either "encrypt" or "decrypt".');
	exit();
}

$action = $_GET['action'];

/* Execute Function */
if (function_exists($action)) {
	$data = array();
	foreach($body_array as $key => $value) {
		$data[$key] = $action($value);
	}
	echo json_encode($data);
} else {
	header('HTTP/1.1 400 Please set "action" parameter to either "encrypt" or "decrypt".');
	exit();
}