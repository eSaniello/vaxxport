@extends('layouts.home')

@section('home')
<style>
    [x-cloak] {
        display: none;
    }

    .duration-300 {
        transition-duration: 300ms;
    }

    .ease-in {
        transition-timing-function: cubic-bezier(0.4, 0, 1, 1);
    }

    .ease-out {
        transition-timing-function: cubic-bezier(0, 0, 0.2, 1);
    }

    .scale-90 {
        transform: scale(.9);
    }

    .scale-100 {
        transform: scale(1);
    }
</style>

<!-- Main content -->
<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll"
    x-data="{ 'showModal': false, 'showModal_cam': false }" @keydown.escape="showModal = false; showModal_cam = false"
    x-cloak>
    <!-- Main content header -->
    <div
        class="flex flex-col items-start justify-between pb-6 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <h1 class="text-2xl font-semibold whitespace-nowrap">Home</h1>
    </div>

    <!-- Start Content -->
    <div class="grid grid-cols-1 gap-5 mt-6 sm:grid-cols-2 lg:grid-cols-3">
        <button type="button" @click="showModal_cam = true">
            <div class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start justify-between">
                    <div class="flex flex-col space-y-2">
                        <span class="text-3xl font-semibold">Scan</span>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-md">
                        <img class="object-fill w-32 h-32" src="{{url('/img/scan.svg')}}" alt="Image">
                    </div>
                </div>
            </div>
        </button>
        <a href="{{ route('login') }}" class="cursor-pointer">
            <div class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start justify-between">
                    <div class="flex flex-col space-y-2">
                        <span class="text-3xl font-semibold">Log In</span>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-md">
                        <img class="object-fill w-32 h-32" src="{{url('/img/login.svg')}}" alt="Image">
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('user.create') }}" class="cursor-pointer">
            <div class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start justify-between">
                    <div class="flex flex-col space-y-2">
                        <span class="text-3xl font-semibold">Create Account</span>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-md">
                        <img class="object-fill w-32 h-32" src="{{url('/img/signup.svg')}}" alt="Image">
                    </div>
                </div>
            </div>
        </a>
    </div>


    <!--Overlay cam-->
    <div class="overflow-auto" x-show="showModal_cam"
        :class="{ 'absolute inset-0 z-10 flex items-center justify-center': showModal_cam }">
        <!--Dialog-->
        <div class="bg-white w-12/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" x-show="showModal_cam"
            @click.away="showModal_cam = false" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90">

            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">Scan code!</p>
                <div class="cursor-pointer z-50" @click="showModal_cam = false">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </div>
            </div>

            <!-- content -->
            <div class="flex flex-wrap content-center p-4">
                <div>
                    <video id="preview"></video>
                </div>
            </div>
        </div>
        <!--/Dialog -->
    </div><!-- /Overlay -->


    <br>

    <iframe class="w-full h-full bg-white"
        src="https://datastudio.google.com/embed/reporting/49f7d3ef-1894-48d8-9f79-54f8613e1dce/page/igSUC"
        loading="lazy" frameborder="0" allowfullscreen="allowfullscreen">
    </iframe>
</main>
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script>
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview'), mirror: false  });
    Instascan.Camera.getCameras().then(function (cameras) {
    if (cameras.length > 0) { 
        var selectedCam = cameras[0];
        $.each(cameras, (i, c) => {
            if (c.name.indexOf('back') != -1) {
                selectedCam = c;
                return false;
            }
        });

        scanner.start(selectedCam);
    } else {
        console.error('No cameras found.');
    }
    }).catch(function (e) {
    console.error(e);
    });

    scanner.addListener('scan', function (content) {
        if(isValidHttpUrl(content)){
            window.location.href = content;
        }else {
            alert("Not a valid QR code");
        }
    });

    function isValidHttpUrl(string) {
    let url;

    try {
    url = new URL(string);
    } catch (_) {
    return false;  
    }

    return url.protocol === "http:" || url.protocol === "https:";
    }
</script>
@endsection