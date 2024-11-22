@extends('guru.template.main')

@section('title', 'Guru-Kelas')

@push('style')
@endpush

@section('content')

    <div class="card h-full">
        <div class="card-body">
            <h4 class="text-gray-500 text-lg font-semibold mb-5">Jadwal Kelas Mengajar</h4>
            <div class="relative overflow-x-auto">
                <table class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                    <thead>
                        <tr class="text-sm">
                            <th scope="col" class="p-4 font-semibold">Kelas</th>
                            <th scope="col" class="p-4 font-semibold">mapel</th>
                            <th scope="col" class="p-4 font-semibold">Jadwal</th>
                            <th scope="col" class="p-4 font-semibold">Materi</th>
                        </tr>
                    </thead>
                    <tbody id="dataTablemapel">
                        @foreach ($kelas as $kelast)
                            <tr>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">
                                                {{ $kelast->rombel->kelas . '-' . $kelast->rombel->jurusan->jurusan . '-' . $kelast->rombel->jurusan->no }}
                                            </h3>
                                        </div>
                                    </div>
                                </td>

                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">{{ $kelast->guruMapel->mapel->pelajaran }}</h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">
                                                {{ $kelast->hari . ' - ' . $kelast->dari . ' - ' . $kelast->sampai }}</h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <button onclick="modalmateri({{ $kelast->id }}, {{ $kelast->rombel->id }}, )"
                                        class="inline-flex
                                    items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white"><i
                                            class="bi bi-plus font-bold "></i></button>
                                    <button onclick="modallist({{ $kelast->id }})"
                                        class="inline-flex
                                    items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white"><i
                                            class="bi bi-eye font-bold"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    @include('guru.kelas.modal')
@endsection

@push('script')
    <script>
        // add materi ke rombel
        function modalmateri(kelasID, rombelID) {
            document.getElementById("addmateri").classList.remove("hidden");
            document.getElementById('rombel_mapel_guru_id').value = kelasID;
            document.getElementById('rombel_id').value = rombelID;
        }

        function closeModallist(id) {
            document.getElementById(`modallist${id}`).classList.add("hidden");
        }

        function modallist(kelasID) {
            console.log(`modallist${kelasID}`);
            document.getElementById(`modallist${kelasID}`).classList.remove("hidden");
        }
    </script>

    <script>
        function closeModalmateri() {
            document.getElementById("addmateri").classList.add("hidden");
        }
    </script>
@endpush
