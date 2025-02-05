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
                <h2 class="text-xl font-bold">Tambah Ketua Kelas</h2>
                <button onclick="closeModalsiswa()" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('addkelas') }}" method="POST">
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
                                @foreach ($jurusan as $rombels)
                                    <option value="{{ $rombels->id }}">{{ $rombels->jurusan }}-{{ $rombels->no }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Footer Modal -->
                        <div class="flex justify-end">
                            <button onclick="closeModalsiswa()" type="button"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded mr-2">Cancel</button>
                            <button class="btn text-base py-2.5 text-white font-medium w-fit hover:bg-blue-700"
                                type="submit">Confirm</button>
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
                <h2 class="text-xl font-bold">Tambah Guru</h2>
                <button onclick="closeModalguru()" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>

            <form action="{{ route('addguru') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">Nama</label>
                    <input type="text" name="name" id="input-label-with-helper-text"
                        class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                        placeholder="" aria-describedby="hs-input-helper-text">
                </div>
                <div class="mb-6">
                    <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">No Guru</label>
                    <input type="number" name="NoUnik" id="input-label-with-helper-text"
                        class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                        placeholder="" aria-describedby="hs-input-helper-text">
                </div>
                <div class="mb-6">
                    <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">Wali Kelas</label>
                    <select id="country" name="rombel" autocomplete="country-name"
                    class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0">
                    <option value="">Tidak ada</option>
                    @foreach ($jurusan as $rombels)
                    <option value="{{ $rombels->id }}">{{ $rombels->jurusan }}-{{ $rombels->no }}</option>
                    @endforeach
                </select>
                </div>
                <div class="mb-6">
                    <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">Role</label>
                    <select id="country" name="role" autocomplete="country-name"
                    class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0">
                        <option value="guru">Guru</option>
                        <option value="konseling">konseling</option>
                    </select>
                </div>
                <!-- Footer Modal -->
                <div class="flex justify-end">
                    <button type="button" onclick="closeModalguru()"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded mr-2">Cancel</button>
                    <button class="btn text-base py-2.5 text-white font-medium w-fit hover:bg-blue-700"
                        type="submit">Confirm</button>
                </div>
            </form>


        </div>
    </div>

    {{-- jadwal pelajaran --}}
    @foreach ($rombe as $rombel)
        <!-- Modal Jadwal untuk setiap Rombel -->
        <div id="modaljadwal{{ $rombel->id }}"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6 max-h-[90vh] overflow-y-auto">
                <!-- Header Modal -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Jadwal untuk Rombel: {{ $rombel->kelas ?? '' }}-{{ $rombel->jurusan?->jurusan ?? '' }}-{{ $rombel->jurusan?->no ?? '' }} </h2>
                    <!-- Nama Rombel -->
                    <button onclick="closeModaljadwal({{ $rombel->id }})"
                        class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>
                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        @php
                            // Kelompokkan jadwal berdasarkan hari untuk rombel ini
                            $groupedByHari = $rombel->jadwal->groupBy('hari');
                        @endphp
                        @foreach ($groupedByHari as $hari => $jadwals)
                            <h4 class="text-gray-500 text-lg font-semibold mb-5">{{ $hari }}</h4>
                            <ul class="timeline-widget relative">
                                @foreach ($jadwals as $jadwal)
                                    <li class="timeline-item flex relative overflow-hidden min-h-[70px]">
                                        <div
                                            class="timeline-time text-gray-500 min-w-[90px] py-[6px] text-sm pr-4 text-end">
                                            Jam ke {{ $jadwal->dari }} - {{ $jadwal->sampai }}
                                        </div>
                                        <div class="timeline-badge-wrap flex flex-col items-center">
                                            <div
                                                class="timeline-badge w-3 h-3 rounded-full shrink-0 bg-transparent border-2 border-blue-300 my-[10px]">
                                            </div>
                                            <div class="timeline-badge-border block h-full w-[1px] bg-gray-100"></div>
                                        </div>
                                        <div class="timeline-desc py-[6px] px-4 text-sm">
                                            <a href="javascript:void(0)" class="text-blue-600">
                                                {{ $jadwal->guruMapel->mapel->pelajaran }} -
                                                {{ $jadwal->guruMapel->user->name }}
                                            </a>
                                            <form action="{{ route('delete-jadwal', $jadwal->id) }}" method="POST" onsubmit="return confirm('Jadwal akan di hapus dari jam');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600">
                                                    Delete 
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach







    {{-- add pelajaran --}}
    <div id="addmapel" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6">
            <!-- Header Modal -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Tambah Mapel</h2>
                <button onclick="closeModalmapel()" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>

            <form action="{{ route('addrombelmapel') }}" method="POST">
                @csrf
                <div class="mb-6" hidden>
                    <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">rombaelID</label>
                    <input type="number" name="rombel_id" id="rombel_id"
                        class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                        placeholder="" aria-describedby="hs-input-helper-text">
                </div>

                <div class="mb-6">
                    <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">Mapel &
                        pengjar</label>
                    <select id="country" name="mapel_id" autocomplete="country-name"
                        class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0">
                        @foreach ($mapellist as $mapelGuru)
                            <option value="{{ $mapelGuru->id }}">
                                {{ $mapelGuru->mapel->pelajaran }} - {{ $mapelGuru->user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex space-x-4 mb-6">
                    <!-- Select Dari Jam -->
                    <div class="w-1/2">
                        <label for="dari-jam" class="block text-sm mb-2 text-gray-400">Dari Jam</label>
                        <select name="dari" id="dari-jam"
                            class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0">
                            <option value="">Pilih Jam</option>
                            @for ($i = 7; $i <= 16; $i++)
                                <option value="{{ $i }}">Jam {{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Select Sampai Jam -->
                    <div class="w-1/2">
                        <label for="sampai-jam" class="block text-sm mb-2 text-gray-400">Sampai Jam</label>
                        <select name="sampai" id="sampai-jam"
                            class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0">
                            <option value="">Pilih Jam</option>
                            @for ($i = 7; $i <= 16; $i++)
                                <option value="{{ $i }}">Jam {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="mb-6">
                    <label for="input-label-with-helper-text" class="block text-sm mb-2 text-gray-400">rombaelID</label>
                    <select name="hari" id="hari"
                        class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0">
                        <option value="">Pilih Hari</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                    </select>
                </div>
                <!-- Footer Modal -->
                <div class="flex justify-end">
                    <button type="button" onclick="closeModalmapel()"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded mr-2">Cancel</button>
                    <button class="btn text-base py-2.5 text-white font-medium w-fit hover:bg-blue-700"
                        type="submit">Confirm</button>
                </div>
            </form>


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
            function modaljadwal(id) {
                document.getElementById(`modaljadwal${id}`).classList.remove("hidden");
            }

            function closeModaljadwal(id) {
                document.getElementById(`modaljadwal${id}`).classList.add("hidden");
            }
        </script>

        <script>
            function modalguru() {
                document.getElementById("modalguru").classList.remove("hidden");
            }

            function closeModalguru() {
                document.getElementById("modalguru").classList.add("hidden");
            }

            function closeModalmapel() {
                document.getElementById("addmapel").classList.add("hidden");
            }
        </script>

        {{-- script add mapel --}}
        <script>
            // proses pengambilan data id untuk di inputkan ke dalam form
            function addmapel(btn, romberID) {
                document.getElementById("addmapel").classList.remove("hidden");
                const tr = btn.closest('tr');
                const tds = tr.querySelectorAll('td');
                console.log("Editing ID:", romberID);
                tds.forEach((td, index) => {
                    console.log(`td[${index}]:`, td.textContent.trim());
                });


                document.getElementById('rombel_id').value = romberID;

            }


            // proses select jam pelajaran supaya sampai tidak lebih kecil dari 
            const dariJam = document.getElementById('dari-jam');
            const sampaiJam = document.getElementById('sampai-jam');

            dariJam.addEventListener('change', function() {
                const dariJamValue = parseInt(dariJam.value);

                sampaiJam.innerHTML = '<option value="">Pilih Jam</option>';

                for (let i = dariJamValue + 1; i <= 16; i++) {
                    const option = document.createElement('option');
                    option.value = i;
                    option.textContent = `Jam ${i}`;
                    sampaiJam.appendChild(option);
                }
            });
        </script>
    @endpush
@endsection
