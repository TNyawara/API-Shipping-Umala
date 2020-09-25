<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;

class showLocations extends Controller
{
    //
    public function show()
{
    $locations = DB::table('locations')->get();
    return view('request', ['locations' => $locations,'pricePerKM' => 20.0]);
}
  public function distance($a,$b){
    $html = file_get_html('https://www.distance.to/'.$a.'/'.$b);
    $distanceInKM = $html->find('span[class=value km]')[1];
    return $distanceInKM->plaintext;
  }

  public function welcome(){
    $locs = DB::table('locations')->get();
    $clients = DB::table('users')->get();
    $completedQuotes = DB::table('quotes')->where('status','COMPLETED')->take(5)->get();
    return view('welcome', ['locations' => $locs,'completedQuotes' => $completedQuotes,'clients' => $clients]);
  }
}
