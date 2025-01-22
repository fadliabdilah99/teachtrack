@extends('guru.template.main')

@section('title', 'Guru-Materi')

@push('style')
@endpush

@section('content')
    <div class="card h-full">
        <div class="card-body">
            <h4 class="text-gray-500 text-lg font-semibold mb-5">Materi</h4>
            <div class="relative overflow-x-auto">
                <button onclick="modalmateri()" class="bg-teal-500 text-white px-4 py-2 rounded-md"><i
                        class="bi bi-plus-lg"></i></button>

                <input type="text" id="searchInputmapel" placeholder="  Search..."
                    class="py-3 px-4 mb-4 border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                    onkeyup="searchTablemapel()" />

                <table class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                    <thead>
                        <tr class="text-sm">
                            <th scope="col" class="p-4 font-semibold">Materi</th>
                            <th scope="col" class="p-4 font-semibold">Tipe</th>
                            <th scope="col" class="p-4 font-semibold">Total materi</th>
                            <th scope="col" class="p-4 font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="dataTablemapel">
                        @foreach ($materis as $mapel)
                            <tr>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">{{ $mapel->judul }}</h3>
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
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">{{ $mapel->struktur->count() }}</h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div class="flex gap-2">
                                        @if ($mapel->jenis == 'ujian(fixed)' || $mapel->jenis == 'ujian')
                                            <a href="{{ url('guru/materi/ujian/' . $mapel->id) }}"
                                                class="inline-flex items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white">
                                                <i class="bi bi-eye font-bold"></i>
                                            </a>
                                        @else
                                            <a href="{{ url('guru/materi/structure/' . $mapel->id) }}"
                                                class="inline-flex items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white">
                                                <i class="bi bi-eye font-bold"></i>
                                            </a>
                                            @if ($mapel->sell->count() == 0)
                                                <div class="">
                                                    <button onclick="modalsel({{ $mapel->id }})"
                                                        class="inline-flex items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white"><i
                                                            class="bi bi-currency-dollar"></i></button>
                                                </div>
                                            @else
                                                <form id="form-stop-sell-{{ $mapel->id }}"
                                                    action="{{ url('guru/materi/stopsell/' . $mapel->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="confirmStopSell({{ $mapel->id }})"
                                                        id="btn-stop-sell-{{ $mapel->id }}"
                                                        class="inline-flex items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white"><i
                                                            class="bi bi-slash-circle"></i></button>
                                                </form>
                                            @endif
                                        @endif
                                        <form id="form-delete-{{ $mapel->id }}"
                                            action="{{ route('deletemateri' , $mapel->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="confirmDelete({{ $mapel->id }})"
                                                id="btn-stop-sell-{{ $mapel->id }}"
                                                class="inline-flex items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white"><i
                                                    class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>


    <div class="card h-full">
        <div class="card-body">
            <h4 class="text-gray-500 text-lg font-semibold mb-5">Penjualan Materi</h4>
            <div class="relative overflow-x-auto">
                <input type="text" id="searchInputmapel" placeholder="  Search..."
                    class="py-3 px-4 mb-4 border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                    onkeyup="searchTablemapel()" />
                <table class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                    <thead>
                        <tr class="text-sm">
                            <th scope="col" class="p-4 font-semibold">materi</th>
                            <th scope="col" class="p-4 font-semibold">harga</th>
                            <th scope="col" class="p-4 font-semibold">Terjual</th>
                            <th scope="col" class="p-4 font-semibold">penghasilan</th>
                        </tr>
                    </thead>
                    <tbody id="dataTablemapel">
                        @foreach ($materis as $materise)
                            @foreach ($materise->sell as $jual)
                                <tr>
                                    <td class="p-4 text-sm">
                                        <div class="flex gap-6 items-center">
                                            <div class="flex flex-col gap-1 text-gray-500">
                                                <h3 class="font-bold">{{ $materise->judul }}</h3>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="p-4 text-sm">
                                        <div class="flex gap-6 items-center">
                                            <div class="flex flex-col gap-1 text-gray-500">
                                                <h3 class="font-bold">{{ number_format($jual->harga) }}</h3>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-sm">
                                        <div class="flex gap-6 items-center">
                                            <div class="flex flex-col gap-1 text-gray-500">
                                                <h3 class="font-bold">{{ $jual->pembeli ? $jual->pembeli->count() : 0 }}
                                                </h3>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4 text-sm">
                                        <div class="flex gap-6 items-center">
                                            <div class="flex flex-col gap-1 text-gray-500">
                                                <h3 class="font-bold">
                                                    {{ $jual->pembeli ? $jual->pembeli->count() * $jual->harga : 0 }}</h3>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    @include('guru.materi.modal')
@endsection

@push('script')
    <script>
        function modalmateri() {
            document.getElementById("addmateri").classList.remove("hidden");
        }

        function closeModalmateri() {
            document.getElementById("addmateri").classList.add("hidden");
        }
    </script>



    <script>
        function showWaktuUjian(value) {
            if (value == "ujian") {
                document.getElementById("ujian").classList.remove("hidden");
            } else {
                document.getElementById("ujian").classList.add("hidden");
            }
        }
    </script>


    {{-- sell modal --}}
    <script>
        function modalsel(MateriID) {
            document.getElementById('materi_guru_id').value = MateriID;
            document.getElementById("sell").classList.remove("hidden");
        }

        function closeModalsell() {
            document.getElementById("sell").classList.add("hidden");
        }

        function stopsell() {
            document.getElementById("sell").classList.add("hidden");
        }
    </script>

    {{-- cancle sell --}}
    <script>
        function confirmStopSell(id) {
            event.preventDefault();
            Swal.fire({
                title: 'Anda yakin?',
                text: "Materi ini akan dihentikan penjualannya",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hentikan penjualan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-stop-sell-' + id).submit();
                }
            })
        }
        // delelte materi
        function confirmDelete(id) {
            event.preventDefault();
            Swal.fire({
                title: 'Anda yakin?',
                text: "Materi akan di tarik dari semua kelas, dan penjualannya dihentikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus Materi ini!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-delete-' + id).submit();
                }
            })
        }
    </script>
@endpush
