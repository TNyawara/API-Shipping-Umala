<?php

namespace App\Http\Controllers;
use App\Models\quote;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $allOrders = quote::all()->where('user_id',$user->id)->where('payment','');
        $ongoing = quote::all()->where('user_id',$user->id)->where('status','ONGOING');
        $completed = quote::all()->where('user_id',$user->id)->where('status','COMPLETED');
        return view('orders',['ordersx'=> $allOrders,'ongoingData'=>$ongoing,'completedData'=>$completed]);
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
      $f = new order;
      $f->consignment = 'onions';
      $f->origin = 'KISUMU';
      $f->destination = 'NAIROBi';
      $f->weight = '5000';
      $f->price = '5642';
      $f->user_id = '1';
      $f->price_per_km = '20';
      $f->travel_distance = '324.4';
      $f->expected_date = '2020-11-11';
      $f->save();
      /*$f = new order;
      //$data = $request->all();
      $f->consignment = $request->consignment;
      $f->origin = $request->origin;
      $f->destination = $request->destination;
      $f->weight = $request->weight;
      $f->price = $request->price;
      $f->user_id = $request->user_id;
      $f->price_per_km = $request->price_per_km;
      $f->travel_distance = $request->travel_distance;
      $f->expected_date = $request->expected_date;
      $f->save();*/
        return response()->json($request, 201);
        //return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order $order)
    {
      //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
    }
}
