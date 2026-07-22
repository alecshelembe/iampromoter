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

                            <form id="send-push-notification" id="send-push-notification" action="{{ route('notifications.send') }}" method="POST">
                                <div class="my-4">
                                    @csrf
				    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Notification Title</label>
                                    <input type="text" id="title" name="title" placeholder ="Heading" value="" class="w-full px-4 mb-2 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Title" />
                                    @error('title')
                                    <p class="text-red-600 mt-1">{{ $message }}</p>
                                    @enderror

                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                    <textarea name="description" id="description" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Write your promotion. Eg: R 20 off Chips"></textarea>
				   @error('description')
                                    <p class="text-red-600 mt-1">{{ $message }}</p>
                                    @enderror

				<div class="grid w-full">
				 <div class="relative z-0 w-full mb-5 group">
	           			 <label for="options" class="block text-gray-700 mb-2">Select Device</label>
	               			   <select id="options" name="device" class=" focus:ring-blue-300 font-medium rounded-lg  w-full px-5 py-2.5 text-left dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 block border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:">
					    <option value="All">-All Unavalable - use terminal command)</option>
    
						    @foreach($devices as $device)
						        <option value="{{ $device->expo_push_token }}">
						            {{ $device->device_name }} ({{ $device->platform }}) ({{ $device->expo_push_token}}) ({{$device->updated_at}})
						        </option>
						    @endforeach
					  </select>

        			        @error('position')
        			        <p class="text-red-600  mt-1">{{ $message }}</p>
        			        @enderror

					 		@if(session('success'))
						    <div class="mt-4 rounded bg-green-100 border border-green-400 text-green-700 px-4 py-3">
						        {{ session('success') }}
						    </div>
						@endif
						
						@if(session('error'))
						    <div class="mt-4 rounded bg-red-100 border border-red-400 text-red-700 px-4 py-3">
						        {{ session('error') }}
						    </div>
						@endif
        		 	   </div>
				</div>
                                    <button class="text-right rounded-full text-right shadow-lg px-2 text-sm py-2"> Send </button>
                                </div>
                            </form>
			@endif
</div>
@endsection
