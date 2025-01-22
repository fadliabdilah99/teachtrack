    <!-- Kelas -->
    <div class="card h-full" id="kelastable">
        <div class="card-body">
            <h4 class="text-gray-500 text-lg font-semibold mb-5">kelas</h4>
            <div class="relative overflow-x-auto">
                @if (Auth::user()->role == 'KM')
                    <button onclick="modalsiswa()" class="bg-teal-500 text-white px-4 py-2 rounded-md"><i
                            class="bi bi-plus-lg"></i></button>
                @endif

                <input type="text" id="searchInputguru" placeholder="  Search..."
                    class="py-3 px-4 mb-4 border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                    onkeyup="searchTableguru()" />

                <table class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                    <thead>
                        <tr class="text-sm">
                            <th scope="col" class="p-4 font-semibold">Nama</th>
                            <th scope="col" class="p-4 font-semibold">Hadir</th>
                            <th scope="col" class="p-4 font-semibold">Sakit</th>
                            <th scope="col" class="p-4 font-semibold">Izin</th>
                            <th scope="col" class="p-4 font-semibold">Skor</th>
                            <th scope="col" class="p-4 font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="dataTableguru">
                        @foreach ($siswas as $siswa)
                            <tr>
                                <td class="p-4 text-sm">
                                    <div class="flex gap-6 items-center">
                                        <div class="h-12 w-12 inline-block"><img
                                                src="{{ $siswa->fotoProfile == null ? asset('assets/images/profile/user-3.jpg') : asset('file/profile/' . $siswa->fotoProfile) }}"
                                                alt="" class="rounded-full w-100"></div>
                                        <div class="flex flex-col gap-1 text-gray-500">
                                            <h3 class="font-bold">{{ $siswa->name }}
                                            </h3>
                                            <span class="font-normal">{{ $siswa->NoUnik }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td class="p-4">
                                    <h3 class="font-medium text-teal-500">
                                        {{ $siswa->absen->where('status', 'hadir')->count() }}</h3>
                                </td>
                                <td class="p-4">
                                    <h3 class="font-medium text-teal-500">
                                        {{ $siswa->absen->where('status', 'sakit')->count() }}</h3>
                                </td>
                                <td class="p-4">
                                    <h3 class="font-medium text-teal-500">
                                        {{ $siswa->absen->where('status', 'izin')->count() }}</h3>
                                </td>
                                <td class="p-4">
                                    <span
                                        class="inline-flex items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white">{{ $siswa->skor->sum('skor') }}</span>
                                </td>
                                <td class="p-4">
                                    @if (Auth::user()->role == 'sekertaris')
                                        <button
                                            onclick="modaledit({{ $siswa->id }}, '{{ $siswa->name }}', {{ $siswa->NoUnik }})"
                                            class="inline-flex items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white"><i
                                                class="bi bi-pencil"></i></button>
                                    @else
                                        <button
                                            onclick="Swal.fire({
                                            title: 'info',
                                            text: 'Hanya Sekertaris Yang Bisa Mengubah Data',
                                            icon: 'info',
                                            confirmButtonText: 'ok',
                                            confirmButtonColor: '#3085d6',
                                        })"
                                            class="inline-flex items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white"><i
                                                class="bi bi-pencil"></i></button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
        @if (Auth::user()->role == 'sekertaris')
            <div class="card-body">
                <h4 class="text-gray-500 text-lg font-semibold mb-5">list siswa belum mengisi absen</h4>
                <div class="relative overflow-x-auto">
                    <table class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                        <thead>
                            <tr class="text-sm">
                                <th scope="col" class="p-4 font-semibold">Nama</th>
                                <th scope="col" class="p-4 font-semibold">keterangan</th>
                            </tr>
                        </thead>
                        <tbody id="dataTableguru">
                            @foreach ($belumAbsen as $tanpaketerangan)
                                <tr class="{{ $tanpaketerangan->role == 'guru' ? 'hidden' : ''}}">
                                    <td class="p-4 text-sm">
                                        <div class="flex gap-6 items-center">
                                            {{-- <div class="h-12 w-12 inline-block"><img src="./assets/images/profile/user-1.jpg"
                                            alt="" class="rounded-full w-100" />
                                    </div> --}}
                                            <div class="flex flex-col gap-1 text-gray-500">
                                                <h3 class="font-bold">{{ $tanpaketerangan->name }}</h3>
                                                <span class="font-normal">{{ $tanpaketerangan->role }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-4">
                                        <button onclick="addabsen({{ $tanpaketerangan->id }})"
                                            class="inline-flex items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white"><i
                                                class="bi bi-plus"></i></button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        @endif

    </div>


    <!-- jadwal -->
    <div class="card h-full" id="materitable">
        <div class="card-body p-6">
            <h4 class="text-gray-500 text-lg font-semibold mb-5">Materi</h4>

            @if ($currentLesson != null)
                <!-- Grid Wrapper -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($currentLesson->materiGuru as $materi)
                        <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
                            <!-- Gambar -->
                            <img class="w-full h-48 object-cover" src="{{ $materi->image_url }}" alt="Course Image">
                            <div class="p-4">
                                <div class="text-sm text-gray-500 flex items-center">
                                    <span>By {{ $materi->user->name }}</span>
                                </div>

                                <h3 class="mt-2 font-bold text-lg text-gray-800">
                                    {{ $materi->judul }}
                                </h3>

                                <div class="flex items-center mt-2 text-gray-500 text-sm">
                                    <span class="flex items-center">
                                        <i class="bi bi-journal-text mr-1"></i>
                                        {{ $materi->struktur->count() }} Modul
                                    </span>
                                </div>

                                <!-- Penilaian -->
                                <div class="flex items-center mt-2">
                                    <i class="bi bi-star text-yellow-500"></i>
                                    <span class="ml-1 font-semibold text-yellow-500">0.0</span>
                                    <span class="ml-1 text-gray-500">(0) Penilaian</span>
                                </div>

                                <!-- Tombol -->

                                @php
                                    if ($materi->jenis == 'ujian(fixed)') {
                                        $link = 'ujian';
                                    } elseif ($materi->jenis == 'materi') {
                                        $link = 'strukturrombel';
                                    }
                                @endphp

                                <div class="border-t border-gray-200 p-4 flex justify-between items-center">
                                    <a href="{{ route($link, $materi->id) }}"
                                        class="bg-teal-500 text-white px-4 py-2 rounded-md">
                                        <i class="bi bi-book"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-lg font-semibold text-center">Belum Ada Materi</p>
            @endif

        </div>
    </div>

    <!-- materi -->
    <div class="card h-full" id="listmateritable">
        <div class="card-body p-6">

            <div class="flex gap-4">
                <button class="bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded"
                    onclick="dibeli()">
                    Materi di beli
                </button>
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                    onclick="materiall()">
                    Materi kelas
                </button>
            </div>
            <hr class="my-4" />



            {{-- materi di beli --}}
            <div id="dibeli">
                <h4 class="text-gray-500 text-lg font-semibold mt-5 mb-3">Materi di Beli</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($dibeli as $dibelis)
                        <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
                            <!-- Gambar -->
                            <img class="w-full h-48 object-cover" src="{{ $dibelis->materiGuru->image_url }}"
                                alt="Course Image">
                            <div class="p-4">
                                <div class="text-sm text-gray-500 flex items-center">
                                    <span>By {{ $dibelis->materiGuru->user->name }}</span>
                                </div>

                                <h3 class="mt-2 font-bold text-lg text-gray-800">
                                    {{ $dibelis->materiGuru->judul }}
                                </h3>

                                <div class="flex items-center mt-2 text-gray-500 text-sm">
                                    <span class="flex items-center">
                                        <i class="bi bi-journal-text mr-1"></i>
                                        {{ $dibelis->materiGuru->struktur->count() }} Modul
                                    </span>
                                </div>
                                <!-- Penilaian -->
                                <div class="flex items-center mt-2">
                                    <i class="bi bi-star text-yellow-500"></i>
                                    <span class="ml-1 font-semibold text-yellow-500">0.0</span>
                                    <span class="ml-1 text-gray-500">(0) Penilaian</span>
                                </div>

                                <!-- Tombol -->
                                <div class="border-t border-gray-200 p-4 flex justify-between items-center">
                                    <a href="{{ route($link, $dibelis->materiGuru->id) }}"
                                        class="bg-teal-500 text-white px-4 py-2 rounded-md">
                                        <i class="bi bi-book"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="materiall">
                {{-- materi kelas yang dimiliki --}}
                <h4 class="text-gray-500 text-lg font-semibold mt-5 mb-3">Materi Kelas yang Dimiliki</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($allmaterimurid as $alls)
                        <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
                            <!-- Gambar -->
                            <img class="w-full h-48 object-cover" src="{{ $alls->materi->image_url }}"
                                alt="Course Image">
                            <div class="p-4">
                                <div class="text-sm text-gray-500 flex items-center">
                                    <span>By {{ $alls->materi->user->name }}</span>
                                </div>

                                <h3 class="mt-2 font-bold text-lg text-gray-800">
                                    {{ $alls->materi->judul }}
                                </h3>

                                <div class="flex items-center mt-2 text-gray-500 text-sm">
                                    <span class="flex items-center">
                                        <i class="bi bi-journal-text mr-1"></i>
                                        {{ $alls->materi->struktur->count() }} Modul
                                    </span>
                                </div>

                                <!-- Penilaian -->
                                <div class="flex items-center mt-2">
                                    <i class="bi bi-star text-yellow-500"></i>
                                    <span class="ml-1 font-semibold text-yellow-500">0.0</span>
                                    <span class="ml-1 text-gray-500">(0) Penilaian</span>
                                </div>


                                <div class="border-t border-gray-200 p-4 flex justify-between items-center">
                                    <a href="{{ route($link, $alls->materi->id) }}"
                                        class="bg-teal-500 text-white px-4 py-2 rounded-md">
                                        <i class="bi bi-book"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>



        </div>
    </div>
