<?php

/*
|--------------------------------------------------------------------------
| File: Kernel.php
|--------------------------------------------------------------------------
| Description: This file contains the Kernel class which is responsible for
| interacting with an external system using GuzzleHttp.
| Author: Alireza Javadi
|--------------------------------------------------------------------------
*/

namespace VibeTiger\System;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class Kernel
 *
 * This class provides methods to interact with an external system using GuzzleHttp.
 */
class Kernel
{
	/**
	 * @var string $url The base URL of the external system.
	 */
	private $url;

	/**
	 * @var string $username The username used for authentication.
	 */
	private $username;

	/**
	 * @var string $accessKey The access key used for authentication.
	 */
	private $accessKey;

	/**
	 * @var string $token The authentication token.
	 */
	public $token;

	/**
	 * @var string $errorMsg Holds error messages encountered during operations.
	 */
	public $errorMsg = '';

	/**
	 * @var \GuzzleHttp\Client $client GuzzleHttp client for making HTTP requests.
	 */
	private $client;

	/**
	 * Kernel constructor.
	 *
	 * Initializes the Kernel object with the provided URL, username, and access key.
	 *
	 * @param string $url The base URL of the external system.
	 * @param string $name The username for authentication.
	 * @param string $key The access key for authentication.
	 */
	function __construct($url, $name, $key)
	{
		$this->url = $url;
		$this->username = $name;
		$this->accessKey = $key;
		$this->token = $key;

		// Initialize GuzzleHttp client
		$this->client = new Client([
			'base_uri' => $this->url,
			'verify' => false, // Disabling SSL verification (use with caution)
			'timeout' => 10 // Timeout for requests (in seconds)
		]);
	}

	/**
	 * Retrieves the authentication challenge from the external system.
	 *
	 * @return string|bool The authentication token on success, false on failure.
	 */
	private function getChallenge()
	{
		try {
			$response = $this->client->request('GET', '', [
				'query' => [
					'operation' => 'getchallenge',
					'username' => $this->username
				]
			]);

			$response = json_decode($response->getBody()->getContents(), true);

			if ($response['success'] === false) {
				$this->errorMsg = 'getChallenge failed: ' . $response['error']['message'] . '<br>';
				return false;
			}

			return $response['result']['token'];
		} catch (GuzzleException $e) {
			$this->errorMsg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Performs login operation to authenticate with the external system.
	 *
	 * @return bool True on successful login, false otherwise.
	 */
	function login()
	{
		$token = $this->getChallenge();
		if (!$token) {
			return false;
		}

		$generatedKey = md5($token . $this->accessKey);

		try {
			$response = $this->client->request('POST', '', [
				'form_params' => [
					'operation' => 'login',
					'username' => $this->username,
					'accessKey' => $generatedKey
				]
			]);

			$response = json_decode($response->getBody()->getContents(), true);

			if ($response['success'] === false) {
				$this->errorMsg = 'Login failed: ' . $response['error']['message'] . '<br>';
				return false;
			}

			$_SESSION['userId'] = $response['result']['userId'];
			$this->token = $response['result']['sessionName'];

			return true;
		} catch (GuzzleException $e) {
			$this->errorMsg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Executes an operation on the external system.
	 *
	 * @param array $values An array containing the operation name, parameters, and type.
	 * @return mixed The result of the operation, or false on failure.
	 */
	public function exec($values)
	{
		$name = $values[0];
		$params = $values[1];
		$type = $values[2];
		$filepath = ""; // Placeholder for file path (if needed)
		$params['operation'] = $name;
		$params['sessionName'] = $this->token;

		try {
			if (strtolower($type) === 'post') {
				$response = $this->client->request('POST', '', [
					'form_params' => $params,
					'multipart' => $this->prepareMultipart($params, $filepath)
				]);
			} else {
				$response = $this->client->request('GET', '', [
					'query' => $params
				]);
			}

			$result = $response->getBody()->getContents();
			return $this->return($result, $name);
		} catch (GuzzleException $e) {
			$this->errorMsg = $e->getMessage();
			return false;
		}
	}

	/**
	 * Processes the response and returns the result.
	 *
	 * @param string $result The response from the external system.
	 * @param string $name The name of the operation.
	 * @return mixed The result of the operation, or false on failure.
	 */
	private function return($result, $name)
	{
		$response = json_decode($result, true);
		if (!$response) {
			$this->errorMsg = "$name failed: " . $result . "<br>";
			return false;
		}
		if ($response['success'] === false) {
			$this->errorMsg = "$name failed: " . $response['error']['message'] . "<br>";
			return false;
		}
		return $response['result'];
	}

	/**
	 * Prepares the multipart form data for file upload.
	 *
	 * @param array $params The parameters for the operation.
	 * @param string $filepath The file path of the file to upload.
	 * @return array The prepared multipart form data.
	 */
	private function prepareMultipart($params, $filepath)
	{
		if ($filepath) {
			$params[] = [
				'name' => 'file',
				'contents' => fopen($filepath, 'r'),
				'filename' => basename($filepath)
			];
		}
		return $params;
	}
}
