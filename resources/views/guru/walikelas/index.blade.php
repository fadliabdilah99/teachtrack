@extends('guru.template.main')

@section('title', 'Guru-Kelas')

@push('style')
@endpush

@section('content')
    {{-- kelas --}}
    <div class="card h-full">
        <div class="card-body">
            <h4 class="text-gray-500 text-lg font-semibold mb-5">Murid</h4>
            <div class="relative overflow-x-auto">
                <table class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                    <thead>
                        <tr class="text-sm">
                            <th scope="col" class="p-4 font-semibold">nama</th>
                            <th scope="col" class="p-4 font-semibold">NIK</th>
                            <th scope="col" class="p-4 font-semibold">nilai</th>
                            <th scope="col" class="p-4 font-semibold">skor</th>
                            <th scope="col" class="p-4 font-semibold">kehadiran</th>
                        </tr>
                    </thead>
                    <tbody id="dataTablemapel">
                        @foreach ($murid as $user)
                            <tr>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">
                                                <p>{{ $user->name }}
                                                </p>
                                            </h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">
                                                <p>{{ $user->NoUnik }}
                                                </p>
                                            </h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">
                                                <p>{{ $user->nilai->sum('nilai') }}
                                                </p>
                                            </h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">
                                                <button onclick="skor({{ $user->id }})"
                                                    class="inline-flex
                                                items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white">{{ $user->skor->sum('skor') }}</button>
                                            </h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">
                                                <p>{{ $user->absen->count() }}
                                                </p>
                                            </h3>
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



    {{-- kelas --}}
    <div class="card h-full">
        <div class="card-body">
            <h4 class="text-gray-500 text-lg font-semibold mb-5">Absen Murid</h4>
            <div class="relative overflow-x-auto">
                <table class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                    <thead>
                        <tr class="text-sm">
                            <th scope="col" class="p-4 font-semibold">nama</th>
                            <th scope="col" class="p-4 font-semibold">jam</th>
                            <th scope="col" class="p-4 font-semibold">anulir</th>
                        </tr>
                    </thead>
                    <tbody id="dataTablemapel">
                        @foreach ($kehadiran as $murid)
                            <tr>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">
                                                <p>{{ $murid->name }}
                                                </p>
                                            </h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">
                                                <p>{{ $murid->absen->last()->created_at ?? '-' }}
                                                </p>
                                            </h3>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">
                                                <button onclick="anulir({{ $murid->id }} )"
                                                    class="inline-flex
                                                items-center py-2 px-4 rounded-3xl font-semibold bg-red-400 text-white"><i
                                                        class="bi bi-slash font-bold "></i></button>
                                            </h3>
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

    @include('guru.walikelas.modal')
@endsection

@push('script')
    <script>
        // anulir absen
        function anulir(userID) {
            document.getElementById(`anulir`).classList.remove("hidden");
        }

        function closeanulir(id) {
            document.getElementById(`anulir`).classList.add("hidden");
        }
    </script>
    <script>
        // skor
        function skor(userID) {
            document.getElementById(`skor`).classList.remove("hidden");
            document.getElementById(`user_id`).value = userID;
        }

        function closeskor(id) {
            document.getElementById(`skor`).classList.add("hidden");
        }
    </script>
@endpush
