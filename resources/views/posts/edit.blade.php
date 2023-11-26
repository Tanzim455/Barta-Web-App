@extends('partials.navbar')
@section('content')
    <main class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
        @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50">
            <span class="font-medium"> {{ session('success') }}</span>

        </div>
        @endif
        <form method="POST" action="{{route('posts.update',$post->uuid)}}" 
            class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-5 sm:px-6 space-y-3">
            <!-- Create Post Card Top -->
            @csrf
            @method('patch')
            <div>
                <div class="flex items-start /space-x-3/">


                    <!-- Content -->
                    <div class="text-gray-700 font-normal w-full">
                        <textarea
                            class="block w-full p-2 pt-2 text-gray-900 rounded-lg border-none outline-none focus:ring-0 focus:ring-offset-0"
                            name="description" rows="2" placeholder="What's going on, Shamim?">
                         {{$post->description}}
                        </textarea>
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
                <div class="flex items-center justify-end">


                    <div>
                        <!-- Post Button -->
                        <button type="submit"
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
          
            

        </section>
        <!-- /Newsfeed -->
    </main>
    @include('partials.footer')
@endsection
