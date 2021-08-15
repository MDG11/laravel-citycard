<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Ride;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Request;

class RidesController extends Controller
{
    public function show()
    {
        $prices = Price::where('card_type_id', '=', auth()->user()->card_type_id)->get();
        $vehicles = Vehicle::orderBy('id')->paginate(20);
        return view('rides.vehicles', compact('prices','vehicles'));
    }
    public function pay($id)
    {
        $price = Price::where('card_type_id','=',auth()->user()->card_type_id)->where('vehicle_type_id','=',Vehicle::find($id)->vehicle_type_id)->first()->price;
        if($price>auth()->user()->balance){
            $ride = new Ride();
            $ride->card_id = auth()->user()->id;
            $ride->vehicle_id = $id;
            $ride->city_id = Vehicle::find($id)->city->id;
            $ride->price = $price;
            $ride->response = 'failed';
            $ride->save();
            return back()->with('error', 'Not enough funds on balance');
        }
        else {
            $ride = new Ride();
            $ride->card_id = auth()->user()->id;
            $ride->vehicle_id = $id;
            $ride->city_id = Vehicle::find($id)->city->id;
            $ride->price = $price;
            $ride->response = 'succeeded';
            try{
                $user = auth()->user();
                $user->balance -= $price;
                $user->save();
            }
            catch(Exception $e){
                return back()->with('error', 'Not enough funds on balance');
            }
            $ride->save();
            return back()->with('success', 'Enjoy your ride');
        }
    }
    public function history()
    {
        $rides = Ride::where('card_id','=',auth()->user()->id)->orderBy('created_at','DESC')->paginate(10);
        return view('rides.history', compact('rides'));
    }
}
