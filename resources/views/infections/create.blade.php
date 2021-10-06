@extends('layouts.home')

@section('home')

<!-- Main content -->
<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
    <!-- Main content header -->
    <div
        class="flex flex-col items-start justify-between pb-6 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <h1 class="text-2xl font-semibold whitespace-nowrap">When were you sick?</h1>
    </div>

    <!-- Table see (https://tailwindui.com/components/application-ui/lists/tables) -->
    <h3 class="mt-6 text-xl mb-6"></h3>
    <a class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease-out select-none hover:bg-green-600 focus:outline-none w-full -ml-1 mt-2 text-xl text-sm"
        href="{{ route('dashboard.index') }}">Back</a>

    <div class="flex flex-col mt-6">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden border-b border-gray-200 rounded-md shadow-md">
                    <div class="p-6">
                        @if ($errors->any())
                        <div class="bg-red-500 p-4 rounded-lg mb-1 text-white">
                            <p class="text-center">
                                <strong>Whoops!</strong> There were some problems with your input.</p>
                            <br><br>

                            @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                            @endforeach
                        </div>
                        @endif

                        {!! Form::open(array('route' => 'infection.store','method'=>'POST', 'files'=>true)) !!}
                        <div class="flex flex-col mb-4">
                            <label for="name" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                The day u got sick
                            </label>
                            <div class="relative">
                                {!! Form::date('start_date', null, array('placeholder' => 'Name','class' => 'text-sm
                                sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400
                                focus:outline-none py-2 pr-2 pl-2'))
                                !!}
                            </div>
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="name" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                The day u got better
                            </label>
                            <div class="relative">
                                {!! Form::date('end_date', null, array('placeholder' => 'Name','class' => 'text-sm
                                sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400
                                focus:outline-none py-2 pr-2 pl-2'))
                                !!}
                            </div>
                        </div>

                        <button type="submit"
                            class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease-out select-none hover:bg-green-600 focus:outline-none w-full -ml-1 mt-2 text-xl">
                            Insert</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection