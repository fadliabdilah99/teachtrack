<div class="card h-full">
    <div class="card-body">
        <h4 class="text-gray-500 text-lg font-semibold mb-5">Guru</h4>
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
                        <th scope="col" class="p-4 font-semibold">No Guru</th>
                        <th scope="col" class="p-4 font-semibold">email</th>
                    </tr>
                </thead>
                <tbody id="dataTableguru">
                    @foreach ($guru as $gurus)
                        <tr>
                            <td class="p-4 text-sm">
                                <div class="flex gap-6 items-center">
                                    {{-- <div class="h-12 w-12 inline-block"><img src="./assets/images/profile/user-1.jpg"
                                            alt="" class="rounded-full w-100" />
                                    </div> --}}
                                    <div class="flex flex-col gap-1 text-gray-500">
                                        <h3 class="font-bold">{{ $gurus->name }}</h3>
                                        <span class="font-normal">
                                            @if ($gurus->rombel_id != null && $gurus->rombel != null)
                                                {{ $gurus->rombel->kelas }}-{{ $gurus->rombel->jurusan->jurusan }}-{{$gurus->rombel->jurusan->no}}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <h3 class="font-medium">{{ $gurus->NoUnik }}</h3>
                            </td>
                            <td class="p-4">
                                <h3 class="font-medium">{{ $gurus->email }}</h3>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
