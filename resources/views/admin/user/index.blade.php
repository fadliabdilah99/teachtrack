@extends('admin.template.main')

@section('title', 'Admin-User')

@push('style')
@endpush

@section('content')
    @include('admin.user.murid')
    @include('admin.user.guru')
    @include('admin.user.orangtua')


    {{-- modal add murid --}}

    <div id="modalsiswas" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6">
            <!-- Header Modal -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">tambah siswa</h2>
                <button onclick="closeModalsiswa()" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('addsiswa') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">Nama</label>
                            <input type="text" name="name" id="input-label-with-helper-text"
                                class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                                placeholder="" aria-describedby="hs-input-helper-text">
                        </div>
                        <div class="mb-6">
                            <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">NIS</label>
                            <input type="number" name="NoUnik" id="input-label-with-helper-text"
                                class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                                placeholder="" aria-describedby="hs-input-helper-text">
                        </div>
                        <div class="mb-6">
                            <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">kelas</label>
                            <select id="country" name="kelas" autocomplete="country-name"
                                class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0">
                                <option value="X">X</option>
                                <option value="XI">XI</option>
                                <option value="XII">XII</option>
                            </select>
                        </div>
                        <div class="mb-6">
                            <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">kelas</label>
                            <select id="country" name="rombel" autocomplete="country-name"
                                class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0">
                                @foreach ($rombel as $rombels)
                                    <option value="{{ $rombels->id }}">{{ $rombels->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Footer Modal -->
                        <div class="flex justify-end">
                            <button onclick="closeModalsiswa()"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded mr-2">Cancel</button>
                            <button
                                class="btn text-base py-2.5 text-white font-medium w-fit hover:bg-blue-700" type="submit">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- guru --}}
    <div id="modalguru" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6">
            <!-- Header Modal -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">tambah guru</h2>
                <button onclick="closeModalguru()" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>

            <!-- Isi Modal -->
            <p class="text-gray-600 mb-4">
                This is a simple modal using Tailwind CSS. You can add any content here.
            </p>

            <!-- Footer Modal -->
            <div class="flex justify-end">
                <button onclick="closeModalguru()"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded mr-2">Cancel</button>
                <button class="bg-teal-500 hover:bg-teal-600 text-white px-4 py-2 rounded">Confirm</button>
            </div>
        </div>
    </div>

    @push('script')
        {{-- search fungsi --}}
        <script>
            function searchTablesiswa() {
                const input = document.getElementById("searchInputsiswa").value.toLowerCase();
                const rows = document.querySelectorAll("#dataTablesiswa tr");

                rows.forEach(row => {
                    // Menggabungkan teks dari semua kolom di baris saat ini
                    const rowText = Array.from(row.cells).map(cell => cell.textContent.toLowerCase()).join(" ");

                    // Menampilkan atau menyembunyikan baris berdasarkan hasil pencarian
                    row.style.display = rowText.includes(input) ? "" : "none";
                });
            }

            function searchTableguru() {
                const input = document.getElementById("searchInputguru").value.toLowerCase();
                const rows = document.querySelectorAll("#dataTableguru tr");

                rows.forEach(row => {
                    // Menggabungkan teks dari semua kolom di baris saat ini
                    const rowText = Array.from(row.cells).map(cell => cell.textContent.toLowerCase()).join(" ");

                    // Menampilkan atau menyembunyikan baris berdasarkan hasil pencarian
                    row.style.display = rowText.includes(input) ? "" : "none";
                });
            }

            function searchTableortu() {
                const input = document.getElementById("searchInputortu").value.toLowerCase();
                const rows = document.querySelectorAll("#dataTableortu tr");

                rows.forEach(row => {
                    // Menggabungkan teks dari semua kolom di baris saat ini
                    const rowText = Array.from(row.cells).map(cell => cell.textContent.toLowerCase()).join(" ");

                    // Menampilkan atau menyembunyikan baris berdasarkan hasil pencarian
                    row.style.display = rowText.includes(input) ? "" : "none";
                });
            }
        </script>

        {{-- modal fungsi --}}

        <script>
            function modalsiswa() {
                document.getElementById("modalsiswas").classList.remove("hidden");
            }

            function closeModalsiswa() {
                document.getElementById("modalsiswas").classList.add("hidden");
            }
        </script>

        <script>
            function modalguru() {
                document.getElementById("modalguru").classList.remove("hidden");
            }

            function closeModalguru() {
                document.getElementById("modalguru").classList.add("hidden");
            }
        </script>
    @endpush
@endsection
