<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prices = Price::orderBy('id')->paginate(10);
        return view('admin.prices.index', compact('prices'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'price' => 'required|numeric'
        ]);
        $price = Price::find($id);
        $price->price = $request->price * 100;
        $price->save();
        return redirect()->to(route('admin.prices.index'))->with('success', 'Price updated');
    }
}
