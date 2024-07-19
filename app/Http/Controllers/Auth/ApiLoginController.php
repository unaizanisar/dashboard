<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\ApiResponseTrait;
class ApiLoginController extends Controller
{
    use ApiResponseTrait;
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        \Log::info('Login request received:', $request->all());

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return $this->apiErrorResponse($validator->errors()->first(), 422);
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            if ($user->status == 0) {
                Auth::logout();
                return $this->apiErrorResponse('Your account is inactive. Please contact admin support.', 403);
            }

            $token = $user->createToken('API Token')->plainTextToken;

            return $this->apiSuccessResponse('Login Successful', [
                'user' => $user,
                'token' => $token,
            ]);
        }
        return $this->apiErrorResponse('Invalid Credentials', 401);
    }
}
