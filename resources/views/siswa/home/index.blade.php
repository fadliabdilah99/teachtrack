@extends('siswa.template.main')

@section('title', 'Siswa-Home')

@push('style')
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
                <span class="font-semibold text-lg">Leaderboard</span>
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
                <button
                    class="w-full bg-green-500 text-white font-semibold py-2 rounded-lg mb-6 hover:bg-green-600 transition">
                    + Buat Postingan
                </button>
                <div class="bg-white rounded-lg shadow-lg p-4">
                    <h3 class="text-xl font-bold mb-4">Sedang Ramai</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="#" class="flex justify-between text-gray-700 hover:text-green-600">
                                <span>Apa Itu CORS? Panduan Lengkap untuk Pemula Dalam Pengembangan Web</span>
                                <span class="text-sm">1 Reactions • 1 Komentar</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex justify-between text-gray-700 hover:text-green-600">
                                <span>Integrasi Stack Overflow dan GitHub Copilot</span>
                                <span class="text-sm">2 Reactions • 2 Komentar</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex justify-between text-gray-700 hover:text-green-600">
                                <span>Kamu Anak IT? Bingung Cari Topik Tugas Akhir? Sini Saya Bantu</span>
                                <span class="text-sm">16 Reactions • 1 Komentar</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex justify-between text-gray-700 hover:text-green-600">
                                <span>Bikin Website (mirip) KitaBisa pake Tailwind CSS | Part 1 - 5</span>
                                <span class="text-sm">1 Reactions • 1 Komentar</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex justify-between text-gray-700 hover:text-green-600">
                                <span>Apa itu GitHub? Simak fungsi dan cara menggunakannya</span>
                                <span class="text-sm">8 Reactions • 3 Komentar</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endSection

@push('script')
@endpush
