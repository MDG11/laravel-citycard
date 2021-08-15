<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::orderBy('id')->paginate(10);
        return view('admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        $vehicle_types = VehicleType::all();
        return view('admin.vehicles.create', compact('cities', 'vehicle_types'));
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
            'licence_plate_number' => array('required','regex:/[A-Z]{2}\d{4}[A-Z]{2}/u'),
            'city_id' => 'required|exists:cities,id',
            'vehicle_type_id' => 'required|exists:vehicle_types,id'
        ]);
        Vehicle::create([
            'licence_plate_number' => $request->licence_plate_number,
            'city_id' => $request->city_id,
            'vehicle_type_id' => $request->vehicle_type_id,
        ]);
        return redirect()->to(route('admin.vehicles.index'))->with('success', 'Vehicle added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cities = City::all();
        $vehicle_types = VehicleType::all();
        $vehicle = Vehicle::find($id);
        return view('admin.vehicles.edit', compact('vehicle','cities', 'vehicle_types'));
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
            'licence_plate_number' => array('required','regex:/[A-Z]{2}\d{4}[A-Z]{2}/u'),
            'city_id' => 'required|exists:cities,id',
            'vehicle_type_id' => 'required|exists:vehicle_types,id'
        ]);
        $vehicle = Vehicle::find($id);
        $vehicle->update($request->all());
        return redirect()->to(route('admin.vehicles.index'))->with('success', 'Vehicle updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->delete();
        return redirect()->to(route('admin.vehicles.index'))->with('success', 'Vehicle deleted successfully');
    }
}
