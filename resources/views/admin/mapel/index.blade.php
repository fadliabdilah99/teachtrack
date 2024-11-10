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
                            <th scope="col" class="p-4 font-semibold">pengajar</th>
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
                                <td class="p-4">
                                    <button onclick="mapel(this, {{ $mapel->id }})"
                                        class="inline-flex
                                        items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white"><i
                                            class="bi bi-plus-lg"></i></button>
                                    <button onclick="showlist({{ $mapel->id }})"
                                        class="inline-flex
                                        items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white">List</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>


@include('admin.mapel.modal')




@endsection

@push('script')
    <script>
        function mapel(btn, historyId) {
            document.getElementById("addguru").classList.remove("hidden");
            const tr = btn.closest('tr');
            const tds = tr.querySelectorAll('td');
            // Logging untuk debugging
            console.log("Editing ID:", historyId);
            tds.forEach((td, index) => {
                console.log(`td[${index}]:`, td.textContent.trim());
            });


            // Mengisi input field
            document.getElementById('mapel_id').value = historyId;

        }
    </script>



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

        function closeModalguru() {
            document.getElementById("addguru").classList.add("hidden");
        }
    </script>
    <script>
        function showlist(id) {
            console.log(`pengajarlist${id}`);
            document.getElementById(`pengajarlist${id}`).classList.remove("hidden");
        }

        function closeModallist(id) {
            document.getElementById(`pengajarlist${id}`).classList.add("hidden");
        }
    </script>
@endpush
