<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Setting;

class MapController extends Controller
{
    /**
     * Build the message.
     *
     * @return view
     */
	  public function index() 
	  {
	  	$key = Setting::where('name','gmaps_api_key')->first()->value;
	  	return view( 'mapa', [ 'key' => $key ] );
	  }
}
