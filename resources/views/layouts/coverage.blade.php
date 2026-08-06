@extends('welcome')

@section('content')

<div class ="max-w-6xl mx-auto p-4 bg-gray-50 rounded-lg shadow-lg mt-10" id="main-form">
  <p class="font-bold text-2xl text-center p-2">Coverage Search </p>
  <p for="address-input" id="Enter_address" class="text-xl text-center p-2">Enter coordinates to get started </p>
      <div class="flex justify-center">
	<input type="text" id="address-input" placeholder="Enter a street name" class="hidden text-center rounded-xl shadow-md w-3/4 text-black my-4 py-2 ">
	<input type="text" id="google_location" class=" hidden text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
      <input type="text" id="google_location_type" class=" hidden text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
      <input type="text" id="google_postal_code" class=" hidden text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
      <input type="text" id="google_city" class=" hidden text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
      <input type="text" id="package_selected" class=" hidden text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
      <input type="text" id="web_source" class=" hidden text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
      <input type="text" id="location_id" class=" hidden text-center rounded-xl shadow-md w-2/3 text-black my-4 py-2 ">
     </div>
	<div class="flex flex-col md:flex-row justify-center items-center">
		<input type="text" id="google_latitude" placeholder="Lat" class=" text-center rounded-xl shadow-md text-black m-2 py-2 ">
		<input type="text" id="google_longitude" placeholder="lng" class=" text-center rounded-xl shadow-md text-black m-2 py-2 ">
	<button class="bg-blue-400 text-white btn-sm m-2 py-2 px-2 rounded-full hover:bg-blue-600" id="checkButton">Start Looking</button>
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
  <div id="fibre_network_providers_original" class="flex justify-center">
	<div class="m-2 w-60 my-2 animate-slow-grow bg-white rounded-xl shadow-md overflow-hidden transform transition-transform hover:scale-105">
            <img class="p-2" src="{{ Storage::url('demo-images/assets/metrofibre.png') }}" alt="Metrofibrelogo" style="width: 15em; height: auto;">
	</div>
	<div class="m-2 w-60 my-2 animate-slow-grow bg-white rounded-xl shadow-md overflow-hidden transform transition-transform hover:scale-105">
            <img class="p-2" src="{{ Storage::url('demo-images/assets/frogfoot.png') }}" alt="frogfootlogo" style=>
	</div>
</div>

<script>

$(document).ready(function () {

    $('#checkButton').on('click', function () {

        let latitude = $('#google_latitude').val();
        let longitude = $('#google_longitude').val();

        // MetroFibre
        $.ajax({
            url: '/search-metrofibre',
            type: 'GET',
            data: {
                latitude: latitude,
                longitude: longitude
            },
            success: function (response) {
                console.log('MetroFibre:', response);
            },
            error: function (xhr) {
                console.error('MetroFibre Error:', xhr.responseText);
            }
        });

        // Frogfoot
        $.ajax({
            url: '/search-frogfoot1',
            type: 'GET',
            data: {
                latitude: latitude,
                longitude: longitude
            },
            success: function (response) {
                console.log('Frogfoot:', response);
            },
            error: function (xhr) {
                console.error('Frogfoot Error:', xhr.responseText);
            }
        });

    });

});

</script>
@endsection
