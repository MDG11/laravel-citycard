<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Rules\FreeCode;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest:web,admin');
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
            'card_code' => ['required', 'string', 'max:255', 'exists:cards,card_code', new FreeCode()],
            'phone' => ['required'],
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
        if (!User::where('phone', '=', $data['phone'])->first()) {
            $user = new User();
            $user->phone = $data['phone'];
            $user->save();
        } else $user = User::where('phone', '=', $data['phone'])->first();
        $card = Card::where('card_code', '=', $data['card_code'])->first();
        $card->user_id = $user->id;
        $card->setRememberToken($token = Str::random(10));
        $card->save();
        return $card;
    }
}
