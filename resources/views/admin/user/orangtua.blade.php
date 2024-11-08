<div class="card h-full">
    <div class="card-body">
        <h4 class="text-gray-500 text-lg font-semibold mb-5">Orang Tua Murid</h4>
        <div class="relative overflow-x-auto">

            <input type="text" id="searchInputortu" placeholder="Search..."
                class="py-3 px-4 mb-4 border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0"
                onkeyup="searchTableortu()" />

            <table class="text-left w-full whitespace-nowrap text-sm text-gray-500">
                <thead>
                    <tr class="text-sm">
                        <th scope="col" class="p-4 font-semibold">orang tua Dari</th>
                        <th scope="col" class="p-4 font-semibold">NIS Siswa</th>
                        <th scope="col" class="p-4 font-semibold">Email</th>
                        <th scope="col" class="p-4 font-semibold">hubungi</th>
                    </tr>
                </thead>
                <tbody id="dataTableortu">
                    @foreach ($orangtua as $ortu)
                        <tr>
                            <td class="p-4 text-sm">
                                <div class="flex gap-6 items-center">
                                    {{-- <div class="h-12 w-12 inline-block"><img src="./assets/images/profile/user-1.jpg"
                                            alt="" class="rounded-full w-100" />
                                    </div> --}}
                                    <div class="flex flex-col gap-1 text-gray-500">
                                        <h3 class="font-bold">{{ $ortu->name }}</h3>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <h3 class="font-medium">
                                    {{ $ortu->siswa ? $ortu->siswa->NoUnik : 'Data siswa tidak ditemukan' }}</h3>
                            </td>
                            <td class="p-4">
                                <h3 class="font-medium">{{ $ortu->email }}</h3>
                            </td>
                            <td class="p-4">
                                <span
                                    class="inline-flex items-center py-2 px-4 rounded-3xl font-semibold bg-teal-400 text-white">Hubungi</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
