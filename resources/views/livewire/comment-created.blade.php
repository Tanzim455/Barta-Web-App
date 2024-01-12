<div>
    {{-- Stop trying to control. --}}
    @if (session()->has('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50">
        {{ session('success') }}
    </div>
      @endif
    <form
            wire:submit.prevent="save">
            
            <!-- Create Comment Card Top -->
            
              <div class="flex items-start /space-x-3/">
                <!-- User Avatar -->
                <!-- <div class="flex-shrink-0">-->
                <!--              <img-->
                <!--                class="h-10 w-10 rounded-full object-cover"-->
                <!--                src="https://avatars.githubusercontent.com/u/831997"-->
                <!--                alt="Ahmed Shamim" />-->
                <!--            </div> -->
                <!-- /User Avatar -->

                <!-- Auto Resizing Comment Box -->
                <div class="text-gray-700 font-normal w-full">
                  <textarea
                    x-data="{
                          resize () {
                              $el.style.height = '0px';
                              $el.style.height = $el.scrollHeight + 'px'
                          }
                      }"
                    x-init="resize()"
                    @input="resize()"
                    type="text"
                    wire:model="description"
                    placeholder="Write a comment..."
                    class="flex w-full h-auto min-h-[40px] px-3 py-2 text-sm bg-gray-100 focus:bg-white border border-sm rounded-lg border-neutral-300 ring-offset-background placeholder:text-neutral-400 focus:border-neutral-300 focus:outline-none focus:ring-1 focus:ring-offset-0 focus:ring-neutral-400 disabled:cursor-not-allowed disabled:opacity-50 text-gray-900"></textarea>
                    <input type="hidden" id="post_id" wire:model="post_id" class="post-id" >
                    
                
                  </div> 
              </div>
           

            <!-- Create Comment Card Bottom -->
            <div>
              <!-- Card Bottom Action Buttons -->
              <div class="flex items-center justify-end">
                <button
                  type="submit"
                  class="mt-2 flex gap-2 text-xs items-center rounded-full px-4 py-2 font-semibold bg-gray-800 hover:bg-black text-white">
                  Comment
                </button>
              </div>
              <!-- /Card Bottom Action Buttons -->
            </div>
            <!-- /Create Comment Card Bottom -->
          </form>
          
</div>
