<div class="card h-full">
    <div class="card-body">
        <h4 class="text-gray-500 text-lg font-semibold mb-5">Tambah jadwal ke Kelas</h4>
        <div class="relative overflow-x-auto">
            <button onclick="modalsiswa()" class="bg-teal-500 text-white px-4 py-2 rounded-md"><i
                    class="bi bi-plus-lg"></i></button>
            <input type="text" id="searchInputsiswa" placeholder="Search..."
                class="py-3 px-4 mb-4 border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                onkeyup="searchTablesiswa()" />
            <table class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                <thead>
                    <tr class="text-sm">
                        <th scope="col" class="p-4 font-semibold">Kelas</th>
                        <th scope="col" class="p-4 font-semibold">KM</th>
                        <th scope="col" class="p-4 font-semibold">Total Murid</th>
                        <th scope="col" class="p-4 font-semibold">Action</th>
                    </tr>
                </thead>
                <tbody id="dataTablesiswa">
                    @foreach ($murid as $murids)
                        <tr>
                            <td class="p-4 text-sm">
                                <div class="flex gap-6 items-center">
                                    {{-- <div class="h-12 w-12 inline-block"><img src="./assets/images/profile/user-1.jpg"
                                            alt="" class="rounded-full w-100" />
                                    </div> --}}
                                    <div class="flex flex-col gap-1 text-gray-500">
                                        <h3 class="font-bold">
                                            {{ $murids->rombel->kelas }}-{{ $murids->rombel->jurusan->jurusan }}-{{ $murids->rombel->jurusan->no }}
                                        </h3>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <h3 class="font-medium">{{ $murids->name }}</h3>
                            </td>
                            <td class="p-4">
                                <h3 class="font-medium text-teal-500">
                                    {{ $total[$murids->rombel_id] ?? 0 }}
                                </h3>
                            </td>
                            <td class="p-4">
                                <button onclick="addmapel(this, {{ $murids->rombel->id }})"
                                    class="inline-flex items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white"><i
                                        class="bi bi-plus-circle-fill"></i></button>
                                <button onclick="modaljadwal({{ $murids->rombel->id }})"
                                    class="inline-flex items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white"><i
                                        class="bi bi-list"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
