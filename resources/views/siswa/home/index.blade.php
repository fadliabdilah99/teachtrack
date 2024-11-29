@extends('siswa.template.main')

@section('title', 'Siswa-Home')

@push('style')
    <style>
        .slider-container {
            position: relative;
            overflow: hidden;
            height: 2rem;
            /* Pastikan sesuai dengan tinggi teks */
            display: flex;
            align-items: center;
        }

        .slider-words {
            display: flex;
            flex-direction: column;
            animation: slide-up 8s ease-in-out infinite;
        }

        .slider-words span {
            display: block;
            height: 2rem;
            line-height: 2rem;
            text-align: left;
        }

        @keyframes slide-up {
            0% {
                transform: translateY(0);
            }

            33% {
                transform: translateY(-2rem);
            }

            66% {
                transform: translateY(-4rem);
            }

            100% {
                transform: translateY(0);
            }

        }
    </style>
@endpush

@section('content')




    <div class="min-h-screen bg-gray-100 p-6">
        <!-- Dashboard Cards -->
        <div class="grid grid-cols-3 gap-4 mb-6">
            <div class="bg-green-500 rounded-lg p-4 flex items-center text-white">
                <i class="ti ti-layout-dashboard text-3xl mr-3"></i>
                <span class="font-semibold text-lg">Dashboard Kelas</span>
            </div>
            <div class="bg-pink-400 rounded-lg p-4 flex items-center text-white">
                <i class="ti ti-trophy text-3xl mr-3"></i>
                <span class="font-semibold text-lg">Achievement</span>
            </div>
            <div class="bg-yellow-400 rounded-lg p-4 flex items-center text-white">
                <i class="ti ti-star text-3xl mr-3"></i>
                <div class="slider-container overflow-hidden">
                    <div class="slider-words">
                        <span class="font-semibold text-lg">Achievements</span>
                        <span class="font-semibold text-lg"></span>
                        <span class="font-semibold text-lg">Nilai Tertinggi</span>
                        <span
                            class="font-semibold text-lg">{{ $kelasRank->kelas . ' ' . $kelasRank->jurusan->jurusan . ' ' . $kelasRank->jurusan->no }}
                            nilai {{ $kelasRank->rataRataNilai }}</span>
                        <span class="font-semibold text-lg">{{ $siswaNilaiTertinggi->name }} nilai
                            {{ $siswaNilaiTertinggi->tes }}</span>
                    </div>
                </div>
            </div>

        </div>
        <!-- Main Content Area -->
        <div class="flex gap-6">
            <!-- Thread Section -->
            <div class="w-2/3">
                <h2 class="text-2xl font-bold mb-4">Thread Pilihan</h2>
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <!-- Thread Header -->
                    <div class="flex items-center mb-4">
                        <img src="https://via.placeholder.com/40" alt="User Avatar" class="w-10 h-10 rounded-full mr-3">
                        <div>
                            <h3 class="font-semibold">Prasatya</h3>
                            <p class="text-sm text-gray-500">ruang rehat • 7 November 2024</p>
                        </div>
                    </div>
                    <!-- Thread Image and Content -->
                    <img src="https://via.placeholder.com/600x300" alt="Thread Image"
                        class="w-full h-60 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">
                        Apa Itu CORS? Panduan Lengkap untuk Pemula Dalam Pengembangan Web
                    </h3>
                    <p class="text-gray-500 mb-4">
                        #apa itu cors #cors adalah #edukasi it
                    </p>
                    <div class="flex items-center text-gray-500 text-sm">
                        <span class="flex items-center mr-4">
                            <i class="ti ti-heart text-pink-500 mr-1"></i> 1 Reaksi
                        </span>
                        <span class="flex items-center mr-4">
                            <i class="ti ti-message mr-1"></i> 1 Komentar
                        </span>
                        <span class="flex items-center">
                            <i class="ti ti-bookmark mr-1"></i> Simpan
                        </span>
                    </div>
                </div>
            </div>

            <!-- Sidebar Section -->
            <div class="w-1/3">
                <button onclick="openModalpost()"
                    class="w-full bg-green-500 text-white font-semibold py-2 rounded-lg mb-6 hover:bg-green-600 transition">
                    + Buat Postingan
                </button>
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <h3 class="text-xl font-bold mb-4">Jadwal Pelajaran</h3>
                    @foreach ($groupedByHari as $hari => $jadwals)
                        <h4 class="text-gray-500 text-lg font-semibold mb-5">{{ $hari }}</h4>
                        <ul class="timeline-widget relative">
                            @foreach ($jadwals as $jadwal)
                                <li class="timeline-item flex relative overflow-hidden min-h-[70px]">
                                    <div class="timeline-time text-gray-500 min-w-[90px] py-[6px] text-sm pr-4 text-end">
                                        jam ke {{ $jadwal->dari }} - {{ $jadwal->sampai }}
                                    </div>
                                    <div class="timeline-badge-wrap flex flex-col items-center">
                                        <div
                                            class="timeline-badge w-3 h-3 rounded-full shrink-0 bg-transparent border-2 border-blue-300 my-[10px]">
                                        </div>
                                        <div class="timeline-badge-border block h-full w-[1px] bg-gray-100"></div>
                                    </div>
                                    <div class="timeline-desc py-[6px] px-4 text-sm">
                                        <p class="text-gray-500 font-semibold"></p>
                                        <a href="javascript:void(0)" class="text-blue-600">
                                            {{ $jadwal->guruMapel->mapel->pelajaran }} -
                                            {{ $jadwal->guruMapel->user->name }}
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    @include('siswa.home.modal')

@endSection

@push('script')
    {{-- modal tambah postingan --}}
    <script>
        function openModalpost() {
            document.getElementById("modalpost").classList.remove("hidden");
        }

        function closemodalpost() {
            document.getElementById("modalpost").classList.add("hidden");
        }
    </script>
@endpush
