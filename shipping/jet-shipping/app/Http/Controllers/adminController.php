<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\quote;
class adminController extends Controller
{
    //
    public function dashboard(){
      $user = auth()->user();
      $ongoing = quote::all()->where('status','ONGOING');
      $completed = quote::all()->where('status','COMPLETED');
      return view('dashboard',['ongoingData'=>$ongoing,'completedData'=>$completed]);
    }
    public function complete(Request $request){
      $quot = quote::find($request->complete);
      $quot->status = 'COMPLETED';
      $quot->save();
      return response()->json('success', 201);
    }
}
