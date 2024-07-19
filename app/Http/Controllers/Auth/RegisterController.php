<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Traits\ApiResponseTrait;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use ApiResponseTrait;
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'unique:users', 'regex:/^[0-9+\(\)#\.\s\/ext-]+$/'],
            'role_id' => ['required','exists:roles,id']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'gender' => $data['gender'],
            'phone' => $data['phone'],
            'role_id' => $data['role_id'],
        ]);
    }
    public function showRegistrationForm()
    {
        $roles = Role::all();
        return view('auth.register', compact('roles'));
    }
    public function register(Request $request){
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return $this->apiErrorResponse($validator->errors()->first(), 422);
        }
        $user = $this -> create($request->all());
        return $this->apiSuccessResponse('User added successfully.', $user, 201);
    }
}
