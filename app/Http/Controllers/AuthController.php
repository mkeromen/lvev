<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return \Psr\Http\Message\StreamInterface|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request) 
    {
        $http = new Client();
        try {
            $tokenResponse = $http->post(config('app.url') . '/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->username,
                    'password' => $request->password
                ]
            ]);
            
            return $this->successResponseApi(200, 'Token returned', json_decode($tokenResponse->getBody()->getContents()));
        } catch(\GuzzleHttp\Exception\BadResponseException $e) {
            if($e->getCode() === 400) {
                return $this->errorResponseApi(400, 'Invalid request');
            } else if($e->getCode() === 401) {
                return $this->errorResponseApi(401, 'Your credentials are incorrect');
            }
            
            return $this->errorResponseApi($e->getCode(), 'Something went wrong');
        }
    }
    
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6'
            ]);
            
            return User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            
        } catch(ValidationException $e) {
            return response()->json($e->errors(), 400);
        }
    }
    
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        auth()->user()->tokens->each(function($token, $key) {
            $token->delete();
        });
                
        return response()->json('Logged out successfully.');
    }
    
}
