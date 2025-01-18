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
                <p class="text-lg mt-2 leading-relaxed">
                    {{ $jadwal->rombel->kelas . '-' . $jadwal->rombel->jurusan->jurusan . ' ' . $jadwal->rombel->jurusan->no }}
                    <br>
                    Dari jam <span class="font-semibold">{{ $jamAwal }}</span> -
                    <span class="font-semibold">{{ $jamAkhir }}</span>
                    <br>
                    Pelajaran: <span class="font-semibold">{{ $jadwal->guruMapel->mapel->pelajaran }}</span>
                </p>
            </div>
    
            <!-- Ikon -->
            <div
                class="flex items-center justify-center p-4 bg-white bg-opacity-20 rounded-full shadow-inner">
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

@endsection

@push('script')
@endpush
