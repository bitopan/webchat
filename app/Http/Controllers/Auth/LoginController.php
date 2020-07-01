<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $this->middleware('guest')->except('logout', 'doLogin');
    }

    public function doLogin(Request $request){

         if(\Auth::attempt(['email' => $request->email, 'password' => $request->password])){

         //Login Successful
         $response = array('success' => true);

         //return a JSON response
         return response()->json($response)
                ->header('AMP-Redirect-To', route('home'))
                ->header('Access-Control-Expose-Headers', "AMP-Redirect-To");
         }
         else{

         $response = array('success' => false, 'message' => 'Invalid login credentials');

         return response()->json($response);
         }
       
    }

}
