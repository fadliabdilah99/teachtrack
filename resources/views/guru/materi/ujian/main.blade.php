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
    @if (session('soal_id'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showMateri({{ session('soal_id') }});
            });
        </script>
    @endif
    <main>
        <!--start the project-->
        <div id="main-wrapper" class="flex p-5 xl:pr-0">
            @include('guru.materi.ujian.header')
            <div class="w-full page-wrapper xl:px-6 px-0">
                <!-- Main Content -->
                <main class="h-full max-w-full">
                    <div class="container full-container p-0 flex flex-col gap-6">
                        @include('guru.materi.ujian.navbar')

                        {{-- form add stuktur materi --}}
                        <div id="form-container" class="p-6 bg-white rounded-lg shadow-md container mx-auto mt-6">
                            <h2 class="text-3xl font-semibold mb-6 text-gray-800">Tambah Soal</h2>

                            <!-- Form untuk memasukkan materi -->
                            <form action="{{ route('addsoal') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="number" name="materi_guru_id" value="{{ $materi->id }}" hidden>

                                <!-- Textarea sebagai teks editor sederhana -->
                                <label for="materi" class="block text-gray-700 font-medium mb-2">Pertanyaan:</label>
                                <textarea id="materi" name="question"
                                    class="w-full h-48 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 resize-none mb-4"
                                    placeholder="Tulis soal di sini..."></textarea>

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

                        {{-- table soal --}}

                        @foreach ($structure as $materis)
                            <div id="materi-{{ $materis->id }}"
                                class="materi-content hidden container mx-auto px-6 py-8">

                                <!-- Section Pertanyaan -->
                                <section class="bg-gray-100 shadow-md rounded-lg p-6 mb-6">
                                    <h3 class="text-xl font-semibold text-gray-700">
                                        {{ $materis->question }}
                                    </h3>
                                </section>


                                <!-- Form Pilihan -->
                                <form action="{{ route('addopsi') }}" method="POST" enctype="multipart/form-data"
                                    class="bg-white shadow-md rounded-lg p-6 flex items-center space-x-4">
                                    @csrf

                                    <!-- Hidden Inputs -->
                                    <input type="hidden" name="question_id" value="{{ $materis->id }}">

                                    <!-- Input Pilihan -->
                                    <div class="flex-1">
                                        <label for="pilihan-{{ $materis->id }}"
                                            class="block text-sm font-medium text-gray-600 mb-2">
                                            Pilihan:
                                        </label>
                                        <input type="text" id="pilihan-{{ $materis->id }}" name="option"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg 
                                                  focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                            placeholder="Tulis pilihan di sini..." required>
                                    </div>
                                    <!-- Button Simpan -->
                                    <button type="submit"
                                        class="bg-indigo-600  hover:bg-indigo-700 text-white font-semibold mt-6 px-6 py-2 rounded-lg 
                                               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Simpan Pilihan
                                    </button>
                                </form>
                                <!-- Section Pertanyaan -->
                                <section class="bg-gray-100 shadow-md rounded-lg p-6 mb-6">
                                    @foreach ($materis->options as $opsi)
                                        <div
                                            class="flex justify-between items-center bg-white p-4 mb-2 rounded-lg shadow">
                                            <h3 class="text-lg font-semibold text-gray-700">
                                                {{ $opsi->option }}
                                            </h3>
                                            <div class="flex space-x-2">
                                                @if ($opsi->status == 'salah')
                                                <form action="{{ route('editopsi', $opsi->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="status" value="benar">
                                                    <input type="hidden" name="soal_id" value="{{ $materis->id }}">
                                                    <input type="hidden" name="question_id" value="{{ $opsi->question_id }}">
                                                    <button class="text-yellow-500 hover:text-blue-700 font-medium">
                                                        salah
                                                    </button>
                                                </form>
                                                @else
                                                    <button class="text-green-500 hover:text-blue-700 font-medium">
                                                        benar
                                                    </button>
                                                @endif
                                                <button class="text-blue-500 hover:text-blue-700 font-medium">
                                                    Edit
                                                </button>
                                                <button class="text-red-500 hover:text-red-700 font-medium">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach

                                </section>
                            </div>
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

</body>

</html>
