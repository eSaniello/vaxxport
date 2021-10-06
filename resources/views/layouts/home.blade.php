@extends('layouts.app')

@section('content')

<div>
    <div class="flex h-screen overflow-y-hidden bg-white" x-data="setup()"
        x-init="$refs.loading.classList.add('hidden')">
        <!-- Loading screen -->
        <div x-ref="loading"
            class="fixed inset-0 z-50 flex items-center justify-center text-white bg-black bg-opacity-50"
            style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)">
            Loading.....
        </div>

        <!-- Sidebar backdrop -->
        <div x-show.in.out.opacity="isSidebarOpen" class="fixed inset-0 z-10 bg-black bg-opacity-20 lg:hidden"
            style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"></div>

        <!-- Sidebar -->
        <aside x-transition:enter="transition transform duration-300"
            x-transition:enter-start="-translate-x-full opacity-30  ease-in"
            x-transition:enter-end="translate-x-0 opacity-100 ease-out"
            x-transition:leave="transition transform duration-300"
            x-transition:leave-start="translate-x-0 opacity-100 ease-out"
            x-transition:leave-end="-translate-x-full opacity-0 ease-in"
            class="fixed inset-y-0 z-10 flex flex-col flex-shrink-0 w-64 max-h-screen overflow-hidden transition-all transform bg-white border-r shadow-lg lg:z-auto lg:static lg:shadow-none"
            :class="{'-translate-x-full lg:translate-x-0 lg:w-20': !isSidebarOpen}">
            <!-- sidebar header -->
            <div class="flex items-center justify-between flex-shrink-0 p-2"
                :class="{'lg:justify-center': !isSidebarOpen}">
                <span class="p-2 text-xl font-semibold leading-8 tracking-wider uppercase whitespace-nowrap">
                    {{-- VAXX<span :class="{'lg:hidden': !isSidebarOpen}">PORT</span> --}}
                    <img src="{{ asset('img/logo.png')}}">
                </span>
                <button @click="toggleSidbarMenu()" class="p-2 rounded-md lg:hidden">
                    <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <!-- Sidebar links -->
            <nav class="flex-1 overflow-hidden hover:overflow-y-auto">
                <ul class="p-2 overflow-hidden">
                    <li class="mb-3">
                        <a href="{{ route('dashboard.index') }}"
                            class="flex items-center p-2 space-x-2 rounded-md hover:bg-gray-100"
                            :class="{'justify-center': !isSidebarOpen}">
                            <span>
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke='grey' stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Dashboard</span>
                        </a>
                    </li>
                    @if (auth()->user() != null)
                    @if (auth()->user()->type == 'admin')
                    <li class="mb-3">
                        <a href="{{ route('vaccine.index') }}"
                            class="flex items-center p-2 space-x-2 rounded-md hover:bg-gray-100"
                            :class="{'justify-center': !isSidebarOpen}">
                            <span><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke="grey" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                                    </path>
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Pending COVID data</span>
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('infection.index') }}"
                            class="flex items-center p-2 space-x-2 rounded-md hover:bg-gray-100"
                            :class="{'justify-center': !isSidebarOpen}">
                            <span><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke="grey" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">Pending infections data</span>
                        </a>
                    </li>
                    <li class="mb-3">
                        <a href="{{ route('user.index') }}"
                            class="flex items-center p-2 space-x-2 rounded-md hover:bg-gray-100"
                            :class="{'justify-center': !isSidebarOpen}">
                            <span>
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke="grey" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                            </span>
                            <span :class="{ 'lg:hidden': !isSidebarOpen }">User Management</span>
                        </a>
                    </li>
                    @endif
                    @endif
                    <!-- Sidebar Links... -->
                </ul>
            </nav>
            <!-- Sidebar footer -->
            <div class="flex-shrink-0 p-2 border-t max-h-14">
                <form action="{{ route('logout') }}" method="POST" class="">
                    @csrf
                    <button type="submit"
                        class="flex items-center justify-center w-full px-4 py-2 space-x-1 font-medium tracking-wider uppercase bg-gray-100 border rounded-md focus:outline-none focus:ring">
                        <span>
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </span>
                        <span :class="{'lg:hidden': !isSidebarOpen}"> Logout </span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex flex-col flex-1 h-full overflow-hidden">
            <!-- Navbar -->
            <header class="flex-shrink-0 border-b">
                <div class="flex items-center justify-between p-2">
                    <!-- Navbar left -->
                    <div class="flex items-center space-x-3">
                        <span class="p-2 text-xl font-semibold tracking-wider uppercase lg:hidden">
                            VAXXPORT
                        </span>
                        <!-- Toggle sidebar button -->
                        <button @click="toggleSidbarMenu()" class="p-2 rounded-md focus:outline-none focus:ring">
                            <svg class="w-4 h-4 text-gray-600"
                                :class="{'transform transition-transform -rotate-180': isSidebarOpen}"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </header>


            @yield('home')


            <!-- Main footer -->
            <footer class="flex items-center justify-between flex-shrink-0 p-4 border-t max-h-14">
                <div>VAXXPORT &copy; 2021</div>
                <div class="text-sm">
                    <a href="https://github.com/eSaniello" target="_blank" class="text-green-500 font-semibold"
                        rel="noopener noreferrer">
                        BITS PLEASE 💚
                    </a>
                </div>
            </footer>
        </div>

    </div>
    <script>
        const setup = () => {
            return {
                loading: true,
                isSidebarOpen: false,
                toggleSidbarMenu() {
                this.isSidebarOpen = !this.isSidebarOpen
                },
                isSettingsPanelOpen: false,
                isSearchBoxOpen: false,
            }
        }
    </script>
</div>
@endsection