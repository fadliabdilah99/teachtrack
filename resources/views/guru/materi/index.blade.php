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
                            <th scope="col" class="p-4 font-semibold">materi</th>
                            <th scope="col" class="p-4 font-semibold">tipe</th>
                            <th scope="col" class="p-4 font-semibold">total materi</th>
                            <th scope="col" class="p-4 font-semibold">kembangkan</th>
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
                                    <form action="{{ route('addstruktur') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="struktur_id" value="{{ $mapel->id }}">
                                        <button type="submit"
                                            class="inline-flex
                                        items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white"><i
                                                class="bi bi-eye font-bold "></i></button>
                                    </form>
                                </td>
                            </tr>
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
@endpush
