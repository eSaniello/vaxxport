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
        <h1 class="text-2xl font-semibold whitespace-nowrap">{{ auth()->user()->type == 'admin' ? 'Admin' : 'User' }}
            Dashboard - {{ auth()->user()->firstname }}</h1>
    </div>

    <!-- Start Content -->
    <div class="grid grid-cols-1 gap-5 mt-6 sm:grid-cols-2 lg:grid-cols-4">
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
        <button type="button" @click="showModal = true">
            <div class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start justify-between">
                    <div class="flex flex-col space-y-2">
                        <span class="text-3xl font-semibold">Show your QR-code</span>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-md">
                        <img class="object-fill w-32 h-32" src="{{url('/img/show.svg')}}" alt="Image">
                    </div>
                </div>
            </div>
        </button>
        <a href="{{ route('vaccine.create') }}" class="cursor-pointer">
            <div class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start justify-between">
                    <div class="flex flex-col space-y-2">
                        <span class="text-3xl font-semibold">Insert vaccine data</span>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-md">
                        <img class="object-fill w-32 h-32" src="{{url('/img/vaccine.svg')}}" alt="Image">
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('infection.create') }}" class="cursor-pointer">
            <div class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
                <div class="flex items-start justify-between">
                    <div class="flex flex-col space-y-2">
                        <span class="text-3xl font-semibold">Insert COVID infection data</span>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-md">
                        <img class="object-fill w-32 h-32" src="{{url('/img/infection.svg')}}" alt="Image">
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Two columns grid -->
    <div class="grid grid-cols-1 gap-6 mt-6 lg:grid-cols-2 xl:grid-cols-4">
        <!-- Import data card -->
        <div class="border rounded-lg shadow-sm xl:col-span-2">
            <!-- Card header -->
            <div class="flex items-center justify-between px-4 py-2 border-b">
                <h5 class="font-semibold">Vaccines u have taken</h5>
            </div>
            <!-- Card content -->
            <div class="flex items-center p-4 space-x-4">
                <table
                    class="w-full overflow-x-scroll divide-y divide-gray-200 border-b border-gray-200 rounded-md shadow-md overflow-x-scroll">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Vaccine</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($vaccines as $key => $vaccine)
                        <tr class="transition-all hover:bg-gray-100 hover:shadow-lg">
                            <td
                                class="px-6 py-4 font-semibold text-lg {{$vaccine->approved == true ? 'text-green-500' : 'text-red-500' }} whitespace-nowrap">
                                {{ $vaccine->name }}</td>
                            <td
                                class="px-6 py-4 text-lg font-semibold text-lg {{$vaccine->approved == true ? 'text-green-500' : 'text-red-500' }} whitespace-nowrap">
                                {{ Carbon\Carbon::parse($vaccine->date)->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $infections->links() }}
            </div>
        </div>

        <!-- Monthly chart card -->
        <div class="border rounded-lg shadow-sm xl:col-span-2">
            <!-- Card header -->
            <div class="flex items-center justify-between px-4 py-2 border-b">
                <h5 class="font-semibold">Times u have gotten COVID</h5>
            </div>
            <!-- Card content -->
            <div class="flex items-center p-4 space-x-4">
                <table
                    class="w-full overflow-x-scroll divide-y divide-gray-200 border-b border-gray-200 rounded-md shadow-md">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                Day u got sick</th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                End date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($infections as $key => $infection)
                        <tr class="transition-all hover:bg-gray-100 hover:shadow-lg">
                            <td
                                class="px-6 py-4 text-lg font-semibold text-lg {{$infection->approved == true ? 'text-green-500' : 'text-red-500' }} whitespace-nowrap">
                                {{ Carbon\Carbon::parse($infection->start_date)->format('d M Y') }}</td>
                            <td
                                class="px-6 py-4 text-lg font-semibold text-lg {{$infection->approved == true ? 'text-green-500' : 'text-red-500' }} whitespace-nowrap">
                                {{ Carbon\Carbon::parse($infection->end_date)->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $infections->links() }}
            </div>
        </div>
    </div>


    <!--Overlay QR-->
    <div class="overflow-auto" x-show="showModal"
        :class="{ 'absolute inset-0 z-10 flex items-center justify-center': showModal }">
        <!--Dialog-->
        <div class="bg-white w-12/12 md:max-w-md mx-auto rounded shadow-lg py-4 text-left px-6" x-show="showModal"
            @click.away="showModal = false" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90">

            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">Scan me!</p>
                <div class="cursor-pointer z-50" @click="showModal = false">
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
                    {!!
                    QrCode::eye('circle')->style('round')->color(7,180,148)->size(250)->generate(url('/').'/qr_code/'
                    . auth()->user()->id);
                    !!}
                </div>
            </div>
        </div>
        <!--/Dialog -->
    </div><!-- /Overlay -->


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