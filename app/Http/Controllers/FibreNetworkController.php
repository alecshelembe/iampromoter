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

    public function frogfoot1b_check(Request $request)
    {
            $latitude = $request->latitude;
            $longitude = $request->longitude;

            return view('check_firbre_network_operator_service.frogfoot1b-search-kml', compact('latitude', 'longitude'));
    }

    public function frogfoot2_check(Request $request)
    {
            $latitude = $request->latitude;
            $longitude = $request->longitude;

            return view('check_firbre_network_operator_service.frogfoot2-search-kml', compact('latitude', 'longitude'));
    }

	public function frogfoot2b_check(Request $request)
    {
            $latitude = $request->latitude;
            $longitude = $request->longitude;

            return view('check_firbre_network_operator_service.frogfoot2b-search-kml', compact('latitude', 'longitude'));
    }

	public function dnatel_check(Request $request)
    {
            $latitude = $request->latitude;
            $longitude = $request->longitude;

            return view('check_firbre_network_operator_service.dnatel-search-kml', compact('latitude', 'longitude'));
    }

	public function octotel_check(Request $request)
    {
            $latitude = $request->latitude;
            $longitude = $request->longitude;

            return view('check_firbre_network_operator_service.octotel-search-kml', compact('latitude', 'longitude'));
    }

	public function ttconnect_check(Request $request)
    {
            $latitude = $request->latitude;
            $longitude = $request->longitude;

            return view('check_firbre_network_operator_service.ttconnect-search-kml', compact('latitude', 'longitude'));
    }
}
