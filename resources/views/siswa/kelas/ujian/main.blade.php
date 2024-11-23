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
        Edited-ujian
    </title>
    @vite('resources/css/app.css')
    @livewireStyles

    <style>
        .fixed-form {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: white;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            /* Bayangan lembut */
            z-index: 1000;
            /* Pastikan form berada di atas konten lainnya */
        }

        .fixed-form .comment-input-box {
            display: flex;
            align-items: center;
            gap: 8px;
            /* Memberikan jarak antar elemen */
            padding: 12px;
            max-width: 100%;
            /* Pastikan tidak melebar melebihi layar */
        }

        .fixed-form textarea {
            flex-grow: 1;
            /* Memastikan textarea mengambil ruang kosong */
            padding: 8px;
            border: 1px solid #e2e8f0;
            /* Warna border ringan */
            border-radius: 6px;
            outline: none;
            font-size: 14px;
            resize: none;
            height: auto;
            /* Pastikan tidak ada overflow */
        }

        .fixed-form input[type="file"] {
            cursor: pointer;
            font-size: 14px;
        }

        .fixed-form button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 12px;
            background-color: #2563eb;
            /* Warna biru */
            color: white;
            font-size: 14px;
            font-weight: 500;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }

        .fixed-form button:hover {
            background-color: #1d4ed8;
            /* Warna biru lebih gelap saat hover */
        }



        .comment-input-box {
            display: flex;
            align-items: center;
            padding: 12px;
            border: 1px solid #e5e7eb;
            /* Warna abu-abu muda */
            border-radius: 8px;
            background-color: #e3e3e3;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        textarea {
            outline: none;
        }

        textarea:focus {
            border: none;
            outline: none;
            box-shadow: none;
        }



        /* Step marker styles */
        .step-marker {
            margin-right: 8px;
        }

        .sidebar-item .sidebar-link.active {
            font-weight: bold;
            color: #1D4ED8;
            /* Customize as needed */
        }

        .sidebar-item .sidebar-link.active .step-marker {
            background-color: #10B981;
            /* Green for active step */
        }

        .sidebar-item .sidebar-link.completed .step-marker {
            background-color: #3B82F6;
            /* Blue for completed steps */
        }

        .sidebar-item .sidebar-link.inactive .step-marker {
            background-color: #D1D5DB;
            /* Gray for inactive steps */
        }

        /* Animasi fade-in */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
                /* Menggeser sedikit ke atas */
            }

            to {
                opacity: 1;
                transform: translateY(0);
                /* Kembali ke posisi awal */
            }
        }

        .fade-in {
            display: block;
            /* Pastikan elemen tampil */
            animation: fadeIn 0.5s ease-out;
            /* Gunakan animasi selama 0.5 detik */
        }
    </style>

    {{-- menampilkan materi yang di select --}}
    <script>
        function showMateri(id) {

            console.log(id)
            document.querySelectorAll('.materi-content').forEach((content) => {
                content.classList.add('hidden');
            });
            document.querySelectorAll('.diskusi-page').forEach((content) => {
                content.classList.add('hidden');
                content.classList.remove('fade-in'); // Pastikan kelas fade-in dihapus
            });

            document.getElementById('materi-' + id).classList.remove('hidden');
        }
    </script>

</head>

<body class="bg-surface">


    <main>
        <!--start the project-->
        <div id="main-wrapper" class="flex p-5 xl:pr-0">
            @include('siswa.kelas.ujian.header')
            <div class="w-full page-wrapper xl:px-6 px-0">
                <!-- Main Content -->
                <main class="h-full max-w-full">
                    <div class="container full-container p-0 flex flex-col gap-6">
                        @include('siswa.kelas.ujian.navbar')
                        {{-- table materi --}}
                        @foreach ($soals as $soal)
                            <div id="materi-{{ $soal->id }}"
                                class="materi-content hidden container mx-auto px-4 py-8">
                                <section class="bg-white shadow-md rounded-lg p-6 mb-8">
                                    <h3 class="text-lg text-gray-600 mt-2">{{ $soal->question }}</h3>
                                </section>
                                <!-- File Materi -->
                                <section class="bg-white shadow-md rounded-lg p-6">
                                    <h4 class="text-lg font-semibold text-gray-700 mb-4">Pilihan Ganda</h4>
                                    <div class="space-y-4">
                                        <form method="POST">
                                            @csrf
                                            @foreach ($soal->options as $pg)
                                                <label
                                                    class="flex items-center p-4 my-2 bg-gray-50 border border-gray-200 rounded-lg hover:bg-gray-100 cursor-pointer transition">
                                                    <!-- Radio Button -->
                                                    <input type="radio" name="option" value="{{ $pg->id }}"
                                                        class="w-4 h-4 text-teal-500 focus:ring-teal-500 cursor-pointer">
                                                    <!-- Teks -->
                                                    <span class="m-4 text-gray-700 text-sm font-medium">
                                                        {{ $pg->option }}
                                                    </span>
                                                </label>
                                            @endforeach
                                            <div class="flex">
                                                <!-- Tombol untuk Jawab -->
                                                <button type="submit" formaction="{{ route('select') }}"
                                                    class="flex-1 flex items-center justify-center bg-green-600 text-white font-medium py-3 px-6 rounded-lg hover:bg-green-700 transition duration-200 mr-2">
                                                    Jawab
                                                </button>
                                                <!-- Tombol untuk Jawab Nanti -->
                                                <button type="submit" formaction="{{ route('pending') }}"
                                                    class="flex-1 flex items-center justify-center bg-gray-600 text-white font-medium py-3 px-6 rounded-lg hover:bg-gray-700 transition duration-200">
                                                    Jawab nanti
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </section>
                            </div>
                        @endforeach

                        {{-- end diskusi --}}
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


    {{-- menampilkan materi pertama --}}
    <script>
        let idM = {{ $materiFirst }};
        document.getElementById(`materi-${idM}`).classList.remove('hidden');
        document.querySelectorAll('.diskusi-page').forEach((content) => {
            content.classList.add('hidden');
        });
    </script>
</body>

</html>
