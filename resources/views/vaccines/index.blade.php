@extends('layouts.home')

@section('home')

<!-- Main content -->
<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
    <!-- Main content header -->
    <div
        class="flex flex-col items-start justify-between pb-6 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <h1 class="text-2xl font-semibold whitespace-nowrap">Pending Vaccines Data</h1>
    </div>

    <!-- Table see (https://tailwindui.com/components/application-ui/lists/tables) -->
    <h3 class="mt-6 text-xl mb-6"></h3>
    <a class="mt-6 mb-6 border border-gray-300 text-gray-700 rounded-md px-4 py-2 m-2 transition duration-500 ease-out select-none hover:bg-gray-300 focus:outline-none text-sm"
        href="{{ route('dashboard.index') }}">Back
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
                                    Person</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    E-ID</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Vaccine</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                    Date</th>
                                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Edit</span></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($vaccines as $key => $vaccine)
                            <tr class="transition-all hover:bg-gray-100 hover:shadow-lg">
                                <td class="px-6 py-4 text-lg text-gray-500 whitespace-nowrap">
                                    @foreach ($users as $user)
                                    @if ($vaccine->user_id == $user->id)
                                    {{ $user->firstname . ' ' . $user->lastname }}
                                    @endif
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 text-lg text-gray-500 whitespace-nowrap">
                                    @foreach ($users as $user)
                                    @if ($vaccine->user_id == $user->id)
                                    {{ $user->e_id_number }}
                                    @endif
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 text-lg text-gray-500 whitespace-nowrap">{{ $vaccine->name }}</td>
                                <td class="px-6 py-4 text-lg text-gray-500 whitespace-nowrap">
                                    {{ Carbon\Carbon::parse($vaccine->date)->format('d M Y') }}</td>
                                <td class="py-4 text-sm font-medium text-right whitespace-nowrap flex justify-center">
                                    <a href="{{ route('vaccine.edit',$vaccine->id) }}"
                                        class="border border-green-500 text-green-500 rounded-md px-4 py-2 m-2 transition duration-500 ease-out select-none hover:text-white hover:bg-green-600 focus:outline-none">Approve</a>
                                    {!! Form::open(['method' => 'DELETE','route' => ['vaccine.destroy',
                                    $vaccine->id],'style'=>'']) !!}
                                    {!! Form::submit('Reject', ['class' => 'border border-red-500 text-red-500
                                    rounded-md px-4 py-2 m-2 transition duration-500 ease-out select-none
                                    hover:text-white hover:bg-red-600 focus:outline-none bg-white cursor-pointer'])
                                    !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $vaccines->links() }}
                </div>
            </div>
        </div>
    </div>
</main>

@endsection