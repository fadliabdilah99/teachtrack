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
</head>

<body class="bg-surface">
    <main>
        <div id="main-wrapper" class="flex p-5 xl:pr-0">
            <div class="w-full page-wrapper xl:px-6 px-0">
                <!-- Main Content -->
                <main class="h-full max-w-full">
                    <div class="container full-container p-0 flex flex-col gap-6">
                        <!--  Header Start -->
                        <header class="bg-white shadow-md rounded-md w-full text-sm py-4 px-6">
                            <!-- ========== HEADER ========== -->
                            <nav class="w-ful flex items-center justify-between" aria-label="Global">
                                <ul class="icon-nav flex items-center gap-4">
                                    <li class="relative xl:hidden">
                                        <a class="text-xl icon-hover cursor-pointer text-heading" id="headerCollapse"
                                            data-hs-overlay="#application-sidebar-brand"
                                            aria-controls="application-sidebar-brand" aria-label="Toggle navigation"
                                            href="javascript:void(0)">
                                            <i class="ti ti-menu-2 relative z-1"></i>
                                        </a>
                                    </li>

                                    <li class="relative">
                                        <div
                                            class="hs-dropdown relative inline-flex [--placement:bottom-left] sm:[--trigger:hover]">
                                            <a class="relative hs-dropdown-toggle inline-flex hover:text-gray-500 text-gray-300"
                                                href="#">
                                                <i class="ti ti-bell-ringing text-xl relative z-[1]"></i>
                                                <h1></h1>
                                                <div
                                                    class="absolute inline-flex items-center justify-center text-white text-[11px] font-medium bg-blue-600 w-2 h-2 rounded-full -top-[1px] -right-[6px]">
                                                </div>
                                            </a>
                                            <div class="card hs-dropdown-menu transition-[opacity,margin] rounded-md duration hs-dropdown-open:opacity-100 opacity-0 mt-2 min-w-max w-[300px] hidden z-[12]"
                                                aria-labelledby="hs-dropdown-custom-icon-trigger">
                                                <div>
                                                    <h3 class="text-gray-500 font-semibold text-base px-6 py-3">
                                                        Notification</h3>
                                                    <ul class="list-none flex flex-col">
                                                        <li>
                                                            <a href="#" class="py-3 px-6 block hover:bg-gray-200">
                                                                <p class="text-sm text-gray-500 font-medium">Roman
                                                                    Joined the Team!</p>
                                                                <p class="text-xs text-gray-400 font-medium">
                                                                    Congratulate him</p>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="py-3 px-6 block hover:bg-gray-200">
                                                                <p class="text-sm text-gray-500 font-medium">New
                                                                    message received</p>
                                                                <p class="text-xs text-gray-400 font-medium">Salma sent
                                                                    you new message</p>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="py-3 px-6 block hover:bg-gray-200">
                                                                <p class="text-sm text-gray-500 font-medium">New
                                                                    Payment received</p>
                                                                <p class="text-xs text-gray-400 font-medium">Check your
                                                                    earnings</p>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="py-3 px-6 block hover:bg-gray-200">
                                                                <p class="text-sm text-gray-500 font-medium">Jolly
                                                                    completed tasks</p>
                                                                <p class="text-xs text-gray-400 font-medium">Assign her
                                                                    new tasks</p>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="py-3 px-6 block hover:bg-gray-200">
                                                                <p class="text-sm text-gray-500 font-medium">Roman
                                                                    Joined the Team!</p>
                                                                <p class="text-xs text-gray-400 font-medium">
                                                                    Congratulate him</p>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class=""><i class="bi bi-wallet text-green-500"></i> : <span
                                            class="font-bold">Rp.
                                            {{ Auth::user()->wallet->where('jenis', 'uang masuk')->sum('nominal') - Auth::user()->wallet->where('jenis', 'uang keluar')->sum('nominal') }}</span>
                                    </li>
                                </ul>
                                <div class="flex items-center gap-4">
                                    <a href="#" class="btn text-base font-medium hover:bg-blue-700"
                                        aria-current="page">Upgrade to
                                        Pros</a>
                                    <div
                                        class="hs-dropdown relative inline-flex [--placement:bottom-right] sm:[--trigger:hover]">
                                        <a class="relative hs-dropdown-toggle cursor-pointer align-middle rounded-full">
                                            <img class="object-cover w-9 h-9 rounded-full"
                                                src="./assets/images/profile/user-1.jpg" alt=""
                                                aria-hidden="true" />
                                        </a>
                                        <div class="card hs-dropdown-menu transition-[opacity,margin] rounded-md duration hs-dropdown-open:opacity-100 opacity-0 mt-2 min-w-max w-[200px] hidden z-[12]"
                                            aria-labelledby="hs-dropdown-custom-icon-trigger">
                                            <div class="card-body p-0 py-2">
                                                <a href="javscript:void(0)"
                                                    class="flex gap-2 items-center font-medium px-4 py-1.5 hover:bg-gray-200 text-gray-400">
                                                    <i class="ti ti-user text-xl"></i>
                                                    <p class="text-sm">My Profile</p>
                                                </a>
                                                <a href="javscript:void(0)"
                                                    class="flex gap-2 items-center font-medium px-4 py-1.5 hover:bg-gray-200 text-gray-400">
                                                    <i class="ti ti-mail text-xl"></i>
                                                    <p class="text-sm">My Account</p>
                                                </a>
                                                <a href="javscript:void(0)"
                                                    class="flex gap-2 items-center font-medium px-4 py-1.5 hover:bg-gray-200 text-gray-400">
                                                    <i class="ti ti-list-check text-xl"></i>
                                                    <p class="text-sm">My Task</p>
                                                </a>
                                                <div class="px-4 mt-[7px] grid">
                                                    <a href="../../pages/authentication-login.html"
                                                        class="btn-outline-primary font-medium text-[15px] w-full hover:bg-blue-600 hover:text-white">Logout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </nav>

                            <!-- ========== END HEADER ========== -->
                        </header>
                        <!--  Header End -->

                        @yield('content')
                    </div>
                </main>
                <!-- Main Content End -->
            </div>
        </div>
        <!--end of project-->
    </main>

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

    @livewireScripts

    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                title: "Berhasil!",
                text: "{{ $message }}",
                icon: "success"
            });
        </script>
    @endif
    @if ($message = Session::get('error'))
        <script>
            Swal.fire({
                title: "gagal!",
                text: "{{ $message }}",
                icon: "error"
            });
        </script>
    @endif

    @if ($message = Session::get($errors->any()))
        <script>
            Swal.fire({
                title: "Errors!",
                text: "{{ $message }}",
                icon: "error"
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
            });
        </script>
    @endif

</body>

</html>
