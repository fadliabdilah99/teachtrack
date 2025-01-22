@extends('guru.template.main')

@section('title', 'Guru-Home')

@push('style')
@endpush

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1 -->
        <div
            class="bg-gradient-to-r from-orange-500 to-orange-600 text-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105">
            <div class="flex items-center justify-between">
                <!-- Konten Utama -->
                <div>
                    <h4 class="text-lg font-bold tracking-wide">Jadwal Sekarang</h4>
                    @if ($jadwal == null)
                       <p>Tidak ada jadwal saat ini</p>
                    @else
                        <p class="text-lg mt-2 leading-relaxed">
                            {{ $jadwal->rombel->kelas . '-' . $jadwal->rombel->jurusan->jurusan . ' ' . $jadwal->rombel->jurusan->no }}
                            <br>
                            Dari jam <span class="font-semibold">{{ $jamAwal }}</span> -
                            <span class="font-semibold">{{ $jamAkhir }}</span>
                            <br>
                            Pelajaran: <span class="font-semibold">{{ $jadwal->guruMapel->mapel->pelajaran }}</span>
                        </p>
                    @endif
                </div>

                <!-- Ikon -->
                <div class="flex items-center justify-center p-4 bg-white bg-opacity-20 rounded-full shadow-inner">
                    <i class="fas fa-book text-3xl text-white"></i>
                </div>
            </div>
        </div>

        <!-- Card 1 -->
        <div
            class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-sm font-semibold">Jumlah Siswa Di Ajar</span>
                    <p class="text-3xl font-bold mt-2">{{ $jumlahSiswa }}</p>
                </div>
                <div class="p-3 bg-white bg-opacity-30 rounded-full">
                    <i class="fas fa-user-graduate text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div
            class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-sm font-semibold">Jumlah Kelas</span>
                    <p class="text-3xl font-bold mt-2">{{ $jumlahKelas }}</p>
                </div>
                <div class="p-3 bg-white bg-opacity-30 rounded-full">
                    <i class="fas fa-chalkboard text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div
            class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <span class="text-sm font-semibold">Jumlah Materi</span>
                    <p class="text-3xl font-bold mt-2">{{ $jumlahMateri }}
                    <p>
                </div>
                <div class="p-3 bg-white bg-opacity-30 rounded-full">
                    <i class="fas fa-book text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-x-6 gap-x-0 lg:gap-y-0 gap-y-6">
        <div class="card">
            <div class="card-body">
                <h4 class="text-gray-500 text-lg font-semibold mb-5">Jadwal Hari ini</h4>
                <ul class="timeline-widget relative">
                    @if ($jadwals->isEmpty())
                        <li class="text-gray-500">Tidak ada jadwal untuk hari ini.</li>
                    @else
                        @foreach ($jadwals as $jadwalHari)
                            <li class="timeline-item flex relative overflow-hidden min-h-[70px]">
                                <div class="timeline-time text-gray-500 text-sm min-w-[90px] py-[6px] pr-4 text-end">Jam -
                                    {{ $jadwalHari->dari }} - {{ $jadwalHari->sampai }}
                                </div>
                                <div class="timeline-badge-wrap flex flex-col items-center">
                                    <div
                                        class="timeline-badge w-3 h-3 rounded-full shrink-0 bg-transparent border-2 border-blue-600 my-[10px]">
                                    </div>
                                    <div class="timeline-badge-border block h-full w-[1px] bg-gray-100"></div>
                                </div>
                                <div class="timeline-desc py-[6px] px-4">
                                    <p class="text-gray-500 text-sm font-normal">
                                        {{ $jadwalHari->guruMapel?->mapel?->pelajaran . ' - ' . $jadwalHari->rombel?->kelas . '-' . $jadwalHari->rombel?->jurusan?->jurusan . ' ' . $jadwalHari->rombel?->jurusan?->no }}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
        <div class="col-span-2">
            <div class="card h-full">
                <div class="card-body">
                    @if ($jadwal)
                        <h4 class="text-gray-500 text-lg font-semibold mb-5">Siswa
                            {{ $jadwal->rombel?->kelas . '-' . $jadwal->rombel?->jurusan?->jurusan . ' ' . $jadwal->rombel?->jurusan?->no }}
                        </h4>
                    @else
                        <h4 class="text-gray-500 text-lg font-semibold mb-5">Tidak ada siswa karena tidak ada jadwal saat
                            ini.</h4>
                    @endif

                    @if ($jadwal)
                        <div class="relative overflow-x-auto">
                            <!-- table -->
                            <table class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                                <thead>
                                    <tr class="text-sm">
                                        <th scope="col" class="p-4 font-semibold">Profile</th>
                                        <th scope="col" class="p-4 font-semibold">Nis</th>
                                        <th scope="col" class="p-4 font-semibold">Status</th>
                                        <th scope="col" class="p-4 font-semibold">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwal->rombel->user as $siswa)
                                        <tr>
                                            <td class="p-4 text-sm">
                                                <div class="flex gap-6 items-center">
                                                    <div class="h-12 w-12 inline-block">
                                                        <img src="{{ $siswa->fotoProfile == null ? asset('assets/images/profile/user-3.jpg') : asset('file/profile/' . $siswa->fotoProfile) }}"
                                                            alt="" class="rounded-full w-100">
                                                    </div>
                                                    <div class="flex flex-col gap-1 text-gray-500">
                                                        <h3 class="font-bold">{{ $siswa->name }}
                                                            <span
                                                                class="{{ $siswa->skor->sum('skor') >= 0 ? 'bg-green-500' : 'bg-red-500' }} rounded-full px-2 py-1 text-white text-xs font-semibold ml-2">{{ $siswa->skor->sum('skor') }}</span>
                                                        </h3>
                                                        <span class="font-normal">{{ $siswa->role }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-4">
                                                <h3 class="font-medium">{{ $siswa->NoUnik }}</h3>
                                            </td>
                                            <td class="p-4">
                                                <h3 class="font-medium ">
                                                    {{ $siswa->absen->where('status', 'hadir')->whereBetween('created_at', [now()->format('Y-m-d') . ' 00:00:00', now()->format('Y-m-d') . ' 23:59:59'])->count() == 0? 'Tidak Hadir': 'Hadir' }}
                                                </h3>
                                            </td>
                                            <td class="p-4">
                                                <button type="button" onclick="openModalskors({{ $siswa->id }})"
                                                    class="inline-flex items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white">Skor</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        function openModalskors(id) {
            document.getElementById('skor').classList.remove('hidden');
            document.getElementById('user_id').value = id;
        }

        function closeModalskors() {
            document.getElementById('skor').classList.add('hidden');
        }
    </script>
@endpush
