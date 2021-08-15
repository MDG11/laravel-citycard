<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CardType;
use App\Models\Price;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicle_types = VehicleType::orderBy('id')->paginate(10);
        return view('admin.vehicle_types.index', compact('vehicle_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $card_types = CardType::all();
        return view('admin.vehicle_types.create', compact('card_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255|unique:vehicle_types,type',
        ]);
        $input_prices = $request->except('_token', 'type');
        $vehicle_type = VehicleType::create([
            'type' => $request->type,
        ]);
        foreach(CardType::all() as $card_type){
            Price::create([
                'vehicle_type_id' => $vehicle_type->id,
                'card_type_id' => $card_type->id,
                'price' => $input_prices[$card_type->id.'-price']*100,
            ]);
        }
        return redirect()->to(route('admin.vehicle-types.index'))->with('success', 'Vehicle type added successfully');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = VehicleType::find($id);
        return view('admin.vehicle_types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string|max:255|unique:vehicle_types,type',
        ]);
        $type = VehicleType::find($id);
        $type->update($request->all());
        return redirect()->to(route('admin.vehicle-types.index'))->with('success', 'Vehicle type added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = VehicleType::find($id);
        $type->delete();
        return redirect()->to(route('admin.vehicle-types.index'))->with('success', 'Vehicle type deleted successfully');
    }
}
