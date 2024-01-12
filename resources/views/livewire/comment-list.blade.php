<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    Comments -{{$count}}
    <div class="flex flex-col space-y-6">
        
        @if(isset($postWithComments) && !empty($postWithComments))
          @foreach ($postWithComments as $comment)
          <article
            class="bg-white border-2 border-black rounded-lg shadow mx-auto max-w-none px-4 py-2 sm:px-6 min-w-full divide-y">
            <!-- Comments -->

            <!-- Comment 1 -->
           
            <div class="py-4">
              <!-- Barta User Comments Top -->
              <header>
                <div class="flex items-center justify-between">
                  <div class="flex items-center space-x-3">
                    <!-- User Info -->
                    <div class="text-gray-900 flex flex-col min-w-0 flex-1">
                      <a
                      href="{{route('profile',['user'=>$comment->user->username])}}"
                        class="hover:underline font-semibold line-clamp-1">
                         {{$comment->user->name}}
                      </a>

                      <a
                      href="{{route('profile',['user'=>$comment->user->username])}}"
                        class="hover:underline text-sm text-gray-500 line-clamp-1">
                        @ {{$comment->user->username}}
                      </a>
                    </div>
                    <!-- /User Info -->
                  </div>
                </div>
              </header>

              <!-- Content -->
              <div class="py-4 text-gray-700 font-normal">
                <p>{{$comment->description}}</p>
              </div>

              <!-- Date Created -->
              <div class="flex items-center gap-2 text-gray-500 text-xs">
                <span class="">6m ago</span>
              </div>
            </div> 
           
           
          </article>
          @endforeach
          @endif

    </div>
</div>
