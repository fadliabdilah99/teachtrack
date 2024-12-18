@extends('siswa.template.main')

@section('title', 'Siswa-Kelas')

@push('style')
@endpush

@section('content')
    <!-- Dashboard Cards -->
    <div class="grid grid-cols-3 gap-4 mb-6">

        <button onclick="modalkelas()" class="bg-gray-400 rounded-lg p-4 flex items-center text-white">
            <i class="ti ti-layout-dashboard text-3xl mr-3"></i>
            <span class="font-semibold text-lg">kelas</span>
        </button>
        <button onclick="modalmapel()" class="bg-green-500 rounded-lg p-4 flex items-center text-white">
            <i class="ti ti-clock text-3xl mr-3"></i>
            @if ($currentLesson)
                <span class="font-semibold text-lg">{{ $currentLesson->dari }}-{{ $currentLesson->sampai }}
                    {{ $currentLesson->guruMapel->mapel->pelajaran }}</span>
            @else
                <span class="font-semibold text-lg">Belum Ada Jadwal</span>
            @endif
        </button>
        <button onclick="modallistkelas()" class="bg-yellow-400 rounded-lg p-4 flex items-center text-white">
            <i class="ti ti-book text-3xl mr-3"></i>
            <span class="font-semibold text-lg">Materi</span>
        </button>
    </div>

    {{-- content --}}
    @include('siswa.kelas.modal')


    {{-- add siswa --}}
    <div id="modalguru" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6">
            <!-- Header Modal -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Siswa kelas {{ $kelas->kelas }}-{{ $kelas->jurusan->jurusan }}</h2>
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
                            <div class="mb-6">
                                <label for="input-label-with-helper-text"
                                    class="block text-sm mb-2 text-gray-400">Jabatan</label>
                                <select id="country" name="role" autocomplete="country-name"
                                    class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0">
                                    <option value="siswa">siswa</option>
                                    <option value="WAKM">WAKM</option>
                                </select>
                            </div>
                        </div>
                        <!-- Footer Modal -->
                        <div class="flex justify-end">
                            <button type="button" onclick="closeModalsiswa()"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded mr-2">Cancel</button>
                            <button class="btn text-base py-2.5 text-white font-medium w-fit hover:bg-blue-700"
                                type="submit">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- modal --}}
    <div id="modalabsen" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6">
            <!-- Header Modal -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Berikan keterangan</h2>
                <button onclick="closeModalabsen()" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('absensiSekertaris') }}" method="POST">
                        @csrf
                        <input type="number" name="user_id" hidden id="userID">
                        <div class="mb-6">
                            <div class="mb-6">
                                <label for="input-label-with-helper-text"
                                    class="block text-sm mb-2 text-gray-400">Jabatan</label>
                                <select id="country" name="status" autocomplete="country-name"
                                    class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0">
                                    <option value="sakit">sakit</option>
                                    <option value="izin">izin</option>
                                </select>
                            </div>
                        </div>
                        <!-- Footer Modal -->
                        <div class="flex justify-end">
                            <button type="button" onclick="closeModalabsen()"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded mr-2">Cancel</button>
                            <button class="btn text-base py-2.5 text-white font-medium w-fit hover:bg-blue-700"
                                type="submit">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('script')
    {{-- form search --}}
    <script>
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
    </script>

    {{-- hidden modal --}}
    <script>
        document.getElementById("kelastable").classList.remove("hidden");
        document.getElementById("materitable").classList.add("hidden");
        document.getElementById("listmateritable").classList.add("hidden");

        function modalsiswa() {
            document.getElementById("modalguru").classList.remove("hidden");
        }

        function closeModalsiswa() {
            document.getElementById("modalguru").classList.add("hidden");
        }

        function addabsen(userID) {
            document.getElementById("userID").value = userID;
            document.getElementById("modalabsen").classList.remove("hidden");
        }

        function closeModalabsen() {
            document.getElementById("modalabsen").classList.add("hidden");
        }

        function modalkelas() {
            document.getElementById("kelastable").classList.remove("hidden");
            document.getElementById("materitable").classList.add("hidden");
            document.getElementById("listmateritable").classList.add("hidden");
        }

        function modalmapel() {
            document.getElementById("materitable").classList.remove("hidden");
            document.getElementById("kelastable").classList.add("hidden");
            document.getElementById("listmateritable").classList.add("hidden");
        }

        function modallistkelas() {
            document.getElementById("dibeli").classList.add("hidden");
            document.getElementById("listmateritable").classList.remove("hidden");
            document.getElementById("kelastable").classList.add("hidden");
            document.getElementById("materitable").classList.add("hidden");
        }

        function dibeli() {
            document.getElementById("dibeli").classList.remove("hidden");
            document.getElementById("materiall").classList.add("hidden");
        }

        function materiall() {
            document.getElementById("dibeli").classList.add("hidden");
            document.getElementById("materiall").classList.remove("hidden");
        }
    </script>
@endpush
