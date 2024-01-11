@extends('partials.navbar')

@section('content')
<div class="py-8">
    <!--- more free and premium Tailwind CSS components at https://tailwinduikit.com/ --->
        <button onclick="notificationHandler(false)" class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600 focus:outline-none  py-2 px-10 rounded bg-indigo-600 hover:bg-indigo-700 text-white">Open Modal</button>
    </div>
    <div class="w-full h-full bg-gray-800 bg-opacity-90 top-0 overflow-y-auto overflow-x-hidden fixed sticky-0" id="chec-div">
        <!--- more free and premium Tailwind CSS components at https://tailwinduikit.com/ --->
        <div class="w-full absolute z-10 right-0 h-full overflow-x-hidden transform translate-x-0 transition ease-in-out duration-700" id="notification">
            <div class="2xl:w-4/12 bg-gray-50 h-screen overflow-y-auto p-8 absolute right-0">
              

                <div class="w-full p-3 mt-8 bg-white rounded flex">
                    <div tabindex="0" aria-label="heart icon" role="img" class="focus:outline-none w-8 h-8 border rounded-full border-gray-200 flex items-center justify-center">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.00059 3.01934C9.56659 1.61334 11.9866 1.66 13.4953 3.17134C15.0033 4.68334 15.0553 7.09133 13.6526 8.662L7.99926 14.3233L2.34726 8.662C0.944589 7.09133 0.997256 4.67934 2.50459 3.17134C4.01459 1.662 6.42992 1.61134 8.00059 3.01934Z" fill="#EF4444" />
                        </svg>
                    </div>
                    <div class="pl-3">
                        <p tabindex="0" class="focus:outline-none text-sm leading-none"><span class="text-indigo-700">James Doe</span> favourited an <span class="text-indigo-700">item</span></p>
                        <p tabindex="0" class="focus:outline-none text-xs leading-3 pt-1 text-gray-500">2 hours ago</p>
                    </div>
                </div>
              
                
               
               
                <h2 tabindex="0" class="focus:outline-none text-sm leading-normal pt-8 border-b pb-2 border-gray-300 text-gray-600">YESTERDAY</h2>
                
                @foreach ($notifications as $notification)
                <div class="w-full p-3 mt-8 bg-white rounded flex">
                    <div tabindex="0" aria-label="heart icon" role="img" class="focus:outline-none w-8 h-8 border rounded-full border-gray-200 flex items-center justify-center">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.00059 3.01934C9.56659 1.61334 11.9866 1.66 13.4953 3.17134C15.0033 4.68334 15.0553 7.09133 13.6526 8.662L7.99926 14.3233L2.34726 8.662C0.944589 7.09133 0.997256 4.67934 2.50459 3.17134C4.01459 1.662 6.42992 1.61134 8.00059 3.01934Z" fill="#EF4444" />
                        </svg>
                    </div>
                    <div class="pl-3">
                        <p tabindex="0" class="focus:outline-none text-sm leading-none"><span class="text-indigo-700">
                            <a class="cursor-pointer" href="{{route('posts.show',$notification->data['url'])}}">{{$notification->data['data']}}</a>
                            {{-- <a href="{{route('posts.show',$post->uuid)}}"> --}}
                        </span></p>
                        <p tabindex="0" class="focus:outline-none text-xs leading-3 pt-1 text-gray-500">2 hours ago</p>
                    </div>
                </div>
                @endforeach
                {{-- <div class="w-full p-3 mt-8 bg-green-100 rounded flex items-center">
                    <div tabindex="0" aria-label="success icon" role="img" class="focus:outline-none w-8 h-8 border rounded-full border-green-200 flex flex-shrink-0 items-center justify-center">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.66674 10.1147L12.7947 3.98599L13.7381 4.92866L6.66674 12L2.42407 7.75733L3.36674 6.81466L6.66674 10.1147Z" fill="#047857" />
                        </svg>
                    </div>
                    <div class="pl-3 w-full">
                        <div class="flex items-center justify-between">
                            <p tabindex="0" class="focus:outline-none text-sm leading-none text-green-700">Design sprint completed</p>
                            <p tabindex="0" class="focus:outline-none focus:text-indigo-600 text-xs leading-3 underline cursor-pointer text-green-700">View</p>
                        </div>
                    </div>
                </div> --}}
               
            </div>
        </div>
    </div>
    <script>
    let notification = document.getElementById("notification");
let checdiv = document.getElementById("chec-div");
let flag3 = false;
const notificationHandler = () => {
if (!flag3) {
notification.classList.add("translate-x-full");
notification.classList.remove("translate-x-0");
setTimeout(function () {
  checdiv.classList.add("hidden");
}, 1000);
flag3 = true;
} else {
setTimeout(function () {
  notification.classList.remove("translate-x-full");
  notification.classList.add("translate-x-0");
}, 1000);
checdiv.classList.remove("hidden");
flag3 = false;
}
};
</script>
@endsection

