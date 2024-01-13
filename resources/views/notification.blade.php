@extends('partials.navbar')
@section('content')
@if($notifications->count()>0)  


<div>
    <div  class="container mx-auto mt-8">
        <div class="max-w-md mx-auto bg-white rounded-md overflow-hidden shadow-md">
            <!-- Header -->
            <div class="flex items-center justify-between px-6 py-4 bg-blue-500 text-white">
                <span class="font-semibold">Notifications</span>
                <span class="text-sm">See All</span>
            </div>

            <!-- Notification Item -->
            <div class="p-4 border-b border-gray-200">
                <!-- Icon -->
                

                <!-- Notification Content -->
                @foreach ($notifications as $notification)
                <div class="ml-3">
                    <a 
                    href="{{route('posts.show',$notification->data['url'])}}"
                    wire:navigate
                    class="text-sm font-medium text-gray-800">{{$notification->data['data']}}</a>
                    <p class="text-xs text-gray-500">{{$notification->created_at->diffForHumans()}}</p>
                </div>
                @endforeach
            </div>

            
                    </svg>
                </div>
               
            </div> 


</div>

@endif
@endsection

