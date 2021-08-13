<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

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


    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    
    protected function validateLogin(Request $request)
    {
        if(User::where('phone','=',$request->user_id)->first())
        $request->user_id = User::where('phone','=',$request->user_id)->first()->id;
        $request->validate([
            'card_code' => 'required',
            'user_id' => 'required',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $account = Card::where('card_code','=', $request->card_code)->where('user_id','=',$request->user_id)->first();
        if($account){
            return $this->guard()->loginUsingId($account->id);
        }
        else return false;
    }

    protected function credentials(Request $request)
    {
        return $request->only('card_code', 'user_id');
    }

    
    public function username()
    {
        return 'card_code';
    }
}
