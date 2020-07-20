<?php

/**
 * PHP Encryption API
 * 
 * @author		Raymund John Ang <raymund@open-nis.org>
 * @version		1.0
 * @license		MIT License
 */

define('PASS_PHRASE', 'MySecret12345'); // Define PASS_PHRASE

/**
 * Encrypt data using AES CTR-HMAC
 *
 * @param string $plaintext - Plaintext to be encrypted
 */

function encrypt($plaintext)
{
	function encrypt_v1($plaintext)
	{
		// Version, Cipher Method and Initialization Vector
		$version = 'enc-v1';
		$cipher = 'aes-256-ctr';
		$iv = random_bytes(16);

		// Salt and Keys
		$salt = random_bytes(16);
		$key = hash_pbkdf2('sha256', PASS_PHRASE, $salt, 10000); // Encryption
		$key_hmac = hash_pbkdf2('sha256', PASS_PHRASE, $salt, 10000); // HMAC

		// Ciphertext and Hash
		$ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv);
		$hash = hash_hmac('sha256', $ciphertext, $key_hmac);

		return $version . '::' . base64_encode($ciphertext) . '::' . base64_encode($hash) . '::' . base64_encode($iv) . '::' . base64_encode($salt);
	}

	/* Version-based Encryption */
	// Default encryption function
	return encrypt_v1($plaintext);
}

/**
 * Decrypt data using AES CTR-HMAC
 *
 * @param string $encypted - base64-encoded data
 */

function decrypt($encrypted)
{
	function decrypt_v1($encrypted)
	{
		// Cipher method
		$cipher = 'aes-256-ctr';

		list($version, $ciphertext, $hash, $iv, $salt) = explode('::', $encrypted);
		$ciphertext = base64_decode($ciphertext);
		$hash = base64_decode($hash);
		$iv = base64_decode($iv);
		$salt = base64_decode($salt);

		// Derive Keys
		$key = hash_pbkdf2('sha256', PASS_PHRASE, $salt, 10000); // Decryption
		$key_hmac = hash_pbkdf2('sha256', PASS_PHRASE, $salt, 10000); // HMAC

		// Calculate hash of ciphertext
		$digest = hash_hmac('sha256', $ciphertext, $key_hmac);

		// HMAC Authentication
		if  ( hash_equals($hash, $digest) ) {
			return openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv);
		} else {
			exit('Please verify authenticity of ciphertext.');
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

$body = file_get_contents('php://input'); // Plaintext or encoded ciphertext

/* Require request body (not enctype="multipart/form-data") */
if (empty($body)) {
	header('HTTP/1.1 400 The request should have a body, and must not be enctype="multipart/form-data".');
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
	echo $action($body);
} else {
	header('HTTP/1.1 400 Please set "action" parameter to either "encrypt" or "decrypt".');
	exit();
}