<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Http\Requests\LoginRequest;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(LoginRequest $request)
    {
    if (!Auth::attempt($request->only('email', 'password'))) {
    return response()->json([
        'code' => 401,
            'status' => false,
            'message' => 'Invalid login details',
            'data' => [
            'message' => 'Invalid login details',
                

            ]
               ]);
           }
    
    $user = User::where('email', $request['email'])->firstOrFail();
    
    $token = $user->createToken('auth_token')->plainTextToken;
    
    return response()->json([
        'code' => 200,
            'status' => true,
            'message' => 'success',
            'data' => [
            'message' => 'successfully logged in',
            'access_token' => $token,
            'token_type' => 'Bearer',
            ]
    ]);
    }

    public function logout()
    {
        try {
            Session::flush();
            $success = true;
            $message = 'Successfully logged out';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        // response
        $response = [
            'success' => $success,
            'message' => $message,
        ];
        return response()->json($response);
    }
}
