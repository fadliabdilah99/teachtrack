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
    <aside id="application-sidebar-brand"
        class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transform hidden xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 fixed xl:top-5 xl:left-auto top-0 left-0 with-vertical h-screen z-[999] shrink-0 w-[270px] shadow-md xl:rounded-md rounded-none bg-white left-sidebar transition-all duration-300">
        <!-- ---------------------------------- -->
        <!-- Start Vertical Layout Sidebar -->
        <!-- ---------------------------------- -->
        <div class="p-4">
            <a href="../" class="text-nowrap">
                <img src="{{ asset('assets/images/logos/logo-light.svg') }}" alt="Logo-Dark" />
            </a>
        </div>
        <div class="scroll-sidebar" data-simplebar="">
            <nav class="w-full flex flex-col sidebar-nav px-4 mt-5">
                <ul id="sidebarnav" class="text-gray-600 text-sm">
                    <li class="text-xs font-bold pb-[5px]">
                        <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
                        <span class="text-xs text-gray-400 font-semibold">HOME</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                            href="{{ route('guru') }}"> <i class="ti ti-layout-dashboard ps-2 text-2xl"></i>
                            <span>Dashboard</span> </a>
                    </li>

                    @if (Auth::user()->role == 'konseling')
                        <li class="sidebar-item">
                            <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                                href="{{ route('konseling') }}"> <i class="bi bi-chat-left-heart ps-2 text-2xl"></i>
                                <span>Bimbingan Konseling</span> </a>
                        </li>
                    @endif

                    <li class="text-xs font-bold mb-4 mt-6">
                        <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
                        <span class="text-xs text-gray-400 font-semibold">Lainnya</span>
                    </li>


                    <li class="sidebar-item">
                        <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                            href="{{ route('gurumateri') }}"> <i class="ti ti-school ps-2 text-2xl"></i>
                            <span>kelas</span> </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                            href="{{ route('materi') }}"> <i class="ti ti-book ps-2 text-2xl"></i>
                            <span>Materi</span> </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                            href="./components/cards.html"> <i class="ti ti-cards ps-2 text-2xl"></i>
                            <span>Card</span> </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                            href="./components/forms.html"> <i class="ti ti-file-description ps-2 text-2xl"></i>
                            <span>Forms</span> </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                            href="./components/typography.html">
                            <i class="ti ti-typography ps-2 text-2xl"></i> <span>Typography</span>
                        </a>
                    </li>

                    <li class="text-xs font-bold mb-4 mt-8">
                        <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
                        <span class="text-xs text-gray-400 font-semibold">AUTH</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                            href="./pages/authentication-login.html"> <i class="ti ti-login ps-2 text-2xl"></i>
                            <span>Login</span> </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                            href="./pages/authentication-register.html">
                            <i class="ti ti-user-plus ps-2 text-2xl"></i> <span>Register</span>
                        </a>
                    </li>

                    <li class="text-xs font-bold mb-4 mt-8">
                        <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
                        <span class="text-xs text-gray-400 font-semibold">EXTRA</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                            href="./pages/icons.html"> <i class="ti ti-mood-happy ps-2 text-2xl"></i>
                            <span>Icons</span> </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center relative rounded-md text-gray-500 w-full"
                            href="./pages/sample-page.html"> <i class="ti ti-aperture ps-2 text-2xl"></i>
                            <span>Sample Page</span> </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Bottom Upgrade Option -->
        <div class="m-4 relative grid">
            <form action="{{ url('logout') }}" method="POST">
                @csrf
                <button class="text-base font-semibold hover:bg-blue-700 btn" type="submit">Logout</button>
            </form>
        </div>
        <!-- </aside> -->
    </aside>


    <main>
        <!--start the project-->
        <div id="main-wrapper" class="flex p-5 xl:pr-0">
            @include('guru.template.header')
            <div class="w-full page-wrapper xl:px-6 px-0">
                <!-- Main Content -->
                <main class="h-full max-w-full">
                    <div class="container full-container p-0 flex flex-col gap-6">
                        @include('guru.template.navbar')
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