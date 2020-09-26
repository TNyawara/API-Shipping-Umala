<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\quote;
use Illuminate\Http\Request;

class quoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $locations = DB::table('locations')->get();
        return view('quote', ['locations' => $locations,'pricePerKM' => 20.0]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $quote = new quote;
      $quote->consignment = $request->consignment;
      $quote->origin = $request->origin;
      $quote->destination = $request->destination;
      $quote->weight = $request->weight;
      $quote->price = $request->price;
      $quote->user_id = $request->user_id;
      $quote->price_per_km = $request->price_per_km;
      $quote->travel_distance = $request->travel_distance;
      $quote->expected_date = $request->expected_date;
      $quote->save();
        return response()->json('success', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
        $quot = quote::find($id);
        $quot->payment = $request->payment;
        $quot->status = 'ONGOING';
        $quot->save();
        return response()->json('success', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
