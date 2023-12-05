@extends('partials.navbar')
@section('content')
    <main class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
        @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50">
            <span class="font-medium"> {{ session('success') }}</span>

        </div>
        @endif
        <form method="POST" action="{{route('posts.store')}}"
        enctype="multipart/form-data" 
            class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6 space-y-3">
            <!-- Create Post Card Top -->
            @csrf
            <div>
                <div class="flex items-start /space-x-3/">
                    <div class="flex-shrink-0">
                        <div class="flex-shrink-0">
                            <div class="flex-shrink-0">
                                <img
                                    class="h-10 w-10 rounded-full object-cover"
                                    src="{{ asset('storage/profile/images/'.(Auth::user()?->image ?? 'avartar.jpg')) }}"
                                    alt="Ahmed Shamim" />
                            </div>
                          </div>
                      </div>

                    <!-- Content -->
                    <div class="text-gray-700 font-normal w-full">
                        <textarea
                            class="block w-full p-2 pt-2 text-gray-900 rounded-lg border-none outline-none focus:ring-0 focus:ring-offset-0"
                            name="description" rows="2" placeholder="What's going on, Shamim?"></textarea>
                            @error('description')
                            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50"
                                role="alert">
                                <span class="font-medium">{{ $message }}</span>

                            </div>
                        @enderror
                    </div>
                    
                </div>
            </div>

            <!-- Create Post Card Bottom -->
            <div>
                <!-- Card Bottom Action Buttons -->
                <div class="flex items-center justify-between">
                    <div class="flex gap-4 text-gray-600">
                      <!-- Upload Picture Button -->
                      <div>
                        <input
                          type="file"
                          name="image"
                          id="picture"
                          class="hidden" />
        
                        <label
                          for="picture"
                          class="-m-2 flex gap-2 text-xs items-center rounded-full p-2 text-gray-600 hover:text-gray-800 cursor-pointer">
                          <span class="sr-only">Picture</span>
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6">
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                          </svg>
                        </label>
                      </div>
                      <!-- /Upload Picture Button -->
        
                        <!-- GIF Button -->
       
                      </div>
        
                    <div>
                      <!-- Post Button -->
                      <button
                              type="submit"
                              class="-m-2 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white">
                        Post
                      </button>
                      <!-- /Post Button -->
                    </div>
                  </div>
                <!-- /Card Bottom Action Buttons -->
            </div>
            <!-- /Create Post Card Bottom -->
        </form>
        <!-- /Barta Create Post Card -->

        <!-- Newsfeed -->
        <section id="newsfeed" class="space-y-6">
            

            <!-- Barta Card -->
            @foreach ($posts as $post)
            <article class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6">
                <!-- Barta Card Top -->
                <header>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <!-- User Avatar -->
                                            <div class="flex-shrink-0">
                                             <img
                                                class="h-10 w-10 rounded-full object-cover"
                                                src="{{ asset('storage/profile/images/'.($post->user->image ?? 'avartar.jpg')) }}"
                                               alt="Tony Stark" />
                                           </div>
                            <!-- /User Avatar -->

                            <!-- User Info -->
                            
                            <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                                
                                <a href="{{route('profile',['user'=>$post->user->username])}}" class="hover:underline font-semibold line-clamp-1">
                                    {{$post->user->name}}
                                </a>

                                <a href="{{route('profile',['user'=>$post->user->username])}}" class="hover:underline text-sm text-gray-500 line-clamp-1">
                                    @ {{$post->user->username}}
                                </a>
                            </div>
                            <!-- /User Info -->
                        </div>

                        <!-- Card Action Dropdown -->
                        <div class="flex flex-shrink-0 self-center" x-data="{ open: false }">
                            <div class="relative inline-block text-left">
                                <div>
                                    <button @click="open = !open" type="button"
                                        class="-m-2 flex items-center rounded-full p-2 text-gray-400 hover:text-gray-600"
                                        id="menu-0-button">
                                        <span class="sr-only">Open options</span>
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path
                                                d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                                <!-- Dropdown menu -->
                                @if (Auth()->user()?->id===$post->user_id)
                                <div x-show="open" @click.away="open = false"
                                    class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                    tabindex="-1">
                                    
                                       
                                        <a>
                                            <form method="POST" action="{{ route('posts.destroy',$post->uuid) }}">
                                                @csrf
                                                @method('delete')
                                                <button 
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                type="submit">Delete</button>
                                            </form>
                                        </a>
                                        <a href="{{route('posts.edit',$post->uuid)}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem" tabindex="-1" id="user-menu-item-0">Edit</a>
                                       
                                        
                                       
                                    {{-- <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                        role="menuitem" tabindex="-1" id="user-menu-item-1">Delete</a> --}}
                                </div>
                                @endif
                            </div>

                        </div>
                        <!-- /Card Action Dropdown -->
                    </div>
                </header>

                <!-- Content -->
                <div class="py-4 text-gray-700 font-normal">
                    @if($post->image)
                    <img
                      src="{{ asset('storage/images/'.$post->image) }}"
                      class="min-h-auto w-full rounded-lg object-cover max-h-64 md:max-h-72"
                      alt="" />
    
                    
                    @endif
                    <a href="{{route('posts.show',$post->uuid)}}">
                        {{$post->description}}
                   </a>
                </div>

                <!-- Date Created & View Stat -->
                <div class="flex items-center gap-2 text-gray-500 text-xs my-2">
                    <span class="">15 hours ago</span>
                    <span class="">•</span>
                    <span>4,450 views</span>
                </div>


            </article>  
            @endforeach
            

        </section>
        <!-- /Newsfeed -->
    </main>
    @include('partials.footer')
@endsection
