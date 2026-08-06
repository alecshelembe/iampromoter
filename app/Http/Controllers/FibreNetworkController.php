<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FibreNetworkController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // to specific methods 
        // $this->middleware('auth')->except(['create', 'store']);
        // $this->middleware('auth')->only(['generate','viewInfluencers']);
    }

    public function NetworkSearch()
    {
        return view('layouts.coverage');
    }

    public function metrofibre_check(Request $request)
    {
            $latitude = $request->latitude;
            $longitude = $request->longitude;

            return view('check_firbre_network_operator_service.metrofibre-search-kml', compact('latitude', 'longitude'));
    }
    
    public function frogfoot1_check(Request $request)
    {
            $latitude = $request->latitude;
            $longitude = $request->longitude;

            return view('check_firbre_network_operator_service.frogfoot1-search-kml', compact('latitude', 'longitude'));
    }


}
