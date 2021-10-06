@extends('layouts.home')

@section('home')

<!-- Main content -->
<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
    <!-- Main content header -->
    <div
        class="flex flex-col items-start justify-between pb-6 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <h1 class="text-2xl font-semibold whitespace-nowrap">User Management</h1>
    </div>

    <!-- Table see (https://tailwindui.com/components/application-ui/lists/tables) -->
    <h3 class="mt-6 text-xl mb-6"></h3>
    <a class="mt-6 mb-6 border border-gray-300 text-gray-700 rounded-md px-4 py-2 m-2 transition duration-500 ease-out select-none hover:bg-gray-300 focus:outline-none text-sm"
        href="{{ route('dashboard.index') }}">Back
    </a>
    <a class="mt-6 mb-6 border border-green-300 text-green-700 rounded-md px-4 py-2 m-2 transition duration-500 ease-out select-none hover:bg-green-300 focus:outline-none text-sm"
        href="{{ route('user.create') }}">Create New User
    </a>
    <h3 class="mt-6 text-xl mb-6"></h3>

    @if ($message = Session::get('success'))
    <div class="bg-green-500 p-4 rounded-lg mb-1 mt-8 text-white text-center">
        {{ $message }}
    </div>
    @endif

    <div class="flex flex-col mt-2">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden border-b border-gray-200 rounded-md shadow-md">
                    <table class="min-w-full overflow-x-scroll divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Name</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    E-ID</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Email</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Mobile</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Address</th>
                                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Edit</span></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $key => $user)
                            <tr class="transition-all hover:bg-gray-100 hover:shadow-lg">
                                <td
                                    class="px-6 py-4 text-lg {{ $user->type == 'admin' ? 'text-green-500 font-semibold' : 'text-gray-500' }} whitespace-nowrap">
                                    {{ $user->firstname . ' ' . $user->lastname }}
                                </td>
                                <td class="px-6 py-4 text-lg text-gray-500 whitespace-nowrap">
                                    {{ $user->e_id_number }}
                                </td>
                                <td class="px-6 py-4 text-lg text-gray-500 whitespace-nowrap">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 text-lg text-gray-500 whitespace-nowrap">
                                    {{ $user->mobile }}
                                </td>
                                <td class="px-6 py-4 text-lg text-gray-500 whitespace-nowrap">
                                    {{ $user->address }}
                                </td>
                                <td class="py-4 text-sm font-medium text-right whitespace-nowrap flex justify-center">
                                    <a href="{{ route('make_admin',$user->id) }}"
                                        class="border border-blue-500 text-blue-500 rounded-md px-4 py-2 m-2 transition duration-500 ease-out select-none hover:text-white hover:bg-blue-600 focus:outline-none">
                                        {{ $user->type == 'user' ? 'Make admin' : 'Make user' }}
                                    </a>
                                    <a href="{{ route('user.show',$user->id) }}"
                                        class="border border-green-500 text-green-500 rounded-md px-4 py-2 m-2 transition duration-500 ease-out select-none hover:text-white hover:bg-green-600 focus:outline-none">
                                        View
                                    </a>
                                    <a href="{{ route('user.edit',$user->id) }}"
                                        class="border border-yellow-500 text-yellow-500 rounded-md px-4 py-2 m-2 transition duration-500 ease-out select-none hover:text-white hover:bg-yellow-600 focus:outline-none">
                                        Edit
                                    </a>
                                    {!! Form::open(['method' => 'DELETE','route' => ['user.destroy',
                                    $user->id],'style'=>'']) !!}
                                    {!! Form::submit('Delete', ['class' => 'border border-red-500 text-red-500
                                    rounded-md px-4 py-2 m-2 transition duration-500 ease-out select-none
                                    hover:text-white hover:bg-red-600 focus:outline-none bg-white cursor-pointer'])
                                    !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</main>

@endsection