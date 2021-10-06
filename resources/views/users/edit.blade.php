@extends('layouts.app')

@section('content')
<div class="flex items-center h-screen w-full justify-center bg-gray-50">
    <div class="max-w-sm">
        <div class="bg-white shadow-xl rounded-lg p-12">
            <div>
                <img class="mx-auto h-22 w-auto" src="{{ asset('img/logo.png') }}" alt="LOGO">
                <h2 class="mt-6 text-center text-2xl font-extrabold text-gray-900">
                    Edit account
                </h2>
            </div>

            <div class="mt-8 space-y-6">
                {!! Form::model($user, ['files'=>true, 'method' => 'PATCH','route' =>
                ['user.update',$user->id]]) !!}
                @csrf

                @if (session('status'))
                <div class="bg-red-500 p-4 rounded-lg mb-6 text-white-text-center">
                    {{ session('status') }}
                </div>
                @endif

                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <label for="email-address" class="sr-only">Firstname</label>
                        <input type="text" class="@error('firstname') border-red-500 @enderror appearance-none rounded-none
                    relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900
                    rounded-t-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                            name="firstname" id="firstname" placeholder="Firstname" value="{{ $user->firstname }}">

                        @error('firstname')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="email-address" class="sr-only">Lastname</label>
                        <input type="text" class="@error('lastname') border-red-500 @enderror appearance-none rounded-none
                    relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900
                    focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                            name="lastname" id="lastname" placeholder="Lastname" value="{{ $user->lastname }}">

                        @error('lastname')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="email-address" class="sr-only">E-ID Number</label>
                        <input type="text" class="@error('e_id_number') border-red-500 @enderror appearance-none rounded-none
                    relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900
            focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm" name="e_id_number"
                            id="e_id_number" placeholder="E-ID Number" value="{{ $user->e_id_number }}">

                        @error('e_id_number')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="email-address" class="sr-only">Mobile</label>
                        <input type="number" class="@error('mobile') border-red-500 @enderror appearance-none rounded-none
                    relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900
                focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm" name="mobile"
                            id="mobile" placeholder="Mobile" value="{{ $user->mobile }}">

                        @error('mobile')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="email-address" class="sr-only">Address</label>
                        <input type="text" class="@error('address') border-red-500 @enderror appearance-none rounded-none
                    relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900
                focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm" name="address"
                            id="address" placeholder="Address" value="{{ $user->address }}">

                        @error('address')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="email-address" class="sr-only">Email address</label>
                        <input type="email" class="@error('email') border-red-500 @enderror appearance-none rounded-none
                    relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900
                    focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm" name="email"
                            id="email" placeholder="Email" value="{{ $user->email }}">

                        @error('email')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="sr-only">(optional) New Password</label>
                        <input type="password"
                            class="@error('password') border-red-500 @enderror appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                            name="password" id="password" placeholder="(optional) Password">

                        @error('password')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="sr-only">(optional) Repeat New Password</label>
                        <input type="password"
                            class="@error('repeat_password') border-red-500 @enderror appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm"
                            name="repeat_password" id="repeat_password" placeholder="(optional) Repeat Password">

                        @error('repeat_password')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <br>
                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <!-- Heroicon name: lock-closed -->
                            <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        Update Account
                    </button>
                </div>
                <br>
                <div>
                    <a href="{{ route('user.index') }}"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Back
                    </a>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>
@endsection