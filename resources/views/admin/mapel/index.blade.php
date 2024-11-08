@extends('admin.template.main')

@section('title', 'admin-Kelas')

@push('style')
@endpush

@section('content')

    <div class="card h-full">
        <div class="card-body">
            <h4 class="text-gray-500 text-lg font-semibold mb-5">mapel</h4>
            <div class="relative overflow-x-auto">
                <button onclick="modalmapel()" class="bg-teal-500 text-white px-4 py-2 rounded-md"><i
                        class="bi bi-plus-lg"></i></button>

                <input type="text" id="searchInputmapel" placeholder="  Search..."
                    class="py-3 px-4 mb-4 border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                    onkeyup="searchTablemapel()" />

                <table class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                    <thead>
                        <tr class="text-sm">
                            <th scope="col" class="p-4 font-semibold">Mapel</th>
                            <th scope="col" class="p-4 font-semibold">Tipe/Jurusan</th>
                        </tr>
                    </thead>
                    <tbody id="dataTablemapel">
                        @foreach ($mapels as $mapel)
                            <tr>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">{{ $mapel->pelajaran }}</h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">{{ $mapel->jenis }}</h3>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>


    {{-- add siswa --}}
    <div id="modalmapel" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6">
            <!-- Header Modal -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Tambah Mata Pelajaran</h2>
                <button onclick="closeModalmapel()" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('addmapel') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label for="input-label-with-helper-text"
                                class="block text-sm mb-2 text-gray-400">Pelajaran</label>
                            <input type="text" name="pelajaran" id="input-label-with-helper-text"
                                class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                                placeholder="" aria-describedby="hs-input-helper-text">
                        </div>
                        <div class="mb-6">
                            <div class="mb-6">
                                <label for="input-label-with-helper-text"
                                    class="block text-sm mb-2 text-gray-400">Tipe/Kejuruan</label>
                                <select id="country" name="jenis" autocomplete="country-name"
                                    class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0">
                                    <option value="umum">umum</option>
                                    @foreach ($jurusan as $kejuruan)
                                        <option value="{{ $kejuruan->jurusan }}">{{ $kejuruan->jurusan }}</option>
                                    @endforeach
                                </select>
                            </div>
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
        </div>
    </div>


@endsection

@push('script')
    <script>
        function searchTablemapel() {
            const input = document.getElementById("searchInputmapel").value.toLowerCase();
            const rows = document.querySelectorAll("#dataTablemapel tr");

            rows.forEach(row => {
                // Menggabungkan teks dari semua kolom di baris saat ini
                const rowText = Array.from(row.cells).map(cell => cell.textContent.toLowerCase()).join(" ");

                // Menampilkan atau menyembunyikan baris berdasarkan hasil pencarian
                row.style.display = rowText.includes(input) ? "" : "none";
            });
        }
    </script>

    <script>
        function modalmapel() {
            document.getElementById("modalmapel").classList.remove("hidden");
        }

        function closeModalmapel() {
            document.getElementById("modalmapel").classList.add("hidden");
        }
    </script>
@endpush
