@extends('welcome')

@section('content')

<div id="main-form">
  <p class="font-bold text-2xl text-center p-2">Coverage Search </p>
  <p for="address-input" id="Enter_address" class="text-sm text-center p-2">Enter an address to get started </p>
  <div class="flex justify-center">
      <input type="text" id="address-input" placeholder="Enter a street name" class="text-center rounded-xl shadow-md w-3/4 text-black my-4 py-2 ">
      <input type="text" id="google_location" class=" hidden text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
      <input type="text" id="google_latitude" class=" hidden text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
      <input type="text" id="google_longitude" class=" hidden text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
      <input type="text" id="google_location_type" class=" hidden text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
      <input type="text" id="google_postal_code" class=" hidden text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
      <input type="text" id="google_city" class=" hidden text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
      <input type="text" id="package_selected" class=" hidden text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
      <input type="text" id="web_source" class=" hidden text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
      <input type="text" id="location_id" class=" hidden text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
  </div>
  <div id="loader" class="flex items-center justify-center hidden">
      <div class="loader"></div>
      <p class="font-semibold text-sm m-4"> Stay here, We're searching the area... </p>
    </div>
  <div class="flex items-center justify-center">
    <p class="hidden text-2xl font-bold m-4" id="congratulations_result"></p>
  </div>
  <div id="fibre_network_providers">

  </div>
  <div id="packages_show" class="flex w-full overflow-x-scroll scrollbar-thin ">
  </div>
  <div id="fibre_network_providers_original" >
	    <div class="m-2 w-60 my-2 animate-slow-grow bg-white rounded-xl shadow-md overflow-hidden transform transition-transform hover:scale-105">
            <img class="p-2" src="' . $link_to_image . '" alt="Sunset in the mountains" style="width: 15em; height: auto;">
            <div class="p-6">
</div>


@endsection
