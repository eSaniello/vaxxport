@extends('layouts.home')

@section('home')

<!-- Main content -->
<main class="flex-1 max-h-full p-5 overflow-hidden overflow-y-scroll">
    <!-- Main content header -->
    <div
        class="flex flex-col items-start justify-between pb-6 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
        <h1 class="mx-auto text-3xl font-semibold whitespace-nowrap">
            @if ($status == 'full_vax')
            🎉Fully vaccinated🎉
            @elseif($status == 'part_vax')
            🙃Partially vaccinated🙃
            @elseif($status == 'none')
            ❌Not vaccinated❌
            @endif
        </h1>
    </div>

    <!-- Table see (https://tailwindui.com/components/application-ui/lists/tables) -->
    <h3 class="mt-6 text-xl mb-6"></h3>

    @if ($message = Session::get('success'))
    <div class="bg-green-500 p-4 rounded-lg mb-1 mt-8 text-white text-center">
        {{ $message }}
    </div>
    @endif

    <div class="flex flex-col mt-6">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden border-b border-gray-200 rounded-md shadow-md">
                    <div class="p-6">
                        <h3 class="mt-2 text-xl mb-6">Personal Information</h3>
                        <div class="flex flex-col mb-4">
                            <label for="name" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                Firstname
                            </label>
                            <div class="relative">
                                <input type="text" class="text-sm
                                sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400
                                focus:outline-none py-2 pr-2 pl-2text-sm
                                sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400
                                focus:outline-none py-2 pr-2 pl-2" name="work_location" value="{{ $user->firstname }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="name" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                Lastname
                            </label>
                            <div class="relative">
                                <input type="text" class="text-sm
                                sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400
                                focus:outline-none py-2 pr-2 pl-2text-sm
                                sm:text-base relative w-full border rounded placeholder-gray-400 focus:border-indigo-400
                                focus:outline-none py-2 pr-2 pl-2" name="work_location" value="{{ $user->lastname }}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col mt-6">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden border-b border-gray-200 rounded-md shadow-md">
                    <div class="p-6">
                        <h3 class="mt-2 text-xl mb-6">Vaccines</h3>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col mt-6">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden border-b border-gray-200 rounded-md shadow-md">
                    <div class="p-6">
                        <h3 class="mt-2 text-xl mb-6">COVID Infections</h3>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection