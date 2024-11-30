@extends('guru.template.main')

@section('title', 'Guru-Kelas')

@push('style')
@endpush

@section('content')


    {{-- jadwal --}}
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
                        @foreach ($jadwal as $jadwals)
                            <tr>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">
                                                {{ $jadwals->rombel->kelas . '-' . $jadwals->rombel->jurusan->jurusan . '-' . $jadwals->rombel->jurusan->no }}
                                            </h3>
                                        </div>
                                    </div>
                                </td>

                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">{{ $jadwals->guruMapel->mapel->pelajaran }}</h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">
                                                {{ $jadwals->hari . ' - ' . $jadwals->dari . ' - ' . $jadwals->sampai }}
                                            </h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <button onclick="modalmateri({{ $jadwals->id }}, {{ $jadwals->rombel->id }}, )"
                                        class="inline-flex
                                    items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white"><i
                                            class="bi bi-plus font-bold "></i></button>
                                    <button onclick="modallist({{ $jadwals->id }})"
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



    {{-- kelas --}}
    <div class="card h-full">
        <div class="card-body">
            <h4 class="text-gray-500 text-lg font-semibold mb-5">List Kelas Mengajar</h4>
            <div class="relative overflow-x-auto">
                <table class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                    <thead>
                        <tr class="text-sm">
                            <th scope="col" class="p-4 font-semibold">Kelas</th>
                            <th scope="col" class="p-4 font-semibold">murid</th>
                            <th scope="col" class="p-4 font-semibold">Materi/Ujian</th>
                            <th scope="col" class="p-4 font-semibold">nilai Rata Rata</th>
                            <th scope="col" class="p-4 font-semibold">Lihat</th>
                        </tr>
                    </thead>
                    <tbody id="dataTablemapel">
                        @foreach ($rombel as $kelas)
                            <tr>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">
                                                <p>{{ $kelas->kelas . '-' . $kelas->jurusan->jurusan . '-' . $kelas->jurusan->no }}
                                                </p>
                                            </h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">
                                                <p>{{ $kelas->user->count() }}</p>
                                            </h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">
                                                <p>{{ $kelas->jadwal->unique('guru_mapel_id')->count() }}</p>
                                            </h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">
                                                <p>{{ number_format($kelas->user->flatMap->nilai->avg('nilai'), 1) }}</p>
                                            </h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex items-center justify-center">
                                            <button
                                                class="inline-flex
                                    items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white">
                                                <i class="bi bi-eye"></i>
                                            </button>
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

    @include('guru.kelas.modal')
@endsection

@push('script')
    <script>
        // add materi ke rombel
        function modalmateri(kelasID, rombelID) {
            document.getElementById(`addmateri${kelasID}`).classList.remove("hidden");
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
        function closeModalmateri(id) {
            document.getElementById(`addmateri${id}`).classList.add("hidden");
        }
    </script>
@endpush
