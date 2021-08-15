<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\CardType;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = Card::orderBy('id')->paginate(10);
        return view('admin.cards.index', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $card_types = CardType::all();
        return view('admin.cards.create', compact('card_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'card_number' => 'required|string|max:255|unique:cards,card_code',
            'card_type' => 'required|numeric'
        ]);
        Card::create([
            'card_code' => $request->card_number,
            'card_type_id' => $request->card_type,
        ]);
        return redirect()->to(route('admin.cards.index'))->with('success', 'Card added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Card::find($id)->only('id', 'card_code');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $card_types = CardType::all();
        $card = Card::find($id);
        return view('admin.cards.edit', compact('card', 'card_types'));
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
            'card_code' => 'required|string|max:255|unique:cards,card_code',
            'card_type_id' => 'required|numeric'
        ]);
        $card = Card::find($id);
        $card->update($request->all());
        return redirect()->to(route('admin.cards.index'))->with('success', 'Card updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Card = Card::find($id);
        $Card->delete();
        return redirect()->to(route('admin.cards.index'))->with('success', 'Card deleted!');
    }
}
