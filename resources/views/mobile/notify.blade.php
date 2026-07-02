@extends('welcome')

@section('content')

@if(Auth::check())
    <!-- Content for authenticated users -->
        @include('layouts.navbar')
@else
    <!-- If not authenticated, redirect to login -->
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endif

<div class="max-w-4xl mx-auto bg-white rounded-lg">

                    @if(Auth::check())

                            <form id="send-push-notification" action="#" method="POST">
                                <div class="my-4">
                                    @csrf
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Android Push notification Service</label>
                                    <textarea name="description" id="description" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Write your promotion."></textarea>
				   @error('description')
                                    <p class="text-red-600 mt-1">{{ $message }}</p>
                                    @enderror

				<div class="grid w-full">
				 <div class="relative z-0 w-full mb-5 group">
	           			 <label for="options" class="block text-gray-700 mb-2">Select Device</label>
	               			   <select id="options" name="position" class=" focus:ring-blue-300 font-medium rounded-lg  w-full px-5 py-2.5 text-left dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 block border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:">
					    <option value="All">All Devices</option>
    
						    @foreach($devices as $device)
						        <option value="{{ $device->device_id }}">
						            {{ $device->device_name }} ({{ $device->platform }}) ({{ $device->expo_push_token}}) ({{$device->updated_at}})
						        </option>
						    @endforeach
					  </select>

        			        @error('position')
        			        <p class="text-red-600  mt-1">{{ $message }}</p>
        			        @enderror
        		 	   </div>
				</div>
                                    <button class="text-right rounded-full text-right shadow-lg px-2 text-sm py-2"> Send </button>
                                </div>
                            </form>
			@endif
</div>
@endsection
