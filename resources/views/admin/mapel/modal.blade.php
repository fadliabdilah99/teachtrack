    {{-- add siswa --}}
    <div id="modalmapel" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6">
            <!-- Header Modal -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Tambah Mata Pelajaran</h2>
                <button onclick="closeModalmapel()" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>

            <div class="card">
                <div class="card-body">
                  
                </div>
            </div>
        </div>
    </div>
    {{-- add mapel --}}
    <div id="addguru" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-11/12 md:w-1/2 lg:w-1/3 p-6">
            <!-- Header Modal -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Tambah pengajar</h2>
                <button onclick="closeModalguru()" class="text-gray-400 hover:text-gray-600">&times;</button>
            </div>

            <div class="card">
                <div class="card-body">
                    <form id="addpengajar" action="{{ route('addpengajar') }}" method="POST">
                        @csrf
                        <div hidden class="mb-6">
                            <label for="input-label-with-helper-text"
                                class="block text-sm mb-2 text-gray-400">mapeID</label>
                            <input type="Number" name="mapel_id" id="mapel_id"
                                class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 "
                                placeholder="" aria-describedby="hs-input-helper-text">
                        </div>
                        <div class="mb-6">
                            <div class="mb-6">
                                <label for="input-label-with-helper-text"
                                    class="block text-sm mb-2 text-gray-400">Guru</label>
                                <select id="country" name="guru_id" autocomplete="country-name"
                                    class="py-3 px-4 text-gray-500 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0">
                                    @foreach ($gurus as $guru)
                                        <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Footer Modal -->
                        <div class="flex justify-end">
                            <button type="button" onclick="closeModalguru()"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded mr-2">Cancel</button>
                            <button class="btn text-base py-2.5 text-white font-medium w-fit hover:bg-blue-700"
                                type="submit">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($mapels as $pelajaran)
        <div id="pengajarlist{{ $pelajaran->id }}"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg shadow-lg w-full md:w-3/5 lg:w-2/5 p-6">
                <!-- Header Modal -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">Tambah pengajar</h2>
                    <button onclick="closeModallist({{ $pelajaran->id }})"
                        class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>
                <div class="card h-full">
                    <div class="card-body">
                        <div class="relative overflow-x-auto">
                            <input type="text" id="searchInputmapel" placeholder="  Search..."
                                class="py-3 px-4 mb-4 border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                                onkeyup="searchTablemapel()" />

                            <table class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                                <thead>
                                    <tr class="text-sm">
                                        <th scope="col" class="p-4 font-semibold">pengajar</th>
                                        <th scope="col" class="p-4 font-semibold">NUPTK</th>
                                        <th scope="col" class="p-4 font-semibold">profile</th>
                                    </tr>
                                </thead>
                                <tbody id="dataTablemapel">
                                    @foreach ($pelajaran->user as $pengajar)
                                        <tr>
                                            <td class="p-4 text-sm">
                                                <div class="flex gap-6 items-center">
                                                    <div class="flex flex-col gap-1 text-gray-500">
                                                        <h3 class="font-bold">{{ $pengajar->name }}</h3>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-4 text-sm">
                                                <div class="flex gap-6 items-center">
                                                    <div class="flex flex-col gap-1 text-gray-500">
                                                        <h3 class="font-bold">{{ $pengajar->NoUnik }}</h3>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-4">
                                                <button onclick="mapel(this, {{ $mapel->id }})"
                                                    class="inline-flex
                                                        items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white"><i
                                                        class="bi bi-person"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
