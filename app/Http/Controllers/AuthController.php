<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) {
		$http = new \GuzzleHttp\Client;
		$credentials = json_decode($request->getContent());
		try {
			$response = $http->post(config('services.passport.login_endpoint'), [
				'form_params' => [
					'grant_type' => 'password',
					'client_id' => config('services.passport.client_id'),
					'client_secret' => config('services.passport.client_secret'),
					'username' => $credentials->username,
					'password' => $credentials->password
				]
			]);

			return response()->json([
				'data' => json_decode($response->getBody()),
				'status' => $response->getStatusCode()
			], $response->getStatusCode());
			
		} catch (\GuzzleHttp\Exception\BadResponseException $e) {
			$message = '';

			if($e->getCode() === 400) {
				$message = 'Invalid Request. Please enter a username or a password.';
			} else if($e->getCode() === 401) {
				$message = 'Your credentials are incorrect. Please try again.';
			} else {
				$message = 'Something went wrong';
			}

			return response()->json([
				'message' => $message,
				'status' => $e->getCode()
			], $e->getCode());
		}
	}

	public function logout() {
		auth()->user()->tokens->each(function ($token, $key) {
			$token->revoke();
		});

		return response()->json('Logged out successfully', 200);
	}
}
