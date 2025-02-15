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
    </style>
    <script>
        function showMateri(id) {
            // Sembunyikan form
            document.getElementById('form-container').classList.add('hidden');

            // Sembunyikan semua materi
            document.querySelectorAll('.materi-content').forEach((content) => {
                content.classList.add('hidden');
            });

            // Tampilkan materi yang dipilih
            document.getElementById('materi-' + id).classList.remove('hidden');
        }

        function showForm() {
            // Sembunyikan semua materi
            document.querySelectorAll('.materi-content').forEach((content) => {
                content.classList.add('hidden');
            });

            // Tampilkan form
            document.getElementById('form-container').classList.remove('hidden');
        }
    </script>
</head>

<body class="bg-surface">
    <main>
        <!--start the project-->
        <div id="main-wrapper" class="flex p-5 xl:pr-0">
            @include('guru.materi.struktur.header')
            <div class="w-full page-wrapper xl:px-6 px-0">
                <!-- Main Content -->
                <main class="h-full max-w-full">
                    <div class="container full-container p-0 flex flex-col gap-6">
                        @include('guru.materi.struktur.navbar')

                        {{-- form add stuktur materi --}}
                        <div id="form-container" class="p-6 bg-white rounded-lg shadow-md container mx-auto mt-6">
                            <h2 class="text-3xl font-semibold mb-6 text-gray-800">Input Materi</h2>

                            <!-- Form untuk memasukkan materi -->
                            <form action="{{ url('guru/materi/addstruktur') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="number" name="materiGuru_id" value="{{ $materi->id }}" hidden>
                                <!-- Input Judul -->
                                <label for="judul" class="block text-gray-700 font-medium mb-2">Judul Materi:</label>
                                <input type="text" id="judul" name="judul"
                                    class="w-full px-4 py-2 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                                    placeholder="Masukkan judul materi" required />

                                <!-- Input Subjudul -->
                                <label for="subjudul"
                                    class="block text-gray-700 font-medium mb-2">Subjudul/Deskripsi</label>
                                <input type="text" id="subjudul" name="subjudul"
                                    class="w-full px-4 py-2 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                                    placeholder="Masukkan Deskripsi" required />

                                <!-- Textarea sebagai teks editor sederhana -->
                                <label for="materi" class="block text-gray-700 font-medium mb-2">Deskripsi
                                    Materi:</label>
                                <textarea id="materi" name="artikel"
                                    class="w-full h-48 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 resize-none mb-4"
                                    placeholder="Tulis deskripsi materi di sini..."></textarea>

                                <!-- Input untuk Upload File -->
                                <label for="file" class="block text-gray-700 font-medium mb-2">Upload File
                                    (opsional):</label>
                                <input type="file" id="file" name="file"
                                    class="w-full px-4 py-2 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                                    accept=".pdf,.doc,.docx,.ppt,.pptx,.jpg,.png,.mp4" />

                                <!-- Tombol submit -->
                                <button type="submit"
                                    class="mt-4 w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Simpan Materi
                                </button>
                            </form>
                        </div>

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
                                    @if (Auth::user()->role == 'guru')
                                        <button onclick="editmateri({{ $materis->id }})"
                                            class="btn items-center justify-center mt-5 bg-teal-400 text-white">Edit
                                            Materi</button>
                                    @endif
                                </section>
                            </div>

                            @if (Auth::user()->role == 'guru')
                                {{-- modal edit materi --}}
                                <div id="editmateri{{ $materis->id }}"
                                    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden overflow-y-scroll">
                                    <div
                                        class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/2 p-6 overflow-y-auto max-h-full">
                                        <!-- Header Modal -->
                                        <div class="flex justify-between items-center mb-4">
                                            <h2 class="text-xl font-bold">Edit Materi</h2>
                                            <button onclick="closeModalmateri({{ $materis->id }})"
                                                class="text-gray-400 hover:text-gray-600">&times;</button>
                                        </div>

                                        <div class="card">
                                            <div class="card-body">
                                                <form action="{{ url('guru/materi/edit') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="number" name="id" value="{{ $materis->id }}"
                                                        hidden>
                                                    <!-- Input Judul -->
                                                    <label for="judul"
                                                        class="block text-gray-700 font-medium mb-2">Judul
                                                        Materi:</label>
                                                    <input type="text" id="judul" name="judul"
                                                        value="{{ $materis->judul }}"
                                                        class="w-full px-4 py-2 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                                                        placeholder="Masukkan judul materi" required />

                                                    <!-- Input Subjudul -->
                                                    <label for="subjudul"
                                                        class="block text-gray-700 font-medium mb-2">Subjudul/Deskripsi</label>
                                                    <input type="text" id="subjudul" name="subjudul"
                                                        value="{{ $materis->subjudul }}"
                                                        class="w-full px-4 py-2 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                                                        placeholder="Masukkan Deskripsi" required />

                                                    <!-- Textarea sebagai teks editor sederhana -->
                                                    <label for="materi"
                                                        class="block text-gray-700 font-medium mb-2">Deskripsi
                                                        Materi:</label>
                                                    <textarea id="materi" name="artikel"
                                                        class="w-full h-48 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 resize-none mb-4"
                                                        placeholder="Tulis deskripsi materi di sini...">{{ $materis->artikel }}</textarea>

                                                    <!-- Input untuk Upload File -->
                                                    <label for="file"
                                                        class="block text-gray-700 font-medium mb-2">Upload File
                                                        (opsional):</label>
                                                    <input type="file" id="file" name="file"
                                                        class="w-full px-4 py-2 mb-4 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                                                        accept=".pdf,.doc,.docx,.ppt,.pptx,.jpg,.png,.mp4" />

                                                    <!-- Tombol submit -->
                                                    <button type="submit"
                                                        class="mt-4 w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        Simpan Materi
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

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


    <script>
        function editmateri(id) {
            // console.log('editmateri' + id);
            document.getElementById('editmateri' + id).classList.remove('hidden');
        }

        function closeModalmateri(id) {
            // console.log('editmateri' + id);
            document.getElementById('editmateri' + id).classList.add('hidden');
        }
    </script>
</body>

</html>
