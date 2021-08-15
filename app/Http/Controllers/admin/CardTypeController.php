<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CardType;
use App\Models\Price;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class CardTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $card_types = CardType::orderBy('id')->paginate(10);
        return view('admin.card_types.index', compact('card_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicle_types = VehicleType::all();
        return view('admin.card_types.create', compact('vehicle_types'));
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
            'type' => 'required|string|max:255|unique:card_types,type',
        ]);
        $input_prices = $request->except('_token', 'type');
        $card_type = CardType::create([
            'type' => $request->type,
        ]);
        foreach(VehicleType::all() as $vehicle_type){
            Price::create([
                'vehicle_type_id' => $vehicle_type->id,
                'card_type_id' => $card_type->id,
                'price' => $input_prices[$vehicle_type->id.'-price']*100,
            ]);
        }
        return redirect()->to(route('admin.card-types.index'))->with('success', 'Card type added successfully');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = CardType::find($id);
        return view('admin.card_types.edit', compact('type'));
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
            'type' => 'required|string|max:255|unique:card_types,type',
        ]);
        $type = CardType::find($id);
        $type->update($request->all());
        return redirect()->to(route('admin.card-types.index'))->with('success', 'Card type added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = CardType::find($id);
        $type->delete();
        return redirect()->to(route('admin.card-types.index'))->with('success', 'Card type deleted successfully');
    }
}
