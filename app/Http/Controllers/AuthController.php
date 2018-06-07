<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserInfo;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
	public function login(Request $request)
	{
		$http = new \GuzzleHttp\Client;

		try {	
			$response = $http->post(config('services.passport.login_endpoint'), [
				'form_params' => [
					'grant_type' => 'password',
					'client_id' => config('services.passport.client_id'),
					'client_secret' => config('services.passport.client_secret'),
					'username' => $request->email, // Envío el parámetro como "email" pero el Oauth lo tengo que asignar como username
					'password' => $request->password,
				]
			]);

			return $response->getBody();
		} catch (\GuzzleHttp\Exception\BadResponseException $e) {
			if ($e->getCode() == 400) {
				return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
			} else if ($e->getCode() == 401) {
				return response()->json('Your credentials are incorrect. Please try again.', $e->getCode());
			}

			return response()->json('Something went wrong on the server.', $e->getCode());
		}
	}

	public function register(Request $request)
	{
		$request->validate([
			'first_name' => 'required|string|max:50',
			'last_name' => 'required|string|max:100',
			'dni' => 'required|string|size:8|unique:user_infos',
			'address' => 'required|string|max:200',
			'phone' => 'nullable|string|size:9',
			'cell_phone' => 'nullable|string|size:9',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6',
		]);

		$user = User::create([
			'email' => $request->email,
			'type' => 'user',
			'state' => 'active',
			'password' => Hash::make($request->password),
		]);

		return UserInfo::create([
			'first_name' => $request->first_name,
			'last_name' => $request->last_name,
			'dni' => $request->dni,
			'address' => $request->address,
			'phone' => $request->phone,
			'cell_phone' => $request->cell_phone,
			'user_id' => $user->id
		]);
	}

	public function logout()
	{
		auth()->user()->tokens->each(function ($token, $key){
			$token->delete();
		});

		return response()->json('Logged out successfully', 200);
	}
}
