    <!-- Main Content Area -->
    <div class="card h-full" id="kelastable">
        <div class="card-body">
            <h4 class="text-gray-500 text-lg font-semibold mb-5">kelas</h4>
            <div class="relative overflow-x-auto">
                <button onclick="modalguru()" class="bg-teal-500 text-white px-4 py-2 rounded-md"><i
                        class="bi bi-plus-lg"></i></button>

                <input type="text" id="searchInputguru" placeholder="  Search..."
                    class="py-3 px-4 mb-4 border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                    onkeyup="searchTableguru()" />

                <table class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                    <thead>
                        <tr class="text-sm">
                            <th scope="col" class="p-4 font-semibold">Nama</th>
                            <th scope="col" class="p-4 font-semibold">Hadir</th>
                            <th scope="col" class="p-4 font-semibold">Sakit</th>
                            <th scope="col" class="p-4 font-semibold">izin</th>
                            <th scope="col" class="p-4 font-semibold">Skor</th>
                        </tr>
                    </thead>
                    <tbody id="dataTableguru">
                        @foreach ($siswas as $siswa)
                            <tr>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        {{-- <div class="h-12 w-12 inline-block"><img src="./assets/images/profile/user-1.jpg"
                                            alt="" class="rounded-full w-100" />
                                    </div> --}}
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">{{ $siswa->name }}</h3>
                                            <span class="font-normal">{{ $siswa->role }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td class="p-4">
                                    <h3 class="font-medium text-teal-500">+53</h3>
                                </td>
                                <td class="p-4">
                                    <h3 class="font-medium text-teal-500">+53</h3>
                                </td>
                                <td class="p-4">
                                    <h3 class="font-medium text-teal-500">+53</h3>
                                </td>
                                <td class="p-4">
                                    <span
                                        class="inline-flex items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white">5</span>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <div class="card h-full" id="materitable">
        <div class="card-body">
            <h4 class="text-gray-500 text-lg font-semibold mb-5">Materi</h4>
            @if ($currentLesson != null)
                @foreach ($currentLesson->materiGuru as $materi)
                    <div class="max-w-xs bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
                        <!-- Gambar -->
                        <img class="w-full h-48 object-cover" src="{{ $materi->image_url }}" alt="Course Image">
                        <div class="p-4">
                            <!-- Nama Instruktur -->
                            <div class="text-sm text-gray-500 flex items-center">
                                <span>By {{ $materi->user->name }}</span>
                            </div>

                            <!-- Judul Kursus -->
                            <h3 class="mt-2 font-bold text-lg text-gray-800">{{ $materi->judul }}
                            </h3>

                            <!-- Info Level, Durasi, Siswa, Modul -->
                            <div class="flex items-center mt-2 text-gray-500 text-sm">
                                <span class="flex items-center">
                                    <i class="bi bi-journal-text mr-1"></i> {{$materi->struktur->count()}} Modul
                                </span>
                            </div>

                            <!-- Rating -->
                            <div class="flex items-center mt-2">
                                <i class="bi bi-star text-yellow-500"></i>
                                <span class="ml-1 font-semibold text-yellow-500">0.0</span>
                                <span class="ml-1 text-gray-500">(0) Penilaian</span>
                            </div>

                            <!-- Harga -->
                            <div class="border-t border-gray-200 p-4 flex justify-between items-center">
                                <a href="{{ route('strukturrombel', $materi->id) }}"
                                    class="bg-teal-500 text-white px-4 py-2 rounded-md"><i class="bi bi-book"></i></a>
                            </div>
                        </div>
                @endforeach
            @else
                <p class="text-lg font-semibold text-center">Belum Ada Materi</p>
            @endif

        </div>
    </div>