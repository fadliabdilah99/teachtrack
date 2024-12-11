<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{-- sweetalert --}}
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets') }}/images/logos/favicon.png" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css" />
    <!-- Core Css -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>
        @yield('title')
    </title>
    @vite('resources/css/app.css')
    @livewireStyles

    @stack('style')
    @livewireStyles
</head>

<body>

    <main>
        <!--start the project-->
        <div id="main-wrapper" class="flex p-5 xl:pr-0">
            <aside id="application-sidebar-brand"
                class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transform hidden xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 fixed xl:top-5 xl:left-auto top-0 rounded-xl left-0 with-vertical h-screen z-[999] shrink-0 w-[270px] shadow-md rounded bg-white left-sidebar transition-all duration-300">
                <!-- Profile Section -->
                <div class="flex flex-col items-center py-6 px-4 rounded-xl bg-gray-200">
                    <!-- Profile Image -->
                    <div class="w-24 h-24 bg-white rounded-full overflow-hidden border-4 border-green-500 mb-2">
                        <img src="https://via.placeholder.com/96" alt="User Avatar" class="w-full h-full object-cover">
                    </div>
                    <!-- Profile Name and Experience -->
                    <h4 class="text-lg font-bold text-center text-gray-800">{{ Auth::user()->role }}</h4>
                    <p class="text-center font-semibold text-lg">{{ Auth::user()->name }}</p>
                    <div class="flex items-center mt-2 text-pink-500 font-semibold">
                        <i class="ti ti-flame mr-1"></i> 198 Exp
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="mt-6">
                    <ul class="text-gray-600 text-sm space-y-4 px-4">
                        <!-- sosmed Link -->
                        <li>
                            <a href="{{ url('siswa') }}"
                                class="flex items-center gap-3 py-2.5 text-gray-500 rounded-md hover:bg-gray-100">
                                <i class="ti ti-world text-2xl"></i> Sosial Media
                            </a>
                        </li>
                        <!-- Profile Link -->
                        <li>
                            <a href="{{ url('profile') }}"
                                class="flex items-center gap-3 py-2.5 text-gray-500 rounded-md hover:bg-gray-100">
                                <i class="ti ti-user text-2xl"></i> Profil Saya
                            </a>
                        </li>
                        <!-- kelas Link -->
                        <li>
                            <a href="{{ route('kelas') }}"
                                class="flex items-center gap-3 py-2.5 text-gray-500 rounded-md hover:bg-gray-100">
                                <i class="ti ti-book text-2xl"></i> Kelas Saya
                            </a>
                        </li>
                        <!-- Shop -->
                        <li>
                            <a href="{{ route('shop') }}"
                                class="flex items-center gap-3 py-2.5 text-gray-500 rounded-md hover:bg-gray-100">
                                <i class="ti ti-shopping-cart text-2xl"></i> Shop
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- Bottom Buttons -->
                <div class="mt-8 px-4">
                    <a href="{{ url('konseling/1') }}">
                        <button
                            class="w-full py-2.5 bg-blue-500 text-white rounded-md font-semibold hover:bg-blue-600 transition">
                            Bimbingan Konseling
                        </button>
                    </a>
                    <button
                        class="w-full mt-4 py-2.5 bg-gray-200 text-gray-600 rounded-md font-semibold hover:bg-gray-300 transition">
                        Butuh Bantuan?
                    </button>
                </div>
            </aside>

            <div class="w-full page-wrapper xl:px-6 px-0">
                <!-- Main Content -->
                <main class="h-full max-w-full">
                    <div class="container full-container p-0 flex flex-col gap-6">

                        {{ $slot }}
                    </div>
                </main>
                <!-- Main Content End -->
            </div>
        </div>
        <!--end of project-->
    </main>

    @livewireScripts

    {{-- sweetalert --}}
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>

    @stack('script')

    <script src="{{ asset('assets') }}/libs/jquery/dist/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="{{ asset('assets') }}/libs/iconify-icon/dist/iconify-icon.min.js"></script>
    <script src="{{ asset('assets') }}/libs/@preline/dropdown/index.js"></script>
    <script src="{{ asset('assets') }}/libs/@preline/overlay/index.js"></script>
    <script src="{{ asset('assets') }}/js/sidebarmenu.js"></script>

    <script src="{{ asset('assets') }}/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="{{ asset('assets') }}/js/dashboard.js"></script>
</body>

</html>
