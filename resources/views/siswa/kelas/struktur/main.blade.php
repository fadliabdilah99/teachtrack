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
        Edited-Structure
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

        button {
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: none;
            cursor: pointer;
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
        // menampilkan diskusi
        function showDiskusi(id) {
            const materi = document.querySelectorAll('.materi-content');
            const diskusi = document.getElementById('diskusi-' + id);

            materi.forEach((content) => {
                content.classList.add('hidden');
            });

            diskusi.classList.remove('hidden');
            diskusi.classList.add('fade-in');
        }

        // close diskusi
        function closeDiskusi(id) {
            const diskusi = document.getElementById('diskusi-' + id);
            diskusi.classList.remove('fade-in');
            diskusi.classList.add('hidden');
            const materi = document.getElementById('materi-' + id).classList.remove('hidden');
        }
    </script>

</head>

<body class="bg-surface">
    @if (session('materi_id'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showDiskusi({{ session('materi_id') }});
            });
        </script>
    @endif

    <main>
        <!--start the project-->
        <div id="main-wrapper" class="flex p-5 xl:pr-0">
            @include('siswa.kelas.struktur.header')
            <div class="w-full page-wrapper xl:px-6 px-0">
                <!-- Main Content -->
                <main class="h-full max-w-full">
                    <div class="container full-container p-0 flex flex-col gap-6">
                        @include('siswa.kelas.struktur.navbar')
                        {{-- table materi --}}
                        @foreach ($structure as $materis)
                            <div id="materi-{{ $materis->id }}"
                                class="materi-content hidden container mx-auto px-4 py-8">
                                <section class="bg-white shadow-md rounded-lg p-6 mb-8">
                                    <h2 class="text-2xl font-semibold text-gray-800">{{ $materis->judul }}</h2>
                                    <h3 class="text-lg text-gray-600 mt-2">{{ $materis->subjudul }}</h3>
                                    <p class="mt-4 text-gray-700">{{ $materis->artikel }}</p>
                                </section>
                                <!-- File Materi -->
                                <section class="bg-white shadow-md rounded-lg p-6">
                                    <h3 class="text-xl font-semibold text-gray-800">File Materi</h3>
                                    <p class="text-gray-600 mt-2 mb-4">Unduh materi dalam format PDF atau DOCX untuk
                                        belajar lebih lanjut.</p>
                                    <div class="space-y-4 p-4 bg-gray-50 rounded-lg shadow-md">
                                        <h2 class="text-lg font-semibold text-gray-800">Download Materi</h2>
                                        @if ($materis->file)
                                            @php
                                                $filePath = public_path('file/' . $materis->file);
                                            @endphp

                                            @if (file_exists($filePath))
                                                <a href="{{ asset('file/' . $materis->file) }}"
                                                    class="flex items-center justify-center bg-blue-600 text-white font-medium py-3 px-6 rounded-lg hover:bg-blue-700 transition duration-200"
                                                    download>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                    Download Materi
                                                    ({{ strtoupper(pathinfo($filePath, PATHINFO_EXTENSION)) }})
                                                </a>
                                            @else
                                                <p class="text-red-500 font-medium">File tidak ditemukan di server.</p>
                                            @endif
                                        @else
                                            <p class="text-gray-500 italic">Tidak ada file materi yang tersedia untuk
                                                diunduh.</p>
                                        @endif
                                    </div>

                                </section>
                                <div class="flex space-x-4 my-4">
                                    <form action="{{ route('paham') }}" method="POST">
                                        @csrf
                                        <input type="number" name="materiStrukture_id" value="{{ $materis->id }}"
                                            hidden>
                                        <button type="submit"
                                            class="flex-1 flex items-center justify-center bg-green-600 text-white font-medium py-3 px-6 rounded-lg hover:bg-green-700 transition duration-200">Saya
                                            Sudah Paham</button>
                                    </form>
                                    <div class="">
                                        <button onclick="showDiskusi({{ $materis->id }})"
                                            class="flex-1 flex items-center justify-center bg-gray-600 text-white font-medium py-3 px-6 rounded-lg hover:bg-gray-700 transition duration-200">Diskusi
                                            Kelas</button>
                                    </div>
                                </div>
                            </div>
                            {{-- diskusi --}}
                            <div class="diskusi-page card" id="diskusi-{{ $materis->id }}">
                                <!-- Tombol Close -->
                                <div class="p-4">
                                    <button onclick="closeDiskusi({{ $materis->id }})"
                                        class="w-full bg-gray-600 text-white font-medium py-3 px-6 rounded-lg hover:bg-gray-700 transition duration-200">
                                        Tutup Diskusi
                                    </button>
                                </div>
                                <div class="card-body mb-[calc(100vh-14rem)]">
                                    <h4 class="text-gray-500 text-lg font-semibold mb-5">Diskusi</h4>
                                    <ul class="timeline-widget relative">
                                        <!-- Looping komentar utama -->
                                        @foreach ($materis->diskusi as $diskusis)
                                            <li class="timeline-item flex relative overflow-hidden min-h-[70px]">
                                                <div
                                                    class="timeline-time text-gray-500 text-sm min-w-[90px] py-[6px] pr-4 text-end">
                                                    <span
                                                        class="text-xs">{{ $diskusis->created_at->format('H:i, d-m-Y') }}</span>
                                                    <br>
                                                    <strong>{{ $diskusis->user->name }}</strong>
                                                </div>
                                                <div class="timeline-badge-wrap flex flex-col items-center">
                                                    <div
                                                        class="timeline-badge w-3 h-3 rounded-full shrink-0 bg-blue-600 border-2 border-blue-600 my-[10px]">
                                                    </div>
                                                    <div class="timeline-badge-border block h-full w-[1px] bg-gray-200">
                                                    </div>
                                                </div>
                                                <div
                                                    class="timeline-desc py-[6px] px-4 bg-gray-50 rounded-lg shadow-sm">
                                                    <p class="text-gray-600 text-sm font-normal">
                                                        {{ $diskusis->content }}</p>
                                                    <!-- Tombol Balas -->
                                                    <button class="mt-2 text-blue-600 text-sm underline"
                                                        onclick="setParentId('{{ $diskusis->id }}', '{{ $diskusis->content }}', '{{ $materis->id }}' )">
                                                        Balas
                                                    </button>
                                                </div>
                                            </li>

                                            <!-- Looping balasan komentar -->
                                            <ul class="pl-12">
                                                @foreach ($diskusis->replies as $reply)
                                                    <li
                                                        class="timeline-item flex relative overflow-hidden min-h-[70px]">
                                                        <div
                                                            class="timeline-time text-gray-500 text-sm min-w-[90px] py-[6px] pr-4 text-end">
                                                            <span
                                                                class="text-xs">{{ $reply->created_at->format('H:i, d-m-Y') }}</span>
                                                            <br>
                                                            <strong>{{ $reply->user->name }}</strong>
                                                        </div>
                                                        <div class="timeline-badge-wrap flex flex-col items-center">
                                                            <div
                                                                class="timeline-badge w-3 h-3 rounded-full shrink-0 bg-green-600 border-2 border-green-600 my-[10px]">
                                                            </div>
                                                            <div
                                                                class="timeline-badge-border block h-full w-[1px] bg-gray-200">
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="timeline-desc py-[6px] px-4 bg-gray-100 rounded-lg shadow-sm">
                                                            <p class="text-gray-600 text-sm font-normal">
                                                                <span class="text-xs text-gray-500 font-semibold">
                                                                    Membalas dari {{ $diskusis->user->name }}:
                                                                </span>
                                                                {{ $reply->content }}
                                                            </p>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="fixed-form ">
                                    <form action="{{ route('diskusi') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <!-- Input tersembunyi untuk parent_id -->
                                        <div class="relative flex items-center hidden" id="form-{{ $materis->id }}">
                                            <input type="number" name="parent_id" hidden
                                                id="parent_id-{{ $materis->id }}" value="">
                                            <input type="text"
                                                class="bg-gray-200 border-0 text-gray-500 rounded-tr-lg"
                                                id="content-{{ $materis->id }}" value="">
                                            <button type="button" class="ml-2 text-gray-600"
                                                onclick="clearContent({{ $materis->id }})">
                                                &times;
                                            </button>
                                        </div>


                                        <input type="number" name="rombel_id"
                                            value="{{ Auth::user()->rombel->id }}" hidden>
                                        <input type="number" name="materiStrukture_id" value="{{ $materis->id }}"
                                            hidden>

                                        <div class="comment-input-box">
                                            <!-- Input Komentar -->
                                            <textarea class="flex-grow resize-none border-none focus:ring-0 text-sm text-gray-700 placeholder-gray-400"
                                                rows="1" placeholder="Write a message..." id="content" name="content" required></textarea>

                                            <!-- Ikon Tambah File -->
                                            <input type="file" name="file" id="fileInput" />

                                            <!-- Tombol Kirim -->
                                            <button type="submit">
                                                <i class="bi bi-send-fill"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>


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


    {{-- balas diskusi --}}
    <script>
        function setParentId(parentId, content, materiId) {
            console.log(parentId, content, materiId);
            document.getElementById('content-' + materiId).value = 'membalas : ' + content;
            document.getElementById('parent_id-' + materiId).value = parentId;
            document.getElementById('content-' + materiId).classList.remove('hidden');
            document.getElementById('form-' + materiId).classList.remove('hidden');
        }
    </script>

    {{-- batal membalas --}}
    <script>
        function clearContent(materiId) {
            document.getElementById('content-' + materiId).value = '';
            document.getElementById('content-' + materiId).classList.add('hidden');
            document.getElementById('parent_id-' + materiId).value = '';
            document.getElementById('form-' + materiId).classList.add('hidden');
        }
    </script>
</body>

</html>
