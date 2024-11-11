@extends('siswa.template.main')

@section('title', 'Siswa-Kelas')

@push('style')
@endpush

@section('content')
    <!-- Dashboard Cards -->
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-green-500 rounded-lg p-4 flex items-center text-white">
            <i class="ti ti-clock text-3xl mr-3"></i>
            <span class="font-semibold text-lg">{{$currentLesson->dari}}-{{$currentLesson->sampai}} {{$currentLesson->guruMapel->mapel->pelajaran}}</span>
        </div>
        <div class="bg-pink-400 rounded-lg p-4 flex items-center text-white">
            <i class="ti ti-trophy text-3xl mr-3"></i>
            <span class="font-semibold text-lg">Achievement</span>
        </div>
        <div class="bg-yellow-400 rounded-lg p-4 flex items-center text-white">
            <i class="ti ti-star text-3xl mr-3"></i>
            <span class="font-semibold text-lg">Leaderboard</span>
        </div>
    </div>
    <!-- Main Content Area -->
    <div class="card h-full">
        <div class="card-body">
            <h4 class="text-gray-500 text-lg font-semibold mb-5">Guru</h4>
            <div class="relative overflow-x-auto">
                <button onclick="modalguru()" class="bg-teal-500 text-white px-4 py-2 rounded-md"><i
                        class="bi bi-plus-lg"></i></button>

                <input type="text" id="searchInputguru" placeholder="  Search..."
                    class="py-3 px-4 mb-4 border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                    onkeyup="searchTableguru()" />

                <table class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                    <thead>
                        <tr class="text-sm">
                            <th scope="col" class="p-4 font-semibold">Nama</th>
                            <th scope="col" class="p-4 font-semibold">Hadir</th>
                            <th scope="col" class="p-4 font-semibold">Sakit</th>
                            <th scope="col" class="p-4 font-semibold">izin</th>
                            <th scope="col" class="p-4 font-semibold">Skor</th>
                        </tr>
                    </thead>
                    <tbody id="dataTableguru">
                        @foreach ($siswas as $siswa)
                            <tr>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        {{-- <div class="h-12 w-12 inline-block"><img src="./assets/images/profile/user-1.jpg"
                                            alt="" class="rounded-full w-100" />
                                    </div> --}}
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">{{ $siswa->name }}</h3>
                                            <span class="font-normal">{{ $siswa->role }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td class="p-4">
                                    <h3 class="font-medium text-teal-500">+53</h3>
                                </td>
                                <td class="p-4">
                                    <h3 class="font-medium text-teal-500">+53</h3>
                                </td>
                                <td class="p-4">
                                    <h3 class="font-medium text-teal-500">+53</h3>
                                </td>
                                <td class="p-4">
                                    <span
                                        class="inline-flex items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white">5</span>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>


    {{-- add siswa --}}
    <div id="modalguru" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6">
            <!-- Header Modal -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Siswa kelas {{ $kelas->kelas }}-{{ $kelas->jurusan->jurusan }}</h2>
                <button onclick="closeModalguru()" class="text-gray-400 hover:text-gray-600">&times;</button>
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
                            <button onclick="closeModalsiswa()"
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

    <script>
        function modalguru() {
            document.getElementById("modalguru").classList.remove("hidden");
        }

        function closeModalguru() {
            document.getElementById("modalguru").classList.add("hidden");
        }
    </script>
@endpush
